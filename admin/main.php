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

require_once __DIR__ . '/admin_header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopslists.php';
include XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
include XOOPS_ROOT_PATH . '/include/xoopscodes.php';
require_once __DIR__ . '/../include/functions.php';
include __DIR__ . '/../include/classes.php';

$oa_timetype = onair_GetModuleOption('timetype');

if (isset($_GET['op']) && 'Eventshow' == $_GET['op']) {
    $op = 'Eventshow';
}
if (isset($_GET['op']) && 'Eventedit' == $_GET['op']) {
    $op = 'Eventedit';
}
if (isset($_GET['op']) && 'Eventdel' === $_GET['op']) {
    $op = 'Eventdel';
}
if (isset($_GET['op']) && 'Eventapprove' === $_GET['op']) {
    $op = 'Eventapprove';
}
if (isset($_POST['op']) && 'Eventsave' === $_POST['op']) {
    $op = 'Eventsave';
}
if (isset($_GET['op']) && 'Addnew' === $_GET['op']) {
    $op = 'Addnew';
}
if (isset($_GET['op']) && 'ImageUpload' === $_GET['op']) {
    $op = 'ImageUpload';
}
if (isset($_GET['op']) && 'PlayList' === $_GET['op']) {
    $op = 'PlayList';
}
/**
 * Choose from menu
 *
 * @internal param \Place $In admin choose your action from menu
 * @internal param int $repeat 1
 *
 * @return Status
 */
function Choice()
{
    global $xoopsModule;
    xoops_cp_header();
    echo '<table class="outer" width="100%"><tr>';
    echo "<td class='even'><div class='center;'><a href='main.php?op=Addnew'>" . _AM_ONAIR_ADDNEW . '</a></div></td>';
    echo "<td class='even'><div class='center;'><a href='main.php?op=Eventshow'>" . _AM_ONAIR_EDIT . '</a></div></td>';
    echo "<td class='even'><div class='center;'><a href='playlist.php?op=Playlistshow'>" . _AM_ONAIR_SHOWPLAYLISTS . '</a></div></td>';
    echo "<td class='even'><div class='center;'><a href='../help.php'" . _AM_ONAIR_HELP . '</a></div></td>';
    echo "<td class='even'><div class='center;'><a href='songs.php" . _AM_ONAIR_SONGSADMIN . '</a></div></td>';
    echo "<td class='even'><div class='center;'><a href='../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=" . $xoopsModule->getVar('mid') . "'>" . _AM_ONAIR_CONFIG . '</a></div></td>';
    echo '</tr></table>';
    xoops_cp_footer();
}

/**
 * Delete events
 *
 * @param int $del
 *
 * @internal param \Place $In admin Delete from database
 * @internal param int $repeat 1
 *
 * @return Status
 */
function onair_EventDel($del = 0)
{
    global $xoopsDB;
    if (isset($_POST['del']) && 1 == $_POST['del']) {
        $result = $xoopsDB->query('DELETE FROM ' . $xoopsDB->prefix('oa_program') . ' WHERE oa_id = ' . (int)$_POST['oa_id'] . '');
        redirect_header('main.php', 2, _AM_ONAIR_EVENTDEL);
    } else {
        xoops_cp_header();
        xoops_confirm(['oa_id' => $_GET['oa_id'], 'del' => 1], 'main.php?op=Eventdel', _AM_ONAIR_SUREDELETE);
        xoops_cp_footer();
    }
}

/**
 * Save event from edit
 *
 * @internal param \Place $In admin saves the edited event
 * @internal param int $repeat 1
 *
 * @return Status
 */
