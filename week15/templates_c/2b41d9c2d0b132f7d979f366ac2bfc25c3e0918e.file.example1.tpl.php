<?php /* Smarty version Smarty-3.0.5, created on 2010-12-07 14:04:35
         compiled from "./templates/example1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1425261174cfe9353ac9d07-51869248%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b41d9c2d0b132f7d979f366ac2bfc25c3e0918e' => 
    array (
      0 => './templates/example1.tpl',
      1 => 1291752269,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1425261174cfe9353ac9d07-51869248',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
<title>Info</title>
</head>
<body>

<pre>
User Information:

Name: <?php echo $_smarty_tpl->getVariable('name')->value;?>

Address: <?php echo $_smarty_tpl->getVariable('address')->value;?>

</pre>

</body>
</html>