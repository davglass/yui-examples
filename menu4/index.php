<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?2.8.0r4/build/reset-fonts-grids/reset-fonts-grids.css&2.8.0r4/build/menu/assets/skins/sam/menu.css">
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.8.0r4/build/yahoo-dom-event/yahoo-dom-event.js&2.8.0r4/build/container/container_core-min.js&2.8.0r4/build/menu/menu-min.js"></script> 
<style type="text/css">
.yui-skin-sam .yuimenuitem {
    text-align: left;
}
.yui-skin-sam .yuimenuitem span {
    text-align: left;
    display: block;
    position: relative;
    width: 250px;
}
.yui-skin-sam .yuimenuitem-selected span {
}
.yui-skin-sam .yuimenuitem span:after { display: block; clear: both; visibility: hidden; content: '.'; height: 0;}

.yui-skin-sam .yuimenubar .yuimenu, .yui-skin-sam .yuimenu .yuimenu {
    width: 250px;
}
.yui-skin-sam .yuimenuitemlabel {
    background-color: #ccc;
    font-weight: bold;
}
.col1, .col2 {
    width: 125px;
    float: left;
    margin-right: 10px;
}
.col1 li, .col2 li {
    list-style-type: square;
    margin-left: 20px;
}

#content h2 {
    font-size: 120%;
    font-weight: bold;
}
#content {
    text-align: left;
    margin: 1em;
    margin-top: 100px;
}
</style>
</head>
<body class="yui-skin-sam">
 <div id="davmenu" class="yuimenubar yuimenubarnav">
      <div class="bd">
        <ul class="first-of-type">
          <li class="yuimenuitem"><a class="yuimenuitemlabel" href="#">About</a>
            <div id="about2" class="yuimenu">
              <div class="bd">
                <ul>
                  <li><a href="#">History</a>
                    <span>
                        <ul class="col1">
                            <li><a href="#">Pres</a></li>
                            <li><a href="#">Provost</a></li>
                            <li><a href="#">Finance</a></li>
                            <li><a href="#">Other</a></li>
                        </ul>
                        <ul class="col2">
                            <li><a href="#">Pres</a></li>
                            <li><a href="#">Provost</a></li>
                            <li><a href="#">Finance</a></li>
                            <li><a href="#">Other</a></li>
                        </ul>
                    </span>
                  </li>
                  <li class="first-of-type"><a href="#">Admin</a>
                    <span>
                        <ul class="col1">
                            <li><a href="#">Pres</a></li>
                            <li><a href="#">Provost</a></li>
                            <li><a href="#">Finance</a></li>
                            <li><a href="#">Other</a></li>
                        </ul>
                    </span>
                  </li>
                  <li><a href="#">Uni &amp; Community</a>
                    <span>
                        <ul class="col1">
                            <li><a href="#">Pres</a></li>
                            <li><a href="#">Provost</a></li>
                            <li><a href="#">Finance</a></li>
                            <li><a href="#">Other</a></li>
                        </ul>
                        <ul class="col2">
                            <li><a href="#">Pres</a></li>
                            <li><a href="#">Provost</a></li>
                            <li><a href="#">Finance</a></li>
                            <li><a href="#">Other</a></li>
                        </ul>
                    </span>
                  </li>
                  <li><a href="#">News</a>
                    <span>
                        <ul class="col1">
                          <li><a href="#">Source 1</a></li>
                          <li><a href="#">Source 2</a></li>
                          <li><a href="#">Source 3</a></li>
                        </ul>
                    </span>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li class="yuimenuitem"><a class="yuimenuitemlabel" href="#">Admissions</a>
            <div id="admissions2" class="yuimenu">
              <div class="bd">
                <ul>
                  <li><a href="#">Apply</a>
                    <span>
                        <ul class="col1">
                          <li><a href="#">Source 1</a></li>
                          <li><a href="#">Source 2</a></li>
                          <li><a href="#">Source 3</a></li>
                        </ul>
                    </span>
                  </li>
                  <li><a href="#">Request info</a>
                    <span>
                        <ul class="col1">
                          <li><a href="#">Source 1</a></li>
                          <li><a href="#">Source 2</a></li>
                          <li><a href="#">Source 3</a></li>
                        </ul>
                    </span>
                  </li>
                </ul> 
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
<script>
YAHOO.util.Event.onContentReady("davmenu", function () {

    var oMenu2 = new YAHOO.widget.MenuBar("davmenu", {
        position: "static",
        lazyload:true,
        autosubmenudisplay: true
    });
    oMenu2.render();
    oMenu2.show();
            
});
</script>

<div id="content">
<h2>CSS</h2>
<script src="http://gist.github.com/301648.js?file=gistfile1.css"></script>

<h2>Javascript</h2>
<script src="http://gist.github.com/301650.js?file=gistfile1.js"></script>

<h2>HTML</h2>
<script src="http://gist.github.com/301649.js?file=gistfile1.htm"></script>
</div>
</body>
</html>
