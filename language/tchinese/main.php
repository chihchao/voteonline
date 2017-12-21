<?php
//error message
define('_ERRMSG_QUERY_FAIL', '資料庫查詢失敗！');
define('_ERRMSG_EMPTY_ELECTION_TITLE', '缺少選舉活動標題，請重新輸入！');
define('_ERRMSG_INSERT_ELECTION_FAIL', '選舉活動設定無法輸入資料庫，請重新輸入！');
define('_ERRMSG_ELECTION_TYPES_EMPTY', '缺少選舉種類名稱，請重新輸入！');
define('_ERRMSG_ELECTION_ADDTYPES_FAIL', '新增選舉種類失敗！');
define('_ERRMSG_ELECTION_QUERY_FAIL', '選舉活動查詢失敗！');
define('_ERRMSG_ELECTION_CANDIDATE_EMPTY', '缺少候選人名稱，請重新輸入！');
define('_ERRMSG_ELECTION_TYPES_QUERY_FAIL', '選舉種類查詢失敗！');
define('_ERRMSG_GDCL_INSERT_FAIL', '新增選舉班級失敗！');
define('_ERRMSG_GDCL_QUERY_FAIL', '選舉班級查詢失敗！');
define('_ERRMSG_ACCOUNT_PASSWD_FAIL', '帳號密碼查驗失敗！');
define('_ERRMSG_ACCOUNT_STATUS_FAIL', '帳號已被封鎖投票！');
define('_ERRMSG_ELECTION_TYPES_MODIFYFAIL', '選舉種類修改失敗！');
define('_ERRMSG_ELECTION_CANDIDATE_ADDFAIL', '候選人新增失敗！');
define('_ERRMSG_ELECTION_CANDIDATE_MODIFYFAIL', '候選人修改失敗！');

//voindex
define('_MI_VOTEOL_INDEX_SYSTEMTIME', '目前系統時間：');
define('_MI_VOTEOL_INDEX_LEAVECOMMISSION', '離開選務中心');
define('_MI_VOTEOL_INDEX_ENTERCOMMISSION', '進入選務中心');

define('_MI_VOTEOL_CMSN_AUTHFAIL', '認證失敗，你沒有權限進入本網頁，請以有權限的帳號登入！');
define('_MI_VOTEOL_CMSN_TITLE', '選務中心');
define('_MI_VOTEOL_CMSN_HOLDELECTION', '舉辦選舉活動');

//election
define('_MI_VOTEOL_ELCT_GDCLVOTE', '進入班級投票');
define('_MI_VOTEOL_ELCT_SUBTITLE_RESULT', '投票結果');
define('_MI_VOTEOL_ELCT_SUBTITLE_DESC', '說明事項');
define('_MI_VOTEOL_ELCT_VOTENONE', '廢票');
define('_MI_VOTEOL_ELCT_PACKAGED_DESC', '選舉已封存無法再做任何查詢及修改。');

