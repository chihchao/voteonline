<?php
/*
 *
 *
 */

//include
include_once('include.php');

//parameter
$action = (isset($_GET['action']) && in_array($_GET['action'], array('tp_add', 'tp_modify', 'cdd_add', 'cdd_modify', 'gdcl_add', 'gdcl_modify', 'blt'))) ? $_GET['action'] : '';
$elid = (isset($_GET['elid'])) ? intval($_GET['elid']) : 0;
$tpid = (isset($_GET['tpid'])) ? intval($_GET['tpid']) : 0;
$cddid = (isset($_GET['cddid'])) ? intval($_GET['cddid']) : 0;
$gcid = (isset($_GET['gcid'])) ? intval($_GET['gcid']) : 0;

//main
if (!authenticate('is_admins')) redirect_header('index.php', 5, _MI_VOTEOL_CMSN_AUTHFAIL);

$election = new Election();
$election -> elid = $elid;
if (!$election_setting = $election -> GetElection()) redirect_header('index.php?commission=1', 5, _MI_VOTEOL_ELCTMANAGE_NOELECTION);
if ($election_setting['packaged']) redirect_header('index.php', 5, _MI_VOTEOL_ELCT_PACKAGED_DESC);

$module = array('name' => $xoopsModule -> getVar('name'));

$page = array();

$route = array();
$route[0]['path'] = 'index.php?commission=1';
$route[0]['title'] = _MI_VOTEOL_CMSN_TITLE;
$route[1]['path'] = 'election.php?commission=1&elid=' . $elid;
$route[1]['title'] = $election_setting['title'];
$route[2]['path'] = $_SERVER['REQUEST_URI'];
$route[2]['title'] = '';

$gradeclass_setting = array();

switch ($action)
{

case 'tp_add':
	if (isset($_POST["submit"]))
	{
		add_slashes_arr($_POST);
		if ($election -> AddTypes())
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTTPCDD_TPADDSUCCESS);
		}
		else
		{
			redirect_header($_SERVER['REQUEST_URI'], 5, $ERRMessage);
		}
	}
	else
	{
		$page['action'] = $action;
		$page['title'] = _MI_VOTEOL_ELCTMANAGE_ELCTTYPES_ADD;
		$route[2]['title'] = _MI_VOTEOL_ELCTMANAGE_ELCTTYPES_ADD;
	}
break;

case 'tp_modify':
	if (isset($_POST["submit"]))
	{
		add_slashes_arr($_POST);
		$election -> tpid = $tpid;
		if ($election -> UpdateTypes())
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTTPCDD_TPMODIFYSUCCESS);
		}
		else
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, $ERRMessage);
		}
	}
	else
	{
		$page['action'] = $action;
		$page['title'] = _MI_VOTEOL_ELCTMANAGE_MODIFY . $election_setting['tpcdd'][$tpid]['types'];
		$page['types'] = $election_setting['tpcdd'][$tpid]['types'];
		$route[2]['title'] = _MI_VOTEOL_ELCTMANAGE_MODIFY . $election_setting['tpcdd'][$tpid]['types'];
	}
break;

case 'cdd_add':
	if (empty($election_setting['types'])) redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTTPCDD_NOTYPES);
	if (isset($_POST["submit"]))
	{
		add_slashes_arr($_POST);
		$election -> tpid = intval($_POST['tpid']);
		if ($election -> AddCandidate())
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTTPCDD_CDDADDSUCCESS);
		}
		else
		{
			redirect_header($_SERVER['REQUEST_URI'], 5, $ERRMessage);
		}
	}
	else
	{
		$page['action'] = $action;
		$page['title'] = _MI_VOTEOL_ELCTMANAGE_ELCTCANDIDATE_ADD;
		$route[2]['title'] = _MI_VOTEOL_ELCTMANAGE_ELCTCANDIDATE_ADD;
		foreach ($election_setting['types'] as $key => $val) $page['tp_options'][$val['id']] = $val['types'];
	}
break;

