<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"  "http://www.w3.org/TR/html4/strict.dtd"> 
<head>
<title>Show Jumping Events - When and Where</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Find out how to get to Show Jumping events in Ireland and get notified if they are cancelled. ">
<meta name="keywords" 			content="show jumping,jumping, horses, events,ireland,sjai,showjumping,photos,notification,directions,ponies,pony,photos,photographs">

    <!---------- YUI Dependencies  ------->
     <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/layout.css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/resize.css">
    <script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/yahoo-dom-event/yahoo-dom-event.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/element/element-beta-min.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/dragdrop/dragdrop-min.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/animation/animation-min.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/resize/resize-beta-min.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/layout/layout-beta-min.js"></script>


<link rel='stylesheet' type='text/css' media='all' href='http://www.ggjump.com/styles/stylesheet.css' /> 
<style type='text/css' media='screen'>@import 'http://www.ggjump.com/styles/stylesheet.css';</style>
<style>
.yui-layout-doc {
    padding: 0;
}    
</style>



<link rel="shortcut icon" type="image/x-icon" href="http://www.ggjump.com/favicon.ico" />


<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>

</head>
<body class="yui-skin-sam">

<div id="wrapper">
<!-- ********************START OR BANNER ***************************** -->


<div id="banner" >
  
		<div id="header">
                    
			<h1>Show Jumping Events in Ireland</h1>
        		<p>Is it on? How do I get there? News and Results</p>
		</div>


	        <div id="login">
                    
      LOGO OF MAIN SPONSOR
       

        </div>  <!-- login -->

               <div class="clear"></div>
	
		<div id="navbar" >
	                  <ul>
                              <li><a href="http://www.ggjump.com/index.php/">Home</a></li>
                             <li><a href="http://www.ggjump.com/index.php/site/about/">About this Site</a></li>
                                                                                       
                            <li><a href="http://www.ggjump.com/index.php/site/help/">Help</a></li>
                            <li><a href="http://www.ggjump.com/index.php/site/map/">Map</a></li>
                                                      <li><a href="http://www.ggjump.com/index.php/site/contact/">Contact Us</a></li>
                
                       </ul>
  
 	</div><!-- navbar -->

  
                                                         <a href="http://www.ggjump.com/index.php/member/login/">Login</a> | <a href="http://www.ggjump.com/index.php/member/register/">Register</a>
                        </div><!-- banner -->


 <!--**********************END OF BANNER ********************** -->

    


<div id="sidebar2" onClick="parent.location='http://www.ggjump.com/index.php/site/map/'">


