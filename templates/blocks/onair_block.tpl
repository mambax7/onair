<script src="<{$xoops_url}>/modules/onair/include/jquery/jquery-1.3.2.js"></script>
<script>
    var refreshId = setInterval(function () {
        $('#dropmsg0').fadeOut("slow", function () {
            $(this).load('<{$xoops_url}>/modules/onair/onair_ajaxassign2.php').fadeIn("slow");
        });
    }, 20000);
    var refreshId2 = setInterval(function () {
        $('#dropmsg0').fadeOut("slow", function () {
            $(this).load('<{$xoops_url}>/modules/onair/onair_ajaxassign.php').fadeIn("slow");
        });
    }, 29999);
</script>
<div class="td#rightcolumn" id="dropmsg0"><{foreach item=message from=$block.onair}>
        <div style="text-align: center;"><b><{$message.station}></b></div>
        <br>
        <div style="text-align: center;"><code><b><{$message.title}></b></code></div>
        <br>
        <div style="text-align: center;"><a
                    href="<{$xoops_url}>/modules/onair/detail.php?ext=info&oa_id=<{$message.id}>"><{$message.image}></a>
        </div>
        <div style="text-align: center;"><h4><{$message.host}><{$message.name}></h4></div>
        <br>
        <div style="text-align: center;"><img
                    src="<{$xoops_url}>/modules/onair/assets/images/icons/musicnote.png"> <{$message.pluginshow}></div>
        <br>
        <div style="text-align: center;"><{$message.day}></div>
        <div style="text-align: center;"><h4><{$message.start}> - <{$message.stop}></h4></div>
    <{/foreach}></div>
