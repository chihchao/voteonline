<?php
/*
 *
 *
 */

//include
include_once('include.php');

//parameter
$action = (isset($_GET['action']) && in_array($_GET['action'], array('el', 'tp', 'cdd', 'gdcl', 'pk', 'rs'))) ? $_GET['action'] : '';
$elid = (isset($_GET['elid'])) ? intval($_GET['elid']) : 0;
$tpid = (isset($_GET['tpid'])) ? intval($_GET['tpid']) : 0;
$cddid = (isset($_GET['cddid'])) ? intval($_GET['cddid']) : 0;
$gcid = (isset($_GET['gcid'])) ? intval($_GET['gcid']) : 0;

//main
if (!authenticate('is_admins')) redirect_header('index.php', 5, _MI_VOTEOL_CMSN_AUTHFAIL);

$elct = new Election();
$elct -> elid = $elid;
if (!$election_setting = $elct -> GetElection()) redirect_header('index.php?commission=1', 5, _MI_VOTEOL_ELCTMANAGE_NOELECTION);
if ($election_setting['packaged']) redirect_header('index.php', 5, _MI_VOTEOL_ELCT_PACKAGED_DESC);

switch ($action)
{
case 'rs':
	if (isset($_POST["submit"]))
	{
		if (Election::ResetElectionVotes())
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTMANAGE_RESETELCTVOTES_SUCCESS);
		}
		else
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTMANAGE_RESETELCTVOTES_FAIL);
		}
	}
	else
	{
		$confirm_str = _MI_VOTEOL_ELCTMANAGE_RESETELCTVOTES_CONFIRM;
	}
break;
case 'gdcl':
	if (isset($_POST["submit"]))
	{
		$gdcl = new GradeClass();
		$gdcl -> elid = $elid;
		$gdcl -> gcid = $gcid;
		if ($gdcl -> DeleteGDCL())
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTMANAGE_DELETEGDCL_SUCCESS);
		}
		else
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTMANAGE_DELETEGDCL_FAIL);
		}
	}
	else
	{
		$confirm_str = _MI_VOTEOL_ELCTMANAGE_DELETEGDCL_CONFIRM;
	}
break;

case 'cdd':
	if (isset($_POST["submit"]))
	{
		$elct -> cddid = $cddid;
		if ($elct -> DeletCandidate())
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTMANAGE_DELETECDD_SUCCESS);
		}
		else
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTMANAGE_DELETECDD_FAIL);
		}
	}
	else
	{
		$confirm_str = _MI_VOTEOL_ELCTMANAGE_DELETECDD_CONFIRM;
	}
break;

case 'tp':
	if (isset($_POST["submit"]))
	{
		$elct -> tpid = $tpid;
		if ($elct -> DeleteTypes())
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTMANAGE_DELETETP_SUCCESS);
		}
		else
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTMANAGE_DELETETP_FAIL);
		}
	}
	else
	{
		$confirm_str = _MI_VOTEOL_ELCTMANAGE_DELETETP_CONFIRM;
	}
break;

case 'el':
	if (isset($_POST["submit"]))
	{
		if ($elct -> DeleteElection())
		{
			redirect_header('index.php?commission=1', 5, _MI_VOTEOL_ELCTMANAGE_DELETEELCT_SUCCESS);
		}
		else
		{
			redirect_header('index.php?commission=1', 5, _MI_VOTEOL_ELCTMANAGE_DELETEELCT_FAIL);
		}
	}
	else
	{
		$confirm_str = _MI_VOTEOL_ELCTMANAGE_DELETEELCT_CONFIRM;
	}
break;

case 'pk':
	if (isset($_POST["submit"]))
	{
		if ($elct -> PackageElection())
		{
			redirect_header('index.php?commission=1', 5, _MI_VOTEOL_ELCTMANAGE_PACKAGE_SUCCESS);
		}
		else
		{
			redirect_header('index.php?commission=1', 5, _MI_VOTEOL_ELCTMANAGE_PACKAGE_FAIL);
		}
	}
	else
	{
		$confirm_str = _MI_VOTEOL_ELCTMANAGE_PACKAGE_CONFIRM;
	}
break;

default:
	exit();
break;
}
include(XOOPS_ROOT_PATH . "/header.php");
xoops_confirm(array('submit' => '1'), $_SERVER['REQUEST_URI'], $confirm_str);
include(XOOPS_ROOT_PATH . "/footer.php");
?>