<!--script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAP5xwnMuFrLi88PRImxI25hTWGKOKNp1h2hjyexWklzujyChtrhQxrYQydwXZEH69wWirrLcHxPyO5g" type="text/javascript" charset="utf-8"></script><script type="text/javascript" charset="utf-8"-->
<script>
//<![CDATA[
/*************************************************
 * Created with GoogleMapAPI 2.5
 * Author: Monte Ohrt <monte AT ohrt DOT com>
 * Copyright 2005-2006 New Digital Group
 * http://www.phpinsider.com/php/code/GoogleMapAPI/
 *************************************************/
 /*
var points = [];
var markers = [];
var counter = 0;
var sidebar_html = "";
var marker_html = [];
var to_htmls = [];
var from_htmls = [];
var map = null;
function onLoad() {
if (GBrowserIsCompatible()) {
var mapObj = document.getElementById("map");
if (mapObj != "undefined" && mapObj != null) {
map = new GMap2(document.getElementById("map"));
map.setCenter(new GLatLng(52.954468, -7.729740), 16, G_NORMAL_MAP);
var bds = new GLatLngBounds(new GLatLng(51.9708528699, -9.0847972869873), new GLatLng(53.938084074673, -6.3746829986572));
map.setZoom(map.getBoundsZoomLevel(bds));
var point = new GLatLng(51.99013945033865,-8.40466976165772);
var marker = createMarker(point,"Ballindenisk Equestrian Show","<div id=\"gmapmarker\"><b>Ballindenisk Equestrian Show<\/b><br \/>              on 20Apr08<br \/>             <a href='http:\/\/www.ggjump.com\/index.php\/site\/more\/ballindenisk_equestrian_show'>More details<\/a><\/div>", 0,"Ballindenisk Equestrian Show-on 20Apr08");
map.addOverlay(marker);
var point = new GLatLng(52.94863788488318,-9.05822753906250);
var marker = createMarker(point,"test","<div id=\"gmapmarker\"><b>test<\/b><br \/>              on 25Apr08<br \/>             <a href='http:\/\/www.ggjump.com\/index.php\/site\/more\/test'>More details<\/a><\/div>", 1,"test-on 25Apr08");
map.addOverlay(marker);
var point = new GLatLng(53.91879749423393,-6.40125274658203);
var marker = createMarker(point,"Louth County Show","<div id=\"gmapmarker\"><b>Louth County Show<\/b><br \/>              from  26Apr08 to 28Apr08<br \/>             <a href='http:\/\/www.ggjump.com\/index.php\/site\/more\/louth_county_show'>More details<\/a><\/div>", 2,"Louth County Show-from  26Apr08 to 28Apr08");
map.addOverlay(marker);
var point = new GLatLng(52.13944103978781,-8.26695442199707);
var marker = createMarker(point,"Fermoy Show","<div id=\"gmapmarker\"><b>Fermoy Show<\/b><br \/>              on 04May08<br \/>             <a href='http:\/\/www.ggjump.com\/index.php\/site\/more\/fermoy_show'>More details<\/a><\/div>", 3,"Fermoy Show-on 04May08");
map.addOverlay(marker);
var point = new GLatLng(52.76039866978357,-8.89605045318604);
var marker = createMarker(point,"Newmarket On Fergus","<div id=\"gmapmarker\"><b>Newmarket On Fergus<\/b><br \/>              on 04May08<br \/>             <a href='http:\/\/www.ggjump.com\/index.php\/site\/more\/newmarket_on_fergus'>More details<\/a><\/div>", 4,"Newmarket On Fergus-on 04May08");
map.addOverlay(marker);
var point = new GLatLng(53.63293386698836,-7.28908538818359);
var marker = createMarker(point,"Streamstown Foxhounds Hunt","<div id=\"gmapmarker\"><b>Streamstown Foxhounds Hunt<\/b><br \/>              on 04May08<br \/>             <a href='http:\/\/www.ggjump.com\/index.php\/site\/more\/streamstown_foxhounds_hunt'>More details<\/a><\/div>", 5,"Streamstown Foxhounds Hunt-on 04May08");
map.addOverlay(marker);
var point = new GLatLng(53.72185331308621,-7.19947814941406);
var marker = createMarker(point,"Thomastown Horse Show","<div id=\"gmapmarker\"><b>Thomastown Horse Show<\/b><br \/>              on 04May08<br \/>             <a href='http:\/\/www.ggjump.com\/index.php\/site\/more\/thomastown_horse_show'>More details<\/a><\/div>", 6,"Thomastown Horse Show-on 04May08");
map.addOverlay(marker);
var point = new GLatLng(52.49984335263108,-6.57724857330322);
var marker = createMarker(point,"Wexford SJAI","<div id=\"gmapmarker\"><b>Wexford SJAI<\/b><br \/>              on 04May08<br \/>             <a href='http:\/\/www.ggjump.com\/index.php\/site\/more\/wexford_sjai'>More details<\/a><\/div>", 7,"Wexford SJAI-on 04May08");
map.addOverlay(marker);
var point = new GLatLng(52.66305767075934,-7.38281250000000);
var marker = createMarker(point,"Kilkenny Amateurs","<div id=\"gmapmarker\"><b>Kilkenny Amateurs<\/b><br \/>              on 05May08<br \/>             <a href='http:\/\/www.ggjump.com\/index.php\/site\/more\/kilkenny_amateurs'>More details<\/a><\/div>", 8,"Kilkenny Amateurs-on 05May08");
map.addOverlay(marker);
var point = new GLatLng(52.61390181532846,-7.20992803573608);
var marker = createMarker(point,"Wallslough Village","<div id=\"gmapmarker\"><b>Wallslough Village<\/b><br \/>              on 11May08<br \/>             <a href='http:\/\/www.ggjump.com\/index.php\/site\/more\/wallslough_village'>More details<\/a><\/div>", 9,"Wallslough Village-on 11May08");
map.addOverlay(marker);
document.getElementById("sidebar_map").innerHTML = "<ul class=\"gmapSidebar\">"+ sidebar_html +"<\/ul>";
}
} else {
alert("Sorry, the Google Maps API is not compatible with this browser.");
}
}
function createMarker(point, title, html, n, tooltip) {
if(n >= 0) { n = -1; }
var marker = new GMarker(point,{'title': tooltip});
var tabFlag = isArray(html);
if(!tabFlag) { html = [{"contentElem": html}]; }
to_htmls[counter] = html[0].contentElem + '<form class="gmapDir" id="gmapDirTo" style="white-space: nowrap;" action="http://maps.google.com/maps" method="get" target="_blank">' +
                     '<span class="gmapDirHead" id="gmapDirHeadTo">Directions: <strong>To here</strong> - <a href="javascript:fromhere(' + counter + ')">From here</a></span>' +
                     '<p class="gmapDirItem" id="gmapDirItemTo"><label for="gmapDirSaddr" class="gmapDirLabel" id="gmapDirLabelTo">Start address: (include addr, city st/region)<br /></label>' +
                     '<input type="text" size="40" maxlength="40" name="saddr" class="gmapTextBox" id="gmapDirSaddr" value="" onfocus="this.style.backgroundColor = \'#e0e0e0\';" onblur="this.style.backgroundColor = \'#ffffff\';" />' +
                     '<span class="gmapDirBtns" id="gmapDirBtnsTo"><input value="Get Directions" type="submit" class="gmapDirButton" id="gmapDirButtonTo" /></span></p>' +
                     '<input type="hidden" name="daddr" value="' +
                     point.y + ',' + point.x + "(" + title.replace(new RegExp(/"/g),'&quot;') + ")" + '" /></form>';
                      from_htmls[counter] = html[0].contentElem + '<p /><form class="gmapDir" id="gmapDirFrom" style="white-space: nowrap;" action="http://maps.google.com/maps" method="get" target="_blank">' +
                     '<span class="gmapDirHead" id="gmapDirHeadFrom">Directions: <a href="javascript:tohere(' + counter + ')">To here</a> - <strong>From here</strong></span>' +
                     '<p class="gmapDirItem" id="gmapDirItemFrom"><label for="gmapDirSaddr" class="gmapDirLabel" id="gmapDirLabelFrom">End address: (include addr, city st/region)<br /></label>' +
                     '<input type="text" size="40" maxlength="40" name="daddr" class="gmapTextBox" id="gmapDirSaddr" value="" onfocus="this.style.backgroundColor = \'#e0e0e0\';" onblur="this.style.backgroundColor = \'#ffffff\';" />' +
                     '<span class="gmapDirBtns" id="gmapDirBtnsFrom"><input value="Get Directions" type="submit" class="gmapDirButton" id="gmapDirButtonFrom" /></span></p>' +
                     '<input type="hidden" name="saddr" value="' +
                     point.y + ',' + point.x + encodeURIComponent("(" + title.replace(new RegExp(/"/g),'&quot;') + ")") + '" /></form>';
                     html[0].contentElem = html[0].contentElem + '<p /><div id="gmapDirHead" class="gmapDir" style="white-space: nowrap;">Directions: <a href="javascript:tohere(' + counter + ')">To here</a> - <a href="javascript:fromhere(' + counter + ')">From here</a></div>';
if(!tabFlag) { html = html[0].contentElem; }points[counter] = point;
markers[counter] = marker;
marker_html[counter] = html;
sidebar_html += '<li class="gmapSidebarItem" id="gmapSidebarItem_'+ counter +'"><a href="javascript:click_sidebar(' + counter + ')">' + title + '<\/a><\/li>';
counter++;
return marker;
}
function isArray(a) {return isObject(a) && a.constructor == Array;}
function isObject(a) {return (a && typeof a == 'object') || isFunction(a);}
function isFunction(a) {return typeof a == 'function';}
function click_sidebar(idx) {
  if(isArray(marker_html[idx])) { markers[idx].openInfoWindowTabsHtml(marker_html[idx]); }
  else { markers[idx].openInfoWindowHtml(marker_html[idx]); }
}
function showInfoWindow(idx,html) {
map.centerAtLatLng(points[idx]);
markers[idx].openInfoWindowHtml(html);
}
function tohere(idx) {
markers[idx].openInfoWindowHtml(to_htmls[idx]);
}
function fromhere(idx) {
markers[idx].openInfoWindowHtml(from_htmls[idx]);
}
*/
//]]>
</script>

 	    <!-- necessary for google maps polyline drawing in IE -->
    <style type="text/css">
      v\:* {
        behavior:url(#default#VML);
      }
      #gmapmarker {
       font-size:70%;
       }
    </style>
 <script type="text/javascript" charset="utf-8">
