<table>
    <th><a href="<{$xoops_url}>/modules/onair/index.php?show=day&oa_day=0"><{$lang_sundayname}></a></th>
    <th><a href="<{$xoops_url}>/modules/onair/index.php?show=day&oa_day=1"><{$lang_mondayname}></a></th>
    <th><a href="<{$xoops_url}>/modules/onair/index.php?show=day&oa_day=2"><{$lang_tuedayname}></a></th>
    <th><a href="<{$xoops_url}>/modules/onair/index.php?show=day&oa_day=3"><{$lang_weddayname}></a></th>
    <th><a href="<{$xoops_url}>/modules/onair/index.php?show=day&oa_day=4"><{$lang_thudayname}></a></th>
    <th><a href="<{$xoops_url}>/modules/onair/index.php?show=day&oa_day=5"><{$lang_fridayname}></a></th>
    <th><a href="<{$xoops_url}>/modules/onair/index.php?show=day&oa_day=6"><{$lang_satdayname}></a></th>
</table>
<table width="100%">
    <{section name=i loop=$posts}>
    <tr class='even'>
        <th align="left"><{$posts[i].oa_day}></th>
    </tr>
    <tr class="odd">
        <td nowrap="nowrap" valign="top" align="left"><{$posts[i].oa_start}></td>
        <td nowrap="nowrap" valign="top" align="left"><{$posts[i].oa_image}></td>
        <td nowrap="nowrap" valign="top" align="left"><{$posts[i].oa_title}></td>
        <td nowrap="nowrap" valign="top" align="left"><a
                    href="<{$xoops_url}>/modules/onair/index.php?show=name&oa_name=<{$posts[i].oa_name}>"><{$posts[i].oa_name}></a>
        </td>
    </tr>
</table>
<{/section}>
