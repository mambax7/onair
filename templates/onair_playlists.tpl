<table width="100%">
    <tr class='odd'>
        <td nowrap="nowrap" valign="top" align="left"><h3><{$lang_datename}></h3></td>
        <td nowrap="nowrap" valign="top" align="left"><h3><{$lang_startname}></h3></td>
        <td nowrap="nowrap" valign="top" align="left"><h3><{$lang_stopname}></h3></td>
        <td nowrap="nowrap" valign="top" align="left"><h3><{$lang_titlename}></h3></td>
        <td nowrap="nowrap" valign="top" align="left"><h3><{$lang_namename}></h3></td>
    </tr>
    <{section name=i loop=$posts}>
        <tbody>
        <tr class="table td">
            <td align="left" valign="top" nowrap="nowrap" style="padding-left:5px;"><{$posts[i].pl_date}></td>
            <td nowrap="nowrap" valign="top" align="left" style="padding-left:5px;"><{$posts[i].pl_start}></td>
            <td nowrap="nowrap" valign="top" align="left" style="padding-left:5px;"><{$posts[i].pl_stop}></td>
            <td nowrap="nowrap" valign="top" align="left" style="padding-left:5px;">
                <a href="<{$xoops_url}>/modules/onair/detailplaylist.php?plext=info&pl_id=<{$posts[i].pl_id}>"><{$posts[i].pl_title}></a>
            </td>
            <td nowrap="nowrap" valign="top" align="left" style="padding-left:5px;">
                <a href="<{$xoops_url}>/modules/onair/playlists.php?show=name&pl_name=<{$posts[i].pl_name}>"><{$posts[i].pl_name}></a>
            </td>
        </tr>
        </tbody>
    <{/section}>
</table>