//<![CDATA[
/*
if (GBrowserIsCompatible()) {
document.write('<div id="map" style="width: 100%; height: 500px"><\/div>');
} else {
document.write('<b>Javascript must be enabled in order to use Google Maps.<\/b>');
}
*/
//]]>
</script>
<noscript><b>Javascript must be enabled in order to use Google Maps.</b></noscript>


<br>
This site brought to you by <img src="http://www.vividlogic.ie/images/logo.gif" alt="vivid Logic"  onClick="parent.location='http://www.vividlogic.iel'" height="20px"> and Cork/Kerry SJAI <img src="http://www.ggjump.com/images/uploads/ck_logo.png" style="border: 0;" height="30px" alt="Cork Kerry SJAI" onClick="parent.location='http://homepage.eircom.net/~corkkerrysjai/index.html'" />
</div>

<div id="main">


    <!---------- YUI Dependencies  ------->
     <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/datatable.css">
    <script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/datasource/datasource-beta.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/datatable/datatable-beta.js"></script>



<p>
   

<h2>News Flash</h2>
<table>

   <tr>
     <td>16Apr 11:58</td>
     <td></td>
     <td>Test email to news</td>
   </tr>
<!--
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
         xmlns:trackback="http://madskills.com/public/xml/rss/module/trackback/"
         xmlns:dc="http://purl.org/dc/elements/1.1/">
