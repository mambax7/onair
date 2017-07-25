<style type="text/css">
    .oa_pullquote {
        float: right;

        padding: 2px;
        border: 1px solid black;
        font-size: .8em;
        margin: 2px;
        background-color: whitesmoke;
    }

</style>
<p><{section name=i loop=$info}></p>
<table>
    <tr>
        <td class="head">
            <div style="text-align: center;"><h1><b><{$info[i].pl_title}></b></h1>

                <h3><{$lang_with}></h3>

                <h1><{$info[i].pl_name}></h1></div>
        </td>
    </tr>
    <tr>
        <td class="even">
            <div style="text-align: center;"><h2><{$lang_ondate}><{$info[i].pl_date}></h2></div>
            <div style="text-align: center;"><h3>(<{$info[i].pl_start}> - <{$info[i].pl_stop}>)</h3></div>
        </td>
    </tr>
    <b>
        <tr>
            <td style="padding:5px;border:1px solid #666;"><b>

                    <div style="float:right;width:37%;">
                        <{$info[i].pl_image}></div>
                    <h4><{$info[i].pl_description}></h4>


            </td>
        </tr>
        <tr>
            <td><b></td>
        </tr>
</table>
</th>


<{/section}>
