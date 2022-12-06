(function(global,factory){if(typeof module==="object"&&typeof module.exports==="object"){module.exports=global.document?factory(global,true):function(w){if(!w.document){throw new Error("jQuery requires a window with a document");}
return factory(w);};}else{factory(global);}}(typeof window!=="undefined"?window:this,function(window,noGlobal){var deletedIds=[];var slice=deletedIds.slice;var concat=deletedIds.concat;var push=deletedIds.push;var indexOf=deletedIds.indexOf;var class2type={};var toString=class2type.toString;var hasOwn=class2type.hasOwnProperty;var support={};var
version="1.11.3",jQuery=function(selector,context){return new jQuery.fn.init(selector,context);},rtrim=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,rmsPrefix=/^-ms-/,rdashAlpha=/-([\da-z])/gi,fcamelCase=function(all,letter){return letter.toUpperCase();};jQuery.fn=jQuery.prototype={jquery:version,constructor:jQuery,selector:"",length:0,toArray:function(){return slice.call(this);},get:function(num){return num!=null?(num<0?this[num+this.length]:this[num]):slice.call(this);},pushStack:function(elems){var ret=jQuery.merge(this.constructor(),elems);ret.prevObject=this;ret.context=this.context;return ret;},each:function(callback,args){return jQuery.each(this,callback,args);},map:function(callback){return this.pushStack(jQuery.map(this,function(elem,i){return callback.call(elem,i,elem);}));},slice:function(){return this.pushStack(slice.apply(this,arguments));},first:function(){return this.eq(0);},last:function(){return this.eq(-1);},eq:function(i){var len=this.length,j=+i+(i<0?len:0);return this.pushStack(j>=0&&j<len?[this[j]]:[]);},end:function(){return this.prevObject||this.constructor(null);},push:push,sort:deletedIds.sort,splice:deletedIds.splice};jQuery.extend=jQuery.fn.extend=function(){var src,copyIsArray,copy,name,options,clone,target=arguments[0]||{},i=1,length=arguments.length,deep=false;if(typeof target==="boolean"){deep=target;target=arguments[i]||{};i++;}
if(typeof target!=="object"&&!jQuery.isFunction(target)){target={};}
if(i===length){target=this;i--;}
for(;i<length;i++){if((options=arguments[i])!=null){for(name in options){src=target[name];copy=options[name];if(target===copy){continue;}
if(deep&&copy&&(jQuery.isPlainObject(copy)||(copyIsArray=jQuery.isArray(copy)))){if(copyIsArray){copyIsArray=false;clone=src&&jQuery.isArray(src)?src:[];}else{clone=src&&jQuery.isPlainObject(src)?src:{};}
target[name]=jQuery.extend(deep,clone,copy);}else if(copy!==undefined){target[name]=copy;}}}}
return target;};jQuery.extend({expando:"jQuery"+(version+Math.random()).replace(/\D/g,""),isReady:true,error:function(msg){throw new Error(msg);},noop:function(){},isFunction:function(obj){return jQuery.type(obj)==="function";},isArray:Array.isArray||function(obj){return jQuery.type(obj)==="array";},isWindow:function(obj){return obj!=null&&obj==obj.window;},isNumeric:function(obj){return!jQuery.isArray(obj)&&(obj-parseFloat(obj)+1)>=0;},isEmptyObject:function(obj){var name;for(name in obj){return false;}
return true;},isPlainObject:function(obj){var key;if(!obj||jQuery.type(obj)!=="object"||obj.nodeType||jQuery.isWindow(obj)){return false;}
try{if(obj.constructor&&!hasOwn.call(obj,"constructor")&&!hasOwn.call(obj.constructor.prototype,"isPrototypeOf")){return false;}}catch(e){return false;}
if(support.ownLast){for(key in obj){return hasOwn.call(obj,key);}}
for(key in obj){}
return key===undefined||hasOwn.call(obj,key);},type:function(obj){if(obj==null){return obj+"";}
return typeof obj==="object"||typeof obj==="function"?class2type[toString.call(obj)]||"object":typeof obj;},globalEval:function(data){if(data&&jQuery.trim(data)){(window.execScript||function(data){window["eval"].call(window,data);})(data);}},camelCase:function(string){return string.replace(rmsPrefix,"ms-").replace(rdashAlpha,fcamelCase);},nodeName:function(elem,name){return elem.nodeName&&elem.nodeName.toLowerCase()===name.toLowerCase();},each:function(obj,callback,args){var value,i=0,length=obj.length,isArray=isArraylike(obj);if(args){if(isArray){for(;i<length;i++){value=callback.apply(obj[i],args);if(value===false){break;}}}else{for(i in obj){value=callback.apply(obj[i],args);if(value===false){break;}}}}else{if(isArray){for(;i<length;i++){value=callback.call(obj[i],i,obj[i]);if(value===false){break;}}}else{for(i in obj){value=callback.call(obj[i],i,obj[i]);if(value===false){break;}}}}
return obj;},trim:function(text){return text==null?"":(text+"").replace(rtrim,"");},makeArray:function(arr,results){var ret=results||[];if(arr!=null){if(isArraylike(Object(arr))){jQuery.merge(ret,typeof arr==="string"?[arr]:arr);}else{push.call(ret,arr);}}
return ret;},inArray:function(elem,arr,i){var len;if(arr){if(indexOf){return indexOf.call(arr,elem,i);}
len=arr.length;i=i?i<0?Math.max(0,len+i):i:0;for(;i<len;i++){if(i in arr&&arr[i]===elem){return i;}}}
return-1;},merge:function(first,second){var len=+second.length,j=0,i=first.length;while(j<len){first[i++]=second[j++];}
if(len!==len){while(second[j]!==undefined){first[i++]=second[j++];}}
first.length=i;return first;},grep:function(elems,callback,invert){var callbackInverse,matches=[],i=0,length=elems.length,callbackExpect=!invert;for(;i<length;i++){callbackInverse=!callback(elems[i],i);if(callbackInverse!==callbackExpect){matches.push(elems[i]);}}
return matches;},map:function(elems,callback,arg){var value,i=0,length=elems.length,isArray=isArraylike(elems),ret=[];if(isArray){for(;i<length;i++){value=callback(elems[i],i,arg);if(value!=null){ret.push(value);}}}else{for(i in elems){value=callback(elems[i],i,arg);if(value!=null){ret.push(value);}}}
return concat.apply([],ret);},guid:1,proxy:function(fn,context){var args,proxy,tmp;if(typeof context==="string"){tmp=fn[context];context=fn;fn=tmp;}
if(!jQuery.isFunction(fn)){return undefined;}
args=slice.call(arguments,2);proxy=function(){return fn.apply(context||this,args.concat(slice.call(arguments)));};proxy.guid=fn.guid=fn.guid||jQuery.guid++;return proxy;},now:function(){return+(new Date());},support:support});jQuery.each("Boolean Number String Function Array Date RegExp Object Error".split(" "),function(i,name){class2type["[object "+name+"]"]=name.toLowerCase();});function isArraylike(obj){var length="length"in obj&&obj.length,type=jQuery.type(obj);if(type==="function"||jQuery.isWindow(obj)){return false;}
if(obj.nodeType===1&&length){return true;}
return type==="array"||length===0||typeof length==="number"&&length>0&&(length-1)in obj;}
var Sizzle=(function(window){var i,support,Expr,getText,isXML,tokenize,compile,select,outermostContext,sortInput,hasDuplicate,setDocument,document,docElem,documentIsHTML,rbuggyQSA,rbuggyMatches,matches,contains,expando="sizzle"+1*new Date(),preferredDoc=window.document,dirruns=0,done=0,classCache=createCache(),tokenCache=createCache(),compilerCache=createCache(),sortOrder=function(a,b){if(a===b){hasDuplicate=true;}
return 0;},MAX_NEGATIVE=1<<31,hasOwn=({}).hasOwnProperty,arr=[],pop=arr.pop,push_native=arr.push,push=arr.push,slice=arr.slice,indexOf=function(list,elem){var i=0,len=list.length;for(;i<len;i++){if(list[i]===elem){return i;}}
return-1;},booleans="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",whitespace="[\\x20\\t\\r\\n\\f]",characterEncoding="(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",identifier=characterEncoding.replace("w","w#"),attributes="\\["+whitespace+"*("+characterEncoding+")(?:"+whitespace+"*([*^$|!~]?=)"+whitespace+"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+identifier+"))|)"+whitespace+"*\\]",pseudos=":("+characterEncoding+")(?:\\(("+"('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|"+"((?:\\\\.|[^\\\\()[\\]]|"+attributes+")*)|"+".*"+")\\)|)",rwhitespace=new RegExp(whitespace+"+","g"),rtrim=new RegExp("^"+whitespace+"+|((?:^|[^\\\\])(?:\\\\.)*)"+whitespace+"+$","g"),rcomma=new RegExp("^"+whitespace+"*,"+whitespace+"*"),rcombinators=new RegExp("^"+whitespace+"*([>+~]|"+whitespace+")"+whitespace+"*"),rattributeQuotes=new RegExp("="+whitespace+"*([^\\]'\"]*?)"+whitespace+"*\\]","g"),rpseudo=new RegExp(pseudos),ridentifier=new RegExp("^"+identifier+"$"),matchExpr={"ID":new RegExp("^#("+characterEncoding+")"),"CLASS":new RegExp("^\\.("+characterEncoding+")"),"TAG":new RegExp("^("+characterEncoding.replace("w","w*")+")"),"ATTR":new RegExp("^"+attributes),"PSEUDO":new RegExp("^"+pseudos),"CHILD":new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+whitespace+"*(even|odd|(([+-]|)(\\d*)n|)"+whitespace+"*(?:([+-]|)"+whitespace+"*(\\d+)|))"+whitespace+"*\\)|)","i"),"bool":new RegExp("^(?:"+booleans+")$","i"),"needsContext":new RegExp("^"+whitespace+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+whitespace+"*((?:-\\d)?\\d*)"+whitespace+"*\\)|)(?=[^-]|$)","i")},rinputs=/^(?:input|select|textarea|button)$/i,rheader=/^h\d$/i,rnative=/^[^{]+\{\s*\[native \w/,rquickExpr=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,rsibling=/[+~]/,rescape=/'|\\/g,runescape=new RegExp("\\\\([\\da-f]{1,6}"+whitespace+"?|("+whitespace+")|.)","ig"),funescape=function(_,escaped,escapedWhitespace){var high="0x"+escaped-0x10000;return high!==high||escapedWhitespace?escaped:high<0?String.fromCharCode(high+0x10000):String.fromCharCode(high>>10|0xD800,high&0x3FF|0xDC00);},unloadHandler=function(){setDocument();};try{push.apply((arr=slice.call(preferredDoc.childNodes)),preferredDoc.childNodes);arr[preferredDoc.childNodes.length].nodeType;}catch(e){push={apply:arr.length?function(target,els){push_native.apply(target,slice.call(els));}:function(target,els){var j=target.length,i=0;while((target[j++]=els[i++])){}
target.length=j-1;}};}
function Sizzle(selector,context,results,seed){var match,elem,m,nodeType,i,groups,old,nid,newContext,newSelector;if((context?context.ownerDocument||context:preferredDoc)!==document){setDocument(context);}
context=context||document;results=results||[];nodeType=context.nodeType;if(typeof selector!=="string"||!selector||nodeType!==1&&nodeType!==9&&nodeType!==11){return results;}
if(!seed&&documentIsHTML){if(nodeType!==11&&(match=rquickExpr.exec(selector))){if((m=match[1])){if(nodeType===9){elem=context.getElementById(m);if(elem&&elem.parentNode){if(elem.id===m){results.push(elem);return results;}}else{return results;}}else{if(context.ownerDocument&&(elem=context.ownerDocument.getElementById(m))&&contains(context,elem)&&elem.id===m){results.push(elem);return results;}}}else if(match[2]){push.apply(results,context.getElementsByTagName(selector));return results;}else if((m=match[3])&&support.getElementsByClassName){push.apply(results,context.getElementsByClassName(m));return results;}}
if(support.qsa&&(!rbuggyQSA||!rbuggyQSA.test(selector))){nid=old=expando;newContext=context;newSelector=nodeType!==1&&selector;if(nodeType===1&&context.nodeName.toLowerCase()!=="object"){groups=tokenize(selector);if((old=context.getAttribute("id"))){nid=old.replace(rescape,"\\$&");}else{context.setAttribute("id",nid);}
nid="[id='"+nid+"'] ";i=groups.length;while(i--){groups[i]=nid+toSelector(groups[i]);}
newContext=rsibling.test(selector)&&testContext(context.parentNode)||context;newSelector=groups.join(",");}
if(newSelector){try{push.apply(results,newContext.querySelectorAll(newSelector));return results;}catch(qsaError){}finally{if(!old){context.removeAttribute("id");}}}}}
return select(selector.replace(rtrim,"$1"),context,results,seed);}
function createCache(){var keys=[];function cache(key,value){if(keys.push(key+" ")>Expr.cacheLength){delete cache[keys.shift()];}
return(cache[key+" "]=value);}
return cache;}
function markFunction(fn){fn[expando]=true;return fn;}
function assert(fn){var div=document.createElement("div");try{return!!fn(div);}catch(e){return false;}finally{if(div.parentNode){div.parentNode.removeChild(div);}
div=null;}}
function addHandle(attrs,handler){var arr=attrs.split("|"),i=attrs.length;while(i--){Expr.attrHandle[arr[i]]=handler;}}
function siblingCheck(a,b){var cur=b&&a,diff=cur&&a.nodeType===1&&b.nodeType===1&&(~b.sourceIndex||MAX_NEGATIVE)-(~a.sourceIndex||MAX_NEGATIVE);if(diff){return diff;}
if(cur){while((cur=cur.nextSibling)){if(cur===b){return-1;}}}
return a?1:-1;}
function createInputPseudo(type){return function(elem){var name=elem.nodeName.toLowerCase();return name==="input"&&elem.type===type;};}
function createButtonPseudo(type){return function(elem){var name=elem.nodeName.toLowerCase();return(name==="input"||name==="button")&&elem.type===type;};}
function createPositionalPseudo(fn){return markFunction(function(argument){argument=+argument;return markFunction(function(seed,matches){var j,matchIndexes=fn([],seed.length,argument),i=matchIndexes.length;while(i--){if(seed[(j=matchIndexes[i])]){seed[j]=!(matches[j]=seed[j]);}}});});}
function testContext(context){return context&&typeof context.getElementsByTagName!=="undefined"&&context;}
support=Sizzle.support={};isXML=Sizzle.isXML=function(elem){var documentElement=elem&&(elem.ownerDocument||elem).documentElement;return documentElement?documentElement.nodeName!=="HTML":false;};setDocument=Sizzle.setDocument=function(node){var hasCompare,parent,doc=node?node.ownerDocument||node:preferredDoc;if(doc===document||doc.nodeType!==9||!doc.documentElement){return document;}
document=doc;docElem=doc.documentElement;parent=doc.defaultView;if(parent&&parent!==parent.top){if(parent.addEventListener){parent.addEventListener("unload",unloadHandler,false);}else if(parent.attachEvent){parent.attachEvent("onunload",unloadHandler);}}
documentIsHTML=!isXML(doc);support.attributes=assert(function(div){div.className="i";return!div.getAttribute("className");});support.getElementsByTagName=assert(function(div){div.appendChild(doc.createComment(""));return!div.getElementsByTagName("*").length;});support.getElementsByClassName=rnative.test(doc.getElementsByClassName);support.getById=assert(function(div){docElem.appendChild(div).id=expando;return!doc.getElementsByName||!doc.getElementsByName(expando).length;});if(support.getById){Expr.find["ID"]=function(id,context){if(typeof context.getElementById!=="undefined"&&documentIsHTML){var m=context.getElementById(id);return m&&m.parentNode?[m]:[];}};Expr.filter["ID"]=function(id){var attrId=id.replace(runescape,funescape);return function(elem){return elem.getAttribute("id")===attrId;};};}else{delete Expr.find["ID"];Expr.filter["ID"]=function(id){var attrId=id.replace(runescape,funescape);return function(elem){var node=typeof elem.getAttributeNode!=="undefined"&&elem.getAttributeNode("id");return node&&node.value===attrId;};};}
Expr.find["TAG"]=support.getElementsByTagName?function(tag,context){if(typeof context.getElementsByTagName!=="undefined"){return context.getElementsByTagName(tag);}else if(support.qsa){return context.querySelectorAll(tag);}}:function(tag,context){var elem,tmp=[],i=0,results=context.getElementsByTagName(tag);if(tag==="*"){while((elem=results[i++])){if(elem.nodeType===1){tmp.push(elem);}}
return tmp;}
return results;};Expr.find["CLASS"]=support.getElementsByClassName&&function(className,context){if(documentIsHTML){return context.getElementsByClassName(className);}};rbuggyMatches=[];rbuggyQSA=[];if((support.qsa=rnative.test(doc.querySelectorAll))){assert(function(div){docElem.appendChild(div).innerHTML="<a id='"+expando+"'></a>"+"<select id='"+expando+"-\f]' msallowcapture=''>"+"<option selected=''></option></select>";if(div.querySelectorAll("[msallowcapture^='']").length){rbuggyQSA.push("[*^$]="+whitespace+"*(?:''|\"\")");}
if(!div.querySelectorAll("[selected]").length){rbuggyQSA.push("\\["+whitespace+"*(?:value|"+booleans+")");}
if(!div.querySelectorAll("[id~="+expando+"-]").length){rbuggyQSA.push("~=");}
if(!div.querySelectorAll(":checked").length){rbuggyQSA.push(":checked");}
if(!div.querySelectorAll("a#"+expando+"+*").length){rbuggyQSA.push(".#.+[+~]");}});assert(function(div){var input=doc.createElement("input");input.setAttribute("type","hidden");div.appendChild(input).setAttribute("name","D");if(div.querySelectorAll("[name=d]").length){rbuggyQSA.push("name"+whitespace+"*[*^$|!~]?=");}
if(!div.querySelectorAll(":enabled").length){rbuggyQSA.push(":enabled",":disabled");}
div.querySelectorAll("*,:x");rbuggyQSA.push(",.*:");});}
if((support.matchesSelector=rnative.test((matches=docElem.matches||docElem.webkitMatchesSelector||docElem.mozMatchesSelector||docElem.oMatchesSelector||docElem.msMatchesSelector)))){assert(function(div){support.disconnectedMatch=matches.call(div,"div");matches.call(div,"[s!='']:x");rbuggyMatches.push("!=",pseudos);});}
rbuggyQSA=rbuggyQSA.length&&new RegExp(rbuggyQSA.join("|"));rbuggyMatches=rbuggyMatches.length&&new RegExp(rbuggyMatches.join("|"));hasCompare=rnative.test(docElem.compareDocumentPosition);contains=hasCompare||rnative.test(docElem.contains)?function(a,b){var adown=a.nodeType===9?a.documentElement:a,bup=b&&b.parentNode;return a===bup||!!(bup&&bup.nodeType===1&&(adown.contains?adown.contains(bup):a.compareDocumentPosition&&a.compareDocumentPosition(bup)&16));}:function(a,b){if(b){while((b=b.parentNode)){if(b===a){return true;}}}
return false;};sortOrder=hasCompare?function(a,b){if(a===b){hasDuplicate=true;return 0;}
var compare=!a.compareDocumentPosition-!b.compareDocumentPosition;if(compare){return compare;}
compare=(a.ownerDocument||a)===(b.ownerDocument||b)?a.compareDocumentPosition(b):1;if(compare&1||(!support.sortDetached&&b.compareDocumentPosition(a)===compare)){if(a===doc||a.ownerDocument===preferredDoc&&contains(preferredDoc,a)){return-1;}
if(b===doc||b.ownerDocument===preferredDoc&&contains(preferredDoc,b)){return 1;}
return sortInput?(indexOf(sortInput,a)-indexOf(sortInput,b)):0;}
return compare&4?-1:1;}:function(a,b){if(a===b){hasDuplicate=true;return 0;}
var cur,i=0,aup=a.parentNode,bup=b.parentNode,ap=[a],bp=[b];if(!aup||!bup){return a===doc?-1:b===doc?1:aup?-1:bup?1:sortInput?(indexOf(sortInput,a)-indexOf(sortInput,b)):0;}else if(aup===bup){return siblingCheck(a,b);}
cur=a;while((cur=cur.parentNode)){ap.unshift(cur);}
cur=b;while((cur=cur.parentNode)){bp.unshift(cur);}
while(ap[i]===bp[i]){i++;}
return i?siblingCheck(ap[i],bp[i]):ap[i]===preferredDoc?-1:bp[i]===preferredDoc?1:0;};return doc;};Sizzle.matches=function(expr,elements){return Sizzle(expr,null,null,elements);};Sizzle.matchesSelector=function(elem,expr){if((elem.ownerDocument||elem)!==document){setDocument(elem);}
expr=expr.replace(rattributeQuotes,"='$1']");if(support.matchesSelector&&documentIsHTML&&(!rbuggyMatches||!rbuggyMatches.test(expr))&&(!rbuggyQSA||!rbuggyQSA.test(expr))){try{var ret=matches.call(elem,expr);if(ret||support.disconnectedMatch||elem.document&&elem.document.nodeType!==11){return ret;}}catch(e){}}
return Sizzle(expr,document,null,[elem]).length>0;};Sizzle.contains=function(context,elem){if((context.ownerDocument||context)!==document){setDocument(context);}
return contains(context,elem);};Sizzle.attr=function(elem,name){if((elem.ownerDocument||elem)!==document){setDocument(elem);}
var fn=Expr.attrHandle[name.toLowerCase()],val=fn&&hasOwn.call(Expr.attrHandle,name.toLowerCase())?fn(elem,name,!documentIsHTML):undefined;return val!==undefined?val:support.attributes||!documentIsHTML?elem.getAttribute(name):(val=elem.getAttributeNode(name))&&val.specified?val.value:null;};Sizzle.error=function(msg){throw new Error("Syntax error, unrecognized expression: "+msg);};Sizzle.uniqueSort=function(results){var elem,duplicates=[],j=0,i=0;hasDuplicate=!support.detectDuplicates;sortInput=!support.sortStable&&results.slice(0);results.sort(sortOrder);if(hasDuplicate){while((elem=results[i++])){if(elem===results[i]){j=duplicates.push(i);}}
while(j--){results.splice(duplicates[j],1);}}
sortInput=null;return results;};getText=Sizzle.getText=function(elem){var node,ret="",i=0,nodeType=elem.nodeType;if(!nodeType){while((node=elem[i++])){ret+=getText(node);}}else if(nodeType===1||nodeType===9||nodeType===11){if(typeof elem.textContent==="string"){return elem.textContent;}else{for(elem=elem.firstChild;elem;elem=elem.nextSibling){ret+=getText(elem);}}}else if(nodeType===3||nodeType===4){return elem.nodeValue;}
return ret;};Expr=Sizzle.selectors={cacheLength:50,createPseudo:markFunction,match:matchExpr,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:true}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:true},"~":{dir:"previousSibling"}},preFilter:{"ATTR":function(match){match[1]=match[1].replace(runescape,funescape);match[3]=(match[3]||match[4]||match[5]||"").replace(runescape,funescape);if(match[2]==="~="){match[3]=" "+match[3]+" ";}
return match.slice(0,4);},"CHILD":function(match){match[1]=match[1].toLowerCase();if(match[1].slice(0,3)==="nth"){if(!match[3]){Sizzle.error(match[0]);}
match[4]=+(match[4]?match[5]+(match[6]||1):2*(match[3]==="even"||match[3]==="odd"));match[5]=+((match[7]+match[8])||match[3]==="odd");}else if(match[3]){Sizzle.error(match[0]);}
return match;},"PSEUDO":function(match){var excess,unquoted=!match[6]&&match[2];if(matchExpr["CHILD"].test(match[0])){return null;}
if(match[3]){match[2]=match[4]||match[5]||"";}else if(unquoted&&rpseudo.test(unquoted)&&(excess=tokenize(unquoted,true))&&(excess=unquoted.indexOf(")",unquoted.length-excess)-unquoted.length)){match[0]=match[0].slice(0,excess);match[2]=unquoted.slice(0,excess);}
return match.slice(0,3);}},filter:{"TAG":function(nodeNameSelector){var nodeName=nodeNameSelector.replace(runescape,funescape).toLowerCase();return nodeNameSelector==="*"?function(){return true;}:function(elem){return elem.nodeName&&elem.nodeName.toLowerCase()===nodeName;};},"CLASS":function(className){var pattern=classCache[className+" "];return pattern||(pattern=new RegExp("(^|"+whitespace+")"+className+"("+whitespace+"|$)"))&&classCache(className,function(elem){return pattern.test(typeof elem.className==="string"&&elem.className||typeof elem.getAttribute!=="undefined"&&elem.getAttribute("class")||"");});},"ATTR":function(name,operator,check){return function(elem){var result=Sizzle.attr(elem,name);if(result==null){return operator==="!=";}
if(!operator){return true;}
result+="";return operator==="="?result===check:operator==="!="?result!==check:operator==="^="?check&&result.indexOf(check)===0:operator==="*="?check&&result.indexOf(check)>-1:operator==="$="?check&&result.slice(-check.length)===check:operator==="~="?(" "+result.replace(rwhitespace," ")+" ").indexOf(check)>-1:operator==="|="?result===check||result.slice(0,check.length+1)===check+"-":false;};},"CHILD":function(type,what,argument,first,last){var simple=type.slice(0,3)!=="nth",forward=type.slice(-4)!=="last",ofType=what==="of-type";return first===1&&last===0?function(elem){return!!elem.parentNode;}:function(elem,context,xml){var cache,outerCache,node,diff,nodeIndex,start,dir=simple!==forward?"nextSibling":"previousSibling",parent=elem.parentNode,name=ofType&&elem.nodeName.toLowerCase(),useCache=!xml&&!ofType;if(parent){if(simple){while(dir){node=elem;while((node=node[dir])){if(ofType?node.nodeName.toLowerCase()===name:node.nodeType===1){return false;}}
start=dir=type==="only"&&!start&&"nextSibling";}
return true;}
start=[forward?parent.firstChild:parent.lastChild];if(forward&&useCache){outerCache=parent[expando]||(parent[expando]={});cache=outerCache[type]||[];nodeIndex=cache[0]===dirruns&&cache[1];diff=cache[0]===dirruns&&cache[2];node=nodeIndex&&parent.childNodes[nodeIndex];while((node=++nodeIndex&&node&&node[dir]||(diff=nodeIndex=0)||start.pop())){if(node.nodeType===1&&++diff&&node===elem){outerCache[type]=[dirruns,nodeIndex,diff];break;}}}else if(useCache&&(cache=(elem[expando]||(elem[expando]={}))[type])&&cache[0]===dirruns){diff=cache[1];}else{while((node=++nodeIndex&&node&&node[dir]||(diff=nodeIndex=0)||start.pop())){if((ofType?node.nodeName.toLowerCase()===name:node.nodeType===1)&&++diff){if(useCache){(node[expando]||(node[expando]={}))[type]=[dirruns,diff];}
if(node===elem){break;}}}}
diff-=last;return diff===first||(diff%first===0&&diff/first>=0);}};},"PSEUDO":function(pseudo,argument){var args,fn=Expr.pseudos[pseudo]||Expr.setFilters[pseudo.toLowerCase()]||Sizzle.error("unsupported pseudo: "+pseudo);if(fn[expando]){return fn(argument);}
if(fn.length>1){args=[pseudo,pseudo,"",argument];return Expr.setFilters.hasOwnProperty(pseudo.toLowerCase())?markFunction(function(seed,matches){var idx,matched=fn(seed,argument),i=matched.length;while(i--){idx=indexOf(seed,matched[i]);seed[idx]=!(matches[idx]=matched[i]);}}):function(elem){return fn(elem,0,args);};}
return fn;}},pseudos:{"not":markFunction(function(selector){var input=[],results=[],matcher=compile(selector.replace(rtrim,"$1"));return matcher[expando]?markFunction(function(seed,matches,context,xml){var elem,unmatched=matcher(seed,null,xml,[]),i=seed.length;while(i--){if((elem=unmatched[i])){seed[i]=!(matches[i]=elem);}}}):function(elem,context,xml){input[0]=elem;matcher(input,null,xml,results);input[0]=null;return!results.pop();};}),"has":markFunction(function(selector){return function(elem){return Sizzle(selector,elem).length>0;};}),"contains":markFunction(function(text){text=text.replace(runescape,funescape);return function(elem){return(elem.textContent||elem.innerText||getText(elem)).indexOf(text)>-1;};}),"lang":markFunction(function(lang){if(!ridentifier.test(lang||"")){Sizzle.error("unsupported lang: "+lang);}
lang=lang.replace(runescape,funescape).toLowerCase();return function(elem){var elemLang;do{if((elemLang=documentIsHTML?elem.lang:elem.getAttribute("xml:lang")||elem.getAttribute("lang"))){elemLang=elemLang.toLowerCase();return elemLang===lang||elemLang.indexOf(lang+"-")===0;}}while((elem=elem.parentNode)&&elem.nodeType===1);return false;};}),"target":function(elem){var hash=window.location&&window.location.hash;return hash&&hash.slice(1)===elem.id;},"root":function(elem){return elem===docElem;},"focus":function(elem){return elem===document.activeElement&&(!document.hasFocus||document.hasFocus())&&!!(elem.type||elem.href||~elem.tabIndex);},"enabled":function(elem){return elem.disabled===false;},"disabled":function(elem){return elem.disabled===true;},"checked":function(elem){var nodeName=elem.nodeName.toLowerCase();return(nodeName==="input"&&!!elem.checked)||(nodeName==="option"&&!!elem.selected);},"selected":function(elem){if(elem.parentNode){elem.parentNode.selectedIndex;}
return elem.selected===true;},"empty":function(elem){for(elem=elem.firstChild;elem;elem=elem.nextSibling){if(elem.nodeType<6){return false;}}
return true;},"parent":function(elem){return!Expr.pseudos["empty"](elem);},"header":function(elem){return rheader.test(elem.nodeName);},"input":function(elem){return rinputs.test(elem.nodeName);},"button":function(elem){var name=elem.nodeName.toLowerCase();return name==="input"&&elem.type==="button"||name==="button";},"text":function(elem){var attr;return elem.nodeName.toLowerCase()==="input"&&elem.type==="text"&&((attr=elem.getAttribute("type"))==null||attr.toLowerCase()==="text");},"first":createPositionalPseudo(function(){return[0];}),"last":createPositionalPseudo(function(matchIndexes,length){return[length-1];}),"eq":createPositionalPseudo(function(matchIndexes,length,argument){return[argument<0?argument+length:argument];}),"even":createPositionalPseudo(function(matchIndexes,length){var i=0;for(;i<length;i+=2){matchIndexes.push(i);}
return matchIndexes;}),"odd":createPositionalPseudo(function(matchIndexes,length){var i=1;for(;i<length;i+=2){matchIndexes.push(i);}
return matchIndexes;}),"lt":createPositionalPseudo(function(matchIndexes,length,argument){var i=argument<0?argument+length:argument;for(;--i>=0;){matchIndexes.push(i);}
return matchIndexes;}),"gt":createPositionalPseudo(function(matchIndexes,length,argument){var i=argument<0?argument+length:argument;for(;++i<length;){matchIndexes.push(i);}
return matchIndexes;})}};Expr.pseudos["nth"]=Expr.pseudos["eq"];for(i in{radio:true,checkbox:true,file:true,password:true,image:true}){Expr.pseudos[i]=createInputPseudo(i);}
for(i in{submit:true,reset:true}){Expr.pseudos[i]=createButtonPseudo(i);}
function setFilters(){}
setFilters.prototype=Expr.filters=Expr.pseudos;Expr.setFilters=new setFilters();tokenize=Sizzle.tokenize=function(selector,parseOnly){var matched,match,tokens,type,soFar,groups,preFilters,cached=tokenCache[selector+" "];if(cached){return parseOnly?0:cached.slice(0);}
soFar=selector;groups=[];preFilters=Expr.preFilter;while(soFar){if(!matched||(match=rcomma.exec(soFar))){if(match){soFar=soFar.slice(match[0].length)||soFar;}
groups.push((tokens=[]));}
matched=false;if((match=rcombinators.exec(soFar))){matched=match.shift();tokens.push({value:matched,type:match[0].replace(rtrim," ")});soFar=soFar.slice(matched.length);}
for(type in Expr.filter){if((match=matchExpr[type].exec(soFar))&&(!preFilters[type]||(match=preFilters[type](match)))){matched=match.shift();tokens.push({value:matched,type:type,matches:match});soFar=soFar.slice(matched.length);}}
if(!matched){break;}}
return parseOnly?soFar.length:soFar?Sizzle.error(selector):tokenCache(selector,groups).slice(0);};function toSelector(tokens){var i=0,len=tokens.length,selector="";for(;i<len;i++){selector+=tokens[i].value;}
return selector;}
function addCombinator(matcher,combinator,base){var dir=combinator.dir,checkNonElements=base&&dir==="parentNode",doneName=done++;return combinator.first?function(elem,context,xml){while((elem=elem[dir])){if(elem.nodeType===1||checkNonElements){return matcher(elem,context,xml);}}}:function(elem,context,xml){var oldCache,outerCache,newCache=[dirruns,doneName];if(xml){while((elem=elem[dir])){if(elem.nodeType===1||checkNonElements){if(matcher(elem,context,xml)){return true;}}}}else{while((elem=elem[dir])){if(elem.nodeType===1||checkNonElements){outerCache=elem[expando]||(elem[expando]={});if((oldCache=outerCache[dir])&&oldCache[0]===dirruns&&oldCache[1]===doneName){return(newCache[2]=oldCache[2]);}else{outerCache[dir]=newCache;if((newCache[2]=matcher(elem,context,xml))){return true;}}}}}};}
function elementMatcher(matchers){return matchers.length>1?function(elem,context,xml){var i=matchers.length;while(i--){if(!matchers[i](elem,context,xml)){return false;}}
return true;}:matchers[0];}
function multipleContexts(selector,contexts,results){var i=0,len=contexts.length;for(;i<len;i++){Sizzle(selector,contexts[i],results);}
return results;}
function condense(unmatched,map,filter,context,xml){var elem,newUnmatched=[],i=0,len=unmatched.length,mapped=map!=null;for(;i<len;i++){if((elem=unmatched[i])){if(!filter||filter(elem,context,xml)){newUnmatched.push(elem);if(mapped){map.push(i);}}}}
return newUnmatched;}
function setMatcher(preFilter,selector,matcher,postFilter,postFinder,postSelector){if(postFilter&&!postFilter[expando]){postFilter=setMatcher(postFilter);}
if(postFinder&&!postFinder[expando]){postFinder=setMatcher(postFinder,postSelector);}
return markFunction(function(seed,results,context,xml){var temp,i,elem,preMap=[],postMap=[],preexisting=results.length,elems=seed||multipleContexts(selector||"*",context.nodeType?[context]:context,[]),matcherIn=preFilter&&(seed||!selector)?condense(elems,preMap,preFilter,context,xml):elems,matcherOut=matcher?postFinder||(seed?preFilter:preexisting||postFilter)?[]:results:matcherIn;if(matcher){matcher(matcherIn,matcherOut,context,xml);}
if(postFilter){temp=condense(matcherOut,postMap);postFilter(temp,[],context,xml);i=temp.length;while(i--){if((elem=temp[i])){matcherOut[postMap[i]]=!(matcherIn[postMap[i]]=elem);}}}
if(seed){if(postFinder||preFilter){if(postFinder){temp=[];i=matcherOut.length;while(i--){if((elem=matcherOut[i])){temp.push((matcherIn[i]=elem));}}
postFinder(null,(matcherOut=[]),temp,xml);}
i=matcherOut.length;while(i--){if((elem=matcherOut[i])&&(temp=postFinder?indexOf(seed,elem):preMap[i])>-1){seed[temp]=!(results[temp]=elem);}}}}else{matcherOut=condense(matcherOut===results?matcherOut.splice(preexisting,matcherOut.length):matcherOut);if(postFinder){postFinder(null,results,matcherOut,xml);}else{push.apply(results,matcherOut);}}});}
function matcherFromTokens(tokens){var checkContext,matcher,j,len=tokens.length,leadingRelative=Expr.relative[tokens[0].type],implicitRelative=leadingRelative||Expr.relative[" "],i=leadingRelative?1:0,matchContext=addCombinator(function(elem){return elem===checkContext;},implicitRelative,true),matchAnyContext=addCombinator(function(elem){return indexOf(checkContext,elem)>-1;},implicitRelative,true),matchers=[function(elem,context,xml){var ret=(!leadingRelative&&(xml||context!==outermostContext))||((checkContext=context).nodeType?matchContext(elem,context,xml):matchAnyContext(elem,context,xml));checkContext=null;return ret;}];for(;i<len;i++){if((matcher=Expr.relative[tokens[i].type])){matchers=[addCombinator(elementMatcher(matchers),matcher)];}else{matcher=Expr.filter[tokens[i].type].apply(null,tokens[i].matches);if(matcher[expando]){j=++i;for(;j<len;j++){if(Expr.relative[tokens[j].type]){break;}}
return setMatcher(i>1&&elementMatcher(matchers),i>1&&toSelector(tokens.slice(0,i-1).concat({value:tokens[i-2].type===" "?"*":""})).replace(rtrim,"$1"),matcher,i<j&&matcherFromTokens(tokens.slice(i,j)),j<len&&matcherFromTokens((tokens=tokens.slice(j))),j<len&&toSelector(tokens));}
matchers.push(matcher);}}
return elementMatcher(matchers);}
function matcherFromGroupMatchers(elementMatchers,setMatchers){var bySet=setMatchers.length>0,byElement=elementMatchers.length>0,superMatcher=function(seed,context,xml,results,outermost){var elem,j,matcher,matchedCount=0,i="0",unmatched=seed&&[],setMatched=[],contextBackup=outermostContext,elems=seed||byElement&&Expr.find["TAG"]("*",outermost),dirrunsUnique=(dirruns+=contextBackup==null?1:Math.random()||0.1),len=elems.length;if(outermost){outermostContext=context!==document&&context;}
for(;i!==len&&(elem=elems[i])!=null;i++){if(byElement&&elem){j=0;while((matcher=elementMatchers[j++])){if(matcher(elem,context,xml)){results.push(elem);break;}}
if(outermost){dirruns=dirrunsUnique;}}
if(bySet){if((elem=!matcher&&elem)){matchedCount--;}
if(seed){unmatched.push(elem);}}}
matchedCount+=i;if(bySet&&i!==matchedCount){j=0;while((matcher=setMatchers[j++])){matcher(unmatched,setMatched,context,xml);}
if(seed){if(matchedCount>0){while(i--){if(!(unmatched[i]||setMatched[i])){setMatched[i]=pop.call(results);}}}
setMatched=condense(setMatched);}
push.apply(results,setMatched);if(outermost&&!seed&&setMatched.length>0&&(matchedCount+setMatchers.length)>1){Sizzle.uniqueSort(results);}}
if(outermost){dirruns=dirrunsUnique;outermostContext=contextBackup;}
return unmatched;};return bySet?markFunction(superMatcher):superMatcher;}
compile=Sizzle.compile=function(selector,match){var i,setMatchers=[],elementMatchers=[],cached=compilerCache[selector+" "];if(!cached){if(!match){match=tokenize(selector);}
i=match.length;while(i--){cached=matcherFromTokens(match[i]);if(cached[expando]){setMatchers.push(cached);}else{elementMatchers.push(cached);}}
cached=compilerCache(selector,matcherFromGroupMatchers(elementMatchers,setMatchers));cached.selector=selector;}
return cached;};select=Sizzle.select=function(selector,context,results,seed){var i,tokens,token,type,find,compiled=typeof selector==="function"&&selector,match=!seed&&tokenize((selector=compiled.selector||selector));results=results||[];if(match.length===1){tokens=match[0]=match[0].slice(0);if(tokens.length>2&&(token=tokens[0]).type==="ID"&&support.getById&&context.nodeType===9&&documentIsHTML&&Expr.relative[tokens[1].type]){context=(Expr.find["ID"](token.matches[0].replace(runescape,funescape),context)||[])[0];if(!context){return results;}else if(compiled){context=context.parentNode;}
selector=selector.slice(tokens.shift().value.length);}
i=matchExpr["needsContext"].test(selector)?0:tokens.length;while(i--){token=tokens[i];if(Expr.relative[(type=token.type)]){break;}
if((find=Expr.find[type])){if((seed=find(token.matches[0].replace(runescape,funescape),rsibling.test(tokens[0].type)&&testContext(context.parentNode)||context))){tokens.splice(i,1);selector=seed.length&&toSelector(tokens);if(!selector){push.apply(results,seed);return results;}
break;}}}}
(compiled||compile(selector,match))(seed,context,!documentIsHTML,results,rsibling.test(selector)&&testContext(context.parentNode)||context);return results;};support.sortStable=expando.split("").sort(sortOrder).join("")===expando;support.detectDuplicates=!!hasDuplicate;setDocument();support.sortDetached=assert(function(div1){return div1.compareDocumentPosition(document.createElement("div"))&1;});if(!assert(function(div){div.innerHTML="<a href='#'></a>";return div.firstChild.getAttribute("href")==="#";})){addHandle("type|href|height|width",function(elem,name,isXML){if(!isXML){return elem.getAttribute(name,name.toLowerCase()==="type"?1:2);}});}
if(!support.attributes||!assert(function(div){div.innerHTML="<input/>";div.firstChild.setAttribute("value","");return div.firstChild.getAttribute("value")==="";})){addHandle("value",function(elem,name,isXML){if(!isXML&&elem.nodeName.toLowerCase()==="input"){return elem.defaultValue;}});}
if(!assert(function(div){return div.getAttribute("disabled")==null;})){addHandle(booleans,function(elem,name,isXML){var val;if(!isXML){return elem[name]===true?name.toLowerCase():(val=elem.getAttributeNode(name))&&val.specified?val.value:null;}});}
return Sizzle;})(window);jQuery.find=Sizzle;jQuery.expr=Sizzle.selectors;jQuery.expr[":"]=jQuery.expr.pseudos;jQuery.unique=Sizzle.uniqueSort;jQuery.text=Sizzle.getText;jQuery.isXMLDoc=Sizzle.isXML;jQuery.contains=Sizzle.contains;var rneedsContext=jQuery.expr.match.needsContext;var rsingleTag=(/^<(\w+)\s*\/?>(?:<\/\1>|)$/);var risSimple=/^.[^:#\[\.,]*$/;function winnow(elements,qualifier,not){if(jQuery.isFunction(qualifier)){return jQuery.grep(elements,function(elem,i){return!!qualifier.call(elem,i,elem)!==not;});}
if(qualifier.nodeType){return jQuery.grep(elements,function(elem){return(elem===qualifier)!==not;});}
if(typeof qualifier==="string"){if(risSimple.test(qualifier)){return jQuery.filter(qualifier,elements,not);}
qualifier=jQuery.filter(qualifier,elements);}
return jQuery.grep(elements,function(elem){return(jQuery.inArray(elem,qualifier)>=0)!==not;});}
jQuery.filter=function(expr,elems,not){var elem=elems[0];if(not){expr=":not("+expr+")";}
return elems.length===1&&elem.nodeType===1?jQuery.find.matchesSelector(elem,expr)?[elem]:[]:jQuery.find.matches(expr,jQuery.grep(elems,function(elem){return elem.nodeType===1;}));};jQuery.fn.extend({find:function(selector){var i,ret=[],self=this,len=self.length;if(typeof selector!=="string"){return this.pushStack(jQuery(selector).filter(function(){for(i=0;i<len;i++){if(jQuery.contains(self[i],this)){return true;}}}));}
for(i=0;i<len;i++){jQuery.find(selector,self[i],ret);}
ret=this.pushStack(len>1?jQuery.unique(ret):ret);ret.selector=this.selector?this.selector+" "+selector:selector;return ret;},filter:function(selector){return this.pushStack(winnow(this,selector||[],false));},not:function(selector){return this.pushStack(winnow(this,selector||[],true));},is:function(selector){return!!winnow(this,typeof selector==="string"&&rneedsContext.test(selector)?jQuery(selector):selector||[],false).length;}});var rootjQuery,document=window.document,rquickExpr=/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,init=jQuery.fn.init=function(selector,context){var match,elem;if(!selector){return this;}
if(typeof selector==="string"){if(selector.charAt(0)==="<"&&selector.charAt(selector.length-1)===">"&&selector.length>=3){match=[null,selector,null];}else{match=rquickExpr.exec(selector);}
if(match&&(match[1]||!context)){if(match[1]){context=context instanceof jQuery?context[0]:context;jQuery.merge(this,jQuery.parseHTML(match[1],context&&context.nodeType?context.ownerDocument||context:document,true));if(rsingleTag.test(match[1])&&jQuery.isPlainObject(context)){for(match in context){if(jQuery.isFunction(this[match])){this[match](context[match]);}else{this.attr(match,context[match]);}}}
return this;}else{elem=document.getElementById(match[2]);if(elem&&elem.parentNode){if(elem.id!==match[2]){return rootjQuery.find(selector);}
this.length=1;this[0]=elem;}
this.context=document;this.selector=selector;return this;}}else if(!context||context.jquery){return(context||rootjQuery).find(selector);}else{return this.constructor(context).find(selector);}}else if(selector.nodeType){this.context=this[0]=selector;this.length=1;return this;}else if(jQuery.isFunction(selector)){return typeof rootjQuery.ready!=="undefined"?rootjQuery.ready(selector):selector(jQuery);}
if(selector.selector!==undefined){this.selector=selector.selector;this.context=selector.context;}
return jQuery.makeArray(selector,this);};init.prototype=jQuery.fn;rootjQuery=jQuery(document);var rparentsprev=/^(?:parents|prev(?:Until|All))/,guaranteedUnique={children:true,contents:true,next:true,prev:true};jQuery.extend({dir:function(elem,dir,until){var matched=[],cur=elem[dir];while(cur&&cur.nodeType!==9&&(until===undefined||cur.nodeType!==1||!jQuery(cur).is(until))){if(cur.nodeType===1){matched.push(cur);}
cur=cur[dir];}
return matched;},sibling:function(n,elem){var r=[];for(;n;n=n.nextSibling){if(n.nodeType===1&&n!==elem){r.push(n);}}
return r;}});jQuery.fn.extend({has:function(target){var i,targets=jQuery(target,this),len=targets.length;return this.filter(function(){for(i=0;i<len;i++){if(jQuery.contains(this,targets[i])){return true;}}});},closest:function(selectors,context){var cur,i=0,l=this.length,matched=[],pos=rneedsContext.test(selectors)||typeof selectors!=="string"?jQuery(selectors,context||this.context):0;for(;i<l;i++){for(cur=this[i];cur&&cur!==context;cur=cur.parentNode){if(cur.nodeType<11&&(pos?pos.index(cur)>-1:cur.nodeType===1&&jQuery.find.matchesSelector(cur,selectors))){matched.push(cur);break;}}}
return this.pushStack(matched.length>1?jQuery.unique(matched):matched);},index:function(elem){if(!elem){return(this[0]&&this[0].parentNode)?this.first().prevAll().length:-1;}
if(typeof elem==="string"){return jQuery.inArray(this[0],jQuery(elem));}
return jQuery.inArray(elem.jquery?elem[0]:elem,this);},add:function(selector,context){return this.pushStack(jQuery.unique(jQuery.merge(this.get(),jQuery(selector,context))));},addBack:function(selector){return this.add(selector==null?this.prevObject:this.prevObject.filter(selector));}});function sibling(cur,dir){do{cur=cur[dir];}while(cur&&cur.nodeType!==1);return cur;}
jQuery.each({parent:function(elem){var parent=elem.parentNode;return parent&&parent.nodeType!==11?parent:null;},parents:function(elem){return jQuery.dir(elem,"parentNode");},parentsUntil:function(elem,i,until){return jQuery.dir(elem,"parentNode",until);},next:function(elem){return sibling(elem,"nextSibling");},prev:function(elem){return sibling(elem,"previousSibling");},nextAll:function(elem){return jQuery.dir(elem,"nextSibling");},prevAll:function(elem){return jQuery.dir(elem,"previousSibling");},nextUntil:function(elem,i,until){return jQuery.dir(elem,"nextSibling",until);},prevUntil:function(elem,i,until){return jQuery.dir(elem,"previousSibling",until);},siblings:function(elem){return jQuery.sibling((elem.parentNode||{}).firstChild,elem);},children:function(elem){return jQuery.sibling(elem.firstChild);},contents:function(elem){return jQuery.nodeName(elem,"iframe")?elem.contentDocument||elem.contentWindow.document:jQuery.merge([],elem.childNodes);}},function(name,fn){jQuery.fn[name]=function(until,selector){var ret=jQuery.map(this,fn,until);if(name.slice(-5)!=="Until"){selector=until;}
if(selector&&typeof selector==="string"){ret=jQuery.filter(selector,ret);}
if(this.length>1){if(!guaranteedUnique[name]){ret=jQuery.unique(ret);}
if(rparentsprev.test(name)){ret=ret.reverse();}}
return this.pushStack(ret);};});var rnotwhite=(/\S+/g);var optionsCache={};function createOptions(options){var object=optionsCache[options]={};jQuery.each(options.match(rnotwhite)||[],function(_,flag){object[flag]=true;});return object;}
jQuery.Callbacks=function(options){options=typeof options==="string"?(optionsCache[options]||createOptions(options)):jQuery.extend({},options);var
firing,memory,fired,firingLength,firingIndex,firingStart,list=[],stack=!options.once&&[],fire=function(data){memory=options.memory&&data;fired=true;firingIndex=firingStart||0;firingStart=0;firingLength=list.length;firing=true;for(;list&&firingIndex<firingLength;firingIndex++){if(list[firingIndex].apply(data[0],data[1])===false&&options.stopOnFalse){memory=false;break;}}
firing=false;if(list){if(stack){if(stack.length){fire(stack.shift());}}else if(memory){list=[];}else{self.disable();}}},self={add:function(){if(list){var start=list.length;(function add(args){jQuery.each(args,function(_,arg){var type=jQuery.type(arg);if(type==="function"){if(!options.unique||!self.has(arg)){list.push(arg);}}else if(arg&&arg.length&&type!=="string"){add(arg);}});})(arguments);if(firing){firingLength=list.length;}else if(memory){firingStart=start;fire(memory);}}
return this;},remove:function(){if(list){jQuery.each(arguments,function(_,arg){var index;while((index=jQuery.inArray(arg,list,index))>-1){list.splice(index,1);if(firing){if(index<=firingLength){firingLength--;}
if(index<=firingIndex){firingIndex--;}}}});}
return this;},has:function(fn){return fn?jQuery.inArray(fn,list)>-1:!!(list&&list.length);},empty:function(){list=[];firingLength=0;return this;},disable:function(){list=stack=memory=undefined;return this;},disabled:function(){return!list;},lock:function(){stack=undefined;if(!memory){self.disable();}
return this;},locked:function(){return!stack;},fireWith:function(context,args){if(list&&(!fired||stack)){args=args||[];args=[context,args.slice?args.slice():args];if(firing){stack.push(args);}else{fire(args);}}
return this;},fire:function(){self.fireWith(this,arguments);return this;},fired:function(){return!!fired;}};return self;};jQuery.extend({Deferred:function(func){var tuples=[["resolve","done",jQuery.Callbacks("once memory"),"resolved"],["reject","fail",jQuery.Callbacks("once memory"),"rejected"],["notify","progress",jQuery.Callbacks("memory")]],state="pending",promise={state:function(){return state;},always:function(){deferred.done(arguments).fail(arguments);return this;},then:function(){var fns=arguments;return jQuery.Deferred(function(newDefer){jQuery.each(tuples,function(i,tuple){var fn=jQuery.isFunction(fns[i])&&fns[i];deferred[tuple[1]](function(){var returned=fn&&fn.apply(this,arguments);if(returned&&jQuery.isFunction(returned.promise)){returned.promise().done(newDefer.resolve).fail(newDefer.reject).progress(newDefer.notify);}else{newDefer[tuple[0]+"With"](this===promise?newDefer.promise():this,fn?[returned]:arguments);}});});fns=null;}).promise();},promise:function(obj){return obj!=null?jQuery.extend(obj,promise):promise;}},deferred={};promise.pipe=promise.then;jQuery.each(tuples,function(i,tuple){var list=tuple[2],stateString=tuple[3];promise[tuple[1]]=list.add;if(stateString){list.add(function(){state=stateString;},tuples[i^1][2].disable,tuples[2][2].lock);}
deferred[tuple[0]]=function(){deferred[tuple[0]+"With"](this===deferred?promise:this,arguments);return this;};deferred[tuple[0]+"With"]=list.fireWith;});promise.promise(deferred);if(func){func.call(deferred,deferred);}
return deferred;},when:function(subordinate){var i=0,resolveValues=slice.call(arguments),length=resolveValues.length,remaining=length!==1||(subordinate&&jQuery.isFunction(subordinate.promise))?length:0,deferred=remaining===1?subordinate:jQuery.Deferred(),updateFunc=function(i,contexts,values){return function(value){contexts[i]=this;values[i]=arguments.length>1?slice.call(arguments):value;if(values===progressValues){deferred.notifyWith(contexts,values);}else if(!(--remaining)){deferred.resolveWith(contexts,values);}};},progressValues,progressContexts,resolveContexts;if(length>1){progressValues=new Array(length);progressContexts=new Array(length);resolveContexts=new Array(length);for(;i<length;i++){if(resolveValues[i]&&jQuery.isFunction(resolveValues[i].promise)){resolveValues[i].promise().done(updateFunc(i,resolveContexts,resolveValues)).fail(deferred.reject).progress(updateFunc(i,progressContexts,progressValues));}else{--remaining;}}}
if(!remaining){deferred.resolveWith(resolveContexts,resolveValues);}
return deferred.promise();}});var readyList;jQuery.fn.ready=function(fn){jQuery.ready.promise().done(fn);return this;};jQuery.extend({isReady:false,readyWait:1,holdReady:function(hold){if(hold){jQuery.readyWait++;}else{jQuery.ready(true);}},ready:function(wait){if(wait===true?--jQuery.readyWait:jQuery.isReady){return;}
if(!document.body){return setTimeout(jQuery.ready);}
jQuery.isReady=true;if(wait!==true&&--jQuery.readyWait>0){return;}
readyList.resolveWith(document,[jQuery]);if(jQuery.fn.triggerHandler){jQuery(document).triggerHandler("ready");jQuery(document).off("ready");}}});function detach(){if(document.addEventListener){document.removeEventListener("DOMContentLoaded",completed,false);window.removeEventListener("load",completed,false);}else{document.detachEvent("onreadystatechange",completed);window.detachEvent("onload",completed);}}
function completed(){if(document.addEventListener||event.type==="load"||document.readyState==="complete"){detach();jQuery.ready();}}
jQuery.ready.promise=function(obj){if(!readyList){readyList=jQuery.Deferred();if(document.readyState==="complete"){setTimeout(jQuery.ready);}else if(document.addEventListener){document.addEventListener("DOMContentLoaded",completed,false);window.addEventListener("load",completed,false);}else{document.attachEvent("onreadystatechange",completed);window.attachEvent("onload",completed);var top=false;try{top=window.frameElement==null&&document.documentElement;}catch(e){}
if(top&&top.doScroll){(function doScrollCheck(){if(!jQuery.isReady){try{top.doScroll("left");}catch(e){return setTimeout(doScrollCheck,50);}
detach();jQuery.ready();}})();}}}
return readyList.promise(obj);};var strundefined=typeof undefined;var i;for(i in jQuery(support)){break;}
support.ownLast=i!=="0";support.inlineBlockNeedsLayout=false;jQuery(function(){var val,div,body,container;body=document.getElementsByTagName("body")[0];if(!body||!body.style){return;}
div=document.createElement("div");container=document.createElement("div");container.style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px";body.appendChild(container).appendChild(div);if(typeof div.style.zoom!==strundefined){div.style.cssText="display:inline;margin:0;border:0;padding:1px;width:1px;zoom:1";support.inlineBlockNeedsLayout=val=div.offsetWidth===3;if(val){body.style.zoom=1;}}
body.removeChild(container);});(function(){var div=document.createElement("div");if(support.deleteExpando==null){support.deleteExpando=true;try{delete div.test;}catch(e){support.deleteExpando=false;}}
div=null;})();jQuery.acceptData=function(elem){var noData=jQuery.noData[(elem.nodeName+" ").toLowerCase()],nodeType=+elem.nodeType||1;return nodeType!==1&&nodeType!==9?false:!noData||noData!==true&&elem.getAttribute("classid")===noData;};var rbrace=/^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,rmultiDash=/([A-Z])/g;function dataAttr(elem,key,data){if(data===undefined&&elem.nodeType===1){var name="data-"+key.replace(rmultiDash,"-$1").toLowerCase();data=elem.getAttribute(name);if(typeof data==="string"){try{data=data==="true"?true:data==="false"?false:data==="null"?null:+data+""===data?+data:rbrace.test(data)?jQuery.parseJSON(data):data;}catch(e){}
jQuery.data(elem,key,data);}else{data=undefined;}}
return data;}
function isEmptyDataObject(obj){var name;for(name in obj){if(name==="data"&&jQuery.isEmptyObject(obj[name])){continue;}
if(name!=="toJSON"){return false;}}
return true;}
function internalData(elem,name,data,pvt){if(!jQuery.acceptData(elem)){return;}
var ret,thisCache,internalKey=jQuery.expando,isNode=elem.nodeType,cache=isNode?jQuery.cache:elem,id=isNode?elem[internalKey]:elem[internalKey]&&internalKey;if((!id||!cache[id]||(!pvt&&!cache[id].data))&&data===undefined&&typeof name==="string"){return;}
if(!id){if(isNode){id=elem[internalKey]=deletedIds.pop()||jQuery.guid++;}else{id=internalKey;}}
if(!cache[id]){cache[id]=isNode?{}:{toJSON:jQuery.noop};}
if(typeof name==="object"||typeof name==="function"){if(pvt){cache[id]=jQuery.extend(cache[id],name);}else{cache[id].data=jQuery.extend(cache[id].data,name);}}
thisCache=cache[id];if(!pvt){if(!thisCache.data){thisCache.data={};}
thisCache=thisCache.data;}
if(data!==undefined){thisCache[jQuery.camelCase(name)]=data;}
if(typeof name==="string"){ret=thisCache[name];if(ret==null){ret=thisCache[jQuery.camelCase(name)];}}else{ret=thisCache;}
return ret;}
function internalRemoveData(elem,name,pvt){if(!jQuery.acceptData(elem)){return;}
var thisCache,i,isNode=elem.nodeType,cache=isNode?jQuery.cache:elem,id=isNode?elem[jQuery.expando]:jQuery.expando;if(!cache[id]){return;}
if(name){thisCache=pvt?cache[id]:cache[id].data;if(thisCache){if(!jQuery.isArray(name)){if(name in thisCache){name=[name];}else{name=jQuery.camelCase(name);if(name in thisCache){name=[name];}else{name=name.split(" ");}}}else{name=name.concat(jQuery.map(name,jQuery.camelCase));}
i=name.length;while(i--){delete thisCache[name[i]];}
if(pvt?!isEmptyDataObject(thisCache):!jQuery.isEmptyObject(thisCache)){return;}}}
if(!pvt){delete cache[id].data;if(!isEmptyDataObject(cache[id])){return;}}
if(isNode){jQuery.cleanData([elem],true);}else if(support.deleteExpando||cache!=cache.window){delete cache[id];}else{cache[id]=null;}}
jQuery.extend({cache:{},noData:{"applet ":true,"embed ":true,"object ":"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"},hasData:function(elem){elem=elem.nodeType?jQuery.cache[elem[jQuery.expando]]:elem[jQuery.expando];return!!elem&&!isEmptyDataObject(elem);},data:function(elem,name,data){return internalData(elem,name,data);},removeData:function(elem,name){return internalRemoveData(elem,name);},_data:function(elem,name,data){return internalData(elem,name,data,true);},_removeData:function(elem,name){return internalRemoveData(elem,name,true);}});jQuery.fn.extend({data:function(key,value){var i,name,data,elem=this[0],attrs=elem&&elem.attributes;if(key===undefined){if(this.length){data=jQuery.data(elem);if(elem.nodeType===1&&!jQuery._data(elem,"parsedAttrs")){i=attrs.length;while(i--){if(attrs[i]){name=attrs[i].name;if(name.indexOf("data-")===0){name=jQuery.camelCase(name.slice(5));dataAttr(elem,name,data[name]);}}}
jQuery._data(elem,"parsedAttrs",true);}}
return data;}
if(typeof key==="object"){return this.each(function(){jQuery.data(this,key);});}
return arguments.length>1?this.each(function(){jQuery.data(this,key,value);}):elem?dataAttr(elem,key,jQuery.data(elem,key)):undefined;},removeData:function(key){return this.each(function(){jQuery.removeData(this,key);});}});jQuery.extend({queue:function(elem,type,data){var queue;if(elem){type=(type||"fx")+"queue";queue=jQuery._data(elem,type);if(data){if(!queue||jQuery.isArray(data)){queue=jQuery._data(elem,type,jQuery.makeArray(data));}else{queue.push(data);}}
return queue||[];}},dequeue:function(elem,type){type=type||"fx";var queue=jQuery.queue(elem,type),startLength=queue.length,fn=queue.shift(),hooks=jQuery._queueHooks(elem,type),next=function(){jQuery.dequeue(elem,type);};if(fn==="inprogress"){fn=queue.shift();startLength--;}
if(fn){if(type==="fx"){queue.unshift("inprogress");}
delete hooks.stop;fn.call(elem,next,hooks);}
if(!startLength&&hooks){hooks.empty.fire();}},_queueHooks:function(elem,type){var key=type+"queueHooks";return jQuery._data(elem,key)||jQuery._data(elem,key,{empty:jQuery.Callbacks("once memory").add(function(){jQuery._removeData(elem,type+"queue");jQuery._removeData(elem,key);})});}});jQuery.fn.extend({queue:function(type,data){var setter=2;if(typeof type!=="string"){data=type;type="fx";setter--;}
if(arguments.length<setter){return jQuery.queue(this[0],type);}
return data===undefined?this:this.each(function(){var queue=jQuery.queue(this,type,data);jQuery._queueHooks(this,type);if(type==="fx"&&queue[0]!=="inprogress"){jQuery.dequeue(this,type);}});},dequeue:function(type){return this.each(function(){jQuery.dequeue(this,type);});},clearQueue:function(type){return this.queue(type||"fx",[]);},promise:function(type,obj){var tmp,count=1,defer=jQuery.Deferred(),elements=this,i=this.length,resolve=function(){if(!(--count)){defer.resolveWith(elements,[elements]);}};if(typeof type!=="string"){obj=type;type=undefined;}
type=type||"fx";while(i--){tmp=jQuery._data(elements[i],type+"queueHooks");if(tmp&&tmp.empty){count++;tmp.empty.add(resolve);}}
resolve();return defer.promise(obj);}});var pnum=(/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/).source;var cssExpand=["Top","Right","Bottom","Left"];var isHidden=function(elem,el){elem=el||elem;return jQuery.css(elem,"display")==="none"||!jQuery.contains(elem.ownerDocument,elem);};var access=jQuery.access=function(elems,fn,key,value,chainable,emptyGet,raw){var i=0,length=elems.length,bulk=key==null;if(jQuery.type(key)==="object"){chainable=true;for(i in key){jQuery.access(elems,fn,i,key[i],true,emptyGet,raw);}}else if(value!==undefined){chainable=true;if(!jQuery.isFunction(value)){raw=true;}
if(bulk){if(raw){fn.call(elems,value);fn=null;}else{bulk=fn;fn=function(elem,key,value){return bulk.call(jQuery(elem),value);};}}
if(fn){for(;i<length;i++){fn(elems[i],key,raw?value:value.call(elems[i],i,fn(elems[i],key)));}}}
return chainable?elems:bulk?fn.call(elems):length?fn(elems[0],key):emptyGet;};var rcheckableType=(/^(?:checkbox|radio)$/i);(function(){var input=document.createElement("input"),div=document.createElement("div"),fragment=document.createDocumentFragment();div.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>";support.leadingWhitespace=div.firstChild.nodeType===3;support.tbody=!div.getElementsByTagName("tbody").length;support.htmlSerialize=!!div.getElementsByTagName("link").length;support.html5Clone=document.createElement("nav").cloneNode(true).outerHTML!=="<:nav></:nav>";input.type="checkbox";input.checked=true;fragment.appendChild(input);support.appendChecked=input.checked;div.innerHTML="<textarea>x</textarea>";support.noCloneChecked=!!div.cloneNode(true).lastChild.defaultValue;fragment.appendChild(div);div.innerHTML="<input type='radio' checked='checked' name='t'/>";support.checkClone=div.cloneNode(true).cloneNode(true).lastChild.checked;support.noCloneEvent=true;if(div.attachEvent){div.attachEvent("onclick",function(){support.noCloneEvent=false;});div.cloneNode(true).click();}
if(support.deleteExpando==null){support.deleteExpando=true;try{delete div.test;}catch(e){support.deleteExpando=false;}}})();(function(){var i,eventName,div=document.createElement("div");for(i in{submit:true,change:true,focusin:true}){eventName="on"+i;if(!(support[i+"Bubbles"]=eventName in window)){div.setAttribute(eventName,"t");support[i+"Bubbles"]=div.attributes[eventName].expando===false;}}
div=null;})();var rformElems=/^(?:input|select|textarea)$/i,rkeyEvent=/^key/,rmouseEvent=/^(?:mouse|pointer|contextmenu)|click/,rfocusMorph=/^(?:focusinfocus|focusoutblur)$/,rtypenamespace=/^([^.]*)(?:\.(.+)|)$/;function returnTrue(){return true;}
function returnFalse(){return false;}
function safeActiveElement(){try{return document.activeElement;}catch(err){}}
jQuery.event={global:{},add:function(elem,types,handler,data,selector){var tmp,events,t,handleObjIn,special,eventHandle,handleObj,handlers,type,namespaces,origType,elemData=jQuery._data(elem);if(!elemData){return;}
if(handler.handler){handleObjIn=handler;handler=handleObjIn.handler;selector=handleObjIn.selector;}
if(!handler.guid){handler.guid=jQuery.guid++;}
if(!(events=elemData.events)){events=elemData.events={};}
if(!(eventHandle=elemData.handle)){eventHandle=elemData.handle=function(e){return typeof jQuery!==strundefined&&(!e||jQuery.event.triggered!==e.type)?jQuery.event.dispatch.apply(eventHandle.elem,arguments):undefined;};eventHandle.elem=elem;}
types=(types||"").match(rnotwhite)||[""];t=types.length;while(t--){tmp=rtypenamespace.exec(types[t])||[];type=origType=tmp[1];namespaces=(tmp[2]||"").split(".").sort();if(!type){continue;}
special=jQuery.event.special[type]||{};type=(selector?special.delegateType:special.bindType)||type;special=jQuery.event.special[type]||{};handleObj=jQuery.extend({type:type,origType:origType,data:data,handler:handler,guid:handler.guid,selector:selector,needsContext:selector&&jQuery.expr.match.needsContext.test(selector),namespace:namespaces.join(".")},handleObjIn);if(!(handlers=events[type])){handlers=events[type]=[];handlers.delegateCount=0;if(!special.setup||special.setup.call(elem,data,namespaces,eventHandle)===false){if(elem.addEventListener){elem.addEventListener(type,eventHandle,false);}else if(elem.attachEvent){elem.attachEvent("on"+type,eventHandle);}}}
if(special.add){special.add.call(elem,handleObj);if(!handleObj.handler.guid){handleObj.handler.guid=handler.guid;}}
if(selector){handlers.splice(handlers.delegateCount++,0,handleObj);}else{handlers.push(handleObj);}
jQuery.event.global[type]=true;}
elem=null;},remove:function(elem,types,handler,selector,mappedTypes){var j,handleObj,tmp,origCount,t,events,special,handlers,type,namespaces,origType,elemData=jQuery.hasData(elem)&&jQuery._data(elem);if(!elemData||!(events=elemData.events)){return;}
types=(types||"").match(rnotwhite)||[""];t=types.length;while(t--){tmp=rtypenamespace.exec(types[t])||[];type=origType=tmp[1];namespaces=(tmp[2]||"").split(".").sort();if(!type){for(type in events){jQuery.event.remove(elem,type+types[t],handler,selector,true);}
continue;}
special=jQuery.event.special[type]||{};type=(selector?special.delegateType:special.bindType)||type;handlers=events[type]||[];tmp=tmp[2]&&new RegExp("(^|\\.)"+namespaces.join("\\.(?:.*\\.|)")+"(\\.|$)");origCount=j=handlers.length;while(j--){handleObj=handlers[j];if((mappedTypes||origType===handleObj.origType)&&(!handler||handler.guid===handleObj.guid)&&(!tmp||tmp.test(handleObj.namespace))&&(!selector||selector===handleObj.selector||selector==="**"&&handleObj.selector)){handlers.splice(j,1);if(handleObj.selector){handlers.delegateCount--;}
if(special.remove){special.remove.call(elem,handleObj);}}}
if(origCount&&!handlers.length){if(!special.teardown||special.teardown.call(elem,namespaces,elemData.handle)===false){jQuery.removeEvent(elem,type,elemData.handle);}
delete events[type];}}
if(jQuery.isEmptyObject(events)){delete elemData.handle;jQuery._removeData(elem,"events");}},trigger:function(event,data,elem,onlyHandlers){var handle,ontype,cur,bubbleType,special,tmp,i,eventPath=[elem||document],type=hasOwn.call(event,"type")?event.type:event,namespaces=hasOwn.call(event,"namespace")?event.namespace.split("."):[];cur=tmp=elem=elem||document;if(elem.nodeType===3||elem.nodeType===8){return;}
if(rfocusMorph.test(type+jQuery.event.triggered)){return;}
if(type.indexOf(".")>=0){namespaces=type.split(".");type=namespaces.shift();namespaces.sort();}
ontype=type.indexOf(":")<0&&"on"+type;event=event[jQuery.expando]?event:new jQuery.Event(type,typeof event==="object"&&event);event.isTrigger=onlyHandlers?2:3;event.namespace=namespaces.join(".");event.namespace_re=event.namespace?new RegExp("(^|\\.)"+namespaces.join("\\.(?:.*\\.|)")+"(\\.|$)"):null;event.result=undefined;if(!event.target){event.target=elem;}
data=data==null?[event]:jQuery.makeArray(data,[event]);special=jQuery.event.special[type]||{};if(!onlyHandlers&&special.trigger&&special.trigger.apply(elem,data)===false){return;}
if(!onlyHandlers&&!special.noBubble&&!jQuery.isWindow(elem)){bubbleType=special.delegateType||type;if(!rfocusMorph.test(bubbleType+type)){cur=cur.parentNode;}
for(;cur;cur=cur.parentNode){eventPath.push(cur);tmp=cur;}
if(tmp===(elem.ownerDocument||document)){eventPath.push(tmp.defaultView||tmp.parentWindow||window);}}
i=0;while((cur=eventPath[i++])&&!event.isPropagationStopped()){event.type=i>1?bubbleType:special.bindType||type;handle=(jQuery._data(cur,"events")||{})[event.type]&&jQuery._data(cur,"handle");if(handle){handle.apply(cur,data);}
handle=ontype&&cur[ontype];if(handle&&handle.apply&&jQuery.acceptData(cur)){event.result=handle.apply(cur,data);if(event.result===false){event.preventDefault();}}}
event.type=type;if(!onlyHandlers&&!event.isDefaultPrevented()){if((!special._default||special._default.apply(eventPath.pop(),data)===false)&&jQuery.acceptData(elem)){if(ontype&&elem[type]&&!jQuery.isWindow(elem)){tmp=elem[ontype];if(tmp){elem[ontype]=null;}
jQuery.event.triggered=type;try{elem[type]();}catch(e){}
jQuery.event.triggered=undefined;if(tmp){elem[ontype]=tmp;}}}}
return event.result;},dispatch:function(event){event=jQuery.event.fix(event);var i,ret,handleObj,matched,j,handlerQueue=[],args=slice.call(arguments),handlers=(jQuery._data(this,"events")||{})[event.type]||[],special=jQuery.event.special[event.type]||{};args[0]=event;event.delegateTarget=this;if(special.preDispatch&&special.preDispatch.call(this,event)===false){return;}
handlerQueue=jQuery.event.handlers.call(this,event,handlers);i=0;while((matched=handlerQueue[i++])&&!event.isPropagationStopped()){event.currentTarget=matched.elem;j=0;while((handleObj=matched.handlers[j++])&&!event.isImmediatePropagationStopped()){if(!event.namespace_re||event.namespace_re.test(handleObj.namespace)){event.handleObj=handleObj;event.data=handleObj.data;ret=((jQuery.event.special[handleObj.origType]||{}).handle||handleObj.handler).apply(matched.elem,args);if(ret!==undefined){if((event.result=ret)===false){event.preventDefault();event.stopPropagation();}}}}}
if(special.postDispatch){special.postDispatch.call(this,event);}
return event.result;},handlers:function(event,handlers){var sel,handleObj,matches,i,handlerQueue=[],delegateCount=handlers.delegateCount,cur=event.target;if(delegateCount&&cur.nodeType&&(!event.button||event.type!=="click")){for(;cur!=this;cur=cur.parentNode||this){if(cur.nodeType===1&&(cur.disabled!==true||event.type!=="click")){matches=[];for(i=0;i<delegateCount;i++){handleObj=handlers[i];sel=handleObj.selector+" ";if(matches[sel]===undefined){matches[sel]=handleObj.needsContext?jQuery(sel,this).index(cur)>=0:jQuery.find(sel,this,null,[cur]).length;}
if(matches[sel]){matches.push(handleObj);}}
if(matches.length){handlerQueue.push({elem:cur,handlers:matches});}}}}
if(delegateCount<handlers.length){handlerQueue.push({elem:this,handlers:handlers.slice(delegateCount)});}
return handlerQueue;},fix:function(event){if(event[jQuery.expando]){return event;}
var i,prop,copy,type=event.type,originalEvent=event,fixHook=this.fixHooks[type];if(!fixHook){this.fixHooks[type]=fixHook=rmouseEvent.test(type)?this.mouseHooks:rkeyEvent.test(type)?this.keyHooks:{};}
copy=fixHook.props?this.props.concat(fixHook.props):this.props;event=new jQuery.Event(originalEvent);i=copy.length;while(i--){prop=copy[i];event[prop]=originalEvent[prop];}
if(!event.target){event.target=originalEvent.srcElement||document;}
if(event.target.nodeType===3){event.target=event.target.parentNode;}
event.metaKey=!!event.metaKey;return fixHook.filter?fixHook.filter(event,originalEvent):event;},props:"altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),fixHooks:{},keyHooks:{props:"char charCode key keyCode".split(" "),filter:function(event,original){if(event.which==null){event.which=original.charCode!=null?original.charCode:original.keyCode;}
return event;}},mouseHooks:{props:"button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),filter:function(event,original){var body,eventDoc,doc,button=original.button,fromElement=original.fromElement;if(event.pageX==null&&original.clientX!=null){eventDoc=event.target.ownerDocument||document;doc=eventDoc.documentElement;body=eventDoc.body;event.pageX=original.clientX+(doc&&doc.scrollLeft||body&&body.scrollLeft||0)-(doc&&doc.clientLeft||body&&body.clientLeft||0);event.pageY=original.clientY+(doc&&doc.scrollTop||body&&body.scrollTop||0)-(doc&&doc.clientTop||body&&body.clientTop||0);}
if(!event.relatedTarget&&fromElement){event.relatedTarget=fromElement===event.target?original.toElement:fromElement;}
if(!event.which&&button!==undefined){event.which=(button&1?1:(button&2?3:(button&4?2:0)));}
return event;}},special:{load:{noBubble:true},focus:{trigger:function(){if(this!==safeActiveElement()&&this.focus){try{this.focus();return false;}catch(e){}}},delegateType:"focusin"},blur:{trigger:function(){if(this===safeActiveElement()&&this.blur){this.blur();return false;}},delegateType:"focusout"},click:{trigger:function(){if(jQuery.nodeName(this,"input")&&this.type==="checkbox"&&this.click){this.click();return false;}},_default:function(event){return jQuery.nodeName(event.target,"a");}},beforeunload:{postDispatch:function(event){if(event.result!==undefined&&event.originalEvent){event.originalEvent.returnValue=event.result;}}}},simulate:function(type,elem,event,bubble){var e=jQuery.extend(new jQuery.Event(),event,{type:type,isSimulated:true,originalEvent:{}});if(bubble){jQuery.event.trigger(e,null,elem);}else{jQuery.event.dispatch.call(elem,e);}
if(e.isDefaultPrevented()){event.preventDefault();}}};jQuery.removeEvent=document.removeEventListener?function(elem,type,handle){if(elem.removeEventListener){elem.removeEventListener(type,handle,false);}}:function(elem,type,handle){var name="on"+type;if(elem.detachEvent){if(typeof elem[name]===strundefined){elem[name]=null;}
elem.detachEvent(name,handle);}};jQuery.Event=function(src,props){if(!(this instanceof jQuery.Event)){return new jQuery.Event(src,props);}
if(src&&src.type){this.originalEvent=src;this.type=src.type;this.isDefaultPrevented=src.defaultPrevented||src.defaultPrevented===undefined&&src.returnValue===false?returnTrue:returnFalse;}else{this.type=src;}
if(props){jQuery.extend(this,props);}
this.timeStamp=src&&src.timeStamp||jQuery.now();this[jQuery.expando]=true;};jQuery.Event.prototype={isDefaultPrevented:returnFalse,isPropagationStopped:returnFalse,isImmediatePropagationStopped:returnFalse,preventDefault:function(){var e=this.originalEvent;this.isDefaultPrevented=returnTrue;if(!e){return;}
if(e.preventDefault){e.preventDefault();}else{e.returnValue=false;}},stopPropagation:function(){var e=this.originalEvent;this.isPropagationStopped=returnTrue;if(!e){return;}
if(e.stopPropagation){e.stopPropagation();}
e.cancelBubble=true;},stopImmediatePropagation:function(){var e=this.originalEvent;this.isImmediatePropagationStopped=returnTrue;if(e&&e.stopImmediatePropagation){e.stopImmediatePropagation();}
this.stopPropagation();}};jQuery.each({mouseenter:"mouseover",mouseleave:"mouseout",pointerenter:"pointerover",pointerleave:"pointerout"},function(orig,fix){jQuery.event.special[orig]={delegateType:fix,bindType:fix,handle:function(event){var ret,target=this,related=event.relatedTarget,handleObj=event.handleObj;if(!related||(related!==target&&!jQuery.contains(target,related))){event.type=handleObj.origType;ret=handleObj.handler.apply(this,arguments);event.type=fix;}
return ret;}};});if(!support.submitBubbles){jQuery.event.special.submit={setup:function(){if(jQuery.nodeName(this,"form")){return false;}
jQuery.event.add(this,"click._submit keypress._submit",function(e){var elem=e.target,form=jQuery.nodeName(elem,"input")||jQuery.nodeName(elem,"button")?elem.form:undefined;if(form&&!jQuery._data(form,"submitBubbles")){jQuery.event.add(form,"submit._submit",function(event){event._submit_bubble=true;});jQuery._data(form,"submitBubbles",true);}});},postDispatch:function(event){if(event._submit_bubble){delete event._submit_bubble;if(this.parentNode&&!event.isTrigger){jQuery.event.simulate("submit",this.parentNode,event,true);}}},teardown:function(){if(jQuery.nodeName(this,"form")){return false;}
jQuery.event.remove(this,"._submit");}};}
if(!support.changeBubbles){jQuery.event.special.change={setup:function(){if(rformElems.test(this.nodeName)){if(this.type==="checkbox"||this.type==="radio"){jQuery.event.add(this,"propertychange._change",function(event){if(event.originalEvent.propertyName==="checked"){this._just_changed=true;}});jQuery.event.add(this,"click._change",function(event){if(this._just_changed&&!event.isTrigger){this._just_changed=false;}
jQuery.event.simulate("change",this,event,true);});}
return false;}
jQuery.event.add(this,"beforeactivate._change",function(e){var elem=e.target;if(rformElems.test(elem.nodeName)&&!jQuery._data(elem,"changeBubbles")){jQuery.event.add(elem,"change._change",function(event){if(this.parentNode&&!event.isSimulated&&!event.isTrigger){jQuery.event.simulate("change",this.parentNode,event,true);}});jQuery._data(elem,"changeBubbles",true);}});},handle:function(event){var elem=event.target;if(this!==elem||event.isSimulated||event.isTrigger||(elem.type!=="radio"&&elem.type!=="checkbox")){return event.handleObj.handler.apply(this,arguments);}},teardown:function(){jQuery.event.remove(this,"._change");return!rformElems.test(this.nodeName);}};}
if(!support.focusinBubbles){jQuery.each({focus:"focusin",blur:"focusout"},function(orig,fix){var handler=function(event){jQuery.event.simulate(fix,event.target,jQuery.event.fix(event),true);};jQuery.event.special[fix]={setup:function(){var doc=this.ownerDocument||this,attaches=jQuery._data(doc,fix);if(!attaches){doc.addEventListener(orig,handler,true);}
jQuery._data(doc,fix,(attaches||0)+1);},teardown:function(){var doc=this.ownerDocument||this,attaches=jQuery._data(doc,fix)-1;if(!attaches){doc.removeEventListener(orig,handler,true);jQuery._removeData(doc,fix);}else{jQuery._data(doc,fix,attaches);}}};});}
jQuery.fn.extend({on:function(types,selector,data,fn,one){var type,origFn;if(typeof types==="object"){if(typeof selector!=="string"){data=data||selector;selector=undefined;}
for(type in types){this.on(type,selector,data,types[type],one);}
return this;}
if(data==null&&fn==null){fn=selector;data=selector=undefined;}else if(fn==null){if(typeof selector==="string"){fn=data;data=undefined;}else{fn=data;data=selector;selector=undefined;}}
if(fn===false){fn=returnFalse;}else if(!fn){return this;}
if(one===1){origFn=fn;fn=function(event){jQuery().off(event);return origFn.apply(this,arguments);};fn.guid=origFn.guid||(origFn.guid=jQuery.guid++);}
return this.each(function(){jQuery.event.add(this,types,fn,data,selector);});},one:function(types,selector,data,fn){return this.on(types,selector,data,fn,1);},off:function(types,selector,fn){var handleObj,type;if(types&&types.preventDefault&&types.handleObj){handleObj=types.handleObj;jQuery(types.delegateTarget).off(handleObj.namespace?handleObj.origType+"."+handleObj.namespace:handleObj.origType,handleObj.selector,handleObj.handler);return this;}
if(typeof types==="object"){for(type in types){this.off(type,selector,types[type]);}
return this;}
if(selector===false||typeof selector==="function"){fn=selector;selector=undefined;}
if(fn===false){fn=returnFalse;}
return this.each(function(){jQuery.event.remove(this,types,fn,selector);});},trigger:function(type,data){return this.each(function(){jQuery.event.trigger(type,data,this);});},triggerHandler:function(type,data){var elem=this[0];if(elem){return jQuery.event.trigger(type,data,elem,true);}}});function createSafeFragment(document){var list=nodeNames.split("|"),safeFrag=document.createDocumentFragment();if(safeFrag.createElement){while(list.length){safeFrag.createElement(list.pop());}}
return safeFrag;}
var nodeNames="abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|"+"header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",rinlinejQuery=/ jQuery\d+="(?:null|\d+)"/g,rnoshimcache=new RegExp("<(?:"+nodeNames+")[\\s/>]","i"),rleadingWhitespace=/^\s+/,rxhtmlTag=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,rtagName=/<([\w:]+)/,rtbody=/<tbody/i,rhtml=/<|&#?\w+;/,rnoInnerhtml=/<(?:script|style|link)/i,rchecked=/checked\s*(?:[^=]|=\s*.checked.)/i,rscriptType=/^$|\/(?:java|ecma)script/i,rscriptTypeMasked=/^true\/(.*)/,rcleanScript=/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,wrapMap={option:[1,"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],area:[1,"<map>","</map>"],param:[1,"<object>","</object>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],_default:support.htmlSerialize?[0,"",""]:[1,"X<div>","</div>"]},safeFragment=createSafeFragment(document),fragmentDiv=safeFragment.appendChild(document.createElement("div"));wrapMap.optgroup=wrapMap.option;wrapMap.tbody=wrapMap.tfoot=wrapMap.colgroup=wrapMap.caption=wrapMap.thead;wrapMap.th=wrapMap.td;function getAll(context,tag){var elems,elem,i=0,found=typeof context.getElementsByTagName!==strundefined?context.getElementsByTagName(tag||"*"):typeof context.querySelectorAll!==strundefined?context.querySelectorAll(tag||"*"):undefined;if(!found){for(found=[],elems=context.childNodes||context;(elem=elems[i])!=null;i++){if(!tag||jQuery.nodeName(elem,tag)){found.push(elem);}else{jQuery.merge(found,getAll(elem,tag));}}}
return tag===undefined||tag&&jQuery.nodeName(context,tag)?jQuery.merge([context],found):found;}
function fixDefaultChecked(elem){if(rcheckableType.test(elem.type)){elem.defaultChecked=elem.checked;}}
function manipulationTarget(elem,content){return jQuery.nodeName(elem,"table")&&jQuery.nodeName(content.nodeType!==11?content:content.firstChild,"tr")?elem.getElementsByTagName("tbody")[0]||elem.appendChild(elem.ownerDocument.createElement("tbody")):elem;}
function disableScript(elem){elem.type=(jQuery.find.attr(elem,"type")!==null)+"/"+elem.type;return elem;}
function restoreScript(elem){var match=rscriptTypeMasked.exec(elem.type);if(match){elem.type=match[1];}else{elem.removeAttribute("type");}
return elem;}
function setGlobalEval(elems,refElements){var elem,i=0;for(;(elem=elems[i])!=null;i++){jQuery._data(elem,"globalEval",!refElements||jQuery._data(refElements[i],"globalEval"));}}
function cloneCopyEvent(src,dest){if(dest.nodeType!==1||!jQuery.hasData(src)){return;}
var type,i,l,oldData=jQuery._data(src),curData=jQuery._data(dest,oldData),events=oldData.events;if(events){delete curData.handle;curData.events={};for(type in events){for(i=0,l=events[type].length;i<l;i++){jQuery.event.add(dest,type,events[type][i]);}}}
if(curData.data){curData.data=jQuery.extend({},curData.data);}}
function fixCloneNodeIssues(src,dest){var nodeName,e,data;if(dest.nodeType!==1){return;}
nodeName=dest.nodeName.toLowerCase();if(!support.noCloneEvent&&dest[jQuery.expando]){data=jQuery._data(dest);for(e in data.events){jQuery.removeEvent(dest,e,data.handle);}
dest.removeAttribute(jQuery.expando);}
if(nodeName==="script"&&dest.text!==src.text){disableScript(dest).text=src.text;restoreScript(dest);}else if(nodeName==="object"){if(dest.parentNode){dest.outerHTML=src.outerHTML;}
if(support.html5Clone&&(src.innerHTML&&!jQuery.trim(dest.innerHTML))){dest.innerHTML=src.innerHTML;}}else if(nodeName==="input"&&rcheckableType.test(src.type)){dest.defaultChecked=dest.checked=src.checked;if(dest.value!==src.value){dest.value=src.value;}}else if(nodeName==="option"){dest.defaultSelected=dest.selected=src.defaultSelected;}else if(nodeName==="input"||nodeName==="textarea"){dest.defaultValue=src.defaultValue;}}
jQuery.extend({clone:function(elem,dataAndEvents,deepDataAndEvents){var destElements,node,clone,i,srcElements,inPage=jQuery.contains(elem.ownerDocument,elem);if(support.html5Clone||jQuery.isXMLDoc(elem)||!rnoshimcache.test("<"+elem.nodeName+">")){clone=elem.cloneNode(true);}else{fragmentDiv.innerHTML=elem.outerHTML;fragmentDiv.removeChild(clone=fragmentDiv.firstChild);}
if((!support.noCloneEvent||!support.noCloneChecked)&&(elem.nodeType===1||elem.nodeType===11)&&!jQuery.isXMLDoc(elem)){destElements=getAll(clone);srcElements=getAll(elem);for(i=0;(node=srcElements[i])!=null;++i){if(destElements[i]){fixCloneNodeIssues(node,destElements[i]);}}}
if(dataAndEvents){if(deepDataAndEvents){srcElements=srcElements||getAll(elem);destElements=destElements||getAll(clone);for(i=0;(node=srcElements[i])!=null;i++){cloneCopyEvent(node,destElements[i]);}}else{cloneCopyEvent(elem,clone);}}
destElements=getAll(clone,"script");if(destElements.length>0){setGlobalEval(destElements,!inPage&&getAll(elem,"script"));}
destElements=srcElements=node=null;return clone;},buildFragment:function(elems,context,scripts,selection){var j,elem,contains,tmp,tag,tbody,wrap,l=elems.length,safe=createSafeFragment(context),nodes=[],i=0;for(;i<l;i++){elem=elems[i];if(elem||elem===0){if(jQuery.type(elem)==="object"){jQuery.merge(nodes,elem.nodeType?[elem]:elem);}else if(!rhtml.test(elem)){nodes.push(context.createTextNode(elem));}else{tmp=tmp||safe.appendChild(context.createElement("div"));tag=(rtagName.exec(elem)||["",""])[1].toLowerCase();wrap=wrapMap[tag]||wrapMap._default;tmp.innerHTML=wrap[1]+elem.replace(rxhtmlTag,"<$1></$2>")+wrap[2];j=wrap[0];while(j--){tmp=tmp.lastChild;}
if(!support.leadingWhitespace&&rleadingWhitespace.test(elem)){nodes.push(context.createTextNode(rleadingWhitespace.exec(elem)[0]));}
if(!support.tbody){elem=tag==="table"&&!rtbody.test(elem)?tmp.firstChild:wrap[1]==="<table>"&&!rtbody.test(elem)?tmp:0;j=elem&&elem.childNodes.length;while(j--){if(jQuery.nodeName((tbody=elem.childNodes[j]),"tbody")&&!tbody.childNodes.length){elem.removeChild(tbody);}}}
jQuery.merge(nodes,tmp.childNodes);tmp.textContent="";while(tmp.firstChild){tmp.removeChild(tmp.firstChild);}
tmp=safe.lastChild;}}}
if(tmp){safe.removeChild(tmp);}
if(!support.appendChecked){jQuery.grep(getAll(nodes,"input"),fixDefaultChecked);}
i=0;while((elem=nodes[i++])){if(selection&&jQuery.inArray(elem,selection)!==-1){continue;}
contains=jQuery.contains(elem.ownerDocument,elem);tmp=getAll(safe.appendChild(elem),"script");if(contains){setGlobalEval(tmp);}
if(scripts){j=0;while((elem=tmp[j++])){if(rscriptType.test(elem.type||"")){scripts.push(elem);}}}}
tmp=null;return safe;},cleanData:function(elems,acceptData){var elem,type,id,data,i=0,internalKey=jQuery.expando,cache=jQuery.cache,deleteExpando=support.deleteExpando,special=jQuery.event.special;for(;(elem=elems[i])!=null;i++){if(acceptData||jQuery.acceptData(elem)){id=elem[internalKey];data=id&&cache[id];if(data){if(data.events){for(type in data.events){if(special[type]){jQuery.event.remove(elem,type);}else{jQuery.removeEvent(elem,type,data.handle);}}}
if(cache[id]){delete cache[id];if(deleteExpando){delete elem[internalKey];}else if(typeof elem.removeAttribute!==strundefined){elem.removeAttribute(internalKey);}else{elem[internalKey]=null;}
deletedIds.push(id);}}}}}});jQuery.fn.extend({text:function(value){return access(this,function(value){return value===undefined?jQuery.text(this):this.empty().append((this[0]&&this[0].ownerDocument||document).createTextNode(value));},null,value,arguments.length);},append:function(){return this.domManip(arguments,function(elem){if(this.nodeType===1||this.nodeType===11||this.nodeType===9){var target=manipulationTarget(this,elem);target.appendChild(elem);}});},prepend:function(){return this.domManip(arguments,function(elem){if(this.nodeType===1||this.nodeType===11||this.nodeType===9){var target=manipulationTarget(this,elem);target.insertBefore(elem,target.firstChild);}});},before:function(){return this.domManip(arguments,function(elem){if(this.parentNode){this.parentNode.insertBefore(elem,this);}});},after:function(){return this.domManip(arguments,function(elem){if(this.parentNode){this.parentNode.insertBefore(elem,this.nextSibling);}});},remove:function(selector,keepData){var elem,elems=selector?jQuery.filter(selector,this):this,i=0;for(;(elem=elems[i])!=null;i++){if(!keepData&&elem.nodeType===1){jQuery.cleanData(getAll(elem));}
if(elem.parentNode){if(keepData&&jQuery.contains(elem.ownerDocument,elem)){setGlobalEval(getAll(elem,"script"));}
elem.parentNode.removeChild(elem);}}
return this;},empty:function(){var elem,i=0;for(;(elem=this[i])!=null;i++){if(elem.nodeType===1){jQuery.cleanData(getAll(elem,false));}
while(elem.firstChild){elem.removeChild(elem.firstChild);}
if(elem.options&&jQuery.nodeName(elem,"select")){elem.options.length=0;}}
return this;},clone:function(dataAndEvents,deepDataAndEvents){dataAndEvents=dataAndEvents==null?false:dataAndEvents;deepDataAndEvents=deepDataAndEvents==null?dataAndEvents:deepDataAndEvents;return this.map(function(){return jQuery.clone(this,dataAndEvents,deepDataAndEvents);});},html:function(value){return access(this,function(value){var elem=this[0]||{},i=0,l=this.length;if(value===undefined){return elem.nodeType===1?elem.innerHTML.replace(rinlinejQuery,""):undefined;}
if(typeof value==="string"&&!rnoInnerhtml.test(value)&&(support.htmlSerialize||!rnoshimcache.test(value))&&(support.leadingWhitespace||!rleadingWhitespace.test(value))&&!wrapMap[(rtagName.exec(value)||["",""])[1].toLowerCase()]){value=value.replace(rxhtmlTag,"<$1></$2>");try{for(;i<l;i++){elem=this[i]||{};if(elem.nodeType===1){jQuery.cleanData(getAll(elem,false));elem.innerHTML=value;}}
elem=0;}catch(e){}}
if(elem){this.empty().append(value);}},null,value,arguments.length);},replaceWith:function(){var arg=arguments[0];this.domManip(arguments,function(elem){arg=this.parentNode;jQuery.cleanData(getAll(this));if(arg){arg.replaceChild(elem,this);}});return arg&&(arg.length||arg.nodeType)?this:this.remove();},detach:function(selector){return this.remove(selector,true);},domManip:function(args,callback){args=concat.apply([],args);var first,node,hasScripts,scripts,doc,fragment,i=0,l=this.length,set=this,iNoClone=l-1,value=args[0],isFunction=jQuery.isFunction(value);if(isFunction||(l>1&&typeof value==="string"&&!support.checkClone&&rchecked.test(value))){return this.each(function(index){var self=set.eq(index);if(isFunction){args[0]=value.call(this,index,self.html());}
self.domManip(args,callback);});}
if(l){fragment=jQuery.buildFragment(args,this[0].ownerDocument,false,this);first=fragment.firstChild;if(fragment.childNodes.length===1){fragment=first;}
if(first){scripts=jQuery.map(getAll(fragment,"script"),disableScript);hasScripts=scripts.length;for(;i<l;i++){node=fragment;if(i!==iNoClone){node=jQuery.clone(node,true,true);if(hasScripts){jQuery.merge(scripts,getAll(node,"script"));}}
callback.call(this[i],node,i);}
if(hasScripts){doc=scripts[scripts.length-1].ownerDocument;jQuery.map(scripts,restoreScript);for(i=0;i<hasScripts;i++){node=scripts[i];if(rscriptType.test(node.type||"")&&!jQuery._data(node,"globalEval")&&jQuery.contains(doc,node)){if(node.src){if(jQuery._evalUrl){jQuery._evalUrl(node.src);}}else{jQuery.globalEval((node.text||node.textContent||node.innerHTML||"").replace(rcleanScript,""));}}}}
fragment=first=null;}}
return this;}});jQuery.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(name,original){jQuery.fn[name]=function(selector){var elems,i=0,ret=[],insert=jQuery(selector),last=insert.length-1;for(;i<=last;i++){elems=i===last?this:this.clone(true);jQuery(insert[i])[original](elems);push.apply(ret,elems.get());}
return this.pushStack(ret);};});var iframe,elemdisplay={};function actualDisplay(name,doc){var style,elem=jQuery(doc.createElement(name)).appendTo(doc.body),display=window.getDefaultComputedStyle&&(style=window.getDefaultComputedStyle(elem[0]))?style.display:jQuery.css(elem[0],"display");elem.detach();return display;}
function defaultDisplay(nodeName){var doc=document,display=elemdisplay[nodeName];if(!display){display=actualDisplay(nodeName,doc);if(display==="none"||!display){iframe=(iframe||jQuery("<iframe frameborder='0' width='0' height='0'/>")).appendTo(doc.documentElement);doc=(iframe[0].contentWindow||iframe[0].contentDocument).document;doc.write();doc.close();display=actualDisplay(nodeName,doc);iframe.detach();}
elemdisplay[nodeName]=display;}
return display;}
(function(){var shrinkWrapBlocksVal;support.shrinkWrapBlocks=function(){if(shrinkWrapBlocksVal!=null){return shrinkWrapBlocksVal;}
shrinkWrapBlocksVal=false;var div,body,container;body=document.getElementsByTagName("body")[0];if(!body||!body.style){return;}
div=document.createElement("div");container=document.createElement("div");container.style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px";body.appendChild(container).appendChild(div);if(typeof div.style.zoom!==strundefined){div.style.cssText="-webkit-box-sizing:content-box;-moz-box-sizing:content-box;"+"box-sizing:content-box;display:block;margin:0;border:0;"+"padding:1px;width:1px;zoom:1";div.appendChild(document.createElement("div")).style.width="5px";shrinkWrapBlocksVal=div.offsetWidth!==3;}
body.removeChild(container);return shrinkWrapBlocksVal;};})();var rmargin=(/^margin/);var rnumnonpx=new RegExp("^("+pnum+")(?!px)[a-z%]+$","i");var getStyles,curCSS,rposition=/^(top|right|bottom|left)$/;if(window.getComputedStyle){getStyles=function(elem){if(elem.ownerDocument.defaultView.opener){return elem.ownerDocument.defaultView.getComputedStyle(elem,null);}
return window.getComputedStyle(elem,null);};curCSS=function(elem,name,computed){var width,minWidth,maxWidth,ret,style=elem.style;computed=computed||getStyles(elem);ret=computed?computed.getPropertyValue(name)||computed[name]:undefined;if(computed){if(ret===""&&!jQuery.contains(elem.ownerDocument,elem)){ret=jQuery.style(elem,name);}
if(rnumnonpx.test(ret)&&rmargin.test(name)){width=style.width;minWidth=style.minWidth;maxWidth=style.maxWidth;style.minWidth=style.maxWidth=style.width=ret;ret=computed.width;style.width=width;style.minWidth=minWidth;style.maxWidth=maxWidth;}}
return ret===undefined?ret:ret+"";};}else if(document.documentElement.currentStyle){getStyles=function(elem){return elem.currentStyle;};curCSS=function(elem,name,computed){var left,rs,rsLeft,ret,style=elem.style;computed=computed||getStyles(elem);ret=computed?computed[name]:undefined;if(ret==null&&style&&style[name]){ret=style[name];}
if(rnumnonpx.test(ret)&&!rposition.test(name)){left=style.left;rs=elem.runtimeStyle;rsLeft=rs&&rs.left;if(rsLeft){rs.left=elem.currentStyle.left;}
style.left=name==="fontSize"?"1em":ret;ret=style.pixelLeft+"px";style.left=left;if(rsLeft){rs.left=rsLeft;}}
return ret===undefined?ret:ret+""||"auto";};}
function addGetHookIf(conditionFn,hookFn){return{get:function(){var condition=conditionFn();if(condition==null){return;}
if(condition){delete this.get;return;}
return(this.get=hookFn).apply(this,arguments);}};}
(function(){var div,style,a,pixelPositionVal,boxSizingReliableVal,reliableHiddenOffsetsVal,reliableMarginRightVal;div=document.createElement("div");div.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>";a=div.getElementsByTagName("a")[0];style=a&&a.style;if(!style){return;}
style.cssText="float:left;opacity:.5";support.opacity=style.opacity==="0.5";support.cssFloat=!!style.cssFloat;div.style.backgroundClip="content-box";div.cloneNode(true).style.backgroundClip="";support.clearCloneStyle=div.style.backgroundClip==="content-box";support.boxSizing=style.boxSizing===""||style.MozBoxSizing===""||style.WebkitBoxSizing==="";jQuery.extend(support,{reliableHiddenOffsets:function(){if(reliableHiddenOffsetsVal==null){computeStyleTests();}
return reliableHiddenOffsetsVal;},boxSizingReliable:function(){if(boxSizingReliableVal==null){computeStyleTests();}
return boxSizingReliableVal;},pixelPosition:function(){if(pixelPositionVal==null){computeStyleTests();}
return pixelPositionVal;},reliableMarginRight:function(){if(reliableMarginRightVal==null){computeStyleTests();}
return reliableMarginRightVal;}});function computeStyleTests(){var div,body,container,contents;body=document.getElementsByTagName("body")[0];if(!body||!body.style){return;}
div=document.createElement("div");container=document.createElement("div");container.style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px";body.appendChild(container).appendChild(div);div.style.cssText="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;"+"box-sizing:border-box;display:block;margin-top:1%;top:1%;"+"border:1px;padding:1px;width:4px;position:absolute";pixelPositionVal=boxSizingReliableVal=false;reliableMarginRightVal=true;if(window.getComputedStyle){pixelPositionVal=(window.getComputedStyle(div,null)||{}).top!=="1%";boxSizingReliableVal=(window.getComputedStyle(div,null)||{width:"4px"}).width==="4px";contents=div.appendChild(document.createElement("div"));contents.style.cssText=div.style.cssText="-webkit-box-sizing:content-box;-moz-box-sizing:content-box;"+"box-sizing:content-box;display:block;margin:0;border:0;padding:0";contents.style.marginRight=contents.style.width="0";div.style.width="1px";reliableMarginRightVal=!parseFloat((window.getComputedStyle(contents,null)||{}).marginRight);div.removeChild(contents);}
div.innerHTML="<table><tr><td></td><td>t</td></tr></table>";contents=div.getElementsByTagName("td");contents[0].style.cssText="margin:0;border:0;padding:0;display:none";reliableHiddenOffsetsVal=contents[0].offsetHeight===0;if(reliableHiddenOffsetsVal){contents[0].style.display="";contents[1].style.display="none";reliableHiddenOffsetsVal=contents[0].offsetHeight===0;}
body.removeChild(container);}})();jQuery.swap=function(elem,options,callback,args){var ret,name,old={};for(name in options){old[name]=elem.style[name];elem.style[name]=options[name];}
ret=callback.apply(elem,args||[]);for(name in options){elem.style[name]=old[name];}
return ret;};var
ralpha=/alpha\([^)]*\)/i,ropacity=/opacity\s*=\s*([^)]*)/,rdisplayswap=/^(none|table(?!-c[ea]).+)/,rnumsplit=new RegExp("^("+pnum+")(.*)$","i"),rrelNum=new RegExp("^([+-])=("+pnum+")","i"),cssShow={position:"absolute",visibility:"hidden",display:"block"},cssNormalTransform={letterSpacing:"0",fontWeight:"400"},cssPrefixes=["Webkit","O","Moz","ms"];function vendorPropName(style,name){if(name in style){return name;}
var capName=name.charAt(0).toUpperCase()+name.slice(1),origName=name,i=cssPrefixes.length;while(i--){name=cssPrefixes[i]+capName;if(name in style){return name;}}
return origName;}
function showHide(elements,show){var display,elem,hidden,values=[],index=0,length=elements.length;for(;index<length;index++){elem=elements[index];if(!elem.style){continue;}
values[index]=jQuery._data(elem,"olddisplay");display=elem.style.display;if(show){if(!values[index]&&display==="none"){elem.style.display="";}
if(elem.style.display===""&&isHidden(elem)){values[index]=jQuery._data(elem,"olddisplay",defaultDisplay(elem.nodeName));}}else{hidden=isHidden(elem);if(display&&display!=="none"||!hidden){jQuery._data(elem,"olddisplay",hidden?display:jQuery.css(elem,"display"));}}}
for(index=0;index<length;index++){elem=elements[index];if(!elem.style){continue;}
if(!show||elem.style.display==="none"||elem.style.display===""){elem.style.display=show?values[index]||"":"none";}}
return elements;}
function setPositiveNumber(elem,value,subtract){var matches=rnumsplit.exec(value);return matches?Math.max(0,matches[1]-(subtract||0))+(matches[2]||"px"):value;}
function augmentWidthOrHeight(elem,name,extra,isBorderBox,styles){var i=extra===(isBorderBox?"border":"content")?4:name==="width"?1:0,val=0;for(;i<4;i+=2){if(extra==="margin"){val+=jQuery.css(elem,extra+cssExpand[i],true,styles);}
if(isBorderBox){if(extra==="content"){val-=jQuery.css(elem,"padding"+cssExpand[i],true,styles);}
if(extra!=="margin"){val-=jQuery.css(elem,"border"+cssExpand[i]+"Width",true,styles);}}else{val+=jQuery.css(elem,"padding"+cssExpand[i],true,styles);if(extra!=="padding"){val+=jQuery.css(elem,"border"+cssExpand[i]+"Width",true,styles);}}}
return val;}
function getWidthOrHeight(elem,name,extra){var valueIsBorderBox=true,val=name==="width"?elem.offsetWidth:elem.offsetHeight,styles=getStyles(elem),isBorderBox=support.boxSizing&&jQuery.css(elem,"boxSizing",false,styles)==="border-box";if(val<=0||val==null){val=curCSS(elem,name,styles);if(val<0||val==null){val=elem.style[name];}
if(rnumnonpx.test(val)){return val;}
valueIsBorderBox=isBorderBox&&(support.boxSizingReliable()||val===elem.style[name]);val=parseFloat(val)||0;}
return(val+augmentWidthOrHeight(elem,name,extra||(isBorderBox?"border":"content"),valueIsBorderBox,styles))+"px";}
jQuery.extend({cssHooks:{opacity:{get:function(elem,computed){if(computed){var ret=curCSS(elem,"opacity");return ret===""?"1":ret;}}}},cssNumber:{"columnCount":true,"fillOpacity":true,"flexGrow":true,"flexShrink":true,"fontWeight":true,"lineHeight":true,"opacity":true,"order":true,"orphans":true,"widows":true,"zIndex":true,"zoom":true},cssProps:{"float":support.cssFloat?"cssFloat":"styleFloat"},style:function(elem,name,value,extra){if(!elem||elem.nodeType===3||elem.nodeType===8||!elem.style){return;}
var ret,type,hooks,origName=jQuery.camelCase(name),style=elem.style;name=jQuery.cssProps[origName]||(jQuery.cssProps[origName]=vendorPropName(style,origName));hooks=jQuery.cssHooks[name]||jQuery.cssHooks[origName];if(value!==undefined){type=typeof value;if(type==="string"&&(ret=rrelNum.exec(value))){value=(ret[1]+1)*ret[2]+parseFloat(jQuery.css(elem,name));type="number";}
if(value==null||value!==value){return;}
if(type==="number"&&!jQuery.cssNumber[origName]){value+="px";}
if(!support.clearCloneStyle&&value===""&&name.indexOf("background")===0){style[name]="inherit";}
if(!hooks||!("set"in hooks)||(value=hooks.set(elem,value,extra))!==undefined){try{style[name]=value;}catch(e){}}}else{if(hooks&&"get"in hooks&&(ret=hooks.get(elem,false,extra))!==undefined){return ret;}
return style[name];}},css:function(elem,name,extra,styles){var num,val,hooks,origName=jQuery.camelCase(name);name=jQuery.cssProps[origName]||(jQuery.cssProps[origName]=vendorPropName(elem.style,origName));hooks=jQuery.cssHooks[name]||jQuery.cssHooks[origName];if(hooks&&"get"in hooks){val=hooks.get(elem,true,extra);}
if(val===undefined){val=curCSS(elem,name,styles);}
if(val==="normal"&&name in cssNormalTransform){val=cssNormalTransform[name];}
if(extra===""||extra){num=parseFloat(val);return extra===true||jQuery.isNumeric(num)?num||0:val;}
return val;}});jQuery.each(["height","width"],function(i,name){jQuery.cssHooks[name]={get:function(elem,computed,extra){if(computed){return rdisplayswap.test(jQuery.css(elem,"display"))&&elem.offsetWidth===0?jQuery.swap(elem,cssShow,function(){return getWidthOrHeight(elem,name,extra);}):getWidthOrHeight(elem,name,extra);}},set:function(elem,value,extra){var styles=extra&&getStyles(elem);return setPositiveNumber(elem,value,extra?augmentWidthOrHeight(elem,name,extra,support.boxSizing&&jQuery.css(elem,"boxSizing",false,styles)==="border-box",styles):0);}};});if(!support.opacity){jQuery.cssHooks.opacity={get:function(elem,computed){return ropacity.test((computed&&elem.currentStyle?elem.currentStyle.filter:elem.style.filter)||"")?(0.01*parseFloat(RegExp.$1))+"":computed?"1":"";},set:function(elem,value){var style=elem.style,currentStyle=elem.currentStyle,opacity=jQuery.isNumeric(value)?"alpha(opacity="+value*100+")":"",filter=currentStyle&&currentStyle.filter||style.filter||"";style.zoom=1;if((value>=1||value==="")&&jQuery.trim(filter.replace(ralpha,""))===""&&style.removeAttribute){style.removeAttribute("filter");if(value===""||currentStyle&&!currentStyle.filter){return;}}
style.filter=ralpha.test(filter)?filter.replace(ralpha,opacity):filter+" "+opacity;}};}
jQuery.cssHooks.marginRight=addGetHookIf(support.reliableMarginRight,function(elem,computed){if(computed){return jQuery.swap(elem,{"display":"inline-block"},curCSS,[elem,"marginRight"]);}});jQuery.each({margin:"",padding:"",border:"Width"},function(prefix,suffix){jQuery.cssHooks[prefix+suffix]={expand:function(value){var i=0,expanded={},parts=typeof value==="string"?value.split(" "):[value];for(;i<4;i++){expanded[prefix+cssExpand[i]+suffix]=parts[i]||parts[i-2]||parts[0];}
return expanded;}};if(!rmargin.test(prefix)){jQuery.cssHooks[prefix+suffix].set=setPositiveNumber;}});jQuery.fn.extend({css:function(name,value){return access(this,function(elem,name,value){var styles,len,map={},i=0;if(jQuery.isArray(name)){styles=getStyles(elem);len=name.length;for(;i<len;i++){map[name[i]]=jQuery.css(elem,name[i],false,styles);}
return map;}
return value!==undefined?jQuery.style(elem,name,value):jQuery.css(elem,name);},name,value,arguments.length>1);},show:function(){return showHide(this,true);},hide:function(){return showHide(this);},toggle:function(state){if(typeof state==="boolean"){return state?this.show():this.hide();}
return this.each(function(){if(isHidden(this)){jQuery(this).show();}else{jQuery(this).hide();}});}});function Tween(elem,options,prop,end,easing){return new Tween.prototype.init(elem,options,prop,end,easing);}
jQuery.Tween=Tween;Tween.prototype={constructor:Tween,init:function(elem,options,prop,end,easing,unit){this.elem=elem;this.prop=prop;this.easing=easing||"swing";this.options=options;this.start=this.now=this.cur();this.end=end;this.unit=unit||(jQuery.cssNumber[prop]?"":"px");},cur:function(){var hooks=Tween.propHooks[this.prop];return hooks&&hooks.get?hooks.get(this):Tween.propHooks._default.get(this);},run:function(percent){var eased,hooks=Tween.propHooks[this.prop];if(this.options.duration){this.pos=eased=jQuery.easing[this.easing](percent,this.options.duration*percent,0,1,this.options.duration);}else{this.pos=eased=percent;}
this.now=(this.end-this.start)*eased+this.start;if(this.options.step){this.options.step.call(this.elem,this.now,this);}
if(hooks&&hooks.set){hooks.set(this);}else{Tween.propHooks._default.set(this);}
return this;}};Tween.prototype.init.prototype=Tween.prototype;Tween.propHooks={_default:{get:function(tween){var result;if(tween.elem[tween.prop]!=null&&(!tween.elem.style||tween.elem.style[tween.prop]==null)){return tween.elem[tween.prop];}
result=jQuery.css(tween.elem,tween.prop,"");return!result||result==="auto"?0:result;},set:function(tween){if(jQuery.fx.step[tween.prop]){jQuery.fx.step[tween.prop](tween);}else if(tween.elem.style&&(tween.elem.style[jQuery.cssProps[tween.prop]]!=null||jQuery.cssHooks[tween.prop])){jQuery.style(tween.elem,tween.prop,tween.now+tween.unit);}else{tween.elem[tween.prop]=tween.now;}}}};Tween.propHooks.scrollTop=Tween.propHooks.scrollLeft={set:function(tween){if(tween.elem.nodeType&&tween.elem.parentNode){tween.elem[tween.prop]=tween.now;}}};jQuery.easing={linear:function(p){return p;},swing:function(p){return 0.5-Math.cos(p*Math.PI)/2;}};jQuery.fx=Tween.prototype.init;jQuery.fx.step={};var
fxNow,timerId,rfxtypes=/^(?:toggle|show|hide)$/,rfxnum=new RegExp("^(?:([+-])=|)("+pnum+")([a-z%]*)$","i"),rrun=/queueHooks$/,animationPrefilters=[defaultPrefilter],tweeners={"*":[function(prop,value){var tween=this.createTween(prop,value),target=tween.cur(),parts=rfxnum.exec(value),unit=parts&&parts[3]||(jQuery.cssNumber[prop]?"":"px"),start=(jQuery.cssNumber[prop]||unit!=="px"&&+target)&&rfxnum.exec(jQuery.css(tween.elem,prop)),scale=1,maxIterations=20;if(start&&start[3]!==unit){unit=unit||start[3];parts=parts||[];start=+target||1;do{scale=scale||".5";start=start/scale;jQuery.style(tween.elem,prop,start+unit);}while(scale!==(scale=tween.cur()/target)&&scale!==1&&--maxIterations);}
if(parts){start=tween.start=+start||+target||0;tween.unit=unit;tween.end=parts[1]?start+(parts[1]+1)*parts[2]:+parts[2];}
return tween;}]};function createFxNow(){setTimeout(function(){fxNow=undefined;});return(fxNow=jQuery.now());}
function genFx(type,includeWidth){var which,attrs={height:type},i=0;includeWidth=includeWidth?1:0;for(;i<4;i+=2-includeWidth){which=cssExpand[i];attrs["margin"+which]=attrs["padding"+which]=type;}
if(includeWidth){attrs.opacity=attrs.width=type;}
return attrs;}
function createTween(value,prop,animation){var tween,collection=(tweeners[prop]||[]).concat(tweeners["*"]),index=0,length=collection.length;for(;index<length;index++){if((tween=collection[index].call(animation,prop,value))){return tween;}}}
function defaultPrefilter(elem,props,opts){var prop,value,toggle,tween,hooks,oldfire,display,checkDisplay,anim=this,orig={},style=elem.style,hidden=elem.nodeType&&isHidden(elem),dataShow=jQuery._data(elem,"fxshow");if(!opts.queue){hooks=jQuery._queueHooks(elem,"fx");if(hooks.unqueued==null){hooks.unqueued=0;oldfire=hooks.empty.fire;hooks.empty.fire=function(){if(!hooks.unqueued){oldfire();}};}
hooks.unqueued++;anim.always(function(){anim.always(function(){hooks.unqueued--;if(!jQuery.queue(elem,"fx").length){hooks.empty.fire();}});});}
if(elem.nodeType===1&&("height"in props||"width"in props)){opts.overflow=[style.overflow,style.overflowX,style.overflowY];display=jQuery.css(elem,"display");checkDisplay=display==="none"?jQuery._data(elem,"olddisplay")||defaultDisplay(elem.nodeName):display;if(checkDisplay==="inline"&&jQuery.css(elem,"float")==="none"){if(!support.inlineBlockNeedsLayout||defaultDisplay(elem.nodeName)==="inline"){style.display="inline-block";}else{style.zoom=1;}}}
if(opts.overflow){style.overflow="hidden";if(!support.shrinkWrapBlocks()){anim.always(function(){style.overflow=opts.overflow[0];style.overflowX=opts.overflow[1];style.overflowY=opts.overflow[2];});}}
for(prop in props){value=props[prop];if(rfxtypes.exec(value)){delete props[prop];toggle=toggle||value==="toggle";if(value===(hidden?"hide":"show")){if(value==="show"&&dataShow&&dataShow[prop]!==undefined){hidden=true;}else{continue;}}
orig[prop]=dataShow&&dataShow[prop]||jQuery.style(elem,prop);}else{display=undefined;}}
if(!jQuery.isEmptyObject(orig)){if(dataShow){if("hidden"in dataShow){hidden=dataShow.hidden;}}else{dataShow=jQuery._data(elem,"fxshow",{});}
if(toggle){dataShow.hidden=!hidden;}
if(hidden){jQuery(elem).show();}else{anim.done(function(){jQuery(elem).hide();});}
anim.done(function(){var prop;jQuery._removeData(elem,"fxshow");for(prop in orig){jQuery.style(elem,prop,orig[prop]);}});for(prop in orig){tween=createTween(hidden?dataShow[prop]:0,prop,anim);if(!(prop in dataShow)){dataShow[prop]=tween.start;if(hidden){tween.end=tween.start;tween.start=prop==="width"||prop==="height"?1:0;}}}}else if((display==="none"?defaultDisplay(elem.nodeName):display)==="inline"){style.display=display;}}
function propFilter(props,specialEasing){var index,name,easing,value,hooks;for(index in props){name=jQuery.camelCase(index);easing=specialEasing[name];value=props[index];if(jQuery.isArray(value)){easing=value[1];value=props[index]=value[0];}
if(index!==name){props[name]=value;delete props[index];}
hooks=jQuery.cssHooks[name];if(hooks&&"expand"in hooks){value=hooks.expand(value);delete props[name];for(index in value){if(!(index in props)){props[index]=value[index];specialEasing[index]=easing;}}}else{specialEasing[name]=easing;}}}
function Animation(elem,properties,options){var result,stopped,index=0,length=animationPrefilters.length,deferred=jQuery.Deferred().always(function(){delete tick.elem;}),tick=function(){if(stopped){return false;}
var currentTime=fxNow||createFxNow(),remaining=Math.max(0,animation.startTime+animation.duration-currentTime),temp=remaining/animation.duration||0,percent=1-temp,index=0,length=animation.tweens.length;for(;index<length;index++){animation.tweens[index].run(percent);}
deferred.notifyWith(elem,[animation,percent,remaining]);if(percent<1&&length){return remaining;}else{deferred.resolveWith(elem,[animation]);return false;}},animation=deferred.promise({elem:elem,props:jQuery.extend({},properties),opts:jQuery.extend(true,{specialEasing:{}},options),originalProperties:properties,originalOptions:options,startTime:fxNow||createFxNow(),duration:options.duration,tweens:[],createTween:function(prop,end){var tween=jQuery.Tween(elem,animation.opts,prop,end,animation.opts.specialEasing[prop]||animation.opts.easing);animation.tweens.push(tween);return tween;},stop:function(gotoEnd){var index=0,length=gotoEnd?animation.tweens.length:0;if(stopped){return this;}
stopped=true;for(;index<length;index++){animation.tweens[index].run(1);}
if(gotoEnd){deferred.resolveWith(elem,[animation,gotoEnd]);}else{deferred.rejectWith(elem,[animation,gotoEnd]);}
return this;}}),props=animation.props;propFilter(props,animation.opts.specialEasing);for(;index<length;index++){result=animationPrefilters[index].call(animation,elem,props,animation.opts);if(result){return result;}}
jQuery.map(props,createTween,animation);if(jQuery.isFunction(animation.opts.start)){animation.opts.start.call(elem,animation);}
jQuery.fx.timer(jQuery.extend(tick,{elem:elem,anim:animation,queue:animation.opts.queue}));return animation.progress(animation.opts.progress).done(animation.opts.done,animation.opts.complete).fail(animation.opts.fail).always(animation.opts.always);}
jQuery.Animation=jQuery.extend(Animation,{tweener:function(props,callback){if(jQuery.isFunction(props)){callback=props;props=["*"];}else{props=props.split(" ");}
var prop,index=0,length=props.length;for(;index<length;index++){prop=props[index];tweeners[prop]=tweeners[prop]||[];tweeners[prop].unshift(callback);}},prefilter:function(callback,prepend){if(prepend){animationPrefilters.unshift(callback);}else{animationPrefilters.push(callback);}}});jQuery.speed=function(speed,easing,fn){var opt=speed&&typeof speed==="object"?jQuery.extend({},speed):{complete:fn||!fn&&easing||jQuery.isFunction(speed)&&speed,duration:speed,easing:fn&&easing||easing&&!jQuery.isFunction(easing)&&easing};opt.duration=jQuery.fx.off?0:typeof opt.duration==="number"?opt.duration:opt.duration in jQuery.fx.speeds?jQuery.fx.speeds[opt.duration]:jQuery.fx.speeds._default;if(opt.queue==null||opt.queue===true){opt.queue="fx";}
opt.old=opt.complete;opt.complete=function(){if(jQuery.isFunction(opt.old)){opt.old.call(this);}
if(opt.queue){jQuery.dequeue(this,opt.queue);}};return opt;};jQuery.fn.extend({fadeTo:function(speed,to,easing,callback){return this.filter(isHidden).css("opacity",0).show().end().animate({opacity:to},speed,easing,callback);},animate:function(prop,speed,easing,callback){var empty=jQuery.isEmptyObject(prop),optall=jQuery.speed(speed,easing,callback),doAnimation=function(){var anim=Animation(this,jQuery.extend({},prop),optall);if(empty||jQuery._data(this,"finish")){anim.stop(true);}};doAnimation.finish=doAnimation;return empty||optall.queue===false?this.each(doAnimation):this.queue(optall.queue,doAnimation);},stop:function(type,clearQueue,gotoEnd){var stopQueue=function(hooks){var stop=hooks.stop;delete hooks.stop;stop(gotoEnd);};if(typeof type!=="string"){gotoEnd=clearQueue;clearQueue=type;type=undefined;}
if(clearQueue&&type!==false){this.queue(type||"fx",[]);}
return this.each(function(){var dequeue=true,index=type!=null&&type+"queueHooks",timers=jQuery.timers,data=jQuery._data(this);if(index){if(data[index]&&data[index].stop){stopQueue(data[index]);}}else{for(index in data){if(data[index]&&data[index].stop&&rrun.test(index)){stopQueue(data[index]);}}}
for(index=timers.length;index--;){if(timers[index].elem===this&&(type==null||timers[index].queue===type)){timers[index].anim.stop(gotoEnd);dequeue=false;timers.splice(index,1);}}
if(dequeue||!gotoEnd){jQuery.dequeue(this,type);}});},finish:function(type){if(type!==false){type=type||"fx";}
return this.each(function(){var index,data=jQuery._data(this),queue=data[type+"queue"],hooks=data[type+"queueHooks"],timers=jQuery.timers,length=queue?queue.length:0;data.finish=true;jQuery.queue(this,type,[]);if(hooks&&hooks.stop){hooks.stop.call(this,true);}
for(index=timers.length;index--;){if(timers[index].elem===this&&timers[index].queue===type){timers[index].anim.stop(true);timers.splice(index,1);}}
for(index=0;index<length;index++){if(queue[index]&&queue[index].finish){queue[index].finish.call(this);}}
delete data.finish;});}});jQuery.each(["toggle","show","hide"],function(i,name){var cssFn=jQuery.fn[name];jQuery.fn[name]=function(speed,easing,callback){return speed==null||typeof speed==="boolean"?cssFn.apply(this,arguments):this.animate(genFx(name,true),speed,easing,callback);};});jQuery.each({slideDown:genFx("show"),slideUp:genFx("hide"),slideToggle:genFx("toggle"),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(name,props){jQuery.fn[name]=function(speed,easing,callback){return this.animate(props,speed,easing,callback);};});jQuery.timers=[];jQuery.fx.tick=function(){var timer,timers=jQuery.timers,i=0;fxNow=jQuery.now();for(;i<timers.length;i++){timer=timers[i];if(!timer()&&timers[i]===timer){timers.splice(i--,1);}}
if(!timers.length){jQuery.fx.stop();}
fxNow=undefined;};jQuery.fx.timer=function(timer){jQuery.timers.push(timer);if(timer()){jQuery.fx.start();}else{jQuery.timers.pop();}};jQuery.fx.interval=13;jQuery.fx.start=function(){if(!timerId){timerId=setInterval(jQuery.fx.tick,jQuery.fx.interval);}};jQuery.fx.stop=function(){clearInterval(timerId);timerId=null;};jQuery.fx.speeds={slow:600,fast:200,_default:400};jQuery.fn.delay=function(time,type){time=jQuery.fx?jQuery.fx.speeds[time]||time:time;type=type||"fx";return this.queue(type,function(next,hooks){var timeout=setTimeout(next,time);hooks.stop=function(){clearTimeout(timeout);};});};(function(){var input,div,select,a,opt;div=document.createElement("div");div.setAttribute("className","t");div.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>";a=div.getElementsByTagName("a")[0];select=document.createElement("select");opt=select.appendChild(document.createElement("option"));input=div.getElementsByTagName("input")[0];a.style.cssText="top:1px";support.getSetAttribute=div.className!=="t";support.style=/top/.test(a.getAttribute("style"));support.hrefNormalized=a.getAttribute("href")==="/a";support.checkOn=!!input.value;support.optSelected=opt.selected;support.enctype=!!document.createElement("form").enctype;select.disabled=true;support.optDisabled=!opt.disabled;input=document.createElement("input");input.setAttribute("value","");support.input=input.getAttribute("value")==="";input.value="t";input.setAttribute("type","radio");support.radioValue=input.value==="t";})();var rreturn=/\r/g;jQuery.fn.extend({val:function(value){var hooks,ret,isFunction,elem=this[0];if(!arguments.length){if(elem){hooks=jQuery.valHooks[elem.type]||jQuery.valHooks[elem.nodeName.toLowerCase()];if(hooks&&"get"in hooks&&(ret=hooks.get(elem,"value"))!==undefined){return ret;}
ret=elem.value;return typeof ret==="string"?ret.replace(rreturn,""):ret==null?"":ret;}
return;}
isFunction=jQuery.isFunction(value);return this.each(function(i){var val;if(this.nodeType!==1){return;}
if(isFunction){val=value.call(this,i,jQuery(this).val());}else{val=value;}
if(val==null){val="";}else if(typeof val==="number"){val+="";}else if(jQuery.isArray(val)){val=jQuery.map(val,function(value){return value==null?"":value+"";});}
hooks=jQuery.valHooks[this.type]||jQuery.valHooks[this.nodeName.toLowerCase()];if(!hooks||!("set"in hooks)||hooks.set(this,val,"value")===undefined){this.value=val;}});}});jQuery.extend({valHooks:{option:{get:function(elem){var val=jQuery.find.attr(elem,"value");return val!=null?val:jQuery.trim(jQuery.text(elem));}},select:{get:function(elem){var value,option,options=elem.options,index=elem.selectedIndex,one=elem.type==="select-one"||index<0,values=one?null:[],max=one?index+1:options.length,i=index<0?max:one?index:0;for(;i<max;i++){option=options[i];if((option.selected||i===index)&&(support.optDisabled?!option.disabled:option.getAttribute("disabled")===null)&&(!option.parentNode.disabled||!jQuery.nodeName(option.parentNode,"optgroup"))){value=jQuery(option).val();if(one){return value;}
values.push(value);}}
return values;},set:function(elem,value){var optionSet,option,options=elem.options,values=jQuery.makeArray(value),i=options.length;while(i--){option=options[i];if(jQuery.inArray(jQuery.valHooks.option.get(option),values)>=0){try{option.selected=optionSet=true;}catch(_){option.scrollHeight;}}else{option.selected=false;}}
if(!optionSet){elem.selectedIndex=-1;}
return options;}}}});jQuery.each(["radio","checkbox"],function(){jQuery.valHooks[this]={set:function(elem,value){if(jQuery.isArray(value)){return(elem.checked=jQuery.inArray(jQuery(elem).val(),value)>=0);}}};if(!support.checkOn){jQuery.valHooks[this].get=function(elem){return elem.getAttribute("value")===null?"on":elem.value;};}});var nodeHook,boolHook,attrHandle=jQuery.expr.attrHandle,ruseDefault=/^(?:checked|selected)$/i,getSetAttribute=support.getSetAttribute,getSetInput=support.input;jQuery.fn.extend({attr:function(name,value){return access(this,jQuery.attr,name,value,arguments.length>1);},removeAttr:function(name){return this.each(function(){jQuery.removeAttr(this,name);});}});jQuery.extend({attr:function(elem,name,value){var hooks,ret,nType=elem.nodeType;if(!elem||nType===3||nType===8||nType===2){return;}
if(typeof elem.getAttribute===strundefined){return jQuery.prop(elem,name,value);}
if(nType!==1||!jQuery.isXMLDoc(elem)){name=name.toLowerCase();hooks=jQuery.attrHooks[name]||(jQuery.expr.match.bool.test(name)?boolHook:nodeHook);}
if(value!==undefined){if(value===null){jQuery.removeAttr(elem,name);}else if(hooks&&"set"in hooks&&(ret=hooks.set(elem,value,name))!==undefined){return ret;}else{elem.setAttribute(name,value+"");return value;}}else if(hooks&&"get"in hooks&&(ret=hooks.get(elem,name))!==null){return ret;}else{ret=jQuery.find.attr(elem,name);return ret==null?undefined:ret;}},removeAttr:function(elem,value){var name,propName,i=0,attrNames=value&&value.match(rnotwhite);if(attrNames&&elem.nodeType===1){while((name=attrNames[i++])){propName=jQuery.propFix[name]||name;if(jQuery.expr.match.bool.test(name)){if(getSetInput&&getSetAttribute||!ruseDefault.test(name)){elem[propName]=false;}else{elem[jQuery.camelCase("default-"+name)]=elem[propName]=false;}}else{jQuery.attr(elem,name,"");}
elem.removeAttribute(getSetAttribute?name:propName);}}},attrHooks:{type:{set:function(elem,value){if(!support.radioValue&&value==="radio"&&jQuery.nodeName(elem,"input")){var val=elem.value;elem.setAttribute("type",value);if(val){elem.value=val;}
return value;}}}}});boolHook={set:function(elem,value,name){if(value===false){jQuery.removeAttr(elem,name);}else if(getSetInput&&getSetAttribute||!ruseDefault.test(name)){elem.setAttribute(!getSetAttribute&&jQuery.propFix[name]||name,name);}else{elem[jQuery.camelCase("default-"+name)]=elem[name]=true;}
return name;}};jQuery.each(jQuery.expr.match.bool.source.match(/\w+/g),function(i,name){var getter=attrHandle[name]||jQuery.find.attr;attrHandle[name]=getSetInput&&getSetAttribute||!ruseDefault.test(name)?function(elem,name,isXML){var ret,handle;if(!isXML){handle=attrHandle[name];attrHandle[name]=ret;ret=getter(elem,name,isXML)!=null?name.toLowerCase():null;attrHandle[name]=handle;}
return ret;}:function(elem,name,isXML){if(!isXML){return elem[jQuery.camelCase("default-"+name)]?name.toLowerCase():null;}};});if(!getSetInput||!getSetAttribute){jQuery.attrHooks.value={set:function(elem,value,name){if(jQuery.nodeName(elem,"input")){elem.defaultValue=value;}else{return nodeHook&&nodeHook.set(elem,value,name);}}};}
if(!getSetAttribute){nodeHook={set:function(elem,value,name){var ret=elem.getAttributeNode(name);if(!ret){elem.setAttributeNode((ret=elem.ownerDocument.createAttribute(name)));}
ret.value=value+="";if(name==="value"||value===elem.getAttribute(name)){return value;}}};attrHandle.id=attrHandle.name=attrHandle.coords=function(elem,name,isXML){var ret;if(!isXML){return(ret=elem.getAttributeNode(name))&&ret.value!==""?ret.value:null;}};jQuery.valHooks.button={get:function(elem,name){var ret=elem.getAttributeNode(name);if(ret&&ret.specified){return ret.value;}},set:nodeHook.set};jQuery.attrHooks.contenteditable={set:function(elem,value,name){nodeHook.set(elem,value===""?false:value,name);}};jQuery.each(["width","height"],function(i,name){jQuery.attrHooks[name]={set:function(elem,value){if(value===""){elem.setAttribute(name,"auto");return value;}}};});}
if(!support.style){jQuery.attrHooks.style={get:function(elem){return elem.style.cssText||undefined;},set:function(elem,value){return(elem.style.cssText=value+"");}};}
var rfocusable=/^(?:input|select|textarea|button|object)$/i,rclickable=/^(?:a|area)$/i;jQuery.fn.extend({prop:function(name,value){return access(this,jQuery.prop,name,value,arguments.length>1);},removeProp:function(name){name=jQuery.propFix[name]||name;return this.each(function(){try{this[name]=undefined;delete this[name];}catch(e){}});}});jQuery.extend({propFix:{"for":"htmlFor","class":"className"},prop:function(elem,name,value){var ret,hooks,notxml,nType=elem.nodeType;if(!elem||nType===3||nType===8||nType===2){return;}
notxml=nType!==1||!jQuery.isXMLDoc(elem);if(notxml){name=jQuery.propFix[name]||name;hooks=jQuery.propHooks[name];}
if(value!==undefined){return hooks&&"set"in hooks&&(ret=hooks.set(elem,value,name))!==undefined?ret:(elem[name]=value);}else{return hooks&&"get"in hooks&&(ret=hooks.get(elem,name))!==null?ret:elem[name];}},propHooks:{tabIndex:{get:function(elem){var tabindex=jQuery.find.attr(elem,"tabindex");return tabindex?parseInt(tabindex,10):rfocusable.test(elem.nodeName)||rclickable.test(elem.nodeName)&&elem.href?0:-1;}}}});if(!support.hrefNormalized){jQuery.each(["href","src"],function(i,name){jQuery.propHooks[name]={get:function(elem){return elem.getAttribute(name,4);}};});}
if(!support.optSelected){jQuery.propHooks.selected={get:function(elem){var parent=elem.parentNode;if(parent){parent.selectedIndex;if(parent.parentNode){parent.parentNode.selectedIndex;}}
return null;}};}
jQuery.each(["tabIndex","readOnly","maxLength","cellSpacing","cellPadding","rowSpan","colSpan","useMap","frameBorder","contentEditable"],function(){jQuery.propFix[this.toLowerCase()]=this;});if(!support.enctype){jQuery.propFix.enctype="encoding";}
var rclass=/[\t\r\n\f]/g;jQuery.fn.extend({addClass:function(value){var classes,elem,cur,clazz,j,finalValue,i=0,len=this.length,proceed=typeof value==="string"&&value;if(jQuery.isFunction(value)){return this.each(function(j){jQuery(this).addClass(value.call(this,j,this.className));});}
if(proceed){classes=(value||"").match(rnotwhite)||[];for(;i<len;i++){elem=this[i];cur=elem.nodeType===1&&(elem.className?(" "+elem.className+" ").replace(rclass," "):" ");if(cur){j=0;while((clazz=classes[j++])){if(cur.indexOf(" "+clazz+" ")<0){cur+=clazz+" ";}}
finalValue=jQuery.trim(cur);if(elem.className!==finalValue){elem.className=finalValue;}}}}
return this;},removeClass:function(value){var classes,elem,cur,clazz,j,finalValue,i=0,len=this.length,proceed=arguments.length===0||typeof value==="string"&&value;if(jQuery.isFunction(value)){return this.each(function(j){jQuery(this).removeClass(value.call(this,j,this.className));});}
if(proceed){classes=(value||"").match(rnotwhite)||[];for(;i<len;i++){elem=this[i];cur=elem.nodeType===1&&(elem.className?(" "+elem.className+" ").replace(rclass," "):"");if(cur){j=0;while((clazz=classes[j++])){while(cur.indexOf(" "+clazz+" ")>=0){cur=cur.replace(" "+clazz+" "," ");}}
finalValue=value?jQuery.trim(cur):"";if(elem.className!==finalValue){elem.className=finalValue;}}}}
return this;},toggleClass:function(value,stateVal){var type=typeof value;if(typeof stateVal==="boolean"&&type==="string"){return stateVal?this.addClass(value):this.removeClass(value);}
if(jQuery.isFunction(value)){return this.each(function(i){jQuery(this).toggleClass(value.call(this,i,this.className,stateVal),stateVal);});}
return this.each(function(){if(type==="string"){var className,i=0,self=jQuery(this),classNames=value.match(rnotwhite)||[];while((className=classNames[i++])){if(self.hasClass(className)){self.removeClass(className);}else{self.addClass(className);}}}else if(type===strundefined||type==="boolean"){if(this.className){jQuery._data(this,"__className__",this.className);}
this.className=this.className||value===false?"":jQuery._data(this,"__className__")||"";}});},hasClass:function(selector){var className=" "+selector+" ",i=0,l=this.length;for(;i<l;i++){if(this[i].nodeType===1&&(" "+this[i].className+" ").replace(rclass," ").indexOf(className)>=0){return true;}}
return false;}});jQuery.each(("blur focus focusin focusout load resize scroll unload click dblclick "+"mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave "+"change select submit keydown keypress keyup error contextmenu").split(" "),function(i,name){jQuery.fn[name]=function(data,fn){return arguments.length>0?this.on(name,null,data,fn):this.trigger(name);};});jQuery.fn.extend({hover:function(fnOver,fnOut){return this.mouseenter(fnOver).mouseleave(fnOut||fnOver);},bind:function(types,data,fn){return this.on(types,null,data,fn);},unbind:function(types,fn){return this.off(types,null,fn);},delegate:function(selector,types,data,fn){return this.on(types,selector,data,fn);},undelegate:function(selector,types,fn){return arguments.length===1?this.off(selector,"**"):this.off(types,selector||"**",fn);}});var nonce=jQuery.now();var rquery=(/\?/);var rvalidtokens=/(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;jQuery.parseJSON=function(data){if(window.JSON&&window.JSON.parse){return window.JSON.parse(data+"");}
var requireNonComma,depth=null,str=jQuery.trim(data+"");return str&&!jQuery.trim(str.replace(rvalidtokens,function(token,comma,open,close){if(requireNonComma&&comma){depth=0;}
if(depth===0){return token;}
requireNonComma=open||comma;depth+=!close-!open;return"";}))?(Function("return "+str))():jQuery.error("Invalid JSON: "+data);};jQuery.parseXML=function(data){var xml,tmp;if(!data||typeof data!=="string"){return null;}
try{if(window.DOMParser){tmp=new DOMParser();xml=tmp.parseFromString(data,"text/xml");}else{xml=new ActiveXObject("Microsoft.XMLDOM");xml.async="false";xml.loadXML(data);}}catch(e){xml=undefined;}
if(!xml||!xml.documentElement||xml.getElementsByTagName("parsererror").length){jQuery.error("Invalid XML: "+data);}
return xml;};var
ajaxLocParts,ajaxLocation,rhash=/#.*$/,rts=/([?&])_=[^&]*/,rheaders=/^(.*?):[ \t]*([^\r\n]*)\r?$/mg,rlocalProtocol=/^(?:about|app|app-storage|.+-extension|file|res|widget):$/,rnoContent=/^(?:GET|HEAD)$/,rprotocol=/^\/\//,rurl=/^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,prefilters={},transports={},allTypes="*/".concat("*");try{ajaxLocation=location.href;}catch(e){ajaxLocation=document.createElement("a");ajaxLocation.href="";ajaxLocation=ajaxLocation.href;}
ajaxLocParts=rurl.exec(ajaxLocation.toLowerCase())||[];function addToPrefiltersOrTransports(structure){return function(dataTypeExpression,func){if(typeof dataTypeExpression!=="string"){func=dataTypeExpression;dataTypeExpression="*";}
var dataType,i=0,dataTypes=dataTypeExpression.toLowerCase().match(rnotwhite)||[];if(jQuery.isFunction(func)){while((dataType=dataTypes[i++])){if(dataType.charAt(0)==="+"){dataType=dataType.slice(1)||"*";(structure[dataType]=structure[dataType]||[]).unshift(func);}else{(structure[dataType]=structure[dataType]||[]).push(func);}}}};}
function inspectPrefiltersOrTransports(structure,options,originalOptions,jqXHR){var inspected={},seekingTransport=(structure===transports);function inspect(dataType){var selected;inspected[dataType]=true;jQuery.each(structure[dataType]||[],function(_,prefilterOrFactory){var dataTypeOrTransport=prefilterOrFactory(options,originalOptions,jqXHR);if(typeof dataTypeOrTransport==="string"&&!seekingTransport&&!inspected[dataTypeOrTransport]){options.dataTypes.unshift(dataTypeOrTransport);inspect(dataTypeOrTransport);return false;}else if(seekingTransport){return!(selected=dataTypeOrTransport);}});return selected;}
return inspect(options.dataTypes[0])||!inspected["*"]&&inspect("*");}
function ajaxExtend(target,src){var deep,key,flatOptions=jQuery.ajaxSettings.flatOptions||{};for(key in src){if(src[key]!==undefined){(flatOptions[key]?target:(deep||(deep={})))[key]=src[key];}}
if(deep){jQuery.extend(true,target,deep);}
return target;}
function ajaxHandleResponses(s,jqXHR,responses){var firstDataType,ct,finalDataType,type,contents=s.contents,dataTypes=s.dataTypes;while(dataTypes[0]==="*"){dataTypes.shift();if(ct===undefined){ct=s.mimeType||jqXHR.getResponseHeader("Content-Type");}}
if(ct){for(type in contents){if(contents[type]&&contents[type].test(ct)){dataTypes.unshift(type);break;}}}
if(dataTypes[0]in responses){finalDataType=dataTypes[0];}else{for(type in responses){if(!dataTypes[0]||s.converters[type+" "+dataTypes[0]]){finalDataType=type;break;}
if(!firstDataType){firstDataType=type;}}
finalDataType=finalDataType||firstDataType;}
if(finalDataType){if(finalDataType!==dataTypes[0]){dataTypes.unshift(finalDataType);}
return responses[finalDataType];}}
function ajaxConvert(s,response,jqXHR,isSuccess){var conv2,current,conv,tmp,prev,converters={},dataTypes=s.dataTypes.slice();if(dataTypes[1]){for(conv in s.converters){converters[conv.toLowerCase()]=s.converters[conv];}}
current=dataTypes.shift();while(current){if(s.responseFields[current]){jqXHR[s.responseFields[current]]=response;}
if(!prev&&isSuccess&&s.dataFilter){response=s.dataFilter(response,s.dataType);}
prev=current;current=dataTypes.shift();if(current){if(current==="*"){current=prev;}else if(prev!=="*"&&prev!==current){conv=converters[prev+" "+current]||converters["* "+current];if(!conv){for(conv2 in converters){tmp=conv2.split(" ");if(tmp[1]===current){conv=converters[prev+" "+tmp[0]]||converters["* "+tmp[0]];if(conv){if(conv===true){conv=converters[conv2];}else if(converters[conv2]!==true){current=tmp[0];dataTypes.unshift(tmp[1]);}
break;}}}}
if(conv!==true){if(conv&&s["throws"]){response=conv(response);}else{try{response=conv(response);}catch(e){return{state:"parsererror",error:conv?e:"No conversion from "+prev+" to "+current};}}}}}}
return{state:"success",data:response};}
jQuery.extend({active:0,lastModified:{},etag:{},ajaxSettings:{url:ajaxLocation,type:"GET",isLocal:rlocalProtocol.test(ajaxLocParts[1]),global:true,processData:true,async:true,contentType:"application/x-www-form-urlencoded; charset=UTF-8",accepts:{"*":allTypes,text:"text/plain",html:"text/html",xml:"application/xml, text/xml",json:"application/json, text/javascript"},contents:{xml:/xml/,html:/html/,json:/json/},responseFields:{xml:"responseXML",text:"responseText",json:"responseJSON"},converters:{"* text":String,"text html":true,"text json":jQuery.parseJSON,"text xml":jQuery.parseXML},flatOptions:{url:true,context:true}},ajaxSetup:function(target,settings){return settings?ajaxExtend(ajaxExtend(target,jQuery.ajaxSettings),settings):ajaxExtend(jQuery.ajaxSettings,target);},ajaxPrefilter:addToPrefiltersOrTransports(prefilters),ajaxTransport:addToPrefiltersOrTransports(transports),ajax:function(url,options){if(typeof url==="object"){options=url;url=undefined;}
options=options||{};var
parts,i,cacheURL,responseHeadersString,timeoutTimer,fireGlobals,transport,responseHeaders,s=jQuery.ajaxSetup({},options),callbackContext=s.context||s,globalEventContext=s.context&&(callbackContext.nodeType||callbackContext.jquery)?jQuery(callbackContext):jQuery.event,deferred=jQuery.Deferred(),completeDeferred=jQuery.Callbacks("once memory"),statusCode=s.statusCode||{},requestHeaders={},requestHeadersNames={},state=0,strAbort="canceled",jqXHR={readyState:0,getResponseHeader:function(key){var match;if(state===2){if(!responseHeaders){responseHeaders={};while((match=rheaders.exec(responseHeadersString))){responseHeaders[match[1].toLowerCase()]=match[2];}}
match=responseHeaders[key.toLowerCase()];}
return match==null?null:match;},getAllResponseHeaders:function(){return state===2?responseHeadersString:null;},setRequestHeader:function(name,value){var lname=name.toLowerCase();if(!state){name=requestHeadersNames[lname]=requestHeadersNames[lname]||name;requestHeaders[name]=value;}
return this;},overrideMimeType:function(type){if(!state){s.mimeType=type;}
return this;},statusCode:function(map){var code;if(map){if(state<2){for(code in map){statusCode[code]=[statusCode[code],map[code]];}}else{jqXHR.always(map[jqXHR.status]);}}
return this;},abort:function(statusText){var finalText=statusText||strAbort;if(transport){transport.abort(finalText);}
done(0,finalText);return this;}};deferred.promise(jqXHR).complete=completeDeferred.add;jqXHR.success=jqXHR.done;jqXHR.error=jqXHR.fail;s.url=((url||s.url||ajaxLocation)+"").replace(rhash,"").replace(rprotocol,ajaxLocParts[1]+"//");s.type=options.method||options.type||s.method||s.type;s.dataTypes=jQuery.trim(s.dataType||"*").toLowerCase().match(rnotwhite)||[""];if(s.crossDomain==null){parts=rurl.exec(s.url.toLowerCase());s.crossDomain=!!(parts&&(parts[1]!==ajaxLocParts[1]||parts[2]!==ajaxLocParts[2]||(parts[3]||(parts[1]==="http:"?"80":"443"))!==(ajaxLocParts[3]||(ajaxLocParts[1]==="http:"?"80":"443"))));}
if(s.data&&s.processData&&typeof s.data!=="string"){s.data=jQuery.param(s.data,s.traditional);}
inspectPrefiltersOrTransports(prefilters,s,options,jqXHR);if(state===2){return jqXHR;}
fireGlobals=jQuery.event&&s.global;if(fireGlobals&&jQuery.active++===0){jQuery.event.trigger("ajaxStart");}
s.type=s.type.toUpperCase();s.hasContent=!rnoContent.test(s.type);cacheURL=s.url;if(!s.hasContent){if(s.data){cacheURL=(s.url+=(rquery.test(cacheURL)?"&":"?")+s.data);delete s.data;}
if(s.cache===false){s.url=rts.test(cacheURL)?cacheURL.replace(rts,"$1_="+nonce++):cacheURL+(rquery.test(cacheURL)?"&":"?")+"_="+nonce++;}}
if(s.ifModified){if(jQuery.lastModified[cacheURL]){jqXHR.setRequestHeader("If-Modified-Since",jQuery.lastModified[cacheURL]);}
if(jQuery.etag[cacheURL]){jqXHR.setRequestHeader("If-None-Match",jQuery.etag[cacheURL]);}}
if(s.data&&s.hasContent&&s.contentType!==false||options.contentType){jqXHR.setRequestHeader("Content-Type",s.contentType);}
jqXHR.setRequestHeader("Accept",s.dataTypes[0]&&s.accepts[s.dataTypes[0]]?s.accepts[s.dataTypes[0]]+(s.dataTypes[0]!=="*"?", "+allTypes+"; q=0.01":""):s.accepts["*"]);for(i in s.headers){jqXHR.setRequestHeader(i,s.headers[i]);}
if(s.beforeSend&&(s.beforeSend.call(callbackContext,jqXHR,s)===false||state===2)){return jqXHR.abort();}
strAbort="abort";for(i in{success:1,error:1,complete:1}){jqXHR[i](s[i]);}
transport=inspectPrefiltersOrTransports(transports,s,options,jqXHR);if(!transport){done(-1,"No Transport");}else{jqXHR.readyState=1;if(fireGlobals){globalEventContext.trigger("ajaxSend",[jqXHR,s]);}
if(s.async&&s.timeout>0){timeoutTimer=setTimeout(function(){jqXHR.abort("timeout");},s.timeout);}
try{state=1;transport.send(requestHeaders,done);}catch(e){if(state<2){done(-1,e);}else{throw e;}}}
function done(status,nativeStatusText,responses,headers){var isSuccess,success,error,response,modified,statusText=nativeStatusText;if(state===2){return;}
state=2;if(timeoutTimer){clearTimeout(timeoutTimer);}
transport=undefined;responseHeadersString=headers||"";jqXHR.readyState=status>0?4:0;isSuccess=status>=200&&status<300||status===304;if(responses){response=ajaxHandleResponses(s,jqXHR,responses);}
response=ajaxConvert(s,response,jqXHR,isSuccess);if(isSuccess){if(s.ifModified){modified=jqXHR.getResponseHeader("Last-Modified");if(modified){jQuery.lastModified[cacheURL]=modified;}
modified=jqXHR.getResponseHeader("etag");if(modified){jQuery.etag[cacheURL]=modified;}}
if(status===204||s.type==="HEAD"){statusText="nocontent";}else if(status===304){statusText="notmodified";}else{statusText=response.state;success=response.data;error=response.error;isSuccess=!error;}}else{error=statusText;if(status||!statusText){statusText="error";if(status<0){status=0;}}}
jqXHR.status=status;jqXHR.statusText=(nativeStatusText||statusText)+"";if(isSuccess){deferred.resolveWith(callbackContext,[success,statusText,jqXHR]);}else{deferred.rejectWith(callbackContext,[jqXHR,statusText,error]);}
jqXHR.statusCode(statusCode);statusCode=undefined;if(fireGlobals){globalEventContext.trigger(isSuccess?"ajaxSuccess":"ajaxError",[jqXHR,s,isSuccess?success:error]);}
completeDeferred.fireWith(callbackContext,[jqXHR,statusText]);if(fireGlobals){globalEventContext.trigger("ajaxComplete",[jqXHR,s]);if(!(--jQuery.active)){jQuery.event.trigger("ajaxStop");}}}
return jqXHR;},getJSON:function(url,data,callback){return jQuery.get(url,data,callback,"json");},getScript:function(url,callback){return jQuery.get(url,undefined,callback,"script");}});jQuery.each(["get","post"],function(i,method){jQuery[method]=function(url,data,callback,type){if(jQuery.isFunction(data)){type=type||callback;callback=data;data=undefined;}
return jQuery.ajax({url:url,type:method,dataType:type,data:data,success:callback});};});jQuery._evalUrl=function(url){return jQuery.ajax({url:url,type:"GET",dataType:"script",async:false,global:false,"throws":true});};jQuery.fn.extend({wrapAll:function(html){if(jQuery.isFunction(html)){return this.each(function(i){jQuery(this).wrapAll(html.call(this,i));});}
if(this[0]){var wrap=jQuery(html,this[0].ownerDocument).eq(0).clone(true);if(this[0].parentNode){wrap.insertBefore(this[0]);}
wrap.map(function(){var elem=this;while(elem.firstChild&&elem.firstChild.nodeType===1){elem=elem.firstChild;}
return elem;}).append(this);}
return this;},wrapInner:function(html){if(jQuery.isFunction(html)){return this.each(function(i){jQuery(this).wrapInner(html.call(this,i));});}
return this.each(function(){var self=jQuery(this),contents=self.contents();if(contents.length){contents.wrapAll(html);}else{self.append(html);}});},wrap:function(html){var isFunction=jQuery.isFunction(html);return this.each(function(i){jQuery(this).wrapAll(isFunction?html.call(this,i):html);});},unwrap:function(){return this.parent().each(function(){if(!jQuery.nodeName(this,"body")){jQuery(this).replaceWith(this.childNodes);}}).end();}});jQuery.expr.filters.hidden=function(elem){return elem.offsetWidth<=0&&elem.offsetHeight<=0||(!support.reliableHiddenOffsets()&&((elem.style&&elem.style.display)||jQuery.css(elem,"display"))==="none");};jQuery.expr.filters.visible=function(elem){return!jQuery.expr.filters.hidden(elem);};var r20=/%20/g,rbracket=/\[\]$/,rCRLF=/\r?\n/g,rsubmitterTypes=/^(?:submit|button|image|reset|file)$/i,rsubmittable=/^(?:input|select|textarea|keygen)/i;function buildParams(prefix,obj,traditional,add){var name;if(jQuery.isArray(obj)){jQuery.each(obj,function(i,v){if(traditional||rbracket.test(prefix)){add(prefix,v);}else{buildParams(prefix+"["+(typeof v==="object"?i:"")+"]",v,traditional,add);}});}else if(!traditional&&jQuery.type(obj)==="object"){for(name in obj){buildParams(prefix+"["+name+"]",obj[name],traditional,add);}}else{add(prefix,obj);}}
jQuery.param=function(a,traditional){var prefix,s=[],add=function(key,value){value=jQuery.isFunction(value)?value():(value==null?"":value);s[s.length]=encodeURIComponent(key)+"="+encodeURIComponent(value);};if(traditional===undefined){traditional=jQuery.ajaxSettings&&jQuery.ajaxSettings.traditional;}
if(jQuery.isArray(a)||(a.jquery&&!jQuery.isPlainObject(a))){jQuery.each(a,function(){add(this.name,this.value);});}else{for(prefix in a){buildParams(prefix,a[prefix],traditional,add);}}
return s.join("&").replace(r20,"+");};jQuery.fn.extend({serialize:function(){return jQuery.param(this.serializeArray());},serializeArray:function(){return this.map(function(){var elements=jQuery.prop(this,"elements");return elements?jQuery.makeArray(elements):this;}).filter(function(){var type=this.type;return this.name&&!jQuery(this).is(":disabled")&&rsubmittable.test(this.nodeName)&&!rsubmitterTypes.test(type)&&(this.checked||!rcheckableType.test(type));}).map(function(i,elem){var val=jQuery(this).val();return val==null?null:jQuery.isArray(val)?jQuery.map(val,function(val){return{name:elem.name,value:val.replace(rCRLF,"\r\n")};}):{name:elem.name,value:val.replace(rCRLF,"\r\n")};}).get();}});jQuery.ajaxSettings.xhr=window.ActiveXObject!==undefined?function(){return!this.isLocal&&/^(get|post|head|put|delete|options)$/i.test(this.type)&&createStandardXHR()||createActiveXHR();}:createStandardXHR;var xhrId=0,xhrCallbacks={},xhrSupported=jQuery.ajaxSettings.xhr();if(window.attachEvent){window.attachEvent("onunload",function(){for(var key in xhrCallbacks){xhrCallbacks[key](undefined,true);}});}
support.cors=!!xhrSupported&&("withCredentials"in xhrSupported);xhrSupported=support.ajax=!!xhrSupported;if(xhrSupported){jQuery.ajaxTransport(function(options){if(!options.crossDomain||support.cors){var callback;return{send:function(headers,complete){var i,xhr=options.xhr(),id=++xhrId;xhr.open(options.type,options.url,options.async,options.username,options.password);if(options.xhrFields){for(i in options.xhrFields){xhr[i]=options.xhrFields[i];}}
if(options.mimeType&&xhr.overrideMimeType){xhr.overrideMimeType(options.mimeType);}
if(!options.crossDomain&&!headers["X-Requested-With"]){headers["X-Requested-With"]="XMLHttpRequest";}
for(i in headers){if(headers[i]!==undefined){xhr.setRequestHeader(i,headers[i]+"");}}
xhr.send((options.hasContent&&options.data)||null);callback=function(_,isAbort){var status,statusText,responses;if(callback&&(isAbort||xhr.readyState===4)){delete xhrCallbacks[id];callback=undefined;xhr.onreadystatechange=jQuery.noop;if(isAbort){if(xhr.readyState!==4){xhr.abort();}}else{responses={};status=xhr.status;if(typeof xhr.responseText==="string"){responses.text=xhr.responseText;}
try{statusText=xhr.statusText;}catch(e){statusText="";}
if(!status&&options.isLocal&&!options.crossDomain){status=responses.text?200:404;}else if(status===1223){status=204;}}}
if(responses){complete(status,statusText,responses,xhr.getAllResponseHeaders());}};if(!options.async){callback();}else if(xhr.readyState===4){setTimeout(callback);}else{xhr.onreadystatechange=xhrCallbacks[id]=callback;}},abort:function(){if(callback){callback(undefined,true);}}};}});}
function createStandardXHR(){try{return new window.XMLHttpRequest();}catch(e){}}
function createActiveXHR(){try{return new window.ActiveXObject("Microsoft.XMLHTTP");}catch(e){}}
jQuery.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/(?:java|ecma)script/},converters:{"text script":function(text){jQuery.globalEval(text);return text;}}});jQuery.ajaxPrefilter("script",function(s){if(s.cache===undefined){s.cache=false;}
if(s.crossDomain){s.type="GET";s.global=false;}});jQuery.ajaxTransport("script",function(s){if(s.crossDomain){var script,head=document.head||jQuery("head")[0]||document.documentElement;return{send:function(_,callback){script=document.createElement("script");script.async=true;if(s.scriptCharset){script.charset=s.scriptCharset;}
script.src=s.url;script.onload=script.onreadystatechange=function(_,isAbort){if(isAbort||!script.readyState||/loaded|complete/.test(script.readyState)){script.onload=script.onreadystatechange=null;if(script.parentNode){script.parentNode.removeChild(script);}
script=null;if(!isAbort){callback(200,"success");}}};head.insertBefore(script,head.firstChild);},abort:function(){if(script){script.onload(undefined,true);}}};}});var oldCallbacks=[],rjsonp=/(=)\?(?=&|$)|\?\?/;jQuery.ajaxSetup({jsonp:"callback",jsonpCallback:function(){var callback=oldCallbacks.pop()||(jQuery.expando+"_"+(nonce++));this[callback]=true;return callback;}});jQuery.ajaxPrefilter("json jsonp",function(s,originalSettings,jqXHR){var callbackName,overwritten,responseContainer,jsonProp=s.jsonp!==false&&(rjsonp.test(s.url)?"url":typeof s.data==="string"&&!(s.contentType||"").indexOf("application/x-www-form-urlencoded")&&rjsonp.test(s.data)&&"data");if(jsonProp||s.dataTypes[0]==="jsonp"){callbackName=s.jsonpCallback=jQuery.isFunction(s.jsonpCallback)?s.jsonpCallback():s.jsonpCallback;if(jsonProp){s[jsonProp]=s[jsonProp].replace(rjsonp,"$1"+callbackName);}else if(s.jsonp!==false){s.url+=(rquery.test(s.url)?"&":"?")+s.jsonp+"="+callbackName;}
s.converters["script json"]=function(){if(!responseContainer){jQuery.error(callbackName+" was not called");}
return responseContainer[0];};s.dataTypes[0]="json";overwritten=window[callbackName];window[callbackName]=function(){responseContainer=arguments;};jqXHR.always(function(){window[callbackName]=overwritten;if(s[callbackName]){s.jsonpCallback=originalSettings.jsonpCallback;oldCallbacks.push(callbackName);}
if(responseContainer&&jQuery.isFunction(overwritten)){overwritten(responseContainer[0]);}
responseContainer=overwritten=undefined;});return"script";}});jQuery.parseHTML=function(data,context,keepScripts){if(!data||typeof data!=="string"){return null;}
if(typeof context==="boolean"){keepScripts=context;context=false;}
context=context||document;var parsed=rsingleTag.exec(data),scripts=!keepScripts&&[];if(parsed){return[context.createElement(parsed[1])];}
parsed=jQuery.buildFragment([data],context,scripts);if(scripts&&scripts.length){jQuery(scripts).remove();}
return jQuery.merge([],parsed.childNodes);};var _load=jQuery.fn.load;jQuery.fn.load=function(url,params,callback){if(typeof url!=="string"&&_load){return _load.apply(this,arguments);}
var selector,response,type,self=this,off=url.indexOf(" ");if(off>=0){selector=jQuery.trim(url.slice(off,url.length));url=url.slice(0,off);}
if(jQuery.isFunction(params)){callback=params;params=undefined;}else if(params&&typeof params==="object"){type="POST";}
if(self.length>0){jQuery.ajax({url:url,type:type,dataType:"html",data:params}).done(function(responseText){response=arguments;self.html(selector?jQuery("<div>").append(jQuery.parseHTML(responseText)).find(selector):responseText);}).complete(callback&&function(jqXHR,status){self.each(callback,response||[jqXHR.responseText,status,jqXHR]);});}
return this;};jQuery.each(["ajaxStart","ajaxStop","ajaxComplete","ajaxError","ajaxSuccess","ajaxSend"],function(i,type){jQuery.fn[type]=function(fn){return this.on(type,fn);};});jQuery.expr.filters.animated=function(elem){return jQuery.grep(jQuery.timers,function(fn){return elem===fn.elem;}).length;};var docElem=window.document.documentElement;function getWindow(elem){return jQuery.isWindow(elem)?elem:elem.nodeType===9?elem.defaultView||elem.parentWindow:false;}
jQuery.offset={setOffset:function(elem,options,i){var curPosition,curLeft,curCSSTop,curTop,curOffset,curCSSLeft,calculatePosition,position=jQuery.css(elem,"position"),curElem=jQuery(elem),props={};if(position==="static"){elem.style.position="relative";}
curOffset=curElem.offset();curCSSTop=jQuery.css(elem,"top");curCSSLeft=jQuery.css(elem,"left");calculatePosition=(position==="absolute"||position==="fixed")&&jQuery.inArray("auto",[curCSSTop,curCSSLeft])>-1;if(calculatePosition){curPosition=curElem.position();curTop=curPosition.top;curLeft=curPosition.left;}else{curTop=parseFloat(curCSSTop)||0;curLeft=parseFloat(curCSSLeft)||0;}
if(jQuery.isFunction(options)){options=options.call(elem,i,curOffset);}
if(options.top!=null){props.top=(options.top-curOffset.top)+curTop;}
if(options.left!=null){props.left=(options.left-curOffset.left)+curLeft;}
if("using"in options){options.using.call(elem,props);}else{curElem.css(props);}}};jQuery.fn.extend({offset:function(options){if(arguments.length){return options===undefined?this:this.each(function(i){jQuery.offset.setOffset(this,options,i);});}
var docElem,win,box={top:0,left:0},elem=this[0],doc=elem&&elem.ownerDocument;if(!doc){return;}
docElem=doc.documentElement;if(!jQuery.contains(docElem,elem)){return box;}
if(typeof elem.getBoundingClientRect!==strundefined){box=elem.getBoundingClientRect();}
win=getWindow(doc);return{top:box.top+(win.pageYOffset||docElem.scrollTop)-(docElem.clientTop||0),left:box.left+(win.pageXOffset||docElem.scrollLeft)-(docElem.clientLeft||0)};},position:function(){if(!this[0]){return;}
var offsetParent,offset,parentOffset={top:0,left:0},elem=this[0];if(jQuery.css(elem,"position")==="fixed"){offset=elem.getBoundingClientRect();}else{offsetParent=this.offsetParent();offset=this.offset();if(!jQuery.nodeName(offsetParent[0],"html")){parentOffset=offsetParent.offset();}
parentOffset.top+=jQuery.css(offsetParent[0],"borderTopWidth",true);parentOffset.left+=jQuery.css(offsetParent[0],"borderLeftWidth",true);}
return{top:offset.top-parentOffset.top-jQuery.css(elem,"marginTop",true),left:offset.left-parentOffset.left-jQuery.css(elem,"marginLeft",true)};},offsetParent:function(){return this.map(function(){var offsetParent=this.offsetParent||docElem;while(offsetParent&&(!jQuery.nodeName(offsetParent,"html")&&jQuery.css(offsetParent,"position")==="static")){offsetParent=offsetParent.offsetParent;}
return offsetParent||docElem;});}});jQuery.each({scrollLeft:"pageXOffset",scrollTop:"pageYOffset"},function(method,prop){var top=/Y/.test(prop);jQuery.fn[method]=function(val){return access(this,function(elem,method,val){var win=getWindow(elem);if(val===undefined){return win?(prop in win)?win[prop]:win.document.documentElement[method]:elem[method];}
if(win){win.scrollTo(!top?val:jQuery(win).scrollLeft(),top?val:jQuery(win).scrollTop());}else{elem[method]=val;}},method,val,arguments.length,null);};});jQuery.each(["top","left"],function(i,prop){jQuery.cssHooks[prop]=addGetHookIf(support.pixelPosition,function(elem,computed){if(computed){computed=curCSS(elem,prop);return rnumnonpx.test(computed)?jQuery(elem).position()[prop]+"px":computed;}});});jQuery.each({Height:"height",Width:"width"},function(name,type){jQuery.each({padding:"inner"+name,content:type,"":"outer"+name},function(defaultExtra,funcName){jQuery.fn[funcName]=function(margin,value){var chainable=arguments.length&&(defaultExtra||typeof margin!=="boolean"),extra=defaultExtra||(margin===true||value===true?"margin":"border");return access(this,function(elem,type,value){var doc;if(jQuery.isWindow(elem)){return elem.document.documentElement["client"+name];}
if(elem.nodeType===9){doc=elem.documentElement;return Math.max(elem.body["scroll"+name],doc["scroll"+name],elem.body["offset"+name],doc["offset"+name],doc["client"+name]);}
return value===undefined?jQuery.css(elem,type,extra):jQuery.style(elem,type,value,extra);},type,chainable?margin:undefined,chainable,null);};});});jQuery.fn.size=function(){return this.length;};jQuery.fn.andSelf=jQuery.fn.addBack;if(typeof define==="function"&&define.amd){define("jquery",[],function(){return jQuery;});}
var
_jQuery=window.jQuery,_$=window.$;jQuery.noConflict=function(deep){if(window.$===jQuery){window.$=_$;}
if(deep&&window.jQuery===jQuery){window.jQuery=_jQuery;}
return jQuery;};if(typeof noGlobal===strundefined){window.jQuery=window.$=jQuery;}
return jQuery;}));!function(e){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=e();else if("function"==typeof define&&define.amd)define([],e);else{var f;"undefined"!=typeof window?f=window:"undefined"!=typeof global?f=global:"undefined"!=typeof self&&(f=self),f.JSZip=e()}}(function(){var define,module,exports;return(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(_dereq_,module,exports){'use strict';var _keyStr="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";exports.encode=function(input,utf8){var output="";var chr1,chr2,chr3,enc1,enc2,enc3,enc4;var i=0;while(i<input.length){chr1=input.charCodeAt(i++);chr2=input.charCodeAt(i++);chr3=input.charCodeAt(i++);enc1=chr1>>2;enc2=((chr1&3)<<4)|(chr2>>4);enc3=((chr2&15)<<2)|(chr3>>6);enc4=chr3&63;if(isNaN(chr2)){enc3=enc4=64;}
else if(isNaN(chr3)){enc4=64;}
output=output+_keyStr.charAt(enc1)+_keyStr.charAt(enc2)+_keyStr.charAt(enc3)+_keyStr.charAt(enc4);}
return output;};exports.decode=function(input,utf8){var output="";var chr1,chr2,chr3;var enc1,enc2,enc3,enc4;var i=0;input=input.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(i<input.length){enc1=_keyStr.indexOf(input.charAt(i++));enc2=_keyStr.indexOf(input.charAt(i++));enc3=_keyStr.indexOf(input.charAt(i++));enc4=_keyStr.indexOf(input.charAt(i++));chr1=(enc1<<2)|(enc2>>4);chr2=((enc2&15)<<4)|(enc3>>2);chr3=((enc3&3)<<6)|enc4;output=output+String.fromCharCode(chr1);if(enc3!=64){output=output+String.fromCharCode(chr2);}
if(enc4!=64){output=output+String.fromCharCode(chr3);}}
return output;};},{}],2:[function(_dereq_,module,exports){'use strict';function CompressedObject(){this.compressedSize=0;this.uncompressedSize=0;this.crc32=0;this.compressionMethod=null;this.compressedContent=null;}
CompressedObject.prototype={getContent:function(){return null;},getCompressedContent:function(){return null;}};module.exports=CompressedObject;},{}],3:[function(_dereq_,module,exports){'use strict';exports.STORE={magic:"\x00\x00",compress:function(content,compressionOptions){return content;},uncompress:function(content){return content;},compressInputType:null,uncompressInputType:null};exports.DEFLATE=_dereq_('./flate');},{"./flate":8}],4:[function(_dereq_,module,exports){'use strict';var utils=_dereq_('./utils');var table=[0x00000000,0x77073096,0xEE0E612C,0x990951BA,0x076DC419,0x706AF48F,0xE963A535,0x9E6495A3,0x0EDB8832,0x79DCB8A4,0xE0D5E91E,0x97D2D988,0x09B64C2B,0x7EB17CBD,0xE7B82D07,0x90BF1D91,0x1DB71064,0x6AB020F2,0xF3B97148,0x84BE41DE,0x1ADAD47D,0x6DDDE4EB,0xF4D4B551,0x83D385C7,0x136C9856,0x646BA8C0,0xFD62F97A,0x8A65C9EC,0x14015C4F,0x63066CD9,0xFA0F3D63,0x8D080DF5,0x3B6E20C8,0x4C69105E,0xD56041E4,0xA2677172,0x3C03E4D1,0x4B04D447,0xD20D85FD,0xA50AB56B,0x35B5A8FA,0x42B2986C,0xDBBBC9D6,0xACBCF940,0x32D86CE3,0x45DF5C75,0xDCD60DCF,0xABD13D59,0x26D930AC,0x51DE003A,0xC8D75180,0xBFD06116,0x21B4F4B5,0x56B3C423,0xCFBA9599,0xB8BDA50F,0x2802B89E,0x5F058808,0xC60CD9B2,0xB10BE924,0x2F6F7C87,0x58684C11,0xC1611DAB,0xB6662D3D,0x76DC4190,0x01DB7106,0x98D220BC,0xEFD5102A,0x71B18589,0x06B6B51F,0x9FBFE4A5,0xE8B8D433,0x7807C9A2,0x0F00F934,0x9609A88E,0xE10E9818,0x7F6A0DBB,0x086D3D2D,0x91646C97,0xE6635C01,0x6B6B51F4,0x1C6C6162,0x856530D8,0xF262004E,0x6C0695ED,0x1B01A57B,0x8208F4C1,0xF50FC457,0x65B0D9C6,0x12B7E950,0x8BBEB8EA,0xFCB9887C,0x62DD1DDF,0x15DA2D49,0x8CD37CF3,0xFBD44C65,0x4DB26158,0x3AB551CE,0xA3BC0074,0xD4BB30E2,0x4ADFA541,0x3DD895D7,0xA4D1C46D,0xD3D6F4FB,0x4369E96A,0x346ED9FC,0xAD678846,0xDA60B8D0,0x44042D73,0x33031DE5,0xAA0A4C5F,0xDD0D7CC9,0x5005713C,0x270241AA,0xBE0B1010,0xC90C2086,0x5768B525,0x206F85B3,0xB966D409,0xCE61E49F,0x5EDEF90E,0x29D9C998,0xB0D09822,0xC7D7A8B4,0x59B33D17,0x2EB40D81,0xB7BD5C3B,0xC0BA6CAD,0xEDB88320,0x9ABFB3B6,0x03B6E20C,0x74B1D29A,0xEAD54739,0x9DD277AF,0x04DB2615,0x73DC1683,0xE3630B12,0x94643B84,0x0D6D6A3E,0x7A6A5AA8,0xE40ECF0B,0x9309FF9D,0x0A00AE27,0x7D079EB1,0xF00F9344,0x8708A3D2,0x1E01F268,0x6906C2FE,0xF762575D,0x806567CB,0x196C3671,0x6E6B06E7,0xFED41B76,0x89D32BE0,0x10DA7A5A,0x67DD4ACC,0xF9B9DF6F,0x8EBEEFF9,0x17B7BE43,0x60B08ED5,0xD6D6A3E8,0xA1D1937E,0x38D8C2C4,0x4FDFF252,0xD1BB67F1,0xA6BC5767,0x3FB506DD,0x48B2364B,0xD80D2BDA,0xAF0A1B4C,0x36034AF6,0x41047A60,0xDF60EFC3,0xA867DF55,0x316E8EEF,0x4669BE79,0xCB61B38C,0xBC66831A,0x256FD2A0,0x5268E236,0xCC0C7795,0xBB0B4703,0x220216B9,0x5505262F,0xC5BA3BBE,0xB2BD0B28,0x2BB45A92,0x5CB36A04,0xC2D7FFA7,0xB5D0CF31,0x2CD99E8B,0x5BDEAE1D,0x9B64C2B0,0xEC63F226,0x756AA39C,0x026D930A,0x9C0906A9,0xEB0E363F,0x72076785,0x05005713,0x95BF4A82,0xE2B87A14,0x7BB12BAE,0x0CB61B38,0x92D28E9B,0xE5D5BE0D,0x7CDCEFB7,0x0BDBDF21,0x86D3D2D4,0xF1D4E242,0x68DDB3F8,0x1FDA836E,0x81BE16CD,0xF6B9265B,0x6FB077E1,0x18B74777,0x88085AE6,0xFF0F6A70,0x66063BCA,0x11010B5C,0x8F659EFF,0xF862AE69,0x616BFFD3,0x166CCF45,0xA00AE278,0xD70DD2EE,0x4E048354,0x3903B3C2,0xA7672661,0xD06016F7,0x4969474D,0x3E6E77DB,0xAED16A4A,0xD9D65ADC,0x40DF0B66,0x37D83BF0,0xA9BCAE53,0xDEBB9EC5,0x47B2CF7F,0x30B5FFE9,0xBDBDF21C,0xCABAC28A,0x53B39330,0x24B4A3A6,0xBAD03605,0xCDD70693,0x54DE5729,0x23D967BF,0xB3667A2E,0xC4614AB8,0x5D681B02,0x2A6F2B94,0xB40BBE37,0xC30C8EA1,0x5A05DF1B,0x2D02EF8D];module.exports=function crc32(input,crc){if(typeof input==="undefined"||!input.length){return 0;}
var isArray=utils.getTypeOf(input)!=="string";if(typeof(crc)=="undefined"){crc=0;}
var x=0;var y=0;var b=0;crc=crc^(-1);for(var i=0,iTop=input.length;i<iTop;i++){b=isArray?input[i]:input.charCodeAt(i);y=(crc^b)&0xFF;x=table[y];crc=(crc>>>8)^x;}
return crc^(-1);};},{"./utils":21}],5:[function(_dereq_,module,exports){'use strict';var utils=_dereq_('./utils');function DataReader(data){this.data=null;this.length=0;this.index=0;}
DataReader.prototype={checkOffset:function(offset){this.checkIndex(this.index+offset);},checkIndex:function(newIndex){if(this.length<newIndex||newIndex<0){throw new Error("End of data reached (data length = "+this.length+", asked index = "+(newIndex)+"). Corrupted zip ?");}},setIndex:function(newIndex){this.checkIndex(newIndex);this.index=newIndex;},skip:function(n){this.setIndex(this.index+n);},byteAt:function(i){},readInt:function(size){var result=0,i;this.checkOffset(size);for(i=this.index+size-1;i>=this.index;i--){result=(result<<8)+this.byteAt(i);}
this.index+=size;return result;},readString:function(size){return utils.transformTo("string",this.readData(size));},readData:function(size){},lastIndexOfSignature:function(sig){},readDate:function(){var dostime=this.readInt(4);return new Date(((dostime>>25)&0x7f)+1980,((dostime>>21)&0x0f)-1,(dostime>>16)&0x1f,(dostime>>11)&0x1f,(dostime>>5)&0x3f,(dostime&0x1f)<<1);}};module.exports=DataReader;},{"./utils":21}],6:[function(_dereq_,module,exports){'use strict';exports.base64=false;exports.binary=false;exports.dir=false;exports.createFolders=false;exports.date=null;exports.compression=null;exports.compressionOptions=null;exports.comment=null;exports.unixPermissions=null;exports.dosPermissions=null;},{}],7:[function(_dereq_,module,exports){'use strict';var utils=_dereq_('./utils');exports.string2binary=function(str){return utils.string2binary(str);};exports.string2Uint8Array=function(str){return utils.transformTo("uint8array",str);};exports.uint8Array2String=function(array){return utils.transformTo("string",array);};exports.string2Blob=function(str){var buffer=utils.transformTo("arraybuffer",str);return utils.arrayBuffer2Blob(buffer);};exports.arrayBuffer2Blob=function(buffer){return utils.arrayBuffer2Blob(buffer);};exports.transformTo=function(outputType,input){return utils.transformTo(outputType,input);};exports.getTypeOf=function(input){return utils.getTypeOf(input);};exports.checkSupport=function(type){return utils.checkSupport(type);};exports.MAX_VALUE_16BITS=utils.MAX_VALUE_16BITS;exports.MAX_VALUE_32BITS=utils.MAX_VALUE_32BITS;exports.pretty=function(str){return utils.pretty(str);};exports.findCompression=function(compressionMethod){return utils.findCompression(compressionMethod);};exports.isRegExp=function(object){return utils.isRegExp(object);};},{"./utils":21}],8:[function(_dereq_,module,exports){'use strict';var USE_TYPEDARRAY=(typeof Uint8Array!=='undefined')&&(typeof Uint16Array!=='undefined')&&(typeof Uint32Array!=='undefined');var pako=_dereq_("pako");exports.uncompressInputType=USE_TYPEDARRAY?"uint8array":"array";exports.compressInputType=USE_TYPEDARRAY?"uint8array":"array";exports.magic="\x08\x00";exports.compress=function(input,compressionOptions){return pako.deflateRaw(input,{level:compressionOptions.level||-1});};exports.uncompress=function(input){return pako.inflateRaw(input);};},{"pako":24}],9:[function(_dereq_,module,exports){'use strict';var base64=_dereq_('./base64');function JSZip(data,options){if(!(this instanceof JSZip))return new JSZip(data,options);this.files={};this.comment=null;this.root="";if(data){this.load(data,options);}
this.clone=function(){var newObj=new JSZip();for(var i in this){if(typeof this[i]!=="function"){newObj[i]=this[i];}}
return newObj;};}
JSZip.prototype=_dereq_('./object');JSZip.prototype.load=_dereq_('./load');JSZip.support=_dereq_('./support');JSZip.defaults=_dereq_('./defaults');JSZip.utils=_dereq_('./deprecatedPublicUtils');JSZip.base64={encode:function(input){return base64.encode(input);},decode:function(input){return base64.decode(input);}};JSZip.compressions=_dereq_('./compressions');module.exports=JSZip;},{"./base64":1,"./compressions":3,"./defaults":6,"./deprecatedPublicUtils":7,"./load":10,"./object":13,"./support":17}],10:[function(_dereq_,module,exports){'use strict';var base64=_dereq_('./base64');var ZipEntries=_dereq_('./zipEntries');module.exports=function(data,options){var files,zipEntries,i,input;options=options||{};if(options.base64){data=base64.decode(data);}
zipEntries=new ZipEntries(data,options);files=zipEntries.files;for(i=0;i<files.length;i++){input=files[i];this.file(input.fileName,input.decompressed,{binary:true,optimizedBinaryString:true,date:input.date,dir:input.dir,comment:input.fileComment.length?input.fileComment:null,unixPermissions:input.unixPermissions,dosPermissions:input.dosPermissions,createFolders:options.createFolders});}
if(zipEntries.zipComment.length){this.comment=zipEntries.zipComment;}
return this;};},{"./base64":1,"./zipEntries":22}],11:[function(_dereq_,module,exports){(function(Buffer){'use strict';module.exports=function(data,encoding){return new Buffer(data,encoding);};module.exports.test=function(b){return Buffer.isBuffer(b);};}).call(this,(typeof Buffer!=="undefined"?Buffer:undefined))},{}],12:[function(_dereq_,module,exports){'use strict';var Uint8ArrayReader=_dereq_('./uint8ArrayReader');function NodeBufferReader(data){this.data=data;this.length=this.data.length;this.index=0;}
NodeBufferReader.prototype=new Uint8ArrayReader();NodeBufferReader.prototype.readData=function(size){this.checkOffset(size);var result=this.data.slice(this.index,this.index+size);this.index+=size;return result;};module.exports=NodeBufferReader;},{"./uint8ArrayReader":18}],13:[function(_dereq_,module,exports){'use strict';var support=_dereq_('./support');var utils=_dereq_('./utils');var crc32=_dereq_('./crc32');var signature=_dereq_('./signature');var defaults=_dereq_('./defaults');var base64=_dereq_('./base64');var compressions=_dereq_('./compressions');var CompressedObject=_dereq_('./compressedObject');var nodeBuffer=_dereq_('./nodeBuffer');var utf8=_dereq_('./utf8');var StringWriter=_dereq_('./stringWriter');var Uint8ArrayWriter=_dereq_('./uint8ArrayWriter');var getRawData=function(file){if(file._data instanceof CompressedObject){file._data=file._data.getContent();file.options.binary=true;file.options.base64=false;if(utils.getTypeOf(file._data)==="uint8array"){var copy=file._data;file._data=new Uint8Array(copy.length);if(copy.length!==0){file._data.set(copy,0);}}}
return file._data;};var getBinaryData=function(file){var result=getRawData(file),type=utils.getTypeOf(result);if(type==="string"){if(!file.options.binary){if(support.nodebuffer){return nodeBuffer(result,"utf-8");}}
return file.asBinary();}
return result;};var dataToString=function(asUTF8){var result=getRawData(this);if(result===null||typeof result==="undefined"){return"";}
if(this.options.base64){result=base64.decode(result);}
if(asUTF8&&this.options.binary){result=out.utf8decode(result);}
else{result=utils.transformTo("string",result);}
if(!asUTF8&&!this.options.binary){result=utils.transformTo("string",out.utf8encode(result));}
return result;};var ZipObject=function(name,data,options){this.name=name;this.dir=options.dir;this.date=options.date;this.comment=options.comment;this.unixPermissions=options.unixPermissions;this.dosPermissions=options.dosPermissions;this._data=data;this.options=options;this._initialMetadata={dir:options.dir,date:options.date};};ZipObject.prototype={asText:function(){return dataToString.call(this,true);},asBinary:function(){return dataToString.call(this,false);},asNodeBuffer:function(){var result=getBinaryData(this);return utils.transformTo("nodebuffer",result);},asUint8Array:function(){var result=getBinaryData(this);return utils.transformTo("uint8array",result);},asArrayBuffer:function(){return this.asUint8Array().buffer;}};var decToHex=function(dec,bytes){var hex="",i;for(i=0;i<bytes;i++){hex+=String.fromCharCode(dec&0xff);dec=dec>>>8;}
return hex;};var extend=function(){var result={},i,attr;for(i=0;i<arguments.length;i++){for(attr in arguments[i]){if(arguments[i].hasOwnProperty(attr)&&typeof result[attr]==="undefined"){result[attr]=arguments[i][attr];}}}
return result;};var prepareFileAttrs=function(o){o=o||{};if(o.base64===true&&(o.binary===null||o.binary===undefined)){o.binary=true;}
o=extend(o,defaults);o.date=o.date||new Date();if(o.compression!==null)o.compression=o.compression.toUpperCase();return o;};var fileAdd=function(name,data,o){var dataType=utils.getTypeOf(data),parent;o=prepareFileAttrs(o);if(typeof o.unixPermissions==="string"){o.unixPermissions=parseInt(o.unixPermissions,8);}
if(o.unixPermissions&&(o.unixPermissions&0x4000)){o.dir=true;}
if(o.dosPermissions&&(o.dosPermissions&0x0010)){o.dir=true;}
if(o.dir){name=forceTrailingSlash(name);}
if(o.createFolders&&(parent=parentFolder(name))){folderAdd.call(this,parent,true);}
if(o.dir||data===null||typeof data==="undefined"){o.base64=false;o.binary=false;data=null;dataType=null;}
else if(dataType==="string"){if(o.binary&&!o.base64){if(o.optimizedBinaryString!==true){data=utils.string2binary(data);}}}
else{o.base64=false;o.binary=true;if(!dataType&&!(data instanceof CompressedObject)){throw new Error("The data of '"+name+"' is in an unsupported format !");}
if(dataType==="arraybuffer"){data=utils.transformTo("uint8array",data);}}
var object=new ZipObject(name,data,o);this.files[name]=object;return object;};var parentFolder=function(path){if(path.slice(-1)=='/'){path=path.substring(0,path.length-1);}
var lastSlash=path.lastIndexOf('/');return(lastSlash>0)?path.substring(0,lastSlash):"";};var forceTrailingSlash=function(path){if(path.slice(-1)!="/"){path+="/";}
return path;};var folderAdd=function(name,createFolders){createFolders=(typeof createFolders!=='undefined')?createFolders:false;name=forceTrailingSlash(name);if(!this.files[name]){fileAdd.call(this,name,null,{dir:true,createFolders:createFolders});}
return this.files[name];};var generateCompressedObjectFrom=function(file,compression,compressionOptions){var result=new CompressedObject(),content;if(file._data instanceof CompressedObject){result.uncompressedSize=file._data.uncompressedSize;result.crc32=file._data.crc32;if(result.uncompressedSize===0||file.dir){compression=compressions['STORE'];result.compressedContent="";result.crc32=0;}
else if(file._data.compressionMethod===compression.magic){result.compressedContent=file._data.getCompressedContent();}
else{content=file._data.getContent();result.compressedContent=compression.compress(utils.transformTo(compression.compressInputType,content),compressionOptions);}}
else{content=getBinaryData(file);if(!content||content.length===0||file.dir){compression=compressions['STORE'];content="";}
result.uncompressedSize=content.length;result.crc32=crc32(content);result.compressedContent=compression.compress(utils.transformTo(compression.compressInputType,content),compressionOptions);}
result.compressedSize=result.compressedContent.length;result.compressionMethod=compression.magic;return result;};var generateUnixExternalFileAttr=function(unixPermissions,isDir){var result=unixPermissions;if(!unixPermissions){result=isDir?0x41fd:0x81b4;}
return(result&0xFFFF)<<16;};var generateDosExternalFileAttr=function(dosPermissions,isDir){return(dosPermissions||0)&0x3F;};var generateZipParts=function(name,file,compressedObject,offset,platform){var data=compressedObject.compressedContent,utfEncodedFileName=utils.transformTo("string",utf8.utf8encode(file.name)),comment=file.comment||"",utfEncodedComment=utils.transformTo("string",utf8.utf8encode(comment)),useUTF8ForFileName=utfEncodedFileName.length!==file.name.length,useUTF8ForComment=utfEncodedComment.length!==comment.length,o=file.options,dosTime,dosDate,extraFields="",unicodePathExtraField="",unicodeCommentExtraField="",dir,date;if(file._initialMetadata.dir!==file.dir){dir=file.dir;}else{dir=o.dir;}
if(file._initialMetadata.date!==file.date){date=file.date;}else{date=o.date;}
var extFileAttr=0;var versionMadeBy=0;if(dir){extFileAttr|=0x00010;}
if(platform==="UNIX"){versionMadeBy=0x031E;extFileAttr|=generateUnixExternalFileAttr(file.unixPermissions,dir);}else{versionMadeBy=0x0014;extFileAttr|=generateDosExternalFileAttr(file.dosPermissions,dir);}
dosTime=date.getHours();dosTime=dosTime<<6;dosTime=dosTime|date.getMinutes();dosTime=dosTime<<5;dosTime=dosTime|date.getSeconds()/2;dosDate=date.getFullYear()-1980;dosDate=dosDate<<4;dosDate=dosDate|(date.getMonth()+1);dosDate=dosDate<<5;dosDate=dosDate|date.getDate();if(useUTF8ForFileName){unicodePathExtraField=decToHex(1,1)+decToHex(crc32(utfEncodedFileName),4)+utfEncodedFileName;extraFields+="\x75\x70"+decToHex(unicodePathExtraField.length,2)+unicodePathExtraField;}
if(useUTF8ForComment){unicodeCommentExtraField=decToHex(1,1)+decToHex(this.crc32(utfEncodedComment),4)+utfEncodedComment;extraFields+="\x75\x63"+decToHex(unicodeCommentExtraField.length,2)+unicodeCommentExtraField;}
var header="";header+="\x0A\x00";header+=(useUTF8ForFileName||useUTF8ForComment)?"\x00\x08":"\x00\x00";header+=compressedObject.compressionMethod;header+=decToHex(dosTime,2);header+=decToHex(dosDate,2);header+=decToHex(compressedObject.crc32,4);header+=decToHex(compressedObject.compressedSize,4);header+=decToHex(compressedObject.uncompressedSize,4);header+=decToHex(utfEncodedFileName.length,2);header+=decToHex(extraFields.length,2);var fileRecord=signature.LOCAL_FILE_HEADER+header+utfEncodedFileName+extraFields;var dirRecord=signature.CENTRAL_FILE_HEADER+decToHex(versionMadeBy,2)+header+decToHex(utfEncodedComment.length,2)+"\x00\x00"+"\x00\x00"+decToHex(extFileAttr,4)+decToHex(offset,4)+utfEncodedFileName+extraFields+utfEncodedComment;return{fileRecord:fileRecord,dirRecord:dirRecord,compressedObject:compressedObject};};var out={load:function(stream,options){throw new Error("Load method is not defined. Is the file jszip-load.js included ?");},filter:function(search){var result=[],filename,relativePath,file,fileClone;for(filename in this.files){if(!this.files.hasOwnProperty(filename)){continue;}
file=this.files[filename];fileClone=new ZipObject(file.name,file._data,extend(file.options));relativePath=filename.slice(this.root.length,filename.length);if(filename.slice(0,this.root.length)===this.root&&search(relativePath,fileClone)){result.push(fileClone);}}
return result;},file:function(name,data,o){if(arguments.length===1){if(utils.isRegExp(name)){var regexp=name;return this.filter(function(relativePath,file){return!file.dir&&regexp.test(relativePath);});}
else{return this.filter(function(relativePath,file){return!file.dir&&relativePath===name;})[0]||null;}}
else{name=this.root+name;fileAdd.call(this,name,data,o);}
return this;},folder:function(arg){if(!arg){return this;}
if(utils.isRegExp(arg)){return this.filter(function(relativePath,file){return file.dir&&arg.test(relativePath);});}
var name=this.root+arg;var newFolder=folderAdd.call(this,name);var ret=this.clone();ret.root=newFolder.name;return ret;},remove:function(name){name=this.root+name;var file=this.files[name];if(!file){if(name.slice(-1)!="/"){name+="/";}
file=this.files[name];}
if(file&&!file.dir){delete this.files[name];}else{var kids=this.filter(function(relativePath,file){return file.name.slice(0,name.length)===name;});for(var i=0;i<kids.length;i++){delete this.files[kids[i].name];}}
return this;},generate:function(options){options=extend(options||{},{base64:true,compression:"STORE",compressionOptions:null,type:"base64",platform:"DOS",comment:null,mimeType:'application/zip'});utils.checkSupport(options.type);if(options.platform==='darwin'||options.platform==='freebsd'||options.platform==='linux'||options.platform==='sunos'){options.platform="UNIX";}
if(options.platform==='win32'){options.platform="DOS";}
var zipData=[],localDirLength=0,centralDirLength=0,writer,i,utfEncodedComment=utils.transformTo("string",this.utf8encode(options.comment||this.comment||""));for(var name in this.files){if(!this.files.hasOwnProperty(name)){continue;}
var file=this.files[name];var compressionName=file.options.compression||options.compression.toUpperCase();var compression=compressions[compressionName];if(!compression){throw new Error(compressionName+" is not a valid compression method !");}
var compressionOptions=file.options.compressionOptions||options.compressionOptions||{};var compressedObject=generateCompressedObjectFrom.call(this,file,compression,compressionOptions);var zipPart=generateZipParts.call(this,name,file,compressedObject,localDirLength,options.platform);localDirLength+=zipPart.fileRecord.length+compressedObject.compressedSize;centralDirLength+=zipPart.dirRecord.length;zipData.push(zipPart);}
var dirEnd="";dirEnd=signature.CENTRAL_DIRECTORY_END+"\x00\x00"+"\x00\x00"+decToHex(zipData.length,2)+decToHex(zipData.length,2)+decToHex(centralDirLength,4)+decToHex(localDirLength,4)+decToHex(utfEncodedComment.length,2)+utfEncodedComment;var typeName=options.type.toLowerCase();if(typeName==="uint8array"||typeName==="arraybuffer"||typeName==="blob"||typeName==="nodebuffer"){writer=new Uint8ArrayWriter(localDirLength+centralDirLength+dirEnd.length);}else{writer=new StringWriter(localDirLength+centralDirLength+dirEnd.length);}
for(i=0;i<zipData.length;i++){writer.append(zipData[i].fileRecord);writer.append(zipData[i].compressedObject.compressedContent);}
for(i=0;i<zipData.length;i++){writer.append(zipData[i].dirRecord);}
writer.append(dirEnd);var zip=writer.finalize();switch(options.type.toLowerCase()){case"uint8array":case"arraybuffer":case"nodebuffer":return utils.transformTo(options.type.toLowerCase(),zip);case"blob":return utils.arrayBuffer2Blob(utils.transformTo("arraybuffer",zip),options.mimeType);case"base64":return(options.base64)?base64.encode(zip):zip;default:return zip;}},crc32:function(input,crc){return crc32(input,crc);},utf8encode:function(string){return utils.transformTo("string",utf8.utf8encode(string));},utf8decode:function(input){return utf8.utf8decode(input);}};module.exports=out;},{"./base64":1,"./compressedObject":2,"./compressions":3,"./crc32":4,"./defaults":6,"./nodeBuffer":11,"./signature":14,"./stringWriter":16,"./support":17,"./uint8ArrayWriter":19,"./utf8":20,"./utils":21}],14:[function(_dereq_,module,exports){'use strict';exports.LOCAL_FILE_HEADER="PK\x03\x04";exports.CENTRAL_FILE_HEADER="PK\x01\x02";exports.CENTRAL_DIRECTORY_END="PK\x05\x06";exports.ZIP64_CENTRAL_DIRECTORY_LOCATOR="PK\x06\x07";exports.ZIP64_CENTRAL_DIRECTORY_END="PK\x06\x06";exports.DATA_DESCRIPTOR="PK\x07\x08";},{}],15:[function(_dereq_,module,exports){'use strict';var DataReader=_dereq_('./dataReader');var utils=_dereq_('./utils');function StringReader(data,optimizedBinaryString){this.data=data;if(!optimizedBinaryString){this.data=utils.string2binary(this.data);}
this.length=this.data.length;this.index=0;}
StringReader.prototype=new DataReader();StringReader.prototype.byteAt=function(i){return this.data.charCodeAt(i);};StringReader.prototype.lastIndexOfSignature=function(sig){return this.data.lastIndexOf(sig);};StringReader.prototype.readData=function(size){this.checkOffset(size);var result=this.data.slice(this.index,this.index+size);this.index+=size;return result;};module.exports=StringReader;},{"./dataReader":5,"./utils":21}],16:[function(_dereq_,module,exports){'use strict';var utils=_dereq_('./utils');var StringWriter=function(){this.data=[];};StringWriter.prototype={append:function(input){input=utils.transformTo("string",input);this.data.push(input);},finalize:function(){return this.data.join("");}};module.exports=StringWriter;},{"./utils":21}],17:[function(_dereq_,module,exports){(function(Buffer){'use strict';exports.base64=true;exports.array=true;exports.string=true;exports.arraybuffer=typeof ArrayBuffer!=="undefined"&&typeof Uint8Array!=="undefined";exports.nodebuffer=typeof Buffer!=="undefined";exports.uint8array=typeof Uint8Array!=="undefined";if(typeof ArrayBuffer==="undefined"){exports.blob=false;}
else{var buffer=new ArrayBuffer(0);try{exports.blob=new Blob([buffer],{type:"application/zip"}).size===0;}
catch(e){try{var Builder=window.BlobBuilder||window.WebKitBlobBuilder||window.MozBlobBuilder||window.MSBlobBuilder;var builder=new Builder();builder.append(buffer);exports.blob=builder.getBlob('application/zip').size===0;}
catch(e){exports.blob=false;}}}}).call(this,(typeof Buffer!=="undefined"?Buffer:undefined))},{}],18:[function(_dereq_,module,exports){'use strict';var DataReader=_dereq_('./dataReader');function Uint8ArrayReader(data){if(data){this.data=data;this.length=this.data.length;this.index=0;}}
Uint8ArrayReader.prototype=new DataReader();Uint8ArrayReader.prototype.byteAt=function(i){return this.data[i];};Uint8ArrayReader.prototype.lastIndexOfSignature=function(sig){var sig0=sig.charCodeAt(0),sig1=sig.charCodeAt(1),sig2=sig.charCodeAt(2),sig3=sig.charCodeAt(3);for(var i=this.length-4;i>=0;--i){if(this.data[i]===sig0&&this.data[i+1]===sig1&&this.data[i+2]===sig2&&this.data[i+3]===sig3){return i;}}
return-1;};Uint8ArrayReader.prototype.readData=function(size){this.checkOffset(size);if(size===0){return new Uint8Array(0);}
var result=this.data.subarray(this.index,this.index+size);this.index+=size;return result;};module.exports=Uint8ArrayReader;},{"./dataReader":5}],19:[function(_dereq_,module,exports){'use strict';var utils=_dereq_('./utils');var Uint8ArrayWriter=function(length){this.data=new Uint8Array(length);this.index=0;};Uint8ArrayWriter.prototype={append:function(input){if(input.length!==0){input=utils.transformTo("uint8array",input);this.data.set(input,this.index);this.index+=input.length;}},finalize:function(){return this.data;}};module.exports=Uint8ArrayWriter;},{"./utils":21}],20:[function(_dereq_,module,exports){'use strict';var utils=_dereq_('./utils');var support=_dereq_('./support');var nodeBuffer=_dereq_('./nodeBuffer');var _utf8len=new Array(256);for(var i=0;i<256;i++){_utf8len[i]=(i>=252?6:i>=248?5:i>=240?4:i>=224?3:i>=192?2:1);}
_utf8len[254]=_utf8len[254]=1;var string2buf=function(str){var buf,c,c2,m_pos,i,str_len=str.length,buf_len=0;for(m_pos=0;m_pos<str_len;m_pos++){c=str.charCodeAt(m_pos);if((c&0xfc00)===0xd800&&(m_pos+1<str_len)){c2=str.charCodeAt(m_pos+1);if((c2&0xfc00)===0xdc00){c=0x10000+((c-0xd800)<<10)+(c2-0xdc00);m_pos++;}}
buf_len+=c<0x80?1:c<0x800?2:c<0x10000?3:4;}
if(support.uint8array){buf=new Uint8Array(buf_len);}else{buf=new Array(buf_len);}
for(i=0,m_pos=0;i<buf_len;m_pos++){c=str.charCodeAt(m_pos);if((c&0xfc00)===0xd800&&(m_pos+1<str_len)){c2=str.charCodeAt(m_pos+1);if((c2&0xfc00)===0xdc00){c=0x10000+((c-0xd800)<<10)+(c2-0xdc00);m_pos++;}}
if(c<0x80){buf[i++]=c;}else if(c<0x800){buf[i++]=0xC0|(c>>>6);buf[i++]=0x80|(c&0x3f);}else if(c<0x10000){buf[i++]=0xE0|(c>>>12);buf[i++]=0x80|(c>>>6&0x3f);buf[i++]=0x80|(c&0x3f);}else{buf[i++]=0xf0|(c>>>18);buf[i++]=0x80|(c>>>12&0x3f);buf[i++]=0x80|(c>>>6&0x3f);buf[i++]=0x80|(c&0x3f);}}
return buf;};var utf8border=function(buf,max){var pos;max=max||buf.length;if(max>buf.length){max=buf.length;}
pos=max-1;while(pos>=0&&(buf[pos]&0xC0)===0x80){pos--;}
if(pos<0){return max;}
if(pos===0){return max;}
return(pos+_utf8len[buf[pos]]>max)?pos:max;};var buf2string=function(buf){var str,i,out,c,c_len;var len=buf.length;var utf16buf=new Array(len*2);for(out=0,i=0;i<len;){c=buf[i++];if(c<0x80){utf16buf[out++]=c;continue;}
c_len=_utf8len[c];if(c_len>4){utf16buf[out++]=0xfffd;i+=c_len-1;continue;}
c&=c_len===2?0x1f:c_len===3?0x0f:0x07;while(c_len>1&&i<len){c=(c<<6)|(buf[i++]&0x3f);c_len--;}
if(c_len>1){utf16buf[out++]=0xfffd;continue;}
if(c<0x10000){utf16buf[out++]=c;}else{c-=0x10000;utf16buf[out++]=0xd800|((c>>10)&0x3ff);utf16buf[out++]=0xdc00|(c&0x3ff);}}
if(utf16buf.length!==out){if(utf16buf.subarray){utf16buf=utf16buf.subarray(0,out);}else{utf16buf.length=out;}}
return utils.applyFromCharCode(utf16buf);};exports.utf8encode=function utf8encode(str){if(support.nodebuffer){return nodeBuffer(str,"utf-8");}
return string2buf(str);};exports.utf8decode=function utf8decode(buf){if(support.nodebuffer){return utils.transformTo("nodebuffer",buf).toString("utf-8");}
buf=utils.transformTo(support.uint8array?"uint8array":"array",buf);var result=[],k=0,len=buf.length,chunk=65536;while(k<len){var nextBoundary=utf8border(buf,Math.min(k+chunk,len));if(support.uint8array){result.push(buf2string(buf.subarray(k,nextBoundary)));}else{result.push(buf2string(buf.slice(k,nextBoundary)));}
k=nextBoundary;}
return result.join("");};},{"./nodeBuffer":11,"./support":17,"./utils":21}],21:[function(_dereq_,module,exports){'use strict';var support=_dereq_('./support');var compressions=_dereq_('./compressions');var nodeBuffer=_dereq_('./nodeBuffer');exports.string2binary=function(str){var result="";for(var i=0;i<str.length;i++){result+=String.fromCharCode(str.charCodeAt(i)&0xff);}
return result;};exports.arrayBuffer2Blob=function(buffer,mimeType){exports.checkSupport("blob");mimeType=mimeType||'application/zip';try{return new Blob([buffer],{type:mimeType});}
catch(e){try{var Builder=window.BlobBuilder||window.WebKitBlobBuilder||window.MozBlobBuilder||window.MSBlobBuilder;var builder=new Builder();builder.append(buffer);return builder.getBlob(mimeType);}
catch(e){throw new Error("Bug : can't construct the Blob.");}}};function identity(input){return input;}
function stringToArrayLike(str,array){for(var i=0;i<str.length;++i){array[i]=str.charCodeAt(i)&0xFF;}
return array;}
function arrayLikeToString(array){var chunk=65536;var result=[],len=array.length,type=exports.getTypeOf(array),k=0,canUseApply=true;try{switch(type){case"uint8array":String.fromCharCode.apply(null,new Uint8Array(0));break;case"nodebuffer":String.fromCharCode.apply(null,nodeBuffer(0));break;}}catch(e){canUseApply=false;}
if(!canUseApply){var resultStr="";for(var i=0;i<array.length;i++){resultStr+=String.fromCharCode(array[i]);}
return resultStr;}
while(k<len&&chunk>1){try{if(type==="array"||type==="nodebuffer"){result.push(String.fromCharCode.apply(null,array.slice(k,Math.min(k+chunk,len))));}
else{result.push(String.fromCharCode.apply(null,array.subarray(k,Math.min(k+chunk,len))));}
k+=chunk;}
catch(e){chunk=Math.floor(chunk/2);}}
return result.join("");}
exports.applyFromCharCode=arrayLikeToString;function arrayLikeToArrayLike(arrayFrom,arrayTo){for(var i=0;i<arrayFrom.length;i++){arrayTo[i]=arrayFrom[i];}
return arrayTo;}
var transform={};transform["string"]={"string":identity,"array":function(input){return stringToArrayLike(input,new Array(input.length));},"arraybuffer":function(input){return transform["string"]["uint8array"](input).buffer;},"uint8array":function(input){return stringToArrayLike(input,new Uint8Array(input.length));},"nodebuffer":function(input){return stringToArrayLike(input,nodeBuffer(input.length));}};transform["array"]={"string":arrayLikeToString,"array":identity,"arraybuffer":function(input){return(new Uint8Array(input)).buffer;},"uint8array":function(input){return new Uint8Array(input);},"nodebuffer":function(input){return nodeBuffer(input);}};transform["arraybuffer"]={"string":function(input){return arrayLikeToString(new Uint8Array(input));},"array":function(input){return arrayLikeToArrayLike(new Uint8Array(input),new Array(input.byteLength));},"arraybuffer":identity,"uint8array":function(input){return new Uint8Array(input);},"nodebuffer":function(input){return nodeBuffer(new Uint8Array(input));}};transform["uint8array"]={"string":arrayLikeToString,"array":function(input){return arrayLikeToArrayLike(input,new Array(input.length));},"arraybuffer":function(input){return input.buffer;},"uint8array":identity,"nodebuffer":function(input){return nodeBuffer(input);}};transform["nodebuffer"]={"string":arrayLikeToString,"array":function(input){return arrayLikeToArrayLike(input,new Array(input.length));},"arraybuffer":function(input){return transform["nodebuffer"]["uint8array"](input).buffer;},"uint8array":function(input){return arrayLikeToArrayLike(input,new Uint8Array(input.length));},"nodebuffer":identity};exports.transformTo=function(outputType,input){if(!input){input="";}
if(!outputType){return input;}
exports.checkSupport(outputType);var inputType=exports.getTypeOf(input);var result=transform[inputType][outputType](input);return result;};exports.getTypeOf=function(input){if(typeof input==="string"){return"string";}
if(Object.prototype.toString.call(input)==="[object Array]"){return"array";}
if(support.nodebuffer&&nodeBuffer.test(input)){return"nodebuffer";}
if(support.uint8array&&input instanceof Uint8Array){return"uint8array";}
if(support.arraybuffer&&input instanceof ArrayBuffer){return"arraybuffer";}};exports.checkSupport=function(type){var supported=support[type.toLowerCase()];if(!supported){throw new Error(type+" is not supported by this browser");}};exports.MAX_VALUE_16BITS=65535;exports.MAX_VALUE_32BITS=-1;exports.pretty=function(str){var res='',code,i;for(i=0;i<(str||"").length;i++){code=str.charCodeAt(i);res+='\\x'+(code<16?"0":"")+code.toString(16).toUpperCase();}
return res;};exports.findCompression=function(compressionMethod){for(var method in compressions){if(!compressions.hasOwnProperty(method)){continue;}
if(compressions[method].magic===compressionMethod){return compressions[method];}}
return null;};exports.isRegExp=function(object){return Object.prototype.toString.call(object)==="[object RegExp]";};},{"./compressions":3,"./nodeBuffer":11,"./support":17}],22:[function(_dereq_,module,exports){'use strict';var StringReader=_dereq_('./stringReader');var NodeBufferReader=_dereq_('./nodeBufferReader');var Uint8ArrayReader=_dereq_('./uint8ArrayReader');var utils=_dereq_('./utils');var sig=_dereq_('./signature');var ZipEntry=_dereq_('./zipEntry');var support=_dereq_('./support');var jszipProto=_dereq_('./object');function ZipEntries(data,loadOptions){this.files=[];this.loadOptions=loadOptions;if(data){this.load(data);}}
ZipEntries.prototype={checkSignature:function(expectedSignature){var signature=this.reader.readString(4);if(signature!==expectedSignature){throw new Error("Corrupted zip or bug : unexpected signature "+"("+utils.pretty(signature)+", expected "+utils.pretty(expectedSignature)+")");}},readBlockEndOfCentral:function(){this.diskNumber=this.reader.readInt(2);this.diskWithCentralDirStart=this.reader.readInt(2);this.centralDirRecordsOnThisDisk=this.reader.readInt(2);this.centralDirRecords=this.reader.readInt(2);this.centralDirSize=this.reader.readInt(4);this.centralDirOffset=this.reader.readInt(4);this.zipCommentLength=this.reader.readInt(2);this.zipComment=this.reader.readString(this.zipCommentLength);this.zipComment=jszipProto.utf8decode(this.zipComment);},readBlockZip64EndOfCentral:function(){this.zip64EndOfCentralSize=this.reader.readInt(8);this.versionMadeBy=this.reader.readString(2);this.versionNeeded=this.reader.readInt(2);this.diskNumber=this.reader.readInt(4);this.diskWithCentralDirStart=this.reader.readInt(4);this.centralDirRecordsOnThisDisk=this.reader.readInt(8);this.centralDirRecords=this.reader.readInt(8);this.centralDirSize=this.reader.readInt(8);this.centralDirOffset=this.reader.readInt(8);this.zip64ExtensibleData={};var extraDataSize=this.zip64EndOfCentralSize-44,index=0,extraFieldId,extraFieldLength,extraFieldValue;while(index<extraDataSize){extraFieldId=this.reader.readInt(2);extraFieldLength=this.reader.readInt(4);extraFieldValue=this.reader.readString(extraFieldLength);this.zip64ExtensibleData[extraFieldId]={id:extraFieldId,length:extraFieldLength,value:extraFieldValue};}},readBlockZip64EndOfCentralLocator:function(){this.diskWithZip64CentralDirStart=this.reader.readInt(4);this.relativeOffsetEndOfZip64CentralDir=this.reader.readInt(8);this.disksCount=this.reader.readInt(4);if(this.disksCount>1){throw new Error("Multi-volumes zip are not supported");}},readLocalFiles:function(){var i,file;for(i=0;i<this.files.length;i++){file=this.files[i];this.reader.setIndex(file.localHeaderOffset);this.checkSignature(sig.LOCAL_FILE_HEADER);file.readLocalPart(this.reader);file.handleUTF8();file.processAttributes();}},readCentralDir:function(){var file;this.reader.setIndex(this.centralDirOffset);while(this.reader.readString(4)===sig.CENTRAL_FILE_HEADER){file=new ZipEntry({zip64:this.zip64},this.loadOptions);file.readCentralPart(this.reader);this.files.push(file);}},readEndOfCentral:function(){var offset=this.reader.lastIndexOfSignature(sig.CENTRAL_DIRECTORY_END);if(offset===-1){var isGarbage=true;try{this.reader.setIndex(0);this.checkSignature(sig.LOCAL_FILE_HEADER);isGarbage=false;}catch(e){}
if(isGarbage){throw new Error("Can't find end of central directory : is this a zip file ? "+"If it is, see http://stuk.github.io/jszip/documentation/howto/read_zip.html");}else{throw new Error("Corrupted zip : can't find end of central directory");}}
this.reader.setIndex(offset);this.checkSignature(sig.CENTRAL_DIRECTORY_END);this.readBlockEndOfCentral();if(this.diskNumber===utils.MAX_VALUE_16BITS||this.diskWithCentralDirStart===utils.MAX_VALUE_16BITS||this.centralDirRecordsOnThisDisk===utils.MAX_VALUE_16BITS||this.centralDirRecords===utils.MAX_VALUE_16BITS||this.centralDirSize===utils.MAX_VALUE_32BITS||this.centralDirOffset===utils.MAX_VALUE_32BITS){this.zip64=true;offset=this.reader.lastIndexOfSignature(sig.ZIP64_CENTRAL_DIRECTORY_LOCATOR);if(offset===-1){throw new Error("Corrupted zip : can't find the ZIP64 end of central directory locator");}
this.reader.setIndex(offset);this.checkSignature(sig.ZIP64_CENTRAL_DIRECTORY_LOCATOR);this.readBlockZip64EndOfCentralLocator();this.reader.setIndex(this.relativeOffsetEndOfZip64CentralDir);this.checkSignature(sig.ZIP64_CENTRAL_DIRECTORY_END);this.readBlockZip64EndOfCentral();}},prepareReader:function(data){var type=utils.getTypeOf(data);if(type==="string"&&!support.uint8array){this.reader=new StringReader(data,this.loadOptions.optimizedBinaryString);}
else if(type==="nodebuffer"){this.reader=new NodeBufferReader(data);}
else{this.reader=new Uint8ArrayReader(utils.transformTo("uint8array",data));}},load:function(data){this.prepareReader(data);this.readEndOfCentral();this.readCentralDir();this.readLocalFiles();}};module.exports=ZipEntries;},{"./nodeBufferReader":12,"./object":13,"./signature":14,"./stringReader":15,"./support":17,"./uint8ArrayReader":18,"./utils":21,"./zipEntry":23}],23:[function(_dereq_,module,exports){'use strict';var StringReader=_dereq_('./stringReader');var utils=_dereq_('./utils');var CompressedObject=_dereq_('./compressedObject');var jszipProto=_dereq_('./object');var MADE_BY_DOS=0x00;var MADE_BY_UNIX=0x03;function ZipEntry(options,loadOptions){this.options=options;this.loadOptions=loadOptions;}
ZipEntry.prototype={isEncrypted:function(){return(this.bitFlag&0x0001)===0x0001;},useUTF8:function(){return(this.bitFlag&0x0800)===0x0800;},prepareCompressedContent:function(reader,from,length){return function(){var previousIndex=reader.index;reader.setIndex(from);var compressedFileData=reader.readData(length);reader.setIndex(previousIndex);return compressedFileData;};},prepareContent:function(reader,from,length,compression,uncompressedSize){return function(){var compressedFileData=utils.transformTo(compression.uncompressInputType,this.getCompressedContent());var uncompressedFileData=compression.uncompress(compressedFileData);if(uncompressedFileData.length!==uncompressedSize){throw new Error("Bug : uncompressed data size mismatch");}
return uncompressedFileData;};},readLocalPart:function(reader){var compression,localExtraFieldsLength;reader.skip(22);this.fileNameLength=reader.readInt(2);localExtraFieldsLength=reader.readInt(2);this.fileName=reader.readString(this.fileNameLength);reader.skip(localExtraFieldsLength);if(this.compressedSize==-1||this.uncompressedSize==-1){throw new Error("Bug or corrupted zip : didn't get enough informations from the central directory "+"(compressedSize == -1 || uncompressedSize == -1)");}
compression=utils.findCompression(this.compressionMethod);if(compression===null){throw new Error("Corrupted zip : compression "+utils.pretty(this.compressionMethod)+" unknown (inner file : "+this.fileName+")");}
this.decompressed=new CompressedObject();this.decompressed.compressedSize=this.compressedSize;this.decompressed.uncompressedSize=this.uncompressedSize;this.decompressed.crc32=this.crc32;this.decompressed.compressionMethod=this.compressionMethod;this.decompressed.getCompressedContent=this.prepareCompressedContent(reader,reader.index,this.compressedSize,compression);this.decompressed.getContent=this.prepareContent(reader,reader.index,this.compressedSize,compression,this.uncompressedSize);if(this.loadOptions.checkCRC32){this.decompressed=utils.transformTo("string",this.decompressed.getContent());if(jszipProto.crc32(this.decompressed)!==this.crc32){throw new Error("Corrupted zip : CRC32 mismatch");}}},readCentralPart:function(reader){this.versionMadeBy=reader.readInt(2);this.versionNeeded=reader.readInt(2);this.bitFlag=reader.readInt(2);this.compressionMethod=reader.readString(2);this.date=reader.readDate();this.crc32=reader.readInt(4);this.compressedSize=reader.readInt(4);this.uncompressedSize=reader.readInt(4);this.fileNameLength=reader.readInt(2);this.extraFieldsLength=reader.readInt(2);this.fileCommentLength=reader.readInt(2);this.diskNumberStart=reader.readInt(2);this.internalFileAttributes=reader.readInt(2);this.externalFileAttributes=reader.readInt(4);this.localHeaderOffset=reader.readInt(4);if(this.isEncrypted()){throw new Error("Encrypted zip are not supported");}
this.fileName=reader.readString(this.fileNameLength);this.readExtraFields(reader);this.parseZIP64ExtraField(reader);this.fileComment=reader.readString(this.fileCommentLength);},processAttributes:function(){this.unixPermissions=null;this.dosPermissions=null;var madeBy=this.versionMadeBy>>8;this.dir=this.externalFileAttributes&0x0010?true:false;if(madeBy===MADE_BY_DOS){this.dosPermissions=this.externalFileAttributes&0x3F;}
if(madeBy===MADE_BY_UNIX){this.unixPermissions=(this.externalFileAttributes>>16)&0xFFFF;}
if(!this.dir&&this.fileName.slice(-1)==='/'){this.dir=true;}},parseZIP64ExtraField:function(reader){if(!this.extraFields[0x0001]){return;}
var extraReader=new StringReader(this.extraFields[0x0001].value);if(this.uncompressedSize===utils.MAX_VALUE_32BITS){this.uncompressedSize=extraReader.readInt(8);}
if(this.compressedSize===utils.MAX_VALUE_32BITS){this.compressedSize=extraReader.readInt(8);}
if(this.localHeaderOffset===utils.MAX_VALUE_32BITS){this.localHeaderOffset=extraReader.readInt(8);}
if(this.diskNumberStart===utils.MAX_VALUE_32BITS){this.diskNumberStart=extraReader.readInt(4);}},readExtraFields:function(reader){var start=reader.index,extraFieldId,extraFieldLength,extraFieldValue;this.extraFields=this.extraFields||{};while(reader.index<start+this.extraFieldsLength){extraFieldId=reader.readInt(2);extraFieldLength=reader.readInt(2);extraFieldValue=reader.readString(extraFieldLength);this.extraFields[extraFieldId]={id:extraFieldId,length:extraFieldLength,value:extraFieldValue};}},handleUTF8:function(){if(this.useUTF8()){this.fileName=jszipProto.utf8decode(this.fileName);this.fileComment=jszipProto.utf8decode(this.fileComment);}else{var upath=this.findExtraFieldUnicodePath();if(upath!==null){this.fileName=upath;}
var ucomment=this.findExtraFieldUnicodeComment();if(ucomment!==null){this.fileComment=ucomment;}}},findExtraFieldUnicodePath:function(){var upathField=this.extraFields[0x7075];if(upathField){var extraReader=new StringReader(upathField.value);if(extraReader.readInt(1)!==1){return null;}
if(jszipProto.crc32(this.fileName)!==extraReader.readInt(4)){return null;}
return jszipProto.utf8decode(extraReader.readString(upathField.length-5));}
return null;},findExtraFieldUnicodeComment:function(){var ucommentField=this.extraFields[0x6375];if(ucommentField){var extraReader=new StringReader(ucommentField.value);if(extraReader.readInt(1)!==1){return null;}
if(jszipProto.crc32(this.fileComment)!==extraReader.readInt(4)){return null;}
return jszipProto.utf8decode(extraReader.readString(ucommentField.length-5));}
return null;}};module.exports=ZipEntry;},{"./compressedObject":2,"./object":13,"./stringReader":15,"./utils":21}],24:[function(_dereq_,module,exports){'use strict';var assign=_dereq_('./lib/utils/common').assign;var deflate=_dereq_('./lib/deflate');var inflate=_dereq_('./lib/inflate');var constants=_dereq_('./lib/zlib/constants');var pako={};assign(pako,deflate,inflate,constants);module.exports=pako;},{"./lib/deflate":25,"./lib/inflate":26,"./lib/utils/common":27,"./lib/zlib/constants":30}],25:[function(_dereq_,module,exports){'use strict';var zlib_deflate=_dereq_('./zlib/deflate.js');var utils=_dereq_('./utils/common');var strings=_dereq_('./utils/strings');var msg=_dereq_('./zlib/messages');var zstream=_dereq_('./zlib/zstream');var Z_NO_FLUSH=0;var Z_FINISH=4;var Z_OK=0;var Z_STREAM_END=1;var Z_DEFAULT_COMPRESSION=-1;var Z_DEFAULT_STRATEGY=0;var Z_DEFLATED=8;var Deflate=function(options){this.options=utils.assign({level:Z_DEFAULT_COMPRESSION,method:Z_DEFLATED,chunkSize:16384,windowBits:15,memLevel:8,strategy:Z_DEFAULT_STRATEGY,to:''},options||{});var opt=this.options;if(opt.raw&&(opt.windowBits>0)){opt.windowBits=-opt.windowBits;}
else if(opt.gzip&&(opt.windowBits>0)&&(opt.windowBits<16)){opt.windowBits+=16;}
this.err=0;this.msg='';this.ended=false;this.chunks=[];this.strm=new zstream();this.strm.avail_out=0;var status=zlib_deflate.deflateInit2(this.strm,opt.level,opt.method,opt.windowBits,opt.memLevel,opt.strategy);if(status!==Z_OK){throw new Error(msg[status]);}
if(opt.header){zlib_deflate.deflateSetHeader(this.strm,opt.header);}};Deflate.prototype.push=function(data,mode){var strm=this.strm;var chunkSize=this.options.chunkSize;var status,_mode;if(this.ended){return false;}
_mode=(mode===~~mode)?mode:((mode===true)?Z_FINISH:Z_NO_FLUSH);if(typeof data==='string'){strm.input=strings.string2buf(data);}else{strm.input=data;}
strm.next_in=0;strm.avail_in=strm.input.length;do{if(strm.avail_out===0){strm.output=new utils.Buf8(chunkSize);strm.next_out=0;strm.avail_out=chunkSize;}
status=zlib_deflate.deflate(strm,_mode);if(status!==Z_STREAM_END&&status!==Z_OK){this.onEnd(status);this.ended=true;return false;}
if(strm.avail_out===0||(strm.avail_in===0&&_mode===Z_FINISH)){if(this.options.to==='string'){this.onData(strings.buf2binstring(utils.shrinkBuf(strm.output,strm.next_out)));}else{this.onData(utils.shrinkBuf(strm.output,strm.next_out));}}}while((strm.avail_in>0||strm.avail_out===0)&&status!==Z_STREAM_END);if(_mode===Z_FINISH){status=zlib_deflate.deflateEnd(this.strm);this.onEnd(status);this.ended=true;return status===Z_OK;}
return true;};Deflate.prototype.onData=function(chunk){this.chunks.push(chunk);};Deflate.prototype.onEnd=function(status){if(status===Z_OK){if(this.options.to==='string'){this.result=this.chunks.join('');}else{this.result=utils.flattenChunks(this.chunks);}}
this.chunks=[];this.err=status;this.msg=this.strm.msg;};function deflate(input,options){var deflator=new Deflate(options);deflator.push(input,true);if(deflator.err){throw deflator.msg;}
return deflator.result;}
function deflateRaw(input,options){options=options||{};options.raw=true;return deflate(input,options);}
function gzip(input,options){options=options||{};options.gzip=true;return deflate(input,options);}
exports.Deflate=Deflate;exports.deflate=deflate;exports.deflateRaw=deflateRaw;exports.gzip=gzip;},{"./utils/common":27,"./utils/strings":28,"./zlib/deflate.js":32,"./zlib/messages":37,"./zlib/zstream":39}],26:[function(_dereq_,module,exports){'use strict';var zlib_inflate=_dereq_('./zlib/inflate.js');var utils=_dereq_('./utils/common');var strings=_dereq_('./utils/strings');var c=_dereq_('./zlib/constants');var msg=_dereq_('./zlib/messages');var zstream=_dereq_('./zlib/zstream');var gzheader=_dereq_('./zlib/gzheader');var Inflate=function(options){this.options=utils.assign({chunkSize:16384,windowBits:0,to:''},options||{});var opt=this.options;if(opt.raw&&(opt.windowBits>=0)&&(opt.windowBits<16)){opt.windowBits=-opt.windowBits;if(opt.windowBits===0){opt.windowBits=-15;}}
if((opt.windowBits>=0)&&(opt.windowBits<16)&&!(options&&options.windowBits)){opt.windowBits+=32;}
if((opt.windowBits>15)&&(opt.windowBits<48)){if((opt.windowBits&15)===0){opt.windowBits|=15;}}
this.err=0;this.msg='';this.ended=false;this.chunks=[];this.strm=new zstream();this.strm.avail_out=0;var status=zlib_inflate.inflateInit2(this.strm,opt.windowBits);if(status!==c.Z_OK){throw new Error(msg[status]);}
this.header=new gzheader();zlib_inflate.inflateGetHeader(this.strm,this.header);};Inflate.prototype.push=function(data,mode){var strm=this.strm;var chunkSize=this.options.chunkSize;var status,_mode;var next_out_utf8,tail,utf8str;if(this.ended){return false;}
_mode=(mode===~~mode)?mode:((mode===true)?c.Z_FINISH:c.Z_NO_FLUSH);if(typeof data==='string'){strm.input=strings.binstring2buf(data);}else{strm.input=data;}
strm.next_in=0;strm.avail_in=strm.input.length;do{if(strm.avail_out===0){strm.output=new utils.Buf8(chunkSize);strm.next_out=0;strm.avail_out=chunkSize;}
status=zlib_inflate.inflate(strm,c.Z_NO_FLUSH);if(status!==c.Z_STREAM_END&&status!==c.Z_OK){this.onEnd(status);this.ended=true;return false;}
if(strm.next_out){if(strm.avail_out===0||status===c.Z_STREAM_END||(strm.avail_in===0&&_mode===c.Z_FINISH)){if(this.options.to==='string'){next_out_utf8=strings.utf8border(strm.output,strm.next_out);tail=strm.next_out-next_out_utf8;utf8str=strings.buf2string(strm.output,next_out_utf8);strm.next_out=tail;strm.avail_out=chunkSize-tail;if(tail){utils.arraySet(strm.output,strm.output,next_out_utf8,tail,0);}
this.onData(utf8str);}else{this.onData(utils.shrinkBuf(strm.output,strm.next_out));}}}}while((strm.avail_in>0)&&status!==c.Z_STREAM_END);if(status===c.Z_STREAM_END){_mode=c.Z_FINISH;}
if(_mode===c.Z_FINISH){status=zlib_inflate.inflateEnd(this.strm);this.onEnd(status);this.ended=true;return status===c.Z_OK;}
return true;};Inflate.prototype.onData=function(chunk){this.chunks.push(chunk);};Inflate.prototype.onEnd=function(status){if(status===c.Z_OK){if(this.options.to==='string'){this.result=this.chunks.join('');}else{this.result=utils.flattenChunks(this.chunks);}}
this.chunks=[];this.err=status;this.msg=this.strm.msg;};function inflate(input,options){var inflator=new Inflate(options);inflator.push(input,true);if(inflator.err){throw inflator.msg;}
return inflator.result;}
function inflateRaw(input,options){options=options||{};options.raw=true;return inflate(input,options);}
exports.Inflate=Inflate;exports.inflate=inflate;exports.inflateRaw=inflateRaw;exports.ungzip=inflate;},{"./utils/common":27,"./utils/strings":28,"./zlib/constants":30,"./zlib/gzheader":33,"./zlib/inflate.js":35,"./zlib/messages":37,"./zlib/zstream":39}],27:[function(_dereq_,module,exports){'use strict';var TYPED_OK=(typeof Uint8Array!=='undefined')&&(typeof Uint16Array!=='undefined')&&(typeof Int32Array!=='undefined');exports.assign=function(obj){var sources=Array.prototype.slice.call(arguments,1);while(sources.length){var source=sources.shift();if(!source){continue;}
if(typeof(source)!=='object'){throw new TypeError(source+'must be non-object');}
for(var p in source){if(source.hasOwnProperty(p)){obj[p]=source[p];}}}
return obj;};exports.shrinkBuf=function(buf,size){if(buf.length===size){return buf;}
if(buf.subarray){return buf.subarray(0,size);}
buf.length=size;return buf;};var fnTyped={arraySet:function(dest,src,src_offs,len,dest_offs){if(src.subarray&&dest.subarray){dest.set(src.subarray(src_offs,src_offs+len),dest_offs);return;}
for(var i=0;i<len;i++){dest[dest_offs+i]=src[src_offs+i];}},flattenChunks:function(chunks){var i,l,len,pos,chunk,result;len=0;for(i=0,l=chunks.length;i<l;i++){len+=chunks[i].length;}
result=new Uint8Array(len);pos=0;for(i=0,l=chunks.length;i<l;i++){chunk=chunks[i];result.set(chunk,pos);pos+=chunk.length;}
return result;}};var fnUntyped={arraySet:function(dest,src,src_offs,len,dest_offs){for(var i=0;i<len;i++){dest[dest_offs+i]=src[src_offs+i];}},flattenChunks:function(chunks){return[].concat.apply([],chunks);}};exports.setTyped=function(on){if(on){exports.Buf8=Uint8Array;exports.Buf16=Uint16Array;exports.Buf32=Int32Array;exports.assign(exports,fnTyped);}else{exports.Buf8=Array;exports.Buf16=Array;exports.Buf32=Array;exports.assign(exports,fnUntyped);}};exports.setTyped(TYPED_OK);},{}],28:[function(_dereq_,module,exports){'use strict';var utils=_dereq_('./common');var STR_APPLY_OK=true;var STR_APPLY_UIA_OK=true;try{String.fromCharCode.apply(null,[0]);}catch(__){STR_APPLY_OK=false;}
try{String.fromCharCode.apply(null,new Uint8Array(1));}catch(__){STR_APPLY_UIA_OK=false;}
var _utf8len=new utils.Buf8(256);for(var i=0;i<256;i++){_utf8len[i]=(i>=252?6:i>=248?5:i>=240?4:i>=224?3:i>=192?2:1);}
_utf8len[254]=_utf8len[254]=1;exports.string2buf=function(str){var buf,c,c2,m_pos,i,str_len=str.length,buf_len=0;for(m_pos=0;m_pos<str_len;m_pos++){c=str.charCodeAt(m_pos);if((c&0xfc00)===0xd800&&(m_pos+1<str_len)){c2=str.charCodeAt(m_pos+1);if((c2&0xfc00)===0xdc00){c=0x10000+((c-0xd800)<<10)+(c2-0xdc00);m_pos++;}}
buf_len+=c<0x80?1:c<0x800?2:c<0x10000?3:4;}
buf=new utils.Buf8(buf_len);for(i=0,m_pos=0;i<buf_len;m_pos++){c=str.charCodeAt(m_pos);if((c&0xfc00)===0xd800&&(m_pos+1<str_len)){c2=str.charCodeAt(m_pos+1);if((c2&0xfc00)===0xdc00){c=0x10000+((c-0xd800)<<10)+(c2-0xdc00);m_pos++;}}
if(c<0x80){buf[i++]=c;}else if(c<0x800){buf[i++]=0xC0|(c>>>6);buf[i++]=0x80|(c&0x3f);}else if(c<0x10000){buf[i++]=0xE0|(c>>>12);buf[i++]=0x80|(c>>>6&0x3f);buf[i++]=0x80|(c&0x3f);}else{buf[i++]=0xf0|(c>>>18);buf[i++]=0x80|(c>>>12&0x3f);buf[i++]=0x80|(c>>>6&0x3f);buf[i++]=0x80|(c&0x3f);}}
return buf;};function buf2binstring(buf,len){if(len<65537){if((buf.subarray&&STR_APPLY_UIA_OK)||(!buf.subarray&&STR_APPLY_OK)){return String.fromCharCode.apply(null,utils.shrinkBuf(buf,len));}}
var result='';for(var i=0;i<len;i++){result+=String.fromCharCode(buf[i]);}
return result;}
exports.buf2binstring=function(buf){return buf2binstring(buf,buf.length);};exports.binstring2buf=function(str){var buf=new utils.Buf8(str.length);for(var i=0,len=buf.length;i<len;i++){buf[i]=str.charCodeAt(i);}
return buf;};exports.buf2string=function(buf,max){var i,out,c,c_len;var len=max||buf.length;var utf16buf=new Array(len*2);for(out=0,i=0;i<len;){c=buf[i++];if(c<0x80){utf16buf[out++]=c;continue;}
c_len=_utf8len[c];if(c_len>4){utf16buf[out++]=0xfffd;i+=c_len-1;continue;}
c&=c_len===2?0x1f:c_len===3?0x0f:0x07;while(c_len>1&&i<len){c=(c<<6)|(buf[i++]&0x3f);c_len--;}
if(c_len>1){utf16buf[out++]=0xfffd;continue;}
if(c<0x10000){utf16buf[out++]=c;}else{c-=0x10000;utf16buf[out++]=0xd800|((c>>10)&0x3ff);utf16buf[out++]=0xdc00|(c&0x3ff);}}
return buf2binstring(utf16buf,out);};exports.utf8border=function(buf,max){var pos;max=max||buf.length;if(max>buf.length){max=buf.length;}
pos=max-1;while(pos>=0&&(buf[pos]&0xC0)===0x80){pos--;}
if(pos<0){return max;}
if(pos===0){return max;}
return(pos+_utf8len[buf[pos]]>max)?pos:max;};},{"./common":27}],29:[function(_dereq_,module,exports){'use strict';function adler32(adler,buf,len,pos){var s1=(adler&0xffff)|0,s2=((adler>>>16)&0xffff)|0,n=0;while(len!==0){n=len>2000?2000:len;len-=n;do{s1=(s1+buf[pos++])|0;s2=(s2+s1)|0;}while(--n);s1%=65521;s2%=65521;}
return(s1|(s2<<16))|0;}
module.exports=adler32;},{}],30:[function(_dereq_,module,exports){module.exports={Z_NO_FLUSH:0,Z_PARTIAL_FLUSH:1,Z_SYNC_FLUSH:2,Z_FULL_FLUSH:3,Z_FINISH:4,Z_BLOCK:5,Z_TREES:6,Z_OK:0,Z_STREAM_END:1,Z_NEED_DICT:2,Z_ERRNO:-1,Z_STREAM_ERROR:-2,Z_DATA_ERROR:-3,Z_BUF_ERROR:-5,Z_NO_COMPRESSION:0,Z_BEST_SPEED:1,Z_BEST_COMPRESSION:9,Z_DEFAULT_COMPRESSION:-1,Z_FILTERED:1,Z_HUFFMAN_ONLY:2,Z_RLE:3,Z_FIXED:4,Z_DEFAULT_STRATEGY:0,Z_BINARY:0,Z_TEXT:1,Z_UNKNOWN:2,Z_DEFLATED:8};},{}],31:[function(_dereq_,module,exports){'use strict';function makeTable(){var c,table=[];for(var n=0;n<256;n++){c=n;for(var k=0;k<8;k++){c=((c&1)?(0xEDB88320^(c>>>1)):(c>>>1));}
table[n]=c;}
return table;}
var crcTable=makeTable();function crc32(crc,buf,len,pos){var t=crcTable,end=pos+len;crc=crc^(-1);for(var i=pos;i<end;i++){crc=(crc>>>8)^t[(crc^buf[i])&0xFF];}
return(crc^(-1));}
module.exports=crc32;},{}],32:[function(_dereq_,module,exports){'use strict';var utils=_dereq_('../utils/common');var trees=_dereq_('./trees');var adler32=_dereq_('./adler32');var crc32=_dereq_('./crc32');var msg=_dereq_('./messages');var Z_NO_FLUSH=0;var Z_PARTIAL_FLUSH=1;var Z_FULL_FLUSH=3;var Z_FINISH=4;var Z_BLOCK=5;var Z_OK=0;var Z_STREAM_END=1;var Z_STREAM_ERROR=-2;var Z_DATA_ERROR=-3;var Z_BUF_ERROR=-5;var Z_DEFAULT_COMPRESSION=-1;var Z_FILTERED=1;var Z_HUFFMAN_ONLY=2;var Z_RLE=3;var Z_FIXED=4;var Z_DEFAULT_STRATEGY=0;var Z_UNKNOWN=2;var Z_DEFLATED=8;var MAX_MEM_LEVEL=9;var MAX_WBITS=15;var DEF_MEM_LEVEL=8;var LENGTH_CODES=29;var LITERALS=256;var L_CODES=LITERALS+1+LENGTH_CODES;var D_CODES=30;var BL_CODES=19;var HEAP_SIZE=2*L_CODES+1;var MAX_BITS=15;var MIN_MATCH=3;var MAX_MATCH=258;var MIN_LOOKAHEAD=(MAX_MATCH+MIN_MATCH+1);var PRESET_DICT=0x20;var INIT_STATE=42;var EXTRA_STATE=69;var NAME_STATE=73;var COMMENT_STATE=91;var HCRC_STATE=103;var BUSY_STATE=113;var FINISH_STATE=666;var BS_NEED_MORE=1;var BS_BLOCK_DONE=2;var BS_FINISH_STARTED=3;var BS_FINISH_DONE=4;var OS_CODE=0x03;function err(strm,errorCode){strm.msg=msg[errorCode];return errorCode;}
function rank(f){return((f)<<1)-((f)>4?9:0);}
function zero(buf){var len=buf.length;while(--len>=0){buf[len]=0;}}
function flush_pending(strm){var s=strm.state;var len=s.pending;if(len>strm.avail_out){len=strm.avail_out;}
if(len===0){return;}
utils.arraySet(strm.output,s.pending_buf,s.pending_out,len,strm.next_out);strm.next_out+=len;s.pending_out+=len;strm.total_out+=len;strm.avail_out-=len;s.pending-=len;if(s.pending===0){s.pending_out=0;}}
function flush_block_only(s,last){trees._tr_flush_block(s,(s.block_start>=0?s.block_start:-1),s.strstart-s.block_start,last);s.block_start=s.strstart;flush_pending(s.strm);}
function put_byte(s,b){s.pending_buf[s.pending++]=b;}
function putShortMSB(s,b){s.pending_buf[s.pending++]=(b>>>8)&0xff;s.pending_buf[s.pending++]=b&0xff;}
function read_buf(strm,buf,start,size){var len=strm.avail_in;if(len>size){len=size;}
if(len===0){return 0;}
strm.avail_in-=len;utils.arraySet(buf,strm.input,strm.next_in,len,start);if(strm.state.wrap===1){strm.adler=adler32(strm.adler,buf,len,start);}
else if(strm.state.wrap===2){strm.adler=crc32(strm.adler,buf,len,start);}
strm.next_in+=len;strm.total_in+=len;return len;}
function longest_match(s,cur_match){var chain_length=s.max_chain_length;var scan=s.strstart;var match;var len;var best_len=s.prev_length;var nice_match=s.nice_match;var limit=(s.strstart>(s.w_size-MIN_LOOKAHEAD))?s.strstart-(s.w_size-MIN_LOOKAHEAD):0;var _win=s.window;var wmask=s.w_mask;var prev=s.prev;var strend=s.strstart+MAX_MATCH;var scan_end1=_win[scan+best_len-1];var scan_end=_win[scan+best_len];if(s.prev_length>=s.good_match){chain_length>>=2;}
if(nice_match>s.lookahead){nice_match=s.lookahead;}
do{match=cur_match;if(_win[match+best_len]!==scan_end||_win[match+best_len-1]!==scan_end1||_win[match]!==_win[scan]||_win[++match]!==_win[scan+1]){continue;}
scan+=2;match++;do{}while(_win[++scan]===_win[++match]&&_win[++scan]===_win[++match]&&_win[++scan]===_win[++match]&&_win[++scan]===_win[++match]&&_win[++scan]===_win[++match]&&_win[++scan]===_win[++match]&&_win[++scan]===_win[++match]&&_win[++scan]===_win[++match]&&scan<strend);len=MAX_MATCH-(strend-scan);scan=strend-MAX_MATCH;if(len>best_len){s.match_start=cur_match;best_len=len;if(len>=nice_match){break;}
scan_end1=_win[scan+best_len-1];scan_end=_win[scan+best_len];}}while((cur_match=prev[cur_match&wmask])>limit&&--chain_length!==0);if(best_len<=s.lookahead){return best_len;}
return s.lookahead;}
function fill_window(s){var _w_size=s.w_size;var p,n,m,more,str;do{more=s.window_size-s.lookahead-s.strstart;if(s.strstart>=_w_size+(_w_size-MIN_LOOKAHEAD)){utils.arraySet(s.window,s.window,_w_size,_w_size,0);s.match_start-=_w_size;s.strstart-=_w_size;s.block_start-=_w_size;n=s.hash_size;p=n;do{m=s.head[--p];s.head[p]=(m>=_w_size?m-_w_size:0);}while(--n);n=_w_size;p=n;do{m=s.prev[--p];s.prev[p]=(m>=_w_size?m-_w_size:0);}while(--n);more+=_w_size;}
if(s.strm.avail_in===0){break;}
n=read_buf(s.strm,s.window,s.strstart+s.lookahead,more);s.lookahead+=n;if(s.lookahead+s.insert>=MIN_MATCH){str=s.strstart-s.insert;s.ins_h=s.window[str];s.ins_h=((s.ins_h<<s.hash_shift)^s.window[str+1])&s.hash_mask;while(s.insert){s.ins_h=((s.ins_h<<s.hash_shift)^s.window[str+MIN_MATCH-1])&s.hash_mask;s.prev[str&s.w_mask]=s.head[s.ins_h];s.head[s.ins_h]=str;str++;s.insert--;if(s.lookahead+s.insert<MIN_MATCH){break;}}}}while(s.lookahead<MIN_LOOKAHEAD&&s.strm.avail_in!==0);}
function deflate_stored(s,flush){var max_block_size=0xffff;if(max_block_size>s.pending_buf_size-5){max_block_size=s.pending_buf_size-5;}
for(;;){if(s.lookahead<=1){fill_window(s);if(s.lookahead===0&&flush===Z_NO_FLUSH){return BS_NEED_MORE;}
if(s.lookahead===0){break;}}
s.strstart+=s.lookahead;s.lookahead=0;var max_start=s.block_start+max_block_size;if(s.strstart===0||s.strstart>=max_start){s.lookahead=s.strstart-max_start;s.strstart=max_start;flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}
if(s.strstart-s.block_start>=(s.w_size-MIN_LOOKAHEAD)){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}}
s.insert=0;if(flush===Z_FINISH){flush_block_only(s,true);if(s.strm.avail_out===0){return BS_FINISH_STARTED;}
return BS_FINISH_DONE;}
if(s.strstart>s.block_start){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}
return BS_NEED_MORE;}
function deflate_fast(s,flush){var hash_head;var bflush;for(;;){if(s.lookahead<MIN_LOOKAHEAD){fill_window(s);if(s.lookahead<MIN_LOOKAHEAD&&flush===Z_NO_FLUSH){return BS_NEED_MORE;}
if(s.lookahead===0){break;}}
hash_head=0;if(s.lookahead>=MIN_MATCH){s.ins_h=((s.ins_h<<s.hash_shift)^s.window[s.strstart+MIN_MATCH-1])&s.hash_mask;hash_head=s.prev[s.strstart&s.w_mask]=s.head[s.ins_h];s.head[s.ins_h]=s.strstart;}
if(hash_head!==0&&((s.strstart-hash_head)<=(s.w_size-MIN_LOOKAHEAD))){s.match_length=longest_match(s,hash_head);}
if(s.match_length>=MIN_MATCH){bflush=trees._tr_tally(s,s.strstart-s.match_start,s.match_length-MIN_MATCH);s.lookahead-=s.match_length;if(s.match_length<=s.max_lazy_match&&s.lookahead>=MIN_MATCH){s.match_length--;do{s.strstart++;s.ins_h=((s.ins_h<<s.hash_shift)^s.window[s.strstart+MIN_MATCH-1])&s.hash_mask;hash_head=s.prev[s.strstart&s.w_mask]=s.head[s.ins_h];s.head[s.ins_h]=s.strstart;}while(--s.match_length!==0);s.strstart++;}else
{s.strstart+=s.match_length;s.match_length=0;s.ins_h=s.window[s.strstart];s.ins_h=((s.ins_h<<s.hash_shift)^s.window[s.strstart+1])&s.hash_mask;}}else{bflush=trees._tr_tally(s,0,s.window[s.strstart]);s.lookahead--;s.strstart++;}
if(bflush){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}}
s.insert=((s.strstart<(MIN_MATCH-1))?s.strstart:MIN_MATCH-1);if(flush===Z_FINISH){flush_block_only(s,true);if(s.strm.avail_out===0){return BS_FINISH_STARTED;}
return BS_FINISH_DONE;}
if(s.last_lit){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}
return BS_BLOCK_DONE;}
function deflate_slow(s,flush){var hash_head;var bflush;var max_insert;for(;;){if(s.lookahead<MIN_LOOKAHEAD){fill_window(s);if(s.lookahead<MIN_LOOKAHEAD&&flush===Z_NO_FLUSH){return BS_NEED_MORE;}
if(s.lookahead===0){break;}}
hash_head=0;if(s.lookahead>=MIN_MATCH){s.ins_h=((s.ins_h<<s.hash_shift)^s.window[s.strstart+MIN_MATCH-1])&s.hash_mask;hash_head=s.prev[s.strstart&s.w_mask]=s.head[s.ins_h];s.head[s.ins_h]=s.strstart;}
s.prev_length=s.match_length;s.prev_match=s.match_start;s.match_length=MIN_MATCH-1;if(hash_head!==0&&s.prev_length<s.max_lazy_match&&s.strstart-hash_head<=(s.w_size-MIN_LOOKAHEAD)){s.match_length=longest_match(s,hash_head);if(s.match_length<=5&&(s.strategy===Z_FILTERED||(s.match_length===MIN_MATCH&&s.strstart-s.match_start>4096))){s.match_length=MIN_MATCH-1;}}
if(s.prev_length>=MIN_MATCH&&s.match_length<=s.prev_length){max_insert=s.strstart+s.lookahead-MIN_MATCH;bflush=trees._tr_tally(s,s.strstart-1-s.prev_match,s.prev_length-MIN_MATCH);s.lookahead-=s.prev_length-1;s.prev_length-=2;do{if(++s.strstart<=max_insert){s.ins_h=((s.ins_h<<s.hash_shift)^s.window[s.strstart+MIN_MATCH-1])&s.hash_mask;hash_head=s.prev[s.strstart&s.w_mask]=s.head[s.ins_h];s.head[s.ins_h]=s.strstart;}}while(--s.prev_length!==0);s.match_available=0;s.match_length=MIN_MATCH-1;s.strstart++;if(bflush){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}}else if(s.match_available){bflush=trees._tr_tally(s,0,s.window[s.strstart-1]);if(bflush){flush_block_only(s,false);}
s.strstart++;s.lookahead--;if(s.strm.avail_out===0){return BS_NEED_MORE;}}else{s.match_available=1;s.strstart++;s.lookahead--;}}
if(s.match_available){bflush=trees._tr_tally(s,0,s.window[s.strstart-1]);s.match_available=0;}
s.insert=s.strstart<MIN_MATCH-1?s.strstart:MIN_MATCH-1;if(flush===Z_FINISH){flush_block_only(s,true);if(s.strm.avail_out===0){return BS_FINISH_STARTED;}
return BS_FINISH_DONE;}
if(s.last_lit){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}
return BS_BLOCK_DONE;}
function deflate_rle(s,flush){var bflush;var prev;var scan,strend;var _win=s.window;for(;;){if(s.lookahead<=MAX_MATCH){fill_window(s);if(s.lookahead<=MAX_MATCH&&flush===Z_NO_FLUSH){return BS_NEED_MORE;}
if(s.lookahead===0){break;}}
s.match_length=0;if(s.lookahead>=MIN_MATCH&&s.strstart>0){scan=s.strstart-1;prev=_win[scan];if(prev===_win[++scan]&&prev===_win[++scan]&&prev===_win[++scan]){strend=s.strstart+MAX_MATCH;do{}while(prev===_win[++scan]&&prev===_win[++scan]&&prev===_win[++scan]&&prev===_win[++scan]&&prev===_win[++scan]&&prev===_win[++scan]&&prev===_win[++scan]&&prev===_win[++scan]&&scan<strend);s.match_length=MAX_MATCH-(strend-scan);if(s.match_length>s.lookahead){s.match_length=s.lookahead;}}}
if(s.match_length>=MIN_MATCH){bflush=trees._tr_tally(s,1,s.match_length-MIN_MATCH);s.lookahead-=s.match_length;s.strstart+=s.match_length;s.match_length=0;}else{bflush=trees._tr_tally(s,0,s.window[s.strstart]);s.lookahead--;s.strstart++;}
if(bflush){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}}
s.insert=0;if(flush===Z_FINISH){flush_block_only(s,true);if(s.strm.avail_out===0){return BS_FINISH_STARTED;}
return BS_FINISH_DONE;}
if(s.last_lit){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}
return BS_BLOCK_DONE;}
function deflate_huff(s,flush){var bflush;for(;;){if(s.lookahead===0){fill_window(s);if(s.lookahead===0){if(flush===Z_NO_FLUSH){return BS_NEED_MORE;}
break;}}
s.match_length=0;bflush=trees._tr_tally(s,0,s.window[s.strstart]);s.lookahead--;s.strstart++;if(bflush){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}}
s.insert=0;if(flush===Z_FINISH){flush_block_only(s,true);if(s.strm.avail_out===0){return BS_FINISH_STARTED;}
return BS_FINISH_DONE;}
if(s.last_lit){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}
return BS_BLOCK_DONE;}
var Config=function(good_length,max_lazy,nice_length,max_chain,func){this.good_length=good_length;this.max_lazy=max_lazy;this.nice_length=nice_length;this.max_chain=max_chain;this.func=func;};var configuration_table;configuration_table=[new Config(0,0,0,0,deflate_stored),new Config(4,4,8,4,deflate_fast),new Config(4,5,16,8,deflate_fast),new Config(4,6,32,32,deflate_fast),new Config(4,4,16,16,deflate_slow),new Config(8,16,32,32,deflate_slow),new Config(8,16,128,128,deflate_slow),new Config(8,32,128,256,deflate_slow),new Config(32,128,258,1024,deflate_slow),new Config(32,258,258,4096,deflate_slow)];function lm_init(s){s.window_size=2*s.w_size;zero(s.head);s.max_lazy_match=configuration_table[s.level].max_lazy;s.good_match=configuration_table[s.level].good_length;s.nice_match=configuration_table[s.level].nice_length;s.max_chain_length=configuration_table[s.level].max_chain;s.strstart=0;s.block_start=0;s.lookahead=0;s.insert=0;s.match_length=s.prev_length=MIN_MATCH-1;s.match_available=0;s.ins_h=0;}
function DeflateState(){this.strm=null;this.status=0;this.pending_buf=null;this.pending_buf_size=0;this.pending_out=0;this.pending=0;this.wrap=0;this.gzhead=null;this.gzindex=0;this.method=Z_DEFLATED;this.last_flush=-1;this.w_size=0;this.w_bits=0;this.w_mask=0;this.window=null;this.window_size=0;this.prev=null;this.head=null;this.ins_h=0;this.hash_size=0;this.hash_bits=0;this.hash_mask=0;this.hash_shift=0;this.block_start=0;this.match_length=0;this.prev_match=0;this.match_available=0;this.strstart=0;this.match_start=0;this.lookahead=0;this.prev_length=0;this.max_chain_length=0;this.max_lazy_match=0;this.level=0;this.strategy=0;this.good_match=0;this.nice_match=0;this.dyn_ltree=new utils.Buf16(HEAP_SIZE*2);this.dyn_dtree=new utils.Buf16((2*D_CODES+1)*2);this.bl_tree=new utils.Buf16((2*BL_CODES+1)*2);zero(this.dyn_ltree);zero(this.dyn_dtree);zero(this.bl_tree);this.l_desc=null;this.d_desc=null;this.bl_desc=null;this.bl_count=new utils.Buf16(MAX_BITS+1);this.heap=new utils.Buf16(2*L_CODES+1);zero(this.heap);this.heap_len=0;this.heap_max=0;this.depth=new utils.Buf16(2*L_CODES+1);zero(this.depth);this.l_buf=0;this.lit_bufsize=0;this.last_lit=0;this.d_buf=0;this.opt_len=0;this.static_len=0;this.matches=0;this.insert=0;this.bi_buf=0;this.bi_valid=0;}
function deflateResetKeep(strm){var s;if(!strm||!strm.state){return err(strm,Z_STREAM_ERROR);}
strm.total_in=strm.total_out=0;strm.data_type=Z_UNKNOWN;s=strm.state;s.pending=0;s.pending_out=0;if(s.wrap<0){s.wrap=-s.wrap;}
s.status=(s.wrap?INIT_STATE:BUSY_STATE);strm.adler=(s.wrap===2)?0:1;s.last_flush=Z_NO_FLUSH;trees._tr_init(s);return Z_OK;}
function deflateReset(strm){var ret=deflateResetKeep(strm);if(ret===Z_OK){lm_init(strm.state);}
return ret;}
function deflateSetHeader(strm,head){if(!strm||!strm.state){return Z_STREAM_ERROR;}
if(strm.state.wrap!==2){return Z_STREAM_ERROR;}
strm.state.gzhead=head;return Z_OK;}
function deflateInit2(strm,level,method,windowBits,memLevel,strategy){if(!strm){return Z_STREAM_ERROR;}
var wrap=1;if(level===Z_DEFAULT_COMPRESSION){level=6;}
if(windowBits<0){wrap=0;windowBits=-windowBits;}
else if(windowBits>15){wrap=2;windowBits-=16;}
if(memLevel<1||memLevel>MAX_MEM_LEVEL||method!==Z_DEFLATED||windowBits<8||windowBits>15||level<0||level>9||strategy<0||strategy>Z_FIXED){return err(strm,Z_STREAM_ERROR);}
if(windowBits===8){windowBits=9;}
var s=new DeflateState();strm.state=s;s.strm=strm;s.wrap=wrap;s.gzhead=null;s.w_bits=windowBits;s.w_size=1<<s.w_bits;s.w_mask=s.w_size-1;s.hash_bits=memLevel+7;s.hash_size=1<<s.hash_bits;s.hash_mask=s.hash_size-1;s.hash_shift=~~((s.hash_bits+MIN_MATCH-1)/MIN_MATCH);s.window=new utils.Buf8(s.w_size*2);s.head=new utils.Buf16(s.hash_size);s.prev=new utils.Buf16(s.w_size);s.lit_bufsize=1<<(memLevel+6);s.pending_buf_size=s.lit_bufsize*4;s.pending_buf=new utils.Buf8(s.pending_buf_size);s.d_buf=s.lit_bufsize>>1;s.l_buf=(1+2)*s.lit_bufsize;s.level=level;s.strategy=strategy;s.method=method;return deflateReset(strm);}
function deflateInit(strm,level){return deflateInit2(strm,level,Z_DEFLATED,MAX_WBITS,DEF_MEM_LEVEL,Z_DEFAULT_STRATEGY);}
function deflate(strm,flush){var old_flush,s;var beg,val;if(!strm||!strm.state||flush>Z_BLOCK||flush<0){return strm?err(strm,Z_STREAM_ERROR):Z_STREAM_ERROR;}
s=strm.state;if(!strm.output||(!strm.input&&strm.avail_in!==0)||(s.status===FINISH_STATE&&flush!==Z_FINISH)){return err(strm,(strm.avail_out===0)?Z_BUF_ERROR:Z_STREAM_ERROR);}
s.strm=strm;old_flush=s.last_flush;s.last_flush=flush;if(s.status===INIT_STATE){if(s.wrap===2){strm.adler=0;put_byte(s,31);put_byte(s,139);put_byte(s,8);if(!s.gzhead){put_byte(s,0);put_byte(s,0);put_byte(s,0);put_byte(s,0);put_byte(s,0);put_byte(s,s.level===9?2:(s.strategy>=Z_HUFFMAN_ONLY||s.level<2?4:0));put_byte(s,OS_CODE);s.status=BUSY_STATE;}
else{put_byte(s,(s.gzhead.text?1:0)+(s.gzhead.hcrc?2:0)+(!s.gzhead.extra?0:4)+(!s.gzhead.name?0:8)+(!s.gzhead.comment?0:16));put_byte(s,s.gzhead.time&0xff);put_byte(s,(s.gzhead.time>>8)&0xff);put_byte(s,(s.gzhead.time>>16)&0xff);put_byte(s,(s.gzhead.time>>24)&0xff);put_byte(s,s.level===9?2:(s.strategy>=Z_HUFFMAN_ONLY||s.level<2?4:0));put_byte(s,s.gzhead.os&0xff);if(s.gzhead.extra&&s.gzhead.extra.length){put_byte(s,s.gzhead.extra.length&0xff);put_byte(s,(s.gzhead.extra.length>>8)&0xff);}
if(s.gzhead.hcrc){strm.adler=crc32(strm.adler,s.pending_buf,s.pending,0);}
s.gzindex=0;s.status=EXTRA_STATE;}}
else
{var header=(Z_DEFLATED+((s.w_bits-8)<<4))<<8;var level_flags=-1;if(s.strategy>=Z_HUFFMAN_ONLY||s.level<2){level_flags=0;}else if(s.level<6){level_flags=1;}else if(s.level===6){level_flags=2;}else{level_flags=3;}
header|=(level_flags<<6);if(s.strstart!==0){header|=PRESET_DICT;}
header+=31-(header%31);s.status=BUSY_STATE;putShortMSB(s,header);if(s.strstart!==0){putShortMSB(s,strm.adler>>>16);putShortMSB(s,strm.adler&0xffff);}
strm.adler=1;}}
if(s.status===EXTRA_STATE){if(s.gzhead.extra){beg=s.pending;while(s.gzindex<(s.gzhead.extra.length&0xffff)){if(s.pending===s.pending_buf_size){if(s.gzhead.hcrc&&s.pending>beg){strm.adler=crc32(strm.adler,s.pending_buf,s.pending-beg,beg);}
flush_pending(strm);beg=s.pending;if(s.pending===s.pending_buf_size){break;}}
put_byte(s,s.gzhead.extra[s.gzindex]&0xff);s.gzindex++;}
if(s.gzhead.hcrc&&s.pending>beg){strm.adler=crc32(strm.adler,s.pending_buf,s.pending-beg,beg);}
if(s.gzindex===s.gzhead.extra.length){s.gzindex=0;s.status=NAME_STATE;}}
else{s.status=NAME_STATE;}}
if(s.status===NAME_STATE){if(s.gzhead.name){beg=s.pending;do{if(s.pending===s.pending_buf_size){if(s.gzhead.hcrc&&s.pending>beg){strm.adler=crc32(strm.adler,s.pending_buf,s.pending-beg,beg);}
flush_pending(strm);beg=s.pending;if(s.pending===s.pending_buf_size){val=1;break;}}
if(s.gzindex<s.gzhead.name.length){val=s.gzhead.name.charCodeAt(s.gzindex++)&0xff;}else{val=0;}
put_byte(s,val);}while(val!==0);if(s.gzhead.hcrc&&s.pending>beg){strm.adler=crc32(strm.adler,s.pending_buf,s.pending-beg,beg);}
if(val===0){s.gzindex=0;s.status=COMMENT_STATE;}}
else{s.status=COMMENT_STATE;}}
if(s.status===COMMENT_STATE){if(s.gzhead.comment){beg=s.pending;do{if(s.pending===s.pending_buf_size){if(s.gzhead.hcrc&&s.pending>beg){strm.adler=crc32(strm.adler,s.pending_buf,s.pending-beg,beg);}
flush_pending(strm);beg=s.pending;if(s.pending===s.pending_buf_size){val=1;break;}}
if(s.gzindex<s.gzhead.comment.length){val=s.gzhead.comment.charCodeAt(s.gzindex++)&0xff;}else{val=0;}
put_byte(s,val);}while(val!==0);if(s.gzhead.hcrc&&s.pending>beg){strm.adler=crc32(strm.adler,s.pending_buf,s.pending-beg,beg);}
if(val===0){s.status=HCRC_STATE;}}
else{s.status=HCRC_STATE;}}
if(s.status===HCRC_STATE){if(s.gzhead.hcrc){if(s.pending+2>s.pending_buf_size){flush_pending(strm);}
if(s.pending+2<=s.pending_buf_size){put_byte(s,strm.adler&0xff);put_byte(s,(strm.adler>>8)&0xff);strm.adler=0;s.status=BUSY_STATE;}}
else{s.status=BUSY_STATE;}}
if(s.pending!==0){flush_pending(strm);if(strm.avail_out===0){s.last_flush=-1;return Z_OK;}}else if(strm.avail_in===0&&rank(flush)<=rank(old_flush)&&flush!==Z_FINISH){return err(strm,Z_BUF_ERROR);}
if(s.status===FINISH_STATE&&strm.avail_in!==0){return err(strm,Z_BUF_ERROR);}
if(strm.avail_in!==0||s.lookahead!==0||(flush!==Z_NO_FLUSH&&s.status!==FINISH_STATE)){var bstate=(s.strategy===Z_HUFFMAN_ONLY)?deflate_huff(s,flush):(s.strategy===Z_RLE?deflate_rle(s,flush):configuration_table[s.level].func(s,flush));if(bstate===BS_FINISH_STARTED||bstate===BS_FINISH_DONE){s.status=FINISH_STATE;}
if(bstate===BS_NEED_MORE||bstate===BS_FINISH_STARTED){if(strm.avail_out===0){s.last_flush=-1;}
return Z_OK;}
if(bstate===BS_BLOCK_DONE){if(flush===Z_PARTIAL_FLUSH){trees._tr_align(s);}
else if(flush!==Z_BLOCK){trees._tr_stored_block(s,0,0,false);if(flush===Z_FULL_FLUSH){zero(s.head);if(s.lookahead===0){s.strstart=0;s.block_start=0;s.insert=0;}}}
flush_pending(strm);if(strm.avail_out===0){s.last_flush=-1;return Z_OK;}}}
if(flush!==Z_FINISH){return Z_OK;}
if(s.wrap<=0){return Z_STREAM_END;}
if(s.wrap===2){put_byte(s,strm.adler&0xff);put_byte(s,(strm.adler>>8)&0xff);put_byte(s,(strm.adler>>16)&0xff);put_byte(s,(strm.adler>>24)&0xff);put_byte(s,strm.total_in&0xff);put_byte(s,(strm.total_in>>8)&0xff);put_byte(s,(strm.total_in>>16)&0xff);put_byte(s,(strm.total_in>>24)&0xff);}
else
{putShortMSB(s,strm.adler>>>16);putShortMSB(s,strm.adler&0xffff);}
flush_pending(strm);if(s.wrap>0){s.wrap=-s.wrap;}
return s.pending!==0?Z_OK:Z_STREAM_END;}
function deflateEnd(strm){var status;if(!strm||!strm.state){return Z_STREAM_ERROR;}
status=strm.state.status;if(status!==INIT_STATE&&status!==EXTRA_STATE&&status!==NAME_STATE&&status!==COMMENT_STATE&&status!==HCRC_STATE&&status!==BUSY_STATE&&status!==FINISH_STATE){return err(strm,Z_STREAM_ERROR);}
strm.state=null;return status===BUSY_STATE?err(strm,Z_DATA_ERROR):Z_OK;}
exports.deflateInit=deflateInit;exports.deflateInit2=deflateInit2;exports.deflateReset=deflateReset;exports.deflateResetKeep=deflateResetKeep;exports.deflateSetHeader=deflateSetHeader;exports.deflate=deflate;exports.deflateEnd=deflateEnd;exports.deflateInfo='pako deflate (from Nodeca project)';},{"../utils/common":27,"./adler32":29,"./crc32":31,"./messages":37,"./trees":38}],33:[function(_dereq_,module,exports){'use strict';function GZheader(){this.text=0;this.time=0;this.xflags=0;this.os=0;this.extra=null;this.extra_len=0;this.name='';this.comment='';this.hcrc=0;this.done=false;}
module.exports=GZheader;},{}],34:[function(_dereq_,module,exports){'use strict';var BAD=30;var TYPE=12;module.exports=function inflate_fast(strm,start){var state;var _in;var last;var _out;var beg;var end;var dmax;var wsize;var whave;var wnext;var window;var hold;var bits;var lcode;var dcode;var lmask;var dmask;var here;var op;var len;var dist;var from;var from_source;var input,output;state=strm.state;_in=strm.next_in;input=strm.input;last=_in+(strm.avail_in-5);_out=strm.next_out;output=strm.output;beg=_out-(start-strm.avail_out);end=_out+(strm.avail_out-257);dmax=state.dmax;wsize=state.wsize;whave=state.whave;wnext=state.wnext;window=state.window;hold=state.hold;bits=state.bits;lcode=state.lencode;dcode=state.distcode;lmask=(1<<state.lenbits)-1;dmask=(1<<state.distbits)-1;top:do{if(bits<15){hold+=input[_in++]<<bits;bits+=8;hold+=input[_in++]<<bits;bits+=8;}
here=lcode[hold&lmask];dolen:for(;;){op=here>>>24;hold>>>=op;bits-=op;op=(here>>>16)&0xff;if(op===0){output[_out++]=here&0xffff;}
else if(op&16){len=here&0xffff;op&=15;if(op){if(bits<op){hold+=input[_in++]<<bits;bits+=8;}
len+=hold&((1<<op)-1);hold>>>=op;bits-=op;}
if(bits<15){hold+=input[_in++]<<bits;bits+=8;hold+=input[_in++]<<bits;bits+=8;}
here=dcode[hold&dmask];dodist:for(;;){op=here>>>24;hold>>>=op;bits-=op;op=(here>>>16)&0xff;if(op&16){dist=here&0xffff;op&=15;if(bits<op){hold+=input[_in++]<<bits;bits+=8;if(bits<op){hold+=input[_in++]<<bits;bits+=8;}}
dist+=hold&((1<<op)-1);if(dist>dmax){strm.msg='invalid distance too far back';state.mode=BAD;break top;}
hold>>>=op;bits-=op;op=_out-beg;if(dist>op){op=dist-op;if(op>whave){if(state.sane){strm.msg='invalid distance too far back';state.mode=BAD;break top;}}
from=0;from_source=window;if(wnext===0){from+=wsize-op;if(op<len){len-=op;do{output[_out++]=window[from++];}while(--op);from=_out-dist;from_source=output;}}
else if(wnext<op){from+=wsize+wnext-op;op-=wnext;if(op<len){len-=op;do{output[_out++]=window[from++];}while(--op);from=0;if(wnext<len){op=wnext;len-=op;do{output[_out++]=window[from++];}while(--op);from=_out-dist;from_source=output;}}}
else{from+=wnext-op;if(op<len){len-=op;do{output[_out++]=window[from++];}while(--op);from=_out-dist;from_source=output;}}
while(len>2){output[_out++]=from_source[from++];output[_out++]=from_source[from++];output[_out++]=from_source[from++];len-=3;}
if(len){output[_out++]=from_source[from++];if(len>1){output[_out++]=from_source[from++];}}}
else{from=_out-dist;do{output[_out++]=output[from++];output[_out++]=output[from++];output[_out++]=output[from++];len-=3;}while(len>2);if(len){output[_out++]=output[from++];if(len>1){output[_out++]=output[from++];}}}}
else if((op&64)===0){here=dcode[(here&0xffff)+(hold&((1<<op)-1))];continue dodist;}
else{strm.msg='invalid distance code';state.mode=BAD;break top;}
break;}}
else if((op&64)===0){here=lcode[(here&0xffff)+(hold&((1<<op)-1))];continue dolen;}
else if(op&32){state.mode=TYPE;break top;}
else{strm.msg='invalid literal/length code';state.mode=BAD;break top;}
break;}}while(_in<last&&_out<end);len=bits>>3;_in-=len;bits-=len<<3;hold&=(1<<bits)-1;strm.next_in=_in;strm.next_out=_out;strm.avail_in=(_in<last?5+(last-_in):5-(_in-last));strm.avail_out=(_out<end?257+(end-_out):257-(_out-end));state.hold=hold;state.bits=bits;return;};},{}],35:[function(_dereq_,module,exports){'use strict';var utils=_dereq_('../utils/common');var adler32=_dereq_('./adler32');var crc32=_dereq_('./crc32');var inflate_fast=_dereq_('./inffast');var inflate_table=_dereq_('./inftrees');var CODES=0;var LENS=1;var DISTS=2;var Z_FINISH=4;var Z_BLOCK=5;var Z_TREES=6;var Z_OK=0;var Z_STREAM_END=1;var Z_NEED_DICT=2;var Z_STREAM_ERROR=-2;var Z_DATA_ERROR=-3;var Z_MEM_ERROR=-4;var Z_BUF_ERROR=-5;var Z_DEFLATED=8;var HEAD=1;var FLAGS=2;var TIME=3;var OS=4;var EXLEN=5;var EXTRA=6;var NAME=7;var COMMENT=8;var HCRC=9;var DICTID=10;var DICT=11;var TYPE=12;var TYPEDO=13;var STORED=14;var COPY_=15;var COPY=16;var TABLE=17;var LENLENS=18;var CODELENS=19;var LEN_=20;var LEN=21;var LENEXT=22;var DIST=23;var DISTEXT=24;var MATCH=25;var LIT=26;var CHECK=27;var LENGTH=28;var DONE=29;var BAD=30;var MEM=31;var SYNC=32;var ENOUGH_LENS=852;var ENOUGH_DISTS=592;var MAX_WBITS=15;var DEF_WBITS=MAX_WBITS;function ZSWAP32(q){return(((q>>>24)&0xff)+((q>>>8)&0xff00)+((q&0xff00)<<8)+((q&0xff)<<24));}
function InflateState(){this.mode=0;this.last=false;this.wrap=0;this.havedict=false;this.flags=0;this.dmax=0;this.check=0;this.total=0;this.head=null;this.wbits=0;this.wsize=0;this.whave=0;this.wnext=0;this.window=null;this.hold=0;this.bits=0;this.length=0;this.offset=0;this.extra=0;this.lencode=null;this.distcode=null;this.lenbits=0;this.distbits=0;this.ncode=0;this.nlen=0;this.ndist=0;this.have=0;this.next=null;this.lens=new utils.Buf16(320);this.work=new utils.Buf16(288);this.lendyn=null;this.distdyn=null;this.sane=0;this.back=0;this.was=0;}
function inflateResetKeep(strm){var state;if(!strm||!strm.state){return Z_STREAM_ERROR;}
state=strm.state;strm.total_in=strm.total_out=state.total=0;strm.msg='';if(state.wrap){strm.adler=state.wrap&1;}
state.mode=HEAD;state.last=0;state.havedict=0;state.dmax=32768;state.head=null;state.hold=0;state.bits=0;state.lencode=state.lendyn=new utils.Buf32(ENOUGH_LENS);state.distcode=state.distdyn=new utils.Buf32(ENOUGH_DISTS);state.sane=1;state.back=-1;return Z_OK;}
function inflateReset(strm){var state;if(!strm||!strm.state){return Z_STREAM_ERROR;}
state=strm.state;state.wsize=0;state.whave=0;state.wnext=0;return inflateResetKeep(strm);}
function inflateReset2(strm,windowBits){var wrap;var state;if(!strm||!strm.state){return Z_STREAM_ERROR;}
state=strm.state;if(windowBits<0){wrap=0;windowBits=-windowBits;}
else{wrap=(windowBits>>4)+1;if(windowBits<48){windowBits&=15;}}
if(windowBits&&(windowBits<8||windowBits>15)){return Z_STREAM_ERROR;}
if(state.window!==null&&state.wbits!==windowBits){state.window=null;}
state.wrap=wrap;state.wbits=windowBits;return inflateReset(strm);}
function inflateInit2(strm,windowBits){var ret;var state;if(!strm){return Z_STREAM_ERROR;}
state=new InflateState();strm.state=state;state.window=null;ret=inflateReset2(strm,windowBits);if(ret!==Z_OK){strm.state=null;}
return ret;}
function inflateInit(strm){return inflateInit2(strm,DEF_WBITS);}
var virgin=true;var lenfix,distfix;function fixedtables(state){if(virgin){var sym;lenfix=new utils.Buf32(512);distfix=new utils.Buf32(32);sym=0;while(sym<144){state.lens[sym++]=8;}
while(sym<256){state.lens[sym++]=9;}
while(sym<280){state.lens[sym++]=7;}
while(sym<288){state.lens[sym++]=8;}
inflate_table(LENS,state.lens,0,288,lenfix,0,state.work,{bits:9});sym=0;while(sym<32){state.lens[sym++]=5;}
inflate_table(DISTS,state.lens,0,32,distfix,0,state.work,{bits:5});virgin=false;}
state.lencode=lenfix;state.lenbits=9;state.distcode=distfix;state.distbits=5;}
function updatewindow(strm,src,end,copy){var dist;var state=strm.state;if(state.window===null){state.wsize=1<<state.wbits;state.wnext=0;state.whave=0;state.window=new utils.Buf8(state.wsize);}
if(copy>=state.wsize){utils.arraySet(state.window,src,end-state.wsize,state.wsize,0);state.wnext=0;state.whave=state.wsize;}
else{dist=state.wsize-state.wnext;if(dist>copy){dist=copy;}
utils.arraySet(state.window,src,end-copy,dist,state.wnext);copy-=dist;if(copy){utils.arraySet(state.window,src,end-copy,copy,0);state.wnext=copy;state.whave=state.wsize;}
else{state.wnext+=dist;if(state.wnext===state.wsize){state.wnext=0;}
if(state.whave<state.wsize){state.whave+=dist;}}}
return 0;}
function inflate(strm,flush){var state;var input,output;var next;var put;var have,left;var hold;var bits;var _in,_out;var copy;var from;var from_source;var here=0;var here_bits,here_op,here_val;var last_bits,last_op,last_val;var len;var ret;var hbuf=new utils.Buf8(4);var opts;var n;var order=[16,17,18,0,8,7,9,6,10,5,11,4,12,3,13,2,14,1,15];if(!strm||!strm.state||!strm.output||(!strm.input&&strm.avail_in!==0)){return Z_STREAM_ERROR;}
state=strm.state;if(state.mode===TYPE){state.mode=TYPEDO;}
put=strm.next_out;output=strm.output;left=strm.avail_out;next=strm.next_in;input=strm.input;have=strm.avail_in;hold=state.hold;bits=state.bits;_in=have;_out=left;ret=Z_OK;inf_leave:for(;;){switch(state.mode){case HEAD:if(state.wrap===0){state.mode=TYPEDO;break;}
while(bits<16){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if((state.wrap&2)&&hold===0x8b1f){state.check=0;hbuf[0]=hold&0xff;hbuf[1]=(hold>>>8)&0xff;state.check=crc32(state.check,hbuf,2,0);hold=0;bits=0;state.mode=FLAGS;break;}
state.flags=0;if(state.head){state.head.done=false;}
if(!(state.wrap&1)||(((hold&0xff)<<8)+(hold>>8))%31){strm.msg='incorrect header check';state.mode=BAD;break;}
if((hold&0x0f)!==Z_DEFLATED){strm.msg='unknown compression method';state.mode=BAD;break;}
hold>>>=4;bits-=4;len=(hold&0x0f)+8;if(state.wbits===0){state.wbits=len;}
else if(len>state.wbits){strm.msg='invalid window size';state.mode=BAD;break;}
state.dmax=1<<len;strm.adler=state.check=1;state.mode=hold&0x200?DICTID:TYPE;hold=0;bits=0;break;case FLAGS:while(bits<16){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
state.flags=hold;if((state.flags&0xff)!==Z_DEFLATED){strm.msg='unknown compression method';state.mode=BAD;break;}
if(state.flags&0xe000){strm.msg='unknown header flags set';state.mode=BAD;break;}
if(state.head){state.head.text=((hold>>8)&1);}
if(state.flags&0x0200){hbuf[0]=hold&0xff;hbuf[1]=(hold>>>8)&0xff;state.check=crc32(state.check,hbuf,2,0);}
hold=0;bits=0;state.mode=TIME;case TIME:while(bits<32){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if(state.head){state.head.time=hold;}
if(state.flags&0x0200){hbuf[0]=hold&0xff;hbuf[1]=(hold>>>8)&0xff;hbuf[2]=(hold>>>16)&0xff;hbuf[3]=(hold>>>24)&0xff;state.check=crc32(state.check,hbuf,4,0);}
hold=0;bits=0;state.mode=OS;case OS:while(bits<16){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if(state.head){state.head.xflags=(hold&0xff);state.head.os=(hold>>8);}
if(state.flags&0x0200){hbuf[0]=hold&0xff;hbuf[1]=(hold>>>8)&0xff;state.check=crc32(state.check,hbuf,2,0);}
hold=0;bits=0;state.mode=EXLEN;case EXLEN:if(state.flags&0x0400){while(bits<16){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
state.length=hold;if(state.head){state.head.extra_len=hold;}
if(state.flags&0x0200){hbuf[0]=hold&0xff;hbuf[1]=(hold>>>8)&0xff;state.check=crc32(state.check,hbuf,2,0);}
hold=0;bits=0;}
else if(state.head){state.head.extra=null;}
state.mode=EXTRA;case EXTRA:if(state.flags&0x0400){copy=state.length;if(copy>have){copy=have;}
if(copy){if(state.head){len=state.head.extra_len-state.length;if(!state.head.extra){state.head.extra=new Array(state.head.extra_len);}
utils.arraySet(state.head.extra,input,next,copy,len);}
if(state.flags&0x0200){state.check=crc32(state.check,input,copy,next);}
have-=copy;next+=copy;state.length-=copy;}
if(state.length){break inf_leave;}}
state.length=0;state.mode=NAME;case NAME:if(state.flags&0x0800){if(have===0){break inf_leave;}
copy=0;do{len=input[next+copy++];if(state.head&&len&&(state.length<65536)){state.head.name+=String.fromCharCode(len);}}while(len&&copy<have);if(state.flags&0x0200){state.check=crc32(state.check,input,copy,next);}
have-=copy;next+=copy;if(len){break inf_leave;}}
else if(state.head){state.head.name=null;}
state.length=0;state.mode=COMMENT;case COMMENT:if(state.flags&0x1000){if(have===0){break inf_leave;}
copy=0;do{len=input[next+copy++];if(state.head&&len&&(state.length<65536)){state.head.comment+=String.fromCharCode(len);}}while(len&&copy<have);if(state.flags&0x0200){state.check=crc32(state.check,input,copy,next);}
have-=copy;next+=copy;if(len){break inf_leave;}}
else if(state.head){state.head.comment=null;}
state.mode=HCRC;case HCRC:if(state.flags&0x0200){while(bits<16){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if(hold!==(state.check&0xffff)){strm.msg='header crc mismatch';state.mode=BAD;break;}
hold=0;bits=0;}
if(state.head){state.head.hcrc=((state.flags>>9)&1);state.head.done=true;}
strm.adler=state.check=0;state.mode=TYPE;break;case DICTID:while(bits<32){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
strm.adler=state.check=ZSWAP32(hold);hold=0;bits=0;state.mode=DICT;case DICT:if(state.havedict===0){strm.next_out=put;strm.avail_out=left;strm.next_in=next;strm.avail_in=have;state.hold=hold;state.bits=bits;return Z_NEED_DICT;}
strm.adler=state.check=1;state.mode=TYPE;case TYPE:if(flush===Z_BLOCK||flush===Z_TREES){break inf_leave;}
case TYPEDO:if(state.last){hold>>>=bits&7;bits-=bits&7;state.mode=CHECK;break;}
while(bits<3){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
state.last=(hold&0x01);hold>>>=1;bits-=1;switch((hold&0x03)){case 0:state.mode=STORED;break;case 1:fixedtables(state);state.mode=LEN_;if(flush===Z_TREES){hold>>>=2;bits-=2;break inf_leave;}
break;case 2:state.mode=TABLE;break;case 3:strm.msg='invalid block type';state.mode=BAD;}
hold>>>=2;bits-=2;break;case STORED:hold>>>=bits&7;bits-=bits&7;while(bits<32){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if((hold&0xffff)!==((hold>>>16)^0xffff)){strm.msg='invalid stored block lengths';state.mode=BAD;break;}
state.length=hold&0xffff;hold=0;bits=0;state.mode=COPY_;if(flush===Z_TREES){break inf_leave;}
case COPY_:state.mode=COPY;case COPY:copy=state.length;if(copy){if(copy>have){copy=have;}
if(copy>left){copy=left;}
if(copy===0){break inf_leave;}
utils.arraySet(output,input,next,copy,put);have-=copy;next+=copy;left-=copy;put+=copy;state.length-=copy;break;}
state.mode=TYPE;break;case TABLE:while(bits<14){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
state.nlen=(hold&0x1f)+257;hold>>>=5;bits-=5;state.ndist=(hold&0x1f)+1;hold>>>=5;bits-=5;state.ncode=(hold&0x0f)+4;hold>>>=4;bits-=4;if(state.nlen>286||state.ndist>30){strm.msg='too many length or distance symbols';state.mode=BAD;break;}
state.have=0;state.mode=LENLENS;case LENLENS:while(state.have<state.ncode){while(bits<3){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
state.lens[order[state.have++]]=(hold&0x07);hold>>>=3;bits-=3;}
while(state.have<19){state.lens[order[state.have++]]=0;}
state.lencode=state.lendyn;state.lenbits=7;opts={bits:state.lenbits};ret=inflate_table(CODES,state.lens,0,19,state.lencode,0,state.work,opts);state.lenbits=opts.bits;if(ret){strm.msg='invalid code lengths set';state.mode=BAD;break;}
state.have=0;state.mode=CODELENS;case CODELENS:while(state.have<state.nlen+state.ndist){for(;;){here=state.lencode[hold&((1<<state.lenbits)-1)];here_bits=here>>>24;here_op=(here>>>16)&0xff;here_val=here&0xffff;if((here_bits)<=bits){break;}
if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if(here_val<16){hold>>>=here_bits;bits-=here_bits;state.lens[state.have++]=here_val;}
else{if(here_val===16){n=here_bits+2;while(bits<n){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
hold>>>=here_bits;bits-=here_bits;if(state.have===0){strm.msg='invalid bit length repeat';state.mode=BAD;break;}
len=state.lens[state.have-1];copy=3+(hold&0x03);hold>>>=2;bits-=2;}
else if(here_val===17){n=here_bits+3;while(bits<n){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
hold>>>=here_bits;bits-=here_bits;len=0;copy=3+(hold&0x07);hold>>>=3;bits-=3;}
else{n=here_bits+7;while(bits<n){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
hold>>>=here_bits;bits-=here_bits;len=0;copy=11+(hold&0x7f);hold>>>=7;bits-=7;}
if(state.have+copy>state.nlen+state.ndist){strm.msg='invalid bit length repeat';state.mode=BAD;break;}
while(copy--){state.lens[state.have++]=len;}}}
if(state.mode===BAD){break;}
if(state.lens[256]===0){strm.msg='invalid code -- missing end-of-block';state.mode=BAD;break;}
state.lenbits=9;opts={bits:state.lenbits};ret=inflate_table(LENS,state.lens,0,state.nlen,state.lencode,0,state.work,opts);state.lenbits=opts.bits;if(ret){strm.msg='invalid literal/lengths set';state.mode=BAD;break;}
state.distbits=6;state.distcode=state.distdyn;opts={bits:state.distbits};ret=inflate_table(DISTS,state.lens,state.nlen,state.ndist,state.distcode,0,state.work,opts);state.distbits=opts.bits;if(ret){strm.msg='invalid distances set';state.mode=BAD;break;}
state.mode=LEN_;if(flush===Z_TREES){break inf_leave;}
case LEN_:state.mode=LEN;case LEN:if(have>=6&&left>=258){strm.next_out=put;strm.avail_out=left;strm.next_in=next;strm.avail_in=have;state.hold=hold;state.bits=bits;inflate_fast(strm,_out);put=strm.next_out;output=strm.output;left=strm.avail_out;next=strm.next_in;input=strm.input;have=strm.avail_in;hold=state.hold;bits=state.bits;if(state.mode===TYPE){state.back=-1;}
break;}
state.back=0;for(;;){here=state.lencode[hold&((1<<state.lenbits)-1)];here_bits=here>>>24;here_op=(here>>>16)&0xff;here_val=here&0xffff;if(here_bits<=bits){break;}
if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if(here_op&&(here_op&0xf0)===0){last_bits=here_bits;last_op=here_op;last_val=here_val;for(;;){here=state.lencode[last_val+((hold&((1<<(last_bits+last_op))-1))>>last_bits)];here_bits=here>>>24;here_op=(here>>>16)&0xff;here_val=here&0xffff;if((last_bits+here_bits)<=bits){break;}
if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
hold>>>=last_bits;bits-=last_bits;state.back+=last_bits;}
hold>>>=here_bits;bits-=here_bits;state.back+=here_bits;state.length=here_val;if(here_op===0){state.mode=LIT;break;}
if(here_op&32){state.back=-1;state.mode=TYPE;break;}
if(here_op&64){strm.msg='invalid literal/length code';state.mode=BAD;break;}
state.extra=here_op&15;state.mode=LENEXT;case LENEXT:if(state.extra){n=state.extra;while(bits<n){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
state.length+=hold&((1<<state.extra)-1);hold>>>=state.extra;bits-=state.extra;state.back+=state.extra;}
state.was=state.length;state.mode=DIST;case DIST:for(;;){here=state.distcode[hold&((1<<state.distbits)-1)];here_bits=here>>>24;here_op=(here>>>16)&0xff;here_val=here&0xffff;if((here_bits)<=bits){break;}
if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if((here_op&0xf0)===0){last_bits=here_bits;last_op=here_op;last_val=here_val;for(;;){here=state.distcode[last_val+((hold&((1<<(last_bits+last_op))-1))>>last_bits)];here_bits=here>>>24;here_op=(here>>>16)&0xff;here_val=here&0xffff;if((last_bits+here_bits)<=bits){break;}
if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
hold>>>=last_bits;bits-=last_bits;state.back+=last_bits;}
hold>>>=here_bits;bits-=here_bits;state.back+=here_bits;if(here_op&64){strm.msg='invalid distance code';state.mode=BAD;break;}
state.offset=here_val;state.extra=(here_op)&15;state.mode=DISTEXT;case DISTEXT:if(state.extra){n=state.extra;while(bits<n){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
state.offset+=hold&((1<<state.extra)-1);hold>>>=state.extra;bits-=state.extra;state.back+=state.extra;}
if(state.offset>state.dmax){strm.msg='invalid distance too far back';state.mode=BAD;break;}
state.mode=MATCH;case MATCH:if(left===0){break inf_leave;}
copy=_out-left;if(state.offset>copy){copy=state.offset-copy;if(copy>state.whave){if(state.sane){strm.msg='invalid distance too far back';state.mode=BAD;break;}}
if(copy>state.wnext){copy-=state.wnext;from=state.wsize-copy;}
else{from=state.wnext-copy;}
if(copy>state.length){copy=state.length;}
from_source=state.window;}
else{from_source=output;from=put-state.offset;copy=state.length;}
if(copy>left){copy=left;}
left-=copy;state.length-=copy;do{output[put++]=from_source[from++];}while(--copy);if(state.length===0){state.mode=LEN;}
break;case LIT:if(left===0){break inf_leave;}
output[put++]=state.length;left--;state.mode=LEN;break;case CHECK:if(state.wrap){while(bits<32){if(have===0){break inf_leave;}
have--;hold|=input[next++]<<bits;bits+=8;}
_out-=left;strm.total_out+=_out;state.total+=_out;if(_out){strm.adler=state.check=(state.flags?crc32(state.check,output,_out,put-_out):adler32(state.check,output,_out,put-_out));}
_out=left;if((state.flags?hold:ZSWAP32(hold))!==state.check){strm.msg='incorrect data check';state.mode=BAD;break;}
hold=0;bits=0;}
state.mode=LENGTH;case LENGTH:if(state.wrap&&state.flags){while(bits<32){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if(hold!==(state.total&0xffffffff)){strm.msg='incorrect length check';state.mode=BAD;break;}
hold=0;bits=0;}
state.mode=DONE;case DONE:ret=Z_STREAM_END;break inf_leave;case BAD:ret=Z_DATA_ERROR;break inf_leave;case MEM:return Z_MEM_ERROR;case SYNC:default:return Z_STREAM_ERROR;}}
strm.next_out=put;strm.avail_out=left;strm.next_in=next;strm.avail_in=have;state.hold=hold;state.bits=bits;if(state.wsize||(_out!==strm.avail_out&&state.mode<BAD&&(state.mode<CHECK||flush!==Z_FINISH))){if(updatewindow(strm,strm.output,strm.next_out,_out-strm.avail_out)){state.mode=MEM;return Z_MEM_ERROR;}}
_in-=strm.avail_in;_out-=strm.avail_out;strm.total_in+=_in;strm.total_out+=_out;state.total+=_out;if(state.wrap&&_out){strm.adler=state.check=(state.flags?crc32(state.check,output,_out,strm.next_out-_out):adler32(state.check,output,_out,strm.next_out-_out));}
strm.data_type=state.bits+(state.last?64:0)+(state.mode===TYPE?128:0)+(state.mode===LEN_||state.mode===COPY_?256:0);if(((_in===0&&_out===0)||flush===Z_FINISH)&&ret===Z_OK){ret=Z_BUF_ERROR;}
return ret;}
function inflateEnd(strm){if(!strm||!strm.state){return Z_STREAM_ERROR;}
var state=strm.state;if(state.window){state.window=null;}
strm.state=null;return Z_OK;}
function inflateGetHeader(strm,head){var state;if(!strm||!strm.state){return Z_STREAM_ERROR;}
state=strm.state;if((state.wrap&2)===0){return Z_STREAM_ERROR;}
state.head=head;head.done=false;return Z_OK;}
exports.inflateReset=inflateReset;exports.inflateReset2=inflateReset2;exports.inflateResetKeep=inflateResetKeep;exports.inflateInit=inflateInit;exports.inflateInit2=inflateInit2;exports.inflate=inflate;exports.inflateEnd=inflateEnd;exports.inflateGetHeader=inflateGetHeader;exports.inflateInfo='pako inflate (from Nodeca project)';},{"../utils/common":27,"./adler32":29,"./crc32":31,"./inffast":34,"./inftrees":36}],36:[function(_dereq_,module,exports){'use strict';var utils=_dereq_('../utils/common');var MAXBITS=15;var ENOUGH_LENS=852;var ENOUGH_DISTS=592;var CODES=0;var LENS=1;var DISTS=2;var lbase=[3,4,5,6,7,8,9,10,11,13,15,17,19,23,27,31,35,43,51,59,67,83,99,115,131,163,195,227,258,0,0];var lext=[16,16,16,16,16,16,16,16,17,17,17,17,18,18,18,18,19,19,19,19,20,20,20,20,21,21,21,21,16,72,78];var dbase=[1,2,3,4,5,7,9,13,17,25,33,49,65,97,129,193,257,385,513,769,1025,1537,2049,3073,4097,6145,8193,12289,16385,24577,0,0];var dext=[16,16,16,16,17,17,18,18,19,19,20,20,21,21,22,22,23,23,24,24,25,25,26,26,27,27,28,28,29,29,64,64];module.exports=function inflate_table(type,lens,lens_index,codes,table,table_index,work,opts)
{var bits=opts.bits;var len=0;var sym=0;var min=0,max=0;var root=0;var curr=0;var drop=0;var left=0;var used=0;var huff=0;var incr;var fill;var low;var mask;var next;var base=null;var base_index=0;var end;var count=new utils.Buf16(MAXBITS+1);var offs=new utils.Buf16(MAXBITS+1);var extra=null;var extra_index=0;var here_bits,here_op,here_val;for(len=0;len<=MAXBITS;len++){count[len]=0;}
for(sym=0;sym<codes;sym++){count[lens[lens_index+sym]]++;}
root=bits;for(max=MAXBITS;max>=1;max--){if(count[max]!==0){break;}}
if(root>max){root=max;}
if(max===0){table[table_index++]=(1<<24)|(64<<16)|0;table[table_index++]=(1<<24)|(64<<16)|0;opts.bits=1;return 0;}
for(min=1;min<max;min++){if(count[min]!==0){break;}}
if(root<min){root=min;}
left=1;for(len=1;len<=MAXBITS;len++){left<<=1;left-=count[len];if(left<0){return-1;}}
if(left>0&&(type===CODES||max!==1)){return-1;}
offs[1]=0;for(len=1;len<MAXBITS;len++){offs[len+1]=offs[len]+count[len];}
for(sym=0;sym<codes;sym++){if(lens[lens_index+sym]!==0){work[offs[lens[lens_index+sym]]++]=sym;}}
if(type===CODES){base=extra=work;end=19;}else if(type===LENS){base=lbase;base_index-=257;extra=lext;extra_index-=257;end=256;}else{base=dbase;extra=dext;end=-1;}
huff=0;sym=0;len=min;next=table_index;curr=root;drop=0;low=-1;used=1<<root;mask=used-1;if((type===LENS&&used>ENOUGH_LENS)||(type===DISTS&&used>ENOUGH_DISTS)){return 1;}
var i=0;for(;;){i++;here_bits=len-drop;if(work[sym]<end){here_op=0;here_val=work[sym];}
else if(work[sym]>end){here_op=extra[extra_index+work[sym]];here_val=base[base_index+work[sym]];}
else{here_op=32+64;here_val=0;}
incr=1<<(len-drop);fill=1<<curr;min=fill;do{fill-=incr;table[next+(huff>>drop)+fill]=(here_bits<<24)|(here_op<<16)|here_val|0;}while(fill!==0);incr=1<<(len-1);while(huff&incr){incr>>=1;}
if(incr!==0){huff&=incr-1;huff+=incr;}else{huff=0;}
sym++;if(--count[len]===0){if(len===max){break;}
len=lens[lens_index+work[sym]];}
if(len>root&&(huff&mask)!==low){if(drop===0){drop=root;}
next+=min;curr=len-drop;left=1<<curr;while(curr+drop<max){left-=count[curr+drop];if(left<=0){break;}
curr++;left<<=1;}
used+=1<<curr;if((type===LENS&&used>ENOUGH_LENS)||(type===DISTS&&used>ENOUGH_DISTS)){return 1;}
low=huff&mask;table[low]=(root<<24)|(curr<<16)|(next-table_index)|0;}}
if(huff!==0){table[next+huff]=((len-drop)<<24)|(64<<16)|0;}
opts.bits=root;return 0;};},{"../utils/common":27}],37:[function(_dereq_,module,exports){'use strict';module.exports={'2':'need dictionary','1':'stream end','0':'','-1':'file error','-2':'stream error','-3':'data error','-4':'insufficient memory','-5':'buffer error','-6':'incompatible version'};},{}],38:[function(_dereq_,module,exports){'use strict';var utils=_dereq_('../utils/common');var Z_FIXED=4;var Z_BINARY=0;var Z_TEXT=1;var Z_UNKNOWN=2;function zero(buf){var len=buf.length;while(--len>=0){buf[len]=0;}}
var STORED_BLOCK=0;var STATIC_TREES=1;var DYN_TREES=2;var MIN_MATCH=3;var MAX_MATCH=258;var LENGTH_CODES=29;var LITERALS=256;var L_CODES=LITERALS+1+LENGTH_CODES;var D_CODES=30;var BL_CODES=19;var HEAP_SIZE=2*L_CODES+1;var MAX_BITS=15;var Buf_size=16;var MAX_BL_BITS=7;var END_BLOCK=256;var REP_3_6=16;var REPZ_3_10=17;var REPZ_11_138=18;var extra_lbits=[0,0,0,0,0,0,0,0,1,1,1,1,2,2,2,2,3,3,3,3,4,4,4,4,5,5,5,5,0];var extra_dbits=[0,0,0,0,1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,9,10,10,11,11,12,12,13,13];var extra_blbits=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,3,7];var bl_order=[16,17,18,0,8,7,9,6,10,5,11,4,12,3,13,2,14,1,15];var DIST_CODE_LEN=512;var static_ltree=new Array((L_CODES+2)*2);zero(static_ltree);var static_dtree=new Array(D_CODES*2);zero(static_dtree);var _dist_code=new Array(DIST_CODE_LEN);zero(_dist_code);var _length_code=new Array(MAX_MATCH-MIN_MATCH+1);zero(_length_code);var base_length=new Array(LENGTH_CODES);zero(base_length);var base_dist=new Array(D_CODES);zero(base_dist);var StaticTreeDesc=function(static_tree,extra_bits,extra_base,elems,max_length){this.static_tree=static_tree;this.extra_bits=extra_bits;this.extra_base=extra_base;this.elems=elems;this.max_length=max_length;this.has_stree=static_tree&&static_tree.length;};var static_l_desc;var static_d_desc;var static_bl_desc;var TreeDesc=function(dyn_tree,stat_desc){this.dyn_tree=dyn_tree;this.max_code=0;this.stat_desc=stat_desc;};function d_code(dist){return dist<256?_dist_code[dist]:_dist_code[256+(dist>>>7)];}
function put_short(s,w){s.pending_buf[s.pending++]=(w)&0xff;s.pending_buf[s.pending++]=(w>>>8)&0xff;}
function send_bits(s,value,length){if(s.bi_valid>(Buf_size-length)){s.bi_buf|=(value<<s.bi_valid)&0xffff;put_short(s,s.bi_buf);s.bi_buf=value>>(Buf_size-s.bi_valid);s.bi_valid+=length-Buf_size;}else{s.bi_buf|=(value<<s.bi_valid)&0xffff;s.bi_valid+=length;}}
function send_code(s,c,tree){send_bits(s,tree[c*2],tree[c*2+1]);}
function bi_reverse(code,len){var res=0;do{res|=code&1;code>>>=1;res<<=1;}while(--len>0);return res>>>1;}
function bi_flush(s){if(s.bi_valid===16){put_short(s,s.bi_buf);s.bi_buf=0;s.bi_valid=0;}else if(s.bi_valid>=8){s.pending_buf[s.pending++]=s.bi_buf&0xff;s.bi_buf>>=8;s.bi_valid-=8;}}
function gen_bitlen(s,desc)
{var tree=desc.dyn_tree;var max_code=desc.max_code;var stree=desc.stat_desc.static_tree;var has_stree=desc.stat_desc.has_stree;var extra=desc.stat_desc.extra_bits;var base=desc.stat_desc.extra_base;var max_length=desc.stat_desc.max_length;var h;var n,m;var bits;var xbits;var f;var overflow=0;for(bits=0;bits<=MAX_BITS;bits++){s.bl_count[bits]=0;}
tree[s.heap[s.heap_max]*2+1]=0;for(h=s.heap_max+1;h<HEAP_SIZE;h++){n=s.heap[h];bits=tree[tree[n*2+1]*2+1]+1;if(bits>max_length){bits=max_length;overflow++;}
tree[n*2+1]=bits;if(n>max_code){continue;}
s.bl_count[bits]++;xbits=0;if(n>=base){xbits=extra[n-base];}
f=tree[n*2];s.opt_len+=f*(bits+xbits);if(has_stree){s.static_len+=f*(stree[n*2+1]+xbits);}}
if(overflow===0){return;}
do{bits=max_length-1;while(s.bl_count[bits]===0){bits--;}
s.bl_count[bits]--;s.bl_count[bits+1]+=2;s.bl_count[max_length]--;overflow-=2;}while(overflow>0);for(bits=max_length;bits!==0;bits--){n=s.bl_count[bits];while(n!==0){m=s.heap[--h];if(m>max_code){continue;}
if(tree[m*2+1]!==bits){s.opt_len+=(bits-tree[m*2+1])*tree[m*2];tree[m*2+1]=bits;}
n--;}}}
function gen_codes(tree,max_code,bl_count)
{var next_code=new Array(MAX_BITS+1);var code=0;var bits;var n;for(bits=1;bits<=MAX_BITS;bits++){next_code[bits]=code=(code+bl_count[bits-1])<<1;}
for(n=0;n<=max_code;n++){var len=tree[n*2+1];if(len===0){continue;}
tree[n*2]=bi_reverse(next_code[len]++,len);}}
function tr_static_init(){var n;var bits;var length;var code;var dist;var bl_count=new Array(MAX_BITS+1);length=0;for(code=0;code<LENGTH_CODES-1;code++){base_length[code]=length;for(n=0;n<(1<<extra_lbits[code]);n++){_length_code[length++]=code;}}
_length_code[length-1]=code;dist=0;for(code=0;code<16;code++){base_dist[code]=dist;for(n=0;n<(1<<extra_dbits[code]);n++){_dist_code[dist++]=code;}}
dist>>=7;for(;code<D_CODES;code++){base_dist[code]=dist<<7;for(n=0;n<(1<<(extra_dbits[code]-7));n++){_dist_code[256+dist++]=code;}}
for(bits=0;bits<=MAX_BITS;bits++){bl_count[bits]=0;}
n=0;while(n<=143){static_ltree[n*2+1]=8;n++;bl_count[8]++;}
while(n<=255){static_ltree[n*2+1]=9;n++;bl_count[9]++;}
while(n<=279){static_ltree[n*2+1]=7;n++;bl_count[7]++;}
while(n<=287){static_ltree[n*2+1]=8;n++;bl_count[8]++;}
gen_codes(static_ltree,L_CODES+1,bl_count);for(n=0;n<D_CODES;n++){static_dtree[n*2+1]=5;static_dtree[n*2]=bi_reverse(n,5);}
static_l_desc=new StaticTreeDesc(static_ltree,extra_lbits,LITERALS+1,L_CODES,MAX_BITS);static_d_desc=new StaticTreeDesc(static_dtree,extra_dbits,0,D_CODES,MAX_BITS);static_bl_desc=new StaticTreeDesc(new Array(0),extra_blbits,0,BL_CODES,MAX_BL_BITS);}
function init_block(s){var n;for(n=0;n<L_CODES;n++){s.dyn_ltree[n*2]=0;}
for(n=0;n<D_CODES;n++){s.dyn_dtree[n*2]=0;}
for(n=0;n<BL_CODES;n++){s.bl_tree[n*2]=0;}
s.dyn_ltree[END_BLOCK*2]=1;s.opt_len=s.static_len=0;s.last_lit=s.matches=0;}
function bi_windup(s)
{if(s.bi_valid>8){put_short(s,s.bi_buf);}else if(s.bi_valid>0){s.pending_buf[s.pending++]=s.bi_buf;}
s.bi_buf=0;s.bi_valid=0;}
function copy_block(s,buf,len,header)
{bi_windup(s);if(header){put_short(s,len);put_short(s,~len);}
utils.arraySet(s.pending_buf,s.window,buf,len,s.pending);s.pending+=len;}
function smaller(tree,n,m,depth){var _n2=n*2;var _m2=m*2;return(tree[_n2]<tree[_m2]||(tree[_n2]===tree[_m2]&&depth[n]<=depth[m]));}
function pqdownheap(s,tree,k)
{var v=s.heap[k];var j=k<<1;while(j<=s.heap_len){if(j<s.heap_len&&smaller(tree,s.heap[j+1],s.heap[j],s.depth)){j++;}
if(smaller(tree,v,s.heap[j],s.depth)){break;}
s.heap[k]=s.heap[j];k=j;j<<=1;}
s.heap[k]=v;}
function compress_block(s,ltree,dtree)
{var dist;var lc;var lx=0;var code;var extra;if(s.last_lit!==0){do{dist=(s.pending_buf[s.d_buf+lx*2]<<8)|(s.pending_buf[s.d_buf+lx*2+1]);lc=s.pending_buf[s.l_buf+lx];lx++;if(dist===0){send_code(s,lc,ltree);}else{code=_length_code[lc];send_code(s,code+LITERALS+1,ltree);extra=extra_lbits[code];if(extra!==0){lc-=base_length[code];send_bits(s,lc,extra);}
dist--;code=d_code(dist);send_code(s,code,dtree);extra=extra_dbits[code];if(extra!==0){dist-=base_dist[code];send_bits(s,dist,extra);}}}while(lx<s.last_lit);}
send_code(s,END_BLOCK,ltree);}
function build_tree(s,desc)
{var tree=desc.dyn_tree;var stree=desc.stat_desc.static_tree;var has_stree=desc.stat_desc.has_stree;var elems=desc.stat_desc.elems;var n,m;var max_code=-1;var node;s.heap_len=0;s.heap_max=HEAP_SIZE;for(n=0;n<elems;n++){if(tree[n*2]!==0){s.heap[++s.heap_len]=max_code=n;s.depth[n]=0;}else{tree[n*2+1]=0;}}
while(s.heap_len<2){node=s.heap[++s.heap_len]=(max_code<2?++max_code:0);tree[node*2]=1;s.depth[node]=0;s.opt_len--;if(has_stree){s.static_len-=stree[node*2+1];}}
desc.max_code=max_code;for(n=(s.heap_len>>1);n>=1;n--){pqdownheap(s,tree,n);}
node=elems;do{n=s.heap[1];s.heap[1]=s.heap[s.heap_len--];pqdownheap(s,tree,1);m=s.heap[1];s.heap[--s.heap_max]=n;s.heap[--s.heap_max]=m;tree[node*2]=tree[n*2]+tree[m*2];s.depth[node]=(s.depth[n]>=s.depth[m]?s.depth[n]:s.depth[m])+1;tree[n*2+1]=tree[m*2+1]=node;s.heap[1]=node++;pqdownheap(s,tree,1);}while(s.heap_len>=2);s.heap[--s.heap_max]=s.heap[1];gen_bitlen(s,desc);gen_codes(tree,max_code,s.bl_count);}
function scan_tree(s,tree,max_code)
{var n;var prevlen=-1;var curlen;var nextlen=tree[0*2+1];var count=0;var max_count=7;var min_count=4;if(nextlen===0){max_count=138;min_count=3;}
tree[(max_code+1)*2+1]=0xffff;for(n=0;n<=max_code;n++){curlen=nextlen;nextlen=tree[(n+1)*2+1];if(++count<max_count&&curlen===nextlen){continue;}else if(count<min_count){s.bl_tree[curlen*2]+=count;}else if(curlen!==0){if(curlen!==prevlen){s.bl_tree[curlen*2]++;}
s.bl_tree[REP_3_6*2]++;}else if(count<=10){s.bl_tree[REPZ_3_10*2]++;}else{s.bl_tree[REPZ_11_138*2]++;}
count=0;prevlen=curlen;if(nextlen===0){max_count=138;min_count=3;}else if(curlen===nextlen){max_count=6;min_count=3;}else{max_count=7;min_count=4;}}}
function send_tree(s,tree,max_code)
{var n;var prevlen=-1;var curlen;var nextlen=tree[0*2+1];var count=0;var max_count=7;var min_count=4;if(nextlen===0){max_count=138;min_count=3;}
for(n=0;n<=max_code;n++){curlen=nextlen;nextlen=tree[(n+1)*2+1];if(++count<max_count&&curlen===nextlen){continue;}else if(count<min_count){do{send_code(s,curlen,s.bl_tree);}while(--count!==0);}else if(curlen!==0){if(curlen!==prevlen){send_code(s,curlen,s.bl_tree);count--;}
send_code(s,REP_3_6,s.bl_tree);send_bits(s,count-3,2);}else if(count<=10){send_code(s,REPZ_3_10,s.bl_tree);send_bits(s,count-3,3);}else{send_code(s,REPZ_11_138,s.bl_tree);send_bits(s,count-11,7);}
count=0;prevlen=curlen;if(nextlen===0){max_count=138;min_count=3;}else if(curlen===nextlen){max_count=6;min_count=3;}else{max_count=7;min_count=4;}}}
function build_bl_tree(s){var max_blindex;scan_tree(s,s.dyn_ltree,s.l_desc.max_code);scan_tree(s,s.dyn_dtree,s.d_desc.max_code);build_tree(s,s.bl_desc);for(max_blindex=BL_CODES-1;max_blindex>=3;max_blindex--){if(s.bl_tree[bl_order[max_blindex]*2+1]!==0){break;}}
s.opt_len+=3*(max_blindex+1)+5+5+4;return max_blindex;}
function send_all_trees(s,lcodes,dcodes,blcodes)
{var rank;send_bits(s,lcodes-257,5);send_bits(s,dcodes-1,5);send_bits(s,blcodes-4,4);for(rank=0;rank<blcodes;rank++){send_bits(s,s.bl_tree[bl_order[rank]*2+1],3);}
send_tree(s,s.dyn_ltree,lcodes-1);send_tree(s,s.dyn_dtree,dcodes-1);}
function detect_data_type(s){var black_mask=0xf3ffc07f;var n;for(n=0;n<=31;n++,black_mask>>>=1){if((black_mask&1)&&(s.dyn_ltree[n*2]!==0)){return Z_BINARY;}}
if(s.dyn_ltree[9*2]!==0||s.dyn_ltree[10*2]!==0||s.dyn_ltree[13*2]!==0){return Z_TEXT;}
for(n=32;n<LITERALS;n++){if(s.dyn_ltree[n*2]!==0){return Z_TEXT;}}
return Z_BINARY;}
var static_init_done=false;function _tr_init(s)
{if(!static_init_done){tr_static_init();static_init_done=true;}
s.l_desc=new TreeDesc(s.dyn_ltree,static_l_desc);s.d_desc=new TreeDesc(s.dyn_dtree,static_d_desc);s.bl_desc=new TreeDesc(s.bl_tree,static_bl_desc);s.bi_buf=0;s.bi_valid=0;init_block(s);}
function _tr_stored_block(s,buf,stored_len,last)
{send_bits(s,(STORED_BLOCK<<1)+(last?1:0),3);copy_block(s,buf,stored_len,true);}
function _tr_align(s){send_bits(s,STATIC_TREES<<1,3);send_code(s,END_BLOCK,static_ltree);bi_flush(s);}
function _tr_flush_block(s,buf,stored_len,last)
{var opt_lenb,static_lenb;var max_blindex=0;if(s.level>0){if(s.strm.data_type===Z_UNKNOWN){s.strm.data_type=detect_data_type(s);}
build_tree(s,s.l_desc);build_tree(s,s.d_desc);max_blindex=build_bl_tree(s);opt_lenb=(s.opt_len+3+7)>>>3;static_lenb=(s.static_len+3+7)>>>3;if(static_lenb<=opt_lenb){opt_lenb=static_lenb;}}else{opt_lenb=static_lenb=stored_len+5;}
if((stored_len+4<=opt_lenb)&&(buf!==-1)){_tr_stored_block(s,buf,stored_len,last);}else if(s.strategy===Z_FIXED||static_lenb===opt_lenb){send_bits(s,(STATIC_TREES<<1)+(last?1:0),3);compress_block(s,static_ltree,static_dtree);}else{send_bits(s,(DYN_TREES<<1)+(last?1:0),3);send_all_trees(s,s.l_desc.max_code+1,s.d_desc.max_code+1,max_blindex+1);compress_block(s,s.dyn_ltree,s.dyn_dtree);}
init_block(s);if(last){bi_windup(s);}}
function _tr_tally(s,dist,lc)
{s.pending_buf[s.d_buf+s.last_lit*2]=(dist>>>8)&0xff;s.pending_buf[s.d_buf+s.last_lit*2+1]=dist&0xff;s.pending_buf[s.l_buf+s.last_lit]=lc&0xff;s.last_lit++;if(dist===0){s.dyn_ltree[lc*2]++;}else{s.matches++;dist--;s.dyn_ltree[(_length_code[lc]+LITERALS+1)*2]++;s.dyn_dtree[d_code(dist)*2]++;}
return(s.last_lit===s.lit_bufsize-1);}
exports._tr_init=_tr_init;exports._tr_stored_block=_tr_stored_block;exports._tr_flush_block=_tr_flush_block;exports._tr_tally=_tr_tally;exports._tr_align=_tr_align;},{"../utils/common":27}],39:[function(_dereq_,module,exports){'use strict';function ZStream(){this.input=null;this.next_in=0;this.avail_in=0;this.total_in=0;this.output=null;this.next_out=0;this.avail_out=0;this.total_out=0;this.msg='';this.state=null;this.data_type=2;this.adler=0;}
module.exports=ZStream;},{}]},{},[9])(9)});(function(modules){var installedModules={};function __webpack_require__(moduleId){if(installedModules[moduleId])
return installedModules[moduleId].exports;var module=installedModules[moduleId]={exports:{},id:moduleId,loaded:false};modules[moduleId].call(module.exports,module,module.exports,__webpack_require__);module.loaded=true;return module.exports;}
__webpack_require__.m=modules;__webpack_require__.c=installedModules;__webpack_require__.p="";return __webpack_require__(0);})([function(module,exports,__webpack_require__){(function(global){module.exports=global["pdfMake"]=__webpack_require__(1);}.call(exports,(function(){return this;}())))},function(module,exports,__webpack_require__){(function(Buffer){'use strict';var PdfPrinter=__webpack_require__(2);var saveAs=__webpack_require__(3);var defaultClientFonts={Roboto:{normal:'Roboto-Regular.ttf',bold:'Roboto-Medium.ttf',italics:'Roboto-Italic.ttf',bolditalics:'Roboto-Italic.ttf'}};function Document(docDefinition,fonts,vfs){this.docDefinition=docDefinition;this.fonts=fonts||defaultClientFonts;this.vfs=vfs;}
Document.prototype._createDoc=function(options,callback){var printer=new PdfPrinter(this.fonts);printer.fs.bindFS(this.vfs);var doc=printer.createPdfKitDocument(this.docDefinition,options);var chunks=[];var result;doc.on('data',function(chunk){chunks.push(chunk);});doc.on('end',function(){result=Buffer.concat(chunks);callback(result,doc._pdfMakePages);});doc.end();};Document.prototype._getPages=function(options,cb){if(!cb)throw'getBuffer is an async method and needs a callback argument';this._createDoc(options,function(ignoreBuffer,pages){cb(pages);});};Document.prototype.open=function(message){var win=window.open('','_blank');try{this.getDataUrl(function(result){win.location.href=result;});}catch(e){win.close();throw e;}};Document.prototype.print=function(){this.getDataUrl(function(dataUrl){var iFrame=document.createElement('iframe');iFrame.style.position='absolute';iFrame.style.left='-99999px';iFrame.src=dataUrl;iFrame.onload=function(){function removeIFrame(){document.body.removeChild(iFrame);document.removeEventListener('click',removeIFrame);}
document.addEventListener('click',removeIFrame,false);};document.body.appendChild(iFrame);},{autoPrint:true});};Document.prototype.download=function(defaultFileName,cb){if(typeof defaultFileName==="function"){cb=defaultFileName;defaultFileName=null;}
defaultFileName=defaultFileName||'file.pdf';this.getBuffer(function(result){saveAs(new Blob([result],{type:'application/pdf'}),defaultFileName);if(typeof cb==="function"){cb();}});};Document.prototype.getBase64=function(cb,options){if(!cb)throw'getBase64 is an async method and needs a callback argument';this._createDoc(options,function(buffer){cb(buffer.toString('base64'));});};Document.prototype.getDataUrl=function(cb,options){if(!cb)throw'getDataUrl is an async method and needs a callback argument';this._createDoc(options,function(buffer){cb('data:application/pdf;base64,'+buffer.toString('base64'));});};Document.prototype.getBuffer=function(cb,options){if(!cb)throw'getBuffer is an async method and needs a callback argument';this._createDoc(options,function(buffer){cb(buffer);});};module.exports={createPdf:function(docDefinition){return new Document(docDefinition,window.pdfMake.fonts,window.pdfMake.vfs);}};}.call(exports,__webpack_require__(4).Buffer))},function(module,exports,__webpack_require__){'use strict';var _=__webpack_require__(11);var FontProvider=__webpack_require__(5);var LayoutBuilder=__webpack_require__(6);var PdfKit=__webpack_require__(28);var PDFReference=__webpack_require__(12);var sizes=__webpack_require__(7);var ImageMeasure=__webpack_require__(8);var textDecorator=__webpack_require__(9);var FontProvider=__webpack_require__(5);function PdfPrinter(fontDescriptors){this.fontDescriptors=fontDescriptors;}
PdfPrinter.prototype.createPdfKitDocument=function(docDefinition,options){options=options||{};var pageSize=pageSize2widthAndHeight(docDefinition.pageSize||'a4');if(docDefinition.pageOrientation==='landscape'){pageSize={width:pageSize.height,height:pageSize.width};}
pageSize.orientation=docDefinition.pageOrientation==='landscape'?docDefinition.pageOrientation:'portrait';this.pdfKitDoc=new PdfKit({size:[pageSize.width,pageSize.height],compress:false});this.pdfKitDoc.info.Producer='pdfmake';this.pdfKitDoc.info.Creator='pdfmake';this.fontProvider=new FontProvider(this.fontDescriptors,this.pdfKitDoc);docDefinition.images=docDefinition.images||{};var builder=new LayoutBuilder(pageSize,fixPageMargins(docDefinition.pageMargins||40),new ImageMeasure(this.pdfKitDoc,docDefinition.images));registerDefaultTableLayouts(builder);if(options.tableLayouts){builder.registerTableLayouts(options.tableLayouts);}
var pages=builder.layoutDocument(docDefinition.content,this.fontProvider,docDefinition.styles||{},docDefinition.defaultStyle||{fontSize:12,font:'Roboto'},docDefinition.background,docDefinition.header,docDefinition.footer,docDefinition.images,docDefinition.watermark,docDefinition.pageBreakBefore);renderPages(pages,this.fontProvider,this.pdfKitDoc);if(options.autoPrint){var jsRef=this.pdfKitDoc.ref({S:'JavaScript',JS:new StringObject('this.print\\(true\\);')});var namesRef=this.pdfKitDoc.ref({Names:[new StringObject('EmbeddedJS'),new PDFReference(this.pdfKitDoc,jsRef.id)],});jsRef.end();namesRef.end();this.pdfKitDoc._root.data.Names={JavaScript:new PDFReference(this.pdfKitDoc,namesRef.id)};}
return this.pdfKitDoc;};function fixPageMargins(margin){if(!margin)return null;if(typeof margin==='number'||margin instanceof Number){margin={left:margin,right:margin,top:margin,bottom:margin};}else if(margin instanceof Array){if(margin.length===2){margin={left:margin[0],top:margin[1],right:margin[0],bottom:margin[1]};}else if(margin.length===4){margin={left:margin[0],top:margin[1],right:margin[2],bottom:margin[3]};}else throw'Invalid pageMargins definition';}
return margin;}
function registerDefaultTableLayouts(layoutBuilder){layoutBuilder.registerTableLayouts({noBorders:{hLineWidth:function(i){return 0;},vLineWidth:function(i){return 0;},paddingLeft:function(i){return i&&4||0;},paddingRight:function(i,node){return(i<node.table.widths.length-1)?4:0;},},headerLineOnly:{hLineWidth:function(i,node){if(i===0||i===node.table.body.length)return 0;return(i===node.table.headerRows)?2:0;},vLineWidth:function(i){return 0;},paddingLeft:function(i){return i===0?0:8;},paddingRight:function(i,node){return(i===node.table.widths.length-1)?0:8;}},lightHorizontalLines:{hLineWidth:function(i,node){if(i===0||i===node.table.body.length)return 0;return(i===node.table.headerRows)?2:1;},vLineWidth:function(i){return 0;},hLineColor:function(i){return i===1?'black':'#aaa';},paddingLeft:function(i){return i===0?0:8;},paddingRight:function(i,node){return(i===node.table.widths.length-1)?0:8;}}});}
var defaultLayout={hLineWidth:function(i,node){return 1;},vLineWidth:function(i,node){return 1;},hLineColor:function(i,node){return'black';},vLineColor:function(i,node){return'black';},paddingLeft:function(i,node){return 4;},paddingRight:function(i,node){return 4;},paddingTop:function(i,node){return 2;},paddingBottom:function(i,node){return 2;}};function pageSize2widthAndHeight(pageSize){if(typeof pageSize=='string'||pageSize instanceof String){var size=sizes[pageSize.toUpperCase()];if(!size)throw('Page size '+pageSize+' not recognized');return{width:size[0],height:size[1]};}
return pageSize;}
function StringObject(str){this.isString=true;this.toString=function(){return str;};}
function updatePageOrientationInOptions(currentPage,pdfKitDoc){var previousPageOrientation=pdfKitDoc.options.size[0]>pdfKitDoc.options.size[1]?'landscape':'portrait';if(currentPage.pageSize.orientation!==previousPageOrientation){var width=pdfKitDoc.options.size[0];var height=pdfKitDoc.options.size[1];pdfKitDoc.options.size=[height,width];}}
function renderPages(pages,fontProvider,pdfKitDoc){pdfKitDoc._pdfMakePages=pages;for(var i=0;i<pages.length;i++){if(i>0){updatePageOrientationInOptions(pages[i],pdfKitDoc);pdfKitDoc.addPage(pdfKitDoc.options);}
var page=pages[i];for(var ii=0,il=page.items.length;ii<il;ii++){var item=page.items[ii];switch(item.type){case'vector':renderVector(item.item,pdfKitDoc);break;case'line':renderLine(item.item,item.item.x,item.item.y,pdfKitDoc);break;case'image':renderImage(item.item,item.item.x,item.item.y,pdfKitDoc);break;}}
if(page.watermark){renderWatermark(page,pdfKitDoc);}
fontProvider.setFontRefsToPdfDoc();}}
function renderLine(line,x,y,pdfKitDoc){x=x||0;y=y||0;var ascenderHeight=line.getAscenderHeight();textDecorator.drawBackground(line,x,y,pdfKitDoc);for(var i=0,l=line.inlines.length;i<l;i++){var inline=line.inlines[i];pdfKitDoc.fill(inline.color||'black');pdfKitDoc.save();pdfKitDoc.transform(1,0,0,-1,0,pdfKitDoc.page.height);var encoded=inline.font.encode(inline.text);pdfKitDoc.addContent('BT');pdfKitDoc.addContent(''+(x+inline.x)+' '+(pdfKitDoc.page.height-y-ascenderHeight)+' Td');pdfKitDoc.addContent('/'+encoded.fontId+' '+inline.fontSize+' Tf');pdfKitDoc.addContent('<'+encoded.encodedText+'> Tj');pdfKitDoc.addContent('ET');pdfKitDoc.restore();}
textDecorator.drawDecorations(line,x,y,pdfKitDoc);}
function renderWatermark(page,pdfKitDoc){var watermark=page.watermark;pdfKitDoc.fill('black');pdfKitDoc.opacity(0.6);pdfKitDoc.save();pdfKitDoc.transform(1,0,0,-1,0,pdfKitDoc.page.height);var angle=Math.atan2(pdfKitDoc.page.height,pdfKitDoc.page.width)*180/Math.PI;pdfKitDoc.rotate(angle,{origin:[pdfKitDoc.page.width/2,pdfKitDoc.page.height/2]});var encoded=watermark.font.encode(watermark.text);pdfKitDoc.addContent('BT');pdfKitDoc.addContent(''+(pdfKitDoc.page.width/2-watermark.size.size.width/2)+' '+(pdfKitDoc.page.height/2-watermark.size.size.height/4)+' Td');pdfKitDoc.addContent('/'+encoded.fontId+' '+watermark.size.fontSize+' Tf');pdfKitDoc.addContent('<'+encoded.encodedText+'> Tj');pdfKitDoc.addContent('ET');pdfKitDoc.restore();}
function renderVector(vector,pdfDoc){pdfDoc.lineWidth(vector.lineWidth||1);if(vector.dash){pdfDoc.dash(vector.dash.length,{space:vector.dash.space||vector.dash.length});}else{pdfDoc.undash();}
pdfDoc.fillOpacity(vector.fillOpacity||1);pdfDoc.strokeOpacity(vector.strokeOpacity||1);pdfDoc.lineJoin(vector.lineJoin||'miter');switch(vector.type){case'ellipse':pdfDoc.ellipse(vector.x,vector.y,vector.r1,vector.r2);break;case'rect':if(vector.r){pdfDoc.roundedRect(vector.x,vector.y,vector.w,vector.h,vector.r);}else{pdfDoc.rect(vector.x,vector.y,vector.w,vector.h);}
break;case'line':pdfDoc.moveTo(vector.x1,vector.y1);pdfDoc.lineTo(vector.x2,vector.y2);break;case'polyline':if(vector.points.length===0)break;pdfDoc.moveTo(vector.points[0].x,vector.points[0].y);for(var i=1,l=vector.points.length;i<l;i++){pdfDoc.lineTo(vector.points[i].x,vector.points[i].y);}
if(vector.points.length>1){var p1=vector.points[0];var pn=vector.points[vector.points.length-1];if(vector.closePath||p1.x===pn.x&&p1.y===pn.y){pdfDoc.closePath();}}
break;}
if(vector.color&&vector.lineColor){pdfDoc.fillAndStroke(vector.color,vector.lineColor);}else if(vector.color){pdfDoc.fill(vector.color);}else{pdfDoc.stroke(vector.lineColor||'black');}}
function renderImage(image,x,y,pdfKitDoc){pdfKitDoc.image(image.image,image.x,image.y,{width:image._width,height:image._height});}
module.exports=PdfPrinter;PdfPrinter.prototype.fs=__webpack_require__(10);},function(module,exports,__webpack_require__){var __WEBPACK_AMD_DEFINE_ARRAY__,__WEBPACK_AMD_DEFINE_RESULT__;(function(module){var saveAs=saveAs||(typeof navigator!=="undefined"&&navigator.msSaveOrOpenBlob&&navigator.msSaveOrOpenBlob.bind(navigator))||(function(view){"use strict";if(typeof navigator!=="undefined"&&/MSIE [1-9]\./.test(navigator.userAgent)){return;}
var
doc=view.document,get_URL=function(){return view.URL||view.webkitURL||view;},save_link=doc.createElementNS("http://www.w3.org/1999/xhtml","a"),can_use_save_link="download"in save_link,click=function(node){var event=doc.createEvent("MouseEvents");event.initMouseEvent("click",true,false,view,0,0,0,0,0,false,false,false,false,0,null);node.dispatchEvent(event);},webkit_req_fs=view.webkitRequestFileSystem,req_fs=view.requestFileSystem||webkit_req_fs||view.mozRequestFileSystem,throw_outside=function(ex){(view.setImmediate||view.setTimeout)(function(){throw ex;},0);},force_saveable_type="application/octet-stream",fs_min_size=0,arbitrary_revoke_timeout=10,revoke=function(file){var revoker=function(){if(typeof file==="string"){get_URL().revokeObjectURL(file);}else{file.remove();}};if(view.chrome){revoker();}else{setTimeout(revoker,arbitrary_revoke_timeout);}},dispatch=function(filesaver,event_types,event){event_types=[].concat(event_types);var i=event_types.length;while(i--){var listener=filesaver["on"+event_types[i]];if(typeof listener==="function"){try{listener.call(filesaver,event||filesaver);}catch(ex){throw_outside(ex);}}}},FileSaver=function(blob,name){var
filesaver=this,type=blob.type,blob_changed=false,object_url,target_view,dispatch_all=function(){dispatch(filesaver,"writestart progress write writeend".split(" "));},fs_error=function(){if(blob_changed||!object_url){object_url=get_URL().createObjectURL(blob);}
if(target_view){target_view.location.href=object_url;}else{var new_tab=view.open(object_url,"_blank");if(new_tab==undefined&&typeof safari!=="undefined"){view.location.href=object_url}}
filesaver.readyState=filesaver.DONE;dispatch_all();revoke(object_url);},abortable=function(func){return function(){if(filesaver.readyState!==filesaver.DONE){return func.apply(this,arguments);}};},create_if_not_found={create:true,exclusive:false},slice;filesaver.readyState=filesaver.INIT;if(!name){name="download";}
if(can_use_save_link){object_url=get_URL().createObjectURL(blob);save_link.href=object_url;save_link.download=name;click(save_link);filesaver.readyState=filesaver.DONE;dispatch_all();revoke(object_url);return;}
if(view.chrome&&type&&type!==force_saveable_type){slice=blob.slice||blob.webkitSlice;blob=slice.call(blob,0,blob.size,force_saveable_type);blob_changed=true;}
if(webkit_req_fs&&name!=="download"){name+=".download";}
if(type===force_saveable_type||webkit_req_fs){target_view=view;}
if(!req_fs){fs_error();return;}
fs_min_size+=blob.size;req_fs(view.TEMPORARY,fs_min_size,abortable(function(fs){fs.root.getDirectory("saved",create_if_not_found,abortable(function(dir){var save=function(){dir.getFile(name,create_if_not_found,abortable(function(file){file.createWriter(abortable(function(writer){writer.onwriteend=function(event){target_view.location.href=file.toURL();filesaver.readyState=filesaver.DONE;dispatch(filesaver,"writeend",event);revoke(file);};writer.onerror=function(){var error=writer.error;if(error.code!==error.ABORT_ERR){fs_error();}};"writestart progress write abort".split(" ").forEach(function(event){writer["on"+event]=filesaver["on"+event];});writer.write(blob);filesaver.abort=function(){writer.abort();filesaver.readyState=filesaver.DONE;};filesaver.readyState=filesaver.WRITING;}),fs_error);}),fs_error);};dir.getFile(name,{create:false},abortable(function(file){file.remove();save();}),abortable(function(ex){if(ex.code===ex.NOT_FOUND_ERR){save();}else{fs_error();}}));}),fs_error);}),fs_error);},FS_proto=FileSaver.prototype,saveAs=function(blob,name){return new FileSaver(blob,name);};FS_proto.abort=function(){var filesaver=this;filesaver.readyState=filesaver.DONE;dispatch(filesaver,"abort");};FS_proto.readyState=FS_proto.INIT=0;FS_proto.WRITING=1;FS_proto.DONE=2;FS_proto.error=FS_proto.onwritestart=FS_proto.onprogress=FS_proto.onwrite=FS_proto.onabort=FS_proto.onerror=FS_proto.onwriteend=null;return saveAs;}(typeof self!=="undefined"&&self||typeof window!=="undefined"&&window||this.content));if(typeof module!=="undefined"&&module!==null){module.exports=saveAs;}else if(("function"!=="undefined"&&__webpack_require__(13)!==null)&&(__webpack_require__(14)!=null)){!(__WEBPACK_AMD_DEFINE_ARRAY__=[],__WEBPACK_AMD_DEFINE_RESULT__=function(){return saveAs;}.apply(exports,__WEBPACK_AMD_DEFINE_ARRAY__),__WEBPACK_AMD_DEFINE_RESULT__!==undefined&&(module.exports=__WEBPACK_AMD_DEFINE_RESULT__));}}.call(exports,__webpack_require__(15)(module)))},function(module,exports,__webpack_require__){(function(Buffer){var base64=__webpack_require__(31)
var ieee754=__webpack_require__(29)
var isArray=__webpack_require__(30)
exports.Buffer=Buffer
exports.SlowBuffer=SlowBuffer
exports.INSPECT_MAX_BYTES=50
Buffer.poolSize=8192
var kMaxLength=0x3fffffff
var rootParent={}
Buffer.TYPED_ARRAY_SUPPORT=(function(){try{var buf=new ArrayBuffer(0)
var arr=new Uint8Array(buf)
arr.foo=function(){return 42}
return arr.foo()===42&&typeof arr.subarray==='function'&&new Uint8Array(1).subarray(1,1).byteLength===0}catch(e){return false}})()
function Buffer(arg){if(!(this instanceof Buffer)){if(arguments.length>1)return new Buffer(arg,arguments[1])
return new Buffer(arg)}
this.length=0
this.parent=undefined
if(typeof arg==='number'){return fromNumber(this,arg)}
if(typeof arg==='string'){return fromString(this,arg,arguments.length>1?arguments[1]:'utf8')}
return fromObject(this,arg)}
function fromNumber(that,length){that=allocate(that,length<0?0:checked(length)|0)
if(!Buffer.TYPED_ARRAY_SUPPORT){for(var i=0;i<length;i++){that[i]=0}}
return that}
function fromString(that,string,encoding){if(typeof encoding!=='string'||encoding==='')encoding='utf8'
var length=byteLength(string,encoding)|0
that=allocate(that,length)
that.write(string,encoding)
return that}
function fromObject(that,object){if(Buffer.isBuffer(object))return fromBuffer(that,object)
if(isArray(object))return fromArray(that,object)
if(object==null){throw new TypeError('must start with number, buffer, array or string')}
if(typeof ArrayBuffer!=='undefined'&&object.buffer instanceof ArrayBuffer){return fromTypedArray(that,object)}
if(object.length)return fromArrayLike(that,object)
return fromJsonObject(that,object)}
function fromBuffer(that,buffer){var length=checked(buffer.length)|0
that=allocate(that,length)
buffer.copy(that,0,0,length)
return that}
function fromArray(that,array){var length=checked(array.length)|0
that=allocate(that,length)
for(var i=0;i<length;i+=1){that[i]=array[i]&255}
return that}
function fromTypedArray(that,array){var length=checked(array.length)|0
that=allocate(that,length)
for(var i=0;i<length;i+=1){that[i]=array[i]&255}
return that}
function fromArrayLike(that,array){var length=checked(array.length)|0
that=allocate(that,length)
for(var i=0;i<length;i+=1){that[i]=array[i]&255}
return that}
function fromJsonObject(that,object){var array
var length=0
if(object.type==='Buffer'&&isArray(object.data)){array=object.data
length=checked(array.length)|0}
that=allocate(that,length)
for(var i=0;i<length;i+=1){that[i]=array[i]&255}
return that}
function allocate(that,length){if(Buffer.TYPED_ARRAY_SUPPORT){that=Buffer._augment(new Uint8Array(length))}else{that.length=length
that._isBuffer=true}
var fromPool=length!==0&&length<=Buffer.poolSize>>>1
if(fromPool)that.parent=rootParent
return that}
function checked(length){if(length>=kMaxLength){throw new RangeError('Attempt to allocate Buffer larger than maximum '+'size: 0x'+kMaxLength.toString(16)+' bytes')}
return length|0}
function SlowBuffer(subject,encoding){if(!(this instanceof SlowBuffer))return new SlowBuffer(subject,encoding)
var buf=new Buffer(subject,encoding)
delete buf.parent
return buf}
Buffer.isBuffer=function isBuffer(b){return!!(b!=null&&b._isBuffer)}
Buffer.compare=function compare(a,b){if(!Buffer.isBuffer(a)||!Buffer.isBuffer(b)){throw new TypeError('Arguments must be Buffers')}
if(a===b)return 0
var x=a.length
var y=b.length
var i=0
var len=Math.min(x,y)
while(i<len){if(a[i]!==b[i])break
++i}
if(i!==len){x=a[i]
y=b[i]}
if(x<y)return-1
if(y<x)return 1
return 0}
Buffer.isEncoding=function isEncoding(encoding){switch(String(encoding).toLowerCase()){case'hex':case'utf8':case'utf-8':case'ascii':case'binary':case'base64':case'raw':case'ucs2':case'ucs-2':case'utf16le':case'utf-16le':return true
default:return false}}
Buffer.concat=function concat(list,length){if(!isArray(list))throw new TypeError('list argument must be an Array of Buffers.')
if(list.length===0){return new Buffer(0)}else if(list.length===1){return list[0]}
var i
if(length===undefined){length=0
for(i=0;i<list.length;i++){length+=list[i].length}}
var buf=new Buffer(length)
var pos=0
for(i=0;i<list.length;i++){var item=list[i]
item.copy(buf,pos)
pos+=item.length}
return buf}
function byteLength(string,encoding){if(typeof string!=='string')string=String(string)
if(string.length===0)return 0
switch(encoding||'utf8'){case'ascii':case'binary':case'raw':return string.length
case'ucs2':case'ucs-2':case'utf16le':case'utf-16le':return string.length*2
case'hex':return string.length>>>1
case'utf8':case'utf-8':return utf8ToBytes(string).length
case'base64':return base64ToBytes(string).length
default:return string.length}}
Buffer.byteLength=byteLength
Buffer.prototype.length=undefined
Buffer.prototype.parent=undefined
Buffer.prototype.toString=function toString(encoding,start,end){var loweredCase=false
start=start|0
end=end===undefined||end===Infinity?this.length:end|0
if(!encoding)encoding='utf8'
if(start<0)start=0
if(end>this.length)end=this.length
if(end<=start)return''
while(true){switch(encoding){case'hex':return hexSlice(this,start,end)
case'utf8':case'utf-8':return utf8Slice(this,start,end)
case'ascii':return asciiSlice(this,start,end)
case'binary':return binarySlice(this,start,end)
case'base64':return base64Slice(this,start,end)
case'ucs2':case'ucs-2':case'utf16le':case'utf-16le':return utf16leSlice(this,start,end)
default:if(loweredCase)throw new TypeError('Unknown encoding: '+encoding)
encoding=(encoding+'').toLowerCase()
loweredCase=true}}}
Buffer.prototype.equals=function equals(b){if(!Buffer.isBuffer(b))throw new TypeError('Argument must be a Buffer')
if(this===b)return true
return Buffer.compare(this,b)===0}
Buffer.prototype.inspect=function inspect(){var str=''
var max=exports.INSPECT_MAX_BYTES
if(this.length>0){str=this.toString('hex',0,max).match(/.{2}/g).join(' ')
if(this.length>max)str+=' ... '}
return'<Buffer '+str+'>'}
Buffer.prototype.compare=function compare(b){if(!Buffer.isBuffer(b))throw new TypeError('Argument must be a Buffer')
if(this===b)return 0
return Buffer.compare(this,b)}
Buffer.prototype.indexOf=function indexOf(val,byteOffset){if(byteOffset>0x7fffffff)byteOffset=0x7fffffff
else if(byteOffset<-0x80000000)byteOffset=-0x80000000
byteOffset>>=0
if(this.length===0)return-1
if(byteOffset>=this.length)return-1
if(byteOffset<0)byteOffset=Math.max(this.length+byteOffset,0)
if(typeof val==='string'){if(val.length===0)return-1
return String.prototype.indexOf.call(this,val,byteOffset)}
if(Buffer.isBuffer(val)){return arrayIndexOf(this,val,byteOffset)}
if(typeof val==='number'){if(Buffer.TYPED_ARRAY_SUPPORT&&Uint8Array.prototype.indexOf==='function'){return Uint8Array.prototype.indexOf.call(this,val,byteOffset)}
return arrayIndexOf(this,[val],byteOffset)}
function arrayIndexOf(arr,val,byteOffset){var foundIndex=-1
for(var i=0;byteOffset+i<arr.length;i++){if(arr[byteOffset+i]===val[foundIndex===-1?0:i-foundIndex]){if(foundIndex===-1)foundIndex=i
if(i-foundIndex+1===val.length)return byteOffset+foundIndex}else{foundIndex=-1}}
return-1}
throw new TypeError('val must be string, number or Buffer')}
Buffer.prototype.get=function get(offset){console.log('.get() is deprecated. Access using array indexes instead.')
return this.readUInt8(offset)}
Buffer.prototype.set=function set(v,offset){console.log('.set() is deprecated. Access using array indexes instead.')
return this.writeUInt8(v,offset)}
function hexWrite(buf,string,offset,length){offset=Number(offset)||0
var remaining=buf.length-offset
if(!length){length=remaining}else{length=Number(length)
if(length>remaining){length=remaining}}
var strLen=string.length
if(strLen%2!==0)throw new Error('Invalid hex string')
if(length>strLen/2){length=strLen/2}
for(var i=0;i<length;i++){var parsed=parseInt(string.substr(i*2,2),16)
if(isNaN(parsed))throw new Error('Invalid hex string')
buf[offset+i]=parsed}
return i}
function utf8Write(buf,string,offset,length){return blitBuffer(utf8ToBytes(string,buf.length-offset),buf,offset,length)}
function asciiWrite(buf,string,offset,length){return blitBuffer(asciiToBytes(string),buf,offset,length)}
function binaryWrite(buf,string,offset,length){return asciiWrite(buf,string,offset,length)}
function base64Write(buf,string,offset,length){return blitBuffer(base64ToBytes(string),buf,offset,length)}
function ucs2Write(buf,string,offset,length){return blitBuffer(utf16leToBytes(string,buf.length-offset),buf,offset,length)}
Buffer.prototype.write=function write(string,offset,length,encoding){if(offset===undefined){encoding='utf8'
length=this.length
offset=0}else if(length===undefined&&typeof offset==='string'){encoding=offset
length=this.length
offset=0}else if(isFinite(offset)){offset=offset|0
if(isFinite(length)){length=length|0
if(encoding===undefined)encoding='utf8'}else{encoding=length
length=undefined}}else{var swap=encoding
encoding=offset
offset=length|0
length=swap}
var remaining=this.length-offset
if(length===undefined||length>remaining)length=remaining
if((string.length>0&&(length<0||offset<0))||offset>this.length){throw new RangeError('attempt to write outside buffer bounds')}
if(!encoding)encoding='utf8'
var loweredCase=false
for(;;){switch(encoding){case'hex':return hexWrite(this,string,offset,length)
case'utf8':case'utf-8':return utf8Write(this,string,offset,length)
case'ascii':return asciiWrite(this,string,offset,length)
case'binary':return binaryWrite(this,string,offset,length)
case'base64':return base64Write(this,string,offset,length)
case'ucs2':case'ucs-2':case'utf16le':case'utf-16le':return ucs2Write(this,string,offset,length)
default:if(loweredCase)throw new TypeError('Unknown encoding: '+encoding)
encoding=(''+encoding).toLowerCase()
loweredCase=true}}}
Buffer.prototype.toJSON=function toJSON(){return{type:'Buffer',data:Array.prototype.slice.call(this._arr||this,0)}}
function base64Slice(buf,start,end){if(start===0&&end===buf.length){return base64.fromByteArray(buf)}else{return base64.fromByteArray(buf.slice(start,end))}}
function utf8Slice(buf,start,end){var res=''
var tmp=''
end=Math.min(buf.length,end)
for(var i=start;i<end;i++){if(buf[i]<=0x7F){res+=decodeUtf8Char(tmp)+String.fromCharCode(buf[i])
tmp=''}else{tmp+='%'+buf[i].toString(16)}}
return res+decodeUtf8Char(tmp)}
function asciiSlice(buf,start,end){var ret=''
end=Math.min(buf.length,end)
for(var i=start;i<end;i++){ret+=String.fromCharCode(buf[i]&0x7F)}
return ret}
function binarySlice(buf,start,end){var ret=''
end=Math.min(buf.length,end)
for(var i=start;i<end;i++){ret+=String.fromCharCode(buf[i])}
return ret}
function hexSlice(buf,start,end){var len=buf.length
if(!start||start<0)start=0
if(!end||end<0||end>len)end=len
var out=''
for(var i=start;i<end;i++){out+=toHex(buf[i])}
return out}
function utf16leSlice(buf,start,end){var bytes=buf.slice(start,end)
var res=''
for(var i=0;i<bytes.length;i+=2){res+=String.fromCharCode(bytes[i]+bytes[i+1]*256)}
return res}
Buffer.prototype.slice=function slice(start,end){var len=this.length
start=~~start
end=end===undefined?len:~~end
if(start<0){start+=len
if(start<0)start=0}else if(start>len){start=len}
if(end<0){end+=len
if(end<0)end=0}else if(end>len){end=len}
if(end<start)end=start
var newBuf
if(Buffer.TYPED_ARRAY_SUPPORT){newBuf=Buffer._augment(this.subarray(start,end))}else{var sliceLen=end-start
newBuf=new Buffer(sliceLen,undefined)
for(var i=0;i<sliceLen;i++){newBuf[i]=this[i+start]}}
if(newBuf.length)newBuf.parent=this.parent||this
return newBuf}
function checkOffset(offset,ext,length){if((offset%1)!==0||offset<0)throw new RangeError('offset is not uint')
if(offset+ext>length)throw new RangeError('Trying to access beyond buffer length')}
Buffer.prototype.readUIntLE=function readUIntLE(offset,byteLength,noAssert){offset=offset|0
byteLength=byteLength|0
if(!noAssert)checkOffset(offset,byteLength,this.length)
var val=this[offset]
var mul=1
var i=0
while(++i<byteLength&&(mul*=0x100)){val+=this[offset+i]*mul}
return val}
Buffer.prototype.readUIntBE=function readUIntBE(offset,byteLength,noAssert){offset=offset|0
byteLength=byteLength|0
if(!noAssert){checkOffset(offset,byteLength,this.length)}
var val=this[offset+--byteLength]
var mul=1
while(byteLength>0&&(mul*=0x100)){val+=this[offset+--byteLength]*mul}
return val}
Buffer.prototype.readUInt8=function readUInt8(offset,noAssert){if(!noAssert)checkOffset(offset,1,this.length)
return this[offset]}
Buffer.prototype.readUInt16LE=function readUInt16LE(offset,noAssert){if(!noAssert)checkOffset(offset,2,this.length)
return this[offset]|(this[offset+1]<<8)}
Buffer.prototype.readUInt16BE=function readUInt16BE(offset,noAssert){if(!noAssert)checkOffset(offset,2,this.length)
return(this[offset]<<8)|this[offset+1]}
Buffer.prototype.readUInt32LE=function readUInt32LE(offset,noAssert){if(!noAssert)checkOffset(offset,4,this.length)
return((this[offset])|(this[offset+1]<<8)|(this[offset+2]<<16))+(this[offset+3]*0x1000000)}
Buffer.prototype.readUInt32BE=function readUInt32BE(offset,noAssert){if(!noAssert)checkOffset(offset,4,this.length)
return(this[offset]*0x1000000)+((this[offset+1]<<16)|(this[offset+2]<<8)|this[offset+3])}
Buffer.prototype.readIntLE=function readIntLE(offset,byteLength,noAssert){offset=offset|0
byteLength=byteLength|0
if(!noAssert)checkOffset(offset,byteLength,this.length)
var val=this[offset]
var mul=1
var i=0
while(++i<byteLength&&(mul*=0x100)){val+=this[offset+i]*mul}
mul*=0x80
if(val>=mul)val-=Math.pow(2,8*byteLength)
return val}
Buffer.prototype.readIntBE=function readIntBE(offset,byteLength,noAssert){offset=offset|0
byteLength=byteLength|0
if(!noAssert)checkOffset(offset,byteLength,this.length)
var i=byteLength
var mul=1
var val=this[offset+--i]
while(i>0&&(mul*=0x100)){val+=this[offset+--i]*mul}
mul*=0x80
if(val>=mul)val-=Math.pow(2,8*byteLength)
return val}
Buffer.prototype.readInt8=function readInt8(offset,noAssert){if(!noAssert)checkOffset(offset,1,this.length)
if(!(this[offset]&0x80))return(this[offset])
return((0xff-this[offset]+1)*-1)}
Buffer.prototype.readInt16LE=function readInt16LE(offset,noAssert){if(!noAssert)checkOffset(offset,2,this.length)
var val=this[offset]|(this[offset+1]<<8)
return(val&0x8000)?val|0xFFFF0000:val}
Buffer.prototype.readInt16BE=function readInt16BE(offset,noAssert){if(!noAssert)checkOffset(offset,2,this.length)
var val=this[offset+1]|(this[offset]<<8)
return(val&0x8000)?val|0xFFFF0000:val}
Buffer.prototype.readInt32LE=function readInt32LE(offset,noAssert){if(!noAssert)checkOffset(offset,4,this.length)
return(this[offset])|(this[offset+1]<<8)|(this[offset+2]<<16)|(this[offset+3]<<24)}
Buffer.prototype.readInt32BE=function readInt32BE(offset,noAssert){if(!noAssert)checkOffset(offset,4,this.length)
return(this[offset]<<24)|(this[offset+1]<<16)|(this[offset+2]<<8)|(this[offset+3])}
Buffer.prototype.readFloatLE=function readFloatLE(offset,noAssert){if(!noAssert)checkOffset(offset,4,this.length)
return ieee754.read(this,offset,true,23,4)}
Buffer.prototype.readFloatBE=function readFloatBE(offset,noAssert){if(!noAssert)checkOffset(offset,4,this.length)
return ieee754.read(this,offset,false,23,4)}
Buffer.prototype.readDoubleLE=function readDoubleLE(offset,noAssert){if(!noAssert)checkOffset(offset,8,this.length)
return ieee754.read(this,offset,true,52,8)}
Buffer.prototype.readDoubleBE=function readDoubleBE(offset,noAssert){if(!noAssert)checkOffset(offset,8,this.length)
return ieee754.read(this,offset,false,52,8)}
function checkInt(buf,value,offset,ext,max,min){if(!Buffer.isBuffer(buf))throw new TypeError('buffer must be a Buffer instance')
if(value>max||value<min)throw new RangeError('value is out of bounds')
if(offset+ext>buf.length)throw new RangeError('index out of range')}
Buffer.prototype.writeUIntLE=function writeUIntLE(value,offset,byteLength,noAssert){value=+value
offset=offset|0
byteLength=byteLength|0
if(!noAssert)checkInt(this,value,offset,byteLength,Math.pow(2,8*byteLength),0)
var mul=1
var i=0
this[offset]=value&0xFF
while(++i<byteLength&&(mul*=0x100)){this[offset+i]=(value/mul)&0xFF}
return offset+byteLength}
Buffer.prototype.writeUIntBE=function writeUIntBE(value,offset,byteLength,noAssert){value=+value
offset=offset|0
byteLength=byteLength|0
if(!noAssert)checkInt(this,value,offset,byteLength,Math.pow(2,8*byteLength),0)
var i=byteLength-1
var mul=1
this[offset+i]=value&0xFF
while(--i>=0&&(mul*=0x100)){this[offset+i]=(value/mul)&0xFF}
return offset+byteLength}
Buffer.prototype.writeUInt8=function writeUInt8(value,offset,noAssert){value=+value
offset=offset|0
if(!noAssert)checkInt(this,value,offset,1,0xff,0)
if(!Buffer.TYPED_ARRAY_SUPPORT)value=Math.floor(value)
this[offset]=value
return offset+1}
function objectWriteUInt16(buf,value,offset,littleEndian){if(value<0)value=0xffff+value+1
for(var i=0,j=Math.min(buf.length-offset,2);i<j;i++){buf[offset+i]=(value&(0xff<<(8*(littleEndian?i:1-i))))>>>(littleEndian?i:1-i)*8}}
Buffer.prototype.writeUInt16LE=function writeUInt16LE(value,offset,noAssert){value=+value
offset=offset|0
if(!noAssert)checkInt(this,value,offset,2,0xffff,0)
if(Buffer.TYPED_ARRAY_SUPPORT){this[offset]=value
this[offset+1]=(value>>>8)}else{objectWriteUInt16(this,value,offset,true)}
return offset+2}
Buffer.prototype.writeUInt16BE=function writeUInt16BE(value,offset,noAssert){value=+value
offset=offset|0
if(!noAssert)checkInt(this,value,offset,2,0xffff,0)
if(Buffer.TYPED_ARRAY_SUPPORT){this[offset]=(value>>>8)
this[offset+1]=value}else{objectWriteUInt16(this,value,offset,false)}
return offset+2}
function objectWriteUInt32(buf,value,offset,littleEndian){if(value<0)value=0xffffffff+value+1
for(var i=0,j=Math.min(buf.length-offset,4);i<j;i++){buf[offset+i]=(value>>>(littleEndian?i:3-i)*8)&0xff}}
Buffer.prototype.writeUInt32LE=function writeUInt32LE(value,offset,noAssert){value=+value
offset=offset|0
if(!noAssert)checkInt(this,value,offset,4,0xffffffff,0)
if(Buffer.TYPED_ARRAY_SUPPORT){this[offset+3]=(value>>>24)
this[offset+2]=(value>>>16)
this[offset+1]=(value>>>8)
this[offset]=value}else{objectWriteUInt32(this,value,offset,true)}
return offset+4}
Buffer.prototype.writeUInt32BE=function writeUInt32BE(value,offset,noAssert){value=+value
offset=offset|0
if(!noAssert)checkInt(this,value,offset,4,0xffffffff,0)
if(Buffer.TYPED_ARRAY_SUPPORT){this[offset]=(value>>>24)
this[offset+1]=(value>>>16)
this[offset+2]=(value>>>8)
this[offset+3]=value}else{objectWriteUInt32(this,value,offset,false)}
return offset+4}
Buffer.prototype.writeIntLE=function writeIntLE(value,offset,byteLength,noAssert){value=+value
offset=offset|0
if(!noAssert){var limit=Math.pow(2,8*byteLength-1)
checkInt(this,value,offset,byteLength,limit-1,-limit)}
var i=0
var mul=1
var sub=value<0?1:0
this[offset]=value&0xFF
while(++i<byteLength&&(mul*=0x100)){this[offset+i]=((value/mul)>>0)-sub&0xFF}
return offset+byteLength}
Buffer.prototype.writeIntBE=function writeIntBE(value,offset,byteLength,noAssert){value=+value
offset=offset|0
if(!noAssert){var limit=Math.pow(2,8*byteLength-1)
checkInt(this,value,offset,byteLength,limit-1,-limit)}
var i=byteLength-1
var mul=1
var sub=value<0?1:0
this[offset+i]=value&0xFF
while(--i>=0&&(mul*=0x100)){this[offset+i]=((value/mul)>>0)-sub&0xFF}
return offset+byteLength}
Buffer.prototype.writeInt8=function writeInt8(value,offset,noAssert){value=+value
offset=offset|0
if(!noAssert)checkInt(this,value,offset,1,0x7f,-0x80)
if(!Buffer.TYPED_ARRAY_SUPPORT)value=Math.floor(value)
if(value<0)value=0xff+value+1
this[offset]=value
return offset+1}
Buffer.prototype.writeInt16LE=function writeInt16LE(value,offset,noAssert){value=+value
offset=offset|0
if(!noAssert)checkInt(this,value,offset,2,0x7fff,-0x8000)
if(Buffer.TYPED_ARRAY_SUPPORT){this[offset]=value
this[offset+1]=(value>>>8)}else{objectWriteUInt16(this,value,offset,true)}
return offset+2}
Buffer.prototype.writeInt16BE=function writeInt16BE(value,offset,noAssert){value=+value
offset=offset|0
if(!noAssert)checkInt(this,value,offset,2,0x7fff,-0x8000)
if(Buffer.TYPED_ARRAY_SUPPORT){this[offset]=(value>>>8)
this[offset+1]=value}else{objectWriteUInt16(this,value,offset,false)}
return offset+2}
Buffer.prototype.writeInt32LE=function writeInt32LE(value,offset,noAssert){value=+value
offset=offset|0
if(!noAssert)checkInt(this,value,offset,4,0x7fffffff,-0x80000000)
if(Buffer.TYPED_ARRAY_SUPPORT){this[offset]=value
this[offset+1]=(value>>>8)
this[offset+2]=(value>>>16)
this[offset+3]=(value>>>24)}else{objectWriteUInt32(this,value,offset,true)}
return offset+4}
Buffer.prototype.writeInt32BE=function writeInt32BE(value,offset,noAssert){value=+value
offset=offset|0
if(!noAssert)checkInt(this,value,offset,4,0x7fffffff,-0x80000000)
if(value<0)value=0xffffffff+value+1
if(Buffer.TYPED_ARRAY_SUPPORT){this[offset]=(value>>>24)
this[offset+1]=(value>>>16)
this[offset+2]=(value>>>8)
this[offset+3]=value}else{objectWriteUInt32(this,value,offset,false)}
return offset+4}
function checkIEEE754(buf,value,offset,ext,max,min){if(value>max||value<min)throw new RangeError('value is out of bounds')
if(offset+ext>buf.length)throw new RangeError('index out of range')
if(offset<0)throw new RangeError('index out of range')}
function writeFloat(buf,value,offset,littleEndian,noAssert){if(!noAssert){checkIEEE754(buf,value,offset,4,3.4028234663852886e+38,-3.4028234663852886e+38)}
ieee754.write(buf,value,offset,littleEndian,23,4)
return offset+4}
Buffer.prototype.writeFloatLE=function writeFloatLE(value,offset,noAssert){return writeFloat(this,value,offset,true,noAssert)}
Buffer.prototype.writeFloatBE=function writeFloatBE(value,offset,noAssert){return writeFloat(this,value,offset,false,noAssert)}
function writeDouble(buf,value,offset,littleEndian,noAssert){if(!noAssert){checkIEEE754(buf,value,offset,8,1.7976931348623157E+308,-1.7976931348623157E+308)}
ieee754.write(buf,value,offset,littleEndian,52,8)
return offset+8}
Buffer.prototype.writeDoubleLE=function writeDoubleLE(value,offset,noAssert){return writeDouble(this,value,offset,true,noAssert)}
Buffer.prototype.writeDoubleBE=function writeDoubleBE(value,offset,noAssert){return writeDouble(this,value,offset,false,noAssert)}
Buffer.prototype.copy=function copy(target,targetStart,start,end){if(!start)start=0
if(!end&&end!==0)end=this.length
if(targetStart>=target.length)targetStart=target.length
if(!targetStart)targetStart=0
if(end>0&&end<start)end=start
if(end===start)return 0
if(target.length===0||this.length===0)return 0
if(targetStart<0){throw new RangeError('targetStart out of bounds')}
if(start<0||start>=this.length)throw new RangeError('sourceStart out of bounds')
if(end<0)throw new RangeError('sourceEnd out of bounds')
if(end>this.length)end=this.length
if(target.length-targetStart<end-start){end=target.length-targetStart+start}
var len=end-start
if(len<1000||!Buffer.TYPED_ARRAY_SUPPORT){for(var i=0;i<len;i++){target[i+targetStart]=this[i+start]}}else{target._set(this.subarray(start,start+len),targetStart)}
return len}
Buffer.prototype.fill=function fill(value,start,end){if(!value)value=0
if(!start)start=0
if(!end)end=this.length
if(end<start)throw new RangeError('end < start')
if(end===start)return
if(this.length===0)return
if(start<0||start>=this.length)throw new RangeError('start out of bounds')
if(end<0||end>this.length)throw new RangeError('end out of bounds')
var i
if(typeof value==='number'){for(i=start;i<end;i++){this[i]=value}}else{var bytes=utf8ToBytes(value.toString())
var len=bytes.length
for(i=start;i<end;i++){this[i]=bytes[i%len]}}
return this}
Buffer.prototype.toArrayBuffer=function toArrayBuffer(){if(typeof Uint8Array!=='undefined'){if(Buffer.TYPED_ARRAY_SUPPORT){return(new Buffer(this)).buffer}else{var buf=new Uint8Array(this.length)
for(var i=0,len=buf.length;i<len;i+=1){buf[i]=this[i]}
return buf.buffer}}else{throw new TypeError('Buffer.toArrayBuffer not supported in this browser')}}
var BP=Buffer.prototype
Buffer._augment=function _augment(arr){arr.constructor=Buffer
arr._isBuffer=true
arr._set=arr.set
arr.get=BP.get
arr.set=BP.set
arr.write=BP.write
arr.toString=BP.toString
arr.toLocaleString=BP.toString
arr.toJSON=BP.toJSON
arr.equals=BP.equals
arr.compare=BP.compare
arr.indexOf=BP.indexOf
arr.copy=BP.copy
arr.slice=BP.slice
arr.readUIntLE=BP.readUIntLE
arr.readUIntBE=BP.readUIntBE
arr.readUInt8=BP.readUInt8
arr.readUInt16LE=BP.readUInt16LE
arr.readUInt16BE=BP.readUInt16BE
arr.readUInt32LE=BP.readUInt32LE
arr.readUInt32BE=BP.readUInt32BE
arr.readIntLE=BP.readIntLE
arr.readIntBE=BP.readIntBE
arr.readInt8=BP.readInt8
arr.readInt16LE=BP.readInt16LE
arr.readInt16BE=BP.readInt16BE
arr.readInt32LE=BP.readInt32LE
arr.readInt32BE=BP.readInt32BE
arr.readFloatLE=BP.readFloatLE
arr.readFloatBE=BP.readFloatBE
arr.readDoubleLE=BP.readDoubleLE
arr.readDoubleBE=BP.readDoubleBE
arr.writeUInt8=BP.writeUInt8
arr.writeUIntLE=BP.writeUIntLE
arr.writeUIntBE=BP.writeUIntBE
arr.writeUInt16LE=BP.writeUInt16LE
arr.writeUInt16BE=BP.writeUInt16BE
arr.writeUInt32LE=BP.writeUInt32LE
arr.writeUInt32BE=BP.writeUInt32BE
arr.writeIntLE=BP.writeIntLE
arr.writeIntBE=BP.writeIntBE
arr.writeInt8=BP.writeInt8
arr.writeInt16LE=BP.writeInt16LE
arr.writeInt16BE=BP.writeInt16BE
arr.writeInt32LE=BP.writeInt32LE
arr.writeInt32BE=BP.writeInt32BE
arr.writeFloatLE=BP.writeFloatLE
arr.writeFloatBE=BP.writeFloatBE
arr.writeDoubleLE=BP.writeDoubleLE
arr.writeDoubleBE=BP.writeDoubleBE
arr.fill=BP.fill
arr.inspect=BP.inspect
arr.toArrayBuffer=BP.toArrayBuffer
return arr}
var INVALID_BASE64_RE=/[^+\/0-9A-z\-]/g
function base64clean(str){str=stringtrim(str).replace(INVALID_BASE64_RE,'')
if(str.length<2)return''
while(str.length%4!==0){str=str+'='}
return str}
function stringtrim(str){if(str.trim)return str.trim()
return str.replace(/^\s+|\s+$/g,'')}
function toHex(n){if(n<16)return'0'+n.toString(16)
return n.toString(16)}
function utf8ToBytes(string,units){units=units||Infinity
var codePoint
var length=string.length
var leadSurrogate=null
var bytes=[]
var i=0
for(;i<length;i++){codePoint=string.charCodeAt(i)
if(codePoint>0xD7FF&&codePoint<0xE000){if(leadSurrogate){if(codePoint<0xDC00){if((units-=3)>-1)bytes.push(0xEF,0xBF,0xBD)
leadSurrogate=codePoint
continue}else{codePoint=leadSurrogate-0xD800<<10|codePoint-0xDC00|0x10000
leadSurrogate=null}}else{if(codePoint>0xDBFF){if((units-=3)>-1)bytes.push(0xEF,0xBF,0xBD)
continue}else if(i+1===length){if((units-=3)>-1)bytes.push(0xEF,0xBF,0xBD)
continue}else{leadSurrogate=codePoint
continue}}}else if(leadSurrogate){if((units-=3)>-1)bytes.push(0xEF,0xBF,0xBD)
leadSurrogate=null}
if(codePoint<0x80){if((units-=1)<0)break
bytes.push(codePoint)}else if(codePoint<0x800){if((units-=2)<0)break
bytes.push(codePoint>>0x6|0xC0,codePoint&0x3F|0x80)}else if(codePoint<0x10000){if((units-=3)<0)break
bytes.push(codePoint>>0xC|0xE0,codePoint>>0x6&0x3F|0x80,codePoint&0x3F|0x80)}else if(codePoint<0x200000){if((units-=4)<0)break
bytes.push(codePoint>>0x12|0xF0,codePoint>>0xC&0x3F|0x80,codePoint>>0x6&0x3F|0x80,codePoint&0x3F|0x80)}else{throw new Error('Invalid code point')}}
return bytes}
function asciiToBytes(str){var byteArray=[]
for(var i=0;i<str.length;i++){byteArray.push(str.charCodeAt(i)&0xFF)}
return byteArray}
function utf16leToBytes(str,units){var c,hi,lo
var byteArray=[]
for(var i=0;i<str.length;i++){if((units-=2)<0)break
c=str.charCodeAt(i)
hi=c>>8
lo=c%256
byteArray.push(lo)
byteArray.push(hi)}
return byteArray}
function base64ToBytes(str){return base64.toByteArray(base64clean(str))}
function blitBuffer(src,dst,offset,length){for(var i=0;i<length;i++){if((i+offset>=dst.length)||(i>=src.length))break
dst[i+offset]=src[i]}
return i}
function decodeUtf8Char(str){try{return decodeURIComponent(str)}catch(err){return String.fromCharCode(0xFFFD)}}}.call(exports,__webpack_require__(4).Buffer))},function(module,exports,__webpack_require__){'use strict';var _=__webpack_require__(11);var FontWrapper=__webpack_require__(16);function typeName(bold,italics){var type='normal';if(bold&&italics)type='bolditalics';else if(bold)type='bold';else if(italics)type='italics';return type;}
function FontProvider(fontDescriptors,pdfDoc){this.fonts={};this.pdfDoc=pdfDoc;this.fontWrappers={};for(var font in fontDescriptors){if(fontDescriptors.hasOwnProperty(font)){var fontDef=fontDescriptors[font];this.fonts[font]={normal:fontDef.normal,bold:fontDef.bold,italics:fontDef.italics,bolditalics:fontDef.bolditalics};}}}
FontProvider.prototype.provideFont=function(familyName,bold,italics){if(!this.fonts[familyName])return this.pdfDoc._font;var type=typeName(bold,italics);this.fontWrappers[familyName]=this.fontWrappers[familyName]||{};if(!this.fontWrappers[familyName][type]){this.fontWrappers[familyName][type]=new FontWrapper(this.pdfDoc,this.fonts[familyName][type],familyName+'('+type+')');}
return this.fontWrappers[familyName][type];};FontProvider.prototype.setFontRefsToPdfDoc=function(){var self=this;_.each(self.fontWrappers,function(fontFamily){_.each(fontFamily,function(fontWrapper){_.each(fontWrapper.pdfFonts,function(font){if(!self.pdfDoc.page.fonts[font.id]){self.pdfDoc.page.fonts[font.id]=font.ref();}});});});};module.exports=FontProvider;},function(module,exports,__webpack_require__){'use strict';var _=__webpack_require__(11);var TraversalTracker=__webpack_require__(18);var DocMeasure=__webpack_require__(19);var DocumentContext=__webpack_require__(20);var PageElementWriter=__webpack_require__(21);var ColumnCalculator=__webpack_require__(22);var TableProcessor=__webpack_require__(23);var Line=__webpack_require__(24);var pack=__webpack_require__(25).pack;var offsetVector=__webpack_require__(25).offsetVector;var fontStringify=__webpack_require__(25).fontStringify;var isFunction=__webpack_require__(25).isFunction;var TextTools=__webpack_require__(26);var StyleContextStack=__webpack_require__(27);function addAll(target,otherArray){_.each(otherArray,function(item){target.push(item);});}
function LayoutBuilder(pageSize,pageMargins,imageMeasure){this.pageSize=pageSize;this.pageMargins=pageMargins;this.tracker=new TraversalTracker();this.imageMeasure=imageMeasure;this.tableLayouts={};}
LayoutBuilder.prototype.registerTableLayouts=function(tableLayouts){this.tableLayouts=pack(this.tableLayouts,tableLayouts);};LayoutBuilder.prototype.layoutDocument=function(docStructure,fontProvider,styleDictionary,defaultStyle,background,header,footer,images,watermark,pageBreakBeforeFct){function addPageBreaksIfNecessary(linearNodeList,pages){linearNodeList=_.reject(linearNodeList,function(node){return _.isEmpty(node.positions);});_.each(linearNodeList,function(node){var nodeInfo=_.pick(node,['id','text','ul','ol','table','image','qr','canvas','columns','headlineLevel','style','pageBreak','pageOrientation','width','height']);nodeInfo.startPosition=_.first(node.positions);nodeInfo.pageNumbers=_.chain(node.positions).map('pageNumber').uniq().value();nodeInfo.pages=pages.length;nodeInfo.stack=_.isArray(node.stack);node.nodeInfo=nodeInfo;});return _.any(linearNodeList,function(node,index,followingNodeList){if(node.pageBreak!=='before'&&!node.pageBreakCalculated){node.pageBreakCalculated=true;var pageNumber=_.first(node.nodeInfo.pageNumbers);var followingNodesOnPage=_.chain(followingNodeList).drop(index+1).filter(function(node0){return _.contains(node0.nodeInfo.pageNumbers,pageNumber);}).value();var nodesOnNextPage=_.chain(followingNodeList).drop(index+1).filter(function(node0){return _.contains(node0.nodeInfo.pageNumbers,pageNumber+1);}).value();var previousNodesOnPage=_.chain(followingNodeList).take(index).filter(function(node0){return _.contains(node0.nodeInfo.pageNumbers,pageNumber);}).value();if(pageBreakBeforeFct(node.nodeInfo,_.map(followingNodesOnPage,'nodeInfo'),_.map(nodesOnNextPage,'nodeInfo'),_.map(previousNodesOnPage,'nodeInfo'))){node.pageBreak='before';return true;}}});}
if(!isFunction(pageBreakBeforeFct)){pageBreakBeforeFct=function(){return false;};}
this.docMeasure=new DocMeasure(fontProvider,styleDictionary,defaultStyle,this.imageMeasure,this.tableLayouts,images);function resetXYs(result){_.each(result.linearNodeList,function(node){node.resetXY();});}
var result=this.tryLayoutDocument(docStructure,fontProvider,styleDictionary,defaultStyle,background,header,footer,images,watermark);while(addPageBreaksIfNecessary(result.linearNodeList,result.pages)){resetXYs(result);result=this.tryLayoutDocument(docStructure,fontProvider,styleDictionary,defaultStyle,background,header,footer,images,watermark);}
return result.pages;};LayoutBuilder.prototype.tryLayoutDocument=function(docStructure,fontProvider,styleDictionary,defaultStyle,background,header,footer,images,watermark,pageBreakBeforeFct){this.linearNodeList=[];docStructure=this.docMeasure.measureDocument(docStructure);this.writer=new PageElementWriter(new DocumentContext(this.pageSize,this.pageMargins),this.tracker);var _this=this;this.writer.context().tracker.startTracking('pageAdded',function(){_this.addBackground(background);});this.addBackground(background);this.processNode(docStructure);this.addHeadersAndFooters(header,footer);if(watermark!=null)
this.addWatermark(watermark,fontProvider);return{pages:this.writer.context().pages,linearNodeList:this.linearNodeList};};LayoutBuilder.prototype.addBackground=function(background){var backgroundGetter=isFunction(background)?background:function(){return background;};var pageBackground=backgroundGetter(this.writer.context().page+1);if(pageBackground){var pageSize=this.writer.context().getCurrentPage().pageSize;this.writer.beginUnbreakableBlock(pageSize.width,pageSize.height);this.processNode(this.docMeasure.measureDocument(pageBackground));this.writer.commitUnbreakableBlock(0,0);}};LayoutBuilder.prototype.addStaticRepeatable=function(headerOrFooter,sizeFunction){this.addDynamicRepeatable(function(){return headerOrFooter;},sizeFunction);};LayoutBuilder.prototype.addDynamicRepeatable=function(nodeGetter,sizeFunction){var pages=this.writer.context().pages;for(var pageIndex=0,l=pages.length;pageIndex<l;pageIndex++){this.writer.context().page=pageIndex;var node=nodeGetter(pageIndex+1,l);if(node){var sizes=sizeFunction(this.writer.context().getCurrentPage().pageSize,this.pageMargins);this.writer.beginUnbreakableBlock(sizes.width,sizes.height);this.processNode(this.docMeasure.measureDocument(node));this.writer.commitUnbreakableBlock(sizes.x,sizes.y);}}};LayoutBuilder.prototype.addHeadersAndFooters=function(header,footer){var headerSizeFct=function(pageSize,pageMargins){return{x:0,y:0,width:pageSize.width,height:pageMargins.top};};var footerSizeFct=function(pageSize,pageMargins){return{x:0,y:pageSize.height-pageMargins.bottom,width:pageSize.width,height:pageMargins.bottom};};if(isFunction(header)){this.addDynamicRepeatable(header,headerSizeFct);}else if(header){this.addStaticRepeatable(header,headerSizeFct);}
if(isFunction(footer)){this.addDynamicRepeatable(footer,footerSizeFct);}else if(footer){this.addStaticRepeatable(footer,footerSizeFct);}};LayoutBuilder.prototype.addWatermark=function(watermark,fontProvider){var defaultFont=Object.getOwnPropertyNames(fontProvider.fonts)[0];var watermarkObject={text:watermark,font:fontProvider.provideFont(fontProvider[defaultFont],false,false),size:getSize(this.pageSize,watermark,fontProvider)};var pages=this.writer.context().pages;for(var i=0,l=pages.length;i<l;i++){pages[i].watermark=watermarkObject;}
function getSize(pageSize,watermark,fontProvider){var width=pageSize.width;var height=pageSize.height;var targetWidth=Math.sqrt(width*width+height*height)*0.8;var textTools=new TextTools(fontProvider);var styleContextStack=new StyleContextStack();var size;var a=0;var b=1000;var c=(a+b)/2;while(Math.abs(a-b)>1){styleContextStack.push({fontSize:c});size=textTools.sizeOfString(watermark,styleContextStack);if(size.width>targetWidth){b=c;c=(a+b)/2;}
else if(size.width<targetWidth){a=c;c=(a+b)/2;}
styleContextStack.pop();}
return{size:size,fontSize:c};}};function decorateNode(node){var x=node.x,y=node.y;node.positions=[];_.each(node.canvas,function(vector){var x=vector.x,y=vector.y;vector.resetXY=function(){vector.x=x;vector.y=y;};});node.resetXY=function(){node.x=x;node.y=y;_.each(node.canvas,function(vector){vector.resetXY();});};}
LayoutBuilder.prototype.processNode=function(node){var self=this;this.linearNodeList.push(node);decorateNode(node);applyMargins(function(){var absPosition=node.absolutePosition;if(absPosition){self.writer.context().beginDetachedBlock();self.writer.context().moveTo(absPosition.x||0,absPosition.y||0);}
if(node.stack){self.processVerticalContainer(node);}else if(node.columns){self.processColumns(node);}else if(node.ul){self.processList(false,node);}else if(node.ol){self.processList(true,node);}else if(node.table){self.processTable(node);}else if(node.text!==undefined){self.processLeaf(node);}else if(node.image){self.processImage(node);}else if(node.canvas){self.processCanvas(node);}else if(node.qr){self.processQr(node);}else if(!node._span){throw'Unrecognized document structure: '+JSON.stringify(node,fontStringify);}
if(absPosition){self.writer.context().endDetachedBlock();}});function applyMargins(callback){var margin=node._margin;if(node.pageBreak==='before'){self.writer.moveToNextPage(node.pageOrientation);}
if(margin){self.writer.context().moveDown(margin[1]);self.writer.context().addMargin(margin[0],margin[2]);}
callback();if(margin){self.writer.context().addMargin(-margin[0],-margin[2]);self.writer.context().moveDown(margin[3]);}
if(node.pageBreak==='after'){self.writer.moveToNextPage(node.pageOrientation);}}};LayoutBuilder.prototype.processVerticalContainer=function(node){var self=this;node.stack.forEach(function(item){self.processNode(item);addAll(node.positions,item.positions);});};LayoutBuilder.prototype.processColumns=function(columnNode){var columns=columnNode.columns;var availableWidth=this.writer.context().availableWidth;var gaps=gapArray(columnNode._gap);if(gaps)availableWidth-=(gaps.length-1)*columnNode._gap;ColumnCalculator.buildColumnWidths(columns,availableWidth);var result=this.processRow(columns,columns,gaps);addAll(columnNode.positions,result.positions);function gapArray(gap){if(!gap)return null;var gaps=[];gaps.push(0);for(var i=columns.length-1;i>0;i--){gaps.push(gap);}
return gaps;}};LayoutBuilder.prototype.processRow=function(columns,widths,gaps,tableBody,tableRow){var self=this;var pageBreaks=[],positions=[];this.tracker.auto('pageChanged',storePageBreakData,function(){widths=widths||columns;self.writer.context().beginColumnGroup();for(var i=0,l=columns.length;i<l;i++){var column=columns[i];var width=widths[i]._calcWidth;var leftOffset=colLeftOffset(i);if(column.colSpan&&column.colSpan>1){for(var j=1;j<column.colSpan;j++){width+=widths[++i]._calcWidth+gaps[i];}}
self.writer.context().beginColumn(width,leftOffset,getEndingCell(column,i));if(!column._span){self.processNode(column);addAll(positions,column.positions);}else if(column._columnEndingContext){self.writer.context().markEnding(column);}}
self.writer.context().completeColumnGroup();});return{pageBreaks:pageBreaks,positions:positions};function storePageBreakData(data){var pageDesc;for(var i=0,l=pageBreaks.length;i<l;i++){var desc=pageBreaks[i];if(desc.prevPage===data.prevPage){pageDesc=desc;break;}}
if(!pageDesc){pageDesc=data;pageBreaks.push(pageDesc);}
pageDesc.prevY=Math.max(pageDesc.prevY,data.prevY);pageDesc.y=Math.min(pageDesc.y,data.y);}
function colLeftOffset(i){if(gaps&&gaps.length>i)return gaps[i];return 0;}
function getEndingCell(column,columnIndex){if(column.rowSpan&&column.rowSpan>1){var endingRow=tableRow+column.rowSpan-1;if(endingRow>=tableBody.length)throw'Row span for column '+columnIndex+' (with indexes starting from 0) exceeded row count';return tableBody[endingRow][columnIndex];}
return null;}};LayoutBuilder.prototype.processList=function(orderedList,node){var self=this,items=orderedList?node.ol:node.ul,gapSize=node._gapSize;this.writer.context().addMargin(gapSize.width);var nextMarker;this.tracker.auto('lineAdded',addMarkerToFirstLeaf,function(){items.forEach(function(item){nextMarker=item.listMarker;self.processNode(item);addAll(node.positions,item.positions);});});this.writer.context().addMargin(-gapSize.width);function addMarkerToFirstLeaf(line){if(nextMarker){var marker=nextMarker;nextMarker=null;if(marker.canvas){var vector=marker.canvas[0];offsetVector(vector,-marker._minWidth,0);self.writer.addVector(vector);}else{var markerLine=new Line(self.pageSize.width);markerLine.addInline(marker._inlines[0]);markerLine.x=-marker._minWidth;markerLine.y=line.getAscenderHeight()-markerLine.getAscenderHeight();self.writer.addLine(markerLine,true);}}}};LayoutBuilder.prototype.processTable=function(tableNode){var processor=new TableProcessor(tableNode);processor.beginTable(this.writer);for(var i=0,l=tableNode.table.body.length;i<l;i++){processor.beginRow(i,this.writer);var result=this.processRow(tableNode.table.body[i],tableNode.table.widths,tableNode._offsets.offsets,tableNode.table.body,i);addAll(tableNode.positions,result.positions);processor.endRow(i,this.writer,result.pageBreaks);}
processor.endTable(this.writer);};LayoutBuilder.prototype.processLeaf=function(node){var line=this.buildNextLine(node);while(line){var positions=this.writer.addLine(line);node.positions.push(positions);line=this.buildNextLine(node);}};LayoutBuilder.prototype.buildNextLine=function(textNode){if(!textNode._inlines||textNode._inlines.length===0)return null;var line=new Line(this.writer.context().availableWidth);while(textNode._inlines&&textNode._inlines.length>0&&line.hasEnoughSpaceForInline(textNode._inlines[0])){line.addInline(textNode._inlines.shift());}
line.lastLineInParagraph=textNode._inlines.length===0;return line;};LayoutBuilder.prototype.processImage=function(node){var position=this.writer.addImage(node);node.positions.push(position);};LayoutBuilder.prototype.processCanvas=function(node){var height=node._minHeight;if(this.writer.context().availableHeight<height){this.writer.moveToNextPage();}
node.canvas.forEach(function(vector){var position=this.writer.addVector(vector);node.positions.push(position);},this);this.writer.context().moveDown(height);};LayoutBuilder.prototype.processQr=function(node){var position=this.writer.addQr(node);node.positions.push(position);};module.exports=LayoutBuilder;},function(module,exports,__webpack_require__){module.exports={'4A0':[4767.87,6740.79],'2A0':[3370.39,4767.87],A0:[2383.94,3370.39],A1:[1683.78,2383.94],A2:[1190.55,1683.78],A3:[841.89,1190.55],A4:[595.28,841.89],A5:[419.53,595.28],A6:[297.64,419.53],A7:[209.76,297.64],A8:[147.40,209.76],A9:[104.88,147.40],A10:[73.70,104.88],B0:[2834.65,4008.19],B1:[2004.09,2834.65],B2:[1417.32,2004.09],B3:[1000.63,1417.32],B4:[708.66,1000.63],B5:[498.90,708.66],B6:[354.33,498.90],B7:[249.45,354.33],B8:[175.75,249.45],B9:[124.72,175.75],B10:[87.87,124.72],C0:[2599.37,3676.54],C1:[1836.85,2599.37],C2:[1298.27,1836.85],C3:[918.43,1298.27],C4:[649.13,918.43],C5:[459.21,649.13],C6:[323.15,459.21],C7:[229.61,323.15],C8:[161.57,229.61],C9:[113.39,161.57],C10:[79.37,113.39],RA0:[2437.80,3458.27],RA1:[1729.13,2437.80],RA2:[1218.90,1729.13],RA3:[864.57,1218.90],RA4:[609.45,864.57],SRA0:[2551.18,3628.35],SRA1:[1814.17,2551.18],SRA2:[1275.59,1814.17],SRA3:[907.09,1275.59],SRA4:[637.80,907.09],EXECUTIVE:[521.86,756.00],FOLIO:[612.00,936.00],LEGAL:[612.00,1008.00],LETTER:[612.00,792.00],TABLOID:[792.00,1224.00]};},function(module,exports,__webpack_require__){(function(Buffer){'use strict';var pdfKit=__webpack_require__(28);var PDFImage=__webpack_require__(17);function ImageMeasure(pdfDoc,imageDictionary){this.pdfDoc=pdfDoc;this.imageDictionary=imageDictionary||{};}
ImageMeasure.prototype.measureImage=function(src){var image,label;var that=this;if(!this.pdfDoc._imageRegistry[src]){label='I'+(++this.pdfDoc._imageCount);image=PDFImage.open(realImageSrc(src),label);image.embed(this.pdfDoc);this.pdfDoc._imageRegistry[src]=image;}else{image=this.pdfDoc._imageRegistry[src];}
return{width:image.width,height:image.height};function realImageSrc(src){var img=that.imageDictionary[src];if(!img)return src;var index=img.indexOf('base64,');if(index<0){throw'invalid image format, images dictionary should contain dataURL entries';}
return new Buffer(img.substring(index+7),'base64');}};module.exports=ImageMeasure;}.call(exports,__webpack_require__(4).Buffer))},function(module,exports,__webpack_require__){'use strict';function groupDecorations(line){var groups=[],curGroup=null;for(var i=0,l=line.inlines.length;i<l;i++){var inline=line.inlines[i];var decoration=inline.decoration;if(!decoration){curGroup=null;continue;}
var color=inline.decorationColor||inline.color||'black';var style=inline.decorationStyle||'solid';decoration=Array.isArray(decoration)?decoration:[decoration];for(var ii=0,ll=decoration.length;ii<ll;ii++){var deco=decoration[ii];if(!curGroup||deco!==curGroup.decoration||style!==curGroup.decorationStyle||color!==curGroup.decorationColor||deco==='lineThrough'){curGroup={line:line,decoration:deco,decorationColor:color,decorationStyle:style,inlines:[inline]};groups.push(curGroup);}else{curGroup.inlines.push(inline);}}}
return groups;}
function drawDecoration(group,x,y,pdfKitDoc){function maxInline(){var max=0;for(var i=0,l=group.inlines.length;i<l;i++){var inl=group.inlines[i];max=inl.fontSize>max?i:max;}
return group.inlines[max];}
function width(){var sum=0;for(var i=0,l=group.inlines.length;i<l;i++){sum+=group.inlines[i].width;}
return sum;}
var firstInline=group.inlines[0],biggerInline=maxInline(),totalWidth=width(),lineAscent=group.line.getAscenderHeight(),ascent=biggerInline.font.ascender/1000*biggerInline.fontSize,height=biggerInline.height,descent=height-ascent;var lw=0.5+Math.floor(Math.max(biggerInline.fontSize-8,0)/2)*0.12;switch(group.decoration){case'underline':y+=lineAscent+descent*0.45;break;case'overline':y+=lineAscent-(ascent*0.85);break;case'lineThrough':y+=lineAscent-(ascent*0.25);break;default:throw'Unkown decoration : '+group.decoration;}
pdfKitDoc.save();if(group.decorationStyle==='double'){var gap=Math.max(0.5,lw*2);pdfKitDoc.fillColor(group.decorationColor).rect(x+firstInline.x,y-lw/2,totalWidth,lw/2).fill().rect(x+firstInline.x,y+gap-lw/2,totalWidth,lw/2).fill();}else if(group.decorationStyle==='dashed'){var nbDashes=Math.ceil(totalWidth/(3.96+2.84));var rdx=x+firstInline.x;pdfKitDoc.rect(rdx,y,totalWidth,lw).clip();pdfKitDoc.fillColor(group.decorationColor);for(var i=0;i<nbDashes;i++){pdfKitDoc.rect(rdx,y-lw/2,3.96,lw).fill();rdx+=3.96+2.84;}}else if(group.decorationStyle==='dotted'){var nbDots=Math.ceil(totalWidth/(lw*3));var rx=x+firstInline.x;pdfKitDoc.rect(rx,y,totalWidth,lw).clip();pdfKitDoc.fillColor(group.decorationColor);for(var ii=0;ii<nbDots;ii++){pdfKitDoc.rect(rx,y-lw/2,lw,lw).fill();rx+=(lw*3);}}else if(group.decorationStyle==='wavy'){var sh=0.7,sv=1;var nbWaves=Math.ceil(totalWidth/(sh*2))+1;var rwx=x+firstInline.x-1;pdfKitDoc.rect(x+firstInline.x,y-sv,totalWidth,y+sv).clip();pdfKitDoc.lineWidth(0.24);pdfKitDoc.moveTo(rwx,y);for(var iii=0;iii<nbWaves;iii++){pdfKitDoc.bezierCurveTo(rwx+sh,y-sv,rwx+sh*2,y-sv,rwx+sh*3,y).bezierCurveTo(rwx+sh*4,y+sv,rwx+sh*5,y+sv,rwx+sh*6,y);rwx+=sh*6;}
pdfKitDoc.stroke(group.decorationColor);}else{pdfKitDoc.fillColor(group.decorationColor).rect(x+firstInline.x,y-lw/2,totalWidth,lw).fill();}
pdfKitDoc.restore();}
function drawDecorations(line,x,y,pdfKitDoc){var groups=groupDecorations(line);for(var i=0,l=groups.length;i<l;i++){drawDecoration(groups[i],x,y,pdfKitDoc);}}
function drawBackground(line,x,y,pdfKitDoc){var height=line.getHeight();for(var i=0,l=line.inlines.length;i<l;i++){var inline=line.inlines[i];if(inline.background){pdfKitDoc.fillColor(inline.background).rect(x+inline.x,y,inline.width,height).fill();}}}
module.exports={drawBackground:drawBackground,drawDecorations:drawDecorations};},function(module,exports,__webpack_require__){(function(Buffer,__dirname){'use strict';function VirtualFileSystem(){this.fileSystem={};this.baseSystem={};}
VirtualFileSystem.prototype.readFileSync=function(filename){filename=fixFilename(filename);var base64content=this.baseSystem[filename];if(base64content){return new Buffer(base64content,'base64');}
return this.fileSystem[filename];};VirtualFileSystem.prototype.writeFileSync=function(filename,content){this.fileSystem[fixFilename(filename)]=content;};VirtualFileSystem.prototype.bindFS=function(data){this.baseSystem=data;};function fixFilename(filename){if(filename.indexOf(__dirname)===0){filename=filename.substring(__dirname.length);}
if(filename.indexOf('/')===0){filename=filename.substring(1);}
return filename;}
module.exports=new VirtualFileSystem();}.call(exports,__webpack_require__(4).Buffer,"/"))},function(module,exports,__webpack_require__){var __WEBPACK_AMD_DEFINE_RESULT__;(function(module,global){;(function(){var undefined;var VERSION='3.1.0';var BIND_FLAG=1,BIND_KEY_FLAG=2,CURRY_BOUND_FLAG=4,CURRY_FLAG=8,CURRY_RIGHT_FLAG=16,PARTIAL_FLAG=32,PARTIAL_RIGHT_FLAG=64,REARG_FLAG=128,ARY_FLAG=256;var DEFAULT_TRUNC_LENGTH=30,DEFAULT_TRUNC_OMISSION='...';var HOT_COUNT=150,HOT_SPAN=16;var LAZY_FILTER_FLAG=0,LAZY_MAP_FLAG=1,LAZY_WHILE_FLAG=2;var FUNC_ERROR_TEXT='Expected a function';var PLACEHOLDER='__lodash_placeholder__';var argsTag='[object Arguments]',arrayTag='[object Array]',boolTag='[object Boolean]',dateTag='[object Date]',errorTag='[object Error]',funcTag='[object Function]',mapTag='[object Map]',numberTag='[object Number]',objectTag='[object Object]',regexpTag='[object RegExp]',setTag='[object Set]',stringTag='[object String]',weakMapTag='[object WeakMap]';var arrayBufferTag='[object ArrayBuffer]',float32Tag='[object Float32Array]',float64Tag='[object Float64Array]',int8Tag='[object Int8Array]',int16Tag='[object Int16Array]',int32Tag='[object Int32Array]',uint8Tag='[object Uint8Array]',uint8ClampedTag='[object Uint8ClampedArray]',uint16Tag='[object Uint16Array]',uint32Tag='[object Uint32Array]';var reEmptyStringLeading=/\b__p \+= '';/g,reEmptyStringMiddle=/\b(__p \+=) '' \+/g,reEmptyStringTrailing=/(__e\(.*?\)|\b__t\)) \+\n'';/g;var reEscapedHtml=/&(?:amp|lt|gt|quot|#39|#96);/g,reUnescapedHtml=/[&<>"'`]/g,reHasEscapedHtml=RegExp(reEscapedHtml.source),reHasUnescapedHtml=RegExp(reUnescapedHtml.source);var reEscape=/<%-([\s\S]+?)%>/g,reEvaluate=/<%([\s\S]+?)%>/g,reInterpolate=/<%=([\s\S]+?)%>/g;var reEsTemplate=/\$\{([^\\}]*(?:\\.[^\\}]*)*)\}/g;var reFlags=/\w*$/;var reFuncName=/^\s*function[ \n\r\t]+\w/;var reHexPrefix=/^0[xX]/;var reHostCtor=/^\[object .+?Constructor\]$/;var reLatin1=/[\xc0-\xd6\xd8-\xde\xdf-\xf6\xf8-\xff]/g;var reNoMatch=/($^)/;var reRegExpChars=/[.*+?^${}()|[\]\/\\]/g,reHasRegExpChars=RegExp(reRegExpChars.source);var reThis=/\bthis\b/;var reUnescapedString=/['\n\r\u2028\u2029\\]/g;var reWords=(function(){var upper='[A-Z\\xc0-\\xd6\\xd8-\\xde]',lower='[a-z\\xdf-\\xf6\\xf8-\\xff]+';return RegExp(upper+'{2,}(?='+upper+lower+')|'+upper+'?'+lower+'|'+upper+'+|[0-9]+','g');}());var whitespace=(' \t\x0b\f\xa0\ufeff'+'\n\r\u2028\u2029'+'\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000');var contextProps=['Array','ArrayBuffer','Date','Error','Float32Array','Float64Array','Function','Int8Array','Int16Array','Int32Array','Math','Number','Object','RegExp','Set','String','_','clearTimeout','document','isFinite','parseInt','setTimeout','TypeError','Uint8Array','Uint8ClampedArray','Uint16Array','Uint32Array','WeakMap','window','WinRTError'];var templateCounter=-1;var typedArrayTags={};typedArrayTags[float32Tag]=typedArrayTags[float64Tag]=typedArrayTags[int8Tag]=typedArrayTags[int16Tag]=typedArrayTags[int32Tag]=typedArrayTags[uint8Tag]=typedArrayTags[uint8ClampedTag]=typedArrayTags[uint16Tag]=typedArrayTags[uint32Tag]=true;typedArrayTags[argsTag]=typedArrayTags[arrayTag]=typedArrayTags[arrayBufferTag]=typedArrayTags[boolTag]=typedArrayTags[dateTag]=typedArrayTags[errorTag]=typedArrayTags[funcTag]=typedArrayTags[mapTag]=typedArrayTags[numberTag]=typedArrayTags[objectTag]=typedArrayTags[regexpTag]=typedArrayTags[setTag]=typedArrayTags[stringTag]=typedArrayTags[weakMapTag]=false;var cloneableTags={};cloneableTags[argsTag]=cloneableTags[arrayTag]=cloneableTags[arrayBufferTag]=cloneableTags[boolTag]=cloneableTags[dateTag]=cloneableTags[float32Tag]=cloneableTags[float64Tag]=cloneableTags[int8Tag]=cloneableTags[int16Tag]=cloneableTags[int32Tag]=cloneableTags[numberTag]=cloneableTags[objectTag]=cloneableTags[regexpTag]=cloneableTags[stringTag]=cloneableTags[uint8Tag]=cloneableTags[uint8ClampedTag]=cloneableTags[uint16Tag]=cloneableTags[uint32Tag]=true;cloneableTags[errorTag]=cloneableTags[funcTag]=cloneableTags[mapTag]=cloneableTags[setTag]=cloneableTags[weakMapTag]=false;var debounceOptions={'leading':false,'maxWait':0,'trailing':false};var deburredLetters={'\xc0':'A','\xc1':'A','\xc2':'A','\xc3':'A','\xc4':'A','\xc5':'A','\xe0':'a','\xe1':'a','\xe2':'a','\xe3':'a','\xe4':'a','\xe5':'a','\xc7':'C','\xe7':'c','\xd0':'D','\xf0':'d','\xc8':'E','\xc9':'E','\xca':'E','\xcb':'E','\xe8':'e','\xe9':'e','\xea':'e','\xeb':'e','\xcC':'I','\xcd':'I','\xce':'I','\xcf':'I','\xeC':'i','\xed':'i','\xee':'i','\xef':'i','\xd1':'N','\xf1':'n','\xd2':'O','\xd3':'O','\xd4':'O','\xd5':'O','\xd6':'O','\xd8':'O','\xf2':'o','\xf3':'o','\xf4':'o','\xf5':'o','\xf6':'o','\xf8':'o','\xd9':'U','\xda':'U','\xdb':'U','\xdc':'U','\xf9':'u','\xfa':'u','\xfb':'u','\xfc':'u','\xdd':'Y','\xfd':'y','\xff':'y','\xc6':'Ae','\xe6':'ae','\xde':'Th','\xfe':'th','\xdf':'ss'};var htmlEscapes={'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;','`':'&#96;'};var htmlUnescapes={'&amp;':'&','&lt;':'<','&gt;':'>','&quot;':'"','&#39;':"'",'&#96;':'`'};var objectTypes={'function':true,'object':true};var stringEscapes={'\\':'\\',"'":"'",'\n':'n','\r':'r','\u2028':'u2028','\u2029':'u2029'};var root=(objectTypes[typeof window]&&window!==(this&&this.window))?window:this;var freeExports=objectTypes[typeof exports]&&exports&&!exports.nodeType&&exports;var freeModule=objectTypes[typeof module]&&module&&!module.nodeType&&module;var freeGlobal=freeExports&&freeModule&&typeof global=='object'&&global;if(freeGlobal&&(freeGlobal.global===freeGlobal||freeGlobal.window===freeGlobal||freeGlobal.self===freeGlobal)){root=freeGlobal;}
var moduleExports=freeModule&&freeModule.exports===freeExports&&freeExports;function baseCompareAscending(value,other){if(value!==other){var valIsReflexive=value===value,othIsReflexive=other===other;if(value>other||!valIsReflexive||(typeof value=='undefined'&&othIsReflexive)){return 1;}
if(value<other||!othIsReflexive||(typeof other=='undefined'&&valIsReflexive)){return-1;}}
return 0;}
function baseIndexOf(array,value,fromIndex){if(value!==value){return indexOfNaN(array,fromIndex);}
var index=(fromIndex||0)-1,length=array.length;while(++index<length){if(array[index]===value){return index;}}
return-1;}
function baseSortBy(array,comparer){var length=array.length;array.sort(comparer);while(length--){array[length]=array[length].value;}
return array;}
function baseToString(value){if(typeof value=='string'){return value;}
return value==null?'':(value+'');}
function charAtCallback(string){return string.charCodeAt(0);}
function charsLeftIndex(string,chars){var index=-1,length=string.length;while(++index<length&&chars.indexOf(string.charAt(index))>-1){}
return index;}
function charsRightIndex(string,chars){var index=string.length;while(index--&&chars.indexOf(string.charAt(index))>-1){}
return index;}
function compareAscending(object,other){return baseCompareAscending(object.criteria,other.criteria)||(object.index-other.index);}
function compareMultipleAscending(object,other){var index=-1,objCriteria=object.criteria,othCriteria=other.criteria,length=objCriteria.length;while(++index<length){var result=baseCompareAscending(objCriteria[index],othCriteria[index]);if(result){return result;}}
return object.index-other.index;}
function deburrLetter(letter){return deburredLetters[letter];}
function escapeHtmlChar(chr){return htmlEscapes[chr];}
function escapeStringChar(chr){return'\\'+stringEscapes[chr];}
function indexOfNaN(array,fromIndex,fromRight){var length=array.length,index=fromRight?(fromIndex||length):((fromIndex||0)-1);while((fromRight?index--:++index<length)){var other=array[index];if(other!==other){return index;}}
return-1;}
function isObjectLike(value){return(value&&typeof value=='object')||false;}
function isSpace(charCode){return((charCode<=160&&(charCode>=9&&charCode<=13)||charCode==32||charCode==160)||charCode==5760||charCode==6158||(charCode>=8192&&(charCode<=8202||charCode==8232||charCode==8233||charCode==8239||charCode==8287||charCode==12288||charCode==65279)));}
function replaceHolders(array,placeholder){var index=-1,length=array.length,resIndex=-1,result=[];while(++index<length){if(array[index]===placeholder){array[index]=PLACEHOLDER;result[++resIndex]=index;}}
return result;}
function sortedUniq(array,iteratee){var seen,index=-1,length=array.length,resIndex=-1,result=[];while(++index<length){var value=array[index],computed=iteratee?iteratee(value,index,array):value;if(!index||seen!==computed){seen=computed;result[++resIndex]=value;}}
return result;}
function trimmedLeftIndex(string){var index=-1,length=string.length;while(++index<length&&isSpace(string.charCodeAt(index))){}
return index;}
function trimmedRightIndex(string){var index=string.length;while(index--&&isSpace(string.charCodeAt(index))){}
return index;}
function unescapeHtmlChar(chr){return htmlUnescapes[chr];}
function runInContext(context){context=context?_.defaults(root.Object(),context,_.pick(root,contextProps)):root;var Array=context.Array,Date=context.Date,Error=context.Error,Function=context.Function,Math=context.Math,Number=context.Number,Object=context.Object,RegExp=context.RegExp,String=context.String,TypeError=context.TypeError;var arrayProto=Array.prototype,objectProto=Object.prototype;var document=(document=context.window)&&document.document;var fnToString=Function.prototype.toString;var getLength=baseProperty('length');var hasOwnProperty=objectProto.hasOwnProperty;var idCounter=0;var objToString=objectProto.toString;var oldDash=context._;var reNative=RegExp('^'+escapeRegExp(objToString).replace(/toString|(function).*?(?=\\\()| for .+?(?=\\\])/g,'$1.*?')+'$');var ArrayBuffer=isNative(ArrayBuffer=context.ArrayBuffer)&&ArrayBuffer,bufferSlice=isNative(bufferSlice=ArrayBuffer&&new ArrayBuffer(0).slice)&&bufferSlice,ceil=Math.ceil,clearTimeout=context.clearTimeout,floor=Math.floor,getPrototypeOf=isNative(getPrototypeOf=Object.getPrototypeOf)&&getPrototypeOf,push=arrayProto.push,propertyIsEnumerable=objectProto.propertyIsEnumerable,Set=isNative(Set=context.Set)&&Set,setTimeout=context.setTimeout,splice=arrayProto.splice,Uint8Array=isNative(Uint8Array=context.Uint8Array)&&Uint8Array,unshift=arrayProto.unshift,WeakMap=isNative(WeakMap=context.WeakMap)&&WeakMap;var Float64Array=(function(){try{var func=isNative(func=context.Float64Array)&&func,result=new func(new ArrayBuffer(10),0,1)&&func;}catch(e){}
return result;}());var nativeIsArray=isNative(nativeIsArray=Array.isArray)&&nativeIsArray,nativeCreate=isNative(nativeCreate=Object.create)&&nativeCreate,nativeIsFinite=context.isFinite,nativeKeys=isNative(nativeKeys=Object.keys)&&nativeKeys,nativeMax=Math.max,nativeMin=Math.min,nativeNow=isNative(nativeNow=Date.now)&&nativeNow,nativeNumIsFinite=isNative(nativeNumIsFinite=Number.isFinite)&&nativeNumIsFinite,nativeParseInt=context.parseInt,nativeRandom=Math.random;var NEGATIVE_INFINITY=Number.NEGATIVE_INFINITY,POSITIVE_INFINITY=Number.POSITIVE_INFINITY;var MAX_ARRAY_LENGTH=Math.pow(2,32)-1,MAX_ARRAY_INDEX=MAX_ARRAY_LENGTH-1,HALF_MAX_ARRAY_LENGTH=MAX_ARRAY_LENGTH>>>1;var FLOAT64_BYTES_PER_ELEMENT=Float64Array?Float64Array.BYTES_PER_ELEMENT:0;var MAX_SAFE_INTEGER=Math.pow(2,53)-1;var metaMap=WeakMap&&new WeakMap;function lodash(value){if(isObjectLike(value)&&!isArray(value)){if(value instanceof LodashWrapper){return value;}
if(hasOwnProperty.call(value,'__wrapped__')){return new LodashWrapper(value.__wrapped__,value.__chain__,arrayCopy(value.__actions__));}}
return new LodashWrapper(value);}
function LodashWrapper(value,chainAll,actions){this.__actions__=actions||[];this.__chain__=!!chainAll;this.__wrapped__=value;}
var support=lodash.support={};(function(x){support.funcDecomp=!isNative(context.WinRTError)&&reThis.test(runInContext);support.funcNames=typeof Function.name=='string';try{support.dom=document.createDocumentFragment().nodeType===11;}catch(e){support.dom=false;}
try{support.nonEnumArgs=!propertyIsEnumerable.call(arguments,1);}catch(e){support.nonEnumArgs=true;}}(0,0));lodash.templateSettings={'escape':reEscape,'evaluate':reEvaluate,'interpolate':reInterpolate,'variable':'','imports':{'_':lodash}};function LazyWrapper(value){this.actions=null;this.dir=1;this.dropCount=0;this.filtered=false;this.iteratees=null;this.takeCount=POSITIVE_INFINITY;this.views=null;this.wrapped=value;}
function lazyClone(){var actions=this.actions,iteratees=this.iteratees,views=this.views,result=new LazyWrapper(this.wrapped);result.actions=actions?arrayCopy(actions):null;result.dir=this.dir;result.dropCount=this.dropCount;result.filtered=this.filtered;result.iteratees=iteratees?arrayCopy(iteratees):null;result.takeCount=this.takeCount;result.views=views?arrayCopy(views):null;return result;}
function lazyReverse(){if(this.filtered){var result=new LazyWrapper(this);result.dir=-1;result.filtered=true;}else{result=this.clone();result.dir*=-1;}
return result;}
function lazyValue(){var array=this.wrapped.value();if(!isArray(array)){return baseWrapperValue(array,this.actions);}
var dir=this.dir,isRight=dir<0,view=getView(0,array.length,this.views),start=view.start,end=view.end,length=end-start,dropCount=this.dropCount,takeCount=nativeMin(length,this.takeCount-dropCount),index=isRight?end:start-1,iteratees=this.iteratees,iterLength=iteratees?iteratees.length:0,resIndex=0,result=[];outer:while(length--&&resIndex<takeCount){index+=dir;var iterIndex=-1,value=array[index];while(++iterIndex<iterLength){var data=iteratees[iterIndex],iteratee=data.iteratee,computed=iteratee(value,index,array),type=data.type;if(type==LAZY_MAP_FLAG){value=computed;}else if(!computed){if(type==LAZY_FILTER_FLAG){continue outer;}else{break outer;}}}
if(dropCount){dropCount--;}else{result[resIndex++]=value;}}
return result;}
function MapCache(){this.__data__={};}
function mapDelete(key){return this.has(key)&&delete this.__data__[key];}
function mapGet(key){return key=='__proto__'?undefined:this.__data__[key];}
function mapHas(key){return key!='__proto__'&&hasOwnProperty.call(this.__data__,key);}
function mapSet(key,value){if(key!='__proto__'){this.__data__[key]=value;}
return this;}
function SetCache(values){var length=values?values.length:0;this.data={'hash':nativeCreate(null),'set':new Set};while(length--){this.push(values[length]);}}
function cacheIndexOf(cache,value){var data=cache.data,result=(typeof value=='string'||isObject(value))?data.set.has(value):data.hash[value];return result?0:-1;}
function cachePush(value){var data=this.data;if(typeof value=='string'||isObject(value)){data.set.add(value);}else{data.hash[value]=true;}}
function arrayCopy(source,array){var index=-1,length=source.length;array||(array=Array(length));while(++index<length){array[index]=source[index];}
return array;}
function arrayEach(array,iteratee){var index=-1,length=array.length;while(++index<length){if(iteratee(array[index],index,array)===false){break;}}
return array;}
function arrayEachRight(array,iteratee){var length=array.length;while(length--){if(iteratee(array[length],length,array)===false){break;}}
return array;}
function arrayEvery(array,predicate){var index=-1,length=array.length;while(++index<length){if(!predicate(array[index],index,array)){return false;}}
return true;}
function arrayFilter(array,predicate){var index=-1,length=array.length,resIndex=-1,result=[];while(++index<length){var value=array[index];if(predicate(value,index,array)){result[++resIndex]=value;}}
return result;}
function arrayMap(array,iteratee){var index=-1,length=array.length,result=Array(length);while(++index<length){result[index]=iteratee(array[index],index,array);}
return result;}
function arrayMax(array){var index=-1,length=array.length,result=NEGATIVE_INFINITY;while(++index<length){var value=array[index];if(value>result){result=value;}}
return result;}
function arrayMin(array){var index=-1,length=array.length,result=POSITIVE_INFINITY;while(++index<length){var value=array[index];if(value<result){result=value;}}
return result;}
function arrayReduce(array,iteratee,accumulator,initFromArray){var index=-1,length=array.length;if(initFromArray&&length){accumulator=array[++index];}
while(++index<length){accumulator=iteratee(accumulator,array[index],index,array);}
return accumulator;}
function arrayReduceRight(array,iteratee,accumulator,initFromArray){var length=array.length;if(initFromArray&&length){accumulator=array[--length];}
while(length--){accumulator=iteratee(accumulator,array[length],length,array);}
return accumulator;}
function arraySome(array,predicate){var index=-1,length=array.length;while(++index<length){if(predicate(array[index],index,array)){return true;}}
return false;}
function assignDefaults(objectValue,sourceValue){return typeof objectValue=='undefined'?sourceValue:objectValue;}
function assignOwnDefaults(objectValue,sourceValue,key,object){return(typeof objectValue=='undefined'||!hasOwnProperty.call(object,key))?sourceValue:objectValue;}
function baseAssign(object,source,customizer){var props=keys(source);if(!customizer){return baseCopy(source,object,props);}
var index=-1,length=props.length
while(++index<length){var key=props[index],value=object[key],result=customizer(value,source[key],key,object,source);if((result===result?result!==value:value===value)||(typeof value=='undefined'&&!(key in object))){object[key]=result;}}
return object;}
function baseAt(collection,props){var index=-1,length=collection.length,isArr=isLength(length),propsLength=props.length,result=Array(propsLength);while(++index<propsLength){var key=props[index];if(isArr){key=parseFloat(key);result[index]=isIndex(key,length)?collection[key]:undefined;}else{result[index]=collection[key];}}
return result;}
function baseCopy(source,object,props){if(!props){props=object;object={};}
var index=-1,length=props.length;while(++index<length){var key=props[index];object[key]=source[key];}
return object;}
function baseBindAll(object,methodNames){var index=-1,length=methodNames.length;while(++index<length){var key=methodNames[index];object[key]=createWrapper(object[key],BIND_FLAG,object);}
return object;}
function baseCallback(func,thisArg,argCount){var type=typeof func;if(type=='function'){return(typeof thisArg!='undefined'&&isBindable(func))?bindCallback(func,thisArg,argCount):func;}
if(func==null){return identity;}
return type=='object'?baseMatches(func):baseProperty(func+'');}
function baseClone(value,isDeep,customizer,key,object,stackA,stackB){var result;if(customizer){result=object?customizer(value,key,object):customizer(value);}
if(typeof result!='undefined'){return result;}
if(!isObject(value)){return value;}
var isArr=isArray(value);if(isArr){result=initCloneArray(value);if(!isDeep){return arrayCopy(value,result);}}else{var tag=objToString.call(value),isFunc=tag==funcTag;if(tag==objectTag||tag==argsTag||(isFunc&&!object)){result=initCloneObject(isFunc?{}:value);if(!isDeep){return baseCopy(value,result,keys(value));}}else{return cloneableTags[tag]?initCloneByTag(value,tag,isDeep):(object?value:{});}}
stackA||(stackA=[]);stackB||(stackB=[]);var length=stackA.length;while(length--){if(stackA[length]==value){return stackB[length];}}
stackA.push(value);stackB.push(result);(isArr?arrayEach:baseForOwn)(value,function(subValue,key){result[key]=baseClone(subValue,isDeep,customizer,key,value,stackA,stackB);});return result;}
var baseCreate=(function(){function Object(){}
return function(prototype){if(isObject(prototype)){Object.prototype=prototype;var result=new Object;Object.prototype=null;}
return result||context.Object();};}());function baseDelay(func,wait,args,fromIndex){if(!isFunction(func)){throw new TypeError(FUNC_ERROR_TEXT);}
return setTimeout(function(){func.apply(undefined,baseSlice(args,fromIndex));},wait);}
function baseDifference(array,values){var length=array?array.length:0,result=[];if(!length){return result;}
var index=-1,indexOf=getIndexOf(),isCommon=indexOf==baseIndexOf,cache=isCommon&&values.length>=200&&createCache(values),valuesLength=values.length;if(cache){indexOf=cacheIndexOf;isCommon=false;values=cache;}
outer:while(++index<length){var value=array[index];if(isCommon&&value===value){var valuesIndex=valuesLength;while(valuesIndex--){if(values[valuesIndex]===value){continue outer;}}
result.push(value);}
else if(indexOf(values,value)<0){result.push(value);}}
return result;}
function baseEach(collection,iteratee){var length=collection?collection.length:0;if(!isLength(length)){return baseForOwn(collection,iteratee);}
var index=-1,iterable=toObject(collection);while(++index<length){if(iteratee(iterable[index],index,iterable)===false){break;}}
return collection;}
function baseEachRight(collection,iteratee){var length=collection?collection.length:0;if(!isLength(length)){return baseForOwnRight(collection,iteratee);}
var iterable=toObject(collection);while(length--){if(iteratee(iterable[length],length,iterable)===false){break;}}
return collection;}
function baseEvery(collection,predicate){var result=true;baseEach(collection,function(value,index,collection){result=!!predicate(value,index,collection);return result;});return result;}
function baseFilter(collection,predicate){var result=[];baseEach(collection,function(value,index,collection){if(predicate(value,index,collection)){result.push(value);}});return result;}
function baseFind(collection,predicate,eachFunc,retKey){var result;eachFunc(collection,function(value,key,collection){if(predicate(value,key,collection)){result=retKey?key:value;return false;}});return result;}
function baseFlatten(array,isDeep,isStrict,fromIndex){var index=(fromIndex||0)-1,length=array.length,resIndex=-1,result=[];while(++index<length){var value=array[index];if(isObjectLike(value)&&isLength(value.length)&&(isArray(value)||isArguments(value))){if(isDeep){value=baseFlatten(value,isDeep,isStrict);}
var valIndex=-1,valLength=value.length;result.length+=valLength;while(++valIndex<valLength){result[++resIndex]=value[valIndex];}}else if(!isStrict){result[++resIndex]=value;}}
return result;}
function baseFor(object,iteratee,keysFunc){var index=-1,iterable=toObject(object),props=keysFunc(object),length=props.length;while(++index<length){var key=props[index];if(iteratee(iterable[key],key,iterable)===false){break;}}
return object;}
function baseForRight(object,iteratee,keysFunc){var iterable=toObject(object),props=keysFunc(object),length=props.length;while(length--){var key=props[length];if(iteratee(iterable[key],key,iterable)===false){break;}}
return object;}
function baseForIn(object,iteratee){return baseFor(object,iteratee,keysIn);}
function baseForOwn(object,iteratee){return baseFor(object,iteratee,keys);}
function baseForOwnRight(object,iteratee){return baseForRight(object,iteratee,keys);}
function baseFunctions(object,props){var index=-1,length=props.length,resIndex=-1,result=[];while(++index<length){var key=props[index];if(isFunction(object[key])){result[++resIndex]=key;}}
return result;}
function baseInvoke(collection,methodName,args){var index=-1,isFunc=typeof methodName=='function',length=collection?collection.length:0,result=isLength(length)?Array(length):[];baseEach(collection,function(value){var func=isFunc?methodName:(value!=null&&value[methodName]);result[++index]=func?func.apply(value,args):undefined;});return result;}
function baseIsEqual(value,other,customizer,isWhere,stackA,stackB){if(value===other){return value!==0||(1/value==1/other);}
var valType=typeof value,othType=typeof other;if((valType!='function'&&valType!='object'&&othType!='function'&&othType!='object')||value==null||other==null){return value!==value&&other!==other;}
return baseIsEqualDeep(value,other,baseIsEqual,customizer,isWhere,stackA,stackB);}
function baseIsEqualDeep(object,other,equalFunc,customizer,isWhere,stackA,stackB){var objIsArr=isArray(object),othIsArr=isArray(other),objTag=arrayTag,othTag=arrayTag;if(!objIsArr){objTag=objToString.call(object);if(objTag==argsTag){objTag=objectTag;}else if(objTag!=objectTag){objIsArr=isTypedArray(object);}}
if(!othIsArr){othTag=objToString.call(other);if(othTag==argsTag){othTag=objectTag;}else if(othTag!=objectTag){othIsArr=isTypedArray(other);}}
var objIsObj=objTag==objectTag,othIsObj=othTag==objectTag,isSameTag=objTag==othTag;if(isSameTag&&!(objIsArr||objIsObj)){return equalByTag(object,other,objTag);}
var valWrapped=objIsObj&&hasOwnProperty.call(object,'__wrapped__'),othWrapped=othIsObj&&hasOwnProperty.call(other,'__wrapped__');if(valWrapped||othWrapped){return equalFunc(valWrapped?object.value():object,othWrapped?other.value():other,customizer,isWhere,stackA,stackB);}
if(!isSameTag){return false;}
stackA||(stackA=[]);stackB||(stackB=[]);var length=stackA.length;while(length--){if(stackA[length]==object){return stackB[length]==other;}}
stackA.push(object);stackB.push(other);var result=(objIsArr?equalArrays:equalObjects)(object,other,equalFunc,customizer,isWhere,stackA,stackB);stackA.pop();stackB.pop();return result;}
function baseIsMatch(object,props,values,strictCompareFlags,customizer){var length=props.length;if(object==null){return!length;}
var index=-1,noCustomizer=!customizer;while(++index<length){if((noCustomizer&&strictCompareFlags[index])?values[index]!==object[props[index]]:!hasOwnProperty.call(object,props[index])){return false;}}
index=-1;while(++index<length){var key=props[index];if(noCustomizer&&strictCompareFlags[index]){var result=hasOwnProperty.call(object,key);}else{var objValue=object[key],srcValue=values[index];result=customizer?customizer(objValue,srcValue,key):undefined;if(typeof result=='undefined'){result=baseIsEqual(srcValue,objValue,customizer,true);}}
if(!result){return false;}}
return true;}
function baseMap(collection,iteratee){var result=[];baseEach(collection,function(value,key,collection){result.push(iteratee(value,key,collection));});return result;}
function baseMatches(source){var props=keys(source),length=props.length;if(length==1){var key=props[0],value=source[key];if(isStrictComparable(value)){return function(object){return object!=null&&value===object[key]&&hasOwnProperty.call(object,key);};}}
var values=Array(length),strictCompareFlags=Array(length);while(length--){value=source[props[length]];values[length]=value;strictCompareFlags[length]=isStrictComparable(value);}
return function(object){return baseIsMatch(object,props,values,strictCompareFlags);};}
function baseMerge(object,source,customizer,stackA,stackB){var isSrcArr=isLength(source.length)&&(isArray(source)||isTypedArray(source));(isSrcArr?arrayEach:baseForOwn)(source,function(srcValue,key,source){if(isObjectLike(srcValue)){stackA||(stackA=[]);stackB||(stackB=[]);return baseMergeDeep(object,source,key,baseMerge,customizer,stackA,stackB);}
var value=object[key],result=customizer?customizer(value,srcValue,key,object,source):undefined,isCommon=typeof result=='undefined';if(isCommon){result=srcValue;}
if((isSrcArr||typeof result!='undefined')&&(isCommon||(result===result?result!==value:value===value))){object[key]=result;}});return object;}
function baseMergeDeep(object,source,key,mergeFunc,customizer,stackA,stackB){var length=stackA.length,srcValue=source[key];while(length--){if(stackA[length]==srcValue){object[key]=stackB[length];return;}}
var value=object[key],result=customizer?customizer(value,srcValue,key,object,source):undefined,isCommon=typeof result=='undefined';if(isCommon){result=srcValue;if(isLength(srcValue.length)&&(isArray(srcValue)||isTypedArray(srcValue))){result=isArray(value)?value:(value?arrayCopy(value):[]);}
else if(isPlainObject(srcValue)||isArguments(srcValue)){result=isArguments(value)?toPlainObject(value):(isPlainObject(value)?value:{});}
else{isCommon=false;}}
stackA.push(srcValue);stackB.push(result);if(isCommon){object[key]=mergeFunc(result,srcValue,customizer,stackA,stackB);}else if(result===result?result!==value:value===value){object[key]=result;}}
function baseProperty(key){return function(object){return object==null?undefined:object[key];};}
function basePullAt(array,indexes){var length=indexes.length,result=baseAt(array,indexes);indexes.sort(baseCompareAscending);while(length--){var index=parseFloat(indexes[length]);if(index!=previous&&isIndex(index)){var previous=index;splice.call(array,index,1);}}
return result;}
function baseRandom(min,max){return min+floor(nativeRandom()*(max-min+1));}
function baseReduce(collection,iteratee,accumulator,initFromCollection,eachFunc){eachFunc(collection,function(value,index,collection){accumulator=initFromCollection?(initFromCollection=false,value):iteratee(accumulator,value,index,collection)});return accumulator;}
var baseSetData=!metaMap?identity:function(func,data){metaMap.set(func,data);return func;};function baseSlice(array,start,end){var index=-1,length=array.length;start=start==null?0:(+start||0);if(start<0){start=-start>length?0:(length+start);}
end=(typeof end=='undefined'||end>length)?length:(+end||0);if(end<0){end+=length;}
length=start>end?0:(end-start)>>>0;start>>>=0;var result=Array(length);while(++index<length){result[index]=array[index+start];}
return result;}
function baseSome(collection,predicate){var result;baseEach(collection,function(value,index,collection){result=predicate(value,index,collection);return!result;});return!!result;}
function baseUniq(array,iteratee){var index=-1,indexOf=getIndexOf(),length=array.length,isCommon=indexOf==baseIndexOf,isLarge=isCommon&&length>=200,seen=isLarge&&createCache(),result=[];if(seen){indexOf=cacheIndexOf;isCommon=false;}else{isLarge=false;seen=iteratee?[]:result;}
outer:while(++index<length){var value=array[index],computed=iteratee?iteratee(value,index,array):value;if(isCommon&&value===value){var seenIndex=seen.length;while(seenIndex--){if(seen[seenIndex]===computed){continue outer;}}
if(iteratee){seen.push(computed);}
result.push(value);}
else if(indexOf(seen,computed)<0){if(iteratee||isLarge){seen.push(computed);}
result.push(value);}}
return result;}
function baseValues(object,props){var index=-1,length=props.length,result=Array(length);while(++index<length){result[index]=object[props[index]];}
return result;}
function baseWrapperValue(value,actions){var result=value;if(result instanceof LazyWrapper){result=result.value();}
var index=-1,length=actions.length;while(++index<length){var args=[result],action=actions[index];push.apply(args,action.args);result=action.func.apply(action.thisArg,args);}
return result;}
function binaryIndex(array,value,retHighest){var low=0,high=array?array.length:low;if(typeof value=='number'&&value===value&&high<=HALF_MAX_ARRAY_LENGTH){while(low<high){var mid=(low+high)>>>1,computed=array[mid];if(retHighest?(computed<=value):(computed<value)){low=mid+1;}else{high=mid;}}
return high;}
return binaryIndexBy(array,value,identity,retHighest);}
function binaryIndexBy(array,value,iteratee,retHighest){value=iteratee(value);var low=0,high=array?array.length:0,valIsNaN=value!==value,valIsUndef=typeof value=='undefined';while(low<high){var mid=floor((low+high)/2),computed=iteratee(array[mid]),isReflexive=computed===computed;if(valIsNaN){var setLow=isReflexive||retHighest;}else if(valIsUndef){setLow=isReflexive&&(retHighest||typeof computed!='undefined');}else{setLow=retHighest?(computed<=value):(computed<value);}
if(setLow){low=mid+1;}else{high=mid;}}
return nativeMin(high,MAX_ARRAY_INDEX);}
function bindCallback(func,thisArg,argCount){if(typeof func!='function'){return identity;}
if(typeof thisArg=='undefined'){return func;}
switch(argCount){case 1:return function(value){return func.call(thisArg,value);};case 3:return function(value,index,collection){return func.call(thisArg,value,index,collection);};case 4:return function(accumulator,value,index,collection){return func.call(thisArg,accumulator,value,index,collection);};case 5:return function(value,other,key,object,source){return func.call(thisArg,value,other,key,object,source);};}
return function(){return func.apply(thisArg,arguments);};}
function bufferClone(buffer){return bufferSlice.call(buffer,0);}
if(!bufferSlice){bufferClone=!(ArrayBuffer&&Uint8Array)?constant(null):function(buffer){var byteLength=buffer.byteLength,floatLength=Float64Array?floor(byteLength/FLOAT64_BYTES_PER_ELEMENT):0,offset=floatLength*FLOAT64_BYTES_PER_ELEMENT,result=new ArrayBuffer(byteLength);if(floatLength){var view=new Float64Array(result,0,floatLength);view.set(new Float64Array(buffer,0,floatLength));}
if(byteLength!=offset){view=new Uint8Array(result,offset);view.set(new Uint8Array(buffer,offset));}
return result;};}
function composeArgs(args,partials,holders){var holdersLength=holders.length,argsIndex=-1,argsLength=nativeMax(args.length-holdersLength,0),leftIndex=-1,leftLength=partials.length,result=Array(argsLength+leftLength);while(++leftIndex<leftLength){result[leftIndex]=partials[leftIndex];}
while(++argsIndex<holdersLength){result[holders[argsIndex]]=args[argsIndex];}
while(argsLength--){result[leftIndex++]=args[argsIndex++];}
return result;}
function composeArgsRight(args,partials,holders){var holdersIndex=-1,holdersLength=holders.length,argsIndex=-1,argsLength=nativeMax(args.length-holdersLength,0),rightIndex=-1,rightLength=partials.length,result=Array(argsLength+rightLength);while(++argsIndex<argsLength){result[argsIndex]=args[argsIndex];}
var pad=argsIndex;while(++rightIndex<rightLength){result[pad+rightIndex]=partials[rightIndex];}
while(++holdersIndex<holdersLength){result[pad+holders[holdersIndex]]=args[argsIndex++];}
return result;}
function createAggregator(setter,initializer){return function(collection,iteratee,thisArg){var result=initializer?initializer():{};iteratee=getCallback(iteratee,thisArg,3);if(isArray(collection)){var index=-1,length=collection.length;while(++index<length){var value=collection[index];setter(result,value,iteratee(value,index,collection),collection);}}else{baseEach(collection,function(value,key,collection){setter(result,value,iteratee(value,key,collection),collection);});}
return result;};}
function createAssigner(assigner){return function(){var length=arguments.length,object=arguments[0];if(length<2||object==null){return object;}
if(length>3&&isIterateeCall(arguments[1],arguments[2],arguments[3])){length=2;}
if(length>3&&typeof arguments[length-2]=='function'){var customizer=bindCallback(arguments[--length-1],arguments[length--],5);}else if(length>2&&typeof arguments[length-1]=='function'){customizer=arguments[--length];}
var index=0;while(++index<length){var source=arguments[index];if(source){assigner(object,source,customizer);}}
return object;};}
function createBindWrapper(func,thisArg){var Ctor=createCtorWrapper(func);function wrapper(){return(this instanceof wrapper?Ctor:func).apply(thisArg,arguments);}
return wrapper;}
var createCache=!(nativeCreate&&Set)?constant(null):function(values){return new SetCache(values);};function createCompounder(callback){return function(string){var index=-1,array=words(deburr(string)),length=array.length,result='';while(++index<length){result=callback(result,array[index],index);}
return result;};}
function createCtorWrapper(Ctor){return function(){var thisBinding=baseCreate(Ctor.prototype),result=Ctor.apply(thisBinding,arguments);return isObject(result)?result:thisBinding;};}
function createExtremum(arrayFunc,isMin){return function(collection,iteratee,thisArg){if(thisArg&&isIterateeCall(collection,iteratee,thisArg)){iteratee=null;}
var func=getCallback(),noIteratee=iteratee==null;if(!(func===baseCallback&&noIteratee)){noIteratee=false;iteratee=func(iteratee,thisArg,3);}
if(noIteratee){var isArr=isArray(collection);if(!isArr&&isString(collection)){iteratee=charAtCallback;}else{return arrayFunc(isArr?collection:toIterable(collection));}}
return extremumBy(collection,iteratee,isMin);};}
function createHybridWrapper(func,bitmask,thisArg,partials,holders,partialsRight,holdersRight,argPos,ary,arity){var isAry=bitmask&ARY_FLAG,isBind=bitmask&BIND_FLAG,isBindKey=bitmask&BIND_KEY_FLAG,isCurry=bitmask&CURRY_FLAG,isCurryBound=bitmask&CURRY_BOUND_FLAG,isCurryRight=bitmask&CURRY_RIGHT_FLAG;var Ctor=!isBindKey&&createCtorWrapper(func),key=func;function wrapper(){var length=arguments.length,index=length,args=Array(length);while(index--){args[index]=arguments[index];}
if(partials){args=composeArgs(args,partials,holders);}
if(partialsRight){args=composeArgsRight(args,partialsRight,holdersRight);}
if(isCurry||isCurryRight){var placeholder=wrapper.placeholder,argsHolders=replaceHolders(args,placeholder);length-=argsHolders.length;if(length<arity){var newArgPos=argPos?arrayCopy(argPos):null,newArity=nativeMax(arity-length,0),newsHolders=isCurry?argsHolders:null,newHoldersRight=isCurry?null:argsHolders,newPartials=isCurry?args:null,newPartialsRight=isCurry?null:args;bitmask|=(isCurry?PARTIAL_FLAG:PARTIAL_RIGHT_FLAG);bitmask&=~(isCurry?PARTIAL_RIGHT_FLAG:PARTIAL_FLAG);if(!isCurryBound){bitmask&=~(BIND_FLAG|BIND_KEY_FLAG);}
var result=createHybridWrapper(func,bitmask,thisArg,newPartials,newsHolders,newPartialsRight,newHoldersRight,newArgPos,ary,newArity);result.placeholder=placeholder;return result;}}
var thisBinding=isBind?thisArg:this;if(isBindKey){func=thisBinding[key];}
if(argPos){args=reorder(args,argPos);}
if(isAry&&ary<args.length){args.length=ary;}
return(this instanceof wrapper?(Ctor||createCtorWrapper(func)):func).apply(thisBinding,args);}
return wrapper;}
function createPad(string,length,chars){var strLength=string.length;length=+length;if(strLength>=length||!nativeIsFinite(length)){return'';}
var padLength=length-strLength;chars=chars==null?' ':(chars+'');return repeat(chars,ceil(padLength/chars.length)).slice(0,padLength);}
function createPartialWrapper(func,bitmask,thisArg,partials){var isBind=bitmask&BIND_FLAG,Ctor=createCtorWrapper(func);function wrapper(){var argsIndex=-1,argsLength=arguments.length,leftIndex=-1,leftLength=partials.length,args=Array(argsLength+leftLength);while(++leftIndex<leftLength){args[leftIndex]=partials[leftIndex];}
while(argsLength--){args[leftIndex++]=arguments[++argsIndex];}
return(this instanceof wrapper?Ctor:func).apply(isBind?thisArg:this,args);}
return wrapper;}
function createWrapper(func,bitmask,thisArg,partials,holders,argPos,ary,arity){var isBindKey=bitmask&BIND_KEY_FLAG;if(!isBindKey&&!isFunction(func)){throw new TypeError(FUNC_ERROR_TEXT);}
var length=partials?partials.length:0;if(!length){bitmask&=~(PARTIAL_FLAG|PARTIAL_RIGHT_FLAG);partials=holders=null;}
length-=(holders?holders.length:0);if(bitmask&PARTIAL_RIGHT_FLAG){var partialsRight=partials,holdersRight=holders;partials=holders=null;}
var data=!isBindKey&&getData(func),newData=[func,bitmask,thisArg,partials,holders,partialsRight,holdersRight,argPos,ary,arity];if(data&&data!==true){mergeData(newData,data);bitmask=newData[1];arity=newData[9];}
newData[9]=arity==null?(isBindKey?0:func.length):(nativeMax(arity-length,0)||0);if(bitmask==BIND_FLAG){var result=createBindWrapper(newData[0],newData[2]);}else if((bitmask==PARTIAL_FLAG||bitmask==(BIND_FLAG|PARTIAL_FLAG))&&!newData[4].length){result=createPartialWrapper.apply(null,newData);}else{result=createHybridWrapper.apply(null,newData);}
var setter=data?baseSetData:setData;return setter(result,newData);}
function equalArrays(array,other,equalFunc,customizer,isWhere,stackA,stackB){var index=-1,arrLength=array.length,othLength=other.length,result=true;if(arrLength!=othLength&&!(isWhere&&othLength>arrLength)){return false;}
while(result&&++index<arrLength){var arrValue=array[index],othValue=other[index];result=undefined;if(customizer){result=isWhere?customizer(othValue,arrValue,index):customizer(arrValue,othValue,index);}
if(typeof result=='undefined'){if(isWhere){var othIndex=othLength;while(othIndex--){othValue=other[othIndex];result=(arrValue&&arrValue===othValue)||equalFunc(arrValue,othValue,customizer,isWhere,stackA,stackB);if(result){break;}}}else{result=(arrValue&&arrValue===othValue)||equalFunc(arrValue,othValue,customizer,isWhere,stackA,stackB);}}}
return!!result;}
function equalByTag(object,other,tag){switch(tag){case boolTag:case dateTag:return+object==+other;case errorTag:return object.name==other.name&&object.message==other.message;case numberTag:return(object!=+object)?other!=+other:(object==0?((1/object)==(1/other)):object==+other);case regexpTag:case stringTag:return object==(other+'');}
return false;}
function equalObjects(object,other,equalFunc,customizer,isWhere,stackA,stackB){var objProps=keys(object),objLength=objProps.length,othProps=keys(other),othLength=othProps.length;if(objLength!=othLength&&!isWhere){return false;}
var hasCtor,index=-1;while(++index<objLength){var key=objProps[index],result=hasOwnProperty.call(other,key);if(result){var objValue=object[key],othValue=other[key];result=undefined;if(customizer){result=isWhere?customizer(othValue,objValue,key):customizer(objValue,othValue,key);}
if(typeof result=='undefined'){result=(objValue&&objValue===othValue)||equalFunc(objValue,othValue,customizer,isWhere,stackA,stackB);}}
if(!result){return false;}
hasCtor||(hasCtor=key=='constructor');}
if(!hasCtor){var objCtor=object.constructor,othCtor=other.constructor;if(objCtor!=othCtor&&('constructor'in object&&'constructor'in other)&&!(typeof objCtor=='function'&&objCtor instanceof objCtor&&typeof othCtor=='function'&&othCtor instanceof othCtor)){return false;}}
return true;}
function extremumBy(collection,iteratee,isMin){var exValue=isMin?POSITIVE_INFINITY:NEGATIVE_INFINITY,computed=exValue,result=computed;baseEach(collection,function(value,index,collection){var current=iteratee(value,index,collection);if((isMin?current<computed:current>computed)||(current===exValue&&current===result)){computed=current;result=value;}});return result;}
function getCallback(func,thisArg,argCount){var result=lodash.callback||callback;result=result===callback?baseCallback:result;return argCount?result(func,thisArg,argCount):result;}
var getData=!metaMap?noop:function(func){return metaMap.get(func);};function getIndexOf(collection,target,fromIndex){var result=lodash.indexOf||indexOf;result=result===indexOf?baseIndexOf:result;return collection?result(collection,target,fromIndex):result;}
function getView(start,end,transforms){var index=-1,length=transforms?transforms.length:0;while(++index<length){var data=transforms[index],size=data.size;switch(data.type){case'drop':start+=size;break;case'dropRight':end-=size;break;case'take':end=nativeMin(end,start+size);break;case'takeRight':start=nativeMax(start,end-size);break;}}
return{'start':start,'end':end};}
function initCloneArray(array){var length=array.length,result=new array.constructor(length);if(length&&typeof array[0]=='string'&&hasOwnProperty.call(array,'index')){result.index=array.index;result.input=array.input;}
return result;}
function initCloneObject(object){var Ctor=object.constructor;if(!(typeof Ctor=='function'&&Ctor instanceof Ctor)){Ctor=Object;}
return new Ctor;}
function initCloneByTag(object,tag,isDeep){var Ctor=object.constructor;switch(tag){case arrayBufferTag:return bufferClone(object);case boolTag:case dateTag:return new Ctor(+object);case float32Tag:case float64Tag:case int8Tag:case int16Tag:case int32Tag:case uint8Tag:case uint8ClampedTag:case uint16Tag:case uint32Tag:var buffer=object.buffer;return new Ctor(isDeep?bufferClone(buffer):buffer,object.byteOffset,object.length);case numberTag:case stringTag:return new Ctor(object);case regexpTag:var result=new Ctor(object.source,reFlags.exec(object));result.lastIndex=object.lastIndex;}
return result;}
function isBindable(func){var support=lodash.support,result=!(support.funcNames?func.name:support.funcDecomp);if(!result){var source=fnToString.call(func);if(!support.funcNames){result=!reFuncName.test(source);}
if(!result){result=reThis.test(source)||isNative(func);baseSetData(func,result);}}
return result;}
function isIndex(value,length){value=+value;length=length==null?MAX_SAFE_INTEGER:length;return value>-1&&value%1==0&&value<length;}
function isIterateeCall(value,index,object){if(!isObject(object)){return false;}
var type=typeof index;if(type=='number'){var length=object.length,prereq=isLength(length)&&isIndex(index,length);}else{prereq=type=='string'&&index in object;}
return prereq&&object[index]===value;}
function isLength(value){return typeof value=='number'&&value>-1&&value%1==0&&value<=MAX_SAFE_INTEGER;}
function isStrictComparable(value){return value===value&&(value===0?((1/value)>0):!isObject(value));}
function mergeData(data,source){var bitmask=data[1],srcBitmask=source[1],newBitmask=bitmask|srcBitmask;var arityFlags=ARY_FLAG|REARG_FLAG,bindFlags=BIND_FLAG|BIND_KEY_FLAG,comboFlags=arityFlags|bindFlags|CURRY_BOUND_FLAG|CURRY_RIGHT_FLAG;var isAry=bitmask&ARY_FLAG&&!(srcBitmask&ARY_FLAG),isRearg=bitmask&REARG_FLAG&&!(srcBitmask&REARG_FLAG),argPos=(isRearg?data:source)[7],ary=(isAry?data:source)[8];var isCommon=!(bitmask>=REARG_FLAG&&srcBitmask>bindFlags)&&!(bitmask>bindFlags&&srcBitmask>=REARG_FLAG);var isCombo=(newBitmask>=arityFlags&&newBitmask<=comboFlags)&&(bitmask<REARG_FLAG||((isRearg||isAry)&&argPos.length<=ary));if(!(isCommon||isCombo)){return data;}
if(srcBitmask&BIND_FLAG){data[2]=source[2];newBitmask|=(bitmask&BIND_FLAG)?0:CURRY_BOUND_FLAG;}
var value=source[3];if(value){var partials=data[3];data[3]=partials?composeArgs(partials,value,source[4]):arrayCopy(value);data[4]=partials?replaceHolders(data[3],PLACEHOLDER):arrayCopy(source[4]);}
value=source[5];if(value){partials=data[5];data[5]=partials?composeArgsRight(partials,value,source[6]):arrayCopy(value);data[6]=partials?replaceHolders(data[5],PLACEHOLDER):arrayCopy(source[6]);}
value=source[7];if(value){data[7]=arrayCopy(value);}
if(srcBitmask&ARY_FLAG){data[8]=data[8]==null?source[8]:nativeMin(data[8],source[8]);}
if(data[9]==null){data[9]=source[9];}
data[0]=source[0];data[1]=newBitmask;return data;}
function pickByArray(object,props){object=toObject(object);var index=-1,length=props.length,result={};while(++index<length){var key=props[index];if(key in object){result[key]=object[key];}}
return result;}
function pickByCallback(object,predicate){var result={};baseForIn(object,function(value,key,object){if(predicate(value,key,object)){result[key]=value;}});return result;}
function reorder(array,indexes){var arrLength=array.length,length=nativeMin(indexes.length,arrLength),oldArray=arrayCopy(array);while(length--){var index=indexes[length];array[length]=isIndex(index,arrLength)?oldArray[index]:undefined;}
return array;}
var setData=(function(){var count=0,lastCalled=0;return function(key,value){var stamp=now(),remaining=HOT_SPAN-(stamp-lastCalled);lastCalled=stamp;if(remaining>0){if(++count>=HOT_COUNT){return key;}}else{count=0;}
return baseSetData(key,value);};}());function shimIsPlainObject(value){var Ctor,support=lodash.support;if(!(isObjectLike(value)&&objToString.call(value)==objectTag)||(!hasOwnProperty.call(value,'constructor')&&(Ctor=value.constructor,typeof Ctor=='function'&&!(Ctor instanceof Ctor)))){return false;}
var result;baseForIn(value,function(subValue,key){result=key;});return typeof result=='undefined'||hasOwnProperty.call(value,result);}
function shimKeys(object){var props=keysIn(object),propsLength=props.length,length=propsLength&&object.length,support=lodash.support;var allowIndexes=length&&isLength(length)&&(isArray(object)||(support.nonEnumArgs&&isArguments(object)));var index=-1,result=[];while(++index<propsLength){var key=props[index];if((allowIndexes&&isIndex(key,length))||hasOwnProperty.call(object,key)){result.push(key);}}
return result;}
function toIterable(value){if(value==null){return[];}
if(!isLength(value.length)){return values(value);}
return isObject(value)?value:Object(value);}
function toObject(value){return isObject(value)?value:Object(value);}
function chunk(array,size,guard){if(guard?isIterateeCall(array,size,guard):size==null){size=1;}else{size=nativeMax(+size||1,1);}
var index=0,length=array?array.length:0,resIndex=-1,result=Array(ceil(length/size));while(index<length){result[++resIndex]=baseSlice(array,index,(index+=size));}
return result;}
function compact(array){var index=-1,length=array?array.length:0,resIndex=-1,result=[];while(++index<length){var value=array[index];if(value){result[++resIndex]=value;}}
return result;}
function difference(){var index=-1,length=arguments.length;while(++index<length){var value=arguments[index];if(isArray(value)||isArguments(value)){break;}}
return baseDifference(value,baseFlatten(arguments,false,true,++index));}
function drop(array,n,guard){var length=array?array.length:0;if(!length){return[];}
if(guard?isIterateeCall(array,n,guard):n==null){n=1;}
return baseSlice(array,n<0?0:n);}
function dropRight(array,n,guard){var length=array?array.length:0;if(!length){return[];}
if(guard?isIterateeCall(array,n,guard):n==null){n=1;}
n=length-(+n||0);return baseSlice(array,0,n<0?0:n);}
function dropRightWhile(array,predicate,thisArg){var length=array?array.length:0;if(!length){return[];}
predicate=getCallback(predicate,thisArg,3);while(length--&&predicate(array[length],length,array)){}
return baseSlice(array,0,length+1);}
function dropWhile(array,predicate,thisArg){var length=array?array.length:0;if(!length){return[];}
var index=-1;predicate=getCallback(predicate,thisArg,3);while(++index<length&&predicate(array[index],index,array)){}
return baseSlice(array,index);}
function findIndex(array,predicate,thisArg){var index=-1,length=array?array.length:0;predicate=getCallback(predicate,thisArg,3);while(++index<length){if(predicate(array[index],index,array)){return index;}}
return-1;}
function findLastIndex(array,predicate,thisArg){var length=array?array.length:0;predicate=getCallback(predicate,thisArg,3);while(length--){if(predicate(array[length],length,array)){return length;}}
return-1;}
function first(array){return array?array[0]:undefined;}
function flatten(array,isDeep,guard){var length=array?array.length:0;if(guard&&isIterateeCall(array,isDeep,guard)){isDeep=false;}
return length?baseFlatten(array,isDeep):[];}
function flattenDeep(array){var length=array?array.length:0;return length?baseFlatten(array,true):[];}
function indexOf(array,value,fromIndex){var length=array?array.length:0;if(!length){return-1;}
if(typeof fromIndex=='number'){fromIndex=fromIndex<0?nativeMax(length+fromIndex,0):(fromIndex||0);}else if(fromIndex){var index=binaryIndex(array,value),other=array[index];return(value===value?value===other:other!==other)?index:-1;}
return baseIndexOf(array,value,fromIndex);}
function initial(array){return dropRight(array,1);}
function intersection(){var args=[],argsIndex=-1,argsLength=arguments.length,caches=[],indexOf=getIndexOf(),isCommon=indexOf==baseIndexOf;while(++argsIndex<argsLength){var value=arguments[argsIndex];if(isArray(value)||isArguments(value)){args.push(value);caches.push(isCommon&&value.length>=120&&createCache(argsIndex&&value));}}
argsLength=args.length;var array=args[0],index=-1,length=array?array.length:0,result=[],seen=caches[0];outer:while(++index<length){value=array[index];if((seen?cacheIndexOf(seen,value):indexOf(result,value))<0){argsIndex=argsLength;while(--argsIndex){var cache=caches[argsIndex];if((cache?cacheIndexOf(cache,value):indexOf(args[argsIndex],value))<0){continue outer;}}
if(seen){seen.push(value);}
result.push(value);}}
return result;}
function last(array){var length=array?array.length:0;return length?array[length-1]:undefined;}
function lastIndexOf(array,value,fromIndex){var length=array?array.length:0;if(!length){return-1;}
var index=length;if(typeof fromIndex=='number'){index=(fromIndex<0?nativeMax(length+fromIndex,0):nativeMin(fromIndex||0,length-1))+1;}else if(fromIndex){index=binaryIndex(array,value,true)-1;var other=array[index];return(value===value?value===other:other!==other)?index:-1;}
if(value!==value){return indexOfNaN(array,index,true);}
while(index--){if(array[index]===value){return index;}}
return-1;}
function pull(){var array=arguments[0];if(!(array&&array.length)){return array;}
var index=0,indexOf=getIndexOf(),length=arguments.length;while(++index<length){var fromIndex=0,value=arguments[index];while((fromIndex=indexOf(array,value,fromIndex))>-1){splice.call(array,fromIndex,1);}}
return array;}
function pullAt(array){return basePullAt(array||[],baseFlatten(arguments,false,false,1));}
function remove(array,predicate,thisArg){var index=-1,length=array?array.length:0,result=[];predicate=getCallback(predicate,thisArg,3);while(++index<length){var value=array[index];if(predicate(value,index,array)){result.push(value);splice.call(array,index--,1);length--;}}
return result;}
function rest(array){return drop(array,1);}
function slice(array,start,end){var length=array?array.length:0;if(!length){return[];}
if(end&&typeof end!='number'&&isIterateeCall(array,start,end)){start=0;end=length;}
return baseSlice(array,start,end);}
function sortedIndex(array,value,iteratee,thisArg){var func=getCallback(iteratee);return(func===baseCallback&&iteratee==null)?binaryIndex(array,value):binaryIndexBy(array,value,func(iteratee,thisArg,1));}
function sortedLastIndex(array,value,iteratee,thisArg){var func=getCallback(iteratee);return(func===baseCallback&&iteratee==null)?binaryIndex(array,value,true):binaryIndexBy(array,value,func(iteratee,thisArg,1),true);}
function take(array,n,guard){var length=array?array.length:0;if(!length){return[];}
if(guard?isIterateeCall(array,n,guard):n==null){n=1;}
return baseSlice(array,0,n<0?0:n);}
function takeRight(array,n,guard){var length=array?array.length:0;if(!length){return[];}
if(guard?isIterateeCall(array,n,guard):n==null){n=1;}
n=length-(+n||0);return baseSlice(array,n<0?0:n);}
function takeRightWhile(array,predicate,thisArg){var length=array?array.length:0;if(!length){return[];}
predicate=getCallback(predicate,thisArg,3);while(length--&&predicate(array[length],length,array)){}
return baseSlice(array,length+1);}
function takeWhile(array,predicate,thisArg){var length=array?array.length:0;if(!length){return[];}
var index=-1;predicate=getCallback(predicate,thisArg,3);while(++index<length&&predicate(array[index],index,array)){}
return baseSlice(array,0,index);}
function union(){return baseUniq(baseFlatten(arguments,false,true));}
function uniq(array,isSorted,iteratee,thisArg){var length=array?array.length:0;if(!length){return[];}
if(typeof isSorted!='boolean'&&isSorted!=null){thisArg=iteratee;iteratee=isIterateeCall(array,isSorted,thisArg)?null:isSorted;isSorted=false;}
var func=getCallback();if(!(func===baseCallback&&iteratee==null)){iteratee=func(iteratee,thisArg,3);}
return(isSorted&&getIndexOf()==baseIndexOf)?sortedUniq(array,iteratee):baseUniq(array,iteratee);}
function unzip(array){var index=-1,length=(array&&array.length&&arrayMax(arrayMap(array,getLength)))>>>0,result=Array(length);while(++index<length){result[index]=arrayMap(array,baseProperty(index));}
return result;}
function without(array){return baseDifference(array,baseSlice(arguments,1));}
function xor(){var index=-1,length=arguments.length;while(++index<length){var array=arguments[index];if(isArray(array)||isArguments(array)){var result=result?baseDifference(result,array).concat(baseDifference(array,result)):array;}}
return result?baseUniq(result):[];}
function zip(){var length=arguments.length,array=Array(length);while(length--){array[length]=arguments[length];}
return unzip(array);}
function zipObject(props,values){var index=-1,length=props?props.length:0,result={};if(length&&!values&&!isArray(props[0])){values=[];}
while(++index<length){var key=props[index];if(values){result[key]=values[index];}else if(key){result[key[0]]=key[1];}}
return result;}
function chain(value){var result=lodash(value);result.__chain__=true;return result;}
function tap(value,interceptor,thisArg){interceptor.call(thisArg,value);return value;}
function thru(value,interceptor,thisArg){return interceptor.call(thisArg,value);}
function wrapperChain(){return chain(this);}
function wrapperReverse(){var value=this.__wrapped__;if(value instanceof LazyWrapper){if(this.__actions__.length){value=new LazyWrapper(this);}
return new LodashWrapper(value.reverse());}
return this.thru(function(value){return value.reverse();});}
function wrapperToString(){return(this.value()+'');}
function wrapperValue(){return baseWrapperValue(this.__wrapped__,this.__actions__);}
function at(collection){var length=collection?collection.length:0;if(isLength(length)){collection=toIterable(collection);}
return baseAt(collection,baseFlatten(arguments,false,false,1));}
function includes(collection,target,fromIndex){var length=collection?collection.length:0;if(!isLength(length)){collection=values(collection);length=collection.length;}
if(!length){return false;}
if(typeof fromIndex=='number'){fromIndex=fromIndex<0?nativeMax(length+fromIndex,0):(fromIndex||0);}else{fromIndex=0;}
return(typeof collection=='string'||!isArray(collection)&&isString(collection))?(fromIndex<length&&collection.indexOf(target,fromIndex)>-1):(getIndexOf(collection,target,fromIndex)>-1);}
var countBy=createAggregator(function(result,value,key){hasOwnProperty.call(result,key)?++result[key]:(result[key]=1);});function every(collection,predicate,thisArg){var func=isArray(collection)?arrayEvery:baseEvery;if(typeof predicate!='function'||typeof thisArg!='undefined'){predicate=getCallback(predicate,thisArg,3);}
return func(collection,predicate);}
function filter(collection,predicate,thisArg){var func=isArray(collection)?arrayFilter:baseFilter;predicate=getCallback(predicate,thisArg,3);return func(collection,predicate);}
function find(collection,predicate,thisArg){if(isArray(collection)){var index=findIndex(collection,predicate,thisArg);return index>-1?collection[index]:undefined;}
predicate=getCallback(predicate,thisArg,3);return baseFind(collection,predicate,baseEach);}
function findLast(collection,predicate,thisArg){predicate=getCallback(predicate,thisArg,3);return baseFind(collection,predicate,baseEachRight);}
function findWhere(collection,source){return find(collection,baseMatches(source));}
function forEach(collection,iteratee,thisArg){return(typeof iteratee=='function'&&typeof thisArg=='undefined'&&isArray(collection))?arrayEach(collection,iteratee):baseEach(collection,bindCallback(iteratee,thisArg,3));}
function forEachRight(collection,iteratee,thisArg){return(typeof iteratee=='function'&&typeof thisArg=='undefined'&&isArray(collection))?arrayEachRight(collection,iteratee):baseEachRight(collection,bindCallback(iteratee,thisArg,3));}
var groupBy=createAggregator(function(result,value,key){if(hasOwnProperty.call(result,key)){result[key].push(value);}else{result[key]=[value];}});var indexBy=createAggregator(function(result,value,key){result[key]=value;});function invoke(collection,methodName){return baseInvoke(collection,methodName,baseSlice(arguments,2));}
function map(collection,iteratee,thisArg){var func=isArray(collection)?arrayMap:baseMap;iteratee=getCallback(iteratee,thisArg,3);return func(collection,iteratee);}
var max=createExtremum(arrayMax);var min=createExtremum(arrayMin,true);var partition=createAggregator(function(result,value,key){result[key?0:1].push(value);},function(){return[[],[]];});function pluck(collection,key){return map(collection,baseProperty(key+''));}
function reduce(collection,iteratee,accumulator,thisArg){var func=isArray(collection)?arrayReduce:baseReduce;return func(collection,getCallback(iteratee,thisArg,4),accumulator,arguments.length<3,baseEach);}
function reduceRight(collection,iteratee,accumulator,thisArg){var func=isArray(collection)?arrayReduceRight:baseReduce;return func(collection,getCallback(iteratee,thisArg,4),accumulator,arguments.length<3,baseEachRight);}
function reject(collection,predicate,thisArg){var func=isArray(collection)?arrayFilter:baseFilter;predicate=getCallback(predicate,thisArg,3);return func(collection,function(value,index,collection){return!predicate(value,index,collection);});}
function sample(collection,n,guard){if(guard?isIterateeCall(collection,n,guard):n==null){collection=toIterable(collection);var length=collection.length;return length>0?collection[baseRandom(0,length-1)]:undefined;}
var result=shuffle(collection);result.length=nativeMin(n<0?0:(+n||0),result.length);return result;}
function shuffle(collection){collection=toIterable(collection);var index=-1,length=collection.length,result=Array(length);while(++index<length){var rand=baseRandom(0,index);if(index!=rand){result[index]=result[rand];}
result[rand]=collection[index];}
return result;}
function size(collection){var length=collection?collection.length:0;return isLength(length)?length:keys(collection).length;}
function some(collection,predicate,thisArg){var func=isArray(collection)?arraySome:baseSome;if(typeof predicate!='function'||typeof thisArg!='undefined'){predicate=getCallback(predicate,thisArg,3);}
return func(collection,predicate);}
function sortBy(collection,iteratee,thisArg){var index=-1,length=collection?collection.length:0,result=isLength(length)?Array(length):[];if(thisArg&&isIterateeCall(collection,iteratee,thisArg)){iteratee=null;}
iteratee=getCallback(iteratee,thisArg,3);baseEach(collection,function(value,key,collection){result[++index]={'criteria':iteratee(value,key,collection),'index':index,'value':value};});return baseSortBy(result,compareAscending);}
function sortByAll(collection){var args=arguments;if(args.length>3&&isIterateeCall(args[1],args[2],args[3])){args=[collection,args[1]];}
var index=-1,length=collection?collection.length:0,props=baseFlatten(args,false,false,1),result=isLength(length)?Array(length):[];baseEach(collection,function(value,key,collection){var length=props.length,criteria=Array(length);while(length--){criteria[length]=value==null?undefined:value[props[length]];}
result[++index]={'criteria':criteria,'index':index,'value':value};});return baseSortBy(result,compareMultipleAscending);}
function where(collection,source){return filter(collection,baseMatches(source));}
var now=nativeNow||function(){return new Date().getTime();};function after(n,func){if(!isFunction(func)){if(isFunction(n)){var temp=n;n=func;func=temp;}else{throw new TypeError(FUNC_ERROR_TEXT);}}
n=nativeIsFinite(n=+n)?n:0;return function(){if(--n<1){return func.apply(this,arguments);}};}
function ary(func,n,guard){if(guard&&isIterateeCall(func,n,guard)){n=null;}
n=(func&&n==null)?func.length:nativeMax(+n||0,0);return createWrapper(func,ARY_FLAG,null,null,null,null,n);}
function before(n,func){var result;if(!isFunction(func)){if(isFunction(n)){var temp=n;n=func;func=temp;}else{throw new TypeError(FUNC_ERROR_TEXT);}}
return function(){if(--n>0){result=func.apply(this,arguments);}else{func=null;}
return result;};}
function bind(func,thisArg){var bitmask=BIND_FLAG;if(arguments.length>2){var partials=baseSlice(arguments,2),holders=replaceHolders(partials,bind.placeholder);bitmask|=PARTIAL_FLAG;}
return createWrapper(func,bitmask,thisArg,partials,holders);}
function bindAll(object){return baseBindAll(object,arguments.length>1?baseFlatten(arguments,false,false,1):functions(object));}
function bindKey(object,key){var bitmask=BIND_FLAG|BIND_KEY_FLAG;if(arguments.length>2){var partials=baseSlice(arguments,2),holders=replaceHolders(partials,bindKey.placeholder);bitmask|=PARTIAL_FLAG;}
return createWrapper(key,bitmask,object,partials,holders);}
function curry(func,arity,guard){if(guard&&isIterateeCall(func,arity,guard)){arity=null;}
var result=createWrapper(func,CURRY_FLAG,null,null,null,null,null,arity);result.placeholder=curry.placeholder;return result;}
function curryRight(func,arity,guard){if(guard&&isIterateeCall(func,arity,guard)){arity=null;}
var result=createWrapper(func,CURRY_RIGHT_FLAG,null,null,null,null,null,arity);result.placeholder=curryRight.placeholder;return result;}
function debounce(func,wait,options){var args,maxTimeoutId,result,stamp,thisArg,timeoutId,trailingCall,lastCalled=0,maxWait=false,trailing=true;if(!isFunction(func)){throw new TypeError(FUNC_ERROR_TEXT);}
wait=wait<0?0:wait;if(options===true){var leading=true;trailing=false;}else if(isObject(options)){leading=options.leading;maxWait='maxWait'in options&&nativeMax(+options.maxWait||0,wait);trailing='trailing'in options?options.trailing:trailing;}
function cancel(){if(timeoutId){clearTimeout(timeoutId);}
if(maxTimeoutId){clearTimeout(maxTimeoutId);}
maxTimeoutId=timeoutId=trailingCall=undefined;}
function delayed(){var remaining=wait-(now()-stamp);if(remaining<=0||remaining>wait){if(maxTimeoutId){clearTimeout(maxTimeoutId);}
var isCalled=trailingCall;maxTimeoutId=timeoutId=trailingCall=undefined;if(isCalled){lastCalled=now();result=func.apply(thisArg,args);if(!timeoutId&&!maxTimeoutId){args=thisArg=null;}}}else{timeoutId=setTimeout(delayed,remaining);}}
function maxDelayed(){if(timeoutId){clearTimeout(timeoutId);}
maxTimeoutId=timeoutId=trailingCall=undefined;if(trailing||(maxWait!==wait)){lastCalled=now();result=func.apply(thisArg,args);if(!timeoutId&&!maxTimeoutId){args=thisArg=null;}}}
function debounced(){args=arguments;stamp=now();thisArg=this;trailingCall=trailing&&(timeoutId||!leading);if(maxWait===false){var leadingCall=leading&&!timeoutId;}else{if(!maxTimeoutId&&!leading){lastCalled=stamp;}
var remaining=maxWait-(stamp-lastCalled),isCalled=remaining<=0||remaining>maxWait;if(isCalled){if(maxTimeoutId){maxTimeoutId=clearTimeout(maxTimeoutId);}
lastCalled=stamp;result=func.apply(thisArg,args);}
else if(!maxTimeoutId){maxTimeoutId=setTimeout(maxDelayed,remaining);}}
if(isCalled&&timeoutId){timeoutId=clearTimeout(timeoutId);}
else if(!timeoutId&&wait!==maxWait){timeoutId=setTimeout(delayed,wait);}
if(leadingCall){isCalled=true;result=func.apply(thisArg,args);}
if(isCalled&&!timeoutId&&!maxTimeoutId){args=thisArg=null;}
return result;}
debounced.cancel=cancel;return debounced;}
function defer(func){return baseDelay(func,1,arguments,1);}
function delay(func,wait){return baseDelay(func,wait,arguments,2);}
function flow(){var funcs=arguments,length=funcs.length;if(!length){return function(){};}
if(!arrayEvery(funcs,isFunction)){throw new TypeError(FUNC_ERROR_TEXT);}
return function(){var index=0,result=funcs[index].apply(this,arguments);while(++index<length){result=funcs[index].call(this,result);}
return result;};}
function flowRight(){var funcs=arguments,fromIndex=funcs.length-1;if(fromIndex<0){return function(){};}
if(!arrayEvery(funcs,isFunction)){throw new TypeError(FUNC_ERROR_TEXT);}
return function(){var index=fromIndex,result=funcs[index].apply(this,arguments);while(index--){result=funcs[index].call(this,result);}
return result;};}
function memoize(func,resolver){if(!isFunction(func)||(resolver&&!isFunction(resolver))){throw new TypeError(FUNC_ERROR_TEXT);}
var memoized=function(){var cache=memoized.cache,key=resolver?resolver.apply(this,arguments):arguments[0];if(cache.has(key)){return cache.get(key);}
var result=func.apply(this,arguments);cache.set(key,result);return result;};memoized.cache=new memoize.Cache;return memoized;}
function negate(predicate){if(!isFunction(predicate)){throw new TypeError(FUNC_ERROR_TEXT);}
return function(){return!predicate.apply(this,arguments);};}
function once(func){return before(func,2);}
function partial(func){var partials=baseSlice(arguments,1),holders=replaceHolders(partials,partial.placeholder);return createWrapper(func,PARTIAL_FLAG,null,partials,holders);}
function partialRight(func){var partials=baseSlice(arguments,1),holders=replaceHolders(partials,partialRight.placeholder);return createWrapper(func,PARTIAL_RIGHT_FLAG,null,partials,holders);}
function rearg(func){var indexes=baseFlatten(arguments,false,false,1);return createWrapper(func,REARG_FLAG,null,null,null,indexes);}
function throttle(func,wait,options){var leading=true,trailing=true;if(!isFunction(func)){throw new TypeError(FUNC_ERROR_TEXT);}
if(options===false){leading=false;}else if(isObject(options)){leading='leading'in options?!!options.leading:leading;trailing='trailing'in options?!!options.trailing:trailing;}
debounceOptions.leading=leading;debounceOptions.maxWait=+wait;debounceOptions.trailing=trailing;return debounce(func,wait,debounceOptions);}
function wrap(value,wrapper){wrapper=wrapper==null?identity:wrapper;return createWrapper(wrapper,PARTIAL_FLAG,null,[value],[]);}
function clone(value,isDeep,customizer,thisArg){if(typeof isDeep!='boolean'&&isDeep!=null){thisArg=customizer;customizer=isIterateeCall(value,isDeep,thisArg)?null:isDeep;isDeep=false;}
customizer=typeof customizer=='function'&&bindCallback(customizer,thisArg,1);return baseClone(value,isDeep,customizer);}
function cloneDeep(value,customizer,thisArg){customizer=typeof customizer=='function'&&bindCallback(customizer,thisArg,1);return baseClone(value,true,customizer);}
function isArguments(value){var length=isObjectLike(value)?value.length:undefined;return(isLength(length)&&objToString.call(value)==argsTag)||false;}
var isArray=nativeIsArray||function(value){return(isObjectLike(value)&&isLength(value.length)&&objToString.call(value)==arrayTag)||false;};function isBoolean(value){return(value===true||value===false||isObjectLike(value)&&objToString.call(value)==boolTag)||false;}
function isDate(value){return(isObjectLike(value)&&objToString.call(value)==dateTag)||false;}
function isElement(value){return(value&&value.nodeType===1&&isObjectLike(value)&&objToString.call(value).indexOf('Element')>-1)||false;}
if(!support.dom){isElement=function(value){return(value&&value.nodeType===1&&isObjectLike(value)&&!isPlainObject(value))||false;};}
function isEmpty(value){if(value==null){return true;}
var length=value.length;if(isLength(length)&&(isArray(value)||isString(value)||isArguments(value)||(isObjectLike(value)&&isFunction(value.splice)))){return!length;}
return!keys(value).length;}
function isEqual(value,other,customizer,thisArg){customizer=typeof customizer=='function'&&bindCallback(customizer,thisArg,3);if(!customizer&&isStrictComparable(value)&&isStrictComparable(other)){return value===other;}
var result=customizer?customizer(value,other):undefined;return typeof result=='undefined'?baseIsEqual(value,other,customizer):!!result;}
function isError(value){return(isObjectLike(value)&&typeof value.message=='string'&&objToString.call(value)==errorTag)||false;}
var isFinite=nativeNumIsFinite||function(value){return typeof value=='number'&&nativeIsFinite(value);};function isFunction(value){return typeof value=='function'||false;}
if(isFunction(/x/)||(Uint8Array&&!isFunction(Uint8Array))){isFunction=function(value){return objToString.call(value)==funcTag;};}
function isObject(value){var type=typeof value;return type=='function'||(value&&type=='object')||false;}
function isMatch(object,source,customizer,thisArg){var props=keys(source),length=props.length;customizer=typeof customizer=='function'&&bindCallback(customizer,thisArg,3);if(!customizer&&length==1){var key=props[0],value=source[key];if(isStrictComparable(value)){return object!=null&&value===object[key]&&hasOwnProperty.call(object,key);}}
var values=Array(length),strictCompareFlags=Array(length);while(length--){value=values[length]=source[props[length]];strictCompareFlags[length]=isStrictComparable(value);}
return baseIsMatch(object,props,values,strictCompareFlags,customizer);}
function isNaN(value){return isNumber(value)&&value!=+value;}
function isNative(value){if(value==null){return false;}
if(objToString.call(value)==funcTag){return reNative.test(fnToString.call(value));}
return(isObjectLike(value)&&reHostCtor.test(value))||false;}
function isNull(value){return value===null;}
function isNumber(value){return typeof value=='number'||(isObjectLike(value)&&objToString.call(value)==numberTag)||false;}
var isPlainObject=!getPrototypeOf?shimIsPlainObject:function(value){if(!(value&&objToString.call(value)==objectTag)){return false;}
var valueOf=value.valueOf,objProto=isNative(valueOf)&&(objProto=getPrototypeOf(valueOf))&&getPrototypeOf(objProto);return objProto?(value==objProto||getPrototypeOf(value)==objProto):shimIsPlainObject(value);};function isRegExp(value){return(isObjectLike(value)&&objToString.call(value)==regexpTag)||false;}
function isString(value){return typeof value=='string'||(isObjectLike(value)&&objToString.call(value)==stringTag)||false;}
function isTypedArray(value){return(isObjectLike(value)&&isLength(value.length)&&typedArrayTags[objToString.call(value)])||false;}
function isUndefined(value){return typeof value=='undefined';}
function toArray(value){var length=value?value.length:0;if(!isLength(length)){return values(value);}
if(!length){return[];}
return arrayCopy(value);}
function toPlainObject(value){return baseCopy(value,keysIn(value));}
var assign=createAssigner(baseAssign);function create(prototype,properties,guard){var result=baseCreate(prototype);if(guard&&isIterateeCall(prototype,properties,guard)){properties=null;}
return properties?baseCopy(properties,result,keys(properties)):result;}
function defaults(object){if(object==null){return object;}
var args=arrayCopy(arguments);args.push(assignDefaults);return assign.apply(undefined,args);}
function findKey(object,predicate,thisArg){predicate=getCallback(predicate,thisArg,3);return baseFind(object,predicate,baseForOwn,true);}
function findLastKey(object,predicate,thisArg){predicate=getCallback(predicate,thisArg,3);return baseFind(object,predicate,baseForOwnRight,true);}
function forIn(object,iteratee,thisArg){if(typeof iteratee!='function'||typeof thisArg!='undefined'){iteratee=bindCallback(iteratee,thisArg,3);}
return baseFor(object,iteratee,keysIn);}
function forInRight(object,iteratee,thisArg){iteratee=bindCallback(iteratee,thisArg,3);return baseForRight(object,iteratee,keysIn);}
function forOwn(object,iteratee,thisArg){if(typeof iteratee!='function'||typeof thisArg!='undefined'){iteratee=bindCallback(iteratee,thisArg,3);}
return baseForOwn(object,iteratee);}
function forOwnRight(object,iteratee,thisArg){iteratee=bindCallback(iteratee,thisArg,3);return baseForRight(object,iteratee,keys);}
function functions(object){return baseFunctions(object,keysIn(object));}
function has(object,key){return object?hasOwnProperty.call(object,key):false;}
function invert(object,multiValue,guard){if(guard&&isIterateeCall(object,multiValue,guard)){multiValue=null;}
var index=-1,props=keys(object),length=props.length,result={};while(++index<length){var key=props[index],value=object[key];if(multiValue){if(hasOwnProperty.call(result,value)){result[value].push(key);}else{result[value]=[key];}}
else{result[value]=key;}}
return result;}
var keys=!nativeKeys?shimKeys:function(object){if(object){var Ctor=object.constructor,length=object.length;}
if((typeof Ctor=='function'&&Ctor.prototype===object)||(typeof object!='function'&&(length&&isLength(length)))){return shimKeys(object);}
return isObject(object)?nativeKeys(object):[];};function keysIn(object){if(object==null){return[];}
if(!isObject(object)){object=Object(object);}
var length=object.length;length=(length&&isLength(length)&&(isArray(object)||(support.nonEnumArgs&&isArguments(object)))&&length)||0;var Ctor=object.constructor,index=-1,isProto=typeof Ctor=='function'&&Ctor.prototype==object,result=Array(length),skipIndexes=length>0;while(++index<length){result[index]=(index+'');}
for(var key in object){if(!(skipIndexes&&isIndex(key,length))&&!(key=='constructor'&&(isProto||!hasOwnProperty.call(object,key)))){result.push(key);}}
return result;}
function mapValues(object,iteratee,thisArg){var result={};iteratee=getCallback(iteratee,thisArg,3);baseForOwn(object,function(value,key,object){result[key]=iteratee(value,key,object);});return result;}
var merge=createAssigner(baseMerge);function omit(object,predicate,thisArg){if(object==null){return{};}
if(typeof predicate!='function'){var props=arrayMap(baseFlatten(arguments,false,false,1),String);return pickByArray(object,baseDifference(keysIn(object),props));}
predicate=bindCallback(predicate,thisArg,3);return pickByCallback(object,function(value,key,object){return!predicate(value,key,object);});}
function pairs(object){var index=-1,props=keys(object),length=props.length,result=Array(length);while(++index<length){var key=props[index];result[index]=[key,object[key]];}
return result;}
function pick(object,predicate,thisArg){if(object==null){return{};}
return typeof predicate=='function'?pickByCallback(object,bindCallback(predicate,thisArg,3)):pickByArray(object,baseFlatten(arguments,false,false,1));}
function result(object,key,defaultValue){var value=object==null?undefined:object[key];if(typeof value=='undefined'){value=defaultValue;}
return isFunction(value)?value.call(object):value;}
function transform(object,iteratee,accumulator,thisArg){var isArr=isArray(object)||isTypedArray(object);iteratee=getCallback(iteratee,thisArg,4);if(accumulator==null){if(isArr||isObject(object)){var Ctor=object.constructor;if(isArr){accumulator=isArray(object)?new Ctor:[];}else{accumulator=baseCreate(typeof Ctor=='function'&&Ctor.prototype);}}else{accumulator={};}}
(isArr?arrayEach:baseForOwn)(object,function(value,index,object){return iteratee(accumulator,value,index,object);});return accumulator;}
function values(object){return baseValues(object,keys(object));}
function valuesIn(object){return baseValues(object,keysIn(object));}
function random(min,max,floating){if(floating&&isIterateeCall(min,max,floating)){max=floating=null;}
var noMin=min==null,noMax=max==null;if(floating==null){if(noMax&&typeof min=='boolean'){floating=min;min=1;}
else if(typeof max=='boolean'){floating=max;noMax=true;}}
if(noMin&&noMax){max=1;noMax=false;}
min=+min||0;if(noMax){max=min;min=0;}else{max=+max||0;}
if(floating||min%1||max%1){var rand=nativeRandom();return nativeMin(min+(rand*(max-min+parseFloat('1e-'+((rand+'').length-1)))),max);}
return baseRandom(min,max);}
var camelCase=createCompounder(function(result,word,index){word=word.toLowerCase();return result+(index?(word.charAt(0).toUpperCase()+word.slice(1)):word);});function capitalize(string){string=baseToString(string);return string&&(string.charAt(0).toUpperCase()+string.slice(1));}
function deburr(string){string=baseToString(string);return string&&string.replace(reLatin1,deburrLetter);}
function endsWith(string,target,position){string=baseToString(string);target=(target+'');var length=string.length;position=(typeof position=='undefined'?length:nativeMin(position<0?0:(+position||0),length))-target.length;return position>=0&&string.indexOf(target,position)==position;}
function escape(string){string=baseToString(string);return(string&&reHasUnescapedHtml.test(string))?string.replace(reUnescapedHtml,escapeHtmlChar):string;}
function escapeRegExp(string){string=baseToString(string);return(string&&reHasRegExpChars.test(string))?string.replace(reRegExpChars,'\\$&'):string;}
var kebabCase=createCompounder(function(result,word,index){return result+(index?'-':'')+word.toLowerCase();});function pad(string,length,chars){string=baseToString(string);length=+length;var strLength=string.length;if(strLength>=length||!nativeIsFinite(length)){return string;}
var mid=(length-strLength)/2,leftLength=floor(mid),rightLength=ceil(mid);chars=createPad('',rightLength,chars);return chars.slice(0,leftLength)+string+chars;}
function padLeft(string,length,chars){string=baseToString(string);return string&&(createPad(string,length,chars)+string);}
function padRight(string,length,chars){string=baseToString(string);return string&&(string+createPad(string,length,chars));}
function parseInt(string,radix,guard){if(guard&&isIterateeCall(string,radix,guard)){radix=0;}
return nativeParseInt(string,radix);}
if(nativeParseInt(whitespace+'08')!=8){parseInt=function(string,radix,guard){if(guard?isIterateeCall(string,radix,guard):radix==null){radix=0;}else if(radix){radix=+radix;}
string=trim(string);return nativeParseInt(string,radix||(reHexPrefix.test(string)?16:10));};}
function repeat(string,n){var result='';string=baseToString(string);n=+n;if(n<1||!string||!nativeIsFinite(n)){return result;}
do{if(n%2){result+=string;}
n=floor(n/2);string+=string;}while(n);return result;}
var snakeCase=createCompounder(function(result,word,index){return result+(index?'_':'')+word.toLowerCase();});var startCase=createCompounder(function(result,word,index){return result+(index?' ':'')+(word.charAt(0).toUpperCase()+word.slice(1));});function startsWith(string,target,position){string=baseToString(string);position=position==null?0:nativeMin(position<0?0:(+position||0),string.length);return string.lastIndexOf(target,position)==position;}
function template(string,options,otherOptions){var settings=lodash.templateSettings;if(otherOptions&&isIterateeCall(string,options,otherOptions)){options=otherOptions=null;}
string=baseToString(string);options=baseAssign(baseAssign({},otherOptions||options),settings,assignOwnDefaults);var imports=baseAssign(baseAssign({},options.imports),settings.imports,assignOwnDefaults),importsKeys=keys(imports),importsValues=baseValues(imports,importsKeys);var isEscaping,isEvaluating,index=0,interpolate=options.interpolate||reNoMatch,source="__p += '";var reDelimiters=RegExp((options.escape||reNoMatch).source+'|'+interpolate.source+'|'+(interpolate===reInterpolate?reEsTemplate:reNoMatch).source+'|'+(options.evaluate||reNoMatch).source+'|$','g');var sourceURL='//# sourceURL='+('sourceURL'in options?options.sourceURL:('lodash.templateSources['+(++templateCounter)+']'))+'\n';string.replace(reDelimiters,function(match,escapeValue,interpolateValue,esTemplateValue,evaluateValue,offset){interpolateValue||(interpolateValue=esTemplateValue);source+=string.slice(index,offset).replace(reUnescapedString,escapeStringChar);if(escapeValue){isEscaping=true;source+="' +\n__e("+escapeValue+") +\n'";}
if(evaluateValue){isEvaluating=true;source+="';\n"+evaluateValue+";\n__p += '";}
if(interpolateValue){source+="' +\n((__t = ("+interpolateValue+")) == null ? '' : __t) +\n'";}
index=offset+match.length;return match;});source+="';\n";var variable=options.variable;if(!variable){source='with (obj) {\n'+source+'\n}\n';}
source=(isEvaluating?source.replace(reEmptyStringLeading,''):source).replace(reEmptyStringMiddle,'$1').replace(reEmptyStringTrailing,'$1;');source='function('+(variable||'obj')+') {\n'+(variable?'':'obj || (obj = {});\n')+"var __t, __p = ''"+(isEscaping?', __e = _.escape':'')+(isEvaluating?', __j = Array.prototype.join;\n'+"function print() { __p += __j.call(arguments, '') }\n":';\n')+source+'return __p\n}';var result=attempt(function(){return Function(importsKeys,sourceURL+'return '+source).apply(undefined,importsValues);});result.source=source;if(isError(result)){throw result;}
return result;}
function trim(string,chars,guard){var value=string;string=baseToString(string);if(!string){return string;}
if(guard?isIterateeCall(value,chars,guard):chars==null){return string.slice(trimmedLeftIndex(string),trimmedRightIndex(string)+1);}
chars=(chars+'');return string.slice(charsLeftIndex(string,chars),charsRightIndex(string,chars)+1);}
function trimLeft(string,chars,guard){var value=string;string=baseToString(string);if(!string){return string;}
if(guard?isIterateeCall(value,chars,guard):chars==null){return string.slice(trimmedLeftIndex(string))}
return string.slice(charsLeftIndex(string,(chars+'')));}
function trimRight(string,chars,guard){var value=string;string=baseToString(string);if(!string){return string;}
if(guard?isIterateeCall(value,chars,guard):chars==null){return string.slice(0,trimmedRightIndex(string)+1)}
return string.slice(0,charsRightIndex(string,(chars+''))+1);}
function trunc(string,options,guard){if(guard&&isIterateeCall(string,options,guard)){options=null;}
var length=DEFAULT_TRUNC_LENGTH,omission=DEFAULT_TRUNC_OMISSION;if(options!=null){if(isObject(options)){var separator='separator'in options?options.separator:separator;length='length'in options?+options.length||0:length;omission='omission'in options?baseToString(options.omission):omission;}else{length=+options||0;}}
string=baseToString(string);if(length>=string.length){return string;}
var end=length-omission.length;if(end<1){return omission;}
var result=string.slice(0,end);if(separator==null){return result+omission;}
if(isRegExp(separator)){if(string.slice(end).search(separator)){var match,newEnd,substring=string.slice(0,end);if(!separator.global){separator=RegExp(separator.source,(reFlags.exec(separator)||'')+'g');}
separator.lastIndex=0;while((match=separator.exec(substring))){newEnd=match.index;}
result=result.slice(0,newEnd==null?end:newEnd);}}else if(string.indexOf(separator,end)!=end){var index=result.lastIndexOf(separator);if(index>-1){result=result.slice(0,index);}}
return result+omission;}
function unescape(string){string=baseToString(string);return(string&&reHasEscapedHtml.test(string))?string.replace(reEscapedHtml,unescapeHtmlChar):string;}
function words(string,pattern,guard){if(guard&&isIterateeCall(string,pattern,guard)){pattern=null;}
string=baseToString(string);return string.match(pattern||reWords)||[];}
function attempt(func){try{return func();}catch(e){return isError(e)?e:Error(e);}}
function callback(func,thisArg,guard){if(guard&&isIterateeCall(func,thisArg,guard)){thisArg=null;}
return isObjectLike(func)?matches(func):baseCallback(func,thisArg);}
function constant(value){return function(){return value;};}
function identity(value){return value;}
function matches(source){return baseMatches(baseClone(source,true));}
function mixin(object,source,options){if(options==null){var isObj=isObject(source),props=isObj&&keys(source),methodNames=props&&props.length&&baseFunctions(source,props);if(!(methodNames?methodNames.length:isObj)){methodNames=false;options=source;source=object;object=this;}}
if(!methodNames){methodNames=baseFunctions(source,keys(source));}
var chain=true,index=-1,isFunc=isFunction(object),length=methodNames.length;if(options===false){chain=false;}else if(isObject(options)&&'chain'in options){chain=options.chain;}
while(++index<length){var methodName=methodNames[index],func=source[methodName];object[methodName]=func;if(isFunc){object.prototype[methodName]=(function(func){return function(){var chainAll=this.__chain__;if(chain||chainAll){var result=object(this.__wrapped__);(result.__actions__=arrayCopy(this.__actions__)).push({'func':func,'args':arguments,'thisArg':object});result.__chain__=chainAll;return result;}
var args=[this.value()];push.apply(args,arguments);return func.apply(object,args);};}(func));}}
return object;}
function noConflict(){context._=oldDash;return this;}
function noop(){}
function property(key){return baseProperty(key+'');}
function propertyOf(object){return function(key){return object==null?undefined:object[key];};}
function range(start,end,step){if(step&&isIterateeCall(start,end,step)){end=step=null;}
start=+start||0;step=step==null?1:(+step||0);if(end==null){end=start;start=0;}else{end=+end||0;}
var index=-1,length=nativeMax(ceil((end-start)/(step||1)),0),result=Array(length);while(++index<length){result[index]=start;start+=step;}
return result;}
function times(n,iteratee,thisArg){n=+n;if(n<1||!nativeIsFinite(n)){return[];}
var index=-1,result=Array(nativeMin(n,MAX_ARRAY_LENGTH));iteratee=bindCallback(iteratee,thisArg,1);while(++index<n){if(index<MAX_ARRAY_LENGTH){result[index]=iteratee(index);}else{iteratee(index);}}
return result;}
function uniqueId(prefix){var id=++idCounter;return baseToString(prefix)+id;}
LodashWrapper.prototype=lodash.prototype;MapCache.prototype['delete']=mapDelete;MapCache.prototype.get=mapGet;MapCache.prototype.has=mapHas;MapCache.prototype.set=mapSet;SetCache.prototype.push=cachePush;memoize.Cache=MapCache;lodash.after=after;lodash.ary=ary;lodash.assign=assign;lodash.at=at;lodash.before=before;lodash.bind=bind;lodash.bindAll=bindAll;lodash.bindKey=bindKey;lodash.callback=callback;lodash.chain=chain;lodash.chunk=chunk;lodash.compact=compact;lodash.constant=constant;lodash.countBy=countBy;lodash.create=create;lodash.curry=curry;lodash.curryRight=curryRight;lodash.debounce=debounce;lodash.defaults=defaults;lodash.defer=defer;lodash.delay=delay;lodash.difference=difference;lodash.drop=drop;lodash.dropRight=dropRight;lodash.dropRightWhile=dropRightWhile;lodash.dropWhile=dropWhile;lodash.filter=filter;lodash.flatten=flatten;lodash.flattenDeep=flattenDeep;lodash.flow=flow;lodash.flowRight=flowRight;lodash.forEach=forEach;lodash.forEachRight=forEachRight;lodash.forIn=forIn;lodash.forInRight=forInRight;lodash.forOwn=forOwn;lodash.forOwnRight=forOwnRight;lodash.functions=functions;lodash.groupBy=groupBy;lodash.indexBy=indexBy;lodash.initial=initial;lodash.intersection=intersection;lodash.invert=invert;lodash.invoke=invoke;lodash.keys=keys;lodash.keysIn=keysIn;lodash.map=map;lodash.mapValues=mapValues;lodash.matches=matches;lodash.memoize=memoize;lodash.merge=merge;lodash.mixin=mixin;lodash.negate=negate;lodash.omit=omit;lodash.once=once;lodash.pairs=pairs;lodash.partial=partial;lodash.partialRight=partialRight;lodash.partition=partition;lodash.pick=pick;lodash.pluck=pluck;lodash.property=property;lodash.propertyOf=propertyOf;lodash.pull=pull;lodash.pullAt=pullAt;lodash.range=range;lodash.rearg=rearg;lodash.reject=reject;lodash.remove=remove;lodash.rest=rest;lodash.shuffle=shuffle;lodash.slice=slice;lodash.sortBy=sortBy;lodash.sortByAll=sortByAll;lodash.take=take;lodash.takeRight=takeRight;lodash.takeRightWhile=takeRightWhile;lodash.takeWhile=takeWhile;lodash.tap=tap;lodash.throttle=throttle;lodash.thru=thru;lodash.times=times;lodash.toArray=toArray;lodash.toPlainObject=toPlainObject;lodash.transform=transform;lodash.union=union;lodash.uniq=uniq;lodash.unzip=unzip;lodash.values=values;lodash.valuesIn=valuesIn;lodash.where=where;lodash.without=without;lodash.wrap=wrap;lodash.xor=xor;lodash.zip=zip;lodash.zipObject=zipObject;lodash.backflow=flowRight;lodash.collect=map;lodash.compose=flowRight;lodash.each=forEach;lodash.eachRight=forEachRight;lodash.extend=assign;lodash.iteratee=callback;lodash.methods=functions;lodash.object=zipObject;lodash.select=filter;lodash.tail=rest;lodash.unique=uniq;mixin(lodash,lodash);lodash.attempt=attempt;lodash.camelCase=camelCase;lodash.capitalize=capitalize;lodash.clone=clone;lodash.cloneDeep=cloneDeep;lodash.deburr=deburr;lodash.endsWith=endsWith;lodash.escape=escape;lodash.escapeRegExp=escapeRegExp;lodash.every=every;lodash.find=find;lodash.findIndex=findIndex;lodash.findKey=findKey;lodash.findLast=findLast;lodash.findLastIndex=findLastIndex;lodash.findLastKey=findLastKey;lodash.findWhere=findWhere;lodash.first=first;lodash.has=has;lodash.identity=identity;lodash.includes=includes;lodash.indexOf=indexOf;lodash.isArguments=isArguments;lodash.isArray=isArray;lodash.isBoolean=isBoolean;lodash.isDate=isDate;lodash.isElement=isElement;lodash.isEmpty=isEmpty;lodash.isEqual=isEqual;lodash.isError=isError;lodash.isFinite=isFinite;lodash.isFunction=isFunction;lodash.isMatch=isMatch;lodash.isNaN=isNaN;lodash.isNative=isNative;lodash.isNull=isNull;lodash.isNumber=isNumber;lodash.isObject=isObject;lodash.isPlainObject=isPlainObject;lodash.isRegExp=isRegExp;lodash.isString=isString;lodash.isTypedArray=isTypedArray;lodash.isUndefined=isUndefined;lodash.kebabCase=kebabCase;lodash.last=last;lodash.lastIndexOf=lastIndexOf;lodash.max=max;lodash.min=min;lodash.noConflict=noConflict;lodash.noop=noop;lodash.now=now;lodash.pad=pad;lodash.padLeft=padLeft;lodash.padRight=padRight;lodash.parseInt=parseInt;lodash.random=random;lodash.reduce=reduce;lodash.reduceRight=reduceRight;lodash.repeat=repeat;lodash.result=result;lodash.runInContext=runInContext;lodash.size=size;lodash.snakeCase=snakeCase;lodash.some=some;lodash.sortedIndex=sortedIndex;lodash.sortedLastIndex=sortedLastIndex;lodash.startCase=startCase;lodash.startsWith=startsWith;lodash.template=template;lodash.trim=trim;lodash.trimLeft=trimLeft;lodash.trimRight=trimRight;lodash.trunc=trunc;lodash.unescape=unescape;lodash.uniqueId=uniqueId;lodash.words=words;lodash.all=every;lodash.any=some;lodash.contains=includes;lodash.detect=find;lodash.foldl=reduce;lodash.foldr=reduceRight;lodash.head=first;lodash.include=includes;lodash.inject=reduce;mixin(lodash,(function(){var source={};baseForOwn(lodash,function(func,methodName){if(!lodash.prototype[methodName]){source[methodName]=func;}});return source;}()),false);lodash.sample=sample;lodash.prototype.sample=function(n){if(!this.__chain__&&n==null){return sample(this.value());}
return this.thru(function(value){return sample(value,n);});};lodash.VERSION=VERSION;arrayEach(['bind','bindKey','curry','curryRight','partial','partialRight'],function(methodName){lodash[methodName].placeholder=lodash;});arrayEach(['filter','map','takeWhile'],function(methodName,index){var isFilter=index==LAZY_FILTER_FLAG;LazyWrapper.prototype[methodName]=function(iteratee,thisArg){var result=this.clone(),filtered=result.filtered,iteratees=result.iteratees||(result.iteratees=[]);result.filtered=filtered||isFilter||(index==LAZY_WHILE_FLAG&&result.dir<0);iteratees.push({'iteratee':getCallback(iteratee,thisArg,3),'type':index});return result;};});arrayEach(['drop','take'],function(methodName,index){var countName=methodName+'Count',whileName=methodName+'While';LazyWrapper.prototype[methodName]=function(n){n=n==null?1:nativeMax(+n||0,0);var result=this.clone();if(result.filtered){var value=result[countName];result[countName]=index?nativeMin(value,n):(value+n);}else{var views=result.views||(result.views=[]);views.push({'size':n,'type':methodName+(result.dir<0?'Right':'')});}
return result;};LazyWrapper.prototype[methodName+'Right']=function(n){return this.reverse()[methodName](n).reverse();};LazyWrapper.prototype[methodName+'RightWhile']=function(predicate,thisArg){return this.reverse()[whileName](predicate,thisArg).reverse();};});arrayEach(['first','last'],function(methodName,index){var takeName='take'+(index?'Right':'');LazyWrapper.prototype[methodName]=function(){return this[takeName](1).value()[0];};});arrayEach(['initial','rest'],function(methodName,index){var dropName='drop'+(index?'':'Right');LazyWrapper.prototype[methodName]=function(){return this[dropName](1);};});arrayEach(['pluck','where'],function(methodName,index){var operationName=index?'filter':'map',createCallback=index?baseMatches:baseProperty;LazyWrapper.prototype[methodName]=function(value){return this[operationName](createCallback(index?value:(value+'')));};});LazyWrapper.prototype.dropWhile=function(iteratee,thisArg){var done,lastIndex,isRight=this.dir<0;iteratee=getCallback(iteratee,thisArg,3);return this.filter(function(value,index,array){done=done&&(isRight?index<lastIndex:index>lastIndex);lastIndex=index;return done||(done=!iteratee(value,index,array));});};LazyWrapper.prototype.reject=function(iteratee,thisArg){iteratee=getCallback(iteratee,thisArg,3);return this.filter(function(value,index,array){return!iteratee(value,index,array);});};LazyWrapper.prototype.slice=function(start,end){start=start==null?0:(+start||0);var result=start<0?this.takeRight(-start):this.drop(start);if(typeof end!='undefined'){end=(+end||0);result=end<0?result.dropRight(-end):result.take(end-start);}
return result;};baseForOwn(LazyWrapper.prototype,function(func,methodName){var lodashFunc=lodash[methodName],retUnwrapped=/^(?:first|last)$/.test(methodName);lodash.prototype[methodName]=function(){var value=this.__wrapped__,args=arguments,chainAll=this.__chain__,isHybrid=!!this.__actions__.length,isLazy=value instanceof LazyWrapper,onlyLazy=isLazy&&!isHybrid;if(retUnwrapped&&!chainAll){return onlyLazy?func.call(value):lodashFunc.call(lodash,this.value());}
var interceptor=function(value){var otherArgs=[value];push.apply(otherArgs,args);return lodashFunc.apply(lodash,otherArgs);};if(isLazy||isArray(value)){var wrapper=onlyLazy?value:new LazyWrapper(this),result=func.apply(wrapper,args);if(!retUnwrapped&&(isHybrid||result.actions)){var actions=result.actions||(result.actions=[]);actions.push({'func':thru,'args':[interceptor],'thisArg':lodash});}
return new LodashWrapper(result,chainAll);}
return this.thru(interceptor);};});arrayEach(['concat','join','pop','push','shift','sort','splice','unshift'],function(methodName){var func=arrayProto[methodName],chainName=/^(?:push|sort|unshift)$/.test(methodName)?'tap':'thru',retUnwrapped=/^(?:join|pop|shift)$/.test(methodName);lodash.prototype[methodName]=function(){var args=arguments;if(retUnwrapped&&!this.__chain__){return func.apply(this.value(),args);}
return this[chainName](function(value){return func.apply(value,args);});};});LazyWrapper.prototype.clone=lazyClone;LazyWrapper.prototype.reverse=lazyReverse;LazyWrapper.prototype.value=lazyValue;lodash.prototype.chain=wrapperChain;lodash.prototype.reverse=wrapperReverse;lodash.prototype.toString=wrapperToString;lodash.prototype.toJSON=lodash.prototype.valueOf=lodash.prototype.value=wrapperValue;lodash.prototype.collect=lodash.prototype.map;lodash.prototype.head=lodash.prototype.first;lodash.prototype.select=lodash.prototype.filter;lodash.prototype.tail=lodash.prototype.rest;return lodash;}
var _=runInContext();if(true){root._=_;!(__WEBPACK_AMD_DEFINE_RESULT__=function(){return _;}.call(exports,__webpack_require__,exports,module),__WEBPACK_AMD_DEFINE_RESULT__!==undefined&&(module.exports=__WEBPACK_AMD_DEFINE_RESULT__));}
else if(freeExports&&freeModule){if(moduleExports){(freeModule.exports=_)._=_;}
else{freeExports._=_;}}
else{root._=_;}}.call(this));}.call(exports,__webpack_require__(15)(module),(function(){return this;}())))},function(module,exports,__webpack_require__){(function(Buffer){(function(){var PDFObject,PDFReference,zlib,__bind=function(fn,me){return function(){return fn.apply(me,arguments);};};zlib=__webpack_require__(45);PDFReference=(function(){function PDFReference(document,id,data){this.document=document;this.id=id;this.data=data!=null?data:{};this.finalize=__bind(this.finalize,this);this.gen=0;this.deflate=null;this.compress=this.document.compress&&!this.data.Filter;this.uncompressedLength=0;this.chunks=[];}
PDFReference.prototype.initDeflate=function(){this.data.Filter='FlateDecode';this.deflate=zlib.createDeflate();this.deflate.on('data',(function(_this){return function(chunk){_this.chunks.push(chunk);return _this.data.Length+=chunk.length;};})(this));return this.deflate.on('end',this.finalize);};PDFReference.prototype.write=function(chunk){var _base;if(!Buffer.isBuffer(chunk)){chunk=new Buffer(chunk+'\n','binary');}
this.uncompressedLength+=chunk.length;if((_base=this.data).Length==null){_base.Length=0;}
if(this.compress){if(!this.deflate){this.initDeflate();}
return this.deflate.write(chunk);}else{this.chunks.push(chunk);return this.data.Length+=chunk.length;}};PDFReference.prototype.end=function(chunk){if(typeof chunk==='string'||Buffer.isBuffer(chunk)){this.write(chunk);}
if(this.deflate){return this.deflate.end();}else{return this.finalize();}};PDFReference.prototype.finalize=function(){var chunk,_i,_len,_ref;this.offset=this.document._offset;this.document._write(""+this.id+" "+this.gen+" obj");this.document._write(PDFObject.convert(this.data));if(this.chunks.length){this.document._write('stream');_ref=this.chunks;for(_i=0,_len=_ref.length;_i<_len;_i++){chunk=_ref[_i];this.document._write(chunk);}
this.chunks.length=0;this.document._write('\nendstream');}
this.document._write('endobj');return this.document._refEnd(this);};PDFReference.prototype.toString=function(){return""+this.id+" "+this.gen+" R";};return PDFReference;})();module.exports=PDFReference;PDFObject=__webpack_require__(32);}).call(this);}.call(exports,__webpack_require__(4).Buffer))},function(module,exports,__webpack_require__){module.exports=function(){throw new Error("define cannot be used indirect");};},function(module,exports,__webpack_require__){(function(__webpack_amd_options__){module.exports=__webpack_amd_options__;}.call(exports,{}))},function(module,exports,__webpack_require__){module.exports=function(module){if(!module.webpackPolyfill){module.deprecate=function(){};module.paths=[];module.children=[];module.webpackPolyfill=1;}
return module;}},function(module,exports,__webpack_require__){'use strict';var _=__webpack_require__(11);function FontWrapper(pdfkitDoc,path,fontName){this.MAX_CHAR_TYPES=92;this.pdfkitDoc=pdfkitDoc;this.path=path;this.pdfFonts=[];this.charCatalogue=[];this.name=fontName;this.__defineGetter__('ascender',function(){var font=this.getFont(0);return font.ascender;});this.__defineGetter__('decender',function(){var font=this.getFont(0);return font.decender;});}
FontWrapper.prototype.getFont=function(index){if(!this.pdfFonts[index]){var pseudoName=this.name+index;if(this.postscriptName){delete this.pdfkitDoc._fontFamilies[this.postscriptName];}
this.pdfFonts[index]=this.pdfkitDoc.font(this.path,pseudoName)._font;if(!this.postscriptName){this.postscriptName=this.pdfFonts[index].name;}}
return this.pdfFonts[index];};FontWrapper.prototype.widthOfString=function(){var font=this.getFont(0);return font.widthOfString.apply(font,arguments);};FontWrapper.prototype.lineHeight=function(){var font=this.getFont(0);return font.lineHeight.apply(font,arguments);};FontWrapper.prototype.ref=function(){var font=this.getFont(0);return font.ref.apply(font,arguments);};var toCharCode=function(char){return char.charCodeAt(0);};FontWrapper.prototype.encode=function(text){var self=this;var charTypesInInline=_.chain(text.split('')).map(toCharCode).uniq().value();if(charTypesInInline.length>self.MAX_CHAR_TYPES){throw new Error('Inline has more than '+self.MAX_CHAR_TYPES+': '+text+' different character types and therefore cannot be properly embedded into pdf.');}
var characterFitInFontWithIndex=function(charCatalogue){return _.uniq(charCatalogue.concat(charTypesInInline)).length<=self.MAX_CHAR_TYPES;};var index=_.findIndex(self.charCatalogue,characterFitInFontWithIndex);if(index<0){index=self.charCatalogue.length;self.charCatalogue[index]=[];}
var font=this.getFont(index);font.use(text);_.each(charTypesInInline,function(charCode){if(!_.includes(self.charCatalogue[index],charCode)){self.charCatalogue[index].push(charCode);}});var encodedText=_.map(font.encode(text),function(char){return char.charCodeAt(0).toString(16);}).join('');return{encodedText:encodedText,fontId:font.id};};module.exports=FontWrapper;},function(module,exports,__webpack_require__){(function(Buffer){(function(){var Data,JPEG,PDFImage,PNG,fs;fs=__webpack_require__(10);Data=__webpack_require__(34);JPEG=__webpack_require__(35);PNG=__webpack_require__(36);PDFImage=(function(){function PDFImage(){}
PDFImage.open=function(src,label){var data,match;if(Buffer.isBuffer(src)){data=src;}else{if(match=/^data:.+;base64,(.*)$/.exec(src)){data=new Buffer(match[1],'base64');}else{data=fs.readFileSync(src);if(!data){return;}}}
if(data[0]===0xff&&data[1]===0xd8){return new JPEG(data,label);}else if(data[0]===0x89&&data.toString('ascii',1,4)==='PNG'){return new PNG(data,label);}else{throw new Error('Unknown image format.');}};return PDFImage;})();module.exports=PDFImage;}).call(this);}.call(exports,__webpack_require__(4).Buffer))},function(module,exports,__webpack_require__){'use strict';function TraversalTracker(){this.events={};}
TraversalTracker.prototype.startTracking=function(event,cb){var callbacks=(this.events[event]||(this.events[event]=[]));if(callbacks.indexOf(cb)<0){callbacks.push(cb);}};TraversalTracker.prototype.stopTracking=function(event,cb){var callbacks=this.events[event];if(callbacks){var index=callbacks.indexOf(cb);if(index>=0){callbacks.splice(index,1);}}};TraversalTracker.prototype.emit=function(event){var args=Array.prototype.slice.call(arguments,1);var callbacks=this.events[event];if(callbacks){callbacks.forEach(function(cb){cb.apply(this,args);});}};TraversalTracker.prototype.auto=function(event,cb,innerBlock){this.startTracking(event,cb);innerBlock();this.stopTracking(event,cb);};module.exports=TraversalTracker;},function(module,exports,__webpack_require__){'use strict';var TextTools=__webpack_require__(26);var StyleContextStack=__webpack_require__(27);var ColumnCalculator=__webpack_require__(22);var fontStringify=__webpack_require__(25).fontStringify;var pack=__webpack_require__(25).pack;var qrEncoder=__webpack_require__(33);function DocMeasure(fontProvider,styleDictionary,defaultStyle,imageMeasure,tableLayouts,images){this.textTools=new TextTools(fontProvider);this.styleStack=new StyleContextStack(styleDictionary,defaultStyle);this.imageMeasure=imageMeasure;this.tableLayouts=tableLayouts;this.images=images;this.autoImageIndex=1;}
DocMeasure.prototype.measureDocument=function(docStructure){return this.measureNode(docStructure);};DocMeasure.prototype.measureNode=function(node){if(node instanceof Array){node={stack:node};}else if(typeof node=='string'||node instanceof String){node={text:node};}
var self=this;return this.styleStack.auto(node,function(){node._margin=getNodeMargin(node);if(node.columns){return extendMargins(self.measureColumns(node));}else if(node.stack){return extendMargins(self.measureVerticalContainer(node));}else if(node.ul){return extendMargins(self.measureList(false,node));}else if(node.ol){return extendMargins(self.measureList(true,node));}else if(node.table){return extendMargins(self.measureTable(node));}else if(node.text!==undefined){return extendMargins(self.measureLeaf(node));}else if(node.image){return extendMargins(self.measureImage(node));}else if(node.canvas){return extendMargins(self.measureCanvas(node));}else if(node.qr){return extendMargins(self.measureQr(node));}else{throw'Unrecognized document structure: '+JSON.stringify(node,fontStringify);}});function extendMargins(node){var margin=node._margin;if(margin){node._minWidth+=margin[0]+margin[2];node._maxWidth+=margin[0]+margin[2];}
return node;}
function getNodeMargin(){function processSingleMargins(node,currentMargin){if(node.marginLeft||node.marginTop||node.marginRight||node.marginBottom){return[node.marginLeft||currentMargin[0]||0,node.marginTop||currentMargin[1]||0,node.marginRight||currentMargin[2]||0,node.marginBottom||currentMargin[3]||0];}
return currentMargin;}
function flattenStyleArray(styleArray){var flattenedStyles={};for(var i=styleArray.length-1;i>=0;i--){var styleName=styleArray[i];var style=self.styleStack.styleDictionary[styleName];for(var key in style){if(style.hasOwnProperty(key)){flattenedStyles[key]=style[key];}}}
return flattenedStyles;}
function convertMargin(margin){if(typeof margin==='number'||margin instanceof Number){margin=[margin,margin,margin,margin];}else if(margin instanceof Array){if(margin.length===2){margin=[margin[0],margin[1],margin[0],margin[1]];}}
return margin;}
var margin=[undefined,undefined,undefined,undefined];if(node.style){var styleArray=(node.style instanceof Array)?node.style:[node.style];var flattenedStyleArray=flattenStyleArray(styleArray);if(flattenedStyleArray){margin=processSingleMargins(flattenedStyleArray,margin);}
if(flattenedStyleArray.margin){margin=convertMargin(flattenedStyleArray.margin);}}
margin=processSingleMargins(node,margin);if(node.margin){margin=convertMargin(node.margin);}
if(margin[0]===undefined&&margin[1]===undefined&&margin[2]===undefined&&margin[3]===undefined){return null;}else{return margin;}}};DocMeasure.prototype.convertIfBase64Image=function(node){if(/^data:image\/(jpeg|jpg|png);base64,/.test(node.image)){var label='$$pdfmake$$'+this.autoImageIndex++;this.images[label]=node.image;node.image=label;}};DocMeasure.prototype.measureImage=function(node){if(this.images){this.convertIfBase64Image(node);}
var imageSize=this.imageMeasure.measureImage(node.image);if(node.fit){var factor=(imageSize.width/imageSize.height>node.fit[0]/node.fit[1])?node.fit[0]/imageSize.width:node.fit[1]/imageSize.height;node._width=node._minWidth=node._maxWidth=imageSize.width*factor;node._height=imageSize.height*factor;}else{node._width=node._minWidth=node._maxWidth=node.width||imageSize.width;node._height=node.height||(imageSize.height*node._width/imageSize.width);}
node._alignment=this.styleStack.getProperty('alignment');return node;};DocMeasure.prototype.measureLeaf=function(node){var data=this.textTools.buildInlines(node.text,this.styleStack);node._inlines=data.items;node._minWidth=data.minWidth;node._maxWidth=data.maxWidth;return node;};DocMeasure.prototype.measureVerticalContainer=function(node){var items=node.stack;node._minWidth=0;node._maxWidth=0;for(var i=0,l=items.length;i<l;i++){items[i]=this.measureNode(items[i]);node._minWidth=Math.max(node._minWidth,items[i]._minWidth);node._maxWidth=Math.max(node._maxWidth,items[i]._maxWidth);}
return node;};DocMeasure.prototype.gapSizeForList=function(isOrderedList,listItems){if(isOrderedList){var longestNo=(listItems.length).toString().replace(/./g,'9');return this.textTools.sizeOfString(longestNo+'. ',this.styleStack);}else{return this.textTools.sizeOfString('9. ',this.styleStack);}};DocMeasure.prototype.buildMarker=function(isOrderedList,counter,styleStack,gapSize){var marker;if(isOrderedList){marker={_inlines:this.textTools.buildInlines(counter,styleStack).items};}
else{var radius=gapSize.fontSize/6;marker={canvas:[{x:radius,y:(gapSize.height/gapSize.lineHeight)+gapSize.decender-gapSize.fontSize/3,r1:radius,r2:radius,type:'ellipse',color:'black'}]};}
marker._minWidth=marker._maxWidth=gapSize.width;marker._minHeight=marker._maxHeight=gapSize.height;return marker;};DocMeasure.prototype.measureList=function(isOrdered,node){var style=this.styleStack.clone();var items=isOrdered?node.ol:node.ul;node._gapSize=this.gapSizeForList(isOrdered,items);node._minWidth=0;node._maxWidth=0;var counter=1;for(var i=0,l=items.length;i<l;i++){var nextItem=items[i]=this.measureNode(items[i]);var marker=counter++ +'. ';if(!nextItem.ol&&!nextItem.ul){nextItem.listMarker=this.buildMarker(isOrdered,nextItem.counter||marker,style,node._gapSize);}
node._minWidth=Math.max(node._minWidth,items[i]._minWidth+node._gapSize.width);node._maxWidth=Math.max(node._maxWidth,items[i]._maxWidth+node._gapSize.width);}
return node;};DocMeasure.prototype.measureColumns=function(node){var columns=node.columns;node._gap=this.styleStack.getProperty('columnGap')||0;for(var i=0,l=columns.length;i<l;i++){columns[i]=this.measureNode(columns[i]);}
var measures=ColumnCalculator.measureMinMax(columns);node._minWidth=measures.min+node._gap*(columns.length-1);node._maxWidth=measures.max+node._gap*(columns.length-1);return node;};DocMeasure.prototype.measureTable=function(node){extendTableWidths(node);node._layout=getLayout(this.tableLayouts);node._offsets=getOffsets(node._layout);var colSpans=[];var col,row,cols,rows;for(col=0,cols=node.table.body[0].length;col<cols;col++){var c=node.table.widths[col];c._minWidth=0;c._maxWidth=0;for(row=0,rows=node.table.body.length;row<rows;row++){var rowData=node.table.body[row];var data=rowData[col];if(!data._span){var _this=this;data=rowData[col]=this.styleStack.auto(data,measureCb(this,data));if(data.colSpan&&data.colSpan>1){markSpans(rowData,col,data.colSpan);colSpans.push({col:col,span:data.colSpan,minWidth:data._minWidth,maxWidth:data._maxWidth});}else{c._minWidth=Math.max(c._minWidth,data._minWidth);c._maxWidth=Math.max(c._maxWidth,data._maxWidth);}}
if(data.rowSpan&&data.rowSpan>1){markVSpans(node.table,row,col,data.rowSpan);}}}
extendWidthsForColSpans();var measures=ColumnCalculator.measureMinMax(node.table.widths);node._minWidth=measures.min+node._offsets.total;node._maxWidth=measures.max+node._offsets.total;return node;function measureCb(_this,data){return function(){if(data!==null&&typeof data==='object'){data.fillColor=_this.styleStack.getProperty('fillColor');}
return _this.measureNode(data);};}
function getLayout(tableLayouts){var layout=node.layout;if(typeof node.layout==='string'||node instanceof String){layout=tableLayouts[layout];}
var defaultLayout={hLineWidth:function(i,node){return 1;},vLineWidth:function(i,node){return 1;},hLineColor:function(i,node){return'black';},vLineColor:function(i,node){return'black';},paddingLeft:function(i,node){return 4;},paddingRight:function(i,node){return 4;},paddingTop:function(i,node){return 2;},paddingBottom:function(i,node){return 2;}};return pack(defaultLayout,layout);}
function getOffsets(layout){var offsets=[];var totalOffset=0;var prevRightPadding=0;for(var i=0,l=node.table.widths.length;i<l;i++){var lOffset=prevRightPadding+layout.vLineWidth(i,node)+layout.paddingLeft(i,node);offsets.push(lOffset);totalOffset+=lOffset;prevRightPadding=layout.paddingRight(i,node);}
totalOffset+=prevRightPadding+layout.vLineWidth(node.table.widths.length,node);return{total:totalOffset,offsets:offsets};}
function extendWidthsForColSpans(){var q,j;for(var i=0,l=colSpans.length;i<l;i++){var span=colSpans[i];var currentMinMax=getMinMax(span.col,span.span,node._offsets);var minDifference=span.minWidth-currentMinMax.minWidth;var maxDifference=span.maxWidth-currentMinMax.maxWidth;if(minDifference>0){q=minDifference/span.span;for(j=0;j<span.span;j++){node.table.widths[span.col+j]._minWidth+=q;}}
if(maxDifference>0){q=maxDifference/span.span;for(j=0;j<span.span;j++){node.table.widths[span.col+j]._maxWidth+=q;}}}}
function getMinMax(col,span,offsets){var result={minWidth:0,maxWidth:0};for(var i=0;i<span;i++){result.minWidth+=node.table.widths[col+i]._minWidth+(i?offsets.offsets[col+i]:0);result.maxWidth+=node.table.widths[col+i]._maxWidth+(i?offsets.offsets[col+i]:0);}
return result;}
function markSpans(rowData,col,span){for(var i=1;i<span;i++){rowData[col+i]={_span:true,_minWidth:0,_maxWidth:0,rowSpan:rowData[col].rowSpan};}}
function markVSpans(table,row,col,span){for(var i=1;i<span;i++){table.body[row+i][col]={_span:true,_minWidth:0,_maxWidth:0,fillColor:table.body[row][col].fillColor};}}
function extendTableWidths(node){if(!node.table.widths){node.table.widths='auto';}
if(typeof node.table.widths==='string'||node.table.widths instanceof String){node.table.widths=[node.table.widths];while(node.table.widths.length<node.table.body[0].length){node.table.widths.push(node.table.widths[node.table.widths.length-1]);}}
for(var i=0,l=node.table.widths.length;i<l;i++){var w=node.table.widths[i];if(typeof w==='number'||w instanceof Number||typeof w==='string'||w instanceof String){node.table.widths[i]={width:w};}}}};DocMeasure.prototype.measureCanvas=function(node){var w=0,h=0;for(var i=0,l=node.canvas.length;i<l;i++){var vector=node.canvas[i];switch(vector.type){case'ellipse':w=Math.max(w,vector.x+vector.r1);h=Math.max(h,vector.y+vector.r2);break;case'rect':w=Math.max(w,vector.x+vector.w);h=Math.max(h,vector.y+vector.h);break;case'line':w=Math.max(w,vector.x1,vector.x2);h=Math.max(h,vector.y1,vector.y2);break;case'polyline':for(var i2=0,l2=vector.points.length;i2<l2;i2++){w=Math.max(w,vector.points[i2].x);h=Math.max(h,vector.points[i2].y);}
break;}}
node._minWidth=node._maxWidth=w;node._minHeight=node._maxHeight=h;return node;};DocMeasure.prototype.measureQr=function(node){node=qrEncoder.measure(node);node._alignment=this.styleStack.getProperty('alignment');return node;};module.exports=DocMeasure;},function(module,exports,__webpack_require__){'use strict';var TraversalTracker=__webpack_require__(18);function DocumentContext(pageSize,pageMargins){this.pages=[];this.pageMargins=pageMargins;this.x=pageMargins.left;this.availableWidth=pageSize.width-pageMargins.left-pageMargins.right;this.availableHeight=0;this.page=-1;this.snapshots=[];this.endingCell=null;this.tracker=new TraversalTracker();this.addPage(pageSize);}
DocumentContext.prototype.beginColumnGroup=function(){this.snapshots.push({x:this.x,y:this.y,availableHeight:this.availableHeight,availableWidth:this.availableWidth,page:this.page,bottomMost:{y:this.y,page:this.page},endingCell:this.endingCell,lastColumnWidth:this.lastColumnWidth});this.lastColumnWidth=0;};DocumentContext.prototype.beginColumn=function(width,offset,endingCell){var saved=this.snapshots[this.snapshots.length-1];this.calculateBottomMost(saved);this.endingCell=endingCell;this.page=saved.page;this.x=this.x+this.lastColumnWidth+(offset||0);this.y=saved.y;this.availableWidth=width;this.availableHeight=saved.availableHeight;this.lastColumnWidth=width;};DocumentContext.prototype.calculateBottomMost=function(destContext){if(this.endingCell){this.saveContextInEndingCell(this.endingCell);this.endingCell=null;}else{destContext.bottomMost=bottomMostContext(this,destContext.bottomMost);}};DocumentContext.prototype.markEnding=function(endingCell){this.page=endingCell._columnEndingContext.page;this.x=endingCell._columnEndingContext.x;this.y=endingCell._columnEndingContext.y;this.availableWidth=endingCell._columnEndingContext.availableWidth;this.availableHeight=endingCell._columnEndingContext.availableHeight;this.lastColumnWidth=endingCell._columnEndingContext.lastColumnWidth;};DocumentContext.prototype.saveContextInEndingCell=function(endingCell){endingCell._columnEndingContext={page:this.page,x:this.x,y:this.y,availableHeight:this.availableHeight,availableWidth:this.availableWidth,lastColumnWidth:this.lastColumnWidth};};DocumentContext.prototype.completeColumnGroup=function(){var saved=this.snapshots.pop();this.calculateBottomMost(saved);this.endingCell=null;this.x=saved.x;this.y=saved.bottomMost.y;this.page=saved.bottomMost.page;this.availableWidth=saved.availableWidth;this.availableHeight=saved.bottomMost.availableHeight;this.lastColumnWidth=saved.lastColumnWidth;};DocumentContext.prototype.addMargin=function(left,right){this.x+=left;this.availableWidth-=left+(right||0);};DocumentContext.prototype.moveDown=function(offset){this.y+=offset;this.availableHeight-=offset;return this.availableHeight>0;};DocumentContext.prototype.initializePage=function(){this.y=this.pageMargins.top;this.availableHeight=this.getCurrentPage().pageSize.height-this.pageMargins.top-this.pageMargins.bottom;this.pageSnapshot().availableWidth=this.getCurrentPage().pageSize.width-this.pageMargins.left-this.pageMargins.right;};DocumentContext.prototype.pageSnapshot=function(){if(this.snapshots[0]){return this.snapshots[0];}else{return this;}};DocumentContext.prototype.moveTo=function(x,y){if(x!==undefined&&x!==null){this.x=x;this.availableWidth=this.getCurrentPage().pageSize.width-this.x-this.pageMargins.right;}
if(y!==undefined&&y!==null){this.y=y;this.availableHeight=this.getCurrentPage().pageSize.height-this.y-this.pageMargins.bottom;}};DocumentContext.prototype.beginDetachedBlock=function(){this.snapshots.push({x:this.x,y:this.y,availableHeight:this.availableHeight,availableWidth:this.availableWidth,page:this.page,endingCell:this.endingCell,lastColumnWidth:this.lastColumnWidth});};DocumentContext.prototype.endDetachedBlock=function(){var saved=this.snapshots.pop();this.x=saved.x;this.y=saved.y;this.availableWidth=saved.availableWidth;this.availableHeight=saved.availableHeight;this.page=saved.page;this.endingCell=saved.endingCell;this.lastColumnWidth=saved.lastColumnWidth;};function pageOrientation(pageOrientationString,currentPageOrientation){if(pageOrientationString===undefined){return currentPageOrientation;}else if(pageOrientationString==='landscape'){return'landscape';}else{return'portrait';}}
var getPageSize=function(currentPage,newPageOrientation){newPageOrientation=pageOrientation(newPageOrientation,currentPage.pageSize.orientation);if(newPageOrientation!==currentPage.pageSize.orientation){return{orientation:newPageOrientation,width:currentPage.pageSize.height,height:currentPage.pageSize.width};}else{return{orientation:currentPage.pageSize.orientation,width:currentPage.pageSize.width,height:currentPage.pageSize.height};}};DocumentContext.prototype.moveToNextPage=function(pageOrientation){var nextPageIndex=this.page+1;var prevPage=this.page;var prevY=this.y;var createNewPage=nextPageIndex>=this.pages.length;if(createNewPage){this.addPage(getPageSize(this.getCurrentPage(),pageOrientation));}else{this.page=nextPageIndex;this.initializePage();}
return{newPageCreated:createNewPage,prevPage:prevPage,prevY:prevY,y:this.y};};DocumentContext.prototype.addPage=function(pageSize){var page={items:[],pageSize:pageSize};this.pages.push(page);this.page=this.pages.length-1;this.initializePage();this.tracker.emit('pageAdded');return page;};DocumentContext.prototype.getCurrentPage=function(){if(this.page<0||this.page>=this.pages.length)return null;return this.pages[this.page];};DocumentContext.prototype.getCurrentPosition=function(){var pageSize=this.getCurrentPage().pageSize;var innerHeight=pageSize.height-this.pageMargins.top-this.pageMargins.bottom;var innerWidth=pageSize.width-this.pageMargins.left-this.pageMargins.right;return{pageNumber:this.page+1,pageOrientation:pageSize.orientation,pageInnerHeight:innerHeight,pageInnerWidth:innerWidth,left:this.x,top:this.y,verticalRatio:((this.y-this.pageMargins.top)/innerHeight),horizontalRatio:((this.x-this.pageMargins.left)/innerWidth)};};function bottomMostContext(c1,c2){var r;if(c1.page>c2.page)r=c1;else if(c2.page>c1.page)r=c2;else r=(c1.y>c2.y)?c1:c2;return{page:r.page,x:r.x,y:r.y,availableHeight:r.availableHeight,availableWidth:r.availableWidth};}
module.exports=DocumentContext;},function(module,exports,__webpack_require__){'use strict';var ElementWriter=__webpack_require__(37);function PageElementWriter(context,tracker){this.transactionLevel=0;this.repeatables=[];this.tracker=tracker;this.writer=new ElementWriter(context,tracker);}
function fitOnPage(self,addFct){var position=addFct(self);if(!position){self.moveToNextPage();position=addFct(self);}
return position;}
PageElementWriter.prototype.addLine=function(line,dontUpdateContextPosition,index){return fitOnPage(this,function(self){return self.writer.addLine(line,dontUpdateContextPosition,index);});};PageElementWriter.prototype.addImage=function(image,index){return fitOnPage(this,function(self){return self.writer.addImage(image,index);});};PageElementWriter.prototype.addQr=function(qr,index){return fitOnPage(this,function(self){return self.writer.addQr(qr,index);});};PageElementWriter.prototype.addVector=function(vector,ignoreContextX,ignoreContextY,index){return this.writer.addVector(vector,ignoreContextX,ignoreContextY,index);};PageElementWriter.prototype.addFragment=function(fragment,useBlockXOffset,useBlockYOffset,dontUpdateContextPosition){if(!this.writer.addFragment(fragment,useBlockXOffset,useBlockYOffset,dontUpdateContextPosition)){this.moveToNextPage();this.writer.addFragment(fragment,useBlockXOffset,useBlockYOffset,dontUpdateContextPosition);}};PageElementWriter.prototype.moveToNextPage=function(pageOrientation){var nextPage=this.writer.context.moveToNextPage(pageOrientation);if(nextPage.newPageCreated){this.repeatables.forEach(function(rep){this.writer.addFragment(rep,true);},this);}else{this.repeatables.forEach(function(rep){this.writer.context.moveDown(rep.height);},this);}
this.writer.tracker.emit('pageChanged',{prevPage:nextPage.prevPage,prevY:nextPage.prevY,y:nextPage.y});};PageElementWriter.prototype.beginUnbreakableBlock=function(width,height){if(this.transactionLevel++===0){this.originalX=this.writer.context.x;this.writer.pushContext(width,height);}};PageElementWriter.prototype.commitUnbreakableBlock=function(forcedX,forcedY){if(--this.transactionLevel===0){var unbreakableContext=this.writer.context;this.writer.popContext();var nbPages=unbreakableContext.pages.length;if(nbPages>0){var fragment=unbreakableContext.pages[0];fragment.xOffset=forcedX;fragment.yOffset=forcedY;if(nbPages>1){if(forcedX!==undefined||forcedY!==undefined){fragment.height=unbreakableContext.getCurrentPage().pageSize.height-unbreakableContext.pageMargins.top-unbreakableContext.pageMargins.bottom;}else{fragment.height=this.writer.context.getCurrentPage().pageSize.height-this.writer.context.pageMargins.top-this.writer.context.pageMargins.bottom;for(var i=0,l=this.repeatables.length;i<l;i++){fragment.height-=this.repeatables[i].height;}}}else{fragment.height=unbreakableContext.y;}
if(forcedX!==undefined||forcedY!==undefined){this.writer.addFragment(fragment,true,true,true);}else{this.addFragment(fragment);}}}};PageElementWriter.prototype.currentBlockToRepeatable=function(){var unbreakableContext=this.writer.context;var rep={items:[]};unbreakableContext.pages[0].items.forEach(function(item){rep.items.push(item);});rep.xOffset=this.originalX;rep.height=unbreakableContext.y;return rep;};PageElementWriter.prototype.pushToRepeatables=function(rep){this.repeatables.push(rep);};PageElementWriter.prototype.popFromRepeatables=function(){this.repeatables.pop();};PageElementWriter.prototype.context=function(){return this.writer.context;};module.exports=PageElementWriter;},function(module,exports,__webpack_require__){'use strict';function buildColumnWidths(columns,availableWidth){var autoColumns=[],autoMin=0,autoMax=0,starColumns=[],starMaxMin=0,starMaxMax=0,fixedColumns=[],initial_availableWidth=availableWidth;columns.forEach(function(column){if(isAutoColumn(column)){autoColumns.push(column);autoMin+=column._minWidth;autoMax+=column._maxWidth;}else if(isStarColumn(column)){starColumns.push(column);starMaxMin=Math.max(starMaxMin,column._minWidth);starMaxMax=Math.max(starMaxMax,column._maxWidth);}else{fixedColumns.push(column);}});fixedColumns.forEach(function(col){if(typeof col.width==='string'&&/\d+%/.test(col.width)){col.width=parseFloat(col.width)*initial_availableWidth/100;}
if(col.width<(col._minWidth)&&col.elasticWidth){col._calcWidth=col._minWidth;}else{col._calcWidth=col.width;}
availableWidth-=col._calcWidth;});var minW=autoMin+starMaxMin*starColumns.length;var maxW=autoMax+starMaxMax*starColumns.length;if(minW>=availableWidth){autoColumns.forEach(function(col){col._calcWidth=col._minWidth;});starColumns.forEach(function(col){col._calcWidth=starMaxMin;});}else{if(maxW<availableWidth){autoColumns.forEach(function(col){col._calcWidth=col._maxWidth;availableWidth-=col._calcWidth;});}else{var W=availableWidth-minW;var D=maxW-minW;autoColumns.forEach(function(col){var d=col._maxWidth-col._minWidth;col._calcWidth=col._minWidth+d*W/D;availableWidth-=col._calcWidth;});}
if(starColumns.length>0){var starSize=availableWidth/starColumns.length;starColumns.forEach(function(col){col._calcWidth=starSize;});}}}
function isAutoColumn(column){return column.width==='auto';}
function isStarColumn(column){return column.width===null||column.width===undefined||column.width==='*'||column.width==='star';}
function measureMinMax(columns){var result={min:0,max:0};var maxStar={min:0,max:0};var starCount=0;for(var i=0,l=columns.length;i<l;i++){var c=columns[i];if(isStarColumn(c)){maxStar.min=Math.max(maxStar.min,c._minWidth);maxStar.max=Math.max(maxStar.max,c._maxWidth);starCount++;}else if(isAutoColumn(c)){result.min+=c._minWidth;result.max+=c._maxWidth;}else{result.min+=((c.width!==undefined&&c.width)||c._minWidth);result.max+=((c.width!==undefined&&c.width)||c._maxWidth);}}
if(starCount){result.min+=starCount*maxStar.min;result.max+=starCount*maxStar.max;}
return result;}
module.exports={buildColumnWidths:buildColumnWidths,measureMinMax:measureMinMax,isAutoColumn:isAutoColumn,isStarColumn:isStarColumn};},function(module,exports,__webpack_require__){'use strict';var ColumnCalculator=__webpack_require__(22);function TableProcessor(tableNode){this.tableNode=tableNode;}
TableProcessor.prototype.beginTable=function(writer){var tableNode;var availableWidth;var self=this;tableNode=this.tableNode;this.offsets=tableNode._offsets;this.layout=tableNode._layout;availableWidth=writer.context().availableWidth-this.offsets.total;ColumnCalculator.buildColumnWidths(tableNode.table.widths,availableWidth);this.tableWidth=tableNode._offsets.total+getTableInnerContentWidth();this.rowSpanData=prepareRowSpanData();this.cleanUpRepeatables=false;this.headerRows=tableNode.table.headerRows||0;this.rowsWithoutPageBreak=this.headerRows+(tableNode.table.keepWithHeaderRows||0);this.dontBreakRows=tableNode.table.dontBreakRows||false;if(this.rowsWithoutPageBreak){writer.beginUnbreakableBlock();}
this.drawHorizontalLine(0,writer);function getTableInnerContentWidth(){var width=0;tableNode.table.widths.forEach(function(w){width+=w._calcWidth;});return width;}
function prepareRowSpanData(){var rsd=[];var x=0;var lastWidth=0;rsd.push({left:0,rowSpan:0});for(var i=0,l=self.tableNode.table.body[0].length;i<l;i++){var paddings=self.layout.paddingLeft(i,self.tableNode)+self.layout.paddingRight(i,self.tableNode);var lBorder=self.layout.vLineWidth(i,self.tableNode);lastWidth=paddings+lBorder+self.tableNode.table.widths[i]._calcWidth;rsd[rsd.length-1].width=lastWidth;x+=lastWidth;rsd.push({left:x,rowSpan:0,width:0});}
return rsd;}};TableProcessor.prototype.onRowBreak=function(rowIndex,writer){var self=this;return function(){var offset=self.rowPaddingTop+(!self.headerRows?self.topLineWidth:0);writer.context().moveDown(offset);};};TableProcessor.prototype.beginRow=function(rowIndex,writer){this.topLineWidth=this.layout.hLineWidth(rowIndex,this.tableNode);this.rowPaddingTop=this.layout.paddingTop(rowIndex,this.tableNode);this.bottomLineWidth=this.layout.hLineWidth(rowIndex+1,this.tableNode);this.rowPaddingBottom=this.layout.paddingBottom(rowIndex,this.tableNode);this.rowCallback=this.onRowBreak(rowIndex,writer);writer.tracker.startTracking('pageChanged',this.rowCallback);if(this.dontBreakRows){writer.beginUnbreakableBlock();}
this.rowTopY=writer.context().y;this.reservedAtBottom=this.bottomLineWidth+this.rowPaddingBottom;writer.context().availableHeight-=this.reservedAtBottom;writer.context().moveDown(this.rowPaddingTop);};TableProcessor.prototype.drawHorizontalLine=function(lineIndex,writer,overrideY){var lineWidth=this.layout.hLineWidth(lineIndex,this.tableNode);if(lineWidth){var offset=lineWidth/2;var currentLine=null;for(var i=0,l=this.rowSpanData.length;i<l;i++){var data=this.rowSpanData[i];var shouldDrawLine=!data.rowSpan;if(!currentLine&&shouldDrawLine){currentLine={left:data.left,width:0};}
if(shouldDrawLine){currentLine.width+=(data.width||0);}
var y=(overrideY||0)+offset;if(!shouldDrawLine||i===l-1){if(currentLine){writer.addVector({type:'line',x1:currentLine.left,x2:currentLine.left+currentLine.width,y1:y,y2:y,lineWidth:lineWidth,lineColor:typeof this.layout.hLineColor==='function'?this.layout.hLineColor(lineIndex,this.tableNode):this.layout.hLineColor},false,overrideY);currentLine=null;}}}
writer.context().moveDown(lineWidth);}};TableProcessor.prototype.drawVerticalLine=function(x,y0,y1,vLineIndex,writer){var width=this.layout.vLineWidth(vLineIndex,this.tableNode);if(width===0)return;writer.addVector({type:'line',x1:x+width/2,x2:x+width/2,y1:y0,y2:y1,lineWidth:width,lineColor:typeof this.layout.vLineColor==='function'?this.layout.vLineColor(vLineIndex,this.tableNode):this.layout.vLineColor},false,true);};TableProcessor.prototype.endTable=function(writer){if(this.cleanUpRepeatables){writer.popFromRepeatables();}};TableProcessor.prototype.endRow=function(rowIndex,writer,pageBreaks){var l,i;var self=this;writer.tracker.stopTracking('pageChanged',this.rowCallback);writer.context().moveDown(this.layout.paddingBottom(rowIndex,this.tableNode));writer.context().availableHeight+=this.reservedAtBottom;var endingPage=writer.context().page;var endingY=writer.context().y;var xs=getLineXs();var ys=[];var hasBreaks=pageBreaks&&pageBreaks.length>0;ys.push({y0:this.rowTopY,page:hasBreaks?pageBreaks[0].prevPage:endingPage});if(hasBreaks){for(i=0,l=pageBreaks.length;i<l;i++){var pageBreak=pageBreaks[i];ys[ys.length-1].y1=pageBreak.prevY;ys.push({y0:pageBreak.y,page:pageBreak.prevPage+1});}}
ys[ys.length-1].y1=endingY;var skipOrphanePadding=(ys[0].y1-ys[0].y0===this.rowPaddingTop);for(var yi=(skipOrphanePadding?1:0),yl=ys.length;yi<yl;yi++){var willBreak=yi<ys.length-1;var rowBreakWithoutHeader=(yi>0&&!this.headerRows);var hzLineOffset=rowBreakWithoutHeader?0:this.topLineWidth;var y1=ys[yi].y0;var y2=ys[yi].y1;if(willBreak){y2=y2+this.rowPaddingBottom;}
if(writer.context().page!=ys[yi].page){writer.context().page=ys[yi].page;this.reservedAtBottom=0;}
for(i=0,l=xs.length;i<l;i++){this.drawVerticalLine(xs[i].x,y1-hzLineOffset,y2+this.bottomLineWidth,xs[i].index,writer);if(i<l-1){var colIndex=xs[i].index;var fillColor=this.tableNode.table.body[rowIndex][colIndex].fillColor;if(fillColor){var wBorder=this.layout.vLineWidth(colIndex,this.tableNode);var xf=xs[i].x+wBorder;var yf=y1-hzLineOffset;writer.addVector({type:'rect',x:xf,y:yf,w:xs[i+1].x-xf,h:y2+this.bottomLineWidth-yf,lineWidth:0,color:fillColor},false,true,0);}}}
if(willBreak&&this.layout.hLineWhenBroken!==false){this.drawHorizontalLine(rowIndex+1,writer,y2);}
if(rowBreakWithoutHeader&&this.layout.hLineWhenBroken!==false){this.drawHorizontalLine(rowIndex,writer,y1);}}
writer.context().page=endingPage;writer.context().y=endingY;var row=this.tableNode.table.body[rowIndex];for(i=0,l=row.length;i<l;i++){if(row[i].rowSpan){this.rowSpanData[i].rowSpan=row[i].rowSpan;if(row[i].colSpan&&row[i].colSpan>1){for(var j=1;j<row[i].rowSpan;j++){this.tableNode.table.body[rowIndex+j][i]._colSpan=row[i].colSpan;}}}
if(this.rowSpanData[i].rowSpan>0){this.rowSpanData[i].rowSpan--;}}
this.drawHorizontalLine(rowIndex+1,writer);if(this.headerRows&&rowIndex===this.headerRows-1){this.headerRepeatable=writer.currentBlockToRepeatable();}
if(this.dontBreakRows){writer.tracker.auto('pageChanged',function(){self.drawHorizontalLine(rowIndex,writer);},function(){writer.commitUnbreakableBlock();self.drawHorizontalLine(rowIndex,writer);});}
if(this.headerRepeatable&&(rowIndex===(this.rowsWithoutPageBreak-1)||rowIndex===this.tableNode.table.body.length-1)){writer.commitUnbreakableBlock();writer.pushToRepeatables(this.headerRepeatable);this.cleanUpRepeatables=true;this.headerRepeatable=null;}
function getLineXs(){var result=[];var cols=0;for(var i=0,l=self.tableNode.table.body[rowIndex].length;i<l;i++){if(!cols){result.push({x:self.rowSpanData[i].left,index:i});var item=self.tableNode.table.body[rowIndex][i];cols=(item._colSpan||item.colSpan||0);}
if(cols>0){cols--;}}
result.push({x:self.rowSpanData[self.rowSpanData.length-1].left,index:self.rowSpanData.length-1});return result;}};module.exports=TableProcessor;},function(module,exports,__webpack_require__){'use strict';function Line(maxWidth){this.maxWidth=maxWidth;this.leadingCut=0;this.trailingCut=0;this.inlineWidths=0;this.inlines=[];}
Line.prototype.getAscenderHeight=function(){var y=0;this.inlines.forEach(function(inline){y=Math.max(y,inline.font.ascender/1000*inline.fontSize);});return y;};Line.prototype.hasEnoughSpaceForInline=function(inline){if(this.inlines.length===0)return true;if(this.newLineForced)return false;return this.inlineWidths+inline.width-this.leadingCut-(inline.trailingCut||0)<=this.maxWidth;};Line.prototype.addInline=function(inline){if(this.inlines.length===0){this.leadingCut=inline.leadingCut||0;}
this.trailingCut=inline.trailingCut||0;inline.x=this.inlineWidths-this.leadingCut;this.inlines.push(inline);this.inlineWidths+=inline.width;if(inline.lineEnd){this.newLineForced=true;}};Line.prototype.getWidth=function(){return this.inlineWidths-this.leadingCut-this.trailingCut;};Line.prototype.getHeight=function(){var max=0;this.inlines.forEach(function(item){max=Math.max(max,item.height||0);});return max;};module.exports=Line;},function(module,exports,__webpack_require__){'use strict';function pack(){var result={};for(var i=0,l=arguments.length;i<l;i++){var obj=arguments[i];if(obj){for(var key in obj){if(obj.hasOwnProperty(key)){result[key]=obj[key];}}}}
return result;}
function offsetVector(vector,x,y){switch(vector.type){case'ellipse':case'rect':vector.x+=x;vector.y+=y;break;case'line':vector.x1+=x;vector.x2+=x;vector.y1+=y;vector.y2+=y;break;case'polyline':for(var i=0,l=vector.points.length;i<l;i++){vector.points[i].x+=x;vector.points[i].y+=y;}
break;}}
function fontStringify(key,val){if(key==='font'){return'font';}
return val;}
function isFunction(functionToCheck){var getType={};return functionToCheck&&getType.toString.call(functionToCheck)==='[object Function]';}
module.exports={pack:pack,fontStringify:fontStringify,offsetVector:offsetVector,isFunction:isFunction};},function(module,exports,__webpack_require__){'use strict';var WORD_RE=/([^ ,\/!.?:;\-\n]*[ ,\/!.?:;\-]*)|\n/g;var LEADING=/^(\s)+/g;var TRAILING=/(\s)+$/g;function TextTools(fontProvider){this.fontProvider=fontProvider;}
TextTools.prototype.buildInlines=function(textArray,styleContextStack){var measured=measure(this.fontProvider,textArray,styleContextStack);var minWidth=0,maxWidth=0,currentLineWidth;measured.forEach(function(inline){minWidth=Math.max(minWidth,inline.width-inline.leadingCut-inline.trailingCut);if(!currentLineWidth){currentLineWidth={width:0,leadingCut:inline.leadingCut,trailingCut:0};}
currentLineWidth.width+=inline.width;currentLineWidth.trailingCut=inline.trailingCut;maxWidth=Math.max(maxWidth,getTrimmedWidth(currentLineWidth));if(inline.lineEnd){currentLineWidth=null;}});return{items:measured,minWidth:minWidth,maxWidth:maxWidth};function getTrimmedWidth(item){return Math.max(0,item.width-item.leadingCut-item.trailingCut);}};TextTools.prototype.sizeOfString=function(text,styleContextStack){text=text.replace('\t','    ');var fontName=getStyleProperty({},styleContextStack,'font','Roboto');var fontSize=getStyleProperty({},styleContextStack,'fontSize',12);var bold=getStyleProperty({},styleContextStack,'bold',false);var italics=getStyleProperty({},styleContextStack,'italics',false);var lineHeight=getStyleProperty({},styleContextStack,'lineHeight',1);var font=this.fontProvider.provideFont(fontName,bold,italics);return{width:font.widthOfString(removeDiacritics(text),fontSize),height:font.lineHeight(fontSize)*lineHeight,fontSize:fontSize,lineHeight:lineHeight,ascender:font.ascender/1000*fontSize,decender:font.decender/1000*fontSize};};function splitWords(text){var results=[];text=text.replace('\t','    ');var array=text.match(WORD_RE);for(var i=0,l=array.length;i<l-1;i++){var item=array[i];var isNewLine=item.length===0;if(!isNewLine){results.push({text:item});}
else{var shouldAddLine=(results.length===0||results[results.length-1].lineEnd);if(shouldAddLine){results.push({text:'',lineEnd:true});}
else{results[results.length-1].lineEnd=true;}}}
return results;}
function copyStyle(source,destination){destination=destination||{};source=source||{};for(var key in source){if(key!='text'&&source.hasOwnProperty(key)){destination[key]=source[key];}}
return destination;}
function normalizeTextArray(array){var results=[];if(typeof array=='string'||array instanceof String){array=[array];}
for(var i=0,l=array.length;i<l;i++){var item=array[i];var style=null;var words;if(typeof item=='string'||item instanceof String){words=splitWords(item);}else{words=splitWords(item.text);style=copyStyle(item);}
for(var i2=0,l2=words.length;i2<l2;i2++){var result={text:words[i2].text};if(words[i2].lineEnd){result.lineEnd=true;}
copyStyle(style,result);results.push(result);}}
return results;}
var diacriticsMap={'Ą':'A','Ć':'C','Ę':'E','Ł':'L','Ń':'N','Ó':'O','Ś':'S','Ź':'Z','Ż':'Z','ą':'a','ć':'c','ę':'e','ł':'l','ń':'n','ó':'o','ś':'s','ź':'z','ż':'z'};function removeDiacritics(text){return text.replace(/[^A-Za-z0-9\[\] ]/g,function(a){return diacriticsMap[a]||a;});}
function getStyleProperty(item,styleContextStack,property,defaultValue){var value;if(item[property]!==undefined&&item[property]!==null){return item[property];}
if(!styleContextStack)return defaultValue;styleContextStack.auto(item,function(){value=styleContextStack.getProperty(property);});if(value!==null&&value!==undefined){return value;}else{return defaultValue;}}
function measure(fontProvider,textArray,styleContextStack){var normalized=normalizeTextArray(textArray);normalized.forEach(function(item){var fontName=getStyleProperty(item,styleContextStack,'font','Roboto');var fontSize=getStyleProperty(item,styleContextStack,'fontSize',12);var bold=getStyleProperty(item,styleContextStack,'bold',false);var italics=getStyleProperty(item,styleContextStack,'italics',false);var color=getStyleProperty(item,styleContextStack,'color','black');var decoration=getStyleProperty(item,styleContextStack,'decoration',null);var decorationColor=getStyleProperty(item,styleContextStack,'decorationColor',null);var decorationStyle=getStyleProperty(item,styleContextStack,'decorationStyle',null);var background=getStyleProperty(item,styleContextStack,'background',null);var lineHeight=getStyleProperty(item,styleContextStack,'lineHeight',1);var font=fontProvider.provideFont(fontName,bold,italics);item.width=font.widthOfString(removeDiacritics(item.text),fontSize);item.height=font.lineHeight(fontSize)*lineHeight;var leadingSpaces=item.text.match(LEADING);var trailingSpaces=item.text.match(TRAILING);if(leadingSpaces){item.leadingCut=font.widthOfString(leadingSpaces[0],fontSize);}
else{item.leadingCut=0;}
if(trailingSpaces){item.trailingCut=font.widthOfString(trailingSpaces[0],fontSize);}
else{item.trailingCut=0;}
item.alignment=getStyleProperty(item,styleContextStack,'alignment','left');item.font=font;item.fontSize=fontSize;item.color=color;item.decoration=decoration;item.decorationColor=decorationColor;item.decorationStyle=decorationStyle;item.background=background;});return normalized;}
module.exports=TextTools;},function(module,exports,__webpack_require__){'use strict';function StyleContextStack(styleDictionary,defaultStyle){this.defaultStyle=defaultStyle||{};this.styleDictionary=styleDictionary;this.styleOverrides=[];}
StyleContextStack.prototype.clone=function(){var stack=new StyleContextStack(this.styleDictionary,this.defaultStyle);this.styleOverrides.forEach(function(item){stack.styleOverrides.push(item);});return stack;};StyleContextStack.prototype.push=function(styleNameOrOverride){this.styleOverrides.push(styleNameOrOverride);};StyleContextStack.prototype.pop=function(howMany){howMany=howMany||1;while(howMany-->0){this.styleOverrides.pop();}};StyleContextStack.prototype.autopush=function(item){if(typeof item==='string'||item instanceof String)return 0;var styleNames=[];if(item.style){if(item.style instanceof Array){styleNames=item.style;}else{styleNames=[item.style];}}
for(var i=0,l=styleNames.length;i<l;i++){this.push(styleNames[i]);}
var styleOverrideObject={};var pushSOO=false;['font','fontSize','bold','italics','alignment','color','columnGap','fillColor','decoration','decorationStyle','decorationColor','background','lineHeight'].forEach(function(key){if(item[key]!==undefined&&item[key]!==null){styleOverrideObject[key]=item[key];pushSOO=true;}});if(pushSOO){this.push(styleOverrideObject);}
return styleNames.length+(pushSOO?1:0);};StyleContextStack.prototype.auto=function(item,callback){var pushedItems=this.autopush(item);var result=callback();if(pushedItems>0){this.pop(pushedItems);}
return result;};StyleContextStack.prototype.getProperty=function(property){if(this.styleOverrides){for(var i=this.styleOverrides.length-1;i>=0;i--){var item=this.styleOverrides[i];if(typeof item=='string'||item instanceof String){var style=this.styleDictionary[item];if(style&&style[property]!==null&&style[property]!==undefined){return style[property];}}else{if(item[property]!==undefined&&item[property]!==null){return item[property];}}}}
return this.defaultStyle&&this.defaultStyle[property];};module.exports=StyleContextStack;},function(module,exports,__webpack_require__){(function(Buffer){(function(){var PDFDocument,PDFObject,PDFPage,PDFReference,fs,stream,__hasProp={}.hasOwnProperty,__extends=function(child,parent){for(var key in parent){if(__hasProp.call(parent,key))child[key]=parent[key];}function ctor(){this.constructor=child;}ctor.prototype=parent.prototype;child.prototype=new ctor();child.__super__=parent.prototype;return child;};stream=__webpack_require__(46);fs=__webpack_require__(10);PDFObject=__webpack_require__(32);PDFReference=__webpack_require__(12);PDFPage=__webpack_require__(38);PDFDocument=(function(_super){var mixin;__extends(PDFDocument,_super);function PDFDocument(options){var key,val,_ref,_ref1;this.options=options!=null?options:{};PDFDocument.__super__.constructor.apply(this,arguments);this.version=1.3;this.compress=(_ref=this.options.compress)!=null?_ref:true;this._pageBuffer=[];this._pageBufferStart=0;this._offsets=[];this._waiting=0;this._ended=false;this._offset=0;this._root=this.ref({Type:'Catalog',Pages:this.ref({Type:'Pages',Count:0,Kids:[]})});this.page=null;this.initColor();this.initVector();this.initFonts();this.initText();this.initImages();this.info={Producer:'PDFKit',Creator:'PDFKit',CreationDate:new Date()};if(this.options.info){_ref1=this.options.info;for(key in _ref1){val=_ref1[key];this.info[key]=val;}}
this._write("%PDF-"+this.version);this._write("%\xFF\xFF\xFF\xFF");this.addPage();}
mixin=function(methods){var method,name,_results;_results=[];for(name in methods){method=methods[name];_results.push(PDFDocument.prototype[name]=method);}
return _results;};mixin(__webpack_require__(41));mixin(__webpack_require__(39));mixin(__webpack_require__(44));mixin(__webpack_require__(40));mixin(__webpack_require__(42));mixin(__webpack_require__(43));PDFDocument.prototype.addPage=function(options){var pages;if(options==null){options=this.options;}
if(!this.options.bufferPages){this.flushPages();}
this.page=new PDFPage(this,options);this._pageBuffer.push(this.page);pages=this._root.data.Pages.data;pages.Kids.push(this.page.dictionary);pages.Count++;this.x=this.page.margins.left;this.y=this.page.margins.top;this._ctm=[1,0,0,1,0,0];this.transform(1,0,0,-1,0,this.page.height);return this;};PDFDocument.prototype.bufferedPageRange=function(){return{start:this._pageBufferStart,count:this._pageBuffer.length};};PDFDocument.prototype.switchToPage=function(n){var page;if(!(page=this._pageBuffer[n-this._pageBufferStart])){throw new Error("switchToPage("+n+") out of bounds, current buffer covers pages "+this._pageBufferStart+" to "+(this._pageBufferStart+this._pageBuffer.length-1));}
return this.page=page;};PDFDocument.prototype.flushPages=function(){var page,pages,_i,_len;pages=this._pageBuffer;this._pageBuffer=[];this._pageBufferStart+=pages.length;for(_i=0,_len=pages.length;_i<_len;_i++){page=pages[_i];page.end();}};PDFDocument.prototype.ref=function(data){var ref;ref=new PDFReference(this,this._offsets.length+1,data);this._offsets.push(null);this._waiting++;return ref;};PDFDocument.prototype._read=function(){};PDFDocument.prototype._write=function(data){if(!Buffer.isBuffer(data)){data=new Buffer(data+'\n','binary');}
this.push(data);return this._offset+=data.length;};PDFDocument.prototype.addContent=function(data){this.page.write(data);return this;};PDFDocument.prototype._refEnd=function(ref){this._offsets[ref.id-1]=ref.offset;if(--this._waiting===0&&this._ended){this._finalize();return this._ended=false;}};PDFDocument.prototype.write=function(filename,fn){var err;err=new Error('PDFDocument#write is deprecated, and will be removed in a future version of PDFKit. Please pipe the document into a Node stream.');console.warn(err.stack);this.pipe(fs.createWriteStream(filename));this.end();return this.once('end',fn);};PDFDocument.prototype.output=function(fn){throw new Error('PDFDocument#output is deprecated, and has been removed from PDFKit. Please pipe the document into a Node stream.');};PDFDocument.prototype.end=function(){var font,key,name,val,_ref,_ref1;this.flushPages();this._info=this.ref();_ref=this.info;for(key in _ref){val=_ref[key];if(typeof val==='string'){val=new String(val);}
this._info.data[key]=val;}
this._info.end();_ref1=this._fontFamilies;for(name in _ref1){font=_ref1[name];font.embed();}
this._root.end();this._root.data.Pages.end();if(this._waiting===0){return this._finalize();}else{return this._ended=true;}};PDFDocument.prototype._finalize=function(fn){var offset,xRefOffset,_i,_len,_ref;xRefOffset=this._offset;this._write("xref");this._write("0 "+(this._offsets.length+1));this._write("0000000000 65535 f ");_ref=this._offsets;for(_i=0,_len=_ref.length;_i<_len;_i++){offset=_ref[_i];offset=('0000000000'+offset).slice(-10);this._write(offset+' 00000 n ');}
this._write('trailer');this._write(PDFObject.convert({Size:this._offsets.length+1,Root:this._root,Info:this._info}));this._write('startxref');this._write(""+xRefOffset);this._write('%%EOF');return this.push(null);};PDFDocument.prototype.toString=function(){return"[object PDFDocument]";};return PDFDocument;})(stream.Readable);module.exports=PDFDocument;}).call(this);}.call(exports,__webpack_require__(4).Buffer))},function(module,exports,__webpack_require__){exports.read=function(buffer,offset,isLE,mLen,nBytes){var e,m,eLen=nBytes*8-mLen-1,eMax=(1<<eLen)-1,eBias=eMax>>1,nBits=-7,i=isLE?(nBytes-1):0,d=isLE?-1:1,s=buffer[offset+i];i+=d;e=s&((1<<(-nBits))-1);s>>=(-nBits);nBits+=eLen;for(;nBits>0;e=e*256+buffer[offset+i],i+=d,nBits-=8);m=e&((1<<(-nBits))-1);e>>=(-nBits);nBits+=mLen;for(;nBits>0;m=m*256+buffer[offset+i],i+=d,nBits-=8);if(e===0){e=1-eBias;}else if(e===eMax){return m?NaN:((s?-1:1)*Infinity);}else{m=m+Math.pow(2,mLen);e=e-eBias;}
return(s?-1:1)*m*Math.pow(2,e-mLen);};exports.write=function(buffer,value,offset,isLE,mLen,nBytes){var e,m,c,eLen=nBytes*8-mLen-1,eMax=(1<<eLen)-1,eBias=eMax>>1,rt=(mLen===23?Math.pow(2,-24)-Math.pow(2,-77):0),i=isLE?0:(nBytes-1),d=isLE?1:-1,s=value<0||(value===0&&1/value<0)?1:0;value=Math.abs(value);if(isNaN(value)||value===Infinity){m=isNaN(value)?1:0;e=eMax;}else{e=Math.floor(Math.log(value)/Math.LN2);if(value*(c=Math.pow(2,-e))<1){e--;c*=2;}
if(e+eBias>=1){value+=rt/c;}else{value+=rt*Math.pow(2,1-eBias);}
if(value*c>=2){e++;c/=2;}
if(e+eBias>=eMax){m=0;e=eMax;}else if(e+eBias>=1){m=(value*c-1)*Math.pow(2,mLen);e=e+eBias;}else{m=value*Math.pow(2,eBias-1)*Math.pow(2,mLen);e=0;}}
for(;mLen>=8;buffer[offset+i]=m&0xff,i+=d,m/=256,mLen-=8);e=(e<<mLen)|m;eLen+=mLen;for(;eLen>0;buffer[offset+i]=e&0xff,i+=d,e/=256,eLen-=8);buffer[offset+i-d]|=s*128;};},function(module,exports,__webpack_require__){var isArray=Array.isArray;var str=Object.prototype.toString;module.exports=isArray||function(val){return!!val&&'[object Array]'==str.call(val);};},function(module,exports,__webpack_require__){var lookup='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';;(function(exports){'use strict';var Arr=(typeof Uint8Array!=='undefined')?Uint8Array:Array
var PLUS='+'.charCodeAt(0)
var SLASH='/'.charCodeAt(0)
var NUMBER='0'.charCodeAt(0)
var LOWER='a'.charCodeAt(0)
var UPPER='A'.charCodeAt(0)
var PLUS_URL_SAFE='-'.charCodeAt(0)
var SLASH_URL_SAFE='_'.charCodeAt(0)
function decode(elt){var code=elt.charCodeAt(0)
if(code===PLUS||code===PLUS_URL_SAFE)
return 62
if(code===SLASH||code===SLASH_URL_SAFE)
return 63
if(code<NUMBER)
return-1
if(code<NUMBER+10)
return code-NUMBER+26+26
if(code<UPPER+26)
return code-UPPER
if(code<LOWER+26)
return code-LOWER+26}
function b64ToByteArray(b64){var i,j,l,tmp,placeHolders,arr
if(b64.length%4>0){throw new Error('Invalid string. Length must be a multiple of 4')}
var len=b64.length
placeHolders='='===b64.charAt(len-2)?2:'='===b64.charAt(len-1)?1:0
arr=new Arr(b64.length*3/4-placeHolders)
l=placeHolders>0?b64.length-4:b64.length
var L=0
function push(v){arr[L++]=v}
for(i=0,j=0;i<l;i+=4,j+=3){tmp=(decode(b64.charAt(i))<<18)|(decode(b64.charAt(i+1))<<12)|(decode(b64.charAt(i+2))<<6)|decode(b64.charAt(i+3))
push((tmp&0xFF0000)>>16)
push((tmp&0xFF00)>>8)
push(tmp&0xFF)}
if(placeHolders===2){tmp=(decode(b64.charAt(i))<<2)|(decode(b64.charAt(i+1))>>4)
push(tmp&0xFF)}else if(placeHolders===1){tmp=(decode(b64.charAt(i))<<10)|(decode(b64.charAt(i+1))<<4)|(decode(b64.charAt(i+2))>>2)
push((tmp>>8)&0xFF)
push(tmp&0xFF)}
return arr}
function uint8ToBase64(uint8){var i,extraBytes=uint8.length%3,output="",temp,length
function encode(num){return lookup.charAt(num)}
function tripletToBase64(num){return encode(num>>18&0x3F)+encode(num>>12&0x3F)+encode(num>>6&0x3F)+encode(num&0x3F)}
for(i=0,length=uint8.length-extraBytes;i<length;i+=3){temp=(uint8[i]<<16)+(uint8[i+1]<<8)+(uint8[i+2])
output+=tripletToBase64(temp)}
switch(extraBytes){case 1:temp=uint8[uint8.length-1]
output+=encode(temp>>2)
output+=encode((temp<<4)&0x3F)
output+='=='
break
case 2:temp=(uint8[uint8.length-2]<<8)+(uint8[uint8.length-1])
output+=encode(temp>>10)
output+=encode((temp>>4)&0x3F)
output+=encode((temp<<2)&0x3F)
output+='='
break}
return output}
exports.toByteArray=b64ToByteArray
exports.fromByteArray=uint8ToBase64}(false?(this.base64js={}):exports))},function(module,exports,__webpack_require__){(function(Buffer){(function(){var PDFObject,PDFReference;PDFObject=(function(){var escapable,escapableRe,pad,swapBytes;function PDFObject(){}
pad=function(str,length){return(Array(length+1).join('0')+str).slice(-length);};escapableRe=/[\n\r\t\b\f\(\)\\]/g;escapable={'\n':'\\n','\r':'\\r','\t':'\\t','\b':'\\b','\f':'\\f','\\':'\\\\','(':'\\(',')':'\\)'};swapBytes=function(buff){var a,i,l,_i,_ref;l=buff.length;if(l&0x01){throw new Error("Buffer length must be even");}else{for(i=_i=0,_ref=l-1;_i<_ref;i=_i+=2){a=buff[i];buff[i]=buff[i+1];buff[i+1]=a;}}
return buff;};PDFObject.convert=function(object){var e,i,isUnicode,items,key,out,string,val,_i,_ref;if(typeof object==='string'){return'/'+object;}else if(object instanceof String){string=object.replace(escapableRe,function(c){return escapable[c];});isUnicode=false;for(i=_i=0,_ref=string.length;_i<_ref;i=_i+=1){if(string.charCodeAt(i)>0x7f){isUnicode=true;break;}}
if(isUnicode){string=swapBytes(new Buffer('\ufeff'+string,'utf16le')).toString('binary');}
return'('+string+')';}else if(Buffer.isBuffer(object)){return'<'+object.toString('hex')+'>';}else if(object instanceof PDFReference){return object.toString();}else if(object instanceof Date){return'(D:'+pad(object.getUTCFullYear(),4)+pad(object.getUTCMonth(),2)+pad(object.getUTCDate(),2)+pad(object.getUTCHours(),2)+pad(object.getUTCMinutes(),2)+pad(object.getUTCSeconds(),2)+'Z)';}else if(Array.isArray(object)){items=((function(){var _j,_len,_results;_results=[];for(_j=0,_len=object.length;_j<_len;_j++){e=object[_j];_results.push(PDFObject.convert(e));}
return _results;})()).join(' ');return'['+items+']';}else if({}.toString.call(object)==='[object Object]'){out=['<<'];for(key in object){val=object[key];out.push('/'+key+' '+PDFObject.convert(val));}
out.push('>>');return out.join('\n');}else{return''+object;}};return PDFObject;})();module.exports=PDFObject;PDFReference=__webpack_require__(12);}).call(this);}.call(exports,__webpack_require__(4).Buffer))},function(module,exports,__webpack_require__){'use strict';var VERSIONS=[null,[[10,7,17,13],[1,1,1,1],[]],[[16,10,28,22],[1,1,1,1],[4,16]],[[26,15,22,18],[1,1,2,2],[4,20]],[[18,20,16,26],[2,1,4,2],[4,24]],[[24,26,22,18],[2,1,4,4],[4,28]],[[16,18,28,24],[4,2,4,4],[4,32]],[[18,20,26,18],[4,2,5,6],[4,20,36]],[[22,24,26,22],[4,2,6,6],[4,22,40]],[[22,30,24,20],[5,2,8,8],[4,24,44]],[[26,18,28,24],[5,4,8,8],[4,26,48]],[[30,20,24,28],[5,4,11,8],[4,28,52]],[[22,24,28,26],[8,4,11,10],[4,30,56]],[[22,26,22,24],[9,4,16,12],[4,32,60]],[[24,30,24,20],[9,4,16,16],[4,24,44,64]],[[24,22,24,30],[10,6,18,12],[4,24,46,68]],[[28,24,30,24],[10,6,16,17],[4,24,48,72]],[[28,28,28,28],[11,6,19,16],[4,28,52,76]],[[26,30,28,28],[13,6,21,18],[4,28,54,80]],[[26,28,26,26],[14,7,25,21],[4,28,56,84]],[[26,28,28,30],[16,8,25,20],[4,32,60,88]],[[26,28,30,28],[17,8,25,23],[4,26,48,70,92]],[[28,28,24,30],[17,9,34,23],[4,24,48,72,96]],[[28,30,30,30],[18,9,30,25],[4,28,52,76,100]],[[28,30,30,30],[20,10,32,27],[4,26,52,78,104]],[[28,26,30,30],[21,12,35,29],[4,30,56,82,108]],[[28,28,30,28],[23,12,37,34],[4,28,56,84,112]],[[28,30,30,30],[25,12,40,34],[4,32,60,88,116]],[[28,30,30,30],[26,13,42,35],[4,24,48,72,96,120]],[[28,30,30,30],[28,14,45,38],[4,28,52,76,100,124]],[[28,30,30,30],[29,15,48,40],[4,24,50,76,102,128]],[[28,30,30,30],[31,16,51,43],[4,28,54,80,106,132]],[[28,30,30,30],[33,17,54,45],[4,32,58,84,110,136]],[[28,30,30,30],[35,18,57,48],[4,28,56,84,112,140]],[[28,30,30,30],[37,19,60,51],[4,32,60,88,116,144]],[[28,30,30,30],[38,19,63,53],[4,28,52,76,100,124,148]],[[28,30,30,30],[40,20,66,56],[4,22,48,74,100,126,152]],[[28,30,30,30],[43,21,70,59],[4,26,52,78,104,130,156]],[[28,30,30,30],[45,22,74,62],[4,30,56,82,108,134,160]],[[28,30,30,30],[47,24,77,65],[4,24,52,80,108,136,164]],[[28,30,30,30],[49,25,81,68],[4,28,56,84,112,140,168]]];var MODE_TERMINATOR=0;var MODE_NUMERIC=1,MODE_ALPHANUMERIC=2,MODE_OCTET=4,MODE_KANJI=8;var NUMERIC_REGEXP=/^\d*$/;var ALPHANUMERIC_REGEXP=/^[A-Za-z0-9 $%*+\-./:]*$/;var ALPHANUMERIC_OUT_REGEXP=/^[A-Z0-9 $%*+\-./:]*$/;var ECCLEVEL_L=1,ECCLEVEL_M=0,ECCLEVEL_Q=3,ECCLEVEL_H=2;var GF256_MAP=[],GF256_INVMAP=[-1];for(var i=0,v=1;i<255;++i){GF256_MAP.push(v);GF256_INVMAP[v]=i;v=(v*2)^(v>=128?0x11d:0);}
var GF256_GENPOLY=[[]];for(var i=0;i<30;++i){var prevpoly=GF256_GENPOLY[i],poly=[];for(var j=0;j<=i;++j){var a=(j<i?GF256_MAP[prevpoly[j]]:0);var b=GF256_MAP[(i+(prevpoly[j-1]||0))%255];poly.push(GF256_INVMAP[a^b]);}
GF256_GENPOLY.push(poly);}
var ALPHANUMERIC_MAP={};for(var i=0;i<45;++i){ALPHANUMERIC_MAP['0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ $%*+-./:'.charAt(i)]=i;}
var MASKFUNCS=[function(i,j){return(i+j)%2===0;},function(i,j){return i%2===0;},function(i,j){return j%3===0;},function(i,j){return(i+j)%3===0;},function(i,j){return(((i/2)|0)+((j/3)|0))%2===0;},function(i,j){return(i*j)%2+(i*j)%3===0;},function(i,j){return((i*j)%2+(i*j)%3)%2===0;},function(i,j){return((i+j)%2+(i*j)%3)%2===0;}];var needsverinfo=function(ver){return ver>6;};var getsizebyver=function(ver){return 4*ver+17;};var nfullbits=function(ver){var v=VERSIONS[ver];var nbits=16*ver*ver+128*ver+64;if(needsverinfo(ver))nbits-=36;if(v[2].length){nbits-=25*v[2].length*v[2].length-10*v[2].length-55;}
return nbits;};var ndatabits=function(ver,ecclevel){var nbits=nfullbits(ver)&~7;var v=VERSIONS[ver];nbits-=8*v[0][ecclevel]*v[1][ecclevel];return nbits;};var ndatalenbits=function(ver,mode){switch(mode){case MODE_NUMERIC:return(ver<10?10:ver<27?12:14);case MODE_ALPHANUMERIC:return(ver<10?9:ver<27?11:13);case MODE_OCTET:return(ver<10?8:16);case MODE_KANJI:return(ver<10?8:ver<27?10:12);}};var getmaxdatalen=function(ver,mode,ecclevel){var nbits=ndatabits(ver,ecclevel)-4-ndatalenbits(ver,mode);switch(mode){case MODE_NUMERIC:return((nbits/10)|0)*3+(nbits%10<4?0:nbits%10<7?1:2);case MODE_ALPHANUMERIC:return((nbits/11)|0)*2+(nbits%11<6?0:1);case MODE_OCTET:return(nbits/8)|0;case MODE_KANJI:return(nbits/13)|0;}};var validatedata=function(mode,data){switch(mode){case MODE_NUMERIC:if(!data.match(NUMERIC_REGEXP))return null;return data;case MODE_ALPHANUMERIC:if(!data.match(ALPHANUMERIC_REGEXP))return null;return data.toUpperCase();case MODE_OCTET:if(typeof data==='string'){var newdata=[];for(var i=0;i<data.length;++i){var ch=data.charCodeAt(i);if(ch<0x80){newdata.push(ch);}else if(ch<0x800){newdata.push(0xc0|(ch>>6),0x80|(ch&0x3f));}else if(ch<0x10000){newdata.push(0xe0|(ch>>12),0x80|((ch>>6)&0x3f),0x80|(ch&0x3f));}else{newdata.push(0xf0|(ch>>18),0x80|((ch>>12)&0x3f),0x80|((ch>>6)&0x3f),0x80|(ch&0x3f));}}
return newdata;}else{return data;}}};var encode=function(ver,mode,data,maxbuflen){var buf=[];var bits=0,remaining=8;var datalen=data.length;var pack=function(x,n){if(n>=remaining){buf.push(bits|(x>>(n-=remaining)));while(n>=8)buf.push((x>>(n-=8))&255);bits=0;remaining=8;}
if(n>0)bits|=(x&((1<<n)-1))<<(remaining-=n);};var nlenbits=ndatalenbits(ver,mode);pack(mode,4);pack(datalen,nlenbits);switch(mode){case MODE_NUMERIC:for(var i=2;i<datalen;i+=3){pack(parseInt(data.substring(i-2,i+1),10),10);}
pack(parseInt(data.substring(i-2),10),[0,4,7][datalen%3]);break;case MODE_ALPHANUMERIC:for(var i=1;i<datalen;i+=2){pack(ALPHANUMERIC_MAP[data.charAt(i-1)]*45+ALPHANUMERIC_MAP[data.charAt(i)],11);}
if(datalen%2==1){pack(ALPHANUMERIC_MAP[data.charAt(i-1)],6);}
break;case MODE_OCTET:for(var i=0;i<datalen;++i){pack(data[i],8);}
break;}
pack(MODE_TERMINATOR,4);if(remaining<8)buf.push(bits);while(buf.length+1<maxbuflen)buf.push(0xec,0x11);if(buf.length<maxbuflen)buf.push(0xec);return buf;};var calculateecc=function(poly,genpoly){var modulus=poly.slice(0);var polylen=poly.length,genpolylen=genpoly.length;for(var i=0;i<genpolylen;++i)modulus.push(0);for(var i=0;i<polylen;){var quotient=GF256_INVMAP[modulus[i++]];if(quotient>=0){for(var j=0;j<genpolylen;++j){modulus[i+j]^=GF256_MAP[(quotient+genpoly[j])%255];}}}
return modulus.slice(polylen);};var augumenteccs=function(poly,nblocks,genpoly){var subsizes=[];var subsize=(poly.length/nblocks)|0,subsize0=0;var pivot=nblocks-poly.length%nblocks;for(var i=0;i<pivot;++i){subsizes.push(subsize0);subsize0+=subsize;}
for(var i=pivot;i<nblocks;++i){subsizes.push(subsize0);subsize0+=subsize+1;}
subsizes.push(subsize0);var eccs=[];for(var i=0;i<nblocks;++i){eccs.push(calculateecc(poly.slice(subsizes[i],subsizes[i+1]),genpoly));}
var result=[];var nitemsperblock=(poly.length/nblocks)|0;for(var i=0;i<nitemsperblock;++i){for(var j=0;j<nblocks;++j){result.push(poly[subsizes[j]+i]);}}
for(var j=pivot;j<nblocks;++j){result.push(poly[subsizes[j+1]-1]);}
for(var i=0;i<genpoly.length;++i){for(var j=0;j<nblocks;++j){result.push(eccs[j][i]);}}
return result;};var augumentbch=function(poly,p,genpoly,q){var modulus=poly<<q;for(var i=p-1;i>=0;--i){if((modulus>>(q+i))&1)modulus^=genpoly<<i;}
return(poly<<q)|modulus;};var makebasematrix=function(ver){var v=VERSIONS[ver],n=getsizebyver(ver);var matrix=[],reserved=[];for(var i=0;i<n;++i){matrix.push([]);reserved.push([]);}
var blit=function(y,x,h,w,bits){for(var i=0;i<h;++i){for(var j=0;j<w;++j){matrix[y+i][x+j]=(bits[i]>>j)&1;reserved[y+i][x+j]=1;}}};blit(0,0,9,9,[0x7f,0x41,0x5d,0x5d,0x5d,0x41,0x17f,0x00,0x40]);blit(n-8,0,8,9,[0x100,0x7f,0x41,0x5d,0x5d,0x5d,0x41,0x7f]);blit(0,n-8,9,8,[0xfe,0x82,0xba,0xba,0xba,0x82,0xfe,0x00,0x00]);for(var i=9;i<n-8;++i){matrix[6][i]=matrix[i][6]=~i&1;reserved[6][i]=reserved[i][6]=1;}
var aligns=v[2],m=aligns.length;for(var i=0;i<m;++i){var minj=(i===0||i===m-1?1:0),maxj=(i===0?m-1:m);for(var j=minj;j<maxj;++j){blit(aligns[i],aligns[j],5,5,[0x1f,0x11,0x15,0x11,0x1f]);}}
if(needsverinfo(ver)){var code=augumentbch(ver,6,0x1f25,12);var k=0;for(var i=0;i<6;++i){for(var j=0;j<3;++j){matrix[i][(n-11)+j]=matrix[(n-11)+j][i]=(code>>k++)&1;reserved[i][(n-11)+j]=reserved[(n-11)+j][i]=1;}}}
return{matrix:matrix,reserved:reserved};};var putdata=function(matrix,reserved,buf){var n=matrix.length;var k=0,dir=-1;for(var i=n-1;i>=0;i-=2){if(i==6)--i;var jj=(dir<0?n-1:0);for(var j=0;j<n;++j){for(var ii=i;ii>i-2;--ii){if(!reserved[jj][ii]){matrix[jj][ii]=(buf[k>>3]>>(~k&7))&1;++k;}}
jj+=dir;}
dir=-dir;}
return matrix;};var maskdata=function(matrix,reserved,mask){var maskf=MASKFUNCS[mask];var n=matrix.length;for(var i=0;i<n;++i){for(var j=0;j<n;++j){if(!reserved[i][j])matrix[i][j]^=maskf(i,j);}}
return matrix;};var putformatinfo=function(matrix,reserved,ecclevel,mask){var n=matrix.length;var code=augumentbch((ecclevel<<3)|mask,5,0x537,10)^0x5412;for(var i=0;i<15;++i){var r=[0,1,2,3,4,5,7,8,n-7,n-6,n-5,n-4,n-3,n-2,n-1][i];var c=[n-1,n-2,n-3,n-4,n-5,n-6,n-7,n-8,7,5,4,3,2,1,0][i];matrix[r][8]=matrix[8][c]=(code>>i)&1;}
return matrix;};var evaluatematrix=function(matrix){var PENALTY_CONSECUTIVE=3;var PENALTY_TWOBYTWO=3;var PENALTY_FINDERLIKE=40;var PENALTY_DENSITY=10;var evaluategroup=function(groups){var score=0;for(var i=0;i<groups.length;++i){if(groups[i]>=5)score+=PENALTY_CONSECUTIVE+(groups[i]-5);}
for(var i=5;i<groups.length;i+=2){var p=groups[i];if(groups[i-1]==p&&groups[i-2]==3*p&&groups[i-3]==p&&groups[i-4]==p&&(groups[i-5]>=4*p||groups[i+1]>=4*p)){score+=PENALTY_FINDERLIKE;}}
return score;};var n=matrix.length;var score=0,nblacks=0;for(var i=0;i<n;++i){var row=matrix[i];var groups;groups=[0];for(var j=0;j<n;){var k;for(k=0;j<n&&row[j];++k)++j;groups.push(k);for(k=0;j<n&&!row[j];++k)++j;groups.push(k);}
score+=evaluategroup(groups);groups=[0];for(var j=0;j<n;){var k;for(k=0;j<n&&matrix[j][i];++k)++j;groups.push(k);for(k=0;j<n&&!matrix[j][i];++k)++j;groups.push(k);}
score+=evaluategroup(groups);var nextrow=matrix[i+1]||[];nblacks+=row[0];for(var j=1;j<n;++j){var p=row[j];nblacks+=p;if(row[j-1]==p&&nextrow[j]===p&&nextrow[j-1]===p){score+=PENALTY_TWOBYTWO;}}}
score+=PENALTY_DENSITY*((Math.abs(nblacks/n/n-0.5)/0.05)|0);return score;};var generate=function(data,ver,mode,ecclevel,mask){var v=VERSIONS[ver];var buf=encode(ver,mode,data,ndatabits(ver,ecclevel)>>3);buf=augumenteccs(buf,v[1][ecclevel],GF256_GENPOLY[v[0][ecclevel]]);var result=makebasematrix(ver);var matrix=result.matrix,reserved=result.reserved;putdata(matrix,reserved,buf);if(mask<0){maskdata(matrix,reserved,0);putformatinfo(matrix,reserved,ecclevel,0);var bestmask=0,bestscore=evaluatematrix(matrix);maskdata(matrix,reserved,0);for(mask=1;mask<8;++mask){maskdata(matrix,reserved,mask);putformatinfo(matrix,reserved,ecclevel,mask);var score=evaluatematrix(matrix);if(bestscore>score){bestscore=score;bestmask=mask;}
maskdata(matrix,reserved,mask);}
mask=bestmask;}
maskdata(matrix,reserved,mask);putformatinfo(matrix,reserved,ecclevel,mask);return matrix;};function generateFrame(data,options){var MODES={'numeric':MODE_NUMERIC,'alphanumeric':MODE_ALPHANUMERIC,'octet':MODE_OCTET};var ECCLEVELS={'L':ECCLEVEL_L,'M':ECCLEVEL_M,'Q':ECCLEVEL_Q,'H':ECCLEVEL_H};options=options||{};var ver=options.version||-1;var ecclevel=ECCLEVELS[(options.eccLevel||'L').toUpperCase()];var mode=options.mode?MODES[options.mode.toLowerCase()]:-1;var mask='mask'in options?options.mask:-1;if(mode<0){if(typeof data==='string'){if(data.match(NUMERIC_REGEXP)){mode=MODE_NUMERIC;}else if(data.match(ALPHANUMERIC_OUT_REGEXP)){mode=MODE_ALPHANUMERIC;}else{mode=MODE_OCTET;}}else{mode=MODE_OCTET;}}else if(!(mode==MODE_NUMERIC||mode==MODE_ALPHANUMERIC||mode==MODE_OCTET)){throw'invalid or unsupported mode';}
data=validatedata(mode,data);if(data===null)throw'invalid data format';if(ecclevel<0||ecclevel>3)throw'invalid ECC level';if(ver<0){for(ver=1;ver<=40;++ver){if(data.length<=getmaxdatalen(ver,mode,ecclevel))break;}
if(ver>40)throw'too large data for the Qr format';}else if(ver<1||ver>40){throw'invalid Qr version! should be between 1 and 40';}
if(mask!=-1&&(mask<0||mask>8))throw'invalid mask';return generate(data,ver,mode,ecclevel,mask);}
function buildCanvas(data,options){var canvas=[];var background=data.background||'#fff';var foreground=data.foreground||'#000';var matrix=generateFrame(data,options);var n=matrix.length;var modSize=Math.floor(options.fit?options.fit/n:5);var size=n*modSize;canvas.push({type:'rect',x:0,y:0,w:size,h:size,lineWidth:0,color:background});for(var i=0;i<n;++i){for(var j=0;j<n;++j){if(matrix[i][j]){canvas.push({type:'rect',x:modSize*i,y:modSize*j,w:modSize,h:modSize,lineWidth:0,color:foreground});}}}
return{canvas:canvas,size:size};}
function measure(node){var cd=buildCanvas(node.qr,node);node._canvas=cd.canvas;node._width=node._height=node._minWidth=node._maxWidth=node._minHeight=node._maxHeight=cd.size;return node;}
module.exports={measure:measure};},function(module,exports,__webpack_require__){(function(){var Data;Data=(function(){function Data(data){this.data=data!=null?data:[];this.pos=0;this.length=this.data.length;}
Data.prototype.readByte=function(){return this.data[this.pos++];};Data.prototype.writeByte=function(byte){return this.data[this.pos++]=byte;};Data.prototype.byteAt=function(index){return this.data[index];};Data.prototype.readBool=function(){return!!this.readByte();};Data.prototype.writeBool=function(val){return this.writeByte(val?1:0);};Data.prototype.readUInt32=function(){var b1,b2,b3,b4;b1=this.readByte()*0x1000000;b2=this.readByte()<<16;b3=this.readByte()<<8;b4=this.readByte();return b1+b2+b3+b4;};Data.prototype.writeUInt32=function(val){this.writeByte((val>>>24)&0xff);this.writeByte((val>>16)&0xff);this.writeByte((val>>8)&0xff);return this.writeByte(val&0xff);};Data.prototype.readInt32=function(){var int;int=this.readUInt32();if(int>=0x80000000){return int-0x100000000;}else{return int;}};Data.prototype.writeInt32=function(val){if(val<0){val+=0x100000000;}
return this.writeUInt32(val);};Data.prototype.readUInt16=function(){var b1,b2;b1=this.readByte()<<8;b2=this.readByte();return b1|b2;};Data.prototype.writeUInt16=function(val){this.writeByte((val>>8)&0xff);return this.writeByte(val&0xff);};Data.prototype.readInt16=function(){var int;int=this.readUInt16();if(int>=0x8000){return int-0x10000;}else{return int;}};Data.prototype.writeInt16=function(val){if(val<0){val+=0x10000;}
return this.writeUInt16(val);};Data.prototype.readString=function(length){var i,ret,_i;ret=[];for(i=_i=0;0<=length?_i<length:_i>length;i=0<=length?++_i:--_i){ret[i]=String.fromCharCode(this.readByte());}
return ret.join('');};Data.prototype.writeString=function(val){var i,_i,_ref,_results;_results=[];for(i=_i=0,_ref=val.length;0<=_ref?_i<_ref:_i>_ref;i=0<=_ref?++_i:--_i){_results.push(this.writeByte(val.charCodeAt(i)));}
return _results;};Data.prototype.stringAt=function(pos,length){this.pos=pos;return this.readString(length);};Data.prototype.readShort=function(){return this.readInt16();};Data.prototype.writeShort=function(val){return this.writeInt16(val);};Data.prototype.readLongLong=function(){var b1,b2,b3,b4,b5,b6,b7,b8;b1=this.readByte();b2=this.readByte();b3=this.readByte();b4=this.readByte();b5=this.readByte();b6=this.readByte();b7=this.readByte();b8=this.readByte();if(b1&0x80){return((b1^0xff)*0x100000000000000+(b2^0xff)*0x1000000000000+(b3^0xff)*0x10000000000+(b4^0xff)*0x100000000+(b5^0xff)*0x1000000+(b6^0xff)*0x10000+(b7^0xff)*0x100+(b8^0xff)+1)*-1;}
return b1*0x100000000000000+b2*0x1000000000000+b3*0x10000000000+b4*0x100000000+b5*0x1000000+b6*0x10000+b7*0x100+b8;};Data.prototype.writeLongLong=function(val){var high,low;high=Math.floor(val/0x100000000);low=val&0xffffffff;this.writeByte((high>>24)&0xff);this.writeByte((high>>16)&0xff);this.writeByte((high>>8)&0xff);this.writeByte(high&0xff);this.writeByte((low>>24)&0xff);this.writeByte((low>>16)&0xff);this.writeByte((low>>8)&0xff);return this.writeByte(low&0xff);};Data.prototype.readInt=function(){return this.readInt32();};Data.prototype.writeInt=function(val){return this.writeInt32(val);};Data.prototype.slice=function(start,end){return this.data.slice(start,end);};Data.prototype.read=function(bytes){var buf,i,_i;buf=[];for(i=_i=0;0<=bytes?_i<bytes:_i>bytes;i=0<=bytes?++_i:--_i){buf.push(this.readByte());}
return buf;};Data.prototype.write=function(bytes){var byte,_i,_len,_results;_results=[];for(_i=0,_len=bytes.length;_i<_len;_i++){byte=bytes[_i];_results.push(this.writeByte(byte));}
return _results;};return Data;})();module.exports=Data;}).call(this);},function(module,exports,__webpack_require__){(function(){var JPEG,fs,__indexOf=[].indexOf||function(item){for(var i=0,l=this.length;i<l;i++){if(i in this&&this[i]===item)return i;}return-1;};fs=__webpack_require__(10);JPEG=(function(){var MARKERS;MARKERS=[0xFFC0,0xFFC1,0xFFC2,0xFFC3,0xFFC5,0xFFC6,0xFFC7,0xFFC8,0xFFC9,0xFFCA,0xFFCB,0xFFCC,0xFFCD,0xFFCE,0xFFCF];function JPEG(data,label){var channels,marker,pos;this.data=data;this.label=label;if(this.data.readUInt16BE(0)!==0xFFD8){throw"SOI not found in JPEG";}
pos=2;while(pos<this.data.length){marker=this.data.readUInt16BE(pos);pos+=2;if(__indexOf.call(MARKERS,marker)>=0){break;}
pos+=this.data.readUInt16BE(pos);}
if(__indexOf.call(MARKERS,marker)<0){throw"Invalid JPEG.";}
pos+=2;this.bits=this.data[pos++];this.height=this.data.readUInt16BE(pos);pos+=2;this.width=this.data.readUInt16BE(pos);pos+=2;channels=this.data[pos++];this.colorSpace=(function(){switch(channels){case 1:return'DeviceGray';case 3:return'DeviceRGB';case 4:return'DeviceCMYK';}})();this.obj=null;}
JPEG.prototype.embed=function(document){if(this.obj){return;}
this.obj=document.ref({Type:'XObject',Subtype:'Image',BitsPerComponent:this.bits,Width:this.width,Height:this.height,ColorSpace:this.colorSpace,Filter:'DCTDecode'});if(this.colorSpace==='DeviceCMYK'){this.obj.data['Decode']=[1.0,0.0,1.0,0.0,1.0,0.0,1.0,0.0];}
this.obj.end(this.data);return this.data=null;};return JPEG;})();module.exports=JPEG;}).call(this);},function(module,exports,__webpack_require__){(function(Buffer){(function(){var PNG,PNGImage,zlib;zlib=__webpack_require__(45);PNG=__webpack_require__(51);PNGImage=(function(){function PNGImage(data,label){this.label=label;this.image=new PNG(data);this.width=this.image.width;this.height=this.image.height;this.imgData=this.image.imgData;this.obj=null;}
PNGImage.prototype.embed=function(document){var mask,palette,params,rgb,val,x,_i,_len;this.document=document;if(this.obj){return;}
this.obj=document.ref({Type:'XObject',Subtype:'Image',BitsPerComponent:this.image.bits,Width:this.width,Height:this.height,Filter:'FlateDecode'});if(!this.image.hasAlphaChannel){params=document.ref({Predictor:15,Colors:this.image.colors,BitsPerComponent:this.image.bits,Columns:this.width});this.obj.data['DecodeParms']=params;params.end();}
if(this.image.palette.length===0){this.obj.data['ColorSpace']=this.image.colorSpace;}else{palette=document.ref();palette.end(new Buffer(this.image.palette));this.obj.data['ColorSpace']=['Indexed','DeviceRGB',(this.image.palette.length/3)-1,palette];}
if(this.image.transparency.grayscale){val=this.image.transparency.greyscale;return this.obj.data['Mask']=[val,val];}else if(this.image.transparency.rgb){rgb=this.image.transparency.rgb;mask=[];for(_i=0,_len=rgb.length;_i<_len;_i++){x=rgb[_i];mask.push(x,x);}
return this.obj.data['Mask']=mask;}else if(this.image.transparency.indexed){return this.loadIndexedAlphaChannel();}else if(this.image.hasAlphaChannel){return this.splitAlphaChannel();}else{return this.finalize();}};PNGImage.prototype.finalize=function(){var sMask;if(this.alphaChannel){sMask=this.document.ref({Type:'XObject',Subtype:'Image',Height:this.height,Width:this.width,BitsPerComponent:8,Filter:'FlateDecode',ColorSpace:'DeviceGray',Decode:[0,1]});sMask.end(this.alphaChannel);this.obj.data['SMask']=sMask;}
this.obj.end(this.imgData);this.image=null;return this.imgData=null;};PNGImage.prototype.splitAlphaChannel=function(){return this.image.decodePixels((function(_this){return function(pixels){var a,alphaChannel,colorByteSize,done,i,imgData,len,p,pixelCount;colorByteSize=_this.image.colors*_this.image.bits/8;pixelCount=_this.width*_this.height;imgData=new Buffer(pixelCount*colorByteSize);alphaChannel=new Buffer(pixelCount);i=p=a=0;len=pixels.length;while(i<len){imgData[p++]=pixels[i++];imgData[p++]=pixels[i++];imgData[p++]=pixels[i++];alphaChannel[a++]=pixels[i++];}
done=0;zlib.deflate(imgData,function(err,imgData){_this.imgData=imgData;if(err){throw err;}
if(++done===2){return _this.finalize();}});return zlib.deflate(alphaChannel,function(err,alphaChannel){_this.alphaChannel=alphaChannel;if(err){throw err;}
if(++done===2){return _this.finalize();}});};})(this));};PNGImage.prototype.loadIndexedAlphaChannel=function(fn){var transparency;transparency=this.image.transparency.indexed;return this.image.decodePixels((function(_this){return function(pixels){var alphaChannel,i,j,_i,_ref;alphaChannel=new Buffer(_this.width*_this.height);i=0;for(j=_i=0,_ref=pixels.length;_i<_ref;j=_i+=1){alphaChannel[i++]=transparency[pixels[j]];}
return zlib.deflate(alphaChannel,function(err,alphaChannel){_this.alphaChannel=alphaChannel;if(err){throw err;}
return _this.finalize();});};})(this));};return PNGImage;})();module.exports=PNGImage;}).call(this);}.call(exports,__webpack_require__(4).Buffer))},function(module,exports,__webpack_require__){'use strict';var Line=__webpack_require__(24);var pack=__webpack_require__(25).pack;var offsetVector=__webpack_require__(25).offsetVector;var DocumentContext=__webpack_require__(20);function ElementWriter(context,tracker){this.context=context;this.contextStack=[];this.tracker=tracker;}
function addPageItem(page,item,index){if(index===null||index===undefined||index<0||index>page.items.length){page.items.push(item);}else{page.items.splice(index,0,item);}}
ElementWriter.prototype.addLine=function(line,dontUpdateContextPosition,index){var height=line.getHeight();var context=this.context;var page=context.getCurrentPage(),position=this.getCurrentPositionOnPage();if(context.availableHeight<height||!page){return false;}
line.x=context.x+(line.x||0);line.y=context.y+(line.y||0);this.alignLine(line);addPageItem(page,{type:'line',item:line},index);this.tracker.emit('lineAdded',line);if(!dontUpdateContextPosition)context.moveDown(height);return position;};ElementWriter.prototype.alignLine=function(line){var width=this.context.availableWidth;var lineWidth=line.getWidth();var alignment=line.inlines&&line.inlines.length>0&&line.inlines[0].alignment;var offset=0;switch(alignment){case'right':offset=width-lineWidth;break;case'center':offset=(width-lineWidth)/2;break;}
if(offset){line.x=(line.x||0)+offset;}
if(alignment==='justify'&&!line.newLineForced&&!line.lastLineInParagraph&&line.inlines.length>1){var additionalSpacing=(width-lineWidth)/(line.inlines.length-1);for(var i=1,l=line.inlines.length;i<l;i++){offset=i*additionalSpacing;line.inlines[i].x+=offset;}}};ElementWriter.prototype.addImage=function(image,index){var context=this.context;var page=context.getCurrentPage(),position=this.getCurrentPositionOnPage();if(context.availableHeight<image._height||!page){return false;}
image.x=context.x+(image.x||0);image.y=context.y;this.alignImage(image);addPageItem(page,{type:'image',item:image},index);context.moveDown(image._height);return position;};ElementWriter.prototype.addQr=function(qr,index){var context=this.context;var page=context.getCurrentPage(),position=this.getCurrentPositionOnPage();if(context.availableHeight<qr._height||!page){return false;}
qr.x=context.x+(qr.x||0);qr.y=context.y;this.alignImage(qr);for(var i=0,l=qr._canvas.length;i<l;i++){var vector=qr._canvas[i];vector.x+=qr.x;vector.y+=qr.y;this.addVector(vector,true,true,index);}
context.moveDown(qr._height);return position;};ElementWriter.prototype.alignImage=function(image){var width=this.context.availableWidth;var imageWidth=image._minWidth;var offset=0;switch(image._alignment){case'right':offset=width-imageWidth;break;case'center':offset=(width-imageWidth)/2;break;}
if(offset){image.x=(image.x||0)+offset;}};ElementWriter.prototype.addVector=function(vector,ignoreContextX,ignoreContextY,index){var context=this.context;var page=context.getCurrentPage(),position=this.getCurrentPositionOnPage();if(page){offsetVector(vector,ignoreContextX?0:context.x,ignoreContextY?0:context.y);addPageItem(page,{type:'vector',item:vector},index);return position;}};function cloneLine(line){var result=new Line(line.maxWidth);for(var key in line){if(line.hasOwnProperty(key)){result[key]=line[key];}}
return result;}
ElementWriter.prototype.addFragment=function(block,useBlockXOffset,useBlockYOffset,dontUpdateContextPosition){var ctx=this.context;var page=ctx.getCurrentPage();if(!useBlockXOffset&&block.height>ctx.availableHeight)return false;block.items.forEach(function(item){switch(item.type){case'line':var l=cloneLine(item.item);l.x=(l.x||0)+(useBlockXOffset?(block.xOffset||0):ctx.x);l.y=(l.y||0)+(useBlockYOffset?(block.yOffset||0):ctx.y);page.items.push({type:'line',item:l});break;case'vector':var v=pack(item.item);offsetVector(v,useBlockXOffset?(block.xOffset||0):ctx.x,useBlockYOffset?(block.yOffset||0):ctx.y);page.items.push({type:'vector',item:v});break;case'image':var img=pack(item.item);img.x=(img.x||0)+(useBlockXOffset?(block.xOffset||0):ctx.x);img.y=(img.y||0)+(useBlockYOffset?(block.yOffset||0):ctx.y);page.items.push({type:'image',item:img});break;}});if(!dontUpdateContextPosition)ctx.moveDown(block.height);return true;};ElementWriter.prototype.pushContext=function(contextOrWidth,height){if(contextOrWidth===undefined){height=this.context.getCurrentPage().height-this.context.pageMargins.top-this.context.pageMargins.bottom;contextOrWidth=this.context.availableWidth;}
if(typeof contextOrWidth==='number'||contextOrWidth instanceof Number){contextOrWidth=new DocumentContext({width:contextOrWidth,height:height},{left:0,right:0,top:0,bottom:0});}
this.contextStack.push(this.context);this.context=contextOrWidth;};ElementWriter.prototype.popContext=function(){this.context=this.contextStack.pop();};ElementWriter.prototype.getCurrentPositionOnPage=function(){return(this.contextStack[0]||this.context).getCurrentPosition();};module.exports=ElementWriter;},function(module,exports,__webpack_require__){(function(){var PDFPage;PDFPage=(function(){var DEFAULT_MARGINS,SIZES;function PDFPage(document,options){var dimensions;this.document=document;if(options==null){options={};}
this.size=options.size||'letter';this.layout=options.layout||'portrait';if(typeof options.margin==='number'){this.margins={top:options.margin,left:options.margin,bottom:options.margin,right:options.margin};}else{this.margins=options.margins||DEFAULT_MARGINS;}
dimensions=Array.isArray(this.size)?this.size:SIZES[this.size.toUpperCase()];this.width=dimensions[this.layout==='portrait'?0:1];this.height=dimensions[this.layout==='portrait'?1:0];this.content=this.document.ref();this.resources=this.document.ref({ProcSet:['PDF','Text','ImageB','ImageC','ImageI']});Object.defineProperties(this,{fonts:{get:(function(_this){return function(){var _base;return(_base=_this.resources.data).Font!=null?_base.Font:_base.Font={};};})(this)},xobjects:{get:(function(_this){return function(){var _base;return(_base=_this.resources.data).XObject!=null?_base.XObject:_base.XObject={};};})(this)},ext_gstates:{get:(function(_this){return function(){var _base;return(_base=_this.resources.data).ExtGState!=null?_base.ExtGState:_base.ExtGState={};};})(this)},patterns:{get:(function(_this){return function(){var _base;return(_base=_this.resources.data).Pattern!=null?_base.Pattern:_base.Pattern={};};})(this)},annotations:{get:(function(_this){return function(){var _base;return(_base=_this.dictionary.data).Annots!=null?_base.Annots:_base.Annots=[];};})(this)}});this.dictionary=this.document.ref({Type:'Page',Parent:this.document._root.data.Pages,MediaBox:[0,0,this.width,this.height],Contents:this.content,Resources:this.resources});}
PDFPage.prototype.maxY=function(){return this.height-this.margins.bottom;};PDFPage.prototype.write=function(chunk){return this.content.write(chunk);};PDFPage.prototype.end=function(){this.dictionary.end();this.resources.end();return this.content.end();};DEFAULT_MARGINS={top:72,left:72,bottom:72,right:72};SIZES={'4A0':[4767.87,6740.79],'2A0':[3370.39,4767.87],A0:[2383.94,3370.39],A1:[1683.78,2383.94],A2:[1190.55,1683.78],A3:[841.89,1190.55],A4:[595.28,841.89],A5:[419.53,595.28],A6:[297.64,419.53],A7:[209.76,297.64],A8:[147.40,209.76],A9:[104.88,147.40],A10:[73.70,104.88],B0:[2834.65,4008.19],B1:[2004.09,2834.65],B2:[1417.32,2004.09],B3:[1000.63,1417.32],B4:[708.66,1000.63],B5:[498.90,708.66],B6:[354.33,498.90],B7:[249.45,354.33],B8:[175.75,249.45],B9:[124.72,175.75],B10:[87.87,124.72],C0:[2599.37,3676.54],C1:[1836.85,2599.37],C2:[1298.27,1836.85],C3:[918.43,1298.27],C4:[649.13,918.43],C5:[459.21,649.13],C6:[323.15,459.21],C7:[229.61,323.15],C8:[161.57,229.61],C9:[113.39,161.57],C10:[79.37,113.39],RA0:[2437.80,3458.27],RA1:[1729.13,2437.80],RA2:[1218.90,1729.13],RA3:[864.57,1218.90],RA4:[609.45,864.57],SRA0:[2551.18,3628.35],SRA1:[1814.17,2551.18],SRA2:[1275.59,1814.17],SRA3:[907.09,1275.59],SRA4:[637.80,907.09],EXECUTIVE:[521.86,756.00],FOLIO:[612.00,936.00],LEGAL:[612.00,1008.00],LETTER:[612.00,792.00],TABLOID:[792.00,1224.00]};return PDFPage;})();module.exports=PDFPage;}).call(this);},function(module,exports,__webpack_require__){(function(){var KAPPA,SVGPath,__slice=[].slice;SVGPath=__webpack_require__(47);KAPPA=4.0*((Math.sqrt(2)-1.0)/3.0);module.exports={initVector:function(){this._ctm=[1,0,0,1,0,0];return this._ctmStack=[];},save:function(){this._ctmStack.push(this._ctm.slice());return this.addContent('q');},restore:function(){this._ctm=this._ctmStack.pop()||[1,0,0,1,0,0];return this.addContent('Q');},closePath:function(){return this.addContent('h');},lineWidth:function(w){return this.addContent(""+w+" w");},_CAP_STYLES:{BUTT:0,ROUND:1,SQUARE:2},lineCap:function(c){if(typeof c==='string'){c=this._CAP_STYLES[c.toUpperCase()];}
return this.addContent(""+c+" J");},_JOIN_STYLES:{MITER:0,ROUND:1,BEVEL:2},lineJoin:function(j){if(typeof j==='string'){j=this._JOIN_STYLES[j.toUpperCase()];}
return this.addContent(""+j+" j");},miterLimit:function(m){return this.addContent(""+m+" M");},dash:function(length,options){var phase,space,_ref;if(options==null){options={};}
if(length==null){return this;}
space=(_ref=options.space)!=null?_ref:length;phase=options.phase||0;return this.addContent("["+length+" "+space+"] "+phase+" d");},undash:function(){return this.addContent("[] 0 d");},moveTo:function(x,y){return this.addContent(""+x+" "+y+" m");},lineTo:function(x,y){return this.addContent(""+x+" "+y+" l");},bezierCurveTo:function(cp1x,cp1y,cp2x,cp2y,x,y){return this.addContent(""+cp1x+" "+cp1y+" "+cp2x+" "+cp2y+" "+x+" "+y+" c");},quadraticCurveTo:function(cpx,cpy,x,y){return this.addContent(""+cpx+" "+cpy+" "+x+" "+y+" v");},rect:function(x,y,w,h){return this.addContent(""+x+" "+y+" "+w+" "+h+" re");},roundedRect:function(x,y,w,h,r){if(r==null){r=0;}
this.moveTo(x+r,y);this.lineTo(x+w-r,y);this.quadraticCurveTo(x+w,y,x+w,y+r);this.lineTo(x+w,y+h-r);this.quadraticCurveTo(x+w,y+h,x+w-r,y+h);this.lineTo(x+r,y+h);this.quadraticCurveTo(x,y+h,x,y+h-r);this.lineTo(x,y+r);return this.quadraticCurveTo(x,y,x+r,y);},ellipse:function(x,y,r1,r2){var ox,oy,xe,xm,ye,ym;if(r2==null){r2=r1;}
x-=r1;y-=r2;ox=r1*KAPPA;oy=r2*KAPPA;xe=x+r1*2;ye=y+r2*2;xm=x+r1;ym=y+r2;this.moveTo(x,ym);this.bezierCurveTo(x,ym-oy,xm-ox,y,xm,y);this.bezierCurveTo(xm+ox,y,xe,ym-oy,xe,ym);this.bezierCurveTo(xe,ym+oy,xm+ox,ye,xm,ye);this.bezierCurveTo(xm-ox,ye,x,ym+oy,x,ym);return this.closePath();},circle:function(x,y,radius){return this.ellipse(x,y,radius);},polygon:function(){var point,points,_i,_len;points=1<=arguments.length?__slice.call(arguments,0):[];this.moveTo.apply(this,points.shift());for(_i=0,_len=points.length;_i<_len;_i++){point=points[_i];this.lineTo.apply(this,point);}
return this.closePath();},path:function(path){SVGPath.apply(this,path);return this;},_windingRule:function(rule){if(/even-?odd/.test(rule)){return'*';}
return'';},fill:function(color,rule){if(/(even-?odd)|(non-?zero)/.test(color)){rule=color;color=null;}
if(color){this.fillColor(color);}
return this.addContent('f'+this._windingRule(rule));},stroke:function(color){if(color){this.strokeColor(color);}
return this.addContent('S');},fillAndStroke:function(fillColor,strokeColor,rule){var isFillRule;if(strokeColor==null){strokeColor=fillColor;}
isFillRule=/(even-?odd)|(non-?zero)/;if(isFillRule.test(fillColor)){rule=fillColor;fillColor=null;}
if(isFillRule.test(strokeColor)){rule=strokeColor;strokeColor=fillColor;}
if(fillColor){this.fillColor(fillColor);this.strokeColor(strokeColor);}
return this.addContent('B'+this._windingRule(rule));},clip:function(rule){return this.addContent('W'+this._windingRule(rule)+' n');},transform:function(m11,m12,m21,m22,dx,dy){var m,m0,m1,m2,m3,m4,m5,v,values;m=this._ctm;m0=m[0],m1=m[1],m2=m[2],m3=m[3],m4=m[4],m5=m[5];m[0]=m0*m11+m2*m12;m[1]=m1*m11+m3*m12;m[2]=m0*m21+m2*m22;m[3]=m1*m21+m3*m22;m[4]=m0*dx+m2*dy+m4;m[5]=m1*dx+m3*dy+m5;values=((function(){var _i,_len,_ref,_results;_ref=[m11,m12,m21,m22,dx,dy];_results=[];for(_i=0,_len=_ref.length;_i<_len;_i++){v=_ref[_i];_results.push(+v.toFixed(5));}
return _results;})()).join(' ');return this.addContent(""+values+" cm");},translate:function(x,y){return this.transform(1,0,0,1,x,y);},rotate:function(angle,options){var cos,rad,sin,x,x1,y,y1,_ref;if(options==null){options={};}
rad=angle*Math.PI/180;cos=Math.cos(rad);sin=Math.sin(rad);x=y=0;if(options.origin!=null){_ref=options.origin,x=_ref[0],y=_ref[1];x1=x*cos-y*sin;y1=x*sin+y*cos;x-=x1;y-=y1;}
return this.transform(cos,sin,-sin,cos,x,y);},scale:function(xFactor,yFactor,options){var x,y,_ref;if(yFactor==null){yFactor=xFactor;}
if(options==null){options={};}
if(arguments.length===2){yFactor=xFactor;options=yFactor;}
x=y=0;if(options.origin!=null){_ref=options.origin,x=_ref[0],y=_ref[1];x-=xFactor*x;y-=yFactor*y;}
return this.transform(xFactor,0,0,yFactor,x,y);}};}).call(this);},function(module,exports,__webpack_require__){(function(){var LineWrapper;LineWrapper=__webpack_require__(48);module.exports={initText:function(){this.x=0;this.y=0;return this._lineGap=0;},lineGap:function(_lineGap){this._lineGap=_lineGap;return this;},moveDown:function(lines){if(lines==null){lines=1;}
this.y+=this.currentLineHeight(true)*lines+this._lineGap;return this;},moveUp:function(lines){if(lines==null){lines=1;}
this.y-=this.currentLineHeight(true)*lines+this._lineGap;return this;},_text:function(text,x,y,options,lineCallback){var line,wrapper,_i,_len,_ref;options=this._initOptions(x,y,options);text=''+text;if(options.wordSpacing){text=text.replace(/\s{2,}/g,' ');}
if(options.width){wrapper=this._wrapper;if(!wrapper){wrapper=new LineWrapper(this,options);wrapper.on('line',lineCallback);}
this._wrapper=options.continued?wrapper:null;this._textOptions=options.continued?options:null;wrapper.wrap(text,options);}else{_ref=text.split('\n');for(_i=0,_len=_ref.length;_i<_len;_i++){line=_ref[_i];lineCallback(line,options);}}
return this;},text:function(text,x,y,options){return this._text(text,x,y,options,this._line.bind(this));},widthOfString:function(string,options){if(options==null){options={};}
return this._font.widthOfString(string,this._fontSize)+(options.characterSpacing||0)*(string.length-1);},heightOfString:function(text,options){var height,lineGap,x,y;if(options==null){options={};}
x=this.x,y=this.y;options=this._initOptions(options);options.height=Infinity;lineGap=options.lineGap||this._lineGap||0;this._text(text,this.x,this.y,options,(function(_this){return function(line,options){return _this.y+=_this.currentLineHeight(true)+lineGap;};})(this));height=this.y-y;this.x=x;this.y=y;return height;},list:function(list,x,y,options,wrapper){var flatten,i,indent,itemIndent,items,level,levels,r;options=this._initOptions(x,y,options);r=Math.round((this._font.ascender/1000*this._fontSize)/3);indent=options.textIndent||r*5;itemIndent=options.bulletIndent||r*8;level=1;items=[];levels=[];flatten=function(list){var i,item,_i,_len,_results;_results=[];for(i=_i=0,_len=list.length;_i<_len;i=++_i){item=list[i];if(Array.isArray(item)){level++;flatten(item);_results.push(level--);}else{items.push(item);_results.push(levels.push(level));}}
return _results;};flatten(list);wrapper=new LineWrapper(this,options);wrapper.on('line',this._line.bind(this));level=1;i=0;wrapper.on('firstLine',(function(_this){return function(){var diff,l;if((l=levels[i++])!==level){diff=itemIndent*(l-level);_this.x+=diff;wrapper.lineWidth-=diff;level=l;}
_this.circle(_this.x-indent+r,_this.y+r+(r/2),r);return _this.fill();};})(this));wrapper.on('sectionStart',(function(_this){return function(){var pos;pos=indent+itemIndent*(level-1);_this.x+=pos;return wrapper.lineWidth-=pos;};})(this));wrapper.on('sectionEnd',(function(_this){return function(){var pos;pos=indent+itemIndent*(level-1);_this.x-=pos;return wrapper.lineWidth+=pos;};})(this));wrapper.wrap(items.join('\n'),options);return this;},_initOptions:function(x,y,options){var key,margins,val,_ref;if(x==null){x={};}
if(options==null){options={};}
if(typeof x==='object'){options=x;x=null;}
options=(function(){var k,opts,v;opts={};for(k in options){v=options[k];opts[k]=v;}
return opts;})();if(this._textOptions){_ref=this._textOptions;for(key in _ref){val=_ref[key];if(key!=='continued'){if(options[key]==null){options[key]=val;}}}}
if(x!=null){this.x=x;}
if(y!=null){this.y=y;}
if(options.lineBreak!==false){margins=this.page.margins;if(options.width==null){options.width=this.page.width-this.x-margins.right;}}
options.columns||(options.columns=0);if(options.columnGap==null){options.columnGap=18;}
return options;},_line:function(text,options,wrapper){var lineGap;if(options==null){options={};}
this._fragment(text,this.x,this.y,options);lineGap=options.lineGap||this._lineGap||0;if(!wrapper){return this.x+=this.widthOfString(text);}else{return this.y+=this.currentLineHeight(true)+lineGap;}},_fragment:function(text,x,y,options){var align,characterSpacing,commands,d,encoded,i,lineWidth,lineY,mode,renderedWidth,spaceWidth,textWidth,word,wordSpacing,words,_base,_i,_len,_name;text=''+text;if(text.length===0){return;}
align=options.align||'left';wordSpacing=options.wordSpacing||0;characterSpacing=options.characterSpacing||0;if(options.width){switch(align){case'right':textWidth=this.widthOfString(text.replace(/\s+$/,''),options);x+=options.lineWidth-textWidth;break;case'center':x+=options.lineWidth/2-options.textWidth/2;break;case'justify':words=text.trim().split(/\s+/);textWidth=this.widthOfString(text.replace(/\s+/g,''),options);spaceWidth=this.widthOfString(' ')+characterSpacing;wordSpacing=Math.max(0,(options.lineWidth-textWidth)/Math.max(1,words.length-1)-spaceWidth);}}
renderedWidth=options.textWidth+(wordSpacing*(options.wordCount-1))+(characterSpacing*(text.length-1));if(options.link){this.link(x,y,renderedWidth,this.currentLineHeight(),options.link);}
if(options.underline||options.strike){this.save();if(!options.stroke){this.strokeColor.apply(this,this._fillColor);}
lineWidth=this._fontSize<10?0.5:Math.floor(this._fontSize/10);this.lineWidth(lineWidth);d=options.underline?1:2;lineY=y+this.currentLineHeight()/d;if(options.underline){lineY-=lineWidth;}
this.moveTo(x,lineY);this.lineTo(x+renderedWidth,lineY);this.stroke();this.restore();}
this.save();this.transform(1,0,0,-1,0,this.page.height);y=this.page.height-y-(this._font.ascender/1000*this._fontSize);if((_base=this.page.fonts)[_name=this._font.id]==null){_base[_name]=this._font.ref();}
this._font.use(text);this.addContent("BT");this.addContent(""+x+" "+y+" Td");this.addContent("/"+this._font.id+" "+this._fontSize+" Tf");mode=options.fill&&options.stroke?2:options.stroke?1:0;if(mode){this.addContent(""+mode+" Tr");}
if(characterSpacing){this.addContent(""+characterSpacing+" Tc");}
if(wordSpacing){words=text.trim().split(/\s+/);wordSpacing+=this.widthOfString(' ')+characterSpacing;wordSpacing*=1000/this._fontSize;commands=[];for(_i=0,_len=words.length;_i<_len;_i++){word=words[_i];encoded=this._font.encode(word);encoded=((function(){var _j,_ref,_results;_results=[];for(i=_j=0,_ref=encoded.length;_j<_ref;i=_j+=1){_results.push(encoded.charCodeAt(i).toString(16));}
return _results;})()).join('');commands.push("<"+encoded+"> "+(-wordSpacing));}
this.addContent("["+(commands.join(' '))+"] TJ");}else{encoded=this._font.encode(text);encoded=((function(){var _j,_ref,_results;_results=[];for(i=_j=0,_ref=encoded.length;_j<_ref;i=_j+=1){_results.push(encoded.charCodeAt(i).toString(16));}
return _results;})()).join('');this.addContent("<"+encoded+"> Tj");}
this.addContent("ET");return this.restore();}};}).call(this);},function(module,exports,__webpack_require__){(function(){var PDFGradient,PDFLinearGradient,PDFRadialGradient,namedColors,_ref;_ref=__webpack_require__(49),PDFGradient=_ref.PDFGradient,PDFLinearGradient=_ref.PDFLinearGradient,PDFRadialGradient=_ref.PDFRadialGradient;module.exports={initColor:function(){this._opacityRegistry={};this._opacityCount=0;return this._gradCount=0;},_normalizeColor:function(color){var hex,part;if(color instanceof PDFGradient){return color;}
if(typeof color==='string'){if(color.charAt(0)==='#'){if(color.length===4){color=color.replace(/#([0-9A-F])([0-9A-F])([0-9A-F])/i,"#$1$1$2$2$3$3");}
hex=parseInt(color.slice(1),16);color=[hex>>16,hex>>8&0xff,hex&0xff];}else if(namedColors[color]){color=namedColors[color];}}
if(Array.isArray(color)){if(color.length===3){color=(function(){var _i,_len,_results;_results=[];for(_i=0,_len=color.length;_i<_len;_i++){part=color[_i];_results.push(part/255);}
return _results;})();}else if(color.length===4){color=(function(){var _i,_len,_results;_results=[];for(_i=0,_len=color.length;_i<_len;_i++){part=color[_i];_results.push(part/100);}
return _results;})();}
return color;}
return null;},_setColor:function(color,stroke){var gstate,name,op,space;color=this._normalizeColor(color);if(!color){return false;}
if(this._sMasked){gstate=this.ref({Type:'ExtGState',SMask:'None'});gstate.end();name="Gs"+(++this._opacityCount);this.page.ext_gstates[name]=gstate;this.addContent("/"+name+" gs");this._sMasked=false;}
op=stroke?'SCN':'scn';if(color instanceof PDFGradient){this._setColorSpace('Pattern',stroke);color.apply(op);}else{space=color.length===4?'DeviceCMYK':'DeviceRGB';this._setColorSpace(space,stroke);color=color.join(' ');this.addContent(""+color+" "+op);}
return true;},_setColorSpace:function(space,stroke){var op;op=stroke?'CS':'cs';return this.addContent("/"+space+" "+op);},fillColor:function(color,opacity){var set;if(opacity==null){opacity=1;}
set=this._setColor(color,false);if(set){this.fillOpacity(opacity);}
this._fillColor=[color,opacity];return this;},strokeColor:function(color,opacity){var set;if(opacity==null){opacity=1;}
set=this._setColor(color,true);if(set){this.strokeOpacity(opacity);}
return this;},opacity:function(opacity){this._doOpacity(opacity,opacity);return this;},fillOpacity:function(opacity){this._doOpacity(opacity,null);return this;},strokeOpacity:function(opacity){this._doOpacity(null,opacity);return this;},_doOpacity:function(fillOpacity,strokeOpacity){var dictionary,id,key,name,_ref1;if(!((fillOpacity!=null)||(strokeOpacity!=null))){return;}
if(fillOpacity!=null){fillOpacity=Math.max(0,Math.min(1,fillOpacity));}
if(strokeOpacity!=null){strokeOpacity=Math.max(0,Math.min(1,strokeOpacity));}
key=""+fillOpacity+"_"+strokeOpacity;if(this._opacityRegistry[key]){_ref1=this._opacityRegistry[key],dictionary=_ref1[0],name=_ref1[1];}else{dictionary={Type:'ExtGState'};if(fillOpacity!=null){dictionary.ca=fillOpacity;}
if(strokeOpacity!=null){dictionary.CA=strokeOpacity;}
dictionary=this.ref(dictionary);dictionary.end();id=++this._opacityCount;name="Gs"+id;this._opacityRegistry[key]=[dictionary,name];}
this.page.ext_gstates[name]=dictionary;return this.addContent("/"+name+" gs");},linearGradient:function(x1,y1,x2,y2){return new PDFLinearGradient(this,x1,y1,x2,y2);},radialGradient:function(x1,y1,r1,x2,y2,r2){return new PDFRadialGradient(this,x1,y1,r1,x2,y2,r2);}};namedColors={aliceblue:[240,248,255],antiquewhite:[250,235,215],aqua:[0,255,255],aquamarine:[127,255,212],azure:[240,255,255],beige:[245,245,220],bisque:[255,228,196],black:[0,0,0],blanchedalmond:[255,235,205],blue:[0,0,255],blueviolet:[138,43,226],brown:[165,42,42],burlywood:[222,184,135],cadetblue:[95,158,160],chartreuse:[127,255,0],chocolate:[210,105,30],coral:[255,127,80],cornflowerblue:[100,149,237],cornsilk:[255,248,220],crimson:[220,20,60],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgoldenrod:[184,134,11],darkgray:[169,169,169],darkgreen:[0,100,0],darkgrey:[169,169,169],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkseagreen:[143,188,143],darkslateblue:[72,61,139],darkslategray:[47,79,79],darkslategrey:[47,79,79],darkturquoise:[0,206,209],darkviolet:[148,0,211],deeppink:[255,20,147],deepskyblue:[0,191,255],dimgray:[105,105,105],dimgrey:[105,105,105],dodgerblue:[30,144,255],firebrick:[178,34,34],floralwhite:[255,250,240],forestgreen:[34,139,34],fuchsia:[255,0,255],gainsboro:[220,220,220],ghostwhite:[248,248,255],gold:[255,215,0],goldenrod:[218,165,32],gray:[128,128,128],grey:[128,128,128],green:[0,128,0],greenyellow:[173,255,47],honeydew:[240,255,240],hotpink:[255,105,180],indianred:[205,92,92],indigo:[75,0,130],ivory:[255,255,240],khaki:[240,230,140],lavender:[230,230,250],lavenderblush:[255,240,245],lawngreen:[124,252,0],lemonchiffon:[255,250,205],lightblue:[173,216,230],lightcoral:[240,128,128],lightcyan:[224,255,255],lightgoldenrodyellow:[250,250,210],lightgray:[211,211,211],lightgreen:[144,238,144],lightgrey:[211,211,211],lightpink:[255,182,193],lightsalmon:[255,160,122],lightseagreen:[32,178,170],lightskyblue:[135,206,250],lightslategray:[119,136,153],lightslategrey:[119,136,153],lightsteelblue:[176,196,222],lightyellow:[255,255,224],lime:[0,255,0],limegreen:[50,205,50],linen:[250,240,230],magenta:[255,0,255],maroon:[128,0,0],mediumaquamarine:[102,205,170],mediumblue:[0,0,205],mediumorchid:[186,85,211],mediumpurple:[147,112,219],mediumseagreen:[60,179,113],mediumslateblue:[123,104,238],mediumspringgreen:[0,250,154],mediumturquoise:[72,209,204],mediumvioletred:[199,21,133],midnightblue:[25,25,112],mintcream:[245,255,250],mistyrose:[255,228,225],moccasin:[255,228,181],navajowhite:[255,222,173],navy:[0,0,128],oldlace:[253,245,230],olive:[128,128,0],olivedrab:[107,142,35],orange:[255,165,0],orangered:[255,69,0],orchid:[218,112,214],palegoldenrod:[238,232,170],palegreen:[152,251,152],paleturquoise:[175,238,238],palevioletred:[219,112,147],papayawhip:[255,239,213],peachpuff:[255,218,185],peru:[205,133,63],pink:[255,192,203],plum:[221,160,221],powderblue:[176,224,230],purple:[128,0,128],red:[255,0,0],rosybrown:[188,143,143],royalblue:[65,105,225],saddlebrown:[139,69,19],salmon:[250,128,114],sandybrown:[244,164,96],seagreen:[46,139,87],seashell:[255,245,238],sienna:[160,82,45],silver:[192,192,192],skyblue:[135,206,235],slateblue:[106,90,205],slategray:[112,128,144],slategrey:[112,128,144],snow:[255,250,250],springgreen:[0,255,127],steelblue:[70,130,180],tan:[210,180,140],teal:[0,128,128],thistle:[216,191,216],tomato:[255,99,71],turquoise:[64,224,208],violet:[238,130,238],wheat:[245,222,179],white:[255,255,255],whitesmoke:[245,245,245],yellow:[255,255,0],yellowgreen:[154,205,50]};}).call(this);},function(module,exports,__webpack_require__){(function(Buffer){(function(){var PDFImage;PDFImage=__webpack_require__(17);module.exports={initImages:function(){this._imageRegistry={};return this._imageCount=0;},image:function(src,x,y,options){var bh,bp,bw,h,hp,image,ip,w,wp,_base,_name,_ref,_ref1,_ref2;if(options==null){options={};}
if(typeof x==='object'){options=x;x=null;}
x=(_ref=x!=null?x:options.x)!=null?_ref:this.x;y=(_ref1=y!=null?y:options.y)!=null?_ref1:this.y;if(!Buffer.isBuffer(src)){image=this._imageRegistry[src];}
if(!image){image=PDFImage.open(src,'I'+(++this._imageCount));image.embed(this);if(!Buffer.isBuffer(src)){this._imageRegistry[src]=image;}}
if((_base=this.page.xobjects)[_name=image.label]==null){_base[_name]=image.obj;}
w=options.width||image.width;h=options.height||image.height;if(options.width&&!options.height){wp=w/image.width;w=image.width*wp;h=image.height*wp;}else if(options.height&&!options.width){hp=h/image.height;w=image.width*hp;h=image.height*hp;}else if(options.scale){w=image.width*options.scale;h=image.height*options.scale;}else if(options.fit){_ref2=options.fit,bw=_ref2[0],bh=_ref2[1];bp=bw/bh;ip=image.width/image.height;if(ip>bp){w=bw;h=bw/ip;}else{h=bh;w=bh*ip;}
if(options.align==='center'){x=x+bw/2-w/2;}else if(options.align==='right'){x=x+bw-w;}
if(options.valign==='center'){y=y+bh/2-h/2;}else if(options.valign==='bottom'){y=y+bh-h;}}
if(this.y===y){this.y+=h;}
this.save();this.transform(w,0,0,-h,x,y+h);this.addContent("/"+image.label+" Do");this.restore();return this;}};}).call(this);}.call(exports,__webpack_require__(4).Buffer))},function(module,exports,__webpack_require__){(function(){module.exports={annotate:function(x,y,w,h,options){var key,ref,val;options.Type='Annot';options.Rect=this._convertRect(x,y,w,h);options.Border=[0,0,0];if(options.Subtype!=='Link'){if(options.C==null){options.C=this._normalizeColor(options.color||[0,0,0]);}}
delete options.color;if(typeof options.Dest==='string'){options.Dest=new String(options.Dest);}
for(key in options){val=options[key];options[key[0].toUpperCase()+key.slice(1)]=val;}
ref=this.ref(options);this.page.annotations.push(ref);ref.end();return this;},note:function(x,y,w,h,contents,options){if(options==null){options={};}
options.Subtype='Text';options.Contents=new String(contents);options.Name='Comment';if(options.color==null){options.color=[243,223,92];}
return this.annotate(x,y,w,h,options);},link:function(x,y,w,h,url,options){if(options==null){options={};}
options.Subtype='Link';options.A=this.ref({S:'URI',URI:new String(url)});options.A.end();return this.annotate(x,y,w,h,options);},_markup:function(x,y,w,h,options){var x1,x2,y1,y2,_ref;if(options==null){options={};}
_ref=this._convertRect(x,y,w,h),x1=_ref[0],y1=_ref[1],x2=_ref[2],y2=_ref[3];options.QuadPoints=[x1,y2,x2,y2,x1,y1,x2,y1];options.Contents=new String;return this.annotate(x,y,w,h,options);},highlight:function(x,y,w,h,options){if(options==null){options={};}
options.Subtype='Highlight';if(options.color==null){options.color=[241,238,148];}
return this._markup(x,y,w,h,options);},underline:function(x,y,w,h,options){if(options==null){options={};}
options.Subtype='Underline';return this._markup(x,y,w,h,options);},strike:function(x,y,w,h,options){if(options==null){options={};}
options.Subtype='StrikeOut';return this._markup(x,y,w,h,options);},lineAnnotation:function(x1,y1,x2,y2,options){if(options==null){options={};}
options.Subtype='Line';options.Contents=new String;options.L=[x1,this.page.height-y1,x2,this.page.height-y2];return this.annotate(x1,y1,x2,y2,options);},rectAnnotation:function(x,y,w,h,options){if(options==null){options={};}
options.Subtype='Square';options.Contents=new String;return this.annotate(x,y,w,h,options);},ellipseAnnotation:function(x,y,w,h,options){if(options==null){options={};}
options.Subtype='Circle';options.Contents=new String;return this.annotate(x,y,w,h,options);},textAnnotation:function(x,y,w,h,text,options){if(options==null){options={};}
options.Subtype='FreeText';options.Contents=new String(text);options.DA=new String;return this.annotate(x,y,w,h,options);},_convertRect:function(x1,y1,w,h){var m0,m1,m2,m3,m4,m5,x2,y2,_ref;y2=y1;y1+=h;x2=x1+w;_ref=this._ctm,m0=_ref[0],m1=_ref[1],m2=_ref[2],m3=_ref[3],m4=_ref[4],m5=_ref[5];x1=m0*x1+m2*y1+m4;y1=m1*x1+m3*y1+m5;x2=m0*x2+m2*y2+m4;y2=m1*x2+m3*y2+m5;return[x1,y1,x2,y2];}};}).call(this);},function(module,exports,__webpack_require__){(function(){var PDFFont;PDFFont=__webpack_require__(52);module.exports={initFonts:function(){this._fontFamilies={};this._fontCount=0;this._fontSize=12;this._font=null;this._registeredFonts={};},font:function(src,family,size){var cacheKey,font,id,_ref;if(typeof family==='number'){size=family;family=null;}
if(typeof src==='string'&&this._registeredFonts[src]){cacheKey=src;_ref=this._registeredFonts[src],src=_ref.src,family=_ref.family;}else{cacheKey=family||src;if(typeof cacheKey!=='string'){cacheKey=null;}}
if(size!=null){this.fontSize(size);}
if(font=this._fontFamilies[cacheKey]){this._font=font;return this;}
id='F'+(++this._fontCount);this._font=new PDFFont(this,src,family,id);if(font=this._fontFamilies[this._font.name]){this._font=font;return this;}
if(cacheKey){this._fontFamilies[cacheKey]=this._font;}
this._fontFamilies[this._font.name]=this._font;return this;},fontSize:function(_fontSize){this._fontSize=_fontSize;return this;},currentLineHeight:function(includeGap){if(includeGap==null){includeGap=false;}
return this._font.lineHeight(this._fontSize,includeGap);},registerFont:function(name,src,family){this._registeredFonts[name]={src:src,family:family};return this;}};}).call(this);},function(module,exports,__webpack_require__){(function(Buffer,process){var Transform=__webpack_require__(55);var binding=__webpack_require__(50);var util=__webpack_require__(60);var assert=__webpack_require__(53).ok;binding.Z_MIN_WINDOWBITS=8;binding.Z_MAX_WINDOWBITS=15;binding.Z_DEFAULT_WINDOWBITS=15;binding.Z_MIN_CHUNK=64;binding.Z_MAX_CHUNK=Infinity;binding.Z_DEFAULT_CHUNK=(16*1024);binding.Z_MIN_MEMLEVEL=1;binding.Z_MAX_MEMLEVEL=9;binding.Z_DEFAULT_MEMLEVEL=8;binding.Z_MIN_LEVEL=-1;binding.Z_MAX_LEVEL=9;binding.Z_DEFAULT_LEVEL=binding.Z_DEFAULT_COMPRESSION;Object.keys(binding).forEach(function(k){if(k.match(/^Z/))exports[k]=binding[k];});exports.codes={Z_OK:binding.Z_OK,Z_STREAM_END:binding.Z_STREAM_END,Z_NEED_DICT:binding.Z_NEED_DICT,Z_ERRNO:binding.Z_ERRNO,Z_STREAM_ERROR:binding.Z_STREAM_ERROR,Z_DATA_ERROR:binding.Z_DATA_ERROR,Z_MEM_ERROR:binding.Z_MEM_ERROR,Z_BUF_ERROR:binding.Z_BUF_ERROR,Z_VERSION_ERROR:binding.Z_VERSION_ERROR};Object.keys(exports.codes).forEach(function(k){exports.codes[exports.codes[k]]=k;});exports.Deflate=Deflate;exports.Inflate=Inflate;exports.Gzip=Gzip;exports.Gunzip=Gunzip;exports.DeflateRaw=DeflateRaw;exports.InflateRaw=InflateRaw;exports.Unzip=Unzip;exports.createDeflate=function(o){return new Deflate(o);};exports.createInflate=function(o){return new Inflate(o);};exports.createDeflateRaw=function(o){return new DeflateRaw(o);};exports.createInflateRaw=function(o){return new InflateRaw(o);};exports.createGzip=function(o){return new Gzip(o);};exports.createGunzip=function(o){return new Gunzip(o);};exports.createUnzip=function(o){return new Unzip(o);};exports.deflate=function(buffer,opts,callback){if(typeof opts==='function'){callback=opts;opts={};}
return zlibBuffer(new Deflate(opts),buffer,callback);};exports.deflateSync=function(buffer,opts){return zlibBufferSync(new Deflate(opts),buffer);};exports.gzip=function(buffer,opts,callback){if(typeof opts==='function'){callback=opts;opts={};}
return zlibBuffer(new Gzip(opts),buffer,callback);};exports.gzipSync=function(buffer,opts){return zlibBufferSync(new Gzip(opts),buffer);};exports.deflateRaw=function(buffer,opts,callback){if(typeof opts==='function'){callback=opts;opts={};}
return zlibBuffer(new DeflateRaw(opts),buffer,callback);};exports.deflateRawSync=function(buffer,opts){return zlibBufferSync(new DeflateRaw(opts),buffer);};exports.unzip=function(buffer,opts,callback){if(typeof opts==='function'){callback=opts;opts={};}
return zlibBuffer(new Unzip(opts),buffer,callback);};exports.unzipSync=function(buffer,opts){return zlibBufferSync(new Unzip(opts),buffer);};exports.inflate=function(buffer,opts,callback){if(typeof opts==='function'){callback=opts;opts={};}
return zlibBuffer(new Inflate(opts),buffer,callback);};exports.inflateSync=function(buffer,opts){return zlibBufferSync(new Inflate(opts),buffer);};exports.gunzip=function(buffer,opts,callback){if(typeof opts==='function'){callback=opts;opts={};}
return zlibBuffer(new Gunzip(opts),buffer,callback);};exports.gunzipSync=function(buffer,opts){return zlibBufferSync(new Gunzip(opts),buffer);};exports.inflateRaw=function(buffer,opts,callback){if(typeof opts==='function'){callback=opts;opts={};}
return zlibBuffer(new InflateRaw(opts),buffer,callback);};exports.inflateRawSync=function(buffer,opts){return zlibBufferSync(new InflateRaw(opts),buffer);};function zlibBuffer(engine,buffer,callback){var buffers=[];var nread=0;engine.on('error',onError);engine.on('end',onEnd);engine.end(buffer);flow();function flow(){var chunk;while(null!==(chunk=engine.read())){buffers.push(chunk);nread+=chunk.length;}
engine.once('readable',flow);}
function onError(err){engine.removeListener('end',onEnd);engine.removeListener('readable',flow);callback(err);}
function onEnd(){var buf=Buffer.concat(buffers,nread);buffers=[];callback(null,buf);engine.close();}}
function zlibBufferSync(engine,buffer){if(typeof buffer==='string')
buffer=new Buffer(buffer);if(!Buffer.isBuffer(buffer))
throw new TypeError('Not a string or buffer');var flushFlag=binding.Z_FINISH;return engine._processChunk(buffer,flushFlag);}
function Deflate(opts){if(!(this instanceof Deflate))return new Deflate(opts);Zlib.call(this,opts,binding.DEFLATE);}
function Inflate(opts){if(!(this instanceof Inflate))return new Inflate(opts);Zlib.call(this,opts,binding.INFLATE);}
function Gzip(opts){if(!(this instanceof Gzip))return new Gzip(opts);Zlib.call(this,opts,binding.GZIP);}
function Gunzip(opts){if(!(this instanceof Gunzip))return new Gunzip(opts);Zlib.call(this,opts,binding.GUNZIP);}
function DeflateRaw(opts){if(!(this instanceof DeflateRaw))return new DeflateRaw(opts);Zlib.call(this,opts,binding.DEFLATERAW);}
function InflateRaw(opts){if(!(this instanceof InflateRaw))return new InflateRaw(opts);Zlib.call(this,opts,binding.INFLATERAW);}
function Unzip(opts){if(!(this instanceof Unzip))return new Unzip(opts);Zlib.call(this,opts,binding.UNZIP);}
function Zlib(opts,mode){this._opts=opts=opts||{};this._chunkSize=opts.chunkSize||exports.Z_DEFAULT_CHUNK;Transform.call(this,opts);if(opts.flush){if(opts.flush!==binding.Z_NO_FLUSH&&opts.flush!==binding.Z_PARTIAL_FLUSH&&opts.flush!==binding.Z_SYNC_FLUSH&&opts.flush!==binding.Z_FULL_FLUSH&&opts.flush!==binding.Z_FINISH&&opts.flush!==binding.Z_BLOCK){throw new Error('Invalid flush flag: '+opts.flush);}}
this._flushFlag=opts.flush||binding.Z_NO_FLUSH;if(opts.chunkSize){if(opts.chunkSize<exports.Z_MIN_CHUNK||opts.chunkSize>exports.Z_MAX_CHUNK){throw new Error('Invalid chunk size: '+opts.chunkSize);}}
if(opts.windowBits){if(opts.windowBits<exports.Z_MIN_WINDOWBITS||opts.windowBits>exports.Z_MAX_WINDOWBITS){throw new Error('Invalid windowBits: '+opts.windowBits);}}
if(opts.level){if(opts.level<exports.Z_MIN_LEVEL||opts.level>exports.Z_MAX_LEVEL){throw new Error('Invalid compression level: '+opts.level);}}
if(opts.memLevel){if(opts.memLevel<exports.Z_MIN_MEMLEVEL||opts.memLevel>exports.Z_MAX_MEMLEVEL){throw new Error('Invalid memLevel: '+opts.memLevel);}}
if(opts.strategy){if(opts.strategy!=exports.Z_FILTERED&&opts.strategy!=exports.Z_HUFFMAN_ONLY&&opts.strategy!=exports.Z_RLE&&opts.strategy!=exports.Z_FIXED&&opts.strategy!=exports.Z_DEFAULT_STRATEGY){throw new Error('Invalid strategy: '+opts.strategy);}}
if(opts.dictionary){if(!Buffer.isBuffer(opts.dictionary)){throw new Error('Invalid dictionary: it should be a Buffer instance');}}
this._binding=new binding.Zlib(mode);var self=this;this._hadError=false;this._binding.onerror=function(message,errno){self._binding=null;self._hadError=true;var error=new Error(message);error.errno=errno;error.code=exports.codes[errno];self.emit('error',error);};var level=exports.Z_DEFAULT_COMPRESSION;if(typeof opts.level==='number')level=opts.level;var strategy=exports.Z_DEFAULT_STRATEGY;if(typeof opts.strategy==='number')strategy=opts.strategy;this._binding.init(opts.windowBits||exports.Z_DEFAULT_WINDOWBITS,level,opts.memLevel||exports.Z_DEFAULT_MEMLEVEL,strategy,opts.dictionary);this._buffer=new Buffer(this._chunkSize);this._offset=0;this._closed=false;this._level=level;this._strategy=strategy;this.once('end',this.close);}
util.inherits(Zlib,Transform);Zlib.prototype.params=function(level,strategy,callback){if(level<exports.Z_MIN_LEVEL||level>exports.Z_MAX_LEVEL){throw new RangeError('Invalid compression level: '+level);}
if(strategy!=exports.Z_FILTERED&&strategy!=exports.Z_HUFFMAN_ONLY&&strategy!=exports.Z_RLE&&strategy!=exports.Z_FIXED&&strategy!=exports.Z_DEFAULT_STRATEGY){throw new TypeError('Invalid strategy: '+strategy);}
if(this._level!==level||this._strategy!==strategy){var self=this;this.flush(binding.Z_SYNC_FLUSH,function(){self._binding.params(level,strategy);if(!self._hadError){self._level=level;self._strategy=strategy;if(callback)callback();}});}else{process.nextTick(callback);}};Zlib.prototype.reset=function(){return this._binding.reset();};Zlib.prototype._flush=function(callback){this._transform(new Buffer(0),'',callback);};Zlib.prototype.flush=function(kind,callback){var ws=this._writableState;if(typeof kind==='function'||(kind===void 0&&!callback)){callback=kind;kind=binding.Z_FULL_FLUSH;}
if(ws.ended){if(callback)
process.nextTick(callback);}else if(ws.ending){if(callback)
this.once('end',callback);}else if(ws.needDrain){var self=this;this.once('drain',function(){self.flush(callback);});}else{this._flushFlag=kind;this.write(new Buffer(0),'',callback);}};Zlib.prototype.close=function(callback){if(callback)
process.nextTick(callback);if(this._closed)
return;this._closed=true;this._binding.close();var self=this;process.nextTick(function(){self.emit('close');});};Zlib.prototype._transform=function(chunk,encoding,cb){var flushFlag;var ws=this._writableState;var ending=ws.ending||ws.ended;var last=ending&&(!chunk||ws.length===chunk.length);if(!chunk===null&&!Buffer.isBuffer(chunk))
return cb(new Error('invalid input'));if(last)
flushFlag=binding.Z_FINISH;else{flushFlag=this._flushFlag;if(chunk.length>=ws.length){this._flushFlag=this._opts.flush||binding.Z_NO_FLUSH;}}
var self=this;this._processChunk(chunk,flushFlag,cb);};Zlib.prototype._processChunk=function(chunk,flushFlag,cb){var availInBefore=chunk&&chunk.length;var availOutBefore=this._chunkSize-this._offset;var inOff=0;var self=this;var async=typeof cb==='function';if(!async){var buffers=[];var nread=0;var error;this.on('error',function(er){error=er;});do{var res=this._binding.writeSync(flushFlag,chunk,inOff,availInBefore,this._buffer,this._offset,availOutBefore);}while(!this._hadError&&callback(res[0],res[1]));if(this._hadError){throw error;}
var buf=Buffer.concat(buffers,nread);this.close();return buf;}
var req=this._binding.write(flushFlag,chunk,inOff,availInBefore,this._buffer,this._offset,availOutBefore);req.buffer=chunk;req.callback=callback;function callback(availInAfter,availOutAfter){if(self._hadError)
return;var have=availOutBefore-availOutAfter;assert(have>=0,'have should not go down');if(have>0){var out=self._buffer.slice(self._offset,self._offset+have);self._offset+=have;if(async){self.push(out);}else{buffers.push(out);nread+=out.length;}}
if(availOutAfter===0||self._offset>=self._chunkSize){availOutBefore=self._chunkSize;self._offset=0;self._buffer=new Buffer(self._chunkSize);}
if(availOutAfter===0){inOff+=(availInBefore-availInAfter);availInBefore=availInAfter;if(!async)
return true;var newReq=self._binding.write(flushFlag,chunk,inOff,availInBefore,self._buffer,self._offset,self._chunkSize);newReq.callback=callback;newReq.buffer=chunk;return;}
if(!async)
return false;cb();}};util.inherits(Deflate,Zlib);util.inherits(Inflate,Zlib);util.inherits(Gzip,Zlib);util.inherits(Gunzip,Zlib);util.inherits(DeflateRaw,Zlib);util.inherits(InflateRaw,Zlib);util.inherits(Unzip,Zlib);}.call(exports,__webpack_require__(4).Buffer,__webpack_require__(61)))},function(module,exports,__webpack_require__){module.exports=Stream;var EE=__webpack_require__(54).EventEmitter;var inherits=__webpack_require__(62);inherits(Stream,EE);Stream.Readable=__webpack_require__(56);Stream.Writable=__webpack_require__(57);Stream.Duplex=__webpack_require__(58);Stream.Transform=__webpack_require__(55);Stream.PassThrough=__webpack_require__(59);Stream.Stream=Stream;function Stream(){EE.call(this);}
Stream.prototype.pipe=function(dest,options){var source=this;function ondata(chunk){if(dest.writable){if(false===dest.write(chunk)&&source.pause){source.pause();}}}
source.on('data',ondata);function ondrain(){if(source.readable&&source.resume){source.resume();}}
dest.on('drain',ondrain);if(!dest._isStdio&&(!options||options.end!==false)){source.on('end',onend);source.on('close',onclose);}
var didOnEnd=false;function onend(){if(didOnEnd)return;didOnEnd=true;dest.end();}
function onclose(){if(didOnEnd)return;didOnEnd=true;if(typeof dest.destroy==='function')dest.destroy();}
function onerror(er){cleanup();if(EE.listenerCount(this,'error')===0){throw er;}}
source.on('error',onerror);dest.on('error',onerror);function cleanup(){source.removeListener('data',ondata);dest.removeListener('drain',ondrain);source.removeListener('end',onend);source.removeListener('close',onclose);source.removeListener('error',onerror);dest.removeListener('error',onerror);source.removeListener('end',cleanup);source.removeListener('close',cleanup);dest.removeListener('close',cleanup);}
source.on('end',cleanup);source.on('close',cleanup);dest.on('close',cleanup);dest.emit('pipe',source);return dest;};},function(module,exports,__webpack_require__){(function(){var SVGPath;SVGPath=(function(){var apply,arcToSegments,cx,cy,parameters,parse,px,py,runners,segmentToBezier,solveArc,sx,sy;function SVGPath(){}
SVGPath.apply=function(doc,path){var commands;commands=parse(path);return apply(commands,doc);};parameters={A:7,a:7,C:6,c:6,H:1,h:1,L:2,l:2,M:2,m:2,Q:4,q:4,S:4,s:4,T:2,t:2,V:1,v:1,Z:0,z:0};parse=function(path){var args,c,cmd,curArg,foundDecimal,params,ret,_i,_len;ret=[];args=[];curArg="";foundDecimal=false;params=0;for(_i=0,_len=path.length;_i<_len;_i++){c=path[_i];if(parameters[c]!=null){params=parameters[c];if(cmd){if(curArg.length>0){args[args.length]=+curArg;}
ret[ret.length]={cmd:cmd,args:args};args=[];curArg="";foundDecimal=false;}
cmd=c;}else if((c===" "||c===",")||(c==="-"&&curArg.length>0&&curArg[curArg.length-1]!=='e')||(c==="."&&foundDecimal)){if(curArg.length===0){continue;}
if(args.length===params){ret[ret.length]={cmd:cmd,args:args};args=[+curArg];if(cmd==="M"){cmd="L";}
if(cmd==="m"){cmd="l";}}else{args[args.length]=+curArg;}
foundDecimal=c===".";curArg=c==='-'||c==='.'?c:'';}else{curArg+=c;if(c==='.'){foundDecimal=true;}}}
if(curArg.length>0){if(args.length===params){ret[ret.length]={cmd:cmd,args:args};args=[+curArg];if(cmd==="M"){cmd="L";}
if(cmd==="m"){cmd="l";}}else{args[args.length]=+curArg;}}
ret[ret.length]={cmd:cmd,args:args};return ret;};cx=cy=px=py=sx=sy=0;apply=function(commands,doc){var c,i,_i,_len,_name;cx=cy=px=py=sx=sy=0;for(i=_i=0,_len=commands.length;_i<_len;i=++_i){c=commands[i];if(typeof runners[_name=c.cmd]==="function"){runners[_name](doc,c.args);}}
return cx=cy=px=py=0;};runners={M:function(doc,a){cx=a[0];cy=a[1];px=py=null;sx=cx;sy=cy;return doc.moveTo(cx,cy);},m:function(doc,a){cx+=a[0];cy+=a[1];px=py=null;sx=cx;sy=cy;return doc.moveTo(cx,cy);},C:function(doc,a){cx=a[4];cy=a[5];px=a[2];py=a[3];return doc.bezierCurveTo.apply(doc,a);},c:function(doc,a){doc.bezierCurveTo(a[0]+cx,a[1]+cy,a[2]+cx,a[3]+cy,a[4]+cx,a[5]+cy);px=cx+a[2];py=cy+a[3];cx+=a[4];return cy+=a[5];},S:function(doc,a){if(px===null){px=cx;py=cy;}
doc.bezierCurveTo(cx-(px-cx),cy-(py-cy),a[0],a[1],a[2],a[3]);px=a[0];py=a[1];cx=a[2];return cy=a[3];},s:function(doc,a){if(px===null){px=cx;py=cy;}
doc.bezierCurveTo(cx-(px-cx),cy-(py-cy),cx+a[0],cy+a[1],cx+a[2],cy+a[3]);px=cx+a[0];py=cy+a[1];cx+=a[2];return cy+=a[3];},Q:function(doc,a){px=a[0];py=a[1];cx=a[2];cy=a[3];return doc.quadraticCurveTo(a[0],a[1],cx,cy);},q:function(doc,a){doc.quadraticCurveTo(a[0]+cx,a[1]+cy,a[2]+cx,a[3]+cy);px=cx+a[0];py=cy+a[1];cx+=a[2];return cy+=a[3];},T:function(doc,a){if(px===null){px=cx;py=cy;}else{px=cx-(px-cx);py=cy-(py-cy);}
doc.quadraticCurveTo(px,py,a[0],a[1]);px=cx-(px-cx);py=cy-(py-cy);cx=a[0];return cy=a[1];},t:function(doc,a){if(px===null){px=cx;py=cy;}else{px=cx-(px-cx);py=cy-(py-cy);}
doc.quadraticCurveTo(px,py,cx+a[0],cy+a[1]);cx+=a[0];return cy+=a[1];},A:function(doc,a){solveArc(doc,cx,cy,a);cx=a[5];return cy=a[6];},a:function(doc,a){a[5]+=cx;a[6]+=cy;solveArc(doc,cx,cy,a);cx=a[5];return cy=a[6];},L:function(doc,a){cx=a[0];cy=a[1];px=py=null;return doc.lineTo(cx,cy);},l:function(doc,a){cx+=a[0];cy+=a[1];px=py=null;return doc.lineTo(cx,cy);},H:function(doc,a){cx=a[0];px=py=null;return doc.lineTo(cx,cy);},h:function(doc,a){cx+=a[0];px=py=null;return doc.lineTo(cx,cy);},V:function(doc,a){cy=a[0];px=py=null;return doc.lineTo(cx,cy);},v:function(doc,a){cy+=a[0];px=py=null;return doc.lineTo(cx,cy);},Z:function(doc){doc.closePath();cx=sx;return cy=sy;},z:function(doc){doc.closePath();cx=sx;return cy=sy;}};solveArc=function(doc,x,y,coords){var bez,ex,ey,large,rot,rx,ry,seg,segs,sweep,_i,_len,_results;rx=coords[0],ry=coords[1],rot=coords[2],large=coords[3],sweep=coords[4],ex=coords[5],ey=coords[6];segs=arcToSegments(ex,ey,rx,ry,large,sweep,rot,x,y);_results=[];for(_i=0,_len=segs.length;_i<_len;_i++){seg=segs[_i];bez=segmentToBezier.apply(null,seg);_results.push(doc.bezierCurveTo.apply(doc,bez));}
return _results;};arcToSegments=function(x,y,rx,ry,large,sweep,rotateX,ox,oy){var a00,a01,a10,a11,cos_th,d,i,pl,result,segments,sfactor,sfactor_sq,sin_th,th,th0,th1,th2,th3,th_arc,x0,x1,xc,y0,y1,yc,_i;th=rotateX*(Math.PI/180);sin_th=Math.sin(th);cos_th=Math.cos(th);rx=Math.abs(rx);ry=Math.abs(ry);px=cos_th*(ox-x)*0.5+sin_th*(oy-y)*0.5;py=cos_th*(oy-y)*0.5-sin_th*(ox-x)*0.5;pl=(px*px)/(rx*rx)+(py*py)/(ry*ry);if(pl>1){pl=Math.sqrt(pl);rx*=pl;ry*=pl;}
a00=cos_th/rx;a01=sin_th/rx;a10=(-sin_th)/ry;a11=cos_th/ry;x0=a00*ox+a01*oy;y0=a10*ox+a11*oy;x1=a00*x+a01*y;y1=a10*x+a11*y;d=(x1-x0)*(x1-x0)+(y1-y0)*(y1-y0);sfactor_sq=1/d-0.25;if(sfactor_sq<0){sfactor_sq=0;}
sfactor=Math.sqrt(sfactor_sq);if(sweep===large){sfactor=-sfactor;}
xc=0.5*(x0+x1)-sfactor*(y1-y0);yc=0.5*(y0+y1)+sfactor*(x1-x0);th0=Math.atan2(y0-yc,x0-xc);th1=Math.atan2(y1-yc,x1-xc);th_arc=th1-th0;if(th_arc<0&&sweep===1){th_arc+=2*Math.PI;}else if(th_arc>0&&sweep===0){th_arc-=2*Math.PI;}
segments=Math.ceil(Math.abs(th_arc/(Math.PI*0.5+0.001)));result=[];for(i=_i=0;0<=segments?_i<segments:_i>segments;i=0<=segments?++_i:--_i){th2=th0+i*th_arc/segments;th3=th0+(i+1)*th_arc/segments;result[i]=[xc,yc,th2,th3,rx,ry,sin_th,cos_th];}
return result;};segmentToBezier=function(cx,cy,th0,th1,rx,ry,sin_th,cos_th){var a00,a01,a10,a11,t,th_half,x1,x2,x3,y1,y2,y3;a00=cos_th*rx;a01=-sin_th*ry;a10=sin_th*rx;a11=cos_th*ry;th_half=0.5*(th1-th0);t=(8/3)*Math.sin(th_half*0.5)*Math.sin(th_half*0.5)/Math.sin(th_half);x1=cx+Math.cos(th0)-t*Math.sin(th0);y1=cy+Math.sin(th0)+t*Math.cos(th0);x3=cx+Math.cos(th1);y3=cy+Math.sin(th1);x2=x3+t*Math.sin(th1);y2=y3-t*Math.cos(th1);return[a00*x1+a01*y1,a10*x1+a11*y1,a00*x2+a01*y2,a10*x2+a11*y2,a00*x3+a01*y3,a10*x3+a11*y3];};return SVGPath;})();module.exports=SVGPath;}).call(this);},function(module,exports,__webpack_require__){(function(){var EventEmitter,LineBreaker,LineWrapper,__hasProp={}.hasOwnProperty,__extends=function(child,parent){for(var key in parent){if(__hasProp.call(parent,key))child[key]=parent[key];}function ctor(){this.constructor=child;}ctor.prototype=parent.prototype;child.prototype=new ctor();child.__super__=parent.prototype;return child;};EventEmitter=__webpack_require__(54).EventEmitter;LineBreaker=__webpack_require__(66);LineWrapper=(function(_super){__extends(LineWrapper,_super);function LineWrapper(document,options){var _ref;this.document=document;this.indent=options.indent||0;this.characterSpacing=options.characterSpacing||0;this.wordSpacing=options.wordSpacing===0;this.columns=options.columns||1;this.columnGap=(_ref=options.columnGap)!=null?_ref:18;this.lineWidth=(options.width-(this.columnGap*(this.columns-1)))/this.columns;this.spaceLeft=this.lineWidth;this.startX=this.document.x;this.startY=this.document.y;this.column=1;this.ellipsis=options.ellipsis;this.continuedX=0;if(options.height!=null){this.height=options.height;this.maxY=this.startY+options.height;}else{this.maxY=this.document.page.maxY();}
this.on('firstLine',(function(_this){return function(options){var indent;indent=_this.continuedX||_this.indent;_this.document.x+=indent;_this.lineWidth-=indent;return _this.once('line',function(){_this.document.x-=indent;_this.lineWidth+=indent;if(options.continued&&!_this.continuedX){_this.continuedX=_this.indent;}
if(!options.continued){return _this.continuedX=0;}});};})(this));this.on('lastLine',(function(_this){return function(options){var align;align=options.align;if(align==='justify'){options.align='left';}
_this.lastLine=true;return _this.once('line',function(){_this.document.y+=options.paragraphGap||0;options.align=align;return _this.lastLine=false;});};})(this));}
LineWrapper.prototype.wordWidth=function(word){return this.document.widthOfString(word,this)+this.characterSpacing+this.wordSpacing;};LineWrapper.prototype.eachWord=function(text,fn){var bk,breaker,fbk,l,last,lbk,shouldContinue,w,word,wordWidths;breaker=new LineBreaker(text);last=null;wordWidths={};while(bk=breaker.nextBreak()){word=text.slice((last!=null?last.position:void 0)||0,bk.position);w=wordWidths[word]!=null?wordWidths[word]:wordWidths[word]=this.wordWidth(word);if(w>this.lineWidth+this.continuedX){lbk=last;fbk={};while(word.length){l=word.length;while(w>this.spaceLeft){w=this.wordWidth(word.slice(0,--l));}
fbk.required=l<word.length;shouldContinue=fn(word.slice(0,l),w,fbk,lbk);lbk={required:false};word=word.slice(l);w=this.wordWidth(word);if(shouldContinue===false){break;}}}else{shouldContinue=fn(word,w,bk,last);}
if(shouldContinue===false){break;}
last=bk;}};LineWrapper.prototype.wrap=function(text,options){var buffer,emitLine,lc,nextY,textWidth,wc,y;if(options.indent!=null){this.indent=options.indent;}
if(options.characterSpacing!=null){this.characterSpacing=options.characterSpacing;}
if(options.wordSpacing!=null){this.wordSpacing=options.wordSpacing;}
if(options.ellipsis!=null){this.ellipsis=options.ellipsis;}
nextY=this.document.y+this.document.currentLineHeight(true);if(this.document.y>this.maxY||nextY>this.maxY){this.nextSection();}
buffer='';textWidth=0;wc=0;lc=0;y=this.document.y;emitLine=(function(_this){return function(){options.textWidth=textWidth+_this.wordSpacing*(wc-1);options.wordCount=wc;options.lineWidth=_this.lineWidth;y=_this.document.y;_this.emit('line',buffer,options,_this);return lc++;};})(this);this.emit('sectionStart',options,this);this.eachWord(text,(function(_this){return function(word,w,bk,last){var lh,shouldContinue;if((last==null)||last.required){_this.emit('firstLine',options,_this);_this.spaceLeft=_this.lineWidth;}
if(w<=_this.spaceLeft){buffer+=word;textWidth+=w;wc++;}
if(bk.required||w>_this.spaceLeft){if(bk.required){_this.emit('lastLine',options,_this);}
lh=_this.document.currentLineHeight(true);if((_this.height!=null)&&_this.ellipsis&&_this.document.y+lh*2>_this.maxY&&_this.column>=_this.columns){if(_this.ellipsis===true){_this.ellipsis='…';}
buffer=buffer.replace(/\s+$/,'');textWidth=_this.wordWidth(buffer+_this.ellipsis);while(textWidth>_this.lineWidth){buffer=buffer.slice(0,-1).replace(/\s+$/,'');textWidth=_this.wordWidth(buffer+_this.ellipsis);}
buffer=buffer+_this.ellipsis;}
emitLine();if(_this.document.y+lh>_this.maxY){shouldContinue=_this.nextSection();if(!shouldContinue){wc=0;buffer='';return false;}}
if(bk.required){if(w>_this.spaceLeft){buffer=word;textWidth=w;wc=1;emitLine();}
_this.spaceLeft=_this.lineWidth;buffer='';textWidth=0;return wc=0;}else{_this.spaceLeft=_this.lineWidth-w;buffer=word;textWidth=w;return wc=1;}}else{return _this.spaceLeft-=w;}};})(this));if(wc>0){this.emit('lastLine',options,this);emitLine();}
this.emit('sectionEnd',options,this);if(options.continued===true){if(lc>1){this.continuedX=0;}
this.continuedX+=options.textWidth;return this.document.y=y;}else{return this.document.x=this.startX;}};LineWrapper.prototype.nextSection=function(options){var _ref;this.emit('sectionEnd',options,this);if(++this.column>this.columns){if(this.height!=null){return false;}
this.document.addPage();this.column=1;this.startY=this.document.page.margins.top;this.maxY=this.document.page.maxY();this.document.x=this.startX;if(this.document._fillColor){(_ref=this.document).fillColor.apply(_ref,this.document._fillColor);}
this.emit('pageBreak',options,this);}else{this.document.x+=this.lineWidth+this.columnGap;this.document.y=this.startY;this.emit('columnBreak',options,this);}
this.emit('sectionStart',options,this);return true;};return LineWrapper;})(EventEmitter);module.exports=LineWrapper;}).call(this);},function(module,exports,__webpack_require__){(function(){var PDFGradient,PDFLinearGradient,PDFRadialGradient,__hasProp={}.hasOwnProperty,__extends=function(child,parent){for(var key in parent){if(__hasProp.call(parent,key))child[key]=parent[key];}function ctor(){this.constructor=child;}ctor.prototype=parent.prototype;child.prototype=new ctor();child.__super__=parent.prototype;return child;};PDFGradient=(function(){function PDFGradient(doc){this.doc=doc;this.stops=[];this.embedded=false;this.transform=[1,0,0,1,0,0];this._colorSpace='DeviceRGB';}
PDFGradient.prototype.stop=function(pos,color,opacity){if(opacity==null){opacity=1;}
opacity=Math.max(0,Math.min(1,opacity));this.stops.push([pos,this.doc._normalizeColor(color),opacity]);return this;};PDFGradient.prototype.embed=function(){var bounds,dx,dy,encode,fn,form,grad,group,gstate,i,last,m,m0,m1,m11,m12,m2,m21,m22,m3,m4,m5,name,pattern,resources,sMask,shader,stop,stops,v,_i,_j,_len,_ref,_ref1,_ref2;if(this.embedded||this.stops.length===0){return;}
this.embedded=true;last=this.stops[this.stops.length-1];if(last[0]<1){this.stops.push([1,last[1],last[2]]);}
bounds=[];encode=[];stops=[];for(i=_i=0,_ref=this.stops.length-1;0<=_ref?_i<_ref:_i>_ref;i=0<=_ref?++_i:--_i){encode.push(0,1);if(i+2!==this.stops.length){bounds.push(this.stops[i+1][0]);}
fn=this.doc.ref({FunctionType:2,Domain:[0,1],C0:this.stops[i+0][1],C1:this.stops[i+1][1],N:1});stops.push(fn);fn.end();}
if(stops.length===1){fn=stops[0];}else{fn=this.doc.ref({FunctionType:3,Domain:[0,1],Functions:stops,Bounds:bounds,Encode:encode});fn.end();}
this.id='Sh'+(++this.doc._gradCount);m=this.doc._ctm.slice();m0=m[0],m1=m[1],m2=m[2],m3=m[3],m4=m[4],m5=m[5];_ref1=this.transform,m11=_ref1[0],m12=_ref1[1],m21=_ref1[2],m22=_ref1[3],dx=_ref1[4],dy=_ref1[5];m[0]=m0*m11+m2*m12;m[1]=m1*m11+m3*m12;m[2]=m0*m21+m2*m22;m[3]=m1*m21+m3*m22;m[4]=m0*dx+m2*dy+m4;m[5]=m1*dx+m3*dy+m5;shader=this.shader(fn);shader.end();pattern=this.doc.ref({Type:'Pattern',PatternType:2,Shading:shader,Matrix:(function(){var _j,_len,_results;_results=[];for(_j=0,_len=m.length;_j<_len;_j++){v=m[_j];_results.push(+v.toFixed(5));}
return _results;})()});this.doc.page.patterns[this.id]=pattern;pattern.end();if(this.stops.some(function(stop){return stop[2]<1;})){grad=this.opacityGradient();grad._colorSpace='DeviceGray';_ref2=this.stops;for(_j=0,_len=_ref2.length;_j<_len;_j++){stop=_ref2[_j];grad.stop(stop[0],[stop[2]]);}
grad=grad.embed();group=this.doc.ref({Type:'Group',S:'Transparency',CS:'DeviceGray'});group.end();resources=this.doc.ref({ProcSet:['PDF','Text','ImageB','ImageC','ImageI'],Shading:{Sh1:grad.data.Shading}});resources.end();form=this.doc.ref({Type:'XObject',Subtype:'Form',FormType:1,BBox:[0,0,this.doc.page.width,this.doc.page.height],Group:group,Resources:resources});form.end("/Sh1 sh");sMask=this.doc.ref({Type:'Mask',S:'Luminosity',G:form});sMask.end();gstate=this.doc.ref({Type:'ExtGState',SMask:sMask});this.opacity_id=++this.doc._opacityCount;name="Gs"+this.opacity_id;this.doc.page.ext_gstates[name]=gstate;gstate.end();}
return pattern;};PDFGradient.prototype.apply=function(op){if(!this.embedded){this.embed();}
this.doc.addContent("/"+this.id+" "+op);if(this.opacity_id){this.doc.addContent("/Gs"+this.opacity_id+" gs");return this.doc._sMasked=true;}};return PDFGradient;})();PDFLinearGradient=(function(_super){__extends(PDFLinearGradient,_super);function PDFLinearGradient(doc,x1,y1,x2,y2){this.doc=doc;this.x1=x1;this.y1=y1;this.x2=x2;this.y2=y2;PDFLinearGradient.__super__.constructor.apply(this,arguments);}
PDFLinearGradient.prototype.shader=function(fn){return this.doc.ref({ShadingType:2,ColorSpace:this._colorSpace,Coords:[this.x1,this.y1,this.x2,this.y2],Function:fn,Extend:[true,true]});};PDFLinearGradient.prototype.opacityGradient=function(){return new PDFLinearGradient(this.doc,this.x1,this.y1,this.x2,this.y2);};return PDFLinearGradient;})(PDFGradient);PDFRadialGradient=(function(_super){__extends(PDFRadialGradient,_super);function PDFRadialGradient(doc,x1,y1,r1,x2,y2,r2){this.doc=doc;this.x1=x1;this.y1=y1;this.r1=r1;this.x2=x2;this.y2=y2;this.r2=r2;PDFRadialGradient.__super__.constructor.apply(this,arguments);}
PDFRadialGradient.prototype.shader=function(fn){return this.doc.ref({ShadingType:3,ColorSpace:this._colorSpace,Coords:[this.x1,this.y1,this.r1,this.x2,this.y2,this.r2],Function:fn,Extend:[true,true]});};PDFRadialGradient.prototype.opacityGradient=function(){return new PDFRadialGradient(this.doc,this.x1,this.y1,this.r1,this.x2,this.y2,this.r2);};return PDFRadialGradient;})(PDFGradient);module.exports={PDFGradient:PDFGradient,PDFLinearGradient:PDFLinearGradient,PDFRadialGradient:PDFRadialGradient};}).call(this);},function(module,exports,__webpack_require__){(function(process,Buffer){var msg=__webpack_require__(73);var zstream=__webpack_require__(77);var zlib_deflate=__webpack_require__(74);var zlib_inflate=__webpack_require__(75);var constants=__webpack_require__(76);for(var key in constants){exports[key]=constants[key];}
exports.NONE=0;exports.DEFLATE=1;exports.INFLATE=2;exports.GZIP=3;exports.GUNZIP=4;exports.DEFLATERAW=5;exports.INFLATERAW=6;exports.UNZIP=7;function Zlib(mode){if(mode<exports.DEFLATE||mode>exports.UNZIP)
throw new TypeError("Bad argument");this.mode=mode;this.init_done=false;this.write_in_progress=false;this.pending_close=false;this.windowBits=0;this.level=0;this.memLevel=0;this.strategy=0;this.dictionary=null;}
Zlib.prototype.init=function(windowBits,level,memLevel,strategy,dictionary){this.windowBits=windowBits;this.level=level;this.memLevel=memLevel;this.strategy=strategy;if(this.mode===exports.GZIP||this.mode===exports.GUNZIP)
this.windowBits+=16;if(this.mode===exports.UNZIP)
this.windowBits+=32;if(this.mode===exports.DEFLATERAW||this.mode===exports.INFLATERAW)
this.windowBits=-this.windowBits;this.strm=new zstream();switch(this.mode){case exports.DEFLATE:case exports.GZIP:case exports.DEFLATERAW:var status=zlib_deflate.deflateInit2(this.strm,this.level,exports.Z_DEFLATED,this.windowBits,this.memLevel,this.strategy);break;case exports.INFLATE:case exports.GUNZIP:case exports.INFLATERAW:case exports.UNZIP:var status=zlib_inflate.inflateInit2(this.strm,this.windowBits);break;default:throw new Error("Unknown mode "+this.mode);}
if(status!==exports.Z_OK){this._error(status);return;}
this.write_in_progress=false;this.init_done=true;};Zlib.prototype.params=function(){throw new Error("deflateParams Not supported");};Zlib.prototype._writeCheck=function(){if(!this.init_done)
throw new Error("write before init");if(this.mode===exports.NONE)
throw new Error("already finalized");if(this.write_in_progress)
throw new Error("write already in progress");if(this.pending_close)
throw new Error("close is pending");};Zlib.prototype.write=function(flush,input,in_off,in_len,out,out_off,out_len){this._writeCheck();this.write_in_progress=true;var self=this;process.nextTick(function(){self.write_in_progress=false;var res=self._write(flush,input,in_off,in_len,out,out_off,out_len);self.callback(res[0],res[1]);if(self.pending_close)
self.close();});return this;};function bufferSet(data,offset){for(var i=0;i<data.length;i++){this[offset+i]=data[i];}}
Zlib.prototype.writeSync=function(flush,input,in_off,in_len,out,out_off,out_len){this._writeCheck();return this._write(flush,input,in_off,in_len,out,out_off,out_len);};Zlib.prototype._write=function(flush,input,in_off,in_len,out,out_off,out_len){this.write_in_progress=true;if(flush!==exports.Z_NO_FLUSH&&flush!==exports.Z_PARTIAL_FLUSH&&flush!==exports.Z_SYNC_FLUSH&&flush!==exports.Z_FULL_FLUSH&&flush!==exports.Z_FINISH&&flush!==exports.Z_BLOCK){throw new Error("Invalid flush value");}
if(input==null){input=new Buffer(0);in_len=0;in_off=0;}
if(out._set)
out.set=out._set;else
out.set=bufferSet;var strm=this.strm;strm.avail_in=in_len;strm.input=input;strm.next_in=in_off;strm.avail_out=out_len;strm.output=out;strm.next_out=out_off;switch(this.mode){case exports.DEFLATE:case exports.GZIP:case exports.DEFLATERAW:var status=zlib_deflate.deflate(strm,flush);break;case exports.UNZIP:case exports.INFLATE:case exports.GUNZIP:case exports.INFLATERAW:var status=zlib_inflate.inflate(strm,flush);break;default:throw new Error("Unknown mode "+this.mode);}
if(status!==exports.Z_STREAM_END&&status!==exports.Z_OK){this._error(status);}
this.write_in_progress=false;return[strm.avail_in,strm.avail_out];};Zlib.prototype.close=function(){if(this.write_in_progress){this.pending_close=true;return;}
this.pending_close=false;if(this.mode===exports.DEFLATE||this.mode===exports.GZIP||this.mode===exports.DEFLATERAW){zlib_deflate.deflateEnd(this.strm);}else{zlib_inflate.inflateEnd(this.strm);}
this.mode=exports.NONE;};Zlib.prototype.reset=function(){switch(this.mode){case exports.DEFLATE:case exports.DEFLATERAW:var status=zlib_deflate.deflateReset(this.strm);break;case exports.INFLATE:case exports.INFLATERAW:var status=zlib_inflate.inflateReset(this.strm);break;}
if(status!==exports.Z_OK){this._error(status);}};Zlib.prototype._error=function(status){this.onerror(msg[status]+': '+this.strm.msg,status);this.write_in_progress=false;if(this.pending_close)
this.close();};exports.Zlib=Zlib;}.call(exports,__webpack_require__(61),__webpack_require__(4).Buffer))},function(module,exports,__webpack_require__){(function(Buffer){(function(){var PNG,fs,zlib;fs=__webpack_require__(10);zlib=__webpack_require__(45);module.exports=PNG=(function(){PNG.decode=function(path,fn){return fs.readFile(path,function(err,file){var png;png=new PNG(file);return png.decode(function(pixels){return fn(pixels);});});};PNG.load=function(path){var file;file=fs.readFileSync(path);return new PNG(file);};function PNG(data){var chunkSize,colors,i,index,key,section,short,text,_i,_j,_ref;this.data=data;this.pos=8;this.palette=[];this.imgData=[];this.transparency={};this.text={};while(true){chunkSize=this.readUInt32();section=((function(){var _i,_results;_results=[];for(i=_i=0;_i<4;i=++_i){_results.push(String.fromCharCode(this.data[this.pos++]));}
return _results;}).call(this)).join('');switch(section){case'IHDR':this.width=this.readUInt32();this.height=this.readUInt32();this.bits=this.data[this.pos++];this.colorType=this.data[this.pos++];this.compressionMethod=this.data[this.pos++];this.filterMethod=this.data[this.pos++];this.interlaceMethod=this.data[this.pos++];break;case'PLTE':this.palette=this.read(chunkSize);break;case'IDAT':for(i=_i=0;_i<chunkSize;i=_i+=1){this.imgData.push(this.data[this.pos++]);}
break;case'tRNS':this.transparency={};switch(this.colorType){case 3:this.transparency.indexed=this.read(chunkSize);short=255-this.transparency.indexed.length;if(short>0){for(i=_j=0;0<=short?_j<short:_j>short;i=0<=short?++_j:--_j){this.transparency.indexed.push(255);}}
break;case 0:this.transparency.grayscale=this.read(chunkSize)[0];break;case 2:this.transparency.rgb=this.read(chunkSize);}
break;case'tEXt':text=this.read(chunkSize);index=text.indexOf(0);key=String.fromCharCode.apply(String,text.slice(0,index));this.text[key]=String.fromCharCode.apply(String,text.slice(index+1));break;case'IEND':this.colors=(function(){switch(this.colorType){case 0:case 3:case 4:return 1;case 2:case 6:return 3;}}).call(this);this.hasAlphaChannel=(_ref=this.colorType)===4||_ref===6;colors=this.colors+(this.hasAlphaChannel?1:0);this.pixelBitlength=this.bits*colors;this.colorSpace=(function(){switch(this.colors){case 1:return'DeviceGray';case 3:return'DeviceRGB';}}).call(this);this.imgData=new Buffer(this.imgData);return;default:this.pos+=chunkSize;}
this.pos+=4;if(this.pos>this.data.length){throw new Error("Incomplete or corrupt PNG file");}}
return;}
PNG.prototype.read=function(bytes){var i,_i,_results;_results=[];for(i=_i=0;0<=bytes?_i<bytes:_i>bytes;i=0<=bytes?++_i:--_i){_results.push(this.data[this.pos++]);}
return _results;};PNG.prototype.readUInt32=function(){var b1,b2,b3,b4;b1=this.data[this.pos++]<<24;b2=this.data[this.pos++]<<16;b3=this.data[this.pos++]<<8;b4=this.data[this.pos++];return b1|b2|b3|b4;};PNG.prototype.readUInt16=function(){var b1,b2;b1=this.data[this.pos++]<<8;b2=this.data[this.pos++];return b1|b2;};PNG.prototype.decodePixels=function(fn){var _this=this;return zlib.inflate(this.imgData,function(err,data){var byte,c,col,i,left,length,p,pa,paeth,pb,pc,pixelBytes,pixels,pos,row,scanlineLength,upper,upperLeft,_i,_j,_k,_l,_m;if(err){throw err;}
pixelBytes=_this.pixelBitlength/8;scanlineLength=pixelBytes*_this.width;pixels=new Buffer(scanlineLength*_this.height);length=data.length;row=0;pos=0;c=0;while(pos<length){switch(data[pos++]){case 0:for(i=_i=0;_i<scanlineLength;i=_i+=1){pixels[c++]=data[pos++];}
break;case 1:for(i=_j=0;_j<scanlineLength;i=_j+=1){byte=data[pos++];left=i<pixelBytes?0:pixels[c-pixelBytes];pixels[c++]=(byte+left)%256;}
break;case 2:for(i=_k=0;_k<scanlineLength;i=_k+=1){byte=data[pos++];col=(i-(i%pixelBytes))/pixelBytes;upper=row&&pixels[(row-1)*scanlineLength+col*pixelBytes+(i%pixelBytes)];pixels[c++]=(upper+byte)%256;}
break;case 3:for(i=_l=0;_l<scanlineLength;i=_l+=1){byte=data[pos++];col=(i-(i%pixelBytes))/pixelBytes;left=i<pixelBytes?0:pixels[c-pixelBytes];upper=row&&pixels[(row-1)*scanlineLength+col*pixelBytes+(i%pixelBytes)];pixels[c++]=(byte+Math.floor((left+upper)/2))%256;}
break;case 4:for(i=_m=0;_m<scanlineLength;i=_m+=1){byte=data[pos++];col=(i-(i%pixelBytes))/pixelBytes;left=i<pixelBytes?0:pixels[c-pixelBytes];if(row===0){upper=upperLeft=0;}else{upper=pixels[(row-1)*scanlineLength+col*pixelBytes+(i%pixelBytes)];upperLeft=col&&pixels[(row-1)*scanlineLength+(col-1)*pixelBytes+(i%pixelBytes)];}
p=left+upper-upperLeft;pa=Math.abs(p-left);pb=Math.abs(p-upper);pc=Math.abs(p-upperLeft);if(pa<=pb&&pa<=pc){paeth=left;}else if(pb<=pc){paeth=upper;}else{paeth=upperLeft;}
pixels[c++]=(byte+paeth)%256;}
break;default:throw new Error("Invalid filter algorithm: "+data[pos-1]);}
row++;}
return fn(pixels);});};PNG.prototype.decodePalette=function(){var c,i,length,palette,pos,ret,transparency,_i,_ref,_ref1;palette=this.palette;transparency=this.transparency.indexed||[];ret=new Buffer(transparency.length+palette.length);pos=0;length=palette.length;c=0;for(i=_i=0,_ref=palette.length;_i<_ref;i=_i+=3){ret[pos++]=palette[i];ret[pos++]=palette[i+1];ret[pos++]=palette[i+2];ret[pos++]=(_ref1=transparency[c++])!=null?_ref1:255;}
return ret;};PNG.prototype.copyToImageData=function(imageData,pixels){var alpha,colors,data,i,input,j,k,length,palette,v,_ref;colors=this.colors;palette=null;alpha=this.hasAlphaChannel;if(this.palette.length){palette=(_ref=this._decodedPalette)!=null?_ref:this._decodedPalette=this.decodePalette();colors=4;alpha=true;}
data=(imageData!=null?imageData.data:void 0)||imageData;length=data.length;input=palette||pixels;i=j=0;if(colors===1){while(i<length){k=palette?pixels[i/4]*4:j;v=input[k++];data[i++]=v;data[i++]=v;data[i++]=v;data[i++]=alpha?input[k++]:255;j=k;}}else{while(i<length){k=palette?pixels[i/4]*4:j;data[i++]=input[k++];data[i++]=input[k++];data[i++]=input[k++];data[i++]=alpha?input[k++]:255;j=k;}}};PNG.prototype.decode=function(fn){var ret,_this=this;ret=new Buffer(this.width*this.height*4);return this.decodePixels(function(pixels){_this.copyToImageData(ret,pixels);return fn(ret);});};return PNG;})();}).call(this);}.call(exports,__webpack_require__(4).Buffer))},function(module,exports,__webpack_require__){(function(Buffer,__dirname){(function(){var AFMFont,PDFFont,Subset,TTFFont,fs;TTFFont=__webpack_require__(64);AFMFont=__webpack_require__(63);Subset=__webpack_require__(65);fs=__webpack_require__(10);PDFFont=(function(){var STANDARD_FONTS,toUnicodeCmap;function PDFFont(document,src,family,id){this.document=document;this.id=id;if(typeof src==='string'){if(src in STANDARD_FONTS){this.isAFM=true;this.font=new AFMFont(STANDARD_FONTS[src]());this.registerAFM(src);return;}else if(/\.(ttf|ttc)$/i.test(src)){this.font=TTFFont.open(src,family);}else if(/\.dfont$/i.test(src)){this.font=TTFFont.fromDFont(src,family);}else{throw new Error('Not a supported font format or standard PDF font.');}}else if(Buffer.isBuffer(src)){this.font=TTFFont.fromBuffer(src,family);}else if(src instanceof Uint8Array){this.font=TTFFont.fromBuffer(new Buffer(src),family);}else if(src instanceof ArrayBuffer){this.font=TTFFont.fromBuffer(new Buffer(new Uint8Array(src)),family);}else{throw new Error('Not a supported font format or standard PDF font.');}
this.subset=new Subset(this.font);this.registerTTF();}
STANDARD_FONTS={"Courier":function(){return fs.readFileSync(__dirname+"/font/data/Courier.afm",'utf8');},"Courier-Bold":function(){return fs.readFileSync(__dirname+"/font/data/Courier-Bold.afm",'utf8');},"Courier-Oblique":function(){return fs.readFileSync(__dirname+"/font/data/Courier-Oblique.afm",'utf8');},"Courier-BoldOblique":function(){return fs.readFileSync(__dirname+"/font/data/Courier-BoldOblique.afm",'utf8');},"Helvetica":function(){return fs.readFileSync(__dirname+"/font/data/Helvetica.afm",'utf8');},"Helvetica-Bold":function(){return fs.readFileSync(__dirname+"/font/data/Helvetica-Bold.afm",'utf8');},"Helvetica-Oblique":function(){return fs.readFileSync(__dirname+"/font/data/Helvetica-Oblique.afm",'utf8');},"Helvetica-BoldOblique":function(){return fs.readFileSync(__dirname+"/font/data/Helvetica-BoldOblique.afm",'utf8');},"Times-Roman":function(){return fs.readFileSync(__dirname+"/font/data/Times-Roman.afm",'utf8');},"Times-Bold":function(){return fs.readFileSync(__dirname+"/font/data/Times-Bold.afm",'utf8');},"Times-Italic":function(){return fs.readFileSync(__dirname+"/font/data/Times-Italic.afm",'utf8');},"Times-BoldItalic":function(){return fs.readFileSync(__dirname+"/font/data/Times-BoldItalic.afm",'utf8');},"Symbol":function(){return fs.readFileSync(__dirname+"/font/data/Symbol.afm",'utf8');},"ZapfDingbats":function(){return fs.readFileSync(__dirname+"/font/data/ZapfDingbats.afm",'utf8');}};PDFFont.prototype.use=function(characters){var _ref;return(_ref=this.subset)!=null?_ref.use(characters):void 0;};PDFFont.prototype.embed=function(){if(this.embedded||(this.dictionary==null)){return;}
if(this.isAFM){this.embedAFM();}else{this.embedTTF();}
return this.embedded=true;};PDFFont.prototype.encode=function(text){var _ref;if(this.isAFM){return this.font.encodeText(text);}else{return((_ref=this.subset)!=null?_ref.encodeText(text):void 0)||text;}};PDFFont.prototype.ref=function(){return this.dictionary!=null?this.dictionary:this.dictionary=this.document.ref();};PDFFont.prototype.registerTTF=function(){var e,hi,low,raw,_ref;this.name=this.font.name.postscriptName;this.scaleFactor=1000.0/this.font.head.unitsPerEm;this.bbox=(function(){var _i,_len,_ref,_results;_ref=this.font.bbox;_results=[];for(_i=0,_len=_ref.length;_i<_len;_i++){e=_ref[_i];_results.push(Math.round(e*this.scaleFactor));}
return _results;}).call(this);this.stemV=0;if(this.font.post.exists){raw=this.font.post.italic_angle;hi=raw>>16;low=raw&0xFF;if(hi&0x8000!==0){hi=-((hi^0xFFFF)+1);}
this.italicAngle=+(""+hi+"."+low);}else{this.italicAngle=0;}
this.ascender=Math.round(this.font.ascender*this.scaleFactor);this.decender=Math.round(this.font.decender*this.scaleFactor);this.lineGap=Math.round(this.font.lineGap*this.scaleFactor);this.capHeight=(this.font.os2.exists&&this.font.os2.capHeight)||this.ascender;this.xHeight=(this.font.os2.exists&&this.font.os2.xHeight)||0;this.familyClass=(this.font.os2.exists&&this.font.os2.familyClass||0)>>8;this.isSerif=(_ref=this.familyClass)===1||_ref===2||_ref===3||_ref===4||_ref===5||_ref===7;this.isScript=this.familyClass===10;this.flags=0;if(this.font.post.isFixedPitch){this.flags|=1<<0;}
if(this.isSerif){this.flags|=1<<1;}
if(this.isScript){this.flags|=1<<3;}
if(this.italicAngle!==0){this.flags|=1<<6;}
this.flags|=1<<5;if(!this.font.cmap.unicode){throw new Error('No unicode cmap for font');}};PDFFont.prototype.embedTTF=function(){var charWidths,cmap,code,data,descriptor,firstChar,fontfile,glyph;data=this.subset.encode();fontfile=this.document.ref();fontfile.write(data);fontfile.data.Length1=fontfile.uncompressedLength;fontfile.end();descriptor=this.document.ref({Type:'FontDescriptor',FontName:this.subset.postscriptName,FontFile2:fontfile,FontBBox:this.bbox,Flags:this.flags,StemV:this.stemV,ItalicAngle:this.italicAngle,Ascent:this.ascender,Descent:this.decender,CapHeight:this.capHeight,XHeight:this.xHeight});descriptor.end();firstChar=+Object.keys(this.subset.cmap)[0];charWidths=(function(){var _ref,_results;_ref=this.subset.cmap;_results=[];for(code in _ref){glyph=_ref[code];_results.push(Math.round(this.font.widthOfGlyph(glyph)));}
return _results;}).call(this);cmap=this.document.ref();cmap.end(toUnicodeCmap(this.subset.subset));this.dictionary.data={Type:'Font',BaseFont:this.subset.postscriptName,Subtype:'TrueType',FontDescriptor:descriptor,FirstChar:firstChar,LastChar:firstChar+charWidths.length-1,Widths:charWidths,Encoding:'MacRomanEncoding',ToUnicode:cmap};return this.dictionary.end();};toUnicodeCmap=function(map){var code,codes,range,unicode,unicodeMap,_i,_len;unicodeMap='/CIDInit /ProcSet findresource begin\n12 dict begin\nbegincmap\n/CIDSystemInfo <<\n  /Registry (Adobe)\n  /Ordering (UCS)\n  /Supplement 0\n>> def\n/CMapName /Adobe-Identity-UCS def\n/CMapType 2 def\n1 begincodespacerange\n<00><ff>\nendcodespacerange';codes=Object.keys(map).sort(function(a,b){return a-b;});range=[];for(_i=0,_len=codes.length;_i<_len;_i++){code=codes[_i];if(range.length>=100){unicodeMap+="\n"+range.length+" beginbfchar\n"+(range.join('\n'))+"\nendbfchar";range=[];}
unicode=('0000'+map[code].toString(16)).slice(-4);code=(+code).toString(16);range.push("<"+code+"><"+unicode+">");}
if(range.length){unicodeMap+="\n"+range.length+" beginbfchar\n"+(range.join('\n'))+"\nendbfchar\n";}
return unicodeMap+='endcmap\nCMapName currentdict /CMap defineresource pop\nend\nend';};PDFFont.prototype.registerAFM=function(name){var _ref;this.name=name;return _ref=this.font,this.ascender=_ref.ascender,this.decender=_ref.decender,this.bbox=_ref.bbox,this.lineGap=_ref.lineGap,_ref;};PDFFont.prototype.embedAFM=function(){this.dictionary.data={Type:'Font',BaseFont:this.name,Subtype:'Type1',Encoding:'WinAnsiEncoding'};return this.dictionary.end();};PDFFont.prototype.widthOfString=function(string,size){var charCode,i,scale,width,_i,_ref;string=''+string;width=0;for(i=_i=0,_ref=string.length;0<=_ref?_i<_ref:_i>_ref;i=0<=_ref?++_i:--_i){charCode=string.charCodeAt(i);width+=this.font.widthOfGlyph(this.font.characterToGlyph(charCode))||0;}
scale=size/1000;return width*scale;};PDFFont.prototype.lineHeight=function(size,includeGap){var gap;if(includeGap==null){includeGap=false;}
gap=includeGap?this.lineGap:0;return(this.ascender+gap-this.decender)/1000*size;};return PDFFont;})();module.exports=PDFFont;}).call(this);}.call(exports,__webpack_require__(4).Buffer,"/"))},function(module,exports,__webpack_require__){var util=__webpack_require__(60);var pSlice=Array.prototype.slice;var hasOwn=Object.prototype.hasOwnProperty;var assert=module.exports=ok;assert.AssertionError=function AssertionError(options){this.name='AssertionError';this.actual=options.actual;this.expected=options.expected;this.operator=options.operator;if(options.message){this.message=options.message;this.generatedMessage=false;}else{this.message=getMessage(this);this.generatedMessage=true;}
var stackStartFunction=options.stackStartFunction||fail;if(Error.captureStackTrace){Error.captureStackTrace(this,stackStartFunction);}
else{var err=new Error();if(err.stack){var out=err.stack;var fn_name=stackStartFunction.name;var idx=out.indexOf('\n'+fn_name);if(idx>=0){var next_line=out.indexOf('\n',idx+1);out=out.substring(next_line+1);}
this.stack=out;}}};util.inherits(assert.AssertionError,Error);function replacer(key,value){if(util.isUndefined(value)){return''+value;}
if(util.isNumber(value)&&!isFinite(value)){return value.toString();}
if(util.isFunction(value)||util.isRegExp(value)){return value.toString();}
return value;}
function truncate(s,n){if(util.isString(s)){return s.length<n?s:s.slice(0,n);}else{return s;}}
function getMessage(self){return truncate(JSON.stringify(self.actual,replacer),128)+' '+self.operator+' '+truncate(JSON.stringify(self.expected,replacer),128);}
function fail(actual,expected,message,operator,stackStartFunction){throw new assert.AssertionError({message:message,actual:actual,expected:expected,operator:operator,stackStartFunction:stackStartFunction});}
assert.fail=fail;function ok(value,message){if(!value)fail(value,true,message,'==',assert.ok);}
assert.ok=ok;assert.equal=function equal(actual,expected,message){if(actual!=expected)fail(actual,expected,message,'==',assert.equal);};assert.notEqual=function notEqual(actual,expected,message){if(actual==expected){fail(actual,expected,message,'!=',assert.notEqual);}};assert.deepEqual=function deepEqual(actual,expected,message){if(!_deepEqual(actual,expected)){fail(actual,expected,message,'deepEqual',assert.deepEqual);}};function _deepEqual(actual,expected){if(actual===expected){return true;}else if(util.isBuffer(actual)&&util.isBuffer(expected)){if(actual.length!=expected.length)return false;for(var i=0;i<actual.length;i++){if(actual[i]!==expected[i])return false;}
return true;}else if(util.isDate(actual)&&util.isDate(expected)){return actual.getTime()===expected.getTime();}else if(util.isRegExp(actual)&&util.isRegExp(expected)){return actual.source===expected.source&&actual.global===expected.global&&actual.multiline===expected.multiline&&actual.lastIndex===expected.lastIndex&&actual.ignoreCase===expected.ignoreCase;}else if(!util.isObject(actual)&&!util.isObject(expected)){return actual==expected;}else{return objEquiv(actual,expected);}}
function isArguments(object){return Object.prototype.toString.call(object)=='[object Arguments]';}
function objEquiv(a,b){if(util.isNullOrUndefined(a)||util.isNullOrUndefined(b))
return false;if(a.prototype!==b.prototype)return false;if(util.isPrimitive(a)||util.isPrimitive(b)){return a===b;}
var aIsArgs=isArguments(a),bIsArgs=isArguments(b);if((aIsArgs&&!bIsArgs)||(!aIsArgs&&bIsArgs))
return false;if(aIsArgs){a=pSlice.call(a);b=pSlice.call(b);return _deepEqual(a,b);}
var ka=objectKeys(a),kb=objectKeys(b),key,i;if(ka.length!=kb.length)
return false;ka.sort();kb.sort();for(i=ka.length-1;i>=0;i--){if(ka[i]!=kb[i])
return false;}
for(i=ka.length-1;i>=0;i--){key=ka[i];if(!_deepEqual(a[key],b[key]))return false;}
return true;}
assert.notDeepEqual=function notDeepEqual(actual,expected,message){if(_deepEqual(actual,expected)){fail(actual,expected,message,'notDeepEqual',assert.notDeepEqual);}};assert.strictEqual=function strictEqual(actual,expected,message){if(actual!==expected){fail(actual,expected,message,'===',assert.strictEqual);}};assert.notStrictEqual=function notStrictEqual(actual,expected,message){if(actual===expected){fail(actual,expected,message,'!==',assert.notStrictEqual);}};function expectedException(actual,expected){if(!actual||!expected){return false;}
if(Object.prototype.toString.call(expected)=='[object RegExp]'){return expected.test(actual);}else if(actual instanceof expected){return true;}else if(expected.call({},actual)===true){return true;}
return false;}
function _throws(shouldThrow,block,expected,message){var actual;if(util.isString(expected)){message=expected;expected=null;}
try{block();}catch(e){actual=e;}
message=(expected&&expected.name?' ('+expected.name+').':'.')+(message?' '+message:'.');if(shouldThrow&&!actual){fail(actual,expected,'Missing expected exception'+message);}
if(!shouldThrow&&expectedException(actual,expected)){fail(actual,expected,'Got unwanted exception'+message);}
if((shouldThrow&&actual&&expected&&!expectedException(actual,expected))||(!shouldThrow&&actual)){throw actual;}}
assert.throws=function(block,error,message){_throws.apply(this,[true].concat(pSlice.call(arguments)));};assert.doesNotThrow=function(block,message){_throws.apply(this,[false].concat(pSlice.call(arguments)));};assert.ifError=function(err){if(err){throw err;}};var objectKeys=Object.keys||function(obj){var keys=[];for(var key in obj){if(hasOwn.call(obj,key))keys.push(key);}
return keys;};},function(module,exports,__webpack_require__){function EventEmitter(){this._events=this._events||{};this._maxListeners=this._maxListeners||undefined;}
module.exports=EventEmitter;EventEmitter.EventEmitter=EventEmitter;EventEmitter.prototype._events=undefined;EventEmitter.prototype._maxListeners=undefined;EventEmitter.defaultMaxListeners=10;EventEmitter.prototype.setMaxListeners=function(n){if(!isNumber(n)||n<0||isNaN(n))
throw TypeError('n must be a positive number');this._maxListeners=n;return this;};EventEmitter.prototype.emit=function(type){var er,handler,len,args,i,listeners;if(!this._events)
this._events={};if(type==='error'){if(!this._events.error||(isObject(this._events.error)&&!this._events.error.length)){er=arguments[1];if(er instanceof Error){throw er;}
throw TypeError('Uncaught, unspecified "error" event.');}}
handler=this._events[type];if(isUndefined(handler))
return false;if(isFunction(handler)){switch(arguments.length){case 1:handler.call(this);break;case 2:handler.call(this,arguments[1]);break;case 3:handler.call(this,arguments[1],arguments[2]);break;default:len=arguments.length;args=new Array(len-1);for(i=1;i<len;i++)
args[i-1]=arguments[i];handler.apply(this,args);}}else if(isObject(handler)){len=arguments.length;args=new Array(len-1);for(i=1;i<len;i++)
args[i-1]=arguments[i];listeners=handler.slice();len=listeners.length;for(i=0;i<len;i++)
listeners[i].apply(this,args);}
return true;};EventEmitter.prototype.addListener=function(type,listener){var m;if(!isFunction(listener))
throw TypeError('listener must be a function');if(!this._events)
this._events={};if(this._events.newListener)
this.emit('newListener',type,isFunction(listener.listener)?listener.listener:listener);if(!this._events[type])
this._events[type]=listener;else if(isObject(this._events[type]))
this._events[type].push(listener);else
this._events[type]=[this._events[type],listener];if(isObject(this._events[type])&&!this._events[type].warned){var m;if(!isUndefined(this._maxListeners)){m=this._maxListeners;}else{m=EventEmitter.defaultMaxListeners;}
if(m&&m>0&&this._events[type].length>m){this._events[type].warned=true;console.error('(node) warning: possible EventEmitter memory '+'leak detected. %d listeners added. '+'Use emitter.setMaxListeners() to increase limit.',this._events[type].length);if(typeof console.trace==='function'){console.trace();}}}
return this;};EventEmitter.prototype.on=EventEmitter.prototype.addListener;EventEmitter.prototype.once=function(type,listener){if(!isFunction(listener))
throw TypeError('listener must be a function');var fired=false;function g(){this.removeListener(type,g);if(!fired){fired=true;listener.apply(this,arguments);}}
g.listener=listener;this.on(type,g);return this;};EventEmitter.prototype.removeListener=function(type,listener){var list,position,length,i;if(!isFunction(listener))
throw TypeError('listener must be a function');if(!this._events||!this._events[type])
return this;list=this._events[type];length=list.length;position=-1;if(list===listener||(isFunction(list.listener)&&list.listener===listener)){delete this._events[type];if(this._events.removeListener)
this.emit('removeListener',type,listener);}else if(isObject(list)){for(i=length;i-->0;){if(list[i]===listener||(list[i].listener&&list[i].listener===listener)){position=i;break;}}
if(position<0)
return this;if(list.length===1){list.length=0;delete this._events[type];}else{list.splice(position,1);}
if(this._events.removeListener)
this.emit('removeListener',type,listener);}
return this;};EventEmitter.prototype.removeAllListeners=function(type){var key,listeners;if(!this._events)
return this;if(!this._events.removeListener){if(arguments.length===0)
this._events={};else if(this._events[type])
delete this._events[type];return this;}
if(arguments.length===0){for(key in this._events){if(key==='removeListener')continue;this.removeAllListeners(key);}
this.removeAllListeners('removeListener');this._events={};return this;}
listeners=this._events[type];if(isFunction(listeners)){this.removeListener(type,listeners);}else{while(listeners.length)
this.removeListener(type,listeners[listeners.length-1]);}
delete this._events[type];return this;};EventEmitter.prototype.listeners=function(type){var ret;if(!this._events||!this._events[type])
ret=[];else if(isFunction(this._events[type]))
ret=[this._events[type]];else
ret=this._events[type].slice();return ret;};EventEmitter.listenerCount=function(emitter,type){var ret;if(!emitter._events||!emitter._events[type])
ret=0;else if(isFunction(emitter._events[type]))
ret=1;else
ret=emitter._events[type].length;return ret;};function isFunction(arg){return typeof arg==='function';}
function isNumber(arg){return typeof arg==='number';}
function isObject(arg){return typeof arg==='object'&&arg!==null;}
function isUndefined(arg){return arg===void 0;}},function(module,exports,__webpack_require__){module.exports=__webpack_require__(70)},function(module,exports,__webpack_require__){exports=module.exports=__webpack_require__(71);exports.Stream=__webpack_require__(46);exports.Readable=exports;exports.Writable=__webpack_require__(67);exports.Duplex=__webpack_require__(69);exports.Transform=__webpack_require__(70);exports.PassThrough=__webpack_require__(68);},function(module,exports,__webpack_require__){module.exports=__webpack_require__(67)},function(module,exports,__webpack_require__){module.exports=__webpack_require__(69)},function(module,exports,__webpack_require__){module.exports=__webpack_require__(68)},function(module,exports,__webpack_require__){(function(global,process){var formatRegExp=/%[sdj%]/g;exports.format=function(f){if(!isString(f)){var objects=[];for(var i=0;i<arguments.length;i++){objects.push(inspect(arguments[i]));}
return objects.join(' ');}
var i=1;var args=arguments;var len=args.length;var str=String(f).replace(formatRegExp,function(x){if(x==='%%')return'%';if(i>=len)return x;switch(x){case'%s':return String(args[i++]);case'%d':return Number(args[i++]);case'%j':try{return JSON.stringify(args[i++]);}catch(_){return'[Circular]';}
default:return x;}});for(var x=args[i];i<len;x=args[++i]){if(isNull(x)||!isObject(x)){str+=' '+x;}else{str+=' '+inspect(x);}}
return str;};exports.deprecate=function(fn,msg){if(isUndefined(global.process)){return function(){return exports.deprecate(fn,msg).apply(this,arguments);};}
if(process.noDeprecation===true){return fn;}
var warned=false;function deprecated(){if(!warned){if(process.throwDeprecation){throw new Error(msg);}else if(process.traceDeprecation){console.trace(msg);}else{console.error(msg);}
warned=true;}
return fn.apply(this,arguments);}
return deprecated;};var debugs={};var debugEnviron;exports.debuglog=function(set){if(isUndefined(debugEnviron))
debugEnviron=process.env.NODE_DEBUG||'';set=set.toUpperCase();if(!debugs[set]){if(new RegExp('\\b'+set+'\\b','i').test(debugEnviron)){var pid=process.pid;debugs[set]=function(){var msg=exports.format.apply(exports,arguments);console.error('%s %d: %s',set,pid,msg);};}else{debugs[set]=function(){};}}
return debugs[set];};function inspect(obj,opts){var ctx={seen:[],stylize:stylizeNoColor};if(arguments.length>=3)ctx.depth=arguments[2];if(arguments.length>=4)ctx.colors=arguments[3];if(isBoolean(opts)){ctx.showHidden=opts;}else if(opts){exports._extend(ctx,opts);}
if(isUndefined(ctx.showHidden))ctx.showHidden=false;if(isUndefined(ctx.depth))ctx.depth=2;if(isUndefined(ctx.colors))ctx.colors=false;if(isUndefined(ctx.customInspect))ctx.customInspect=true;if(ctx.colors)ctx.stylize=stylizeWithColor;return formatValue(ctx,obj,ctx.depth);}
exports.inspect=inspect;inspect.colors={'bold':[1,22],'italic':[3,23],'underline':[4,24],'inverse':[7,27],'white':[37,39],'grey':[90,39],'black':[30,39],'blue':[34,39],'cyan':[36,39],'green':[32,39],'magenta':[35,39],'red':[31,39],'yellow':[33,39]};inspect.styles={'special':'cyan','number':'yellow','boolean':'yellow','undefined':'grey','null':'bold','string':'green','date':'magenta','regexp':'red'};function stylizeWithColor(str,styleType){var style=inspect.styles[styleType];if(style){return'\u001b['+inspect.colors[style][0]+'m'+str+'\u001b['+inspect.colors[style][1]+'m';}else{return str;}}
function stylizeNoColor(str,styleType){return str;}
function arrayToHash(array){var hash={};array.forEach(function(val,idx){hash[val]=true;});return hash;}
function formatValue(ctx,value,recurseTimes){if(ctx.customInspect&&value&&isFunction(value.inspect)&&value.inspect!==exports.inspect&&!(value.constructor&&value.constructor.prototype===value)){var ret=value.inspect(recurseTimes,ctx);if(!isString(ret)){ret=formatValue(ctx,ret,recurseTimes);}
return ret;}
var primitive=formatPrimitive(ctx,value);if(primitive){return primitive;}
var keys=Object.keys(value);var visibleKeys=arrayToHash(keys);if(ctx.showHidden){keys=Object.getOwnPropertyNames(value);}
if(isError(value)&&(keys.indexOf('message')>=0||keys.indexOf('description')>=0)){return formatError(value);}
if(keys.length===0){if(isFunction(value)){var name=value.name?': '+value.name:'';return ctx.stylize('[Function'+name+']','special');}
if(isRegExp(value)){return ctx.stylize(RegExp.prototype.toString.call(value),'regexp');}
if(isDate(value)){return ctx.stylize(Date.prototype.toString.call(value),'date');}
if(isError(value)){return formatError(value);}}
var base='',array=false,braces=['{','}'];if(isArray(value)){array=true;braces=['[',']'];}
if(isFunction(value)){var n=value.name?': '+value.name:'';base=' [Function'+n+']';}
if(isRegExp(value)){base=' '+RegExp.prototype.toString.call(value);}
if(isDate(value)){base=' '+Date.prototype.toUTCString.call(value);}
if(isError(value)){base=' '+formatError(value);}
if(keys.length===0&&(!array||value.length==0)){return braces[0]+base+braces[1];}
if(recurseTimes<0){if(isRegExp(value)){return ctx.stylize(RegExp.prototype.toString.call(value),'regexp');}else{return ctx.stylize('[Object]','special');}}
ctx.seen.push(value);var output;if(array){output=formatArray(ctx,value,recurseTimes,visibleKeys,keys);}else{output=keys.map(function(key){return formatProperty(ctx,value,recurseTimes,visibleKeys,key,array);});}
ctx.seen.pop();return reduceToSingleString(output,base,braces);}
function formatPrimitive(ctx,value){if(isUndefined(value))
return ctx.stylize('undefined','undefined');if(isString(value)){var simple='\''+JSON.stringify(value).replace(/^"|"$/g,'').replace(/'/g,"\\'").replace(/\\"/g,'"')+'\'';return ctx.stylize(simple,'string');}
if(isNumber(value))
return ctx.stylize(''+value,'number');if(isBoolean(value))
return ctx.stylize(''+value,'boolean');if(isNull(value))
return ctx.stylize('null','null');}
function formatError(value){return'['+Error.prototype.toString.call(value)+']';}
function formatArray(ctx,value,recurseTimes,visibleKeys,keys){var output=[];for(var i=0,l=value.length;i<l;++i){if(hasOwnProperty(value,String(i))){output.push(formatProperty(ctx,value,recurseTimes,visibleKeys,String(i),true));}else{output.push('');}}
keys.forEach(function(key){if(!key.match(/^\d+$/)){output.push(formatProperty(ctx,value,recurseTimes,visibleKeys,key,true));}});return output;}
function formatProperty(ctx,value,recurseTimes,visibleKeys,key,array){var name,str,desc;desc=Object.getOwnPropertyDescriptor(value,key)||{value:value[key]};if(desc.get){if(desc.set){str=ctx.stylize('[Getter/Setter]','special');}else{str=ctx.stylize('[Getter]','special');}}else{if(desc.set){str=ctx.stylize('[Setter]','special');}}
if(!hasOwnProperty(visibleKeys,key)){name='['+key+']';}
if(!str){if(ctx.seen.indexOf(desc.value)<0){if(isNull(recurseTimes)){str=formatValue(ctx,desc.value,null);}else{str=formatValue(ctx,desc.value,recurseTimes-1);}
if(str.indexOf('\n')>-1){if(array){str=str.split('\n').map(function(line){return'  '+line;}).join('\n').substr(2);}else{str='\n'+str.split('\n').map(function(line){return'   '+line;}).join('\n');}}}else{str=ctx.stylize('[Circular]','special');}}
if(isUndefined(name)){if(array&&key.match(/^\d+$/)){return str;}
name=JSON.stringify(''+key);if(name.match(/^"([a-zA-Z_][a-zA-Z_0-9]*)"$/)){name=name.substr(1,name.length-2);name=ctx.stylize(name,'name');}else{name=name.replace(/'/g,"\\'").replace(/\\"/g,'"').replace(/(^"|"$)/g,"'");name=ctx.stylize(name,'string');}}
return name+': '+str;}
function reduceToSingleString(output,base,braces){var numLinesEst=0;var length=output.reduce(function(prev,cur){numLinesEst++;if(cur.indexOf('\n')>=0)numLinesEst++;return prev+cur.replace(/\u001b\[\d\d?m/g,'').length+1;},0);if(length>60){return braces[0]+(base===''?'':base+'\n ')+' '+output.join(',\n  ')+' '+braces[1];}
return braces[0]+base+' '+output.join(', ')+' '+braces[1];}
function isArray(ar){return Array.isArray(ar);}
exports.isArray=isArray;function isBoolean(arg){return typeof arg==='boolean';}
exports.isBoolean=isBoolean;function isNull(arg){return arg===null;}
exports.isNull=isNull;function isNullOrUndefined(arg){return arg==null;}
exports.isNullOrUndefined=isNullOrUndefined;function isNumber(arg){return typeof arg==='number';}
exports.isNumber=isNumber;function isString(arg){return typeof arg==='string';}
exports.isString=isString;function isSymbol(arg){return typeof arg==='symbol';}
exports.isSymbol=isSymbol;function isUndefined(arg){return arg===void 0;}
exports.isUndefined=isUndefined;function isRegExp(re){return isObject(re)&&objectToString(re)==='[object RegExp]';}
exports.isRegExp=isRegExp;function isObject(arg){return typeof arg==='object'&&arg!==null;}
exports.isObject=isObject;function isDate(d){return isObject(d)&&objectToString(d)==='[object Date]';}
exports.isDate=isDate;function isError(e){return isObject(e)&&(objectToString(e)==='[object Error]'||e instanceof Error);}
exports.isError=isError;function isFunction(arg){return typeof arg==='function';}
exports.isFunction=isFunction;function isPrimitive(arg){return arg===null||typeof arg==='boolean'||typeof arg==='number'||typeof arg==='string'||typeof arg==='symbol'||typeof arg==='undefined';}
exports.isPrimitive=isPrimitive;exports.isBuffer=__webpack_require__(72);function objectToString(o){return Object.prototype.toString.call(o);}
function pad(n){return n<10?'0'+n.toString(10):n.toString(10);}
var months=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];function timestamp(){var d=new Date();var time=[pad(d.getHours()),pad(d.getMinutes()),pad(d.getSeconds())].join(':');return[d.getDate(),months[d.getMonth()],time].join(' ');}
exports.log=function(){console.log('%s - %s',timestamp(),exports.format.apply(exports,arguments));};exports.inherits=__webpack_require__(94);exports._extend=function(origin,add){if(!add||!isObject(add))return origin;var keys=Object.keys(add);var i=keys.length;while(i--){origin[keys[i]]=add[keys[i]];}
return origin;};function hasOwnProperty(obj,prop){return Object.prototype.hasOwnProperty.call(obj,prop);}}.call(exports,(function(){return this;}()),__webpack_require__(61)))},function(module,exports,__webpack_require__){var process=module.exports={};var queue=[];var draining=false;function drainQueue(){if(draining){return;}
draining=true;var currentQueue;var len=queue.length;while(len){currentQueue=queue;queue=[];var i=-1;while(++i<len){currentQueue[i]();}
len=queue.length;}
draining=false;}
process.nextTick=function(fun){queue.push(fun);if(!draining){setTimeout(drainQueue,0);}};process.title='browser';process.browser=true;process.env={};process.argv=[];process.version='';process.versions={};function noop(){}
process.on=noop;process.addListener=noop;process.once=noop;process.off=noop;process.removeListener=noop;process.removeAllListeners=noop;process.emit=noop;process.binding=function(name){throw new Error('process.binding is not supported');};process.cwd=function(){return'/'};process.chdir=function(dir){throw new Error('process.chdir is not supported');};process.umask=function(){return 0;};},function(module,exports,__webpack_require__){if(typeof Object.create==='function'){module.exports=function inherits(ctor,superCtor){ctor.super_=superCtor
ctor.prototype=Object.create(superCtor.prototype,{constructor:{value:ctor,enumerable:false,writable:true,configurable:true}});};}else{module.exports=function inherits(ctor,superCtor){ctor.super_=superCtor
var TempCtor=function(){}
TempCtor.prototype=superCtor.prototype
ctor.prototype=new TempCtor()
ctor.prototype.constructor=ctor}}},function(module,exports,__webpack_require__){(function(){var AFMFont,fs;fs=__webpack_require__(10);AFMFont=(function(){var WIN_ANSI_MAP,characters;AFMFont.open=function(filename){return new AFMFont(fs.readFileSync(filename,'utf8'));};function AFMFont(contents){var e,i;this.contents=contents;this.attributes={};this.glyphWidths={};this.boundingBoxes={};this.parse();this.charWidths=(function(){var _i,_results;_results=[];for(i=_i=0;_i<=255;i=++_i){_results.push(this.glyphWidths[characters[i]]);}
return _results;}).call(this);this.bbox=(function(){var _i,_len,_ref,_results;_ref=this.attributes['FontBBox'].split(/\s+/);_results=[];for(_i=0,_len=_ref.length;_i<_len;_i++){e=_ref[_i];_results.push(+e);}
return _results;}).call(this);this.ascender=+(this.attributes['Ascender']||0);this.decender=+(this.attributes['Descender']||0);this.lineGap=(this.bbox[3]-this.bbox[1])-(this.ascender-this.decender);}
AFMFont.prototype.parse=function(){var a,key,line,match,name,section,value,_i,_len,_ref;section='';_ref=this.contents.split('\n');for(_i=0,_len=_ref.length;_i<_len;_i++){line=_ref[_i];if(match=line.match(/^Start(\w+)/)){section=match[1];continue;}else if(match=line.match(/^End(\w+)/)){section='';continue;}
switch(section){case'FontMetrics':match=line.match(/(^\w+)\s+(.*)/);key=match[1];value=match[2];if(a=this.attributes[key]){if(!Array.isArray(a)){a=this.attributes[key]=[a];}
a.push(value);}else{this.attributes[key]=value;}
break;case'CharMetrics':if(!/^CH?\s/.test(line)){continue;}
name=line.match(/\bN\s+(\.?\w+)\s*;/)[1];this.glyphWidths[name]=+line.match(/\bWX\s+(\d+)\s*;/)[1];}}};WIN_ANSI_MAP={402:131,8211:150,8212:151,8216:145,8217:146,8218:130,8220:147,8221:148,8222:132,8224:134,8225:135,8226:149,8230:133,8364:128,8240:137,8249:139,8250:155,710:136,8482:153,338:140,339:156,732:152,352:138,353:154,376:159,381:142,382:158};AFMFont.prototype.encodeText=function(text){var char,i,string,_i,_ref;string='';for(i=_i=0,_ref=text.length;0<=_ref?_i<_ref:_i>_ref;i=0<=_ref?++_i:--_i){char=text.charCodeAt(i);char=WIN_ANSI_MAP[char]||char;string+=String.fromCharCode(char);}
return string;};AFMFont.prototype.characterToGlyph=function(character){return characters[WIN_ANSI_MAP[character]||character];};AFMFont.prototype.widthOfGlyph=function(glyph){return this.glyphWidths[glyph];};characters='.notdef       .notdef        .notdef        .notdef\n.notdef       .notdef        .notdef        .notdef\n.notdef       .notdef        .notdef        .notdef\n.notdef       .notdef        .notdef        .notdef\n.notdef       .notdef        .notdef        .notdef\n.notdef       .notdef        .notdef        .notdef\n.notdef       .notdef        .notdef        .notdef\n.notdef       .notdef        .notdef        .notdef\n\nspace         exclam         quotedbl       numbersign\ndollar        percent        ampersand      quotesingle\nparenleft     parenright     asterisk       plus\ncomma         hyphen         period         slash\nzero          one            two            three\nfour          five           six            seven\neight         nine           colon          semicolon\nless          equal          greater        question\n\nat            A              B              C\nD             E              F              G\nH             I              J              K\nL             M              N              O\nP             Q              R              S\nT             U              V              W\nX             Y              Z              bracketleft\nbackslash     bracketright   asciicircum    underscore\n\ngrave         a              b              c\nd             e              f              g\nh             i              j              k\nl             m              n              o\np             q              r              s\nt             u              v              w\nx             y              z              braceleft\nbar           braceright     asciitilde     .notdef\n\nEuro          .notdef        quotesinglbase florin\nquotedblbase  ellipsis       dagger         daggerdbl\ncircumflex    perthousand    Scaron         guilsinglleft\nOE            .notdef        Zcaron         .notdef\n.notdef       quoteleft      quoteright     quotedblleft\nquotedblright bullet         endash         emdash\ntilde         trademark      scaron         guilsinglright\noe            .notdef        zcaron         ydieresis\n\nspace         exclamdown     cent           sterling\ncurrency      yen            brokenbar      section\ndieresis      copyright      ordfeminine    guillemotleft\nlogicalnot    hyphen         registered     macron\ndegree        plusminus      twosuperior    threesuperior\nacute         mu             paragraph      periodcentered\ncedilla       onesuperior    ordmasculine   guillemotright\nonequarter    onehalf        threequarters  questiondown\n\nAgrave        Aacute         Acircumflex    Atilde\nAdieresis     Aring          AE             Ccedilla\nEgrave        Eacute         Ecircumflex    Edieresis\nIgrave        Iacute         Icircumflex    Idieresis\nEth           Ntilde         Ograve         Oacute\nOcircumflex   Otilde         Odieresis      multiply\nOslash        Ugrave         Uacute         Ucircumflex\nUdieresis     Yacute         Thorn          germandbls\n\nagrave        aacute         acircumflex    atilde\nadieresis     aring          ae             ccedilla\negrave        eacute         ecircumflex    edieresis\nigrave        iacute         icircumflex    idieresis\neth           ntilde         ograve         oacute\nocircumflex   otilde         odieresis      divide\noslash        ugrave         uacute         ucircumflex\nudieresis     yacute         thorn          ydieresis'.split(/\s+/);return AFMFont;})();module.exports=AFMFont;}).call(this);},function(module,exports,__webpack_require__){(function(){var CmapTable,DFont,Data,Directory,GlyfTable,HeadTable,HheaTable,HmtxTable,LocaTable,MaxpTable,NameTable,OS2Table,PostTable,TTFFont,fs;fs=__webpack_require__(10);Data=__webpack_require__(34);DFont=__webpack_require__(78);Directory=__webpack_require__(79);NameTable=__webpack_require__(80);HeadTable=__webpack_require__(81);CmapTable=__webpack_require__(82);HmtxTable=__webpack_require__(83);HheaTable=__webpack_require__(84);MaxpTable=__webpack_require__(85);PostTable=__webpack_require__(86);OS2Table=__webpack_require__(87);LocaTable=__webpack_require__(88);GlyfTable=__webpack_require__(90);TTFFont=(function(){TTFFont.open=function(filename,name){var contents;contents=fs.readFileSync(filename);return new TTFFont(contents,name);};TTFFont.fromDFont=function(filename,family){var dfont;dfont=DFont.open(filename);return new TTFFont(dfont.getNamedFont(family));};TTFFont.fromBuffer=function(buffer,family){var dfont,e,ttf;try{ttf=new TTFFont(buffer,family);if(!(ttf.head.exists&&ttf.name.exists&&ttf.cmap.exists)){dfont=new DFont(buffer);ttf=new TTFFont(dfont.getNamedFont(family));if(!(ttf.head.exists&&ttf.name.exists&&ttf.cmap.exists)){throw new Error('Invalid TTF file in DFont');}}
return ttf;}catch(_error){e=_error;throw new Error('Unknown font format in buffer: '+e.message);}};function TTFFont(rawData,name){var data,i,numFonts,offset,offsets,version,_i,_j,_len;this.rawData=rawData;data=this.contents=new Data(this.rawData);if(data.readString(4)==='ttcf'){if(!name){throw new Error("Must specify a font name for TTC files.");}
version=data.readInt();numFonts=data.readInt();offsets=[];for(i=_i=0;0<=numFonts?_i<numFonts:_i>numFonts;i=0<=numFonts?++_i:--_i){offsets[i]=data.readInt();}
for(i=_j=0,_len=offsets.length;_j<_len;i=++_j){offset=offsets[i];data.pos=offset;this.parse();if(this.name.postscriptName===name){return;}}
throw new Error("Font "+name+" not found in TTC file.");}else{data.pos=0;this.parse();}}
TTFFont.prototype.parse=function(){this.directory=new Directory(this.contents);this.head=new HeadTable(this);this.name=new NameTable(this);this.cmap=new CmapTable(this);this.hhea=new HheaTable(this);this.maxp=new MaxpTable(this);this.hmtx=new HmtxTable(this);this.post=new PostTable(this);this.os2=new OS2Table(this);this.loca=new LocaTable(this);this.glyf=new GlyfTable(this);this.ascender=(this.os2.exists&&this.os2.ascender)||this.hhea.ascender;this.decender=(this.os2.exists&&this.os2.decender)||this.hhea.decender;this.lineGap=(this.os2.exists&&this.os2.lineGap)||this.hhea.lineGap;return this.bbox=[this.head.xMin,this.head.yMin,this.head.xMax,this.head.yMax];};TTFFont.prototype.characterToGlyph=function(character){var _ref;return((_ref=this.cmap.unicode)!=null?_ref.codeMap[character]:void 0)||0;};TTFFont.prototype.widthOfGlyph=function(glyph){var scale;scale=1000.0/this.head.unitsPerEm;return this.hmtx.forGlyph(glyph).advance*scale;};return TTFFont;})();module.exports=TTFFont;}).call(this);},function(module,exports,__webpack_require__){(function(){var CmapTable,Subset,utils,__indexOf=[].indexOf||function(item){for(var i=0,l=this.length;i<l;i++){if(i in this&&this[i]===item)return i;}return-1;};CmapTable=__webpack_require__(82);utils=__webpack_require__(89);Subset=(function(){function Subset(font){this.font=font;this.subset={};this.unicodes={};this.next=33;}
Subset.prototype.use=function(character){var i,_i,_ref;if(typeof character==='string'){for(i=_i=0,_ref=character.length;0<=_ref?_i<_ref:_i>_ref;i=0<=_ref?++_i:--_i){this.use(character.charCodeAt(i));}
return;}
if(!this.unicodes[character]){this.subset[this.next]=character;return this.unicodes[character]=this.next++;}};Subset.prototype.encodeText=function(text){var char,i,string,_i,_ref;string='';for(i=_i=0,_ref=text.length;0<=_ref?_i<_ref:_i>_ref;i=0<=_ref?++_i:--_i){char=this.unicodes[text.charCodeAt(i)];string+=String.fromCharCode(char);}
return string;};Subset.prototype.generateCmap=function(){var mapping,roman,unicode,unicodeCmap,_ref;unicodeCmap=this.font.cmap.tables[0].codeMap;mapping={};_ref=this.subset;for(roman in _ref){unicode=_ref[roman];mapping[roman]=unicodeCmap[unicode];}
return mapping;};Subset.prototype.glyphIDs=function(){var ret,roman,unicode,unicodeCmap,val,_ref;unicodeCmap=this.font.cmap.tables[0].codeMap;ret=[0];_ref=this.subset;for(roman in _ref){unicode=_ref[roman];val=unicodeCmap[unicode];if((val!=null)&&__indexOf.call(ret,val)<0){ret.push(val);}}
return ret.sort();};Subset.prototype.glyphsFor=function(glyphIDs){var additionalIDs,glyph,glyphs,id,_i,_len,_ref;glyphs={};for(_i=0,_len=glyphIDs.length;_i<_len;_i++){id=glyphIDs[_i];glyphs[id]=this.font.glyf.glyphFor(id);}
additionalIDs=[];for(id in glyphs){glyph=glyphs[id];if(glyph!=null?glyph.compound:void 0){additionalIDs.push.apply(additionalIDs,glyph.glyphIDs);}}
if(additionalIDs.length>0){_ref=this.glyphsFor(additionalIDs);for(id in _ref){glyph=_ref[id];glyphs[id]=glyph;}}
return glyphs;};Subset.prototype.encode=function(){var cmap,code,glyf,glyphs,id,ids,loca,name,new2old,newIDs,nextGlyphID,old2new,oldID,oldIDs,tables,_ref,_ref1;cmap=CmapTable.encode(this.generateCmap(),'unicode');glyphs=this.glyphsFor(this.glyphIDs());old2new={0:0};_ref=cmap.charMap;for(code in _ref){ids=_ref[code];old2new[ids.old]=ids["new"];}
nextGlyphID=cmap.maxGlyphID;for(oldID in glyphs){if(!(oldID in old2new)){old2new[oldID]=nextGlyphID++;}}
new2old=utils.invert(old2new);newIDs=Object.keys(new2old).sort(function(a,b){return a-b;});oldIDs=(function(){var _i,_len,_results;_results=[];for(_i=0,_len=newIDs.length;_i<_len;_i++){id=newIDs[_i];_results.push(new2old[id]);}
return _results;})();glyf=this.font.glyf.encode(glyphs,oldIDs,old2new);loca=this.font.loca.encode(glyf.offsets);name=this.font.name.encode();this.postscriptName=name.postscriptName;this.cmap={};_ref1=cmap.charMap;for(code in _ref1){ids=_ref1[code];this.cmap[code]=ids.old;}
tables={cmap:cmap.table,glyf:glyf.table,loca:loca.table,hmtx:this.font.hmtx.encode(oldIDs),hhea:this.font.hhea.encode(oldIDs),maxp:this.font.maxp.encode(oldIDs),post:this.font.post.encode(oldIDs),name:name.table,head:this.font.head.encode(loca)};if(this.font.os2.exists){tables['OS/2']=this.font.os2.raw();}
return this.font.directory.encode(tables);};return Subset;})();module.exports=Subset;}).call(this);},function(module,exports,__webpack_require__){(function(){var AI,AL,BA,BK,CB,CI_BRK,CJ,CP_BRK,CR,DI_BRK,ID,IN_BRK,LF,LineBreaker,NL,NS,PR_BRK,SA,SG,SP,UnicodeTrie,WJ,XX,characterClasses,classTrie,pairTable,_ref,_ref1;UnicodeTrie=__webpack_require__(100);classTrie=new UnicodeTrie(__webpack_require__(106));_ref=__webpack_require__(92),BK=_ref.BK,CR=_ref.CR,LF=_ref.LF,NL=_ref.NL,CB=_ref.CB,BA=_ref.BA,SP=_ref.SP,WJ=_ref.WJ,SP=_ref.SP,BK=_ref.BK,LF=_ref.LF,NL=_ref.NL,AI=_ref.AI,AL=_ref.AL,SA=_ref.SA,SG=_ref.SG,XX=_ref.XX,CJ=_ref.CJ,ID=_ref.ID,NS=_ref.NS,characterClasses=_ref.characterClasses;_ref1=__webpack_require__(91),DI_BRK=_ref1.DI_BRK,IN_BRK=_ref1.IN_BRK,CI_BRK=_ref1.CI_BRK,CP_BRK=_ref1.CP_BRK,PR_BRK=_ref1.PR_BRK,pairTable=_ref1.pairTable;LineBreaker=(function(){var Break,mapClass,mapFirst;function LineBreaker(string){this.string=string;this.pos=0;this.lastPos=0;this.curClass=null;this.nextClass=null;}
LineBreaker.prototype.nextCodePoint=function(){var code,next;code=this.string.charCodeAt(this.pos++);next=this.string.charCodeAt(this.pos);if((0xd800<=code&&code<=0xdbff)&&(0xdc00<=next&&next<=0xdfff)){this.pos++;return((code-0xd800)*0x400)+(next-0xdc00)+0x10000;}
return code;};mapClass=function(c){switch(c){case AI:return AL;case SA:case SG:case XX:return AL;case CJ:return NS;default:return c;}};mapFirst=function(c){switch(c){case LF:case NL:return BK;case CB:return BA;case SP:return WJ;default:return c;}};LineBreaker.prototype.nextCharClass=function(first){if(first==null){first=false;}
return mapClass(classTrie.get(this.nextCodePoint()));};Break=(function(){function Break(position,required){this.position=position;this.required=required!=null?required:false;}
return Break;})();LineBreaker.prototype.nextBreak=function(){var cur,lastClass,shouldBreak;if(this.curClass==null){this.curClass=mapFirst(this.nextCharClass());}
while(this.pos<this.string.length){this.lastPos=this.pos;lastClass=this.nextClass;this.nextClass=this.nextCharClass();if(this.curClass===BK||(this.curClass===CR&&this.nextClass!==LF)){this.curClass=mapFirst(mapClass(this.nextClass));return new Break(this.lastPos,true);}
cur=(function(){switch(this.nextClass){case SP:return this.curClass;case BK:case LF:case NL:return BK;case CR:return CR;case CB:return BA;}}).call(this);if(cur!=null){this.curClass=cur;if(this.nextClass===CB){return new Break(this.lastPos);}
continue;}
shouldBreak=false;switch(pairTable[this.curClass][this.nextClass]){case DI_BRK:shouldBreak=true;break;case IN_BRK:shouldBreak=lastClass===SP;break;case CI_BRK:shouldBreak=lastClass===SP;if(!shouldBreak){continue;}
break;case CP_BRK:if(lastClass!==SP){continue;}}
this.curClass=this.nextClass;if(shouldBreak){return new Break(this.lastPos);}}
if(this.pos>=this.string.length){if(this.lastPos<this.string.length){this.lastPos=this.string.length;return new Break(this.string.length);}else{return null;}}};return LineBreaker;})();module.exports=LineBreaker;}).call(this);},function(module,exports,__webpack_require__){(function(process){module.exports=Writable;var Buffer=__webpack_require__(4).Buffer;Writable.WritableState=WritableState;var util=__webpack_require__(105);util.inherits=__webpack_require__(104);var Stream=__webpack_require__(46);util.inherits(Writable,Stream);function WriteReq(chunk,encoding,cb){this.chunk=chunk;this.encoding=encoding;this.callback=cb;}
function WritableState(options,stream){var Duplex=__webpack_require__(69);options=options||{};var hwm=options.highWaterMark;var defaultHwm=options.objectMode?16:16*1024;this.highWaterMark=(hwm||hwm===0)?hwm:defaultHwm;this.objectMode=!!options.objectMode;if(stream instanceof Duplex)
this.objectMode=this.objectMode||!!options.writableObjectMode;this.highWaterMark=~~this.highWaterMark;this.needDrain=false;this.ending=false;this.ended=false;this.finished=false;var noDecode=options.decodeStrings===false;this.decodeStrings=!noDecode;this.defaultEncoding=options.defaultEncoding||'utf8';this.length=0;this.writing=false;this.corked=0;this.sync=true;this.bufferProcessing=false;this.onwrite=function(er){onwrite(stream,er);};this.writecb=null;this.writelen=0;this.buffer=[];this.pendingcb=0;this.prefinished=false;this.errorEmitted=false;}
function Writable(options){var Duplex=__webpack_require__(69);if(!(this instanceof Writable)&&!(this instanceof Duplex))
return new Writable(options);this._writableState=new WritableState(options,this);this.writable=true;Stream.call(this);}
Writable.prototype.pipe=function(){this.emit('error',new Error('Cannot pipe. Not readable.'));};function writeAfterEnd(stream,state,cb){var er=new Error('write after end');stream.emit('error',er);process.nextTick(function(){cb(er);});}
function validChunk(stream,state,chunk,cb){var valid=true;if(!util.isBuffer(chunk)&&!util.isString(chunk)&&!util.isNullOrUndefined(chunk)&&!state.objectMode){var er=new TypeError('Invalid non-string/buffer chunk');stream.emit('error',er);process.nextTick(function(){cb(er);});valid=false;}
return valid;}
Writable.prototype.write=function(chunk,encoding,cb){var state=this._writableState;var ret=false;if(util.isFunction(encoding)){cb=encoding;encoding=null;}
if(util.isBuffer(chunk))
encoding='buffer';else if(!encoding)
encoding=state.defaultEncoding;if(!util.isFunction(cb))
cb=function(){};if(state.ended)
writeAfterEnd(this,state,cb);else if(validChunk(this,state,chunk,cb)){state.pendingcb++;ret=writeOrBuffer(this,state,chunk,encoding,cb);}
return ret;};Writable.prototype.cork=function(){var state=this._writableState;state.corked++;};Writable.prototype.uncork=function(){var state=this._writableState;if(state.corked){state.corked--;if(!state.writing&&!state.corked&&!state.finished&&!state.bufferProcessing&&state.buffer.length)
clearBuffer(this,state);}};function decodeChunk(state,chunk,encoding){if(!state.objectMode&&state.decodeStrings!==false&&util.isString(chunk)){chunk=new Buffer(chunk,encoding);}
return chunk;}
function writeOrBuffer(stream,state,chunk,encoding,cb){chunk=decodeChunk(state,chunk,encoding);if(util.isBuffer(chunk))
encoding='buffer';var len=state.objectMode?1:chunk.length;state.length+=len;var ret=state.length<state.highWaterMark;if(!ret)
state.needDrain=true;if(state.writing||state.corked)
state.buffer.push(new WriteReq(chunk,encoding,cb));else
doWrite(stream,state,false,len,chunk,encoding,cb);return ret;}
function doWrite(stream,state,writev,len,chunk,encoding,cb){state.writelen=len;state.writecb=cb;state.writing=true;state.sync=true;if(writev)
stream._writev(chunk,state.onwrite);else
stream._write(chunk,encoding,state.onwrite);state.sync=false;}
function onwriteError(stream,state,sync,er,cb){if(sync)
process.nextTick(function(){state.pendingcb--;cb(er);});else{state.pendingcb--;cb(er);}
stream._writableState.errorEmitted=true;stream.emit('error',er);}
function onwriteStateUpdate(state){state.writing=false;state.writecb=null;state.length-=state.writelen;state.writelen=0;}
function onwrite(stream,er){var state=stream._writableState;var sync=state.sync;var cb=state.writecb;onwriteStateUpdate(state);if(er)
onwriteError(stream,state,sync,er,cb);else{var finished=needFinish(stream,state);if(!finished&&!state.corked&&!state.bufferProcessing&&state.buffer.length){clearBuffer(stream,state);}
if(sync){process.nextTick(function(){afterWrite(stream,state,finished,cb);});}else{afterWrite(stream,state,finished,cb);}}}
function afterWrite(stream,state,finished,cb){if(!finished)
onwriteDrain(stream,state);state.pendingcb--;cb();finishMaybe(stream,state);}
function onwriteDrain(stream,state){if(state.length===0&&state.needDrain){state.needDrain=false;stream.emit('drain');}}
function clearBuffer(stream,state){state.bufferProcessing=true;if(stream._writev&&state.buffer.length>1){var cbs=[];for(var c=0;c<state.buffer.length;c++)
cbs.push(state.buffer[c].callback);state.pendingcb++;doWrite(stream,state,true,state.length,state.buffer,'',function(err){for(var i=0;i<cbs.length;i++){state.pendingcb--;cbs[i](err);}});state.buffer=[];}else{for(var c=0;c<state.buffer.length;c++){var entry=state.buffer[c];var chunk=entry.chunk;var encoding=entry.encoding;var cb=entry.callback;var len=state.objectMode?1:chunk.length;doWrite(stream,state,false,len,chunk,encoding,cb);if(state.writing){c++;break;}}
if(c<state.buffer.length)
state.buffer=state.buffer.slice(c);else
state.buffer.length=0;}
state.bufferProcessing=false;}
Writable.prototype._write=function(chunk,encoding,cb){cb(new Error('not implemented'));};Writable.prototype._writev=null;Writable.prototype.end=function(chunk,encoding,cb){var state=this._writableState;if(util.isFunction(chunk)){cb=chunk;chunk=null;encoding=null;}else if(util.isFunction(encoding)){cb=encoding;encoding=null;}
if(!util.isNullOrUndefined(chunk))
this.write(chunk,encoding);if(state.corked){state.corked=1;this.uncork();}
if(!state.ending&&!state.finished)
endWritable(this,state,cb);};function needFinish(stream,state){return(state.ending&&state.length===0&&!state.finished&&!state.writing);}
function prefinish(stream,state){if(!state.prefinished){state.prefinished=true;stream.emit('prefinish');}}
function finishMaybe(stream,state){var need=needFinish(stream,state);if(need){if(state.pendingcb===0){prefinish(stream,state);state.finished=true;stream.emit('finish');}else
prefinish(stream,state);}
return need;}
function endWritable(stream,state,cb){state.ending=true;finishMaybe(stream,state);if(cb){if(state.finished)
process.nextTick(cb);else
stream.once('finish',cb);}
state.ended=true;}}.call(exports,__webpack_require__(61)))},function(module,exports,__webpack_require__){module.exports=PassThrough;var Transform=__webpack_require__(70);var util=__webpack_require__(105);util.inherits=__webpack_require__(104);util.inherits(PassThrough,Transform);function PassThrough(options){if(!(this instanceof PassThrough))
return new PassThrough(options);Transform.call(this,options);}
PassThrough.prototype._transform=function(chunk,encoding,cb){cb(null,chunk);};},function(module,exports,__webpack_require__){(function(process){module.exports=Duplex;var objectKeys=Object.keys||function(obj){var keys=[];for(var key in obj)keys.push(key);return keys;}
var util=__webpack_require__(105);util.inherits=__webpack_require__(104);var Readable=__webpack_require__(71);var Writable=__webpack_require__(67);util.inherits(Duplex,Readable);forEach(objectKeys(Writable.prototype),function(method){if(!Duplex.prototype[method])
Duplex.prototype[method]=Writable.prototype[method];});function Duplex(options){if(!(this instanceof Duplex))
return new Duplex(options);Readable.call(this,options);Writable.call(this,options);if(options&&options.readable===false)
this.readable=false;if(options&&options.writable===false)
this.writable=false;this.allowHalfOpen=true;if(options&&options.allowHalfOpen===false)
this.allowHalfOpen=false;this.once('end',onend);}
function onend(){if(this.allowHalfOpen||this._writableState.ended)
return;process.nextTick(this.end.bind(this));}
function forEach(xs,f){for(var i=0,l=xs.length;i<l;i++){f(xs[i],i);}}}.call(exports,__webpack_require__(61)))},function(module,exports,__webpack_require__){module.exports=Transform;var Duplex=__webpack_require__(69);var util=__webpack_require__(105);util.inherits=__webpack_require__(104);util.inherits(Transform,Duplex);function TransformState(options,stream){this.afterTransform=function(er,data){return afterTransform(stream,er,data);};this.needTransform=false;this.transforming=false;this.writecb=null;this.writechunk=null;}
function afterTransform(stream,er,data){var ts=stream._transformState;ts.transforming=false;var cb=ts.writecb;if(!cb)
return stream.emit('error',new Error('no writecb in Transform class'));ts.writechunk=null;ts.writecb=null;if(!util.isNullOrUndefined(data))
stream.push(data);if(cb)
cb(er);var rs=stream._readableState;rs.reading=false;if(rs.needReadable||rs.length<rs.highWaterMark){stream._read(rs.highWaterMark);}}
function Transform(options){if(!(this instanceof Transform))
return new Transform(options);Duplex.call(this,options);this._transformState=new TransformState(options,this);var stream=this;this._readableState.needReadable=true;this._readableState.sync=false;this.once('prefinish',function(){if(util.isFunction(this._flush))
this._flush(function(er){done(stream,er);});else
done(stream);});}
Transform.prototype.push=function(chunk,encoding){this._transformState.needTransform=false;return Duplex.prototype.push.call(this,chunk,encoding);};Transform.prototype._transform=function(chunk,encoding,cb){throw new Error('not implemented');};Transform.prototype._write=function(chunk,encoding,cb){var ts=this._transformState;ts.writecb=cb;ts.writechunk=chunk;ts.writeencoding=encoding;if(!ts.transforming){var rs=this._readableState;if(ts.needTransform||rs.needReadable||rs.length<rs.highWaterMark)
this._read(rs.highWaterMark);}};Transform.prototype._read=function(n){var ts=this._transformState;if(!util.isNull(ts.writechunk)&&ts.writecb&&!ts.transforming){ts.transforming=true;this._transform(ts.writechunk,ts.writeencoding,ts.afterTransform);}else{ts.needTransform=true;}};function done(stream,er){if(er)
return stream.emit('error',er);var ws=stream._writableState;var ts=stream._transformState;if(ws.length)
throw new Error('calling transform done when ws.length != 0');if(ts.transforming)
throw new Error('calling transform done when still transforming');return stream.push(null);}},function(module,exports,__webpack_require__){(function(process){module.exports=Readable;var isArray=__webpack_require__(107);var Buffer=__webpack_require__(4).Buffer;Readable.ReadableState=ReadableState;var EE=__webpack_require__(54).EventEmitter;if(!EE.listenerCount)EE.listenerCount=function(emitter,type){return emitter.listeners(type).length;};var Stream=__webpack_require__(46);var util=__webpack_require__(105);util.inherits=__webpack_require__(104);var StringDecoder;var debug=__webpack_require__(93);if(debug&&debug.debuglog){debug=debug.debuglog('stream');}else{debug=function(){};}
util.inherits(Readable,Stream);function ReadableState(options,stream){var Duplex=__webpack_require__(69);options=options||{};var hwm=options.highWaterMark;var defaultHwm=options.objectMode?16:16*1024;this.highWaterMark=(hwm||hwm===0)?hwm:defaultHwm;this.highWaterMark=~~this.highWaterMark;this.buffer=[];this.length=0;this.pipes=null;this.pipesCount=0;this.flowing=null;this.ended=false;this.endEmitted=false;this.reading=false;this.sync=true;this.needReadable=false;this.emittedReadable=false;this.readableListening=false;this.objectMode=!!options.objectMode;if(stream instanceof Duplex)
this.objectMode=this.objectMode||!!options.readableObjectMode;this.defaultEncoding=options.defaultEncoding||'utf8';this.ranOut=false;this.awaitDrain=0;this.readingMore=false;this.decoder=null;this.encoding=null;if(options.encoding){if(!StringDecoder)
StringDecoder=__webpack_require__(101).StringDecoder;this.decoder=new StringDecoder(options.encoding);this.encoding=options.encoding;}}
function Readable(options){var Duplex=__webpack_require__(69);if(!(this instanceof Readable))
return new Readable(options);this._readableState=new ReadableState(options,this);this.readable=true;Stream.call(this);}
Readable.prototype.push=function(chunk,encoding){var state=this._readableState;if(util.isString(chunk)&&!state.objectMode){encoding=encoding||state.defaultEncoding;if(encoding!==state.encoding){chunk=new Buffer(chunk,encoding);encoding='';}}
return readableAddChunk(this,state,chunk,encoding,false);};Readable.prototype.unshift=function(chunk){var state=this._readableState;return readableAddChunk(this,state,chunk,'',true);};function readableAddChunk(stream,state,chunk,encoding,addToFront){var er=chunkInvalid(state,chunk);if(er){stream.emit('error',er);}else if(util.isNullOrUndefined(chunk)){state.reading=false;if(!state.ended)
onEofChunk(stream,state);}else if(state.objectMode||chunk&&chunk.length>0){if(state.ended&&!addToFront){var e=new Error('stream.push() after EOF');stream.emit('error',e);}else if(state.endEmitted&&addToFront){var e=new Error('stream.unshift() after end event');stream.emit('error',e);}else{if(state.decoder&&!addToFront&&!encoding)
chunk=state.decoder.write(chunk);if(!addToFront)
state.reading=false;if(state.flowing&&state.length===0&&!state.sync){stream.emit('data',chunk);stream.read(0);}else{state.length+=state.objectMode?1:chunk.length;if(addToFront)
state.buffer.unshift(chunk);else
state.buffer.push(chunk);if(state.needReadable)
emitReadable(stream);}
maybeReadMore(stream,state);}}else if(!addToFront){state.reading=false;}
return needMoreData(state);}
function needMoreData(state){return!state.ended&&(state.needReadable||state.length<state.highWaterMark||state.length===0);}
Readable.prototype.setEncoding=function(enc){if(!StringDecoder)
StringDecoder=__webpack_require__(101).StringDecoder;this._readableState.decoder=new StringDecoder(enc);this._readableState.encoding=enc;return this;};var MAX_HWM=0x800000;function roundUpToNextPowerOf2(n){if(n>=MAX_HWM){n=MAX_HWM;}else{n--;for(var p=1;p<32;p<<=1)n|=n>>p;n++;}
return n;}
function howMuchToRead(n,state){if(state.length===0&&state.ended)
return 0;if(state.objectMode)
return n===0?0:1;if(isNaN(n)||util.isNull(n)){if(state.flowing&&state.buffer.length)
return state.buffer[0].length;else
return state.length;}
if(n<=0)
return 0;if(n>state.highWaterMark)
state.highWaterMark=roundUpToNextPowerOf2(n);if(n>state.length){if(!state.ended){state.needReadable=true;return 0;}else
return state.length;}
return n;}
Readable.prototype.read=function(n){debug('read',n);var state=this._readableState;var nOrig=n;if(!util.isNumber(n)||n>0)
state.emittedReadable=false;if(n===0&&state.needReadable&&(state.length>=state.highWaterMark||state.ended)){debug('read: emitReadable',state.length,state.ended);if(state.length===0&&state.ended)
endReadable(this);else
emitReadable(this);return null;}
n=howMuchToRead(n,state);if(n===0&&state.ended){if(state.length===0)
endReadable(this);return null;}
var doRead=state.needReadable;debug('need readable',doRead);if(state.length===0||state.length-n<state.highWaterMark){doRead=true;debug('length less than watermark',doRead);}
if(state.ended||state.reading){doRead=false;debug('reading or ended',doRead);}
if(doRead){debug('do read');state.reading=true;state.sync=true;if(state.length===0)
state.needReadable=true;this._read(state.highWaterMark);state.sync=false;}
if(doRead&&!state.reading)
n=howMuchToRead(nOrig,state);var ret;if(n>0)
ret=fromList(n,state);else
ret=null;if(util.isNull(ret)){state.needReadable=true;n=0;}
state.length-=n;if(state.length===0&&!state.ended)
state.needReadable=true;if(nOrig!==n&&state.ended&&state.length===0)
endReadable(this);if(!util.isNull(ret))
this.emit('data',ret);return ret;};function chunkInvalid(state,chunk){var er=null;if(!util.isBuffer(chunk)&&!util.isString(chunk)&&!util.isNullOrUndefined(chunk)&&!state.objectMode){er=new TypeError('Invalid non-string/buffer chunk');}
return er;}
function onEofChunk(stream,state){if(state.decoder&&!state.ended){var chunk=state.decoder.end();if(chunk&&chunk.length){state.buffer.push(chunk);state.length+=state.objectMode?1:chunk.length;}}
state.ended=true;emitReadable(stream);}
function emitReadable(stream){var state=stream._readableState;state.needReadable=false;if(!state.emittedReadable){debug('emitReadable',state.flowing);state.emittedReadable=true;if(state.sync)
process.nextTick(function(){emitReadable_(stream);});else
emitReadable_(stream);}}
function emitReadable_(stream){debug('emit readable');stream.emit('readable');flow(stream);}
function maybeReadMore(stream,state){if(!state.readingMore){state.readingMore=true;process.nextTick(function(){maybeReadMore_(stream,state);});}}
function maybeReadMore_(stream,state){var len=state.length;while(!state.reading&&!state.flowing&&!state.ended&&state.length<state.highWaterMark){debug('maybeReadMore read 0');stream.read(0);if(len===state.length)
break;else
len=state.length;}
state.readingMore=false;}
Readable.prototype._read=function(n){this.emit('error',new Error('not implemented'));};Readable.prototype.pipe=function(dest,pipeOpts){var src=this;var state=this._readableState;switch(state.pipesCount){case 0:state.pipes=dest;break;case 1:state.pipes=[state.pipes,dest];break;default:state.pipes.push(dest);break;}
state.pipesCount+=1;debug('pipe count=%d opts=%j',state.pipesCount,pipeOpts);var doEnd=(!pipeOpts||pipeOpts.end!==false)&&dest!==process.stdout&&dest!==process.stderr;var endFn=doEnd?onend:cleanup;if(state.endEmitted)
process.nextTick(endFn);else
src.once('end',endFn);dest.on('unpipe',onunpipe);function onunpipe(readable){debug('onunpipe');if(readable===src){cleanup();}}
function onend(){debug('onend');dest.end();}
var ondrain=pipeOnDrain(src);dest.on('drain',ondrain);function cleanup(){debug('cleanup');dest.removeListener('close',onclose);dest.removeListener('finish',onfinish);dest.removeListener('drain',ondrain);dest.removeListener('error',onerror);dest.removeListener('unpipe',onunpipe);src.removeListener('end',onend);src.removeListener('end',cleanup);src.removeListener('data',ondata);if(state.awaitDrain&&(!dest._writableState||dest._writableState.needDrain))
ondrain();}
src.on('data',ondata);function ondata(chunk){debug('ondata');var ret=dest.write(chunk);if(false===ret){debug('false write response, pause',src._readableState.awaitDrain);src._readableState.awaitDrain++;src.pause();}}
function onerror(er){debug('onerror',er);unpipe();dest.removeListener('error',onerror);if(EE.listenerCount(dest,'error')===0)
dest.emit('error',er);}
if(!dest._events||!dest._events.error)
dest.on('error',onerror);else if(isArray(dest._events.error))
dest._events.error.unshift(onerror);else
dest._events.error=[onerror,dest._events.error];function onclose(){dest.removeListener('finish',onfinish);unpipe();}
dest.once('close',onclose);function onfinish(){debug('onfinish');dest.removeListener('close',onclose);unpipe();}
dest.once('finish',onfinish);function unpipe(){debug('unpipe');src.unpipe(dest);}
dest.emit('pipe',src);if(!state.flowing){debug('pipe resume');src.resume();}
return dest;};function pipeOnDrain(src){return function(){var state=src._readableState;debug('pipeOnDrain',state.awaitDrain);if(state.awaitDrain)
state.awaitDrain--;if(state.awaitDrain===0&&EE.listenerCount(src,'data')){state.flowing=true;flow(src);}};}
Readable.prototype.unpipe=function(dest){var state=this._readableState;if(state.pipesCount===0)
return this;if(state.pipesCount===1){if(dest&&dest!==state.pipes)
return this;if(!dest)
dest=state.pipes;state.pipes=null;state.pipesCount=0;state.flowing=false;if(dest)
dest.emit('unpipe',this);return this;}
if(!dest){var dests=state.pipes;var len=state.pipesCount;state.pipes=null;state.pipesCount=0;state.flowing=false;for(var i=0;i<len;i++)
dests[i].emit('unpipe',this);return this;}
var i=indexOf(state.pipes,dest);if(i===-1)
return this;state.pipes.splice(i,1);state.pipesCount-=1;if(state.pipesCount===1)
state.pipes=state.pipes[0];dest.emit('unpipe',this);return this;};Readable.prototype.on=function(ev,fn){var res=Stream.prototype.on.call(this,ev,fn);if(ev==='data'&&false!==this._readableState.flowing){this.resume();}
if(ev==='readable'&&this.readable){var state=this._readableState;if(!state.readableListening){state.readableListening=true;state.emittedReadable=false;state.needReadable=true;if(!state.reading){var self=this;process.nextTick(function(){debug('readable nexttick read 0');self.read(0);});}else if(state.length){emitReadable(this,state);}}}
return res;};Readable.prototype.addListener=Readable.prototype.on;Readable.prototype.resume=function(){var state=this._readableState;if(!state.flowing){debug('resume');state.flowing=true;if(!state.reading){debug('resume read 0');this.read(0);}
resume(this,state);}
return this;};function resume(stream,state){if(!state.resumeScheduled){state.resumeScheduled=true;process.nextTick(function(){resume_(stream,state);});}}
function resume_(stream,state){state.resumeScheduled=false;stream.emit('resume');flow(stream);if(state.flowing&&!state.reading)
stream.read(0);}
Readable.prototype.pause=function(){debug('call pause flowing=%j',this._readableState.flowing);if(false!==this._readableState.flowing){debug('pause');this._readableState.flowing=false;this.emit('pause');}
return this;};function flow(stream){var state=stream._readableState;debug('flow',state.flowing);if(state.flowing){do{var chunk=stream.read();}while(null!==chunk&&state.flowing);}}
Readable.prototype.wrap=function(stream){var state=this._readableState;var paused=false;var self=this;stream.on('end',function(){debug('wrapped end');if(state.decoder&&!state.ended){var chunk=state.decoder.end();if(chunk&&chunk.length)
self.push(chunk);}
self.push(null);});stream.on('data',function(chunk){debug('wrapped data');if(state.decoder)
chunk=state.decoder.write(chunk);if(!chunk||!state.objectMode&&!chunk.length)
return;var ret=self.push(chunk);if(!ret){paused=true;stream.pause();}});for(var i in stream){if(util.isFunction(stream[i])&&util.isUndefined(this[i])){this[i]=function(method){return function(){return stream[method].apply(stream,arguments);}}(i);}}
var events=['error','close','destroy','pause','resume'];forEach(events,function(ev){stream.on(ev,self.emit.bind(self,ev));});self._read=function(n){debug('wrapped _read',n);if(paused){paused=false;stream.resume();}};return self;};Readable._fromList=fromList;function fromList(n,state){var list=state.buffer;var length=state.length;var stringMode=!!state.decoder;var objectMode=!!state.objectMode;var ret;if(list.length===0)
return null;if(length===0)
ret=null;else if(objectMode)
ret=list.shift();else if(!n||n>=length){if(stringMode)
ret=list.join('');else
ret=Buffer.concat(list,length);list.length=0;}else{if(n<list[0].length){var buf=list[0];ret=buf.slice(0,n);list[0]=buf.slice(n);}else if(n===list[0].length){ret=list.shift();}else{if(stringMode)
ret='';else
ret=new Buffer(n);var c=0;for(var i=0,l=list.length;i<l&&c<n;i++){var buf=list[0];var cpy=Math.min(n-c,buf.length);if(stringMode)
ret+=buf.slice(0,cpy);else
buf.copy(ret,c,0,cpy);if(cpy<buf.length)
list[0]=buf.slice(cpy);else
list.shift();c+=cpy;}}}
return ret;}
function endReadable(stream){var state=stream._readableState;if(state.length>0)
throw new Error('endReadable called on non-empty stream');if(!state.endEmitted){state.ended=true;process.nextTick(function(){if(!state.endEmitted&&state.length===0){state.endEmitted=true;stream.readable=false;stream.emit('end');}});}}
function forEach(xs,f){for(var i=0,l=xs.length;i<l;i++){f(xs[i],i);}}
function indexOf(xs,x){for(var i=0,l=xs.length;i<l;i++){if(xs[i]===x)return i;}
return-1;}}.call(exports,__webpack_require__(61)))},function(module,exports,__webpack_require__){module.exports=function isBuffer(arg){return arg&&typeof arg==='object'&&typeof arg.copy==='function'&&typeof arg.fill==='function'&&typeof arg.readUInt8==='function';}},function(module,exports,__webpack_require__){'use strict';module.exports={'2':'need dictionary','1':'stream end','0':'','-1':'file error','-2':'stream error','-3':'data error','-4':'insufficient memory','-5':'buffer error','-6':'incompatible version'};},function(module,exports,__webpack_require__){'use strict';var utils=__webpack_require__(98);var trees=__webpack_require__(95);var adler32=__webpack_require__(96);var crc32=__webpack_require__(97);var msg=__webpack_require__(73);var Z_NO_FLUSH=0;var Z_PARTIAL_FLUSH=1;var Z_FULL_FLUSH=3;var Z_FINISH=4;var Z_BLOCK=5;var Z_OK=0;var Z_STREAM_END=1;var Z_STREAM_ERROR=-2;var Z_DATA_ERROR=-3;var Z_BUF_ERROR=-5;var Z_DEFAULT_COMPRESSION=-1;var Z_FILTERED=1;var Z_HUFFMAN_ONLY=2;var Z_RLE=3;var Z_FIXED=4;var Z_DEFAULT_STRATEGY=0;var Z_UNKNOWN=2;var Z_DEFLATED=8;var MAX_MEM_LEVEL=9;var MAX_WBITS=15;var DEF_MEM_LEVEL=8;var LENGTH_CODES=29;var LITERALS=256;var L_CODES=LITERALS+1+LENGTH_CODES;var D_CODES=30;var BL_CODES=19;var HEAP_SIZE=2*L_CODES+1;var MAX_BITS=15;var MIN_MATCH=3;var MAX_MATCH=258;var MIN_LOOKAHEAD=(MAX_MATCH+MIN_MATCH+1);var PRESET_DICT=0x20;var INIT_STATE=42;var EXTRA_STATE=69;var NAME_STATE=73;var COMMENT_STATE=91;var HCRC_STATE=103;var BUSY_STATE=113;var FINISH_STATE=666;var BS_NEED_MORE=1;var BS_BLOCK_DONE=2;var BS_FINISH_STARTED=3;var BS_FINISH_DONE=4;var OS_CODE=0x03;function err(strm,errorCode){strm.msg=msg[errorCode];return errorCode;}
function rank(f){return((f)<<1)-((f)>4?9:0);}
function zero(buf){var len=buf.length;while(--len>=0){buf[len]=0;}}
function flush_pending(strm){var s=strm.state;var len=s.pending;if(len>strm.avail_out){len=strm.avail_out;}
if(len===0){return;}
utils.arraySet(strm.output,s.pending_buf,s.pending_out,len,strm.next_out);strm.next_out+=len;s.pending_out+=len;strm.total_out+=len;strm.avail_out-=len;s.pending-=len;if(s.pending===0){s.pending_out=0;}}
function flush_block_only(s,last){trees._tr_flush_block(s,(s.block_start>=0?s.block_start:-1),s.strstart-s.block_start,last);s.block_start=s.strstart;flush_pending(s.strm);}
function put_byte(s,b){s.pending_buf[s.pending++]=b;}
function putShortMSB(s,b){s.pending_buf[s.pending++]=(b>>>8)&0xff;s.pending_buf[s.pending++]=b&0xff;}
function read_buf(strm,buf,start,size){var len=strm.avail_in;if(len>size){len=size;}
if(len===0){return 0;}
strm.avail_in-=len;utils.arraySet(buf,strm.input,strm.next_in,len,start);if(strm.state.wrap===1){strm.adler=adler32(strm.adler,buf,len,start);}
else if(strm.state.wrap===2){strm.adler=crc32(strm.adler,buf,len,start);}
strm.next_in+=len;strm.total_in+=len;return len;}
function longest_match(s,cur_match){var chain_length=s.max_chain_length;var scan=s.strstart;var match;var len;var best_len=s.prev_length;var nice_match=s.nice_match;var limit=(s.strstart>(s.w_size-MIN_LOOKAHEAD))?s.strstart-(s.w_size-MIN_LOOKAHEAD):0;var _win=s.window;var wmask=s.w_mask;var prev=s.prev;var strend=s.strstart+MAX_MATCH;var scan_end1=_win[scan+best_len-1];var scan_end=_win[scan+best_len];if(s.prev_length>=s.good_match){chain_length>>=2;}
if(nice_match>s.lookahead){nice_match=s.lookahead;}
do{match=cur_match;if(_win[match+best_len]!==scan_end||_win[match+best_len-1]!==scan_end1||_win[match]!==_win[scan]||_win[++match]!==_win[scan+1]){continue;}
scan+=2;match++;do{}while(_win[++scan]===_win[++match]&&_win[++scan]===_win[++match]&&_win[++scan]===_win[++match]&&_win[++scan]===_win[++match]&&_win[++scan]===_win[++match]&&_win[++scan]===_win[++match]&&_win[++scan]===_win[++match]&&_win[++scan]===_win[++match]&&scan<strend);len=MAX_MATCH-(strend-scan);scan=strend-MAX_MATCH;if(len>best_len){s.match_start=cur_match;best_len=len;if(len>=nice_match){break;}
scan_end1=_win[scan+best_len-1];scan_end=_win[scan+best_len];}}while((cur_match=prev[cur_match&wmask])>limit&&--chain_length!==0);if(best_len<=s.lookahead){return best_len;}
return s.lookahead;}
function fill_window(s){var _w_size=s.w_size;var p,n,m,more,str;do{more=s.window_size-s.lookahead-s.strstart;if(s.strstart>=_w_size+(_w_size-MIN_LOOKAHEAD)){utils.arraySet(s.window,s.window,_w_size,_w_size,0);s.match_start-=_w_size;s.strstart-=_w_size;s.block_start-=_w_size;n=s.hash_size;p=n;do{m=s.head[--p];s.head[p]=(m>=_w_size?m-_w_size:0);}while(--n);n=_w_size;p=n;do{m=s.prev[--p];s.prev[p]=(m>=_w_size?m-_w_size:0);}while(--n);more+=_w_size;}
if(s.strm.avail_in===0){break;}
n=read_buf(s.strm,s.window,s.strstart+s.lookahead,more);s.lookahead+=n;if(s.lookahead+s.insert>=MIN_MATCH){str=s.strstart-s.insert;s.ins_h=s.window[str];s.ins_h=((s.ins_h<<s.hash_shift)^s.window[str+1])&s.hash_mask;while(s.insert){s.ins_h=((s.ins_h<<s.hash_shift)^s.window[str+MIN_MATCH-1])&s.hash_mask;s.prev[str&s.w_mask]=s.head[s.ins_h];s.head[s.ins_h]=str;str++;s.insert--;if(s.lookahead+s.insert<MIN_MATCH){break;}}}}while(s.lookahead<MIN_LOOKAHEAD&&s.strm.avail_in!==0);}
function deflate_stored(s,flush){var max_block_size=0xffff;if(max_block_size>s.pending_buf_size-5){max_block_size=s.pending_buf_size-5;}
for(;;){if(s.lookahead<=1){fill_window(s);if(s.lookahead===0&&flush===Z_NO_FLUSH){return BS_NEED_MORE;}
if(s.lookahead===0){break;}}
s.strstart+=s.lookahead;s.lookahead=0;var max_start=s.block_start+max_block_size;if(s.strstart===0||s.strstart>=max_start){s.lookahead=s.strstart-max_start;s.strstart=max_start;flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}
if(s.strstart-s.block_start>=(s.w_size-MIN_LOOKAHEAD)){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}}
s.insert=0;if(flush===Z_FINISH){flush_block_only(s,true);if(s.strm.avail_out===0){return BS_FINISH_STARTED;}
return BS_FINISH_DONE;}
if(s.strstart>s.block_start){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}
return BS_NEED_MORE;}
function deflate_fast(s,flush){var hash_head;var bflush;for(;;){if(s.lookahead<MIN_LOOKAHEAD){fill_window(s);if(s.lookahead<MIN_LOOKAHEAD&&flush===Z_NO_FLUSH){return BS_NEED_MORE;}
if(s.lookahead===0){break;}}
hash_head=0;if(s.lookahead>=MIN_MATCH){s.ins_h=((s.ins_h<<s.hash_shift)^s.window[s.strstart+MIN_MATCH-1])&s.hash_mask;hash_head=s.prev[s.strstart&s.w_mask]=s.head[s.ins_h];s.head[s.ins_h]=s.strstart;}
if(hash_head!==0&&((s.strstart-hash_head)<=(s.w_size-MIN_LOOKAHEAD))){s.match_length=longest_match(s,hash_head);}
if(s.match_length>=MIN_MATCH){bflush=trees._tr_tally(s,s.strstart-s.match_start,s.match_length-MIN_MATCH);s.lookahead-=s.match_length;if(s.match_length<=s.max_lazy_match&&s.lookahead>=MIN_MATCH){s.match_length--;do{s.strstart++;s.ins_h=((s.ins_h<<s.hash_shift)^s.window[s.strstart+MIN_MATCH-1])&s.hash_mask;hash_head=s.prev[s.strstart&s.w_mask]=s.head[s.ins_h];s.head[s.ins_h]=s.strstart;}while(--s.match_length!==0);s.strstart++;}else
{s.strstart+=s.match_length;s.match_length=0;s.ins_h=s.window[s.strstart];s.ins_h=((s.ins_h<<s.hash_shift)^s.window[s.strstart+1])&s.hash_mask;}}else{bflush=trees._tr_tally(s,0,s.window[s.strstart]);s.lookahead--;s.strstart++;}
if(bflush){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}}
s.insert=((s.strstart<(MIN_MATCH-1))?s.strstart:MIN_MATCH-1);if(flush===Z_FINISH){flush_block_only(s,true);if(s.strm.avail_out===0){return BS_FINISH_STARTED;}
return BS_FINISH_DONE;}
if(s.last_lit){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}
return BS_BLOCK_DONE;}
function deflate_slow(s,flush){var hash_head;var bflush;var max_insert;for(;;){if(s.lookahead<MIN_LOOKAHEAD){fill_window(s);if(s.lookahead<MIN_LOOKAHEAD&&flush===Z_NO_FLUSH){return BS_NEED_MORE;}
if(s.lookahead===0){break;}}
hash_head=0;if(s.lookahead>=MIN_MATCH){s.ins_h=((s.ins_h<<s.hash_shift)^s.window[s.strstart+MIN_MATCH-1])&s.hash_mask;hash_head=s.prev[s.strstart&s.w_mask]=s.head[s.ins_h];s.head[s.ins_h]=s.strstart;}
s.prev_length=s.match_length;s.prev_match=s.match_start;s.match_length=MIN_MATCH-1;if(hash_head!==0&&s.prev_length<s.max_lazy_match&&s.strstart-hash_head<=(s.w_size-MIN_LOOKAHEAD)){s.match_length=longest_match(s,hash_head);if(s.match_length<=5&&(s.strategy===Z_FILTERED||(s.match_length===MIN_MATCH&&s.strstart-s.match_start>4096))){s.match_length=MIN_MATCH-1;}}
if(s.prev_length>=MIN_MATCH&&s.match_length<=s.prev_length){max_insert=s.strstart+s.lookahead-MIN_MATCH;bflush=trees._tr_tally(s,s.strstart-1-s.prev_match,s.prev_length-MIN_MATCH);s.lookahead-=s.prev_length-1;s.prev_length-=2;do{if(++s.strstart<=max_insert){s.ins_h=((s.ins_h<<s.hash_shift)^s.window[s.strstart+MIN_MATCH-1])&s.hash_mask;hash_head=s.prev[s.strstart&s.w_mask]=s.head[s.ins_h];s.head[s.ins_h]=s.strstart;}}while(--s.prev_length!==0);s.match_available=0;s.match_length=MIN_MATCH-1;s.strstart++;if(bflush){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}}else if(s.match_available){bflush=trees._tr_tally(s,0,s.window[s.strstart-1]);if(bflush){flush_block_only(s,false);}
s.strstart++;s.lookahead--;if(s.strm.avail_out===0){return BS_NEED_MORE;}}else{s.match_available=1;s.strstart++;s.lookahead--;}}
if(s.match_available){bflush=trees._tr_tally(s,0,s.window[s.strstart-1]);s.match_available=0;}
s.insert=s.strstart<MIN_MATCH-1?s.strstart:MIN_MATCH-1;if(flush===Z_FINISH){flush_block_only(s,true);if(s.strm.avail_out===0){return BS_FINISH_STARTED;}
return BS_FINISH_DONE;}
if(s.last_lit){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}
return BS_BLOCK_DONE;}
function deflate_rle(s,flush){var bflush;var prev;var scan,strend;var _win=s.window;for(;;){if(s.lookahead<=MAX_MATCH){fill_window(s);if(s.lookahead<=MAX_MATCH&&flush===Z_NO_FLUSH){return BS_NEED_MORE;}
if(s.lookahead===0){break;}}
s.match_length=0;if(s.lookahead>=MIN_MATCH&&s.strstart>0){scan=s.strstart-1;prev=_win[scan];if(prev===_win[++scan]&&prev===_win[++scan]&&prev===_win[++scan]){strend=s.strstart+MAX_MATCH;do{}while(prev===_win[++scan]&&prev===_win[++scan]&&prev===_win[++scan]&&prev===_win[++scan]&&prev===_win[++scan]&&prev===_win[++scan]&&prev===_win[++scan]&&prev===_win[++scan]&&scan<strend);s.match_length=MAX_MATCH-(strend-scan);if(s.match_length>s.lookahead){s.match_length=s.lookahead;}}}
if(s.match_length>=MIN_MATCH){bflush=trees._tr_tally(s,1,s.match_length-MIN_MATCH);s.lookahead-=s.match_length;s.strstart+=s.match_length;s.match_length=0;}else{bflush=trees._tr_tally(s,0,s.window[s.strstart]);s.lookahead--;s.strstart++;}
if(bflush){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}}
s.insert=0;if(flush===Z_FINISH){flush_block_only(s,true);if(s.strm.avail_out===0){return BS_FINISH_STARTED;}
return BS_FINISH_DONE;}
if(s.last_lit){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}
return BS_BLOCK_DONE;}
function deflate_huff(s,flush){var bflush;for(;;){if(s.lookahead===0){fill_window(s);if(s.lookahead===0){if(flush===Z_NO_FLUSH){return BS_NEED_MORE;}
break;}}
s.match_length=0;bflush=trees._tr_tally(s,0,s.window[s.strstart]);s.lookahead--;s.strstart++;if(bflush){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}}
s.insert=0;if(flush===Z_FINISH){flush_block_only(s,true);if(s.strm.avail_out===0){return BS_FINISH_STARTED;}
return BS_FINISH_DONE;}
if(s.last_lit){flush_block_only(s,false);if(s.strm.avail_out===0){return BS_NEED_MORE;}}
return BS_BLOCK_DONE;}
var Config=function(good_length,max_lazy,nice_length,max_chain,func){this.good_length=good_length;this.max_lazy=max_lazy;this.nice_length=nice_length;this.max_chain=max_chain;this.func=func;};var configuration_table;configuration_table=[new Config(0,0,0,0,deflate_stored),new Config(4,4,8,4,deflate_fast),new Config(4,5,16,8,deflate_fast),new Config(4,6,32,32,deflate_fast),new Config(4,4,16,16,deflate_slow),new Config(8,16,32,32,deflate_slow),new Config(8,16,128,128,deflate_slow),new Config(8,32,128,256,deflate_slow),new Config(32,128,258,1024,deflate_slow),new Config(32,258,258,4096,deflate_slow)];function lm_init(s){s.window_size=2*s.w_size;zero(s.head);s.max_lazy_match=configuration_table[s.level].max_lazy;s.good_match=configuration_table[s.level].good_length;s.nice_match=configuration_table[s.level].nice_length;s.max_chain_length=configuration_table[s.level].max_chain;s.strstart=0;s.block_start=0;s.lookahead=0;s.insert=0;s.match_length=s.prev_length=MIN_MATCH-1;s.match_available=0;s.ins_h=0;}
function DeflateState(){this.strm=null;this.status=0;this.pending_buf=null;this.pending_buf_size=0;this.pending_out=0;this.pending=0;this.wrap=0;this.gzhead=null;this.gzindex=0;this.method=Z_DEFLATED;this.last_flush=-1;this.w_size=0;this.w_bits=0;this.w_mask=0;this.window=null;this.window_size=0;this.prev=null;this.head=null;this.ins_h=0;this.hash_size=0;this.hash_bits=0;this.hash_mask=0;this.hash_shift=0;this.block_start=0;this.match_length=0;this.prev_match=0;this.match_available=0;this.strstart=0;this.match_start=0;this.lookahead=0;this.prev_length=0;this.max_chain_length=0;this.max_lazy_match=0;this.level=0;this.strategy=0;this.good_match=0;this.nice_match=0;this.dyn_ltree=new utils.Buf16(HEAP_SIZE*2);this.dyn_dtree=new utils.Buf16((2*D_CODES+1)*2);this.bl_tree=new utils.Buf16((2*BL_CODES+1)*2);zero(this.dyn_ltree);zero(this.dyn_dtree);zero(this.bl_tree);this.l_desc=null;this.d_desc=null;this.bl_desc=null;this.bl_count=new utils.Buf16(MAX_BITS+1);this.heap=new utils.Buf16(2*L_CODES+1);zero(this.heap);this.heap_len=0;this.heap_max=0;this.depth=new utils.Buf16(2*L_CODES+1);zero(this.depth);this.l_buf=0;this.lit_bufsize=0;this.last_lit=0;this.d_buf=0;this.opt_len=0;this.static_len=0;this.matches=0;this.insert=0;this.bi_buf=0;this.bi_valid=0;}
function deflateResetKeep(strm){var s;if(!strm||!strm.state){return err(strm,Z_STREAM_ERROR);}
strm.total_in=strm.total_out=0;strm.data_type=Z_UNKNOWN;s=strm.state;s.pending=0;s.pending_out=0;if(s.wrap<0){s.wrap=-s.wrap;}
s.status=(s.wrap?INIT_STATE:BUSY_STATE);strm.adler=(s.wrap===2)?0:1;s.last_flush=Z_NO_FLUSH;trees._tr_init(s);return Z_OK;}
function deflateReset(strm){var ret=deflateResetKeep(strm);if(ret===Z_OK){lm_init(strm.state);}
return ret;}
function deflateSetHeader(strm,head){if(!strm||!strm.state){return Z_STREAM_ERROR;}
if(strm.state.wrap!==2){return Z_STREAM_ERROR;}
strm.state.gzhead=head;return Z_OK;}
function deflateInit2(strm,level,method,windowBits,memLevel,strategy){if(!strm){return Z_STREAM_ERROR;}
var wrap=1;if(level===Z_DEFAULT_COMPRESSION){level=6;}
if(windowBits<0){wrap=0;windowBits=-windowBits;}
else if(windowBits>15){wrap=2;windowBits-=16;}
if(memLevel<1||memLevel>MAX_MEM_LEVEL||method!==Z_DEFLATED||windowBits<8||windowBits>15||level<0||level>9||strategy<0||strategy>Z_FIXED){return err(strm,Z_STREAM_ERROR);}
if(windowBits===8){windowBits=9;}
var s=new DeflateState();strm.state=s;s.strm=strm;s.wrap=wrap;s.gzhead=null;s.w_bits=windowBits;s.w_size=1<<s.w_bits;s.w_mask=s.w_size-1;s.hash_bits=memLevel+7;s.hash_size=1<<s.hash_bits;s.hash_mask=s.hash_size-1;s.hash_shift=~~((s.hash_bits+MIN_MATCH-1)/MIN_MATCH);s.window=new utils.Buf8(s.w_size*2);s.head=new utils.Buf16(s.hash_size);s.prev=new utils.Buf16(s.w_size);s.lit_bufsize=1<<(memLevel+6);s.pending_buf_size=s.lit_bufsize*4;s.pending_buf=new utils.Buf8(s.pending_buf_size);s.d_buf=s.lit_bufsize>>1;s.l_buf=(1+2)*s.lit_bufsize;s.level=level;s.strategy=strategy;s.method=method;return deflateReset(strm);}
function deflateInit(strm,level){return deflateInit2(strm,level,Z_DEFLATED,MAX_WBITS,DEF_MEM_LEVEL,Z_DEFAULT_STRATEGY);}
function deflate(strm,flush){var old_flush,s;var beg,val;if(!strm||!strm.state||flush>Z_BLOCK||flush<0){return strm?err(strm,Z_STREAM_ERROR):Z_STREAM_ERROR;}
s=strm.state;if(!strm.output||(!strm.input&&strm.avail_in!==0)||(s.status===FINISH_STATE&&flush!==Z_FINISH)){return err(strm,(strm.avail_out===0)?Z_BUF_ERROR:Z_STREAM_ERROR);}
s.strm=strm;old_flush=s.last_flush;s.last_flush=flush;if(s.status===INIT_STATE){if(s.wrap===2){strm.adler=0;put_byte(s,31);put_byte(s,139);put_byte(s,8);if(!s.gzhead){put_byte(s,0);put_byte(s,0);put_byte(s,0);put_byte(s,0);put_byte(s,0);put_byte(s,s.level===9?2:(s.strategy>=Z_HUFFMAN_ONLY||s.level<2?4:0));put_byte(s,OS_CODE);s.status=BUSY_STATE;}
else{put_byte(s,(s.gzhead.text?1:0)+(s.gzhead.hcrc?2:0)+(!s.gzhead.extra?0:4)+(!s.gzhead.name?0:8)+(!s.gzhead.comment?0:16));put_byte(s,s.gzhead.time&0xff);put_byte(s,(s.gzhead.time>>8)&0xff);put_byte(s,(s.gzhead.time>>16)&0xff);put_byte(s,(s.gzhead.time>>24)&0xff);put_byte(s,s.level===9?2:(s.strategy>=Z_HUFFMAN_ONLY||s.level<2?4:0));put_byte(s,s.gzhead.os&0xff);if(s.gzhead.extra&&s.gzhead.extra.length){put_byte(s,s.gzhead.extra.length&0xff);put_byte(s,(s.gzhead.extra.length>>8)&0xff);}
if(s.gzhead.hcrc){strm.adler=crc32(strm.adler,s.pending_buf,s.pending,0);}
s.gzindex=0;s.status=EXTRA_STATE;}}
else
{var header=(Z_DEFLATED+((s.w_bits-8)<<4))<<8;var level_flags=-1;if(s.strategy>=Z_HUFFMAN_ONLY||s.level<2){level_flags=0;}else if(s.level<6){level_flags=1;}else if(s.level===6){level_flags=2;}else{level_flags=3;}
header|=(level_flags<<6);if(s.strstart!==0){header|=PRESET_DICT;}
header+=31-(header%31);s.status=BUSY_STATE;putShortMSB(s,header);if(s.strstart!==0){putShortMSB(s,strm.adler>>>16);putShortMSB(s,strm.adler&0xffff);}
strm.adler=1;}}
if(s.status===EXTRA_STATE){if(s.gzhead.extra){beg=s.pending;while(s.gzindex<(s.gzhead.extra.length&0xffff)){if(s.pending===s.pending_buf_size){if(s.gzhead.hcrc&&s.pending>beg){strm.adler=crc32(strm.adler,s.pending_buf,s.pending-beg,beg);}
flush_pending(strm);beg=s.pending;if(s.pending===s.pending_buf_size){break;}}
put_byte(s,s.gzhead.extra[s.gzindex]&0xff);s.gzindex++;}
if(s.gzhead.hcrc&&s.pending>beg){strm.adler=crc32(strm.adler,s.pending_buf,s.pending-beg,beg);}
if(s.gzindex===s.gzhead.extra.length){s.gzindex=0;s.status=NAME_STATE;}}
else{s.status=NAME_STATE;}}
if(s.status===NAME_STATE){if(s.gzhead.name){beg=s.pending;do{if(s.pending===s.pending_buf_size){if(s.gzhead.hcrc&&s.pending>beg){strm.adler=crc32(strm.adler,s.pending_buf,s.pending-beg,beg);}
flush_pending(strm);beg=s.pending;if(s.pending===s.pending_buf_size){val=1;break;}}
if(s.gzindex<s.gzhead.name.length){val=s.gzhead.name.charCodeAt(s.gzindex++)&0xff;}else{val=0;}
put_byte(s,val);}while(val!==0);if(s.gzhead.hcrc&&s.pending>beg){strm.adler=crc32(strm.adler,s.pending_buf,s.pending-beg,beg);}
if(val===0){s.gzindex=0;s.status=COMMENT_STATE;}}
else{s.status=COMMENT_STATE;}}
if(s.status===COMMENT_STATE){if(s.gzhead.comment){beg=s.pending;do{if(s.pending===s.pending_buf_size){if(s.gzhead.hcrc&&s.pending>beg){strm.adler=crc32(strm.adler,s.pending_buf,s.pending-beg,beg);}
flush_pending(strm);beg=s.pending;if(s.pending===s.pending_buf_size){val=1;break;}}
if(s.gzindex<s.gzhead.comment.length){val=s.gzhead.comment.charCodeAt(s.gzindex++)&0xff;}else{val=0;}
put_byte(s,val);}while(val!==0);if(s.gzhead.hcrc&&s.pending>beg){strm.adler=crc32(strm.adler,s.pending_buf,s.pending-beg,beg);}
if(val===0){s.status=HCRC_STATE;}}
else{s.status=HCRC_STATE;}}
if(s.status===HCRC_STATE){if(s.gzhead.hcrc){if(s.pending+2>s.pending_buf_size){flush_pending(strm);}
if(s.pending+2<=s.pending_buf_size){put_byte(s,strm.adler&0xff);put_byte(s,(strm.adler>>8)&0xff);strm.adler=0;s.status=BUSY_STATE;}}
else{s.status=BUSY_STATE;}}
if(s.pending!==0){flush_pending(strm);if(strm.avail_out===0){s.last_flush=-1;return Z_OK;}}else if(strm.avail_in===0&&rank(flush)<=rank(old_flush)&&flush!==Z_FINISH){return err(strm,Z_BUF_ERROR);}
if(s.status===FINISH_STATE&&strm.avail_in!==0){return err(strm,Z_BUF_ERROR);}
if(strm.avail_in!==0||s.lookahead!==0||(flush!==Z_NO_FLUSH&&s.status!==FINISH_STATE)){var bstate=(s.strategy===Z_HUFFMAN_ONLY)?deflate_huff(s,flush):(s.strategy===Z_RLE?deflate_rle(s,flush):configuration_table[s.level].func(s,flush));if(bstate===BS_FINISH_STARTED||bstate===BS_FINISH_DONE){s.status=FINISH_STATE;}
if(bstate===BS_NEED_MORE||bstate===BS_FINISH_STARTED){if(strm.avail_out===0){s.last_flush=-1;}
return Z_OK;}
if(bstate===BS_BLOCK_DONE){if(flush===Z_PARTIAL_FLUSH){trees._tr_align(s);}
else if(flush!==Z_BLOCK){trees._tr_stored_block(s,0,0,false);if(flush===Z_FULL_FLUSH){zero(s.head);if(s.lookahead===0){s.strstart=0;s.block_start=0;s.insert=0;}}}
flush_pending(strm);if(strm.avail_out===0){s.last_flush=-1;return Z_OK;}}}
if(flush!==Z_FINISH){return Z_OK;}
if(s.wrap<=0){return Z_STREAM_END;}
if(s.wrap===2){put_byte(s,strm.adler&0xff);put_byte(s,(strm.adler>>8)&0xff);put_byte(s,(strm.adler>>16)&0xff);put_byte(s,(strm.adler>>24)&0xff);put_byte(s,strm.total_in&0xff);put_byte(s,(strm.total_in>>8)&0xff);put_byte(s,(strm.total_in>>16)&0xff);put_byte(s,(strm.total_in>>24)&0xff);}
else
{putShortMSB(s,strm.adler>>>16);putShortMSB(s,strm.adler&0xffff);}
flush_pending(strm);if(s.wrap>0){s.wrap=-s.wrap;}
return s.pending!==0?Z_OK:Z_STREAM_END;}
function deflateEnd(strm){var status;if(!strm||!strm.state){return Z_STREAM_ERROR;}
status=strm.state.status;if(status!==INIT_STATE&&status!==EXTRA_STATE&&status!==NAME_STATE&&status!==COMMENT_STATE&&status!==HCRC_STATE&&status!==BUSY_STATE&&status!==FINISH_STATE){return err(strm,Z_STREAM_ERROR);}
strm.state=null;return status===BUSY_STATE?err(strm,Z_DATA_ERROR):Z_OK;}
exports.deflateInit=deflateInit;exports.deflateInit2=deflateInit2;exports.deflateReset=deflateReset;exports.deflateResetKeep=deflateResetKeep;exports.deflateSetHeader=deflateSetHeader;exports.deflate=deflate;exports.deflateEnd=deflateEnd;exports.deflateInfo='pako deflate (from Nodeca project)';},function(module,exports,__webpack_require__){'use strict';var utils=__webpack_require__(98);var adler32=__webpack_require__(96);var crc32=__webpack_require__(97);var inflate_fast=__webpack_require__(102);var inflate_table=__webpack_require__(103);var CODES=0;var LENS=1;var DISTS=2;var Z_FINISH=4;var Z_BLOCK=5;var Z_TREES=6;var Z_OK=0;var Z_STREAM_END=1;var Z_NEED_DICT=2;var Z_STREAM_ERROR=-2;var Z_DATA_ERROR=-3;var Z_MEM_ERROR=-4;var Z_BUF_ERROR=-5;var Z_DEFLATED=8;var HEAD=1;var FLAGS=2;var TIME=3;var OS=4;var EXLEN=5;var EXTRA=6;var NAME=7;var COMMENT=8;var HCRC=9;var DICTID=10;var DICT=11;var TYPE=12;var TYPEDO=13;var STORED=14;var COPY_=15;var COPY=16;var TABLE=17;var LENLENS=18;var CODELENS=19;var LEN_=20;var LEN=21;var LENEXT=22;var DIST=23;var DISTEXT=24;var MATCH=25;var LIT=26;var CHECK=27;var LENGTH=28;var DONE=29;var BAD=30;var MEM=31;var SYNC=32;var ENOUGH_LENS=852;var ENOUGH_DISTS=592;var MAX_WBITS=15;var DEF_WBITS=MAX_WBITS;function ZSWAP32(q){return(((q>>>24)&0xff)+((q>>>8)&0xff00)+((q&0xff00)<<8)+((q&0xff)<<24));}
function InflateState(){this.mode=0;this.last=false;this.wrap=0;this.havedict=false;this.flags=0;this.dmax=0;this.check=0;this.total=0;this.head=null;this.wbits=0;this.wsize=0;this.whave=0;this.wnext=0;this.window=null;this.hold=0;this.bits=0;this.length=0;this.offset=0;this.extra=0;this.lencode=null;this.distcode=null;this.lenbits=0;this.distbits=0;this.ncode=0;this.nlen=0;this.ndist=0;this.have=0;this.next=null;this.lens=new utils.Buf16(320);this.work=new utils.Buf16(288);this.lendyn=null;this.distdyn=null;this.sane=0;this.back=0;this.was=0;}
function inflateResetKeep(strm){var state;if(!strm||!strm.state){return Z_STREAM_ERROR;}
state=strm.state;strm.total_in=strm.total_out=state.total=0;strm.msg='';if(state.wrap){strm.adler=state.wrap&1;}
state.mode=HEAD;state.last=0;state.havedict=0;state.dmax=32768;state.head=null;state.hold=0;state.bits=0;state.lencode=state.lendyn=new utils.Buf32(ENOUGH_LENS);state.distcode=state.distdyn=new utils.Buf32(ENOUGH_DISTS);state.sane=1;state.back=-1;return Z_OK;}
function inflateReset(strm){var state;if(!strm||!strm.state){return Z_STREAM_ERROR;}
state=strm.state;state.wsize=0;state.whave=0;state.wnext=0;return inflateResetKeep(strm);}
function inflateReset2(strm,windowBits){var wrap;var state;if(!strm||!strm.state){return Z_STREAM_ERROR;}
state=strm.state;if(windowBits<0){wrap=0;windowBits=-windowBits;}
else{wrap=(windowBits>>4)+1;if(windowBits<48){windowBits&=15;}}
if(windowBits&&(windowBits<8||windowBits>15)){return Z_STREAM_ERROR;}
if(state.window!==null&&state.wbits!==windowBits){state.window=null;}
state.wrap=wrap;state.wbits=windowBits;return inflateReset(strm);}
function inflateInit2(strm,windowBits){var ret;var state;if(!strm){return Z_STREAM_ERROR;}
state=new InflateState();strm.state=state;state.window=null;ret=inflateReset2(strm,windowBits);if(ret!==Z_OK){strm.state=null;}
return ret;}
function inflateInit(strm){return inflateInit2(strm,DEF_WBITS);}
var virgin=true;var lenfix,distfix;function fixedtables(state){if(virgin){var sym;lenfix=new utils.Buf32(512);distfix=new utils.Buf32(32);sym=0;while(sym<144){state.lens[sym++]=8;}
while(sym<256){state.lens[sym++]=9;}
while(sym<280){state.lens[sym++]=7;}
while(sym<288){state.lens[sym++]=8;}
inflate_table(LENS,state.lens,0,288,lenfix,0,state.work,{bits:9});sym=0;while(sym<32){state.lens[sym++]=5;}
inflate_table(DISTS,state.lens,0,32,distfix,0,state.work,{bits:5});virgin=false;}
state.lencode=lenfix;state.lenbits=9;state.distcode=distfix;state.distbits=5;}
function updatewindow(strm,src,end,copy){var dist;var state=strm.state;if(state.window===null){state.wsize=1<<state.wbits;state.wnext=0;state.whave=0;state.window=new utils.Buf8(state.wsize);}
if(copy>=state.wsize){utils.arraySet(state.window,src,end-state.wsize,state.wsize,0);state.wnext=0;state.whave=state.wsize;}
else{dist=state.wsize-state.wnext;if(dist>copy){dist=copy;}
utils.arraySet(state.window,src,end-copy,dist,state.wnext);copy-=dist;if(copy){utils.arraySet(state.window,src,end-copy,copy,0);state.wnext=copy;state.whave=state.wsize;}
else{state.wnext+=dist;if(state.wnext===state.wsize){state.wnext=0;}
if(state.whave<state.wsize){state.whave+=dist;}}}
return 0;}
function inflate(strm,flush){var state;var input,output;var next;var put;var have,left;var hold;var bits;var _in,_out;var copy;var from;var from_source;var here=0;var here_bits,here_op,here_val;var last_bits,last_op,last_val;var len;var ret;var hbuf=new utils.Buf8(4);var opts;var n;var order=[16,17,18,0,8,7,9,6,10,5,11,4,12,3,13,2,14,1,15];if(!strm||!strm.state||!strm.output||(!strm.input&&strm.avail_in!==0)){return Z_STREAM_ERROR;}
state=strm.state;if(state.mode===TYPE){state.mode=TYPEDO;}
put=strm.next_out;output=strm.output;left=strm.avail_out;next=strm.next_in;input=strm.input;have=strm.avail_in;hold=state.hold;bits=state.bits;_in=have;_out=left;ret=Z_OK;inf_leave:for(;;){switch(state.mode){case HEAD:if(state.wrap===0){state.mode=TYPEDO;break;}
while(bits<16){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if((state.wrap&2)&&hold===0x8b1f){state.check=0;hbuf[0]=hold&0xff;hbuf[1]=(hold>>>8)&0xff;state.check=crc32(state.check,hbuf,2,0);hold=0;bits=0;state.mode=FLAGS;break;}
state.flags=0;if(state.head){state.head.done=false;}
if(!(state.wrap&1)||(((hold&0xff)<<8)+(hold>>8))%31){strm.msg='incorrect header check';state.mode=BAD;break;}
if((hold&0x0f)!==Z_DEFLATED){strm.msg='unknown compression method';state.mode=BAD;break;}
hold>>>=4;bits-=4;len=(hold&0x0f)+8;if(state.wbits===0){state.wbits=len;}
else if(len>state.wbits){strm.msg='invalid window size';state.mode=BAD;break;}
state.dmax=1<<len;strm.adler=state.check=1;state.mode=hold&0x200?DICTID:TYPE;hold=0;bits=0;break;case FLAGS:while(bits<16){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
state.flags=hold;if((state.flags&0xff)!==Z_DEFLATED){strm.msg='unknown compression method';state.mode=BAD;break;}
if(state.flags&0xe000){strm.msg='unknown header flags set';state.mode=BAD;break;}
if(state.head){state.head.text=((hold>>8)&1);}
if(state.flags&0x0200){hbuf[0]=hold&0xff;hbuf[1]=(hold>>>8)&0xff;state.check=crc32(state.check,hbuf,2,0);}
hold=0;bits=0;state.mode=TIME;case TIME:while(bits<32){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if(state.head){state.head.time=hold;}
if(state.flags&0x0200){hbuf[0]=hold&0xff;hbuf[1]=(hold>>>8)&0xff;hbuf[2]=(hold>>>16)&0xff;hbuf[3]=(hold>>>24)&0xff;state.check=crc32(state.check,hbuf,4,0);}
hold=0;bits=0;state.mode=OS;case OS:while(bits<16){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if(state.head){state.head.xflags=(hold&0xff);state.head.os=(hold>>8);}
if(state.flags&0x0200){hbuf[0]=hold&0xff;hbuf[1]=(hold>>>8)&0xff;state.check=crc32(state.check,hbuf,2,0);}
hold=0;bits=0;state.mode=EXLEN;case EXLEN:if(state.flags&0x0400){while(bits<16){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
state.length=hold;if(state.head){state.head.extra_len=hold;}
if(state.flags&0x0200){hbuf[0]=hold&0xff;hbuf[1]=(hold>>>8)&0xff;state.check=crc32(state.check,hbuf,2,0);}
hold=0;bits=0;}
else if(state.head){state.head.extra=null;}
state.mode=EXTRA;case EXTRA:if(state.flags&0x0400){copy=state.length;if(copy>have){copy=have;}
if(copy){if(state.head){len=state.head.extra_len-state.length;if(!state.head.extra){state.head.extra=new Array(state.head.extra_len);}
utils.arraySet(state.head.extra,input,next,copy,len);}
if(state.flags&0x0200){state.check=crc32(state.check,input,copy,next);}
have-=copy;next+=copy;state.length-=copy;}
if(state.length){break inf_leave;}}
state.length=0;state.mode=NAME;case NAME:if(state.flags&0x0800){if(have===0){break inf_leave;}
copy=0;do{len=input[next+copy++];if(state.head&&len&&(state.length<65536)){state.head.name+=String.fromCharCode(len);}}while(len&&copy<have);if(state.flags&0x0200){state.check=crc32(state.check,input,copy,next);}
have-=copy;next+=copy;if(len){break inf_leave;}}
else if(state.head){state.head.name=null;}
state.length=0;state.mode=COMMENT;case COMMENT:if(state.flags&0x1000){if(have===0){break inf_leave;}
copy=0;do{len=input[next+copy++];if(state.head&&len&&(state.length<65536)){state.head.comment+=String.fromCharCode(len);}}while(len&&copy<have);if(state.flags&0x0200){state.check=crc32(state.check,input,copy,next);}
have-=copy;next+=copy;if(len){break inf_leave;}}
else if(state.head){state.head.comment=null;}
state.mode=HCRC;case HCRC:if(state.flags&0x0200){while(bits<16){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if(hold!==(state.check&0xffff)){strm.msg='header crc mismatch';state.mode=BAD;break;}
hold=0;bits=0;}
if(state.head){state.head.hcrc=((state.flags>>9)&1);state.head.done=true;}
strm.adler=state.check=0;state.mode=TYPE;break;case DICTID:while(bits<32){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
strm.adler=state.check=ZSWAP32(hold);hold=0;bits=0;state.mode=DICT;case DICT:if(state.havedict===0){strm.next_out=put;strm.avail_out=left;strm.next_in=next;strm.avail_in=have;state.hold=hold;state.bits=bits;return Z_NEED_DICT;}
strm.adler=state.check=1;state.mode=TYPE;case TYPE:if(flush===Z_BLOCK||flush===Z_TREES){break inf_leave;}
case TYPEDO:if(state.last){hold>>>=bits&7;bits-=bits&7;state.mode=CHECK;break;}
while(bits<3){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
state.last=(hold&0x01);hold>>>=1;bits-=1;switch((hold&0x03)){case 0:state.mode=STORED;break;case 1:fixedtables(state);state.mode=LEN_;if(flush===Z_TREES){hold>>>=2;bits-=2;break inf_leave;}
break;case 2:state.mode=TABLE;break;case 3:strm.msg='invalid block type';state.mode=BAD;}
hold>>>=2;bits-=2;break;case STORED:hold>>>=bits&7;bits-=bits&7;while(bits<32){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if((hold&0xffff)!==((hold>>>16)^0xffff)){strm.msg='invalid stored block lengths';state.mode=BAD;break;}
state.length=hold&0xffff;hold=0;bits=0;state.mode=COPY_;if(flush===Z_TREES){break inf_leave;}
case COPY_:state.mode=COPY;case COPY:copy=state.length;if(copy){if(copy>have){copy=have;}
if(copy>left){copy=left;}
if(copy===0){break inf_leave;}
utils.arraySet(output,input,next,copy,put);have-=copy;next+=copy;left-=copy;put+=copy;state.length-=copy;break;}
state.mode=TYPE;break;case TABLE:while(bits<14){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
state.nlen=(hold&0x1f)+257;hold>>>=5;bits-=5;state.ndist=(hold&0x1f)+1;hold>>>=5;bits-=5;state.ncode=(hold&0x0f)+4;hold>>>=4;bits-=4;if(state.nlen>286||state.ndist>30){strm.msg='too many length or distance symbols';state.mode=BAD;break;}
state.have=0;state.mode=LENLENS;case LENLENS:while(state.have<state.ncode){while(bits<3){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
state.lens[order[state.have++]]=(hold&0x07);hold>>>=3;bits-=3;}
while(state.have<19){state.lens[order[state.have++]]=0;}
state.lencode=state.lendyn;state.lenbits=7;opts={bits:state.lenbits};ret=inflate_table(CODES,state.lens,0,19,state.lencode,0,state.work,opts);state.lenbits=opts.bits;if(ret){strm.msg='invalid code lengths set';state.mode=BAD;break;}
state.have=0;state.mode=CODELENS;case CODELENS:while(state.have<state.nlen+state.ndist){for(;;){here=state.lencode[hold&((1<<state.lenbits)-1)];here_bits=here>>>24;here_op=(here>>>16)&0xff;here_val=here&0xffff;if((here_bits)<=bits){break;}
if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if(here_val<16){hold>>>=here_bits;bits-=here_bits;state.lens[state.have++]=here_val;}
else{if(here_val===16){n=here_bits+2;while(bits<n){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
hold>>>=here_bits;bits-=here_bits;if(state.have===0){strm.msg='invalid bit length repeat';state.mode=BAD;break;}
len=state.lens[state.have-1];copy=3+(hold&0x03);hold>>>=2;bits-=2;}
else if(here_val===17){n=here_bits+3;while(bits<n){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
hold>>>=here_bits;bits-=here_bits;len=0;copy=3+(hold&0x07);hold>>>=3;bits-=3;}
else{n=here_bits+7;while(bits<n){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
hold>>>=here_bits;bits-=here_bits;len=0;copy=11+(hold&0x7f);hold>>>=7;bits-=7;}
if(state.have+copy>state.nlen+state.ndist){strm.msg='invalid bit length repeat';state.mode=BAD;break;}
while(copy--){state.lens[state.have++]=len;}}}
if(state.mode===BAD){break;}
if(state.lens[256]===0){strm.msg='invalid code -- missing end-of-block';state.mode=BAD;break;}
state.lenbits=9;opts={bits:state.lenbits};ret=inflate_table(LENS,state.lens,0,state.nlen,state.lencode,0,state.work,opts);state.lenbits=opts.bits;if(ret){strm.msg='invalid literal/lengths set';state.mode=BAD;break;}
state.distbits=6;state.distcode=state.distdyn;opts={bits:state.distbits};ret=inflate_table(DISTS,state.lens,state.nlen,state.ndist,state.distcode,0,state.work,opts);state.distbits=opts.bits;if(ret){strm.msg='invalid distances set';state.mode=BAD;break;}
state.mode=LEN_;if(flush===Z_TREES){break inf_leave;}
case LEN_:state.mode=LEN;case LEN:if(have>=6&&left>=258){strm.next_out=put;strm.avail_out=left;strm.next_in=next;strm.avail_in=have;state.hold=hold;state.bits=bits;inflate_fast(strm,_out);put=strm.next_out;output=strm.output;left=strm.avail_out;next=strm.next_in;input=strm.input;have=strm.avail_in;hold=state.hold;bits=state.bits;if(state.mode===TYPE){state.back=-1;}
break;}
state.back=0;for(;;){here=state.lencode[hold&((1<<state.lenbits)-1)];here_bits=here>>>24;here_op=(here>>>16)&0xff;here_val=here&0xffff;if(here_bits<=bits){break;}
if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if(here_op&&(here_op&0xf0)===0){last_bits=here_bits;last_op=here_op;last_val=here_val;for(;;){here=state.lencode[last_val+((hold&((1<<(last_bits+last_op))-1))>>last_bits)];here_bits=here>>>24;here_op=(here>>>16)&0xff;here_val=here&0xffff;if((last_bits+here_bits)<=bits){break;}
if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
hold>>>=last_bits;bits-=last_bits;state.back+=last_bits;}
hold>>>=here_bits;bits-=here_bits;state.back+=here_bits;state.length=here_val;if(here_op===0){state.mode=LIT;break;}
if(here_op&32){state.back=-1;state.mode=TYPE;break;}
if(here_op&64){strm.msg='invalid literal/length code';state.mode=BAD;break;}
state.extra=here_op&15;state.mode=LENEXT;case LENEXT:if(state.extra){n=state.extra;while(bits<n){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
state.length+=hold&((1<<state.extra)-1);hold>>>=state.extra;bits-=state.extra;state.back+=state.extra;}
state.was=state.length;state.mode=DIST;case DIST:for(;;){here=state.distcode[hold&((1<<state.distbits)-1)];here_bits=here>>>24;here_op=(here>>>16)&0xff;here_val=here&0xffff;if((here_bits)<=bits){break;}
if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if((here_op&0xf0)===0){last_bits=here_bits;last_op=here_op;last_val=here_val;for(;;){here=state.distcode[last_val+((hold&((1<<(last_bits+last_op))-1))>>last_bits)];here_bits=here>>>24;here_op=(here>>>16)&0xff;here_val=here&0xffff;if((last_bits+here_bits)<=bits){break;}
if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
hold>>>=last_bits;bits-=last_bits;state.back+=last_bits;}
hold>>>=here_bits;bits-=here_bits;state.back+=here_bits;if(here_op&64){strm.msg='invalid distance code';state.mode=BAD;break;}
state.offset=here_val;state.extra=(here_op)&15;state.mode=DISTEXT;case DISTEXT:if(state.extra){n=state.extra;while(bits<n){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
state.offset+=hold&((1<<state.extra)-1);hold>>>=state.extra;bits-=state.extra;state.back+=state.extra;}
if(state.offset>state.dmax){strm.msg='invalid distance too far back';state.mode=BAD;break;}
state.mode=MATCH;case MATCH:if(left===0){break inf_leave;}
copy=_out-left;if(state.offset>copy){copy=state.offset-copy;if(copy>state.whave){if(state.sane){strm.msg='invalid distance too far back';state.mode=BAD;break;}}
if(copy>state.wnext){copy-=state.wnext;from=state.wsize-copy;}
else{from=state.wnext-copy;}
if(copy>state.length){copy=state.length;}
from_source=state.window;}
else{from_source=output;from=put-state.offset;copy=state.length;}
if(copy>left){copy=left;}
left-=copy;state.length-=copy;do{output[put++]=from_source[from++];}while(--copy);if(state.length===0){state.mode=LEN;}
break;case LIT:if(left===0){break inf_leave;}
output[put++]=state.length;left--;state.mode=LEN;break;case CHECK:if(state.wrap){while(bits<32){if(have===0){break inf_leave;}
have--;hold|=input[next++]<<bits;bits+=8;}
_out-=left;strm.total_out+=_out;state.total+=_out;if(_out){strm.adler=state.check=(state.flags?crc32(state.check,output,_out,put-_out):adler32(state.check,output,_out,put-_out));}
_out=left;if((state.flags?hold:ZSWAP32(hold))!==state.check){strm.msg='incorrect data check';state.mode=BAD;break;}
hold=0;bits=0;}
state.mode=LENGTH;case LENGTH:if(state.wrap&&state.flags){while(bits<32){if(have===0){break inf_leave;}
have--;hold+=input[next++]<<bits;bits+=8;}
if(hold!==(state.total&0xffffffff)){strm.msg='incorrect length check';state.mode=BAD;break;}
hold=0;bits=0;}
state.mode=DONE;case DONE:ret=Z_STREAM_END;break inf_leave;case BAD:ret=Z_DATA_ERROR;break inf_leave;case MEM:return Z_MEM_ERROR;case SYNC:default:return Z_STREAM_ERROR;}}
strm.next_out=put;strm.avail_out=left;strm.next_in=next;strm.avail_in=have;state.hold=hold;state.bits=bits;if(state.wsize||(_out!==strm.avail_out&&state.mode<BAD&&(state.mode<CHECK||flush!==Z_FINISH))){if(updatewindow(strm,strm.output,strm.next_out,_out-strm.avail_out)){state.mode=MEM;return Z_MEM_ERROR;}}
_in-=strm.avail_in;_out-=strm.avail_out;strm.total_in+=_in;strm.total_out+=_out;state.total+=_out;if(state.wrap&&_out){strm.adler=state.check=(state.flags?crc32(state.check,output,_out,strm.next_out-_out):adler32(state.check,output,_out,strm.next_out-_out));}
strm.data_type=state.bits+(state.last?64:0)+(state.mode===TYPE?128:0)+(state.mode===LEN_||state.mode===COPY_?256:0);if(((_in===0&&_out===0)||flush===Z_FINISH)&&ret===Z_OK){ret=Z_BUF_ERROR;}
return ret;}
function inflateEnd(strm){if(!strm||!strm.state){return Z_STREAM_ERROR;}
var state=strm.state;if(state.window){state.window=null;}
strm.state=null;return Z_OK;}
function inflateGetHeader(strm,head){var state;if(!strm||!strm.state){return Z_STREAM_ERROR;}
state=strm.state;if((state.wrap&2)===0){return Z_STREAM_ERROR;}
state.head=head;head.done=false;return Z_OK;}
exports.inflateReset=inflateReset;exports.inflateReset2=inflateReset2;exports.inflateResetKeep=inflateResetKeep;exports.inflateInit=inflateInit;exports.inflateInit2=inflateInit2;exports.inflate=inflate;exports.inflateEnd=inflateEnd;exports.inflateGetHeader=inflateGetHeader;exports.inflateInfo='pako inflate (from Nodeca project)';},function(module,exports,__webpack_require__){module.exports={Z_NO_FLUSH:0,Z_PARTIAL_FLUSH:1,Z_SYNC_FLUSH:2,Z_FULL_FLUSH:3,Z_FINISH:4,Z_BLOCK:5,Z_TREES:6,Z_OK:0,Z_STREAM_END:1,Z_NEED_DICT:2,Z_ERRNO:-1,Z_STREAM_ERROR:-2,Z_DATA_ERROR:-3,Z_BUF_ERROR:-5,Z_NO_COMPRESSION:0,Z_BEST_SPEED:1,Z_BEST_COMPRESSION:9,Z_DEFAULT_COMPRESSION:-1,Z_FILTERED:1,Z_HUFFMAN_ONLY:2,Z_RLE:3,Z_FIXED:4,Z_DEFAULT_STRATEGY:0,Z_BINARY:0,Z_TEXT:1,Z_UNKNOWN:2,Z_DEFLATED:8};},function(module,exports,__webpack_require__){'use strict';function ZStream(){this.input=null;this.next_in=0;this.avail_in=0;this.total_in=0;this.output=null;this.next_out=0;this.avail_out=0;this.total_out=0;this.msg='';this.state=null;this.data_type=2;this.adler=0;}
module.exports=ZStream;},function(module,exports,__webpack_require__){(function(){var DFont,Data,Directory,NameTable,fs;fs=__webpack_require__(10);Data=__webpack_require__(34);Directory=__webpack_require__(79);NameTable=__webpack_require__(80);DFont=(function(){DFont.open=function(filename){var contents;contents=fs.readFileSync(filename);return new DFont(contents);};function DFont(contents){this.contents=new Data(contents);this.parse(this.contents);}
DFont.prototype.parse=function(data){var attr,b2,b3,b4,dataLength,dataOffset,dataOfs,entry,font,handle,i,id,j,len,length,mapLength,mapOffset,maxIndex,maxTypeIndex,name,nameListOffset,nameOfs,p,pos,refListOffset,type,typeListOffset,_i,_j;dataOffset=data.readInt();mapOffset=data.readInt();dataLength=data.readInt();mapLength=data.readInt();this.map={};data.pos=mapOffset+24;typeListOffset=data.readShort()+mapOffset;nameListOffset=data.readShort()+mapOffset;data.pos=typeListOffset;maxIndex=data.readShort();for(i=_i=0;_i<=maxIndex;i=_i+=1){type=data.readString(4);maxTypeIndex=data.readShort();refListOffset=data.readShort();this.map[type]={list:[],named:{}};pos=data.pos;data.pos=typeListOffset+refListOffset;for(j=_j=0;_j<=maxTypeIndex;j=_j+=1){id=data.readShort();nameOfs=data.readShort();attr=data.readByte();b2=data.readByte()<<16;b3=data.readByte()<<8;b4=data.readByte();dataOfs=dataOffset+(0|b2|b3|b4);handle=data.readUInt32();entry={id:id,attributes:attr,offset:dataOfs,handle:handle};p=data.pos;if(nameOfs!==-1&&(nameListOffset+nameOfs<mapOffset+mapLength)){data.pos=nameListOffset+nameOfs;len=data.readByte();entry.name=data.readString(len);}else if(type==='sfnt'){data.pos=entry.offset;length=data.readUInt32();font={};font.contents=new Data(data.slice(data.pos,data.pos+length));font.directory=new Directory(font.contents);name=new NameTable(font);entry.name=name.fontName[0].raw;}
data.pos=p;this.map[type].list.push(entry);if(entry.name){this.map[type].named[entry.name]=entry;}}
data.pos=pos;}};DFont.prototype.getNamedFont=function(name){var data,entry,length,pos,ret,_ref;data=this.contents;pos=data.pos;entry=(_ref=this.map.sfnt)!=null?_ref.named[name]:void 0;if(!entry){throw new Error("Font "+name+" not found in DFont file.");}
data.pos=entry.offset;length=data.readUInt32();ret=data.slice(data.pos,data.pos+length);data.pos=pos;return ret;};return DFont;})();module.exports=DFont;}).call(this);},function(module,exports,__webpack_require__){(function(Buffer){(function(){var Data,Directory,__slice=[].slice;Data=__webpack_require__(34);Directory=(function(){var checksum;function Directory(data){var entry,i,_i,_ref;this.scalarType=data.readInt();this.tableCount=data.readShort();this.searchRange=data.readShort();this.entrySelector=data.readShort();this.rangeShift=data.readShort();this.tables={};for(i=_i=0,_ref=this.tableCount;0<=_ref?_i<_ref:_i>_ref;i=0<=_ref?++_i:--_i){entry={tag:data.readString(4),checksum:data.readInt(),offset:data.readInt(),length:data.readInt()};this.tables[entry.tag]=entry;}}
Directory.prototype.encode=function(tables){var adjustment,directory,directoryLength,entrySelector,headOffset,log2,offset,rangeShift,searchRange,sum,table,tableCount,tableData,tag;tableCount=Object.keys(tables).length;log2=Math.log(2);searchRange=Math.floor(Math.log(tableCount)/log2)*16;entrySelector=Math.floor(searchRange/log2);rangeShift=tableCount*16-searchRange;directory=new Data;directory.writeInt(this.scalarType);directory.writeShort(tableCount);directory.writeShort(searchRange);directory.writeShort(entrySelector);directory.writeShort(rangeShift);directoryLength=tableCount*16;offset=directory.pos+directoryLength;headOffset=null;tableData=[];for(tag in tables){table=tables[tag];directory.writeString(tag);directory.writeInt(checksum(table));directory.writeInt(offset);directory.writeInt(table.length);tableData=tableData.concat(table);if(tag==='head'){headOffset=offset;}
offset+=table.length;while(offset%4){tableData.push(0);offset++;}}
directory.write(tableData);sum=checksum(directory.data);adjustment=0xB1B0AFBA-sum;directory.pos=headOffset+8;directory.writeUInt32(adjustment);return new Buffer(directory.data);};checksum=function(data){var i,sum,tmp,_i,_ref;data=__slice.call(data);while(data.length%4){data.push(0);}
tmp=new Data(data);sum=0;for(i=_i=0,_ref=data.length;_i<_ref;i=_i+=4){sum+=tmp.readUInt32();}
return sum&0xFFFFFFFF;};return Directory;})();module.exports=Directory;}).call(this);}.call(exports,__webpack_require__(4).Buffer))},function(module,exports,__webpack_require__){(function(){var Data,NameEntry,NameTable,Table,utils,__hasProp={}.hasOwnProperty,__extends=function(child,parent){for(var key in parent){if(__hasProp.call(parent,key))child[key]=parent[key];}function ctor(){this.constructor=child;}ctor.prototype=parent.prototype;child.prototype=new ctor();child.__super__=parent.prototype;return child;};Table=__webpack_require__(99);Data=__webpack_require__(34);utils=__webpack_require__(89);NameTable=(function(_super){var subsetTag;__extends(NameTable,_super);function NameTable(){return NameTable.__super__.constructor.apply(this,arguments);}
NameTable.prototype.tag='name';NameTable.prototype.parse=function(data){var count,entries,entry,format,i,name,stringOffset,strings,text,_i,_j,_len,_name;data.pos=this.offset;format=data.readShort();count=data.readShort();stringOffset=data.readShort();entries=[];for(i=_i=0;0<=count?_i<count:_i>count;i=0<=count?++_i:--_i){entries.push({platformID:data.readShort(),encodingID:data.readShort(),languageID:data.readShort(),nameID:data.readShort(),length:data.readShort(),offset:this.offset+stringOffset+data.readShort()});}
strings={};for(i=_j=0,_len=entries.length;_j<_len;i=++_j){entry=entries[i];data.pos=entry.offset;text=data.readString(entry.length);name=new NameEntry(text,entry);if(strings[_name=entry.nameID]==null){strings[_name]=[];}
strings[entry.nameID].push(name);}
this.strings=strings;this.copyright=strings[0];this.fontFamily=strings[1];this.fontSubfamily=strings[2];this.uniqueSubfamily=strings[3];this.fontName=strings[4];this.version=strings[5];this.postscriptName=strings[6][0].raw.replace(/[\x00-\x19\x80-\xff]/g,"");this.trademark=strings[7];this.manufacturer=strings[8];this.designer=strings[9];this.description=strings[10];this.vendorUrl=strings[11];this.designerUrl=strings[12];this.license=strings[13];this.licenseUrl=strings[14];this.preferredFamily=strings[15];this.preferredSubfamily=strings[17];this.compatibleFull=strings[18];return this.sampleText=strings[19];};subsetTag="AAAAAA";NameTable.prototype.encode=function(){var id,list,nameID,nameTable,postscriptName,strCount,strTable,string,strings,table,val,_i,_len,_ref;strings={};_ref=this.strings;for(id in _ref){val=_ref[id];strings[id]=val;}
postscriptName=new NameEntry(""+subsetTag+"+"+this.postscriptName,{platformID:1,encodingID:0,languageID:0});strings[6]=[postscriptName];subsetTag=utils.successorOf(subsetTag);strCount=0;for(id in strings){list=strings[id];if(list!=null){strCount+=list.length;}}
table=new Data;strTable=new Data;table.writeShort(0);table.writeShort(strCount);table.writeShort(6+12*strCount);for(nameID in strings){list=strings[nameID];if(list!=null){for(_i=0,_len=list.length;_i<_len;_i++){string=list[_i];table.writeShort(string.platformID);table.writeShort(string.encodingID);table.writeShort(string.languageID);table.writeShort(nameID);table.writeShort(string.length);table.writeShort(strTable.pos);strTable.writeString(string.raw);}}}
return nameTable={postscriptName:postscriptName.raw,table:table.data.concat(strTable.data)};};return NameTable;})(Table);module.exports=NameTable;NameEntry=(function(){function NameEntry(raw,entry){this.raw=raw;this.length=this.raw.length;this.platformID=entry.platformID;this.encodingID=entry.encodingID;this.languageID=entry.languageID;}
return NameEntry;})();}).call(this);},function(module,exports,__webpack_require__){(function(){var Data,HeadTable,Table,__hasProp={}.hasOwnProperty,__extends=function(child,parent){for(var key in parent){if(__hasProp.call(parent,key))child[key]=parent[key];}function ctor(){this.constructor=child;}ctor.prototype=parent.prototype;child.prototype=new ctor();child.__super__=parent.prototype;return child;};Table=__webpack_require__(99);Data=__webpack_require__(34);HeadTable=(function(_super){__extends(HeadTable,_super);function HeadTable(){return HeadTable.__super__.constructor.apply(this,arguments);}
HeadTable.prototype.tag='head';HeadTable.prototype.parse=function(data){data.pos=this.offset;this.version=data.readInt();this.revision=data.readInt();this.checkSumAdjustment=data.readInt();this.magicNumber=data.readInt();this.flags=data.readShort();this.unitsPerEm=data.readShort();this.created=data.readLongLong();this.modified=data.readLongLong();this.xMin=data.readShort();this.yMin=data.readShort();this.xMax=data.readShort();this.yMax=data.readShort();this.macStyle=data.readShort();this.lowestRecPPEM=data.readShort();this.fontDirectionHint=data.readShort();this.indexToLocFormat=data.readShort();return this.glyphDataFormat=data.readShort();};HeadTable.prototype.encode=function(loca){var table;table=new Data;table.writeInt(this.version);table.writeInt(this.revision);table.writeInt(this.checkSumAdjustment);table.writeInt(this.magicNumber);table.writeShort(this.flags);table.writeShort(this.unitsPerEm);table.writeLongLong(this.created);table.writeLongLong(this.modified);table.writeShort(this.xMin);table.writeShort(this.yMin);table.writeShort(this.xMax);table.writeShort(this.yMax);table.writeShort(this.macStyle);table.writeShort(this.lowestRecPPEM);table.writeShort(this.fontDirectionHint);table.writeShort(loca.type);table.writeShort(this.glyphDataFormat);return table.data;};return HeadTable;})(Table);module.exports=HeadTable;}).call(this);},function(module,exports,__webpack_require__){(function(){var CmapEntry,CmapTable,Data,Table,__hasProp={}.hasOwnProperty,__extends=function(child,parent){for(var key in parent){if(__hasProp.call(parent,key))child[key]=parent[key];}function ctor(){this.constructor=child;}ctor.prototype=parent.prototype;child.prototype=new ctor();child.__super__=parent.prototype;return child;};Table=__webpack_require__(99);Data=__webpack_require__(34);CmapTable=(function(_super){__extends(CmapTable,_super);function CmapTable(){return CmapTable.__super__.constructor.apply(this,arguments);}
CmapTable.prototype.tag='cmap';CmapTable.prototype.parse=function(data){var entry,i,tableCount,_i;data.pos=this.offset;this.version=data.readUInt16();tableCount=data.readUInt16();this.tables=[];this.unicode=null;for(i=_i=0;0<=tableCount?_i<tableCount:_i>tableCount;i=0<=tableCount?++_i:--_i){entry=new CmapEntry(data,this.offset);this.tables.push(entry);if(entry.isUnicode){if(this.unicode==null){this.unicode=entry;}}}
return true;};CmapTable.encode=function(charmap,encoding){var result,table;if(encoding==null){encoding='macroman';}
result=CmapEntry.encode(charmap,encoding);table=new Data;table.writeUInt16(0);table.writeUInt16(1);result.table=table.data.concat(result.subtable);return result;};return CmapTable;})(Table);CmapEntry=(function(){function CmapEntry(data,offset){var code,count,endCode,glyphId,glyphIds,i,idDelta,idRangeOffset,index,saveOffset,segCount,segCountX2,start,startCode,tail,_i,_j,_k,_len;this.platformID=data.readUInt16();this.encodingID=data.readShort();this.offset=offset+data.readInt();saveOffset=data.pos;data.pos=this.offset;this.format=data.readUInt16();this.length=data.readUInt16();this.language=data.readUInt16();this.isUnicode=(this.platformID===3&&this.encodingID===1&&this.format===4)||this.platformID===0&&this.format===4;this.codeMap={};switch(this.format){case 0:for(i=_i=0;_i<256;i=++_i){this.codeMap[i]=data.readByte();}
break;case 4:segCountX2=data.readUInt16();segCount=segCountX2/2;data.pos+=6;endCode=(function(){var _j,_results;_results=[];for(i=_j=0;0<=segCount?_j<segCount:_j>segCount;i=0<=segCount?++_j:--_j){_results.push(data.readUInt16());}
return _results;})();data.pos+=2;startCode=(function(){var _j,_results;_results=[];for(i=_j=0;0<=segCount?_j<segCount:_j>segCount;i=0<=segCount?++_j:--_j){_results.push(data.readUInt16());}
return _results;})();idDelta=(function(){var _j,_results;_results=[];for(i=_j=0;0<=segCount?_j<segCount:_j>segCount;i=0<=segCount?++_j:--_j){_results.push(data.readUInt16());}
return _results;})();idRangeOffset=(function(){var _j,_results;_results=[];for(i=_j=0;0<=segCount?_j<segCount:_j>segCount;i=0<=segCount?++_j:--_j){_results.push(data.readUInt16());}
return _results;})();count=(this.length-data.pos+this.offset)/2;glyphIds=(function(){var _j,_results;_results=[];for(i=_j=0;0<=count?_j<count:_j>count;i=0<=count?++_j:--_j){_results.push(data.readUInt16());}
return _results;})();for(i=_j=0,_len=endCode.length;_j<_len;i=++_j){tail=endCode[i];start=startCode[i];for(code=_k=start;start<=tail?_k<=tail:_k>=tail;code=start<=tail?++_k:--_k){if(idRangeOffset[i]===0){glyphId=code+idDelta[i];}else{index=idRangeOffset[i]/2+(code-start)-(segCount-i);glyphId=glyphIds[index]||0;if(glyphId!==0){glyphId+=idDelta[i];}}
this.codeMap[code]=glyphId&0xFFFF;}}}
data.pos=saveOffset;}
CmapEntry.encode=function(charmap,encoding){var charMap,code,codeMap,codes,delta,deltas,diff,endCode,endCodes,entrySelector,glyphIDs,i,id,indexes,last,map,nextID,offset,old,rangeOffsets,rangeShift,result,searchRange,segCount,segCountX2,startCode,startCodes,startGlyph,subtable,_i,_j,_k,_l,_len,_len1,_len2,_len3,_len4,_len5,_len6,_len7,_m,_n,_name,_o,_p,_q;subtable=new Data;codes=Object.keys(charmap).sort(function(a,b){return a-b;});switch(encoding){case'macroman':id=0;indexes=(function(){var _i,_results;_results=[];for(i=_i=0;_i<256;i=++_i){_results.push(0);}
return _results;})();map={0:0};codeMap={};for(_i=0,_len=codes.length;_i<_len;_i++){code=codes[_i];if(map[_name=charmap[code]]==null){map[_name]=++id;}
codeMap[code]={old:charmap[code],"new":map[charmap[code]]};indexes[code]=map[charmap[code]];}
subtable.writeUInt16(1);subtable.writeUInt16(0);subtable.writeUInt32(12);subtable.writeUInt16(0);subtable.writeUInt16(262);subtable.writeUInt16(0);subtable.write(indexes);return result={charMap:codeMap,subtable:subtable.data,maxGlyphID:id+1};case'unicode':startCodes=[];endCodes=[];nextID=0;map={};charMap={};last=diff=null;for(_j=0,_len1=codes.length;_j<_len1;_j++){code=codes[_j];old=charmap[code];if(map[old]==null){map[old]=++nextID;}
charMap[code]={old:old,"new":map[old]};delta=map[old]-code;if((last==null)||delta!==diff){if(last){endCodes.push(last);}
startCodes.push(code);diff=delta;}
last=code;}
if(last){endCodes.push(last);}
endCodes.push(0xFFFF);startCodes.push(0xFFFF);segCount=startCodes.length;segCountX2=segCount*2;searchRange=2*Math.pow(Math.log(segCount)/Math.LN2,2);entrySelector=Math.log(searchRange/2)/Math.LN2;rangeShift=2*segCount-searchRange;deltas=[];rangeOffsets=[];glyphIDs=[];for(i=_k=0,_len2=startCodes.length;_k<_len2;i=++_k){startCode=startCodes[i];endCode=endCodes[i];if(startCode===0xFFFF){deltas.push(0);rangeOffsets.push(0);break;}
startGlyph=charMap[startCode]["new"];if(startCode-startGlyph>=0x8000){deltas.push(0);rangeOffsets.push(2*(glyphIDs.length+segCount-i));for(code=_l=startCode;startCode<=endCode?_l<=endCode:_l>=endCode;code=startCode<=endCode?++_l:--_l){glyphIDs.push(charMap[code]["new"]);}}else{deltas.push(startGlyph-startCode);rangeOffsets.push(0);}}
subtable.writeUInt16(3);subtable.writeUInt16(1);subtable.writeUInt32(12);subtable.writeUInt16(4);subtable.writeUInt16(16+segCount*8+glyphIDs.length*2);subtable.writeUInt16(0);subtable.writeUInt16(segCountX2);subtable.writeUInt16(searchRange);subtable.writeUInt16(entrySelector);subtable.writeUInt16(rangeShift);for(_m=0,_len3=endCodes.length;_m<_len3;_m++){code=endCodes[_m];subtable.writeUInt16(code);}
subtable.writeUInt16(0);for(_n=0,_len4=startCodes.length;_n<_len4;_n++){code=startCodes[_n];subtable.writeUInt16(code);}
for(_o=0,_len5=deltas.length;_o<_len5;_o++){delta=deltas[_o];subtable.writeUInt16(delta);}
for(_p=0,_len6=rangeOffsets.length;_p<_len6;_p++){offset=rangeOffsets[_p];subtable.writeUInt16(offset);}
for(_q=0,_len7=glyphIDs.length;_q<_len7;_q++){id=glyphIDs[_q];subtable.writeUInt16(id);}
return result={charMap:charMap,subtable:subtable.data,maxGlyphID:nextID+1};}};return CmapEntry;})();module.exports=CmapTable;}).call(this);},function(module,exports,__webpack_require__){(function(){var Data,HmtxTable,Table,__hasProp={}.hasOwnProperty,__extends=function(child,parent){for(var key in parent){if(__hasProp.call(parent,key))child[key]=parent[key];}function ctor(){this.constructor=child;}ctor.prototype=parent.prototype;child.prototype=new ctor();child.__super__=parent.prototype;return child;};Table=__webpack_require__(99);Data=__webpack_require__(34);HmtxTable=(function(_super){__extends(HmtxTable,_super);function HmtxTable(){return HmtxTable.__super__.constructor.apply(this,arguments);}
HmtxTable.prototype.tag='hmtx';HmtxTable.prototype.parse=function(data){var i,last,lsbCount,m,_i,_j,_ref,_results;data.pos=this.offset;this.metrics=[];for(i=_i=0,_ref=this.file.hhea.numberOfMetrics;0<=_ref?_i<_ref:_i>_ref;i=0<=_ref?++_i:--_i){this.metrics.push({advance:data.readUInt16(),lsb:data.readInt16()});}
lsbCount=this.file.maxp.numGlyphs-this.file.hhea.numberOfMetrics;this.leftSideBearings=(function(){var _j,_results;_results=[];for(i=_j=0;0<=lsbCount?_j<lsbCount:_j>lsbCount;i=0<=lsbCount?++_j:--_j){_results.push(data.readInt16());}
return _results;})();this.widths=(function(){var _j,_len,_ref1,_results;_ref1=this.metrics;_results=[];for(_j=0,_len=_ref1.length;_j<_len;_j++){m=_ref1[_j];_results.push(m.advance);}
return _results;}).call(this);last=this.widths[this.widths.length-1];_results=[];for(i=_j=0;0<=lsbCount?_j<lsbCount:_j>lsbCount;i=0<=lsbCount?++_j:--_j){_results.push(this.widths.push(last));}
return _results;};HmtxTable.prototype.forGlyph=function(id){var metrics;if(id in this.metrics){return this.metrics[id];}
return metrics={advance:this.metrics[this.metrics.length-1].advance,lsb:this.leftSideBearings[id-this.metrics.length]};};HmtxTable.prototype.encode=function(mapping){var id,metric,table,_i,_len;table=new Data;for(_i=0,_len=mapping.length;_i<_len;_i++){id=mapping[_i];metric=this.forGlyph(id);table.writeUInt16(metric.advance);table.writeUInt16(metric.lsb);}
return table.data;};return HmtxTable;})(Table);module.exports=HmtxTable;}).call(this);},function(module,exports,__webpack_require__){(function(){var Data,HheaTable,Table,__hasProp={}.hasOwnProperty,__extends=function(child,parent){for(var key in parent){if(__hasProp.call(parent,key))child[key]=parent[key];}function ctor(){this.constructor=child;}ctor.prototype=parent.prototype;child.prototype=new ctor();child.__super__=parent.prototype;return child;};Table=__webpack_require__(99);Data=__webpack_require__(34);HheaTable=(function(_super){__extends(HheaTable,_super);function HheaTable(){return HheaTable.__super__.constructor.apply(this,arguments);}
HheaTable.prototype.tag='hhea';HheaTable.prototype.parse=function(data){data.pos=this.offset;this.version=data.readInt();this.ascender=data.readShort();this.decender=data.readShort();this.lineGap=data.readShort();this.advanceWidthMax=data.readShort();this.minLeftSideBearing=data.readShort();this.minRightSideBearing=data.readShort();this.xMaxExtent=data.readShort();this.caretSlopeRise=data.readShort();this.caretSlopeRun=data.readShort();this.caretOffset=data.readShort();data.pos+=4*2;this.metricDataFormat=data.readShort();return this.numberOfMetrics=data.readUInt16();};HheaTable.prototype.encode=function(ids){var i,table,_i,_ref;table=new Data;table.writeInt(this.version);table.writeShort(this.ascender);table.writeShort(this.decender);table.writeShort(this.lineGap);table.writeShort(this.advanceWidthMax);table.writeShort(this.minLeftSideBearing);table.writeShort(this.minRightSideBearing);table.writeShort(this.xMaxExtent);table.writeShort(this.caretSlopeRise);table.writeShort(this.caretSlopeRun);table.writeShort(this.caretOffset);for(i=_i=0,_ref=4*2;0<=_ref?_i<_ref:_i>_ref;i=0<=_ref?++_i:--_i){table.writeByte(0);}
table.writeShort(this.metricDataFormat);table.writeUInt16(ids.length);return table.data;};return HheaTable;})(Table);module.exports=HheaTable;}).call(this);},function(module,exports,__webpack_require__){(function(){var Data,MaxpTable,Table,__hasProp={}.hasOwnProperty,__extends=function(child,parent){for(var key in parent){if(__hasProp.call(parent,key))child[key]=parent[key];}function ctor(){this.constructor=child;}ctor.prototype=parent.prototype;child.prototype=new ctor();child.__super__=parent.prototype;return child;};Table=__webpack_require__(99);Data=__webpack_require__(34);MaxpTable=(function(_super){__extends(MaxpTable,_super);function MaxpTable(){return MaxpTable.__super__.constructor.apply(this,arguments);}
MaxpTable.prototype.tag='maxp';MaxpTable.prototype.parse=function(data){data.pos=this.offset;this.version=data.readInt();this.numGlyphs=data.readUInt16();this.maxPoints=data.readUInt16();this.maxContours=data.readUInt16();this.maxCompositePoints=data.readUInt16();this.maxComponentContours=data.readUInt16();this.maxZones=data.readUInt16();this.maxTwilightPoints=data.readUInt16();this.maxStorage=data.readUInt16();this.maxFunctionDefs=data.readUInt16();this.maxInstructionDefs=data.readUInt16();this.maxStackElements=data.readUInt16();this.maxSizeOfInstructions=data.readUInt16();this.maxComponentElements=data.readUInt16();return this.maxComponentDepth=data.readUInt16();};MaxpTable.prototype.encode=function(ids){var table;table=new Data;table.writeInt(this.version);table.writeUInt16(ids.length);table.writeUInt16(this.maxPoints);table.writeUInt16(this.maxContours);table.writeUInt16(this.maxCompositePoints);table.writeUInt16(this.maxComponentContours);table.writeUInt16(this.maxZones);table.writeUInt16(this.maxTwilightPoints);table.writeUInt16(this.maxStorage);table.writeUInt16(this.maxFunctionDefs);table.writeUInt16(this.maxInstructionDefs);table.writeUInt16(this.maxStackElements);table.writeUInt16(this.maxSizeOfInstructions);table.writeUInt16(this.maxComponentElements);table.writeUInt16(this.maxComponentDepth);return table.data;};return MaxpTable;})(Table);module.exports=MaxpTable;}).call(this);},function(module,exports,__webpack_require__){(function(){var Data,PostTable,Table,__hasProp={}.hasOwnProperty,__extends=function(child,parent){for(var key in parent){if(__hasProp.call(parent,key))child[key]=parent[key];}function ctor(){this.constructor=child;}ctor.prototype=parent.prototype;child.prototype=new ctor();child.__super__=parent.prototype;return child;};Table=__webpack_require__(99);Data=__webpack_require__(34);PostTable=(function(_super){var POSTSCRIPT_GLYPHS;__extends(PostTable,_super);function PostTable(){return PostTable.__super__.constructor.apply(this,arguments);}
PostTable.prototype.tag='post';PostTable.prototype.parse=function(data){var i,length,numberOfGlyphs,_i,_results;data.pos=this.offset;this.format=data.readInt();this.italicAngle=data.readInt();this.underlinePosition=data.readShort();this.underlineThickness=data.readShort();this.isFixedPitch=data.readInt();this.minMemType42=data.readInt();this.maxMemType42=data.readInt();this.minMemType1=data.readInt();this.maxMemType1=data.readInt();switch(this.format){case 0x00010000:break;case 0x00020000:numberOfGlyphs=data.readUInt16();this.glyphNameIndex=[];for(i=_i=0;0<=numberOfGlyphs?_i<numberOfGlyphs:_i>numberOfGlyphs;i=0<=numberOfGlyphs?++_i:--_i){this.glyphNameIndex.push(data.readUInt16());}
this.names=[];_results=[];while(data.pos<this.offset+this.length){length=data.readByte();_results.push(this.names.push(data.readString(length)));}
return _results;break;case 0x00025000:numberOfGlyphs=data.readUInt16();return this.offsets=data.read(numberOfGlyphs);case 0x00030000:break;case 0x00040000:return this.map=(function(){var _j,_ref,_results1;_results1=[];for(i=_j=0,_ref=this.file.maxp.numGlyphs;0<=_ref?_j<_ref:_j>_ref;i=0<=_ref?++_j:--_j){_results1.push(data.readUInt32());}
return _results1;}).call(this);}};PostTable.prototype.glyphFor=function(code){var index;switch(this.format){case 0x00010000:return POSTSCRIPT_GLYPHS[code]||'.notdef';case 0x00020000:index=this.glyphNameIndex[code];if(index<=257){return POSTSCRIPT_GLYPHS[index];}else{return this.names[index-258]||'.notdef';}
break;case 0x00025000:return POSTSCRIPT_GLYPHS[code+this.offsets[code]]||'.notdef';case 0x00030000:return'.notdef';case 0x00040000:return this.map[code]||0xFFFF;}};PostTable.prototype.encode=function(mapping){var id,index,indexes,position,post,raw,string,strings,table,_i,_j,_k,_len,_len1,_len2;if(!this.exists){return null;}
raw=this.raw();if(this.format===0x00030000){return raw;}
table=new Data(raw.slice(0,32));table.writeUInt32(0x00020000);table.pos=32;indexes=[];strings=[];for(_i=0,_len=mapping.length;_i<_len;_i++){id=mapping[_i];post=this.glyphFor(id);position=POSTSCRIPT_GLYPHS.indexOf(post);if(position!==-1){indexes.push(position);}else{indexes.push(257+strings.length);strings.push(post);}}
table.writeUInt16(Object.keys(mapping).length);for(_j=0,_len1=indexes.length;_j<_len1;_j++){index=indexes[_j];table.writeUInt16(index);}
for(_k=0,_len2=strings.length;_k<_len2;_k++){string=strings[_k];table.writeByte(string.length);table.writeString(string);}
return table.data;};POSTSCRIPT_GLYPHS='.notdef .null nonmarkingreturn space exclam quotedbl numbersign dollar percent\nampersand quotesingle parenleft parenright asterisk plus comma hyphen period slash\nzero one two three four five six seven eight nine colon semicolon less equal greater\nquestion at A B C D E F G H I J K L M N O P Q R S T U V W X Y Z\nbracketleft backslash bracketright asciicircum underscore grave\na b c d e f g h i j k l m n o p q r s t u v w x y z\nbraceleft bar braceright asciitilde Adieresis Aring Ccedilla Eacute Ntilde Odieresis\nUdieresis aacute agrave acircumflex adieresis atilde aring ccedilla eacute egrave\necircumflex edieresis iacute igrave icircumflex idieresis ntilde oacute ograve\nocircumflex odieresis otilde uacute ugrave ucircumflex udieresis dagger degree cent\nsterling section bullet paragraph germandbls registered copyright trademark acute\ndieresis notequal AE Oslash infinity plusminus lessequal greaterequal yen mu\npartialdiff summation product pi integral ordfeminine ordmasculine Omega ae oslash\nquestiondown exclamdown logicalnot radical florin approxequal Delta guillemotleft\nguillemotright ellipsis nonbreakingspace Agrave Atilde Otilde OE oe endash emdash\nquotedblleft quotedblright quoteleft quoteright divide lozenge ydieresis Ydieresis\nfraction currency guilsinglleft guilsinglright fi fl daggerdbl periodcentered\nquotesinglbase quotedblbase perthousand Acircumflex Ecircumflex Aacute Edieresis\nEgrave Iacute Icircumflex Idieresis Igrave Oacute Ocircumflex apple Ograve Uacute\nUcircumflex Ugrave dotlessi circumflex tilde macron breve dotaccent ring cedilla\nhungarumlaut ogonek caron Lslash lslash Scaron scaron Zcaron zcaron brokenbar Eth\neth Yacute yacute Thorn thorn minus multiply onesuperior twosuperior threesuperior\nonehalf onequarter threequarters franc Gbreve gbreve Idotaccent Scedilla scedilla\nCacute cacute Ccaron ccaron dcroat'.split(/\s+/g);return PostTable;})(Table);module.exports=PostTable;}).call(this);},function(module,exports,__webpack_require__){(function(){var OS2Table,Table,__hasProp={}.hasOwnProperty,__extends=function(child,parent){for(var key in parent){if(__hasProp.call(parent,key))child[key]=parent[key];}function ctor(){this.constructor=child;}ctor.prototype=parent.prototype;child.prototype=new ctor();child.__super__=parent.prototype;return child;};Table=__webpack_require__(99);OS2Table=(function(_super){__extends(OS2Table,_super);function OS2Table(){return OS2Table.__super__.constructor.apply(this,arguments);}
OS2Table.prototype.tag='OS/2';OS2Table.prototype.parse=function(data){var i;data.pos=this.offset;this.version=data.readUInt16();this.averageCharWidth=data.readShort();this.weightClass=data.readUInt16();this.widthClass=data.readUInt16();this.type=data.readShort();this.ySubscriptXSize=data.readShort();this.ySubscriptYSize=data.readShort();this.ySubscriptXOffset=data.readShort();this.ySubscriptYOffset=data.readShort();this.ySuperscriptXSize=data.readShort();this.ySuperscriptYSize=data.readShort();this.ySuperscriptXOffset=data.readShort();this.ySuperscriptYOffset=data.readShort();this.yStrikeoutSize=data.readShort();this.yStrikeoutPosition=data.readShort();this.familyClass=data.readShort();this.panose=(function(){var _i,_results;_results=[];for(i=_i=0;_i<10;i=++_i){_results.push(data.readByte());}
return _results;})();this.charRange=(function(){var _i,_results;_results=[];for(i=_i=0;_i<4;i=++_i){_results.push(data.readInt());}
return _results;})();this.vendorID=data.readString(4);this.selection=data.readShort();this.firstCharIndex=data.readShort();this.lastCharIndex=data.readShort();if(this.version>0){this.ascent=data.readShort();this.descent=data.readShort();this.lineGap=data.readShort();this.winAscent=data.readShort();this.winDescent=data.readShort();this.codePageRange=(function(){var _i,_results;_results=[];for(i=_i=0;_i<2;i=++_i){_results.push(data.readInt());}
return _results;})();if(this.version>1){this.xHeight=data.readShort();this.capHeight=data.readShort();this.defaultChar=data.readShort();this.breakChar=data.readShort();return this.maxContext=data.readShort();}}};OS2Table.prototype.encode=function(){return this.raw();};return OS2Table;})(Table);module.exports=OS2Table;}).call(this);},function(module,exports,__webpack_require__){(function(){var Data,LocaTable,Table,__hasProp={}.hasOwnProperty,__extends=function(child,parent){for(var key in parent){if(__hasProp.call(parent,key))child[key]=parent[key];}function ctor(){this.constructor=child;}ctor.prototype=parent.prototype;child.prototype=new ctor();child.__super__=parent.prototype;return child;};Table=__webpack_require__(99);Data=__webpack_require__(34);LocaTable=(function(_super){__extends(LocaTable,_super);function LocaTable(){return LocaTable.__super__.constructor.apply(this,arguments);}
LocaTable.prototype.tag='loca';LocaTable.prototype.parse=function(data){var format,i;data.pos=this.offset;format=this.file.head.indexToLocFormat;if(format===0){return this.offsets=(function(){var _i,_ref,_results;_results=[];for(i=_i=0,_ref=this.length;_i<_ref;i=_i+=2){_results.push(data.readUInt16()*2);}
return _results;}).call(this);}else{return this.offsets=(function(){var _i,_ref,_results;_results=[];for(i=_i=0,_ref=this.length;_i<_ref;i=_i+=4){_results.push(data.readUInt32());}
return _results;}).call(this);}};LocaTable.prototype.indexOf=function(id){return this.offsets[id];};LocaTable.prototype.lengthOf=function(id){return this.offsets[id+1]-this.offsets[id];};LocaTable.prototype.encode=function(offsets){var o,offset,ret,table,_i,_j,_k,_len,_len1,_len2,_ref;table=new Data;for(_i=0,_len=offsets.length;_i<_len;_i++){offset=offsets[_i];if(!(offset>0xFFFF)){continue;}
_ref=this.offsets;for(_j=0,_len1=_ref.length;_j<_len1;_j++){o=_ref[_j];table.writeUInt32(o);}
return ret={format:1,table:table.data};}
for(_k=0,_len2=offsets.length;_k<_len2;_k++){o=offsets[_k];table.writeUInt16(o/2);}
return ret={format:0,table:table.data};};return LocaTable;})(Table);module.exports=LocaTable;}).call(this);},function(module,exports,__webpack_require__){(function(){exports.successorOf=function(input){var added,alphabet,carry,i,index,isUpperCase,last,length,next,result;alphabet='abcdefghijklmnopqrstuvwxyz';length=alphabet.length;result=input;i=input.length;while(i>=0){last=input.charAt(--i);if(isNaN(last)){index=alphabet.indexOf(last.toLowerCase());if(index===-1){next=last;carry=true;}else{next=alphabet.charAt((index+1)%length);isUpperCase=last===last.toUpperCase();if(isUpperCase){next=next.toUpperCase();}
carry=index+1>=length;if(carry&&i===0){added=isUpperCase?'A':'a';result=added+next+result.slice(1);break;}}}else{next=+last+1;carry=next>9;if(carry){next=0;}
if(carry&&i===0){result='1'+next+result.slice(1);break;}}
result=result.slice(0,i)+next+result.slice(i+1);if(!carry){break;}}
return result;};exports.invert=function(object){var key,ret,val;ret={};for(key in object){val=object[key];ret[val]=key;}
return ret;};}).call(this);},function(module,exports,__webpack_require__){(function(){var CompoundGlyph,Data,GlyfTable,SimpleGlyph,Table,__hasProp={}.hasOwnProperty,__extends=function(child,parent){for(var key in parent){if(__hasProp.call(parent,key))child[key]=parent[key];}function ctor(){this.constructor=child;}ctor.prototype=parent.prototype;child.prototype=new ctor();child.__super__=parent.prototype;return child;},__slice=[].slice;Table=__webpack_require__(99);Data=__webpack_require__(34);GlyfTable=(function(_super){__extends(GlyfTable,_super);function GlyfTable(){return GlyfTable.__super__.constructor.apply(this,arguments);}
GlyfTable.prototype.tag='glyf';GlyfTable.prototype.parse=function(data){return this.cache={};};GlyfTable.prototype.glyphFor=function(id){var data,index,length,loca,numberOfContours,raw,xMax,xMin,yMax,yMin;if(id in this.cache){return this.cache[id];}
loca=this.file.loca;data=this.file.contents;index=loca.indexOf(id);length=loca.lengthOf(id);if(length===0){return this.cache[id]=null;}
data.pos=this.offset+index;raw=new Data(data.read(length));numberOfContours=raw.readShort();xMin=raw.readShort();yMin=raw.readShort();xMax=raw.readShort();yMax=raw.readShort();if(numberOfContours===-1){this.cache[id]=new CompoundGlyph(raw,xMin,yMin,xMax,yMax);}else{this.cache[id]=new SimpleGlyph(raw,numberOfContours,xMin,yMin,xMax,yMax);}
return this.cache[id];};GlyfTable.prototype.encode=function(glyphs,mapping,old2new){var glyph,id,offsets,table,_i,_len;table=[];offsets=[];for(_i=0,_len=mapping.length;_i<_len;_i++){id=mapping[_i];glyph=glyphs[id];offsets.push(table.length);if(glyph){table=table.concat(glyph.encode(old2new));}}
offsets.push(table.length);return{table:table,offsets:offsets};};return GlyfTable;})(Table);SimpleGlyph=(function(){function SimpleGlyph(raw,numberOfContours,xMin,yMin,xMax,yMax){this.raw=raw;this.numberOfContours=numberOfContours;this.xMin=xMin;this.yMin=yMin;this.xMax=xMax;this.yMax=yMax;this.compound=false;}
SimpleGlyph.prototype.encode=function(){return this.raw.data;};return SimpleGlyph;})();CompoundGlyph=(function(){var ARG_1_AND_2_ARE_WORDS,MORE_COMPONENTS,WE_HAVE_AN_X_AND_Y_SCALE,WE_HAVE_A_SCALE,WE_HAVE_A_TWO_BY_TWO,WE_HAVE_INSTRUCTIONS;ARG_1_AND_2_ARE_WORDS=0x0001;WE_HAVE_A_SCALE=0x0008;MORE_COMPONENTS=0x0020;WE_HAVE_AN_X_AND_Y_SCALE=0x0040;WE_HAVE_A_TWO_BY_TWO=0x0080;WE_HAVE_INSTRUCTIONS=0x0100;function CompoundGlyph(raw,xMin,yMin,xMax,yMax){var data,flags;this.raw=raw;this.xMin=xMin;this.yMin=yMin;this.xMax=xMax;this.yMax=yMax;this.compound=true;this.glyphIDs=[];this.glyphOffsets=[];data=this.raw;while(true){flags=data.readShort();this.glyphOffsets.push(data.pos);this.glyphIDs.push(data.readShort());if(!(flags&MORE_COMPONENTS)){break;}
if(flags&ARG_1_AND_2_ARE_WORDS){data.pos+=4;}else{data.pos+=2;}
if(flags&WE_HAVE_A_TWO_BY_TWO){data.pos+=8;}else if(flags&WE_HAVE_AN_X_AND_Y_SCALE){data.pos+=4;}else if(flags&WE_HAVE_A_SCALE){data.pos+=2;}}}
CompoundGlyph.prototype.encode=function(mapping){var i,id,result,_i,_len,_ref;result=new Data(__slice.call(this.raw.data));_ref=this.glyphIDs;for(i=_i=0,_len=_ref.length;_i<_len;i=++_i){id=_ref[i];result.pos=this.glyphOffsets[i];result.writeShort(mapping[id]);}
return result.data;};return CompoundGlyph;})();module.exports=GlyfTable;}).call(this);},function(module,exports,__webpack_require__){(function(){var CI_BRK,CP_BRK,DI_BRK,IN_BRK,PR_BRK;exports.DI_BRK=DI_BRK=0;exports.IN_BRK=IN_BRK=1;exports.CI_BRK=CI_BRK=2;exports.CP_BRK=CP_BRK=3;exports.PR_BRK=PR_BRK=4;exports.pairTable=[[PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,CP_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[PR_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,CI_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK],[IN_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,CI_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,DI_BRK,IN_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[IN_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK],[IN_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[IN_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[IN_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[IN_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,IN_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,DI_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,DI_BRK,IN_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,DI_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[IN_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,CI_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,DI_BRK,PR_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[IN_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK],[IN_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,CI_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,IN_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,DI_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,IN_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,DI_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,IN_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,IN_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,DI_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,IN_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,DI_BRK],[DI_BRK,PR_BRK,PR_BRK,IN_BRK,IN_BRK,IN_BRK,PR_BRK,PR_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK,IN_BRK,DI_BRK,DI_BRK,PR_BRK,CI_BRK,PR_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,DI_BRK,IN_BRK]];}).call(this);},function(module,exports,__webpack_require__){(function(){var AI,AL,B2,BA,BB,BK,CB,CJ,CL,CM,CP,CR,EX,GL,H2,H3,HL,HY,ID,IN,IS,JL,JT,JV,LF,NL,NS,NU,OP,PO,PR,QU,RI,SA,SG,SP,SY,WJ,XX,ZW;exports.OP=OP=0;exports.CL=CL=1;exports.CP=CP=2;exports.QU=QU=3;exports.GL=GL=4;exports.NS=NS=5;exports.EX=EX=6;exports.SY=SY=7;exports.IS=IS=8;exports.PR=PR=9;exports.PO=PO=10;exports.NU=NU=11;exports.AL=AL=12;exports.HL=HL=13;exports.ID=ID=14;exports.IN=IN=15;exports.HY=HY=16;exports.BA=BA=17;exports.BB=BB=18;exports.B2=B2=19;exports.ZW=ZW=20;exports.CM=CM=21;exports.WJ=WJ=22;exports.H2=H2=23;exports.H3=H3=24;exports.JL=JL=25;exports.JV=JV=26;exports.JT=JT=27;exports.RI=RI=28;exports.AI=AI=29;exports.BK=BK=30;exports.CB=CB=31;exports.CJ=CJ=32;exports.CR=CR=33;exports.LF=LF=34;exports.NL=NL=35;exports.SA=SA=36;exports.SG=SG=37;exports.SP=SP=38;exports.XX=XX=39;}).call(this);},function(module,exports,__webpack_require__){},function(module,exports,__webpack_require__){if(typeof Object.create==='function'){module.exports=function inherits(ctor,superCtor){ctor.super_=superCtor
ctor.prototype=Object.create(superCtor.prototype,{constructor:{value:ctor,enumerable:false,writable:true,configurable:true}});};}else{module.exports=function inherits(ctor,superCtor){ctor.super_=superCtor
var TempCtor=function(){}
TempCtor.prototype=superCtor.prototype
ctor.prototype=new TempCtor()
ctor.prototype.constructor=ctor}}},function(module,exports,__webpack_require__){'use strict';var utils=__webpack_require__(98);var Z_FIXED=4;var Z_BINARY=0;var Z_TEXT=1;var Z_UNKNOWN=2;function zero(buf){var len=buf.length;while(--len>=0){buf[len]=0;}}
var STORED_BLOCK=0;var STATIC_TREES=1;var DYN_TREES=2;var MIN_MATCH=3;var MAX_MATCH=258;var LENGTH_CODES=29;var LITERALS=256;var L_CODES=LITERALS+1+LENGTH_CODES;var D_CODES=30;var BL_CODES=19;var HEAP_SIZE=2*L_CODES+1;var MAX_BITS=15;var Buf_size=16;var MAX_BL_BITS=7;var END_BLOCK=256;var REP_3_6=16;var REPZ_3_10=17;var REPZ_11_138=18;var extra_lbits=[0,0,0,0,0,0,0,0,1,1,1,1,2,2,2,2,3,3,3,3,4,4,4,4,5,5,5,5,0];var extra_dbits=[0,0,0,0,1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,9,10,10,11,11,12,12,13,13];var extra_blbits=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,3,7];var bl_order=[16,17,18,0,8,7,9,6,10,5,11,4,12,3,13,2,14,1,15];var DIST_CODE_LEN=512;var static_ltree=new Array((L_CODES+2)*2);zero(static_ltree);var static_dtree=new Array(D_CODES*2);zero(static_dtree);var _dist_code=new Array(DIST_CODE_LEN);zero(_dist_code);var _length_code=new Array(MAX_MATCH-MIN_MATCH+1);zero(_length_code);var base_length=new Array(LENGTH_CODES);zero(base_length);var base_dist=new Array(D_CODES);zero(base_dist);var StaticTreeDesc=function(static_tree,extra_bits,extra_base,elems,max_length){this.static_tree=static_tree;this.extra_bits=extra_bits;this.extra_base=extra_base;this.elems=elems;this.max_length=max_length;this.has_stree=static_tree&&static_tree.length;};var static_l_desc;var static_d_desc;var static_bl_desc;var TreeDesc=function(dyn_tree,stat_desc){this.dyn_tree=dyn_tree;this.max_code=0;this.stat_desc=stat_desc;};function d_code(dist){return dist<256?_dist_code[dist]:_dist_code[256+(dist>>>7)];}
function put_short(s,w){s.pending_buf[s.pending++]=(w)&0xff;s.pending_buf[s.pending++]=(w>>>8)&0xff;}
function send_bits(s,value,length){if(s.bi_valid>(Buf_size-length)){s.bi_buf|=(value<<s.bi_valid)&0xffff;put_short(s,s.bi_buf);s.bi_buf=value>>(Buf_size-s.bi_valid);s.bi_valid+=length-Buf_size;}else{s.bi_buf|=(value<<s.bi_valid)&0xffff;s.bi_valid+=length;}}
function send_code(s,c,tree){send_bits(s,tree[c*2],tree[c*2+1]);}
function bi_reverse(code,len){var res=0;do{res|=code&1;code>>>=1;res<<=1;}while(--len>0);return res>>>1;}
function bi_flush(s){if(s.bi_valid===16){put_short(s,s.bi_buf);s.bi_buf=0;s.bi_valid=0;}else if(s.bi_valid>=8){s.pending_buf[s.pending++]=s.bi_buf&0xff;s.bi_buf>>=8;s.bi_valid-=8;}}
function gen_bitlen(s,desc)
{var tree=desc.dyn_tree;var max_code=desc.max_code;var stree=desc.stat_desc.static_tree;var has_stree=desc.stat_desc.has_stree;var extra=desc.stat_desc.extra_bits;var base=desc.stat_desc.extra_base;var max_length=desc.stat_desc.max_length;var h;var n,m;var bits;var xbits;var f;var overflow=0;for(bits=0;bits<=MAX_BITS;bits++){s.bl_count[bits]=0;}
tree[s.heap[s.heap_max]*2+1]=0;for(h=s.heap_max+1;h<HEAP_SIZE;h++){n=s.heap[h];bits=tree[tree[n*2+1]*2+1]+1;if(bits>max_length){bits=max_length;overflow++;}
tree[n*2+1]=bits;if(n>max_code){continue;}
s.bl_count[bits]++;xbits=0;if(n>=base){xbits=extra[n-base];}
f=tree[n*2];s.opt_len+=f*(bits+xbits);if(has_stree){s.static_len+=f*(stree[n*2+1]+xbits);}}
if(overflow===0){return;}
do{bits=max_length-1;while(s.bl_count[bits]===0){bits--;}
s.bl_count[bits]--;s.bl_count[bits+1]+=2;s.bl_count[max_length]--;overflow-=2;}while(overflow>0);for(bits=max_length;bits!==0;bits--){n=s.bl_count[bits];while(n!==0){m=s.heap[--h];if(m>max_code){continue;}
if(tree[m*2+1]!==bits){s.opt_len+=(bits-tree[m*2+1])*tree[m*2];tree[m*2+1]=bits;}
n--;}}}
function gen_codes(tree,max_code,bl_count)
{var next_code=new Array(MAX_BITS+1);var code=0;var bits;var n;for(bits=1;bits<=MAX_BITS;bits++){next_code[bits]=code=(code+bl_count[bits-1])<<1;}
for(n=0;n<=max_code;n++){var len=tree[n*2+1];if(len===0){continue;}
tree[n*2]=bi_reverse(next_code[len]++,len);}}
function tr_static_init(){var n;var bits;var length;var code;var dist;var bl_count=new Array(MAX_BITS+1);length=0;for(code=0;code<LENGTH_CODES-1;code++){base_length[code]=length;for(n=0;n<(1<<extra_lbits[code]);n++){_length_code[length++]=code;}}
_length_code[length-1]=code;dist=0;for(code=0;code<16;code++){base_dist[code]=dist;for(n=0;n<(1<<extra_dbits[code]);n++){_dist_code[dist++]=code;}}
dist>>=7;for(;code<D_CODES;code++){base_dist[code]=dist<<7;for(n=0;n<(1<<(extra_dbits[code]-7));n++){_dist_code[256+dist++]=code;}}
for(bits=0;bits<=MAX_BITS;bits++){bl_count[bits]=0;}
n=0;while(n<=143){static_ltree[n*2+1]=8;n++;bl_count[8]++;}
while(n<=255){static_ltree[n*2+1]=9;n++;bl_count[9]++;}
while(n<=279){static_ltree[n*2+1]=7;n++;bl_count[7]++;}
while(n<=287){static_ltree[n*2+1]=8;n++;bl_count[8]++;}
gen_codes(static_ltree,L_CODES+1,bl_count);for(n=0;n<D_CODES;n++){static_dtree[n*2+1]=5;static_dtree[n*2]=bi_reverse(n,5);}
static_l_desc=new StaticTreeDesc(static_ltree,extra_lbits,LITERALS+1,L_CODES,MAX_BITS);static_d_desc=new StaticTreeDesc(static_dtree,extra_dbits,0,D_CODES,MAX_BITS);static_bl_desc=new StaticTreeDesc(new Array(0),extra_blbits,0,BL_CODES,MAX_BL_BITS);}
function init_block(s){var n;for(n=0;n<L_CODES;n++){s.dyn_ltree[n*2]=0;}
for(n=0;n<D_CODES;n++){s.dyn_dtree[n*2]=0;}
for(n=0;n<BL_CODES;n++){s.bl_tree[n*2]=0;}
s.dyn_ltree[END_BLOCK*2]=1;s.opt_len=s.static_len=0;s.last_lit=s.matches=0;}
function bi_windup(s)
{if(s.bi_valid>8){put_short(s,s.bi_buf);}else if(s.bi_valid>0){s.pending_buf[s.pending++]=s.bi_buf;}
s.bi_buf=0;s.bi_valid=0;}
function copy_block(s,buf,len,header)
{bi_windup(s);if(header){put_short(s,len);put_short(s,~len);}
utils.arraySet(s.pending_buf,s.window,buf,len,s.pending);s.pending+=len;}
function smaller(tree,n,m,depth){var _n2=n*2;var _m2=m*2;return(tree[_n2]<tree[_m2]||(tree[_n2]===tree[_m2]&&depth[n]<=depth[m]));}
function pqdownheap(s,tree,k)
{var v=s.heap[k];var j=k<<1;while(j<=s.heap_len){if(j<s.heap_len&&smaller(tree,s.heap[j+1],s.heap[j],s.depth)){j++;}
if(smaller(tree,v,s.heap[j],s.depth)){break;}
s.heap[k]=s.heap[j];k=j;j<<=1;}
s.heap[k]=v;}
function compress_block(s,ltree,dtree)
{var dist;var lc;var lx=0;var code;var extra;if(s.last_lit!==0){do{dist=(s.pending_buf[s.d_buf+lx*2]<<8)|(s.pending_buf[s.d_buf+lx*2+1]);lc=s.pending_buf[s.l_buf+lx];lx++;if(dist===0){send_code(s,lc,ltree);}else{code=_length_code[lc];send_code(s,code+LITERALS+1,ltree);extra=extra_lbits[code];if(extra!==0){lc-=base_length[code];send_bits(s,lc,extra);}
dist--;code=d_code(dist);send_code(s,code,dtree);extra=extra_dbits[code];if(extra!==0){dist-=base_dist[code];send_bits(s,dist,extra);}}}while(lx<s.last_lit);}
send_code(s,END_BLOCK,ltree);}
function build_tree(s,desc)
{var tree=desc.dyn_tree;var stree=desc.stat_desc.static_tree;var has_stree=desc.stat_desc.has_stree;var elems=desc.stat_desc.elems;var n,m;var max_code=-1;var node;s.heap_len=0;s.heap_max=HEAP_SIZE;for(n=0;n<elems;n++){if(tree[n*2]!==0){s.heap[++s.heap_len]=max_code=n;s.depth[n]=0;}else{tree[n*2+1]=0;}}
while(s.heap_len<2){node=s.heap[++s.heap_len]=(max_code<2?++max_code:0);tree[node*2]=1;s.depth[node]=0;s.opt_len--;if(has_stree){s.static_len-=stree[node*2+1];}}
desc.max_code=max_code;for(n=(s.heap_len>>1);n>=1;n--){pqdownheap(s,tree,n);}
node=elems;do{n=s.heap[1];s.heap[1]=s.heap[s.heap_len--];pqdownheap(s,tree,1);m=s.heap[1];s.heap[--s.heap_max]=n;s.heap[--s.heap_max]=m;tree[node*2]=tree[n*2]+tree[m*2];s.depth[node]=(s.depth[n]>=s.depth[m]?s.depth[n]:s.depth[m])+1;tree[n*2+1]=tree[m*2+1]=node;s.heap[1]=node++;pqdownheap(s,tree,1);}while(s.heap_len>=2);s.heap[--s.heap_max]=s.heap[1];gen_bitlen(s,desc);gen_codes(tree,max_code,s.bl_count);}
function scan_tree(s,tree,max_code)
{var n;var prevlen=-1;var curlen;var nextlen=tree[0*2+1];var count=0;var max_count=7;var min_count=4;if(nextlen===0){max_count=138;min_count=3;}
tree[(max_code+1)*2+1]=0xffff;for(n=0;n<=max_code;n++){curlen=nextlen;nextlen=tree[(n+1)*2+1];if(++count<max_count&&curlen===nextlen){continue;}else if(count<min_count){s.bl_tree[curlen*2]+=count;}else if(curlen!==0){if(curlen!==prevlen){s.bl_tree[curlen*2]++;}
s.bl_tree[REP_3_6*2]++;}else if(count<=10){s.bl_tree[REPZ_3_10*2]++;}else{s.bl_tree[REPZ_11_138*2]++;}
count=0;prevlen=curlen;if(nextlen===0){max_count=138;min_count=3;}else if(curlen===nextlen){max_count=6;min_count=3;}else{max_count=7;min_count=4;}}}
function send_tree(s,tree,max_code)
{var n;var prevlen=-1;var curlen;var nextlen=tree[0*2+1];var count=0;var max_count=7;var min_count=4;if(nextlen===0){max_count=138;min_count=3;}
for(n=0;n<=max_code;n++){curlen=nextlen;nextlen=tree[(n+1)*2+1];if(++count<max_count&&curlen===nextlen){continue;}else if(count<min_count){do{send_code(s,curlen,s.bl_tree);}while(--count!==0);}else if(curlen!==0){if(curlen!==prevlen){send_code(s,curlen,s.bl_tree);count--;}
send_code(s,REP_3_6,s.bl_tree);send_bits(s,count-3,2);}else if(count<=10){send_code(s,REPZ_3_10,s.bl_tree);send_bits(s,count-3,3);}else{send_code(s,REPZ_11_138,s.bl_tree);send_bits(s,count-11,7);}
count=0;prevlen=curlen;if(nextlen===0){max_count=138;min_count=3;}else if(curlen===nextlen){max_count=6;min_count=3;}else{max_count=7;min_count=4;}}}
function build_bl_tree(s){var max_blindex;scan_tree(s,s.dyn_ltree,s.l_desc.max_code);scan_tree(s,s.dyn_dtree,s.d_desc.max_code);build_tree(s,s.bl_desc);for(max_blindex=BL_CODES-1;max_blindex>=3;max_blindex--){if(s.bl_tree[bl_order[max_blindex]*2+1]!==0){break;}}
s.opt_len+=3*(max_blindex+1)+5+5+4;return max_blindex;}
function send_all_trees(s,lcodes,dcodes,blcodes)
{var rank;send_bits(s,lcodes-257,5);send_bits(s,dcodes-1,5);send_bits(s,blcodes-4,4);for(rank=0;rank<blcodes;rank++){send_bits(s,s.bl_tree[bl_order[rank]*2+1],3);}
send_tree(s,s.dyn_ltree,lcodes-1);send_tree(s,s.dyn_dtree,dcodes-1);}
function detect_data_type(s){var black_mask=0xf3ffc07f;var n;for(n=0;n<=31;n++,black_mask>>>=1){if((black_mask&1)&&(s.dyn_ltree[n*2]!==0)){return Z_BINARY;}}
if(s.dyn_ltree[9*2]!==0||s.dyn_ltree[10*2]!==0||s.dyn_ltree[13*2]!==0){return Z_TEXT;}
for(n=32;n<LITERALS;n++){if(s.dyn_ltree[n*2]!==0){return Z_TEXT;}}
return Z_BINARY;}
var static_init_done=false;function _tr_init(s)
{if(!static_init_done){tr_static_init();static_init_done=true;}
s.l_desc=new TreeDesc(s.dyn_ltree,static_l_desc);s.d_desc=new TreeDesc(s.dyn_dtree,static_d_desc);s.bl_desc=new TreeDesc(s.bl_tree,static_bl_desc);s.bi_buf=0;s.bi_valid=0;init_block(s);}
function _tr_stored_block(s,buf,stored_len,last)
{send_bits(s,(STORED_BLOCK<<1)+(last?1:0),3);copy_block(s,buf,stored_len,true);}
function _tr_align(s){send_bits(s,STATIC_TREES<<1,3);send_code(s,END_BLOCK,static_ltree);bi_flush(s);}
function _tr_flush_block(s,buf,stored_len,last)
{var opt_lenb,static_lenb;var max_blindex=0;if(s.level>0){if(s.strm.data_type===Z_UNKNOWN){s.strm.data_type=detect_data_type(s);}
build_tree(s,s.l_desc);build_tree(s,s.d_desc);max_blindex=build_bl_tree(s);opt_lenb=(s.opt_len+3+7)>>>3;static_lenb=(s.static_len+3+7)>>>3;if(static_lenb<=opt_lenb){opt_lenb=static_lenb;}}else{opt_lenb=static_lenb=stored_len+5;}
if((stored_len+4<=opt_lenb)&&(buf!==-1)){_tr_stored_block(s,buf,stored_len,last);}else if(s.strategy===Z_FIXED||static_lenb===opt_lenb){send_bits(s,(STATIC_TREES<<1)+(last?1:0),3);compress_block(s,static_ltree,static_dtree);}else{send_bits(s,(DYN_TREES<<1)+(last?1:0),3);send_all_trees(s,s.l_desc.max_code+1,s.d_desc.max_code+1,max_blindex+1);compress_block(s,s.dyn_ltree,s.dyn_dtree);}
init_block(s);if(last){bi_windup(s);}}
function _tr_tally(s,dist,lc)
{s.pending_buf[s.d_buf+s.last_lit*2]=(dist>>>8)&0xff;s.pending_buf[s.d_buf+s.last_lit*2+1]=dist&0xff;s.pending_buf[s.l_buf+s.last_lit]=lc&0xff;s.last_lit++;if(dist===0){s.dyn_ltree[lc*2]++;}else{s.matches++;dist--;s.dyn_ltree[(_length_code[lc]+LITERALS+1)*2]++;s.dyn_dtree[d_code(dist)*2]++;}
return(s.last_lit===s.lit_bufsize-1);}
exports._tr_init=_tr_init;exports._tr_stored_block=_tr_stored_block;exports._tr_flush_block=_tr_flush_block;exports._tr_tally=_tr_tally;exports._tr_align=_tr_align;},function(module,exports,__webpack_require__){'use strict';function adler32(adler,buf,len,pos){var s1=(adler&0xffff)|0,s2=((adler>>>16)&0xffff)|0,n=0;while(len!==0){n=len>2000?2000:len;len-=n;do{s1=(s1+buf[pos++])|0;s2=(s2+s1)|0;}while(--n);s1%=65521;s2%=65521;}
return(s1|(s2<<16))|0;}
module.exports=adler32;},function(module,exports,__webpack_require__){'use strict';function makeTable(){var c,table=[];for(var n=0;n<256;n++){c=n;for(var k=0;k<8;k++){c=((c&1)?(0xEDB88320^(c>>>1)):(c>>>1));}
table[n]=c;}
return table;}
var crcTable=makeTable();function crc32(crc,buf,len,pos){var t=crcTable,end=pos+len;crc=crc^(-1);for(var i=pos;i<end;i++){crc=(crc>>>8)^t[(crc^buf[i])&0xFF];}
return(crc^(-1));}
module.exports=crc32;},function(module,exports,__webpack_require__){'use strict';var TYPED_OK=(typeof Uint8Array!=='undefined')&&(typeof Uint16Array!=='undefined')&&(typeof Int32Array!=='undefined');exports.assign=function(obj){var sources=Array.prototype.slice.call(arguments,1);while(sources.length){var source=sources.shift();if(!source){continue;}
if(typeof(source)!=='object'){throw new TypeError(source+'must be non-object');}
for(var p in source){if(source.hasOwnProperty(p)){obj[p]=source[p];}}}
return obj;};exports.shrinkBuf=function(buf,size){if(buf.length===size){return buf;}
if(buf.subarray){return buf.subarray(0,size);}
buf.length=size;return buf;};var fnTyped={arraySet:function(dest,src,src_offs,len,dest_offs){if(src.subarray&&dest.subarray){dest.set(src.subarray(src_offs,src_offs+len),dest_offs);return;}
for(var i=0;i<len;i++){dest[dest_offs+i]=src[src_offs+i];}},flattenChunks:function(chunks){var i,l,len,pos,chunk,result;len=0;for(i=0,l=chunks.length;i<l;i++){len+=chunks[i].length;}
result=new Uint8Array(len);pos=0;for(i=0,l=chunks.length;i<l;i++){chunk=chunks[i];result.set(chunk,pos);pos+=chunk.length;}
return result;}};var fnUntyped={arraySet:function(dest,src,src_offs,len,dest_offs){for(var i=0;i<len;i++){dest[dest_offs+i]=src[src_offs+i];}},flattenChunks:function(chunks){return[].concat.apply([],chunks);}};exports.setTyped=function(on){if(on){exports.Buf8=Uint8Array;exports.Buf16=Uint16Array;exports.Buf32=Int32Array;exports.assign(exports,fnTyped);}else{exports.Buf8=Array;exports.Buf16=Array;exports.Buf32=Array;exports.assign(exports,fnUntyped);}};exports.setTyped(TYPED_OK);},function(module,exports,__webpack_require__){(function(){var Table;Table=(function(){function Table(file){var info;this.file=file;info=this.file.directory.tables[this.tag];this.exists=!!info;if(info){this.offset=info.offset,this.length=info.length;this.parse(this.file.contents);}}
Table.prototype.parse=function(){};Table.prototype.encode=function(){};Table.prototype.raw=function(){if(!this.exists){return null;}
this.file.contents.pos=this.offset;return this.file.contents.read(this.length);};return Table;})();module.exports=Table;}).call(this);},function(module,exports,__webpack_require__){var UnicodeTrie,__slice=[].slice;UnicodeTrie=(function(){var DATA_BLOCK_LENGTH,DATA_GRANULARITY,DATA_MASK,INDEX_1_OFFSET,INDEX_2_BLOCK_LENGTH,INDEX_2_BMP_LENGTH,INDEX_2_MASK,INDEX_SHIFT,LSCP_INDEX_2_LENGTH,LSCP_INDEX_2_OFFSET,OMITTED_BMP_INDEX_1_LENGTH,SHIFT_1,SHIFT_1_2,SHIFT_2,UTF8_2B_INDEX_2_LENGTH,UTF8_2B_INDEX_2_OFFSET;SHIFT_1=6+5;SHIFT_2=5;SHIFT_1_2=SHIFT_1-SHIFT_2;OMITTED_BMP_INDEX_1_LENGTH=0x10000>>SHIFT_1;INDEX_2_BLOCK_LENGTH=1<<SHIFT_1_2;INDEX_2_MASK=INDEX_2_BLOCK_LENGTH-1;INDEX_SHIFT=2;DATA_BLOCK_LENGTH=1<<SHIFT_2;DATA_MASK=DATA_BLOCK_LENGTH-1;LSCP_INDEX_2_OFFSET=0x10000>>SHIFT_2;LSCP_INDEX_2_LENGTH=0x400>>SHIFT_2;INDEX_2_BMP_LENGTH=LSCP_INDEX_2_OFFSET+LSCP_INDEX_2_LENGTH;UTF8_2B_INDEX_2_OFFSET=INDEX_2_BMP_LENGTH;UTF8_2B_INDEX_2_LENGTH=0x800>>6;INDEX_1_OFFSET=UTF8_2B_INDEX_2_OFFSET+UTF8_2B_INDEX_2_LENGTH;DATA_GRANULARITY=1<<INDEX_SHIFT;function UnicodeTrie(json){var _ref,_ref1;if(json==null){json={};}
this.data=json.data||[];this.highStart=(_ref=json.highStart)!=null?_ref:0;this.errorValue=(_ref1=json.errorValue)!=null?_ref1:-1;}
UnicodeTrie.prototype.get=function(codePoint){var index;if(codePoint<0||codePoint>0x10ffff){return this.errorValue;}
if(codePoint<0xd800||(codePoint>0xdbff&&codePoint<=0xffff)){index=(this.data[codePoint>>SHIFT_2]<<INDEX_SHIFT)+(codePoint&DATA_MASK);return this.data[index];}
if(codePoint<=0xffff){index=(this.data[LSCP_INDEX_2_OFFSET+((codePoint-0xd800)>>SHIFT_2)]<<INDEX_SHIFT)+(codePoint&DATA_MASK);return this.data[index];}
if(codePoint<this.highStart){index=this.data[(INDEX_1_OFFSET-OMITTED_BMP_INDEX_1_LENGTH)+(codePoint>>SHIFT_1)];index=this.data[index+((codePoint>>SHIFT_2)&INDEX_2_MASK)];index=(index<<INDEX_SHIFT)+(codePoint&DATA_MASK);return this.data[index];}
return this.data[this.data.length-DATA_GRANULARITY];};UnicodeTrie.prototype.toJSON=function(){var res;res={data:__slice.call(this.data),highStart:this.highStart,errorValue:this.errorValue};return res;};return UnicodeTrie;})();module.exports=UnicodeTrie;},function(module,exports,__webpack_require__){var Buffer=__webpack_require__(4).Buffer;var isBufferEncoding=Buffer.isEncoding||function(encoding){switch(encoding&&encoding.toLowerCase()){case'hex':case'utf8':case'utf-8':case'ascii':case'binary':case'base64':case'ucs2':case'ucs-2':case'utf16le':case'utf-16le':case'raw':return true;default:return false;}}
function assertEncoding(encoding){if(encoding&&!isBufferEncoding(encoding)){throw new Error('Unknown encoding: '+encoding);}}
var StringDecoder=exports.StringDecoder=function(encoding){this.encoding=(encoding||'utf8').toLowerCase().replace(/[-_]/,'');assertEncoding(encoding);switch(this.encoding){case'utf8':this.surrogateSize=3;break;case'ucs2':case'utf16le':this.surrogateSize=2;this.detectIncompleteChar=utf16DetectIncompleteChar;break;case'base64':this.surrogateSize=3;this.detectIncompleteChar=base64DetectIncompleteChar;break;default:this.write=passThroughWrite;return;}
this.charBuffer=new Buffer(6);this.charReceived=0;this.charLength=0;};StringDecoder.prototype.write=function(buffer){var charStr='';while(this.charLength){var available=(buffer.length>=this.charLength-this.charReceived)?this.charLength-this.charReceived:buffer.length;buffer.copy(this.charBuffer,this.charReceived,0,available);this.charReceived+=available;if(this.charReceived<this.charLength){return'';}
buffer=buffer.slice(available,buffer.length);charStr=this.charBuffer.slice(0,this.charLength).toString(this.encoding);var charCode=charStr.charCodeAt(charStr.length-1);if(charCode>=0xD800&&charCode<=0xDBFF){this.charLength+=this.surrogateSize;charStr='';continue;}
this.charReceived=this.charLength=0;if(buffer.length===0){return charStr;}
break;}
this.detectIncompleteChar(buffer);var end=buffer.length;if(this.charLength){buffer.copy(this.charBuffer,0,buffer.length-this.charReceived,end);end-=this.charReceived;}
charStr+=buffer.toString(this.encoding,0,end);var end=charStr.length-1;var charCode=charStr.charCodeAt(end);if(charCode>=0xD800&&charCode<=0xDBFF){var size=this.surrogateSize;this.charLength+=size;this.charReceived+=size;this.charBuffer.copy(this.charBuffer,size,0,size);buffer.copy(this.charBuffer,0,0,size);return charStr.substring(0,end);}
return charStr;};StringDecoder.prototype.detectIncompleteChar=function(buffer){var i=(buffer.length>=3)?3:buffer.length;for(;i>0;i--){var c=buffer[buffer.length-i];if(i==1&&c>>5==0x06){this.charLength=2;break;}
if(i<=2&&c>>4==0x0E){this.charLength=3;break;}
if(i<=3&&c>>3==0x1E){this.charLength=4;break;}}
this.charReceived=i;};StringDecoder.prototype.end=function(buffer){var res='';if(buffer&&buffer.length)
res=this.write(buffer);if(this.charReceived){var cr=this.charReceived;var buf=this.charBuffer;var enc=this.encoding;res+=buf.slice(0,cr).toString(enc);}
return res;};function passThroughWrite(buffer){return buffer.toString(this.encoding);}
function utf16DetectIncompleteChar(buffer){this.charReceived=buffer.length%2;this.charLength=this.charReceived?2:0;}
function base64DetectIncompleteChar(buffer){this.charReceived=buffer.length%3;this.charLength=this.charReceived?3:0;}},function(module,exports,__webpack_require__){'use strict';var BAD=30;var TYPE=12;module.exports=function inflate_fast(strm,start){var state;var _in;var last;var _out;var beg;var end;var dmax;var wsize;var whave;var wnext;var window;var hold;var bits;var lcode;var dcode;var lmask;var dmask;var here;var op;var len;var dist;var from;var from_source;var input,output;state=strm.state;_in=strm.next_in;input=strm.input;last=_in+(strm.avail_in-5);_out=strm.next_out;output=strm.output;beg=_out-(start-strm.avail_out);end=_out+(strm.avail_out-257);dmax=state.dmax;wsize=state.wsize;whave=state.whave;wnext=state.wnext;window=state.window;hold=state.hold;bits=state.bits;lcode=state.lencode;dcode=state.distcode;lmask=(1<<state.lenbits)-1;dmask=(1<<state.distbits)-1;top:do{if(bits<15){hold+=input[_in++]<<bits;bits+=8;hold+=input[_in++]<<bits;bits+=8;}
here=lcode[hold&lmask];dolen:for(;;){op=here>>>24;hold>>>=op;bits-=op;op=(here>>>16)&0xff;if(op===0){output[_out++]=here&0xffff;}
else if(op&16){len=here&0xffff;op&=15;if(op){if(bits<op){hold+=input[_in++]<<bits;bits+=8;}
len+=hold&((1<<op)-1);hold>>>=op;bits-=op;}
if(bits<15){hold+=input[_in++]<<bits;bits+=8;hold+=input[_in++]<<bits;bits+=8;}
here=dcode[hold&dmask];dodist:for(;;){op=here>>>24;hold>>>=op;bits-=op;op=(here>>>16)&0xff;if(op&16){dist=here&0xffff;op&=15;if(bits<op){hold+=input[_in++]<<bits;bits+=8;if(bits<op){hold+=input[_in++]<<bits;bits+=8;}}
dist+=hold&((1<<op)-1);if(dist>dmax){strm.msg='invalid distance too far back';state.mode=BAD;break top;}
hold>>>=op;bits-=op;op=_out-beg;if(dist>op){op=dist-op;if(op>whave){if(state.sane){strm.msg='invalid distance too far back';state.mode=BAD;break top;}}
from=0;from_source=window;if(wnext===0){from+=wsize-op;if(op<len){len-=op;do{output[_out++]=window[from++];}while(--op);from=_out-dist;from_source=output;}}
else if(wnext<op){from+=wsize+wnext-op;op-=wnext;if(op<len){len-=op;do{output[_out++]=window[from++];}while(--op);from=0;if(wnext<len){op=wnext;len-=op;do{output[_out++]=window[from++];}while(--op);from=_out-dist;from_source=output;}}}
else{from+=wnext-op;if(op<len){len-=op;do{output[_out++]=window[from++];}while(--op);from=_out-dist;from_source=output;}}
while(len>2){output[_out++]=from_source[from++];output[_out++]=from_source[from++];output[_out++]=from_source[from++];len-=3;}
if(len){output[_out++]=from_source[from++];if(len>1){output[_out++]=from_source[from++];}}}
else{from=_out-dist;do{output[_out++]=output[from++];output[_out++]=output[from++];output[_out++]=output[from++];len-=3;}while(len>2);if(len){output[_out++]=output[from++];if(len>1){output[_out++]=output[from++];}}}}
else if((op&64)===0){here=dcode[(here&0xffff)+(hold&((1<<op)-1))];continue dodist;}
else{strm.msg='invalid distance code';state.mode=BAD;break top;}
break;}}
else if((op&64)===0){here=lcode[(here&0xffff)+(hold&((1<<op)-1))];continue dolen;}
else if(op&32){state.mode=TYPE;break top;}
else{strm.msg='invalid literal/length code';state.mode=BAD;break top;}
break;}}while(_in<last&&_out<end);len=bits>>3;_in-=len;bits-=len<<3;hold&=(1<<bits)-1;strm.next_in=_in;strm.next_out=_out;strm.avail_in=(_in<last?5+(last-_in):5-(_in-last));strm.avail_out=(_out<end?257+(end-_out):257-(_out-end));state.hold=hold;state.bits=bits;return;};},function(module,exports,__webpack_require__){'use strict';var utils=__webpack_require__(98);var MAXBITS=15;var ENOUGH_LENS=852;var ENOUGH_DISTS=592;var CODES=0;var LENS=1;var DISTS=2;var lbase=[3,4,5,6,7,8,9,10,11,13,15,17,19,23,27,31,35,43,51,59,67,83,99,115,131,163,195,227,258,0,0];var lext=[16,16,16,16,16,16,16,16,17,17,17,17,18,18,18,18,19,19,19,19,20,20,20,20,21,21,21,21,16,72,78];var dbase=[1,2,3,4,5,7,9,13,17,25,33,49,65,97,129,193,257,385,513,769,1025,1537,2049,3073,4097,6145,8193,12289,16385,24577,0,0];var dext=[16,16,16,16,17,17,18,18,19,19,20,20,21,21,22,22,23,23,24,24,25,25,26,26,27,27,28,28,29,29,64,64];module.exports=function inflate_table(type,lens,lens_index,codes,table,table_index,work,opts)
{var bits=opts.bits;var len=0;var sym=0;var min=0,max=0;var root=0;var curr=0;var drop=0;var left=0;var used=0;var huff=0;var incr;var fill;var low;var mask;var next;var base=null;var base_index=0;var end;var count=new utils.Buf16(MAXBITS+1);var offs=new utils.Buf16(MAXBITS+1);var extra=null;var extra_index=0;var here_bits,here_op,here_val;for(len=0;len<=MAXBITS;len++){count[len]=0;}
for(sym=0;sym<codes;sym++){count[lens[lens_index+sym]]++;}
root=bits;for(max=MAXBITS;max>=1;max--){if(count[max]!==0){break;}}
if(root>max){root=max;}
if(max===0){table[table_index++]=(1<<24)|(64<<16)|0;table[table_index++]=(1<<24)|(64<<16)|0;opts.bits=1;return 0;}
for(min=1;min<max;min++){if(count[min]!==0){break;}}
if(root<min){root=min;}
left=1;for(len=1;len<=MAXBITS;len++){left<<=1;left-=count[len];if(left<0){return-1;}}
if(left>0&&(type===CODES||max!==1)){return-1;}
offs[1]=0;for(len=1;len<MAXBITS;len++){offs[len+1]=offs[len]+count[len];}
for(sym=0;sym<codes;sym++){if(lens[lens_index+sym]!==0){work[offs[lens[lens_index+sym]]++]=sym;}}
if(type===CODES){base=extra=work;end=19;}else if(type===LENS){base=lbase;base_index-=257;extra=lext;extra_index-=257;end=256;}else{base=dbase;extra=dext;end=-1;}
huff=0;sym=0;len=min;next=table_index;curr=root;drop=0;low=-1;used=1<<root;mask=used-1;if((type===LENS&&used>ENOUGH_LENS)||(type===DISTS&&used>ENOUGH_DISTS)){return 1;}
var i=0;for(;;){i++;here_bits=len-drop;if(work[sym]<end){here_op=0;here_val=work[sym];}
else if(work[sym]>end){here_op=extra[extra_index+work[sym]];here_val=base[base_index+work[sym]];}
else{here_op=32+64;here_val=0;}
incr=1<<(len-drop);fill=1<<curr;min=fill;do{fill-=incr;table[next+(huff>>drop)+fill]=(here_bits<<24)|(here_op<<16)|here_val|0;}while(fill!==0);incr=1<<(len-1);while(huff&incr){incr>>=1;}
if(incr!==0){huff&=incr-1;huff+=incr;}else{huff=0;}
sym++;if(--count[len]===0){if(len===max){break;}
len=lens[lens_index+work[sym]];}
if(len>root&&(huff&mask)!==low){if(drop===0){drop=root;}
next+=min;curr=len-drop;left=1<<curr;while(curr+drop<max){left-=count[curr+drop];if(left<=0){break;}
curr++;left<<=1;}
used+=1<<curr;if((type===LENS&&used>ENOUGH_LENS)||(type===DISTS&&used>ENOUGH_DISTS)){return 1;}
low=huff&mask;table[low]=(root<<24)|(curr<<16)|(next-table_index)|0;}}
if(huff!==0){table[next+huff]=((len-drop)<<24)|(64<<16)|0;}
opts.bits=root;return 0;};},function(module,exports,__webpack_require__){if(typeof Object.create==='function'){module.exports=function inherits(ctor,superCtor){ctor.super_=superCtor
ctor.prototype=Object.create(superCtor.prototype,{constructor:{value:ctor,enumerable:false,writable:true,configurable:true}});};}else{module.exports=function inherits(ctor,superCtor){ctor.super_=superCtor
var TempCtor=function(){}
TempCtor.prototype=superCtor.prototype
ctor.prototype=new TempCtor()
ctor.prototype.constructor=ctor}}},function(module,exports,__webpack_require__){(function(Buffer){function isArray(ar){return Array.isArray(ar);}
exports.isArray=isArray;function isBoolean(arg){return typeof arg==='boolean';}
exports.isBoolean=isBoolean;function isNull(arg){return arg===null;}
exports.isNull=isNull;function isNullOrUndefined(arg){return arg==null;}
exports.isNullOrUndefined=isNullOrUndefined;function isNumber(arg){return typeof arg==='number';}
exports.isNumber=isNumber;function isString(arg){return typeof arg==='string';}
exports.isString=isString;function isSymbol(arg){return typeof arg==='symbol';}
exports.isSymbol=isSymbol;function isUndefined(arg){return arg===void 0;}
exports.isUndefined=isUndefined;function isRegExp(re){return isObject(re)&&objectToString(re)==='[object RegExp]';}
exports.isRegExp=isRegExp;function isObject(arg){return typeof arg==='object'&&arg!==null;}
exports.isObject=isObject;function isDate(d){return isObject(d)&&objectToString(d)==='[object Date]';}
exports.isDate=isDate;function isError(e){return isObject(e)&&(objectToString(e)==='[object Error]'||e instanceof Error);}
exports.isError=isError;function isFunction(arg){return typeof arg==='function';}
exports.isFunction=isFunction;function isPrimitive(arg){return arg===null||typeof arg==='boolean'||typeof arg==='number'||typeof arg==='string'||typeof arg==='symbol'||typeof arg==='undefined';}
exports.isPrimitive=isPrimitive;function isBuffer(arg){return Buffer.isBuffer(arg);}
else if(typeof exports==='object'){module.exports=factory(require('jquery'));}
else if(jQuery&&!jQuery.fn.dataTable){factory(jQuery);}}
(function($){"use strict";var DataTable;var _ext;var _Api;var _api_register;var _api_registerPlural;var _re_dic={};var _re_new_lines=/[\r\n]/g;var _re_html=/<.*?>/g;var _re_date_start=/^[\w\+\-]/;var _re_date_end=/[\w\+\-]$/;var _re_escape_regex=new RegExp('(\\'+['/','.','*','+','?','|','(',')','[',']','{','}','\\','$','^','-'].join('|\\')+')','g');var _re_formatted_numeric=/[',$£€¥%\u2009\u202F\u20BD\u20a9\u20BArfk]/gi;var _empty=function(d){return!d||d===true||d==='-'?true:false;};var _intVal=function(s){var integer=parseInt(s,10);return!isNaN(integer)&&isFinite(s)?integer:null;};var _numToDecimal=function(num,decimalPoint){if(!_re_dic[decimalPoint]){_re_dic[decimalPoint]=new RegExp(_fnEscapeRegex(decimalPoint),'g');}
return typeof num==='string'&&decimalPoint!=='.'?num.replace(/\./g,'').replace(_re_dic[decimalPoint],'.'):num;};var _isNumber=function(d,decimalPoint,formatted){var strType=typeof d==='string';if(_empty(d)){return true;}
if(decimalPoint&&strType){d=_numToDecimal(d,decimalPoint);}
if(formatted&&strType){d=d.replace(_re_formatted_numeric,'');}
return!isNaN(parseFloat(d))&&isFinite(d);};var _isHtml=function(d){return _empty(d)||typeof d==='string';};var _htmlNumeric=function(d,decimalPoint,formatted){if(_empty(d)){return true;}
var html=_isHtml(d);return!html?null:_isNumber(_stripHtml(d),decimalPoint,formatted)?true:null;};var _pluck=function(a,prop,prop2){var out=[];var i=0,ien=a.length;if(prop2!==undefined){for(;i<ien;i++){if(a[i]&&a[i][prop]){out.push(a[i][prop][prop2]);}}}
else{for(;i<ien;i++){if(a[i]){out.push(a[i][prop]);}}}
return out;};var _pluck_order=function(a,order,prop,prop2)
{var out=[];var i=0,ien=order.length;if(prop2!==undefined){for(;i<ien;i++){if(a[order[i]][prop]){out.push(a[order[i]][prop][prop2]);}}}
else{for(;i<ien;i++){out.push(a[order[i]][prop]);}}
return out;};var _range=function(len,start)
{var out=[];var end;if(start===undefined){start=0;end=len;}
else{end=start;start=len;}
for(var i=start;i<end;i++){out.push(i);}
return out;};var _removeEmpty=function(a)
{var out=[];for(var i=0,ien=a.length;i<ien;i++){if(a[i]){out.push(a[i]);}}
return out;};var _stripHtml=function(d){return d.replace(_re_html,'');};var _unique=function(src)
{var
out=[],val,i,ien=src.length,j,k=0;again:for(i=0;i<ien;i++){val=src[i];for(j=0;j<k;j++){if(out[j]===val){continue again;}}
out.push(val);k++;}
return out;};function _fnHungarianMap(o)
{var
hungarian='a aa ai ao as b fn i m o s ',match,newKey,map={};$.each(o,function(key,val){match=key.match(/^([^A-Z]+?)([A-Z])/);if(match&&hungarian.indexOf(match[1]+' ')!==-1)
{newKey=key.replace(match[0],match[2].toLowerCase());map[newKey]=key;if(match[1]==='o')
{_fnHungarianMap(o[key]);}}});o._hungarianMap=map;}
function _fnCamelToHungarian(src,user,force)
{if(!src._hungarianMap){_fnHungarianMap(src);}
var hungarianKey;$.each(user,function(key,val){hungarianKey=src._hungarianMap[key];if(hungarianKey!==undefined&&(force||user[hungarianKey]===undefined))
{if(hungarianKey.charAt(0)==='o')
{if(!user[hungarianKey]){user[hungarianKey]={};}
$.extend(true,user[hungarianKey],user[key]);_fnCamelToHungarian(src[hungarianKey],user[hungarianKey],force);}
else{user[hungarianKey]=user[key];}}});}
function _fnLanguageCompat(lang)
{var defaults=DataTable.defaults.oLanguage;var zeroRecords=lang.sZeroRecords;if(!lang.sEmptyTable&&zeroRecords&&defaults.sEmptyTable==="No data available in table")
{_fnMap(lang,lang,'sZeroRecords','sEmptyTable');}
if(!lang.sLoadingRecords&&zeroRecords&&defaults.sLoadingRecords==="Loading...")
{_fnMap(lang,lang,'sZeroRecords','sLoadingRecords');}
if(lang.sInfoThousands){lang.sThousands=lang.sInfoThousands;}
var decimal=lang.sDecimal;if(decimal){_addNumericSort(decimal);}}
var _fnCompatMap=function(o,knew,old){if(o[knew]!==undefined){o[old]=o[knew];}};function _fnCompatOpts(init)
{_fnCompatMap(init,'ordering','bSort');_fnCompatMap(init,'orderMulti','bSortMulti');_fnCompatMap(init,'orderClasses','bSortClasses');_fnCompatMap(init,'orderCellsTop','bSortCellsTop');_fnCompatMap(init,'order','aaSorting');_fnCompatMap(init,'orderFixed','aaSortingFixed');_fnCompatMap(init,'paging','bPaginate');_fnCompatMap(init,'pagingType','sPaginationType');_fnCompatMap(init,'pageLength','iDisplayLength');_fnCompatMap(init,'searching','bFilter');if(typeof init.sScrollX==='boolean'){init.sScrollX=init.sScrollX?'100%':'';}
var searchCols=init.aoSearchCols;if(searchCols){for(var i=0,ien=searchCols.length;i<ien;i++){if(searchCols[i]){_fnCamelToHungarian(DataTable.models.oSearch,searchCols[i]);}}}}
function _fnCompatCols(init)
{_fnCompatMap(init,'orderable','bSortable');_fnCompatMap(init,'orderData','aDataSort');_fnCompatMap(init,'orderSequence','asSorting');_fnCompatMap(init,'orderDataType','sortDataType');var dataSort=init.aDataSort;if(dataSort&&!$.isArray(dataSort)){init.aDataSort=[dataSort];}}
function _fnBrowserDetect(settings)
{if(!DataTable.__browser){var browser={};DataTable.__browser=browser;var n=$('<div/>').css({position:'fixed',top:0,left:0,height:1,width:1,overflow:'hidden'}).append($('<div/>').css({position:'absolute',top:1,left:1,width:100,overflow:'scroll'}).append($('<div/>').css({width:'100%',height:10}))).appendTo('body');var outer=n.children();var inner=outer.children();browser.barWidth=outer[0].offsetWidth-outer[0].clientWidth;browser.bScrollOversize=inner[0].offsetWidth===100&&outer[0].clientWidth!==100;browser.bScrollbarLeft=Math.round(inner.offset().left)!==1;browser.bBounding=n[0].getBoundingClientRect().width?true:false;n.remove();}
$.extend(settings.oBrowser,DataTable.__browser);settings.oScroll.iBarWidth=DataTable.__browser.barWidth;}
function _fnReduce(that,fn,init,start,end,inc)
{var
i=start,value,isSet=false;if(init!==undefined){value=init;isSet=true;}
while(i!==end){if(!that.hasOwnProperty(i)){continue;}
value=isSet?fn(value,that[i],i,that):that[i];isSet=true;i+=inc;}
return value;}
function _fnAddColumn(oSettings,nTh)
{var oDefaults=DataTable.defaults.column;var iCol=oSettings.aoColumns.length;var oCol=$.extend({},DataTable.models.oColumn,oDefaults,{"nTh":nTh?nTh:document.createElement('th'),"sTitle":oDefaults.sTitle?oDefaults.sTitle:nTh?nTh.innerHTML:'',"aDataSort":oDefaults.aDataSort?oDefaults.aDataSort:[iCol],"mData":oDefaults.mData?oDefaults.mData:iCol,idx:iCol});oSettings.aoColumns.push(oCol);var searchCols=oSettings.aoPreSearchCols;searchCols[iCol]=$.extend({},DataTable.models.oSearch,searchCols[iCol]);_fnColumnOptions(oSettings,iCol,$(nTh).data());}
function _fnColumnOptions(oSettings,iCol,oOptions)
{var oCol=oSettings.aoColumns[iCol];var oClasses=oSettings.oClasses;var th=$(oCol.nTh);if(!oCol.sWidthOrig){oCol.sWidthOrig=th.attr('width')||null;var t=(th.attr('style')||'').match(/width:\s*(\d+[pxem%]+)/);if(t){oCol.sWidthOrig=t[1];}}
if(oOptions!==undefined&&oOptions!==null)
{_fnCompatCols(oOptions);_fnCamelToHungarian(DataTable.defaults.column,oOptions);if(oOptions.mDataProp!==undefined&&!oOptions.mData)
{oOptions.mData=oOptions.mDataProp;}
if(oOptions.sType)
{oCol._sManualType=oOptions.sType;}
if(oOptions.className&&!oOptions.sClass)
{oOptions.sClass=oOptions.className;}
$.extend(oCol,oOptions);_fnMap(oCol,oOptions,"sWidth","sWidthOrig");if(oOptions.iDataSort!==undefined)
{oCol.aDataSort=[oOptions.iDataSort];}
_fnMap(oCol,oOptions,"aDataSort");}
var mDataSrc=oCol.mData;var mData=_fnGetObjectDataFn(mDataSrc);var mRender=oCol.mRender?_fnGetObjectDataFn(oCol.mRender):null;var attrTest=function(src){return typeof src==='string'&&src.indexOf('@')!==-1;};oCol._bAttrSrc=$.isPlainObject(mDataSrc)&&(attrTest(mDataSrc.sort)||attrTest(mDataSrc.type)||attrTest(mDataSrc.filter));oCol.fnGetData=function(rowData,type,meta){var innerData=mData(rowData,type,undefined,meta);return mRender&&type?mRender(innerData,type,rowData,meta):innerData;};oCol.fnSetData=function(rowData,val,meta){return _fnSetObjectDataFn(mDataSrc)(rowData,val,meta);};if(typeof mDataSrc!=='number'){oSettings._rowReadObject=true;}
if(!oSettings.oFeatures.bSort)
{oCol.bSortable=false;th.addClass(oClasses.sSortableNone);}
var bAsc=$.inArray('asc',oCol.asSorting)!==-1;var bDesc=$.inArray('desc',oCol.asSorting)!==-1;if(!oCol.bSortable||(!bAsc&&!bDesc))
{oCol.sSortingClass=oClasses.sSortableNone;oCol.sSortingClassJUI="";}
else if(bAsc&&!bDesc)
{oCol.sSortingClass=oClasses.sSortableAsc;oCol.sSortingClassJUI=oClasses.sSortJUIAscAllowed;}
else if(!bAsc&&bDesc)
{oCol.sSortingClass=oClasses.sSortableDesc;oCol.sSortingClassJUI=oClasses.sSortJUIDescAllowed;}
else
{oCol.sSortingClass=oClasses.sSortable;oCol.sSortingClassJUI=oClasses.sSortJUI;}}
function _fnAdjustColumnSizing(settings)
{if(settings.oFeatures.bAutoWidth!==false)
{var columns=settings.aoColumns;_fnCalculateColumnWidths(settings);for(var i=0,iLen=columns.length;i<iLen;i++)
{columns[i].nTh.style.width=columns[i].sWidth;}}
var scroll=settings.oScroll;if(scroll.sY!==''||scroll.sX!=='')
{_fnScrollDraw(settings);}
_fnCallbackFire(settings,null,'column-sizing',[settings]);}
function _fnVisibleToColumnIndex(oSettings,iMatch)
{var aiVis=_fnGetColumns(oSettings,'bVisible');return typeof aiVis[iMatch]==='number'?aiVis[iMatch]:null;}
function _fnColumnIndexToVisible(oSettings,iMatch)
{var aiVis=_fnGetColumns(oSettings,'bVisible');var iPos=$.inArray(iMatch,aiVis);return iPos!==-1?iPos:null;}
function _fnVisbleColumns(oSettings)
{return _fnGetColumns(oSettings,'bVisible').length;}
function _fnGetColumns(oSettings,sParam)
{var a=[];$.map(oSettings.aoColumns,function(val,i){if(val[sParam]){a.push(i);}});return a;}
function _fnColumnTypes(settings)
{var columns=settings.aoColumns;var data=settings.aoData;var types=DataTable.ext.type.detect;var i,ien,j,jen,k,ken;var col,cell,detectedType,cache;for(i=0,ien=columns.length;i<ien;i++){col=columns[i];cache=[];if(!col.sType&&col._sManualType){col.sType=col._sManualType;}
else if(!col.sType){for(j=0,jen=types.length;j<jen;j++){for(k=0,ken=data.length;k<ken;k++){if(cache[k]===undefined){cache[k]=_fnGetCellData(settings,k,i,'type');}
detectedType=types[j](cache[k],settings);if(!detectedType&&j!==types.length-1){break;}
if(detectedType==='html'){break;}}
if(detectedType){col.sType=detectedType;break;}}
if(!col.sType){col.sType='string';}}}}
function _fnApplyColumnDefs(oSettings,aoColDefs,aoCols,fn)
{var i,iLen,j,jLen,k,kLen,def;var columns=oSettings.aoColumns;if(aoColDefs)
{for(i=aoColDefs.length-1;i>=0;i--)
{def=aoColDefs[i];var aTargets=def.targets!==undefined?def.targets:def.aTargets;if(!$.isArray(aTargets))
{aTargets=[aTargets];}
for(j=0,jLen=aTargets.length;j<jLen;j++)
{if(typeof aTargets[j]==='number'&&aTargets[j]>=0)
{while(columns.length<=aTargets[j])
{_fnAddColumn(oSettings);}
fn(aTargets[j],def);}
else if(typeof aTargets[j]==='number'&&aTargets[j]<0)
{fn(columns.length+aTargets[j],def);}
else if(typeof aTargets[j]==='string')
{for(k=0,kLen=columns.length;k<kLen;k++)
{if(aTargets[j]=="_all"||$(columns[k].nTh).hasClass(aTargets[j]))
{fn(k,def);}}}}}}
if(aoCols)
{for(i=0,iLen=aoCols.length;i<iLen;i++)
{fn(i,aoCols[i]);}}}
function _fnAddData(oSettings,aDataIn,nTr,anTds)
{var iRow=oSettings.aoData.length;var oData=$.extend(true,{},DataTable.models.oRow,{src:nTr?'dom':'data',idx:iRow});oData._aData=aDataIn;oSettings.aoData.push(oData);var nTd,sThisType;var columns=oSettings.aoColumns;for(var i=0,iLen=columns.length;i<iLen;i++)
{columns[i].sType=null;}
oSettings.aiDisplayMaster.push(iRow);var id=oSettings.rowIdFn(aDataIn);if(id!==undefined){oSettings.aIds[id]=oData;}
if(nTr||!oSettings.oFeatures.bDeferRender)
{_fnCreateTr(oSettings,iRow,nTr,anTds);}
return iRow;}
function _fnAddTr(settings,trs)
{var row;if(!(trs instanceof $)){trs=$(trs);}
return trs.map(function(i,el){row=_fnGetRowElements(settings,el);return _fnAddData(settings,row.data,el,row.cells);});}
function _fnNodeToDataIndex(oSettings,n)
{return(n._DT_RowIndex!==undefined)?n._DT_RowIndex:null;}
function _fnNodeToColumnIndex(oSettings,iRow,n)
{return $.inArray(n,oSettings.aoData[iRow].anCells);}
function _fnGetCellData(settings,rowIdx,colIdx,type)
{var draw=settings.iDraw;var col=settings.aoColumns[colIdx];var rowData=settings.aoData[rowIdx]._aData;var defaultContent=col.sDefaultContent;var cellData=col.fnGetData(rowData,type,{settings:settings,row:rowIdx,col:colIdx});if(cellData===undefined){if(settings.iDrawError!=draw&&defaultContent===null){_fnLog(settings,0,"Requested unknown parameter "+(typeof col.mData=='function'?'{function}':"'"+col.mData+"'")+" for row "+rowIdx,4);settings.iDrawError=draw;}
return defaultContent;}
if((cellData===rowData||cellData===null)&&defaultContent!==null){cellData=defaultContent;}
else if(typeof cellData==='function'){return cellData.call(rowData);}
if(cellData===null&&type=='display'){return'';}
return cellData;}
function _fnSetCellData(settings,rowIdx,colIdx,val)
{var col=settings.aoColumns[colIdx];var rowData=settings.aoData[rowIdx]._aData;col.fnSetData(rowData,val,{settings:settings,row:rowIdx,col:colIdx});}
var __reArray=/\[.*?\]$/;var __reFn=/\(\)$/;function _fnSplitObjNotation(str)
{return $.map(str.match(/(\\.|[^\.])+/g)||[''],function(s){return s.replace(/\\./g,'.');});}
function _fnGetObjectDataFn(mSource)
{if($.isPlainObject(mSource))
{var o={};$.each(mSource,function(key,val){if(val){o[key]=_fnGetObjectDataFn(val);}});return function(data,type,row,meta){var t=o[type]||o._;return t!==undefined?t(data,type,row,meta):data;};}
else if(mSource===null)
{return function(data){return data;};}
else if(typeof mSource==='function')
{return function(data,type,row,meta){return mSource(data,type,row,meta);};}
else if(typeof mSource==='string'&&(mSource.indexOf('.')!==-1||mSource.indexOf('[')!==-1||mSource.indexOf('(')!==-1))
{var fetchData=function(data,type,src){var arrayNotation,funcNotation,out,innerSrc;if(src!=="")
{var a=_fnSplitObjNotation(src);for(var i=0,iLen=a.length;i<iLen;i++)
{arrayNotation=a[i].match(__reArray);funcNotation=a[i].match(__reFn);if(arrayNotation)
{a[i]=a[i].replace(__reArray,'');if(a[i]!==""){data=data[a[i]];}
out=[];a.splice(0,i+1);innerSrc=a.join('.');if($.isArray(data)){for(var j=0,jLen=data.length;j<jLen;j++){out.push(fetchData(data[j],type,innerSrc));}}
var join=arrayNotation[0].substring(1,arrayNotation[0].length-1);data=(join==="")?out:out.join(join);break;}
else if(funcNotation)
{a[i]=a[i].replace(__reFn,'');data=data[a[i]]();continue;}
if(data===null||data[a[i]]===undefined)
{return undefined;}
data=data[a[i]];}}
return data;};return function(data,type){return fetchData(data,type,mSource);};}
else
{return function(data,type){return data[mSource];};}}
function _fnSetObjectDataFn(mSource)
{if($.isPlainObject(mSource))
{return _fnSetObjectDataFn(mSource._);}
else if(mSource===null)
{return function(){};}
else if(typeof mSource==='function')
{return function(data,val,meta){mSource(data,'set',val,meta);};}
else if(typeof mSource==='string'&&(mSource.indexOf('.')!==-1||mSource.indexOf('[')!==-1||mSource.indexOf('(')!==-1))
{var setData=function(data,val,src){var a=_fnSplitObjNotation(src),b;var aLast=a[a.length-1];var arrayNotation,funcNotation,o,innerSrc;for(var i=0,iLen=a.length-1;i<iLen;i++)
{arrayNotation=a[i].match(__reArray);funcNotation=a[i].match(__reFn);if(arrayNotation)
{a[i]=a[i].replace(__reArray,'');data[a[i]]=[];b=a.slice();b.splice(0,i+1);innerSrc=b.join('.');if($.isArray(val))
{for(var j=0,jLen=val.length;j<jLen;j++)
{o={};setData(o,val[j],innerSrc);data[a[i]].push(o);}}
else
{data[a[i]]=val;}
return;}
else if(funcNotation)
{a[i]=a[i].replace(__reFn,'');data=data[a[i]](val);}
if(data[a[i]]===null||data[a[i]]===undefined)
{data[a[i]]={};}
data=data[a[i]];}
if(aLast.match(__reFn))
{data=data[aLast.replace(__reFn,'')](val);}
else
{data[aLast.replace(__reArray,'')]=val;}};return function(data,val){return setData(data,val,mSource);};}
else
{return function(data,val){data[mSource]=val;};}}
function _fnGetDataMaster(settings)
{return _pluck(settings.aoData,'_aData');}
function _fnClearTable(settings)
{settings.aoData.length=0;settings.aiDisplayMaster.length=0;settings.aiDisplay.length=0;settings.aIds={};}
function _fnDeleteIndex(a,iTarget,splice)
{var iTargetIndex=-1;for(var i=0,iLen=a.length;i<iLen;i++)
{if(a[i]==iTarget)
{iTargetIndex=i;}
else if(a[i]>iTarget)
{a[i]--;}}
if(iTargetIndex!=-1&&splice===undefined)
{a.splice(iTargetIndex,1);}}
function _fnInvalidate(settings,rowIdx,src,colIdx)
{var row=settings.aoData[rowIdx];var i,ien;var cellWrite=function(cell,col){while(cell.childNodes.length){cell.removeChild(cell.firstChild);}
cell.innerHTML=_fnGetCellData(settings,rowIdx,col,'display');};if(src==='dom'||((!src||src==='auto')&&row.src==='dom')){row._aData=_fnGetRowElements(settings,row,colIdx,colIdx===undefined?undefined:row._aData).data;}
else{var cells=row.anCells;if(cells){if(colIdx!==undefined){cellWrite(cells[colIdx],colIdx);}
else{for(i=0,ien=cells.length;i<ien;i++){cellWrite(cells[i],i);}}}}
row._aSortData=null;row._aFilterData=null;var cols=settings.aoColumns;if(colIdx!==undefined){cols[colIdx].sType=null;}
else{for(i=0,ien=cols.length;i<ien;i++){cols[i].sType=null;}
_fnRowAttributes(settings,row);}}
function _fnGetRowElements(settings,row,colIdx,d)
{var
tds=[],td=row.firstChild,name,col,o,i=0,contents,columns=settings.aoColumns,objectRead=settings._rowReadObject;d=d!==undefined?d:objectRead?{}:[];var attr=function(str,td){if(typeof str==='string'){var idx=str.indexOf('@');if(idx!==-1){var attr=str.substring(idx+1);var setter=_fnSetObjectDataFn(str);setter(d,td.getAttribute(attr));}}};var cellProcess=function(cell){if(colIdx===undefined||colIdx===i){col=columns[i];contents=$.trim(cell.innerHTML);if(col&&col._bAttrSrc){var setter=_fnSetObjectDataFn(col.mData._);setter(d,contents);attr(col.mData.sort,cell);attr(col.mData.type,cell);attr(col.mData.filter,cell);}
else{if(objectRead){if(!col._setter){col._setter=_fnSetObjectDataFn(col.mData);}
col._setter(d,contents);}
else{d[i]=contents;}}}
i++;};if(td){while(td){name=td.nodeName.toUpperCase();if(name=="TD"||name=="TH"){cellProcess(td);tds.push(td);}
td=td.nextSibling;}}
else{tds=row.anCells;for(var j=0,jen=tds.length;j<jen;j++){cellProcess(tds[j]);}}
var rowNode=td?row:row.nTr;if(rowNode){var id=rowNode.getAttribute('id');if(id){_fnSetObjectDataFn(settings.rowId)(d,id);}}
return{data:d,cells:tds};}
function _fnCreateTr(oSettings,iRow,nTrIn,anTds)
{var
row=oSettings.aoData[iRow],rowData=row._aData,cells=[],nTr,nTd,oCol,i,iLen;if(row.nTr===null)
{nTr=nTrIn||document.createElement('tr');row.nTr=nTr;row.anCells=cells;nTr._DT_RowIndex=iRow;_fnRowAttributes(oSettings,row);for(i=0,iLen=oSettings.aoColumns.length;i<iLen;i++)
{oCol=oSettings.aoColumns[i];nTd=nTrIn?anTds[i]:document.createElement(oCol.sCellType);cells.push(nTd);if(!nTrIn||oCol.mRender||oCol.mData!==i)
{nTd.innerHTML=_fnGetCellData(oSettings,iRow,i,'display');}
if(oCol.sClass)
{nTd.className+=' '+oCol.sClass;}
if(oCol.bVisible&&!nTrIn)
{nTr.appendChild(nTd);}
else if(!oCol.bVisible&&nTrIn)
{nTd.parentNode.removeChild(nTd);}
if(oCol.fnCreatedCell)
{oCol.fnCreatedCell.call(oSettings.oInstance,nTd,_fnGetCellData(oSettings,iRow,i),rowData,iRow,i);}}
_fnCallbackFire(oSettings,'aoRowCreatedCallback',null,[nTr,rowData,iRow]);}
row.nTr.setAttribute('role','row');}
function _fnRowAttributes(settings,row)
{var tr=row.nTr;var data=row._aData;if(tr){var id=settings.rowIdFn(data);if(id){tr.id=id;}
if(data.DT_RowClass){var a=data.DT_RowClass.split(' ');row.__rowc=row.__rowc?_unique(row.__rowc.concat(a)):a;$(tr).removeClass(row.__rowc.join(' ')).addClass(data.DT_RowClass);}
if(data.DT_RowAttr){$(tr).attr(data.DT_RowAttr);}
if(data.DT_RowData){$(tr).data(data.DT_RowData);}}}
function _fnBuildHead(oSettings)
{var i,ien,cell,row,column;var thead=oSettings.nTHead;var tfoot=oSettings.nTFoot;var createHeader=$('th, td',thead).length===0;var classes=oSettings.oClasses;var columns=oSettings.aoColumns;if(createHeader){row=$('<tr/>').appendTo(thead);}
for(i=0,ien=columns.length;i<ien;i++){column=columns[i];cell=$(column.nTh).addClass(column.sClass);if(createHeader){cell.appendTo(row);}
if(oSettings.oFeatures.bSort){cell.addClass(column.sSortingClass);if(column.bSortable!==false){cell.attr('tabindex',oSettings.iTabIndex).attr('aria-controls',oSettings.sTableId);_fnSortAttachListener(oSettings,column.nTh,i);}}
if(column.sTitle!=cell[0].innerHTML){cell.html(column.sTitle);}
_fnRenderer(oSettings,'header')(oSettings,cell,column,classes);}
if(createHeader){_fnDetectHeader(oSettings.aoHeader,thead);}
$(thead).find('>tr').attr('role','row');$(thead).find('>tr>th, >tr>td').addClass(classes.sHeaderTH);$(tfoot).find('>tr>th, >tr>td').addClass(classes.sFooterTH);if(tfoot!==null){var cells=oSettings.aoFooter[0];for(i=0,ien=cells.length;i<ien;i++){column=columns[i];column.nTf=cells[i].cell;if(column.sClass){$(column.nTf).addClass(column.sClass);}}}}
function _fnDrawHead(oSettings,aoSource,bIncludeHidden)
{var i,iLen,j,jLen,k,kLen,n,nLocalTr;var aoLocal=[];var aApplied=[];var iColumns=oSettings.aoColumns.length;var iRowspan,iColspan;if(!aoSource)
{return;}
if(bIncludeHidden===undefined)
{bIncludeHidden=false;}
for(i=0,iLen=aoSource.length;i<iLen;i++)
{aoLocal[i]=aoSource[i].slice();aoLocal[i].nTr=aoSource[i].nTr;for(j=iColumns-1;j>=0;j--)
{if(!oSettings.aoColumns[j].bVisible&&!bIncludeHidden)
{aoLocal[i].splice(j,1);}}
aApplied.push([]);}
for(i=0,iLen=aoLocal.length;i<iLen;i++)
{nLocalTr=aoLocal[i].nTr;if(nLocalTr)
{while((n=nLocalTr.firstChild))
{nLocalTr.removeChild(n);}}
for(j=0,jLen=aoLocal[i].length;j<jLen;j++)
{iRowspan=1;iColspan=1;if(aApplied[i][j]===undefined)
{nLocalTr.appendChild(aoLocal[i][j].cell);aApplied[i][j]=1;while(aoLocal[i+iRowspan]!==undefined&&aoLocal[i][j].cell==aoLocal[i+iRowspan][j].cell)
{aApplied[i+iRowspan][j]=1;iRowspan++;}
while(aoLocal[i][j+iColspan]!==undefined&&aoLocal[i][j].cell==aoLocal[i][j+iColspan].cell)
{for(k=0;k<iRowspan;k++)
{aApplied[i+k][j+iColspan]=1;}
iColspan++;}
$(aoLocal[i][j].cell).attr('rowspan',iRowspan).attr('colspan',iColspan);}}}}
function _fnDraw(oSettings)
{var aPreDraw=_fnCallbackFire(oSettings,'aoPreDrawCallback','preDraw',[oSettings]);if($.inArray(false,aPreDraw)!==-1)
{_fnProcessingDisplay(oSettings,false);return;}
var i,iLen,n;var anRows=[];var iRowCount=0;var asStripeClasses=oSettings.asStripeClasses;var iStripes=asStripeClasses.length;var iOpenRows=oSettings.aoOpenRows.length;var oLang=oSettings.oLanguage;var iInitDisplayStart=oSettings.iInitDisplayStart;var bServerSide=_fnDataSource(oSettings)=='ssp';var aiDisplay=oSettings.aiDisplay;oSettings.bDrawing=true;if(iInitDisplayStart!==undefined&&iInitDisplayStart!==-1)
{oSettings._iDisplayStart=bServerSide?iInitDisplayStart:iInitDisplayStart>=oSettings.fnRecordsDisplay()?0:iInitDisplayStart;oSettings.iInitDisplayStart=-1;}
var iDisplayStart=oSettings._iDisplayStart;var iDisplayEnd=oSettings.fnDisplayEnd();if(oSettings.bDeferLoading)
{oSettings.bDeferLoading=false;oSettings.iDraw++;_fnProcessingDisplay(oSettings,false);}
else if(!bServerSide)
{oSettings.iDraw++;}
else if(!oSettings.bDestroying&&!_fnAjaxUpdate(oSettings))
{return;}
if(aiDisplay.length!==0)
{var iStart=bServerSide?0:iDisplayStart;var iEnd=bServerSide?oSettings.aoData.length:iDisplayEnd;for(var j=iStart;j<iEnd;j++)
{var iDataIndex=aiDisplay[j];var aoData=oSettings.aoData[iDataIndex];if(aoData.nTr===null)
{_fnCreateTr(oSettings,iDataIndex);}
var nRow=aoData.nTr;if(iStripes!==0)
{var sStripe=asStripeClasses[iRowCount%iStripes];if(aoData._sRowStripe!=sStripe)
{$(nRow).removeClass(aoData._sRowStripe).addClass(sStripe);aoData._sRowStripe=sStripe;}}
_fnCallbackFire(oSettings,'aoRowCallback',null,[nRow,aoData._aData,iRowCount,j]);anRows.push(nRow);iRowCount++;}}
else
{var sZero=oLang.sZeroRecords;if(oSettings.iDraw==1&&_fnDataSource(oSettings)=='ajax')
{sZero=oLang.sLoadingRecords;}
else if(oLang.sEmptyTable&&oSettings.fnRecordsTotal()===0)
{sZero=oLang.sEmptyTable;}
anRows[0]=$('<tr/>',{'class':iStripes?asStripeClasses[0]:''}).append($('<td />',{'valign':'top','colSpan':_fnVisbleColumns(oSettings),'class':oSettings.oClasses.sRowEmpty}).html(sZero))[0];}
_fnCallbackFire(oSettings,'aoHeaderCallback','header',[$(oSettings.nTHead).children('tr')[0],_fnGetDataMaster(oSettings),iDisplayStart,iDisplayEnd,aiDisplay]);_fnCallbackFire(oSettings,'aoFooterCallback','footer',[$(oSettings.nTFoot).children('tr')[0],_fnGetDataMaster(oSettings),iDisplayStart,iDisplayEnd,aiDisplay]);var body=$(oSettings.nTBody);body.children().detach();body.append($(anRows));_fnCallbackFire(oSettings,'aoDrawCallback','draw',[oSettings]);oSettings.bSorted=false;oSettings.bFiltered=false;oSettings.bDrawing=false;}
function _fnReDraw(settings,holdPosition)
{var
features=settings.oFeatures,sort=features.bSort,filter=features.bFilter;if(sort){_fnSort(settings);}
if(filter){_fnFilterComplete(settings,settings.oPreviousSearch);}
else{settings.aiDisplay=settings.aiDisplayMaster.slice();}
if(holdPosition!==true){settings._iDisplayStart=0;}
settings._drawHold=holdPosition;_fnDraw(settings);settings._drawHold=false;}
function _fnAddOptionsHtml(oSettings)
{var classes=oSettings.oClasses;var table=$(oSettings.nTable);var holding=$('<div/>').insertBefore(table);var features=oSettings.oFeatures;var insert=$('<div/>',{id:oSettings.sTableId+'_wrapper','class':classes.sWrapper+(oSettings.nTFoot?'':' '+classes.sNoFooter)});oSettings.nHolding=holding[0];oSettings.nTableWrapper=insert[0];oSettings.nTableReinsertBefore=oSettings.nTable.nextSibling;var aDom=oSettings.sDom.split('');var featureNode,cOption,nNewNode,cNext,sAttr,j;for(var i=0;i<aDom.length;i++)
{featureNode=null;cOption=aDom[i];if(cOption=='<')
{nNewNode=$('<div/>')[0];cNext=aDom[i+1];if(cNext=="'"||cNext=='"')
{sAttr="";j=2;while(aDom[i+j]!=cNext)
{sAttr+=aDom[i+j];j++;}
if(sAttr=="H")
{sAttr=classes.sJUIHeader;}
else if(sAttr=="F")
{sAttr=classes.sJUIFooter;}
if(sAttr.indexOf('.')!=-1)
{var aSplit=sAttr.split('.');nNewNode.id=aSplit[0].substr(1,aSplit[0].length-1);nNewNode.className=aSplit[1];}
else if(sAttr.charAt(0)=="#")
{nNewNode.id=sAttr.substr(1,sAttr.length-1);}
else
{nNewNode.className=sAttr;}
i+=j;}
insert.append(nNewNode);insert=$(nNewNode);}
else if(cOption=='>')
{insert=insert.parent();}
else if(cOption=='l'&&features.bPaginate&&features.bLengthChange)
{featureNode=_fnFeatureHtmlLength(oSettings);}
else if(cOption=='f'&&features.bFilter)
{featureNode=_fnFeatureHtmlFilter(oSettings);}
else if(cOption=='r'&&features.bProcessing)
{featureNode=_fnFeatureHtmlProcessing(oSettings);}
else if(cOption=='t')
{featureNode=_fnFeatureHtmlTable(oSettings);}
else if(cOption=='i'&&features.bInfo)
{featureNode=_fnFeatureHtmlInfo(oSettings);}
else if(cOption=='p'&&features.bPaginate)
{featureNode=_fnFeatureHtmlPaginate(oSettings);}
else if(DataTable.ext.feature.length!==0)
{var aoFeatures=DataTable.ext.feature;for(var k=0,kLen=aoFeatures.length;k<kLen;k++)
{if(cOption==aoFeatures[k].cFeature)
{featureNode=aoFeatures[k].fnInit(oSettings);break;}}}
if(featureNode)
{var aanFeatures=oSettings.aanFeatures;if(!aanFeatures[cOption])
{aanFeatures[cOption]=[];}
aanFeatures[cOption].push(featureNode);insert.append(featureNode);}}
holding.replaceWith(insert);oSettings.nHolding=null;}
function _fnDetectHeader(aLayout,nThead)
{var nTrs=$(nThead).children('tr');var nTr,nCell;var i,k,l,iLen,jLen,iColShifted,iColumn,iColspan,iRowspan;var bUnique;var fnShiftCol=function(a,i,j){var k=a[i];while(k[j]){j++;}
return j;};aLayout.splice(0,aLayout.length);for(i=0,iLen=nTrs.length;i<iLen;i++)
{aLayout.push([]);}
for(i=0,iLen=nTrs.length;i<iLen;i++)
{nTr=nTrs[i];iColumn=0;nCell=nTr.firstChild;while(nCell){if(nCell.nodeName.toUpperCase()=="TD"||nCell.nodeName.toUpperCase()=="TH")
{iColspan=nCell.getAttribute('colspan')*1;iRowspan=nCell.getAttribute('rowspan')*1;iColspan=(!iColspan||iColspan===0||iColspan===1)?1:iColspan;iRowspan=(!iRowspan||iRowspan===0||iRowspan===1)?1:iRowspan;iColShifted=fnShiftCol(aLayout,i,iColumn);bUnique=iColspan===1?true:false;for(l=0;l<iColspan;l++)
{for(k=0;k<iRowspan;k++)
{aLayout[i+k][iColShifted+l]={"cell":nCell,"unique":bUnique};aLayout[i+k].nTr=nTr;}}}
nCell=nCell.nextSibling;}}}
function _fnGetUniqueThs(oSettings,nHeader,aLayout)
{var aReturn=[];if(!aLayout)
{aLayout=oSettings.aoHeader;if(nHeader)
{aLayout=[];_fnDetectHeader(aLayout,nHeader);}}
for(var i=0,iLen=aLayout.length;i<iLen;i++)
{for(var j=0,jLen=aLayout[i].length;j<jLen;j++)
{if(aLayout[i][j].unique&&(!aReturn[j]||!oSettings.bSortCellsTop))
{aReturn[j]=aLayout[i][j].cell;}}}
return aReturn;}
function _fnBuildAjax(oSettings,data,fn)
{_fnCallbackFire(oSettings,'aoServerParams','serverParams',[data]);if(data&&$.isArray(data)){var tmp={};var rbracket=/(.*?)\[\]$/;$.each(data,function(key,val){var match=val.name.match(rbracket);if(match){var name=match[0];if(!tmp[name]){tmp[name]=[];}
tmp[name].push(val.value);}
else{tmp[val.name]=val.value;}});data=tmp;}
var ajaxData;var ajax=oSettings.ajax;var instance=oSettings.oInstance;var callback=function(json){_fnCallbackFire(oSettings,null,'xhr',[oSettings,json,oSettings.jqXHR]);fn(json);};if($.isPlainObject(ajax)&&ajax.data)
{ajaxData=ajax.data;var newData=$.isFunction(ajaxData)?ajaxData(data,oSettings):ajaxData;data=$.isFunction(ajaxData)&&newData?newData:$.extend(true,data,newData);delete ajax.data;}
var baseAjax={"data":data,"success":function(json){var error=json.error||json.sError;if(error){_fnLog(oSettings,0,error);}
oSettings.json=json;callback(json);},"dataType":"json","cache":false,"type":oSettings.sServerMethod,"error":function(xhr,error,thrown){var ret=_fnCallbackFire(oSettings,null,'xhr',[oSettings,null,oSettings.jqXHR]);if($.inArray(true,ret)===-1){if(error=="parsererror"){_fnLog(oSettings,0,'Invalid JSON response',1);}
else if(xhr.readyState===4){_fnLog(oSettings,0,'Ajax error',7);}}
_fnProcessingDisplay(oSettings,false);}};oSettings.oAjaxData=data;_fnCallbackFire(oSettings,null,'preXhr',[oSettings,data]);if(oSettings.fnServerData)
{oSettings.fnServerData.call(instance,oSettings.sAjaxSource,$.map(data,function(val,key){return{name:key,value:val};}),callback,oSettings);}
else if(oSettings.sAjaxSource||typeof ajax==='string')
{oSettings.jqXHR=$.ajax($.extend(baseAjax,{url:ajax||oSettings.sAjaxSource}));}
else if($.isFunction(ajax))
{oSettings.jqXHR=ajax.call(instance,data,callback,oSettings);}
else
{oSettings.jqXHR=$.ajax($.extend(baseAjax,ajax));ajax.data=ajaxData;}}
function _fnAjaxUpdate(settings)
{if(settings.bAjaxDataGet){settings.iDraw++;_fnProcessingDisplay(settings,true);_fnBuildAjax(settings,_fnAjaxParameters(settings),function(json){_fnAjaxUpdateDraw(settings,json);});return false;}
return true;}
function _fnAjaxParameters(settings)
{var
columns=settings.aoColumns,columnCount=columns.length,features=settings.oFeatures,preSearch=settings.oPreviousSearch,preColSearch=settings.aoPreSearchCols,i,data=[],dataProp,column,columnSearch,sort=_fnSortFlatten(settings),displayStart=settings._iDisplayStart,displayLength=features.bPaginate!==false?settings._iDisplayLength:-1;var param=function(name,value){data.push({'name':name,'value':value});};param('sEcho',settings.iDraw);param('iColumns',columnCount);param('sColumns',_pluck(columns,'sName').join(','));param('iDisplayStart',displayStart);param('iDisplayLength',displayLength);var d={draw:settings.iDraw,columns:[],order:[],start:displayStart,length:displayLength,search:{value:preSearch.sSearch,regex:preSearch.bRegex}};for(i=0;i<columnCount;i++){column=columns[i];columnSearch=preColSearch[i];dataProp=typeof column.mData=="function"?'function':column.mData;d.columns.push({data:dataProp,name:column.sName,searchable:column.bSearchable,orderable:column.bSortable,search:{value:columnSearch.sSearch,regex:columnSearch.bRegex}});param("mDataProp_"+i,dataProp);if(features.bFilter){param('sSearch_'+i,columnSearch.sSearch);param('bRegex_'+i,columnSearch.bRegex);param('bSearchable_'+i,column.bSearchable);}
if(features.bSort){param('bSortable_'+i,column.bSortable);}}
if(features.bFilter){param('sSearch',preSearch.sSearch);param('bRegex',preSearch.bRegex);}
if(features.bSort){$.each(sort,function(i,val){d.order.push({column:val.col,dir:val.dir});param('iSortCol_'+i,val.col);param('sSortDir_'+i,val.dir);});param('iSortingCols',sort.length);}
var legacy=DataTable.ext.legacy.ajax;if(legacy===null){return settings.sAjaxSource?data:d;}
return legacy?data:d;}
function _fnAjaxUpdateDraw(settings,json)
{var compat=function(old,modern){return json[old]!==undefined?json[old]:json[modern];};var data=_fnAjaxDataSrc(settings,json);var draw=compat('sEcho','draw');var recordsTotal=compat('iTotalRecords','recordsTotal');var recordsFiltered=compat('iTotalDisplayRecords','recordsFiltered');if(draw){if(draw*1<settings.iDraw){return;}
settings.iDraw=draw*1;}
_fnClearTable(settings);settings._iRecordsTotal=parseInt(recordsTotal,10);settings._iRecordsDisplay=parseInt(recordsFiltered,10);for(var i=0,ien=data.length;i<ien;i++){_fnAddData(settings,data[i]);}
settings.aiDisplay=settings.aiDisplayMaster.slice();settings.bAjaxDataGet=false;_fnDraw(settings);if(!settings._bInitComplete){_fnInitComplete(settings,json);}
settings.bAjaxDataGet=true;_fnProcessingDisplay(settings,false);}
function _fnAjaxDataSrc(oSettings,json)
{var dataSrc=$.isPlainObject(oSettings.ajax)&&oSettings.ajax.dataSrc!==undefined?oSettings.ajax.dataSrc:oSettings.sAjaxDataProp;if(dataSrc==='data'){return json.aaData||json[dataSrc];}
return dataSrc!==""?_fnGetObjectDataFn(dataSrc)(json):json;}
function _fnFeatureHtmlFilter(settings)
{var classes=settings.oClasses;var tableId=settings.sTableId;var language=settings.oLanguage;var previousSearch=settings.oPreviousSearch;var features=settings.aanFeatures;var input='<input type="search" class="'+classes.sFilterInput+'"/>';var str=language.sSearch;str=str.match(/_INPUT_/)?str.replace('_INPUT_',input):str+input;var filter=$('<div/>',{'id':!features.f?tableId+'_filter':null,'class':classes.sFilter}).append($('<label/>').append(str));var searchFn=function(){var n=features.f;var val=!this.value?"":this.value;if(val!=previousSearch.sSearch){_fnFilterComplete(settings,{"sSearch":val,"bRegex":previousSearch.bRegex,"bSmart":previousSearch.bSmart,"bCaseInsensitive":previousSearch.bCaseInsensitive});settings._iDisplayStart=0;_fnDraw(settings);}};var searchDelay=settings.searchDelay!==null?settings.searchDelay:_fnDataSource(settings)==='ssp'?400:0;var jqFilter=$('input',filter).val(previousSearch.sSearch).attr('placeholder',language.sSearchPlaceholder).bind('keyup.DT search.DT input.DT paste.DT cut.DT',searchDelay?_fnThrottle(searchFn,searchDelay):searchFn).bind('keypress.DT',function(e){if(e.keyCode==13){return false;}}).attr('aria-controls',tableId);$(settings.nTable).on('search.dt.DT',function(ev,s){if(settings===s){try{if(jqFilter[0]!==document.activeElement){jqFilter.val(previousSearch.sSearch);}}
catch(e){}}});return filter[0];}
function _fnFilterComplete(oSettings,oInput,iForce)
{var oPrevSearch=oSettings.oPreviousSearch;var aoPrevSearch=oSettings.aoPreSearchCols;var fnSaveFilter=function(oFilter){oPrevSearch.sSearch=oFilter.sSearch;oPrevSearch.bRegex=oFilter.bRegex;oPrevSearch.bSmart=oFilter.bSmart;oPrevSearch.bCaseInsensitive=oFilter.bCaseInsensitive;};var fnRegex=function(o){return o.bEscapeRegex!==undefined?!o.bEscapeRegex:o.bRegex;};_fnColumnTypes(oSettings);if(_fnDataSource(oSettings)!='ssp')
{_fnFilter(oSettings,oInput.sSearch,iForce,fnRegex(oInput),oInput.bSmart,oInput.bCaseInsensitive);fnSaveFilter(oInput);for(var i=0;i<aoPrevSearch.length;i++)
{_fnFilterColumn(oSettings,aoPrevSearch[i].sSearch,i,fnRegex(aoPrevSearch[i]),aoPrevSearch[i].bSmart,aoPrevSearch[i].bCaseInsensitive);}
_fnFilterCustom(oSettings);}
else
{fnSaveFilter(oInput);}
oSettings.bFiltered=true;_fnCallbackFire(oSettings,null,'search',[oSettings]);}
function _fnFilterCustom(settings)
{var filters=DataTable.ext.search;var displayRows=settings.aiDisplay;var row,rowIdx;for(var i=0,ien=filters.length;i<ien;i++){var rows=[];for(var j=0,jen=displayRows.length;j<jen;j++){rowIdx=displayRows[j];row=settings.aoData[rowIdx];if(filters[i](settings,row._aFilterData,rowIdx,row._aData,j)){rows.push(rowIdx);}}
displayRows.length=0;$.merge(displayRows,rows);}}
function _fnFilterColumn(settings,searchStr,colIdx,regex,smart,caseInsensitive)
{if(searchStr===''){return;}
var data;var display=settings.aiDisplay;var rpSearch=_fnFilterCreateSearch(searchStr,regex,smart,caseInsensitive);for(var i=display.length-1;i>=0;i--){data=settings.aoData[display[i]]._aFilterData[colIdx];if(!rpSearch.test(data)){display.splice(i,1);}}}
function _fnFilter(settings,input,force,regex,smart,caseInsensitive)
{var rpSearch=_fnFilterCreateSearch(input,regex,smart,caseInsensitive);var prevSearch=settings.oPreviousSearch.sSearch;var displayMaster=settings.aiDisplayMaster;var display,invalidated,i;if(DataTable.ext.search.length!==0){force=true;}
invalidated=_fnFilterData(settings);if(input.length<=0){settings.aiDisplay=displayMaster.slice();}
else{if(invalidated||force||prevSearch.length>input.length||input.indexOf(prevSearch)!==0||settings.bSorted){settings.aiDisplay=displayMaster.slice();}
display=settings.aiDisplay;for(i=display.length-1;i>=0;i--){if(!rpSearch.test(settings.aoData[display[i]]._sFilterRow)){display.splice(i,1);}}}}
function _fnFilterCreateSearch(search,regex,smart,caseInsensitive)
{search=regex?search:_fnEscapeRegex(search);if(smart){var a=$.map(search.match(/"[^"]+"|[^ ]+/g)||[''],function(word){if(word.charAt(0)==='"'){var m=word.match(/^"(.*)"$/);word=m?m[1]:word;}
return word.replace('"','');});search='^(?=.*?'+a.join(')(?=.*?')+').*$';}
return new RegExp(search,caseInsensitive?'i':'');}
function _fnEscapeRegex(sVal)
{return sVal.replace(_re_escape_regex,'\\$1');}
var __filter_div=$('<div>')[0];var __filter_div_textContent=__filter_div.textContent!==undefined;function _fnFilterData(settings)
{var columns=settings.aoColumns;var column;var i,j,ien,jen,filterData,cellData,row;var fomatters=DataTable.ext.type.search;var wasInvalidated=false;for(i=0,ien=settings.aoData.length;i<ien;i++){row=settings.aoData[i];if(!row._aFilterData){filterData=[];for(j=0,jen=columns.length;j<jen;j++){column=columns[j];if(column.bSearchable){cellData=_fnGetCellData(settings,i,j,'filter');if(fomatters[column.sType]){cellData=fomatters[column.sType](cellData);}
if(cellData===null){cellData='';}
if(typeof cellData!=='string'&&cellData.toString){cellData=cellData.toString();}}
else{cellData='';}
if(cellData.indexOf&&cellData.indexOf('&')!==-1){__filter_div.innerHTML=cellData;cellData=__filter_div_textContent?__filter_div.textContent:__filter_div.innerText;}
if(cellData.replace){cellData=cellData.replace(/[\r\n]/g,'');}
filterData.push(cellData);}
row._aFilterData=filterData;row._sFilterRow=filterData.join('  ');wasInvalidated=true;}}
return wasInvalidated;}
function _fnSearchToCamel(obj)
{return{search:obj.sSearch,smart:obj.bSmart,regex:obj.bRegex,caseInsensitive:obj.bCaseInsensitive};}
function _fnSearchToHung(obj)
{return{sSearch:obj.search,bSmart:obj.smart,bRegex:obj.regex,bCaseInsensitive:obj.caseInsensitive};}
function _fnFeatureHtmlInfo(settings)
{var
tid=settings.sTableId,nodes=settings.aanFeatures.i,n=$('<div/>',{'class':settings.oClasses.sInfo,'id':!nodes?tid+'_info':null});if(!nodes){settings.aoDrawCallback.push({"fn":_fnUpdateInfo,"sName":"information"});n.attr('role','status').attr('aria-live','polite');$(settings.nTable).attr('aria-describedby',tid+'_info');}
return n[0];}
function _fnUpdateInfo(settings)
{var nodes=settings.aanFeatures.i;if(nodes.length===0){return;}
var
lang=settings.oLanguage,start=settings._iDisplayStart+1,end=settings.fnDisplayEnd(),max=settings.fnRecordsTotal(),total=settings.fnRecordsDisplay(),out=total?lang.sInfo:lang.sInfoEmpty;if(total!==max){out+=' '+lang.sInfoFiltered;}
out+=lang.sInfoPostFix;out=_fnInfoMacros(settings,out);var callback=lang.fnInfoCallback;if(callback!==null){out=callback.call(settings.oInstance,settings,start,end,max,total,out);}
$(nodes).html(out);}
function _fnInfoMacros(settings,str)
{var
formatter=settings.fnFormatNumber,start=settings._iDisplayStart+1,len=settings._iDisplayLength,vis=settings.fnRecordsDisplay(),all=len===-1;return str.replace(/_START_/g,formatter.call(settings,start)).replace(/_END_/g,formatter.call(settings,settings.fnDisplayEnd())).replace(/_MAX_/g,formatter.call(settings,settings.fnRecordsTotal())).replace(/_TOTAL_/g,formatter.call(settings,vis)).replace(/_PAGE_/g,formatter.call(settings,all?1:Math.ceil(start/len))).replace(/_PAGES_/g,formatter.call(settings,all?1:Math.ceil(vis/len)));}
function _fnInitialise(settings)
{var i,iLen,iAjaxStart=settings.iInitDisplayStart;var columns=settings.aoColumns,column;var features=settings.oFeatures;var deferLoading=settings.bDeferLoading;if(!settings.bInitialised){setTimeout(function(){_fnInitialise(settings);},200);return;}
_fnAddOptionsHtml(settings);_fnBuildHead(settings);_fnDrawHead(settings,settings.aoHeader);_fnDrawHead(settings,settings.aoFooter);_fnProcessingDisplay(settings,true);if(features.bAutoWidth){_fnCalculateColumnWidths(settings);}
for(i=0,iLen=columns.length;i<iLen;i++){column=columns[i];if(column.sWidth){column.nTh.style.width=_fnStringToCss(column.sWidth);}}
_fnCallbackFire(settings,null,'preInit',[settings]);_fnReDraw(settings);var dataSrc=_fnDataSource(settings);if(dataSrc!='ssp'||deferLoading){if(dataSrc=='ajax'){_fnBuildAjax(settings,[],function(json){var aData=_fnAjaxDataSrc(settings,json);for(i=0;i<aData.length;i++){_fnAddData(settings,aData[i]);}
settings.iInitDisplayStart=iAjaxStart;_fnReDraw(settings);_fnProcessingDisplay(settings,false);_fnInitComplete(settings,json);},settings);}
else{_fnProcessingDisplay(settings,false);_fnInitComplete(settings);}}}
function _fnInitComplete(settings,json)
{settings._bInitComplete=true;if(json||settings.oInit.aaData){_fnAdjustColumnSizing(settings);}
_fnCallbackFire(settings,'aoInitComplete','init',[settings,json]);}
function _fnLengthChange(settings,val)
{var len=parseInt(val,10);settings._iDisplayLength=len;_fnLengthOverflow(settings);_fnCallbackFire(settings,null,'length',[settings,len]);}
function _fnFeatureHtmlLength(settings)
{var
classes=settings.oClasses,tableId=settings.sTableId,menu=settings.aLengthMenu,d2=$.isArray(menu[0]),lengths=d2?menu[0]:menu,language=d2?menu[1]:menu;var select=$('<select/>',{'name':tableId+'_length','aria-controls':tableId,'class':classes.sLengthSelect});for(var i=0,ien=lengths.length;i<ien;i++){select[0][i]=new Option(language[i],lengths[i]);}
var div=$('<div><label/></div>').addClass(classes.sLength);if(!settings.aanFeatures.l){div[0].id=tableId+'_length';}
div.children().append(settings.oLanguage.sLengthMenu.replace('_MENU_',select[0].outerHTML));$('select',div).val(settings._iDisplayLength).bind('change.DT',function(e){_fnLengthChange(settings,$(this).val());_fnDraw(settings);});$(settings.nTable).bind('length.dt.DT',function(e,s,len){if(settings===s){$('select',div).val(len);}});return div[0];}
function _fnFeatureHtmlPaginate(settings)
{var
type=settings.sPaginationType,plugin=DataTable.ext.pager[type],modern=typeof plugin==='function',redraw=function(settings){_fnDraw(settings);},node=$('<div/>').addClass(settings.oClasses.sPaging+type)[0],features=settings.aanFeatures;if(!modern){plugin.fnInit(settings,node,redraw);}
if(!features.p)
{node.id=settings.sTableId+'_paginate';settings.aoDrawCallback.push({"fn":function(settings){if(modern){var
start=settings._iDisplayStart,len=settings._iDisplayLength,visRecords=settings.fnRecordsDisplay(),all=len===-1,page=all?0:Math.ceil(start/len),pages=all?1:Math.ceil(visRecords/len),buttons=plugin(page,pages),i,ien;for(i=0,ien=features.p.length;i<ien;i++){_fnRenderer(settings,'pageButton')(settings,features.p[i],i,buttons,page,pages);}}
else{plugin.fnUpdate(settings,redraw);}},"sName":"pagination"});}
return node;}
function _fnPageChange(settings,action,redraw)
{var
start=settings._iDisplayStart,len=settings._iDisplayLength,records=settings.fnRecordsDisplay();if(records===0||len===-1)
{start=0;}
else if(typeof action==="number")
{start=action*len;if(start>records)
{start=0;}}
else if(action=="first")
{start=0;}
else if(action=="previous")
{start=len>=0?start-len:0;if(start<0)
{start=0;}}
else if(action=="next")
{if(start+len<records)
{start+=len;}}
else if(action=="last")
{start=Math.floor((records-1)/len)*len;}
else
{_fnLog(settings,0,"Unknown paging action: "+action,5);}
var changed=settings._iDisplayStart!==start;settings._iDisplayStart=start;if(changed){_fnCallbackFire(settings,null,'page',[settings]);if(redraw){_fnDraw(settings);}}
return changed;}
function _fnFeatureHtmlProcessing(settings)
{return $('<div/>',{'id':!settings.aanFeatures.r?settings.sTableId+'_processing':null,'class':settings.oClasses.sProcessing}).html(settings.oLanguage.sProcessing).insertBefore(settings.nTable)[0];}
function _fnProcessingDisplay(settings,show)
{if(settings.oFeatures.bProcessing){$(settings.aanFeatures.r).css('display',show?'block':'none');}
_fnCallbackFire(settings,null,'processing',[settings,show]);}
function _fnFeatureHtmlTable(settings)
{var table=$(settings.nTable);table.attr('role','grid');var scroll=settings.oScroll;if(scroll.sX===''&&scroll.sY===''){return settings.nTable;}
var scrollX=scroll.sX;var scrollY=scroll.sY;var classes=settings.oClasses;var caption=table.children('caption');var captionSide=caption.length?caption[0]._captionSide:null;var headerClone=$(table[0].cloneNode(false));var footerClone=$(table[0].cloneNode(false));var footer=table.children('tfoot');var _div='<div/>';var size=function(s){return!s?null:_fnStringToCss(s);};if(scroll.sX&&table.attr('width')==='100%'){table.removeAttr('width');}
if(!footer.length){footer=null;}
var scroller=$(_div,{'class':classes.sScrollWrapper}).append($(_div,{'class':classes.sScrollHead}).css({overflow:'hidden',position:'relative',border:0,width:scrollX?size(scrollX):'100%'}).append($(_div,{'class':classes.sScrollHeadInner}).css({'box-sizing':'content-box',width:scroll.sXInner||'100%'}).append(headerClone.removeAttr('id').css('margin-left',0).append(captionSide==='top'?caption:null).append(table.children('thead'))))).append($(_div,{'class':classes.sScrollBody}).css({position:'relative',overflow:'auto',width:size(scrollX)}).append(table));if(footer){scroller.append($(_div,{'class':classes.sScrollFoot}).css({overflow:'hidden',border:0,width:scrollX?size(scrollX):'100%'}).append($(_div,{'class':classes.sScrollFootInner}).append(footerClone.removeAttr('id').css('margin-left',0).append(captionSide==='bottom'?caption:null).append(table.children('tfoot')))));}
var children=scroller.children();var scrollHead=children[0];var scrollBody=children[1];var scrollFoot=footer?children[2]:null;if(scrollX){$(scrollBody).on('scroll.DT',function(e){var scrollLeft=this.scrollLeft;scrollHead.scrollLeft=scrollLeft;if(footer){scrollFoot.scrollLeft=scrollLeft;}});}
$(scrollBody).css(scrollY&&scroll.bCollapse?'max-height':'height',scrollY);settings.nScrollHead=scrollHead;settings.nScrollBody=scrollBody;settings.nScrollFoot=scrollFoot;settings.aoDrawCallback.push({"fn":_fnScrollDraw,"sName":"scrolling"});return scroller[0];}
function _fnScrollDraw(settings)
{var
scroll=settings.oScroll,scrollX=scroll.sX,scrollXInner=scroll.sXInner,scrollY=scroll.sY,barWidth=scroll.iBarWidth,divHeader=$(settings.nScrollHead),divHeaderStyle=divHeader[0].style,divHeaderInner=divHeader.children('div'),divHeaderInnerStyle=divHeaderInner[0].style,divHeaderTable=divHeaderInner.children('table'),divBodyEl=settings.nScrollBody,divBody=$(divBodyEl),divBodyStyle=divBodyEl.style,divFooter=$(settings.nScrollFoot),divFooterInner=divFooter.children('div'),divFooterTable=divFooterInner.children('table'),header=$(settings.nTHead),table=$(settings.nTable),tableEl=table[0],tableStyle=tableEl.style,footer=settings.nTFoot?$(settings.nTFoot):null,browser=settings.oBrowser,ie67=browser.bScrollOversize,headerTrgEls,footerTrgEls,headerSrcEls,footerSrcEls,headerCopy,footerCopy,headerWidths=[],footerWidths=[],headerContent=[],idx,correction,sanityWidth,zeroOut=function(nSizer){var style=nSizer.style;style.paddingTop="0";style.paddingBottom="0";style.borderTopWidth="0";style.borderBottomWidth="0";style.height=0;};table.children('thead, tfoot').remove();headerCopy=header.clone().prependTo(table);headerTrgEls=header.find('tr');headerSrcEls=headerCopy.find('tr');headerCopy.find('th, td').removeAttr('tabindex');if(footer){footerCopy=footer.clone().prependTo(table);footerTrgEls=footer.find('tr');footerSrcEls=footerCopy.find('tr');}
if(!scrollX)
{divBodyStyle.width='100%';divHeader[0].style.width='100%';}
$.each(_fnGetUniqueThs(settings,headerCopy),function(i,el){idx=_fnVisibleToColumnIndex(settings,i);el.style.width=settings.aoColumns[idx].sWidth;});if(footer){_fnApplyToChildren(function(n){n.style.width="";},footerSrcEls);}
sanityWidth=table.outerWidth();if(scrollX===""){tableStyle.width="100%";if(ie67&&(table.find('tbody').height()>divBodyEl.offsetHeight||divBody.css('overflow-y')=="scroll")){tableStyle.width=_fnStringToCss(table.outerWidth()-barWidth);}
sanityWidth=table.outerWidth();}
else if(scrollXInner!==""){tableStyle.width=_fnStringToCss(scrollXInner);sanityWidth=table.outerWidth();}
_fnApplyToChildren(zeroOut,headerSrcEls);_fnApplyToChildren(function(nSizer){headerContent.push(nSizer.innerHTML);headerWidths.push(_fnStringToCss($(nSizer).css('width')));},headerSrcEls);_fnApplyToChildren(function(nToSize,i){nToSize.style.width=headerWidths[i];},headerTrgEls);$(headerSrcEls).height(0);if(footer)
{_fnApplyToChildren(zeroOut,footerSrcEls);_fnApplyToChildren(function(nSizer){footerWidths.push(_fnStringToCss($(nSizer).css('width')));},footerSrcEls);_fnApplyToChildren(function(nToSize,i){nToSize.style.width=footerWidths[i];},footerTrgEls);$(footerSrcEls).height(0);}
_fnApplyToChildren(function(nSizer,i){nSizer.innerHTML='<div class="dataTables_sizing" style="height:0;overflow:hidden;">'+headerContent[i]+'</div>';nSizer.style.width=headerWidths[i];},headerSrcEls);if(footer)
{_fnApplyToChildren(function(nSizer,i){nSizer.innerHTML="";nSizer.style.width=footerWidths[i];},footerSrcEls);}
if(table.outerWidth()<sanityWidth)
{correction=((divBodyEl.scrollHeight>divBodyEl.offsetHeight||divBody.css('overflow-y')=="scroll"))?sanityWidth+barWidth:sanityWidth;if(ie67&&(divBodyEl.scrollHeight>divBodyEl.offsetHeight||divBody.css('overflow-y')=="scroll")){tableStyle.width=_fnStringToCss(correction-barWidth);}
if(scrollX===""||scrollXInner!==""){_fnLog(settings,1,'Possible column misalignment',6);}}
else
{correction='100%';}
divBodyStyle.width=_fnStringToCss(correction);divHeaderStyle.width=_fnStringToCss(correction);if(footer){settings.nScrollFoot.style.width=_fnStringToCss(correction);}
if(!scrollY){if(ie67){divBodyStyle.height=_fnStringToCss(tableEl.offsetHeight+barWidth);}}
var iOuterWidth=table.outerWidth();divHeaderTable[0].style.width=_fnStringToCss(iOuterWidth);divHeaderInnerStyle.width=_fnStringToCss(iOuterWidth);var bScrolling=table.height()>divBodyEl.clientHeight||divBody.css('overflow-y')=="scroll";var padding='padding'+(browser.bScrollbarLeft?'Left':'Right');divHeaderInnerStyle[padding]=bScrolling?barWidth+"px":"0px";if(footer){divFooterTable[0].style.width=_fnStringToCss(iOuterWidth);divFooterInner[0].style.width=_fnStringToCss(iOuterWidth);divFooterInner[0].style[padding]=bScrolling?barWidth+"px":"0px";}
divBody.scroll();if((settings.bSorted||settings.bFiltered)&&!settings._drawHold){divBodyEl.scrollTop=0;}}
function _fnApplyToChildren(fn,an1,an2)
{var index=0,i=0,iLen=an1.length;var nNode1,nNode2;while(i<iLen){nNode1=an1[i].firstChild;nNode2=an2?an2[i].firstChild:null;while(nNode1){if(nNode1.nodeType===1){if(an2){fn(nNode1,nNode2,index);}
else{fn(nNode1,index);}
index++;}
nNode1=nNode1.nextSibling;nNode2=an2?nNode2.nextSibling:null;}
i++;}}
var __re_html_remove=/<.*?>/g;function _fnCalculateColumnWidths(oSettings)
{var
table=oSettings.nTable,columns=oSettings.aoColumns,scroll=oSettings.oScroll,scrollY=scroll.sY,scrollX=scroll.sX,scrollXInner=scroll.sXInner,columnCount=columns.length,visibleColumns=_fnGetColumns(oSettings,'bVisible'),headerCells=$('th',oSettings.nTHead),tableWidthAttr=table.getAttribute('width'),tableContainer=table.parentNode,userInputs=false,i,column,columnIdx,width,outerWidth,browser=oSettings.oBrowser,ie67=browser.bScrollOversize;var styleWidth=table.style.width;if(styleWidth&&styleWidth.indexOf('%')!==-1){tableWidthAttr=styleWidth;}
for(i=0;i<visibleColumns.length;i++){column=columns[visibleColumns[i]];if(column.sWidth!==null){column.sWidth=_fnConvertToWidth(column.sWidthOrig,tableContainer);userInputs=true;}}
if(ie67||!userInputs&&!scrollX&&!scrollY&&columnCount==_fnVisbleColumns(oSettings)&&columnCount==headerCells.length){for(i=0;i<columnCount;i++){var colIdx=_fnVisibleToColumnIndex(oSettings,i);if(colIdx){columns[colIdx].sWidth=_fnStringToCss(headerCells.eq(i).width());}}}
else
{var tmpTable=$(table).clone().css('visibility','hidden').removeAttr('id');tmpTable.find('tbody tr').remove();var tr=$('<tr/>').appendTo(tmpTable.find('tbody'));tmpTable.find('thead, tfoot').remove();tmpTable.append($(oSettings.nTHead).clone()).append($(oSettings.nTFoot).clone());tmpTable.find('tfoot th, tfoot td').css('width','');headerCells=_fnGetUniqueThs(oSettings,tmpTable.find('thead')[0]);for(i=0;i<visibleColumns.length;i++){column=columns[visibleColumns[i]];headerCells[i].style.width=column.sWidthOrig!==null&&column.sWidthOrig!==''?_fnStringToCss(column.sWidthOrig):'';}
if(oSettings.aoData.length){for(i=0;i<visibleColumns.length;i++){columnIdx=visibleColumns[i];column=columns[columnIdx];$(_fnGetWidestNode(oSettings,columnIdx)).clone(false).append(column.sContentPadding).appendTo(tr);}}
var holder=$('<div/>').css(scrollX||scrollY?{position:'absolute',top:0,left:0,height:1,right:0,overflow:'hidden'}:{}).append(tmpTable).appendTo(tableContainer);if(scrollX&&scrollXInner){tmpTable.width(scrollXInner);}
else if(scrollX){tmpTable.css('width','auto');if(tmpTable.width()<tableContainer.clientWidth){tmpTable.width(tableContainer.clientWidth);}}
else if(scrollY){tmpTable.width(tableContainer.clientWidth);}
else if(tableWidthAttr){tmpTable.width(tableWidthAttr);}
if(scrollX)
{var total=0;for(i=0;i<visibleColumns.length;i++){column=columns[visibleColumns[i]];outerWidth=browser.bBounding?headerCells[i].getBoundingClientRect().width:$(headerCells[i]).outerWidth();total+=column.sWidthOrig===null?outerWidth:parseInt(column.sWidth,10)+outerWidth-$(headerCells[i]).width();}
tmpTable.width(_fnStringToCss(total));table.style.width=_fnStringToCss(total);}
for(i=0;i<visibleColumns.length;i++){column=columns[visibleColumns[i]];width=$(headerCells[i]).width();if(width){column.sWidth=_fnStringToCss(width);}}
table.style.width=_fnStringToCss(tmpTable.css('width'));holder.remove();}
if(tableWidthAttr){table.style.width=_fnStringToCss(tableWidthAttr);}
if((tableWidthAttr||scrollX)&&!oSettings._reszEvt){var bindResize=function(){$(window).bind('resize.DT-'+oSettings.sInstance,_fnThrottle(function(){_fnAdjustColumnSizing(oSettings);}));};if(ie67){setTimeout(bindResize,1000);}
else{bindResize();}
oSettings._reszEvt=true;}}
function _fnThrottle(fn,freq){var
frequency=freq!==undefined?freq:200,last,timer;return function(){var
that=this,now=+new Date(),args=arguments;if(last&&now<last+frequency){clearTimeout(timer);timer=setTimeout(function(){last=undefined;fn.apply(that,args);},frequency);}
else{last=now;fn.apply(that,args);}};}
function _fnConvertToWidth(width,parent)
{if(!width){return 0;}
var n=$('<div/>').css('width',_fnStringToCss(width)).appendTo(parent||document.body);var val=n[0].offsetWidth;n.remove();return val;}
function _fnGetWidestNode(settings,colIdx)
{var idx=_fnGetMaxLenString(settings,colIdx);if(idx<0){return null;}
var data=settings.aoData[idx];return!data.nTr?$('<td/>').html(_fnGetCellData(settings,idx,colIdx,'display'))[0]:data.anCells[colIdx];}
function _fnGetMaxLenString(settings,colIdx)
{var s,max=-1,maxIdx=-1;for(var i=0,ien=settings.aoData.length;i<ien;i++){s=_fnGetCellData(settings,i,colIdx,'display')+'';s=s.replace(__re_html_remove,'');if(s.length>max){max=s.length;maxIdx=i;}}
return maxIdx;}
function _fnStringToCss(s)
{if(s===null){return'0px';}
if(typeof s=='number'){return s<0?'0px':s+'px';}
return s.match(/\d$/)?s+'px':s;}
function _fnSortFlatten(settings)
{var
i,iLen,k,kLen,aSort=[],aiOrig=[],aoColumns=settings.aoColumns,aDataSort,iCol,sType,srcCol,fixed=settings.aaSortingFixed,fixedObj=$.isPlainObject(fixed),nestedSort=[],add=function(a){if(a.length&&!$.isArray(a[0])){nestedSort.push(a);}
else{$.merge(nestedSort,a);}};if($.isArray(fixed)){add(fixed);}
if(fixedObj&&fixed.pre){add(fixed.pre);}
add(settings.aaSorting);if(fixedObj&&fixed.post){add(fixed.post);}
for(i=0;i<nestedSort.length;i++)
{srcCol=nestedSort[i][0];aDataSort=aoColumns[srcCol].aDataSort;for(k=0,kLen=aDataSort.length;k<kLen;k++)
{iCol=aDataSort[k];sType=aoColumns[iCol].sType||'string';if(nestedSort[i]._idx===undefined){nestedSort[i]._idx=$.inArray(nestedSort[i][1],aoColumns[iCol].asSorting);}
aSort.push({src:srcCol,col:iCol,dir:nestedSort[i][1],index:nestedSort[i]._idx,type:sType,formatter:DataTable.ext.type.order[sType+"-pre"]});}}
return aSort;}
function _fnSort(oSettings)
{var
i,ien,iLen,j,jLen,k,kLen,sDataType,nTh,aiOrig=[],oExtSort=DataTable.ext.type.order,aoData=oSettings.aoData,aoColumns=oSettings.aoColumns,aDataSort,data,iCol,sType,oSort,formatters=0,sortCol,displayMaster=oSettings.aiDisplayMaster,aSort;_fnColumnTypes(oSettings);aSort=_fnSortFlatten(oSettings);for(i=0,ien=aSort.length;i<ien;i++){sortCol=aSort[i];if(sortCol.formatter){formatters++;}
_fnSortData(oSettings,sortCol.col);}
if(_fnDataSource(oSettings)!='ssp'&&aSort.length!==0)
{for(i=0,iLen=displayMaster.length;i<iLen;i++){aiOrig[displayMaster[i]]=i;}
if(formatters===aSort.length){displayMaster.sort(function(a,b){var
x,y,k,test,sort,len=aSort.length,dataA=aoData[a]._aSortData,dataB=aoData[b]._aSortData;for(k=0;k<len;k++){sort=aSort[k];x=dataA[sort.col];y=dataB[sort.col];test=x<y?-1:x>y?1:0;if(test!==0){return sort.dir==='asc'?test:-test;}}
x=aiOrig[a];y=aiOrig[b];return x<y?-1:x>y?1:0;});}
else{displayMaster.sort(function(a,b){var
x,y,k,l,test,sort,fn,len=aSort.length,dataA=aoData[a]._aSortData,dataB=aoData[b]._aSortData;for(k=0;k<len;k++){sort=aSort[k];x=dataA[sort.col];y=dataB[sort.col];fn=oExtSort[sort.type+"-"+sort.dir]||oExtSort["string-"+sort.dir];test=fn(x,y);if(test!==0){return test;}}
x=aiOrig[a];y=aiOrig[b];return x<y?-1:x>y?1:0;});}}
oSettings.bSorted=true;}
function _fnSortAria(settings)
{var label;var nextSort;var columns=settings.aoColumns;var aSort=_fnSortFlatten(settings);var oAria=settings.oLanguage.oAria;for(var i=0,iLen=columns.length;i<iLen;i++)
{var col=columns[i];var asSorting=col.asSorting;var sTitle=col.sTitle.replace(/<.*?>/g,"");var th=col.nTh;th.removeAttribute('aria-sort');if(col.bSortable){if(aSort.length>0&&aSort[0].col==i){th.setAttribute('aria-sort',aSort[0].dir=="asc"?"ascending":"descending");nextSort=asSorting[aSort[0].index+1]||asSorting[0];}
else{nextSort=asSorting[0];}
label=sTitle+(nextSort==="asc"?oAria.sSortAscending:oAria.sSortDescending);}
else{label=sTitle;}
th.setAttribute('aria-label',label);}}
function _fnSortListener(settings,colIdx,append,callback)
{var col=settings.aoColumns[colIdx];var sorting=settings.aaSorting;var asSorting=col.asSorting;var nextSortIdx;var next=function(a,overflow){var idx=a._idx;if(idx===undefined){idx=$.inArray(a[1],asSorting);}
return idx+1<asSorting.length?idx+1:overflow?null:0;};if(typeof sorting[0]==='number'){sorting=settings.aaSorting=[sorting];}
if(append&&settings.oFeatures.bSortMulti){var sortIdx=$.inArray(colIdx,_pluck(sorting,'0'));if(sortIdx!==-1){nextSortIdx=next(sorting[sortIdx],true);if(nextSortIdx===null&&sorting.length===1){nextSortIdx=0;}
if(nextSortIdx===null){sorting.splice(sortIdx,1);}
else{sorting[sortIdx][1]=asSorting[nextSortIdx];sorting[sortIdx]._idx=nextSortIdx;}}
else{sorting.push([colIdx,asSorting[0],0]);sorting[sorting.length-1]._idx=0;}}
else if(sorting.length&&sorting[0][0]==colIdx){nextSortIdx=next(sorting[0]);sorting.length=1;sorting[0][1]=asSorting[nextSortIdx];sorting[0]._idx=nextSortIdx;}
else{sorting.length=0;sorting.push([colIdx,asSorting[0]]);sorting[0]._idx=0;}
_fnReDraw(settings);if(typeof callback=='function'){callback(settings);}}
function _fnSortAttachListener(settings,attachTo,colIdx,callback)
{var col=settings.aoColumns[colIdx];_fnBindAction(attachTo,{},function(e){if(col.bSortable===false){return;}
if(settings.oFeatures.bProcessing){_fnProcessingDisplay(settings,true);setTimeout(function(){_fnSortListener(settings,colIdx,e.shiftKey,callback);if(_fnDataSource(settings)!=='ssp'){_fnProcessingDisplay(settings,false);}},0);}
else{_fnSortListener(settings,colIdx,e.shiftKey,callback);}});}
function _fnSortingClasses(settings)
{var oldSort=settings.aLastSort;var sortClass=settings.oClasses.sSortColumn;var sort=_fnSortFlatten(settings);var features=settings.oFeatures;var i,ien,colIdx;if(features.bSort&&features.bSortClasses){for(i=0,ien=oldSort.length;i<ien;i++){colIdx=oldSort[i].src;$(_pluck(settings.aoData,'anCells',colIdx)).removeClass(sortClass+(i<2?i+1:3));}
for(i=0,ien=sort.length;i<ien;i++){colIdx=sort[i].src;$(_pluck(settings.aoData,'anCells',colIdx)).addClass(sortClass+(i<2?i+1:3));}}
settings.aLastSort=sort;}
function _fnSortData(settings,idx)
{var column=settings.aoColumns[idx];var customSort=DataTable.ext.order[column.sSortDataType];var customData;if(customSort){customData=customSort.call(settings.oInstance,settings,idx,_fnColumnIndexToVisible(settings,idx));}
var row,cellData;var formatter=DataTable.ext.type.order[column.sType+"-pre"];for(var i=0,ien=settings.aoData.length;i<ien;i++){row=settings.aoData[i];if(!row._aSortData){row._aSortData=[];}
if(!row._aSortData[idx]||customSort){cellData=customSort?customData[i]:_fnGetCellData(settings,i,idx,'sort');row._aSortData[idx]=formatter?formatter(cellData):cellData;}}}
function _fnSaveState(settings)
{if(!settings.oFeatures.bStateSave||settings.bDestroying)
{return;}
var state={time:+new Date(),start:settings._iDisplayStart,length:settings._iDisplayLength,order:$.extend(true,[],settings.aaSorting),search:_fnSearchToCamel(settings.oPreviousSearch),columns:$.map(settings.aoColumns,function(col,i){return{visible:col.bVisible,search:_fnSearchToCamel(settings.aoPreSearchCols[i])};})};_fnCallbackFire(settings,"aoStateSaveParams",'stateSaveParams',[settings,state]);settings.oSavedState=state;settings.fnStateSaveCallback.call(settings.oInstance,settings,state);}
function _fnLoadState(settings,oInit)
{var i,ien;var columns=settings.aoColumns;if(!settings.oFeatures.bStateSave){return;}
var state=settings.fnStateLoadCallback.call(settings.oInstance,settings);if(!state||!state.time){return;}
var abStateLoad=_fnCallbackFire(settings,'aoStateLoadParams','stateLoadParams',[settings,state]);if($.inArray(false,abStateLoad)!==-1){return;}
var duration=settings.iStateDuration;if(duration>0&&state.time<+new Date()-(duration*1000)){return;}
if(columns.length!==state.columns.length){return;}
settings.oLoadedState=$.extend(true,{},state);if(state.start!==undefined){settings._iDisplayStart=state.start;settings.iInitDisplayStart=state.start;}
if(state.length!==undefined){settings._iDisplayLength=state.length;}
if(state.order!==undefined){settings.aaSorting=[];$.each(state.order,function(i,col){settings.aaSorting.push(col[0]>=columns.length?[0,col[1]]:col);});}
if(state.search!==undefined){$.extend(settings.oPreviousSearch,_fnSearchToHung(state.search));}
for(i=0,ien=state.columns.length;i<ien;i++){var col=state.columns[i];if(col.visible!==undefined){columns[i].bVisible=col.visible;}
if(col.search!==undefined){$.extend(settings.aoPreSearchCols[i],_fnSearchToHung(col.search));}}
_fnCallbackFire(settings,'aoStateLoaded','stateLoaded',[settings,state]);}
function _fnSettingsFromNode(table)
{var settings=DataTable.settings;var idx=$.inArray(table,_pluck(settings,'nTable'));return idx!==-1?settings[idx]:null;}
function _fnLog(settings,level,msg,tn)
{msg='DataTables warning: '+(settings?'table id='+settings.sTableId+' - ':'')+msg;if(tn){msg+='. For more information about this error, please see '+'http://datatables.net/tn/'+tn;}
if(!level){var ext=DataTable.ext;var type=ext.sErrMode||ext.errMode;if(settings){_fnCallbackFire(settings,null,'error',[settings,tn,msg]);}
if(type=='alert'){alert(msg);}
else if(type=='throw'){throw new Error(msg);}
else if(typeof type=='function'){type(settings,tn,msg);}}
else if(window.console&&console.log){console.log(msg);}}
function _fnMap(ret,src,name,mappedName)
{if($.isArray(name)){$.each(name,function(i,val){if($.isArray(val)){_fnMap(ret,src,val[0],val[1]);}
else{_fnMap(ret,src,val);}});return;}
if(mappedName===undefined){mappedName=name;}
if(src[name]!==undefined){ret[mappedName]=src[name];}}
function _fnExtend(out,extender,breakRefs)
{var val;for(var prop in extender){if(extender.hasOwnProperty(prop)){val=extender[prop];if($.isPlainObject(val)){if(!$.isPlainObject(out[prop])){out[prop]={};}
$.extend(true,out[prop],val);}
else if(breakRefs&&prop!=='data'&&prop!=='aaData'&&$.isArray(val)){out[prop]=val.slice();}
else{out[prop]=val;}}}
return out;}
function _fnBindAction(n,oData,fn)
{$(n).bind('click.DT',oData,function(e){n.blur();fn(e);}).bind('keypress.DT',oData,function(e){if(e.which===13){e.preventDefault();fn(e);}}).bind('selectstart.DT',function(){return false;});}
function _fnCallbackReg(oSettings,sStore,fn,sName)
{if(fn)
{oSettings[sStore].push({"fn":fn,"sName":sName});}}
function _fnCallbackFire(settings,callbackArr,eventName,args)
{var ret=[];if(callbackArr){ret=$.map(settings[callbackArr].slice().reverse(),function(val,i){return val.fn.apply(settings.oInstance,args);});}
if(eventName!==null){var e=$.Event(eventName+'.dt');$(settings.nTable).trigger(e,args);ret.push(e.result);}
return ret;}
function _fnLengthOverflow(settings)
{var
start=settings._iDisplayStart,end=settings.fnDisplayEnd(),len=settings._iDisplayLength;if(start>=end)
{start=end-len;}
start-=(start%len);if(len===-1||start<0)
{start=0;}
settings._iDisplayStart=start;}
function _fnRenderer(settings,type)
{var renderer=settings.renderer;var host=DataTable.ext.renderer[type];if($.isPlainObject(renderer)&&renderer[type]){return host[renderer[type]]||host._;}
else if(typeof renderer==='string'){return host[renderer]||host._;}
return host._;}
function _fnDataSource(settings)
{if(settings.oFeatures.bServerSide){return'ssp';}
else if(settings.ajax||settings.sAjaxSource){return'ajax';}
return'dom';}
DataTable=function(options)
{this.$=function(sSelector,oOpts)
{return this.api(true).$(sSelector,oOpts);};this._=function(sSelector,oOpts)
{return this.api(true).rows(sSelector,oOpts).data();};this.api=function(traditional)
{return traditional?new _Api(_fnSettingsFromNode(this[_ext.iApiIndex])):new _Api(this);};this.fnAddData=function(data,redraw)
{var api=this.api(true);var rows=$.isArray(data)&&($.isArray(data[0])||$.isPlainObject(data[0]))?api.rows.add(data):api.row.add(data);if(redraw===undefined||redraw){api.draw();}
return rows.flatten().toArray();};this.fnAdjustColumnSizing=function(bRedraw)
{var api=this.api(true).columns.adjust();var settings=api.settings()[0];var scroll=settings.oScroll;if(bRedraw===undefined||bRedraw){api.draw(false);}
else if(scroll.sX!==""||scroll.sY!==""){_fnScrollDraw(settings);}};this.fnClearTable=function(bRedraw)
{var api=this.api(true).clear();if(bRedraw===undefined||bRedraw){api.draw();}};this.fnClose=function(nTr)
{this.api(true).row(nTr).child.hide();};this.fnDeleteRow=function(target,callback,redraw)
{var api=this.api(true);var rows=api.rows(target);var settings=rows.settings()[0];var data=settings.aoData[rows[0][0]];rows.remove();if(callback){callback.call(this,settings,data);}
if(redraw===undefined||redraw){api.draw();}
return data;};this.fnDestroy=function(remove)
{this.api(true).destroy(remove);};this.fnDraw=function(complete)
{this.api(true).draw(complete);};this.fnFilter=function(sInput,iColumn,bRegex,bSmart,bShowGlobal,bCaseInsensitive)
{var api=this.api(true);if(iColumn===null||iColumn===undefined){api.search(sInput,bRegex,bSmart,bCaseInsensitive);}
else{api.column(iColumn).search(sInput,bRegex,bSmart,bCaseInsensitive);}
api.draw();};this.fnGetData=function(src,col)
{var api=this.api(true);if(src!==undefined){var type=src.nodeName?src.nodeName.toLowerCase():'';return col!==undefined||type=='td'||type=='th'?api.cell(src,col).data():api.row(src).data()||null;}
return api.data().toArray();};this.fnGetNodes=function(iRow)
{var api=this.api(true);return iRow!==undefined?api.row(iRow).node():api.rows().nodes().flatten().toArray();};this.fnGetPosition=function(node)
{var api=this.api(true);var nodeName=node.nodeName.toUpperCase();if(nodeName=='TR'){return api.row(node).index();}
else if(nodeName=='TD'||nodeName=='TH'){var cell=api.cell(node).index();return[cell.row,cell.columnVisible,cell.column];}
return null;};this.fnIsOpen=function(nTr)
{return this.api(true).row(nTr).child.isShown();};this.fnOpen=function(nTr,mHtml,sClass)
{return this.api(true).row(nTr).child(mHtml,sClass).show().child()[0];};this.fnPageChange=function(mAction,bRedraw)
{var api=this.api(true).page(mAction);if(bRedraw===undefined||bRedraw){api.draw(false);}};this.fnSetColumnVis=function(iCol,bShow,bRedraw)
{var api=this.api(true).column(iCol).visible(bShow);if(bRedraw===undefined||bRedraw){api.columns.adjust().draw();}};this.fnSettings=function()
{return _fnSettingsFromNode(this[_ext.iApiIndex]);};this.fnSort=function(aaSort)
{this.api(true).order(aaSort).draw();};this.fnSortListener=function(nNode,iColumn,fnCallback)
{this.api(true).order.listener(nNode,iColumn,fnCallback);};this.fnUpdate=function(mData,mRow,iColumn,bRedraw,bAction)
{var api=this.api(true);if(iColumn===undefined||iColumn===null){api.row(mRow).data(mData);}
else{api.cell(mRow,iColumn).data(mData);}
if(bAction===undefined||bAction){api.columns.adjust();}
if(bRedraw===undefined||bRedraw){api.draw();}
return 0;};this.fnVersionCheck=_ext.fnVersionCheck;var _that=this;var emptyInit=options===undefined;var len=this.length;if(emptyInit){options={};}
this.oApi=this.internal=_ext.internal;for(var fn in DataTable.ext.internal){if(fn){this[fn]=_fnExternApiFunc(fn);}}
this.each(function(){var o={};var oInit=len>1?_fnExtend(o,options,true):options;var i=0,iLen,j,jLen,k,kLen;var sId=this.getAttribute('id');var bInitHandedOff=false;var defaults=DataTable.defaults;var $this=$(this);if(this.nodeName.toLowerCase()!='table')
{_fnLog(null,0,'Non-table node initialisation ('+this.nodeName+')',2);return;}
_fnCompatOpts(defaults);_fnCompatCols(defaults.column);_fnCamelToHungarian(defaults,defaults,true);_fnCamelToHungarian(defaults.column,defaults.column,true);_fnCamelToHungarian(defaults,$.extend(oInit,$this.data()));var allSettings=DataTable.settings;for(i=0,iLen=allSettings.length;i<iLen;i++)
{var s=allSettings[i];if(s.nTable==this||s.nTHead.parentNode==this||(s.nTFoot&&s.nTFoot.parentNode==this))
{var bRetrieve=oInit.bRetrieve!==undefined?oInit.bRetrieve:defaults.bRetrieve;var bDestroy=oInit.bDestroy!==undefined?oInit.bDestroy:defaults.bDestroy;if(emptyInit||bRetrieve)
{return s.oInstance;}
else if(bDestroy)
{s.oInstance.fnDestroy();break;}
else
{_fnLog(s,0,'Cannot reinitialise DataTable',3);return;}}
if(s.sTableId==this.id)
{allSettings.splice(i,1);break;}}
if(sId===null||sId==="")
{sId="DataTables_Table_"+(DataTable.ext._unique++);this.id=sId;}
var oSettings=$.extend(true,{},DataTable.models.oSettings,{"sDestroyWidth":$this[0].style.width,"sInstance":sId,"sTableId":sId});oSettings.nTable=this;oSettings.oApi=_that.internal;oSettings.oInit=oInit;allSettings.push(oSettings);oSettings.oInstance=(_that.length===1)?_that:$this.dataTable();_fnCompatOpts(oInit);if(oInit.oLanguage)
{_fnLanguageCompat(oInit.oLanguage);}
if(oInit.aLengthMenu&&!oInit.iDisplayLength)
{oInit.iDisplayLength=$.isArray(oInit.aLengthMenu[0])?oInit.aLengthMenu[0][0]:oInit.aLengthMenu[0];}
oInit=_fnExtend($.extend(true,{},defaults),oInit);_fnMap(oSettings.oFeatures,oInit,["bPaginate","bLengthChange","bFilter","bSort","bSortMulti","bInfo","bProcessing","bAutoWidth","bSortClasses","bServerSide","bDeferRender"]);_fnMap(oSettings,oInit,["asStripeClasses","ajax","fnServerData","fnFormatNumber","sServerMethod","aaSorting","aaSortingFixed","aLengthMenu","sPaginationType","sAjaxSource","sAjaxDataProp","iStateDuration","sDom","bSortCellsTop","iTabIndex","fnStateLoadCallback","fnStateSaveCallback","renderer","searchDelay","rowId",["iCookieDuration","iStateDuration"],["oSearch","oPreviousSearch"],["aoSearchCols","aoPreSearchCols"],["iDisplayLength","_iDisplayLength"],["bJQueryUI","bJUI"]]);_fnMap(oSettings.oScroll,oInit,[["sScrollX","sX"],["sScrollXInner","sXInner"],["sScrollY","sY"],["bScrollCollapse","bCollapse"]]);_fnMap(oSettings.oLanguage,oInit,"fnInfoCallback");_fnCallbackReg(oSettings,'aoDrawCallback',oInit.fnDrawCallback,'user');_fnCallbackReg(oSettings,'aoServerParams',oInit.fnServerParams,'user');_fnCallbackReg(oSettings,'aoStateSaveParams',oInit.fnStateSaveParams,'user');_fnCallbackReg(oSettings,'aoStateLoadParams',oInit.fnStateLoadParams,'user');_fnCallbackReg(oSettings,'aoStateLoaded',oInit.fnStateLoaded,'user');_fnCallbackReg(oSettings,'aoRowCallback',oInit.fnRowCallback,'user');_fnCallbackReg(oSettings,'aoRowCreatedCallback',oInit.fnCreatedRow,'user');_fnCallbackReg(oSettings,'aoHeaderCallback',oInit.fnHeaderCallback,'user');_fnCallbackReg(oSettings,'aoFooterCallback',oInit.fnFooterCallback,'user');_fnCallbackReg(oSettings,'aoInitComplete',oInit.fnInitComplete,'user');_fnCallbackReg(oSettings,'aoPreDrawCallback',oInit.fnPreDrawCallback,'user');oSettings.rowIdFn=_fnGetObjectDataFn(oInit.rowId);_fnBrowserDetect(oSettings);var oClasses=oSettings.oClasses;if(oInit.bJQueryUI)
{$.extend(oClasses,DataTable.ext.oJUIClasses,oInit.oClasses);if(oInit.sDom===defaults.sDom&&defaults.sDom==="lfrtip")
{oSettings.sDom='<"H"lfr>t<"F"ip>';}
if(!oSettings.renderer){oSettings.renderer='jqueryui';}
else if($.isPlainObject(oSettings.renderer)&&!oSettings.renderer.header){oSettings.renderer.header='jqueryui';}}
else
{$.extend(oClasses,DataTable.ext.classes,oInit.oClasses);}
$this.addClass(oClasses.sTable);if(oSettings.iInitDisplayStart===undefined)
{oSettings.iInitDisplayStart=oInit.iDisplayStart;oSettings._iDisplayStart=oInit.iDisplayStart;}
if(oInit.iDeferLoading!==null)
{oSettings.bDeferLoading=true;var tmp=$.isArray(oInit.iDeferLoading);oSettings._iRecordsDisplay=tmp?oInit.iDeferLoading[0]:oInit.iDeferLoading;oSettings._iRecordsTotal=tmp?oInit.iDeferLoading[1]:oInit.iDeferLoading;}
var oLanguage=oSettings.oLanguage;$.extend(true,oLanguage,oInit.oLanguage);if(oLanguage.sUrl!=="")
{$.ajax({dataType:'json',url:oLanguage.sUrl,success:function(json){_fnLanguageCompat(json);_fnCamelToHungarian(defaults.oLanguage,json);$.extend(true,oLanguage,json);_fnInitialise(oSettings);},error:function(){_fnInitialise(oSettings);}});bInitHandedOff=true;}
if(oInit.asStripeClasses===null)
{oSettings.asStripeClasses=[oClasses.sStripeOdd,oClasses.sStripeEven];}
var stripeClasses=oSettings.asStripeClasses;var rowOne=$this.children('tbody').find('tr').eq(0);if($.inArray(true,$.map(stripeClasses,function(el,i){return rowOne.hasClass(el);}))!==-1){$('tbody tr',this).removeClass(stripeClasses.join(' '));oSettings.asDestroyStripes=stripeClasses.slice();}
var anThs=[];var aoColumnsInit;var nThead=this.getElementsByTagName('thead');if(nThead.length!==0)
{_fnDetectHeader(oSettings.aoHeader,nThead[0]);anThs=_fnGetUniqueThs(oSettings);}
if(oInit.aoColumns===null)
{aoColumnsInit=[];for(i=0,iLen=anThs.length;i<iLen;i++)
{aoColumnsInit.push(null);}}
else
{aoColumnsInit=oInit.aoColumns;}
for(i=0,iLen=aoColumnsInit.length;i<iLen;i++)
{_fnAddColumn(oSettings,anThs?anThs[i]:null);}
_fnApplyColumnDefs(oSettings,oInit.aoColumnDefs,aoColumnsInit,function(iCol,oDef){_fnColumnOptions(oSettings,iCol,oDef);});if(rowOne.length){var a=function(cell,name){return cell.getAttribute('data-'+name)!==null?name:null;};$(rowOne[0]).children('th, td').each(function(i,cell){var col=oSettings.aoColumns[i];if(col.mData===i){var sort=a(cell,'sort')||a(cell,'order');var filter=a(cell,'filter')||a(cell,'search');if(sort!==null||filter!==null){col.mData={_:i+'.display',sort:sort!==null?i+'.@data-'+sort:undefined,type:sort!==null?i+'.@data-'+sort:undefined,filter:filter!==null?i+'.@data-'+filter:undefined};_fnColumnOptions(oSettings,i);}}});}
var features=oSettings.oFeatures;if(oInit.bStateSave)
{features.bStateSave=true;_fnLoadState(oSettings,oInit);_fnCallbackReg(oSettings,'aoDrawCallback',_fnSaveState,'state_save');}
if(oInit.aaSorting===undefined)
{var sorting=oSettings.aaSorting;for(i=0,iLen=sorting.length;i<iLen;i++)
{sorting[i][1]=oSettings.aoColumns[i].asSorting[0];}}
_fnSortingClasses(oSettings);if(features.bSort)
{_fnCallbackReg(oSettings,'aoDrawCallback',function(){if(oSettings.bSorted){var aSort=_fnSortFlatten(oSettings);var sortedColumns={};$.each(aSort,function(i,val){sortedColumns[val.src]=val.dir;});_fnCallbackFire(oSettings,null,'order',[oSettings,aSort,sortedColumns]);_fnSortAria(oSettings);}});}
_fnCallbackReg(oSettings,'aoDrawCallback',function(){if(oSettings.bSorted||_fnDataSource(oSettings)==='ssp'||features.bDeferRender){_fnSortingClasses(oSettings);}},'sc');var captions=$this.children('caption').each(function(){this._captionSide=$this.css('caption-side');});var thead=$this.children('thead');if(thead.length===0)
{thead=$('<thead/>').appendTo(this);}
oSettings.nTHead=thead[0];var tbody=$this.children('tbody');if(tbody.length===0)
{tbody=$('<tbody/>').appendTo(this);}
oSettings.nTBody=tbody[0];var tfoot=$this.children('tfoot');if(tfoot.length===0&&captions.length>0&&(oSettings.oScroll.sX!==""||oSettings.oScroll.sY!==""))
{tfoot=$('<tfoot/>').appendTo(this);}
if(tfoot.length===0||tfoot.children().length===0){$this.addClass(oClasses.sNoFooter);}
else if(tfoot.length>0){oSettings.nTFoot=tfoot[0];_fnDetectHeader(oSettings.aoFooter,oSettings.nTFoot);}
if(oInit.aaData)
{for(i=0;i<oInit.aaData.length;i++)
{_fnAddData(oSettings,oInit.aaData[i]);}}
else if(oSettings.bDeferLoading||_fnDataSource(oSettings)=='dom')
{_fnAddTr(oSettings,$(oSettings.nTBody).children('tr'));}
oSettings.aiDisplay=oSettings.aiDisplayMaster.slice();oSettings.bInitialised=true;if(bInitHandedOff===false)
{_fnInitialise(oSettings);}});_that=null;return this;};var __apiStruct=[];var __arrayProto=Array.prototype;var _toSettings=function(mixed)
{var idx,jq;var settings=DataTable.settings;var tables=$.map(settings,function(el,i){return el.nTable;});if(!mixed){return[];}
else if(mixed.nTable&&mixed.oApi){return[mixed];}
else if(mixed.nodeName&&mixed.nodeName.toLowerCase()==='table'){idx=$.inArray(mixed,tables);return idx!==-1?[settings[idx]]:null;}
else if(mixed&&typeof mixed.settings==='function'){return mixed.settings().toArray();}
else if(typeof mixed==='string'){jq=$(mixed);}
else if(mixed instanceof $){jq=mixed;}
if(jq){return jq.map(function(i){idx=$.inArray(this,tables);return idx!==-1?settings[idx]:null;}).toArray();}};_Api=function(context,data)
{if(!(this instanceof _Api)){return new _Api(context,data);}
var settings=[];var ctxSettings=function(o){var a=_toSettings(o);if(a){settings=settings.concat(a);}};if($.isArray(context)){for(var i=0,ien=context.length;i<ien;i++){ctxSettings(context[i]);}}
else{ctxSettings(context);}
this.context=_unique(settings);if(data){$.merge(this,data);}
this.selector={rows:null,cols:null,opts:null};_Api.extend(this,this,__apiStruct);};DataTable.Api=_Api;$.extend(_Api.prototype,{any:function()
{return this.count()!==0;},concat:__arrayProto.concat,context:[],count:function()
{return this.flatten().length;},each:function(fn)
{for(var i=0,ien=this.length;i<ien;i++){fn.call(this,this[i],i,this);}
return this;},eq:function(idx)
{var ctx=this.context;return ctx.length>idx?new _Api(ctx[idx],this[idx]):null;},filter:function(fn)
{var a=[];if(__arrayProto.filter){a=__arrayProto.filter.call(this,fn,this);}
else{for(var i=0,ien=this.length;i<ien;i++){if(fn.call(this,this[i],i,this)){a.push(this[i]);}}}
return new _Api(this.context,a);},flatten:function()
{var a=[];return new _Api(this.context,a.concat.apply(a,this.toArray()));},join:__arrayProto.join,indexOf:__arrayProto.indexOf||function(obj,start)
{for(var i=(start||0),ien=this.length;i<ien;i++){if(this[i]===obj){return i;}}
return-1;},iterator:function(flatten,type,fn,alwaysNew){var
a=[],ret,i,ien,j,jen,context=this.context,rows,items,item,selector=this.selector;if(typeof flatten==='string'){alwaysNew=fn;fn=type;type=flatten;flatten=false;}
for(i=0,ien=context.length;i<ien;i++){var apiInst=new _Api(context[i]);if(type==='table'){ret=fn.call(apiInst,context[i],i);if(ret!==undefined){a.push(ret);}}
else if(type==='columns'||type==='rows'){ret=fn.call(apiInst,context[i],this[i],i);if(ret!==undefined){a.push(ret);}}
else if(type==='column'||type==='column-rows'||type==='row'||type==='cell'){items=this[i];if(type==='column-rows'){rows=_selector_row_indexes(context[i],selector.opts);}
for(j=0,jen=items.length;j<jen;j++){item=items[j];if(type==='cell'){ret=fn.call(apiInst,context[i],item.row,item.column,i,j);}
else{ret=fn.call(apiInst,context[i],item,i,j,rows);}
if(ret!==undefined){a.push(ret);}}}}
if(a.length||alwaysNew){var api=new _Api(context,flatten?a.concat.apply([],a):a);var apiSelector=api.selector;apiSelector.rows=selector.rows;apiSelector.cols=selector.cols;apiSelector.opts=selector.opts;return api;}
return this;},lastIndexOf:__arrayProto.lastIndexOf||function(obj,start)
{return this.indexOf.apply(this.toArray.reverse(),arguments);},length:0,map:function(fn)
{var a=[];if(__arrayProto.map){a=__arrayProto.map.call(this,fn,this);}
else{for(var i=0,ien=this.length;i<ien;i++){a.push(fn.call(this,this[i],i));}}
return new _Api(this.context,a);},pluck:function(prop)
{return this.map(function(el){return el[prop];});},pop:__arrayProto.pop,push:__arrayProto.push,reduce:__arrayProto.reduce||function(fn,init)
{return _fnReduce(this,fn,init,0,this.length,1);},reduceRight:__arrayProto.reduceRight||function(fn,init)
{return _fnReduce(this,fn,init,this.length-1,-1,-1);},reverse:__arrayProto.reverse,selector:null,shift:__arrayProto.shift,sort:__arrayProto.sort,splice:__arrayProto.splice,toArray:function()
{return __arrayProto.slice.call(this);},to$:function()
{return $(this);},toJQuery:function()
{return $(this);},unique:function()
{return new _Api(this.context,_unique(this));},unshift:__arrayProto.unshift});_Api.extend=function(scope,obj,ext)
{if(!ext.length||!obj||(!(obj instanceof _Api)&&!obj.__dt_wrapper)){return;}
var
i,ien,j,jen,struct,inner,methodScoping=function(scope,fn,struc){return function(){var ret=fn.apply(scope,arguments);_Api.extend(ret,ret,struc.methodExt);return ret;};};for(i=0,ien=ext.length;i<ien;i++){struct=ext[i];obj[struct.name]=typeof struct.val==='function'?methodScoping(scope,struct.val,struct):$.isPlainObject(struct.val)?{}:struct.val;obj[struct.name].__dt_wrapper=true;_Api.extend(scope,obj[struct.name],struct.propExt);}};_Api.register=_api_register=function(name,val)
{if($.isArray(name)){for(var j=0,jen=name.length;j<jen;j++){_Api.register(name[j],val);}
return;}
var
i,ien,heir=name.split('.'),struct=__apiStruct,key,method;var find=function(src,name){for(var i=0,ien=src.length;i<ien;i++){if(src[i].name===name){return src[i];}}
return null;};for(i=0,ien=heir.length;i<ien;i++){method=heir[i].indexOf('()')!==-1;key=method?heir[i].replace('()',''):heir[i];var src=find(struct,key);if(!src){src={name:key,val:{},methodExt:[],propExt:[]};struct.push(src);}
if(i===ien-1){src.val=val;}
else{struct=method?src.methodExt:src.propExt;}}};_Api.registerPlural=_api_registerPlural=function(pluralName,singularName,val){_Api.register(pluralName,val);_Api.register(singularName,function(){var ret=val.apply(this,arguments);if(ret===this){return this;}
else if(ret instanceof _Api){return ret.length?$.isArray(ret[0])?new _Api(ret.context,ret[0]):ret[0]:undefined;}
return ret;});};var __table_selector=function(selector,a)
{if(typeof selector==='number'){return[a[selector]];}
var nodes=$.map(a,function(el,i){return el.nTable;});return $(nodes).filter(selector).map(function(i){var idx=$.inArray(this,nodes);return a[idx];}).toArray();};_api_register('tables()',function(selector){return selector?new _Api(__table_selector(selector,this.context)):this;});_api_register('table()',function(selector){var tables=this.tables(selector);var ctx=tables.context;return ctx.length?new _Api(ctx[0]):tables;});_api_registerPlural('tables().nodes()','table().node()',function(){return this.iterator('table',function(ctx){return ctx.nTable;},1);});_api_registerPlural('tables().body()','table().body()',function(){return this.iterator('table',function(ctx){return ctx.nTBody;},1);});_api_registerPlural('tables().header()','table().header()',function(){return this.iterator('table',function(ctx){return ctx.nTHead;},1);});_api_registerPlural('tables().footer()','table().footer()',function(){return this.iterator('table',function(ctx){return ctx.nTFoot;},1);});_api_registerPlural('tables().containers()','table().container()',function(){return this.iterator('table',function(ctx){return ctx.nTableWrapper;},1);});_api_register('draw()',function(paging){return this.iterator('table',function(settings){if(paging==='page'){_fnDraw(settings);}
else{if(typeof paging==='string'){paging=paging==='full-hold'?false:true;}
_fnReDraw(settings,paging===false);}});});_api_register('page()',function(action){if(action===undefined){return this.page.info().page;}
return this.iterator('table',function(settings){_fnPageChange(settings,action);});});_api_register('page.info()',function(action){if(this.context.length===0){return undefined;}
var
settings=this.context[0],start=settings._iDisplayStart,len=settings._iDisplayLength,visRecords=settings.fnRecordsDisplay(),all=len===-1;return{"page":all?0:Math.floor(start/len),"pages":all?1:Math.ceil(visRecords/len),"start":start,"end":settings.fnDisplayEnd(),"length":len,"recordsTotal":settings.fnRecordsTotal(),"recordsDisplay":visRecords,"serverSide":_fnDataSource(settings)==='ssp'};});_api_register('page.len()',function(len){if(len===undefined){return this.context.length!==0?this.context[0]._iDisplayLength:undefined;}
return this.iterator('table',function(settings){_fnLengthChange(settings,len);});});var __reload=function(settings,holdPosition,callback){if(callback){var api=new _Api(settings);api.one('draw',function(){callback(api.ajax.json());});}
if(_fnDataSource(settings)=='ssp'){_fnReDraw(settings,holdPosition);}
else{_fnProcessingDisplay(settings,true);var xhr=settings.jqXHR;if(xhr&&xhr.readyState!==4){xhr.abort();}
_fnBuildAjax(settings,[],function(json){_fnClearTable(settings);var data=_fnAjaxDataSrc(settings,json);for(var i=0,ien=data.length;i<ien;i++){_fnAddData(settings,data[i]);}
_fnReDraw(settings,holdPosition);_fnProcessingDisplay(settings,false);});}};_api_register('ajax.json()',function(){var ctx=this.context;if(ctx.length>0){return ctx[0].json;}});_api_register('ajax.params()',function(){var ctx=this.context;if(ctx.length>0){return ctx[0].oAjaxData;}});_api_register('ajax.reload()',function(callback,resetPaging){return this.iterator('table',function(settings){__reload(settings,resetPaging===false,callback);});});_api_register('ajax.url()',function(url){var ctx=this.context;if(url===undefined){if(ctx.length===0){return undefined;}
ctx=ctx[0];return ctx.ajax?$.isPlainObject(ctx.ajax)?ctx.ajax.url:ctx.ajax:ctx.sAjaxSource;}
return this.iterator('table',function(settings){if($.isPlainObject(settings.ajax)){settings.ajax.url=url;}
else{settings.ajax=url;}});});_api_register('ajax.url().load()',function(callback,resetPaging){return this.iterator('table',function(ctx){__reload(ctx,resetPaging===false,callback);});});var _selector_run=function(type,selector,selectFn,settings,opts)
{var
out=[],res,a,i,ien,j,jen,selectorType=typeof selector;if(!selector||selectorType==='string'||selectorType==='function'||selector.length===undefined){selector=[selector];}
for(i=0,ien=selector.length;i<ien;i++){a=selector[i]&&selector[i].split?selector[i].split(','):[selector[i]];for(j=0,jen=a.length;j<jen;j++){res=selectFn(typeof a[j]==='string'?$.trim(a[j]):a[j]);if(res&&res.length){out=out.concat(res);}}}
var ext=_ext.selector[type];if(ext.length){for(i=0,ien=ext.length;i<ien;i++){out=ext[i](settings,opts,out);}}
return _unique(out);};var _selector_opts=function(opts)
{if(!opts){opts={};}
if(opts.filter&&opts.search===undefined){opts.search=opts.filter;}
return $.extend({search:'none',order:'current',page:'all'},opts);};var _selector_first=function(inst)
{for(var i=0,ien=inst.length;i<ien;i++){if(inst[i].length>0){inst[0]=inst[i];inst[0].length=1;inst.length=1;inst.context=[inst.context[i]];return inst;}}
inst.length=0;return inst;};var _selector_row_indexes=function(settings,opts)
{var
i,ien,tmp,a=[],displayFiltered=settings.aiDisplay,displayMaster=settings.aiDisplayMaster;var
search=opts.search,order=opts.order,page=opts.page;if(_fnDataSource(settings)=='ssp'){return search==='removed'?[]:_range(0,displayMaster.length);}
else if(page=='current'){for(i=settings._iDisplayStart,ien=settings.fnDisplayEnd();i<ien;i++){a.push(displayFiltered[i]);}}
else if(order=='current'||order=='applied'){a=search=='none'?displayMaster.slice():search=='applied'?displayFiltered.slice():$.map(displayMaster,function(el,i){return $.inArray(el,displayFiltered)===-1?el:null;});}
else if(order=='index'||order=='original'){for(i=0,ien=settings.aoData.length;i<ien;i++){if(search=='none'){a.push(i);}
else{tmp=$.inArray(i,displayFiltered);if((tmp===-1&&search=='removed')||(tmp>=0&&search=='applied'))
{a.push(i);}}}}
return a;};var __row_selector=function(settings,selector,opts)
{var run=function(sel){var selInt=_intVal(sel);var i,ien;if(selInt!==null&&!opts){return[selInt];}
var rows=_selector_row_indexes(settings,opts);if(selInt!==null&&$.inArray(selInt,rows)!==-1){return[selInt];}
else if(!sel){return rows;}
if(typeof sel==='function'){return $.map(rows,function(idx){var row=settings.aoData[idx];return sel(idx,row._aData,row.nTr)?idx:null;});}
var nodes=_removeEmpty(_pluck_order(settings.aoData,rows,'nTr'));if(sel.nodeName){if($.inArray(sel,nodes)!==-1){return[sel._DT_RowIndex];}}
if(typeof sel==='string'&&sel.charAt(0)==='#'){var rowObj=settings.aIds[sel.replace(/^#/,'')];if(rowObj!==undefined){return[rowObj.idx];}}
return $(nodes).filter(sel).map(function(){return this._DT_RowIndex;}).toArray();};return _selector_run('row',selector,run,settings,opts);};_api_register('rows()',function(selector,opts){if(selector===undefined){selector='';}
else if($.isPlainObject(selector)){opts=selector;selector='';}
opts=_selector_opts(opts);var inst=this.iterator('table',function(settings){return __row_selector(settings,selector,opts);},1);inst.selector.rows=selector;inst.selector.opts=opts;return inst;});_api_register('rows().nodes()',function(){return this.iterator('row',function(settings,row){return settings.aoData[row].nTr||undefined;},1);});_api_register('rows().data()',function(){return this.iterator(true,'rows',function(settings,rows){return _pluck_order(settings.aoData,rows,'_aData');},1);});_api_registerPlural('rows().cache()','row().cache()',function(type){return this.iterator('row',function(settings,row){var r=settings.aoData[row];return type==='search'?r._aFilterData:r._aSortData;},1);});_api_registerPlural('rows().invalidate()','row().invalidate()',function(src){return this.iterator('row',function(settings,row){_fnInvalidate(settings,row,src);});});_api_registerPlural('rows().indexes()','row().index()',function(){return this.iterator('row',function(settings,row){return row;},1);});_api_registerPlural('rows().ids()','row().id()',function(hash){var a=[];var context=this.context;for(var i=0,ien=context.length;i<ien;i++){for(var j=0,jen=this[i].length;j<jen;j++){var id=context[i].rowIdFn(context[i].aoData[this[i][j]]._aData);a.push((hash===true?'#':'')+id);}}
return new _Api(context,a);});_api_registerPlural('rows().remove()','row().remove()',function(){var that=this;this.iterator('row',function(settings,row,thatIdx){var data=settings.aoData;var rowData=data[row];data.splice(row,1);for(var i=0,ien=data.length;i<ien;i++){if(data[i].nTr!==null){data[i].nTr._DT_RowIndex=i;}}
_fnDeleteIndex(settings.aiDisplayMaster,row);_fnDeleteIndex(settings.aiDisplay,row);_fnDeleteIndex(that[thatIdx],row,false);_fnLengthOverflow(settings);var id=settings.rowIdFn(rowData._aData);if(id!==undefined){delete settings.aIds[id];}});this.iterator('table',function(settings){for(var i=0,ien=settings.aoData.length;i<ien;i++){settings.aoData[i].idx=i;}});return this;});_api_register('rows.add()',function(rows){var newRows=this.iterator('table',function(settings){var row,i,ien;var out=[];for(i=0,ien=rows.length;i<ien;i++){row=rows[i];if(row.nodeName&&row.nodeName.toUpperCase()==='TR'){out.push(_fnAddTr(settings,row)[0]);}
else{out.push(_fnAddData(settings,row));}}
return out;},1);var modRows=this.rows(-1);modRows.pop();$.merge(modRows,newRows);return modRows;});_api_register('row()',function(selector,opts){return _selector_first(this.rows(selector,opts));});_api_register('row().data()',function(data){var ctx=this.context;if(data===undefined){return ctx.length&&this.length?ctx[0].aoData[this[0]]._aData:undefined;}
ctx[0].aoData[this[0]]._aData=data;_fnInvalidate(ctx[0],this[0],'data');return this;});_api_register('row().node()',function(){var ctx=this.context;return ctx.length&&this.length?ctx[0].aoData[this[0]].nTr||null:null;});_api_register('row.add()',function(row){if(row instanceof $&&row.length){row=row[0];}
var rows=this.iterator('table',function(settings){if(row.nodeName&&row.nodeName.toUpperCase()==='TR'){return _fnAddTr(settings,row)[0];}
return _fnAddData(settings,row);});return this.row(rows[0]);});var __details_add=function(ctx,row,data,klass)
{var rows=[];var addRow=function(r,k){if($.isArray(r)||r instanceof $){for(var i=0,ien=r.length;i<ien;i++){addRow(r[i],k);}
return;}
if(r.nodeName&&r.nodeName.toLowerCase()==='tr'){rows.push(r);}
else{var created=$('<tr><td/></tr>').addClass(k);$('td',created).addClass(k).html(r)[0].colSpan=_fnVisbleColumns(ctx);rows.push(created[0]);}};addRow(data,klass);if(row._details){row._details.remove();}
row._details=$(rows);if(row._detailsShow){row._details.insertAfter(row.nTr);}};var __details_remove=function(api,idx)
{var ctx=api.context;if(ctx.length){var row=ctx[0].aoData[idx!==undefined?idx:api[0]];if(row&&row._details){row._details.remove();row._detailsShow=undefined;row._details=undefined;}}};var __details_display=function(api,show){var ctx=api.context;if(ctx.length&&api.length){var row=ctx[0].aoData[api[0]];if(row._details){row._detailsShow=show;if(show){row._details.insertAfter(row.nTr);}
else{row._details.detach();}
__details_events(ctx[0]);}}};var __details_events=function(settings)
{var api=new _Api(settings);var namespace='.dt.DT_details';var drawEvent='draw'+namespace;var colvisEvent='column-visibility'+namespace;var destroyEvent='destroy'+namespace;var data=settings.aoData;api.off(drawEvent+' '+colvisEvent+' '+destroyEvent);if(_pluck(data,'_details').length>0){api.on(drawEvent,function(e,ctx){if(settings!==ctx){return;}
api.rows({page:'current'}).eq(0).each(function(idx){var row=data[idx];if(row._detailsShow){row._details.insertAfter(row.nTr);}});});api.on(colvisEvent,function(e,ctx,idx,vis){if(settings!==ctx){return;}
var row,visible=_fnVisbleColumns(ctx);for(var i=0,ien=data.length;i<ien;i++){row=data[i];if(row._details){row._details.children('td[colspan]').attr('colspan',visible);}}});api.on(destroyEvent,function(e,ctx){if(settings!==ctx){return;}
for(var i=0,ien=data.length;i<ien;i++){if(data[i]._details){__details_remove(api,i);}}});}};var _emp='';var _child_obj=_emp+'row().child';var _child_mth=_child_obj+'()';_api_register(_child_mth,function(data,klass){var ctx=this.context;if(data===undefined){return ctx.length&&this.length?ctx[0].aoData[this[0]]._details:undefined;}
else if(data===true){this.child.show();}
else if(data===false){__details_remove(this);}
else if(ctx.length&&this.length){__details_add(ctx[0],ctx[0].aoData[this[0]],data,klass);}
return this;});_api_register([_child_obj+'.show()',_child_mth+'.show()'],function(show){__details_display(this,true);return this;});_api_register([_child_obj+'.hide()',_child_mth+'.hide()'],function(){__details_display(this,false);return this;});_api_register([_child_obj+'.remove()',_child_mth+'.remove()'],function(){__details_remove(this);return this;});_api_register(_child_obj+'.isShown()',function(){var ctx=this.context;if(ctx.length&&this.length){return ctx[0].aoData[this[0]]._detailsShow||false;}
return false;});var __re_column_selector=/^(.+):(name|visIdx|visible)$/;var __columnData=function(settings,column,r1,r2,rows){var a=[];for(var row=0,ien=rows.length;row<ien;row++){a.push(_fnGetCellData(settings,rows[row],column));}
return a;};var __column_selector=function(settings,selector,opts)
{var
columns=settings.aoColumns,names=_pluck(columns,'sName'),nodes=_pluck(columns,'nTh');var run=function(s){var selInt=_intVal(s);if(s===''){return _range(columns.length);}
if(selInt!==null){return[selInt>=0?selInt:columns.length+selInt];}
if(typeof s==='function'){var rows=_selector_row_indexes(settings,opts);return $.map(columns,function(col,idx){return s(idx,__columnData(settings,idx,0,0,rows),nodes[idx])?idx:null;});}
var match=typeof s==='string'?s.match(__re_column_selector):'';if(match){switch(match[2]){case'visIdx':case'visible':var idx=parseInt(match[1],10);if(idx<0){var visColumns=$.map(columns,function(col,i){return col.bVisible?i:null;});return[visColumns[visColumns.length+idx]];}
return[_fnVisibleToColumnIndex(settings,idx)];case'name':return $.map(names,function(name,i){return name===match[1]?i:null;});}}
else{return $(nodes).filter(s).map(function(){return $.inArray(this,nodes);}).toArray();}};return _selector_run('column',selector,run,settings,opts);};var __setColumnVis=function(settings,column,vis,recalc){var
cols=settings.aoColumns,col=cols[column],data=settings.aoData,row,cells,i,ien,tr;if(vis===undefined){return col.bVisible;}
if(col.bVisible===vis){return;}
if(vis){var insertBefore=$.inArray(true,_pluck(cols,'bVisible'),column+1);for(i=0,ien=data.length;i<ien;i++){tr=data[i].nTr;cells=data[i].anCells;if(tr){tr.insertBefore(cells[column],cells[insertBefore]||null);}}}
else{$(_pluck(settings.aoData,'anCells',column)).detach();}
col.bVisible=vis;_fnDrawHead(settings,settings.aoHeader);_fnDrawHead(settings,settings.aoFooter);if(recalc===undefined||recalc){_fnAdjustColumnSizing(settings);if(settings.oScroll.sX||settings.oScroll.sY){_fnScrollDraw(settings);}}
_fnCallbackFire(settings,null,'column-visibility',[settings,column,vis]);_fnSaveState(settings);};_api_register('columns()',function(selector,opts){if(selector===undefined){selector='';}
else if($.isPlainObject(selector)){opts=selector;selector='';}
opts=_selector_opts(opts);var inst=this.iterator('table',function(settings){return __column_selector(settings,selector,opts);},1);inst.selector.cols=selector;inst.selector.opts=opts;return inst;});_api_registerPlural('columns().header()','column().header()',function(selector,opts){return this.iterator('column',function(settings,column){return settings.aoColumns[column].nTh;},1);});_api_registerPlural('columns().footer()','column().footer()',function(selector,opts){return this.iterator('column',function(settings,column){return settings.aoColumns[column].nTf;},1);});_api_registerPlural('columns().data()','column().data()',function(){return this.iterator('column-rows',__columnData,1);});_api_registerPlural('columns().dataSrc()','column().dataSrc()',function(){return this.iterator('column',function(settings,column){return settings.aoColumns[column].mData;},1);});_api_registerPlural('columns().cache()','column().cache()',function(type){return this.iterator('column-rows',function(settings,column,i,j,rows){return _pluck_order(settings.aoData,rows,type==='search'?'_aFilterData':'_aSortData',column);},1);});_api_registerPlural('columns().nodes()','column().nodes()',function(){return this.iterator('column-rows',function(settings,column,i,j,rows){return _pluck_order(settings.aoData,rows,'anCells',column);},1);});_api_registerPlural('columns().visible()','column().visible()',function(vis,calc){return this.iterator('column',function(settings,column){if(vis===undefined){return settings.aoColumns[column].bVisible;}
__setColumnVis(settings,column,vis,calc);});});_api_registerPlural('columns().indexes()','column().index()',function(type){return this.iterator('column',function(settings,column){return type==='visible'?_fnColumnIndexToVisible(settings,column):column;},1);});_api_register('columns.adjust()',function(){return this.iterator('table',function(settings){_fnAdjustColumnSizing(settings);},1);});_api_register('column.index()',function(type,idx){if(this.context.length!==0){var ctx=this.context[0];if(type==='fromVisible'||type==='toData'){return _fnVisibleToColumnIndex(ctx,idx);}
else if(type==='fromData'||type==='toVisible'){return _fnColumnIndexToVisible(ctx,idx);}}});_api_register('column()',function(selector,opts){return _selector_first(this.columns(selector,opts));});var __cell_selector=function(settings,selector,opts)
{var data=settings.aoData;var rows=_selector_row_indexes(settings,opts);var cells=_removeEmpty(_pluck_order(data,rows,'anCells'));var allCells=$([].concat.apply([],cells));var row;var columns=settings.aoColumns.length;var a,i,ien,j,o,host;var run=function(s){var fnSelector=typeof s==='function';if(s===null||s===undefined||fnSelector){a=[];for(i=0,ien=rows.length;i<ien;i++){row=rows[i];for(j=0;j<columns;j++){o={row:row,column:j};if(fnSelector){host=data[row];if(s(o,_fnGetCellData(settings,row,j),host.anCells?host.anCells[j]:null)){a.push(o);}}
else{a.push(o);}}}
return a;}
if($.isPlainObject(s)){return[s];}
return allCells.filter(s).map(function(i,el){if(el.parentNode){row=el.parentNode._DT_RowIndex;}
else{for(i=0,ien=data.length;i<ien;i++){if($.inArray(el,data[i].anCells)!==-1){row=i;break;}}}
return{row:row,column:$.inArray(el,data[row].anCells)};}).toArray();};return _selector_run('cell',selector,run,settings,opts);};_api_register('cells()',function(rowSelector,columnSelector,opts){if($.isPlainObject(rowSelector)){if(rowSelector.row===undefined){opts=rowSelector;rowSelector=null;}
else{opts=columnSelector;columnSelector=null;}}
if($.isPlainObject(columnSelector)){opts=columnSelector;columnSelector=null;}
if(columnSelector===null||columnSelector===undefined){return this.iterator('table',function(settings){return __cell_selector(settings,rowSelector,_selector_opts(opts));});}
var columns=this.columns(columnSelector,opts);var rows=this.rows(rowSelector,opts);var a,i,ien,j,jen;var cells=this.iterator('table',function(settings,idx){a=[];for(i=0,ien=rows[idx].length;i<ien;i++){for(j=0,jen=columns[idx].length;j<jen;j++){a.push({row:rows[idx][i],column:columns[idx][j]});}}
return a;},1);$.extend(cells.selector,{cols:columnSelector,rows:rowSelector,opts:opts});return cells;});_api_registerPlural('cells().nodes()','cell().node()',function(){return this.iterator('cell',function(settings,row,column){var cells=settings.aoData[row].anCells;return cells?cells[column]:undefined;},1);});_api_register('cells().data()',function(){return this.iterator('cell',function(settings,row,column){return _fnGetCellData(settings,row,column);},1);});_api_registerPlural('cells().cache()','cell().cache()',function(type){type=type==='search'?'_aFilterData':'_aSortData';return this.iterator('cell',function(settings,row,column){return settings.aoData[row][type][column];},1);});_api_registerPlural('cells().render()','cell().render()',function(type){return this.iterator('cell',function(settings,row,column){return _fnGetCellData(settings,row,column,type);},1);});_api_registerPlural('cells().indexes()','cell().index()',function(){return this.iterator('cell',function(settings,row,column){return{row:row,column:column,columnVisible:_fnColumnIndexToVisible(settings,column)};},1);});_api_registerPlural('cells().invalidate()','cell().invalidate()',function(src){return this.iterator('cell',function(settings,row,column){_fnInvalidate(settings,row,src,column);});});_api_register('cell()',function(rowSelector,columnSelector,opts){return _selector_first(this.cells(rowSelector,columnSelector,opts));});_api_register('cell().data()',function(data){var ctx=this.context;var cell=this[0];if(data===undefined){return ctx.length&&cell.length?_fnGetCellData(ctx[0],cell[0].row,cell[0].column):undefined;}
_fnSetCellData(ctx[0],cell[0].row,cell[0].column,data);_fnInvalidate(ctx[0],cell[0].row,'data',cell[0].column);return this;});_api_register('order()',function(order,dir){var ctx=this.context;if(order===undefined){return ctx.length!==0?ctx[0].aaSorting:undefined;}
if(typeof order==='number'){order=[[order,dir]];}
else if(!$.isArray(order[0])){order=Array.prototype.slice.call(arguments);}
return this.iterator('table',function(settings){settings.aaSorting=order.slice();});});_api_register('order.listener()',function(node,column,callback){return this.iterator('table',function(settings){_fnSortAttachListener(settings,node,column,callback);});});_api_register(['columns().order()','column().order()'],function(dir){var that=this;return this.iterator('table',function(settings,i){var sort=[];$.each(that[i],function(j,col){sort.push([col,dir]);});settings.aaSorting=sort;});});_api_register('search()',function(input,regex,smart,caseInsen){var ctx=this.context;if(input===undefined){return ctx.length!==0?ctx[0].oPreviousSearch.sSearch:undefined;}
return this.iterator('table',function(settings){if(!settings.oFeatures.bFilter){return;}
_fnFilterComplete(settings,$.extend({},settings.oPreviousSearch,{"sSearch":input+"","bRegex":regex===null?false:regex,"bSmart":smart===null?true:smart,"bCaseInsensitive":caseInsen===null?true:caseInsen}),1);});});_api_registerPlural('columns().search()','column().search()',function(input,regex,smart,caseInsen){return this.iterator('column',function(settings,column){var preSearch=settings.aoPreSearchCols;if(input===undefined){return preSearch[column].sSearch;}
if(!settings.oFeatures.bFilter){return;}
$.extend(preSearch[column],{"sSearch":input+"","bRegex":regex===null?false:regex,"bSmart":smart===null?true:smart,"bCaseInsensitive":caseInsen===null?true:caseInsen});_fnFilterComplete(settings,settings.oPreviousSearch,1);});});_api_register('state()',function(){return this.context.length?this.context[0].oSavedState:null;});_api_register('state.clear()',function(){return this.iterator('table',function(settings){settings.fnStateSaveCallback.call(settings.oInstance,settings,{});});});_api_register('state.loaded()',function(){return this.context.length?this.context[0].oLoadedState:null;});_api_register('state.save()',function(){return this.iterator('table',function(settings){_fnSaveState(settings);});});DataTable.versionCheck=DataTable.fnVersionCheck=function(version)
{var aThis=DataTable.version.split('.');var aThat=version.split('.');var iThis,iThat;for(var i=0,iLen=aThat.length;i<iLen;i++){iThis=parseInt(aThis[i],10)||0;iThat=parseInt(aThat[i],10)||0;if(iThis===iThat){continue;}
return iThis>iThat;}
return true;};DataTable.isDataTable=DataTable.fnIsDataTable=function(table)
{var t=$(table).get(0);var is=false;$.each(DataTable.settings,function(i,o){var head=o.nScrollHead?$('table',o.nScrollHead)[0]:null;var foot=o.nScrollFoot?$('table',o.nScrollFoot)[0]:null;if(o.nTable===t||head===t||foot===t){is=true;}});return is;};DataTable.tables=DataTable.fnTables=function(visible)
{var api=false;if($.isPlainObject(visible)){api=visible.api;visible=visible.visible;}
var a=$.map(DataTable.settings,function(o){if(!visible||(visible&&$(o.nTable).is(':visible'))){return o.nTable;}});return api?new _Api(a):a;};DataTable.util={throttle:_fnThrottle,escapeRegex:_fnEscapeRegex};DataTable.camelToHungarian=_fnCamelToHungarian;_api_register('$()',function(selector,opts){var
rows=this.rows(opts).nodes(),jqRows=$(rows);return $([].concat(jqRows.filter(selector).toArray(),jqRows.find(selector).toArray()));});$.each(['on','one','off'],function(i,key){_api_register(key+'()',function(){var args=Array.prototype.slice.call(arguments);if(!args[0].match(/\.dt\b/)){args[0]+='.dt';}
var inst=$(this.tables().nodes());inst[key].apply(inst,args);return this;});});_api_register('clear()',function(){return this.iterator('table',function(settings){_fnClearTable(settings);});});_api_register('settings()',function(){return new _Api(this.context,this.context);});_api_register('init()',function(){var ctx=this.context;return ctx.length?ctx[0].oInit:null;});_api_register('data()',function(){return this.iterator('table',function(settings){return _pluck(settings.aoData,'_aData');}).flatten();});_api_register('destroy()',function(remove){remove=remove||false;return this.iterator('table',function(settings){var orig=settings.nTableWrapper.parentNode;var classes=settings.oClasses;var table=settings.nTable;var tbody=settings.nTBody;var thead=settings.nTHead;var tfoot=settings.nTFoot;var jqTable=$(table);var jqTbody=$(tbody);var jqWrapper=$(settings.nTableWrapper);var rows=$.map(settings.aoData,function(r){return r.nTr;});var i,ien;settings.bDestroying=true;_fnCallbackFire(settings,"aoDestroyCallback","destroy",[settings]);if(!remove){new _Api(settings).columns().visible(true);}
jqWrapper.unbind('.DT').find(':not(tbody *)').unbind('.DT');$(window).unbind('.DT-'+settings.sInstance);if(table!=thead.parentNode){jqTable.children('thead').detach();jqTable.append(thead);}
if(tfoot&&table!=tfoot.parentNode){jqTable.children('tfoot').detach();jqTable.append(tfoot);}
settings.aaSorting=[];settings.aaSortingFixed=[];_fnSortingClasses(settings);$(rows).removeClass(settings.asStripeClasses.join(' '));$('th, td',thead).removeClass(classes.sSortable+' '+classes.sSortableAsc+' '+classes.sSortableDesc+' '+classes.sSortableNone);if(settings.bJUI){$('th span.'+classes.sSortIcon+', td span.'+classes.sSortIcon,thead).detach();$('th, td',thead).each(function(){var wrapper=$('div.'+classes.sSortJUIWrapper,this);$(this).append(wrapper.contents());wrapper.detach();});}
jqTbody.children().detach();jqTbody.append(rows);var removedMethod=remove?'remove':'detach';jqTable[removedMethod]();jqWrapper[removedMethod]();if(!remove&&orig){orig.insertBefore(table,settings.nTableReinsertBefore);jqTable.css('width',settings.sDestroyWidth).removeClass(classes.sTable);ien=settings.asDestroyStripes.length;if(ien){jqTbody.children().each(function(i){$(this).addClass(settings.asDestroyStripes[i%ien]);});}}
var idx=$.inArray(settings,DataTable.settings);if(idx!==-1){DataTable.settings.splice(idx,1);}});});$.each(['column','row','cell'],function(i,type){_api_register(type+'s().every()',function(fn){return this.iterator(type,function(settings,arg1,arg2,arg3,arg4){fn.call(new _Api(settings)[type](arg1,type==='cell'?arg2:undefined),arg1,arg2,arg3,arg4);});});});_api_register('i18n()',function(token,def,plural){var ctx=this.context[0];var resolved=_fnGetObjectDataFn(token)(ctx.oLanguage);if(resolved===undefined){resolved=def;}
if(plural!==undefined&&$.isPlainObject(resolved)){resolved=resolved[plural]!==undefined?resolved[plural]:resolved._;}
return resolved.replace('%d',plural);});DataTable.version="1.10.9";DataTable.settings=[];DataTable.models={};DataTable.models.oSearch={"bCaseInsensitive":true,"sSearch":"","bRegex":false,"bSmart":true};DataTable.models.oRow={"nTr":null,"anCells":null,"_aData":[],"_aSortData":null,"_aFilterData":null,"_sFilterRow":null,"_sRowStripe":"","src":null,"idx":-1};DataTable.models.oColumn={"idx":null,"aDataSort":null,"asSorting":null,"bSearchable":null,"bSortable":null,"bVisible":null,"_sManualType":null,"_bAttrSrc":false,"fnCreatedCell":null,"fnGetData":null,"fnSetData":null,"mData":null,"mRender":null,"nTh":null,"nTf":null,"sClass":null,"sContentPadding":null,"sDefaultContent":null,"sName":null,"sSortDataType":'std',"sSortingClass":null,"sSortingClassJUI":null,"sTitle":null,"sType":null,"sWidth":null,"sWidthOrig":null};DataTable.defaults={"aaData":null,"aaSorting":[[0,'asc']],"aaSortingFixed":[],"ajax":null,"aLengthMenu":[10,25,50,100],"aoColumns":null,"aoColumnDefs":null,"aoSearchCols":[],"asStripeClasses":null,"bAutoWidth":true,"bDeferRender":false,"bDestroy":false,"bFilter":true,"bInfo":true,"bJQueryUI":false,"bLengthChange":true,"bPaginate":true,"bProcessing":false,"bRetrieve":false,"bScrollCollapse":false,"bServerSide":false,"bSort":true,"bSortMulti":true,"bSortCellsTop":false,"bSortClasses":true,"bStateSave":false,"fnCreatedRow":null,"fnDrawCallback":null,"fnFooterCallback":null,"fnFormatNumber":function(toFormat){return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g,this.oLanguage.sThousands);},"fnHeaderCallback":null,"fnInfoCallback":null,"fnInitComplete":null,"fnPreDrawCallback":null,"fnRowCallback":null,"fnServerData":null,"fnServerParams":null,"fnStateLoadCallback":function(settings){try{return JSON.parse((settings.iStateDuration===-1?sessionStorage:localStorage).getItem('DataTables_'+settings.sInstance+'_'+location.pathname));}catch(e){}},"fnStateLoadParams":null,"fnStateLoaded":null,"fnStateSaveCallback":function(settings,data){try{(settings.iStateDuration===-1?sessionStorage:localStorage).setItem('DataTables_'+settings.sInstance+'_'+location.pathname,JSON.stringify(data));}catch(e){}},"fnStateSaveParams":null,"iStateDuration":7200,"iDeferLoading":null,"iDisplayLength":10,"iDisplayStart":0,"iTabIndex":0,"oClasses":{},"oLanguage":{"oAria":{"sSortAscending":": activate to sort column ascending","sSortDescending":": activate to sort column descending"},"oPaginate":{"sFirst":"First","sLast":"Last","sNext":"Next","sPrevious":"Previous"},"sEmptyTable":"No data available in table","sInfo":"Showing _START_ to _END_ of _TOTAL_ entries","sInfoEmpty":"Showing 0 to 0 of 0 entries","sInfoFiltered":"(filtered from _MAX_ total entries)","sInfoPostFix":"","sDecimal":"","sThousands":",","sLengthMenu":"Show _MENU_ entries","sLoadingRecords":"Loading...","sProcessing":"Processing...","sSearch":"Search:","sSearchPlaceholder":"","sUrl":"","sZeroRecords":"No matching records found"},"oSearch":$.extend({},DataTable.models.oSearch),"sAjaxDataProp":"data","sAjaxSource":null,"sDom":"lfrtip","searchDelay":null,"sPaginationType":"simple_numbers","sScrollX":"","sScrollXInner":"","sScrollY":"","sServerMethod":"GET","renderer":null,"rowId":"DT_RowId"};_fnHungarianMap(DataTable.defaults);DataTable.defaults.column={"aDataSort":null,"iDataSort":-1,"asSorting":['asc','desc'],"bSearchable":true,"bSortable":true,"bVisible":true,"fnCreatedCell":null,"mData":null,"mRender":null,"sCellType":"td","sClass":"","sContentPadding":"","sDefaultContent":null,"sName":"","sSortDataType":"std","sTitle":null,"sType":null,"sWidth":null};_fnHungarianMap(DataTable.defaults.column);DataTable.models.oSettings={"oFeatures":{"bAutoWidth":null,"bDeferRender":null,"bFilter":null,"bInfo":null,"bLengthChange":null,"bPaginate":null,"bProcessing":null,"bServerSide":null,"bSort":null,"bSortMulti":null,"bSortClasses":null,"bStateSave":null},"oScroll":{"bCollapse":null,"iBarWidth":0,"sX":null,"sXInner":null,"sY":null},"oLanguage":{"fnInfoCallback":null},"oBrowser":{"bScrollOversize":false,"bScrollbarLeft":false,"bBounding":false,"barWidth":0},"ajax":null,"aanFeatures":[],"aoData":[],"aiDisplay":[],"aiDisplayMaster":[],"aIds":{},"aoColumns":[],"aoHeader":[],"aoFooter":[],"oPreviousSearch":{},"aoPreSearchCols":[],"aaSorting":null,"aaSortingFixed":[],"asStripeClasses":null,"asDestroyStripes":[],"sDestroyWidth":0,"aoRowCallback":[],"aoHeaderCallback":[],"aoFooterCallback":[],"aoDrawCallback":[],"aoRowCreatedCallback":[],"aoPreDrawCallback":[],"aoInitComplete":[],"aoStateSaveParams":[],"aoStateLoadParams":[],"aoStateLoaded":[],"sTableId":"","nTable":null,"nTHead":null,"nTFoot":null,"nTBody":null,"nTableWrapper":null,"bDeferLoading":false,"bInitialised":false,"aoOpenRows":[],"sDom":null,"searchDelay":null,"sPaginationType":"two_button","iStateDuration":0,"aoStateSave":[],"aoStateLoad":[],"oSavedState":null,"oLoadedState":null,"sAjaxSource":null,"sAjaxDataProp":null,"bAjaxDataGet":true,"jqXHR":null,"json":undefined,"oAjaxData":undefined,"fnServerData":null,"aoServerParams":[],"sServerMethod":null,"fnFormatNumber":null,"aLengthMenu":null,"iDraw":0,"bDrawing":false,"iDrawError":-1,"_iDisplayLength":10,"_iDisplayStart":0,"_iRecordsTotal":0,"_iRecordsDisplay":0,"bJUI":null,"oClasses":{},"bFiltered":false,"bSorted":false,"bSortCellsTop":null,"oInit":null,"aoDestroyCallback":[],"fnRecordsTotal":function()
{return _fnDataSource(this)=='ssp'?this._iRecordsTotal*1:this.aiDisplayMaster.length;},"fnRecordsDisplay":function()
{return _fnDataSource(this)=='ssp'?this._iRecordsDisplay*1:this.aiDisplay.length;},"fnDisplayEnd":function()
{var
len=this._iDisplayLength,start=this._iDisplayStart,calc=start+len,records=this.aiDisplay.length,features=this.oFeatures,paginate=features.bPaginate;if(features.bServerSide){return paginate===false||len===-1?start+records:Math.min(start+len,this._iRecordsDisplay);}
else{return!paginate||calc>records||len===-1?records:calc;}},"oInstance":null,"sInstance":null,"iTabIndex":0,"nScrollHead":null,"nScrollFoot":null,"aLastSort":[],"oPlugins":{},"rowIdFn":null,"rowId":null};DataTable.ext=_ext={buttons:{},classes:{},errMode:"alert",feature:[],search:[],selector:{cell:[],column:[],row:[]},internal:{},legacy:{ajax:null},pager:{},renderer:{pageButton:{},header:{}},order:{},type:{detect:[],search:{},order:{}},_unique:0,fnVersionCheck:DataTable.fnVersionCheck,iApiIndex:0,oJUIClasses:{},sVersion:DataTable.version};$.extend(_ext,{afnFiltering:_ext.search,aTypes:_ext.type.detect,ofnSearch:_ext.type.search,oSort:_ext.type.order,afnSortData:_ext.order,aoFeatures:_ext.feature,oApi:_ext.internal,oStdClasses:_ext.classes,oPagination:_ext.pager});$.extend(DataTable.ext.classes,{"sTable":"dataTable","sNoFooter":"no-footer","sPageButton":"paginate_button","sPageButtonActive":"current","sPageButtonDisabled":"disabled","sStripeOdd":"odd","sStripeEven":"even","sRowEmpty":"dataTables_empty","sWrapper":"dataTables_wrapper","sFilter":"dataTables_filter","sInfo":"dataTables_info","sPaging":"dataTables_paginate paging_","sLength":"dataTables_length","sProcessing":"dataTables_processing","sSortAsc":"sorting_asc","sSortDesc":"sorting_desc","sSortable":"sorting","sSortableAsc":"sorting_asc_disabled","sSortableDesc":"sorting_desc_disabled","sSortableNone":"sorting_disabled","sSortColumn":"sorting_","sFilterInput":"","sLengthSelect":"","sScrollWrapper":"dataTables_scroll","sScrollHead":"dataTables_scrollHead","sScrollHeadInner":"dataTables_scrollHeadInner","sScrollBody":"dataTables_scrollBody","sScrollFoot":"dataTables_scrollFoot","sScrollFootInner":"dataTables_scrollFootInner","sHeaderTH":"","sFooterTH":"","sSortJUIAsc":"","sSortJUIDesc":"","sSortJUI":"","sSortJUIAscAllowed":"","sSortJUIDescAllowed":"","sSortJUIWrapper":"","sSortIcon":"","sJUIHeader":"","sJUIFooter":""});(function(){var _empty='';_empty='';var _stateDefault=_empty+'ui-state-default';var _sortIcon=_empty+'css_right ui-icon ui-icon-';var _headerFooter=_empty+'fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix';$.extend(DataTable.ext.oJUIClasses,DataTable.ext.classes,{"sPageButton":"fg-button ui-button "+_stateDefault,"sPageButtonActive":"ui-state-disabled","sPageButtonDisabled":"ui-state-disabled","sPaging":"dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi "+"ui-buttonset-multi paging_","sSortAsc":_stateDefault+" sorting_asc","sSortDesc":_stateDefault+" sorting_desc","sSortable":_stateDefault+" sorting","sSortableAsc":_stateDefault+" sorting_asc_disabled","sSortableDesc":_stateDefault+" sorting_desc_disabled","sSortableNone":_stateDefault+" sorting_disabled","sSortJUIAsc":_sortIcon+"triangle-1-n","sSortJUIDesc":_sortIcon+"triangle-1-s","sSortJUI":_sortIcon+"carat-2-n-s","sSortJUIAscAllowed":_sortIcon+"carat-1-n","sSortJUIDescAllowed":_sortIcon+"carat-1-s","sSortJUIWrapper":"DataTables_sort_wrapper","sSortIcon":"DataTables_sort_icon","sScrollHead":"dataTables_scrollHead "+_stateDefault,"sScrollFoot":"dataTables_scrollFoot "+_stateDefault,"sHeaderTH":_stateDefault,"sFooterTH":_stateDefault,"sJUIHeader":_headerFooter+" ui-corner-tl ui-corner-tr","sJUIFooter":_headerFooter+" ui-corner-bl ui-corner-br"});}());var extPagination=DataTable.ext.pager;function _numbers(page,pages){var
numbers=[],buttons=extPagination.numbers_length,half=Math.floor(buttons/2),i=1;if(pages<=buttons){numbers=_range(0,pages);}
else if(page<=half){numbers=_range(0,buttons-2);numbers.push('ellipsis');numbers.push(pages-1);}
else if(page>=pages-1-half){numbers=_range(pages-(buttons-2),pages);numbers.splice(0,0,'ellipsis');numbers.splice(0,0,0);}
else{numbers=_range(page-half+2,page+half-1);numbers.push('ellipsis');numbers.push(pages-1);numbers.splice(0,0,'ellipsis');numbers.splice(0,0,0);}
numbers.DT_el='span';return numbers;}
$.extend(extPagination,{simple:function(page,pages){return['previous','next'];},full:function(page,pages){return['first','previous','next','last'];},numbers:function(page,pages){return[_numbers(page,pages)];},simple_numbers:function(page,pages){return['previous',_numbers(page,pages),'next'];},full_numbers:function(page,pages){return['first','previous',_numbers(page,pages),'next','last'];},_numbers:_numbers,numbers_length:7});$.extend(true,DataTable.ext.renderer,{pageButton:{_:function(settings,host,idx,buttons,page,pages){var classes=settings.oClasses;var lang=settings.oLanguage.oPaginate;var btnDisplay,btnClass,counter=0;var attach=function(container,buttons){var i,ien,node,button;var clickHandler=function(e){_fnPageChange(settings,e.data.action,true);};for(i=0,ien=buttons.length;i<ien;i++){button=buttons[i];if($.isArray(button)){var inner=$('<'+(button.DT_el||'div')+'/>').appendTo(container);attach(inner,button);}
else{btnDisplay=null;btnClass='';switch(button){case'ellipsis':container.append('<span class="ellipsis">&#x2026;</span>');break;case'first':btnDisplay=lang.sFirst;btnClass=button+(page>0?'':' '+classes.sPageButtonDisabled);break;case'previous':btnDisplay=lang.sPrevious;btnClass=button+(page>0?'':' '+classes.sPageButtonDisabled);break;case'next':btnDisplay=lang.sNext;btnClass=button+(page<pages-1?'':' '+classes.sPageButtonDisabled);break;case'last':btnDisplay=lang.sLast;btnClass=button+(page<pages-1?'':' '+classes.sPageButtonDisabled);break;default:btnDisplay=button+1;btnClass=page===button?classes.sPageButtonActive:'';break;}
if(btnDisplay!==null){node=$('<a>',{'class':classes.sPageButton+' '+btnClass,'aria-controls':settings.sTableId,'data-dt-idx':counter,'tabindex':settings.iTabIndex,'id':idx===0&&typeof button==='string'?settings.sTableId+'_'+button:null}).html(btnDisplay).appendTo(container);_fnBindAction(node,{action:button},clickHandler);counter++;}}}};var activeEl;try{activeEl=$(host).find(document.activeElement).data('dt-idx');}
catch(e){}
attach($(host).empty(),buttons);if(activeEl){$(host).find('[data-dt-idx='+activeEl+']').focus();}}}});$.extend(DataTable.ext.type.detect,[function(d,settings)
{var decimal=settings.oLanguage.sDecimal;return _isNumber(d,decimal)?'num'+decimal:null;},function(d,settings)
{if(d&&!(d instanceof Date)&&(!_re_date_start.test(d)||!_re_date_end.test(d))){return null;}
var parsed=Date.parse(d);return(parsed!==null&&!isNaN(parsed))||_empty(d)?'date':null;},function(d,settings)
{var decimal=settings.oLanguage.sDecimal;return _isNumber(d,decimal,true)?'num-fmt'+decimal:null;},function(d,settings)
{var decimal=settings.oLanguage.sDecimal;return _htmlNumeric(d,decimal)?'html-num'+decimal:null;},function(d,settings)
{var decimal=settings.oLanguage.sDecimal;return _htmlNumeric(d,decimal,true)?'html-num-fmt'+decimal:null;},function(d,settings)
{return _empty(d)||(typeof d==='string'&&d.indexOf('<')!==-1)?'html':null;}]);$.extend(DataTable.ext.type.search,{html:function(data){return _empty(data)?data:typeof data==='string'?data.replace(_re_new_lines," ").replace(_re_html,""):'';},string:function(data){return _empty(data)?data:typeof data==='string'?data.replace(_re_new_lines," "):data;}});var __numericReplace=function(d,decimalPlace,re1,re2){if(d!==0&&(!d||d==='-')){return-Infinity;}
if(decimalPlace){d=_numToDecimal(d,decimalPlace);}
if(d.replace){if(re1){d=d.replace(re1,'');}
if(re2){d=d.replace(re2,'');}}
return d*1;};function _addNumericSort(decimalPlace){$.each({"num":function(d){return __numericReplace(d,decimalPlace);},"num-fmt":function(d){return __numericReplace(d,decimalPlace,_re_formatted_numeric);},"html-num":function(d){return __numericReplace(d,decimalPlace,_re_html);},"html-num-fmt":function(d){return __numericReplace(d,decimalPlace,_re_html,_re_formatted_numeric);}},function(key,fn){_ext.type.order[key+decimalPlace+'-pre']=fn;if(key.match(/^html\-/)){_ext.type.search[key+decimalPlace]=_ext.type.search.html;}});}
$.extend(_ext.type.order,{"date-pre":function(d){return Date.parse(d)||0;},"html-pre":function(a){return _empty(a)?'':a.replace?a.replace(/<.*?>/g,"").toLowerCase():a+'';},"string-pre":function(a){return _empty(a)?'':typeof a==='string'?a.toLowerCase():!a.toString?'':a.toString();},"string-asc":function(x,y){return((x<y)?-1:((x>y)?1:0));},"string-desc":function(x,y){return((x<y)?1:((x>y)?-1:0));}});_addNumericSort('');$.extend(true,DataTable.ext.renderer,{header:{_:function(settings,cell,column,classes){$(settings.nTable).on('order.dt.DT',function(e,ctx,sorting,columns){if(settings!==ctx){return;}
var colIdx=column.idx;cell.removeClass(column.sSortingClass+' '+classes.sSortAsc+' '+classes.sSortDesc).addClass(columns[colIdx]=='asc'?classes.sSortAsc:columns[colIdx]=='desc'?classes.sSortDesc:column.sSortingClass);});},jqueryui:function(settings,cell,column,classes){$('<div/>').addClass(classes.sSortJUIWrapper).append(cell.contents()).append($('<span/>').addClass(classes.sSortIcon+' '+column.sSortingClassJUI)).appendTo(cell);$(settings.nTable).on('order.dt.DT',function(e,ctx,sorting,columns){if(settings!==ctx){return;}
var colIdx=column.idx;cell.removeClass(classes.sSortAsc+" "+classes.sSortDesc).addClass(columns[colIdx]=='asc'?classes.sSortAsc:columns[colIdx]=='desc'?classes.sSortDesc:column.sSortingClass);cell.find('span.'+classes.sSortIcon).removeClass(classes.sSortJUIAsc+" "+classes.sSortJUIDesc+" "+classes.sSortJUI+" "+classes.sSortJUIAscAllowed+" "+classes.sSortJUIDescAllowed).addClass(columns[colIdx]=='asc'?classes.sSortJUIAsc:columns[colIdx]=='desc'?classes.sSortJUIDesc:column.sSortingClassJUI);});}}});DataTable.render={number:function(thousands,decimal,precision,prefix,postfix){return{display:function(d){if(typeof d!=='number'&&typeof d!=='string'){return d;}
var negative=d<0?'-':'';d=Math.abs(parseFloat(d));var intPart=parseInt(d,10);var floatPart=precision?decimal+(d-intPart).toFixed(precision).substring(2):'';return negative+(prefix||'')+intPart.toString().replace(/\B(?=(\d{3})+(?!\d))/g,thousands)+floatPart+(postfix||'');}};}};function _fnExternApiFunc(fn)
{return function(){var args=[_fnSettingsFromNode(this[DataTable.ext.iApiIndex])].concat(Array.prototype.slice.call(arguments));return DataTable.ext.internal[fn].apply(this,args);};}
$.extend(DataTable.ext.internal,{_fnExternApiFunc:_fnExternApiFunc,_fnBuildAjax:_fnBuildAjax,_fnAjaxUpdate:_fnAjaxUpdate,_fnAjaxParameters:_fnAjaxParameters,_fnAjaxUpdateDraw:_fnAjaxUpdateDraw,_fnAjaxDataSrc:_fnAjaxDataSrc,_fnAddColumn:_fnAddColumn,_fnColumnOptions:_fnColumnOptions,_fnAdjustColumnSizing:_fnAdjustColumnSizing,_fnVisibleToColumnIndex:_fnVisibleToColumnIndex,_fnColumnIndexToVisible:_fnColumnIndexToVisible,_fnVisbleColumns:_fnVisbleColumns,_fnGetColumns:_fnGetColumns,_fnColumnTypes:_fnColumnTypes,_fnApplyColumnDefs:_fnApplyColumnDefs,_fnHungarianMap:_fnHungarianMap,_fnCamelToHungarian:_fnCamelToHungarian,_fnLanguageCompat:_fnLanguageCompat,_fnBrowserDetect:_fnBrowserDetect,_fnAddData:_fnAddData,_fnAddTr:_fnAddTr,_fnNodeToDataIndex:_fnNodeToDataIndex,_fnNodeToColumnIndex:_fnNodeToColumnIndex,_fnGetCellData:_fnGetCellData,_fnSetCellData:_fnSetCellData,_fnSplitObjNotation:_fnSplitObjNotation,_fnGetObjectDataFn:_fnGetObjectDataFn,_fnSetObjectDataFn:_fnSetObjectDataFn,_fnGetDataMaster:_fnGetDataMaster,_fnClearTable:_fnClearTable,_fnDeleteIndex:_fnDeleteIndex,_fnInvalidate:_fnInvalidate,_fnGetRowElements:_fnGetRowElements,_fnCreateTr:_fnCreateTr,_fnBuildHead:_fnBuildHead,_fnDrawHead:_fnDrawHead,_fnDraw:_fnDraw,_fnReDraw:_fnReDraw,_fnAddOptionsHtml:_fnAddOptionsHtml,_fnDetectHeader:_fnDetectHeader,_fnGetUniqueThs:_fnGetUniqueThs,_fnFeatureHtmlFilter:_fnFeatureHtmlFilter,_fnFilterComplete:_fnFilterComplete,_fnFilterCustom:_fnFilterCustom,_fnFilterColumn:_fnFilterColumn,_fnFilter:_fnFilter,_fnFilterCreateSearch:_fnFilterCreateSearch,_fnEscapeRegex:_fnEscapeRegex,_fnFilterData:_fnFilterData,_fnFeatureHtmlInfo:_fnFeatureHtmlInfo,_fnUpdateInfo:_fnUpdateInfo,_fnInfoMacros:_fnInfoMacros,_fnInitialise:_fnInitialise,_fnInitComplete:_fnInitComplete,_fnLengthChange:_fnLengthChange,_fnFeatureHtmlLength:_fnFeatureHtmlLength,_fnFeatureHtmlPaginate:_fnFeatureHtmlPaginate,_fnPageChange:_fnPageChange,_fnFeatureHtmlProcessing:_fnFeatureHtmlProcessing,_fnProcessingDisplay:_fnProcessingDisplay,_fnFeatureHtmlTable:_fnFeatureHtmlTable,_fnScrollDraw:_fnScrollDraw,_fnApplyToChildren:_fnApplyToChildren,_fnCalculateColumnWidths:_fnCalculateColumnWidths,_fnThrottle:_fnThrottle,_fnConvertToWidth:_fnConvertToWidth,_fnGetWidestNode:_fnGetWidestNode,_fnGetMaxLenString:_fnGetMaxLenString,_fnStringToCss:_fnStringToCss,_fnSortFlatten:_fnSortFlatten,_fnSort:_fnSort,_fnSortAria:_fnSortAria,_fnSortListener:_fnSortListener,_fnSortAttachListener:_fnSortAttachListener,_fnSortingClasses:_fnSortingClasses,_fnSortData:_fnSortData,_fnSaveState:_fnSaveState,_fnLoadState:_fnLoadState,_fnSettingsFromNode:_fnSettingsFromNode,_fnLog:_fnLog,_fnMap:_fnMap,_fnBindAction:_fnBindAction,_fnCallbackReg:_fnCallbackReg,_fnCallbackFire:_fnCallbackFire,_fnLengthOverflow:_fnLengthOverflow,_fnRenderer:_fnRenderer,_fnDataSource:_fnDataSource,_fnRowAttributes:_fnRowAttributes,_fnCalculateEnd:function(){}});$.fn.dataTable=DataTable;$.fn.dataTableSettings=DataTable.settings;$.fn.dataTableExt=DataTable.ext;$.fn.DataTable=function(opts){return $(this).dataTable(opts).api();};$.each(DataTable,function(prop,val){$.fn.DataTable[prop]=val;});return $.fn.dataTable;}));}(window,document));jQuery.fn.dataTable.ext.builder="dt\/jqc-1.11.3,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,b-1.0.3,b-colvis-1.0.3,b-flash-1.0.3,b-html5-1.0.3,b-print-1.0.3,fc-3.1.0,fh-3.0.0,r-1.0.7,se-1.0.1";(function(window,document,undefined){var factory=function($,DataTable){"use strict";var _instCounter=0;var _buttonCounter=0;var _dtButtons=DataTable.ext.buttons;var Buttons=function(dt,config)
{if(config===true){config={};}
if($.isArray(config)){config={buttons:config};}
this.c=$.extend(true,{},Buttons.defaults,config);if(config.buttons){this.c.buttons=config.buttons;}
this.s={dt:new DataTable.Api(dt),buttons:[],subButtons:[],listenKeys:'',namespace:'dtb'+(_instCounter++)};this.dom={container:$('<'+this.c.dom.container.tag+'/>').addClass(this.c.dom.container.className)};this._constructor();};$.extend(Buttons.prototype,{action:function(idx,action)
{var button=this._indexToButton(idx).conf;if(action===undefined){return button.action;}
button.action=action;return this;},active:function(idx,flag){var button=this._indexToButton(idx);button.node.toggleClass(this.c.dom.button.active,flag===undefined?true:flag);return this;},add:function(idx,config)
{if(typeof idx==='string'&&idx.indexOf('-')!==-1){var idxs=idx.split('-');this.c.buttons[idxs[0]*1].buttons.splice(idxs[1]*1,0,config);}
else{this.c.buttons.splice(idx*1,0,config);}
this.dom.container.empty();this._buildButtons(this.c.buttons);return this;},container:function()
{return this.dom.container;},disable:function(idx){var button=this._indexToButton(idx);button.node.addClass(this.c.dom.button.disabled);return this;},destroy:function()
{$('body').off('keyup.'+this.s.namespace);var buttons=this.s.buttons;var subButtons=this.s.subButtons;var i,ien,j,jen;for(i=0,ien=buttons.length;i<ien;i++){this.removePrep(i);for(j=0,jen=subButtons[i].length;j<jen;j++){this.removePrep(i+'-'+j);}}
this.removeCommit();this.dom.container.remove();var buttonInsts=this.s.dt.settings()[0];for(i=0,ien=buttonInsts.length;i<ien;i++){if(buttonInsts.inst===this){buttonInsts.splice(i,1);break;}}
return this;},enable:function(idx,flag)
{if(flag===false){return this.disable(idx);}
var button=this._indexToButton(idx);button.node.removeClass(this.c.dom.button.disabled);return this;},name:function()
{return this.c.name;},node:function(idx)
{var button=this._indexToButton(idx);return button.node;},removeCommit:function()
{var buttons=this.s.buttons;var subButtons=this.s.subButtons;var i,ien,j;for(i=buttons.length-1;i>=0;i--){if(buttons[i]===null){buttons.splice(i,1);subButtons.splice(i,1);this.c.buttons.splice(i,1);}}
for(i=0,ien=subButtons.length;i<ien;i++){for(j=subButtons[i].length-1;j>=0;j--){if(subButtons[i][j]===null){subButtons[i].splice(j,1);this.c.buttons[i].buttons.splice(j,1);}}}
return this;},removePrep:function(idx)
{var button;var dt=this.s.dt;if(typeof idx==='number'||idx.indexOf('-')===-1){button=this.s.buttons[idx*1];if(button.conf.destroy){button.conf.destroy.call(dt.button(idx),dt,button,button.conf);}
button.node.remove();this._removeKey(button.conf);this.s.buttons[idx*1]=null;}
else{var idxs=idx.split('-');button=this.s.subButtons[idxs[0]*1][idxs[1]*1];if(button.conf.destroy){button.conf.destroy.call(dt.button(idx),dt,button,button.conf);}
button.node.remove();this._removeKey(button.conf);this.s.subButtons[idxs[0]*1][idxs[1]*1]=null;}
return this;},text:function(idx,label)
{var button=this._indexToButton(idx);var linerTag=this.c.dom.buttonLiner.tag;var dt=this.s.dt;var text=function(opt){return typeof opt==='function'?opt(dt,button.node,button.conf):opt;};if(label===undefined){return text(button.conf.text);}
button.conf.text=label;if(linerTag){button.node.children(linerTag).html(text(label));}
else{button.node.html(text(label));}
return this;},toIndex:function(node)
{var i,ien,j,jen;var buttons=this.s.buttons;var subButtons=this.s.subButtons;for(i=0,ien=buttons.length;i<ien;i++){if(buttons[i].node[0]===node){return i+'';}}
for(i=0,ien=subButtons.length;i<ien;i++){for(j=0,jen=subButtons[i].length;j<jen;j++){if(subButtons[i][j].node[0]===node){return i+'-'+j;}}}},_constructor:function()
{var that=this;var dt=this.s.dt;var dtSettings=dt.settings()[0];if(!dtSettings._buttons){dtSettings._buttons=[];}
dtSettings._buttons.push({inst:this,name:this.c.name});this._buildButtons(this.c.buttons);dt.on('destroy',function(){that.destroy();});$('body').on('keyup.'+this.s.namespace,function(e){if(!document.activeElement||document.activeElement===document.body){var character=String.fromCharCode(e.keyCode).toLowerCase();if(that.s.listenKeys.toLowerCase().indexOf(character)!==-1){that._keypress(character,e);}}});},_addKey:function(conf)
{if(conf.key){this.s.listenKeys+=$.isPlainObject(conf.key)?conf.key.key:conf.key;}},_buildButtons:function(buttons,container,collectionCounter)
{var dt=this.s.dt;if(!container){container=this.dom.container;this.s.buttons=[];this.s.subButtons=[];}
for(var i=0,ien=buttons.length;i<ien;i++){var conf=this._resolveExtends(buttons[i]);if(!conf){continue;}
if($.isArray(conf)){this._buildButtons(conf,container,collectionCounter);continue;}
var button=this._buildButton(conf,collectionCounter!==undefined?true:false);if(!button){continue;}
var buttonNode=button.node;container.append(button.inserter);if(collectionCounter===undefined){this.s.buttons.push({node:buttonNode,conf:conf,inserter:button.inserter});this.s.subButtons.push([]);}
else{this.s.subButtons[collectionCounter].push({node:buttonNode,conf:conf,inserter:button.inserter});}
if(conf.buttons){var collectionDom=this.c.dom.collection;conf._collection=$('<'+collectionDom.tag+'/>').addClass(collectionDom.className);this._buildButtons(conf.buttons,conf._collection,i);}
if(conf.init){conf.init.call(dt.button(buttonNode),dt,buttonNode,conf);}}},_buildButton:function(config,collectionButton)
{var that=this;var buttonDom=this.c.dom.button;var linerDom=this.c.dom.buttonLiner;var collectionDom=this.c.dom.collection;var dt=this.s.dt;var text=function(opt){return typeof opt==='function'?opt(dt,button,config):opt;};if(collectionButton&&collectionDom.button){buttonDom=collectionDom.button;}
if(collectionButton&&collectionDom.buttonLiner){linerDom=collectionDom.buttonLiner;}
if(config.available&&!config.available(dt,config)){return false;}
var button=$('<'+buttonDom.tag+'/>').addClass(buttonDom.className).attr('tabindex',this.s.dt.settings()[0].iTabIndex).attr('aria-controls',this.s.dt.table().node().id).on('click.dtb',function(e){e.preventDefault();if(!button.hasClass(buttonDom.disabled)&&config.action){config.action.call(dt.button(button),e,dt,button,config);}
button.blur();}).on('keyup.dtb',function(e){if(e.keyCode===13){if(!button.hasClass(buttonDom.disabled)&&config.action){config.action.call(dt.button(button),e,dt,button,config);}}});if(linerDom.tag){button.append($('<'+linerDom.tag+'/>').html(text(config.text)).addClass(linerDom.className));}
else{button.html(text(config.text));}
if(config.enabled===false){button.addClass(buttonDom.disabled);}
if(config.className){button.addClass(config.className);}
if(!config.namespace){config.namespace='.dt-button-'+(_buttonCounter++);}
var buttonContainer=this.c.dom.buttonContainer;var inserter;if(buttonContainer){inserter=$('<'+buttonContainer.tag+'/>').addClass(buttonContainer.className).append(button);}
else{inserter=button;}
this._addKey(config);return{node:button,inserter:inserter};},_indexToButton:function(idx)
{if(typeof idx==='number'||idx.indexOf('-')===-1){return this.s.buttons[idx*1];}
var idxs=idx.split('-');return this.s.subButtons[idxs[0]*1][idxs[1]*1];},_keypress:function(character,e)
{var i,ien,j,jen;var buttons=this.s.buttons;var subButtons=this.s.subButtons;var run=function(conf,node){if(!conf.key){return;}
if(conf.key===character){node.click();}
else if($.isPlainObject(conf.key)){if(conf.key.key!==character){return;}
if(conf.key.shiftKey&&!e.shiftKey){return;}
if(conf.key.altKey&&!e.altKey){return;}
if(conf.key.ctrlKey&&!e.ctrlKey){return;}
if(conf.key.metaKey&&!e.metaKey){return;}
node.click();}};for(i=0,ien=buttons.length;i<ien;i++){run(buttons[i].conf,buttons[i].node);}
for(i=0,ien=subButtons.length;i<ien;i++){for(j=0,jen=subButtons[i].length;j<jen;j++){run(subButtons[i][j].conf,subButtons[i][j].node);}}},_removeKey:function(conf)
{if(conf.key){var character=$.isPlainObject(conf.key)?conf.key.key:conf.key;var a=this.s.listenKeys.split('');var idx=$.inArray(character,a);a.splice(idx,1);this.s.listenKeys=a.join('');}},_resolveExtends:function(conf)
{var dt=this.s.dt;var i,ien;var toConfObject=function(base){var loop=0;while(!$.isPlainObject(base)&&!$.isArray(base)){if(typeof base==='function'){base=base(dt,conf);if(!base){return false;}}
else if(typeof base==='string'){if(!_dtButtons[base]){throw'Unknown button type: '+base;}
base=_dtButtons[base];}
loop++;if(loop>30){throw'Buttons: Too many iterations';}}
return $.isArray(base)?base:$.extend({},base);};conf=toConfObject(conf);while(conf&&conf.extend){var objArray=toConfObject(_dtButtons[conf.extend]);if($.isArray(objArray)){return objArray;}
var originalClassName=objArray.className;conf=$.extend({},objArray,conf);if(originalClassName&&conf.className!==originalClassName){conf.className=originalClassName+' '+conf.className;}
var postfixButtons=conf.postfixButtons;if(postfixButtons){if(!conf.buttons){conf.buttons=[];}
for(i=0,ien=postfixButtons.length;i<ien;i++){conf.buttons.push(postfixButtons[i]);}
conf.postfixButtons=null;}
var prefixButtons=conf.prefixButtons;if(prefixButtons){if(!conf.buttons){conf.buttons=[];}
for(i=0,ien=prefixButtons.length;i<ien;i++){conf.buttons.splice(i,0,prefixButtons[i]);}
conf.prefixButtons=null;}
conf.extend=objArray.extend;}
return conf;}});Buttons.background=function(show,className,fade){if(fade===undefined){fade=400;}
if(show){$('<div/>').addClass(className).css('display','none').appendTo('body').fadeIn(fade);}
else{$('body > div.'+className).fadeOut(fade,function(){$(this).remove();});}};Buttons.instanceSelector=function(group,buttons)
{if(!group){return $.map(buttons,function(v){return v.inst;});}
var ret=[];var names=$.map(buttons,function(v){return v.name;});var process=function(input){if($.isArray(input)){for(var i=0,ien=input.length;i<ien;i++){process(input[i]);}
return;}
if(typeof input==='string'){if(input.indexOf(',')!==-1){process(input.split(','));}
else{var idx=$.inArray($.trim(input),names);if(idx!==-1){ret.push(buttons[idx].inst);}}}
else if(typeof input==='number'){ret.push(buttons[input].inst);}};process(group);return ret;};Buttons.buttonSelector=function(insts,selector)
{var ret=[];var run=function(selector,inst){var i,ien,j,jen;var buttons=[];$.each(inst.s.buttons,function(i,v){if(v!==null){buttons.push({node:v.node[0],name:v.name});}});$.each(inst.s.subButtons,function(i,v){$.each(v,function(j,w){if(w!==null){buttons.push({node:w.node[0],name:w.name});}});});var nodes=$.map(buttons,function(v){return v.node;});if($.isArray(selector)||selector instanceof $){for(i=0,ien=selector.length;i<ien;i++){run(selector[i],inst);}
return;}
if(selector===null||selector===undefined||selector==='*'){for(i=0,ien=buttons.length;i<ien;i++){ret.push({inst:inst,idx:inst.toIndex(buttons[i].node)});}}
else if(typeof selector==='number'){ret.push({inst:inst,idx:selector});}
else if(typeof selector==='string'){if(selector.indexOf(',')!==-1){var a=selector.split(',');for(i=0,ien=a.length;i<ien;i++){run($.trim(a[i]),inst);}}
else if(selector.match(/^\d+(\-\d+)?$/)){ret.push({inst:inst,idx:selector});}
else if(selector.indexOf(':name')!==-1){var name=selector.replace(':name','');for(i=0,ien=buttons.length;i<ien;i++){if(buttons[i].name===name){ret.push({inst:inst,idx:inst.toIndex(buttons[i].node)});}}}
else{$(nodes).filter(selector).each(function(){ret.push({inst:inst,idx:inst.toIndex(this)});});}}
else if(typeof selector==='object'&&selector.nodeName){var idx=$.inArray(selector,nodes);if(idx!==-1){ret.push({inst:inst,idx:inst.toIndex(nodes[idx])});}}};for(var i=0,ien=insts.length;i<ien;i++){var inst=insts[i];run(selector,inst);}
return ret;};Buttons.defaults={buttons:['copy','excel','csv','pdf','print'],name:'main',tabIndex:0,dom:{container:{tag:'div',className:'dt-buttons'},collection:{tag:'div',className:'dt-button-collection'},button:{tag:'a',className:'dt-button',active:'active',disabled:'disabled'},buttonLiner:{tag:'span',className:''}}};Buttons.version='1.0.3';$.extend(_dtButtons,{collection:{text:function(dt,button,config){return dt.i18n('buttons.collection','Collection');},className:'buttons-collection',action:function(e,dt,button,config){var background;var host=button;var hostOffset=host.offset();var tableContainer=$(dt.table().container());config._collection.addClass(config.collectionLayout).css('display','none').appendTo('body').fadeIn(config.fade);if(config._collection.css('position')==='absolute'){config._collection.css({top:hostOffset.top+host.outerHeight(),left:hostOffset.left});var listRight=hostOffset.left+config._collection.outerWidth();var tableRight=tableContainer.offset().left+tableContainer.width();if(listRight>tableRight){config._collection.css('left',hostOffset.left-(listRight-tableRight));}}
else{var top=config._collection.height()/2;if(top>$(window).height()/2){top=$(window).height()/2;}
config._collection.css('marginTop',top*-1);}
if(config.background){Buttons.background(true,config.backgroundClassName,config.fade);}
setTimeout(function(){$(document).on('click.dtb-collection',function(e){if(!$(e.target).parents().andSelf().filter(config._collection).length){config._collection.fadeOut(config.fade,function(){config._collection.detach();});Buttons.background(false,config.backgroundClassName,config.fade);$(document).off('click.dtb-collection');}});},10);},background:true,collectionLayout:'',backgroundClassName:'dt-button-background',fade:400},copy:function(dt,conf){if(conf.preferHtml&&_dtButtons.copyHtml5){return'copyHtml5';}
if(_dtButtons.copyFlash&&_dtButtons.copyFlash.available(dt,conf)){return'copyFlash';}
if(_dtButtons.copyHtml5){return'copyHtml5';}},csv:function(dt,conf){if(_dtButtons.csvHtml5&&_dtButtons.csvHtml5.available(dt,conf)){return'csvHtml5';}
if(_dtButtons.csvFlash&&_dtButtons.csvFlash.available(dt,conf)){return'csvFlash';}},excel:function(dt,conf){if(_dtButtons.excelHtml5&&_dtButtons.excelHtml5.available(dt,conf)){return'excelHtml5';}
if(_dtButtons.excelFlash&&_dtButtons.excelFlash.available(dt,conf)){return'excelFlash';}},pdf:function(dt,conf){if(_dtButtons.pdfHtml5&&_dtButtons.pdfHtml5.available(dt,conf)){return'pdfHtml5';}
if(_dtButtons.pdfFlash&&_dtButtons.pdfFlash.available(dt,conf)){return'pdfFlash';}}});DataTable.Api.register('buttons()',function(group,selector){if(selector===undefined){selector=group;group=undefined;}
return this.iterator(true,'table',function(ctx){if(ctx._buttons){return Buttons.buttonSelector(Buttons.instanceSelector(group,ctx._buttons),selector);}},true);});DataTable.Api.register('button()',function(group,selector){var buttons=this.buttons(group,selector);if(buttons.length>1){buttons.splice(1,buttons.length);}
return buttons;});DataTable.Api.register(['buttons().active()','button().active()'],function(flag){return this.each(function(set){set.inst.active(set.idx,flag);});});DataTable.Api.registerPlural('buttons().action()','button().action()',function(action){if(action===undefined){return this.map(function(set){return set.inst.action(set.idx);});}
return this.each(function(set){set.inst.action(set.idx,action);});});DataTable.Api.register(['buttons().enable()','button().enable()'],function(flag){return this.each(function(set){set.inst.enable(set.idx,flag);});});DataTable.Api.register(['buttons().disable()','button().disable()'],function(){return this.each(function(set){set.inst.disable(set.idx);});});DataTable.Api.registerPlural('buttons().nodes()','button().node()',function(){var jq=$();$(this.each(function(set){jq=jq.add(set.inst.node(set.idx));}));return jq;});DataTable.Api.registerPlural('buttons().text()','button().text()',function(label){if(label===undefined){return this.map(function(set){return set.inst.text(set.idx);});}
return this.each(function(set){set.inst.text(set.idx,label);});});DataTable.Api.registerPlural('buttons().trigger()','button().trigger()',function(){return this.each(function(set){set.inst.node(set.idx).trigger('click');});});DataTable.Api.registerPlural('buttons().containers()','buttons().container()',function(){var jq=$();$(this.each(function(set){jq=jq.add(set.inst.container());}));return jq;});DataTable.Api.register('button().add()',function(idx,conf){if(this.length===1){this[0].inst.add(idx,conf);}
return this.button(idx);});DataTable.Api.register('buttons().destroy()',function(idx){this.pluck('inst').unique().each(function(inst){inst.destroy();});return this;});DataTable.Api.registerPlural('buttons().remove()','buttons().remove()',function(){this.each(function(set){set.inst.removePrep(set.idx);});this.pluck('inst').unique().each(function(inst){inst.removeCommit();});return this;});var _infoTimer;DataTable.Api.register('buttons.info()',function(title,message,time){var that=this;if(title===false){$('#datatables_buttons_info').fadeOut(function(){$(this).remove();});clearTimeout(_infoTimer);_infoTimer=null;return this;}
if(_infoTimer){clearTimeout(_infoTimer);}
if($('#datatables_buttons_info').length){$('#datatables_buttons_info').remove();}
title=title?'<h2>'+title+'</h2>':'';$('<div id="datatables_buttons_info" class="dt-button-info"/>').html(title).append($('<div/>')[typeof message==='string'?'html':'append'](message)).css('display','none').appendTo('body').fadeIn();if(time!==undefined&&time!==0){_infoTimer=setTimeout(function(){that.buttons.info(false);},time);}
return this;});DataTable.Api.register('buttons.exportData()',function(options){if(this.context.length){return _exportData(new DataTable.Api(this.context[0]),options);}});var _exportData=function(dt,inOpts)
{var config=$.extend(true,{},{rows:null,columns:'',modifier:{search:'applied',order:'applied'},orthogonal:'display',stripHtml:true,stripNewlines:true,trim:true},inOpts);var strip=function(str){if(typeof str!=='string'){return str;}
if(config.stripHtml){str=str.replace(/<.*?>/g,'');}
if(config.trim){str=str.replace(/^\s+|\s+$/g,'');}
if(config.stripNewlines){str=str.replace(/\n/g,' ');}
return str;};var header=dt.columns(config.columns).indexes().map(function(idx,i){return strip(dt.column(idx).header().innerHTML);}).toArray();var footer=dt.table().footer()?dt.columns(config.columns).indexes().map(function(idx,i){var el=dt.column(idx).footer();return el?strip(el.innerHTML):'';}).toArray():null;var cells=dt.cells(config.rows,config.columns,config.modifier).render(config.orthogonal).toArray();var columns=header.length;var rows=cells.length/columns;var body=new Array(rows);var cellCounter=0;for(var i=0,ien=rows;i<ien;i++){var row=new Array(columns);for(var j=0;j<columns;j++){row[j]=strip(cells[cellCounter]);cellCounter++;}
body[i]=row;}
return{header:header,footer:footer,body:body};};$.fn.dataTable.Buttons=Buttons;$.fn.DataTable.Buttons=Buttons;$(document).on('init.dt.dtb',function(e,settings,json){if(e.namespace!=='dt'){return;}
var opts=settings.oInit.buttons||DataTable.defaults.buttons;if(opts&&!settings._buttons){new Buttons(settings,opts).container();}});DataTable.ext.feature.push({fnInit:function(settings){var api=new DataTable.Api(settings);var opts=api.init().buttons;return new Buttons(api,opts).container();},cFeature:"B"});return Buttons;};if(typeof define==='function'&&define.amd){define(['jquery','datatables'],factory);}
else if(typeof exports==='object'){factory(require('jquery'),require('datatables'));}
else if(jQuery&&!jQuery.fn.dataTable.Buttons){factory(jQuery,jQuery.fn.dataTable);}})(window,document);(function($,DataTable){"use strict";$.extend(DataTable.ext.buttons,{colvis:function(dt,conf){return{extend:'collection',text:function(dt){return dt.i18n('buttons.colvis','Column visibility');},className:'buttons-colvis',buttons:[{extend:'columnsToggle',columns:conf.columns}]};},columnsToggle:function(dt,conf){var columns=dt.columns(conf.columns).indexes().map(function(idx){return{extend:'columnToggle',columns:idx};}).toArray();return columns;},columnToggle:function(dt,conf){return{extend:'columnVisibility',columns:conf.columns};},columnsVisibility:function(dt,conf){var columns=dt.columns(conf.columns).indexes().map(function(idx){return{extend:'columnVisibility',columns:idx,visibility:conf.visibility};}).toArray();return columns;},columnVisibility:{columns:null,text:function(dt,button,conf){return conf._columnText(dt,conf.columns);},className:'buttons-columnVisibility',action:function(e,dt,button,conf){var col=dt.column(conf.columns);col.visible(conf.visibility!==undefined?conf.visibility:!col.visible());},init:function(dt,button,conf){var that=this;var col=dt.column(conf.columns);dt.on('column-visibility.dt'+conf.namespace,function(e,settings,column,state){if(column===conf.columns){that.active(state);}}).on('column-reorder.dt'+conf.namespace,function(e,settings,details){var col=dt.column(conf.columns);button.text(conf._columnText(dt,conf.columns));that.active(col.visible());});this.active(col.visible());},destroy:function(dt,button,conf){dt.off('column-visibility.dt'+conf.namespace).off('column-reorder.dt'+conf.namespace);},_columnText:function(dt,col){var idx=dt.column(col).index();return dt.settings()[0].aoColumns[idx].sTitle.replace(/\n/g," ").replace(/<.*?>/g,"").replace(/^\s+|\s+$/g,"");}},colvisRestore:{className:'buttons-colvisRestore',text:function(dt){return dt.i18n('buttons.colvisRestore','Restore visibility');},init:function(dt,button,conf){conf._visOriginal=dt.columns().indexes().map(function(idx){return dt.column(idx).visible();}).toArray();},action:function(e,dt,button,conf){dt.columns().every(function(i){this.visible(conf._visOriginal[i]);});}},colvisGroup:{className:'buttons-colvisGroup',action:function(e,dt,button,conf){dt.columns(conf.show).visible(true);dt.columns(conf.hide).visible(false);},show:[],hide:[]}});})(jQuery,jQuery.fn.dataTable);(function($,DataTable){"use strict";var ZeroClipboard_TableTools={version:"1.0.4-TableTools2",clients:{},moviePath:'',nextId:1,$:function(thingy){if(typeof(thingy)=='string'){thingy=document.getElementById(thingy);}
if(!thingy.addClass){thingy.hide=function(){this.style.display='none';};thingy.show=function(){this.style.display='';};thingy.addClass=function(name){this.removeClass(name);this.className+=' '+name;};thingy.removeClass=function(name){this.className=this.className.replace(new RegExp("\\s*"+name+"\\s*")," ").replace(/^\s+/,'').replace(/\s+$/,'');};thingy.hasClass=function(name){return!!this.className.match(new RegExp("\\s*"+name+"\\s*"));};}
return thingy;},setMoviePath:function(path){this.moviePath=path;},dispatch:function(id,eventName,args){var client=this.clients[id];if(client){client.receiveEvent(eventName,args);}},register:function(id,client){this.clients[id]=client;},getDOMObjectPosition:function(obj){var info={left:0,top:0,width:obj.width?obj.width:obj.offsetWidth,height:obj.height?obj.height:obj.offsetHeight};if(obj.style.width!==""){info.width=obj.style.width.replace("px","");}
if(obj.style.height!==""){info.height=obj.style.height.replace("px","");}
while(obj){info.left+=obj.offsetLeft;info.top+=obj.offsetTop;obj=obj.offsetParent;}
return info;},Client:function(elem){this.handlers={};this.id=ZeroClipboard_TableTools.nextId++;this.movieId='ZeroClipboard_TableToolsMovie_'+this.id;ZeroClipboard_TableTools.register(this.id,this);if(elem){this.glue(elem);}}};ZeroClipboard_TableTools.Client.prototype={id:0,ready:false,movie:null,clipText:'',fileName:'',action:'copy',handCursorEnabled:true,cssEffects:true,handlers:null,sized:false,glue:function(elem,title){this.domElement=ZeroClipboard_TableTools.$(elem);var zIndex=99;if(this.domElement.style.zIndex){zIndex=parseInt(this.domElement.style.zIndex,10)+1;}
var box=ZeroClipboard_TableTools.getDOMObjectPosition(this.domElement);this.div=document.createElement('div');var style=this.div.style;style.position='absolute';style.left='0px';style.top='0px';style.width=(box.width)+'px';style.height=box.height+'px';style.zIndex=zIndex;if(typeof title!="undefined"&&title!==""){this.div.title=title;}
if(box.width!==0&&box.height!==0){this.sized=true;}
if(this.domElement){this.domElement.appendChild(this.div);this.div.innerHTML=this.getHTML(box.width,box.height).replace(/&/g,'&amp;');}},positionElement:function(){var box=ZeroClipboard_TableTools.getDOMObjectPosition(this.domElement);var style=this.div.style;style.position='absolute';style.width=box.width+'px';style.height=box.height+'px';if(box.width!==0&&box.height!==0){this.sized=true;}else{return;}
var flash=this.div.childNodes[0];flash.width=box.width;flash.height=box.height;},getHTML:function(width,height){var html='';var flashvars='id='+this.id+'&width='+width+'&height='+height;if(navigator.userAgent.match(/MSIE/)){var protocol=location.href.match(/^https/i)?'https://':'http://';html+='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="'+protocol+'download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="'+width+'" height="'+height+'" id="'+this.movieId+'" align="middle"><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="false" /><param name="movie" value="'+ZeroClipboard_TableTools.moviePath+'" /><param name="loop" value="false" /><param name="menu" value="false" /><param name="quality" value="best" /><param name="bgcolor" value="#ffffff" /><param name="flashvars" value="'+flashvars+'"/><param name="wmode" value="transparent"/></object>';}
else{html+='<embed id="'+this.movieId+'" src="'+ZeroClipboard_TableTools.moviePath+'" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="'+width+'" height="'+height+'" name="'+this.movieId+'" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="'+flashvars+'" wmode="transparent" />';}
return html;},hide:function(){if(this.div){this.div.style.left='-2000px';}},show:function(){this.reposition();},destroy:function(){var that=this;if(this.domElement&&this.div){$(this.div).remove();this.domElement=null;this.div=null;$.each(ZeroClipboard_TableTools.clients,function(id,client){if(client===that){delete ZeroClipboard_TableTools.clients[id];}});}},reposition:function(elem){if(elem){this.domElement=ZeroClipboard_TableTools.$(elem);if(!this.domElement){this.hide();}}
if(this.domElement&&this.div){var box=ZeroClipboard_TableTools.getDOMObjectPosition(this.domElement);var style=this.div.style;style.left=''+box.left+'px';style.top=''+box.top+'px';}},clearText:function(){this.clipText='';if(this.ready){this.movie.clearText();}},appendText:function(newText){this.clipText+=newText;if(this.ready){this.movie.appendText(newText);}},setText:function(newText){this.clipText=newText;if(this.ready){this.movie.setText(newText);}},setFileName:function(newText){this.fileName=newText;if(this.ready){this.movie.setFileName(newText);}},setAction:function(newText){this.action=newText;if(this.ready){this.movie.setAction(newText);}},addEventListener:function(eventName,func){eventName=eventName.toString().toLowerCase().replace(/^on/,'');if(!this.handlers[eventName]){this.handlers[eventName]=[];}
this.handlers[eventName].push(func);},setHandCursor:function(enabled){this.handCursorEnabled=enabled;if(this.ready){this.movie.setHandCursor(enabled);}},setCSSEffects:function(enabled){this.cssEffects=!!enabled;},receiveEvent:function(eventName,args){var self;eventName=eventName.toString().toLowerCase().replace(/^on/,'');switch(eventName){case'load':this.movie=document.getElementById(this.movieId);if(!this.movie){self=this;setTimeout(function(){self.receiveEvent('load',null);},1);return;}
if(!this.ready&&navigator.userAgent.match(/Firefox/)&&navigator.userAgent.match(/Windows/)){self=this;setTimeout(function(){self.receiveEvent('load',null);},100);this.ready=true;return;}
this.ready=true;this.movie.clearText();this.movie.appendText(this.clipText);this.movie.setFileName(this.fileName);this.movie.setAction(this.action);this.movie.setHandCursor(this.handCursorEnabled);break;case'mouseover':if(this.domElement&&this.cssEffects){if(this.recoverActive){this.domElement.addClass('active');}}
break;case'mouseout':if(this.domElement&&this.cssEffects){this.recoverActive=false;if(this.domElement.hasClass('active')){this.domElement.removeClass('active');this.recoverActive=true;}}
break;case'mousedown':if(this.domElement&&this.cssEffects){this.domElement.addClass('active');}
break;case'mouseup':if(this.domElement&&this.cssEffects){this.domElement.removeClass('active');this.recoverActive=false;}
break;}
if(this.handlers[eventName]){for(var idx=0,len=this.handlers[eventName].length;idx<len;idx++){var func=this.handlers[eventName][idx];if(typeof(func)=='function'){func(this,args);}
else if((typeof(func)=='object')&&(func.length==2)){func[0][func[1]](this,args);}
else if(typeof(func)=='string'){window[func](this,args);}}}}};ZeroClipboard_TableTools.hasFlash=function()
{try{var fo=new ActiveXObject('ShockwaveFlash.ShockwaveFlash');if(fo){return true;}}
catch(e){if(navigator.mimeTypes&&navigator.mimeTypes['application/x-shockwave-flash']!==undefined&&navigator.mimeTypes['application/x-shockwave-flash'].enabledPlugin){return true;}}
return false;};window.ZeroClipboard_TableTools=ZeroClipboard_TableTools;var _glue=function(flash,node)
{var id=node.attr('id');if(node.parents('html').length){flash.glue(node[0],'');}
else{setTimeout(function(){_glue(flash,node);},500);}};var _filename=function(config,incExtension)
{var title=config.title;if(title.indexOf('*')!==-1){title=title.replace('*',$('title').text());}
title=title.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g,"");return incExtension===undefined||incExtension===true?title+config.extension:title;};var _setText=function(flash,data)
{var parts=data.match(/[\s\S]{1,8192}/g)||[];flash.clearText();for(var i=0,len=parts.length;i<len;i++)
{flash.appendText(parts[i]);}};var _newLine=function(config)
{return config.newline?config.newline:navigator.userAgent.match(/Windows/)?'\r\n':'\n';};var _exportData=function(dt,config)
{var newLine=_newLine(config);var data=dt.buttons.exportData(config.exportOptions);var join=function(a){var s='';var boundary=config.fieldBoundary;var separator=config.fieldSeparator;for(var i=0,ien=a.length;i<ien;i++){if(i>0){s+=separator;}
s+=boundary?boundary+a[i].replace(boundary,'\\'+boundary)+boundary:a[i];}
return s;};var header=config.header?join(data.header)+newLine:'';var footer=config.footer?newLine+join(data.footer):'';var body=[];for(var i=0,ien=data.body.length;i<ien;i++){body.push(join(data.body[i]));}
return{str:header+body.join(newLine)+footer,rows:body.length};};var flashButton={available:function(){return ZeroClipboard_TableTools.hasFlash();},init:function(dt,button,config){ZeroClipboard_TableTools.moviePath=DataTable.Buttons.swfPath;var flash=new ZeroClipboard_TableTools.Client();flash.setHandCursor(true);flash.addEventListener('mouseDown',function(client){config._fromFlash=true;dt.button(button[0]).trigger();config._fromFlash=false;});_glue(flash,button);config._flash=flash;},destroy:function(dt,button,config){config._flash.destroy();},fieldSeparator:',',fieldBoundary:'"',exportOptions:{},title:'*',extension:'.csv',header:true,footer:false};DataTable.Buttons.swfPath='//cdn.datatables.net/buttons/1.0.0/swf/flashExport.swf';DataTable.Api.register('buttons.resize()',function(){$.each(ZeroClipboard_TableTools.clients,function(i,client){if(client.domElement!==undefined&&client.domElement.parentNode){client.positionElement();}});});DataTable.ext.buttons.copyFlash=$.extend({},flashButton,{className:'buttons-copy buttons-flash',text:function(dt){return dt.i18n('buttons.copy','Copy');},action:function(e,dt,button,config){if(!config._fromFlash){return;}
var flash=config._flash;var data=_exportData(dt,config);flash.setAction('copy');_setText(flash,data.str);dt.buttons.info(dt.i18n('buttons.copyTitle','Copy to clipboard'),dt.i18n('buttons.copyInfo',{_:'Copied %d rows to clipboard',1:'Copied 1 row to clipboard'},data.rows),3000);},fieldSeparator:'\t',fieldBoundary:''});DataTable.ext.buttons.csvFlash=$.extend({},flashButton,{className:'buttons-csv buttons-flash',text:function(dt){return dt.i18n('buttons.csv','CSV');},action:function(e,dt,button,config){var flash=config._flash;var data=_exportData(dt,config);flash.setAction('csv');flash.setFileName(_filename(config));_setText(flash,data.str);}});DataTable.ext.buttons.excelFlash=$.extend({},flashButton,{className:'buttons-excel buttons-flash',text:function(dt){return dt.i18n('buttons.excel','Excel');},action:function(e,dt,button,config){var xml='';var flash=config._flash;var data=dt.buttons.exportData(config.exportOptions);var addRow=function(row){var cells=[];for(var i=0,ien=row.length;i<ien;i++){cells.push($.isNumeric(row[i])?'<c t="n"><v>'+row[i]+'</v></c>':'<c t="inlineStr"><is><t>'+row[i].replace(/&(?!amp;)/g,'&amp;')+'</t></is></c>');}
return'<row>'+cells.join('')+'</row>';};if(config.header){xml+=addRow(data.header);}
for(var i=0,ien=data.body.length;i<ien;i++){xml+=addRow(data.body[i]);}
if(config.footer){xml+=addRow(data.footer);}
flash.setAction('excel');flash.setFileName(_filename(config));_setText(flash,xml);},extension:'.xlsx'});DataTable.ext.buttons.pdfFlash=$.extend({},flashButton,{className:'buttons-pdf buttons-flash',text:function(dt){return dt.i18n('buttons.pdf','PDF');},action:function(e,dt,button,config){var flash=config._flash;var data=dt.buttons.exportData(config.exportOptions);var totalWidth=dt.table().node().offsetWidth;var ratios=dt.columns(config.columns).indexes().map(function(idx){return dt.column(idx).header().offsetWidth/totalWidth;});flash.setAction('pdf');flash.setFileName(_filename(config));_setText(flash,JSON.stringify({title:_filename(config,false),message:config.message,colWidth:ratios.toArray(),orientation:config.orientation,size:config.pageSize,header:config.header?data.header:null,footer:config.footer?data.footer:null,body:data.body}));},extension:'.pdf',orientation:'portrait',pageSize:'A4',message:'',newline:'\n'});})(jQuery,jQuery.fn.dataTable);(function($,DataTable){"use strict";var _saveAs=(function(view){if(typeof navigator!=="undefined"&&/MSIE [1-9]\./.test(navigator.userAgent)){return;}
var
doc=view.document,get_URL=function(){return view.URL||view.webkitURL||view;},save_link=doc.createElementNS("http://www.w3.org/1999/xhtml","a"),can_use_save_link="download"in save_link,click=function(node){var event=doc.createEvent("MouseEvents");event.initMouseEvent("click",true,false,view,0,0,0,0,0,false,false,false,false,0,null);node.dispatchEvent(event);},webkit_req_fs=view.webkitRequestFileSystem,req_fs=view.requestFileSystem||webkit_req_fs||view.mozRequestFileSystem,throw_outside=function(ex){(view.setImmediate||view.setTimeout)(function(){throw ex;},0);},force_saveable_type="application/octet-stream",fs_min_size=0,arbitrary_revoke_timeout=500,revoke=function(file){var revoker=function(){if(typeof file==="string"){get_URL().revokeObjectURL(file);}else{file.remove();}};if(view.chrome){revoker();}else{setTimeout(revoker,arbitrary_revoke_timeout);}},dispatch=function(filesaver,event_types,event){event_types=[].concat(event_types);var i=event_types.length;while(i--){var listener=filesaver["on"+event_types[i]];if(typeof listener==="function"){try{listener.call(filesaver,event||filesaver);}catch(ex){throw_outside(ex);}}}},auto_bom=function(blob){if(/^\s*(?:text\/\S*|application\/xml|\S*\/\S*\+xml)\s*;.*charset\s*=\s*utf-8/i.test(blob.type)){return new Blob(["\ufeff",blob],{type:blob.type});}
return blob;},FileSaver=function(blob,name){blob=auto_bom(blob);var
filesaver=this,type=blob.type,blob_changed=false,object_url,target_view,dispatch_all=function(){dispatch(filesaver,"writestart progress write writeend".split(" "));},fs_error=function(){if(blob_changed||!object_url){object_url=get_URL().createObjectURL(blob);}
if(target_view){target_view.location.href=object_url;}else{var new_tab=view.open(object_url,"_blank");if(new_tab===undefined&&typeof safari!=="undefined"){view.location.href=object_url;}}
filesaver.readyState=filesaver.DONE;dispatch_all();revoke(object_url);},abortable=function(func){return function(){if(filesaver.readyState!==filesaver.DONE){return func.apply(this,arguments);}};},create_if_not_found={create:true,exclusive:false},slice;filesaver.readyState=filesaver.INIT;if(!name){name="download";}
if(can_use_save_link){object_url=get_URL().createObjectURL(blob);save_link.href=object_url;save_link.download=name;click(save_link);filesaver.readyState=filesaver.DONE;dispatch_all();revoke(object_url);return;}
if(view.chrome&&type&&type!==force_saveable_type){slice=blob.slice||blob.webkitSlice;blob=slice.call(blob,0,blob.size,force_saveable_type);blob_changed=true;}
if(webkit_req_fs&&name!=="download"){name+=".download";}
if(type===force_saveable_type||webkit_req_fs){target_view=view;}
if(!req_fs){fs_error();return;}
fs_min_size+=blob.size;req_fs(view.TEMPORARY,fs_min_size,abortable(function(fs){fs.root.getDirectory("saved",create_if_not_found,abortable(function(dir){var save=function(){dir.getFile(name,create_if_not_found,abortable(function(file){file.createWriter(abortable(function(writer){writer.onwriteend=function(event){target_view.location.href=file.toURL();filesaver.readyState=filesaver.DONE;dispatch(filesaver,"writeend",event);revoke(file);};writer.onerror=function(){var error=writer.error;if(error.code!==error.ABORT_ERR){fs_error();}};"writestart progress write abort".split(" ").forEach(function(event){writer["on"+event]=filesaver["on"+event];});writer.write(blob);filesaver.abort=function(){writer.abort();filesaver.readyState=filesaver.DONE;};filesaver.readyState=filesaver.WRITING;}),fs_error);}),fs_error);};dir.getFile(name,{create:false},abortable(function(file){file.remove();save();}),abortable(function(ex){if(ex.code===ex.NOT_FOUND_ERR){save();}else{fs_error();}}));}),fs_error);}),fs_error);},FS_proto=FileSaver.prototype,saveAs=function(blob,name){return new FileSaver(blob,name);};if(typeof navigator!=="undefined"&&navigator.msSaveOrOpenBlob){return function(blob,name){return navigator.msSaveOrOpenBlob(auto_bom(blob),name);};}
FS_proto.abort=function(){var filesaver=this;filesaver.readyState=filesaver.DONE;dispatch(filesaver,"abort");};FS_proto.readyState=FS_proto.INIT=0;FS_proto.WRITING=1;FS_proto.DONE=2;FS_proto.error=FS_proto.onwritestart=FS_proto.onprogress=FS_proto.onwrite=FS_proto.onabort=FS_proto.onerror=FS_proto.onwriteend=null;return saveAs;}(window));var _filename=function(config,incExtension)
{var title=config.title;if(title.indexOf('*')!==-1){title=title.replace('*',$('title').text());}
title=title.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g,"");return incExtension===undefined||incExtension===true?title+config.extension:title;};var _newLine=function(config)
{return config.newline?config.newline:navigator.userAgent.match(/Windows/)?'\r\n':'\n';};var _exportData=function(dt,config)
{var newLine=_newLine(config);var data=dt.buttons.exportData(config.exportOptions);var join=function(a){var s='';var boundary=config.fieldBoundary;var separator=config.fieldSeparator;for(var i=0,ien=a.length;i<ien;i++){if(i>0){s+=separator;}
s+=boundary?boundary+a[i].replace(boundary,'\\'+boundary)+boundary:a[i];}
return s;};var header=config.header?join(data.header)+newLine:'';var footer=config.footer?newLine+join(data.footer):'';var body=[];for(var i=0,ien=data.body.length;i<ien;i++){body.push(join(data.body[i]));}
return{str:header+body.join(newLine)+footer,rows:body.length};};var _isSafari=function()
{return navigator.userAgent.indexOf('Safari')!==-1&&navigator.userAgent.indexOf('Chrome')===-1&&navigator.userAgent.indexOf('Opera')===-1;};var excelStrings={"_rels/.rels":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?>\
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">\
	<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>\
</Relationships>',"xl/_rels/workbook.xml.rels":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?>\
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">\
	<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>\
</Relationships>',"[Content_Types].xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?>\
<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">\
	<Default Extension="xml" ContentType="application/xml"/>\
	<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>\
	<Default Extension="jpeg" ContentType="image/jpeg"/>\
	<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>\
	<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>\
</Types>',"xl/workbook.xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?>\
<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">\
	<fileVersion appName="xl" lastEdited="5" lowestEdited="5" rupBuild="24816"/>\
	<workbookPr showInkAnnotation="0" autoCompressPictures="0"/>\
	<bookViews>\
		<workbookView xWindow="0" yWindow="0" windowWidth="25600" windowHeight="19020" tabRatio="500"/>\
	</bookViews>\
	<sheets>\
		<sheet name="Sheet1" sheetId="1" r:id="rId1"/>\
	</sheets>\
</workbook>',"xl/worksheets/sheet1.xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?>\
<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac">\
	<sheetData>\
		__DATA__\
	</sheetData>\
</worksheet>'};DataTable.ext.buttons.copyHtml5={className:'buttons-copy buttons-html5',text:function(dt){return dt.i18n('buttons.copy','Copy');},action:function(e,dt,button,config){var newLine=_newLine(config);var output=_exportData(dt,config).str;var message=$('<span>'+dt.i18n('buttons.copyKeys','Press <i>ctrl</i> or <i>\u2318</i> + <i>C</i> to copy the table data<br>to your system clipboard.<br><br>'+'To cancel, click this message or press escape.')+'</span>').append($('<div/>').css({height:1,width:1,overflow:'hidden'}).append($('<textarea readonly/>').val(output)));dt.buttons.info(dt.i18n('buttons.copyTitle','Copy to clipboard'),message,0);message.find('textarea')[0].focus();message.find('textarea')[0].select();var container=$(message).closest('.dt-button-info');var close=function(){container.off('click.buttons-copy');$(document).off('.buttons-copy');dt.buttons.info(false);};container.on('click.buttons-copy',close);$(document).on('keydown.buttons-copy',function(e){if(e.keyCode===27){close();}}).on('copy.buttons-copy cut.buttons-copy',function(){close();});},exportOptions:{},fieldSeparator:'\t',fieldBoundary:'',header:true,footer:false};DataTable.ext.buttons.csvHtml5={className:'buttons-csv buttons-html5',available:function(){return window.FileReader!==undefined&&window.Blob;},text:function(dt){return dt.i18n('buttons.csv','CSV');},action:function(e,dt,button,config){var newLine=_newLine(config);var output=_exportData(dt,config).str;_saveAs(new Blob([output],{type:'text/csv'}),_filename(config));},title:'*',extension:'.csv',exportOptions:{},fieldSeparator:',',fieldBoundary:'"',header:true,footer:false};DataTable.ext.buttons.excelHtml5={className:'buttons-excel buttons-html5',available:function(){return window.FileReader!==undefined&&window.JSZip!==undefined&&!_isSafari();},text:function(dt){return dt.i18n('buttons.excel','Excel');},action:function(e,dt,button,config){var xml='';var data=dt.buttons.exportData(config.exportOptions);var addRow=function(row){var cells=[];for(var i=0,ien=row.length;i<ien;i++){cells.push($.isNumeric(row[i])?'<c t="n"><v>'+row[i]+'</v></c>':'<c t="inlineStr"><is><t>'+row[i].replace(/&(?!amp;)/g,'&amp;')+'</t></is></c>');}
return'<row>'+cells.join('')+'</row>';};if(config.header){xml+=addRow(data.header);}
for(var i=0,ien=data.body.length;i<ien;i++){xml+=addRow(data.body[i]);}
if(config.footer){xml+=addRow(data.footer);}
var zip=new window.JSZip();var _rels=zip.folder("_rels");var xl=zip.folder("xl");var xl_rels=zip.folder("xl/_rels");var xl_worksheets=zip.folder("xl/worksheets");zip.file('[Content_Types].xml',excelStrings['[Content_Types].xml']);_rels.file('.rels',excelStrings['_rels/.rels']);xl.file('workbook.xml',excelStrings['xl/workbook.xml']);xl_rels.file('workbook.xml.rels',excelStrings['xl/_rels/workbook.xml.rels']);xl_worksheets.file('sheet1.xml',excelStrings['xl/worksheets/sheet1.xml'].replace('__DATA__',xml));_saveAs(zip.generate({type:"blob"}),_filename(config));},title:'*',extension:'.xlsx',exportOptions:{},header:true,footer:false};DataTable.ext.buttons.pdfHtml5={className:'buttons-pdf buttons-html5',available:function(){return window.FileReader!==undefined&&window.pdfMake;},text:function(dt){return dt.i18n('buttons.pdf','PDF');},action:function(e,dt,button,config){var newLine=_newLine(config);var data=dt.buttons.exportData(config.exportOptions);var rows=[];if(config.header){rows.push($.map(data.header,function(d){return{text:d,style:'tableHeader'};}));}
for(var i=0,ien=data.body.length;i<ien;i++){rows.push($.map(data.body[i],function(d){return{text:d,style:i%2?'tableBodyEven':'tableBodyOdd'};}));}
if(config.footer){rows.push($.map(data.footer,function(d){return{text:d,style:'tableFooter'};}));}
var doc={pageSize:config.pageSize,pageOrientation:config.orientation,content:[{table:{headerRows:1,body:rows},layout:'noBorders'}],styles:{tableHeader:{bold:true,fontSize:11,color:'white',fillColor:'#2d4154',alignment:'center'},tableBodyEven:{},tableBodyOdd:{fillColor:'#f3f3f3'},tableFooter:{bold:true,fontSize:11,color:'white',fillColor:'#2d4154'},title:{alignment:'center',fontSize:15},message:{}},defaultStyle:{fontSize:10}};if(config.message){doc.content.unshift({text:config.message,style:'message',margin:[0,0,0,12]});}
if(config.title){doc.content.unshift({text:_filename(config,false),style:'title',margin:[0,0,0,12]});}
if(config.customize){config.customize(doc);}
var pdf=window.pdfMake.createPdf(doc);if(config.download==='open'&&!_isSafari()){pdf.open();}
else{pdf.getBuffer(function(buffer){var blob=new Blob([buffer],{type:'application/pdf'});_saveAs(blob,_filename(config));});}},title:'*',extension:'.pdf',exportOptions:{},orientation:'portrait',pageSize:'A4',header:true,footer:false,message:null,customize:null,download:'download'};})(jQuery,jQuery.fn.dataTable);(function($,DataTable){"use strict";var _link=document.createElement('a');var _relToAbs=function(el){var url;var clone=$(el).clone()[0];var linkHost;if(clone.nodeName.toLowerCase()==='link'){_link.href=clone.href;linkHost=_link.host;if(linkHost.indexOf('/')===-1&&_link.pathname.indexOf('/')!==0){linkHost+='/';}
clone.href=_link.protocol+"//"+linkHost+_link.pathname+_link.search;}
return clone.outerHTML;};DataTable.ext.buttons.print={className:'buttons-print',text:function(dt){return dt.i18n('buttons.print','Print');},action:function(e,dt,button,config){var data=dt.buttons.exportData(config.exportOptions);var addRow=function(d,tag){var str='<tr>';for(var i=0,ien=d.length;i<ien;i++){str+='<'+tag+'>'+d[i]+'</'+tag+'>';}
return str+'</tr>';};var html='<table class="'+dt.table().node().className+'">';if(config.header){html+='<thead>'+addRow(data.header,'th')+'</thead>';}
html+='<tbody>';for(var i=0,ien=data.body.length;i<ien;i++){html+=addRow(data.body[i],'td');}
html+='</tbody>';if(config.footer){html+='<thead>'+addRow(data.footer,'th')+'</thead>';}
var win=window.open('','');var title=config.title.replace('*',$('title').text());win.document.close();var head='<title>'+title+'</title>';$('style, link').each(function(){head+=_relToAbs(this);});$(win.document.head).html(head);$(win.document.body).html('<h1>'+title+'</h1>'+'<div>'+config.message+'</div>'+html);if(config.customize){config.customize(win);}
setTimeout(function(){if(config.autoPrint){win.print();win.close();}},250);},title:'*',message:'',exportOptions:{},header:true,footer:false,autoPrint:true,customize:null};})(jQuery,jQuery.fn.dataTable);(function(window,document,undefined){var factory=function($,DataTable){"use strict";var FixedColumns=function(dt,init){var that=this;if(!(this instanceof FixedColumns)){alert("FixedColumns warning: FixedColumns must be initialised with the 'new' keyword.");return;}
if(init===undefined||init===true){init={};}
var camelToHungarian=$.fn.dataTable.camelToHungarian;if(camelToHungarian){camelToHungarian(FixedColumns.defaults,FixedColumns.defaults,true);camelToHungarian(FixedColumns.defaults,init);}
var dtSettings=new $.fn.dataTable.Api(dt).settings()[0];this.s={"dt":dtSettings,"iTableColumns":dtSettings.aoColumns.length,"aiOuterWidths":[],"aiInnerWidths":[]};this.dom={"scroller":null,"header":null,"body":null,"footer":null,"grid":{"wrapper":null,"dt":null,"left":{"wrapper":null,"head":null,"body":null,"foot":null},"right":{"wrapper":null,"head":null,"body":null,"foot":null}},"clone":{"left":{"header":null,"body":null,"footer":null},"right":{"header":null,"body":null,"footer":null}}};if(dtSettings._oFixedColumns){throw'FixedColumns already initialised on this table';}
dtSettings._oFixedColumns=this;if(!dtSettings._bInitComplete)
{dtSettings.oApi._fnCallbackReg(dtSettings,'aoInitComplete',function(){that._fnConstruct(init);},'FixedColumns');}
else
{this._fnConstruct(init);}};FixedColumns.prototype={"fnUpdate":function()
{this._fnDraw(true);},"fnRedrawLayout":function()
{this._fnColCalc();this._fnGridLayout();this.fnUpdate();},"fnRecalculateHeight":function(nTr)
{delete nTr._DTTC_iHeight;nTr.style.height='auto';},"fnSetRowHeight":function(nTarget,iHeight)
{nTarget.style.height=iHeight+"px";},"fnGetPosition":function(node)
{var idx;var inst=this.s.dt.oInstance;if(!$(node).parents('.DTFC_Cloned').length)
{return inst.fnGetPosition(node);}
else
{if(node.nodeName.toLowerCase()==='tr'){idx=$(node).index();return inst.fnGetPosition($('tr',this.s.dt.nTBody)[idx]);}
else
{var colIdx=$(node).index();idx=$(node.parentNode).index();var row=inst.fnGetPosition($('tr',this.s.dt.nTBody)[idx]);return[row,colIdx,inst.oApi._fnVisibleToColumnIndex(this.s.dt,colIdx)];}}},"_fnConstruct":function(oInit)
{var i,iLen,iWidth,that=this;if(typeof this.s.dt.oInstance.fnVersionCheck!='function'||this.s.dt.oInstance.fnVersionCheck('1.8.0')!==true)
{alert("FixedColumns "+FixedColumns.VERSION+" required DataTables 1.8.0 or later. "+"Please upgrade your DataTables installation");return;}
if(this.s.dt.oScroll.sX==="")
{this.s.dt.oInstance.oApi._fnLog(this.s.dt,1,"FixedColumns is not needed (no "+"x-scrolling in DataTables enabled), so no action will be taken. Use 'FixedHeader' for "+"column fixing when scrolling is not enabled");return;}
this.s=$.extend(true,this.s,FixedColumns.defaults,oInit);var classes=this.s.dt.oClasses;this.dom.grid.dt=$(this.s.dt.nTable).parents('div.'+classes.sScrollWrapper)[0];this.dom.scroller=$('div.'+classes.sScrollBody,this.dom.grid.dt)[0];this._fnColCalc();this._fnGridSetup();var mouseController;$(this.dom.scroller).on('mouseover.DTFC touchstart.DTFC',function(){mouseController='main';}).on('scroll.DTFC',function(e){if(!mouseController&&e.originalEvent){mouseController='main';}
if(mouseController==='main'){if(that.s.iLeftColumns>0){that.dom.grid.left.liner.scrollTop=that.dom.scroller.scrollTop;}
if(that.s.iRightColumns>0){that.dom.grid.right.liner.scrollTop=that.dom.scroller.scrollTop;}}});var wheelType='onwheel'in document.createElement('div')?'wheel.DTFC':'mousewheel.DTFC';if(that.s.iLeftColumns>0){$(that.dom.grid.left.liner).on('mouseover.DTFC touchstart.DTFC',function(){mouseController='left';}).on('scroll.DTFC',function(e){if(!mouseController&&e.originalEvent){mouseController='left';}
if(mouseController==='left'){that.dom.scroller.scrollTop=that.dom.grid.left.liner.scrollTop;if(that.s.iRightColumns>0){that.dom.grid.right.liner.scrollTop=that.dom.grid.left.liner.scrollTop;}}}).on(wheelType,function(e){var xDelta=e.type==='wheel'?-e.originalEvent.deltaX:e.originalEvent.wheelDeltaX;that.dom.scroller.scrollLeft-=xDelta;});}
if(that.s.iRightColumns>0){$(that.dom.grid.right.liner).on('mouseover.DTFC touchstart.DTFC',function(){mouseController='right';}).on('scroll.DTFC',function(e){if(!mouseController&&e.originalEvent){mouseController='right';}
if(mouseController==='right'){that.dom.scroller.scrollTop=that.dom.grid.right.liner.scrollTop;if(that.s.iLeftColumns>0){that.dom.grid.left.liner.scrollTop=that.dom.grid.right.liner.scrollTop;}}}).on(wheelType,function(e){var xDelta=e.type==='wheel'?-e.originalEvent.deltaX:e.originalEvent.wheelDeltaX;that.dom.scroller.scrollLeft-=xDelta;});}
$(window).on('resize.DTFC',function(){that._fnGridLayout.call(that);});var bFirstDraw=true;var jqTable=$(this.s.dt.nTable);jqTable.on('draw.dt.DTFC',function(){that._fnDraw.call(that,bFirstDraw);bFirstDraw=false;}).on('column-sizing.dt.DTFC',function(){that._fnColCalc();that._fnGridLayout(that);}).on('column-visibility.dt.DTFC',function(){that._fnColCalc();that._fnGridLayout(that);that._fnDraw(true);}).on('destroy.dt.DTFC',function(){jqTable.off('column-sizing.dt.DTFC column-visibility.dt.DTFC destroy.dt.DTFC draw.dt.DTFC');$(that.dom.scroller).off('mouseover.DTFC touchstart.DTFC scroll.DTFC');$(window).off('resize.DTFC');$(that.dom.grid.left.liner).off('mouseover.DTFC touchstart.DTFC scroll.DTFC '+wheelType);$(that.dom.grid.left.wrapper).remove();$(that.dom.grid.right.liner).off('mouseover.DTFC touchstart.DTFC scroll.DTFC '+wheelType);$(that.dom.grid.right.wrapper).remove();});this._fnGridLayout();this.s.dt.oInstance.fnDraw(false);},"_fnColCalc":function()
{var that=this;var iLeftWidth=0;var iRightWidth=0;this.s.aiInnerWidths=[];this.s.aiOuterWidths=[];$.each(this.s.dt.aoColumns,function(i,col){var th=$(col.nTh);var border;if(!th.filter(':visible').length){that.s.aiInnerWidths.push(0);that.s.aiOuterWidths.push(0);}
else
{var iWidth=th.outerWidth();if(that.s.aiOuterWidths.length===0){border=$(that.s.dt.nTable).css('border-left-width');iWidth+=typeof border==='string'?1:parseInt(border,10);}
if(that.s.aiOuterWidths.length===that.s.dt.aoColumns.length-1){border=$(that.s.dt.nTable).css('border-right-width');iWidth+=typeof border==='string'?1:parseInt(border,10);}
that.s.aiOuterWidths.push(iWidth);that.s.aiInnerWidths.push(th.width());if(i<that.s.iLeftColumns)
{iLeftWidth+=iWidth;}
if(that.s.iTableColumns-that.s.iRightColumns<=i)
{iRightWidth+=iWidth;}}});this.s.iLeftWidth=iLeftWidth;this.s.iRightWidth=iRightWidth;},"_fnGridSetup":function()
{var that=this;var oOverflow=this._fnDTOverflow();var block;this.dom.body=this.s.dt.nTable;this.dom.header=this.s.dt.nTHead.parentNode;this.dom.header.parentNode.parentNode.style.position="relative";var nSWrapper=$('<div class="DTFC_ScrollWrapper" style="position:relative; clear:both;">'+'<div class="DTFC_LeftWrapper" style="position:absolute; top:0; left:0;">'+'<div class="DTFC_LeftHeadWrapper" style="position:relative; top:0; left:0; overflow:hidden;"></div>'+'<div class="DTFC_LeftBodyWrapper" style="position:relative; top:0; left:0; overflow:hidden;">'+'<div class="DTFC_LeftBodyLiner" style="position:relative; top:0; left:0; overflow-y:scroll;"></div>'+'</div>'+'<div class="DTFC_LeftFootWrapper" style="position:relative; top:0; left:0; overflow:hidden;"></div>'+'</div>'+'<div class="DTFC_RightWrapper" style="position:absolute; top:0; left:0;">'+'<div class="DTFC_RightHeadWrapper" style="position:relative; top:0; left:0;">'+'<div class="DTFC_RightHeadBlocker DTFC_Blocker" style="position:absolute; top:0; bottom:0;"></div>'+'</div>'+'<div class="DTFC_RightBodyWrapper" style="position:relative; top:0; left:0; overflow:hidden;">'+'<div class="DTFC_RightBodyLiner" style="position:relative; top:0; left:0; overflow-y:scroll;"></div>'+'</div>'+'<div class="DTFC_RightFootWrapper" style="position:relative; top:0; left:0;">'+'<div class="DTFC_RightFootBlocker DTFC_Blocker" style="position:absolute; top:0; bottom:0;"></div>'+'</div>'+'</div>'+'</div>')[0];var nLeft=nSWrapper.childNodes[0];var nRight=nSWrapper.childNodes[1];this.dom.grid.dt.parentNode.insertBefore(nSWrapper,this.dom.grid.dt);nSWrapper.appendChild(this.dom.grid.dt);this.dom.grid.wrapper=nSWrapper;if(this.s.iLeftColumns>0)
{this.dom.grid.left.wrapper=nLeft;this.dom.grid.left.head=nLeft.childNodes[0];this.dom.grid.left.body=nLeft.childNodes[1];this.dom.grid.left.liner=$('div.DTFC_LeftBodyLiner',nSWrapper)[0];nSWrapper.appendChild(nLeft);}
if(this.s.iRightColumns>0)
{this.dom.grid.right.wrapper=nRight;this.dom.grid.right.head=nRight.childNodes[0];this.dom.grid.right.body=nRight.childNodes[1];this.dom.grid.right.liner=$('div.DTFC_RightBodyLiner',nSWrapper)[0];block=$('div.DTFC_RightHeadBlocker',nSWrapper)[0];block.style.width=oOverflow.bar+"px";block.style.right=-oOverflow.bar+"px";this.dom.grid.right.headBlock=block;block=$('div.DTFC_RightFootBlocker',nSWrapper)[0];block.style.width=oOverflow.bar+"px";block.style.right=-oOverflow.bar+"px";this.dom.grid.right.footBlock=block;nSWrapper.appendChild(nRight);}
if(this.s.dt.nTFoot)
{this.dom.footer=this.s.dt.nTFoot.parentNode;if(this.s.iLeftColumns>0)
{this.dom.grid.left.foot=nLeft.childNodes[2];}
if(this.s.iRightColumns>0)
{this.dom.grid.right.foot=nRight.childNodes[2];}}},"_fnGridLayout":function()
{var oGrid=this.dom.grid;var iWidth=$(oGrid.wrapper).width();var iBodyHeight=$(this.s.dt.nTable.parentNode).outerHeight();var iFullHeight=$(this.s.dt.nTable.parentNode.parentNode).outerHeight();var oOverflow=this._fnDTOverflow();var
iLeftWidth=this.s.iLeftWidth,iRightWidth=this.s.iRightWidth,iRight;var scrollbarAdjust=function(node,width){if(!oOverflow.bar){node.style.width=(width+20)+"px";node.style.paddingRight="20px";node.style.boxSizing="border-box";}
else{node.style.width=(width+oOverflow.bar)+"px";}};if(oOverflow.x)
{iBodyHeight-=oOverflow.bar;}
oGrid.wrapper.style.height=iFullHeight+"px";if(this.s.iLeftColumns>0)
{oGrid.left.wrapper.style.width=iLeftWidth+"px";oGrid.left.wrapper.style.height="1px";oGrid.left.body.style.height=iBodyHeight+"px";if(oGrid.left.foot){oGrid.left.foot.style.top=(oOverflow.x?oOverflow.bar:0)+"px";}
scrollbarAdjust(oGrid.left.liner,iLeftWidth);oGrid.left.liner.style.height=iBodyHeight+"px";}
if(this.s.iRightColumns>0)
{iRight=iWidth-iRightWidth;if(oOverflow.y)
{iRight-=oOverflow.bar;}
oGrid.right.wrapper.style.width=iRightWidth+"px";oGrid.right.wrapper.style.left=iRight+"px";oGrid.right.wrapper.style.height="1px";oGrid.right.body.style.height=iBodyHeight+"px";if(oGrid.right.foot){oGrid.right.foot.style.top=(oOverflow.x?oOverflow.bar:0)+"px";}
scrollbarAdjust(oGrid.right.liner,iRightWidth);oGrid.right.liner.style.height=iBodyHeight+"px";oGrid.right.headBlock.style.display=oOverflow.y?'block':'none';oGrid.right.footBlock.style.display=oOverflow.y?'block':'none';}},"_fnDTOverflow":function()
{var nTable=this.s.dt.nTable;var nTableScrollBody=nTable.parentNode;var out={"x":false,"y":false,"bar":this.s.dt.oScroll.iBarWidth};if(nTable.offsetWidth>nTableScrollBody.clientWidth)
{out.x=true;}
if(nTable.offsetHeight>nTableScrollBody.clientHeight)
{out.y=true;}
return out;},"_fnDraw":function(bAll)
{this._fnGridLayout();this._fnCloneLeft(bAll);this._fnCloneRight(bAll);if(this.s.fnDrawCallback!==null)
{this.s.fnDrawCallback.call(this,this.dom.clone.left,this.dom.clone.right);}
$(this).trigger('draw.dtfc',{"leftClone":this.dom.clone.left,"rightClone":this.dom.clone.right});},"_fnCloneRight":function(bAll)
{if(this.s.iRightColumns<=0){return;}
var that=this,i,jq,aiColumns=[];for(i=this.s.iTableColumns-this.s.iRightColumns;i<this.s.iTableColumns;i++){if(this.s.dt.aoColumns[i].bVisible){aiColumns.push(i);}}
this._fnClone(this.dom.clone.right,this.dom.grid.right,aiColumns,bAll);},"_fnCloneLeft":function(bAll)
{if(this.s.iLeftColumns<=0){return;}
var that=this,i,jq,aiColumns=[];for(i=0;i<this.s.iLeftColumns;i++){if(this.s.dt.aoColumns[i].bVisible){aiColumns.push(i);}}
this._fnClone(this.dom.clone.left,this.dom.grid.left,aiColumns,bAll);},"_fnCopyLayout":function(aoOriginal,aiColumns,events)
{var aReturn=[];var aClones=[];var aCloned=[];for(var i=0,iLen=aoOriginal.length;i<iLen;i++)
{var aRow=[];aRow.nTr=$(aoOriginal[i].nTr).clone(events,false)[0];for(var j=0,jLen=this.s.iTableColumns;j<jLen;j++)
{if($.inArray(j,aiColumns)===-1)
{continue;}
var iCloned=$.inArray(aoOriginal[i][j].cell,aCloned);if(iCloned===-1)
{var nClone=$(aoOriginal[i][j].cell).clone(events,false)[0];aClones.push(nClone);aCloned.push(aoOriginal[i][j].cell);aRow.push({"cell":nClone,"unique":aoOriginal[i][j].unique});}
else
{aRow.push({"cell":aClones[iCloned],"unique":aoOriginal[i][j].unique});}}
aReturn.push(aRow);}
return aReturn;},"_fnClone":function(oClone,oGrid,aiColumns,bAll)
{var that=this,i,iLen,j,jLen,jq,nTarget,iColumn,nClone,iIndex,aoCloneLayout,jqCloneThead,aoFixedHeader,dt=this.s.dt;if(bAll)
{$(oClone.header).remove();oClone.header=$(this.dom.header).clone(true,false)[0];oClone.header.className+=" DTFC_Cloned";oClone.header.style.width="100%";oGrid.head.appendChild(oClone.header);aoCloneLayout=this._fnCopyLayout(dt.aoHeader,aiColumns,true);jqCloneThead=$('>thead',oClone.header);jqCloneThead.empty();for(i=0,iLen=aoCloneLayout.length;i<iLen;i++)
{jqCloneThead[0].appendChild(aoCloneLayout[i].nTr);}
dt.oApi._fnDrawHead(dt,aoCloneLayout,true);}
else
{aoCloneLayout=this._fnCopyLayout(dt.aoHeader,aiColumns,false);aoFixedHeader=[];dt.oApi._fnDetectHeader(aoFixedHeader,$('>thead',oClone.header)[0]);for(i=0,iLen=aoCloneLayout.length;i<iLen;i++)
{for(j=0,jLen=aoCloneLayout[i].length;j<jLen;j++)
{aoFixedHeader[i][j].cell.className=aoCloneLayout[i][j].cell.className;$('span.DataTables_sort_icon',aoFixedHeader[i][j].cell).each(function(){this.className=$('span.DataTables_sort_icon',aoCloneLayout[i][j].cell)[0].className;});}}}
this._fnEqualiseHeights('thead',this.dom.header,oClone.header);if(this.s.sHeightMatch=='auto')
{$('>tbody>tr',that.dom.body).css('height','auto');}
if(oClone.body!==null)
{$(oClone.body).remove();oClone.body=null;}
oClone.body=$(this.dom.body).clone(true)[0];oClone.body.className+=" DTFC_Cloned";oClone.body.style.paddingBottom=dt.oScroll.iBarWidth+"px";oClone.body.style.marginBottom=(dt.oScroll.iBarWidth*2)+"px";if(oClone.body.getAttribute('id')!==null)
{oClone.body.removeAttribute('id');}
$('>thead>tr',oClone.body).empty();$('>tfoot',oClone.body).remove();var nBody=$('tbody',oClone.body)[0];$(nBody).empty();if(dt.aiDisplay.length>0)
{var nInnerThead=$('>thead>tr',oClone.body)[0];for(iIndex=0;iIndex<aiColumns.length;iIndex++)
{iColumn=aiColumns[iIndex];nClone=$(dt.aoColumns[iColumn].nTh).clone(true)[0];nClone.innerHTML="";var oStyle=nClone.style;oStyle.paddingTop="0";oStyle.paddingBottom="0";oStyle.borderTopWidth="0";oStyle.borderBottomWidth="0";oStyle.height=0;oStyle.width=that.s.aiInnerWidths[iColumn]+"px";nInnerThead.appendChild(nClone);}
$('>tbody>tr',that.dom.body).each(function(z){var n=this.cloneNode(false);n.removeAttribute('id');var i=that.s.dt.oFeatures.bServerSide===false?that.s.dt.aiDisplay[that.s.dt._iDisplayStart+z]:z;var aTds=that.s.dt.aoData[i].anCells||$(this).children('td, th');for(iIndex=0;iIndex<aiColumns.length;iIndex++)
{iColumn=aiColumns[iIndex];if(aTds.length>0)
{nClone=$(aTds[iColumn]).clone(true,true)[0];n.appendChild(nClone);}}
nBody.appendChild(n);});}
else
{$('>tbody>tr',that.dom.body).each(function(z){nClone=this.cloneNode(true);nClone.className+=' DTFC_NoData';$('td',nClone).html('');nBody.appendChild(nClone);});}
oClone.body.style.width="100%";oClone.body.style.margin="0";oClone.body.style.padding="0";if(dt.oScroller!==undefined)
{var scrollerForcer=dt.oScroller.dom.force;if(!oGrid.forcer){oGrid.forcer=scrollerForcer.cloneNode(true);oGrid.liner.appendChild(oGrid.forcer);}
else{oGrid.forcer.style.height=scrollerForcer.style.height;}}
oGrid.liner.appendChild(oClone.body);this._fnEqualiseHeights('tbody',that.dom.body,oClone.body);if(dt.nTFoot!==null)
{if(bAll)
{if(oClone.footer!==null)
{oClone.footer.parentNode.removeChild(oClone.footer);}
oClone.footer=$(this.dom.footer).clone(true,true)[0];oClone.footer.className+=" DTFC_Cloned";oClone.footer.style.width="100%";oGrid.foot.appendChild(oClone.footer);aoCloneLayout=this._fnCopyLayout(dt.aoFooter,aiColumns,true);var jqCloneTfoot=$('>tfoot',oClone.footer);jqCloneTfoot.empty();for(i=0,iLen=aoCloneLayout.length;i<iLen;i++)
{jqCloneTfoot[0].appendChild(aoCloneLayout[i].nTr);}
dt.oApi._fnDrawHead(dt,aoCloneLayout,true);}
else
{aoCloneLayout=this._fnCopyLayout(dt.aoFooter,aiColumns,false);var aoCurrFooter=[];dt.oApi._fnDetectHeader(aoCurrFooter,$('>tfoot',oClone.footer)[0]);for(i=0,iLen=aoCloneLayout.length;i<iLen;i++)
{for(j=0,jLen=aoCloneLayout[i].length;j<jLen;j++)
{aoCurrFooter[i][j].cell.className=aoCloneLayout[i][j].cell.className;}}}
this._fnEqualiseHeights('tfoot',this.dom.footer,oClone.footer);}
var anUnique=dt.oApi._fnGetUniqueThs(dt,$('>thead',oClone.header)[0]);$(anUnique).each(function(i){iColumn=aiColumns[i];this.style.width=that.s.aiInnerWidths[iColumn]+"px";});if(that.s.dt.nTFoot!==null)
{anUnique=dt.oApi._fnGetUniqueThs(dt,$('>tfoot',oClone.footer)[0]);$(anUnique).each(function(i){iColumn=aiColumns[i];this.style.width=that.s.aiInnerWidths[iColumn]+"px";});}},"_fnGetTrNodes":function(nIn)
{var aOut=[];for(var i=0,iLen=nIn.childNodes.length;i<iLen;i++)
{if(nIn.childNodes[i].nodeName.toUpperCase()=="TR")
{aOut.push(nIn.childNodes[i]);}}
return aOut;},"_fnEqualiseHeights":function(nodeName,original,clone)
{if(this.s.sHeightMatch=='none'&&nodeName!=='thead'&&nodeName!=='tfoot')
{return;}
var that=this,i,iLen,iHeight,iHeight2,iHeightOriginal,iHeightClone,rootOriginal=original.getElementsByTagName(nodeName)[0],rootClone=clone.getElementsByTagName(nodeName)[0],jqBoxHack=$('>'+nodeName+'>tr:eq(0)',original).children(':first'),iBoxHack=jqBoxHack.outerHeight()-jqBoxHack.height(),anOriginal=this._fnGetTrNodes(rootOriginal),anClone=this._fnGetTrNodes(rootClone),heights=[];for(i=0,iLen=anClone.length;i<iLen;i++)
{iHeightOriginal=anOriginal[i].offsetHeight;iHeightClone=anClone[i].offsetHeight;iHeight=iHeightClone>iHeightOriginal?iHeightClone:iHeightOriginal;if(this.s.sHeightMatch=='semiauto')
{anOriginal[i]._DTTC_iHeight=iHeight;}
heights.push(iHeight);}
for(i=0,iLen=anClone.length;i<iLen;i++)
{anClone[i].style.height=heights[i]+"px";anOriginal[i].style.height=heights[i]+"px";}}};FixedColumns.defaults={"iLeftColumns":1,"iRightColumns":0,"fnDrawCallback":null,"sHeightMatch":"semiauto"};FixedColumns.version="3.1.0";DataTable.Api.register('fixedColumns()',function(){return this;});DataTable.Api.register('fixedColumns().update()',function(){return this.iterator('table',function(ctx){if(ctx._oFixedColumns){ctx._oFixedColumns.fnUpdate();}});});DataTable.Api.register('fixedColumns().relayout()',function(){return this.iterator('table',function(ctx){if(ctx._oFixedColumns){ctx._oFixedColumns.fnRedrawLayout();}});});DataTable.Api.register('rows().recalcHeight()',function(){return this.iterator('row',function(ctx,idx){if(ctx._oFixedColumns){ctx._oFixedColumns.fnRecalculateHeight(this.row(idx).node());}});});DataTable.Api.register('fixedColumns().rowIndex()',function(row){row=$(row);return row.parents('.DTFC_Cloned').length?this.rows({page:'current'}).indexes()[row.index()]:this.row(row).index();});DataTable.Api.register('fixedColumns().cellIndex()',function(cell){cell=$(cell);if(cell.parents('.DTFC_Cloned').length){var rowClonedIdx=cell.parent().index();var rowIdx=this.rows({page:'current'}).indexes()[rowClonedIdx];var columnIdx;if(cell.parents('.DTFC_LeftWrapper').length){columnIdx=cell.index();}
else{var columns=this.columns().flatten().length;columnIdx=columns-this.context[0]._oFixedColumns.s.iRightColumns+cell.index();}
return{row:rowIdx,column:this.column.index('toData',columnIdx),columnVisible:columnIdx};}
else{return this.cell(cell).index();}});$(document).on('init.dt.fixedColumns',function(e,settings){if(e.namespace!=='dt'){return;}
var init=settings.oInit.fixedColumns;var defaults=DataTable.defaults.fixedColumns;if(init||defaults){var opts=$.extend({},init,defaults);if(init!==false){new FixedColumns(settings,opts);}}});$.fn.dataTable.FixedColumns=FixedColumns;$.fn.DataTable.FixedColumns=FixedColumns;return FixedColumns;};if(typeof define==='function'&&define.amd){define(['jquery','datatables'],factory);}
else if(typeof exports==='object'){factory(require('jquery'),require('datatables'));}
else if(jQuery&&!jQuery.fn.dataTable.FixedColumns){factory(jQuery,jQuery.fn.dataTable);}})(window,document);(function(window,document,undefined){var factory=function($,DataTable){"use strict";var _instCounter=0;var FixedHeader=function(dt,config){if(!(this instanceof FixedHeader)){throw"FixedHeader must be initialised with the 'new' keyword.";}
if(config===true){config={};}
dt=new DataTable.Api(dt);this.c=$.extend(true,{},FixedHeader.defaults,config);this.s={dt:dt,position:{theadTop:0,tbodyTop:0,tfootTop:0,tfootBottom:0,width:0,left:0,tfootHeight:0,theadHeight:0,windowHeight:$(window).height(),visible:true},headerMode:null,footerMode:null,namespace:'.dtfc'+(_instCounter++)};this.dom={floatingHeader:null,thead:$(dt.table().header()),tbody:$(dt.table().body()),tfoot:$(dt.table().footer()),header:{host:null,floating:null,placeholder:null},footer:{host:null,floating:null,placeholder:null}};this.dom.header.host=this.dom.thead.parent();this.dom.footer.host=this.dom.tfoot.parent();var dtSettings=dt.settings()[0];if(dtSettings._fixedHeader){throw"FixedHeader already initialised on table "+dtSettings.nTable.id;}
dtSettings._fixedHeader=this;this._constructor();};FixedHeader.prototype={update:function(){this._positions();this._scroll(true);},_constructor:function()
{var that=this;var dt=this.s.dt;$(window).on('scroll'+this.s.namespace,function(){that._scroll();}).on('resize'+this.s.namespace,function(){that.s.position.windowHeight=$(window).height();that._positions();that._scroll(true);});dt.on('column-reorder.dt.dtfc column-visibility.dt.dtfc',function(){that._positions();that._scroll(true);}).on('draw.dtfc',function(){that._positions();that._scroll();});dt.on('destroy.dtfc',function(){dt.off('.dtfc');$(window).off(this.s.namespace);});this._positions();this._scroll();},_clone:function(item,force)
{var dt=this.s.dt;var itemDom=this.dom[item];var itemElement=item==='header'?this.dom.thead:this.dom.tfoot;if(!force&&itemDom.floating){itemDom.floating.removeClass('fixedHeader-floating fixedHeader-locked');}
else{if(itemDom.floating){itemDom.placeholder.remove();itemDom.floating.children().detach();itemDom.floating.remove();}
itemDom.floating=$(dt.table().node().cloneNode(false)).removeAttr('id').append(itemElement).appendTo('body');itemDom.placeholder=itemElement.clone(false);itemDom.host.append(itemDom.placeholder);if(item==='footer'){this._footerMatch(itemDom.placeholder,itemDom.floating);}}},_footerMatch:function(from,to){var type=function(name){var toWidths=$(name,from).map(function(){return $(this).width();}).toArray();$(name,to).each(function(i){$(this).width(toWidths[i]);});};type('th');type('td');},_footerUnsize:function(){var footer=this.dom.footer.floating;if(footer){$('th, td',footer).css('width','');}},_modeChange:function(mode,item,forceChange)
{var dt=this.s.dt;var itemDom=this.dom[item];var position=this.s.position;if(mode==='in-place'){if(itemDom.placeholder){itemDom.placeholder.remove();itemDom.placeholder=null;}
itemDom.host.append(item==='header'?this.dom.thead:this.dom.tfoot);if(itemDom.floating){itemDom.floating.remove();itemDom.floating=null;}
if(item==='footer'){this._footerUnsize();}}
else if(mode==='in'){this._clone(item,forceChange);itemDom.floating.addClass('fixedHeader-floating').css(item==='header'?'top':'bottom',this.c[item+'Offset']).css('left',position.left+'px').css('width',position.width+'px');if(item==='footer'){itemDom.floating.css('top','');}}
else if(mode==='below'){this._clone(item,forceChange);itemDom.floating.addClass('fixedHeader-locked').css('top',position.tfootTop-position.theadHeight).css('left',position.left+'px').css('width',position.width+'px');}
else if(mode==='above'){this._clone(item,forceChange);itemDom.floating.addClass('fixedHeader-locked').css('top',position.tbodyTop).css('left',position.left+'px').css('width',position.width+'px');}
this.s[item+'Mode']=mode;},_positions:function()
{var dt=this.s.dt;var table=dt.table();var position=this.s.position;var dom=this.dom;var tableNode=$(table.node());var thead=tableNode.children('thead');var tfoot=tableNode.children('tfoot');var tbody=dom.tbody;position.visible=tableNode.is(':visible');position.width=tableNode.outerWidth();position.left=tableNode.offset().left;position.theadTop=thead.offset().top;position.tbodyTop=tbody.offset().top;position.theadHeight=position.tbodyTop-position.theadTop;if(tfoot.length){position.tfootTop=tfoot.offset().top;position.tfootBottom=position.tfootTop+tfoot.outerHeight();position.tfootHeight=position.tfootBottom-position.tfootTop;}
else{position.tfootTop=position.tbodyTop+tbody.outerHeight();position.tfootBottom=position.tfootTop;position.tfootHeight=position.tfootTop;}},_scroll:function(forceChange)
{var windowTop=$(document).scrollTop();var position=this.s.position;var headerMode,footerMode;if(this.c.header){if(!position.visible||windowTop<=position.theadTop-this.c.headerOffset){headerMode='in-place';}
else if(windowTop<=position.tfootTop-position.theadHeight-this.c.headerOffset){headerMode='in';}
else{headerMode='below';}
if(forceChange||headerMode!==this.s.headerMode){this._modeChange(headerMode,'header',forceChange);}}
if(this.c.footer&&this.dom.tfoot.length){if(!position.visible||windowTop+position.windowHeight>=position.tfootBottom+this.c.footerOffset){footerMode='in-place';}
else if(position.windowHeight+windowTop>position.tbodyTop+position.tfootHeight+this.c.footerOffset){footerMode='in';}
else{footerMode='above';}
if(forceChange||footerMode!==this.s.footerMode){this._modeChange(footerMode,'footer',forceChange);}}}};FixedHeader.version="3.0.0";FixedHeader.defaults={header:true,footer:false,headerOffset:0,footerOffset:0};$.fn.dataTable.FixedHeader=FixedHeader;$.fn.DataTable.FixedHeader=FixedHeader;$(document).on('init.dt.dtb',function(e,settings,json){if(e.namespace!=='dt'){return;}
var opts=settings.oInit.fixedHeader||DataTable.defaults.fixedHeader;if(opts&&!settings._buttons){new FixedHeader(settings,opts);}});DataTable.Api.register('fixedHeader()',function(){});DataTable.Api.register('fixedHeader.adjust()',function(){return this.iterator('table',function(ctx){var fh=ctx._fixedHeader;if(fh){fh.update();}});});return FixedHeader;};if(typeof define==='function'&&define.amd){define(['jquery','datatables'],factory);}
else if(typeof exports==='object'){factory(require('jquery'),require('datatables'));}
else if(jQuery&&!jQuery.fn.dataTable.FixedHeader){factory(jQuery,jQuery.fn.dataTable);}})(window,document);(function(window,document,undefined){var factory=function($,DataTable){"use strict";var Responsive=function(settings,opts){if(!DataTable.versionCheck||!DataTable.versionCheck('1.10.1')){throw'DataTables Responsive requires DataTables 1.10.1 or newer';}
this.s={dt:new DataTable.Api(settings),columns:[]};if(this.s.dt.settings()[0].responsive){return;}
if(opts&&typeof opts.details==='string'){opts.details={type:opts.details};}
this.c=$.extend(true,{},Responsive.defaults,DataTable.defaults.responsive,opts);settings.responsive=this;this._constructor();};Responsive.prototype={_constructor:function()
{var that=this;var dt=this.s.dt;dt.settings()[0]._responsive=this;$(window).on('resize.dtr orientationchange.dtr',dt.settings()[0].oApi._fnThrottle(function(){that._resize();}));dt.on('destroy.dtr',function(){$(window).off('resize.dtr orientationchange.dtr draw.dtr');});this.c.breakpoints.sort(function(a,b){return a.width<b.width?1:a.width>b.width?-1:0;});this._classLogic();this._resizeAuto();var details=this.c.details;if(details.type){that._detailsInit();this._detailsVis();dt.on('column-visibility.dtr',function(){that._detailsVis();});dt.on('draw.dtr',function(){dt.rows({page:'current'}).iterator('row',function(settings,idx){var row=dt.row(idx);if(row.child.isShown()){var info=that.c.details.renderer(dt,idx);row.child(info,'child').show();}});});$(dt.table().node()).addClass('dtr-'+details.type);}
this._resize();},_columnsVisiblity:function(breakpoint)
{var dt=this.s.dt;var columns=this.s.columns;var i,ien;var display=$.map(columns,function(col){return col.auto&&col.minWidth===null?false:col.auto===true?'-':$.inArray(breakpoint,col.includeIn)!==-1;});var requiredWidth=0;for(i=0,ien=display.length;i<ien;i++){if(display[i]===true){requiredWidth+=columns[i].minWidth;}}
var scrolling=dt.settings()[0].oScroll;var bar=scrolling.sY||scrolling.sX?scrolling.iBarWidth:0;var widthAvailable=dt.table().container().offsetWidth-bar;var usedWidth=widthAvailable-requiredWidth;for(i=0,ien=display.length;i<ien;i++){if(columns[i].control){usedWidth-=columns[i].minWidth;}}
var empty=false;for(i=0,ien=display.length;i<ien;i++){if(display[i]==='-'&&!columns[i].control){if(empty||usedWidth-columns[i].minWidth<0){empty=true;display[i]=false;}
else{display[i]=true;}
usedWidth-=columns[i].minWidth;}}
var showControl=false;for(i=0,ien=columns.length;i<ien;i++){if(!columns[i].control&&!columns[i].never&&!display[i]){showControl=true;break;}}
for(i=0,ien=columns.length;i<ien;i++){if(columns[i].control){display[i]=showControl;}}
if($.inArray(true,display)===-1){display[0]=true;}
return display;},_classLogic:function()
{var that=this;var calc={};var breakpoints=this.c.breakpoints;var columns=this.s.dt.columns().eq(0).map(function(i){var className=this.column(i).header().className;return{className:className,includeIn:[],auto:false,control:false,never:className.match(/\bnever\b/)?true:false};});var add=function(colIdx,name){var includeIn=columns[colIdx].includeIn;if($.inArray(name,includeIn)===-1){includeIn.push(name);}};var column=function(colIdx,name,operator,matched){var size,i,ien;if(!operator){columns[colIdx].includeIn.push(name);}
else if(operator==='max-'){size=that._find(name).width;for(i=0,ien=breakpoints.length;i<ien;i++){if(breakpoints[i].width<=size){add(colIdx,breakpoints[i].name);}}}
else if(operator==='min-'){size=that._find(name).width;for(i=0,ien=breakpoints.length;i<ien;i++){if(breakpoints[i].width>=size){add(colIdx,breakpoints[i].name);}}}
else if(operator==='not-'){for(i=0,ien=breakpoints.length;i<ien;i++){if(breakpoints[i].name.indexOf(matched)===-1){add(colIdx,breakpoints[i].name);}}}};columns.each(function(col,i){var classNames=col.className.split(' ');var hasClass=false;for(var k=0,ken=classNames.length;k<ken;k++){var className=$.trim(classNames[k]);if(className==='all'){hasClass=true;col.includeIn=$.map(breakpoints,function(a){return a.name;});return;}
else if(className==='none'||className==='never'){hasClass=true;return;}
else if(className==='control'){hasClass=true;col.control=true;return;}
$.each(breakpoints,function(j,breakpoint){var brokenPoint=breakpoint.name.split('-');var re=new RegExp('(min\\-|max\\-|not\\-)?('+brokenPoint[0]+')(\\-[_a-zA-Z0-9])?');var match=className.match(re);if(match){hasClass=true;if(match[2]===brokenPoint[0]&&match[3]==='-'+brokenPoint[1]){column(i,breakpoint.name,match[1],match[2]+match[3]);}
else if(match[2]===brokenPoint[0]&&!match[3]){column(i,breakpoint.name,match[1],match[2]);}}});}
if(!hasClass){col.auto=true;}});this.s.columns=columns;},_detailsInit:function()
{var that=this;var dt=this.s.dt;var details=this.c.details;if(details.type==='inline'){details.target='td:first-child';}
var target=details.target;var selector=typeof target==='string'?target:'td';$(dt.table().body()).on('click',selector,function(e){if(!$(dt.table().node()).hasClass('collapsed')){return;}
if(!dt.row($(this).closest('tr')).length){return;}
if(typeof target==='number'){var targetIdx=target<0?dt.columns().eq(0).length+target:target;if(dt.cell(this).index().column!==targetIdx){return;}}
var row=dt.row($(this).closest('tr'));if(row.child.isShown()){row.child(false);$(row.node()).removeClass('parent');}
else{var info=that.c.details.renderer(dt,row[0]);row.child(info,'child').show();$(row.node()).addClass('parent');}});},_detailsVis:function()
{var that=this;var dt=this.s.dt;var hiddenColumns=dt.columns().indexes().filter(function(idx){var col=dt.column(idx);if(col.visible()){return null;}
return $(col.header()).hasClass('never')?null:idx;});var haveHidden=true;if(hiddenColumns.length===0||(hiddenColumns.length===1&&this.s.columns[hiddenColumns[0]].control)){haveHidden=false;}
if(haveHidden){dt.rows({page:'current'}).eq(0).each(function(idx){var row=dt.row(idx);if(row.child()){var info=that.c.details.renderer(dt,row[0]);if(info===false){row.child.hide();}
else{row.child(info,'child').show();}}});}
else{dt.rows({page:'current'}).eq(0).each(function(idx){dt.row(idx).child.hide();});}},_find:function(name)
{var breakpoints=this.c.breakpoints;for(var i=0,ien=breakpoints.length;i<ien;i++){if(breakpoints[i].name===name){return breakpoints[i];}}},_resize:function()
{var dt=this.s.dt;var width=$(window).width();var breakpoints=this.c.breakpoints;var breakpoint=breakpoints[0].name;var columns=this.s.columns;var i,ien;for(i=breakpoints.length-1;i>=0;i--){if(width<=breakpoints[i].width){breakpoint=breakpoints[i].name;break;}}
var columnsVis=this._columnsVisiblity(breakpoint);var collapsedClass=false;for(i=0,ien=columns.length;i<ien;i++){if(columnsVis[i]===false&&!columns[i].never){collapsedClass=true;break;}}
$(dt.table().node()).toggleClass('collapsed',collapsedClass);dt.columns().eq(0).each(function(colIdx,i){dt.column(colIdx).visible(columnsVis[i]);});},_resizeAuto:function()
{var dt=this.s.dt;var columns=this.s.columns;if(!this.c.auto){return;}
if($.inArray(true,$.map(columns,function(c){return c.auto;}))===-1){return;}
var tableWidth=dt.table().node().offsetWidth;var columnWidths=dt.columns;var clonedTable=dt.table().node().cloneNode(false);var clonedHeader=$(dt.table().header().cloneNode(false)).appendTo(clonedTable);var clonedBody=$(dt.table().body().cloneNode(false)).appendTo(clonedTable);$(dt.table().footer()).clone(false).appendTo(clonedTable);dt.rows({page:'current'}).indexes().flatten().each(function(idx){var clone=dt.row(idx).node().cloneNode(true);if(dt.columns(':hidden').flatten().length){$(clone).append(dt.cells(idx,':hidden').nodes().to$().clone());}
$(clone).appendTo(clonedBody);});var cells=dt.columns().header().to$().clone(false);$('<tr/>').append(cells).appendTo(clonedHeader);if(this.c.details.type==='inline'){$(clonedTable).addClass('dtr-inline collapsed');}
var inserted=$('<div/>').css({width:1,height:1,overflow:'hidden'}).append(clonedTable);inserted.find('th.never, td.never').remove();inserted.insertBefore(dt.table().node());dt.columns().eq(0).each(function(idx){columns[idx].minWidth=cells[idx].offsetWidth||0;});inserted.remove();}};Responsive.breakpoints=[{name:'desktop',width:Infinity},{name:'tablet-l',width:1024},{name:'tablet-p',width:768},{name:'mobile-l',width:480},{name:'mobile-p',width:320}];Responsive.defaults={breakpoints:Responsive.breakpoints,auto:true,details:{renderer:function(api,rowIdx){var data=api.cells(rowIdx,':hidden').eq(0).map(function(cell){var header=$(api.column(cell.column).header());var idx=api.cell(cell).index();if(header.hasClass('control')||header.hasClass('never')){return'';}
var dtPrivate=api.settings()[0];var cellData=dtPrivate.oApi._fnGetCellData(dtPrivate,idx.row,idx.column,'display');var title=header.text();if(title){title=title+':';}
return'<li data-dtr-index="'+idx.column+'">'+'<span class="dtr-title">'+title+'</span> '+'<span class="dtr-data">'+cellData+'</span>'+'</li>';}).toArray().join('');return data?$('<ul data-dtr-index="'+rowIdx+'"/>').append(data):false;},target:0,type:'inline'}};var Api=$.fn.dataTable.Api;Api.register('responsive()',function(){return this;});Api.register('responsive.index()',function(li){li=$(li);return{column:li.data('dtr-index'),row:li.parent().data('dtr-index')};});Api.register('responsive.rebuild()',function(){return this.iterator('table',function(ctx){if(ctx._responsive){ctx._responsive._classLogic();}});});Api.register('responsive.recalc()',function(){return this.iterator('table',function(ctx){if(ctx._responsive){ctx._responsive._resizeAuto();ctx._responsive._resize();}});});Responsive.version='1.0.7';$.fn.dataTable.Responsive=Responsive;$.fn.DataTable.Responsive=Responsive;$(document).on('init.dt.dtr',function(e,settings,json){if(e.namespace!=='dt'){return;}
if($(settings.nTable).hasClass('responsive')||$(settings.nTable).hasClass('dt-responsive')||settings.oInit.responsive||DataTable.defaults.responsive){var init=settings.oInit.responsive;if(init!==false){new Responsive(settings,$.isPlainObject(init)?init:{});}}});return Responsive;};if(typeof define==='function'&&define.amd){define(['jquery','datatables'],factory);}
else if(typeof exports==='object'){factory(require('jquery'),require('datatables'));}
else if(jQuery&&!jQuery.fn.dataTable.Responsive){factory(jQuery,jQuery.fn.dataTable);}})(window,document);(function(window,document,undefined){var factory=function($,DataTable){"use strict";DataTable.select={};DataTable.select.version='1.0.1';function cellRange(dt,idx,last)
{var indexes;var columnIndexes;var rowIndexes;var selectColumns=function(start,end){if(start>end){var tmp=end;end=start;start=tmp;}
var record=false;return dt.columns(':visible').indexes().filter(function(i){if(i===start){record=true;}
if(i===end){record=false;return true;}
return record;});};var selectRows=function(start,end){var indexes=dt.rows({search:'applied'}).indexes();if(indexes.indexOf(start)>indexes.indexOf(end)){var tmp=end;end=start;start=tmp;}
var record=false;return indexes.filter(function(i){if(i===start){record=true;}
if(i===end){record=false;return true;}
return record;});};if(!dt.cells({selected:true}).any()&&!last){columnIndexes=selectColumns(0,idx.column);rowIndexes=selectRows(0,idx.row);}
else{columnIndexes=selectColumns(last.column,idx.column);rowIndexes=selectRows(last.row,idx.row);}
indexes=dt.cells(rowIndexes,columnIndexes).flatten();if(!dt.cells(idx,{selected:true}).any()){dt.cells(indexes).select();}
else{dt.cells(indexes).deselect();}}
function disableMouseSelection(dt)
{var ctx=dt.settings()[0];var selector=ctx._select.selector;$(dt.table().body()).off('mousedown.dtSelect',selector).off('mouseup.dtSelect',selector).off('click.dtSelect',selector);$('body').off('click.dtSelect');}
function enableMouseSelection(dt)
{var body=$(dt.table().body());var ctx=dt.settings()[0];var selector=ctx._select.selector;body.on('mousedown.dtSelect',selector,function(e){if(e.shiftKey){body.css('-moz-user-select','none').one('selectstart.dtSelect',selector,function(){return false;});}}).on('mouseup.dtSelect',selector,function(e){body.css('-moz-user-select','');}).on('click.dtSelect',selector,function(e){var items=dt.select.items();var cellIndex=dt.cell(this).index();var idx;var ctx=dt.settings()[0];if($(e.target).closest('tbody')[0]!=body[0]){return;}
if(!dt.cell(e.target).any()){return;}
if(items==='row'){idx=cellIndex.row;typeSelect(e,dt,ctx,'row',idx);}
else if(items==='column'){idx=dt.cell(e.target).index().column;typeSelect(e,dt,ctx,'column',idx);}
else if(items==='cell'){idx=dt.cell(e.target).index();typeSelect(e,dt,ctx,'cell',idx);}
ctx._select_lastCell=cellIndex;});$('body').on('click.dtSelect',function(e){if(ctx._select.blurable){if($(e.target).parents().filter(dt.table().container()).length){return;}
if($(e.target).parents('div.DTE').length){return;}
clear(ctx,true);}});}
function eventTrigger(api,type,args,any)
{if(any&&!api.flatten().length){return;}
args.unshift(api);$(api.table().node()).triggerHandler(type+'.dt',args);}
function info(api)
{var ctx=api.settings()[0];if(!ctx._select.info||!ctx.aanFeatures.i){return;}
var output=$('<span class="select-info"/>');var add=function(name,num){output.append($('<span class="select-item"/>').append(api.i18n('select.'+name+'s',{_:'%d '+name+'s selected',0:'',1:'1 '+name+' selected'},num)));};add('row',api.rows({selected:true}).flatten().length);add('column',api.columns({selected:true}).flatten().length);add('cell',api.cells({selected:true}).flatten().length);$.each(ctx.aanFeatures.i,function(i,el){el=$(el);var exisiting=el.children('span.select-info');if(exisiting.length){exisiting.remove();}
if(output.text()!==''){el.append(output);}});}
function init(ctx){var api=new DataTable.Api(ctx);ctx.aoRowCreatedCallback.push({fn:function(row,data,index){var i,ien;var d=ctx.aoData[index];if(d._select_selected){$(row).addClass('selected');}
for(i=0,ien=ctx.aoColumns.length;i<ien;i++){if(ctx.aoColumns[i]._select_selected||(d._selected_cells&&d._selected_cells[i])){$(d.anCells[i]).addClass('selected');}}},sName:'select-deferRender'});api.on('preXhr.dt.dtSelect',function(){var rows=api.rows({selected:true}).ids(true).filter(function(d){return d!==undefined;});var cells=api.cells({selected:true}).eq(0).map(function(cellIdx){var id=api.row(cellIdx.row).id(true);return id?{row:id,column:cellIdx.column}:undefined;}).filter(function(d){return d!==undefined;});api.one('draw.dt.dtSelect',function(){api.rows(rows).select();if(cells.any()){cells.each(function(id){api.cells(id.row,id.column).select();});}});});api.on('draw.dtSelect.dt select.dtSelect.dt deselect.dtSelect.dt',function(){info(api);});api.on('destroy.dtSelect',function(){disableMouseSelection(api);api.off('.dtSelect');});}
function rowColumnRange(dt,type,idx,last)
{var indexes=dt[type+'s']({search:'applied'}).indexes();var idx1=$.inArray(last,indexes);var idx2=$.inArray(idx,indexes);if(!dt[type+'s']({selected:true}).any()&&idx1===-1){indexes.splice($.inArray(idx,indexes)+1,indexes.length);}
else{if(idx1>idx2){var tmp=idx2;idx2=idx1;idx1=tmp;}
indexes.splice(idx2+1,indexes.length);indexes.splice(0,idx1);}
if(!dt[type](idx,{selected:true}).any()){dt[type+'s'](indexes).select();}
else{indexes.splice($.inArray(idx,indexes),1);dt[type+'s'](indexes).deselect();}}
function clear(ctx,force)
{if(force||ctx._select.style==='single'){var api=new DataTable.Api(ctx);api.rows({selected:true}).deselect();api.columns({selected:true}).deselect();api.cells({selected:true}).deselect();}}
function typeSelect(e,dt,ctx,type,idx)
{var style=dt.select.style();var isSelected=dt[type](idx,{selected:true}).any();if(style==='os'){if(e.ctrlKey||e.metaKey){dt[type](idx).select(!isSelected);}
else if(e.shiftKey){if(type==='cell'){cellRange(dt,idx,ctx._select_lastCell||null);}
else{rowColumnRange(dt,type,idx,ctx._select_lastCell?ctx._select_lastCell[type]:null);}}
else{var selected=dt[type+'s']({selected:true});if(isSelected&&selected.flatten().length===1){dt[type](idx).deselect();}
else{selected.deselect();dt[type](idx).select();}}}
else{dt[type](idx).select(!isSelected);}}
$.each([{type:'row',prop:'aoData'},{type:'column',prop:'aoColumns'}],function(i,o){DataTable.ext.selector[o.type].push(function(settings,opts,indexes){var selected=opts.selected;var data;var out=[];if(selected===undefined){return indexes;}
for(var i=0,ien=indexes.length;i<ien;i++){data=settings[o.prop][indexes[i]];if((selected===true&&data._select_selected===true)||(selected===false&&!data._select_selected)){out.push(indexes[i]);}}
return out;});});DataTable.ext.selector.cell.push(function(settings,opts,cells){var selected=opts.selected;var rowData;var out=[];if(selected===undefined){return cells;}
for(var i=0,ien=cells.length;i<ien;i++){rowData=settings.aoData[cells[i].row];if((selected===true&&rowData._selected_cells&&rowData._selected_cells[cells[i].column]===true)||(selected===false&&(!rowData._selected_cells||!rowData._selected_cells[cells[i].column]))){out.push(cells[i]);}}
return out;});var apiRegister=DataTable.Api.register;var apiRegisterPlural=DataTable.Api.registerPlural;apiRegister('select()',function(){});apiRegister('select.blurable()',function(flag){if(flag===undefined){return this.context[0]._select.blurable;}
return this.iterator('table',function(ctx){ctx._select.blurable=flag;});});apiRegister('select.info()',function(flag){if(info===undefined){return this.context[0]._select.info;}
return this.iterator('table',function(ctx){ctx._select.info=flag;});});apiRegister('select.items()',function(items){if(items===undefined){return this.context[0]._select.items;}
return this.iterator('table',function(ctx){ctx._select.items=items;eventTrigger(new DataTable.Api(ctx),'selectItems',[items]);});});apiRegister('select.style()',function(style){if(style===undefined){return this.context[0]._select.style;}
return this.iterator('table',function(ctx){ctx._select.style=style;if(!ctx._select_init){init(ctx);}
var dt=new DataTable.Api(ctx);disableMouseSelection(dt);if(style!=='api'){enableMouseSelection(dt);}
eventTrigger(new DataTable.Api(ctx),'selectStyle',[style]);});});apiRegister('select.selector()',function(selector){if(selector===undefined){return this.context[0]._select.selector;}
return this.iterator('table',function(ctx){disableMouseSelection(new DataTable.Api(ctx));ctx._select.selector=selector;if(ctx._select.style!=='api'){enableMouseSelection(new DataTable.Api(ctx));}});});apiRegisterPlural('rows().select()','row().select()',function(select){var api=this;if(select===false){return this.deselect();}
this.iterator('row',function(ctx,idx){clear(ctx);ctx.aoData[idx]._select_selected=true;$(ctx.aoData[idx].nTr).addClass('selected');});this.iterator('table',function(ctx,i){eventTrigger(api,'select',['row',api[i]],true);});return this;});apiRegisterPlural('columns().select()','column().select()',function(select){var api=this;if(select===false){return this.deselect();}
this.iterator('column',function(ctx,idx){clear(ctx);ctx.aoColumns[idx]._select_selected=true;var column=new DataTable.Api(ctx).column(idx);$(column.header()).addClass('selected');$(column.footer()).addClass('selected');column.nodes().to$().addClass('selected');});this.iterator('table',function(ctx,i){eventTrigger(api,'select',['column',api[i]],true);});return this;});apiRegisterPlural('cells().select()','cell().select()',function(select){var api=this;if(select===false){return this.deselect();}
this.iterator('cell',function(ctx,rowIdx,colIdx){clear(ctx);var data=ctx.aoData[rowIdx];if(data._selected_cells===undefined){data._selected_cells=[];}
data._selected_cells[colIdx]=true;if(data.anCells){$(data.anCells[colIdx]).addClass('selected');}});this.iterator('table',function(ctx,i){eventTrigger(api,'select',['cell',api[i]],true);});return this;});apiRegisterPlural('rows().deselect()','row().deselect()',function(){var api=this;this.iterator('row',function(ctx,idx){ctx.aoData[idx]._select_selected=false;$(ctx.aoData[idx].nTr).removeClass('selected');});this.iterator('table',function(ctx,i){eventTrigger(api,'deselect',['row',api[i]],true);});return this;});apiRegisterPlural('columns().deselect()','column().deselect()',function(){var api=this;this.iterator('column',function(ctx,idx){ctx.aoColumns[idx]._select_selected=false;var api=new DataTable.Api(ctx);var column=api.column(idx);$(column.header()).removeClass('selected');$(column.footer()).removeClass('selected');api.cells(null,idx).indexes().each(function(cellIdx){var data=ctx.aoData[cellIdx.row];var cellSelected=data._selected_cells;if(data.anCells&&(!cellSelected||!cellSelected[cellIdx.column])){$(data.anCells[cellIdx.column]).removeClass('selected');}});});this.iterator('table',function(ctx,i){eventTrigger(api,'deselect',['column',api[i]],true);});return this;});apiRegisterPlural('cells().deselect()','cell().deselect()',function(){var api=this;this.iterator('cell',function(ctx,rowIdx,colIdx){var data=ctx.aoData[rowIdx];data._selected_cells[colIdx]=false;if(data.anCells&&!ctx.aoColumns[colIdx]._select_selected){$(data.anCells[colIdx]).removeClass('selected');}});this.iterator('table',function(ctx,i){eventTrigger(api,'deselect',['cell',api[i]],true);});return this;});function i18n(label,def){return function(dt){return dt.i18n('buttons.'+label,def);};}
$.extend(DataTable.ext.buttons,{selected:{text:i18n('selected','Selected'),className:'buttons-selected',init:function(dt,button,config){var that=this;dt.on('draw.dt.DT select.dt.DT deselect.dt.DT',function(){var enable=that.rows({selected:true}).any()||that.columns({selected:true}).any()||that.cells({selected:true}).any();that.enable(enable);});this.disable();}},selectedSingle:{text:i18n('selectedSingle','Selected single'),className:'buttons-selected-single',init:function(dt,button,config){var that=this;dt.on('draw.dt.DT select.dt.DT deselect.dt.DT',function(){var count=dt.rows({selected:true}).flatten().length+dt.columns({selected:true}).flatten().length+dt.cells({selected:true}).flatten().length;that.enable(count===1);});this.disable();}},selectAll:{text:i18n('selectAll','Select all'),className:'buttons-select-all',action:function(){var items=this.select.items();this[items+'s']().select();}},selectNone:{text:i18n('selectNone','Deselect all'),className:'buttons-select-none',action:function(){clear(this.settings()[0],true);}}});$.each(['Row','Column','Cell'],function(i,item){var lc=item.toLowerCase();DataTable.ext.buttons['select'+item+'s']={text:i18n('select'+item+'s','Select '+lc+'s'),className:'buttons-select-'+lc+'s',action:function(){this.select.items(lc);},init:function(dt,button,config){var that=this;dt.on('selectItems.dt.DT',function(e,ctx,items){that.active(items===lc);});}};});$(document).on('init.dt.dtSelect',function(e,ctx,json){if(e.namespace!=='dt'){return;}
var opts=ctx.oInit.select||DataTable.defaults.select;var dt=new DataTable.Api(ctx);var items='row';var style='api';var blurable=false;var info=true;var selector='td, th';ctx._select={};if(opts===true){style='os';}
else if(typeof opts==='string'){style=opts;}
else if($.isPlainObject(opts)){if(opts.blurable!==undefined){blurable=opts.blurable;}
if(opts.info!==undefined){info=opts.info;}
if(opts.items!==undefined){items=opts.items;}
if(opts.style!==undefined){style=opts.style;}
if(opts.selector!==undefined){selector=opts.selector;}}
dt.select.selector(selector);dt.select.items(items);dt.select.style(style);dt.select.blurable(blurable);dt.select.info(info);if($(dt.table().node()).hasClass('selectable')){dt.select.style('os');}});};if(typeof define==='function'&&define.amd){define(['jquery','datatables'],factory);}
else if(typeof exports==='object'){factory(require('jquery'),require('datatables'));}
else if(jQuery&&!jQuery.fn.dataTable.select){factory(jQuery,jQuery.fn.dataTable);}})(window,document);