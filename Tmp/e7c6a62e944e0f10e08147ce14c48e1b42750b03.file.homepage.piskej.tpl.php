<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-11 13:38:04
         compiled from "C:\xampp\htdocs\registryfrm\App\View\Homepage\homepage.piskej.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2732955c9de9c481ea8-38865269%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7c6a62e944e0f10e08147ce14c48e1b42750b03' => 
    array (
      0 => 'C:\\xampp\\htdocs\\registryfrm\\App\\View\\Homepage\\homepage.piskej.tpl',
      1 => 1417910319,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2732955c9de9c481ea8-38865269',
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
  'unifunc' => 'content_55c9de9c4ad1d4_37062298',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c9de9c4ad1d4_37062298')) {function content_55c9de9c4ad1d4_37062298($_smarty_tpl) {?><div id='left'>
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
	vystup metody piskej - <?php echo $_smarty_tpl->tpl_vars['secti']->value;?>


</div><?php }} ?>