function onair_EventSave()
{
    global $xoopsDB, $oa_timetype, $numbers2days;
    if ('1' == onair_GetModuleOption('timetype')) {
        $_POST['oa_start'] = date('h:i:s a', $_POST['oa_start']);
        $_POST['oa_stop']  = date('h:i:s a', $_POST['oa_stop']);
        if ($_POST['oa_stop'] < $_POST['oa_start']) {
            $_POST['oa_stop'] = '11:59:59 pm';
        }
    } else {
        if ('0' == onair_GetModuleOption('timetype')) {
            $_POST['oa_start'] = date('H:i:s', $_POST['oa_start']);
            $_POST['oa_stop']  = date('H:i:s', $_POST['oa_stop']);
            if ($_POST['oa_stop'] < $_POST['oa_start']) {
                $_POST['oa_stop'] = '23:59:59';
            }
        }
    }

    $xoopsDB->query('UPDATE '
                    . $xoopsDB->prefix('oa_program')
                    . ' SET oa_day = '
                    . $xoopsDB->quoteString($_POST['oa_day'])
                    . ', oa_station = '
                    . $xoopsDB->quoteString($_POST['oa_station'])
                    . ', oa_title = '
                    . $xoopsDB->quoteString($_POST['oa_title'])
                    . ', oa_name = '
                    . $xoopsDB->quoteString($_POST['oa_name'])
                    . ', oa_start = '
                    . $xoopsDB->quoteString($_POST['oa_start'])
                    . ', oa_stop = '
                    . $xoopsDB->quoteString($_POST['oa_stop'])
                    . ', oa_image = '
                    . $xoopsDB->quoteString($_POST['oa_image'])
                    . ', oa_description = '
                    . $xoopsDB->quoteString($_POST['oa_description'])
                    . ', oa_plugin = '
                    . $xoopsDB->quoteString($_POST['oa_plugin'])
                    . ', oa_stream = '
                    . $xoopsDB->quoteString($_POST['oa_stream'])
                    . ' WHERE oa_id = '
                    . $_POST['oa_id']
                    . '');
    redirect_header('main.php?op=Eventshow', 2, _AM_ONAIR_EVENTMOD);
}

/**
 * Edit event
 *
 * @param $oa_id
 * @internal param \Place $In admin edit choosen event
 * @internal param int $repeat 1
 *
 * @return Status
 */
