<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-12-06 20:32:55
         compiled from "/var/www/registryfrm/App/View/Homepage/homepage.default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139226495554805006d95ee7-63514188%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43449cb35ee7e8c385730b86f021e527cc494c08' => 
    array (
      0 => '/var/www/registryfrm/App/View/Homepage/homepage.default.tpl',
      1 => 1417894374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139226495554805006d95ee7-63514188',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54805006e5dfb3_29940092',
  'variables' => 
  array (
    'menu2' => 0,
    'p' => 0,
    'k' => 0,
    'secti' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54805006e5dfb3_29940092')) {function content_54805006e5dfb3_29940092($_smarty_tpl) {?><div id='left'>
	<h2>ted jsme v homepage template</h2>
	<h3>menu 2</h3>
	<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['menu2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['p']->key;
?>
		<a href='http://localhost/registryfrm/www/<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
' ><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</a></br>
	<?php } ?>
	<br>
	<h3> Form na secteni </h3>
	<form action="http://localhost/registryfrm/www/homepage/secti" method="post">
	promenna A: <input type="text" name="a"><br>
	promenna B: <input type="text" name="b"><br>
	<input type="submit">
	</form>

	<?php if (isset($_smarty_tpl->tpl_vars['secti']->value)) {?>
		vysledek: 
		<?php echo $_smarty_tpl->tpl_vars['secti']->value;?>
 .
	<?php }?>

</div><?php }} ?>
