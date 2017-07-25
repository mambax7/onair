<{foreach item=messagenext from=$block.onair2}>
    <div style="text-align: center;"><{$messagenext.comup}></div>
    <br>
    <div style="text-align: center;"><{$messagenext.station}></div>
    <div style="text-align: center;"><code><b><{$messagenext.title}></b></code></div>
    <div style="text-align: center;"><a
                href="<{$xoops_url}>/modules/onair/detail.php?ext=info&oa_id=<{$messagenext.id}>"><{$messagenext.image}></a>
    </div>
    <br>
    <div style="text-align: center;"><h4><{$messagenext.host}><{$messagenext.name}></h4></div>
    <br>
    <div style="text-align: center;"><{$messagenext.day}></div>
    <div style="text-align: center;"><h4><{$messagenext.start}> - <{$messagenext.stop}></h4></div>
<{/foreach}>
