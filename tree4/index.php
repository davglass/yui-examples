<html dir="ltr">
<head>
<title>Managed Objects - Chart</title>
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<link rel="Shortcut Icon" href="/html/themes/managedobjects/images/liferay.ico" />
<link href="/c/portal/css_cached?themeId=managedobjects&colorSchemeId=01" type="text/css" rel="stylesheet" />
<link href="/html/js/calendar/skins/aqua/theme.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#layout-inner-side-decoration {
width: 1004px;
background-image: url('/html/themes/managedobjects/images/logo.gif');
background-repeat: no-repeat;
background-attachment: scroll;
background-position: 30px 99%;
}
#layout-box {
width: 984px;
}
</style>
<script type="text/javascript">
var themeDisplay = {
getDoAsUserIdEncoded : function() {
// Use Java to encode the encrypted user id because IE doesn't
// properly encode with encodeURIComponent. It leaves a '+' as a '+'
// whereas Firefox correctly encodes a '+' to '%2B'.
return "";
},
getPathMain : function() {
return "/c";
},
getPathThemeImage : function() {
return "/html/themes/managedobjects/images";
},
getPathThemeRoot : function() {
return "/html/themes/managedobjects";
},
getURLHome : function() {
return "http://localhost:8080";
}
};
var mainPath = themeDisplay.getPathMain();
</script>
<script src="/html/js/prototype.js" type="text/javascript"></script>
<script src="/html/js/json.js" type="text/javascript"></script>
<script src="/html/js/sniffer.js" type="text/javascript"></script>
<script src="/html/js/util.js" type="text/javascript"></script>
<script src="/html/js/portal.js" type="text/javascript"></script>
<script src="/html/js/ajax.js" type="text/javascript"></script>
<script src="/html/js/alerts.js" type="text/javascript"></script>
<script src="/html/js/swfobject.js" type="text/javascript"></script>
<script src="/html/js/calendar/calendar_stripped.js" type="text/javascript"></script>
<script src="/html/js/calendar/calendar-setup_stripped.js" type="text/javascript"></script>
<script src="/html/js/colorpicker/colorpicker.js" type="text/javascript"></script>
<script src="/html/js/dragdrop/coordinates.js" type="text/javascript"></script>
<script src="/html/js/dragdrop/drag.js" type="text/javascript"></script>
<script src="/html/js/dragdrop/dragdropzone.js" type="text/javascript"></script>
<script src="/html/js/dragdrop/resize.js" type="text/javascript"></script>
<script src="/html/js/portlet/layout_configuration.js" type="text/javascript"></script>
<script src="/html/js/portlet/messaging.js" type="text/javascript"></script>
<script type="text/javascript" src="/c/portal/javascript_cached?themeId=managedobjects&languageId=en_US&colorSchemeId=01"></script>
<script type="text/javascript">
function showLayoutTemplates() {
var message = Alerts.fireMessageBox(
{
width: 700,
modal: true,
title: "\u004c\u0061\u0079\u006f\u0075\u0074"
});
url = "/c/layout_configuration/templates?p_l_id=PRI.15.6&doAsUserId=";
AjaxUtil.update(url, message);
}
function showPageSettings() {
var url = "http://swapnil:8080/c/portal/layout?p_l_id=PRI.15.6&p_p_id=88&p_p_action=0&p_p_state=maximized&p_p_mode=view&p_p_col_id=null&p_p_col_pos=0&p_p_col_count=1&_88_struts_action=%2Flayout_management%2Fedit_pages&_88_tabs2=private&_88_groupId=15&_88_selPlid=PRI.15.6";
url = url.replace(/\b=maximized\b/,"=pop_up");
var message = Alerts.popupIframe(
url,
{
width: 700,
modal: true,
title: '\u0050\u0061\u0067\u0065\u0020\u0053\u0065\u0074\u0074\u0069\u006e\u0067\u0073',
onClose:
function() {
window.location.reload(false);
}
});
}
Event.observe(window, "load", function() {
Messaging.init("admin");
});
if (!is_safari) {
Event.observe(window, "load", function() {
setTimeout("ReverseAjax.initialize()", 2000);
});
Event.addHandler(window, "unload", function() {
ReverseAjax.release();
});
}
var LogFactory = {
getLog : function(name) {
return new LogFactory.DummyLogger();
},
DummyLogger : function () {
this.trace = function(message, exception) {};
this.debug = function(message, exception) {};
this.info = function(message, exception) {};
this.warn = function(message, exception) {};
this.error = function(message, exception) {};
this.fatal = function(message, exception) {};
}
}</script><script> djConfig = { parseWidgets: false, searchIds: [] }; </script>
<script src="/ManagedObjectsPortlets/managedobjects/dojo/js/dojo.js" type="text/javascript"></script> 
<script src="/ManagedObjectsPortlets/managedobjects/yui/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
<script src="/ManagedObjectsPortlets/managedobjects/yui/utilities/utilities.js" type="text/javascript"></script>
<script src="/ManagedObjectsPortlets/managedobjects/yui/connection/connection-min.js" type="text/javascript"></script>
<script src="/ManagedObjectsPortlets/managedobjects/yui/animation/animation-min.js" type="text/javascript"></script>
<script src="/ManagedObjectsPortlets/managedobjects/yui/autocomplete/autocomplete-min.js" type="text/javascript"></script>
<script src="/ManagedObjectsPortlets/managedobjects/yui/element/element-beta-min.js" type="text/javascript"></script>  
<script src="/ManagedObjectsPortlets/managedobjects/yui/datasource/datasource-beta-min.js" type="text/javascript"></script>  
<script src="/ManagedObjectsPortlets/managedobjects/yui/dragdrop/dragdrop-min.js" type="text/javascript"></script>  
<script src="/ManagedObjectsPortlets/managedobjects/yui/calendar/calendar-min.js" type="text/javascript"></script>  
<script src="/ManagedObjectsPortlets/managedobjects/yui/datatable/datatable-beta-min.js" type="text/javascript"></script>  
<script src="/ManagedObjectsPortlets/managedobjects/yui/container/container-min.js" type="text/javascript"></script>  
<script src="/ManagedObjectsPortlets/managedobjects/yui/treeview/treeview-min.js" type="text/javascript"></script>  
<link type="text/css" rel="stylesheet" href="/ManagedObjectsPortlets/managedobjects/yui/assets/skins/sam/skin.css" />
<script src="/ManagedObjectsPortlets/managedobjects/js/moJavaScript.js" type="text/javascript"></script>
<script src="/ManagedObjectsPortlets/managedobjects/js/alerts.js" type="text/javascript"></script>
<script src="/ManagedObjectsPortlets/managedobjects/js/svgcheck.js" type="text/javascript"></script>
<script src="/ManagedObjectsPortlets/managedobjects/js/svgcheck.vbs" type="text/vbscript"></script>
<link href="/html/common/themes/mocolors.jsp" type="text/css" rel="stylesheet" />
<link href="/ManagedObjectsPortlets/managedobjects/html/portlet/common/css_static.css" type="text/css" rel="stylesheet" />
</head>
<body id="portal-body">
<div id="layout-outer-side-decoration" style="z-index: 0">
<div id="layout-inner-side-decoration">
<div style="position: relative; z-index: 4;">
<table cellpadding="0" cellspacing="0" border="0" id="portal-dock-title" style="z-index: 2">
<tr>
<td>
<div class="portal-dock-help" id="portal-dock-text">
Welcome Default Administrator!</div>
<div class="portal-dock-help" id="portal-dock-my-places" style="display: none">
<div id="p_p_id_49_" class="portlet-boundary portlet-boundary_49_">
<a name="p_49"></a>
<table border="0" cellspacing="0" cellpadding="0" onclick="MyPlaces.show();">
<tr>
<td class="layout-my-places">
Default Administrator (Private)</td>
<td class="layout-my-places-arrow">
<img style="vertical-align: middle" src="/html/themes/managedobjects/images/arrows/01_down.gif" />
</td>
</tr>
</table>
<ul id="layout-my-places-menu" style="display: none">
<li onmouseover="this.style.backgroundColor='#cccccc'" onmouseout="this.style.backgroundColor='transparent'" onclick="window.location='http://swapnil:8080/c/portal/layout?p_l_id=PRI.15.6&p_p_id=49&p_p_action=1&p_p_state=normal&p_p_mode=view&p_p_col_id=&p_p_col_pos=0&p_p_col_count=0&_49_struts_action=%2Fmy_places%2Fview&_49_ownerId=PUB.1'">Guest (Public)</li>
<li onmouseover="this.style.backgroundColor='#cccccc'" onmouseout="this.style.backgroundColor='transparent'" onclick="window.location='http://swapnil:8080/c/portal/layout?p_l_id=PRI.15.6&p_p_id=49&p_p_action=1&p_p_state=normal&p_p_mode=view&p_p_col_id=&p_p_col_pos=0&p_p_col_count=0&_49_struts_action=%2Fmy_places%2Fview&_49_ownerId=PRI.2'">CMS (Private)</li>
<li onmouseover="this.style.backgroundColor='#cccccc'" onmouseout="this.style.backgroundColor='transparent'" onclick="window.location='http://swapnil:8080/c/portal/layout?p_l_id=PRI.15.6&p_p_id=49&p_p_action=1&p_p_state=normal&p_p_mode=view&p_p_col_id=&p_p_col_pos=0&p_p_col_count=0&_49_struts_action=%2Fmy_places%2Fview&_49_ownerId=PRI.3'">Support (Private)</li>
</ul>
<script type="text/javascript">
var MyPlaces = {
showing: false,
show: function() {
if (!MyPlaces.showing) {
$("layout-my-places-menu").style.display = "";
setTimeout("document.onclick = function() { MyPlaces.hide(); }", 0);
MyPlaces.showing = true;
}
},
hide: function() {
$("layout-my-places-menu").style.display = "none";
MyPlaces.showing = false;
document.onclick = function() {};
}
}
</script>
</div>
<script type="text/javascript">
$("p_p_id_49_").portletId = "49";
$("p_p_id_49_").isStatic = "end";
</script>
</div>
<div clsss="portal-dock-help" id="portal-dock-search" style="display: none">
<form action="http://swapnil:8080/c/portal/layout?p_l_id=PRI.15.6&p_p_id=77&p_p_action=0&p_p_state=maximized&p_p_mode=view&p_p_col_id=null&p_p_col_pos=0&p_p_col_count=0&_77_struts_action=%2Fjournal_content_search%2Fsearch" method="post" name="_77_fm" onSubmit="submitForm(this); return false;">
<input class="form-text" name="_77_keywords" size="30" type="text" value="Search..." onBlur="if (this.value == '') { this.value = '\u0053\u0065\u0061\u0072\u0063\u0068\u002e\u002e\u002e'; }" onFocus="if (this.value == '\u0053\u0065\u0061\u0072\u0063\u0068\u002e\u002e\u002e') { this.value = ''; }">
<input align="absmiddle" border="0" src="/html/themes/managedobjects/images/common/search.gif" title="Search" type="image"></form></div>
</td>
</tr>
</table>
<div id="portal-dock" style="position: absolute; z-index: 1;">
<div class="portal-dock-box"
 onmouseover="LiferayDock.showText('\u0057\u0065\u006c\u0063\u006f\u006d\u0065\u0020\u0044\u0065\u0066\u0061\u0075\u006c\u0074\u0020\u0041\u0064\u006d\u0069\u006e\u0069\u0073\u0074\u0072\u0061\u0074\u006f\u0072\u0021')">
 <div style="
