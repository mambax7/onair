<?php
/**
 * Onair Module
 *
 * Assigning data to div2 used in block template.
 *
 * LICENSE
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * @copyright     XOOPS Project (https://xoops.org)
 * @license       http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author        Michael Albertsen (culex) <http://www.culex.dk>
 * @since         File available since Release 1.0.4
 */
include __DIR__ . '/../../mainfile.php';
require_once XOOPS_ROOT_PATH . '/class/template.php';
require_once XOOPS_ROOT_PATH . '/modules/onair/blocks/simple_now.php';
$tpl    = new XoopsTpl();
$result = b_Onair_Show();
$tpl->assign('block', $result);
$tpl->display(XOOPS_ROOT_PATH . '/modules/onair/templates/onair_div2.tpl');
