<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<!-- Drag Drop Dependencies --> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/dragdrop/dragdrop.js"></script> 

<script language="javascript">
    <!--	
    var ddsummary;
    function initYahooDD() {
        ddsummary = new YAHOO.util.DD("panelStatus");
        ddsummary.setHandleElId('status');
    }
    -->
</script>
</head>

<body onload="initYahooDD();">
<div id="panelStatus" style="position:absolute">
    <table id=statPanel bgcolor=DimGray>
    <tr>
        <td colspan="6" bgcolor=Wheat class=statusHeader id="status">STATUS</td>
    </tr>
    <tr>
        <td colspan="6">
        <div> 
            <div id="dspRecentEvents" style="height: 50px; overflow: auto; background-color:white;">
            test1<br/>
            test2 <br/>
            test3 <br/>
            test4 <br/>
            test5 <br/>
            test6 <br/>
            test7 <br/>
            test8 <br/>
            test9 <br/>
            <table width="100%"></table>
            </div>
        </div>
        </td>
    </tr>
    </table> 
</div>
</body>
</html>