background-image: url(/html/themes/managedobjects/images/dock/icons_nav_main.png);
height: 50px; width: 50px;"></div></div>
<div class="portal-dock-box"
 onmouseover="LiferayDock.showObject('portal-dock-my-places', 10)">
 <div style="
background-image: url(/html/themes/managedobjects/images/dock/icons_nav_myPlaces.png);
height: 50px; width: 50px;"></div></div>
<div class="portal-dock-box"
 onclick="window.location='/c/portal/logout'"
 onmouseover="LiferayDock.showText('\u0053\u0069\u0067\u006e\u0020\u004f\u0075\u0074')">
 <div style="
background-image: url(/html/themes/managedobjects/images/dock/icons_nav_logout.png);
height: 50px; width: 50px;"></div></div>
<div class="portal-dock-box"
 onclick="window.location='http://localhost:8080'"
 onmouseover="LiferayDock.showText('\u0048\u006f\u006d\u0065')">
 <div style="
background-image: url(/html/themes/managedobjects/images/dock/icons_nav_home.png);
height: 50px; width: 50px;"></div></div>
<div class="portal-dock-box"
 onclick=""
 onmouseover="LiferayDock.showObject('portal-dock-search', 10); $('portal-dock-search').getElementsByTagName('input')[0].focus()">
 <div style="
