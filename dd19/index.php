<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>
Drag Drop
</title>
  <link href="style/main2.css" type="text/css" rel="stylesheet">
<script language="javascript" src="js/main.js">
</script>
<style>
a.sortableLink:link {COLOR: black; text-decoration:none}a.sortableLink:visited {COLOR: black; text-decoration:none}a.sortableLink:active {COLOR: black; text-decoration:none}a.sortableLink:hover {COLOR: blaczk; text-decoration:none}.addUserRow2{background-color:#f7f5ef;border-top:#e9e7e9 1px solid;border-bottom:#e9e7e9 1px solid;}.styleForDataDiv{border-right:1px solid #777777;border-left:1px solid #777777; padding:4px;}
</style>
<style type="text/css">
.listBox{ border:#cccccc 1px solid;padding:2px;margin:2px;background:#FFFFDF; cursor:move;}.listBoxInner{ border:#cccccc 1px solid;padding:2px;margin:2px;background:#FFFFDF;background-repeat:no-repeat; background-position:98%; cursor:move;}.colContainer{ padding-left:4px;height:367px;overflow:auto;}.colContainer2{ height:80px;overflow:auto; background-color:#f4f0e6; border:1px solid #777777; border-left:none; padding:0px; margin:0px;}.styleForTDs{filter:flipH() flipV(); writing-mode:tb-rl; text-align:center; vertical-align:middle; font-weight:bold; height:30px; width:30px; border:1px solid #777777; margin:0px; padding:0px; background-color:#fffbe7; }.innerNodesStyle{ background-image:url(images/close_nodes.gif); background-repeat:no-repeat; background-position:right; }
</style>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/treeview/treeview-min.js"></script> 
<!-------------Json--------------- >
< script type="text/javascript" >
function Evaluate(){ alert(eval(document.getElementById('cFeeder').value));}
< /script >
< !-------------Json-------------->
<script type="text/javascript">
var myFirstJSON = {"Name":"Main","cCount":24,"cNodes":[ {"Name":"DragDrop_1","Id":"ID_1","cCount":0}, {"Name":"DragDrop_2","Id":"ID_2","cCount":0}, {"Name":"DragDrop_3","Id":"ID_3","cCount":0}, {"Name":"DragDrop_4","Id":"ID_4","cCount":0}, {"Name":"DragDrop_5","Id":"ID_5","cCount":0}, {"Name":"DragDrop_6","Id":"ID_6","cCount":0}, {"Name":"DragDrop_7","Id":"ID_7","cCount":0}, {"Name":"DragDrop_8","Id":"ID_8","cCount":0}, {"Name":"DragDrop_9","Id":"ID_9","cCount":0}, {"Name":"DragDrop_10","Id":"ID_10","cCount":0}, {"Name":"DragDrop_11","Id":"ID_11","cCount":0}, {"Name":"DragDrop_12","Id":"ID_12","cCount":0}, {"Name":"DragDrop_13","Id":"ID_13","cCount":0}, {"Name":"DragDrop_14","Id":"ID_14","cCount":0}, {"Name":"DragDrop_15","Id":"ID_15","cCount":0}, {"Name":"DragDrop_16","Id":"ID_16","cCount":0}, {"Name":"DragDrop_17","Id":"ID_17","cCount":0}, {"Name":"DragDrop_18","Id":"ID_18","cCount":0}, {"Name":"DragDrop_19","Id":"ID_19","cCount":0}, {"Name":"DragDrop_20","Id":"ID_20","cCount":0}, {"Name":"DragDrop_21","Id":"ID_21","cCount":0}, {"Name":"DragDrop_22","Id":"ID_22","cCount":0}, {"Name":"DragDrop_23","Id":"ID_23","cCount":0}, {"Name":"DragDrop_24","Id":"ID_24","cCount":0} ]};



( function() {
var Dom = YAHOO.util.Dom;
var Event = YAHOO.util.Event;
var DDM = YAHOO.util.DragDropMgr;
var coll = new Array();
//////////////////////////////////////////////////////////////////////////////
// example app
//////////////////////////////////////////////////////////////////////////////
YAHOO.example.DDApp = {
init: function() {

tree = new YAHOO.widget.TreeView("col1");
cnt = 1;
/*for (var i = 1; i < 5; i++) {
var htmltext = "<div class='listBox' id=tr_"+i+">ParentNode_"+i+"</div>"
var tmpNode = new YAHOO.widget.HTMLNode(htmltext, tree.getRoot(), true, true);
tmpNode.value = "tr_"+i;
new YAHOO.example.DDList("tr_"+i);
//var tmpNode = new YAHOO.widget.TextNode("label-" + i, tree.getRoot(), false);
//document.getElementById(tmpNode.labelElId).style.color="#ff0000";
//new YAHOO.example.DDList("tr_"+i);
cnt = cnt+1;
buildLargeBranch(tmpNode,i);
}
function buildLargeBranch(node,val) {
if (node.depth < 10) {
for ( var i = 1; i < 3; i++ ) {
var htmltext = "<div class='listBox2' id=tr_"+val+"_"+i+">ChildNode_"+i+"</div>"
var cnode = new YAHOO.widget.HTMLNode(htmltext,node, false, true);
cnode.value = "tr_"+val+"_"+i
new YAHOO.example.DDList("tr_"+val+"_"+i);
coll["tr_"+val+"_"+i] = "ygtvcontentel"+cnt;
cnt = cnt+1;
}
}
}*/
for(i=0;i<myFirstJSON.cCount;i++){
if(tree.id == 'col1' )
{
var htmltext = "<div class='listBox' id="+myFirstJSON.cNodes[i].Id+">"+myFirstJSON.cNodes[i].Name+"</div>";
}
var tmpNode = new YAHOO.widget.HTMLNode(htmltext, tree.getRoot(), true, true);
Event.addListener(myFirstJSON.cNodes[i].Id, "dblclick", helloWorld);
if(myFirstJSON.cNodes[i].cCount > 0){
cnt++;
parseJsonObj(tmpNode,myFirstJSON.cNodes[i]);
}else{
new YAHOO.example.DDList(myFirstJSON.cNodes[i].Id);
coll[myFirstJSON.cNodes[i].Id] = "ygtvcontentel"+cnt;
}
}

function parseJsonObj(obj1,obj){
obj.tCount = 0;
while(obj.cCount > obj.tCount){
var htmltext = "<div class='listBox' id="+obj.cNodes[obj.tCount].Id+">"+obj.cNodes[obj.tCount].Name+"</div>";
var tmpNode = new YAHOO.widget.HTMLNode(htmltext, obj1, true, true);
Event.addListener(obj.cNodes[obj.tCount].Id, "dblclick", helloWorld);
//onclick:{fn:myFunc,obj:this,scope:this}
if(obj.cNodes[obj.tCount].cCount==0){
new YAHOO.example.DDList(obj.cNodes[obj.tCount].Id);
coll[obj.cNodes[obj.tCount].Id] = "ygtvcontentel"+cnt;
alert(obj.cNodes[obj.tCount].Id);
//document.getElementById('cFeeder').value += obj.cNodes[obj.tCount].Id +"---------------ygtvcontentel"+cnt+"\n";
}
cnt++;
parseJsonObj(tmpNode,obj.cNodes[obj.tCount]);
//alert(obj.cNodes[obj.cCount-1].Name);
//alert(obj.cNodes[obj.cCount-1]);
//alert(obj.tCount);
obj.tCount++;
}
}
function helloWorld(e) {
alert(this.id);
}
tree.draw();
tree.collapseAll();
//document.getElementById("debug").innerText = tree.getEl().innerHTML;
new YAHOO.util.DDTarget("col1");
new YAHOO.util.DDTarget("col2");
new YAHOO.util.DDTarget("col3");
new YAHOO.util.DDTarget("col4");
new YAHOO.util.DDTarget("col5");
new YAHOO.util.DDTarget("col6");
new YAHOO.util.DDTarget("col7");
new YAHOO.util.DDTarget("col8");
new YAHOO.util.DDTarget("col9");
new YAHOO.util.DDTarget("groupX1");
new YAHOO.util.DDTarget("groupX2");
new YAHOO.util.DDTarget("groupX3");
new YAHOO.util.DDTarget("groupX4");
new YAHOO.util.DDTarget("groupY1");
new YAHOO.util.DDTarget("groupY2");
new YAHOO.util.DDTarget("groupY3");
new YAHOO.util.DDTarget("groupY3");
}
};
//////////////////////////////////////////////////////////////////////////////
// custom drag and drop implementation
//////////////////////////////////////////////////////////////////////////////
var chk;
YAHOO.example.DDList = function(id, sGroup, config) {
    console.log('DDList: ' + id);
YAHOO.example.DDList.superclass.constructor.call(this, id, sGroup, config);
this.logger = this.logger || YAHOO;
var el = this.getDragEl();
Dom.setStyle(el, "opacity", 0.67); // The proxy is slightly transparent
this.goingUp = false;
this.lastY = 0;
};
YAHOO.extend(YAHOO.example.DDList, YAHOO.util.DDProxy, {
startDrag: function(x, y) {
this.logger.log(this.id + " startDrag");

// make the proxy look like the source element
var dragEl = this.getDragEl();
var clickEl = this.getEl();
Dom.setStyle(clickEl, "visibility", "hidden");
dragEl.innerHTML = clickEl.innerHTML;
chk = dragEl.innerHTML;
Dom.setStyle(dragEl, "color", Dom.getStyle(clickEl, "color"));
Dom.setStyle(dragEl, "backgroundColor", Dom.getStyle(clickEl, "backgroundColor"));
Dom.setStyle(dragEl, "border", "2px solid gray");

},
endDrag: function(e) {
var srcEl = this.getEl();

var proxy = this.getDragEl();
Dom.setStyle(srcEl, "visibility", "");
// Show the proxy element and animate it to the src element's location
//extra
//extra
Dom.setStyle(proxy, "visibility", "visible");
var a = new YAHOO.util.Motion(
proxy, {
points: {
to: Dom.getXY(srcEl)
}
},
0.2,
YAHOO.util.Easing.easeOut
)
var proxyid = proxy.id;
var thisid = this.id;
// Hide the proxy and show the source element when finished with the animation
a.onComplete.subscribe(function() {
Dom.setStyle(proxyid, "visibility", "hidden");
Dom.setStyle(thisid, "visibility", "");
});
a.animate();
},

onDragDrop: function(e, id) {

// If there is one drop interaction, the li was dropped either on the list,
// or it was dropped on the current location of the source element.
if (DDM.interactionInfo.drop.length === 1) {
// The position of the cursor at the time of the drop (YAHOO.util.Point)
var pt = DDM.interactionInfo.point;
// The region occupied by the source element at the time of the drop
var region = DDM.interactionInfo.sourceRegion;
// Check to see if we are over the source element's location. We will
// append to the bottom of the list once we are sure it was a drop in
// the negative space (the area of the list without any list items)
if (!region.intersect(pt)) {
var destEl = Dom.get(id);
var destDD = DDM.getDDById(id);

// after dragging , drop it inside the group container
if(destEl.id =="groupX1" || destEl.id=="col2"){
//alert(this.getEl().id);
var sen = this.getEl();
destEl = document.getElementById("col2");
if(this.getEl().innerHTML.indexOf("<")==-1){
this.getEl().innerHTML = "<div style='height:12px;'><div style='display:inline; float:left'>"+this.getEl().innerHTML+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+sen.id+")' border='0' style='cursor:hand; float:right;' /></div>";
}
destEl.appendChild(this.getEl());
}
if(destEl.id=="groupX2" || destEl.id=="col3"){
var sen = this.getEl();
destEl = document.getElementById("col3");
if(this.getEl().innerHTML.indexOf("<")==-1){
this.getEl().innerHTML = "<div style='height:12px;'><div style='display:inline; float:left'>"+this.getEl().innerHTML+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+sen.id+")' border='0' style='cursor:hand; float:right;' /></div>";}
destEl.appendChild(this.getEl());

}
if(destEl.id=="groupX3" || destEl.id=="col4"){
var sen = this.getEl();
destEl = document.getElementById("col4");
if(this.getEl().innerHTML.indexOf("<")==-1){
this.getEl().innerHTML = "<div style='height:12px;'><div style='display:inline; float:left'>"+this.getEl().innerHTML+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+sen.id+")' border='0' style='cursor:hand; float:right;' /></div>";
}
destEl.appendChild(this.getEl());

}
if(destEl.id=="groupX4" || destEl.id=="col5"){
var sen = this.getEl();
destEl = document.getElementById("col5");
if(this.getEl().innerHTML.indexOf("<")==-1){
this.getEl().innerHTML = "<div style='height:12px;'><div style='display:inline; float:left'>"+this.getEl().innerHTML+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+sen.id+")' border='0' style='cursor:hand; float:right;' /></div>";
}
destEl.appendChild(this.getEl());

}
if(destEl.id=="groupY1" || destEl.id=="col6"){
var sen = this.getEl();
destEl = document.getElementById("col6");
if(this.getEl().innerHTML.indexOf("<")==-1){
this.getEl().innerHTML = "<div style='height:12px;'><div style='display:inline; float:left'>"+this.getEl().innerHTML+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+sen.id+")' border='0' style='cursor:hand; float:right;' /></div>";
}
destEl.appendChild(this.getEl());

}
if(destEl.id=="groupY2" || destEl.id=="col7"){
var sen = this.getEl();
destEl = document.getElementById("col7");
if(this.getEl().innerHTML.indexOf("<")==-1){
this.getEl().innerHTML = "<div style='height:12px;'><div style='display:inline; float:left'>"+this.getEl().innerHTML+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+sen.id+")' border='0' style='cursor:hand; float:right;' /></div>";
}
destEl.appendChild(this.getEl());

}if(destEl.id=="groupY3" || destEl.id=="col8"){
var sen = this.getEl();
destEl = document.getElementById("col8");
if(this.getEl().innerHTML.indexOf("<")==-1){
this.getEl().innerHTML = "<div style='height:12px;'><div style='display:inline; float:left'>"+this.getEl().innerHTML+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+sen.id+")' border='0' style='cursor:hand; float:right;' /></div>";
}
destEl.appendChild(this.getEl());

}if(destEl.id=="groupY4" || destEl.id=="col9"){
var sen = this.getEl();
destEl = document.getElementById("col9");
if(this.getEl().innerHTML.indexOf("<")==-1){
this.getEl().innerHTML = "<div style='height:12px;'><div style='display:inline; float:left'>"+this.getEl().innerHTML+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+sen.id+")' border='0' style='cursor:hand; float:right;' /></div>";
}
destEl.appendChild(this.getEl());
}
/*else
{
var destE2 = document.getElementById("col1");
destE2.appendChild(this.getEl());
}
/* if(destEl.id=="col1")
{
destEl = document.getElementById(coll[this.getEl().id]);
destEl.appendChild(this.getEl());
}
else
{
destEl.appendChild(this.getEl());
} */
destDD.isEmpty = false;
DDM.refreshCache();
}
}
},

onDrag: function(e) {
// Keep track of the direction of the drag for use during onDragOver
var y = Event.getPageY(e);
if (y < this.lastY) {
this.goingUp = true;
} else if (y > this.lastY) {
this.goingUp = false;
}
this.lastY = y;
},
onDragOver: function(e, id) {
var srcEl = this.getEl();
var destEl = Dom.get(id);

// We are only concerned with list items, we ignore the dragover
// notifications for the list.
if (destEl.nodeName.toLowerCase() == "li") {
var orig_p = srcEl.parentNode;
var p = destEl.parentNode;
if (this.goingUp) {
p.insertBefore(srcEl, destEl); // insert above
} else {
p.insertBefore(srcEl, destEl); // insert below
// p.insertBefore(srcEl, destEl.nextSibling); // insert below
}
DDM.refreshCache();
}
}
});
Event.onDOMReady(YAHOO.example.DDApp.init, YAHOO.example.DDApp, true);
//YAHOO.util.Event.addListener(window, "load", YAHOO.example.DDApp.init, YAHOO.example.DDApp);
})();
// deleting
function removeV(idm){
//alert("e"+idm.id);
var t = document.getElementById(idm.id);
t.parentNode.removeChild(t);
}

// getting the groups and the Items
function GetIds(){
var xAxisGrp1 = document.getElementById('col2');
var xAxisGrp2 = document.getElementById('col3');
var xAxisGrp3 = document.getElementById('col4');
var xAxisGrp4 = document.getElementById('col5');
var yAxisGrp1 = document.getElementById('col6');
var yAxisGrp2 = document.getElementById('col7');
var yAxisGrp3 = document.getElementById('col8');
var yAxisGrp4 = document.getElementById('col9');
// alert(" Left Y-Axis Group1 :: "+buildList(xAxisGrp1)+"\n\n Left Y-Axis Group2 :: "+buildList(xAxisGrp2)+"\n\n Left Y-Axis Group3 :: "+buildList(xAxisGrp3)+"\n\n Left Y-Axis Group4 :: "+buildList(xAxisGrp4)+"\n\n Y-Axis Group1 :: "+buildList(yAxisGrp1)+"\n\n Y-Axis Group2 :: "+buildList(yAxisGrp2)+"\n\n Y-Axis Group3 :: "+buildList(yAxisGrp3)+"\n\n Y-Axis Group4 :: "+buildList(yAxisGrp4));
var allLists = "" ;
if ( buildList(xAxisGrp1) != ""){
allLists += xAxisGrp1.id+"-"+buildList(xAxisGrp1)+"~";
}
if ( buildList(xAxisGrp2) != ""){
allLists += xAxisGrp2.id +"-"+ buildList(xAxisGrp2)+"~";
}
if ( buildList(xAxisGrp3) != ""){
allLists += xAxisGrp3.id +"-"+buildList(xAxisGrp3)+"~";
}
if ( buildList(xAxisGrp4) != ""){
allLists += xAxisGrp4.id+"-"+buildList(xAxisGrp4)+"~";
}
if ( buildList(yAxisGrp1) != ""){
allLists += yAxisGrp1.id+"-"+buildList(yAxisGrp1)+"~";
}
if ( buildList(yAxisGrp2) != ""){
allLists += yAxisGrp2.id+"-"+buildList(yAxisGrp2)+"~";
}
if ( buildList(yAxisGrp3) != ""){
allLists += yAxisGrp3.id+"-"+buildList(yAxisGrp3)+"~";
}
if ( buildList(yAxisGrp4) != ""){
allLists += yAxisGrp4.id+"-"+buildList(yAxisGrp4) ;
}

if ( buildList(xAxisGrp1).length == 0 && buildList(xAxisGrp2).length == 0 && buildList(xAxisGrp3).length == 0 && buildList(xAxisGrp4).length == 0 && buildList(yAxisGrp1).length == 0 && buildList(yAxisGrp2).length == 0 && buildList(yAxisGrp3).length == 0 && buildList(yAxisGrp4).length == 0)
{
return false ;
}
else {
return allLists ;
}

}
// building the list ..container of Items
function buildList(obj){
var columnArr = new Array();
for(i=0;i<obj.childNodes.length;i++){
columnArr[i] = obj.childNodes[i].id;
}
return columnArr;
}

function addData(){

if ( document.dragDropFrm.name.value == null || document.dragDropFrm.name.value == "" ){
alert ( " Please enter the name " );
return ;
}
var isEmpty = GetIds();
if (!isEmpty ){
alert ( " Please select any of the measures " );
return ;
}else{
var allLists = GetIds();
document.dragDropFrm.allVals.value = allLists ;
alert ( " All lists .. " + allLists );
document.dragDropFrm.action="dragDrop?action=insert";
document.dragDropFrm.submit();
}
}


</script>
</head>
<body>
<form name="dragDropFrm" method="post" action="dragDrop">
  <input name="allVals" type="hidden">
<div style="padding: 4px;">
<!-----------------------------------------------Header Starts----------------------------------------------------------------- >
< !----------div for background shadow-------------------->
<!----------background shadow div ends------------------>
<!-----------------------------------------------Header Ends------------------------------------------------------------------>
<div id="mainCont">
<!-- wrapper -->
<div>
<!-----------------------------------------------leftNav Starts---------------------------------------------------------------- >
< !-----------------------------------------------leftNav Ends------------------------------------------------------------------ >
< !-----------------------------------------------RightBlock Starts------------------------------------------------------------>
<!---------------------Add User Table Start Here---------------->
<div>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td>
Enter a name :
  <input name="name" type="text">
</td>
</tr>
<tr>
</tr>
<tr>
</tr>
<tr>
</tr>
<tr>
</tr>
<tr>
</tr>
<tr>
</tr>
<tr>
<td align="center" valign="top">
<div style="margin-right: 5px;">
<div class="boxHeaderBG">
<div class="boxHeaderLeftCorner">
<div class="boxHeaderRightCorner">
<div id="bvTitle">
Drag and Drop
</div>
<div>
<div id="filterTabHolder">
</div>
<div class="boxHeaderQuickLinks">
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td>
<div class="boxHeaderDivider">
</div>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<div class="boxContentBlock" style="height: 100%;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td align="left" valign="top" width="100%">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td style="padding: 4px;" align="left" valign="top" width="33%">
<div class="boxHeaderBG">
<div class="boxHeaderLeftCorner">
<div class="boxHeaderRightCorner">
<div id="bvTitle">
Avaliable Items
</div>
<div>
<div id="filterTabHolder">
</div>
<div class="boxHeaderQuickLinks">
<table border="0">
<tbody>
<tr>
<td>
<div class="boxHeaderDivider">
</div>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<div id="dataContainerForRoles" class="styleForDataDiv styleForScrollbars" style="overflow: auto;">
<div id="col1" class="colContainer">
</div>
</div>
<div class="boxFooterBG">
<div class="boxFooterLeftCorner">
<div class="boxFooterRightCorner">
&nbsp;
</div>
</div>
</div>
</td>
<td style="padding: 4px;" align="left" valign="top" width="33%">
<div class="boxHeaderBG">
<div class="boxHeaderLeftCorner">
<div class="boxHeaderRightCorner">
<div id="bvTitle">
Left Y-Axis Items Group
</div>
<div>
<div id="filterTabHolder">
</div>
<div class="boxHeaderQuickLinks">
<table border="0">
<tbody>
<tr>
<td>
<div class="boxHeaderDivider">
</div>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<div id="dataContainerForRoles2" class="styleForDataDiv styleForScrollbars" style="padding: 8px; overflow: auto;">
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td colspan="2">
</td>
</tr>
<tr>
<td class="styleForTDs" id="groupX1" width="30">
Group 1
</td>
<td style="margin: 0px; padding: 0px; width: 100%;" width="100%">
<div id="col2" class="colContainer2">
<div class="listBox" style="height: 12px;" id="element1">
<div style="display: inline; font-size: 11px; float: left;">
ID_1
</div>
<div style="display: inline; float: right;">
  <img src="images/close_nodes3.gif" onclick="removeV(ID_1)" style="float: right;" border="0">
</div>
</div>
<div class="listBox" style="height: 12px;" id="element1">
<div style="display: inline; font-size: 11px; float: left;">
ID_3
</div>
<div style="display: inline; float: right;">
  <img src="images/close_nodes3.gif" onclick="removeV(ID_3)" style="float: right;" border="0">
</div>
</div>
</div>
</td>
</tr>
<tr height="10">
<td colspan="2">
</td>
</tr>
<tr>
<td class="styleForTDs" id="groupX2" width="30">
Group 2
</td>
<td style="margin: 0px; padding: 0px; width: 100%;" width="100%">
<div id="col3" class="colContainer2">
<div class="listBox" style="height: 12px;" id="element1">
<div style="display: inline; font-size: 11px; float: left;">
ID_2
</div>
<div style="display: inline; float: right;">
  <img src="images/close_nodes3.gif" onclick="removeV(ID_2)" style="float: right;" border="0">
</div>
</div>
<div class="listBox" style="height: 12px;" id="element1">
<div style="display: inline; font-size: 11px; float: left;">
ID_4
</div>
<div style="display: inline; float: right;">
  <img src="images/close_nodes3.gif" onclick="removeV(ID_4)" style="float: right;" border="0">
</div>
</div>
</div>
</td>
</tr>
<tr height="10">
<td colspan="2">
</td>
</tr>
<tr>
<td class="styleForTDs" id="groupX3" width="30">
Group 3
</td>
<td style="margin: 0px; padding: 0px; width: 100%;" width="100%">
<div id="col4" class="colContainer2">
<div class="listBox" style="height: 12px;" id="element1">
<div style="display: inline; font-size: 11px; float: left;">
ID_5
</div>
<div style="display: inline; float: right;">
  <img src="images/close_nodes3.gif" onclick="removeV(ID_5)" style="float: right;" border="0">
</div>
</div>
</div>
</td>
</tr>
<tr height="10">
<td colspan="2">
</td>
</tr>
<tr>
<td class="styleForTDs" id="groupX4" width="30">
Group 4
</td>
<td style="margin: 0px; padding: 0px; width: 100%;" width="100%">
<div id="col5" class="colContainer2">
<div class="listBox" style="height: 12px;" id="element1">
<div style="display: inline; font-size: 11px; float: left;">
ID_6
</div>
<div style="display: inline; float: right;">
  <img src="images/close_nodes3.gif" onclick="removeV(ID_6)" style="float: right;" border="0">
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<div class="boxFooterBG">
<div class="boxFooterLeftCorner">
<div class="boxFooterRightCorner">
&nbsp;
</div>
</div>
</div>
</td>
<td style="padding: 4px;" align="left" valign="top" width="33%">
<div class="boxHeaderBG">
<div class="boxHeaderLeftCorner">
<div class="boxHeaderRightCorner">
<div id="bvTitle">
Right Y-Axis Items Group
</div>
<div>
<div id="filterTabHolder">
</div>
<div class="boxHeaderQuickLinks">
<table border="0">
<tbody>
<tr>
<td>
<div class="boxHeaderDivider">
</div>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<div id="dataContainerForRoles4" class="styleForDataDiv styleForScrollbars" style="padding: 8px; overflow: auto;">
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td colspan="2">
</td>
</tr>
<tr>
<td class="styleForTDs" id="groupY1" width="30">
Group 1
</td>
<td style="margin: 0px; padding: 0px; width: 100%;" width="100%">
<div id="col6" class="colContainer2">
<div class="listBox" style="height: 12px;" id="element1">
<div style="display: inline; font-size: 11px; float: left;">
ID_7
</div>
<div style="display: inline; float: right;">
  <img src="images/close_nodes3.gif" onclick="removeV(ID_7)" style="float: right;" border="0">
</div>
</div>
</div>
</td>
</tr>
<tr height="10">
<td colspan="2">
</td>
</tr>
<tr>
<td class="styleForTDs" id="groupY2" width="30">
Group 2
</td>
<td style="margin: 0px; padding: 0px; width: 100%;" width="100%">
<div id="col7" class="colContainer2">
</div>
</td>
</tr>
<tr height="10">
<td colspan="2">
</td>
</tr>
<tr>
<td class="styleForTDs" id="groupY3" width="30">
Group 3
</td>
<td style="margin: 0px; padding: 0px; width: 100%;" width="100%">
<div id="col8" class="colContainer2">
</div>
</td>
</tr>
<tr height="10">
<td colspan="2">
</td>
</tr>
<tr>
<td class="styleForTDs" id="groupY4" width="30">
Group 4
</td>
<td style="margin: 0px; padding: 0px; width: 100%;" width="100%">
<div id="col9" class="colContainer2">
</div>
</td>
</tr>
</tbody>
</table>
</div>
<div class="boxFooterBG">
<div class="boxFooterLeftCorner">
<div class="boxFooterRightCorner">
&nbsp;
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td class="filterButton">
<div class="listLines">
<div style="margin: 4px 10px 4px 0px; float: right;">
<a href="#">
  <img src="images/submit_off.gif" name="submit111" class="image_padding" id="submit111" style="cursor: pointer;" title="" onmouseover="MM_swapImage('submit111','','images/submit_on.gif',0)" onmouseout="MM_swapImgRestore()" onclick="GetIds();addData()" align="absmiddle" border="0">
</a>
&nbsp;
<a href="#">
  <img src="images/cancel_off.gif" name="canc" class="image_padding" id="canc" style="cursor: pointer;" title="" onmouseover="MM_swapImage('canc','','images/cancel_on.gif',0)" onmouseout="MM_swapImgRestore()" align="absmiddle" border="0">
</a>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<div class="boxFooterBG">
<div class="boxFooterLeftCorner">
<div class="boxFooterRightCorner">
&nbsp;
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<!---------------------Add User Table ends Here---------------->
</div>
</div>
</form>
<script>
function colorChangeOver()
{
document.getElementById('colGroup1').style.backgroundColor='#fffbe7';
}
function colorChangeOut()
{
document.getElementById('colGroup1').style.backgroundColor='';
}

</script>
<!----------Search Dialog Box------------------>
<script>
var colsJS = document.getElementById('col2');
colsJS.innerHTML = "" ;
var htmltext = "" ;

</script>
<script>
var splitMeasureID = 'ID_1';
colsJS.innerHTML+="<div class='listBox' style='height:12px;' id='element1'><div style='display:inline;font-size:11px; float:left' >"+splitMeasureID+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+splitMeasureID+")' border='0' style='cursor:hand; float:right;' /></div>"
document.forms[0].name.value = 'bbb';

</script>
<script>
var splitMeasureID = 'ID_3';
colsJS.innerHTML+="<div class='listBox' style='height:12px;' id='element1'><div style='display:inline;font-size:11px; float:left' >"+splitMeasureID+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+splitMeasureID+")' border='0' style='cursor:hand; float:right;' /></div>"
document.forms[0].name.value = 'bbb';

</script>
<script>
var colsJS = document.getElementById('col3');
colsJS.innerHTML = "" ;
var htmltext = "" ;

</script>
<script>
var splitMeasureID = 'ID_2';
colsJS.innerHTML+="<div class='listBox' style='height:12px;' id='element1'><div style='display:inline;font-size:11px; float:left' >"+splitMeasureID+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+splitMeasureID+")' border='0' style='cursor:hand; float:right;' /></div>"
document.forms[0].name.value = 'bbb';

</script>
<script>
var splitMeasureID = 'ID_4';
colsJS.innerHTML+="<div class='listBox' style='height:12px;' id='element1'><div style='display:inline;font-size:11px; float:left' >"+splitMeasureID+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+splitMeasureID+")' border='0' style='cursor:hand; float:right;' /></div>"
document.forms[0].name.value = 'bbb';

</script>
<script>
var colsJS = document.getElementById('col4');
colsJS.innerHTML = "" ;
var htmltext = "" ;

</script>
<script>
var splitMeasureID = 'ID_5';
colsJS.innerHTML+="<div class='listBox' style='height:12px;' id='element1'><div style='display:inline;font-size:11px; float:left' >"+splitMeasureID+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+splitMeasureID+")' border='0' style='cursor:hand; float:right;' /></div>"
document.forms[0].name.value = 'bbb';

</script>
<script>
var colsJS = document.getElementById('col5');
colsJS.innerHTML = "" ;
var htmltext = "" ;

</script>
<script>
var splitMeasureID = 'ID_6';
colsJS.innerHTML+="<div class='listBox' style='height:12px;' id='element1'><div style='display:inline;font-size:11px; float:left' >"+splitMeasureID+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+splitMeasureID+")' border='0' style='cursor:hand; float:right;' /></div>"
document.forms[0].name.value = 'bbb';

</script>
<script>
var colsJS = document.getElementById('col6');
colsJS.innerHTML = "" ;
var htmltext = "" ;

</script>
<script>
var splitMeasureID = 'ID_7';
colsJS.innerHTML+="<div class='listBox' style='height:12px;' id='element1'><div style='display:inline;font-size:11px; float:left' >"+splitMeasureID+"</div><div style='display:inline; float:right'><img src='images/close_nodes3.gif' onclick='removeV("+splitMeasureID+")' border='0' style='cursor:hand; float:right;' /></div>"
document.forms[0].name.value = 'bbb';

</script>
<div style="position: absolute; top: -1000px; left: -1000px;">
<span class="[object Event]tn">
&nbsp;
</span>
<span class="[object Event]tm">
&nbsp;
</span>
<span class="[object Event]tmh">
&nbsp;
</span>
<span class="[object Event]tp">
&nbsp;
</span>
<span class="[object Event]tph">
&nbsp;
</span>
<span class="[object Event]ln">
&nbsp;
</span>
<span class="[object Event]lm">
&nbsp;
</span>
<span class="[object Event]lmh">
&nbsp;
</span>
<span class="[object Event]lp">
&nbsp;
</span>
<span class="[object Event]lph">
&nbsp;
</span>
<span class="[object Event]loading">
&nbsp;
</span>
</div>
</body>
</html>

Real housewives write extensions. 
