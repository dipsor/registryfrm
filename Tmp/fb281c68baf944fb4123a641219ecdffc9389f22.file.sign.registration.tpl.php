<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-12-04 21:23:20
         compiled from "/var/www/registryfrm/App/View/Sign/sign.registration.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7305249195480c26ba80579-66941203%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb281c68baf944fb4123a641219ecdffc9389f22' => 
    array (
      0 => '/var/www/registryfrm/App/View/Sign/sign.registration.tpl',
      1 => 1417724583,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7305249195480c26ba80579-66941203',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5480c26baa9515_25803624',
  'variables' => 
  array (
    'signupmenu' => 0,
    'p' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5480c26baa9515_25803624')) {function content_5480c26baa9515_25803624($_smarty_tpl) {?><div id='left'>
	<h2>ted jsme v Registration template</h2>
	<h3>Registrace </h3>
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