background-image: url(/html/themes/managedobjects/images/dock/icons_nav_search.png);
height: 50px; width: 50px;"></div></div>
<div class="portal-dock-box"
 onclick="showLayoutTemplates()"
 onmouseover="LiferayDock.showText('\u004c\u0061\u0079\u006f\u0075\u0074')">
 <div style="
background-image: url(/html/themes/managedobjects/images/dock/icons_nav_layout.png);
height: 50px; width: 50px;"></div></div>
<div class="portal-dock-box"
 onclick="window.location='http://swapnil:8080/c/portal/layout?p_l_id=PRI.15.6&p_p_id=2&p_p_action=0&p_p_state=maximized&p_p_mode=view&p_p_col_id=null&p_p_col_pos=0&p_p_col_count=0&_2_struts_action=%2Fmy_account%2Fedit_user'"
 onmouseover="LiferayDock.showText('\u004d\u0079\u0020\u0041\u0063\u0063\u006f\u0075\u006e\u0074')">
 <div style="
background-image: url(/html/themes/managedobjects/images/dock/icons_nav_myAccount.png);
height: 50px; width: 50px;"></div></div>
<div class="portal-dock-box"
 onclick="LayoutConfiguration.toggle('PRI.15.6', '87', '');"
 onmouseover="LiferayDock.showText('\u0041\u0064\u0064\u0020\u0043\u006f\u006e\u0074\u0065\u006e\u0074')">
 <div style="
