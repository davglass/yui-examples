<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>List reorder w/Bubbling</title>

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

<link type="text/css" rel="stylesheet" href="http://yui.yahooapis.com/3.0.0pr1/build/cssfonts/fonts-min.css" />
<script type="text/javascript" src="http://yui.yahooapis.com/3.0.0pr1/build/yui/yui-min.js"></script>

<!--there is no custom header content for this example-->

</head>

<body class=" yui-skin-sam">

<h1>List reorder w/Bubbling</h1>

<div class="exampleIntro">
	<p>This example shows how to make a sortable list using Custom Event Bubbling.</p>
			
</div>

<!--BEGIN SOURCE CODE FOR EXAMPLE =============================== -->

<style type="text/css" media="screen">
    .yui-dd-proxy {
        text-align: left;
    }
    #play {
        border: 1px solid black;
        padding: 10px;
        margin: 10px;
        zoom: 1;
    }
    #play:after { display: block; clear: both; visibility: hidden; content: '.'; height: 0;}
    #play ul {
        border: 1px solid black;
        margin: 10px;
        width: 200px;
        height: 300px;
        float: left;
        padding: 0;
        zoom: 1;
    }
    #play ul li {
        background-image: none;
        list-style-type: none;
        height: 32px;
        border: 1px solid #ccc;
        display: block;
        margin: 2px;
    }
    #play ul li span {
        padding-left: 20px;
        display: block;
        padding: 5px;
        cursor: move;
        zoom: 1;
        width: 184px;
        height: 20px;
    }
    #play ul li.list1 span {
        background-color: #8DD5E7;
        border:1px solid #004C6D;
    }
    #play ul li.list2 span {
        background-color: #EDFF9F;
        border:1px solid #CDCDCD;
    }
</style>

<div id="play">
    <ul id="list1">
        <li class="list1"><span>Item #1</span></li>
        <li class="list1"><span>Item #2</span></li>
        <li class="list1"><span>Item #3</span></li>
        <li class="list1"><span>Item #4</span></li>
        <li class="list1"><span>Item #5</span></li>
    </ul>
    <ul id="list2">
        <li class="list2"><span>Item #1</span></li>
        <li class="list2"><span>Item #2</span></li>
        <li class="list2"><span>Item #3</span></li>
        <li class="list2"><span>Item #4</span></li>
        <li class="list2"><span>Item #5</span></li>
    </ul>
</div>


<script src="source.js"></script>
</body>
</html>
