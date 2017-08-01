<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-12-04 19:08:25
         compiled from "/var/www/registryfrm/App/View/Sign/sign.default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17862139635480a17883ba42-24577483%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '497c00c0bdf962f07dfd27f729367de609eec054' => 
    array (
      0 => '/var/www/registryfrm/App/View/Sign/sign.default.tpl',
      1 => 1417716504,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17862139635480a17883ba42-24577483',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5480a178921a71_15015091',
  'variables' => 
  array (
    'signupmenu' => 0,
    'p' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5480a178921a71_15015091')) {function content_5480a178921a71_15015091($_smarty_tpl) {?><div id='left'>
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