<rdf:Description
    rdf:about="http://www.ggjump.com/index.php/77/"
    trackback:ping="http://www.ggjump.com/index.php/trackback/77/"
    dc:title="Test email to news"
    dc:identifier="http://www.ggjump.com/index.php/77/" 
    dc:subject=""
    dc:description=""
    dc:creator="Phoebe"
    dc:date="2008-04-16 11:58:07 AM GMT" />
</rdf:RDF>
-->
   <tr>
     <td>16Apr 10:58</td>
     <td>Fermoy Show</td>
     <td>Entries for Grand Prix close 10pm today</td>
   </tr>
<!--
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
         xmlns:trackback="http://madskills.com/public/xml/rss/module/trackback/"
         xmlns:dc="http://purl.org/dc/elements/1.1/">
<rdf:Description
    rdf:about="http://www.ggjump.com/index.php/76/"
    trackback:ping="http://www.ggjump.com/index.php/trackback/76/"
    dc:title="Entries for Grand Prix close 10pm today"
    dc:identifier="http://www.ggjump.com/index.php/76/" 
    dc:subject=""
    dc:description=""
    dc:creator="Phoebe"
    dc:date="2008-04-16 10:58:00 AM GMT" />
</rdf:RDF>
-->
   <tr>
     <td>16Apr 10:45</td>
     <td>Ballindenisk Equestrian Show</td>
     <td>90cm starts earlier - Ring 4 at 12am</td>
   </tr>
<!--
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
         xmlns:trackback="http://madskills.com/public/xml/rss/module/trackback/"
         xmlns:dc="http://purl.org/dc/elements/1.1/">
