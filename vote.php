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

add_slashes_arr($_POST);

$act = new Account();
$act -> elid = $elid;
$act -> gcid = $gcid;
$act -> actid = (isset($_POST['actid'])) ? intval($_POST['actid']) : 0;
if (!$act -> CheckAccount()) redirect_header('vote_gdcl.php?elid=' . $elid . '&gcid=' .$gcid , 5, $ERRMessage);
$account = $act -> GetAccount();

if (isset($_POST["submit"]))
{
	if ($act -> vote($election_setting['types']))
	{
		redirect_header('vote_gdcl.php?elid=' . $elid . '&gcid=' .$gcid , 5, _MI_VOTEOL_VT_SUCCESS);
	}
	else
	{
		redirect_header('vote_gdcl.php?elid=' . $elid . '&gcid=' .$gcid , 5, _MI_VOTEOL_VT_FAIL);
	}
}

$module = array('name' => $xoopsModule -> getVar('name'));

$page = array();
$page['title'] = _MI_VOTEOL_VT_TITLE . '&nbsp;(' . $gradeclass_setting['gdcl'] . '&nbsp;no.' . $account['nb'] . ')';
$page['elct_title'] = $election_setting['title'];

$route = array();
$route[0]['path'] = 'index.php';
$route[0]['title'] = $xoopsModule -> getVar('name');
$route[1]['path'] = 'election.php?elid=' . $elid;
$route[1]['title'] = $election_setting['title'];
$route[2]['path'] = 'vote_gdcl.php?elid=' . $elid . '&gcid=' .$gcid;
$route[2]['title'] = _MI_VOTEOL_VTGDCL_TITLE . '(' . $gradeclass_setting['gdcl'] . ')';

$sublink = array();

foreach($election_setting['tpcdd'] as $k => $v) foreach($election_setting['tpcdd'][$k]['candidate'] as $k2 => $v2) $election_setting['tpcdd'][$k]['candidate'][$k2]['photo_url'] = get_candidate_photo_url($election_setting['tpcdd'][$k]['candidate'][$k2]['id']);

//template
$xoopsOption['template_main'] = 'vote.htm';

include(XOOPS_ROOT_PATH . '/header.php');
$xoopsTpl -> assign('module', $module);
$xoopsTpl -> assign('page', $page);
$xoopsTpl -> assign('route', $route);
$xoopsTpl -> assign('sublink', $sublink);
$xoopsTpl -> assign('election_setting', $election_setting);
include(XOOPS_ROOT_PATH . '/footer.php');
?>
