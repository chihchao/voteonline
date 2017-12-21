<?php
/*
 *
 *
 */

class Election
{

	var $elid;
	var $tpid;
	var $cddid;
	var $check_bg;
	var $check_ed;
	var $vote_bg;
	var $vote_ed;
	var $bulletin_bg;

	function Election(){}

	function SetElectionDate($chkbg, $chked, $vtbg, $vted, $bltbg)
	{
		$this -> check_bg = mktime(intval($chkbg[3]), intval($chkbg[4]), 0, intval($chkbg[1]), intval($chkbg[2]), intval($chkbg[0]));
		$this -> check_ed = mktime(intval($chked[3]), intval($chked[4]), 0, intval($chked[1]), intval($chked[2]), intval($chked[0]));
		$this -> vote_bg = mktime(intval($vtbg[3]), intval($vtbg[4]), 0, intval($vtbg[1]), intval($vtbg[2]), intval($vtbg[0]));
		$this -> vote_ed = mktime(intval($vted[3]), intval($vted[4]), 0, intval($vted[1]), intval($vted[2]), intval($vted[0]));
		$this -> bulletin_bg = mktime(intval($bltbg[3]), intval($bltbg[4]), 0, intval($bltbg[1]), intval($bltbg[2]), intval($bltbg[0]));
	}
	function ListElections()
	{
		global $xoopsDB;
		$recordset = array();
		$sql = "Select * From " . $xoopsDB -> prefix('voteonline_election');
		if (!$result = $xoopsDB -> query($sql)) return false;
		while($record = $xoopsDB -> fetchArray($result)) array_push($recordset, $record);
		return $recordset;
	}
	function GetElection()
	{
		global $xoopsDB, $ERRMessage;
		$recordset = array();
		$sql = "Select * From " . $xoopsDB -> prefix('voteonline_election') . " Where id = '" . $this -> elid . "'";
		if (!$result = $xoopsDB -> query($sql)) return false;
		if ($recordset = $xoopsDB -> fetchArray($result))
		{
			$sql = "Select * From " . $xoopsDB -> prefix('voteonline_types') . " Where elid = '" . $this -> elid . "' Order by id";
			if (!$result = $xoopsDB -> query($sql)) return false;
			$recordset['types'] = array();
			$recordset['tpcdd'] = array();
			while ($record = $xoopsDB -> fetchArray($result))
			{
				$recordset['tpcdd'][$record['id']]['types'] = $record['types'];
				$recordset['tpcdd'][$record['id']]['candidate'] = array();
				array_push($recordset['types'], $record);
			}
			$sql = "Select id, elid, tpid, nb, name, votes From " . $xoopsDB -> prefix('voteonline_candidate') . " Where elid = '" . $this -> elid . "' Order by tpid, nb";
			if (!$result = $xoopsDB -> query($sql)) return false;
			$recordset['candidate'] = array();
			while ($record = $xoopsDB -> fetchArray($result))
			{
				array_push($recordset['tpcdd'][$record['tpid']]['candidate'], $record);
				array_push($recordset['candidate'], $record);
			}
		}
		else
		{
			$ERRMessage = _ERRMSG_ELECTION_QUERY_FAIL;
			return false;
		}
		return $recordset;
	}
	function HoldElection()
	{
		global $xoopsDB, $ERRMessage;
		$check_ltrim = ltrim($_POST['title']);
		if (empty($check_ltrim))
		{
			$ERRMessage = _ERRMSG_EMPTY_ELECTION_TITLE;
			return false;
		}
		$this -> SetElectionDate(array($_POST['check_bg_yr'], $_POST['check_bg_mt'], $_POST['check_bg_dy'], $_POST['check_bg_hr'], $_POST['check_bg_mn']), array($_POST['check_ed_yr'], $_POST['check_ed_mt'], $_POST['check_ed_dy'], $_POST['check_ed_hr'], $_POST['check_ed_mn']), array($_POST['vote_bg_yr'], $_POST['vote_bg_mt'], $_POST['vote_bg_dy'], $_POST['vote_bg_hr'], $_POST['vote_bg_mn']), array($_POST['vote_ed_yr'], $_POST['vote_ed_mt'], $_POST['vote_ed_dy'], $_POST['vote_ed_hr'], $_POST['vote_ed_mn']), array($_POST['bulletin_bg_yr'], $_POST['bulletin_bg_mt'], $_POST['bulletin_bg_dy'], $_POST['bulletin_bg_hr'], $_POST['bulletin_bg_mn']));
		$sql = "Insert Into " . $xoopsDB -> prefix('voteonline_election') . " (title, check_bg, check_ed, vote_bg, vote_ed, bulletin_bg) Values ('" . $_POST['title'] . "', '" . $this -> check_bg . "', '" . $this -> check_ed . "', '" . $this -> vote_bg . "', '" . $this -> vote_ed . "', '" . $this -> bulletin_bg . "')";
		if (!$xoopsDB -> query($sql))
		{
			$ERRMessage = _ERRMSG_INSERT_ELECTION_FAIL;
			return false;
		}
		return true;
	}
	function UpdateElection()
	{
		global $xoopsDB, $ERRMessage;
		$ERRMessage = '';
		$check_ltrim = ltrim($_POST['title']);
		if (empty($check_ltrim))
		{
			$ERRMessage = _ERRMSG_EMPTY_ELECTION_TITLE;
			return false;
		}
		$this -> SetElectionDate(array($_POST['check_bg_yr'], $_POST['check_bg_mt'], $_POST['check_bg_dy'], $_POST['check_bg_hr'], $_POST['check_bg_mn']), array($_POST['check_ed_yr'], $_POST['check_ed_mt'], $_POST['check_ed_dy'], $_POST['check_ed_hr'], $_POST['check_ed_mn']), array($_POST['vote_bg_yr'], $_POST['vote_bg_mt'], $_POST['vote_bg_dy'], $_POST['vote_bg_hr'], $_POST['vote_bg_mn']), array($_POST['vote_ed_yr'], $_POST['vote_ed_mt'], $_POST['vote_ed_dy'], $_POST['vote_ed_hr'], $_POST['vote_ed_mn']), array($_POST['bulletin_bg_yr'], $_POST['bulletin_bg_mt'], $_POST['bulletin_bg_dy'], $_POST['bulletin_bg_hr'], $_POST['bulletin_bg_mn']));
		$sql = "Update " . $xoopsDB -> prefix('voteonline_election') . " Set title = '" . $_POST['title'] . "', check_bg = '" . $this -> check_bg . "', check_ed = '" . $this -> check_ed . "', vote_bg = '" . $this -> vote_bg . "', vote_ed = '" . $this -> vote_ed . "', bulletin_bg = '" . $this -> bulletin_bg . "' Where id = '" . $this -> elid . "'";
		if (!$xoopsDB -> query($sql))
		{
			$ERRMessage = _ERRMSG_INSERT_ELECTION_FAIL;
			return false;
		}
		return true;
	}
	function ExistElection()
	{
		global $xoopsDB;
		$recordset = array();
		$sql = "Select id From " . $xoopsDB -> prefix('voteonline_election') . " Where id = '" . $this -> elid . "'";
		if (!$result = $xoopsDB -> query($sql)) return false;
		if (!$recordset = $xoopsDB -> fetchArray($result)) return false;
		return true;
	}
	function DeleteElection()
	{
		global $xoopsDB;
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_account') . " Where elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_class') . " Where elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_vote') . " Where elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_candidate') . " Where elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_types') . " Where elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_election') . " Where id = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		return true;
	}
	function AddTypes()
	{
		global $xoopsDB, $ERRMessage;
		$check_ltrim = ltrim($_POST['types']);
		if (empty($check_ltrim))
		{
			$ERRMessage = _ERRMSG_ELECTION_TYPES_EMPTY;
			return false;
		}
		$recordset = array();
		$sql = "Select id From " . $xoopsDB -> prefix('voteonline_election') . " Where id = '" . $this -> elid . "'";
		if (!$result = $xoopsDB -> query($sql))
		{
			$ERRMessage = _ERRMSG_QUERY_FAIL;
			return false;
		}
		if ($recordset = $xoopsDB -> fetchArray($result))
		{
			$sql = "Insert Into " . $xoopsDB -> prefix('voteonline_types') . " (elid, types) Values ('" . $this -> elid . "', '" . $_POST['types'] . "')";
			if (!$xoopsDB -> query($sql))
			{
				$ERRMessage = _ERRMSG_ELECTION_ADDTYPES_FAIL;
				return false;
			}
			return true;
		}
		else
		{
			$ERRMessage = _ERRMSG_ELECTION_QUERY_FAIL;
			return false;
		}
	}
	function UpdateTypes()
	{
		global $xoopsDB, $ERRMessage;
		$ERRMessage = '';
		$check_ltrim = ltrim($_POST['types']);
		if (empty($check_ltrim))
		{
			$ERRMessage = _ERRMSG_ELECTION_TYPES_EMPTY;
			return false;
		}
		$sql = "Update " . $xoopsDB -> prefix('voteonline_types') . " Set types = '" . $_POST['types'] . "' Where id = '" . $this -> tpid . "' And elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> query($sql))
		{
			$ERRMessage = _ERRMSG_ELECTION_TYPES_MODIFYFAIL;
			return false;
		}
		return true;
	}
	function DeleteTypes()
	{
		global $xoopsDB;
		$recordset = array();
		$sql = "Select id From " . $xoopsDB -> prefix('voteonline_candidate') . " Where tpid = '" . $this -> tpid . "' And elid = '" . $this -> elid . "'";
		if (!$result = $xoopsDB -> query($sql)) return false;
		while (list($id) = $xoopsDB -> fetchRow($result)) $recordset[$id] = $id;
		if (!empty($recordset))
		{
			$sql = "Delete From " . $xoopsDB -> prefix('voteonline_vote') . " Where (cddid = '" . implode("' Or cddid = '", $recordset) . "')  And elid = '" . $this -> elid . "'";
			if (!$xoopsDB -> queryF($sql)) return false;
		}
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_candidate') . " Where tpid = '" . $this -> tpid . "' And elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_types') . " Where id = '" . $this -> tpid . "' And elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		return true;
	}
	function AddCandidate()
	{
		global $xoopsDB, $xoopsModuleConfig, $ERRMessage;
		$check_ltrim = ltrim($_POST['name']);
		if (empty($check_ltrim))
		{
			$ERRMessage = _ERRMSG_ELECTION_CANDIDATE_EMPTY;
			return false;
		}
		$recordset = array();
		$sql = "Select id From " . $xoopsDB -> prefix('voteonline_election') . " Where id = '" . $this -> elid . "'";
		if (!$result = $xoopsDB -> query($sql))
		{
			$ERRMessage = _ERRMSG_QUERY_FAIL;
			return false;
		}
		if ($recordset = $xoopsDB -> fetchArray($result))
		{
			$sql = "Select id From " . $xoopsDB -> prefix('voteonline_types') . " Where id = '" . $this -> tpid . "'";
			if (!$result = $xoopsDB -> query($sql))
			{
				$ERRMessage = _ERRMSG_QUERY_FAIL;
				return false;
			}
			if ($recordset = $xoopsDB -> fetchArray($result))
			{
				$sql = "Insert Into " . $xoopsDB -> prefix('voteonline_candidate') . " (elid, tpid, nb, name) Values ('" . $this -> elid . "', '" . $this -> tpid . "', '" . intval($_POST['nb']) . "', '" . $_POST['name'] . "')";
				if (!$xoopsDB -> query($sql))
				{
					$ERRMessage = _ERRMSG_ELECTION_CANDIDATE_ADDFAIL;
					return false;
				}
				if (is_uploaded_file($_FILES['photo']['tmp_name']) && ($_FILES['photo']['type'] == 'image/jpeg' || $_FILES['photo']['type'] == 'image/jpg' || $_FILES['photo']['type'] == 'image/pjpeg'))
				{
					$upload_path = XOOPS_ROOT_PATH . $xoopsModuleConfig['uploadpath'];
					if (!is_dir($upload_path) || !is_writeable($upload_path)) mkdir($upload_path);
					$cddid = $xoopsDB -> getInsertId();
					$source_size = getimagesize($_FILES["photo"]["tmp_name"]);
					$thumbnail_img = imagecreatetruecolor(120, 160);
					$source_img = imagecreatefromjpeg($_FILES["photo"]["tmp_name"]);
					imagecopyresized($thumbnail_img, $source_img, 0, 0, 0, 0, 120, 160, $source_size[0], $source_size[1]);
					imagejpeg($thumbnail_img, $upload_path . '/' . $cddid . '.jpg');
					imagedestroy($source_img);
					imagedestroy($thumbnail_img);
				}
				return true;
			}
			else
			{
				$ERRMessage = _ERRMSG_ELECTION_TYPES_QUERY_FAIL;
				return false;
			}
		}
		else
		{
			$ERRMessage = _ERRMSG_ELECTION_QUERY_FAIL;
			return false;
		}
	}
	function UpdateCandidate()
	{
		global $xoopsDB, $xoopsModuleConfig, $ERRMessage;
		$ERRMessage = '';
		$check_ltrim = ltrim($_POST['name']);
		if (empty($check_ltrim))
		{
			$ERRMessage = _ERRMSG_ELECTION_CANDIDATE_EMPTY;
			return false;
		}
		$sql = "Update " . $xoopsDB -> prefix('voteonline_candidate') . " Set tpid = '" . $this -> tpid . "', nb = '" . intval($_POST['nb']) . "', name = '" . $_POST['name'] . "' Where id = '" . $this -> cddid . "' And elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> query($sql))
		{
			$ERRMessage = _ERRMSG_ELECTION_CANDIDATE_MODIFYFAIL;
			return false;
		}
		if (is_uploaded_file($_FILES['photo']['tmp_name']) && ($_FILES['photo']['type'] == 'image/jpeg' || $_FILES['photo']['type'] == 'image/jpg' || $_FILES['photo']['type'] == 'image/pjpeg'))
		{
			$upload_path = XOOPS_ROOT_PATH . $xoopsModuleConfig['uploadpath'];
			if (!is_dir($upload_path) || !is_writeable($upload_path)) mkdir($upload_path);
			$cddid = $this -> cddid;
			$source_size = getimagesize($_FILES["photo"]["tmp_name"]);
			$thumbnail_img = imagecreatetruecolor(120, 160);
			$source_img = imagecreatefromjpeg($_FILES["photo"]["tmp_name"]);
			imagecopyresized($thumbnail_img, $source_img, 0, 0, 0, 0, 120, 160, $source_size[0], $source_size[1]);
			imagejpeg($thumbnail_img, $upload_path . '/' . $cddid . '.jpg');
			imagedestroy($source_img);
			imagedestroy($thumbnail_img);
		}
		return true;
	}
	function DeletCandidate()
	{
		global $xoopsDB, $xoopsModuleConfig;
		$sql = "Update " . $xoopsDB -> prefix('voteonline_vote') . " Set cddid = '0' Where cddid = '" . $this -> cddid . "' And elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_candidate') . " Where id = '" . $this -> cddid . "' And elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		unlink(XOOPS_ROOT_PATH . $xoopsModuleConfig['uploadpath'] . '/' . $this -> cddid . '.jpg');
		return true;
	}

	function CountVote()
	{
		global $xoopsDB;
		$recordset = array();
		$recordset[0] = array();
		if ($this -> CheckPackaged())
		{
			$sql = "Select votes, id From " . $xoopsDB -> prefix('voteonline_candidate') . " Where elid = '" . $this -> elid . "'";
			if (!$result = $xoopsDB -> query($sql)) return false;
			while (list($ct, $id) = $xoopsDB -> fetchRow($result)) $recordset[$id] = $ct;
			$sql = "Select id, votes_none From " . $xoopsDB -> prefix('voteonline_types') . " Where elid = '" . $this -> elid . "'";
			if (!$result = $xoopsDB -> query($sql)) return false;
			while (list($id, $votes) = $xoopsDB -> fetchRow($result)) $recordset[0][$id] = $votes;
		}
		else
		{
			$sql = "Select count(id), cddid, tpid From " . $xoopsDB -> prefix('voteonline_vote') . " Where elid = '" . $this -> elid . "' Group By cddid, tpid";
			if (!$result = $xoopsDB -> query($sql)) return false;
			while (list($ct, $id, $tpid) = $xoopsDB -> fetchRow($result))
			{
			if ($id)
			{
				$recordset[$id] = $ct;
			}
			else
			{
				$recordset[0][$tpid] = $ct;
			}
			}
		}
		return $recordset;
	}
	function CheckPackaged()
	{
		global $xoopsDB;
		$sql = "Select packaged From " . $xoopsDB -> prefix('voteonline_election') . " Where id = '" . $this -> elid . "'";
		$result = $xoopsDB -> query($sql);
		list($packaged) = $xoopsDB -> fetchRow($result);
		if ($packaged)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function UpdateBulletin()
	{
		global $xoopsDB;
		$sql = "Update " . $xoopsDB -> prefix('voteonline_election') . " Set bulletin = '" . $_POST['bulletin'] . "' Where id = '" . $this -> elid . "'";
		if (!$xoopsDB -> query($sql)) return false;
		return true;
	}
	function PackageElection()
	{
		global $xoopsDB;
		if ($this -> CheckPackaged()) return false;
		$sql = "Update " . $xoopsDB -> prefix('voteonline_candidate') . " Set votes = '0' Where elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		$sql = "Update " . $xoopsDB -> prefix('voteonline_types') . " Set votes_none = '0' Where elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		$votes = $this -> CountVote();
		foreach($votes as $k => $v)
		{
			if ($k)
			{
				$sql = "Update " . $xoopsDB -> prefix('voteonline_candidate') . " Set votes = '" . $v . "' Where id = '" . $k . "' And elid = '" . $this -> elid . "'";
				$xoopsDB -> queryF($sql);
			}
			else
			{			
				foreach($v as $k2 => $v2)
				{
					$sql = "Update " . $xoopsDB -> prefix('voteonline_types') . " Set votes_none = '" . $v2 . "' Where id = '" . $k2 . "' And elid = '" . $this -> elid . "'";
					$xoopsDB -> queryF($sql);
				}
			}
		}
		$sql = "Update " . $xoopsDB -> prefix('voteonline_election') . " Set packaged = '1' Where id = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_vote') . " Where elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_account') . " Where elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_class') . " Where elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		return true;

	}
	function ResetElectionVotes() {
		global $xoopsDB, $ERRMessage;
		$ERRMessage = '';
		$recordset = array();
		$sql = 'Select actid From ' . $xoopsDB -> prefix('voteonline_vote') . ' Group By actid';
		if (!$result = $xoopsDB -> query($sql)) return false;
		while (list($actid) = $xoopsDB -> fetchRow($result)) array_push($recordset, $actid);
		foreach ($recordset as $actid) {
			$sql = "Delete From " . $xoopsDB -> prefix('voteonline_vote') . " where actid = '" . $actid . "'";
			if ($xoopsDB -> queryF($sql)) {
				$sql = "Update " . $xoopsDB -> prefix('voteonline_account') . " Set status = '1' where id = '" . $actid . "'";
				if (!$xoopsDB -> queryF($sql)) $ERRMessage .= 'error: voteonline_account actid(' . $actid . ') update fail.';
			} else {
				$ERRMessage .= 'error: voteonline_vote actid(' . $actid . ') delete fail.';
			}
		}
		if (empty($ERRMessage)) {
			return true;
		} else {
			return false;
		}
	}
}
