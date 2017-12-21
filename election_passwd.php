<?php
/*
 *
 *
 */

//include
include_once('include.php');

//parameter
$elid = (isset($_GET['elid'])) ? intval($_GET['elid']) : 0;

//main
if (!authenticate('is_admins')) redirect_header('index.php', 5, _MI_VOTEOL_CMSN_AUTHFAIL);

$elct = new Election();
$elct -> elid = $elid;
if (!$election_setting = $elct -> GetElection()) redirect_header('index.php', 5, _MI_VOTEOL_ELCTMANAGE_NOELECTION);
if ($election_setting['packaged']) redirect_header('index.php', 5, _MI_VOTEOL_ELCT_PACKAGED_DESC);

if (isset($_POST["submit"]))
{
	$act = new Account();
	$act -> elid = $elid;
	if ($act -> SetPasswd())
	{
		redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTMANAGE_PASSWD_SUCCESS);
	}
	else
	{
		redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTMANAGE_PASSWD_FAIL);
	}
}

include(XOOPS_ROOT_PATH . "/header.php");
xoops_confirm(array('submit' => '1'), $_SERVER['REQUEST_URI'], _MI_VOTEOL_ELCTMANAGE_PASSWD_CONFIRM);
include(XOOPS_ROOT_PATH . "/footer.php");
?>