define('_MI_VOTEOL_ELCTMANAGE_NOELECTION', '沒有所指定的選舉活動！');
define('_MI_VOTEOL_ELCTMANAGE_ELCTTITLE', '選舉活動標題');
define('_MI_VOTEOL_ELCTMANAGE_ELCTCHKBG', '名冊檢查開始時間');
define('_MI_VOTEOL_ELCTMANAGE_ELCTCHKED', '名冊檢查結束時間');
define('_MI_VOTEOL_ELCTMANAGE_ELCTVTBG', '選舉投票開始時間');
define('_MI_VOTEOL_ELCTMANAGE_ELCTVTED', '選舉投票結束時間');
define('_MI_VOTEOL_ELCTMANAGE_ELCTBLTBG', '當選公告開始時間');
define('_MI_VOTEOL_ELCTMANAGE_ELCTBLT', '當選公告');
define('_MI_VOTEOL_ELCTMANAGE_ELCTTYPES', '選舉種類');
define('_MI_VOTEOL_ELCTMANAGE_ELCTTYPES_ADD', '新增選舉種類');
define('_MI_VOTEOL_ELCTMANAGE_ELCTCANDIDATE', '候選人');
define('_MI_VOTEOL_ELCTMANAGE_ELCTCANDIDATE_ADD', '新增候選人');
define('_MI_VOTEOL_ELCTMANAGE_ELCTGDCL_ADD', '新增投票班級');
define('_MI_VOTEOL_ELCTMANAGE_BULLETIN', '修改當選公告');
define('_MI_VOTEOL_ELCTMANAGE_YEAR', '年');
define('_MI_VOTEOL_ELCTMANAGE_MONTH', '月');
define('_MI_VOTEOL_ELCTMANAGE_DAY', '日');
define('_MI_VOTEOL_ELCTMANAGE_HOUR', '時');
define('_MI_VOTEOL_ELCTMANAGE_MINUTE', '分');
define('_MI_VOTEOL_ELCTMANAGE_ELCTGDCL', '投票班級');
define('_MI_VOTEOL_ELCTMANAGE_PASSWD', '設定投票密碼');
define('_MI_VOTEOL_ELCTMANAGE_PASSWD_DESC', '「設定投票密碼」將會重設所有投票名冊帳號的密碼，所以請在設定好所有投票名冊後再按下 [設定投票密碼]');
define('_MI_VOTEOL_ELCTMANAGE_PASSWD_CONFIRM', '你確定要重設所有班級的投票密碼嗎？');
define('_MI_VOTEOL_ELCTMANAGE_PASSWD_SUCCESS', '重設所有班級的投票密碼成功！');
define('_MI_VOTEOL_ELCTMANAGE_PASSWD_FAIL', '重設所有班級的投票密碼失敗！');
define('_MI_VOTEOL_ELCTMANAGE_ELCTMODIFY', '修改選舉設定');
define('_MI_VOTEOL_ELCTMANAGE_ELCTDELETE', '刪除本次選舉');
define('_MI_VOTEOL_ELCTMANAGE_ELCTPACKAGE', '封存本次選舉');
define('_MI_VOTEOL_ELCTMANAGE_MODIFY', '修改');
define('_MI_VOTEOL_ELCTMANAGE_DELETE', '刪除');
define('_MI_VOTEOL_ELCTMANAGE_DELETEGDCL_CONFIRM', '刪除班級將會連帶刪除班級選舉人及該班級選舉人所投下之選票，你確定要刪除所指定的班級嗎？');
define('_MI_VOTEOL_ELCTMANAGE_DELETEGDCL_SUCCESS', '刪除班級成功！');
define('_MI_VOTEOL_ELCTMANAGE_DELETEGDCL_FAIL', '刪除班級失敗！');
define('_MI_VOTEOL_ELCTMANAGE_DELETECDD_CONFIRM', '刪除候選人將會連帶把投給該候選人的選票設成廢票，你確定要刪除該候選人嗎？');
define('_MI_VOTEOL_ELCTMANAGE_DELETECDD_SUCCESS', '刪除候選人成功！');
define('_MI_VOTEOL_ELCTMANAGE_DELETECDD_FAIL', '刪除候選人失敗！');
define('_MI_VOTEOL_ELCTMANAGE_DELETETP_CONFIRM', '刪除選舉種類將會連帶把投給該種類的候選人及候選人的選票刪除，你確定要刪除該選舉種類嗎？');
define('_MI_VOTEOL_ELCTMANAGE_DELETETP_SUCCESS', '刪除選舉種類成功！');
define('_MI_VOTEOL_ELCTMANAGE_DELETETP_FAIL', '刪除選舉種類失敗！');
define('_MI_VOTEOL_ELCTMANAGE_ELCTDELETE_DESC', '「刪除本次選舉」將會連帶把有關該選舉的所有資料全部刪除，請注意！！！');
define('_MI_VOTEOL_ELCTMANAGE_DELETEELCT_CONFIRM', '刪除選舉將會連帶把有關該選舉的所有資料全部刪除，你確定要刪除該選舉嗎？');
define('_MI_VOTEOL_ELCTMANAGE_DELETEELCT_SUCCESS', '刪除選舉成功！');
define('_MI_VOTEOL_ELCTMANAGE_DELETEELCT_FAIL', '刪除選舉失敗！');
define('_MI_VOTEOL_ELCTMANAGE_RESETELCTVOTES_CONFIRM', '重新開始選舉投票會將所有選票刪除，並解除已投票人的投票封鎖，你確定要重新開始選舉投票嗎？');
define('_MI_VOTEOL_ELCTMANAGE_RESETELCTVOTES_SUCCESS', '重新開始選舉投票成功！');
define('_MI_VOTEOL_ELCTMANAGE_RESETELCTVOTES_FAIL', '重新開始選舉投票失敗！');
define('_MI_VOTEOL_ELCTMANAGE_ELCTPACKAGE_DESC', '「封存本次選舉」會將本次選舉結果封存而無法再加以查驗或修改，請注意！！！');
define('_MI_VOTEOL_ELCTMANAGE_PACKAGE_CONFIRM', '封存選舉會將本次選舉結果封存而無法再加以查驗或修改，你確定要封存該選舉嗎？');
define('_MI_VOTEOL_ELCTMANAGE_PACKAGE_SUCCESS', '封存選舉成功！');
define('_MI_VOTEOL_ELCTMANAGE_PACKAGE_FAIL', '封存選舉失敗！');

