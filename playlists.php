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
$GLOBALS['xoopsOption']['template_main'] = 'onair_playlists.tpl';
include XOOPS_ROOT_PATH . '/header.php';
global $xoopsDB, $show, $myts;
$myts = MyTextSanitizer::getInstance();
$show = '';
if (isset($_GET['show']) && 'title' === $_GET['show']) {
    $show     = 'title';
    $pl_title = $myts->addSlashes($pl_title);
}
if (isset($_GET['show']) && 'name' === $_GET['show']) {
    $show    = 'name';
    $pl_name = $myts->addSlashes($pl_name);
}

switch ($show) {
    case 'title':
        onair_PlaylistByTitle($_REQUEST['pl_title']);
        break;
    case 'name':
        onair_PlaylistByName($_GET['pl_name']);
        break;
    default:
        onair_PlaylistAll();
        break;
}
include XOOPS_ROOT_PATH . '/footer.php';
