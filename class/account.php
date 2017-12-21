<?php
/*
 *
 *
 */

class Account
{

	var $elid;
	var $gcid;
	var $actid;
	var $nb;

	function Account(){}
	function ListAccounts()
	{
		global $xoopsDB;
		$recordset = array();
		$sql = "Select * From " . $xoopsDB -> prefix('voteonline_account') . " Where elid = '" . $this -> elid . "' And gcid = '" . $this -> gcid . "' Order By nb";
		if (!$result = $xoopsDB -> query($sql)) return false;
		while ($record = $xoopsDB -> fetchArray($result)) array_push($recordset, $record);
		return $recordset;
	}
	function GetAccount()
	{
		global $xoopsDB;
		$recordset = array();
		$sql = "Select * From " . $xoopsDB -> prefix('voteonline_account') . " Where id = '" . $this -> actid . "'";
		if (!$result = $xoopsDB -> query($sql)) return false;
		if (!$recordset = $xoopsDB -> fetchArray($result)) return false;
		return $recordset;
	}
	function SetAccounts($std_numbers)
	{
		global $xoopsDB;
		for ($i = 1; $i <= $std_numbers; $i ++)
		{
			$status = (in_array($i, $_POST['nb'])) ? (0) : (1);
			$nb_str[$i] = "(" . $this -> elid . ", " . $this -> gcid . ", " . $i . ", " . $status . ")";
		}
		$sql = "Insert Into " . $xoopsDB -> prefix('voteonline_account') . " (elid, gcid, nb, status) Values " . implode(", ", $nb_str);
		if (!$xoopsDB -> query($sql)) return false;
		return true;
	}
	function UnvoteAccount()
	{
		global $xoopsDB;
		$sql = "Update " . $xoopsDB -> prefix('voteonline_account') . " Set status = '0' where id = '" . $this -> actid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		return true;
	}
	function EnvoteAccount()
	{
		global $xoopsDB;
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_vote') . " where actid = '" . $this -> actid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		$sql = "Update " . $xoopsDB -> prefix('voteonline_account') . " Set status = '1' where id = '" . $this -> actid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		return true;
	}
	function CheckAccount()
	{
		global $xoopsDB, $ERRMessage;
		$ERRMessage = '';
		$recordset = array();
		$sql = "Select * From " . $xoopsDB -> prefix('voteonline_account') . " Where id = '" . $this -> actid . "' And elid = '" . $this -> elid . "' And gcid = '" . $this -> gcid . "' And passwd = '" . $_POST['passwd'] . "'";
		if (!$result = $xoopsDB -> query($sql)) return false;
		if (!$recordset = $xoopsDB -> fetchArray($result))
		{
			$ERRMessage = _ERRMSG_ACCOUNT_PASSWD_FAIL;
			return false;
		}
		if ($recordset['status'])
		{
			return true;
		}
		else
		{
			$ERRMessage = _ERRMSG_ACCOUNT_STATUS_FAIL;
			return false;
		}
	}
	function SetPasswd()
	{
		global $xoopsDB;
		$sql = "Update " . $xoopsDB -> prefix('voteonline_account') . " Set passwd = SUBSTRING(rand(), 3, 5)";
		if (!$result = $xoopsDB -> query($sql)) return false;
		if (!$xoopsDB -> queryF($sql)) return false;
		return true;
	}
	function vote($types)
	{
		global $xoopsDB;
		$sql = "Update " . $xoopsDB -> prefix('voteonline_account') . " Set status = '0' where id = '" . $this -> actid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		foreach($types as $k => $v)
		{
			$cddid = (isset($_POST[$v['id']])) ? $_POST[$v['id']] : 0;
			$cdd_str[$v['id']] = "('" . $this -> elid . "', '" . $v['id'] . "', '" . $cddid . "', '" . $this -> actid . "', '" . $_SERVER['REMOTE_ADDR'] . "', now())";
		}
		$sql = "Insert Into " . $xoopsDB -> prefix('voteonline_vote') . " (elid, tpid, cddid, actid, ip, dttm) Values " . implode(", ", $cdd_str);
		if (!$xoopsDB -> query($sql))
		{
			$sql = "Update " . $xoopsDB -> prefix('voteonline_account') . " Set status = '1' where id = '" . $this -> actid . "'";
			$xoopsDB -> queryF($sql);
			return false;
		}
		return true;
	}
}