background-image: url(/html/themes/managedobjects/images/dock/icons_nav_addContent.png);
height: 50px; width: 50px;"></div></div>
<div class="portal-dock-box"
 onclick="showPageSettings()"
 onmouseover="LiferayDock.showText('\u0050\u0061\u0067\u0065\u0020\u0053\u0065\u0074\u0074\u0069\u006e\u0067\u0073')">
 <div style="
background-image: url(/html/themes/managedobjects/images/dock/icons_nav_pageSettings.png);
height: 50px; width: 50px;"></div></div>
</div>
</div>
<script type="text/javascript">
LiferayDock.initialize("\u0057\u0065\u006c\u0063\u006f\u006d\u0065\u0020\u0044\u0065\u0066\u0061\u0075\u006c\u0074\u0020\u0041\u0064\u006d\u0069\u006e\u0069\u0073\u0074\u0072\u0061\u0074\u006f\u0072\u0021");
</script>
<div id="layout-box">
<table border="0" cellspacing="0" cellpadding="0" width="100%" id="layout-top-banner">
<tr>
<td id="top-left" width="35%" valign="middle" align="center">
<a href="http://localhost:8080"><img src="/image/company_logo?img_id=managedobjects.com"></a>
</td>
<td id="top-right">
<img src="/html/themes/managedobjects/images/background_middle.gif" vspace="0" hspace="0" border="0" />
</td>
</tr>
</table><div id="layout-nav-container">
<div id="layout-tab-selected" class="layout-tab">
<div class="layout-tab-text"><span id="layout-tab-text-edit">Chart</span></div>
</div>
<div class="layout-tab">
<div class="layout-tab-text"><a href="/c/portal/layout?p_l_id=PRI.15.2" >myHome</a></div>
</div>
<div class="layout-tab">
<div class="layout-tab-text"><a href="/c/portal/layout?p_l_id=PRI.15.4" >myFinances</a></div>
</div>
<div class="layout-tab">
<div class="layout-tab-text"><a href="/c/portal/layout?p_l_id=PRI.15.5" >myCommunites</a></div>
</div>
<div class="layout-tab">
<div class="layout-tab-text"><a href="/c/portal/layout?p_l_id=PRI.15.3" >Administration</a></div>
</div>
<div id="layout-tab-add">
<div class="layout-tab-text"><a href="javascript: Navigation.addPage()">Add Page</a></div>
</div>
</div>
<div id="layout-nav-divider" class="layout-nav-selected"></div>
<script type="text/javascript">
Navigation.init({
groupId: "15",
language: "en_US",
layoutId: "6",
newPage: false,
ownerId: "PRI.15",
isPrivate: true,
parent: "-1",
layoutIds: [6,2,4,5,3],
hiddenIds: []
});
</script>
<div id="layout-content-outer-decoration">
<div id="layout-content-inner-decoration">
<div id="layout-content-container">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td valign="top" width="29%">
<div id="layout-column_column-1"></div>
</td>
<td class="layout-column-spacer" width="1%">
<div>&nbsp;</div>
</td>
<td valign="top" width="70%">
<div id="layout-column_column-2">
<div id="p_p_id_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_" class="portlet-boundary portlet-boundary_mo_chartBuilder_WAR_ManagedObjectsPortlets_">
<a name="p_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph"></a>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td class="portlet-shadow-tl"><div></div></td>
<td class="portlet-shadow-tc" width="100%"></td>
<td class="portlet-shadow-tr"><div></div></td>
</tr>
<tr>
<td class="portlet-shadow-ml">
</td>
<td width="100%">
<div class="portlet-container">
<div class="portlet-header-bar" id="portlet-header-bar_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph"
>
<div class="portlet-wrap-title">
<span class="portlet-title" id="portlet-title-bar_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph">Chart Builder Portlet</span>
</div>
<script type="text/javascript">
QuickEdit.create("portlet-title-bar_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph", {
dragId: $("p_p_id_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_").isStatic == "no" ? "p_p_id_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_" : null,
onEdit:
function(input, textWidth) {
input.style.width = (textWidth) + "px";
input.style.margin = "1px 0 0 5px";
},
onComplete:
function(newTextObj, oldText) {
var newText = newTextObj.innerHTML;
if (oldText != newText) {
var url = "/c/portlet_configuration/update_title" +
"?doAsUserId=" +
"&layoutId=6" +
"&ownerId=PRI.15" +
"&portletId=mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph" +
"&title=" + encodeURIComponent(newText);
AjaxUtil.request(url);
}
}
});
</script>
<div class="portlet-small-icon-bar" style="display: block;">
<a href="http://swapnil:8080/c/portal/layout?p_l_id=PRI.15.6&p_p_id=mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph&p_p_action=0&p_p_state=normal&p_p_mode=view&p_p_col_id=column-2&p_p_col_pos=0&p_p_col_count=1&" target="_self"><img align="absmiddle" border="0" src="/html/themes/managedobjects/images/common/../portlet/back.gif" title="Back" /></a></div>
</div><div class="portlet-box">
<div class="portlet-minimum-height">
<div id="p_p_body_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph" >
    		    <div class="slide-maximize-reference"><div id="p_p_content_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_" style="margin-top: 0; margin-bottom: 0;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td style="padding: 4px 8px 10px 8px;">
