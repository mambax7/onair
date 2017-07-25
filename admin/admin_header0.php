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

include __DIR__ . '/../../../mainfile.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsmodule.php';
include XOOPS_ROOT_PATH . '/include/cp_functions.php';
if ($xoopsUser) {
    $xoopsModule = XoopsModule::getByDirname('onair');

    if (!$xoopsUser->isAdmin($xoopsModule->mid())) {
        redirect_header(XOOPS_URL . '/', 2, _NOPERM);
    }
} else {
    redirect_header(XOOPS_URL . '/', 2, _NOPERM);
}

if (file_exists('../language/' . $xoopsConfig['language'] . '/admin.php')) {
    include __DIR__ . '/../language/' . $xoopsConfig['language'] . '/admin.php';
} else {
    include __DIR__ . '/../language/english/admin.php';
}
