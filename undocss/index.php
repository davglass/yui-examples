<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Undo reset.css on part of page</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/yuicss.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/dpSyntaxHighlighter.css">
    <link rel="stylesheet" type="text/css" href="undoreset.css">

    <style type="text/css" media="screen">
        p, h2 {
            margin: 2em;
        }
        textarea {
            width: 98%;
            margin: 1em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Undo reset.css on part of page</a></h1></div>
    <div id="bd">
    <p>I ran into a situation where I needed part of the page to render content from a user that did not need to be reformatted via reset.css. And from this <a href="http://tech.groups.yahoo.com/group/ydn-javascript/message/6679">thread it seems like others have too.</a></p>
    <p>Here is how I am attempting to solve it. (Keep in mind I haven't fully tested it in Internet Explorer)</p>
    <p>Basically I have created a <a href="undoreset.css">stylesheet</a>, that only effects elements below the class <code>undoreset</code>. Currently it only "undoes" certain  HTML Elements, as they are the only ones I needed to "fix".</p>
    <p>Example: <a href="norm.php">Page without reset</a> - <a href="example.php">Page with reset</a></p>
    <textarea name="code" class="HTML">
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <link rel="stylesheet" href="undoreset.css" type="text/css">
</head>
<body>
    <div class="undoreset">
        <strong>Strong Item</strong><br>
        <em>EM Item</em><br>
        <h1>Header 1</h1>
        <h4>Header 4</h4>
        <h5>Header 5</h5>
        <h6>Header 6</h6>
        <ul>
            <li>List Item</li>
            <li>List Item</li>
        </ul>
    </div>
</head>
</html></textarea>



    <h2>Normal code, outside of class undoreset</h2>
    <div>
        <strong>Strong Item</strong><br>
        <em>EM Item</em><br>
        <h1>Header 1</h1>
        <h4>Header 4</h4>
        <h5>Header 5</h5>
        <h6>Header 6</h6>
        <ul>
            <li>List Item</li>
            <li>List Item</li>
        </ul>
    </div>
    <h2>Normal code, inside of class undoreset</h2>
    <div class="undoreset">
        <strong>Strong Item</strong><br>
        <em>EM Item</em><br>
        <h1>Header 1</h1>
        <h4>Header 4</h4>
        <h5>Header 5</h5>
        <h6>Header 6</h6>
        <ul>
            <li>List Item</li>
            <li>List Item</li>
        </ul>
    </div>
    </div>
    <div id="ft">&nbsp;</div>
</div>

<script type="text/javascript" src="../js/yui-012.js"></script>
<script type="text/javascript" src="../js/tools-min.js"></script>
<script type="text/javascript" src="../js/effects-min.js"></script>
<script src="../js/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">


function init() {
    dp.SyntaxHighlighter.HighlightAll('code');
}

$E.addListener(window, 'load', init);

</script>
</body>
</html>
