<?php /* Smarty version Smarty-3.1.19, created on 2014-08-14 23:55:20
         compiled from "/var/www/registryfrm/App/View/homepage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104654329153ed3b6909ecf0-78879883%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cd3e2b9a3f52435000df4db41692346fa758cd2c' => 
    array (
      0 => '/var/www/registryfrm/App/View/homepage.tpl',
      1 => 1408056919,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104654329153ed3b6909ecf0-78879883',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_53ed3b6910fd44_18831008',
  'variables' => 
  array (
    'menu' => 0,
    'p' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ed3b6910fd44_18831008')) {function content_53ed3b6910fd44_18831008($_smarty_tpl) {?><h1>ted jsme v homepage template</h1>

<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['p']->key;
?>
	<a href='http://localhost/registryfrm/www/<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
' ><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</a></br>
<?php } ?><?php }} ?>
