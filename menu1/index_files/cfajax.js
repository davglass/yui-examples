/*ADOBE SYSTEMS INCORPORATED
Copyright 2007 Adobe Systems Incorporated
All Rights Reserved.

NOTICE:  Adobe permits you to use, modify, and distribute this file in accordance with the
terms of the Adobe license agreement accompanying it.  If you have received this file from a
source other than Adobe, then your use, modification, or distribution of it requires the prior
written permission of Adobe.*/
function cfinit(){
if(!window.ColdFusion){
ColdFusion={};
var $C=ColdFusion;
if(!$C.Ajax){
$C.Ajax={};
}
var $A=$C.Ajax;
if(!$C.AjaxProxy){
$C.AjaxProxy={};
}
var $X=$C.AjaxProxy;
if(!$C.Bind){
$C.Bind={};
}
var $B=$C.Bind;
if(!$C.Event){
$C.Event={};
}
var $E=$C.Event;
if(!$C.Log){
$C.Log={};
}
var $L=$C.Log;
if(!$C.Util){
$C.Util={};
}
var $U=$C.Util;
if(!$C.DOM){
$C.DOM={};
}
var $D=$C.DOM;
if(!$C.Spry){
$C.Spry={};
}
var $S=$C.Spry;
if(!$C.Pod){
$C.Pod={};
}
var $P=$C.Pod;
if(!$C.objectCache){
$C.objectCache={};
}
if(!$C.required){
$C.required={};
}
if(!$C.importedTags){
$C.importedTags=[];
}
if(!$C.requestCounter){
$C.requestCounter=0;
}
if(!$C.bindHandlerCache){
$C.bindHandlerCache={};
}
window._cf_loadingtexthtml=window._cf_loadingtexthtml+"&nbsp;"+CFMessage["loading"]+"</div>";
$C.globalErrorHandler=function(_1fc,_1fd){
if($L.isAvailable){
$L.error(_1fc,_1fd);
}
if($C.userGlobalErrorHandler){
$C.userGlobalErrorHandler(_1fc);
}
if(!$L.isAvailable&&!$C.userGlobalErrorHandler){
alert(_1fc+CFMessage["globalErrorHandler.alert"]);
}
};
$C.handleError=function(_1fe,_1ff,_200,_201,_202,_203,_204){
var msg=$L.format(_1ff,_201);
if(_1fe){
$L.error(msg,"http");
if(!_202){
_202=-1;
}
if(!_203){
_203=msg;
}
_1fe(_202,_203);
}else{
if(_204){
$L.error(msg,"http");
throw msg;
}else{
$C.globalErrorHandler(msg,_200);
}
}
};
$C.setGlobalErrorHandler=function(_206){
$C.userGlobalErrorHandler=_206;
};
$A.createXMLHttpRequest=function(){
var _207=["Microsoft.XMLHTTP","MSXML2.XMLHTTP.5.0","MSXML2.XMLHTTP.4.0","MSXML2.XMLHTTP.3.0","MSXML2.XMLHTTP"];
for(var i=0;i<_207.length;i++){
try{
return new ActiveXObject(_207[i]);
}
catch(e){
}
}
try{
return new XMLHttpRequest();
}
catch(e){
}
return false;
};
$A.isRequestError=function(req){
return ((req.status!=0&&req.status!=200)||req.getResponseHeader("server-error"));
};
$A.sendMessage=function(url,_20b,_20c,_20d,_20e,_20f,_210){
var req=$A.createXMLHttpRequest();
if(!_20b){
_20b="GET";
}
if(_20d&&_20e){
req.onreadystatechange=function(){
$A.callback(req,_20e,_20f);
};
}
if(_20c){
_20c+="&_cf_nodebug=true&_cf_nocache=true";
}else{
_20c="_cf_nodebug=true&_cf_nocache=true";
}
if(window._cf_clientid){
_20c+="&_cf_clientid="+_cf_clientid;
}
if(_20b=="GET"){
if(_20c){
_20c+="&_cf_rc="+($C.requestCounter++);
if(url.indexOf("?")==-1){
url+="?"+_20c;
}else{
url+="&"+_20c;
}
}
$L.info("ajax.sendmessage.get","http",[url]);
req.open(_20b,url,_20d);
req.send(null);
}else{
$L.info("ajax.sendmessage.post","http",[url,_20c]);
req.open(_20b,url,_20d);
req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
if(_20c){
req.send(_20c);
}else{
req.send(null);
}
}
if(!_20d){
while(req.readyState!=4){
}
if($A.isRequestError(req)){
$C.handleError(null,"ajax.sendmessage.error","http",[req.status,req.statusText],req.status,req.statusText,_210);
}else{
return req;
}
}
};
$A.callback=function(req,_213,_214){
if(req.readyState!=4){
return;
}
_213(req,_214);
};
$A.submitForm=function(_215,url,_217,_218,_219,_21a){
var _21b=$C.getFormQueryString(_215);
if(_21b==-1){
$C.handleError(_218,"ajax.submitform.formnotfound","http",[_215],-1,null,true);
return;
}
if(!_219){
_219="POST";
}
_21a=!(_21a===false);
var _21c=function(req){
$A.submitForm.callback(req,_215,_217,_218);
};
$L.info("ajax.submitform.submitting","http",[_215]);
var _21e=$A.sendMessage(url,_219,_21b,_21a,_21c);
if(!_21a){
$L.info("ajax.submitform.success","http",[_215]);
return _21e.responseText;
}
};
$A.submitForm.callback=function(req,_220,_221,_222){
if($A.isRequestError(req)){
$C.handleError(_222,"ajax.submitform.error","http",[req.status,_220,req.statusText],req.status,req.statusText);
}else{
$L.info("ajax.submitform.success","http",[_220]);
if(_221){
_221(req.responseText);
}
}
};
$C.empty=function(){
};
$C.getFormQueryString=function(_223,_224){
var _225;
if(typeof _223=="string"){
_225=(document.getElementById(_223)||document.forms[_223]);
}else{
if(typeof _223=="object"){
_225=_223;
}
}
if(!_225){
return -1;
}
var _226,elementName,elementValue,elementDisabled;
var _227=false;
var _228=(_224)?{}:"";
for(var i=0;i<_225.elements.length;i++){
_226=_225.elements[i];
elementDisabled=_226.disabled;
elementName=_226.name;
elementValue=_226.value;
if(!elementDisabled&&elementName){
switch(_226.type){
case "select-one":
case "select-multiple":
for(var j=0;j<_226.options.length;j++){
if(_226.options[j].selected){
if(window.ActiveXObject){
_228=$C.getFormQueryString.processFormData(_228,_224,elementName,_226.options[j].attributes["value"].specified?_226.options[j].value:_226.options[j].text);
}else{
_228=$C.getFormQueryString.processFormData(_228,_224,elementName,_226.options[j].hasAttribute("value")?_226.options[j].value:_226.options[j].text);
}
}
}
break;
case "radio":
case "checkbox":
if(_226.checked){
_228=$C.getFormQueryString.processFormData(_228,_224,elementName,elementValue);
}
break;
case "file":
case undefined:
case "reset":
case "button":
break;
case "submit":
if(_227==false){
_228=$C.getFormQueryString.processFormData(_228,_224,elementName,elementValue);
_227=true;
}
break;
case "textarea":
var _22b;
if(window.FCKeditorAPI&&(_22b=$C.objectCache[elementName])&&_22b.richtextid){
var _22c=FCKeditorAPI.GetInstance(_22b.richtextid);
if(_22c){
elementValue=_22c.GetXHTML();
}
}
_228=$C.getFormQueryString.processFormData(_228,_224,elementName,elementValue);
break;
default:
_228=$C.getFormQueryString.processFormData(_228,_224,elementName,elementValue);
break;
}
}
}
if(!_224){
_228=_228.substr(0,_228.length-1);
}
return _228;
};
$C.getFormQueryString.processFormData=function(_22d,_22e,_22f,_230){
if(_22e){
if(_22d[_22f]){
_22d[_22f]+=","+_230;
}else{
_22d[_22f]=_230;
}
}else{
_22d+=encodeURIComponent(_22f)+"="+encodeURIComponent(_230)+"&";
}
return _22d;
};
$A.importTag=function(_231){
$C.importedTags.push(_231);
};
$A.checkImportedTag=function(_232){
var _233=false;
for(var i=0;i<$C.importedTags.length;i++){
if($C.importedTags[i]==_232){
_233=true;
break;
}
}
if(!_233){
$C.handleError(null,"ajax.checkimportedtag.error","widget",[_232]);
}
};
$C.getElementValue=function(_235,_236,_237){
if(!_235){
$C.handleError(null,"getelementvalue.noelementname","bind",null,null,null,true);
return;
}
if(!_237){
_237="value";
}
var _238=$B.getBindElementValue(_235,_236,_237);
if(typeof (_238)=="undefined"){
_238=null;
}
if(_238==null){
$C.handleError(null,"getelementvalue.elnotfound","bind",[_235,_237],null,null,true);
return;
}
return _238;
};
$B.getBindElementValue=function(_239,_23a,_23b,_23c,_23d){
var _23e="";
if(window[_239]){
var _23f=eval(_239);
if(_23f&&_23f._cf_getAttribute){
_23e=_23f._cf_getAttribute(_23b);
return _23e;
}
}
var _240=$C.objectCache[_239];
if(_240&&_240._cf_getAttribute){
_23e=_240._cf_getAttribute(_23b);
return _23e;
}
var el=$D.getElement(_239,_23a);
var _242=(el&&((!el.length&&el.length!=0)||(el.length&&el.length>0)||el.tagName=="SELECT"));
if(!_242&&!_23d){
$C.handleError(null,"bind.getbindelementvalue.elnotfound","bind",[_239]);
return null;
}
if(el.tagName!="SELECT"){
if(el.length>1){
var _243=true;
for(var i=0;i<el.length;i++){
var _245=(el[i].getAttribute("type")=="radio"||el[i].getAttribute("type")=="checkbox");
if(!_245||(_245&&el[i].checked)){
if(!_243){
_23e+=",";
}
_23e+=$B.getBindElementValue.extract(el[i],_23b);
_243=false;
}
}
}else{
_23e=$B.getBindElementValue.extract(el,_23b);
}
}else{
var _243=true;
for(var i=0;i<el.options.length;i++){
if(el.options[i].selected){
if(!_243){
_23e+=",";
}
_23e+=$B.getBindElementValue.extract(el.options[i],_23b);
_243=false;
}
}
}
if(typeof (_23e)=="object"){
$C.handleError(null,"bind.getbindelementvalue.simplevalrequired","bind",[_239,_23b]);
return null;
}
if(_23c&&$C.required[_239]&&_23e.length==0){
return null;
}
return _23e;
};
$B.getBindElementValue.extract=function(el,_247){
var _248=el[_247];
if((_248==null||typeof (_248)=="undefined")&&el.getAttribute){
_248=el.getAttribute(_247);
}
return _248;
};
$L.init=function(){
if(window.YAHOO&&YAHOO.widget&&YAHOO.widget.Logger){
YAHOO.widget.Logger.categories=[CFMessage["debug"],CFMessage["info"],CFMessage["error"],CFMessage["window"]];
YAHOO.widget.LogReader.prototype.formatMsg=function(_249){
var _24a=_249.category;
return "<p>"+"<span class='"+_24a+"'>"+_24a+"</span>:<i>"+_249.source+"</i>: "+_249.msg+"</p>";
};
var _24b=new YAHOO.widget.LogReader(null,{width:"30em",fontSize:"100%"});
_24b.setTitle(CFMessage["log.title"]||"ColdFusion AJAX Logger");
_24b._btnCollapse.value=CFMessage["log.collapse"]||"Collapse";
_24b._btnPause.value=CFMessage["log.pause"]||"Pause";
_24b._btnClear.value=CFMessage["log.clear"]||"Clear";
$L.isAvailable=true;
}
};
$L.log=function(_24c,_24d,_24e,_24f){
if(!$L.isAvailable){
return;
}
if(!_24e){
_24e="global";
}
_24e=CFMessage[_24e]||_24e;
_24d=CFMessage[_24d]||_24d;
_24c=$L.format(_24c,_24f);
YAHOO.log(_24c,_24d,_24e);
};
$L.format=function(code,_251){
var msg=CFMessage[code]||code;
if(_251){
for(i=0;i<_251.length;i++){
if(!_251[i].length){
_251[i]="";
}
var _253="{"+i+"}";
msg=msg.replace(_253,_251[i]);
}
}
return msg;
};
$L.debug=function(_254,_255,_256){
$L.log(_254,"debug",_255,_256);
};
$L.info=function(_257,_258,_259){
$L.log(_257,"info",_258,_259);
};
$L.error=function(_25a,_25b,_25c){
$L.log(_25a,"error",_25b,_25c);
};
$L.dump=function(_25d,_25e){
if($L.isAvailable){
var dump=(/string|number|undefined|boolean/.test(typeof (_25d))||_25d==null)?_25d:recurse(_25d,typeof _25d,true);
$L.debug(dump,_25e);
}
};
$X.invoke=function(_260,_261,_262,_263){
var _264="method="+_261;
var _265=_260.returnFormat||"json";
_264+="&returnFormat="+_265;
if(_260.queryFormat){
_264+="&queryFormat="+_260.queryFormat;
}
if(_260.formId){
var _266=$C.getFormQueryString(_260.formId,true);
if(_262!=null){
for(prop in _266){
_262[prop]=_266[prop];
}
}else{
_262=_266;
}
_260.formId=null;
}
var _267="";
if(_262!=null){
_267=$X.JSON.encode(_262);
_264+="&argumentCollection="+encodeURIComponent(_267);
}
$L.info("ajaxproxy.invoke.invoking","http",[_260.cfcPath,_261,_267]);
if(_260.callHandler){
_260.callHandler.call(null,_260.callHandlerParams,_260.cfcPath,_264);
return;
}
var _268;
if(_260.async){
_268=function(req){
$X.callback(req,_260,_263);
};
}
var req=$A.sendMessage(_260.cfcPath,_260.httpMethod,_264,_260.async,_268,null,true);
if(!_260.async){
return $X.processResponse(req,_260);
}
};
$X.callback=function(req,_26c,_26d){
if($A.isRequestError(req)){
$C.handleError(_26c.errorHandler,"ajaxproxy.invoke.error","http",[req.status,_26c.cfcPath,req.statusText],req.status,req.statusText);
}else{
if(_26c.callbackHandler){
var _26e=$X.processResponse(req,_26c);
_26c.callbackHandler(_26e,_26d);
}
}
};
$X.processResponse=function(req,_270){
var _271=true;
for(var i=0;i<req.responseText.length;i++){
var c=req.responseText.charAt(i);
_271=(c==" "||c=="\n"||c=="\t"||c=="\r");
if(!_271){
break;
}
}
var _274=(req.responseXML&&req.responseXML.childNodes.length>0);
var _275=_274?"[XML Document]":req.responseText;
$L.info("ajaxproxy.invoke.response","http",[_275]);
var _276;
var _277=_270.returnFormat||"json";
if(_277=="json"){
_276=_271?null:$X.JSON.decode(req.responseText);
}else{
_276=_274?req.responseXML:(_271?null:req.responseText);
}
return _276;
};
$X.init=function(_278,_279){
var _27a=_279.split(".");
var ns=self;
for(i=0;i<_27a.length-1;i++){
if(_27a[i].length){
ns[_27a[i]]=ns[_27a[i]]||{};
ns=ns[_27a[i]];
}
}
var _27c=_27a[_27a.length-1];
if(ns[_27c]){
return ns[_27c];
}
ns[_27c]=function(){
this.httpMethod="GET";
this.async=false;
this.callbackHandler=null;
this.errorHandler=null;
this.formId=null;
};
ns[_27c].prototype.cfcPath=_278;
ns[_27c].prototype.setHTTPMethod=function(_27d){
if(_27d){
_27d=_27d.toUpperCase();
}
if(_27d!="GET"&&_27d!="POST"){
$C.handleError(null,"ajaxproxy.sethttpmethod.invalidmethod","http",[_27d],null,null,true);
}
this.httpMethod=_27d;
};
ns[_27c].prototype.setSyncMode=function(){
this.async=false;
};
ns[_27c].prototype.setAsyncMode=function(){
this.async=true;
};
ns[_27c].prototype.setCallbackHandler=function(fn){
this.callbackHandler=fn;
this.setAsyncMode();
};
ns[_27c].prototype.setErrorHandler=function(fn){
this.errorHandler=fn;
this.setAsyncMode();
};
ns[_27c].prototype.setForm=function(fn){
this.formId=fn;
};
ns[_27c].prototype.setQueryFormat=function(_281){
if(_281){
_281=_281.toLowerCase();
}
if(!_281||(_281!="column"&&_281!="row")){
$C.handleError(null,"ajaxproxy.setqueryformat.invalidformat","http",[_281],null,null,true);
}
this.queryFormat=_281;
};
ns[_27c].prototype.setReturnFormat=function(_282){
if(_282){
_282=_282.toLowerCase();
}
if(!_282||(_282!="plain"&&_282!="json"&&_282!="wddx")){
$C.handleError(null,"ajaxproxy.setreturnformat.invalidformat","http",[_282],null,null,true);
}
this.returnFormat=_282;
};
$L.info("ajaxproxy.init.created","http",[_278]);
return ns[_27c];
};
$U.isWhitespace=function(s){
var _284=true;
for(var i=0;i<s.length;i++){
var c=s.charAt(i);
_284=(c==" "||c=="\n"||c=="\t"||c=="\r");
if(!_284){
break;
}
}
return _284;
};
$U.getFirstNonWhitespaceIndex=function(s){
var _288=true;
for(var i=0;i<s.length;i++){
var c=s.charAt(i);
_288=(c==" "||c=="\n"||c=="\t"||c=="\r");
if(!_288){
break;
}
}
return i;
};
$C.trim=function(_28b){
return _28b.replace(/^\s+|\s+$/g,"");
};
$U.isInteger=function(n){
var _28d=true;
if(typeof (n)=="number"){
_28d=(n>=0);
}else{
for(i=0;i<n.length;i++){
if($U.isInteger.numberChars.indexOf(n.charAt(i))==-1){
_28d=false;
break;
}
}
}
return _28d;
};
$U.isInteger.numberChars="0123456789";
$U.isArray=function(a){
return (typeof (a.length)=="number"&&!a.toUpperCase);
};
$U.isBoolean=function(b){
if(b===true||b===false){
return true;
}else{
if(b.toLowerCase){
b=b.toLowerCase();
return (b==$U.isBoolean.trueChars||b==$U.isBoolean.falseChars);
}else{
return false;
}
}
};
$U.isBoolean.trueChars="true";
$U.isBoolean.falseChars="false";
$U.castBoolean=function(b){
if(b===true){
return true;
}else{
if(b===false){
return false;
}else{
if(b.toLowerCase){
b=b.toLowerCase();
if(b==$U.isBoolean.trueChars){
return true;
}else{
if(b==$U.isBoolean.falseChars){
return false;
}else{
return false;
}
}
}else{
return false;
}
}
}
};
$U.checkQuery=function(o){
var _292=null;
if(o&&o.COLUMNS&&$U.isArray(o.COLUMNS)&&o.DATA&&$U.isArray(o.DATA)&&(o.DATA.length==0||(o.DATA.length>0&&$U.isArray(o.DATA[0])))){
_292="row";
}else{
if(o&&o.COLUMNS&&$U.isArray(o.COLUMNS)&&o.ROWCOUNT&&$U.isInteger(o.ROWCOUNT)&&o.DATA){
_292="col";
for(var i=0;i<o.COLUMNS.length;i++){
var _294=o.DATA[o.COLUMNS[i]];
if(!_294||!$U.isArray(_294)){
_292=null;
break;
}
}
}
}
return _292;
};
$X.JSON=new function(){
var _295={}.hasOwnProperty?true:false;
var _296=/^("(\\.|[^"\\\n\r])*?"|[,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t])+?$/;
var pad=function(n){
return n<10?"0"+n:n;
};
var m={"\b":"\\b","\t":"\\t","\n":"\\n","\f":"\\f","\r":"\\r","\"":"\\\"","\\":"\\\\"};
var _29a=function(s){
if(/["\\\x00-\x1f]/.test(s)){
return "\""+s.replace(/([\x00-\x1f\\"])/g,function(a,b){
var c=m[b];
if(c){
return c;
}
c=b.charCodeAt();
return "\\u00"+Math.floor(c/16).toString(16)+(c%16).toString(16);
})+"\"";
}
return "\""+s+"\"";
};
var _29f=function(o){
var a=["["],b,i,l=o.length,v;
for(i=0;i<l;i+=1){
v=o[i];
switch(typeof v){
case "undefined":
case "function":
case "unknown":
break;
default:
if(b){
a.push(",");
}
a.push(v===null?"null":$X.JSON.encode(v));
b=true;
}
}
a.push("]");
return a.join("");
};
var _2a2=function(o){
return "\""+o.getFullYear()+"-"+pad(o.getMonth()+1)+"-"+pad(o.getDate())+"T"+pad(o.getHours())+":"+pad(o.getMinutes())+":"+pad(o.getSeconds())+"\"";
};
this.encode=function(o){
if(typeof o=="undefined"||o===null){
return "null";
}else{
if(o instanceof Array){
return _29f(o);
}else{
if(o instanceof Date){
return _2a2(o);
}else{
if(typeof o=="string"){
return _29a(o);
}else{
if(typeof o=="number"){
return isFinite(o)?String(o):"null";
}else{
if(typeof o=="boolean"){
return String(o);
}else{
var a=["{"],b,i,v;
for(var i in o){
if(!_295||o.hasOwnProperty(i)){
v=o[i];
switch(typeof v){
case "undefined":
case "function":
case "unknown":
break;
default:
if(b){
a.push(",");
}
a.push(this.encode(i),":",v===null?"null":this.encode(v));
b=true;
}
}
}
a.push("}");
return a.join("");
}
}
}
}
}
}
};
this.decode=function(json){
if($U.isWhitespace(json)){
return null;
}
var _2a8=$U.getFirstNonWhitespaceIndex(json);
if(_2a8>0){
json=json.slice(_2a8);
}
if(window._cf_jsonprefix&&json.indexOf(_cf_jsonprefix)==0){
json=json.slice(_cf_jsonprefix.length);
}
try{
if(_296.test(json)){
return eval("("+json+")");
}
}
catch(e){
}
throw new SyntaxError("parseJSON");
};
}();
if(!$C.JSON){
$C.JSON={};
}
$C.JSON.encode=$X.JSON.encode;
$C.JSON.decode=$X.JSON.decode;
$C.navigate=function(url,_2aa,_2ab,_2ac,_2ad,_2ae){
if(url==null){
$C.handleError(_2ac,"navigate.urlrequired","widget");
return;
}
if(_2ad){
_2ad=_2ad.toUpperCase();
if(_2ad!="GET"&&_2ad!="POST"){
$C.handleError(null,"navigate.invalidhttpmethod","http",[_2ad],null,null,true);
}
}else{
_2ad="GET";
}
var _2af;
if(_2ae){
_2af=$C.getFormQueryString(_2ae);
if(_2af==-1){
$C.handleError(null,"navigate.formnotfound","http",[_2ae],null,null,true);
}
}
if(_2aa==null){
if(_2af){
if(url.indexOf("?")==-1){
url+="?"+_2af;
}else{
url+="&"+_2af;
}
}
$L.info("navigate.towindow","widget",[url]);
window.location.replace(url);
return;
}
$L.info("navigate.tocontainer","widget",[url,_2aa]);
var obj=$C.objectCache[_2aa];
if(obj!=null){
if(typeof (obj._cf_body)!="undefined"&&obj._cf_body!=null){
_2aa=obj._cf_body;
}
}
$A.replaceHTML(_2aa,url,_2ad,_2af,_2ab,_2ac);
};
$A.checkForm=function(_2b1,_2b2,_2b3,_2b4,_2b5){
var _2b6=_2b2.call(null,_2b1);
if(_2b6==false){
return false;
}
var _2b7=$C.getFormQueryString(_2b1);
$L.info("ajax.submitform.submitting","http",[_2b1.name]);
$A.replaceHTML(_2b3,_2b1.action,_2b1.method,_2b7,_2b4,_2b5);
return false;
};
$A.replaceHTML=function(_2b8,url,_2ba,_2bb,_2bc,_2bd){
var _2be=document.getElementById(_2b8);
if(!_2be){
$C.handleError(_2bd,"ajax.replacehtml.elnotfound","http",[_2b8]);
return;
}
var _2bf="_cf_containerId="+encodeURIComponent(_2b8);
_2bb=(_2bb)?_2bb+"&"+_2bf:_2bf;
$L.info("ajax.replacehtml.replacing","http",[_2b8,url,_2bb]);
if(_cf_loadingtexthtml){
try{
_2be.innerHTML=_cf_loadingtexthtml;
}
catch(e){
}
}
var _2c0=function(req,_2c2){
var _2c3=false;
if($A.isRequestError(req)){
$C.handleError(_2bd,"ajax.replacehtml.error","http",[req.status,_2c2.id,req.statusText],req.status,req.statusText);
_2c3=true;
}
var _2c4=new $E.CustomEvent("onReplaceHTML",_2c2);
var _2c5=new $E.CustomEvent("onReplaceHTMLUser",_2c2);
$E.loadEvents[_2c2.id]={system:_2c4,user:_2c5};
if(req.responseText.search(/<script/i)!=-1){
try{
_2c2.innerHTML="";
}
catch(e){
}
$A.replaceHTML.processResponseText(req.responseText,_2c2,_2bd);
}else{
try{
_2c2.innerHTML=req.responseText;
}
catch(e){
}
}
$E.loadEvents[_2c2.id]=null;
_2c4.fire();
_2c4.unsubscribe();
_2c5.fire();
_2c5.unsubscribe();
$L.info("ajax.replacehtml.success","http",[_2c2.id]);
if(_2bc&&!_2c3){
_2bc();
}
};
try{
$A.sendMessage(url,_2ba,_2bb,true,_2c0,_2be);
}
catch(e){
try{
_2be.innerHTML=$L.format(CFMessage["ajax.replacehtml.connectionerrordisplay"],[url,e]);
}
catch(e){
}
$C.handleError(_2bd,"ajax.replacehtml.connectionerror","http",[_2b8,url,e]);
}
};
$A.replaceHTML.processResponseText=function(text,_2c7,_2c8){
var pos=0;
var _2ca=0;
var _2cb=0;
_2c7._cf_innerHTML="";
while(pos<text.length){
var _2cc=text.indexOf("<s",pos);
if(_2cc==-1){
_2cc=text.indexOf("<S",pos);
}
if(_2cc==-1){
break;
}
pos=_2cc;
var _2cd=true;
var _2ce=$A.replaceHTML.processResponseText.scriptTagChars;
for(var i=1;i<_2ce.length;i++){
var _2d0=pos+i+1;
if(_2d0>text.length){
break;
}
var _2d1=text.charAt(_2d0);
if(_2ce[i][0]!=_2d1&&_2ce[i][1]!=_2d1){
pos+=i+1;
_2cd=false;
break;
}
}
if(!_2cd){
continue;
}
var _2d2=text.substring(_2ca,pos);
if(_2d2){
_2c7._cf_innerHTML+=_2d2;
}
var _2d3=text.indexOf(">",pos)+1;
if(_2d3==0){
pos++;
continue;
}else{
pos+=7;
}
var _2d4=_2d3;
while(_2d4<text.length&&_2d4!=-1){
_2d4=text.indexOf("</s",_2d4);
if(_2d4==-1){
_2d4=text.indexOf("</S",_2d4);
}
if(_2d4!=-1){
_2cd=true;
for(var i=1;i<_2ce.length;i++){
var _2d0=_2d4+2+i;
if(_2d0>text.length){
break;
}
var _2d1=text.charAt(_2d0);
if(_2ce[i][0]!=_2d1&&_2ce[i][1]!=_2d1){
_2d4=_2d0;
_2cd=false;
break;
}
}
if(_2cd){
break;
}
}
}
if(_2d4!=-1){
var _2d5=text.substring(_2d3,_2d4);
var _2d6=_2d5.indexOf("<!--");
if(_2d6!=-1){
_2d5=_2d5.substring(_2d6+4);
}
var _2d7=_2d5.lastIndexOf("//-->");
if(_2d7!=-1){
_2d5=_2d5.substring(0,_2d7-1);
}
if(_2d5.indexOf("document.write")!=-1){
_2d5="var _cfDomNode = document.getElementById('"+_2c7.id+"'); var _cfBuffer='';"+"if (!document._cf_write)"+"{document._cf_write = document.write;"+"document.write = function(str){if (_cfBuffer!=null){_cfBuffer+=str;}else{document._cf_write(str);}};};"+_2d5+";_cfDomNode._cf_innerHTML += _cfBuffer; _cfBuffer=null;";
}
try{
eval(_2d5);
}
catch(ex){
$C.handleError(_2c8,"ajax.replacehtml.jserror","http",[_2c7.id,ex]);
}
}
_2cc=text.indexOf(">",_2d4)+1;
if(_2cc==0){
_2cb=_2d4+1;
break;
}
_2cb=_2cc;
pos=_2cc;
_2ca=_2cc;
}
if(_2cb<text.length-1){
var _2d2=text.substring(_2cb,text.length);
if(_2d2){
_2c7._cf_innerHTML+=_2d2;
}
}
try{
_2c7.innerHTML=_2c7._cf_innerHTML;
}
catch(e){
}
_2c7._cf_innerHTML="";
};
$A.replaceHTML.processResponseText.scriptTagChars=[["s","S"],["c","C"],["r","R"],["i","I"],["p","P"],["t","T"]];
$D.getElement=function(_2d8,_2d9){
var _2da=function(_2db){
return (_2db.name==_2d8||_2db.id==_2d8);
};
var _2dc=$D.getElementsBy(_2da,null,_2d9);
if(_2dc.length==1){
return _2dc[0];
}else{
return _2dc;
}
};
$D.getElementsBy=function(_2dd,tag,root){
tag=tag||"*";
var _2e0=[];
if(root){
root=$D.get(root);
if(!root){
return _2e0;
}
}else{
root=document;
}
var _2e1=root.getElementsByTagName(tag);
if(!_2e1.length&&(tag=="*"&&root.all)){
_2e1=root.all;
}
for(var i=0,len=_2e1.length;i<len;++i){
if(_2dd(_2e1[i])){
_2e0[_2e0.length]=_2e1[i];
}
}
return _2e0;
};
$D.get=function(el){
if(!el){
return null;
}
if(typeof el!="string"&&!(el instanceof Array)){
return el;
}
if(typeof el=="string"){
return document.getElementById(el);
}else{
var _2e4=[];
for(var i=0,len=el.length;i<len;++i){
_2e4[_2e4.length]=$D.get(el[i]);
}
return _2e4;
}
return null;
};
$E.loadEvents={};
$E.CustomEvent=function(_2e6,_2e7){
return {name:_2e6,domNode:_2e7,subs:[],subscribe:function(func,_2e9){
var dup=false;
for(var i=0;i<this.subs.length;i++){
var sub=this.subs[i];
if(sub.f==func&&sub.p==_2e9){
dup=true;
break;
}
}
if(!dup){
this.subs.push({f:func,p:_2e9});
}
},fire:function(){
for(var i=0;i<this.subs.length;i++){
var sub=this.subs[i];
sub.f.call(null,this,sub.p);
}
},unsubscribe:function(){
this.subscribers=[];
}};
};
$E.windowLoadImpEvent=new $E.CustomEvent("cfWindowLoadImp");
$E.windowLoadEvent=new $E.CustomEvent("cfWindowLoad");
$E.windowLoadUserEvent=new $E.CustomEvent("cfWindowLoadUser");
$E.listeners=[];
$E.addListener=function(el,ev,fn,_2f2){
var l={el:el,ev:ev,fn:fn,params:_2f2};
$E.listeners.push(l);
var _2f4=function(e){
if(!e){
var e=window.event;
}
fn.call(null,e,_2f2);
};
if(el.addEventListener){
el.addEventListener(ev,_2f4,false);
return true;
}else{
if(el.attachEvent){
el.attachEvent("on"+ev,_2f4);
return true;
}else{
return false;
}
}
};
$E.isListener=function(el,ev,fn,_2f9){
var _2fa=false;
var ls=$E.listeners;
for(var i=0;i<ls.length;i++){
if(ls[i].el==el&&ls[i].ev==ev&&ls[i].fn==fn&&ls[i].params==_2f9){
_2fa=true;
break;
}
}
return _2fa;
};
$E.callBindHandlers=function(id,_2fe,ev){
var el=document.getElementById(id);
if(!el){
return;
}
var ls=$E.listeners;
for(var i=0;i<ls.length;i++){
if(ls[i].el==el&&ls[i].ev==ev&&ls[i].fn._cf_bindhandler){
ls[i].fn.call(null,null,ls[i].params);
}
}
};
$E.registerOnLoad=function(func,_304,_305,user){
if($E.registerOnLoad.windowLoaded){
if(_304&&_304._cf_containerId&&$E.loadEvents[_304._cf_containerId]){
if(user){
$E.loadEvents[_304._cf_containerId].user.subscribe(func,_304);
}else{
$E.loadEvents[_304._cf_containerId].system.subscribe(func,_304);
}
}else{
func.call(null,null,_304);
}
}else{
if(user){
$E.windowLoadUserEvent.subscribe(func,_304);
}else{
if(_305){
$E.windowLoadImpEvent.subscribe(func,_304);
}else{
$E.windowLoadEvent.subscribe(func,_304);
}
}
}
};
$E.registerOnLoad.windowLoaded=false;
$E.onWindowLoad=function(fn){
if(window.addEventListener){
window.addEventListener("load",fn,false);
}else{
if(window.attachEvent){
window.attachEvent("onload",fn);
}else{
if(document.getElementById){
window.onload=fn;
}
}
}
};
$C.addSpanToDom=function(){
var _308=document.createElement("span");
document.body.insertBefore(_308,document.body.firstChild);
};
$E.windowLoadHandler=function(e){
if(window.Ext){
Ext.BLANK_IMAGE_URL=_cf_contextpath+"/CFIDE/scripts/ajax/resources/ext/images/default/s.gif";
}
$C.addSpanToDom();
$L.init();
$E.registerOnLoad.windowLoaded=true;
$E.windowLoadImpEvent.fire();
$E.windowLoadImpEvent.unsubscribe();
$E.windowLoadEvent.fire();
$E.windowLoadEvent.unsubscribe();
$E.windowLoadUserEvent.fire();
$E.windowLoadUserEvent.unsubscribe();
};
$E.onWindowLoad($E.windowLoadHandler);
$B.register=function(_30a,_30b,_30c,_30d){
for(var i=0;i<_30a.length;i++){
var _30f=_30a[i][0];
var _310=_30a[i][1];
var _311=_30a[i][2];
if(window[_30f]){
var _312=eval(_30f);
if(_312&&_312._cf_register){
_312._cf_register(_311,_30c,_30b);
continue;
}
}
var _313=$C.objectCache[_30f];
if(_313&&_313._cf_register){
_313._cf_register(_311,_30c,_30b);
continue;
}
var _314=$D.getElement(_30f,_310);
var _315=(_314&&((!_314.length&&_314.length!=0)||(_314.length&&_314.length>0)||_314.tagName=="SELECT"));
if(!_315){
$C.handleError(null,"bind.register.elnotfound","bind",[_30f]);
}
if(_314.length>1&&!_314.options){
for(var i=0;i<_314.length;i++){
$B.register.addListener(_314[i],_311,_30c,_30b);
}
}else{
$B.register.addListener(_314,_311,_30c,_30b);
}
}
if(!$C.bindHandlerCache[_30b.bindTo]&&typeof (_30b.bindTo)=="string"){
$C.bindHandlerCache[_30b.bindTo]=function(){
_30c.call(null,null,_30b);
};
}
if(_30d){
_30c.call(null,null,_30b);
}
};
$B.register.addListener=function(_316,_317,_318,_319){
if(!$E.isListener(_316,_317,_318,_319)){
$E.addListener(_316,_317,_318,_319);
}
};
$B.assignValue=function(_31a,_31b,_31c,_31d){
if(!_31a){
return;
}
if(_31a.call){
_31a.call(null,_31c,_31d);
return;
}
var _31e=$C.objectCache[_31a];
if(_31e&&_31e._cf_setValue){
_31e._cf_setValue(_31c);
return;
}
var _31f=document.getElementById(_31a);
if(!_31f){
$C.handleError(null,"bind.assignvalue.elnotfound","bind",[_31a]);
}
if(_31f.tagName=="SELECT"){
var _320=$U.checkQuery(_31c);
var _321=$C.objectCache[_31a];
if(_320){
if(!_321||(_321&&(!_321.valueCol||!_321.displayCol))){
$C.handleError(null,"bind.assignvalue.selboxmissingvaldisplay","bind",[_31a]);
return;
}
}else{
if(typeof (_31c.length)=="number"&&!_31c.toUpperCase){
if(_31c.length>0&&(typeof (_31c[0].length)!="number"||_31c[0].toUpperCase)){
$C.handleError(null,"bind.assignvalue.selboxerror","bind",[_31a]);
return;
}
}else{
$C.handleError(null,"bind.assignvalue.selboxerror","bind",[_31a]);
return;
}
}
_31f.options.length=0;
if(!_320){
for(var i=0;i<_31c.length;i++){
var opt=new Option(_31c[i][1],_31c[i][0]);
_31f.options[i]=opt;
}
}else{
if(_320=="col"){
var _324=_31c.DATA[_321.valueCol];
var _325=_31c.DATA[_321.displayCol];
if(!_324||!_325){
$C.handleError(null,"bind.assignvalue.selboxinvalidvaldisplay","bind",[_31a]);
return;
}
for(var i=0;i<_324.length;i++){
var opt=new Option(_325[i],_324[i]);
_31f.options[i]=opt;
}
}else{
if(_320=="row"){
var _326=-1;
var _327=-1;
for(var i=0;i<_31c.COLUMNS.length;i++){
var col=_31c.COLUMNS[i];
if(col==_321.valueCol){
_326=i;
}
if(col==_321.displayCol){
_327=i;
}
if(_326!=-1&&_327!=-1){
break;
}
}
if(_326==-1||_327==-1){
$C.handleError(null,"bind.assignvalue.selboxinvalidvaldisplay","bind",[_31a]);
return;
}
for(var i=0;i<_31c.DATA.length;i++){
var opt=new Option(_31c.DATA[i][_327],_31c.DATA[i][_326]);
_31f.options[i]=opt;
}
}
}
}
}else{
_31f[_31b]=_31c;
}
$E.callBindHandlers(_31a,null,"change");
$L.info("bind.assignvalue.success","bind",[_31c,_31a,_31b]);
};
$B.localBindHandler=function(e,_32a){
var _32b=document.getElementById(_32a.bindTo);
var _32c=$B.evaluateBindTemplate(_32a,true);
$B.assignValue(_32a.bindTo,_32a.bindToAttr,_32c);
};
$B.localBindHandler._cf_bindhandler=true;
$B.evaluateBindTemplate=function(_32d,_32e,_32f,_330){
var _331=_32d.bindExpr;
var _332="";
for(var i=0;i<_331.length;i++){
if(typeof (_331[i])=="object"){
var _334=$B.getBindElementValue(_331[i][0],_331[i][1],_331[i][2],_32e,_330);
if(_334==null){
if(_32e){
_332="";
break;
}else{
_334="";
}
}
if(_32f){
_334=encodeURIComponent(_334);
}
_332+=_334;
}else{
_332+=_331[i];
}
}
return _332;
};
$B.jsBindHandler=function(e,_336){
var _337=_336.bindExpr;
var _338=_336.callFunction+"(";
for(var i=0;i<_337.length;i++){
var _33a;
if(typeof (_337[i])=="object"){
_33a=$B.getBindElementValue(_337[i][0],_337[i][1],_337[i][2],false);
}else{
_33a=_337[i];
}
if(_33a&&_33a.replace){
_33a=_33a.replace(/\\/g,"\\\\");
_33a=_33a.replace(/\'/g,"\\'");
}
if(i!=0){
_338+=",";
}
_338+="'"+_33a+"'";
}
_338+=")";
$L.info("bind.jsbindhandler.invoking","bind",[_338]);
var _33b=eval(_338);
$B.assignValue(_336.bindTo,_336.bindToAttr,_33b,_336.bindToParams);
};
$B.jsBindHandler._cf_bindhandler=true;
$B.urlBindHandler=function(e,_33d){
var _33e=_33d.bindTo;
if($C.objectCache[_33e]&&$C.objectCache[_33e]._cf_visible===false){
$C.objectCache[_33e]._cf_dirtyview=true;
return;
}
var url=$B.evaluateBindTemplate(_33d,false,true);
if(_33d.bindToAttr){
var _33d={"bindTo":_33d.bindTo,"bindToAttr":_33d.bindToAttr,"bindToParams":_33d.bindToParams,"errorHandler":_33d.errorHandler,"url":url};
try{
$A.sendMessage(url,"GET",null,true,$B.urlBindHandler.callback,_33d);
}
catch(e){
$C.handleError(_33d.errorHandler,"ajax.urlbindhandler.connectionerror","http",[url,e]);
}
}else{
$A.replaceHTML(_33e,url,null,null,null,_33d.errorHandler);
}
};
$B.urlBindHandler._cf_bindhandler=true;
$B.urlBindHandler.callback=function(req,_341){
if($A.isRequestError(req)){
$C.handleError(_341.errorHandler,"bind.urlbindhandler.httperror","http",[req.status,_341.url,req.statusText],req.status,req.statusText);
}else{
$L.info("bind.urlbindhandler.response","http",[req.responseText]);
var _342;
try{
_342=$X.JSON.decode(req.responseText);
}
catch(e){
$C.handleError(_341.errorHandler,"bind.urlbindhandler.jsonerror","http",[req.responseText]);
}
$B.assignValue(_341.bindTo,_341.bindToAttr,_342,_341.bindToParams);
}
};
$A.initSelect=function(_343,_344,_345){
$C.objectCache[_343]={"valueCol":_344,"displayCol":_345};
};
$S.setupSpry=function(){
if(typeof (Spry)!="undefined"&&Spry.Data){
Spry.Data.DataSet.prototype._cf_getAttribute=function(_346){
var val;
var row=this.getCurrentRow();
if(row){
val=row[_346];
}
return val;
};
Spry.Data.DataSet.prototype._cf_register=function(_349,_34a,_34b){
var obs={bindParams:_34b};
obs.onCurrentRowChanged=function(){
_34a.call(null,null,this.bindParams);
};
obs.onDataChanged=function(){
_34a.call(null,null,this.bindParams);
};
this.addObserver(obs);
};
if(Spry.Debug.trace){
var _34d=Spry.Debug.trace;
Spry.Debug.trace=function(str){
$L.info(str,"spry");
_34d(str);
};
}
if(Spry.Debug.reportError){
var _34f=Spry.Debug.reportError;
Spry.Debug.reportError=function(str){
$L.error(str,"spry");
_34f(str);
};
}
$L.info("spry.setupcomplete","bind");
}
};
$E.registerOnLoad($S.setupSpry,null,true);
$S.bindHandler=function(_351,_352){
var url;
var _354="_cf_nodebug=true&_cf_nocache=true";
if(window._cf_clientid){
_354+="&_cf_clientid="+_cf_clientid;
}
var _355=window[_352.bindTo];
var _356=(typeof (_355)=="undefined");
if(_352.cfc){
var _357={};
var _358=_352.bindExpr;
for(var i=0;i<_358.length;i++){
var _35a;
if(_358[i].length==2){
_35a=_358[i][1];
}else{
_35a=$B.getBindElementValue(_358[i][1],_358[i][2],_358[i][3],false,_356);
}
_357[_358[i][0]]=_35a;
}
_357=$X.JSON.encode(_357);
_354+="&method="+_352.cfcFunction;
_354+="&argumentCollection="+encodeURIComponent(_357);
$L.info("spry.bindhandler.loadingcfc","http",[_352.bindTo,_352.cfc,_352.cfcFunction,_357]);
url=_352.cfc;
}else{
url=$B.evaluateBindTemplate(_352,false,true,_356);
$L.info("spry.bindhandler.loadingurl","http",[_352.bindTo,url]);
}
var _35b=_352.options||{};
if((_355&&_355._cf_type=="json")||_352.dsType=="json"){
_354+="&returnformat=json";
}
if(_355){
if(_355.requestInfo.method=="GET"){
_35b.method="GET";
if(url.indexOf("?")==-1){
url+="?"+_354;
}else{
url+="&"+_354;
}
}else{
_35b.postData=_354;
_35b.method="POST";
_355.setURL("");
}
_355.setURL(url,_35b);
_355.loadData();
}else{
if(!_35b.method||_35b.method=="GET"){
if(url.indexOf("?")==-1){
url+="?"+_354;
}else{
url+="&"+_354;
}
}else{
_35b.postData=_354;
_35b.useCache=false;
}
var ds;
if(_352.dsType=="xml"){
ds=new Spry.Data.XMLDataSet(url,_352.xpath,_35b);
}else{
ds=new Spry.Data.JSONDataSet(url,_35b);
ds.preparseFunc=$S.preparseData;
}
ds._cf_type=_352.dsType;
var _35d={onLoadError:function(req){
$C.handleError(_352.errorHandler,"spry.bindhandler.error","http",[_352.bindTo,req.url,req.requestInfo.postData]);
}};
ds.addObserver(_35d);
window[_352.bindTo]=ds;
}
};
$S.bindHandler._cf_bindhandler=true;
$S.preparseData=function(ds,_360){
var _361=$U.getFirstNonWhitespaceIndex(_360);
if(_361>0){
_360=_360.slice(_361);
}
if(window._cf_jsonprefix&&_360.indexOf(_cf_jsonprefix)==0){
_360=_360.slice(_cf_jsonprefix.length);
}
return _360;
};
$P.init=function(_362){
$L.info("pod.init.creating","widget",[_362]);
var _363={};
_363._cf_body=_362+"_body";
$C.objectCache[_362]=_363;
};
$B.cfcBindHandler=function(e,_365){
var _366=(_365.httpMethod)?_365.httpMethod:"GET";
var _367={};
var _368=_365.bindExpr;
for(var i=0;i<_368.length;i++){
var _36a;
if(_368[i].length==2){
_36a=_368[i][1];
}else{
_36a=$B.getBindElementValue(_368[i][1],_368[i][2],_368[i][3],false);
}
_367[_368[i][0]]=_36a;
}
var _36b=function(_36c,_36d){
$B.assignValue(_36d.bindTo,_36d.bindToAttr,_36c,_36d.bindToParams);
};
var _36e={"bindTo":_365.bindTo,"bindToAttr":_365.bindToAttr,"bindToParams":_365.bindToParams};
var _36f={"async":true,"cfcPath":_365.cfc,"httpMethod":_366,"callbackHandler":_36b,"errorHandler":_365.errorHandler};
if(_365.proxyCallHandler){
_36f.callHandler=_365.proxyCallHandler;
_36f.callHandlerParams=_365;
}
$X.invoke(_36f,_365.cfcFunction,_367,_36e);
};
$B.cfcBindHandler._cf_bindhandler=true;
}
}
cfinit();
