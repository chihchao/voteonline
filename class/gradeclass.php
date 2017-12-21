<?php
/*
 *
 *
 */

class GradeClass
{

	var $elid;
	var $gcid;

	function GradeClass(){}
	function AddGDCL()
	{
		global $xoopsDB, $ERRMessage;
		$sql = "Insert Into " . $xoopsDB -> prefix('voteonline_class') . " (elid, gdcl, uid) Values ('" . $this -> elid . "', '" . $_POST['gd'] . "-" . $_POST['cl'] . "', '" . $_POST['uid'] . "')";
		if (!$xoopsDB -> query($sql))
		{
			$ERRMessage = _ERRMSG_GDCL_INSERT_FAIL;
			return false;
		}
		return true;
	}
	function ListGDCLs()
	{
		global $xoopsDB, $ERRMessage;
		$recordset = array();
		$sql = "Select * From " . $xoopsDB -> prefix('voteonline_class') . " Where elid = '" . $this -> elid . "'";
		if (!$result = $xoopsDB -> query($sql))
		{
			$ERRMessage = _ERRMSG_QUERY_FAIL;
			return false;
		}
		while ($record = $xoopsDB -> fetchArray($result))
		{
			$gdcl = explode('-', $record['gdcl']);
			$recordset[$gdcl[0]][$gdcl[1]]['id'] = $record['id'];
			$recordset[$gdcl[0]][$gdcl[1]]['uid'] = $record['uid'];
			$recordset[$gdcl[0]][$gdcl[1]]['uname'] = XoopsUser::getUnameFromId($record['uid']);
		}
		ksort($recordset);
		foreach($recordset as $key => $val) ksort($recordset[$key]);
		return $recordset;
	}
	function GetGDCL()
	{
		global $xoopsDB, $ERRMessage;
		$recordset = array();
		$sql = "Select * From " . $xoopsDB -> prefix('voteonline_class') . " Where id = '" . $this -> gcid . "' And elid = '" . $this -> elid . "'";
		if (!$result = $xoopsDB -> query($sql))
		{
			$ERRMessage = _ERRMSG_QUERY_FAIL;
			return false;
		}
		if (!$recordset = $xoopsDB -> fetchArray($result))
		{
			$ERRMessage = _ERRMSG_GDCL_QUERY_FAIL;
			return false;
		}
		return $recordset;
	}
	function UpdateGDCL()
	{
		global $xoopsDB, $ERRMessage;
		$sql ="Update " . $xoopsDB -> prefix('voteonline_class') . " Set gdcl = '" . $_POST['gd'] . "-" . $_POST['cl'] . "', uid = '" . $_POST['uid'] . "' Where elid = '" . $this -> elid . "' And id = '" . $this -> gcid . "'";
		if (!$xoopsDB -> query($sql)) return false;
		return true;
	}
	function ExistGDCL()
	{
		global $xoopsDB;
		$recordset = array();
		$sql = "Select id From " . $xoopsDB -> prefix('voteonline_class') . " Where id = '" . $this -> gcid . "'";
		if (!$result = $xoopsDB -> query($sql)) return false;
		if (!$recordset = $xoopsDB -> fetchArray($result)) return false;
		return true;
	}
	function DeleteGDCL()
	{
		global $xoopsDB;
		$recordset = array();
		$sql = "Select id From " . $xoopsDB -> prefix('voteonline_account') . " Where gcid = '" . $this -> gcid . "'";
		if (!$result = $xoopsDB -> query($sql)) return false;
		while (list($id) = $xoopsDB -> fetchRow($result)) $recordset[$id] = $id;
		if (!empty($recordset))
		{
			$sql = "Delete From " . $xoopsDB -> prefix('voteonline_vote') . " Where (actid = '" . implode("' Or actid = '", $recordset) . "')  And elid = '" . $this -> elid . "'";
			if (!$xoopsDB -> queryF($sql)) return false;
		}
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_account') . " Where gcid = '" . $this -> gcid . "' And elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		$sql = "Delete From " . $xoopsDB -> prefix('voteonline_class') . " Where id = '" . $this -> gcid . "' And elid = '" . $this -> elid . "'";
		if (!$xoopsDB -> queryF($sql)) return false;
		return true;
	}
	function CheckSettinged($std_numbers)
	{
		global $xoopsDB, $ERRMessage;
		$sql = "Select count(*) From " . $xoopsDB -> prefix('voteonline_account') . " Where gcid = '" . $this -> gcid . "'";
		if (!$result = $xoopsDB -> query($sql))
		{
			$ERRMessage = _ERRMSG_QUERY_FAIL;
			return false;
		}
		list($ttl) = $xoopsDB -> fetchRow($result);
		if ($ttl != $std_numbers)
		{
			if ($ttl > 0)
			{
				$sql = "Delete From " . $xoopsDB -> prefix('voteonline_account') . " Where gcid = '" . $this -> gcid . "'";
				$xoopsDB -> queryF($sql);
			}
			return false;
		}
		return true;
	}
}
?>