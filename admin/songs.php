<?php
/**
 * Onair Module
 *
 * Use this to edit, save and update songs in the song database
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
onair_clean_illegalSongData();
$song_timetype = onair_GetModuleOption('timetype');

if (isset($_GET['op']) && 'Songlistshow' === $_GET['op']) {
    $op = 'Songlistshow';
}
if (isset($_GET['op']) && 'SongEdit' === $_GET['op']) {
    $op = 'SongEdit';
}
if (isset($_GET['op']) && 'Songsave' === $_GET['op']) {
    $op = 'Songsave';
}
if (isset($_GET['op']) && 'Songdel' === $_GET['op']) {
    $op = 'Songdel';
}
/**
 * Choose from playlist menu
 *
 * @internal param \Place $In admin choose your action from menu
 * @internal param int $repeat 1
 *
 * @return Status
 */
function onair_SongChoice()
{
    global $xoopsModule;
    xoops_cp_header();
    echo '<table class="outer" width="100%"><tr><td class="even">';
    echo "<a href='songs.php?op=Songlistshow'>" . _AM_ONAIR_SONGSHOWALL . '</a><br>';
    echo "<a href='hitlist.php'>" . _AM_ONAIR_UPLOADSONGS . '</a><br>';
    echo "<a href='index.php?op=choice'>" . _AM_ONAIR_BACK2INDEX . '</a><br>';
    echo '</td></tr></table>';
    xoops_cp_footer();
}

/**
 * Delete playlist
 *
 * @param int $del
 *
 * @internal param \Place $In admin delete playlist from database
 * @internal param int $repeat 1
 *
 * @return Status
 */
function onair_SongDel($del = 0)
{
    global $xoopsDB;
    if (isset($_POST['del']) && 1 == $_POST['del']) {
        $result = $xoopsDB->query('DELETE FROM ' . $xoopsDB->prefix('oa_hitlist') . ' WHERE oa_songid = ' . (int)$_POST['oa_songid'] . '');
        redirect_header('songs.php', 2, _AM_ONAIR_SONGDEL);
    } else {
        xoops_cp_header();
        xoops_confirm(['oa_songid' => $_GET['oa_songid'], 'del' => 1], 'songs.php?op=SongDel', _AM_ONAIR_SUREDELETE);
        xoops_cp_footer();
    }
}

/**
 * Save edited playlist to database
 *
 * @internal param \Place $In admin saves your edited playlist
 * @internal param int $repeat 1
 *
 * @return Status
 */
function onair_SongSave()
{
    global $xoopsDB, $song_timetype, $numbers2days;

    $xoopsDB->query('UPDATE '
                    . $xoopsDB->prefix('oa_hitlist')
                    . ' SET oa_songid = '
                    . $xoopsDB->quoteString($_POST['oa_songid'])
                    . ', oa_songtime = '
                    . $xoopsDB->quoteString($_POST['oa_songtime'])
                    . ', oa_songday = '
                    . $xoopsDB->quoteString($_POST['oa_songday'])
                    . ', oa_songweek = '
                    . $xoopsDB->quoteString($_POST['oa_songweek'])
                    . ', oa_songyear = '
                    . $xoopsDB->quoteString($_POST['oa_songyear'])
                    . ', oa_songsong = '
                    . $xoopsDB->quoteString($_POST['oa_songsong'])
                    . ' WHERE oa_songid = '
                    . (int)$_POST['oa_songid']
                    . '');
    redirect_header('songs.php', 2, _AM_ONAIR_SONGMOD . $_POST['approved']);
}

/**
 * Edit choosen playlist
 *
 * @param $oa_songid
 * @internal param \Place $In admin Load data to edit form and send to onair_SongSave
 * @internal param int $repeat 1
 *
 * @return Status
 */