<div id="_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph__indicator" class="indicator"></div><div id="_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph__editor">
<ul class="gamma-tab"><li class="current"
id="edit_tab_chartBuilder__mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_">
<a href="http://swapnil:8080/c/portal/layout?p_l_id=PRI.15.6&p_p_id=mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph&p_p_action=0&p_p_state=maximized&p_p_mode=edit&p_p_col_id=column-2&p_p_col_pos=0&p_p_col_count=1&_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_topTab=chartBuilder__mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_"> Chart Builder</a>
</li>
<li 
id="edit_tab_elementSelector__mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_">
<a href="http://swapnil:8080/c/portal/layout?p_l_id=PRI.15.6&p_p_id=mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph&p_p_action=0&p_p_state=maximized&p_p_mode=edit&p_p_col_id=column-2&p_p_col_pos=0&p_p_col_count=1&_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_topTab=elementSelector__mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_"> Elements</a>
</li>
<li 
id="edit_tab_advanced">
<a href="http://swapnil:8080/c/portal/layout?p_l_id=PRI.15.6&p_p_id=mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph&p_p_action=0&p_p_state=maximized&p_p_mode=edit&p_p_col_id=column-2&p_p_col_pos=0&p_p_col_count=1&_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_topTab=advanced"> Advanced</a>
</li>
</div><script type="text/javascript">
function showHide_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_(_myObj,_action) {
    var _myTableObj = document.getElementById((_myObj.parentNode.id).substring(0,(_myObj.parentNode.id).indexOf('_')));
    if (_action == 'show') {
        _myTableObj.style.display = 'block';
        _myObj.parentNode.innerHTML = '<a href="#" onclick="showHide_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_(this,\'hide\');">Unmanage</a>';
        _myObj.focus();
    }
    if (_action == 'hide') {
        _myTableObj.style.display = 'none';
        _myObj.parentNode.innerHTML = '<a href="#" onclick="showHide_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_(this,\'show\');">Manage</a>';
        _myObj.focus();
    }
}
</script>
file 
Your current settings are to display the <b></b> file named <b></b>.
<br />
<br />
<script language="JavaScript">	
   function validate_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_( form, element, message ) {
      if (form[element].value == null || form[element].value == "") {
         alert( message );
      }
      else {
       //  form.submit();
        manageContent_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_.Dialogs.AddManageDialog.submitName(form,'upload');
      }
   } 
   
   function doDelete_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_( form, count ) {
      if (count > -1) {
         form['num_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_'].value = count;
         if (confirm("Are you sure you want to undeploy and delete the selected chart templates?")) {
            //form.submit();
            manageContent_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_.Dialogs.AddManageDialog.submitName(form,'delete');
         }
      }
      else {
         alert( "No chart templates have been selected for undeployment." );
      }
   }
   function changeTemplate_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_( file ) {
      document.editor_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_['chartBuilder__mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph__actionName'].value = getType_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_( file );
      document.editor_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_.submit();
   }
   function getType_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_( file ) {
      var _type;
      if (file.options[file.selectedIndex].value != null && 
             file.options[file.selectedIndex].value.length > 6) {
         if (file.options[file.selectedIndex].value.lastIndexOf(".pcxml") == 
                file.options[file.selectedIndex].value.length - 6) {
            _type = "pcxml";
         }
         else {
            _type = "template";
         }
      }
      else {
         _type = "template";
      }
      return _type;
   }
   function performMerge_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_( file ) {
      document.editor_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_['performAction_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_'].value = getType_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_( file );
      document.editor_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_['mergeAction_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_'].value = 'on';
      document.editor_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_.submit();
   }
   
   function performSave_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_( file ) {
      document.editor_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_['performAction_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_'].value = getType_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_( file );
      document.editor_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_.submit();
   }
</script>
<div id="_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph__chartBuilderEditor">
<form name="editor_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_" action="http://swapnil:8080/c/portal/layout?p_l_id=PRI.15.6&p_p_id=mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph&p_p_action=1&p_p_state=normal&p_p_mode=edit&p_p_col_id=column-2&p_p_col_pos=0&p_p_col_count=1&" method="POST">
  <table>
  	<tr>
        <td>
           <b>Select what you would like to display for this portlet.</b>
           <br />
           <br />
        </td>
    </tr>
