<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" lang="en">
  <head>
    <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Multiple YUI RTE Test</title>

    <link href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css" type="text/css" rel="stylesheet" />
    <link href="http://www.federalstreetstudios.com/yui-testing/multiple-rte/css/screen.css" type="text/css" rel="stylesheet" />
    <link href="http://www.federalstreetstudios.com/yui-testing/multiple-rte/css/richedit.css" type="text/css" rel="stylesheet" />

    <script src="http://yui.yahooapis.com/2.3.1/build/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
    <script src="http://yui.yahooapis.com/2.3.1/build/element/element-beta-min.js" type="text/javascript"></script>
    <script src="http://yui.yahooapis.com/2.3.1/build/container/container-min.js" type="text/javascript"></script>
    <script src="http://yui.yahooapis.com/2.3.1/build/menu/menu-min.js" type="text/javascript"></script>
    <script src="http://yui.yahooapis.com/2.3.1/build/button/button-beta-min.js" type="text/javascript"></script>
    <script src="http://yui.yahooapis.com/2.3.1/build/editor/editor-beta-min.js" type="text/javascript"></script>

    <script src="http://yui.yahooapis.com/2.3.1/build/yahoo/yahoo-min.js" type="text/javascript"></script>
    <script src="http://yui.yahooapis.com/2.3.1/build/dom/dom-min.js" type="text/javascript"></script>
    <script src="richedit.js" type="text/javascript"></script>
    <script src="http://www.federalstreetstudios.com/yui-testing/multiple-rte/js/global.js" type="text/javascript"> </script>

    <style type="text/css">
      div { text-align: left; }
      form { width: 500px }
      label { float: none; margin: 0; padding: 0 }
      .editable {
          margin: 0 0 10px;
          text-align: left;
      }
    </style>
  </head>

  <body class="">
    <form action="">
      <div>
	<p>Double Click a element to edit it's contents</p>
	<fieldset>
	  <label for="author" class="required">Authors(s) or Principle Investigators(s)</label>
	  <textarea name="author" class="richTextEditor" id="author">&lt;b&gt;author 0&lt;/b&gt;</textarea>

	  
	  <label for="notes" class="required">Key Results</label>
	  <textarea name="notes" class="richTextEditor" id="notes">&lt;b&gt;notes 0&lt;/b&gt;</textarea>
	  
	  <label for="purpose" class="required">Purpose of Study</label>
	  <textarea name="purpose" class="richTextEditor" id="purpose">&lt;b&gt;purpose of study&lt;/b&gt;</textarea>

	  <label for="primaryPoint" class="required">Primary End Point of Study</label>
	  <textarea name="primaryPoint" class="richTextEditor" id="primaryPoint">&lt;b&gt;primary end point&lt;/b&gt;</textarea>

	  <label for="secPoint">Secondary Endpoints</label>
	  <textarea name="secPoint" class="richTextEditor" id="secPoint">&lt;b&gt;secondary point&lt;/b&gt;</textarea>

	  <label for="objective">Study Objectives</label>
	  <textarea name="objective" class="richTextEditor" id="objective">&lt;b&gt;objective&lt;/b&gt;</textarea>

	  <label for="design">Study Design</label>

	  <textarea name="design" class="richTextEditor" id="design">&lt;b&gt;design&lt;/b&gt;</textarea>

	  <label for="criteria">Inclusion/Exclusion Criteria</label>
	  <textarea name="criteria" class="richTextEditor" id="criteria">&lt;b&gt;criteria&lt;/b&gt;</textarea>

	  <label for="dosing">Dosing</label>
	  <textarea name="dosing" class="richTextEditor" id="dosing">&lt;b&gt;dosing&lt;/b&gt;</textarea>

	  <label for="safety">Finding-Safety</label>
	  <textarea name="safety" class="richTextEditor" id="safety">&lt;b&gt;finding-safty&lt;/b&gt;</textarea>

	  <label for="limitation">Finding-Limitations</label>
	  <textarea name="limitation" class="richTextEditor" id="limitation">&lt;b&gt;finding-limitation&lt;/b&gt;</textarea>

	  <label for="noteworthy">Finding-Noteworthy</label>

	  <textarea name="noteworthy" class="richTextEditor" id="noteworthy">&lt;b&gt;findings-noteworthy&lt;/b&gt;</textarea>
	</fieldset>
      </div>
    </form>
  </body>
</html>
