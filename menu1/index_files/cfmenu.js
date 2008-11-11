/*ADOBE SYSTEMS INCORPORATED
Copyright 2007 Adobe Systems Incorporated
All Rights Reserved.

NOTICE:  Adobe permits you to use, modify, and distribute this file in accordance with the
terms of the Adobe license agreement accompanying it.  If you have received this file from a
source other than Adobe, then your use, modification, or distribution of it requires the prior
written permission of Adobe.*/
if(!ColdFusion.Menu){
ColdFusion.Menu={};
}
ColdFusion.Menu.menuItemMouseOver=function(id,_110,_111,_112){
var _113=document.getElementById(id);
_113.tempbackgroundColor=_113.style.backgroundColor;
_113.tempfontcolor=_113.firstChild.style.color;
if(_110){
_113.style.backgroundColor=_110;
}
if(_112){
_113.firstChild.style.color=_112;
}
if(_111){
_113.style.backgroundColor=_110;
}
};
ColdFusion.Menu.menuItemMouseOut=function(id,_115){
var _116=document.getElementById(id);
if(_116.tempfontcolor){
_116.firstChild.style.color=_116.tempfontcolor;
}else{
_116.firstChild.style.color="black";
}
_116.style.backgroundColor=_116.tempbackgroundColor;
};