function onair_SongEdit($oa_songid)
{
    global $xoopsModuleConfig, $xoopsModule, $xoopsDB, $song_timetype, $myts;
    include XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
    $Songform = new XoopsThemeForm('Songform', 'form', "songs.php?op=SongSave&amp;oa_songid=$oa_songid");
    $myts     = MyTextSanitizer::getInstance();
    $result   = $xoopsDB->query('SELECT oa_songid, oa_songtime, oa_songday, oa_songweek, oa_songyear, oa_songsong FROM ' . $xoopsDB->prefix('oa_hitlist') . ' WHERE oa_songid=' . (int)$oa_songid . '');

    list($oa_songid, $oa_songtime, $oa_songday, $oa_songweek, $oa_songyear, $oa_songsong) = $xoopsDB->fetchRow($result);

    $oa_songid   = new XoopsFormHidden('oa_songid', $oa_songid);
    $oa_songday  = new XoopsFormHidden('oa_songday', $myts->htmlSpecialChars($myts->stripSlashesGPC($oa_songday)));
    $oa_songweek = new XoopsFormHidden('oa_songweek', $myts->htmlSpecialChars($myts->stripSlashesGPC($oa_songweek)));
    $oa_songyear = new XoopsFormHidden('oa_songyear', $oa_songyear);
    $oa_songtime = new XoopsFormHidden('oa_songtime', $myts->htmlSpecialChars($myts->stripSlashesGPC($oa_songtime)));
    // SELECT PROGRAM TO ADD PLAYLIST TO...

    $oa_songsong = new XoopsFormText(_AM_ONAIR_SONG, 'oa_songsong', 200, 75, $myts->htmlSpecialChars($myts->stripSlashesGPC($oa_songsong)));
    $Songform->addElement($oa_songsong);

    // SUBMIT BUTTON AND SHOW FORM
    $op_hidden = new XoopsFormHidden('op', 'SongSave');
    $Songform->addElement($op_hidden);

    $Songform->addElement($oa_songid);
    $Songform->addElement($oa_songtime);
    $Songform->addElement($oa_songday);
    $Songform->addElement($oa_songweek);
    $Songform->addElement($oa_songyear);
    $button_tray = new XoopsFormElementTray('', '');
    $button_tray->addElement(new XoopsFormButton('', 'SongSave', 'Submit', 'submit'));
    $Songform->addElement($button_tray);
    $Songform->display();
}

/**
 * Show all playlist in database
 *
 * @internal param \Place $In admin Show all playlists
 * @internal param int $repeat 1
 *
 * @return Status
 */
function onair_SongShow()
{
    global $xoopsDB, $myts, $pl_days, $xoopsModuleConfig, $song_timetype;

    xoops_cp_header();
    $myts = MyTextSanitizer::getInstance();
    echo "<table border='0' width='100%' class='outer' align='center'>
        <tr><td class='even'><b>" . _AM_ONAIR_SONGID . "</b></td><td class='even'><b>" . _AM_ONAIR_SONGTITLE . "</b></td><td colspan='2' class='even'><div class='center;'><b>" . _AM_ONAIR_ACTION . '</div></b></td></tr>';

    $result = $xoopsDB->query('SELECT oa_songid, oa_songday, oa_songweek, oa_songyear, oa_songsong ,' . ' oa_songtime FROM ' . $xoopsDB->prefix('oa_hitlist') . ' ORDER BY oa_songsong, oa_songweek');
    while ($myrow = $xoopsDB->fetchArray($result)) {
        $oa_songid   = $myrow['oa_songid'];
        $oa_songday  = $myrow['oa_songday'];
        $oa_songweek = $myrow['oa_songweek'];
        $oa_songtime = $myrow['oa_songtime'];
        $oa_songsong = $myts->htmlSpecialChars($myts->stripSlashesGPC($myrow['oa_songsong']));
        echo "</td>
        <td class='odd'>$oa_songsong&nbsp;</td>
        <td class='odd'>$oa_songtime&nbsp;</td>
        <td class='odd'><a href='songs.php?op=SongEdit&amp;oa_songid=$oa_songid'>" . _AM_ONAIR_EDIT . "</a></td>
        <td class='odd'><a href='songs.php?op=SongDel&amp;oa_songid=$oa_songid'>" . _AM_ONAIR_DEL . '</a></td>
        </tr>';
    }
    echo '</table>';
    xoops_cp_footer();
}

// end up using the function selector
if (!isset($_POST['op'])) {
    $op = isset($_GET['op']) ? $_GET['op'] : 'Songchoice';
} else {
    $op = $_POST['op'];
}

// Switch for choises
global $op;
switch ($op) {
    case 'SongSave':
        onair_SongSave();
        break;
    case 'SongEdit':
        xoops_cp_header();
        onair_SongEdit($_GET['oa_songid']);
        xoops_cp_footer();
        break;
    case 'SongDel':
        onair_SongDel();
        break;
    case 'Songlistshow':
        onair_SongShow();
        break;
    case 'Song':
        xoops_cp_header();
        onair_Song($_GET['oa_id']);
        xoops_cp_footer();
        break;
    case 'Songchoice':
    default:
        onair_SongChoice();
        break;
}
