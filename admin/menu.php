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
 * @since         File available since Release 1.0.5
 */

// Items in the left-side menu for amin

$moduleDirName = basename(dirname(__DIR__));

if (false !== ($moduleHelper = Xmf\Module\Helper::getHelper($moduleDirName))) {
} else {
    $moduleHelper = Xmf\Module\Helper::getHelper('system');
}


$pathIcon32 = \Xmf\Module\Admin::menuIconPath('');
//$pathModIcon32 = $moduleHelper->getModule()->getInfo('modicons32');

$moduleHelper->loadLanguage('modinfo');

$adminmenu              = [];
$i                      = 0;
$adminmenu[$i]['title'] = _AM_MODULEADMIN_HOME;
$adminmenu[$i]['link']  = 'admin/index.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/home.png';
//++$i;
//$adminmenu[$i]['title'] = _MI_OLEDRION_ADMENU10;
//$adminmenu[$i]['link'] = "admin/main.php";
//$adminmenu[$i]["icon"]  = $pathIcon32 . '/manage.png';
++$i;
$adminmenu[$i]['title'] = _MI_ONAIR_PROGRAM_EDIT;
$adminmenu[$i]['link']  = 'admin/main.php?op=Eventshow';
$adminmenu[$i]['icon']  = $pathIcon32 . '/event.png';
++$i;
$adminmenu[$i]['title'] = _MI_ONAIR_ADDNEW;
$adminmenu[$i]['link']  = 'admin/main.php?op=Addnew';
$adminmenu[$i]['icon']  = $pathIcon32 . '/add.png';
++$i;
$adminmenu[$i]['title'] = _MI_ONAIR_ADDIMAGE;
$adminmenu[$i]['link']  = 'admin/main.php?op=ImageUpload';
$adminmenu[$i]['icon']  = $pathIcon32 . '/upload.png';
++$i;
$adminmenu[$i]['title'] = _MI_ONAIR_PLAYLISTMENU;
$adminmenu[$i]['link']  = 'admin/playlist.php?op=Playlistshow';
$adminmenu[$i]['icon']  = $pathIcon32 . '/view_detailed.png';
++$i;
$adminmenu[$i]['title'] = _MI_ONAIR_SONGS;
$adminmenu[$i]['link']  = 'admin/songs.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/playlist.png';
//++$i;
//$adminmenu[$i]['title'] = _MI_ONAIR_HELP;
//$adminmenu[$i]['link'] = "admin/help.php";
//$adminmenu[$i]["icon"]  = $pathIcon32 . '/manage.png';
++$i;
$adminmenu[$i]['title'] = _AM_MODULEADMIN_ABOUT;
$adminmenu[$i]['link']  = 'admin/about.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/about.png';
