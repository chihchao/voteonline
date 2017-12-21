<?php
/*
 *
 *
 */

//include
include_once('include.php');

//parameter
$elid = (isset($_GET['elid'])) ? intval($_GET['elid']) : 0;
$gcid = (isset($_GET['gcid'])) ? intval($_GET['gcid']) : 0;
$commission = (isset($_GET['commission'])) ? true : false;

//main
$election = new Election();
$election -> elid = $elid;
if (!$election_setting = $election -> GetElection()) redirect_header('index.php', 5, _MI_VOTEOL_ELCTMANAGE_NOELECTION);
if ($election_setting['packaged']) redirect_header('index.php', 5, _MI_VOTEOL_ELCT_PACKAGED_DESC);

$gdcl = new GradeClass();
$gdcl -> elid = $elid;
$gdcl -> gcid = $gcid;
if (!$gradeclass_setting = $gdcl -> GetGDCL()) redirect_header('election.php?elid=' . $elid, 5, _MI_VOTEOL_ACTSETTING_NOGDCL);

if (!authenticate('is_admins')) if (!(time() > $election_setting['check_bg'] && time() < $election_setting['check_ed'] && is_object($xoopsUser) && $gradeclass_setting['uid'] == $xoopsUser -> getVar('uid'))) redirect_header('election.php?elid=' . $elid, 5, _MI_VOTEOL_CMSN_AUTHFAIL);

$settinged = $gdcl -> CheckSettinged($xoopsModuleConfig['std_numbers']);

if (isset($_POST["submit"]) && !$settinged)
{
	add_slashes_arr($_POST);
	$act = new Account();
	$act -> elid = $elid;
	$act -> gcid = $gcid;
	if ($act -> SetAccounts($xoopsModuleConfig['std_numbers']))
	{
		redirect_header($_SERVER['REQUEST_URI'], 5, _MI_VOTEOL_ACTSETTING_SETTINGSUCCESS);
	}
	else
	{
		redirect_header($_SERVER['REQUEST_URI'], 5, _MI_VOTEOL_ACTSETTING_SETTINGFAIL);
	}
}

$module = array('name' => $xoopsModule -> getVar('name'));

$page = array();
$page['title'] = ($settinged) ? _MI_VOTEOL_ACTSETTING_TITLE_CHECK : _MI_VOTEOL_ACTSETTING_TITLE_SETTING ;
$page['elid'] = $elid;
$page['settinged'] = $settinged;
$page['std_numbers'] = $xoopsModuleConfig['std_numbers'];
$page['std_numbers_helf'] = intval($xoopsModuleConfig['std_numbers'] / 2);
$page['commission'] = $commission;

$route = array();
if ($commission)
{
	$route[0]['path'] = 'index.php?commission=1';
	$route[0]['title'] = _MI_VOTEOL_CMSN_TITLE;
	$route[1]['path'] = 'election.php?commission=1&elid=' . $elid;
	$route[1]['title'] = $election_setting['title'];
}
else
{
	$route[0]['path'] = 'index.php';
	$route[0]['title'] = $xoopsModule -> getVar('name');
	$route[1]['path'] = 'election.php?elid=' . $elid;
	$route[1]['title'] = $election_setting['title'];
}
$route[2]['path'] = $_SERVER['REQUEST_URI'];
$route[2]['title'] = $page['title'];

$sublink = array();

$account = array();
if ($settinged)
{
	$act = new Account();
	$act -> elid = $elid;
	$act -> gcid = $gcid;
	$account = $act -> ListAccounts();
}

//template
$xoopsOption['template_main'] = 'account_setting.htm';

include(XOOPS_ROOT_PATH . '/header.php');
$xoopsTpl -> assign('module', $module);
$xoopsTpl -> assign('page', $page);
$xoopsTpl -> assign('route', $route);
$xoopsTpl -> assign('sublink', $sublink);
$xoopsTpl -> assign('account', $account);
include(XOOPS_ROOT_PATH . '/footer.php');
?>
