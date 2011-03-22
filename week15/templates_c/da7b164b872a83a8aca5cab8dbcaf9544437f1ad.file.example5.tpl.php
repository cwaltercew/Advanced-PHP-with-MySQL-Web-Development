<?php /* Smarty version Smarty-3.0.5, created on 2010-12-07 14:11:06
         compiled from "./templates/example5.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18138323114cfe94da06bdb1-18198657%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da7b164b872a83a8aca5cab8dbcaf9544437f1ad' => 
    array (
      0 => './templates/example5.tpl',
      1 => 1291752656,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18138323114cfe94da06bdb1-18198657',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_html_options')) include '/home/natha/Dropbox/School/AdvPHP/week15/libs/plugins/function.html_options.php';
?><select name=user>
<?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->getVariable('id')->value,'output'=>$_smarty_tpl->getVariable('names')->value,'selected'=>"5"),$_smarty_tpl);?>

</select>