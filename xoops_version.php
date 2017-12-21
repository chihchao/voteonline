<?
$modversion['name'] = _MI_VOTEOL_NAME;
$modversion['version'] = 1.00;
$modversion['description'] = _MI_VOTEOL_DESC;
$modversion['credits'] = '';
$modversion['author'] = 'atlas';
$modversion['license'] = 'GPL see LICENSE';
$modversion['image'] = 'images/logo.gif';
$modversion['dirname'] = 'voteonline';

//database
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][0] = 'voteonline_account';
$modversion['tables'][1] = 'voteonline_candidate';
$modversion['tables'][2] = 'voteonline_class';
$modversion['tables'][3] = 'voteonline_election';
$modversion['tables'][4] = 'voteonline_vote';
$modversion['tables'][5] = 'voteonline_types';

//css
$modversion['css'] = 'default.css';

//admin
$modversion['hasAdmin'] = 1;

//menu
$modversion['hasMain'] = 1;

//templates
$modversion['templates'][1]['file'] = 'voindex.htm';
$modversion['templates'][1]['description'] = 'voteonline index';
$modversion['templates'][2]['file'] = 'election.htm';
$modversion['templates'][2]['description'] = 'election commission hold election';
$modversion['templates'][3]['file'] = 'election_modify.htm';
$modversion['templates'][3]['description'] = 'modify election';
$modversion['templates'][4]['file'] = 'election_tpcdd.htm';
$modversion['templates'][4]['description'] = 'modify election types';
$modversion['templates'][5]['file'] = 'account_setting.htm';
$modversion['templates'][5]['description'] = 'setting account';
$modversion['templates'][6]['file'] = 'vote_gdcl.htm';
$modversion['templates'][6]['description'] = 'class vote';
$modversion['templates'][7]['file'] = 'vote.htm';
$modversion['templates'][7]['description'] = 'vote';

//config
$modversion['config'][1]['name'] = 'admins';
$modversion['config'][1]['title'] = '_MI_VOTEOL_CF01_TITLE';
$modversion['config'][1]['description'] = '_MI_VOTEOL_CF01_DESC';
$modversion['config'][1]['formtype'] = 'user_multi';
$modversion['config'][1]['valuetype'] = 'array';
$modversion['config'][1]['default'] = '';

$modversion['config'][2]['name'] = 'teachers';
$modversion['config'][2]['title'] = '_MI_VOTEOL_CF02_TITLE';
$modversion['config'][2]['description'] = '_MI_VOTEOL_CF02_DESC';
$modversion['config'][2]['formtype'] = 'group_multi';
$modversion['config'][2]['valuetype'] = 'array';
$modversion['config'][2]['default'] = '';

$modversion['config'][3]['name'] = 'grade';
$modversion['config'][3]['title'] = '_MI_VOTEOL_CF03_TITLE';
$modversion['config'][3]['description'] = '_MI_VOTEOL_CF03_DESC';
$modversion['config'][3]['formtype'] = 'text';
$modversion['config'][3]['valuetype'] = 'text';
$modversion['config'][3]['default'] = '6|5|4|3|2|1';

$modversion['config'][4]['name'] = 'class';
$modversion['config'][4]['title'] = '_MI_VOTEOL_CF04_TITLE';
$modversion['config'][4]['description'] = '_MI_VOTEOL_CF04_DESC';
$modversion['config'][4]['formtype'] = 'text';
$modversion['config'][4]['valuetype'] = 'text';
$modversion['config'][4]['default'] = '01|02|03|04|05|06|07|08|09|10|11';

$modversion['config'][5]['name'] = 'std_numbers';
$modversion['config'][5]['title'] = '_MI_VOTEOL_CF05_TITLE';
$modversion['config'][5]['description'] = '_MI_VOTEOL_CF05_DESC';
$modversion['config'][5]['formtype'] = 'text';
$modversion['config'][5]['valuetype'] = 'text';
$modversion['config'][5]['default'] = '50';

$modversion['config'][6]['name'] = 'uploadpath';
$modversion['config'][6]['title'] = '_MI_VOTEOL_CF06_TITLE';
$modversion['config'][6]['description'] = '_MI_VOTEOL_CF06_DESC';
$modversion['config'][6]['formtype'] = 'text';
$modversion['config'][6]['valuetype'] = 'text';
$modversion['config'][6]['default'] = '/uploads/voteonline';
?>