<html>
<head>
    <title>YUI 3.x</title>
</head>
<body>
<h1>Not Loaded Yet..</h1>
<script src=/libs/3.0.0pr1/build/yui/yui.js></script>
<script>
YUI({
    comboBase: '/combo/?b=libs&f=',
    filter: {
        'searchExp': "&3", 
        'replaceStr': ",3"

    },
}).use('node', 'dd', function(Y) {
    Y.get('h1').setStyle('backgroundColor', 'red').set('innerHTML', 'It Worked!!');
});
</script>
</body>
</html>
