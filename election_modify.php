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

if (isset($_POST["submit"]))
{
	add_slashes_arr($_POST);
	$elct = new Election();
	if ($elid)
	{
		$elct -> elid = $elid;
		if ($elct -> UpdateElection())
		{
			redirect_header('election.php?commission=1&elid=' . $elid, 5, _MI_VOTEOL_ELCTMODIFY_MODIFYSUCCESS);
		}
		else
		{
			redirect_header($_SERVER['REQUEST_URI'], 5, $ERRMessage);
		}
	}
	else
	{
		if ($elct -> HoldElection())
		{
			redirect_header('index.php?commission=1', 5, _MI_VOTEOL_ELCTMODIFY_HOLDSUCCESS);
		}
		else
		{
			redirect_header($_SERVER['REQUEST_URI'], 5, $ERRMessage);
		}
	}
}

$module = array('name' => $xoopsModule -> getVar('name'));

$page = array();
$page['title'] = ($elid) ? _MI_VOTEOL_ELCTMODIFY_MODIFY : _MI_VOTEOL_ELCTMODIFY_HOLD;
$page['yr'] = array('chkbg' => date('Y'), 'chked' => date('Y'), 'vtbg' => date('Y'), 'vted' => date('Y'), 'bltbg' => date('Y'));
$page['yr_options'] = array(date('Y') - 1, date('Y'), date('Y') + 1);
$page['mt'] = array('chkbg' => date('n'), 'chked' => date('n'), 'vtbg' => date('n'), 'vted' => date('n'), 'bltbg' => date('n'));
$page['mt_options'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
$page['dy'] = array('chkbg' => date('j'), 'chked' => date('j'), 'vtbg' => date('j'), 'vted' => date('j'), 'bltbg' => date('j'));
$page['dy_options'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31);
$page['hr'] = array('chkbg' => 0, 'chked' => 0, 'vtbg' => 0, 'vted' => 0, 'bltbg' => 0);
$page['hr_options'] = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23);
$page['mn'] = array('chkbg' => 0, 'chked' => 0, 'vtbg' => 0, 'vted' => 0, 'bltbg' => 0);
$page['mn_options'] = array(0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55);

$route = array();
$route[0]['path'] = 'index.php?commission=1';
$route[0]['title'] = _MI_VOTEOL_CMSN_TITLE;
$route[1]['path'] = $_SERVER['REQUEST_URI'];
$route[1]['title'] = $page['title'];

$sublink = array();

$election_setting = array();
if ($elid)
{
	$elct = new Election();
	$elct -> elid = $elid;
	$election_setting = $elct -> GetElection();
	if ($election_setting['packaged']) redirect_header('index.php', 5, _MI_VOTEOL_ELCT_PACKAGED_DESC);
	$page['yr']['chkbg'] =  date('Y', $election_setting['check_bg']);
	$page['yr']['chked'] = date('Y', $election_setting['check_ed']);
	$page['yr']['vtbg'] = date('Y', $election_setting['vote_bg']);
	$page['yr']['vted'] = date('Y', $election_setting['vote_ed']);
	$page['yr']['bltbg'] = date('Y', $election_setting['bulletin_bg']);
	$page['mt']['chkbg'] =  date('n', $election_setting['check_bg']);
	$page['mt']['chked'] = date('n', $election_setting['check_ed']);
	$page['mt']['vtbg'] = date('n', $election_setting['vote_bg']);
	$page['mt']['vted'] = date('n', $election_setting['vote_ed']);
	$page['mt']['bltbg'] = date('n', $election_setting['bulletin_bg']);
	$page['dy']['chkbg'] =  date('j', $election_setting['check_bg']);
	$page['dy']['chked'] = date('j', $election_setting['check_ed']);
	$page['dy']['vtbg'] = date('j', $election_setting['vote_bg']);
	$page['dy']['vted'] = date('j', $election_setting['vote_ed']);
	$page['dy']['bltbg'] = date('j', $election_setting['bulletin_bg']);
	$page['hr']['chkbg'] =  date('G', $election_setting['check_bg']);
	$page['hr']['chked'] = date('G', $election_setting['check_ed']);
	$page['hr']['vtbg'] = date('G', $election_setting['vote_bg']);
	$page['hr']['vted'] = date('G', $election_setting['vote_ed']);
	$page['hr']['bltbg'] = date('G', $election_setting['bulletin_bg']);
	$page['mn']['chkbg'] =  intval(date('i', $election_setting['check_bg']));
	$page['mn']['chked'] = intval(date('i', $election_setting['check_ed']));
	$page['mn']['vtbg'] = intval(date('i', $election_setting['vote_bg']));
	$page['mn']['vted'] = intval(date('i', $election_setting['vote_ed']));
	$page['mn']['bltbg'] = intval(date('i', $election_setting['bulletin_bg']));
	$route[1]['path'] = 'election.php?commission=1&elid=' . $elid;
	$route[1]['title'] = $election_setting['title'];
	$route[2]['path'] = $_SERVER['REQUEST_URI'];
	$route[2]['title'] = _MI_VOTEOL_ELCTMANAGE_ELCTMODIFY;
}

//template
$xoopsOption['template_main'] = 'election_modify.htm';

include(XOOPS_ROOT_PATH . '/header.php');
$xoopsTpl -> assign('module', $module);
$xoopsTpl -> assign('page', $page);
$xoopsTpl -> assign('route', $route);
$xoopsTpl -> assign('sublink', $sublink);
$xoopsTpl -> assign('election_setting', $election_setting);
include(XOOPS_ROOT_PATH . '/footer.php');
?>
