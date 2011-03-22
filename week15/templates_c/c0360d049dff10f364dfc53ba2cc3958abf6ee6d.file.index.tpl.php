<?php /* Smarty version Smarty-3.0.5, created on 2010-12-07 13:38:45
         compiled from "./templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3734856984cfe8d45259122-73058375%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0360d049dff10f364dfc53ba2cc3958abf6ee6d' => 
    array (
      0 => './templates/index.tpl',
      1 => 1291750720,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3734856984cfe8d45259122-73058375',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_capitalize')) include '/home/natha/Dropbox/School/AdvPHP/week15/libs/plugins/modifier.capitalize.php';
if (!is_callable('smarty_modifier_escape')) include '/home/natha/Dropbox/School/AdvPHP/week15/libs/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/natha/Dropbox/School/AdvPHP/week15/libs/plugins/modifier.date_format.php';
?><html>
<head>
<title>Info</title>
</head>
<body>

<pre>
User Information:

Name: <?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('name')->value);?>

Addr: <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('address')->value);?>

Date: <?php echo smarty_modifier_date_format(time(),"%b %e, %Y");?>

</pre>

</body>
</html>