<rdf:Description
    rdf:about="http://www.ggjump.com/index.php/75/"
    trackback:ping="http://www.ggjump.com/index.php/trackback/75/"
    dc:title="90cm starts earlier &#45; Ring 4 at 12am"
    dc:identifier="http://www.ggjump.com/index.php/75/" 
    dc:subject=""
    dc:description=""
    dc:creator="Phoebe"
    dc:date="2008-04-16 10:45:00 AM GMT" />
</rdf:RDF>
-->
   <tr>
     <td>16Apr 10:27</td>
     <td>Ballindenisk Equestrian Show</td>
     <td>1.10cm is 2 Phase</td>
   </tr>
<!--
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
         xmlns:trackback="http://madskills.com/public/xml/rss/module/trackback/"
         xmlns:dc="http://purl.org/dc/elements/1.1/">
<rdf:Description
    rdf:about="http://www.ggjump.com/index.php/74/"
    trackback:ping="http://www.ggjump.com/index.php/trackback/74/"
    dc:title="1.10cm is 2 Phase"
    dc:identifier="http://www.ggjump.com/index.php/74/" 
    dc:subject=""
    dc:description=""
    dc:creator="Phoebe"
    dc:date="2008-04-16 10:27:00 AM GMT" />
</rdf:RDF>
-->
</table>

<h2>Upcoming Events</h2>






                     <div id="div_eventlist">
                     <table id="eventlist" >
                     <thead>
                     <tr>
                      <th>Show Starts</th><th>Show</th><th>County</th><th>Status</th><th>Notes</th><th>Notify</th>
                      </tr>
                      </thead>
                      <tbody>


 
 

  <tr valign="top">
     <td>20Apr08</td>
    <td><a href="http://www.ggjump.com/index.php/more/ballindenisk_equestrian_show/">Ballindenisk Equestrian Show</a></td>
    <td><p>Cork
</p></td>
    <td><font color="#006633">Running</font></td>
     <td>Status at 15:55 on 20Apr08 is Running - Ground a bit damp
     <a href="http://www.ggjump.com/index.php/more/ballindenisk_equestrian_show/">see details...</a></td>
                        <td></td>
          </tr>


 
 

  <tr valign="top">
     <td>25Apr08</td>
    <td><a href="http://www.ggjump.com/index.php/more/test/">test</a></td>
    <td><p>Carlow
</p></td>
    <td><font color="#009933">None</font></td>
     <td>
     <a href="http://www.ggjump.com/index.php/more/test/">see details...</a></td>
                        <td></td>
          </tr>


 
 

  <tr valign="top">
     <td>26Apr08</td>
    <td><a href="http://www.ggjump.com/index.php/more/louth_county_show/">Louth County Show</a></td>
    <td>Louth</td>
    <td><font color="#009933">None</font></td>
     <td>
     <a href="http://www.ggjump.com/index.php/more/louth_county_show/">see details...</a></td>
                        <td></td>
          </tr>


 
 

  <tr valign="top">
     <td>03May08</td>
    <td><a href="http://www.ggjump.com/index.php/more/claregalway/">Claregalway</a></td>
    <td>Galway</td>
    <td><font color="#009933">None</font></td>
     <td>
     <a href="http://www.ggjump.com/index.php/more/claregalway/">see details...</a></td>
                        <td></td>
          </tr>


 
 

  <tr valign="top">
     <td>04May08</td>
    <td><a href="http://www.ggjump.com/index.php/more/fermoy_show/">Fermoy Show</a></td>
    <td>Cork</td>
    <td><font color="#009933">None</font></td>
     <td>
     <a href="http://www.ggjump.com/index.php/more/fermoy_show/">see details...</a></td>
                        <td></td>
          </tr>


 
 

  <tr valign="top">
     <td>04May08</td>
    <td><a href="http://www.ggjump.com/index.php/more/newmarket_on_fergus/">Newmarket On Fergus</a></td>
    <td>Clare</td>
    <td><font color="#009933">None</font></td>
     <td>
     <a href="http://www.ggjump.com/index.php/more/newmarket_on_fergus/">see details...</a></td>
                        <td></td>
          </tr>


 
 

  <tr valign="top">
     <td>04May08</td>
    <td><a href="http://www.ggjump.com/index.php/more/streamstown_foxhounds_hunt/">Streamstown Foxhounds Hunt</a></td>
    <td>Westmeath</td>
    <td><font color="#009933">None</font></td>
     <td>
     <a href="http://www.ggjump.com/index.php/more/streamstown_foxhounds_hunt/">see details...</a></td>
                        <td></td>
          </tr>


 
 

  <tr valign="top">
     <td>04May08</td>
    <td><a href="http://www.ggjump.com/index.php/more/thomastown_horse_show/">Thomastown Horse Show</a></td>
    <td><p>Kilkenny
