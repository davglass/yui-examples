<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DHTML Form Controls</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/yuicss.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        @import url( style.css );
        p, h2 {
            margin: 1em;
        }
        .fieldHolder {
            padding: .25em;
            margin: .5em;
            clear: both;
        }
        .right {
            padding-left: 150px;
        }
        .fieldHolder label.right {
            padding-left: .5em;
        }
        .fieldHolder label.left {
            padding-left: .5em;
            width: 150px;
            display: block;
            float: left;
            text-align: right;
        }
        fieldset {
            margin: 1em;
            width: 50%;
        }
        legend {
            display: none;
        }
        #examples {
            border: 1px solid black;
            background-color: white;
            width: 300px;
        }
        #examples ul {
            list-style-type: disc;
            padding: 4px;
        }
        #examples li {
            margin-left: 20px;
            padding: 2px;
        }
        #examples .hd {
            margin: 0;
            padding: .25em;
            background-color: #336699;
            color: white;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DHTML Form Controls</a></h1></div>
    <div id="bd">
    <p>DHTML Form Controls built with the YUI Libs. This example shows the different controls available.</p>
    <p>Render any of the controls &amp; change their value, then destroy the control to see the form has been updated.</p>
    <p><a href="../docs/?type=forms">Docs available here</a> - <a href="dhtmlforms-min.js">Minimized source here</a></p>
    <form id="thisForm">
    <fieldset>
        <legend>My Form</legend>
        <div class="fieldHolder">
            <label for="test1" class="left">This is a select box: </label>
            <select id="test1">
                <option> Value 1.1</option>
                <option> Value 1.2</option>
                <option> Value 1.3</option>
                <option> Value 1.4</option>
            </select>
        </div>
        <div class="fieldHolder">
            <label for="test2" class="left">This is a select box: </label>
            <select id="test2">
                <option> Value 2.1</option>
                <option selected="selected"> Value 2.2</option>
                <option> Value 2.3</option>
                <option> Value 2.4</option>
            </select>
        </div>
        <div class="fieldHolder right">
            <input type="checkbox" id="test3" value="1" checked /><label for="test3" class="right">This is a simple checkbox</label>
        </div>
        <div class="fieldHolder right">
            <input type="checkbox" id="test31" value="1" checked /><label for="test31" class="right">This is a simple checkbox</label>
        </div>
        <div class="fieldHolder right">
            <input type="checkbox" id="test32" value="1" checked /><label for="test32" class="right">This is a simple checkbox</label>
        </div>
        <div class="fieldHolder right">
            <input type="radio" id="test4" name="testradio" value="1" checked /><label for="test4" class="right">This is a simple radio (1)</label><br>
            <input type="radio" id="test5" name="testradio" value="2" /><label for="test5" class="right">This is a simple radio (2)</label><br>
            <input type="radio" id="test6" name="testradio" value="3" /><label for="test6" class="right">This is a simple radio (3)</label><br>
        </div>
        <div class="fieldHolder right">
            <input type="radio" id="test42" name="testradio2" value="1" /><label for="test42" class="right">This is a simple radio (1)</label><br>
            <input type="radio" id="test52" name="testradio2" value="2" checked /><label for="test52" class="right">This is a simple radio (2)</label><br>
            <input type="radio" id="test62" name="testradio2" value="3" /><label for="test62" class="right">This is a simple radio (3)</label><br>
        </div>
        <div class="fieldHolder right">
            <input type="radio" id="test43" name="testradio3" value="1" /><label for="test43" class="right">This is a simple radio (1)</label><br>
            <input type="radio" id="test53" name="testradio3" value="2" /><label for="test53" class="right">This is a simple radio (2)</label><br>
            <input type="radio" id="test63" name="testradio3" value="3" checked /><label for="test63" class="right">This is a simple radio (3)</label><br>
        </div>
        <div class="fieldHolder">
            <label for="test7" class="left">Text Input: </label>
            <input type="text" id="test7" size="45" value="This is the content of the input." />
        </div>
        <div class="fieldHolder">
            <label for="test71" class="left">Text Input: </label>
            <input type="text" id="test71" size="45" value="This is the content of the second input." />
        </div>
        <div class="fieldHolder">
            <label for="test72" class="left">Password Input: </label>
            <input type="password" id="test72" size="45" value="This is the content of the password input." />
        </div>
        <div class="fieldHolder">
            <label for="test8" class="left">Text Area: </label>
            <textarea id="test8" rows="5" cols="45">This is the content of the textarea. This is the content of the textarea. This is the content of the textarea. </textarea>
        </div>
    </form>
    <div id="examples">
        <div class="hd">DHTML Form Controls Examples</div>
        <div class="bd">
            Click on the links below 8-)
            <ul id="exampleControls">
                <li>
                    <ul>Render Control
                        <li><a href="javascript: tmpForm.renderSelectBoxes();">SelectBoxes</a></li>
                        <li><a href="javascript: tmpForm.renderCheckBoxes();">CheckBoxes</a></li>
                        <li><a href="javascript: tmpForm.renderRadioButtons();">RadioButtons</a></li>
                        <li><a href="javascript: tmpForm.renderTextInputsOnly();">Text Inputs Only</a></li>
                        <li><a href="javascript: tmpForm.renderPasswords();">Password Inputs Only</a></li>
                        <li><a href="javascript: tmpForm.renderTextAreas();">Text Areas Only</a></li>
                        <li><a href="javascript: tmpForm.renderTextInputs();">TextInputs All</a></li>
                        <li><a href="javascript: tmpForm.render();">Form</a></li>
                    </ul>
                </li>
                <li>
                    <ul>Destroy Control
                        <li><a href="javascript: tmpForm.destroySelectBoxes();">SelectBoxes</a></li>
                        <li><a href="javascript: tmpForm.destroyCheckBoxes();">CheckBoxes</a></li>
                        <li><a href="javascript: tmpForm.destroyRadioButtons();">RadioButtons</a></li>
                        <li><a href="javascript: tmpForm.destroyTextInputsOnly();">Text Inputs Only</a></li>
                        <li><a href="javascript: tmpForm.destroyPasswords();">Password Inputs Only</a></li>
                        <li><a href="javascript: tmpForm.destroyTextAreas();">Text Areas Only</a></li>
                        <li><a href="javascript: tmpForm.destroyTextInputs();">Text Inputs All</a></li>
                        <li><a href="javascript: tmpForm.destroy();">Form</a></li>
                    </ul>
                </li>
            </ul>
            <p>Next release: Error Handling and Calendar attachments</p>
        </div>
    </div>