<tr>
<td>
<table>
<tr>
<td>
Select Template File:</td>
<td>
<select id="_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph__actionName" class="portlet-form-text"
name="chartBuilder__mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph__actionName" onChange="javascript:changeTemplate_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_( document.editor_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_['chartBuilder__mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph__actionName'] );">
<option
>
childElementBarAlarms.jsp</option>
<option
>
elementBarAlarms.jsp</option>
<option
>
elementPieAlarms.jsp</option>
<option
>
mapDrillDown.jsp</option>
<option
>
radarAndPieAlarms.jsp</option>
<option
>
slaStatus.jsp</option>
<option value="--">-----------------------</option><option
>
childElementBarAlarms.pcxml</option>
<option
>
elementBarAlarms.pcxml</option>
<option
>
slaStatus.pcxml</option>
</select>
</td>
</tr>			
<tr>
<td>Chart Width:</td>
<td><input class="portlet-form-text" type="text" name="chartBuilder__mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph__width" value="330" /></td>
</tr>
<tr>
<td>Chart Height:</td>
<td><input class="portlet-form-text" type="text" name="chartBuilder__mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph__height" value="540" /></td>
</tr>
<tr>
<td>Chart Output:</td>
<td>
<select id="_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph__output" class="portlet-form-text" 
name="chartBuilder__mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph__output>">
<option selected="selected"  value = "FLASH">
FLASH<option   value = "JPEG">
JPEG<option   value = "SVG">
SVG<option   value = "PNG">
PNG</select>
</td>
</tr>
</table>
</td>
</tr>
<tr>
         <td>
            <br /><input type="hidden" name="chartBuilder__mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph__chartBuilder" value="true" />
            		<input type="hidden" name="action" value="save" />
<input class="portlet-form-button" type="submit" value="Save"><table>
  <tr>
      <td>
      <button onclick="manageContent_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_.Dialogs.AddManageDialog.start(); return false;">
Manage...
</button>
</td>
<td>
<a href = "#" onClick="manageContent_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_.Dialogs.AddTreeDialog.start(); return false;"> Browse </a>
</td>
   </tr>
       </table>
       </td>
  	</tr>	
 </table>      
  </form>	
 </div>
 <div class= "yui-skin-sam">
   <div id="addManagePanel_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_">
   <div class="hd">Wizard: Manage Templates</div>
   <div class="bd">
      <div id="addManagePanelBody_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_"></div>
   </div>
</div>
</div>
<div class= "yui-skin-sam">
   <div id="addTreePanel_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_">
   <div class="hd">Select Element</div>
   <div class="bd">
      <div id="addTreePanelBody_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_">
      	<div id="MOElementTree_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_"></div>
      </div>
   </div>