</p></td>
    <td><font color="#009933">None</font></td>
     <td>
     <a href="http://www.ggjump.com/index.php/more/thomastown_horse_show/">see details...</a></td>
                        <td></td>
          </tr>


 
 

  <tr valign="top">
     <td>04May08</td>
    <td><a href="http://www.ggjump.com/index.php/more/wexford_sjai/">Wexford SJAI</a></td>
    <td><p>Wexford
</p></td>
    <td><font color="#009933">None</font></td>
     <td>
     <a href="http://www.ggjump.com/index.php/more/wexford_sjai/">see details...</a></td>
                        <td></td>
          </tr>


 
 

  <tr valign="top">
     <td>05May08</td>
    <td><a href="http://www.ggjump.com/index.php/more/kilkenny_amateurs/">Kilkenny Amateurs</a></td>
    <td>Kilkenny</td>
    <td><font color="#009933">None</font></td>
     <td>
     <a href="http://www.ggjump.com/index.php/more/kilkenny_amateurs/">see details...</a></td>
                        <td></td>
          </tr>



</tbody>
                     </table>
                     </div>


            
<script type="text/javascript">

     YAHOO.util.Event.addListener(window, "load", function() {
    YAHOO.example.EnhanceFromMarkup = new function() {
        var myColumnDefs = [{key:"key1",label:"Show Starts",formatter:YAHOO.widget.DataTable.formatSortable},{key:"key2",label:" Show"},{key:"key3",label:" County",sortable:true},{key:"key4",label:" Status"},{key:"key5",label:" Notes"},{key:"key6",label:" Notify"}
        ];

        this.parseNumberFromCurrency = function(sString) {
            // Remove dollar sign and make it a float
            return parseFloat(sString.substring(1));
        };

       YAHOO.util.DataSource.parseSqldate = function (oData) {
              var parts = oData.split(" ");
              var datePart = parts[0].split("-");
              if (parts.length > 1) {
                      var timePart = parts[1].split(":");
                      var dt= new Date(datePart[0],datePart[1]-1,datePart[2],timePart[0],timePart[1],timePart[2]);
              } else {
                      var dt=new Date(datePart[0],datePart[1]-1,datePart[2]);
              }
              
              var sMonth;
                switch(dt.getMonth()+1) {
                     case 1:
                         sMonth = "Jan";
                         break;
                     case 2:
                         sMonth = "Feb";
                         break;
                     case 3:
                         sMonth = "Mar";
                         break;
                     case 4:
                         sMonth = "Apr";
                         break;
                     case 5:
                         sMonth = "May";
                         break;
                     case 6:
                         sMonth = "Jun";
                         break;
                     case 7:
                         sMonth = "Jul";
                         break;
                     case 8:
                         sMonth = "Aug";
                         break;
                     case 9:
                         sMonth = "Sep";
                         break;
                     case 10:
                         sMonth = "Oct";
                         break;
                     case 11:
                         sMonth = "Nov";
                         break;
                     case 12:
                         sMonth = "Dec";
                         break;
                 }

              
               return dt.getDate()  + sMonth + dt.getFullYear();
      };
        

        this.myDataSource = new YAHOO.util.DataSource(YAHOO.util.Dom.get("eventlist"));
        this.myDataSource.responseType = YAHOO.util.DataSource.TYPE_HTMLTABLE;
        this.myDataSource.responseSchema = {
            fields: [{key:"key1", parser:YAHOO.util.DataSource.parseSortable},{key:"key2"},{key:"key3"},{key:"key4"},{key:"key5"},{key:"key6"}
            ]
        };

        this.myDataTable = new YAHOO.widget.DataTable("div_eventlist", myColumnDefs, this.myDataSource,
        {                caption:"Upcoming Events",    paginated:false, 
	
                });
                
        };
        

});
</script>


 
       </form>