function onair_EventEdit($oa_id)
{
    global $xoopsModule, $xoopsDB, $oa_timetype, $numbers2days;
    $myts  = MyTextSanitizer::getInstance();
    $oa_id = $_GET['oa_id'];
    xoops_cp_header();
    $oa_start = '';
    $oa_stop  = '';
    $result   = $xoopsDB->query('SELECT oa_day, oa_station, oa_title, oa_name, oa_start, oa_stop, oa_image, oa_description, oa_plugin, oa_stream FROM ' . $xoopsDB->prefix('oa_program') . ' WHERE oa_id=' . (int)$oa_id . '');
    list($oa_day, $oa_station, $oa_title, $oa_name, $oa_start, $oa_stop, $oa_image, $oa_description, $oa_plugin, $oa_stream) = $xoopsDB->fetchRow($result);

    // Form for day names
    $edform    = new XoopsThemeForm(_AM_ONAIR_EDITENTRY, 'onair', 'main.php');
    $edformday = new XoopsFormSelect(_AM_ONAIR_DAY, 'oa_day', $oa_day, 1, false);
    $edformday->addOption('0', _AM_ONAIR_SUNDAYNAME);
    $edformday->addOption('1', _AM_ONAIR_MONDAYNAME);
    $edformday->addOption('2', _AM_ONAIR_TUEDAYNAME);
    $edformday->addOption('3', _AM_ONAIR_WEDDAYNAME);
    $edformday->addOption('4', _AM_ONAIR_THUDAYNAME);
    $edformday->addOption('5', _AM_ONAIR_FRIDAYNAME);
    $edformday->addOption('6', _AM_ONAIR_SATDAYNAME);
    $edform->addElement($edformday);

    // Form for Station
    $edformstation = new XoopsFormText(_AM_ONAIR_STATION, 'oa_station', 75, 75, $myts->htmlSpecialChars($myts->stripSlashesGPC($oa_station)));
    $edform->addElement($edformstation);

    // Form for Title
    $edformtitle = new XoopsFormText(_AM_ONAIR_TITLE, 'oa_title', 75, 75, $myts->htmlSpecialChars($myts->stripSlashesGPC($oa_title)));
    $edform->addElement($edformtitle);

    // Form for name
    $edformname = new XoopsFormText(_AM_ONAIR_NAME, 'oa_name', 75, 75, $myts->htmlSpecialChars($myts->stripSlashesGPC($oa_name)));
    $edform->addElement($edformname);

    // determine 12 hour Or 24 hour format time

    if ('0' == onair_GetModuleOption('timetype')) {

        // Uses class to set 24 hour format
        $edformstart = new onair_XoopsFormTimeEuro(_AM_ONAIR_START, 'oa_start', 20);
        $edform->addElement($edformstart);
        $edformstop = new onair_XoopsFormTimeEuro(_AM_ONAIR_STOP, 'oa_stop', 15);
        $oa_start   = date('H:i:s', strtotime($oa_start));
        $oa_stop    = date('H:i:s', strtotime($oa_stop));
        $edform->addElement($edformstop);
    } // Uses class to set 12 hour format
    else {
        if ('1' == onair_GetModuleOption('timetype')) {
            $edformstart = new onair_XoopsFormTimeUs(_AM_ONAIR_START, 'oa_start', 20);
            $edform->addElement($edformstart);
            $edformstop = new onair_XoopsFormTimeUs(_AM_ONAIR_STOP, 'oa_stop', 15);
            $edform->addElement($edformstop);
            $oa_start = date('h:i:s a', strtotime($oa_start));
            $oa_stop  = date('h:i:s a', strtotime($oa_stop));
        }
    }
    // Check to see if end time is bigger than start time

    // Form to choose image

    $imgdir = '/modules/' . $xoopsModule->dirname() . '/assets/images';

    if ('0' == $oa_image) {
        $oa_image = 'blank.gif';
    }
    $graph_array = &onair_OaLists::getImgListAsArray(XOOPS_ROOT_PATH . $imgdir . '/');
    array_unshift($graph_array, _NONE);
    $indeximage_select = new XoopsFormSelect('', 'oa_image', 'oa_image');
    $indeximage_select->addOptionArray($graph_array);
    $indeximage_select->setExtra("onchange=\"showImgSelected('img', 'oa_image', '/" . $imgdir . "/', '', '" . XOOPS_URL . "')\"");
    $indeximage_tray = new XoopsFormElementTray(_AM_SELECT_IMAGE, '&nbsp;');
    $indeximage_tray->addElement($indeximage_select);
    $indeximage_tray->addElement(new XoopsFormLabel('', "<br><img src='" . XOOPS_URL . $imgdir . '/' . $oa_image . " 'name='img' id='img' alt=''>"));
    $edform->addElement($indeximage_tray);

    // Form for Description
    $edformdescription = new XoopsFormDhtmlTextArea(_AM_ONAIR_DESCRIPTION, 'oa_description', $myts->htmlSpecialChars($myts->stripSlashesGPC($oa_description)), 10, 50);
    $edform->addElement($edformdescription);

    //Select Plugin
    $edformplugin = new XoopsFormSelect(_AM_ONAIR_PLUGINSELECT, 'oa_plugin', $value = '0', 1, false);
    $edformplugin->addOption('0', _AM_ONAIR_PLUGINNONE);
    $edformplugin->addOption('1', _AM_ONAIR_PLUGINDIRETTORE);
    $edformplugin->addOption('2', _AM_ONAIR_PLUGINSP);
    $edformplugin->addOption('3', _AM_ONAIR_PLUGINWINAMP);
    $edform->addElement($edformplugin);

    $edformstream = new XoopsFormText(_AM_ONAIR_STREAM, 'oa_stream', 75, 75, $oa_stream);
    $edform->addElement($edformstream);

    // Hidden forms and id
    $op_hidden = new XoopsFormHidden('op', 'Eventsave');
    $edform->addElement($op_hidden);
    $id_event_hidden = new XoopsFormHidden('oa_id', $_GET['oa_id']);
    $edform->addElement($id_event_hidden);
    $submit_button = new XoopsFormButton('', 'Submit', _AM_ONAIR_SUBMIT, 'submit');
    $edform->addElement($submit_button);
    $edform->display();

    xoops_cp_footer();
}