</div>
</div>
<!-- <div class="yui-skin-sam" id="MOElementTree_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_"></div>-->
<script language="JavaScript">
manageContent_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_ = {
Dialogs : {		
    create : function() {
       this.init();
     },
         
init : function() {
   this.AddManageDialog.init();
 },
 AddTreeDialog : {
   
   	panel : new YAHOO.widget.Panel("addTreePanel_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_",
       	{
    width:550,
    close:true,
    visible:false,
    draggable:true,
    modal:true,			   
}),
   
   start : function() {
      	//this.clear();
//	this.firstPage();
this.panel.render();
this.panel.center();
this.panel.show(); 
this.panel.bringToTop();
//this.panel.cfg.queueProperty("visible","true");
    },	
    clear : function() {
    	MOJS.getById("addTreePanelBody_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_").innerHTML = "";
     },
     
      firstPage : function() { 
     	 //MOJS.loadUrlFromId('addTreePanelBody_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_',
     	 //'/ManagedObjectsPortlets/managedobjects/action/chartBuilder/manager?action=dialog&type=tree&namespace=_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_&date=1194968098277',
     	 //'empty', false, false, 'addTreePanelBody_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_'  ); 
      },
   
   },
    AddManageDialog : {
    
       panel : new YAHOO.widget.Panel("addManagePanel_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_",
       	{
    width:550,
    close:true,
    visible:false,
    draggable:true,
    modal:true,			   
}),
removeDialog : new YAHOO.widget.Dialog("removeTemplate_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_", 
 {
  width:370, 
  modal:true, 
  effect:  
     {
effect:YAHOO.widget.ContainerEffect.FADE,
duration:0.25
     }
        }),
      start : function() {
      	//this.clear();
this.firstPage();
this.panel.render();
this.panel.center();
this.panel.show(); 
this.panel.bringToTop();
//this.panel.cfg.queueProperty("visible","true");
    },	
    clear : function() {
    	MOJS.getById("addManagePanelBody_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_").innerHTML = "";
     },
     
     firstPage : function() { 
        this.openPage( '/ManagedObjectsPortlets/managedobjects/action/chartBuilder/manager?action=dialog&type=manage&namespace=_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_&date=1194968098277' );
     	   	/*MOJS.loadUrlFromId('addManagePanelBody_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_',
     	 	'/ManagedObjectsPortlets/managedobjects/action/chartBuilder/manager?action=dialog&type=manage&namespace=_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_&date=1194968098277',
     	 	'empty', false, false, 'addManagePanelBody_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_'  ); */
   		},
       
    openPage : function(link) {
      MO.globals.extendSession();
  AjaxUtil.update( link, MOJS.getById("addManagePanelBody_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_") );            
},
       
init : function() {
   var myButtons =
      [ { text:"Submit", handler:this.handleSubmit, isDefault:true },
      	{ text:"Cancel", handler:this.handleCancel } ];
   
  this.removeDialog.cfg.queueProperty("buttons", myButtons);
  this.removeDialog.cfg.queueProperty("postmethod", "asynch");
  this.removeDialog.cfg.queueProperty("visible", false);
  //this.removeDialog.callback.success = this.onManageSucessHandler;
 // this.removeDialog.callback.failure = this.onManageFailureHandler;
      },
      
      
      handleCancel : function(){
     	this.cancel();
      },
           Connect : YAHOO.util.Connect,
            
            submitName : function( oForm, type ) {
            
               var sMethod = 
                 (oForm.getAttribute("method") || "POST").toUpperCase();
if (type == 'upload')
                YAHOO.util.Connect.setForm(oForm, true, false);
            else if (type == 'delete')
            	 YAHOO.util.Connect.setForm(oForm, false, false);
   
   				
   				   
                var saveCallback = {
                
                       
                  success : function(o) { 
                     MO.globals.popups.hideWorkingMsg();
                     MO.globals.popups.showMsg(
                        "Sucess", 
                        "<h2><span class=\"portlet-msg-success\">Template is deleted sucessfully</span>",
                        1000
                     );
                                  
                    if (type == 'upload'){
                     manageContent_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_.Dialogs.AddManageDialog.openPage( '/ManagedObjectsPortlets/managedobjects/action/chartBuilder/manager?action=dialog&type=upload&namespace=_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_&date=1194968098277' );
                    }else if (type == 'delete'){
                     manageContent_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_.Dialogs.AddManageDialog.openPage( '/ManagedObjectsPortlets/managedobjects/action/chartBuilder/manager?action=dialog&type=manage&namespace=_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_&date=1194968098277' );
                     }
                  },
                  failure : function(o) { 
                     MO.globals.popups.hideWorkingMsg();
                     MO.globals.popups.showMsg(
                        "Error", 
                        "<h2><span class=\"portlet-msg-error\">Your submission failed</span>"+
                        "<br />Status: " + o.status + "</h2>"
                     );
                  },
                  arguments : [oForm]
                }   
                
                // show the processing popup
                MO.globals.popups.showWorkingMsg();
                     
                // submit the form
                if (type == 'upload'){
                   YAHOO.util.Connect.asyncRequest(sMethod, '/ManagedObjectsPortlets/managedobjects/action/chartBuilder/manager?action=dialog&type=upload&namespace=_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_&date=1194968098277', 
                    saveCallback);
                }else if (type == 'delete'){
               	   YAHOO.util.Connect.asyncRequest(sMethod, '/ManagedObjectsPortlets/managedobjects/action/chartBuilder/manager?action=dialog&type=manage&namespace=_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_&date=1194968098277', 
                    saveCallback);
                }
                
                return false;
            
            },
            
      handleSubmit : function(){
      	MO.globals.popups.showWorkingMsg();
        this.submit();
      },
     
 } //end manage dialog
 }, // end dialog
 	
 
  	
  		treeContent : {
  		
  			create : function(){
  				//manageContent.treeConent.AddTreeContent.init();
  				this.init();
  			},
  			
  			init : function(){
  				this.AddTreeContent.init();
  			},
  			
  			AddTreeContent : {
  			
  			//	tree : new YAHOO.widget.TreeView("MOElementTree_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_"),
  				
  					init : function(){
  						var tree = new YAHOO.widget.TreeView("MOElementTree_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_");
  						
  						tree.setDynamicLoad(this.loadNodeData);
  						
  						var root = tree.getRoot();
  						
  						var topNode = "Service Models";
  						
  						var tempNode = new YAHOO.widget.TextNode(topNode,root, false);
  						//var tmpNode = new YAHOO.widget.TextNode("mylabel1", root, false); 
//var tmpNode2 = new YAHOO.widget.TextNode("mylabel1-1", tmpNode, false); 
  						tree.draw();
  						//MOJS.getById("MOElementTree_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_").style.display = 'none';
  						
  					},
  					
  					start : function() {
  					//	this.clear();
  						this.init();
  					//	this.hide();
  					},
  					
  					clear : function(){
  						MOJS.getById("MOElementTree_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_").innerHTML = "";  						
  					},
  					
  					hide : function(){
  						MOJS.getById("MOElementTree_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_").style.display = 'none';
  					},
  					
  				
loadNodeData : function(node, fnLoadComplete){
var treeDataURL = "/ManagedObjectsPortlets/managedobjects/action/chartBuilder/manager?action=tree&type=treeData&namespace=_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_&date=1194968098277&identity=XXXREPLACEMEXXX";						
 
 if ((node.parent).isRoot()){
  treeDataURL = treeDataURL.replace( "XXXREPLACEMEXXX", escape ("identity:dname:SczlT3rFScTXRcbwONHfRsvp") );
 }else{
  treeDataURL = treeDataURL.replace( "XXXREPLACEMEXXX", escape (node.data.elementID) );
 }
  var callback = {
success: function(oResponse) {		
  var oResults = eval( '(' +  oResponse.responseText + ')' );
if((oResults.ResultSet.Result) && (oResults.ResultSet.Result.length)) {
//Result is an array if more than one result, string otherwise										
    if(YAHOO.lang.isArray(oResults.ResultSet.Result)) {
for (var i=0, j=oResults.ResultSet.Result.length; i<j; i++) {
//alert((oResults.ResultSet.Result[i].elementName));
var tempNode = new YAHOO.widget.TextNode(oResults.ResultSet.Result[i], node, !oResults.ResultSet.Result[i].elementChildren);
tempNode.setUpLabel(oResults.ResultSet.Result[i]);
alert(tempNode.labelStyle);
}
} else {
//there is only one result; comes as string:
var tempNode = new YAHOO.widget.TextNode(oResults.ResultSet.Result, node, !oResults.ResultSet.Result.elementChildren)
}
}
oResponse.argument.fnLoadComplete();
    },  
   failure: function(oResponse) {
    	   YAHOO.log("Failed to process XHR transaction.", "info", "example");
                    	   oResponse.argument.fnLoadComplete();
   },
argument: {
"node": node,
"fnLoadComplete": fnLoadComplete
},							
timeout: 7000
};						
YAHOO.util.Connect.asyncRequest('GET', treeDataURL, callback);
}
}  					
  			}
  			
  	}
  
  manageContent_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_.Dialogs.create();	
  manageContent_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_.treeContent.create();				
 // YAHOO.util.Event.onDOMReady(manageContent_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_.treeContent.create());		
  MO.globals.popups.hideWorkingMsg();		
  
  
 </script>
