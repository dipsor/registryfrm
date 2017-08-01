<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-12-07 00:58:40
         compiled from "/var/www/registryfrm/App/View/Homepage/homepage.piskej.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20154784154804ffe0c8a60-09774533%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97906fc11ad3e162b062f61eee256af00bda6622' => 
    array (
      0 => '/var/www/registryfrm/App/View/Homepage/homepage.piskej.tpl',
      1 => 1417910319,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20154784154804ffe0c8a60-09774533',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54804ffe1ae552_58923173',
  'variables' => 
  array (
    'menu2' => 0,
    'p' => 0,
    'k' => 0,
    'secti' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54804ffe1ae552_58923173')) {function content_54804ffe1ae552_58923173($_smarty_tpl) {?><div id='left'>
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
