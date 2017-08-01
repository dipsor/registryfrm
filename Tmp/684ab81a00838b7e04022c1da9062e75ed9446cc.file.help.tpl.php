<?php /* Smarty version Smarty-3.1.19, created on 2014-08-16 20:15:42
         compiled from "/var/www/registryfrm/App/View/help.tpl" */ ?>
<?php /*%%SmartyHeaderCode:127651564753ed3e2fa9b224-66836147%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '684ab81a00838b7e04022c1da9062e75ed9446cc' => 
    array (
      0 => '/var/www/registryfrm/App/View/help.tpl',
      1 => 1408212063,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '127651564753ed3e2fa9b224-66836147',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_53ed3e2fabf533_31080185',
  'variables' => 
  array (
    'menu' => 0,
    'p' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ed3e2fabf533_31080185')) {function content_53ed3e2fabf533_31080185($_smarty_tpl) {?><h1>ted jsme v help template</h1>

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