/**
 * Show events in database
 *
 * @internal param \Place $In admin Show events sorted by day, start time
 * @internal param int $repeat 1
 *
 * @return Status
 */
function onair_EventShow()
{
    global $xoopsDB, $myts, $oa_days, $xoopsModuleConfig, $oa_timetype;
    $currentFile = basename(__FILE__);
    $myts        = MyTextSanitizer::getInstance();
    xoops_cp_header();

    //$adminObject = \Xmf\Module\Admin::getInstance();
    $adminObject->addItemButton(_MI_ONAIR_ADDNEW, "{$currentFile}?op=Addnew", 'add');
    $adminObject->displayButton('left');

    echo "<table border='0' width='100%' class='outer' align='center'>
        <tr><td class='even'><b>"
         . _AM_ONAIR_DAY
         . "</b></td><td class='even'><b>"
         . _AM_ONAIR_TITLE
         . "</b></td><td class='even'><b>"
         . _AM_ONAIR_START
         . "</b></td><td class='even'><b>"
         . _AM_ONAIR_STOP
         . "</b></td><td colspan='2' class='even'><div class='center;'><b>"
         . _AM_ONAIR_ACTION
         . "</div></b></td><td colspan='2' class='even'><center><b>"
         . _AM_ONAIR_MAKEPLAYLIST
         . '</center></b></td></tr>';

    $result = $xoopsDB->query('SELECT oa_id, oa_day, oa_title, oa_start, oa_stop ,' . ' oa_image, oa_description FROM ' . $xoopsDB->prefix('oa_program') . ' ORDER BY oa_day,oa_start');

    while ($myrow = $xoopsDB->fetchArray($result)) {
        $oa_id    = $myrow['oa_id'];
        $oa_day   = $myrow['oa_day'];
        $oa_title = $myts->htmlSpecialChars($myts->stripSlashesGPC($myrow['oa_title']));
        if (0 == $oa_timetype) {
            $oa_start = date('H:i:s', strtotime($myrow['oa_start']));
            $oa_stop  = date('H:i:s', strtotime($myrow['oa_stop']));
        }
        if (1 == $oa_timetype) {
            $oa_start = date('h:i:s a', strtotime($myrow['oa_start']));
            $oa_stop  = date('h:i:s a', strtotime($myrow['oa_stop']));
        }

        $oa_image       = $myrow['oa_image'];
        $oa_description = $myts->htmlSpecialChars($myts->stripSlashesGPC($myrow['oa_description']));

        echo "</td>
        <td class='odd'>$oa_days[$oa_day]&nbsp;</td>
        <td class='odd'>$oa_title&nbsp;</td>
        <td class='odd'>$oa_start&nbsp;</td>
        <td class='odd'>$oa_stop&nbsp;</td>
        <td class='odd'><a href='main.php?op=Eventedit&amp;oa_id=$oa_id'>" . _AM_ONAIR_EDIT . "</a></td>
        <td class='odd'><a href='main.php?op=Eventdel&amp;oa_id=$oa_id'>" . _AM_ONAIR_DEL . "</a></td>
        <td class='odd'><a href='playlist.php?op=Playlist&amp;oa_id=$oa_id'>" . _AM_ONAIR_PL . '</a></td>
        </tr>';
    }
    echo '</table><br>';
    xoops_cp_footer();
}

/**
 * Add new event
 *
 * @internal param \Place $In admin create new event and send to post.php
 * @internal param int $repeat 1
 *
 * @return Status
 */