</div>
<div id="ft">&nbsp;</div>
</div>


<script type="text/javascript" src="../js/yui-012.js"></script>
<script type="text/javascript" src="../tools/tools-min.js"></script>
<script type="text/javascript" src="../js/effects-min.js"></script>
<script src="../js/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="./dhtmlforms-min.js"></script>
<script type="text/javascript">
var exampleCont = null;
var tmpForm = null;

function init() {
    tmpForm = new YAHOO.DHTMLForms.Form('thisForm');

    exampleCont = new YAHOO.widget.Panel('examples', {
        visible: true,
        underlay: 'shadow',
        draggable: true,
        iframe: true,
        context: ['hd', 'tr', 'br']
    });
    exampleCont.render();
}

$E.addListener(window, 'load', init);
/*
tmpForm.render();
var tmp = new YAHOO.DHTMLForms.SelectBox('test1');
tmp.render();

var tmp2 = new YAHOO.DHTMLForms.SelectBox('test2');
tmp2.render();
var tmp4 = new YAHOO.DHTMLForms.TextInput('test7', 'click');
tmp4.render();
var tmp5 = new YAHOO.DHTMLForms.TextInput('test8');
tmp5.render();

var tmp51 = new YAHOO.DHTMLForms.TextInput('test71', 'click');
tmp51.render();

var tmp6 = new YAHOO.DHTMLForms.CheckBox('test3');
tmp6.render();

var tmp7 = new YAHOO.DHTMLForms.RadioButtons(['test4', 'test5', 'test6']);
tmp7.render();
*/
</script>
</body>
</html>

