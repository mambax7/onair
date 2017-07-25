<?php

if (!defined('ONAIR_MODULE_PATH')) {
    define('ONAIR_DIRNAME', basename(dirname(__DIR__)));
    define('ONAIR_URL', XOOPS_URL . '/modules/' . ONAIR_DIRNAME);
    define('ONAIR_IMAGE_URL', ONAIR_URL . '/assets/images/');
    define('ONAIR_ROOT_PATH', XOOPS_ROOT_PATH . '/modules/' . ONAIR_DIRNAME);
    define('ONAIR_IMAGE_PATH', ONAIR_ROOT_PATH . '/assets/images');
    define('ONAIR_ADMIN_URL', ONAIR_URL . '/admin/');
    define('ONAIR_UPLOAD_URL', XOOPS_UPLOAD_URL . '/' . ONAIR_DIRNAME);
    define('ONAIR_UPLOAD_PATH', XOOPS_UPLOAD_PATH . '/' . ONAIR_DIRNAME);
}
xoops_loadLanguage('common', ONAIR_DIRNAME);

require_once ONAIR_ROOT_PATH . '/include/functions.php';
//require_once ONAIR_ROOT_PATH . '/include/constants.php';
//require_once ONAIR_ROOT_PATH . '/include/seo_functions.php';
//require_once ONAIR_ROOT_PATH . '/class/metagen.php';
//require_once ONAIR_ROOT_PATH . '/class/session.php';

//require_once ONAIR_ROOT_PATH . '/class/xoalbum.php';
//require_once ONAIR_ROOT_PATH . '/class/request.php';

//$debug = false;
//$xoalbum = XoalbumXoalbum::getInstance($debug);