// election_tpcdd
define('_MI_VOTEOL_ELCTTPCDD_TPADDSUCCESS', '選舉種類新增成功！');
define('_MI_VOTEOL_ELCTTPCDD_CDDADDSUCCESS', '候選人新增成功！');
define('_MI_VOTEOL_ELCTTPCDD_NOTYPES', '沒有選舉種類，請先新增選舉種類！');
define('_MI_VOTEOL_ELCTTPCDD_CANDIDATENB', '編號');
define('_MI_VOTEOL_ELCTTPCDD_CANDIDATEPHOTOT', '照片');
define('_MI_VOTEOL_ELCTTPCDD_GRADE', '年');
define('_MI_VOTEOL_ELCTTPCDD_CLASS', '班');
define('_MI_VOTEOL_ELCTTPCDD_TEACHER', '老師');
define('_MI_VOTEOL_ELCTTPCDD_GDCLADDSUCCESS', '班級新增成功！');
define('_MI_VOTEOL_ELCTTPCDD_GDCLMODIFYSUCCESS', '班級設定修改成功！');
define('_MI_VOTEOL_ELCTTPCDD_GDCLMODIFYFAIL', '班級設定修改失敗！');
define('_MI_VOTEOL_ELCTTPCDD_TPMODIFYSUCCESS', '選舉種類修改成功！');
define('_MI_VOTEOL_ELCTTPCDD_CDDMODIFYSUCCESS', '候選人修改成功！');
define('_MI_VOTEOL_ELCTTPCDD_BULLETINSUCCESS', '當選公告修改成功！');
define('_MI_VOTEOL_ELCTTPCDD_BULLETINFAIL', '當選公告修改失敗！');


//election_modify
define('_MI_VOTEOL_ELCTMODIFY_MODIFY', '修改選舉設定');
define('_MI_VOTEOL_ELCTMODIFY_HOLD', '舉辦選舉活動');
define('_MI_VOTEOL_ELCTMODIFY_HOLDSUCCESS', '選舉活動建置成功！');
define('_MI_VOTEOL_ELCTMODIFY_MODIFYSUCCESS', '選舉活動設定修改成功！');

//account_setting
define('_MI_VOTEOL_ACTSETTING_NOGDCL', '所指定的班級不存在！');
define('_MI_VOTEOL_ACTSETTING_SETTINGSUCCESS', '選舉人帳號設定成功！');
define('_MI_VOTEOL_ACTSETTING_SETTINGFAIL', '選舉人帳號設定失敗！');
define('_MI_VOTEOL_ACTSETTING_TITLE_CHECK', '檢視投票名冊');
define('_MI_VOTEOL_ACTSETTING_TITLE_SETTING', '設定投票名冊');
define('_MI_VOTEOL_ACTSETTING_SETTING_DESC', '請勾選不能投票的座號');
define('_MI_VOTEOL_ACTSETTING_NB', '號');
define('_MI_VOTEOL_ACTSETTING_ENVOTE', '解除');
define('_MI_VOTEOL_ACTSETTING_UNVOTE', '封鎖');

//account_envote
define('_MI_VOTEOL_ACTENVOTE_NOACCOUNT', '所指定的選舉人帳號不存在！');
define('_MI_VOTEOL_ACTENVOTE_UNVOTESUCCESS', '封鎖選舉人帳號成功！');
define('_MI_VOTEOL_ACTENVOTE_UNVOTEFAIL', '封鎖選舉人帳號失敗！');
define('_MI_VOTEOL_ACTENVOTE_ENVOTESUCCESS', '解除封鎖選舉人帳號成功！');
define('_MI_VOTEOL_ACTENVOTE_ENVOTEFAIL', '解除封鎖選舉人帳號失敗！');

//vote_gdcl
define('_MI_VOTEOL_VTGDCL_NOGDCLACCOUNT', '所指定的班級沒有設定選舉人帳號，請先設定班級選舉人帳號！');
define('_MI_VOTEOL_VTGDCL_TITLE', '選舉名冊');
define('_MI_VOTEOL_VTGDCL_FORM_TITLE', '領取選票');
define('_MI_VOTEOL_VTGDCL_FORM_DESC', '輸入投票者密碼，並選擇投票者的座號');
define('_MI_VOTEOL_VTGDCL_FORM_PASSWD', '密碼');
define('_MI_VOTEOL_VTGDCL_FORM_NB', '座號');

//vote
define('_MI_VOTEOL_VT_TITLE', '選票');
define('_MI_VOTEOL_VT_SUBMIT', '投下選票');
define('_MI_VOTEOL_VT_RESET', '重新圈選');
define('_MI_VOTEOL_VT_SUCCESS', '投票成功！');
define('_MI_VOTEOL_VT_FAIL', '投票失敗！');
?>
