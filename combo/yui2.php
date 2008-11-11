<html>
<head>
    <title>YUI 2.6.0</title>
</head>
<body class="yui-skin-sam">
<h1>Not Loaded Yet..</h1>
<script type="text/javascript" src="/libs/2.6.0/build/yuiloader/yuiloader.js"></script>
<script>
// Instantiate and configure Loader:
var loader = new YAHOO.util.YUILoader({

    require: ["button", "selector"],
    comboBase: '/combo/?b=libs&f=',
    loadOptional: true,
    filter: {
        'searchExp': /&2/g, 
        'replaceStr': ",2"

    },
    skin: {
        defaultSkin: 'sam', 
        base: 'assets/skins/',
        path: 'skin.css',
        rollup: 1
    },
    onSuccess: function() {
        var button = new YAHOO.widget.Button({
            label: "It Worked",
            container: document.body
        });
        var h1 = YAHOO.util.Selector.query("h1")[0];
        h1.innerHTML = "It Worked!!";
        YAHOO.util.Dom.setStyle(h1, "backgroundColor", "red");
    },
    timeout: 10000,
    combine: true
});

loader.insert();
</script>
</body>
</html>
