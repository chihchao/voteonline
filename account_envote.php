<?php
/*
 *
 *
 */

//include
include_once('include.php');

//parameter
$actid = (isset($_GET['actid'])) ? intval($_GET['actid']) : 0;
$action = (isset($_GET['action']) && $_GET['action'] == 'en') ? 'en' : 'un';

//main
$act = new Account();
$act -> actid = $actid;
if (!$account = $act -> GetAccount()) redirect_header('index.php', 5, _MI_VOTEOL_ACTENVOTE_NOACCOUNT);

$election = new Election();
$election -> elid = $account['elid'];
if (!$election_setting = $election -> GetElection()) redirect_header('index.php', 5, _MI_VOTEOL_ELCTMANAGE_NOELECTION);
if ($election_setting['packaged']) redirect_header('index.php', 5, _MI_VOTEOL_ELCT_PACKAGED_DESC);

$gdcl = new GradeClass();
$gdcl -> elid = $account['elid'];
$gdcl -> gcid = $account['gcid'];
if (!$gradeclass_setting = $gdcl -> GetGDCL()) redirect_header('index.php', 5, _MI_VOTEOL_ACTSETTING_NOGDCL);

if (!authenticate('is_admins')) if (!(time() > $election_setting['check_bg'] && time() < $election_setting['check_ed'] && is_object($xoopsUser) && $gradeclass_setting['uid'] == $xoopsUser -> getVar('uid'))) redirect_header('index.php', 5, _MI_VOTEOL_CMSN_AUTHFAIL);

if ($action == 'en')
{
	if ($act -> EnvoteAccount())
	{
		redirect_header('account_setting.php?elid=' . $account['elid'] . '&gcid=' . $account['gcid'], 5, _MI_VOTEOL_ACTENVOTE_ENVOTESUCCESS);
	}
	else
	{
		redirect_header('account_setting.php?elid=' . $account['elid'] . '&gcid=' . $account['gcid'], 5, _MI_VOTEOL_ACTENVOTE_ENVOTEFAIL);
	}
}
else
{
	if ($act -> UnvoteAccount())
	{
		redirect_header('account_setting.php?elid=' . $account['elid'] . '&gcid=' . $account['gcid'], 5, _MI_VOTEOL_ACTENVOTE_UNVOTESUCCESS);
	}
	else
	{
		redirect_header('account_setting.php?elid=' . $account['elid'] . '&gcid=' . $account['gcid'], 5, _MI_VOTEOL_ACTENVOTE_UNVOTEFAIL);
	}
}
?>