case 'cdd_modify':
	if (empty($election_setting['types'])) redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTTPCDD_NOTYPES);
	if (isset($_POST["submit"]))
	{
		add_slashes_arr($_POST);
		$notypes = true;
		foreach ($election_setting['types'] as $v) if ($v['id'] == intval($_POST['tpid'])) $notypes = false;
		if ($notypes) redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTTPCDD_NOTYPES);
		$election -> tpid = intval($_POST['tpid']);
		$election -> cddid = $cddid;
		if ($election -> UpdateCandidate())
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTTPCDD_CDDMODIFYSUCCESS);
		}
		else
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, $ERRMessage);
		}
	}
	else
	{
		foreach ($election_setting['candidate'] as $v) if ($v['id'] == $cddid) $page['candidate'] = $v;
		$page['action'] = $action;
		$page['title'] = _MI_VOTEOL_ELCTMANAGE_MODIFY . $page['candidate']['name'];
		$route[2]['title'] = $page['title'];
		foreach ($election_setting['types'] as $key => $val) $page['tp_options'][$val['id']] = $val['types'];
	}
break;

case 'gdcl_add':
	if (isset($_POST["submit"]))
	{
		add_slashes_arr($_POST);
		$gdcl = new GradeClass();
		$gdcl -> elid = $elid;
		if ($gdcl -> AddGDCL())
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTTPCDD_GDCLADDSUCCESS);
		}
		else
		{
			redirect_header($_SERVER['REQUEST_URI'], 5, $ERRMessage);
		}
	}
	else
	{
		$page['title'] = _MI_VOTEOL_ELCTMANAGE_ELCTGDCL_ADD;
		$page['action'] = $action;
		$page['grade'] = explode('|', $xoopsModuleConfig['grade']);
		$page['class'] = explode('|', $xoopsModuleConfig['class']);
		$member_handler =& xoops_gethandler('member');
		$page['teachers'] = array();
		foreach($xoopsModuleConfig['teachers'] as $val)
		{
			$tch =& $member_handler -> getUsersByGroup($val);
			foreach($tch as $v) $page['teachers'][$v] = XoopsUser::getUnameFromId($v,0);
		}
		$route[2]['title'] = _MI_VOTEOL_ELCTMANAGE_ELCTGDCL_ADD;
	}
break;

case 'gdcl_modify':
	$gdcl = new GradeClass();
	$gdcl -> elid = $elid;
	$gdcl -> gcid = $gcid;
	if (isset($_POST["submit"]))
	{
		add_slashes_arr($_POST);
		if ($gdcl -> UpdateGDCL())
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTTPCDD_GDCLMODIFYSUCCESS);
		}
		else
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTTPCDD_GDCLMODIFYFAIL);
		}
	}
	else
	{
		if (!$gradeclass_setting = $gdcl -> GetGDCL()) redirect_header('election.php?elid=' . $elid, 5, _MI_VOTEOL_ACTSETTING_NOGDCL);
		$page['action'] = $action;
		$page['title'] = _MI_VOTEOL_ELCTMANAGE_MODIFY;
		$page['grade'] = explode('|', $xoopsModuleConfig['grade']);
		$page['class'] = explode('|', $xoopsModuleConfig['class']);
		$page['gdcl'] = explode('-', $gradeclass_setting['gdcl']);
		$member_handler =& xoops_gethandler('member');
		$page['teachers'] = array();
		foreach($xoopsModuleConfig['teachers'] as $val)
		{
			$tch =& $member_handler -> getUsersByGroup($val);
			foreach($tch as $v) $page['teachers'][$v] = XoopsUser::getUnameFromId($v,0);
		}
		$route[2]['title'] = _MI_VOTEOL_ELCTMANAGE_MODIFY;
	}
break;

case 'blt':
if (isset($_POST['submit']))
{
	add_slashes_arr($_POST);
	if ($election -> UpdateBulletin())
	{
		redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTTPCDD_BULLETINSUCCESS);
	}
	else
	{
		redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTTPCDD_BULLETINFAIL);
	}

}
else
{
	$page['action'] = $action;
	$page['title'] = _MI_VOTEOL_ELCTMANAGE_BULLETIN;
	$route[2]['title'] = $page['title'];
}
break;


}
//template
$xoopsOption['template_main'] = 'election_tpcdd.htm';

include(XOOPS_ROOT_PATH . '/header.php');
$xoopsTpl -> assign('module', $module);
$xoopsTpl -> assign('page', $page);
$xoopsTpl -> assign('route', $route);
$xoopsTpl -> assign('election_setting', $election_setting);
$xoopsTpl -> assign('gradeclass_setting', $gradeclass_setting);
include(XOOPS_ROOT_PATH . '/footer.php');
?>
