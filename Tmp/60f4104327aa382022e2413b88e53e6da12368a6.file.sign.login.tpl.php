<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-12-09 16:19:43
         compiled from "/var/www/registryfrm/App/View/Sign/sign.login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9412911535480a418b789c7-36408413%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '60f4104327aa382022e2413b88e53e6da12368a6' => 
    array (
      0 => '/var/www/registryfrm/App/View/Sign/sign.login.tpl',
      1 => 1418138380,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9412911535480a418b789c7-36408413',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5480a418b7ed18_92720956',
  'variables' => 
  array (
    'signupmenu' => 0,
    'p' => 0,
    'k' => 0,
    'form' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5480a418b7ed18_92720956')) {function content_5480a418b7ed18_92720956($_smarty_tpl) {?><div id='left'>
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
