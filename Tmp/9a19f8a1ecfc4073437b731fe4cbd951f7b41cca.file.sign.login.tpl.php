<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-11 20:10:09
         compiled from "C:\xampp\htdocs\registryfrm\App\View\Sign\sign.login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3142055ca3a81b514a2-34643572%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9a19f8a1ecfc4073437b731fe4cbd951f7b41cca' => 
    array (
      0 => 'C:\\xampp\\htdocs\\registryfrm\\App\\View\\Sign\\sign.login.tpl',
      1 => 1418138380,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3142055ca3a81b514a2-34643572',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'signupmenu' => 0,
    'p' => 0,
    'k' => 0,
    'form' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55ca3a81b85312_46486576',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55ca3a81b85312_46486576')) {function content_55ca3a81b85312_46486576($_smarty_tpl) {?><div id='left'>
	<h2>ted jsme v Log Im template</h2>
	<h3>Log In</h3>
	<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['signupmenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['p']->key;
?>
		<a href='http://localhost/registryfrm/www/sign/<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
' ><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</a></br>
	<?php } ?>
	<br>

	<?php if (isset($_smarty_tpl->tpl_vars['form']->value)) {?>
		<?php echo $_smarty_tpl->tpl_vars['form']->value;?>

	<?php }?>
</div><?php }} ?>