<a href="http://www.ggjump.com/index.php/site/eventlist/">Full Calendar of Events...</a>



</div>  <!-- main -->



<div id="sidebar1" >


<h3>News</h3>

 <h4>Ready for initial testing!</h4>
<p>Please register and have a play with the site, it should work! The designer is working on major improvements to the way the site looks and works and this should be in by the end of next week.&nbsp; Let me know if you have any problems by adding a comment below. Phoebe.
</p>
<small><a href="http://www.ggjump.com/index.php/site/comments/ready_for_initial_testing">See (0) Comments or add your own...</a></small>
<!--
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
         xmlns:trackback="http://madskills.com/public/xml/rss/module/trackback/"
         xmlns:dc="http://purl.org/dc/elements/1.1/">
<rdf:Description
    rdf:about="http://www.ggjump.com/index.php/78/"
    trackback:ping="http://www.ggjump.com/index.php/trackback/78/"
    dc:title="Ready for initial testing!"
    dc:identifier="http://www.ggjump.com/index.php/78/" 
    dc:subject=""
    dc:description=""
    dc:creator="Phoebe"
    dc:date="2008-04-17 02:33:00 PM GMT" />
</rdf:RDF>
-->
 <h4>Nearly ready for Testing</h4>
<p>Just needs a bit more tweaking&#8230;
</p>
<small><a href="http://www.ggjump.com/index.php/site/comments/nearly_ready_for_testing">See (0) Comments or add your own...</a></small>
<!--
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
         xmlns:trackback="http://madskills.com/public/xml/rss/module/trackback/"
         xmlns:dc="http://purl.org/dc/elements/1.1/">
<rdf:Description
    rdf:about="http://www.ggjump.com/index.php/73/"
    trackback:ping="http://www.ggjump.com/index.php/trackback/73/"
    dc:title="Nearly ready for Testing"
    dc:identifier="http://www.ggjump.com/index.php/73/" 
    dc:subject=""
    dc:description=""
    dc:creator="Phoebe"
    dc:date="2008-04-16 10:18:01 AM GMT" />
</rdf:RDF>
-->
 <h4>GGJump looking for site sponsor</h4>
<p>If you want your companies logo to appear on every page of this website, give us a call&#8230;
</p>
<small><a href="http://www.ggjump.com/index.php/site/comments/ggjump_looking_for_site_sponsor1">See (0) Comments or add your own...</a></small>
<!--
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
         xmlns:trackback="http://madskills.com/public/xml/rss/module/trackback/"
         xmlns:dc="http://purl.org/dc/elements/1.1/">
<rdf:Description
    rdf:about="http://www.ggjump.com/index.php/71/"
    trackback:ping="http://www.ggjump.com/index.php/trackback/71/"
    dc:title="GGJump looking for site sponsor"
    dc:identifier="http://www.ggjump.com/index.php/71/" 
    dc:subject=""
    dc:description=""
    dc:creator="Phoebe"
    dc:date="2008-04-16 10:13:00 AM GMT" />
</rdf:RDF>
-->
 <h4>GGJump looking for site sponsor</h4>
<p>If you want your companies logo to appear on every page of this website, give us a call&#8230;
</p>
<small><a href="http://www.ggjump.com/index.php/site/comments/ggjump_looking_for_site_sponsor2">See (0) Comments or add your own...</a></small>
<!--
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
         xmlns:trackback="http://madskills.com/public/xml/rss/module/trackback/"
         xmlns:dc="http://purl.org/dc/elements/1.1/">
