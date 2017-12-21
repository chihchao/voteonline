<?php
/*
 *
 *
 */

//include
include_once('include.php');

//parameter
$commission = (isset($_GET['commission'])) ? true : false;

//main
if ($commission && !authenticate('is_admins')) redirect_header('index.php', 5, _MI_VOTEOL_CMSN_AUTHFAIL);

$module = array('name' => $xoopsModule -> getVar('name'));

$page = array();
$page['title'] = ($commission) ? _MI_VOTEOL_CMSN_TITLE : $xoopsModule -> getVar('name');
$page['commission'] = $commission;
$page['system_time'] = date('Y-m-d H:i:s');

$route = array();
$route[0]['path'] = $_SERVER['REQUEST_URI'];
$route[0]['title'] = $page['title'];

$sublink = array();
if ($commission)
{
	$sublink[0]['path'] = 'election_modify.php';
	$sublink[0]['title'] = _MI_VOTEOL_CMSN_HOLDELECTION;
	$sublink[1]['path'] = 'index.php';
	$sublink[1]['title'] = _MI_VOTEOL_INDEX_LEAVECOMMISSION;
}
else
{
	$sublink[1]['path'] = 'index.php?commission=1';
	$sublink[1]['title'] = _MI_VOTEOL_INDEX_ENTERCOMMISSION;
}

$elct = new Election();
$elections = array();
$elections = $elct -> ListElections();

//template
$xoopsOption['template_main'] = 'voindex.htm';

include(XOOPS_ROOT_PATH . '/header.php');
$xoopsTpl -> assign('module', $module);
$xoopsTpl -> assign('page', $page);
$xoopsTpl -> assign('route', $route);
$xoopsTpl -> assign('sublink', $sublink);
$xoopsTpl -> assign('elections', $elections);
include(XOOPS_ROOT_PATH . '/footer.php');
?>