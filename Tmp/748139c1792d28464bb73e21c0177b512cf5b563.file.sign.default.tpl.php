<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-11 13:38:08
         compiled from "C:\xampp\htdocs\registryfrm\App\View\Sign\sign.default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3114355c9dea0e1e483-02221652%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '748139c1792d28464bb73e21c0177b512cf5b563' => 
    array (
      0 => 'C:\\xampp\\htdocs\\registryfrm\\App\\View\\Sign\\sign.default.tpl',
      1 => 1417716504,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3114355c9dea0e1e483-02221652',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'signupmenu' => 0,
    'p' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c9dea0e495c4_09180899',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c9dea0e495c4_09180899')) {function content_55c9dea0e495c4_09180899($_smarty_tpl) {?><div id='left'>
	<h2>ted jsme v Sign up template</h2>
	<h3>sign up menu </h3>
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
</div><?php }} ?>
