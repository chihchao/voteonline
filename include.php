<?php
/*
 *
 *
 */

//function
//deal slashes problem, set magic_quotes_gpc off
function setoff_magic_quotes_gpc()
{
	if (get_magic_quotes_gpc())
	{
		function traverse(&$arr)
		{
			if (!is_array($arr)) return;
			foreach ($arr as $key => $val) is_array ($arr[$key]) ? traverse($arr[$key]) : ($arr[$key] = stripslashes ($arr[$key]));
		}
		$gpc = array( &$_GET, &$_POST, &$_COOKIE );
		traverse($gpc);
	}
}

//add slashes for array data
function add_slashes_arr(&$arr)
{
		function as_trv(&$arr)
		{
			if (!is_array($arr)) return;
			foreach ($arr as $key => $val) is_array ($arr[$key]) ? as_trv($arr[$key]) : ($arr[$key] = addslashes ($arr[$key]));
		}
		as_trv($arr);
}

function authenticate($type)
{
	global $xoopsUser, $xoopsModuleConfig;
	if (is_object($xoopsUser) && $xoopsUser->isAdmin()) return true;
	$groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : array(XOOPS_GROUP_ANONYMOUS);
	$uid = is_object($xoopsUser) ? $xoopsUser->getVar('uid') : 0;
	switch ($type)
	{
		case 'is_admins':
			if ($uid != 0 && in_array($uid, $xoopsModuleConfig['admins'])) return true;
			break;
		case 'is_teachers':
			foreach ($groups as $val) if (in_array($val, $xoopsModuleConfig['teachers'])) return true;
			break;
	}
	return false;
}

function get_candidate_photo_url($cddid)
{
	global $xoopsModuleConfig;
	$img_url = XOOPS_ROOT_PATH . $xoopsModuleConfig['uploadpath'] . '/' . $cddid . '.jpg';
	$img_url = (file_exists($img_url)) ? XOOPS_URL . $xoopsModuleConfig['uploadpath'] . '/' . $cddid . '.jpg' : XOOPS_URL . '/modules/voteonline/images/cdd.jpg';
	return $img_url;
}
//include
include_once("../../mainfile.php");
include_once("class/election.php");
include_once("class/gradeclass.php");
include_once("class/account.php");


//anticipation
setoff_magic_quotes_gpc();
?>