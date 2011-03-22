<?php /* Smarty version Smarty-3.0.5, created on 2010-12-07 14:04:40
         compiled from "./templates/example3.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16622920644cfe9358517742-91427108%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e54fddb43706ac13d2805480f2d23fb7b2a4110e' => 
    array (
      0 => './templates/example3.tpl',
      1 => 1291752155,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16622920644cfe9358517742-91427108',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_capitalize')) include '/home/natha/Dropbox/School/AdvPHP/week15/libs/plugins/modifier.capitalize.php';
if (!is_callable('smarty_modifier_escape')) include '/home/natha/Dropbox/School/AdvPHP/week15/libs/plugins/modifier.escape.php';
?><?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title',"Info"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

User Information:<p>

Name: <?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('name')->value);?>
<br>
Address: <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('address')->value);?>
<br>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>