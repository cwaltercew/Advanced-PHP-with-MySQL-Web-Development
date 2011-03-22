<?php /* Smarty version Smarty-3.0.5, created on 2010-12-07 22:42:59
         compiled from "templates/guestbook_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2757062994cff0cd3509c67-83502177%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6f32f4c1c271d3518966c92b0dc5202c8661c9b' => 
    array (
      0 => 'templates/guestbook_form.tpl',
      1 => 1280520130,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2757062994cff0cd3509c67-83502177',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '../libs/plugins/modifier.escape.php';
?>

<form action="<?php echo $_smarty_tpl->getVariable('SCRIPT_NAME')->value;?>
?action=submit" method="post">
  <table border="1">
    <?php if ($_smarty_tpl->getVariable('error')->value!=''){?>
      <tr>
      <td bgcolor="yellow" colspan="2">
      <?php if ($_smarty_tpl->getVariable('error')->value=="name_empty"){?>You must supply a name.
      <?php }elseif($_smarty_tpl->getVariable('error')->value=="comment_empty"){?> You must supply a comment.
      <?php }?>
      </td>
      </tr>
    <?php }?>
    <tr>
      <td>Name:</td>
      <td>
        <input type="text" name="Name"
          value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('post')->value['Name']);?>
" size="40">
      </td>
    </tr>
    <tr>
      <td valign="top">Comment:</td>
      <td><textarea name="Comment" cols="40" rows="10"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('post')->value['Comment']);?>
</textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" value="Submit">
      </td>
    </tr>
  </table>
</form>
