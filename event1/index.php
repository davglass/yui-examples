<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Multiple Events</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/yuicss.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Multiple Events</a></h1></div>
    <div id="bd">
        <p><textarea id="test1" rows="15" cols="65" maxlength="100" class="enhanced"></textarea><br></p>
        <p><textarea id="test2" rows="15" cols="65" maxlength="110" class="enhanced"></textarea><br></p>
        <p><textarea id="test3" rows="15" cols="65" maxlength="120" class="enhanced"></textarea><br></p>
        <p><textarea id="test4" rows="15" cols="65" maxlength="130" class="enhanced"></textarea><br></p>
        <p><textarea id="test5" rows="15" cols="65" maxlength="140" class="enhanced"></textarea><br></p>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="../js/yui-012.js"></script>
<script type="text/javascript" src="../js/tools-min.js"></script>
<script type="text/javascript" src="../js/effects-min.js"></script>
<script src="../js/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">



function countChars(ev) {
    var field = YAHOO.util.Event.getTarget(ev);
    // get max characters
    if (field.getAttribute('maxlength')) {
      var maxLimit = field.getAttribute('maxlength');
    } else {
      // if no maxChars, then maxChars = 1000
      var maxLimit = 1000;
    }
    var charCount = field.value.length;

    var fieldWidth = parseInt(YAHOO.util.Dom.getStyle(field, 'width'));
    var charCount = field.value.length;
    var counter = YAHOO.util.Dom.get(field.id + '_charCount');
  // trim the extra text
  if (charCount > maxLimit) {
    field.value = field.value.substring(0, maxLimit);
        alert('Your text has exceeded the maximum length allowed. Please edit your text to fit within the characters allowed. Use the progress bar and character counter below to help you with this.');
  } else {
    // progress bar percentage
    var percentage = parseInt(100 - (( maxLimit - charCount) * 100)/maxLimit);
    YAHOO.util.Dom.get(field.id + '_progressBar').style.width = parseInt((fieldWidth * percentage)/100)+"px";
    setColor(counter, percentage, "background-color");
        // update characters remaining counter
        YAHOO.util.Dom.get(field.id + '_charCount').innerHTML = (maxLimit - charCount);
  }
}

function setColor(obj,percentage,prop) {
  obj.style[prop] = "rgb(80%,"+(100-percentage)+"%,"+(100-percentage)+"%)";
}

function attachBehaviors() {
  // look for Enhanced TextArea elements
    var textareaElements = YAHOO.util.Dom.getElementsByClassName('enhanced','textarea');
    // loop through each of the Enhanced TextArea elements, get attribute settings
    // and attach handlers
    for (var i=0; i < textareaElements.length; i++) {
      // get element ID
        if (textareaElements[i].getAttribute('id')) {
          var elementID = textareaElements[i].getAttribute('id');
        }else {
          // if no ID, then assign one
            var elementID = 'textareaElement'+i;
            textareaElements[i].setAttribute('id',elementID);
        }
        
        if (textareaElements[i].getAttribute('maxlength')) {
          var maxChars = textareaElements[i].getAttribute('maxlength');
        } else {
          // if no maxChars, then maxChars = 1000
          var maxChars = 1000;
        }
        
        // compute width (in pixels) of textarea
        var textareaWidth = textareaElements[i].clientWidth;
        textareaElements[i].style.width = textareaWidth;
        
        // set unique progress bar ID and character counterIDs
        var progressBarID = elementID + '_progressBar';
        var charCounterTextID = elementID + '_charCounterText';
        var charCounterID = elementID + '_charCount';
        
        // add progress bar and character counter belowtextarea
        var newProgressBar = document.createElement("div");
        newProgressBar.setAttribute("id",progressBarID);
        newProgressBar.style.width = "1px";
        newProgressBar.style.height = "12px";
        newProgressBar.style.backgroundColor = "#0000FF";
        newProgressBar.style.borderWidth = "1px";
        newProgressBar.style.borderStyle = "solid";
        newProgressBar.style.borderColor = "#000000";
        
        var newCharCounter = document.createElement("div");
        newCharCounter.setAttribute("id",charCounterTextID);
        
        var newCharCounterText = document.createTextNode("Characters remaining: ");
        newCharCounter.appendChild(newCharCounterText);
        
        var newCharCounterSpan = document.createElement("span");
        newCharCounterSpan.setAttribute("id",charCounterID);
        
        var newCharCountValue = document.createTextNode(maxChars);
        
        newCharCounterSpan.appendChild(newCharCountValue);
        newCharCounter.appendChild(newCharCounterSpan);
        
        // find the parent element of the textarea
        var textareaParent = textareaElements[i].parentNode;
        
        // this is the content of the textarea
        var textareaContent = textareaElements[i].nextSibling;
        
        // this is the next element after the textarea & textarea content
        var nextElement = textareaContent.nextSibling;
        
        // append the progress bar and character counterinto the document
        textareaParent.insertBefore(newProgressBar,nextElement);
        textareaParent.insertBefore(newCharCounter,nextElement);
        
    }
    YAHOO.util.Event.addListener(textareaElements,'keydown',countChars);
    YAHOO.util.Event.addListener(textareaElements,'keyup',countChars);
    YAHOO.util.Event.addListener(textareaElements,'focus',countChars);
}

YAHOO.util.Event.addListener(window,'load',attachBehaviors);





</script>
</body>
</html>
