<?php
/*
 *
 *
 */

//include
include_once('include.php');

//parameter
$elid = (isset($_GET['elid'])) ? intval($_GET['elid']) : 0;
$commission = (isset($_GET['commission'])) ? true : false;

//main
if ($commission && !authenticate('is_admins')) redirect_header('index.php', 5, _MI_VOTEOL_CMSN_AUTHFAIL);

$elct = new Election();
$elct -> elid = $elid;
if (!$election_setting = $elct -> GetElection()) redirect_header('index.php', 5, _MI_VOTEOL_ELCTMANAGE_NOELECTION);
$gdcl = new GradeClass();
$gdcl -> elid = $elid;
$election_setting['gdcl'] = $gdcl -> ListGDCLs();

$module = array('name' => $xoopsModule -> getVar('name'));

$page = array();
$page['elid'] = $elid;
$page['packaged'] = $election_setting['packaged'];
$page['commission'] = $commission;
$page['title'] = $election_setting['title'];
$page['system_time'] = date('Y-m-d H:i:s');
$page['period']['check'] = (time() > $election_setting['check_bg'] && time() < $election_setting['check_ed']) ? true : false;
$page['period']['vote'] = (time() > $election_setting['vote_bg'] && time() < $election_setting['vote_ed']) ? true : false;
$page['period']['bulletin'] = (time() > $election_setting['bulletin_bg']) ? true : false;


$route = array();
if ($commission)
{
	$route[0]['path'] = 'index.php?commission=1';
	$route[0]['title'] = _MI_VOTEOL_CMSN_TITLE;
}
else
{
	$route[0]['path'] = 'index.php';
	$route[0]['title'] = $xoopsModule -> getVar('name');
}
$route[1]['path'] = $_SERVER['REQUEST_URI'];
$route[1]['title'] = $page['title'];


$sublink = array();
if ($commission && !$election_setting['packaged'])
{
	$sublink[0]['path'] = 'election_tpcdd.php?action=tp_add&elid=' . $elid;
	$sublink[0]['title'] = _MI_VOTEOL_ELCTMANAGE_ELCTTYPES_ADD;
	$sublink[1]['path'] = 'election_tpcdd.php?action=cdd_add&elid=' . $elid;
	$sublink[1]['title'] = _MI_VOTEOL_ELCTMANAGE_ELCTCANDIDATE_ADD;
	$sublink[2]['path'] = 'election_tpcdd.php?action=gdcl_add&elid=' . $elid;
	$sublink[2]['title'] = _MI_VOTEOL_ELCTMANAGE_ELCTGDCL_ADD;
	$sublink[3]['path'] = 'election_modify.php?elid=' . $elid;
	$sublink[3]['title'] = _MI_VOTEOL_ELCTMANAGE_ELCTMODIFY;
	$sublink[4]['path'] = 'election_tpcdd.php?action=blt&elid=' . $elid;
	$sublink[4]['title'] = _MI_VOTEOL_ELCTMANAGE_BULLETIN;
}

foreach($election_setting['tpcdd'] as $k => $v) foreach($election_setting['tpcdd'][$k]['candidate'] as $k2 => $v2) $election_setting['tpcdd'][$k]['candidate'][$k2]['photo_url'] = get_candidate_photo_url($election_setting['tpcdd'][$k]['candidate'][$k2]['id']);

if (time() > $election_setting['bulletin_bg'])
{
	$count_votes = $elct -> CountVote();
	foreach($election_setting['tpcdd'] as $k => $v)
	{
		foreach($election_setting['tpcdd'][$k]['candidate'] as $k2 => $v2) $election_setting['tpcdd'][$k]['candidate'][$k2]['votes'] = isset($count_votes[$election_setting['tpcdd'][$k]['candidate'][$k2]['id']]) ? $count_votes[$election_setting['tpcdd'][$k]['candidate'][$k2]['id']] : 0;
		$election_setting['tpcdd'][$k]['vote_none'] = isset($count_votes[0][$k]) ? $count_votes[0][$k] : 0;
	}
	
}

//template
$xoopsOption['template_main'] = 'election.htm';

include(XOOPS_ROOT_PATH . '/header.php');
$xoopsTpl -> assign('module', $module);
$xoopsTpl -> assign('page', $page);
$xoopsTpl -> assign('route', $route);
$xoopsTpl -> assign('sublink', $sublink);
$xoopsTpl -> assign('election_setting', $election_setting);
include(XOOPS_ROOT_PATH . '/footer.php');
?>
