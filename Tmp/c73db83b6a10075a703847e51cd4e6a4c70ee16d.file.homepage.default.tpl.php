<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-11 13:37:52
         compiled from "C:\xampp\htdocs\registryfrm\App\View\Homepage\homepage.default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2858455c9de90696111-56248532%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c73db83b6a10075a703847e51cd4e6a4c70ee16d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\registryfrm\\App\\View\\Homepage\\homepage.default.tpl',
      1 => 1417894374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2858455c9de90696111-56248532',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menu2' => 0,
    'p' => 0,
    'k' => 0,
    'secti' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c9de906e6c93_64520114',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c9de906e6c93_64520114')) {function content_55c9de906e6c93_64520114($_smarty_tpl) {?><div id='left'>
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
