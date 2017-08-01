<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-12-04 13:25:12
         compiled from "/var/www/registryfrm/App/View/Help/help.shit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53247494954805149338335-41385094%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e4e026d0063365809b38fc1730ad295bb82411d8' => 
    array (
      0 => '/var/www/registryfrm/App/View/Help/help.shit.tpl',
      1 => 1417695731,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53247494954805149338335-41385094',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54805149369b29_92533053',
  'variables' => 
  array (
    'menu2' => 0,
    'p' => 0,
    'k' => 0,
    'arg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54805149369b29_92533053')) {function content_54805149369b29_92533053($_smarty_tpl) {?><div id='left'>
	<h2>ted jsme v help template</h2>
	
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
	vystup metody <strong>shit</strong> - <?php echo $_smarty_tpl->tpl_vars['arg']->value;?>
	

</div><?php }} ?>
