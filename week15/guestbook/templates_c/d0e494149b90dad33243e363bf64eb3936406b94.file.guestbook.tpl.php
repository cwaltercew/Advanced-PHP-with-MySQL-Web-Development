<?php /* Smarty version Smarty-3.0.5, created on 2010-12-07 22:42:56
         compiled from "templates/guestbook.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10982886384cff0cd0ec6e69-45072950%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0e494149b90dad33243e363bf64eb3936406b94' => 
    array (
      0 => 'templates/guestbook.tpl',
      1 => 1280518006,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10982886384cff0cd0ec6e69-45072950',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_cycle')) include '../libs/plugins/function.cycle.php';
if (!is_callable('smarty_modifier_escape')) include '../libs/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_date_format')) include '../libs/plugins/modifier.date_format.php';
?>

<table border="0" width="300">
  <tr>
    <th colspan="2" bgcolor="#d1d1d1">
      Guestbook Entries (<a href="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=add">add</a>)</th>
  </tr>
  <?php  $_smarty_tpl->tpl_vars["entry"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('data')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["entry"]->key => $_smarty_tpl->tpl_vars["entry"]->value){
?>
    <tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#dedede,#eeeeee",'advance'=>false),$_smarty_tpl);?>
">
      <td><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['Name']);?>
</td>        
    <td align="right">
      <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('entry')->value['EntryDate'],"%e %b, %Y %H:%M:%S");?>
</td>        
    </tr>
    <tr>
      <td colspan="2" bgcolor="<?php echo smarty_function_cycle(array('values'=>"#dedede,#eeeeee"),$_smarty_tpl);?>
">
        <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('entry')->value['Comment']);?>
</td>
    </tr>
    <?php }} else { ?>
      <tr>
        <td colspan="2">No records</td>
      </tr>
  <?php } ?>
</table>
