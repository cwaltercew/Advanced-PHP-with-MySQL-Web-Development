<?php /* Smarty version Smarty-3.0.5, created on 2010-12-07 14:03:48
         compiled from "./templates/example2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5051530624cfe9324c75af4-69331765%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e53a1aa33cf74af7bbd95c8c8b18879d47c778ab' => 
    array (
      0 => './templates/example2.tpl',
      1 => 1291752061,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5051530624cfe9324c75af4-69331765',
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