<rdf:Description
    rdf:about="http://www.ggjump.com/index.php/72/"
    trackback:ping="http://www.ggjump.com/index.php/trackback/72/"
    dc:title="GGJump looking for site sponsor"
    dc:identifier="http://www.ggjump.com/index.php/72/" 
    dc:subject=""
    dc:description=""
    dc:creator="Phoebe"
    dc:date="2008-04-16 10:13:00 AM GMT" />
</rdf:RDF>
-->


<h3>Recent Events</h3>
<table>

 

  <tr valign="top">
     <td>13Apr08</td>
    <td><a href="http://www.ggjump.com/index.php/archive/seaview_amateur_charity_show/">Seaview Amateur Charity Show</a></td>
    </tr>


 

  <tr valign="top">
     <td>05Apr08</td>
    <td><a href="http://www.ggjump.com/index.php/archive/riverview_spring_league/">Riverview Spring League</a></td>
    </tr>


 

  <tr valign="top">
     <td>01Apr08</td>
    <td><a href="http://www.ggjump.com/index.php/archive/ross_house_equestrian_centre_spring_league/">Ross House Equestrian Centre Spring League</a></td>
    </tr>


 

  <tr valign="top">
     <td>29Mar08</td>
    <td><a href="http://www.ggjump.com/index.php/archive/cork_kerry_at_maryville/">Cork/Kerry at Maryville</a></td>
    </tr>


 

  <tr valign="top">
     <td>23Mar08</td>
    <td><a href="http://www.ggjump.com/index.php/archive/west_cork_equine_centre_spring_league/">West Cork Equine Centre Spring League</a></td>
    </tr>


 

  <tr valign="top">
     <td>19Jan08</td>
    <td><a href="http://www.ggjump.com/index.php/archive/first_jump_of_the_year/">First jump  of the year</a></td>
    </tr>


 

  <tr valign="top">
     <td>24Aug07</td>
    <td><a href="http://www.ggjump.com/index.php/archive/sjai_national_pony_young_riders_championships/">SJAI National Pony &amp; Young Riders Championships</a></td>
    </tr>


</table>

<div id="photolist">
  <h3>Event Photos</h3>
  <table>
  
        
        
        
        
            <tr>
        <td>23Mar08</td>
        <td><a href="<p>http://www.travelpublishing.co.uk/countrylivingireland/Cork/CLI28232.htm
</p>">West Cork Equine Centre Spring League</a><td>
      </tr>
      
        
        
        
        
            <tr>
        <td>09Aug07</td>
        <td><a href="www.oaktreepix.com">Outdoor Amateur Championships</a><td>
      </tr>
      
            <tr>
        <td>09Aug07</td>
        <td><a href="<p>http://www.oaktreepix.com
</p>">Newcastle West Show</a><td>
      </tr>
      
        
        
            <tr>
        <td>18Jul07</td>
        <td><a href="www.oaktreepix.com">Limerick Pony club Area Qualifier</a><td>
      </tr>
      
            <tr>
        <td>20Jun07</td>
        <td><a href="http://www.sportingireland.com/">Belgooly Show 2007</a><td>
      </tr>
      
</table>

</div> <!-- photoloist -->

</div>  <!-- sidebar1 -->





</div> <!-- wrapper -->  
	
</body>
</html>


<script>
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    Event.onDOMReady(function() {
        var wrapHeight = Dom.get('wrapper').offsetHeight,
            layout = new YAHOO.widget.Layout('wrapper', {
            height: wrapHeight,
            units: [
                { position: 'top',body:'banner', height:160},
                { position: 'left',body:'sidebar2', width:220, header:'Plan'},
                { position: 'center',body:'main',  header:'Get Latest Details'},
                { position: 'right',body:'sidebar1', width:220, header:'News & Results'},           
           ]
        });
        layout.on('resize', function() {
            var wrapHeight = Dom.get('wrapper').offsetHeight;
            layout.set('height', wrapHeight);
        });
        layout.render();
    });
})();
</script>
