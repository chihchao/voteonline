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

//main
$elct = new Election();
$elct -> elid = $elid;
if (!$election_setting = $elct -> GetElection()) redirect_header('index.php', 5, _MI_VOTEOL_ELCTMANAGE_NOELECTION);
if ($election_setting['packaged']) redirect_header('index.php', 5, _MI_VOTEOL_ELCT_PACKAGED_DESC);

$gdcl = new GradeClass();
$gdcl -> elid = $elid;
$gdcl -> gcid = $gcid;
if (!$gradeclass_setting = $gdcl -> GetGDCL()) redirect_header('election.php?elid=' . $elid, 5, _MI_VOTEOL_ACTSETTING_NOGDCL);

if (!(time() > $election_setting['vote_bg'] && time() < $election_setting['vote_ed'] && is_object($xoopsUser) && $gradeclass_setting['uid'] == $xoopsUser -> getVar('uid'))) redirect_header('election.php?elid=' . $elid, 5, _MI_VOTEOL_CMSN_AUTHFAIL);

if (!($gdcl -> CheckSettinged($xoopsModuleConfig['std_numbers']))) redirect_header('election.php?elid=' . $elid, 5, _MI_VOTEOL_VTGDCL_NOGDCLACCOUNT);

$module = array('name' => $xoopsModule -> getVar('name'));

$page = array();
$page['title'] = _MI_VOTEOL_VTGDCL_TITLE . '(' . $gradeclass_setting['gdcl'] . ')';
$page['elid'] = $elid;
$page['gcid'] = $gcid;
$page['std_numbers'] = $xoopsModuleConfig['std_numbers'];
$page['std_numbers_helf'] = intval($xoopsModuleConfig['std_numbers'] / 2);

$route = array();
$route[0]['path'] = 'index.php';
$route[0]['title'] = $xoopsModule -> getVar('name');
$route[1]['path'] = 'election.php?elid=' . $elid;
$route[1]['title'] = $election_setting['title'];
$route[2]['path'] = $_SERVER['REQUEST_URI'];
$route[2]['title'] = $page['title'];

$sublink = array();

$account = array();
$act = new Account();
$act -> elid = $elid;
$act -> gcid = $gcid;
$account = $act -> ListAccounts();

//template
$xoopsOption['template_main'] = 'vote_gdcl.htm';

include(XOOPS_ROOT_PATH . '/header.php');
$xoopsTpl -> assign('module', $module);
$xoopsTpl -> assign('page', $page);
$xoopsTpl -> assign('route', $route);
$xoopsTpl -> assign('sublink', $sublink);
$xoopsTpl -> assign('account', $account);
include(XOOPS_ROOT_PATH . '/footer.php');
?>
