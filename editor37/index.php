<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>Calendar Plugin</title>

<style type="text/css">
/*margin and padding on body element
  can introduce errors in determining
  element position and are not recommended;
  we turn them off as a foundation for YUI
  CSS treatments. */
body {
	margin:0;
	padding:0;
}
</style>

<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/fonts/fonts-min.css?_yuiversion=2.4.0" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/container/assets/skins/sam/container.css?_yuiversion=2.4.0" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/calendar/assets/skins/sam/calendar.css?_yuiversion=2.4.0" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/menu/assets/skins/sam/menu.css?_yuiversion=2.4.0" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/button/assets/skins/sam/button.css?_yuiversion=2.4.0" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/editor/assets/skins/sam/editor.css?_yuiversion=2.4.0" />
<link type="text/css" rel="stylesheet" href="http://yui.yahooapis.com/2.4.0/build/logger/assets/skins/sam/logger.css">

<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js?_yuiversion=2.4.0"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/container/container.js?_yuiversion=2.4.0"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/calendar/calendar.js?_yuiversion=2.4.0"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/menu/menu.js?_yuiversion=2.4.0"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/button/button.js?_yuiversion=2.4.0"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/editor/editor-beta.js?_yuiversion=2.4.0"></script>

<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/logger/logger-min.js?_yuiversion=2.4.0"></script>
<!-- -->

<script type="text/javascript" src="vneditor.js"></script>
<script type="text/javascript">

YAHOO.util.Event.on(window, 'load', function() {
    new YAHOO.widget.LogReader();
});

    (function YahooDragDrop() {
        var dd, dd2;
        YAHOO.util.Event.onDOMReady(function() {
            dd = new YAHOO.util.DD("drag1");
            dd2 = new YAHOO.util.DD("drag2");
        });
    })();

</script>

<style>
    .yui-skin-sam .yui-toolbar-container .yui-toolbar-insertVN span.yui-toolbar-icon {
        background-image: url( assets/calendar_default.gif );
        background-position: 1px 0px;
        left: 5px;
    }
    .yui-skin-sam .yui-toolbar-container .yui-button-insertVN-selected span.yui-toolbar-icon {
        background-image: url( assets/calendar_active.gif );
        background-position: 1px 0px;
        left: 5px;
    }
    
    #insertdate {
        background-color: transparent;
    }
</style>
</head>
<body class="yui-skin-sam">
<form method="post" action="#" id="form1">
<div id="drag1" class="dd-demo">
<textarea id="editor" name="editor" rows="20" cols="75"></textarea>
</div>
<div id="drag2" class="dd-demo" style="position:absolute; left: 550;top: 50">
<table id="table1" cellspacing="1" cellpadding="1" width="300" border="1">
<tr>
    <td>&#272;</td>
    <td>&#273;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr bgcolor="#ccffff">
    <td></td>
    <td>&#7841;</td>
    <td>&#224;</td>
    <td>&#225;</td>
    <td>&#7843;</td>
    <td>&#227;</td>
    <td></td>
    <td>&#7840;</td>
    <td>&#192;</td>
    <td>&#193;</td>
    <td>&#7842;</td>
    <td>&#195;</td>
</tr>
<tr>
        <td>&#226;</td>
        <td>&#7853;</td>
        <td>&#7847;</td>
        <td>&#7845;</td>
        <td>&#7849;</td>
        <td>&#7851;</td>
        <td>&#194;</td>
        <td>&#7852;</td>
        <td>&#7846;</td>
        <td>&#7844;</td>
        <td>&#7848;</td>
        <td>&#7850;</td>
</tr>
<tr bgcolor="#ccffff">
        <td>&#259;</td>
        <td>&#7863;</td>
        <td>&#7857;</td>
        <td>&#7855;</td>
        <td>&#7859;</td>
        <td>&#7861;</td>
        <td>&#258;</td>
        <td>&#7862;</td>
        <td>&#7856;</td>
        <td>&#7854;</td>
        <td>&#7858;</td>
        <td>&#7860;</td>
</tr>
<tr>
        <td></td>
        <td>&#7865;</td>
        <td>&#232;</td>
        <td>&#233;</td>
        <td>&#7867;</td>
        <td>&#7869;</td>
        <td></td>
        <td>&#7864;</td>
        <td>&#200;</td>
        <td>&#201;</td>
        <td>&#7866;</td>
        <td>&#7868;</td>
</tr>
<tr bgcolor="#ccffff">
        <td>&#234;</td>
        <td>&#7879;</td>
        <td>&#7873;</td>
        <td>&#7871;</td>
        <td>&#7875;</td>
        <td>&#7877;</td>
        <td>&#202;</td>
        <td>&#7878;</td>
        <td>&#7872;</td>
        <td>&#7870;</td>
        <td>&#7874;</td>
        <td>&#7876;</td>
</tr>
<tr>
        <td></td>
        <td>&#7883;</td>
        <td>&#236;</td>
        <td>&#237;</td>
        <td>&#7881;</td>
        <td>&#297;</td>
        <td></td>
        <td>&#7882;</td>
        <td>&#204;</td>
        <td>&#205;</td>
        <td>&#7880;</td>
        <td>&#296;</td>
</tr>
<tr bgcolor="#ccffff">
        <td></td>
        <td>&#7885;</td>
        <td>&#242;</td>
        <td>&#243;</td>
        <td>&#7887;</td>
        <td>&#245;</td>
        <td></td>
        <td>&#7884;</td>
        <td>&#210;</td>
        <td>&#211;</td>
        <td>&#7886;</td>
        <td>&#213;</td>
</tr>
<tr>
        <td>&#244;</td>
        <td>&#7897;</td>
        <td>&#7891;</td>
        <td>&#7889;</td>
        <td>&#7893;</td>
        <td>&#7895;</td>
        <td>&#212;</td>
        <td>&#7896;</td>
        <td>&#7890;</td>
        <td>&#7888;</td>
        <td>&#7892;</td>
        <td>&#7894;</td>
</tr>
<tr bgcolor="#ccffff">
        <td>&#417;</td>
        <td>&#7907;</td>
        <td>&#7901;</td>
        <td>&#7899;</td>
        <td>&#7903;</td>
        <td>&#7905;</td>
        <td>&#416;</td>
        <td>&#7906;</td>
        <td>&#7900;</td>
        <td>&#7898;</td>
        <td>&#7902;</td>
        <td>&#7904;</td>
</tr>
<tr>
        <td></td>
        <td>&#7909;</td>
        <td>&#249;</td>
        <td>&#250;</td>
        <td>&#7911;</td>
        <td>&#361;</td>
        <td></td>
        <td>&#7908;</td>
        <td>&#217;</td>
        <td>&#218;</td>
        <td>&#7910;</td>
        <td>&#360;</td>
</tr>
<tr bgcolor="#ccffff">
        <td>&#432;</td>
        <td>&#7921;</td>
        <td>&#7915;</td>
        <td>&#7913;</td>
        <td>&#7917;</td>
        <td>&#7919;</td>
        <td>&#431;</td>
        <td>&#7920;</td>
        <td>&#7914;</td>
        <td>&#7912;</td>
        <td>&#7916;</td>
        <td>&#7918;</td>
</tr>
<tr>
        <td></td>
        <td>&#7925;</td>
        <td>&#253;</td>
        <td>&#7923;</td>
        <td>&#7927;</td>
        <td>&#7929;</td>
        <td></td>
        <td>&#7924;</td>
        <td>&#7922;</td>
        <td>&#221;</td>
        <td>&#7926;</td>
        <td>&#7928;</td>
</tr>
</table>
</div>


</body>
</html>
