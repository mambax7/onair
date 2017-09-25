<?php
/**
 * Onair Module
 *
 * Use this to show details, picture and schedule of timed events in a block.
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
 * @since         File available since Release 1.0.0
 */
include __DIR__ . '/header.php';
include __DIR__ . '/include/functions.php';
$GLOBALS['xoopsOption']['template_main'] = 'onair_detail.tpl';
include XOOPS_ROOT_PATH . '/header.php';
global $xoopsDB;
if (isset($_GET['ext']) && 'info' === $_GET['ext']) {
    $ext = 'info';
}

switch ($ext) {
    case 'info':
        onair_ShowExtInfo((int)$_GET['oa_id']);
        break;
}
$xoopsTpl->assign('lang_sundayname', _MD_ONAIR_SUNDAYNAME);
$xoopsTpl->assign('lang_mondayname', _MD_ONAIR_MONDAYNAME);
$xoopsTpl->assign('lang_tuedayname', _MD_ONAIR_TUEDAYNAME);
$xoopsTpl->assign('lang_weddayname', _MD_ONAIR_WEDDAYNAME);
$xoopsTpl->assign('lang_thudayname', _MD_ONAIR_THUDAYNAME);
$xoopsTpl->assign('lang_fridayname', _MD_ONAIR_FRIDAYNAME);
$xoopsTpl->assign('lang_satdayname', _MD_ONAIR_SATDAYNAME);

include XOOPS_ROOT_PATH . '/footer.php';