function onair_AddNew()
{
    global $xoopsModule, $xoopsDB, $myts, $numbers2days, $oa_eu_start, $oa_eu_stop, $oa_us_start, $oa_us_start;
    $currentFile = basename(__FILE__);

    if (isset($_POST['oa_day'])) {
        $oa_day = $myts->htmlSpecialChars($myts->stripSlashesGPC($_POST['oa_day']));
    } else {
        $oa_day = '';
    }
    if (isset($_POST['oa_station'])) {
        $oa_station = $myts->htmlSpecialChars($myts->stripSlashesGPC($_POST['oa_station']));
    } else {
        $oa_station = '';
    }
    if (isset($_POST['oa_name'])) {
        $oa_name = $myts->htmlSpecialChars($myts->stripSlashesGPC($_POST['oa_name']));
    } else {
        $oa_name = '';
    }
    if (isset($_POST['oa_title'])) {
        $oa_title = $myts->htmlSpecialChars($myts->stripSlashesGPC($_POST['oa_title']));
    } else {
        $oa_title = '';
    }
    if (isset($_POST['oa_start'])) {
        $oa_start = $myts->htmlSpecialChars($myts->stripSlashesGPC($_POST['oa_start']));
    } else {
        $oa_start = '';
    }
    if (isset($_POST['oa_stop'])) {
        $oa_stop = $myts->htmlSpecialChars($myts->stripSlashesGPC($_POST['oa_stop']));
    } else {
        $oa_stop = '';
    }
    if (isset($_POST['oa_image'])) {
        $oa_image = $myts->htmlSpecialChars($myts->stripSlashesGPC($_POST['oa_image']));
    } else {
        $oa_image = 'blank.gif';
    }
    if (isset($_POST['oa_description'])) {
        $oa_description = $myts->htmlSpecialChars($myts->stripSlashesGPC($_POST['oa_description']));
    } else {
        $oa_description = _AM_ONAIR_NODESCRIPTION;
    }

    $myts = MyTextSanitizer::getInstance();

    //assign variable of xoopsuser to form
    xoops_cp_header();
    //$adminObject = \Xmf\Module\Admin::getInstance();
    $adminObject->addItemButton(_MI_ONAIR_PROGRAM_EDIT, "{$currentFile}?op=Eventshow", 'list');
    $adminObject->displayButton('left');

    $signform = new XoopsThemeForm(_AM_ONAIR_ENTRY, 'Onair', 'post.php');

    // Select days
    $signformday = new XoopsFormSelect(_AM_ONAIR_DAY, 'oa_day', 0, 1, false);
    $signformday->addOption('0', _AM_ONAIR_SUNDAYNAME);
    $signformday->addOption('1', _AM_ONAIR_MONDAYNAME);
    $signformday->addOption('2', _AM_ONAIR_TUEDAYNAME);
    $signformday->addOption('3', _AM_ONAIR_WEDDAYNAME);
    $signformday->addOption('4', _AM_ONAIR_THUDAYNAME);
    $signformday->addOption('5', _AM_ONAIR_FRIDAYNAME);
    $signformday->addOption('6', _AM_ONAIR_SATDAYNAME);
    $signform->addElement($signformday);

    // Select Station name
    $signformstation = new XoopsFormText(_AM_ONAIR_STATION, 'oa_station', 75, 75, $oa_station);
    $signform->addElement($signformstation);

    // Select Person name
    $signformuname = new XoopsFormText(_AM_ONAIR_NAME, 'oa_name', 75, 75, $oa_name);
    $signform->addElement($signformuname);

    // Select Show title
    $signformutitle = new XoopsFormText(_AM_ONAIR_TITLE, 'oa_title', 75, 75, $oa_title);
    $signform->addElement($signformutitle);

    // determine 12 hour Or 24 hour format time

    // Uses class to set 12 hour format
    if ('1' == onair_GetModuleOption('timetype')) {
        $signformstarteu = new onair_XoopsFormTimeUs(_AM_ONAIR_START, 'oa_start', 20);
        $signform->addElement($signformstarteu);
        $signformstopeu = new onair_XoopsFormTimeUs(_AM_ONAIR_STOP, 'oa_stop', 15);
        $signform->addElement($signformstopeu);
        $oa_start = date('h:i:s a', strtotime($oa_start));
        $oa_stop  = date('h:i:s a', strtotime($oa_stop));
    } else {
        if ('0' == onair_GetModuleOption('timetype')) {

            // Uses class to set 24 hour format

            $signformstart = new onair_XoopsFormTimeEuro(_AM_ONAIR_START, 'oa_start', 20);
            $signform->addElement($signformstart);
            $signformstop = new onair_XoopsFormTimeEuro(_AM_ONAIR_STOP, 'oa_stop', 15);
            $signform->addElement($signformstop);
            $oa_start = date('H:i:s', strtotime($oa_start));
            $oa_stop  = date('H:i:s', strtotime($oa_stop));
        }
    }

    // Make description for the show
    $signformdescription = new XoopsFormDhtmlTextArea(_AM_ONAIR_DESCRIPTION, 'oa_description', $oa_description, 10, 50);
    $signform->addElement($signformdescription);

    // Is smilies allowed ?
    global $xoopsModuleConfig, $oa_images;
    if (1 == $xoopsModuleConfig['smiliesallow']) {
        ob_start();
        echo xoopsSmilies('oa_description');
        $signform->addElement(new XoopsFormLabel('', ob_get_contents()));
        ob_end_clean();
    }

    // Choose image
    $imgdir = '/modules/' . $xoopsModule->dirname() . '/assets/images';

    if ('0' == $oa_images) {
        $oa_images = 'blank.gif';
    }
    $graph_array = &onair_OaLists::getImgListAsArray(XOOPS_ROOT_PATH . $imgdir . '/');
    array_unshift($graph_array, _NONE);
    $indeximage_select = new XoopsFormSelect('', 'oa_image', 'oa_image');
    $indeximage_select->addOptionArray($graph_array);
    $indeximage_select->setExtra("onchange=\"showImgSelected('img', 'oa_image', '/" . $imgdir . "/', '', '" . XOOPS_URL . "')\"");
    $indeximage_tray = new XoopsFormElementTray(_AM_SELECT_IMAGE, '&nbsp;');
    $indeximage_tray->addElement($indeximage_select);
    $indeximage_tray->addElement(new XoopsFormLabel('', "<br><img src='" . XOOPS_URL . $imgdir . '/' . $oa_images . " 'name='img' id='img' alt=''>"));
    $signform->addElement($indeximage_tray);

    //Select Plugin
    $signformplugin = new XoopsFormSelect(_AM_ONAIR_PLUGINSELECT, 'oa_plugin', 0, 1, false);
    $signformplugin->addOption('0', _AM_ONAIR_PLUGINNONE);
    $signformplugin->addOption('1', _AM_ONAIR_PLUGINDIRETTORE);
    $signformplugin->addOption('2', _AM_ONAIR_PLUGINSP);
    $signformplugin->addOption('3', _AM_ONAIR_PLUGINWINAMP);
    $signform->addElement($signformplugin);

    $signformstream = new XoopsFormText(_AM_ONAIR_STREAM, 'oa_stream', 75, 75, $oa_stream);
    $signform->addElement($signformstream);

    //$signform->addElement(new XoopsFormHidden("oa_id", $oa_id));
    $submit_button = new XoopsFormButton('', 'submitbutton', _AM_ONAIR_SUBMIT, 'submit');
    $signform->addElement($submit_button);
    $signform->display();
    xoops_cp_footer();
}

// Switch for choises
global $op;

$oa_id = isset($oa_id) ? (int)$oa_id : '';
switch ($op) {
    case 'Eventsave':
        onair_EventSave();
        break;
    case 'Eventedit':
        onair_EventEdit($_GET['oa_id']);
        break;
    case 'Eventapprove':
        onair_EventApprove();
        break;
    case 'Eventdel':
        onair_EventDel();
        break;
    case 'Eventshow':
        onair_EventShow();
        break;
    case 'Addnew':
        onair_AddNew();
        break;
    case 'ImageUpload':
        redirect_header('uploader.php', 5, _AM_ONAIR_GOING2UPLOADFORM);
        break;
    case 'PlayList':
        redirect_header('playlist.php', 5, _AM_ONAIR_GOING2PLAYLISTFORM);
        break;
    default:
        Choice();
        break;
}
