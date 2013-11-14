<?php /* Smarty version Smarty-3.1-DEV, created on 2013-11-14 19:23:01
         compiled from "/Volumes/HDD/Development/sep007/lmvc-modules/tests/rendering/templates/tmpl-smarty.smarty" */ ?>
<?php /*%%SmartyHeaderCode:7208554405285150581c002-36275216%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92ea98dd46a56eaec8579910705cf34c3b159d9b' => 
    array (
      0 => '/Volumes/HDD/Development/sep007/lmvc-modules/tests/rendering/templates/tmpl-smarty.smarty',
      1 => 1384366601,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7208554405285150581c002-36275216',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'users' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_52851505a34e46_07435012',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52851505a34e46_07435012')) {function content_52851505a34e46_07435012($_smarty_tpl) {?><ul>
   <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
      <li><?php echo $_smarty_tpl->tpl_vars['user']->value;?>
</li>
   <?php } ?>
</ul><?php }} ?>
