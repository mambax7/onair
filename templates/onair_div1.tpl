<{foreach item=message from=$block.onair}>
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
<{/foreach}>