</td>
</tr>
</table>
</div>
</div><!-- slide-maximize-reference -->
</div>
</div>
</div><!-- end portlet-box -->
</div><!-- End portlet-container -->
</td>
<td class="portlet-shadow-mr">
</td>
</tr>
<tr>
<td colspan="3">
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td class="portlet-shadow-bl"><div></div></td>
<td class="portlet-shadow-bc" width="100%"></td>
<td class="portlet-shadow-br"><div></div></td>
</tr>
</table>
</td>
</tr>
</table>
<div class="portlet-spacer"></div></div>
<script type="text/javascript">
$("p_p_id_mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph_").portletId = "mo_chartBuilder_WAR_ManagedObjectsPortlets_INSTANCE_P0Ph";
</script>
</div>
</td>
</tr>
</table>
</div>
</div>
</div><script type="text/javascript">
LayoutColumns.layoutMaximized = false;
LayoutColumns.plid = "PRI.15.6";
LayoutColumns.doAsUserId = "";
LayoutColumns.init(["column-1","column-2"]);
</script>
<div id="layout-bottom-container"></div>
</div><!-- End layout-box -->
</div>
</div><!-- End layout-outer-side-decoration --><script type="text/javascript">
setTimeout("openSessionWarning()", 1740000);
function extendSession() {
loadPage("/c/portal/extend_session");
setTimeout("openSessionWarning()", 1740000);
}
function openSessionWarning() {
var message = Alerts.fireMessageBox({
modal: true,
width: 300
});
var url = "/c/portal/extend_session_confirm?p_p_state=pop_up";
AjaxUtil.update(url, message);
setTimeout("sessionHasExpired()", 60000);
}
function sessionHasExpired() {
var warningText = document.getElementById("session_warning_text");
if (warningText) {
warningText.innerHTML = "\u0057\u0061\u0072\u006e\u0069\u006e\u0067\u0021\u0020\u0044\u0075\u0065\u0020\u0074\u006f\u0020\u0069\u006e\u0061\u0063\u0074\u0069\u0076\u0069\u0074\u0079\u002c\u0020\u0079\u006f\u0075\u0072\u0020\u0073\u0065\u0073\u0073\u0069\u006f\u006e\u0020\u0068\u0061\u0073\u0020\u0065\u0078\u0070\u0069\u0072\u0065\u0064\u002e";
document.getElementById("ok_btn").onclick = function() { Alerts.killAlert(this); };
document.getElementById("cancel_btn").style.display = "none";
loadPage("/c/portal/expire_session");
}
}
</script></body>
</html>
