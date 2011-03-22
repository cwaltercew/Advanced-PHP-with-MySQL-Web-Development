<?php /* Smarty version Smarty-3.0.5, created on 2010-12-07 14:15:10
         compiled from "./templates/example6.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8688513164cfe95ce5c30a7-58708823%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ceabe2ca5b2ff7446e9226eef7230576ba5c61a' => 
    array (
      0 => './templates/example6.tpl',
      1 => 1291752784,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8688513164cfe95ce5c30a7-58708823',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_cycle')) include '/home/natha/Dropbox/School/AdvPHP/week15/libs/plugins/function.cycle.php';
?><table>
<?php  $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('names')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['name']->key => $_smarty_tpl->tpl_vars['name']->value){
?>
<tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#eeeeee,#dddddd"),$_smarty_tpl);?>
"><td><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</td></tr>
<?php }} ?>
</table>

<table>
<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('users')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
<tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#aaaaaa,#bbbbbb"),$_smarty_tpl);?>
"><td><?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['user']->value['phone'];?>
</td></tr>
<?php }} ?>
</table>