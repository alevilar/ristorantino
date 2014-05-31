/*! jQuery v1.6.4 http://jquery.com/ | http://jquery.org/license */
(function(a,b){function cu(a){return f.isWindow(a)?a:a.nodeType===9?a.defaultView||a.parentWindow:!1}function cr(a){if(!cg[a]){var b=c.body,d=f("<"+a+">").appendTo(b),e=d.css("display");d.remove();if(e==="none"||e===""){ch||(ch=c.createElement("iframe"),ch.frameBorder=ch.width=ch.height=0),b.appendChild(ch);if(!ci||!ch.createElement)ci=(ch.contentWindow||ch.contentDocument).document,ci.write((c.compatMode==="CSS1Compat"?"<!doctype html>":"")+"<html><body>"),ci.close();d=ci.createElement(a),ci.body.appendChild(d),e=f.css(d,"display"),b.removeChild(ch)}cg[a]=e}return cg[a]}function cq(a,b){var c={};f.each(cm.concat.apply([],cm.slice(0,b)),function(){c[this]=a});return c}function cp(){cn=b}function co(){setTimeout(cp,0);return cn=f.now()}function cf(){try{return new a.ActiveXObject("Microsoft.XMLHTTP")}catch(b){}}function ce(){try{return new a.XMLHttpRequest}catch(b){}}function b$(a,c){a.dataFilter&&(c=a.dataFilter(c,a.dataType));var d=a.dataTypes,e={},g,h,i=d.length,j,k=d[0],l,m,n,o,p;for(g=1;g<i;g++){if(g===1)for(h in a.converters)typeof h=="string"&&(e[h.toLowerCase()]=a.converters[h]);l=k,k=d[g];if(k==="*")k=l;else if(l!=="*"&&l!==k){m=l+" "+k,n=e[m]||e["* "+k];if(!n){p=b;for(o in e){j=o.split(" ");if(j[0]===l||j[0]==="*"){p=e[j[1]+" "+k];if(p){o=e[o],o===!0?n=p:p===!0&&(n=o);break}}}}!n&&!p&&f.error("No conversion from "+m.replace(" "," to ")),n!==!0&&(c=n?n(c):p(o(c)))}}return c}function bZ(a,c,d){var e=a.contents,f=a.dataTypes,g=a.responseFields,h,i,j,k;for(i in g)i in d&&(c[g[i]]=d[i]);while(f[0]==="*")f.shift(),h===b&&(h=a.mimeType||c.getResponseHeader("content-type"));if(h)for(i in e)if(e[i]&&e[i].test(h)){f.unshift(i);break}if(f[0]in d)j=f[0];else{for(i in d){if(!f[0]||a.converters[i+" "+f[0]]){j=i;break}k||(k=i)}j=j||k}if(j){j!==f[0]&&f.unshift(j);return d[j]}}function bY(a,b,c,d){if(f.isArray(b))f.each(b,function(b,e){c||bA.test(a)?d(a,e):bY(a+"["+(typeof e=="object"||f.isArray(e)?b:"")+"]",e,c,d)});else if(!c&&b!=null&&typeof b=="object")for(var e in b)bY(a+"["+e+"]",b[e],c,d);else d(a,b)}function bX(a,c){var d,e,g=f.ajaxSettings.flatOptions||{};for(d in c)c[d]!==b&&((g[d]?a:e||(e={}))[d]=c[d]);e&&f.extend(!0,a,e)}function bW(a,c,d,e,f,g){f=f||c.dataTypes[0],g=g||{},g[f]=!0;var h=a[f],i=0,j=h?h.length:0,k=a===bP,l;for(;i<j&&(k||!l);i++)l=h[i](c,d,e),typeof l=="string"&&(!k||g[l]?l=b:(c.dataTypes.unshift(l),l=bW(a,c,d,e,l,g)));(k||!l)&&!g["*"]&&(l=bW(a,c,d,e,"*",g));return l}function bV(a){return function(b,c){typeof b!="string"&&(c=b,b="*");if(f.isFunction(c)){var d=b.toLowerCase().split(bL),e=0,g=d.length,h,i,j;for(;e<g;e++)h=d[e],j=/^\+/.test(h),j&&(h=h.substr(1)||"*"),i=a[h]=a[h]||[],i[j?"unshift":"push"](c)}}}function by(a,b,c){var d=b==="width"?a.offsetWidth:a.offsetHeight,e=b==="width"?bt:bu;if(d>0){c!=="border"&&f.each(e,function(){c||(d-=parseFloat(f.css(a,"padding"+this))||0),c==="margin"?d+=parseFloat(f.css(a,c+this))||0:d-=parseFloat(f.css(a,"border"+this+"Width"))||0});return d+"px"}d=bv(a,b,b);if(d<0||d==null)d=a.style[b]||0;d=parseFloat(d)||0,c&&f.each(e,function(){d+=parseFloat(f.css(a,"padding"+this))||0,c!=="padding"&&(d+=parseFloat(f.css(a,"border"+this+"Width"))||0),c==="margin"&&(d+=parseFloat(f.css(a,c+this))||0)});return d+"px"}function bl(a,b){b.src?f.ajax({url:b.src,async:!1,dataType:"script"}):f.globalEval((b.text||b.textContent||b.innerHTML||"").replace(bd,"/*$0*/")),b.parentNode&&b.parentNode.removeChild(b)}function bk(a){f.nodeName(a,"input")?bj(a):"getElementsByTagName"in a&&f.grep(a.getElementsByTagName("input"),bj)}function bj(a){if(a.type==="checkbox"||a.type==="radio")a.defaultChecked=a.checked}function bi(a){return"getElementsByTagName"in a?a.getElementsByTagName("*"):"querySelectorAll"in a?a.querySelectorAll("*"):[]}function bh(a,b){var c;if(b.nodeType===1){b.clearAttributes&&b.clearAttributes(),b.mergeAttributes&&b.mergeAttributes(a),c=b.nodeName.toLowerCase();if(c==="object")b.outerHTML=a.outerHTML;else if(c!=="input"||a.type!=="checkbox"&&a.type!=="radio"){if(c==="option")b.selected=a.defaultSelected;else if(c==="input"||c==="textarea")b.defaultValue=a.defaultValue}else a.checked&&(b.defaultChecked=b.checked=a.checked),b.value!==a.value&&(b.value=a.value);b.removeAttribute(f.expando)}}function bg(a,b){if(b.nodeType===1&&!!f.hasData(a)){var c=f.expando,d=f.data(a),e=f.data(b,d);if(d=d[c]){var g=d.events;e=e[c]=f.extend({},d);if(g){delete e.handle,e.events={};for(var h in g)for(var i=0,j=g[h].length;i<j;i++)f.event.add(b,h+(g[h][i].namespace?".":"")+g[h][i].namespace,g[h][i],g[h][i].data)}}}}function bf(a,b){return f.nodeName(a,"table")?a.getElementsByTagName("tbody")[0]||a.appendChild(a.ownerDocument.createElement("tbody")):a}function V(a,b,c){b=b||0;if(f.isFunction(b))return f.grep(a,function(a,d){var e=!!b.call(a,d,a);return e===c});if(b.nodeType)return f.grep(a,function(a,d){return a===b===c});if(typeof b=="string"){var d=f.grep(a,function(a){return a.nodeType===1});if(Q.test(b))return f.filter(b,d,!c);b=f.filter(b,d)}return f.grep(a,function(a,d){return f.inArray(a,b)>=0===c})}function U(a){return!a||!a.parentNode||a.parentNode.nodeType===11}function M(a,b){return(a&&a!=="*"?a+".":"")+b.replace(y,"`").replace(z,"&")}function L(a){var b,c,d,e,g,h,i,j,k,l,m,n,o,p=[],q=[],r=f._data(this,"events");if(!(a.liveFired===this||!r||!r.live||a.target.disabled||a.button&&a.type==="click")){a.namespace&&(n=new RegExp("(^|\\.)"+a.namespace.split(".").join("\\.(?:.*\\.)?")+"(\\.|$)")),a.liveFired=this;var s=r.live.slice(0);for(i=0;i<s.length;i++)g=s[i],g.origType.replace(w,"")===a.type?q.push(g.selector):s.splice(i--,1);e=f(a.target).closest(q,a.currentTarget);for(j=0,k=e.length;j<k;j++){m=e[j];for(i=0;i<s.length;i++){g=s[i];if(m.selector===g.selector&&(!n||n.test(g.namespace))&&!m.elem.disabled){h=m.elem,d=null;if(g.preType==="mouseenter"||g.preType==="mouseleave")a.type=g.preType,d=f(a.relatedTarget).closest(g.selector)[0],d&&f.contains(h,d)&&(d=h);(!d||d!==h)&&p.push({elem:h,handleObj:g,level:m.level})}}}for(j=0,k=p.length;j<k;j++){e=p[j];if(c&&e.level>c)break;a.currentTarget=e.elem,a.data=e.handleObj.data,a.handleObj=e.handleObj,o=e.handleObj.origHandler.apply(e.elem,arguments);if(o===!1||a.isPropagationStopped()){c=e.level,o===!1&&(b=!1);if(a.isImmediatePropagationStopped())break}}return b}}function J(a,c,d){var e=f.extend({},d[0]);e.type=a,e.originalEvent={},e.liveFired=b,f.event.handle.call(c,e),e.isDefaultPrevented()&&d[0].preventDefault()}function D(){return!0}function C(){return!1}function m(a,c,d){var e=c+"defer",g=c+"queue",h=c+"mark",i=f.data(a,e,b,!0);i&&(d==="queue"||!f.data(a,g,b,!0))&&(d==="mark"||!f.data(a,h,b,!0))&&setTimeout(function(){!f.data(a,g,b,!0)&&!f.data(a,h,b,!0)&&(f.removeData(a,e,!0),i.resolve())},0)}function l(a){for(var b in a)if(b!=="toJSON")return!1;return!0}function k(a,c,d){if(d===b&&a.nodeType===1){var e="data-"+c.replace(j,"-$1").toLowerCase();d=a.getAttribute(e);if(typeof d=="string"){try{d=d==="true"?!0:d==="false"?!1:d==="null"?null:f.isNaN(d)?i.test(d)?f.parseJSON(d):d:parseFloat(d)}catch(g){}f.data(a,c,d)}else d=b}return d}var c=a.document,d=a.navigator,e=a.location,f=function(){function K(){if(!e.isReady){try{c.documentElement.doScroll("left")}catch(a){setTimeout(K,1);return}e.ready()}}var e=function(a,b){return new e.fn.init(a,b,h)},f=a.jQuery,g=a.$,h,i=/^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/,j=/\S/,k=/^\s+/,l=/\s+$/,m=/\d/,n=/^<(\w+)\s*\/?>(?:<\/\1>)?$/,o=/^[\],:{}\s]*$/,p=/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,q=/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,r=/(?:^|:|,)(?:\s*\[)+/g,s=/(webkit)[ \/]([\w.]+)/,t=/(opera)(?:.*version)?[ \/]([\w.]+)/,u=/(msie) ([\w.]+)/,v=/(mozilla)(?:.*? rv:([\w.]+))?/,w=/-([a-z]|[0-9])/ig,x=/^-ms-/,y=function(a,b){return(b+"").toUpperCase()},z=d.userAgent,A,B,C,D=Object.prototype.toString,E=Object.prototype.hasOwnProperty,F=Array.prototype.push,G=Array.prototype.slice,H=String.prototype.trim,I=Array.prototype.indexOf,J={};e.fn=e.prototype={constructor:e,init:function(a,d,f){var g,h,j,k;if(!a)return this;if(a.nodeType){this.context=this[0]=a,this.length=1;return this}if(a==="body"&&!d&&c.body){this.context=c,this[0]=c.body,this.selector=a,this.length=1;return this}if(typeof a=="string"){a.charAt(0)!=="<"||a.charAt(a.length-1)!==">"||a.length<3?g=i.exec(a):g=[null,a,null];if(g&&(g[1]||!d)){if(g[1]){d=d instanceof e?d[0]:d,k=d?d.ownerDocument||d:c,j=n.exec(a),j?e.isPlainObject(d)?(a=[c.createElement(j[1])],e.fn.attr.call(a,d,!0)):a=[k.createElement(j[1])]:(j=e.buildFragment([g[1]],[k]),a=(j.cacheable?e.clone(j.fragment):j.fragment).childNodes);return e.merge(this,a)}h=c.getElementById(g[2]);if(h&&h.parentNode){if(h.id!==g[2])return f.find(a);this.length=1,this[0]=h}this.context=c,this.selector=a;return this}return!d||d.jquery?(d||f).find(a):this.constructor(d).find(a)}if(e.isFunction(a))return f.ready(a);a.selector!==b&&(this.selector=a.selector,this.context=a.context);return e.makeArray(a,this)},selector:"",jquery:"1.6.4",length:0,size:function(){return this.length},toArray:function(){return G.call(this,0)},get:function(a){return a==null?this.toArray():a<0?this[this.length+a]:this[a]},pushStack:function(a,b,c){var d=this.constructor();e.isArray(a)?F.apply(d,a):e.merge(d,a),d.prevObject=this,d.context=this.context,b==="find"?d.selector=this.selector+(this.selector?" ":"")+c:b&&(d.selector=this.selector+"."+b+"("+c+")");return d},each:function(a,b){return e.each(this,a,b)},ready:function(a){e.bindReady(),B.done(a);return this},eq:function(a){return a===-1?this.slice(a):this.slice(a,+a+1)},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},slice:function(){return this.pushStack(G.apply(this,arguments),"slice",G.call(arguments).join(","))},map:function(a){return this.pushStack(e.map(this,function(b,c){return a.call(b,c,b)}))},end:function(){return this.prevObject||this.constructor(null)},push:F,sort:[].sort,splice:[].splice},e.fn.init.prototype=e.fn,e.extend=e.fn.extend=function(){var a,c,d,f,g,h,i=arguments[0]||{},j=1,k=arguments.length,l=!1;typeof i=="boolean"&&(l=i,i=arguments[1]||{},j=2),typeof i!="object"&&!e.isFunction(i)&&(i={}),k===j&&(i=this,--j);for(;j<k;j++)if((a=arguments[j])!=null)for(c in a){d=i[c],f=a[c];if(i===f)continue;l&&f&&(e.isPlainObject(f)||(g=e.isArray(f)))?(g?(g=!1,h=d&&e.isArray(d)?d:[]):h=d&&e.isPlainObject(d)?d:{},i[c]=e.extend(l,h,f)):f!==b&&(i[c]=f)}return i},e.extend({noConflict:function(b){a.$===e&&(a.$=g),b&&a.jQuery===e&&(a.jQuery=f);return e},isReady:!1,readyWait:1,holdReady:function(a){a?e.readyWait++:e.ready(!0)},ready:function(a){if(a===!0&&!--e.readyWait||a!==!0&&!e.isReady){if(!c.body)return setTimeout(e.ready,1);e.isReady=!0;if(a!==!0&&--e.readyWait>0)return;B.resolveWith(c,[e]),e.fn.trigger&&e(c).trigger("ready").unbind("ready")}},bindReady:function(){if(!B){B=e._Deferred();if(c.readyState==="complete")return setTimeout(e.ready,1);if(c.addEventListener)c.addEventListener("DOMContentLoaded",C,!1),a.addEventListener("load",e.ready,!1);else if(c.attachEvent){c.attachEvent("onreadystatechange",C),a.attachEvent("onload",e.ready);var b=!1;try{b=a.frameElement==null}catch(d){}c.documentElement.doScroll&&b&&K()}}},isFunction:function(a){return e.type(a)==="function"},isArray:Array.isArray||function(a){return e.type(a)==="array"},isWindow:function(a){return a&&typeof a=="object"&&"setInterval"in a},isNaN:function(a){return a==null||!m.test(a)||isNaN(a)},type:function(a){return a==null?String(a):J[D.call(a)]||"object"},isPlainObject:function(a){if(!a||e.type(a)!=="object"||a.nodeType||e.isWindow(a))return!1;try{if(a.constructor&&!E.call(a,"constructor")&&!E.call(a.constructor.prototype,"isPrototypeOf"))return!1}catch(c){return!1}var d;for(d in a);return d===b||E.call(a,d)},isEmptyObject:function(a){for(var b in a)return!1;return!0},error:function(a){throw a},parseJSON:function(b){if(typeof b!="string"||!b)return null;b=e.trim(b);if(a.JSON&&a.JSON.parse)return a.JSON.parse(b);if(o.test(b.replace(p,"@").replace(q,"]").replace(r,"")))return(new Function("return "+b))();e.error("Invalid JSON: "+b)},parseXML:function(c){var d,f;try{a.DOMParser?(f=new DOMParser,d=f.parseFromString(c,"text/xml")):(d=new ActiveXObject("Microsoft.XMLDOM"),d.async="false",d.loadXML(c))}catch(g){d=b}(!d||!d.documentElement||d.getElementsByTagName("parsererror").length)&&e.error("Invalid XML: "+c);return d},noop:function(){},globalEval:function(b){b&&j.test(b)&&(a.execScript||function(b){a.eval.call(a,b)})(b)},camelCase:function(a){return a.replace(x,"ms-").replace(w,y)},nodeName:function(a,b){return a.nodeName&&a.nodeName.toUpperCase()===b.toUpperCase()},each:function(a,c,d){var f,g=0,h=a.length,i=h===b||e.isFunction(a);if(d){if(i){for(f in a)if(c.apply(a[f],d)===!1)break}else for(;g<h;)if(c.apply(a[g++],d)===!1)break}else if(i){for(f in a)if(c.call(a[f],f,a[f])===!1)break}else for(;g<h;)if(c.call(a[g],g,a[g++])===!1)break;return a},trim:H?function(a){return a==null?"":H.call(a)}:function(a){return a==null?"":(a+"").replace(k,"").replace(l,"")},makeArray:function(a,b){var c=b||[];if(a!=null){var d=e.type(a);a.length==null||d==="string"||d==="function"||d==="regexp"||e.isWindow(a)?F.call(c,a):e.merge(c,a)}return c},inArray:function(a,b){if(!b)return-1;if(I)return I.call(b,a);for(var c=0,d=b.length;c<d;c++)if(b[c]===a)return c;return-1},merge:function(a,c){var d=a.length,e=0;if(typeof c.length=="number")for(var f=c.length;e<f;e++)a[d++]=c[e];else while(c[e]!==b)a[d++]=c[e++];a.length=d;return a},grep:function(a,b,c){var d=[],e;c=!!c;for(var f=0,g=a.length;f<g;f++)e=!!b(a[f],f),c!==e&&d.push(a[f]);return d},map:function(a,c,d){var f,g,h=[],i=0,j=a.length,k=a instanceof e||j!==b&&typeof j=="number"&&(j>0&&a[0]&&a[j-1]||j===0||e.isArray(a));if(k)for(;i<j;i++)f=c(a[i],i,d),f!=null&&(h[h.length]=f);else for(g in a)f=c(a[g],g,d),f!=null&&(h[h.length]=f);return h.concat.apply([],h)},guid:1,proxy:function(a,c){if(typeof c=="string"){var d=a[c];c=a,a=d}if(!e.isFunction(a))return b;var f=G.call(arguments,2),g=function(){return a.apply(c,f.concat(G.call(arguments)))};g.guid=a.guid=a.guid||g.guid||e.guid++;return g},access:function(a,c,d,f,g,h){var i=a.length;if(typeof c=="object"){for(var j in c)e.access(a,j,c[j],f,g,d);return a}if(d!==b){f=!h&&f&&e.isFunction(d);for(var k=0;k<i;k++)g(a[k],c,f?d.call(a[k],k,g(a[k],c)):d,h);return a}return i?g(a[0],c):b},now:function(){return(new Date).getTime()},uaMatch:function(a){a=a.toLowerCase();var b=s.exec(a)||t.exec(a)||u.exec(a)||a.indexOf("compatible")<0&&v.exec(a)||[];return{browser:b[1]||"",version:b[2]||"0"}},sub:function(){function a(b,c){return new a.fn.init(b,c)}e.extend(!0,a,this),a.superclass=this,a.fn=a.prototype=this(),a.fn.constructor=a,a.sub=this.sub,a.fn.init=function(d,f){f&&f instanceof e&&!(f instanceof a)&&(f=a(f));return e.fn.init.call(this,d,f,b)},a.fn.init.prototype=a.fn;var b=a(c);return a},browser:{}}),e.each("Boolean Number String Function Array Date RegExp Object".split(" "),function(a,b){J["[object "+b+"]"]=b.toLowerCase()}),A=e.uaMatch(z),A.browser&&(e.browser[A.browser]=!0,e.browser.version=A.version),e.browser.webkit&&(e.browser.safari=!0),j.test(" ")&&(k=/^[\s\xA0]+/,l=/[\s\xA0]+$/),h=e(c),c.addEventListener?C=function(){c.removeEventListener("DOMContentLoaded",C,!1),e.ready()}:c.attachEvent&&(C=function(){c.readyState==="complete"&&(c.detachEvent("onreadystatechange",C),e.ready())});return e}(),g="done fail isResolved isRejected promise then always pipe".split(" "),h=[].slice;f.extend({_Deferred:function(){var a=[],b,c,d,e={done:function(){if(!d){var c=arguments,g,h,i,j,k;b&&(k=b,b=0);for(g=0,h=c.length;g<h;g++)i=c[g],j=f.type(i),j==="array"?e.done.apply(e,i):j==="function"&&a.push(i);k&&e.resolveWith(k[0],k[1])}return this},resolveWith:function(e,f){if(!d&&!b&&!c){f=f||[],c=1;try{while(a[0])a.shift().apply(e,f)}finally{b=[e,f],c=0}}return this},resolve:function(){e.resolveWith(this,arguments);return this},isResolved:function(){return!!c||!!b},cancel:function(){d=1,a=[];return this}};return e},Deferred:function(a){var b=f._Deferred(),c=f._Deferred(),d;f.extend(b,{then:function(a,c){b.done(a).fail(c);return this},always:function(){return b.done.apply(b,arguments).fail.apply(this,arguments)},fail:c.done,rejectWith:c.resolveWith,reject:c.resolve,isRejected:c.isResolved,pipe:function(a,c){return f.Deferred(function(d){f.each({done:[a,"resolve"],fail:[c,"reject"]},function(a,c){var e=c[0],g=c[1],h;f.isFunction(e)?b[a](function(){h=e.apply(this,arguments),h&&f.isFunction(h.promise)?h.promise().then(d.resolve,d.reject):d[g+"With"](this===b?d:this,[h])}):b[a](d[g])})}).promise()},promise:function(a){if(a==null){if(d)return d;d=a={}}var c=g.length;while(c--)a[g[c]]=b[g[c]];return a}}),b.done(c.cancel).fail(b.cancel),delete b.cancel,a&&a.call(b,b);return b},when:function(a){function i(a){return function(c){b[a]=arguments.length>1?h.call(arguments,0):c,--e||g.resolveWith(g,h.call(b,0))}}var b=arguments,c=0,d=b.length,e=d,g=d<=1&&a&&f.isFunction(a.promise)?a:f.Deferred();if(d>1){for(;c<d;c++)b[c]&&f.isFunction(b[c].promise)?b[c].promise().then(i(c),g.reject):--e;e||g.resolveWith(g,b)}else g!==a&&g.resolveWith(g,d?[a]:[]);return g.promise()}}),f.support=function(){var a=c.createElement("div"),b=c.documentElement,d,e,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u;a.setAttribute("className","t"),a.innerHTML="   <link/><table></table><a href='/a' style='top:1px;float:left;opacity:.55;'>a</a><input type='checkbox'/>",d=a.getElementsByTagName("*"),e=a.getElementsByTagName("a")[0];if(!d||!d.length||!e)return{};g=c.createElement("select"),h=g.appendChild(c.createElement("option")),i=a.getElementsByTagName("input")[0],k={leadingWhitespace:a.firstChild.nodeType===3,tbody:!a.getElementsByTagName("tbody").length,htmlSerialize:!!a.getElementsByTagName("link").length,style:/top/.test(e.getAttribute("style")),hrefNormalized:e.getAttribute("href")==="/a",opacity:/^0.55$/.test(e.style.opacity),cssFloat:!!e.style.cssFloat,checkOn:i.value==="on",optSelected:h.selected,getSetAttribute:a.className!=="t",submitBubbles:!0,changeBubbles:!0,focusinBubbles:!1,deleteExpando:!0,noCloneEvent:!0,inlineBlockNeedsLayout:!1,shrinkWrapBlocks:!1,reliableMarginRight:!0},i.checked=!0,k.noCloneChecked=i.cloneNode(!0).checked,g.disabled=!0,k.optDisabled=!h.disabled;try{delete a.test}catch(v){k.deleteExpando=!1}!a.addEventListener&&a.attachEvent&&a.fireEvent&&(a.attachEvent("onclick",function(){k.noCloneEvent=!1}),a.cloneNode(!0).fireEvent("onclick")),i=c.createElement("input"),i.value="t",i.setAttribute("type","radio"),k.radioValue=i.value==="t",i.setAttribute("checked","checked"),a.appendChild(i),l=c.createDocumentFragment(),l.appendChild(a.firstChild),k.checkClone=l.cloneNode(!0).cloneNode(!0).lastChild.checked,a.innerHTML="",a.style.width=a.style.paddingLeft="1px",m=c.getElementsByTagName("body")[0],o=c.createElement(m?"div":"body"),p={visibility:"hidden",width:0,height:0,border:0,margin:0,background:"none"},m&&f.extend(p,{position:"absolute",left:"-1000px",top:"-1000px"});for(t in p)o.style[t]=p[t];o.appendChild(a),n=m||b,n.insertBefore(o,n.firstChild),k.appendChecked=i.checked,k.boxModel=a.offsetWidth===2,"zoom"in a.style&&(a.style.display="inline",a.style.zoom=1,k.inlineBlockNeedsLayout=a.offsetWidth===2,a.style.display="",a.innerHTML="<div style='width:4px;'></div>",k.shrinkWrapBlocks=a.offsetWidth!==2),a.innerHTML="<table><tr><td style='padding:0;border:0;display:none'></td><td>t</td></tr></table>",q=a.getElementsByTagName("td"),u=q[0].offsetHeight===0,q[0].style.display="",q[1].style.display="none",k.reliableHiddenOffsets=u&&q[0].offsetHeight===0,a.innerHTML="",c.defaultView&&c.defaultView.getComputedStyle&&(j=c.createElement("div"),j.style.width="0",j.style.marginRight="0",a.appendChild(j),k.reliableMarginRight=(parseInt((c.defaultView.getComputedStyle(j,null)||{marginRight:0}).marginRight,10)||0)===0),o.innerHTML="",n.removeChild(o);if(a.attachEvent)for(t in{submit:1,change:1,focusin:1})s="on"+t,u=s in a,u||(a.setAttribute(s,"return;"),u=typeof a[s]=="function"),k[t+"Bubbles"]=u;o=l=g=h=m=j=a=i=null;return k}(),f.boxModel=f.support.boxModel;var i=/^(?:\{.*\}|\[.*\])$/,j=/([A-Z])/g;f.extend({cache:{},uuid:0,expando:"jQuery"+(f.fn.jquery+Math.random()).replace(/\D/g,""),noData:{embed:!0,object:"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",applet:!0},hasData:function(a){a=a.nodeType?f.cache[a[f.expando]]:a[f.expando];return!!a&&!l(a)},data:function(a,c,d,e){if(!!f.acceptData(a)){var g,h,i=f.expando,j=typeof c=="string",k=a.nodeType,l=k?f.cache:a,m=k?a[f.expando]:a[f.expando]&&f.expando;if((!m||e&&m&&l[m]&&!l[m][i])&&j&&d===b)return;m||(k?a[f.expando]=m=++f.uuid:m=f.expando),l[m]||(l[m]={},k||(l[m].toJSON=f.noop));if(typeof c=="object"||typeof c=="function")e?l[m][i]=f.extend(l[m][i],c):l[m]=f.extend(l[m],c);g=l[m],e&&(g[i]||(g[i]={}),g=g[i]),d!==b&&(g[f.camelCase(c)]=d);if(c==="events"&&!g[c])return g[i]&&g[i].events;j?(h=g[c],h==null&&(h=g[f.camelCase(c)])):h=g;return h}},removeData:function(a,b,c){if(!!f.acceptData(a)){var d,e=f.expando,g=a.nodeType,h=g?f.cache:a,i=g?a[f.expando]:f.expando;if(!h[i])return;if(b){d=c?h[i][e]:h[i];if(d){d[b]||(b=f.camelCase(b)),delete d[b];if(!l(d))return}}if(c){delete h[i][e];if(!l(h[i]))return}var j=h[i][e];f.support.deleteExpando||!h.setInterval?delete h[i]:h[i]=null,j?(h[i]={},g||(h[i].toJSON=f.noop),h[i][e]=j):g&&(f.support.deleteExpando?delete a[f.expando]:a.removeAttribute?a.removeAttribute(f.expando):a[f.expando]=null)}},_data:function(a,b,c){return f.data(a,b,c,!0)},acceptData:function(a){if(a.nodeName){var b=f.noData[a.nodeName.toLowerCase()];if(b)return b!==!0&&a.getAttribute("classid")===b}return!0}}),f.fn.extend({data:function(a,c){var d=null;if(typeof a=="undefined"){if(this.length){d=f.data(this[0]);if(this[0].nodeType===1){var e=this[0].attributes,g;for(var h=0,i=e.length;h<i;h++)g=e[h].name,g.indexOf("data-")===0&&(g=f.camelCase(g.substring(5)),k(this[0],g,d[g]))}}return d}if(typeof a=="object")return this.each(function(){f.data(this,a)});var j=a.split(".");j[1]=j[1]?"."+j[1]:"";if(c===b){d=this.triggerHandler("getData"+j[1]+"!",[j[0]]),d===b&&this.length&&(d=f.data(this[0],a),d=k(this[0],a,d));return d===b&&j[1]?this.data(j[0]):d}return this.each(function(){var b=f(this),d=[j[0],c];b.triggerHandler("setData"+j[1]+"!",d),f.data(this,a,c),b.triggerHandler("changeData"+j[1]+"!",d)})},removeData:function(a){return this.each(function(){f.removeData(this,a)})}}),f.extend({_mark:function(a,c){a&&(c=(c||"fx")+"mark",f.data(a,c,(f.data(a,c,b,!0)||0)+1,!0))},_unmark:function(a,c,d){a!==!0&&(d=c,c=a,a=!1);if(c){d=d||"fx";var e=d+"mark",g=a?0:(f.data(c,e,b,!0)||1)-1;g?f.data(c,e,g,!0):(f.removeData(c,e,!0),m(c,d,"mark"))}},queue:function(a,c,d){if(a){c=(c||"fx")+"queue";var e=f.data(a,c,b,!0);d&&(!e||f.isArray(d)?e=f.data(a,c,f.makeArray(d),!0):e.push(d));return e||[]}},dequeue:function(a,b){b=b||"fx";var c=f.queue(a,b),d=c.shift(),e;d==="inprogress"&&(d=c.shift()),d&&(b==="fx"&&c.unshift("inprogress"),d.call(a,function(){f.dequeue(a,b)})),c.length||(f.removeData(a,b+"queue",!0),m(a,b,"queue"))}}),f.fn.extend({queue:function(a,c){typeof a!="string"&&(c=a,a="fx");if(c===b)return f.queue(this[0],a);return this.each(function(){var b=f.queue(this,a,c);a==="fx"&&b[0]!=="inprogress"&&f.dequeue(this,a)})},dequeue:function(a){return this.each(function(){f.dequeue(this,a)})},delay:function(a,b){a=f.fx?f.fx.speeds[a]||a:a,b=b||"fx";return this.queue(b,function(){var c=this;setTimeout(function(){f.dequeue(c,b)},a)})},clearQueue:function(a){return this.queue(a||"fx",[])},promise:function(a,c){function m(){--h||d.resolveWith(e,[e])}typeof a!="string"&&(c=a,a=b),a=a||"fx";var d=f.Deferred(),e=this,g=e.length,h=1,i=a+"defer",j=a+"queue",k=a+"mark",l;while(g--)if(l=f.data(e[g],i,b,!0)||(f.data(e[g],j,b,!0)||f.data(e[g],k,b,!0))&&f.data(e[g],i,f._Deferred(),!0))h++,l.done(m);m();return d.promise()}});var n=/[\n\t\r]/g,o=/\s+/,p=/\r/g,q=/^(?:button|input)$/i,r=/^(?:button|input|object|select|textarea)$/i,s=/^a(?:rea)?$/i,t=/^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,u,v;f.fn.extend({attr:function(a,b){return f.access(this,a,b,!0,f.attr)},removeAttr:function(a){return this.each(function(){f.removeAttr(this,a)})},prop:function(a,b){return f.access(this,a,b,!0,f.prop)},removeProp:function(a){a=f.propFix[a]||a;return this.each(function(){try{this[a]=b,delete this[a]}catch(c){}})},addClass:function(a){var b,c,d,e,g,h,i;if(f.isFunction(a))return this.each(function(b){f(this).addClass(a.call(this,b,this.className))});if(a&&typeof a=="string"){b=a.split(o);for(c=0,d=this.length;c<d;c++){e=this[c];if(e.nodeType===1)if(!e.className&&b.length===1)e.className=a;else{g=" "+e.className+" ";for(h=0,i=b.length;h<i;h++)~g.indexOf(" "+b[h]+" ")||(g+=b[h]+" ");e.className=f.trim(g)}}}return this},removeClass:function(a){var c,d,e,g,h,i,j;if(f.isFunction(a))return this.each(function(b){f(this).removeClass(a.call(this,b,this.className))});if(a&&typeof a=="string"||a===b){c=(a||"").split(o);for(d=0,e=this.length;d<e;d++){g=this[d];if(g.nodeType===1&&g.className)if(a){h=(" "+g.className+" ").replace(n," ");for(i=0,j=c.length;i<j;i++)h=h.replace(" "+c[i]+" "," ");g.className=f.trim(h)}else g.className=""}}return this},toggleClass:function(a,b){var c=typeof a,d=typeof b=="boolean";if(f.isFunction(a))return this.each(function(c){f(this).toggleClass(a.call(this,c,this.className,b),b)});return this.each(function(){if(c==="string"){var e,g=0,h=f(this),i=b,j=a.split(o);while(e=j[g++])i=d?i:!h.hasClass(e),h[i?"addClass":"removeClass"](e)}else if(c==="undefined"||c==="boolean")this.className&&f._data(this,"__className__",this.className),this.className=this.className||a===!1?"":f._data(this,"__className__")||""})},hasClass:function(a){var b=" "+a+" ";for(var c=0,d=this.length;c<d;c++)if(this[c].nodeType===1&&(" "+this[c].className+" ").replace(n," ").indexOf(b)>-1)return!0;return!1},val:function(a){var c,d,e=this[0];if(!arguments.length){if(e){c=f.valHooks[e.nodeName.toLowerCase()]||f.valHooks[e.type];if(c&&"get"in c&&(d=c.get(e,"value"))!==b)return d;d=e.value;return typeof d=="string"?d.replace(p,""):d==null?"":d}return b}var g=f.isFunction(a);return this.each(function(d){var e=f(this),h;if(this.nodeType===1){g?h=a.call(this,d,e.val()):h=a,h==null?h="":typeof h=="number"?h+="":f.isArray(h)&&(h=f.map(h,function(a){return a==null?"":a+""})),c=f.valHooks[this.nodeName.toLowerCase()]||f.valHooks[this.type];if(!c||!("set"in c)||c.set(this,h,"value")===b)this.value=h}})}}),f.extend({valHooks:{option:{get:function(a){var b=a.attributes.value;return!b||b.specified?a.value:a.text}},select:{get:function(a){var b,c=a.selectedIndex,d=[],e=a.options,g=a.type==="select-one";if(c<0)return null;for(var h=g?c:0,i=g?c+1:e.length;h<i;h++){var j=e[h];if(j.selected&&(f.support.optDisabled?!j.disabled:j.getAttribute("disabled")===null)&&(!j.parentNode.disabled||!f.nodeName(j.parentNode,"optgroup"))){b=f(j).val();if(g)return b;d.push(b)}}if(g&&!d.length&&e.length)return f(e[c]).val();return d},set:function(a,b){var c=f.makeArray(b);f(a).find("option").each(function(){this.selected=f.inArray(f(this).val(),c)>=0}),c.length||(a.selectedIndex=-1);return c}}},attrFn:{val:!0,css:!0,html:!0,text:!0,data:!0,width:!0,height:!0,offset:!0},attrFix:{tabindex:"tabIndex"},attr:function(a,c,d,e){var g=a.nodeType;if(!a||g===3||g===8||g===2)return b;if(e&&c in f.attrFn)return f(a)[c](d);if(!("getAttribute"in a))return f.prop(a,c,d);var h,i,j=g!==1||!f.isXMLDoc(a);j&&(c=f.attrFix[c]||c,i=f.attrHooks[c],i||(t.test(c)?i=v:u&&(i=u)));if(d!==b){if(d===null){f.removeAttr(a,c);return b}if(i&&"set"in i&&j&&(h=i.set(a,d,c))!==b)return h;a.setAttribute(c,""+d);return d}if(i&&"get"in i&&j&&(h=i.get(a,c))!==null)return h;h=a.getAttribute(c);return h===null?b:h},removeAttr:function(a,b){var c;a.nodeType===1&&(b=f.attrFix[b]||b,f.attr(a,b,""),a.removeAttribute(b),t.test(b)&&(c=f.propFix[b]||b)in a&&(a[c]=!1))},attrHooks:{type:{set:function(a,b){if(q.test(a.nodeName)&&a.parentNode)f.error("type property can't be changed");else if(!f.support.radioValue&&b==="radio"&&f.nodeName(a,"input")){var c=a.value;a.setAttribute("type",b),c&&(a.value=c);return b}}},value:{get:function(a,b){if(u&&f.nodeName(a,"button"))return u.get(a,b);return b in a?a.value:null},set:function(a,b,c){if(u&&f.nodeName(a,"button"))return u.set(a,b,c);a.value=b}}},propFix:{tabindex:"tabIndex",readonly:"readOnly","for":"htmlFor","class":"className",maxlength:"maxLength",cellspacing:"cellSpacing",cellpadding:"cellPadding",rowspan:"rowSpan",colspan:"colSpan",usemap:"useMap",frameborder:"frameBorder",contenteditable:"contentEditable"},prop:function(a,c,d){var e=a.nodeType;if(!a||e===3||e===8||e===2)return b;var g,h,i=e!==1||!f.isXMLDoc(a);i&&(c=f.propFix[c]||c,h=f.propHooks[c]);return d!==b?h&&"set"in h&&(g=h.set(a,d,c))!==b?g:a[c]=d:h&&"get"in h&&(g=h.get(a,c))!==null?g:a[c]},propHooks:{tabIndex:{get:function(a){var c=a.getAttributeNode("tabindex");return c&&c.specified?parseInt(c.value,10):r.test(a.nodeName)||s.test(a.nodeName)&&a.href?0:b}}}}),f.attrHooks.tabIndex=f.propHooks.tabIndex,v={get:function(a,c){var d;return f.prop(a,c)===!0||(d=a.getAttributeNode(c))&&d.nodeValue!==!1?c.toLowerCase():b},set:function(a,b,c){var d;b===!1?f.removeAttr(a,c):(d=f.propFix[c]||c,d in a&&(a[d]=!0),a.setAttribute(c,c.toLowerCase()));return c}},f.support.getSetAttribute||(u=f.valHooks.button={get:function(a,c){var d;d=a.getAttributeNode(c);return d&&d.nodeValue!==""?d.nodeValue:b},set:function(a,b,d){var e=a.getAttributeNode(d);e||(e=c.createAttribute(d),a.setAttributeNode(e));return e.nodeValue=b+""}},f.each(["width","height"],function(a,b){f.attrHooks[b]=f.extend(f.attrHooks[b],{set:function(a,c){if(c===""){a.setAttribute(b,"auto");return c}}})})),f.support.hrefNormalized||f.each(["href","src","width","height"],function(a,c){f.attrHooks[c]=f.extend(f.attrHooks[c],{get:function(a){var d=a.getAttribute(c,2);return d===null?b:d}})}),f.support.style||(f.attrHooks.style={get:function(a){return a.style.cssText.toLowerCase()||b},set:function(a,b){return a.style.cssText=""+b}}),f.support.optSelected||(f.propHooks.selected=f.extend(f.propHooks.selected,{get:function(a){var b=a.parentNode;b&&(b.selectedIndex,b.parentNode&&b.parentNode.selectedIndex);return null}})),f.support.checkOn||f.each(["radio","checkbox"],function(){f.valHooks[this]={get:function(a){return a.getAttribute("value")===null?"on":a.value}}}),f.each(["radio","checkbox"],function(){f.valHooks[this]=f.extend(f.valHooks[this],{set:function(a,b){if(f.isArray(b))return a.checked=f.inArray(f(a).val(),b)>=0}})});var w=/\.(.*)$/,x=/^(?:textarea|input|select)$/i,y=/\./g,z=/ /g,A=/[^\w\s.|`]/g,B=function(a){return a.replace(A,"\\$&")};f.event={add:function(a,c,d,e){if(a.nodeType!==3&&a.nodeType!==8){if(d===!1)d=C;else if(!d)return;var g,h;d.handler&&(g=d,d=g.handler),d.guid||(d.guid=f.guid++);var i=f._data(a);if(!i)return;var j=i.events,k=i.handle;j||(i.events=j={}),k||(i.handle=k=function(a){return typeof f!="undefined"&&(!a||f.event.triggered!==a.type)?f.event.handle.apply(k.elem,arguments):b}),k.elem=a,c=c.split(" ");var l,m=0,n;while(l=c[m++]){h=g?f.extend({},g):{handler:d,data:e},l.indexOf(".")>-1?(n=l.split("."),l=n.shift(),h.namespace=n.slice(0).sort().join(".")):(n=[],h.namespace=""),h.type=l,h.guid||(h.guid=d.guid);var o=j[l],p=f.event.special[l]||{};if(!o){o=j[l]=[];if(!p.setup||p.setup.call(a,e,n,k)===!1)a.addEventListener?a.addEventListener(l,k,!1):a.attachEvent&&a.attachEvent("on"+l,k)}p.add&&(p.add.call(a,h),h.handler.guid||(h.handler.guid=d.guid)),o.push(h),f.event.global[l]=!0}a=null}},global:{},remove:function(a,c,d,e){if(a.nodeType!==3&&a.nodeType!==8){d===!1&&(d=C);var g,h,i,j,k=0,l,m,n,o,p,q,r,s=f.hasData(a)&&f._data(a),t=s&&s.events;if(!s||!t)return;c&&c.type&&(d=c.handler,c=c.type);if(!c||typeof c=="string"&&c.charAt(0)==="."){c=c||"";for(h in t)f.event.remove(a,h+c);return}c=c.split(" ");while(h=c[k++]){r=h,q=null,l=h.indexOf(".")<0,m=[],l||(m=h.split("."),h=m.shift(),n=new RegExp("(^|\\.)"+f.map(m.slice(0).sort(),B).join("\\.(?:.*\\.)?")+"(\\.|$)")),p=t[h];if(!p)continue;if(!d){for(j=0;j<p.length;j++){q=p[j];if(l||n.test(q.namespace))f.event.remove(a,r,q.handler,j),p.splice(j--,1)}continue}o=f.event.special[h]||{};for(j=e||0;j<p.length;j++){q=p[j];if(d.guid===q.guid){if(l||n.test(q.namespace))e==null&&p.splice(j--,1),o.remove&&o.remove.call(a,q);if(e!=null)break}}if(p.length===0||e!=null&&p.length===1)(!o.teardown||o.teardown.call(a,m)===!1)&&f.removeEvent(a,h,s.handle),g=null,delete 
t[h]}if(f.isEmptyObject(t)){var u=s.handle;u&&(u.elem=null),delete s.events,delete s.handle,f.isEmptyObject(s)&&f.removeData(a,b,!0)}}},customEvent:{getData:!0,setData:!0,changeData:!0},trigger:function(c,d,e,g){var h=c.type||c,i=[],j;h.indexOf("!")>=0&&(h=h.slice(0,-1),j=!0),h.indexOf(".")>=0&&(i=h.split("."),h=i.shift(),i.sort());if(!!e&&!f.event.customEvent[h]||!!f.event.global[h]){c=typeof c=="object"?c[f.expando]?c:new f.Event(h,c):new f.Event(h),c.type=h,c.exclusive=j,c.namespace=i.join("."),c.namespace_re=new RegExp("(^|\\.)"+i.join("\\.(?:.*\\.)?")+"(\\.|$)");if(g||!e)c.preventDefault(),c.stopPropagation();if(!e){f.each(f.cache,function(){var a=f.expando,b=this[a];b&&b.events&&b.events[h]&&f.event.trigger(c,d,b.handle.elem)});return}if(e.nodeType===3||e.nodeType===8)return;c.result=b,c.target=e,d=d!=null?f.makeArray(d):[],d.unshift(c);var k=e,l=h.indexOf(":")<0?"on"+h:"";do{var m=f._data(k,"handle");c.currentTarget=k,m&&m.apply(k,d),l&&f.acceptData(k)&&k[l]&&k[l].apply(k,d)===!1&&(c.result=!1,c.preventDefault()),k=k.parentNode||k.ownerDocument||k===c.target.ownerDocument&&a}while(k&&!c.isPropagationStopped());if(!c.isDefaultPrevented()){var n,o=f.event.special[h]||{};if((!o._default||o._default.call(e.ownerDocument,c)===!1)&&(h!=="click"||!f.nodeName(e,"a"))&&f.acceptData(e)){try{l&&e[h]&&(n=e[l],n&&(e[l]=null),f.event.triggered=h,e[h]())}catch(p){}n&&(e[l]=n),f.event.triggered=b}}return c.result}},handle:function(c){c=f.event.fix(c||a.event);var d=((f._data(this,"events")||{})[c.type]||[]).slice(0),e=!c.exclusive&&!c.namespace,g=Array.prototype.slice.call(arguments,0);g[0]=c,c.currentTarget=this;for(var h=0,i=d.length;h<i;h++){var j=d[h];if(e||c.namespace_re.test(j.namespace)){c.handler=j.handler,c.data=j.data,c.handleObj=j;var k=j.handler.apply(this,g);k!==b&&(c.result=k,k===!1&&(c.preventDefault(),c.stopPropagation()));if(c.isImmediatePropagationStopped())break}}return c.result},props:"altKey attrChange attrName bubbles button cancelable charCode clientX clientY ctrlKey currentTarget data detail eventPhase fromElement handler keyCode layerX layerY metaKey newValue offsetX offsetY pageX pageY prevValue relatedNode relatedTarget screenX screenY shiftKey srcElement target toElement view wheelDelta which".split(" "),fix:function(a){if(a[f.expando])return a;var d=a;a=f.Event(d);for(var e=this.props.length,g;e;)g=this.props[--e],a[g]=d[g];a.target||(a.target=a.srcElement||c),a.target.nodeType===3&&(a.target=a.target.parentNode),!a.relatedTarget&&a.fromElement&&(a.relatedTarget=a.fromElement===a.target?a.toElement:a.fromElement);if(a.pageX==null&&a.clientX!=null){var h=a.target.ownerDocument||c,i=h.documentElement,j=h.body;a.pageX=a.clientX+(i&&i.scrollLeft||j&&j.scrollLeft||0)-(i&&i.clientLeft||j&&j.clientLeft||0),a.pageY=a.clientY+(i&&i.scrollTop||j&&j.scrollTop||0)-(i&&i.clientTop||j&&j.clientTop||0)}a.which==null&&(a.charCode!=null||a.keyCode!=null)&&(a.which=a.charCode!=null?a.charCode:a.keyCode),!a.metaKey&&a.ctrlKey&&(a.metaKey=a.ctrlKey),!a.which&&a.button!==b&&(a.which=a.button&1?1:a.button&2?3:a.button&4?2:0);return a},guid:1e8,proxy:f.proxy,special:{ready:{setup:f.bindReady,teardown:f.noop},live:{add:function(a){f.event.add(this,M(a.origType,a.selector),f.extend({},a,{handler:L,guid:a.handler.guid}))},remove:function(a){f.event.remove(this,M(a.origType,a.selector),a)}},beforeunload:{setup:function(a,b,c){f.isWindow(this)&&(this.onbeforeunload=c)},teardown:function(a,b){this.onbeforeunload===b&&(this.onbeforeunload=null)}}}},f.removeEvent=c.removeEventListener?function(a,b,c){a.removeEventListener&&a.removeEventListener(b,c,!1)}:function(a,b,c){a.detachEvent&&a.detachEvent("on"+b,c)},f.Event=function(a,b){if(!this.preventDefault)return new f.Event(a,b);a&&a.type?(this.originalEvent=a,this.type=a.type,this.isDefaultPrevented=a.defaultPrevented||a.returnValue===!1||a.getPreventDefault&&a.getPreventDefault()?D:C):this.type=a,b&&f.extend(this,b),this.timeStamp=f.now(),this[f.expando]=!0},f.Event.prototype={preventDefault:function(){this.isDefaultPrevented=D;var a=this.originalEvent;!a||(a.preventDefault?a.preventDefault():a.returnValue=!1)},stopPropagation:function(){this.isPropagationStopped=D;var a=this.originalEvent;!a||(a.stopPropagation&&a.stopPropagation(),a.cancelBubble=!0)},stopImmediatePropagation:function(){this.isImmediatePropagationStopped=D,this.stopPropagation()},isDefaultPrevented:C,isPropagationStopped:C,isImmediatePropagationStopped:C};var E=function(a){var b=a.relatedTarget,c=!1,d=a.type;a.type=a.data,b!==this&&(b&&(c=f.contains(this,b)),c||(f.event.handle.apply(this,arguments),a.type=d))},F=function(a){a.type=a.data,f.event.handle.apply(this,arguments)};f.each({mouseenter:"mouseover",mouseleave:"mouseout"},function(a,b){f.event.special[a]={setup:function(c){f.event.add(this,b,c&&c.selector?F:E,a)},teardown:function(a){f.event.remove(this,b,a&&a.selector?F:E)}}}),f.support.submitBubbles||(f.event.special.submit={setup:function(a,b){if(!f.nodeName(this,"form"))f.event.add(this,"click.specialSubmit",function(a){var b=a.target,c=f.nodeName(b,"input")||f.nodeName(b,"button")?b.type:"";(c==="submit"||c==="image")&&f(b).closest("form").length&&J("submit",this,arguments)}),f.event.add(this,"keypress.specialSubmit",function(a){var b=a.target,c=f.nodeName(b,"input")||f.nodeName(b,"button")?b.type:"";(c==="text"||c==="password")&&f(b).closest("form").length&&a.keyCode===13&&J("submit",this,arguments)});else return!1},teardown:function(a){f.event.remove(this,".specialSubmit")}});if(!f.support.changeBubbles){var G,H=function(a){var b=f.nodeName(a,"input")?a.type:"",c=a.value;b==="radio"||b==="checkbox"?c=a.checked:b==="select-multiple"?c=a.selectedIndex>-1?f.map(a.options,function(a){return a.selected}).join("-"):"":f.nodeName(a,"select")&&(c=a.selectedIndex);return c},I=function(c){var d=c.target,e,g;if(!!x.test(d.nodeName)&&!d.readOnly){e=f._data(d,"_change_data"),g=H(d),(c.type!=="focusout"||d.type!=="radio")&&f._data(d,"_change_data",g);if(e===b||g===e)return;if(e!=null||g)c.type="change",c.liveFired=b,f.event.trigger(c,arguments[1],d)}};f.event.special.change={filters:{focusout:I,beforedeactivate:I,click:function(a){var b=a.target,c=f.nodeName(b,"input")?b.type:"";(c==="radio"||c==="checkbox"||f.nodeName(b,"select"))&&I.call(this,a)},keydown:function(a){var b=a.target,c=f.nodeName(b,"input")?b.type:"";(a.keyCode===13&&!f.nodeName(b,"textarea")||a.keyCode===32&&(c==="checkbox"||c==="radio")||c==="select-multiple")&&I.call(this,a)},beforeactivate:function(a){var b=a.target;f._data(b,"_change_data",H(b))}},setup:function(a,b){if(this.type==="file")return!1;for(var c in G)f.event.add(this,c+".specialChange",G[c]);return x.test(this.nodeName)},teardown:function(a){f.event.remove(this,".specialChange");return x.test(this.nodeName)}},G=f.event.special.change.filters,G.focus=G.beforeactivate}f.support.focusinBubbles||f.each({focus:"focusin",blur:"focusout"},function(a,b){function e(a){var c=f.event.fix(a);c.type=b,c.originalEvent={},f.event.trigger(c,null,c.target),c.isDefaultPrevented()&&a.preventDefault()}var d=0;f.event.special[b]={setup:function(){d++===0&&c.addEventListener(a,e,!0)},teardown:function(){--d===0&&c.removeEventListener(a,e,!0)}}}),f.each(["bind","one"],function(a,c){f.fn[c]=function(a,d,e){var g;if(typeof a=="object"){for(var h in a)this[c](h,d,a[h],e);return this}if(arguments.length===2||d===!1)e=d,d=b;c==="one"?(g=function(a){f(this).unbind(a,g);return e.apply(this,arguments)},g.guid=e.guid||f.guid++):g=e;if(a==="unload"&&c!=="one")this.one(a,d,e);else for(var i=0,j=this.length;i<j;i++)f.event.add(this[i],a,g,d);return this}}),f.fn.extend({unbind:function(a,b){if(typeof a=="object"&&!a.preventDefault)for(var c in a)this.unbind(c,a[c]);else for(var d=0,e=this.length;d<e;d++)f.event.remove(this[d],a,b);return this},delegate:function(a,b,c,d){return this.live(b,c,d,a)},undelegate:function(a,b,c){return arguments.length===0?this.unbind("live"):this.die(b,null,c,a)},trigger:function(a,b){return this.each(function(){f.event.trigger(a,b,this)})},triggerHandler:function(a,b){if(this[0])return f.event.trigger(a,b,this[0],!0)},toggle:function(a){var b=arguments,c=a.guid||f.guid++,d=0,e=function(c){var e=(f.data(this,"lastToggle"+a.guid)||0)%d;f.data(this,"lastToggle"+a.guid,e+1),c.preventDefault();return b[e].apply(this,arguments)||!1};e.guid=c;while(d<b.length)b[d++].guid=c;return this.click(e)},hover:function(a,b){return this.mouseenter(a).mouseleave(b||a)}});var K={focus:"focusin",blur:"focusout",mouseenter:"mouseover",mouseleave:"mouseout"};f.each(["live","die"],function(a,c){f.fn[c]=function(a,d,e,g){var h,i=0,j,k,l,m=g||this.selector,n=g?this:f(this.context);if(typeof a=="object"&&!a.preventDefault){for(var o in a)n[c](o,d,a[o],m);return this}if(c==="die"&&!a&&g&&g.charAt(0)==="."){n.unbind(g);return this}if(d===!1||f.isFunction(d))e=d||C,d=b;a=(a||"").split(" ");while((h=a[i++])!=null){j=w.exec(h),k="",j&&(k=j[0],h=h.replace(w,""));if(h==="hover"){a.push("mouseenter"+k,"mouseleave"+k);continue}l=h,K[h]?(a.push(K[h]+k),h=h+k):h=(K[h]||h)+k;if(c==="live")for(var p=0,q=n.length;p<q;p++)f.event.add(n[p],"live."+M(h,m),{data:d,selector:m,handler:e,origType:h,origHandler:e,preType:l});else n.unbind("live."+M(h,m),e)}return this}}),f.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error".split(" "),function(a,b){f.fn[b]=function(a,c){c==null&&(c=a,a=null);return arguments.length>0?this.bind(b,a,c):this.trigger(b)},f.attrFn&&(f.attrFn[b]=!0)}),function(){function u(a,b,c,d,e,f){for(var g=0,h=d.length;g<h;g++){var i=d[g];if(i){var j=!1;i=i[a];while(i){if(i.sizcache===c){j=d[i.sizset];break}if(i.nodeType===1){f||(i.sizcache=c,i.sizset=g);if(typeof b!="string"){if(i===b){j=!0;break}}else if(k.filter(b,[i]).length>0){j=i;break}}i=i[a]}d[g]=j}}}function t(a,b,c,d,e,f){for(var g=0,h=d.length;g<h;g++){var i=d[g];if(i){var j=!1;i=i[a];while(i){if(i.sizcache===c){j=d[i.sizset];break}i.nodeType===1&&!f&&(i.sizcache=c,i.sizset=g);if(i.nodeName.toLowerCase()===b){j=i;break}i=i[a]}d[g]=j}}}var a=/((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,d=0,e=Object.prototype.toString,g=!1,h=!0,i=/\\/g,j=/\W/;[0,0].sort(function(){h=!1;return 0});var k=function(b,d,f,g){f=f||[],d=d||c;var h=d;if(d.nodeType!==1&&d.nodeType!==9)return[];if(!b||typeof b!="string")return f;var i,j,n,o,q,r,s,t,u=!0,w=k.isXML(d),x=[],y=b;do{a.exec(""),i=a.exec(y);if(i){y=i[3],x.push(i[1]);if(i[2]){o=i[3];break}}}while(i);if(x.length>1&&m.exec(b))if(x.length===2&&l.relative[x[0]])j=v(x[0]+x[1],d);else{j=l.relative[x[0]]?[d]:k(x.shift(),d);while(x.length)b=x.shift(),l.relative[b]&&(b+=x.shift()),j=v(b,j)}else{!g&&x.length>1&&d.nodeType===9&&!w&&l.match.ID.test(x[0])&&!l.match.ID.test(x[x.length-1])&&(q=k.find(x.shift(),d,w),d=q.expr?k.filter(q.expr,q.set)[0]:q.set[0]);if(d){q=g?{expr:x.pop(),set:p(g)}:k.find(x.pop(),x.length===1&&(x[0]==="~"||x[0]==="+")&&d.parentNode?d.parentNode:d,w),j=q.expr?k.filter(q.expr,q.set):q.set,x.length>0?n=p(j):u=!1;while(x.length)r=x.pop(),s=r,l.relative[r]?s=x.pop():r="",s==null&&(s=d),l.relative[r](n,s,w)}else n=x=[]}n||(n=j),n||k.error(r||b);if(e.call(n)==="[object Array]")if(!u)f.push.apply(f,n);else if(d&&d.nodeType===1)for(t=0;n[t]!=null;t++)n[t]&&(n[t]===!0||n[t].nodeType===1&&k.contains(d,n[t]))&&f.push(j[t]);else for(t=0;n[t]!=null;t++)n[t]&&n[t].nodeType===1&&f.push(j[t]);else p(n,f);o&&(k(o,h,f,g),k.uniqueSort(f));return f};k.uniqueSort=function(a){if(r){g=h,a.sort(r);if(g)for(var b=1;b<a.length;b++)a[b]===a[b-1]&&a.splice(b--,1)}return a},k.matches=function(a,b){return k(a,null,null,b)},k.matchesSelector=function(a,b){return k(b,null,null,[a]).length>0},k.find=function(a,b,c){var d;if(!a)return[];for(var e=0,f=l.order.length;e<f;e++){var g,h=l.order[e];if(g=l.leftMatch[h].exec(a)){var j=g[1];g.splice(1,1);if(j.substr(j.length-1)!=="\\"){g[1]=(g[1]||"").replace(i,""),d=l.find[h](g,b,c);if(d!=null){a=a.replace(l.match[h],"");break}}}}d||(d=typeof b.getElementsByTagName!="undefined"?b.getElementsByTagName("*"):[]);return{set:d,expr:a}},k.filter=function(a,c,d,e){var f,g,h=a,i=[],j=c,m=c&&c[0]&&k.isXML(c[0]);while(a&&c.length){for(var n in l.filter)if((f=l.leftMatch[n].exec(a))!=null&&f[2]){var o,p,q=l.filter[n],r=f[1];g=!1,f.splice(1,1);if(r.substr(r.length-1)==="\\")continue;j===i&&(i=[]);if(l.preFilter[n]){f=l.preFilter[n](f,j,d,i,e,m);if(!f)g=o=!0;else if(f===!0)continue}if(f)for(var s=0;(p=j[s])!=null;s++)if(p){o=q(p,f,s,j);var t=e^!!o;d&&o!=null?t?g=!0:j[s]=!1:t&&(i.push(p),g=!0)}if(o!==b){d||(j=i),a=a.replace(l.match[n],"");if(!g)return[];break}}if(a===h)if(g==null)k.error(a);else break;h=a}return j},k.error=function(a){throw"Syntax error, unrecognized expression: "+a};var l=k.selectors={order:["ID","NAME","TAG"],match:{ID:/#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,CLASS:/\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,NAME:/\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/,ATTR:/\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(?:(['"])(.*?)\3|(#?(?:[\w\u00c0-\uFFFF\-]|\\.)*)|)|)\s*\]/,TAG:/^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/,CHILD:/:(only|nth|last|first)-child(?:\(\s*(even|odd|(?:[+\-]?\d+|(?:[+\-]?\d*)?n\s*(?:[+\-]\s*\d+)?))\s*\))?/,POS:/:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/,PSEUDO:/:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/},leftMatch:{},attrMap:{"class":"className","for":"htmlFor"},attrHandle:{href:function(a){return a.getAttribute("href")},type:function(a){return a.getAttribute("type")}},relative:{"+":function(a,b){var c=typeof b=="string",d=c&&!j.test(b),e=c&&!d;d&&(b=b.toLowerCase());for(var f=0,g=a.length,h;f<g;f++)if(h=a[f]){while((h=h.previousSibling)&&h.nodeType!==1);a[f]=e||h&&h.nodeName.toLowerCase()===b?h||!1:h===b}e&&k.filter(b,a,!0)},">":function(a,b){var c,d=typeof b=="string",e=0,f=a.length;if(d&&!j.test(b)){b=b.toLowerCase();for(;e<f;e++){c=a[e];if(c){var g=c.parentNode;a[e]=g.nodeName.toLowerCase()===b?g:!1}}}else{for(;e<f;e++)c=a[e],c&&(a[e]=d?c.parentNode:c.parentNode===b);d&&k.filter(b,a,!0)}},"":function(a,b,c){var e,f=d++,g=u;typeof b=="string"&&!j.test(b)&&(b=b.toLowerCase(),e=b,g=t),g("parentNode",b,f,a,e,c)},"~":function(a,b,c){var e,f=d++,g=u;typeof b=="string"&&!j.test(b)&&(b=b.toLowerCase(),e=b,g=t),g("previousSibling",b,f,a,e,c)}},find:{ID:function(a,b,c){if(typeof b.getElementById!="undefined"&&!c){var d=b.getElementById(a[1]);return d&&d.parentNode?[d]:[]}},NAME:function(a,b){if(typeof b.getElementsByName!="undefined"){var c=[],d=b.getElementsByName(a[1]);for(var e=0,f=d.length;e<f;e++)d[e].getAttribute("name")===a[1]&&c.push(d[e]);return c.length===0?null:c}},TAG:function(a,b){if(typeof b.getElementsByTagName!="undefined")return b.getElementsByTagName(a[1])}},preFilter:{CLASS:function(a,b,c,d,e,f){a=" "+a[1].replace(i,"")+" ";if(f)return a;for(var g=0,h;(h=b[g])!=null;g++)h&&(e^(h.className&&(" "+h.className+" ").replace(/[\t\n\r]/g," ").indexOf(a)>=0)?c||d.push(h):c&&(b[g]=!1));return!1},ID:function(a){return a[1].replace(i,"")},TAG:function(a,b){return a[1].replace(i,"").toLowerCase()},CHILD:function(a){if(a[1]==="nth"){a[2]||k.error(a[0]),a[2]=a[2].replace(/^\+|\s*/g,"");var b=/(-?)(\d*)(?:n([+\-]?\d*))?/.exec(a[2]==="even"&&"2n"||a[2]==="odd"&&"2n+1"||!/\D/.test(a[2])&&"0n+"+a[2]||a[2]);a[2]=b[1]+(b[2]||1)-0,a[3]=b[3]-0}else a[2]&&k.error(a[0]);a[0]=d++;return a},ATTR:function(a,b,c,d,e,f){var g=a[1]=a[1].replace(i,"");!f&&l.attrMap[g]&&(a[1]=l.attrMap[g]),a[4]=(a[4]||a[5]||"").replace(i,""),a[2]==="~="&&(a[4]=" "+a[4]+" ");return a},PSEUDO:function(b,c,d,e,f){if(b[1]==="not")if((a.exec(b[3])||"").length>1||/^\w/.test(b[3]))b[3]=k(b[3],null,null,c);else{var g=k.filter(b[3],c,d,!0^f);d||e.push.apply(e,g);return!1}else if(l.match.POS.test(b[0])||l.match.CHILD.test(b[0]))return!0;return b},POS:function(a){a.unshift(!0);return a}},filters:{enabled:function(a){return a.disabled===!1&&a.type!=="hidden"},disabled:function(a){return a.disabled===!0},checked:function(a){return a.checked===!0},selected:function(a){a.parentNode&&a.parentNode.selectedIndex;return a.selected===!0},parent:function(a){return!!a.firstChild},empty:function(a){return!a.firstChild},has:function(a,b,c){return!!k(c[3],a).length},header:function(a){return/h\d/i.test(a.nodeName)},text:function(a){var b=a.getAttribute("type"),c=a.type;return a.nodeName.toLowerCase()==="input"&&"text"===c&&(b===c||b===null)},radio:function(a){return a.nodeName.toLowerCase()==="input"&&"radio"===a.type},checkbox:function(a){return a.nodeName.toLowerCase()==="input"&&"checkbox"===a.type},file:function(a){return a.nodeName.toLowerCase()==="input"&&"file"===a.type},password:function(a){return a.nodeName.toLowerCase()==="input"&&"password"===a.type},submit:function(a){var b=a.nodeName.toLowerCase();return(b==="input"||b==="button")&&"submit"===a.type},image:function(a){return a.nodeName.toLowerCase()==="input"&&"image"===a.type},reset:function(a){var b=a.nodeName.toLowerCase();return(b==="input"||b==="button")&&"reset"===a.type},button:function(a){var b=a.nodeName.toLowerCase();return b==="input"&&"button"===a.type||b==="button"},input:function(a){return/input|select|textarea|button/i.test(a.nodeName)},focus:function(a){return a===a.ownerDocument.activeElement}},setFilters:{first:function(a,b){return b===0},last:function(a,b,c,d){return b===d.length-1},even:function(a,b){return b%2===0},odd:function(a,b){return b%2===1},lt:function(a,b,c){return b<c[3]-0},gt:function(a,b,c){return b>c[3]-0},nth:function(a,b,c){return c[3]-0===b},eq:function(a,b,c){return c[3]-0===b}},filter:{PSEUDO:function(a,b,c,d){var e=b[1],f=l.filters[e];if(f)return f(a,c,b,d);if(e==="contains")return(a.textContent||a.innerText||k.getText([a])||"").indexOf(b[3])>=0;if(e==="not"){var g=b[3];for(var h=0,i=g.length;h<i;h++)if(g[h]===a)return!1;return!0}k.error(e)},CHILD:function(a,b){var c=b[1],d=a;switch(c){case"only":case"first":while(d=d.previousSibling)if(d.nodeType===1)return!1;if(c==="first")return!0;d=a;case"last":while(d=d.nextSibling)if(d.nodeType===1)return!1;return!0;case"nth":var e=b[2],f=b[3];if(e===1&&f===0)return!0;var g=b[0],h=a.parentNode;if(h&&(h.sizcache!==g||!a.nodeIndex)){var i=0;for(d=h.firstChild;d;d=d.nextSibling)d.nodeType===1&&(d.nodeIndex=++i);h.sizcache=g}var j=a.nodeIndex-f;return e===0?j===0:j%e===0&&j/e>=0}},ID:function(a,b){return a.nodeType===1&&a.getAttribute("id")===b},TAG:function(a,b){return b==="*"&&a.nodeType===1||a.nodeName.toLowerCase()===b},CLASS:function(a,b){return(" "+(a.className||a.getAttribute("class"))+" ").indexOf(b)>-1},ATTR:function(a,b){var c=b[1],d=l.attrHandle[c]?l.attrHandle[c](a):a[c]!=null?a[c]:a.getAttribute(c),e=d+"",f=b[2],g=b[4];return d==null?f==="!=":f==="="?e===g:f==="*="?e.indexOf(g)>=0:f==="~="?(" "+e+" ").indexOf(g)>=0:g?f==="!="?e!==g:f==="^="?e.indexOf(g)===0:f==="$="?e.substr(e.length-g.length)===g:f==="|="?e===g||e.substr(0,g.length+1)===g+"-":!1:e&&d!==!1},POS:function(a,b,c,d){var e=b[2],f=l.setFilters[e];if(f)return f(a,c,b,d)}}},m=l.match.POS,n=function(a,b){return"\\"+(b-0+1)};for(var o in l.match)l.match[o]=new RegExp(l.match[o].source+/(?![^\[]*\])(?![^\(]*\))/.source),l.leftMatch[o]=new RegExp(/(^(?:.|\r|\n)*?)/.source+l.match[o].source.replace(/\\(\d+)/g,n));var p=function(a,b){a=Array.prototype.slice.call(a,0);if(b){b.push.apply(b,a);return b}return a};try{Array.prototype.slice.call(c.documentElement.childNodes,0)[0].nodeType}catch(q){p=function(a,b){var c=0,d=b||[];if(e.call(a)==="[object Array]")Array.prototype.push.apply(d,a);else if(typeof a.length=="number")for(var f=a.length;c<f;c++)d.push(a[c]);else for(;a[c];c++)d.push(a[c]);return d}}var r,s;c.documentElement.compareDocumentPosition?r=function(a,b){if(a===b){g=!0;return 0}if(!a.compareDocumentPosition||!b.compareDocumentPosition)return a.compareDocumentPosition?-1:1;return a.compareDocumentPosition(b)&4?-1:1}:(r=function(a,b){if(a===b){g=!0;return 0}if(a.sourceIndex&&b.sourceIndex)return a.sourceIndex-b.sourceIndex;var c,d,e=[],f=[],h=a.parentNode,i=b.parentNode,j=h;if(h===i)return s(a,b);if(!h)return-1;if(!i)return 1;while(j)e.unshift(j),j=j.parentNode;j=i;while(j)f.unshift(j),j=j.parentNode;c=e.length,d=f.length;for(var k=0;k<c&&k<d;k++)if(e[k]!==f[k])return s(e[k],f[k]);return k===c?s(a,f[k],-1):s(e[k],b,1)},s=function(a,b,c){if(a===b)return c;var d=a.nextSibling;while(d){if(d===b)return-1;d=d.nextSibling}return 1}),k.getText=function(a){var b="",c;for(var d=0;a[d];d++)c=a[d],c.nodeType===3||c.nodeType===4?b+=c.nodeValue:c.nodeType!==8&&(b+=k.getText(c.childNodes));return b},function(){var a=c.createElement("div"),d="script"+(new Date).getTime(),e=c.documentElement;a.innerHTML="<a name='"+d+"'/>",e.insertBefore(a,e.firstChild),c.getElementById(d)&&(l.find.ID=function(a,c,d){if(typeof c.getElementById!="undefined"&&!d){var e=c.getElementById(a[1]);return e?e.id===a[1]||typeof e.getAttributeNode!="undefined"&&e.getAttributeNode("id").nodeValue===a[1]?[e]:b:[]}},l.filter.ID=function(a,b){var c=typeof a.getAttributeNode!="undefined"&&a.getAttributeNode("id");return a.nodeType===1&&c&&c.nodeValue===b}),e.removeChild(a),e=a=null}(),function(){var a=c.createElement("div");a.appendChild(c.createComment("")),a.getElementsByTagName("*").length>0&&(l.find.TAG=function(a,b){var c=b.getElementsByTagName(a[1]);if(a[1]==="*"){var d=[];for(var e=0;c[e];e++)c[e].nodeType===1&&d.push(c[e]);c=d}return c}),a.innerHTML="<a href='#'></a>",a.firstChild&&typeof a.firstChild.getAttribute!="undefined"&&a.firstChild.getAttribute("href")!=="#"&&(l.attrHandle.href=function(a){return a.getAttribute("href",2)}),a=null}(),c.querySelectorAll&&function(){var a=k,b=c.createElement("div"),d="__sizzle__";b.innerHTML="<p class='TEST'></p>";if(!b.querySelectorAll||b.querySelectorAll(".TEST").length!==0){k=function(b,e,f,g){e=e||c;if(!g&&!k.isXML(e)){var h=/^(\w+$)|^\.([\w\-]+$)|^#([\w\-]+$)/.exec(b);if(h&&(e.nodeType===1||e.nodeType===9)){if(h[1])return p(e.getElementsByTagName(b),f);if(h[2]&&l.find.CLASS&&e.getElementsByClassName)return p(e.getElementsByClassName(h[2]),f)}if(e.nodeType===9){if(b==="body"&&e.body)return p([e.body],f);if(h&&h[3]){var i=e.getElementById(h[3]);if(!i||!i.parentNode)return p([],f);if(i.id===h[3])return p([i],f)}try{return p(e.querySelectorAll(b),f)}catch(j){}}else if(e.nodeType===1&&e.nodeName.toLowerCase()!=="object"){var m=e,n=e.getAttribute("id"),o=n||d,q=e.parentNode,r=/^\s*[+~]/.test(b);n?o=o.replace(/'/g,"\\$&"):e.setAttribute("id",o),r&&q&&(e=e.parentNode);try{if(!r||q)return p(e.querySelectorAll("[id='"+o+"'] "+b),f)}catch(s){}finally{n||m.removeAttribute("id")}}}return a(b,e,f,g)};for(var e in a)k[e]=a[e];b=null}}(),function(){var a=c.documentElement,b=a.matchesSelector||a.mozMatchesSelector||a.webkitMatchesSelector||a.msMatchesSelector;if(b){var d=!b.call(c.createElement("div"),"div"),e=!1;try{b.call(c.documentElement,"[test!='']:sizzle")}catch(f){e=!0}k.matchesSelector=function(a,c){c=c.replace(/\=\s*([^'"\]]*)\s*\]/g,"='$1']");if(!k.isXML(a))try{if(e||!l.match.PSEUDO.test(c)&&!/!=/.test(c)){var f=b.call(a,c);if(f||!d||a.document&&a.document.nodeType!==11)return f}}catch(g){}return k(c,null,null,[a]).length>0}}}(),function(){var a=c.createElement("div");a.innerHTML="<div class='test e'></div><div class='test'></div>";if(!!a.getElementsByClassName&&a.getElementsByClassName("e").length!==0){a.lastChild.className="e";if(a.getElementsByClassName("e").length===1)return;l.order.splice(1,0,"CLASS"),l.find.CLASS=function(a,b,c){if(typeof b.getElementsByClassName!="undefined"&&!c)return b.getElementsByClassName(a[1])},a=null}}(),c.documentElement.contains?k.contains=function(a,b){return a!==b&&(a.contains?a.contains(b):!0)}:c.documentElement.compareDocumentPosition?k.contains=function(a,b){return!!(a.compareDocumentPosition(b)&16)}:k.contains=function(){return!1},k.isXML=function(a){var b=(a?a.ownerDocument||a:0).documentElement;return b?b.nodeName!=="HTML":!1};var v=function(a,b){var c,d=[],e="",f=b.nodeType?[b]:b;while(c=l.match.PSEUDO.exec(a))e+=c[0],a=a.replace(l.match.PSEUDO,"");a=l.relative[a]?a+"*":a;for(var g=0,h=f.length;g<h;g++)k(a,f[g],d);return k.filter(e,d)};f.find=k,f.expr=k.selectors,f.expr[":"]=f.expr.filters,f.unique=k.uniqueSort,f.text=k.getText,f.isXMLDoc=k.isXML,f.contains=k.contains}();var N=/Until$/,O=/^(?:parents|prevUntil|prevAll)/,P=/,/,Q=/^.[^:#\[\.,]*$/,R=Array.prototype.slice,S=f.expr.match.POS,T={children:!0,contents:!0,next:!0,prev:!0};f.fn.extend({find:function(a){var b=this,c,d;if(typeof a!="string")return f(a).filter(function(){for(c=0,d=b.length;c<d;c++)if(f.contains(b[c],this))return!0});var e=this.pushStack("","find",a),g,h,i;for(c=0,d=this.length;c<d;c++){g=e.length,f.find(a,this[c],e);if(c>0)for(h=g;h<e.length;h++)for(i=0;i<g;i++)if(e[i]===e[h]){e.splice(h--,1);break}}return e},has:function(a){var b=f(a);return this.filter(function(){for(var a=0,c=b.length;a<c;a++)if(f.contains(this,b[a]))return!0})},not:function(a){return this.pushStack(V(this,a,!1),"not",a)},filter:function(a){return this.pushStack(V(this,a,!0),"filter",a)},is:function(a){return!!a&&(typeof a=="string"?f.filter(a,this).length>0:this.filter(a).length>0)},closest:function(a,b){var c=[],d,e,g=this[0];if(f.isArray(a)){var h,i,j={},k=1;if(g&&a.length){for(d=0,e=a.length;d<e;d++)i=a[d],j[i]||(j[i]=S.test(i)?f(i,b||this.context):i);while(g&&g.ownerDocument&&g!==b){for(i in j)h=j[i],(h.jquery?h.index(g)>-1:f(g).is(h))&&c.push({selector:i,elem:g,level:k});g=g.parentNode,k++}}return c}var l=S.test(a)||typeof a!="string"?f(a,b||this.context):0;for(d=0,e=this.length;d<e;d++){g=this[d];while(g){if(l?l.index(g)>-1:f.find.matchesSelector(g,a)){c.push(g);break}g=g.parentNode;if(!g||!g.ownerDocument||g===b||g.nodeType===11)break}}c=c.length>1?f.unique(c):c;return this.pushStack(c,"closest",a)},index:function(a){if(!a)return this[0]&&this[0].parentNode?this.prevAll().length:-1;if(typeof a=="string")return f.inArray(this[0],f(a));return f.inArray(a.jquery?a[0]:a,this)},add:function(a,b){var c=typeof a=="string"?f(a,b):f.makeArray(a&&a.nodeType?[a]:a),d=f.merge(this.get(),c);return this.pushStack(U(c[0])||U(d[0])?d:f.unique(d))},andSelf:function(){return this.add(this.prevObject)}}),f.each({parent:function(a){var b=a.parentNode;return b&&b.nodeType!==11?b:null},parents:function(a){return f.dir(a,"parentNode")},parentsUntil:function(a,b,c){return f.dir(a,"parentNode",c)},next:function(a){return f.nth(a,2,"nextSibling")},prev:function(a){return f.nth(a,2,"previousSibling")},nextAll:function(a){return f.dir(a,"nextSibling")},prevAll:function(a){return f.dir(a,"previousSibling")},nextUntil:function(a,b,c){return f.dir(a,"nextSibling",c)},prevUntil:function(a,b,c){return f.dir(a,"previousSibling",c)},siblings:function(a){return f.sibling(a.parentNode.firstChild,a)},children:function(a){return f.sibling(a.firstChild)},contents:function(a){return f.nodeName(a,"iframe")?a.contentDocument||a.contentWindow.document:f.makeArray(a.childNodes)}},function(a,b){f.fn[a]=function(c,d){var e=f.map(this,b,c),g=R.call(arguments);N.test(a)||(d=c),d&&typeof d=="string"&&(e=f.filter(d,e)),e=this.length>1&&!T[a]?f.unique(e):e,(this.length>1||P.test(d))&&O.test(a)&&(e=e.reverse());return this.pushStack(e,a,g.join(","))}}),f.extend({filter:function(a,b,c){c&&(a=":not("+a+")");return b.length===1?f.find.matchesSelector(b[0],a)?[b[0]]:[]:f.find.matches(a,b)},dir:function(a,c,d){var e=[],g=a[c];while(g&&g.nodeType!==9&&(d===b||g.nodeType!==1||!f(g).is(d)))g.nodeType===1&&e.push(g),g=g[c];return e},nth:function(a,b,c,d){b=b||1;var e=0;for(;a;a=a[c])if(a.nodeType===1&&++e===b)break;return a},sibling:function(a,b){var c=[];for(;a;a=a.nextSibling)a.nodeType===1&&a!==b&&c.push(a);return c}});var W=/ jQuery\d+="(?:\d+|null)"/g,X=/^\s+/,Y=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/ig,Z=/<([\w:]+)/,$=/<tbody/i,_=/<|&#?\w+;/,ba=/<(?:script|object|embed|option|style)/i,bb=/checked\s*(?:[^=]|=\s*.checked.)/i,bc=/\/(java|ecma)script/i,bd=/^\s*<!(?:\[CDATA\[|\-\-)/,be={option:[1,"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],area:[1,"<map>","</map>"],_default:[0,"",""]};be.optgroup=be.option,be.tbody=be.tfoot=be.colgroup=be.caption=be.thead,be.th=be.td,f.support.htmlSerialize||(be._default=[1,"div<div>","</div>"]),f.fn.extend({text:function(a){if(f.isFunction(a))return this.each(function(b){var c=f(this);c.text(a.call(this,b,c.text()))});if(typeof a!="object"&&a!==b)return this.empty().append((this[0]&&this[0].ownerDocument||c).createTextNode(a));return f.text(this)},wrapAll:function(a){if(f.isFunction(a))return this.each(function(b){f(this).wrapAll(a.call(this,b))});if(this[0]){var b=f(a,this[0].ownerDocument).eq(0).clone(!0);this[0].parentNode&&b.insertBefore(this[0]),b.map(function(){var a=this;while(a.firstChild&&a.firstChild.nodeType===1)a=a.firstChild;return a}).append(this)}return this},wrapInner:function(a){if(f.isFunction(a))return this.each(function(b){f(this).wrapInner(a.call(this,b))});return this.each(function(){var b=f(this),c=b.contents();c.length?c.wrapAll(a):b.append(a)})},wrap:function(a){return this.each(function(){f(this).wrapAll(a)})},unwrap:function(){return this.parent().each(function(){f.nodeName(this,"body")||f(this).replaceWith(this.childNodes)}).end()},append:function(){return this.domManip(arguments,!0,function(a){this.nodeType===1&&this.appendChild(a)})},prepend:function(){return this.domManip(arguments,!0,function(a){this.nodeType===1&&this.insertBefore(a,this.firstChild)})},before:function(){if(this[0]&&this[0].parentNode)return this.domManip(arguments,!1,function(a){this.parentNode.insertBefore(a,this)});if(arguments.length){var a=f(arguments[0]);a.push.apply(a,this.toArray());return this.pushStack(a,"before",arguments)}},after:function(){if(this[0]&&this[0].parentNode)return this.domManip(arguments,!1,function(a){this.parentNode.insertBefore(a,this.nextSibling)});if(arguments.length){var a=this.pushStack(this,"after",arguments);a.push.apply(a,f(arguments[0]).toArray());return a}},remove:function(a,b){for(var c=0,d;(d=this[c])!=null;c++)if(!a||f.filter(a,[d]).length)!b&&d.nodeType===1&&(f.cleanData(d.getElementsByTagName("*")),f.cleanData([d])),d.parentNode&&d.parentNode.removeChild(d);return this},empty:function(){for(var a=0,b;(b=this[a])!=null;a++){b.nodeType===1&&f.cleanData(b.getElementsByTagName("*"));while(b.firstChild)b.removeChild(b.firstChild)}return this},clone:function(a,b){a=a==null?!1:a,b=b==null?a:b;return this.map(function(){return f.clone(this,a,b)})},html:function(a){if(a===b)return this[0]&&this[0].nodeType===1?this[0].innerHTML.replace(W,""):null;if(typeof a=="string"&&!ba.test(a)&&(f.support.leadingWhitespace||!X.test(a))&&!be[(Z.exec(a)||["",""])[1].toLowerCase()]){a=a.replace(Y,"<$1></$2>");try{for(var c=0,d=this.length;c<d;c++)this[c].nodeType===1&&(f.cleanData(this[c].getElementsByTagName("*")),this[c].innerHTML=a)}catch(e){this.empty().append(a)}}else f.isFunction(a)?this.each(function(b){var c=f(this);c.html(a.call(this,b,c.html()))}):this.empty().append(a);return this},replaceWith:function(a){if(this[0]&&this[0].parentNode){if(f.isFunction(a))return this.each(function(b){var c=f(this),d=c.html();c.replaceWith(a.call(this,b,d))});typeof a!="string"&&(a=f(a).detach());return this.each(function(){var b=this.nextSibling,c=this.parentNode;f(this).remove(),b?f(b).before(a):f(c).append(a)})}return this.length?this.pushStack(f(f.isFunction(a)?a():a),"replaceWith",a):this},detach:function(a){return this.remove(a,!0)},domManip:function(a,c,d){var e,g,h,i,j=a[0],k=[];if(!f.support.checkClone&&arguments.length===3&&typeof j=="string"&&bb.test(j))return this.each(function(){f(this).domManip(a,c,d,!0)});if(f.isFunction(j))return this.each(function(e){var g=f(this);a[0]=j.call(this,e,c?g.html():b),g.domManip(a,c,d)});if(this[0]){i=j&&j.parentNode,f.support.parentNode&&i&&i.nodeType===11&&i.childNodes.length===this.length?e={fragment:i}:e=f.buildFragment(a,this,k),h=e.fragment,h.childNodes.length===1?g=h=h.firstChild:g=h.firstChild;if(g){c=c&&f.nodeName(g,"tr");for(var l=0,m=this.length,n=m-1;l<m;l++)d.call(c?bf(this[l],g):this[l],e.cacheable||m>1&&l<n?f.clone(h,!0,!0):h)}k.length&&f.each(k,bl)}return this}}),f.buildFragment=function(a,b,d){var e,g,h,i;b&&b[0]&&(i=b[0].ownerDocument||b[0]),i.createDocumentFragment||(i=c),a.length===1&&typeof a[0]=="string"&&a[0].length<512&&i===c&&a[0].charAt(0)==="<"&&!ba.test(a[0])&&(f.support.checkClone||!bb.test(a[0]))&&(g=!0,h=f.fragments[a[0]],h&&h!==1&&(e=h)),e||(e=i.createDocumentFragment(),f.clean
(a,i,e,d)),g&&(f.fragments[a[0]]=h?e:1);return{fragment:e,cacheable:g}},f.fragments={},f.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(a,b){f.fn[a]=function(c){var d=[],e=f(c),g=this.length===1&&this[0].parentNode;if(g&&g.nodeType===11&&g.childNodes.length===1&&e.length===1){e[b](this[0]);return this}for(var h=0,i=e.length;h<i;h++){var j=(h>0?this.clone(!0):this).get();f(e[h])[b](j),d=d.concat(j)}return this.pushStack(d,a,e.selector)}}),f.extend({clone:function(a,b,c){var d=a.cloneNode(!0),e,g,h;if((!f.support.noCloneEvent||!f.support.noCloneChecked)&&(a.nodeType===1||a.nodeType===11)&&!f.isXMLDoc(a)){bh(a,d),e=bi(a),g=bi(d);for(h=0;e[h];++h)g[h]&&bh(e[h],g[h])}if(b){bg(a,d);if(c){e=bi(a),g=bi(d);for(h=0;e[h];++h)bg(e[h],g[h])}}e=g=null;return d},clean:function(a,b,d,e){var g;b=b||c,typeof b.createElement=="undefined"&&(b=b.ownerDocument||b[0]&&b[0].ownerDocument||c);var h=[],i;for(var j=0,k;(k=a[j])!=null;j++){typeof k=="number"&&(k+="");if(!k)continue;if(typeof k=="string")if(!_.test(k))k=b.createTextNode(k);else{k=k.replace(Y,"<$1></$2>");var l=(Z.exec(k)||["",""])[1].toLowerCase(),m=be[l]||be._default,n=m[0],o=b.createElement("div");o.innerHTML=m[1]+k+m[2];while(n--)o=o.lastChild;if(!f.support.tbody){var p=$.test(k),q=l==="table"&&!p?o.firstChild&&o.firstChild.childNodes:m[1]==="<table>"&&!p?o.childNodes:[];for(i=q.length-1;i>=0;--i)f.nodeName(q[i],"tbody")&&!q[i].childNodes.length&&q[i].parentNode.removeChild(q[i])}!f.support.leadingWhitespace&&X.test(k)&&o.insertBefore(b.createTextNode(X.exec(k)[0]),o.firstChild),k=o.childNodes}var r;if(!f.support.appendChecked)if(k[0]&&typeof (r=k.length)=="number")for(i=0;i<r;i++)bk(k[i]);else bk(k);k.nodeType?h.push(k):h=f.merge(h,k)}if(d){g=function(a){return!a.type||bc.test(a.type)};for(j=0;h[j];j++)if(e&&f.nodeName(h[j],"script")&&(!h[j].type||h[j].type.toLowerCase()==="text/javascript"))e.push(h[j].parentNode?h[j].parentNode.removeChild(h[j]):h[j]);else{if(h[j].nodeType===1){var s=f.grep(h[j].getElementsByTagName("script"),g);h.splice.apply(h,[j+1,0].concat(s))}d.appendChild(h[j])}}return h},cleanData:function(a){var b,c,d=f.cache,e=f.expando,g=f.event.special,h=f.support.deleteExpando;for(var i=0,j;(j=a[i])!=null;i++){if(j.nodeName&&f.noData[j.nodeName.toLowerCase()])continue;c=j[f.expando];if(c){b=d[c]&&d[c][e];if(b&&b.events){for(var k in b.events)g[k]?f.event.remove(j,k):f.removeEvent(j,k,b.handle);b.handle&&(b.handle.elem=null)}h?delete j[f.expando]:j.removeAttribute&&j.removeAttribute(f.expando),delete d[c]}}}});var bm=/alpha\([^)]*\)/i,bn=/opacity=([^)]*)/,bo=/([A-Z]|^ms)/g,bp=/^-?\d+(?:px)?$/i,bq=/^-?\d/,br=/^([\-+])=([\-+.\de]+)/,bs={position:"absolute",visibility:"hidden",display:"block"},bt=["Left","Right"],bu=["Top","Bottom"],bv,bw,bx;f.fn.css=function(a,c){if(arguments.length===2&&c===b)return this;return f.access(this,a,c,!0,function(a,c,d){return d!==b?f.style(a,c,d):f.css(a,c)})},f.extend({cssHooks:{opacity:{get:function(a,b){if(b){var c=bv(a,"opacity","opacity");return c===""?"1":c}return a.style.opacity}}},cssNumber:{fillOpacity:!0,fontWeight:!0,lineHeight:!0,opacity:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{"float":f.support.cssFloat?"cssFloat":"styleFloat"},style:function(a,c,d,e){if(!!a&&a.nodeType!==3&&a.nodeType!==8&&!!a.style){var g,h,i=f.camelCase(c),j=a.style,k=f.cssHooks[i];c=f.cssProps[i]||i;if(d===b){if(k&&"get"in k&&(g=k.get(a,!1,e))!==b)return g;return j[c]}h=typeof d,h==="string"&&(g=br.exec(d))&&(d=+(g[1]+1)*+g[2]+parseFloat(f.css(a,c)),h="number");if(d==null||h==="number"&&isNaN(d))return;h==="number"&&!f.cssNumber[i]&&(d+="px");if(!k||!("set"in k)||(d=k.set(a,d))!==b)try{j[c]=d}catch(l){}}},css:function(a,c,d){var e,g;c=f.camelCase(c),g=f.cssHooks[c],c=f.cssProps[c]||c,c==="cssFloat"&&(c="float");if(g&&"get"in g&&(e=g.get(a,!0,d))!==b)return e;if(bv)return bv(a,c)},swap:function(a,b,c){var d={};for(var e in b)d[e]=a.style[e],a.style[e]=b[e];c.call(a);for(e in b)a.style[e]=d[e]}}),f.curCSS=f.css,f.each(["height","width"],function(a,b){f.cssHooks[b]={get:function(a,c,d){var e;if(c){if(a.offsetWidth!==0)return by(a,b,d);f.swap(a,bs,function(){e=by(a,b,d)});return e}},set:function(a,b){if(!bp.test(b))return b;b=parseFloat(b);if(b>=0)return b+"px"}}}),f.support.opacity||(f.cssHooks.opacity={get:function(a,b){return bn.test((b&&a.currentStyle?a.currentStyle.filter:a.style.filter)||"")?parseFloat(RegExp.$1)/100+"":b?"1":""},set:function(a,b){var c=a.style,d=a.currentStyle,e=f.isNaN(b)?"":"alpha(opacity="+b*100+")",g=d&&d.filter||c.filter||"";c.zoom=1;if(b>=1&&f.trim(g.replace(bm,""))===""){c.removeAttribute("filter");if(d&&!d.filter)return}c.filter=bm.test(g)?g.replace(bm,e):g+" "+e}}),f(function(){f.support.reliableMarginRight||(f.cssHooks.marginRight={get:function(a,b){var c;f.swap(a,{display:"inline-block"},function(){b?c=bv(a,"margin-right","marginRight"):c=a.style.marginRight});return c}})}),c.defaultView&&c.defaultView.getComputedStyle&&(bw=function(a,c){var d,e,g;c=c.replace(bo,"-$1").toLowerCase();if(!(e=a.ownerDocument.defaultView))return b;if(g=e.getComputedStyle(a,null))d=g.getPropertyValue(c),d===""&&!f.contains(a.ownerDocument.documentElement,a)&&(d=f.style(a,c));return d}),c.documentElement.currentStyle&&(bx=function(a,b){var c,d=a.currentStyle&&a.currentStyle[b],e=a.runtimeStyle&&a.runtimeStyle[b],f=a.style;!bp.test(d)&&bq.test(d)&&(c=f.left,e&&(a.runtimeStyle.left=a.currentStyle.left),f.left=b==="fontSize"?"1em":d||0,d=f.pixelLeft+"px",f.left=c,e&&(a.runtimeStyle.left=e));return d===""?"auto":d}),bv=bw||bx,f.expr&&f.expr.filters&&(f.expr.filters.hidden=function(a){var b=a.offsetWidth,c=a.offsetHeight;return b===0&&c===0||!f.support.reliableHiddenOffsets&&(a.style.display||f.css(a,"display"))==="none"},f.expr.filters.visible=function(a){return!f.expr.filters.hidden(a)});var bz=/%20/g,bA=/\[\]$/,bB=/\r?\n/g,bC=/#.*$/,bD=/^(.*?):[ \t]*([^\r\n]*)\r?$/mg,bE=/^(?:color|date|datetime|datetime-local|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i,bF=/^(?:about|app|app\-storage|.+\-extension|file|res|widget):$/,bG=/^(?:GET|HEAD)$/,bH=/^\/\//,bI=/\?/,bJ=/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,bK=/^(?:select|textarea)/i,bL=/\s+/,bM=/([?&])_=[^&]*/,bN=/^([\w\+\.\-]+:)(?:\/\/([^\/?#:]*)(?::(\d+))?)?/,bO=f.fn.load,bP={},bQ={},bR,bS,bT=["*/"]+["*"];try{bR=e.href}catch(bU){bR=c.createElement("a"),bR.href="",bR=bR.href}bS=bN.exec(bR.toLowerCase())||[],f.fn.extend({load:function(a,c,d){if(typeof a!="string"&&bO)return bO.apply(this,arguments);if(!this.length)return this;var e=a.indexOf(" ");if(e>=0){var g=a.slice(e,a.length);a=a.slice(0,e)}var h="GET";c&&(f.isFunction(c)?(d=c,c=b):typeof c=="object"&&(c=f.param(c,f.ajaxSettings.traditional),h="POST"));var i=this;f.ajax({url:a,type:h,dataType:"html",data:c,complete:function(a,b,c){c=a.responseText,a.isResolved()&&(a.done(function(a){c=a}),i.html(g?f("<div>").append(c.replace(bJ,"")).find(g):c)),d&&i.each(d,[c,b,a])}});return this},serialize:function(){return f.param(this.serializeArray())},serializeArray:function(){return this.map(function(){return this.elements?f.makeArray(this.elements):this}).filter(function(){return this.name&&!this.disabled&&(this.checked||bK.test(this.nodeName)||bE.test(this.type))}).map(function(a,b){var c=f(this).val();return c==null?null:f.isArray(c)?f.map(c,function(a,c){return{name:b.name,value:a.replace(bB,"\r\n")}}):{name:b.name,value:c.replace(bB,"\r\n")}}).get()}}),f.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "),function(a,b){f.fn[b]=function(a){return this.bind(b,a)}}),f.each(["get","post"],function(a,c){f[c]=function(a,d,e,g){f.isFunction(d)&&(g=g||e,e=d,d=b);return f.ajax({type:c,url:a,data:d,success:e,dataType:g})}}),f.extend({getScript:function(a,c){return f.get(a,b,c,"script")},getJSON:function(a,b,c){return f.get(a,b,c,"json")},ajaxSetup:function(a,b){b?bX(a,f.ajaxSettings):(b=a,a=f.ajaxSettings),bX(a,b);return a},ajaxSettings:{url:bR,isLocal:bF.test(bS[1]),global:!0,type:"GET",contentType:"application/x-www-form-urlencoded",processData:!0,async:!0,accepts:{xml:"application/xml, text/xml",html:"text/html",text:"text/plain",json:"application/json, text/javascript","*":bT},contents:{xml:/xml/,html:/html/,json:/json/},responseFields:{xml:"responseXML",text:"responseText"},converters:{"* text":a.String,"text html":!0,"text json":f.parseJSON,"text xml":f.parseXML},flatOptions:{context:!0,url:!0}},ajaxPrefilter:bV(bP),ajaxTransport:bV(bQ),ajax:function(a,c){function w(a,c,l,m){if(s!==2){s=2,q&&clearTimeout(q),p=b,n=m||"",v.readyState=a>0?4:0;var o,r,u,w=c,x=l?bZ(d,v,l):b,y,z;if(a>=200&&a<300||a===304){if(d.ifModified){if(y=v.getResponseHeader("Last-Modified"))f.lastModified[k]=y;if(z=v.getResponseHeader("Etag"))f.etag[k]=z}if(a===304)w="notmodified",o=!0;else try{r=b$(d,x),w="success",o=!0}catch(A){w="parsererror",u=A}}else{u=w;if(!w||a)w="error",a<0&&(a=0)}v.status=a,v.statusText=""+(c||w),o?h.resolveWith(e,[r,w,v]):h.rejectWith(e,[v,w,u]),v.statusCode(j),j=b,t&&g.trigger("ajax"+(o?"Success":"Error"),[v,d,o?r:u]),i.resolveWith(e,[v,w]),t&&(g.trigger("ajaxComplete",[v,d]),--f.active||f.event.trigger("ajaxStop"))}}typeof a=="object"&&(c=a,a=b),c=c||{};var d=f.ajaxSetup({},c),e=d.context||d,g=e!==d&&(e.nodeType||e instanceof f)?f(e):f.event,h=f.Deferred(),i=f._Deferred(),j=d.statusCode||{},k,l={},m={},n,o,p,q,r,s=0,t,u,v={readyState:0,setRequestHeader:function(a,b){if(!s){var c=a.toLowerCase();a=m[c]=m[c]||a,l[a]=b}return this},getAllResponseHeaders:function(){return s===2?n:null},getResponseHeader:function(a){var c;if(s===2){if(!o){o={};while(c=bD.exec(n))o[c[1].toLowerCase()]=c[2]}c=o[a.toLowerCase()]}return c===b?null:c},overrideMimeType:function(a){s||(d.mimeType=a);return this},abort:function(a){a=a||"abort",p&&p.abort(a),w(0,a);return this}};h.promise(v),v.success=v.done,v.error=v.fail,v.complete=i.done,v.statusCode=function(a){if(a){var b;if(s<2)for(b in a)j[b]=[j[b],a[b]];else b=a[v.status],v.then(b,b)}return this},d.url=((a||d.url)+"").replace(bC,"").replace(bH,bS[1]+"//"),d.dataTypes=f.trim(d.dataType||"*").toLowerCase().split(bL),d.crossDomain==null&&(r=bN.exec(d.url.toLowerCase()),d.crossDomain=!(!r||r[1]==bS[1]&&r[2]==bS[2]&&(r[3]||(r[1]==="http:"?80:443))==(bS[3]||(bS[1]==="http:"?80:443)))),d.data&&d.processData&&typeof d.data!="string"&&(d.data=f.param(d.data,d.traditional)),bW(bP,d,c,v);if(s===2)return!1;t=d.global,d.type=d.type.toUpperCase(),d.hasContent=!bG.test(d.type),t&&f.active++===0&&f.event.trigger("ajaxStart");if(!d.hasContent){d.data&&(d.url+=(bI.test(d.url)?"&":"?")+d.data,delete d.data),k=d.url;if(d.cache===!1){var x=f.now(),y=d.url.replace(bM,"$1_="+x);d.url=y+(y===d.url?(bI.test(d.url)?"&":"?")+"_="+x:"")}}(d.data&&d.hasContent&&d.contentType!==!1||c.contentType)&&v.setRequestHeader("Content-Type",d.contentType),d.ifModified&&(k=k||d.url,f.lastModified[k]&&v.setRequestHeader("If-Modified-Since",f.lastModified[k]),f.etag[k]&&v.setRequestHeader("If-None-Match",f.etag[k])),v.setRequestHeader("Accept",d.dataTypes[0]&&d.accepts[d.dataTypes[0]]?d.accepts[d.dataTypes[0]]+(d.dataTypes[0]!=="*"?", "+bT+"; q=0.01":""):d.accepts["*"]);for(u in d.headers)v.setRequestHeader(u,d.headers[u]);if(d.beforeSend&&(d.beforeSend.call(e,v,d)===!1||s===2)){v.abort();return!1}for(u in{success:1,error:1,complete:1})v[u](d[u]);p=bW(bQ,d,c,v);if(!p)w(-1,"No Transport");else{v.readyState=1,t&&g.trigger("ajaxSend",[v,d]),d.async&&d.timeout>0&&(q=setTimeout(function(){v.abort("timeout")},d.timeout));try{s=1,p.send(l,w)}catch(z){s<2?w(-1,z):f.error(z)}}return v},param:function(a,c){var d=[],e=function(a,b){b=f.isFunction(b)?b():b,d[d.length]=encodeURIComponent(a)+"="+encodeURIComponent(b)};c===b&&(c=f.ajaxSettings.traditional);if(f.isArray(a)||a.jquery&&!f.isPlainObject(a))f.each(a,function(){e(this.name,this.value)});else for(var g in a)bY(g,a[g],c,e);return d.join("&").replace(bz,"+")}}),f.extend({active:0,lastModified:{},etag:{}});var b_=f.now(),ca=/(\=)\?(&|$)|\?\?/i;f.ajaxSetup({jsonp:"callback",jsonpCallback:function(){return f.expando+"_"+b_++}}),f.ajaxPrefilter("json jsonp",function(b,c,d){var e=b.contentType==="application/x-www-form-urlencoded"&&typeof b.data=="string";if(b.dataTypes[0]==="jsonp"||b.jsonp!==!1&&(ca.test(b.url)||e&&ca.test(b.data))){var g,h=b.jsonpCallback=f.isFunction(b.jsonpCallback)?b.jsonpCallback():b.jsonpCallback,i=a[h],j=b.url,k=b.data,l="$1"+h+"$2";b.jsonp!==!1&&(j=j.replace(ca,l),b.url===j&&(e&&(k=k.replace(ca,l)),b.data===k&&(j+=(/\?/.test(j)?"&":"?")+b.jsonp+"="+h))),b.url=j,b.data=k,a[h]=function(a){g=[a]},d.always(function(){a[h]=i,g&&f.isFunction(i)&&a[h](g[0])}),b.converters["script json"]=function(){g||f.error(h+" was not called");return g[0]},b.dataTypes[0]="json";return"script"}}),f.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/javascript|ecmascript/},converters:{"text script":function(a){f.globalEval(a);return a}}}),f.ajaxPrefilter("script",function(a){a.cache===b&&(a.cache=!1),a.crossDomain&&(a.type="GET",a.global=!1)}),f.ajaxTransport("script",function(a){if(a.crossDomain){var d,e=c.head||c.getElementsByTagName("head")[0]||c.documentElement;return{send:function(f,g){d=c.createElement("script"),d.async="async",a.scriptCharset&&(d.charset=a.scriptCharset),d.src=a.url,d.onload=d.onreadystatechange=function(a,c){if(c||!d.readyState||/loaded|complete/.test(d.readyState))d.onload=d.onreadystatechange=null,e&&d.parentNode&&e.removeChild(d),d=b,c||g(200,"success")},e.insertBefore(d,e.firstChild)},abort:function(){d&&d.onload(0,1)}}}});var cb=a.ActiveXObject?function(){for(var a in cd)cd[a](0,1)}:!1,cc=0,cd;f.ajaxSettings.xhr=a.ActiveXObject?function(){return!this.isLocal&&ce()||cf()}:ce,function(a){f.extend(f.support,{ajax:!!a,cors:!!a&&"withCredentials"in a})}(f.ajaxSettings.xhr()),f.support.ajax&&f.ajaxTransport(function(c){if(!c.crossDomain||f.support.cors){var d;return{send:function(e,g){var h=c.xhr(),i,j;c.username?h.open(c.type,c.url,c.async,c.username,c.password):h.open(c.type,c.url,c.async);if(c.xhrFields)for(j in c.xhrFields)h[j]=c.xhrFields[j];c.mimeType&&h.overrideMimeType&&h.overrideMimeType(c.mimeType),!c.crossDomain&&!e["X-Requested-With"]&&(e["X-Requested-With"]="XMLHttpRequest");try{for(j in e)h.setRequestHeader(j,e[j])}catch(k){}h.send(c.hasContent&&c.data||null),d=function(a,e){var j,k,l,m,n;try{if(d&&(e||h.readyState===4)){d=b,i&&(h.onreadystatechange=f.noop,cb&&delete cd[i]);if(e)h.readyState!==4&&h.abort();else{j=h.status,l=h.getAllResponseHeaders(),m={},n=h.responseXML,n&&n.documentElement&&(m.xml=n),m.text=h.responseText;try{k=h.statusText}catch(o){k=""}!j&&c.isLocal&&!c.crossDomain?j=m.text?200:404:j===1223&&(j=204)}}}catch(p){e||g(-1,p)}m&&g(j,k,m,l)},!c.async||h.readyState===4?d():(i=++cc,cb&&(cd||(cd={},f(a).unload(cb)),cd[i]=d),h.onreadystatechange=d)},abort:function(){d&&d(0,1)}}}});var cg={},ch,ci,cj=/^(?:toggle|show|hide)$/,ck=/^([+\-]=)?([\d+.\-]+)([a-z%]*)$/i,cl,cm=[["height","marginTop","marginBottom","paddingTop","paddingBottom"],["width","marginLeft","marginRight","paddingLeft","paddingRight"],["opacity"]],cn;f.fn.extend({show:function(a,b,c){var d,e;if(a||a===0)return this.animate(cq("show",3),a,b,c);for(var g=0,h=this.length;g<h;g++)d=this[g],d.style&&(e=d.style.display,!f._data(d,"olddisplay")&&e==="none"&&(e=d.style.display=""),e===""&&f.css(d,"display")==="none"&&f._data(d,"olddisplay",cr(d.nodeName)));for(g=0;g<h;g++){d=this[g];if(d.style){e=d.style.display;if(e===""||e==="none")d.style.display=f._data(d,"olddisplay")||""}}return this},hide:function(a,b,c){if(a||a===0)return this.animate(cq("hide",3),a,b,c);for(var d=0,e=this.length;d<e;d++)if(this[d].style){var g=f.css(this[d],"display");g!=="none"&&!f._data(this[d],"olddisplay")&&f._data(this[d],"olddisplay",g)}for(d=0;d<e;d++)this[d].style&&(this[d].style.display="none");return this},_toggle:f.fn.toggle,toggle:function(a,b,c){var d=typeof a=="boolean";f.isFunction(a)&&f.isFunction(b)?this._toggle.apply(this,arguments):a==null||d?this.each(function(){var b=d?a:f(this).is(":hidden");f(this)[b?"show":"hide"]()}):this.animate(cq("toggle",3),a,b,c);return this},fadeTo:function(a,b,c,d){return this.filter(":hidden").css("opacity",0).show().end().animate({opacity:b},a,c,d)},animate:function(a,b,c,d){var e=f.speed(b,c,d);if(f.isEmptyObject(a))return this.each(e.complete,[!1]);a=f.extend({},a);return this[e.queue===!1?"each":"queue"](function(){e.queue===!1&&f._mark(this);var b=f.extend({},e),c=this.nodeType===1,d=c&&f(this).is(":hidden"),g,h,i,j,k,l,m,n,o;b.animatedProperties={};for(i in a){g=f.camelCase(i),i!==g&&(a[g]=a[i],delete a[i]),h=a[g],f.isArray(h)?(b.animatedProperties[g]=h[1],h=a[g]=h[0]):b.animatedProperties[g]=b.specialEasing&&b.specialEasing[g]||b.easing||"swing";if(h==="hide"&&d||h==="show"&&!d)return b.complete.call(this);c&&(g==="height"||g==="width")&&(b.overflow=[this.style.overflow,this.style.overflowX,this.style.overflowY],f.css(this,"display")==="inline"&&f.css(this,"float")==="none"&&(f.support.inlineBlockNeedsLayout?(j=cr(this.nodeName),j==="inline"?this.style.display="inline-block":(this.style.display="inline",this.style.zoom=1)):this.style.display="inline-block"))}b.overflow!=null&&(this.style.overflow="hidden");for(i in a)k=new f.fx(this,b,i),h=a[i],cj.test(h)?k[h==="toggle"?d?"show":"hide":h]():(l=ck.exec(h),m=k.cur(),l?(n=parseFloat(l[2]),o=l[3]||(f.cssNumber[i]?"":"px"),o!=="px"&&(f.style(this,i,(n||1)+o),m=(n||1)/k.cur()*m,f.style(this,i,m+o)),l[1]&&(n=(l[1]==="-="?-1:1)*n+m),k.custom(m,n,o)):k.custom(m,h,""));return!0})},stop:function(a,b){a&&this.queue([]),this.each(function(){var a=f.timers,c=a.length;b||f._unmark(!0,this);while(c--)a[c].elem===this&&(b&&a[c](!0),a.splice(c,1))}),b||this.dequeue();return this}}),f.each({slideDown:cq("show",1),slideUp:cq("hide",1),slideToggle:cq("toggle",1),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(a,b){f.fn[a]=function(a,c,d){return this.animate(b,a,c,d)}}),f.extend({speed:function(a,b,c){var d=a&&typeof a=="object"?f.extend({},a):{complete:c||!c&&b||f.isFunction(a)&&a,duration:a,easing:c&&b||b&&!f.isFunction(b)&&b};d.duration=f.fx.off?0:typeof d.duration=="number"?d.duration:d.duration in f.fx.speeds?f.fx.speeds[d.duration]:f.fx.speeds._default,d.old=d.complete,d.complete=function(a){f.isFunction(d.old)&&d.old.call(this),d.queue!==!1?f.dequeue(this):a!==!1&&f._unmark(this)};return d},easing:{linear:function(a,b,c,d){return c+d*a},swing:function(a,b,c,d){return(-Math.cos(a*Math.PI)/2+.5)*d+c}},timers:[],fx:function(a,b,c){this.options=b,this.elem=a,this.prop=c,b.orig=b.orig||{}}}),f.fx.prototype={update:function(){this.options.step&&this.options.step.call(this.elem,this.now,this),(f.fx.step[this.prop]||f.fx.step._default)(this)},cur:function(){if(this.elem[this.prop]!=null&&(!this.elem.style||this.elem.style[this.prop]==null))return this.elem[this.prop];var a,b=f.css(this.elem,this.prop);return isNaN(a=parseFloat(b))?!b||b==="auto"?0:b:a},custom:function(a,b,c){function g(a){return d.step(a)}var d=this,e=f.fx;this.startTime=cn||co(),this.start=a,this.end=b,this.unit=c||this.unit||(f.cssNumber[this.prop]?"":"px"),this.now=this.start,this.pos=this.state=0,g.elem=this.elem,g()&&f.timers.push(g)&&!cl&&(cl=setInterval(e.tick,e.interval))},show:function(){this.options.orig[this.prop]=f.style(this.elem,this.prop),this.options.show=!0,this.custom(this.prop==="width"||this.prop==="height"?1:0,this.cur()),f(this.elem).show()},hide:function(){this.options.orig[this.prop]=f.style(this.elem,this.prop),this.options.hide=!0,this.custom(this.cur(),0)},step:function(a){var b=cn||co(),c=!0,d=this.elem,e=this.options,g,h;if(a||b>=e.duration+this.startTime){this.now=this.end,this.pos=this.state=1,this.update(),e.animatedProperties[this.prop]=!0;for(g in e.animatedProperties)e.animatedProperties[g]!==!0&&(c=!1);if(c){e.overflow!=null&&!f.support.shrinkWrapBlocks&&f.each(["","X","Y"],function(a,b){d.style["overflow"+b]=e.overflow[a]}),e.hide&&f(d).hide();if(e.hide||e.show)for(var i in e.animatedProperties)f.style(d,i,e.orig[i]);e.complete.call(d)}return!1}e.duration==Infinity?this.now=b:(h=b-this.startTime,this.state=h/e.duration,this.pos=f.easing[e.animatedProperties[this.prop]](this.state,h,0,1,e.duration),this.now=this.start+(this.end-this.start)*this.pos),this.update();return!0}},f.extend(f.fx,{tick:function(){for(var a=f.timers,b=0;b<a.length;++b)a[b]()||a.splice(b--,1);a.length||f.fx.stop()},interval:13,stop:function(){clearInterval(cl),cl=null},speeds:{slow:600,fast:200,_default:400},step:{opacity:function(a){f.style(a.elem,"opacity",a.now)},_default:function(a){a.elem.style&&a.elem.style[a.prop]!=null?a.elem.style[a.prop]=(a.prop==="width"||a.prop==="height"?Math.max(0,a.now):a.now)+a.unit:a.elem[a.prop]=a.now}}}),f.expr&&f.expr.filters&&(f.expr.filters.animated=function(a){return f.grep(f.timers,function(b){return a===b.elem}).length});var cs=/^t(?:able|d|h)$/i,ct=/^(?:body|html)$/i;"getBoundingClientRect"in c.documentElement?f.fn.offset=function(a){var b=this[0],c;if(a)return this.each(function(b){f.offset.setOffset(this,a,b)});if(!b||!b.ownerDocument)return null;if(b===b.ownerDocument.body)return f.offset.bodyOffset(b);try{c=b.getBoundingClientRect()}catch(d){}var e=b.ownerDocument,g=e.documentElement;if(!c||!f.contains(g,b))return c?{top:c.top,left:c.left}:{top:0,left:0};var h=e.body,i=cu(e),j=g.clientTop||h.clientTop||0,k=g.clientLeft||h.clientLeft||0,l=i.pageYOffset||f.support.boxModel&&g.scrollTop||h.scrollTop,m=i.pageXOffset||f.support.boxModel&&g.scrollLeft||h.scrollLeft,n=c.top+l-j,o=c.left+m-k;return{top:n,left:o}}:f.fn.offset=function(a){var b=this[0];if(a)return this.each(function(b){f.offset.setOffset(this,a,b)});if(!b||!b.ownerDocument)return null;if(b===b.ownerDocument.body)return f.offset.bodyOffset(b);f.offset.initialize();var c,d=b.offsetParent,e=b,g=b.ownerDocument,h=g.documentElement,i=g.body,j=g.defaultView,k=j?j.getComputedStyle(b,null):b.currentStyle,l=b.offsetTop,m=b.offsetLeft;while((b=b.parentNode)&&b!==i&&b!==h){if(f.offset.supportsFixedPosition&&k.position==="fixed")break;c=j?j.getComputedStyle(b,null):b.currentStyle,l-=b.scrollTop,m-=b.scrollLeft,b===d&&(l+=b.offsetTop,m+=b.offsetLeft,f.offset.doesNotAddBorder&&(!f.offset.doesAddBorderForTableAndCells||!cs.test(b.nodeName))&&(l+=parseFloat(c.borderTopWidth)||0,m+=parseFloat(c.borderLeftWidth)||0),e=d,d=b.offsetParent),f.offset.subtractsBorderForOverflowNotVisible&&c.overflow!=="visible"&&(l+=parseFloat(c.borderTopWidth)||0,m+=parseFloat(c.borderLeftWidth)||0),k=c}if(k.position==="relative"||k.position==="static")l+=i.offsetTop,m+=i.offsetLeft;f.offset.supportsFixedPosition&&k.position==="fixed"&&(l+=Math.max(h.scrollTop,i.scrollTop),m+=Math.max(h.scrollLeft,i.scrollLeft));return{top:l,left:m}},f.offset={initialize:function(){var a=c.body,b=c.createElement("div"),d,e,g,h,i=parseFloat(f.css(a,"marginTop"))||0,j="<div style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;'><div></div></div><table style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;' cellpadding='0' cellspacing='0'><tr><td></td></tr></table>";f.extend(b.style,{position:"absolute",top:0,left:0,margin:0,border:0,width:"1px",height:"1px",visibility:"hidden"}),b.innerHTML=j,a.insertBefore(b,a.firstChild),d=b.firstChild,e=d.firstChild,h=d.nextSibling.firstChild.firstChild,this.doesNotAddBorder=e.offsetTop!==5,this.doesAddBorderForTableAndCells=h.offsetTop===5,e.style.position="fixed",e.style.top="20px",this.supportsFixedPosition=e.offsetTop===20||e.offsetTop===15,e.style.position=e.style.top="",d.style.overflow="hidden",d.style.position="relative",this.subtractsBorderForOverflowNotVisible=e.offsetTop===-5,this.doesNotIncludeMarginInBodyOffset=a.offsetTop!==i,a.removeChild(b),f.offset.initialize=f.noop},bodyOffset:function(a){var b=a.offsetTop,c=a.offsetLeft;f.offset.initialize(),f.offset.doesNotIncludeMarginInBodyOffset&&(b+=parseFloat(f.css(a,"marginTop"))||0,c+=parseFloat(f.css(a,"marginLeft"))||0);return{top:b,left:c}},setOffset:function(a,b,c){var d=f.css(a,"position");d==="static"&&(a.style.position="relative");var e=f(a),g=e.offset(),h=f.css(a,"top"),i=f.css(a,"left"),j=(d==="absolute"||d==="fixed")&&f.inArray("auto",[h,i])>-1,k={},l={},m,n;j?(l=e.position(),m=l.top,n=l.left):(m=parseFloat(h)||0,n=parseFloat(i)||0),f.isFunction(b)&&(b=b.call(a,c,g)),b.top!=null&&(k.top=b.top-g.top+m),b.left!=null&&(k.left=b.left-g.left+n),"using"in b?b.using.call(a,k):e.css(k)}},f.fn.extend({position:function(){if(!this[0])return null;var a=this[0],b=this.offsetParent(),c=this.offset(),d=ct.test(b[0].nodeName)?{top:0,left:0}:b.offset();c.top-=parseFloat(f.css(a,"marginTop"))||0,c.left-=parseFloat(f.css(a,"marginLeft"))||0,d.top+=parseFloat(f.css(b[0],"borderTopWidth"))||0,d.left+=parseFloat(f.css(b[0],"borderLeftWidth"))||0;return{top:c.top-d.top,left:c.left-d.left}},offsetParent:function(){return this.map(function(){var a=this.offsetParent||c.body;while(a&&!ct.test(a.nodeName)&&f.css(a,"position")==="static")a=a.offsetParent;return a})}}),f.each(["Left","Top"],function(a,c){var d="scroll"+c;f.fn[d]=function(c){var e,g;if(c===b){e=this[0];if(!e)return null;g=cu(e);return g?"pageXOffset"in g?g[a?"pageYOffset":"pageXOffset"]:f.support.boxModel&&g.document.documentElement[d]||g.document.body[d]:e[d]}return this.each(function(){g=cu(this),g?g.scrollTo(a?f(g).scrollLeft():c,a?c:f(g).scrollTop()):this[d]=c})}}),f.each(["Height","Width"],function(a,c){var d=c.toLowerCase();f.fn["inner"+c]=function(){var a=this[0];return a&&a.style?parseFloat(f.css(a,d,"padding")):null},f.fn["outer"+c]=function(a){var b=this[0];return b&&b.style?parseFloat(f.css(b,d,a?"margin":"border")):null},f.fn[d]=function(a){var e=this[0];if(!e)return a==null?null:this;if(f.isFunction(a))return this.each(function(b){var c=f(this);c[d](a.call(this,b,c[d]()))});if(f.isWindow(e)){var g=e.document.documentElement["client"+c],h=e.document.body;return e.document.compatMode==="CSS1Compat"&&g||h&&h["client"+c]||g}if(e.nodeType===9)return Math.max(e.documentElement["client"+c],e.body["scroll"+c],e.documentElement["scroll"+c],e.body["offset"+c],e.documentElement["offset"+c]);if(a===b){var i=f.css(e,d),j=parseFloat(i);return f.isNaN(j)?i:j}return this.css(d,typeof a=="string"?a:a+"px")}}),a.jQuery=a.$=f})(window);/*
 * jQuery Templates Plugin 1.0.0pre
 * http://github.com/jquery/jquery-tmpl
 * Requires jQuery 1.4.2
 *
 * Copyright Software Freedom Conservancy, Inc.
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 */
(function(a){var r=a.fn.domManip,d="_tmplitem",q=/^[^<]*(<[\w\W]+>)[^>]*$|\{\{\! /,b={},f={},e,p={key:0,data:{}},i=0,c=0,l=[];function g(g,d,h,e){var c={data:e||(e===0||e===false)?e:d?d.data:{},_wrap:d?d._wrap:null,tmpl:null,parent:d||null,nodes:[],calls:u,nest:w,wrap:x,html:v,update:t};g&&a.extend(c,g,{nodes:[],parent:d});if(h){c.tmpl=h;c._ctnt=c._ctnt||c.tmpl(a,c);c.key=++i;(l.length?f:b)[i]=c}return c}a.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(f,d){a.fn[f]=function(n){var g=[],i=a(n),k,h,m,l,j=this.length===1&&this[0].parentNode;e=b||{};if(j&&j.nodeType===11&&j.childNodes.length===1&&i.length===1){i[d](this[0]);g=this}else{for(h=0,m=i.length;h<m;h++){c=h;k=(h>0?this.clone(true):this).get();a(i[h])[d](k);g=g.concat(k)}c=0;g=this.pushStack(g,f,i.selector)}l=e;e=null;a.tmpl.complete(l);return g}});a.fn.extend({tmpl:function(d,c,b){return a.tmpl(this[0],d,c,b)},tmplItem:function(){return a.tmplItem(this[0])},template:function(b){return a.template(b,this[0])},domManip:function(d,m,k){if(d[0]&&a.isArray(d[0])){var g=a.makeArray(arguments),h=d[0],j=h.length,i=0,f;while(i<j&&!(f=a.data(h[i++],"tmplItem")));if(f&&c)g[2]=function(b){a.tmpl.afterManip(this,b,k)};r.apply(this,g)}else r.apply(this,arguments);c=0;!e&&a.tmpl.complete(b);return this}});a.extend({tmpl:function(d,h,e,c){var i,k=!c;if(k){c=p;d=a.template[d]||a.template(null,d);f={}}else if(!d){d=c.tmpl;b[c.key]=c;c.nodes=[];c.wrapped&&n(c,c.wrapped);return a(j(c,null,c.tmpl(a,c)))}if(!d)return[];if(typeof h==="function")h=h.call(c||{});e&&e.wrapped&&n(e,e.wrapped);i=a.isArray(h)?a.map(h,function(a){return a?g(e,c,d,a):null}):[g(e,c,d,h)];return k?a(j(c,null,i)):i},tmplItem:function(b){var c;if(b instanceof a)b=b[0];while(b&&b.nodeType===1&&!(c=a.data(b,"tmplItem"))&&(b=b.parentNode));return c||p},template:function(c,b){if(b){if(typeof b==="string")b=o(b);else if(b instanceof a)b=b[0]||{};if(b.nodeType)b=a.data(b,"tmpl")||a.data(b,"tmpl",o(b.innerHTML));return typeof c==="string"?(a.template[c]=b):b}return c?typeof c!=="string"?a.template(null,c):a.template[c]||a.template(null,q.test(c)?c:a(c)):null},encode:function(a){return(""+a).split("<").join("&lt;").split(">").join("&gt;").split('"').join("&#34;").split("'").join("&#39;")}});a.extend(a.tmpl,{tag:{tmpl:{_default:{$2:"null"},open:"if($notnull_1){__=__.concat($item.nest($1,$2));}"},wrap:{_default:{$2:"null"},open:"$item.calls(__,$1,$2);__=[];",close:"call=$item.calls();__=call._.concat($item.wrap(call,__));"},each:{_default:{$2:"$index, $value"},open:"if($notnull_1){$.each($1a,function($2){with(this){",close:"}});}"},"if":{open:"if(($notnull_1) && $1a){",close:"}"},"else":{_default:{$1:"true"},open:"}else if(($notnull_1) && $1a){"},html:{open:"if($notnull_1){__.push($1a);}"},"=":{_default:{$1:"$data"},open:"if($notnull_1){__.push($.encode($1a));}"},"!":{open:""}},complete:function(){b={}},afterManip:function(f,b,d){var e=b.nodeType===11?a.makeArray(b.childNodes):b.nodeType===1?[b]:[];d.call(f,b);m(e);c++}});function j(e,g,f){var b,c=f?a.map(f,function(a){return typeof a==="string"?e.key?a.replace(/(<\w+)(?=[\s>])(?![^>]*_tmplitem)([^>]*)/g,"$1 "+d+'="'+e.key+'" $2'):a:j(a,e,a._ctnt)}):e;if(g)return c;c=c.join("");c.replace(/^\s*([^<\s][^<]*)?(<[\w\W]+>)([^>]*[^>\s])?\s*$/,function(f,c,e,d){b=a(e).get();m(b);if(c)b=k(c).concat(b);if(d)b=b.concat(k(d))});return b?b:k(c)}function k(c){var b=document.createElement("div");b.innerHTML=c;return a.makeArray(b.childNodes)}function o(b){return new Function("jQuery","$item","var $=jQuery,call,__=[],$data=$item.data;with($data){__.push('"+a.trim(b).replace(/([\\'])/g,"\\$1").replace(/[\r\t\n]/g," ").replace(/\$\{([^\}]*)\}/g,"{{= $1}}").replace(/\{\{(\/?)(\w+|.)(?:\(((?:[^\}]|\}(?!\}))*?)?\))?(?:\s+(.*?)?)?(\(((?:[^\}]|\}(?!\}))*?)\))?\s*\}\}/g,function(m,l,k,g,b,c,d){var j=a.tmpl.tag[k],i,e,f;if(!j)throw"Unknown template tag: "+k;i=j._default||[];if(c&&!/\w$/.test(b)){b+=c;c=""}if(b){b=h(b);d=d?","+h(d)+")":c?")":"";e=c?b.indexOf(".")>-1?b+h(c):"("+b+").call($item"+d:b;f=c?e:"(typeof("+b+")==='function'?("+b+").call($item):("+b+"))"}else f=e=i.$1||"null";g=h(g);return"');"+j[l?"close":"open"].split("$notnull_1").join(b?"typeof("+b+")!=='undefined' && ("+b+")!=null":"true").split("$1a").join(f).split("$1").join(e).split("$2").join(g||i.$2||"")+"__.push('"})+"');}return __;")}function n(c,b){c._wrap=j(c,true,a.isArray(b)?b:[q.test(b)?b:a(b).html()]).join("")}function h(a){return a?a.replace(/\\'/g,"'").replace(/\\\\/g,"\\"):null}function s(b){var a=document.createElement("div");a.appendChild(b.cloneNode(true));return a.innerHTML}function m(o){var n="_"+c,k,j,l={},e,p,h;for(e=0,p=o.length;e<p;e++){if((k=o[e]).nodeType!==1)continue;j=k.getElementsByTagName("*");for(h=j.length-1;h>=0;h--)m(j[h]);m(k)}function m(j){var p,h=j,k,e,m;if(m=j.getAttribute(d)){while(h.parentNode&&(h=h.parentNode).nodeType===1&&!(p=h.getAttribute(d)));if(p!==m){h=h.parentNode?h.nodeType===11?0:h.getAttribute(d)||0:0;if(!(e=b[m])){e=f[m];e=g(e,b[h]||f[h]);e.key=++i;b[i]=e}c&&o(m)}j.removeAttribute(d)}else if(c&&(e=a.data(j,"tmplItem"))){o(e.key);b[e.key]=e;h=a.data(j.parentNode,"tmplItem");h=h?h.key:0}if(e){k=e;while(k&&k.key!=h){k.nodes.push(j);k=k.parent}delete e._ctnt;delete e._wrap;a.data(j,"tmplItem",e)}function o(a){a=a+n;e=l[a]=l[a]||g(e,b[e.parent.key+n]||e.parent)}}}function u(a,d,c,b){if(!a)return l.pop();l.push({_:a,tmpl:d,item:this,data:c,options:b})}function w(d,c,b){return a.tmpl(a.template(d),c,b,this)}function x(b,d){var c=b.options||{};c.wrapped=d;return a.tmpl(a.template(b.tmpl),b.data,c,b.item)}function v(d,c){var b=this._wrap;return a.map(a(a.isArray(b)?b.join(""):b).filter(d||"*"),function(a){return c?a.innerText||a.textContent:a.outerHTML||s(a)})}function t(){var b=this.nodes;a.tmpl(null,null,null,this).insertBefore(b[0]);a(b).remove()}})(jQuery);// Knockout JavaScript library v2.0.0
// (c) Steven Sanderson - http://knockoutjs.com/
// License: MIT (http://www.opensource.org/licenses/mit-license.php)

(function(window,undefined){ 
function c(a){throw a;}var l=void 0,m=!0,o=null,p=!1,r=window.ko={};r.b=function(a,b){for(var d=a.split("."),e=window,f=0;f<d.length-1;f++)e=e[d[f]];e[d[d.length-1]]=b};r.l=function(a,b,d){a[b]=d};
r.a=new function(){function a(a,e){if("INPUT"!=a.tagName||!a.type)return p;if("click"!=e.toLowerCase())return p;var b=a.type.toLowerCase();return"checkbox"==b||"radio"==b}var b=/^(\s|\u00A0)+|(\s|\u00A0)+$/g,d={},e={};d[/Firefox\/2/i.test(navigator.userAgent)?"KeyboardEvent":"UIEvents"]=["keyup","keydown","keypress"];d.MouseEvents="click,dblclick,mousedown,mouseup,mousemove,mouseover,mouseout,mouseenter,mouseleave".split(",");for(var f in d){var h=d[f];if(h.length)for(var g=0,i=h.length;g<i;g++)e[h[g]]=
f}var j=function(){for(var a=3,e=document.createElement("div"),b=e.getElementsByTagName("i");e.innerHTML="<\!--[if gt IE "+ ++a+"]><i></i><![endif]--\>",b[0];);return 4<a?a:l}();return{Ba:["authenticity_token",/^__RequestVerificationToken(_.*)?$/],n:function(a,e){for(var b=0,f=a.length;b<f;b++)e(a[b])},k:function(a,e){if("function"==typeof Array.prototype.indexOf)return Array.prototype.indexOf.call(a,e);for(var b=0,f=a.length;b<f;b++)if(a[b]===e)return b;return-1},Wa:function(a,e,b){for(var f=0,d=
a.length;f<d;f++)if(e.call(b,a[f]))return a[f];return o},ca:function(a,e){var b=r.a.k(a,e);0<=b&&a.splice(b,1)},ya:function(a){for(var a=a||[],e=[],b=0,f=a.length;b<f;b++)0>r.a.k(e,a[b])&&e.push(a[b]);return e},ba:function(a,e){for(var a=a||[],b=[],f=0,d=a.length;f<d;f++)b.push(e(a[f]));return b},aa:function(a,e){for(var a=a||[],b=[],f=0,d=a.length;f<d;f++)e(a[f])&&b.push(a[f]);return b},J:function(a,e){for(var b=0,f=e.length;b<f;b++)a.push(e[b]);return a},extend:function(a,e){for(var b in e)e.hasOwnProperty(b)&&
(a[b]=e[b]);return a},U:function(a){for(;a.firstChild;)r.removeNode(a.firstChild)},oa:function(a,e){r.a.U(a);e&&r.a.n(e,function(e){a.appendChild(e)})},Ja:function(a,e){var b=a.nodeType?[a]:a;if(0<b.length){for(var f=b[0],d=f.parentNode,h=0,g=e.length;h<g;h++)d.insertBefore(e[h],f);h=0;for(g=b.length;h<g;h++)r.removeNode(b[h])}},La:function(a,e){0<=navigator.userAgent.indexOf("MSIE 6")?a.setAttribute("selected",e):a.selected=e},z:function(a){return(a||"").replace(b,"")},Db:function(a,e){for(var b=
[],f=(a||"").split(e),d=0,h=f.length;d<h;d++){var g=r.a.z(f[d]);""!==g&&b.push(g)}return b},Cb:function(a,e){a=a||"";return e.length>a.length?p:a.substring(0,e.length)===e},hb:function(a){for(var e=Array.prototype.slice.call(arguments,1),b="return ("+a+")",f=0;f<e.length;f++)e[f]&&"object"==typeof e[f]&&(b="with(sc["+f+"]) { "+b+" } ");return(new Function("sc",b))(e)},fb:function(a,e){if(e.compareDocumentPosition)return 16==(e.compareDocumentPosition(a)&16);for(;a!=o;){if(a==e)return m;a=a.parentNode}return p},
ga:function(a){return r.a.fb(a,document)},s:function(e,b,f){if("undefined"!=typeof jQuery){if(a(e,b))var d=f,f=function(a,e){var b=this.checked;if(e)this.checked=e.Ya!==m;d.call(this,a);this.checked=b};jQuery(e).bind(b,f)}else"function"==typeof e.addEventListener?e.addEventListener(b,f,p):"undefined"!=typeof e.attachEvent?e.attachEvent("on"+b,function(a){f.call(e,a)}):c(Error("Browser doesn't support addEventListener or attachEvent"))},sa:function(b,f){(!b||!b.nodeType)&&c(Error("element must be a DOM node when calling triggerEvent"));
if("undefined"!=typeof jQuery){var d=[];a(b,f)&&d.push({Ya:b.checked});jQuery(b).trigger(f,d)}else if("function"==typeof document.createEvent)"function"==typeof b.dispatchEvent?(d=document.createEvent(e[f]||"HTMLEvents"),d.initEvent(f,m,m,window,0,0,0,0,0,p,p,p,p,0,b),b.dispatchEvent(d)):c(Error("The supplied element doesn't support dispatchEvent"));else if("undefined"!=typeof b.fireEvent){if("click"==f&&"INPUT"==b.tagName&&("checkbox"==b.type.toLowerCase()||"radio"==b.type.toLowerCase()))b.checked=
b.checked!==m;b.fireEvent("on"+f)}else c(Error("Browser doesn't support triggering events"))},d:function(a){return r.V(a)?a():a},eb:function(a,e){return 0<=r.a.k((a.className||"").split(/\s+/),e)},Qa:function(a,e,b){var f=r.a.eb(a,e);if(b&&!f)a.className=(a.className||"")+" "+e;else if(f&&!b){for(var b=(a.className||"").split(/\s+/),f="",d=0;d<b.length;d++)b[d]!=e&&(f+=b[d]+" ");a.className=r.a.z(f)}},outerHTML:function(a){if(j===l){var e=a.outerHTML;if("string"==typeof e)return e}e=window.document.createElement("div");
e.appendChild(a.cloneNode(m));return e.innerHTML},Ma:function(a,e){var b=r.a.d(e);if(b===o||b===l)b="";"innerText"in a?a.innerText=b:a.textContent=b;if(9<=j)a.innerHTML=a.innerHTML},yb:function(a,e){for(var a=r.a.d(a),e=r.a.d(e),b=[],f=a;f<=e;f++)b.push(f);return b},X:function(a){for(var e=[],b=0,f=a.length;b<f;b++)e.push(a[b]);return e},ob:6===j,pb:7===j,Ca:function(a,e){for(var b=r.a.X(a.getElementsByTagName("INPUT")).concat(r.a.X(a.getElementsByTagName("TEXTAREA"))),f="string"==typeof e?function(a){return a.name===
e}:function(a){return e.test(a.name)},d=[],h=b.length-1;0<=h;h--)f(b[h])&&d.push(b[h]);return d},vb:function(a){return"string"==typeof a&&(a=r.a.z(a))?window.JSON&&window.JSON.parse?window.JSON.parse(a):(new Function("return "+a))():o},qa:function(a){("undefined"==typeof JSON||"undefined"==typeof JSON.stringify)&&c(Error("Cannot find JSON.stringify(). Some browsers (e.g., IE < 8) don't support it natively, but you can overcome this by adding a script reference to json2.js, downloadable from http://www.json.org/json2.js"));
return JSON.stringify(r.a.d(a))},wb:function(a,e,b){var b=b||{},f=b.params||{},d=b.includeFields||this.Ba,h=a;if("object"==typeof a&&"FORM"==a.tagName)for(var h=a.action,g=d.length-1;0<=g;g--)for(var j=r.a.Ca(a,d[g]),i=j.length-1;0<=i;i--)f[j[i].name]=j[i].value;var e=r.a.d(e),u=document.createElement("FORM");u.style.display="none";u.action=h;u.method="post";for(var y in e)a=document.createElement("INPUT"),a.name=y,a.value=r.a.qa(r.a.d(e[y])),u.appendChild(a);for(y in f)a=document.createElement("INPUT"),
a.name=y,a.value=f[y],u.appendChild(a);document.body.appendChild(u);b.submitter?b.submitter(u):u.submit();setTimeout(function(){u.parentNode.removeChild(u)},0)}}};r.b("ko.utils",r.a);
r.a.n([["arrayForEach",r.a.n],["arrayFirst",r.a.Wa],["arrayFilter",r.a.aa],["arrayGetDistinctValues",r.a.ya],["arrayIndexOf",r.a.k],["arrayMap",r.a.ba],["arrayPushAll",r.a.J],["arrayRemoveItem",r.a.ca],["extend",r.a.extend],["fieldsIncludedWithJsonPost",r.a.Ba],["getFormFields",r.a.Ca],["postJson",r.a.wb],["parseJson",r.a.vb],["registerEventHandler",r.a.s],["stringifyJson",r.a.qa],["range",r.a.yb],["toggleDomNodeCssClass",r.a.Qa],["triggerEvent",r.a.sa],["unwrapObservable",r.a.d]],function(a){r.b("ko.utils."+
a[0],a[1])});Function.prototype.bind||(Function.prototype.bind=function(a){var b=this,d=Array.prototype.slice.call(arguments),a=d.shift();return function(){return b.apply(a,d.concat(Array.prototype.slice.call(arguments)))}});
r.a.e=new function(){var a=0,b="__ko__"+(new Date).getTime(),d={};return{get:function(a,b){var d=r.a.e.getAll(a,p);return d===l?l:d[b]},set:function(a,b,d){d===l&&r.a.e.getAll(a,p)===l||(r.a.e.getAll(a,m)[b]=d)},getAll:function(e,f){var h=e[b];if(!(h&&"null"!==h)){if(!f)return;h=e[b]="ko"+a++;d[h]={}}return d[h]},clear:function(a){var f=a[b];f&&(delete d[f],a[b]=o)}}};r.b("ko.utils.domData",r.a.e);r.b("ko.utils.domData.clear",r.a.e.clear);
r.a.A=new function(){function a(a,b){var h=r.a.e.get(a,d);h===l&&b&&(h=[],r.a.e.set(a,d,h));return h}function b(e){var b=a(e,p);if(b)for(var b=b.slice(0),d=0;d<b.length;d++)b[d](e);r.a.e.clear(e);"function"==typeof jQuery&&"function"==typeof jQuery.cleanData&&jQuery.cleanData([e])}var d="__ko_domNodeDisposal__"+(new Date).getTime();return{va:function(e,b){"function"!=typeof b&&c(Error("Callback must be a function"));a(e,m).push(b)},Ia:function(e,b){var h=a(e,p);h&&(r.a.ca(h,b),0==h.length&&r.a.e.set(e,
d,l))},F:function(a){if(!(1!=a.nodeType&&9!=a.nodeType)){b(a);var f=[];r.a.J(f,a.getElementsByTagName("*"));for(var a=0,d=f.length;a<d;a++)b(f[a])}},removeNode:function(a){r.F(a);a.parentNode&&a.parentNode.removeChild(a)}}};r.F=r.a.A.F;r.removeNode=r.a.A.removeNode;r.b("ko.cleanNode",r.F);r.b("ko.removeNode",r.removeNode);r.b("ko.utils.domNodeDisposal",r.a.A);r.b("ko.utils.domNodeDisposal.addDisposeCallback",r.a.A.va);r.b("ko.utils.domNodeDisposal.removeDisposeCallback",r.a.A.Ia);
r.a.ma=function(a){var b;if("undefined"!=typeof jQuery){if((b=jQuery.clean([a]))&&b[0]){for(a=b[0];a.parentNode&&11!==a.parentNode.nodeType;)a=a.parentNode;a.parentNode&&a.parentNode.removeChild(a)}}else{var d=r.a.z(a).toLowerCase();b=document.createElement("div");d=d.match(/^<(thead|tbody|tfoot)/)&&[1,"<table>","</table>"]||!d.indexOf("<tr")&&[2,"<table><tbody>","</tbody></table>"]||(!d.indexOf("<td")||!d.indexOf("<th"))&&[3,"<table><tbody><tr>","</tr></tbody></table>"]||[0,"",""];a="ignored<div>"+
d[1]+a+d[2]+"</div>";for("function"==typeof window.innerShiv?b.appendChild(window.innerShiv(a)):b.innerHTML=a;d[0]--;)b=b.lastChild;b=r.a.X(b.lastChild.childNodes)}return b};r.a.Z=function(a,b){r.a.U(a);if(b!==o&&b!==l)if("string"!=typeof b&&(b=b.toString()),"undefined"!=typeof jQuery)jQuery(a).html(b);else for(var d=r.a.ma(b),e=0;e<d.length;e++)a.appendChild(d[e])};r.b("ko.utils.parseHtmlFragment",r.a.ma);r.b("ko.utils.setHtml",r.a.Z);
r.r=function(){function a(){return(4294967296*(1+Math.random())|0).toString(16).substring(1)}function b(a,f){if(a)if(8==a.nodeType){var d=r.r.Ga(a.nodeValue);d!=o&&f.push({cb:a,tb:d})}else if(1==a.nodeType)for(var d=0,g=a.childNodes,i=g.length;d<i;d++)b(g[d],f)}var d={};return{ka:function(b){"function"!=typeof b&&c(Error("You can only pass a function to ko.memoization.memoize()"));var f=a()+a();d[f]=b;return"<\!--[ko_memo:"+f+"]--\>"},Ra:function(a,b){var h=d[a];h===l&&c(Error("Couldn't find any memo with ID "+
a+". Perhaps it's already been unmemoized."));try{return h.apply(o,b||[]),m}finally{delete d[a]}},Sa:function(a,f){var d=[];b(a,d);for(var g=0,i=d.length;g<i;g++){var j=d[g].cb,k=[j];f&&r.a.J(k,f);r.r.Ra(d[g].tb,k);j.nodeValue="";j.parentNode&&j.parentNode.removeChild(j)}},Ga:function(a){return(a=a.match(/^\[ko_memo\:(.*?)\]$/))?a[1]:o}}}();r.b("ko.memoization",r.r);r.b("ko.memoization.memoize",r.r.ka);r.b("ko.memoization.unmemoize",r.r.Ra);r.b("ko.memoization.parseMemoText",r.r.Ga);
r.b("ko.memoization.unmemoizeDomNodeAndDescendants",r.r.Sa);r.Aa={throttle:function(a,b){a.throttleEvaluation=b;var d=o;return r.i({read:a,write:function(e){clearTimeout(d);d=setTimeout(function(){a(e)},b)}})},notify:function(a,b){a.equalityComparer="always"==b?function(){return p}:r.w.fn.equalityComparer;return a}};r.b("ko.extenders",r.Aa);r.Oa=function(a,b){this.da=a;this.bb=b;r.l(this,"dispose",this.v)};r.Oa.prototype.v=function(){this.nb=m;this.bb()};
r.R=function(){this.u={};r.a.extend(this,r.R.fn);r.l(this,"subscribe",this.ra);r.l(this,"extend",this.extend);r.l(this,"getSubscriptionsCount",this.kb)};
r.R.fn={ra:function(a,b,d){var d=d||"change",a=b?a.bind(b):a,e=new r.Oa(a,function(){r.a.ca(this.u[d],e)}.bind(this));this.u[d]||(this.u[d]=[]);this.u[d].push(e);return e},notifySubscribers:function(a,b){b=b||"change";this.u[b]&&r.a.n(this.u[b].slice(0),function(b){b&&b.nb!==m&&b.da(a)})},kb:function(){var a=0,b;for(b in this.u)this.u.hasOwnProperty(b)&&(a+=this.u[b].length);return a},extend:function(a){var b=this;if(a)for(var d in a){var e=r.Aa[d];"function"==typeof e&&(b=e(b,a[d]))}return b}};
r.Ea=function(a){return"function"==typeof a.ra&&"function"==typeof a.notifySubscribers};r.b("ko.subscribable",r.R);r.b("ko.isSubscribable",r.Ea);r.T=function(){var a=[];return{Xa:function(b){a.push({da:b,za:[]})},end:function(){a.pop()},Ha:function(b){r.Ea(b)||c("Only subscribable things can act as dependencies");if(0<a.length){var d=a[a.length-1];0<=r.a.k(d.za,b)||(d.za.push(b),d.da(b))}}}}();var B={undefined:m,"boolean":m,number:m,string:m};
r.w=function(a){function b(){if(0<arguments.length){if(!b.equalityComparer||!b.equalityComparer(d,arguments[0]))b.H(),d=arguments[0],b.G();return this}r.T.Ha(b);return d}var d=a;r.R.call(b);b.G=function(){b.notifySubscribers(d)};b.H=function(){b.notifySubscribers(d,"beforeChange")};r.a.extend(b,r.w.fn);r.l(b,"valueHasMutated",b.G);r.l(b,"valueWillMutate",b.H);return b};r.w.fn={B:r.w,equalityComparer:function(a,b){return a===o||typeof a in B?a===b:p}};
r.V=function(a){return a===o||a===l||a.B===l?p:a.B===r.w?m:r.V(a.B)};r.P=function(a){return"function"==typeof a&&a.B===r.w?m:"function"==typeof a&&a.B===r.i&&a.lb?m:p};r.b("ko.observable",r.w);r.b("ko.isObservable",r.V);r.b("ko.isWriteableObservable",r.P);
r.Q=function(a){0==arguments.length&&(a=[]);a!==o&&a!==l&&!("length"in a)&&c(Error("The argument passed when initializing an observable array must be an array, or null, or undefined."));var b=new r.w(a);r.a.extend(b,r.Q.fn);r.l(b,"remove",b.remove);r.l(b,"removeAll",b.zb);r.l(b,"destroy",b.fa);r.l(b,"destroyAll",b.ab);r.l(b,"indexOf",b.indexOf);r.l(b,"replace",b.replace);return b};
r.Q.fn={remove:function(a){for(var b=this(),d=[],e="function"==typeof a?a:function(b){return b===a},f=0;f<b.length;f++){var h=b[f];e(h)&&(0===d.length&&this.H(),d.push(h),b.splice(f,1),f--)}d.length&&this.G();return d},zb:function(a){if(a===l){var b=this(),d=b.slice(0);this.H();b.splice(0,b.length);this.G();return d}return!a?[]:this.remove(function(b){return 0<=r.a.k(a,b)})},fa:function(a){var b=this(),d="function"==typeof a?a:function(b){return b===a};this.H();for(var e=b.length-1;0<=e;e--)d(b[e])&&
(b[e]._destroy=m);this.G()},ab:function(a){return a===l?this.fa(function(){return m}):!a?[]:this.fa(function(b){return 0<=r.a.k(a,b)})},indexOf:function(a){var b=this();return r.a.k(b,a)},replace:function(a,b){var d=this.indexOf(a);0<=d&&(this.H(),this()[d]=b,this.G())}};r.a.n("pop,push,reverse,shift,sort,splice,unshift".split(","),function(a){r.Q.fn[a]=function(){var b=this();this.H();b=b[a].apply(b,arguments);this.G();return b}});
r.a.n(["slice"],function(a){r.Q.fn[a]=function(){var b=this();return b[a].apply(b,arguments)}});r.b("ko.observableArray",r.Q);function C(a,b){a&&"object"==typeof a?b=a:(b=b||{},b.read=a||b.read);"function"!=typeof b.read&&c("Pass a function that returns the value of the dependentObservable");return b}
r.i=function(a,b,d){function e(){r.a.n(q,function(a){a.v()});q=[]}function f(){var a=g.throttleEvaluation;a&&0<=a?(clearTimeout(v),v=setTimeout(h,a)):h()}function h(){if(j&&"function"==typeof d.disposeWhen&&d.disposeWhen())g.v();else{try{e();r.T.Xa(function(a){q.push(a.ra(f))});var a=d.read.call(d.owner||b);g.notifySubscribers(i,"beforeChange");i=a}finally{r.T.end()}g.notifySubscribers(i);j=m}}function g(){if(0<arguments.length)"function"===typeof d.write?d.write.apply(d.owner||b,arguments):c("Cannot write a value to a dependentObservable unless you specify a 'write' option. If you wish to read the current value, don't pass any parameters.");
else return j||h(),r.T.Ha(g),i}var i,j=p,d=C(a,d),k="object"==typeof d.disposeWhenNodeIsRemoved?d.disposeWhenNodeIsRemoved:o,n=o;if(k){n=function(){g.v()};r.a.A.va(k,n);var t=d.disposeWhen;d.disposeWhen=function(){return!r.a.ga(k)||"function"==typeof t&&t()}}var q=[],v=o;g.jb=function(){return q.length};g.lb="function"===typeof d.write;g.v=function(){k&&r.a.A.Ia(k,n);e()};r.R.call(g);r.a.extend(g,r.i.fn);d.deferEvaluation!==m&&h();r.l(g,"dispose",g.v);r.l(g,"getDependenciesCount",g.jb);return g};
r.i.fn={B:r.i};r.i.B=r.w;r.b("ko.dependentObservable",r.i);r.b("ko.computed",r.i);
(function(){function a(e,f,h){h=h||new d;e=f(e);if(!("object"==typeof e&&e!==o&&e!==l&&!(e instanceof Date)))return e;var g=e instanceof Array?[]:{};h.save(e,g);b(e,function(b){var d=f(e[b]);switch(typeof d){case "boolean":case "number":case "string":case "function":g[b]=d;break;case "object":case "undefined":var k=h.get(d);g[b]=k!==l?k:a(d,f,h)}});return g}function b(a,b){if(a instanceof Array)for(var d=0;d<a.length;d++)b(d);else for(d in a)b(d)}function d(){var a=[],b=[];this.save=function(d,g){var i=
r.a.k(a,d);0<=i?b[i]=g:(a.push(d),b.push(g))};this.get=function(d){d=r.a.k(a,d);return 0<=d?b[d]:l}}r.Pa=function(b){0==arguments.length&&c(Error("When calling ko.toJS, pass the object you want to convert."));return a(b,function(a){for(var b=0;r.V(a)&&10>b;b++)a=a();return a})};r.toJSON=function(a){a=r.Pa(a);return r.a.qa(a)}})();r.b("ko.toJS",r.Pa);r.b("ko.toJSON",r.toJSON);
r.h={q:function(a){return"OPTION"==a.tagName?a.__ko__hasDomDataOptionValue__===m?r.a.e.get(a,r.c.options.la):a.getAttribute("value"):"SELECT"==a.tagName?0<=a.selectedIndex?r.h.q(a.options[a.selectedIndex]):l:a.value},S:function(a,b){if("OPTION"==a.tagName)switch(typeof b){case "string":r.a.e.set(a,r.c.options.la,l);"__ko__hasDomDataOptionValue__"in a&&delete a.__ko__hasDomDataOptionValue__;a.value=b;break;default:r.a.e.set(a,r.c.options.la,b),a.__ko__hasDomDataOptionValue__=m,a.value="number"===typeof b?
b:""}else if("SELECT"==a.tagName)for(var d=a.options.length-1;0<=d;d--){if(r.h.q(a.options[d])==b){a.selectedIndex=d;break}}else{if(b===o||b===l)b="";a.value=b}}};r.b("ko.selectExtensions",r.h);r.b("ko.selectExtensions.readValue",r.h.q);r.b("ko.selectExtensions.writeValue",r.h.S);
r.j=function(){function a(a,e){for(var d=o;a!=d;)d=a,a=a.replace(b,function(a,b){return e[b]});return a}var b=/\@ko_token_(\d+)\@/g,d=/^[\_$a-z][\_$a-z0-9]*(\[.*?\])*(\.[\_$a-z][\_$a-z0-9]*(\[.*?\])*)*$/i,e=["true","false"];return{D:[],Y:function(b){var e=r.a.z(b);if(3>e.length)return[];"{"===e.charAt(0)&&(e=e.substring(1,e.length-1));for(var b=[],d=o,i,j=0;j<e.length;j++){var k=e.charAt(j);if(d===o)switch(k){case '"':case "'":case "/":d=j,i=k}else if(k==i&&"\\"!==e.charAt(j-1)){k=e.substring(d,j+
1);b.push(k);var n="@ko_token_"+(b.length-1)+"@",e=e.substring(0,d)+n+e.substring(j+1),j=j-(k.length-n.length),d=o}}i=d=o;for(var t=0,q=o,j=0;j<e.length;j++){k=e.charAt(j);if(d===o)switch(k){case "{":d=j;q=k;i="}";break;case "(":d=j;q=k;i=")";break;case "[":d=j,q=k,i="]"}k===q?t++:k===i&&(t--,0===t&&(k=e.substring(d,j+1),b.push(k),n="@ko_token_"+(b.length-1)+"@",e=e.substring(0,d)+n+e.substring(j+1),j-=k.length-n.length,d=o))}i=[];e=e.split(",");d=0;for(j=e.length;d<j;d++)t=e[d],q=t.indexOf(":"),
0<q&&q<t.length-1?(k=t.substring(q+1),i.push({key:a(t.substring(0,q),b),value:a(k,b)})):i.push({unknown:a(t,b)});return i},ia:function(a){for(var b="string"===typeof a?r.j.Y(a):a,g=[],a=[],i,j=0;i=b[j];j++)if(0<g.length&&g.push(","),i.key){var k;a:{k=i.key;var n=r.a.z(k);switch(n.length&&n.charAt(0)){case "'":case '"':break a;default:k="'"+n+"'"}}i=i.value;g.push(k);g.push(":");g.push(i);n=r.a.z(i);if(0<=r.a.k(e,r.a.z(n).toLowerCase())?0:n.match(d)!==o)0<a.length&&a.push(", "),a.push(k+" : function(__ko_value) { "+
i+" = __ko_value; }")}else i.unknown&&g.push(i.unknown);b=g.join("");0<a.length&&(b=b+", '_ko_property_writers' : { "+a.join("")+" } ");return b},rb:function(a,b){for(var e=0;e<a.length;e++)if(r.a.z(a[e].key)==b)return m;return p}}}();r.b("ko.jsonExpressionRewriting",r.j);r.b("ko.jsonExpressionRewriting.bindingRewriteValidators",r.j.D);r.b("ko.jsonExpressionRewriting.parseObjectLiteral",r.j.Y);r.b("ko.jsonExpressionRewriting.insertPropertyAccessorsIntoJson",r.j.ia);
(function(){function a(a){return 8==a.nodeType&&(f?a.text:a.nodeValue).match(h)}function b(a){return 8==a.nodeType&&(f?a.text:a.nodeValue).match(g)}function d(e,d){for(var f=e,g=1,h=[];f=f.nextSibling;){if(b(f)&&(g--,0===g))return h;h.push(f);a(f)&&g++}d||c(Error("Cannot find closing comment tag to match: "+e.nodeValue));return o}function e(a,b){var e=d(a,b);return e?0<e.length?e[e.length-1].nextSibling:a.nextSibling:o}var f="<\!--test--\>"===document.createComment("test").text,h=f?/^<\!--\s*ko\s+(.*\:.*)\s*--\>$/:
/^\s*ko\s+(.*\:.*)\s*$/,g=f?/^<\!--\s*\/ko\s*--\>$/:/^\s*\/ko\s*$/,i={ul:m,ol:m};r.f={C:{},childNodes:function(b){return a(b)?d(b):b.childNodes},ha:function(b){if(a(b))for(var b=r.f.childNodes(b),e=0,d=b.length;e<d;e++)r.removeNode(b[e]);else r.a.U(b)},oa:function(b,e){if(a(b)){r.f.ha(b);for(var d=b.nextSibling,f=0,g=e.length;f<g;f++)d.parentNode.insertBefore(e[f],d)}else r.a.oa(b,e)},xb:function(b,e){a(b)?b.parentNode.insertBefore(e,b.nextSibling):b.firstChild?b.insertBefore(e,b.firstChild):b.appendChild(e)},
mb:function(b,e,d){a(b)?b.parentNode.insertBefore(e,d.nextSibling):d.nextSibling?b.insertBefore(e,d.nextSibling):b.appendChild(e)},nextSibling:function(d){return a(d)?e(d).nextSibling:d.nextSibling&&b(d.nextSibling)?l:d.nextSibling},ta:function(b){return(b=a(b))?b[1]:o},ib:function(a){if(r.f.ta(a)){var b;b=r.f.childNodes(a);for(var e=[],d=0,f=b.length;d<f;d++)r.a.A.F(b[d]),e.push(r.a.outerHTML(b[d]));b=String.prototype.concat.apply("",e);r.f.ha(a);(new r.m.I(a)).text(b)}},Fa:function(d){if(i[d.tagName.toLowerCase()]){var f=
d.firstChild;if(f){do if(1===f.nodeType){var g;g=f.firstChild;var h=o;if(g){do if(h)h.push(g);else if(a(g)){var q=e(g,m);q?g=q:h=[g]}else b(g)&&(h=[g]);while(g=g.nextSibling)}if(g=h){h=f.nextSibling;for(q=0;q<g.length;q++)h?d.insertBefore(g[q],h):d.appendChild(g[q])}}while(f=f.nextSibling)}}}}})();r.L=function(){};
r.a.extend(r.L.prototype,{nodeHasBindings:function(a){switch(a.nodeType){case 1:return a.getAttribute("data-bind")!=o;case 8:return r.f.ta(a)!=o;default:return p}},getBindings:function(a,b){var d=this.getBindingsString(a,b);return d?this.parseBindingsString(d,b):o},getBindingsString:function(a){switch(a.nodeType){case 1:return a.getAttribute("data-bind");case 8:return r.f.ta(a);default:return o}},parseBindingsString:function(a,b){try{var d=b.$data,e=" { "+r.j.ia(a)+" } ";return r.a.hb(e,d===o?window:
d,b)}catch(f){c(Error("Unable to parse bindings.\nMessage: "+f+";\nBindings value: "+a))}}});r.L.instance=new r.L;r.b("ko.bindingProvider",r.L);
(function(){function a(a,d){for(var h,g=d.childNodes[0];h=g;)g=r.f.nextSibling(h),b(a,h,p)}function b(b,f,h){var g=m,i=1==f.nodeType;i&&r.f.Fa(f);if(i&&h||r.L.instance.nodeHasBindings(f))g=d(f,o,b,h).Bb;i&&g&&a(b,f)}function d(a,b,d,g){function i(a){return function(){return n[a]}}function j(){return n}var k=0;r.f.ib(a);var n,t;new r.i(function(){var q=d&&d instanceof r.K?d:new r.K(r.a.d(d)),v=q.$data;g&&r.Na(a,q);if(n=("function"==typeof b?b():b)||r.L.instance.getBindings(a,q)){if(0===k){k=1;for(var s in n){var w=
r.c[s];w&&8===a.nodeType&&!r.f.C[s]&&c(Error("The binding '"+s+"' cannot be used with virtual elements"));if(w&&"function"==typeof w.init&&(w=(0,w.init)(a,i(s),j,v,q))&&w.controlsDescendantBindings)t!==l&&c(Error("Multiple bindings ("+t+" and "+s+") are trying to control descendant bindings of the same element. You cannot use these bindings together on the same element.")),t=s}k=2}if(2===k)for(s in n)(w=r.c[s])&&"function"==typeof w.update&&(0,w.update)(a,i(s),j,v,q)}},o,{disposeWhenNodeIsRemoved:a});
return{Bb:t===l}}r.c={};r.K=function(a,b){this.$data=a;b?(this.$parent=b.$data,this.$parents=(b.$parents||[]).slice(0),this.$parents.unshift(this.$parent),this.$root=b.$root):(this.$parents=[],this.$root=a)};r.K.prototype.createChildContext=function(a){return new r.K(a,this)};r.Na=function(a,b){if(2==arguments.length)r.a.e.set(a,"__ko_bindingContext__",b);else return r.a.e.get(a,"__ko_bindingContext__")};r.xa=function(a,b,h){1===a.nodeType&&r.f.Fa(a);return d(a,b,h,m)};r.Ta=function(b,d){1===d.nodeType&&
a(b,d)};r.wa=function(a,d){d&&1!==d.nodeType&&8!==d.nodeType&&c(Error("ko.applyBindings: first parameter should be your view model; second parameter should be a DOM node"));d=d||window.document.body;b(a,d,m)};r.ea=function(a){switch(a.nodeType){case 1:case 8:var b=r.Na(a);if(b)return b;if(a.parentNode)return r.ea(a.parentNode)}};r.$a=function(a){return(a=r.ea(a))?a.$data:l};r.b("ko.bindingHandlers",r.c);r.b("ko.applyBindings",r.wa);r.b("ko.applyBindingsToDescendants",r.Ta);r.b("ko.applyBindingsToNode",
r.xa);r.b("ko.contextFor",r.ea);r.b("ko.dataFor",r.$a)})();r.a.n(["click"],function(a){r.c[a]={init:function(b,d,e,f){return r.c.event.init.call(this,b,function(){var b={};b[a]=d();return b},e,f)}}});
r.c.event={init:function(a,b,d,e){var f=b()||{},h;for(h in f)(function(){var f=h;"string"==typeof f&&r.a.s(a,f,function(a){var h,k=b()[f];if(k){var n=d();try{var t=r.a.X(arguments);t.unshift(e);h=k.apply(e,t)}finally{if(h!==m)a.preventDefault?a.preventDefault():a.returnValue=p}if(n[f+"Bubble"]===p)a.cancelBubble=m,a.stopPropagation&&a.stopPropagation()}})})()}};
r.c.submit={init:function(a,b,d,e){"function"!=typeof b()&&c(Error("The value for a submit binding must be a function"));r.a.s(a,"submit",function(d){var h,g=b();try{h=g.call(e,a)}finally{if(h!==m)d.preventDefault?d.preventDefault():d.returnValue=p}})}};r.c.visible={update:function(a,b){var d=r.a.d(b()),e="none"!=a.style.display;if(d&&!e)a.style.display="";else if(!d&&e)a.style.display="none"}};
r.c.enable={update:function(a,b){var d=r.a.d(b());if(d&&a.disabled)a.removeAttribute("disabled");else if(!d&&!a.disabled)a.disabled=m}};r.c.disable={update:function(a,b){r.c.enable.update(a,function(){return!r.a.d(b())})}};function D(a,b,d){d&&b!==r.h.q(a)&&r.h.S(a,b);b!==r.h.q(a)&&r.a.sa(a,"change")}
r.c.value={init:function(a,b,d){var e=["change"],f=d().valueUpdate;f&&("string"==typeof f&&(f=[f]),r.a.J(e,f),e=r.a.ya(e));r.a.n(e,function(e){var f=p;r.a.Cb(e,"after")&&(f=m,e=e.substring(5));var i=f?function(a){setTimeout(a,0)}:function(a){a()};r.a.s(a,e,function(){i(function(){var e=b(),f=r.h.q(a);r.P(e)?e(f):(e=d(),e._ko_property_writers&&e._ko_property_writers.value&&e._ko_property_writers.value(f))})})})},update:function(a,b){var d=r.a.d(b()),e=r.h.q(a),f=d!=e;0===d&&0!==e&&"0"!==e&&(f=m);f&&
(e=function(){r.h.S(a,d)},e(),"SELECT"==a.tagName&&setTimeout(e,0));"SELECT"==a.tagName&&0<a.length&&D(a,d,p)}};
r.c.options={update:function(a,b,d){"SELECT"!=a.tagName&&c(Error("options binding applies only to SELECT elements"));var e=0==a.length,f=r.a.ba(r.a.aa(a.childNodes,function(a){return a.tagName&&"OPTION"==a.tagName&&a.selected}),function(a){return r.h.q(a)||a.innerText||a.textContent}),h=a.scrollTop;a.scrollTop=0;for(var g=r.a.d(b());0<a.length;)r.F(a.options[0]),a.remove(0);if(g){d=d();"number"!=typeof g.length&&(g=[g]);if(d.optionsCaption){var i=document.createElement("OPTION");r.a.Z(i,d.optionsCaption);
r.h.S(i,l);a.appendChild(i)}for(var b=0,j=g.length;b<j;b++){var i=document.createElement("OPTION"),k="string"==typeof d.optionsValue?g[b][d.optionsValue]:g[b],k=r.a.d(k);r.h.S(i,k);var n=d.optionsText,k="function"==typeof n?n(g[b]):"string"==typeof n?g[b][n]:k;if(k===o||k===l)k="";r.a.Ma(i,k);a.appendChild(i)}g=a.getElementsByTagName("OPTION");b=i=0;for(j=g.length;b<j;b++)0<=r.a.k(f,r.h.q(g[b]))&&(r.a.La(g[b],m),i++);if(h)a.scrollTop=h;e&&"value"in d&&D(a,r.a.d(d.value),m)}}};r.c.options.la="__ko.optionValueDomData__";
r.c.selectedOptions={Da:function(a){for(var b=[],a=a.childNodes,d=0,e=a.length;d<e;d++){var f=a[d];"OPTION"==f.tagName&&f.selected&&b.push(r.h.q(f))}return b},init:function(a,b,d){r.a.s(a,"change",function(){var a=b();r.P(a)?a(r.c.selectedOptions.Da(this)):(a=d(),a._ko_property_writers&&a._ko_property_writers.value&&a._ko_property_writers.value(r.c.selectedOptions.Da(this)))})},update:function(a,b){"SELECT"!=a.tagName&&c(Error("values binding applies only to SELECT elements"));var d=r.a.d(b());if(d&&
"number"==typeof d.length)for(var e=a.childNodes,f=0,h=e.length;f<h;f++){var g=e[f];"OPTION"==g.tagName&&r.a.La(g,0<=r.a.k(d,r.h.q(g)))}}};r.c.text={update:function(a,b){r.a.Ma(a,b())}};r.c.html={init:function(){return{controlsDescendantBindings:m}},update:function(a,b){var d=r.a.d(b());r.a.Z(a,d)}};r.c.css={update:function(a,b){var d=r.a.d(b()||{}),e;for(e in d)if("string"==typeof e){var f=r.a.d(d[e]);r.a.Qa(a,e,f)}}};
r.c.style={update:function(a,b){var d=r.a.d(b()||{}),e;for(e in d)if("string"==typeof e){var f=r.a.d(d[e]);a.style[e]=f||""}}};r.c.uniqueName={init:function(a,b){if(b())a.name="ko_unique_"+ ++r.c.uniqueName.Za,(r.a.ob||r.a.pb)&&a.mergeAttributes(document.createElement("<input name='"+a.name+"'/>"),p)}};r.c.uniqueName.Za=0;
r.c.checked={init:function(a,b,d){r.a.s(a,"click",function(){var e;if("checkbox"==a.type)e=a.checked;else if("radio"==a.type&&a.checked)e=a.value;else return;var f=b();"checkbox"==a.type&&r.a.d(f)instanceof Array?(e=r.a.k(r.a.d(f),a.value),a.checked&&0>e?f.push(a.value):!a.checked&&0<=e&&f.splice(e,1)):r.P(f)?f()!==e&&f(e):(f=d(),f._ko_property_writers&&f._ko_property_writers.checked&&f._ko_property_writers.checked(e))});"radio"==a.type&&!a.name&&r.c.uniqueName.init(a,function(){return m})},update:function(a,
b){var d=r.a.d(b());if("checkbox"==a.type)a.checked=d instanceof Array?0<=r.a.k(d,a.value):d;else if("radio"==a.type)a.checked=a.value==d}};r.c.attr={update:function(a,b){var d=r.a.d(b())||{},e;for(e in d)if("string"==typeof e){var f=r.a.d(d[e]);f===p||f===o||f===l?a.removeAttribute(e):a.setAttribute(e,f.toString())}}};
r.c.hasfocus={init:function(a,b,d){function e(a){var e=b();a!=r.a.d(e)&&(r.P(e)?e(a):(e=d(),e._ko_property_writers&&e._ko_property_writers.hasfocus&&e._ko_property_writers.hasfocus(a)))}r.a.s(a,"focus",function(){e(m)});r.a.s(a,"focusin",function(){e(m)});r.a.s(a,"blur",function(){e(p)});r.a.s(a,"focusout",function(){e(p)})},update:function(a,b){var d=r.a.d(b());d?a.focus():a.blur();r.a.sa(a,d?"focusin":"focusout")}};
r.c["with"]={o:function(a){return function(){var b=a();return{"if":b,data:b,templateEngine:r.p.M}}},init:function(a,b){return r.c.template.init(a,r.c["with"].o(b))},update:function(a,b,d,e,f){return r.c.template.update(a,r.c["with"].o(b),d,e,f)}};r.j.D["with"]=p;r.f.C["with"]=m;r.c["if"]={o:function(a){return function(){return{"if":a(),templateEngine:r.p.M}}},init:function(a,b){return r.c.template.init(a,r.c["if"].o(b))},update:function(a,b,d,e,f){return r.c.template.update(a,r.c["if"].o(b),d,e,f)}};
r.j.D["if"]=p;r.f.C["if"]=m;r.c.ifnot={o:function(a){return function(){return{ifnot:a(),templateEngine:r.p.M}}},init:function(a,b){return r.c.template.init(a,r.c.ifnot.o(b))},update:function(a,b,d,e,f){return r.c.template.update(a,r.c.ifnot.o(b),d,e,f)}};r.j.D.ifnot=p;r.f.C.ifnot=m;
r.c.foreach={o:function(a){return function(){var b=r.a.d(a());return!b||"number"==typeof b.length?{foreach:b,templateEngine:r.p.M}:{foreach:b.data,includeDestroyed:b.includeDestroyed,afterAdd:b.afterAdd,beforeRemove:b.beforeRemove,afterRender:b.afterRender,templateEngine:r.p.M}}},init:function(a,b){return r.c.template.init(a,r.c.foreach.o(b))},update:function(a,b,d,e,f){return r.c.template.update(a,r.c.foreach.o(b),d,e,f)}};r.j.D.foreach=p;r.f.C.foreach=m;r.b("ko.allowedVirtualElementBindings",r.f.C);
r.t=function(){};r.t.prototype.renderTemplateSource=function(){c("Override renderTemplateSource")};r.t.prototype.createJavaScriptEvaluatorBlock=function(){c("Override createJavaScriptEvaluatorBlock")};r.t.prototype.makeTemplateSource=function(a){if("string"==typeof a){var b=document.getElementById(a);b||c(Error("Cannot find template with ID "+a));return new r.m.g(b)}if(1==a.nodeType||8==a.nodeType)return new r.m.I(a);c(Error("Unknown template type: "+a))};
r.t.prototype.renderTemplate=function(a,b,d){return this.renderTemplateSource(this.makeTemplateSource(a),b,d)};r.t.prototype.isTemplateRewritten=function(a){return this.allowTemplateRewriting===p?m:this.W&&this.W[a]?m:this.makeTemplateSource(a).data("isRewritten")};r.t.prototype.rewriteTemplate=function(a,b){var d=this.makeTemplateSource(a),e=b(d.text());d.text(e);d.data("isRewritten",m);if("string"==typeof a)this.W=this.W||{},this.W[a]=m};r.b("ko.templateEngine",r.t);
r.$=function(){function a(a,b,d){for(var a=r.j.Y(a),g=r.j.D,i=0;i<a.length;i++){var j=a[i].key;if(g.hasOwnProperty(j)){var k=g[j];"function"===typeof k?(j=k(a[i].value))&&c(Error(j)):k||c(Error("This template engine does not support the '"+j+"' binding within its templates"))}}a="ko.templateRewriting.applyMemoizedBindingsToNextSibling(function() {             return (function() { return { "+r.j.ia(a)+" } })()         })";return d.createJavaScriptEvaluatorBlock(a)+b}var b=/(<[a-z]+\d*(\s+(?!data-bind=)[a-z0-9\-]+(=(\"[^\"]*\"|\'[^\']*\'))?)*\s+)data-bind=(["'])([\s\S]*?)\5/gi,
d=/<\!--\s*ko\b\s*([\s\S]*?)\s*--\>/g;return{gb:function(a,b){b.isTemplateRewritten(a)||b.rewriteTemplate(a,function(a){return r.$.ub(a,b)})},ub:function(e,f){return e.replace(b,function(b,e,d,j,k,n,t){return a(t,e,f)}).replace(d,function(b,e){return a(e,"<\!-- ko --\>",f)})},Ua:function(a){return r.r.ka(function(b,d){b.nextSibling&&r.xa(b.nextSibling,a,d)})}}}();r.b("ko.templateRewriting",r.$);r.b("ko.templateRewriting.applyMemoizedBindingsToNextSibling",r.$.Ua);r.m={};r.m.g=function(a){this.g=a};
r.m.g.prototype.text=function(){if(0==arguments.length)return"script"==this.g.tagName.toLowerCase()?this.g.text:this.g.innerHTML;var a=arguments[0];"script"==this.g.tagName.toLowerCase()?this.g.text=a:r.a.Z(this.g,a)};r.m.g.prototype.data=function(a){if(1===arguments.length)return r.a.e.get(this.g,"templateSourceData_"+a);r.a.e.set(this.g,"templateSourceData_"+a,arguments[1])};r.m.I=function(a){this.g=a};r.m.I.prototype=new r.m.g;
r.m.I.prototype.text=function(){if(0==arguments.length)return r.a.e.get(this.g,"__ko_anon_template__");r.a.e.set(this.g,"__ko_anon_template__",arguments[0])};r.b("ko.templateSources",r.m);r.b("ko.templateSources.domElement",r.m.g);r.b("ko.templateSources.anonymousTemplate",r.m.I);
(function(){function a(a,b,d){for(var g=0;node=a[g];g++)node.parentNode===b&&(1===node.nodeType||8===node.nodeType)&&d(node)}function b(a,b,h,g,i){var i=i||{},j=i.templateEngine||d;r.$.gb(h,j);h=j.renderTemplate(h,g,i);("number"!=typeof h.length||0<h.length&&"number"!=typeof h[0].nodeType)&&c("Template engine must return an array of DOM nodes");j=p;switch(b){case "replaceChildren":r.f.oa(a,h);j=m;break;case "replaceNode":r.a.Ja(a,h);j=m;break;case "ignoreTargetNode":break;default:c(Error("Unknown renderMode: "+
b))}j&&(r.ua(h,g),i.afterRender&&i.afterRender(h,g.$data));return h}var d;r.pa=function(a){a!=l&&!(a instanceof r.t)&&c("templateEngine must inherit from ko.templateEngine");d=a};r.ua=function(b,d){var h=r.a.J([],b),g=0<b.length?b[0].parentNode:o;a(h,g,function(a){r.wa(d,a)});a(h,g,function(a){r.r.Sa(a,[d])})};r.na=function(a,f,h,g,i){h=h||{};(h.templateEngine||d)==l&&c("Set a template engine before calling renderTemplate");i=i||"replaceChildren";if(g){var j=g.nodeType?g:0<g.length?g[0]:o;return new r.i(function(){var d=
f&&f instanceof r.K?f:new r.K(r.a.d(f)),n="function"==typeof a?a(d.$data):a,d=b(g,i,n,d,h);"replaceNode"==i&&(g=d,j=g.nodeType?g:0<g.length?g[0]:o)},o,{disposeWhen:function(){return!j||!r.a.ga(j)},disposeWhenNodeIsRemoved:j&&"replaceNode"==i?j.parentNode:j})}return r.r.ka(function(b){r.na(a,f,h,b,"replaceNode")})};r.Ab=function(a,d,h,g,i){function j(a,b){var d=k(a);r.ua(b,d);h.afterRender&&h.afterRender(b,d.$data)}function k(a){return i.createChildContext(r.a.d(a))}return new r.i(function(){var i=
r.a.d(d)||[];"undefined"==typeof i.length&&(i=[i]);i=r.a.aa(i,function(a){return h.includeDestroyed||a===l||a===o||!r.a.d(a._destroy)});r.a.Ka(g,i,function(d){var f="function"==typeof a?a(d):a;return b(o,"ignoreTargetNode",f,k(d),h)},h,j)},o,{disposeWhenNodeIsRemoved:g})};r.c.template={init:function(a,b){var d=r.a.d(b());"string"!=typeof d&&!d.name&&1==a.nodeType&&((new r.m.I(a)).text(a.innerHTML),r.a.U(a));return{controlsDescendantBindings:m}},update:function(a,b,d,g,i){b=r.a.d(b());g=m;"string"==
typeof b?d=b:(d=b.name,"if"in b&&(g=g&&r.a.d(b["if"])),"ifnot"in b&&(g=g&&!r.a.d(b.ifnot)));var j=o;"object"===typeof b&&"foreach"in b?j=r.Ab(d||a,g&&b.foreach||[],b,a,i):g?(i="object"==typeof b&&"data"in b?i.createChildContext(r.a.d(b.data)):i,j=r.na(d||a,i,b,a)):r.f.ha(a);i=j;(b=r.a.e.get(a,"__ko__templateSubscriptionDomDataKey__"))&&"function"==typeof b.v&&b.v();r.a.e.set(a,"__ko__templateSubscriptionDomDataKey__",i)}};r.j.D.template=function(a){a=r.j.Y(a);return 1==a.length&&a[0].unknown?o:r.j.rb(a,
"name")?o:"This template engine does not support anonymous templates nested within its templates"};r.f.C.template=m})();r.b("ko.setTemplateEngine",r.pa);r.b("ko.renderTemplate",r.na);
r.a.N=function(a,b,d){if(d===l)return r.a.N(a,b,1)||r.a.N(a,b,10)||r.a.N(a,b,Number.MAX_VALUE);for(var a=a||[],b=b||[],e=a,f=b,h=[],g=0;g<=f.length;g++)h[g]=[];for(var g=0,i=Math.min(e.length,d);g<=i;g++)h[0][g]=g;g=1;for(i=Math.min(f.length,d);g<=i;g++)h[g][0]=g;for(var i=e.length,j,k=f.length,g=1;g<=i;g++){j=Math.max(1,g-d);for(var n=Math.min(k,g+d);j<=n;j++)h[j][g]=e[g-1]===f[j-1]?h[j-1][g-1]:Math.min(h[j-1][g]===l?Number.MAX_VALUE:h[j-1][g]+1,h[j][g-1]===l?Number.MAX_VALUE:h[j][g-1]+1)}d=a.length;
e=b.length;f=[];g=h[e][d];if(g===l)h=o;else{for(;0<d||0<e;){i=h[e][d];k=0<e?h[e-1][d]:g+1;n=0<d?h[e][d-1]:g+1;j=0<e&&0<d?h[e-1][d-1]:g+1;if(k===l||k<i-1)k=g+1;if(n===l||n<i-1)n=g+1;j<i-1&&(j=g+1);k<=n&&k<j?(f.push({status:"added",value:b[e-1]}),e--):(n<k&&n<j?f.push({status:"deleted",value:a[d-1]}):(f.push({status:"retained",value:a[d-1]}),e--),d--)}h=f.reverse()}return h};r.b("ko.utils.compareArrays",r.a.N);
(function(){function a(a){if(2<a.length){for(var b=a[0],f=a[a.length-1],h=[b];b!==f;){b=b.nextSibling;if(!b)return;h.push(b)}Array.prototype.splice.apply(a,[0,a.length].concat(h))}}function b(b,e,f,h){var g=[],b=r.i(function(){var b=e(f)||[];0<g.length&&(a(g),r.a.Ja(g,b),h&&h(f,b));g.splice(0,g.length);r.a.J(g,b)},o,{disposeWhenNodeIsRemoved:b,disposeWhen:function(){return 0==g.length||!r.a.ga(g[0])}});return{sb:g,i:b}}r.a.Ka=function(d,e,f,h,g){for(var e=e||[],h=h||{},i=r.a.e.get(d,"setDomNodeChildrenFromArrayMapping_lastMappingResult")===
l,j=r.a.e.get(d,"setDomNodeChildrenFromArrayMapping_lastMappingResult")||[],k=r.a.ba(j,function(a){return a.Va}),n=r.a.N(k,e),e=[],t=0,q=[],k=[],v=o,s=0,w=n.length;s<w;s++)switch(n[s].status){case "retained":var x=j[t];e.push(x);0<x.O.length&&(v=x.O[x.O.length-1]);t++;break;case "deleted":j[t].i.v();a(j[t].O);r.a.n(j[t].O,function(a){q.push({element:a,index:s,value:n[s].value});v=a});t++;break;case "added":var x=n[s].value,z=b(d,f,x,g),u=z.sb;e.push({Va:n[s].value,O:u,i:z.i});for(var z=0,y=u.length;z<
y;z++){var A=u[z];k.push({element:A,index:s,value:n[s].value});v==o?r.f.xb(d,A):r.f.mb(d,A,v);v=A}g&&g(x,u)}r.a.n(q,function(a){r.F(a.element)});f=p;if(!i){if(h.afterAdd)for(s=0;s<k.length;s++)h.afterAdd(k[s].element,k[s].index,k[s].value);if(h.beforeRemove){for(s=0;s<q.length;s++)h.beforeRemove(q[s].element,q[s].index,q[s].value);f=m}}f||r.a.n(q,function(a){r.removeNode(a.element)});r.a.e.set(d,"setDomNodeChildrenFromArrayMapping_lastMappingResult",e)}})();
r.b("ko.utils.setDomNodeChildrenFromArrayMapping",r.a.Ka);r.p=function(){this.allowTemplateRewriting=p};r.p.prototype=new r.t;r.p.prototype.renderTemplateSource=function(a){a=a.text();return r.a.ma(a)};r.p.M=new r.p;r.pa(r.p.M);r.b("ko.nativeTemplateEngine",r.p);
(function(){r.ja=function(){var a=this.qb=function(){if("undefined"==typeof jQuery||!jQuery.tmpl)return 0;try{if(0<=jQuery.tmpl.tag.tmpl.open.toString().indexOf("__"))return 2}catch(a){}return 1}();this.renderTemplateSource=function(d,e,f){f=f||{};2>a&&c(Error("Your version of jQuery.tmpl is too old. Please upgrade to jQuery.tmpl 1.0.0pre or later."));var h=d.data("precompiled");h||(h=d.text()||"",h=jQuery.template(o,"{{ko_with $item.koBindingContext}}"+h+"{{/ko_with}}"),d.data("precompiled",h));
d=[e.$data];e=jQuery.extend({koBindingContext:e},f.templateOptions);e=jQuery.tmpl(h,d,e);e.appendTo(document.createElement("div"));jQuery.fragments={};return e};this.createJavaScriptEvaluatorBlock=function(a){return"{{ko_code ((function() { return "+a+" })()) }}"};this.addTemplate=function(a,b){document.write("<script type='text/html' id='"+a+"'>"+b+"<\/script>")};if(0<a)jQuery.tmpl.tag.ko_code={open:"__.push($1 || '');"},jQuery.tmpl.tag.ko_with={open:"with($1) {",close:"} "}};r.ja.prototype=new r.t;
var a=new r.ja;0<a.qb&&r.pa(a);r.b("ko.jqueryTmplTemplateEngine",r.ja)})();
})(window);                  
// Knockout Mapping plugin v2.0.2
// (c) 2011 Steven Sanderson, Roy Jacobs - http://knockoutjs.com/
// License: Ms-Pl (http://www.opensource.org/licenses/ms-pl.html)

ko.exportSymbol=function(g,r){for(var h=g.split("."),i=window,e=0;e<h.length-1;e++)i=i[h[e]];i[h[h.length-1]]=r};ko.exportProperty=function(g,r,h){g[r]=h};
(function(){function g(a,c){for(var b in c)c.hasOwnProperty(b)&&c[b]&&(b&&a[b]&&!(a[b]instanceof Array)?g(a[b],c[b]):a[b]=c[b])}function r(a,c){var b={};g(b,a);g(b,c);return b}function h(a){return a&&typeof a==="object"&&a.constructor==(new Date).constructor?"date":typeof a}function i(a,c){a=a||{};if(a.create instanceof Function||a.update instanceof Function||a.key instanceof Function||a.arrayChanged instanceof Function)a={"":a};if(c)a.ignore=e(c.ignore,a.ignore),a.include=e(c.include,a.include),
a.copy=e(c.copy,a.copy);a.ignore=e(a.ignore,l.ignore);a.include=e(a.include,l.include);a.copy=e(a.copy,l.copy);a.mappedProperties=a.mappedProperties||{};return a}function e(a,c){a instanceof Array||(a=h(a)==="undefined"?[]:[a]);c instanceof Array||(c=h(c)==="undefined"?[]:[c]);return a.concat(c)}function J(a,c){var b=ko.dependentObservable;ko.dependentObservable=function(b,c,d){var d=d||{},j=d.deferEvaluation;b&&typeof b=="object"&&(d=b);var h=false,e=function(b){var c=o({read:function(){h||(ko.utils.arrayRemoveItem(a,
b),h=true);return b.apply(b,arguments)},write:function(a){return b(a)},deferEvaluation:true});c.__ko_proto__=o;return c};d.deferEvaluation=true;b=new o(b,c,d);b.__ko_proto__=o;j||(a.push(b),b=e(b));return b};var d=c();ko.dependentObservable=b;return d}function y(a,c,b,d,f,e){var x=ko.utils.unwrapObservable(c)instanceof Array,e=e||"";if(ko.mapping.isMapped(a))var j=ko.utils.unwrapObservable(a)[n],b=r(j,b);var l=function(){return b[d]&&b[d].create instanceof Function},B=function(a){return J(C,function(){return b[d].create({data:a||
c,parent:f})})},g=function(){return b[d]&&b[d].update instanceof Function},p=function(a,K){var e={data:K||c,parent:f,target:ko.utils.unwrapObservable(a)};if(ko.isWriteableObservable(a))e.observable=a;return b[d].update(e)};if(j=z.get(c))return j;d=d||"";if(x){var x=[],m=false,k=function(a){return a};if(b[d]&&b[d].key)k=b[d].key,m=true;if(!ko.isObservable(a))a=ko.observableArray([]),a.mappedRemove=function(b){var c=typeof b=="function"?b:function(a){return a===k(b)};return a.remove(function(a){return c(k(a))})},
a.mappedRemoveAll=function(b){var c=v(b,k);return a.remove(function(a){return ko.utils.arrayIndexOf(c,k(a))!=-1})},a.mappedDestroy=function(b){var c=typeof b=="function"?b:function(a){return a===k(b)};return a.destroy(function(a){return c(k(a))})},a.mappedDestroyAll=function(b){var c=v(b,k);return a.destroy(function(a){return ko.utils.arrayIndexOf(c,k(a))!=-1})},a.mappedIndexOf=function(b){var c=v(a(),k),b=k(b);return ko.utils.arrayIndexOf(c,b)},a.mappedCreate=function(b){if(a.mappedIndexOf(b)!==
-1)throw Error("There already is an object with the key that you specified.");var c=l()?B(b):b;g()&&(b=p(c,b),ko.isWriteableObservable(c)?c(b):c=b);a.push(c);return c};var j=v(ko.utils.unwrapObservable(a),k).sort(),i=v(c,k);m&&i.sort();for(var m=ko.utils.compareArrays(j,i),j={},i=[],o=0,u=m.length;o<u;o++){var t=m[o],s,q=e+"["+o+"]";switch(t.status){case "added":var w=A(ko.utils.unwrapObservable(c),t.value,k);s=ko.utils.unwrapObservable(y(void 0,w,b,d,a,q));q=F(ko.utils.unwrapObservable(c),w,j);i[q]=
s;j[q]=true;break;case "retained":w=A(ko.utils.unwrapObservable(c),t.value,k);s=A(a,t.value,k);y(s,w,b,d,a,q);q=F(ko.utils.unwrapObservable(c),w,j);i[q]=s;j[q]=true;break;case "deleted":s=A(a,t.value,k)}x.push({event:t.status,item:s})}a(i);b[d]&&b[d].arrayChanged&&ko.utils.arrayForEach(x,function(a){b[d].arrayChanged(a.event,a.item)})}else if(D(c)){a=ko.utils.unwrapObservable(a);if(!a)if(l())return m=B(),g()&&(m=p(m)),m;else{if(g())return p(m);a={}}g()&&(a=p(a));z.save(c,a);G(c,function(d){var f=
e.length?e+"."+d:d;if(ko.utils.arrayIndexOf(b.ignore,f)==-1)if(ko.utils.arrayIndexOf(b.copy,f)!=-1)a[d]=c[d];else{var h=z.get(c[d])||y(a[d],c[d],b,d,a,f);if(ko.isWriteableObservable(a[d]))a[d](ko.utils.unwrapObservable(h));else a[d]=h;b.mappedProperties[f]=true}})}else switch(h(c)){case "function":g()?ko.isWriteableObservable(c)?(c(p(c)),a=c):a=p(c):a=c;break;default:ko.isWriteableObservable(a)?g()?a(p(a)):a(ko.utils.unwrapObservable(c)):(a=l()?B():ko.observable(ko.utils.unwrapObservable(c)),g()&&
a(p(a)))}return a}function F(a,c,b){for(var d=0,f=a.length;d<f;d++)if(b[d]!==true&&a[d]===c)return d;return null}function H(a,c){var b;c&&(b=c(a));h(b)==="undefined"&&(b=a);return ko.utils.unwrapObservable(b)}function A(a,c,b){a=ko.utils.arrayFilter(ko.utils.unwrapObservable(a),function(a){return H(a,b)===c});if(a.length==0)throw Error("When calling ko.update*, the key '"+c+"' was not found!");if(a.length>1&&D(a[0]))throw Error("When calling ko.update*, the key '"+c+"' was not unique!");return a[0]}
function v(a,c){return ko.utils.arrayMap(ko.utils.unwrapObservable(a),function(a){return c?H(a,c):a})}function G(a,c){if(a instanceof Array)for(var b=0;b<a.length;b++)c(b);else for(b in a)c(b)}function D(a){var c=h(a);return c==="object"&&a!==null&&c!=="undefined"}function I(){var a=[],c=[];this.save=function(b,d){var f=ko.utils.arrayIndexOf(a,b);f>=0?c[f]=d:(a.push(b),c.push(d))};this.get=function(b){b=ko.utils.arrayIndexOf(a,b);return b>=0?c[b]:void 0}}ko.mapping={};var n="__ko_mapping__",o=ko.dependentObservable,
E=0,C,z,u={include:["_destroy"],ignore:[],copy:[]},l=u;ko.mapping.isMapped=function(a){return(a=ko.utils.unwrapObservable(a))&&a[n]};ko.mapping.fromJS=function(a){if(arguments.length==0)throw Error("When calling ko.fromJS, pass the object you want to convert.");window.setTimeout(function(){E=0},0);E++||(C=[],z=new I);var c,b;arguments.length==2&&(arguments[1][n]?b=arguments[1]:c=arguments[1]);arguments.length==3&&(c=arguments[1],b=arguments[2]);b&&(c=r(c,b[n]));c=i(c);var d=y(b,a,c);b&&(d=b);--E||
window.setTimeout(function(){ko.utils.arrayForEach(C,function(a){a&&a()})},0);d[n]=r(d[n],c);return d};ko.mapping.fromJSON=function(a){var c=ko.utils.parseJson(a);arguments[0]=c;return ko.mapping.fromJS.apply(this,arguments)};ko.mapping.updateFromJS=function(){throw Error("ko.mapping.updateFromJS, use ko.mapping.fromJS instead. Please note that the order of parameters is different!");};ko.mapping.updateFromJSON=function(){throw Error("ko.mapping.updateFromJSON, use ko.mapping.fromJSON instead. Please note that the order of parameters is different!");
};ko.mapping.toJS=function(a,c){l||ko.mapping.resetDefaultOptions();if(arguments.length==0)throw Error("When calling ko.mapping.toJS, pass the object you want to convert.");if(!(l.ignore instanceof Array))throw Error("ko.mapping.defaultOptions().ignore should be an array.");if(!(l.include instanceof Array))throw Error("ko.mapping.defaultOptions().include should be an array.");if(!(l.copy instanceof Array))throw Error("ko.mapping.defaultOptions().copy should be an array.");c=i(c,a[n]);return ko.mapping.visitModel(a,
function(a){return ko.utils.unwrapObservable(a)},c)};ko.mapping.toJSON=function(a,c){var b=ko.mapping.toJS(a,c);return ko.utils.stringifyJson(b)};ko.mapping.defaultOptions=function(){if(arguments.length>0)l=arguments[0];else return l};ko.mapping.resetDefaultOptions=function(){l={include:u.include.slice(0),ignore:u.ignore.slice(0),copy:u.copy.slice(0)}};ko.mapping.visitModel=function(a,c,b){b=b||{};b.visitedObjects=b.visitedObjects||new I;b.parentName||(b=i(b));var d,f=ko.utils.unwrapObservable(a);
if(D(f))c(a,b.parentName),d=f instanceof Array?[]:{};else return c(a,b.parentName);b.visitedObjects.save(a,d);var e=b.parentName;G(f,function(a){if(!(b.ignore&&ko.utils.arrayIndexOf(b.ignore,a)!=-1)){var j=f[a],g=b,i=e||"";f instanceof Array?e&&(i+="["+a+"]"):(e&&(i+="."),i+=a);g.parentName=i;if(!(ko.utils.arrayIndexOf(b.copy,a)===-1&&ko.utils.arrayIndexOf(b.include,a)===-1&&f[n]&&f[n].mappedProperties&&!f[n].mappedProperties[a]&&!(f instanceof Array)))switch(h(ko.utils.unwrapObservable(j))){case "object":case "undefined":g=
b.visitedObjects.get(j);d[a]=h(g)!=="undefined"?g:ko.mapping.visitModel(j,c,b);break;default:d[a]=c(j,b.parentName)}}});return d};ko.exportSymbol("ko.mapping",ko.mapping);ko.exportSymbol("ko.mapping.fromJS",ko.mapping.fromJS);ko.exportSymbol("ko.mapping.fromJSON",ko.mapping.fromJSON);ko.exportSymbol("ko.mapping.isMapped",ko.mapping.isMapped);ko.exportSymbol("ko.mapping.defaultOptions",ko.mapping.defaultOptions);ko.exportSymbol("ko.mapping.toJS",ko.mapping.toJS);ko.exportSymbol("ko.mapping.toJSON",
ko.mapping.toJSON);ko.exportSymbol("ko.mapping.updateFromJS",ko.mapping.updateFromJS);ko.exportSymbol("ko.mapping.updateFromJSON",ko.mapping.updateFromJSON);ko.exportSymbol("ko.mapping.visitModel",ko.mapping.visitModel)})();
/*--------------------------------------------------------------------------------------------------- CakeSaver
 *
 *
 * Clase CakeSaver
 * 
 * Convierte objetos de javascript en algo que CakePhp pueda leer bajo el $this->data
 * o sea, convierte los objetos a un array para enviar via method POST en ajax
 * 
 * EL objeto debe tener un atributo (key denominada: "Model", con el nombre del modelo.
 * 
 * Objeto a enviar, ejemplo:
 * 
 * var product = {
 *      model: 'Producto',
 *      name: 'Zapatillas Nike',
 *      precio: 34.76
 *      observacion: 'una observacion re copada ...'
 * }
 * 
 * var objetoEnviar = {
 *      obj: product,
 *      method: 'post', // por defecto ya viene en post, puede ser get tambien. no es obligatorio ponerlo
 *      url: '/url/enviar' // es la url a donde se enviara el ajax
 * }
 * 
 * Envia un ajax post para que Cake pueda crear 
 *      $this->data['Producto']['name']
 *      $this->data['Producto']['precio']
 *      $this->data['Producto']['observacion']
 *      
 *      
 *      El objeto debe tener lso siguientes atributos o claves:
 *      'obj': Obligatorio, Objeto js a enviar
 *      'url': Obligatorio, es la url donde se enviara el ajax
 *      'method': puede ser get o post, es el method de envio ajax
 */
var $cakeSaver = {
    
    method: 'POST',
    
    /**
     * 
     * @param sendObje Objeto a mandar, debe tener como minimo:
     *  'url' => es la url donde se enviara el post
     *  'obj' => es el objeto que voy a enviar$cakeSaver
     *  'error' => function handler
     *  'if'    => es una funcion que devuelve un boolean, Si el boolean da false, entonces el envio se posterga hasta que sea "true"
     *  'ifDo'  => es una funcion que se ejecuta cuando devuelve true el IF y pasa como parametro el objeto aplanado para hacerle los cambios que sean 
     *  @param fn funcion callback a ejecutar onSuccess
     */
    send: function( sendObj , fn){
        var i = 0;
        var obj = sendObj['obj'];
        
        var url = sendObj['url'];
        var errorHandler = sendObj.error || function(){};
        var method = sendObj['method'] || this.method;       
        var obAplanado = this.__processObj(obj, obj.model); // objeto aplanado
        this.__doSend(url, obAplanado, method, errorHandler, fn, obj);
       
    },
    
    
    
    __doSend: function(url, ob, method, errorHandler, fn, obj){
        $.ajax({
                'url': url,
                'data': ob,
                'type': method,
                error: errorHandler,
                success: function(data){
                    if (typeof fn == 'function'){
                        fn.call(data);
                    } else {
                        try { 
                            if ( typeof obj.handleAjaxSuccess == 'function' ) {
                                obj.handleAjaxSuccess(data, url, method);
                            } else {
                                throw "$cakeSaver:: EL objeto '"+obj.model+"' pasado para enviar vía ajax no tiene una función llamada 'handleAjaxSuccess'. La misma es indispensable para tratar la respuesta.";
                            }
                        }
                        catch(er) {
                            jQuery.error(er);
                        }
                    }
                }
            });
    },
    
    
    /**
     *
     * @param auxObj es el objeto que voy a aplanar
     * @param recursivObj es el objeto resultado de este proceso. Sirve cuando quiero hacerlo de forma recursiva
     * @key es un string, la continuacion del $this[data][blah][blah] que deseo crear automaticamente
     */
    __aplanarObj: function(auxObj, recursivObj, key) {
        var cont,
            ooo = recursivObj || {},
            model = auxObj.model,
            arrayKey,
            siEsArrayKey;
        
        for (var i in auxObj ) {
            if ( typeof auxObj[i] != 'object' && typeof auxObj[i] != 'function' && auxObj[i] != undefined && auxObj[i] != null) {
                arrayKey = key || 'data['+model+']'; 
                arrayKey = arrayKey+'['+i+']';
                ooo[arrayKey] = auxObj[i];
            }
            
            // si es Array
            if ( typeof auxObj[i] == 'object' && $.isArray(auxObj[i]) ) {
                cont = 0;
                siEsArrayKey = key || 'data';
                for (var scnd in auxObj[i]) {
                    this.__aplanarObj(auxObj[i][scnd], ooo, siEsArrayKey+'['+auxObj[i][scnd].model+']'+'['+cont+']');
                    cont++;
                }
            }
            
            // si es un objeto Model , o sea si tiene el atributo 'model''
            if ( typeof auxObj[i] == 'object' && auxObj[i] && auxObj[i].model ) {
                this.__aplanarObj(auxObj[i], ooo); 
            }
        }
        return ooo;
    },
    
    __processObj: function(obj, model){
        var auxObj = ko.toJS(obj);
        var aa = this.__aplanarObj(auxObj);
        return $.param( aa );
    }
    
}/*--------------------------------------------------------------------------------------------------- Risto
 *
 *
 * Paquete Risto
 */
var Risto = {
    modelizar: function(obToModelizar){
        
        obToModelizar.timeCreated = function(){
            var d;
            
            var created;
            if (typeof this.created == 'function'){
                created = this.created();
            } else {
                created = this.created;
            }
            if (!created) {
                d = new Date();
            } else {
                d = new Date( mysqlTimeStampToDate(this.created()) );       
            }

            var min =  (d.getMinutes() < 10 ? '0' : '') + d.getMinutes();
            return d.getHours()+":"+min;
        }
    }
}




function mysqlTimeStampToDate(timestamp) {
    if (timestamp) {
        //function parses mysql datetime string and returns javascript Date object
        //input has to be in this format: 2007-06-05 15:26:02
        var regex=/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/;
        var parts=timestamp.replace(regex,"$1 $2 $3 $4 $5 $6").split(' ');
        return new Date(parts[0],parts[1]-1,parts[2],parts[3],parts[4],parts[5]);
    } else {
        return new Date();
    }
        
}

/**
 * I make a mysql date timestamp
 * @deprecated - Datepicker used instead
 * @param {Object} dateobj - a date
 */
function jsToMySqlTimestamp( dateobj )
{
    var date;
    if ( dateobj ) {
         date = new Date( dateobj );
    } else {
        date = new Date(  );
    }
    
    var yyyy = date.getFullYear();
    var mm = date.getMonth() + 1;
    var dd = date.getDate();
    var hh = date.getHours();
    var min = date.getMinutes();
    var ss = date.getSeconds();
 
	var mysqlDateTime = yyyy + '-' + mm + '-' + dd + ' ' + hh + ':' + min + ':' + ss;
 
    return mysqlDateTime;
}/*--------------------------------------------------------------------------------------------------- PKG:Risto.Adicion
 *
 *
 * Package Adition
 */ 
    

Risto.Adition = {
    koAdicionModel : {
        refreshBinding: function(){}
    },
    
    /**
     * @var Utilizada en el listado de mesas para buscar la mesa cuando se tipea el numero
     * esta variable es global, y se va llenando con cada keypress
     * por lo tanto es usual encontrar la logica de llenado de esta variable en adition.events
     */
    mesaBuscarAccessKey: '',
    mesaCurrentIndex: null,
    mesaCurrentContainer: null

};


$(document).ready(function(){
    Risto.Adition.koAdicionModel.refreshBinding();
    
    $mesasContainer = $('#mesas_container');
    $mesasDom = $mesasContainer.find('li');
    $listMozosContainer = $('#listado-mozos-para-mesas');
});/*--------------------------------------------------------------------------------------------------- Risto.Adicion.mozo
 *
 *
 * Clase Mozo, depende de Productos
 */


/**
 *  Trigger de los siguientes eventos:
 *      - mozoAgregaMesa
 *      - mozoSacaMesa
 *      - mozoSeleccionado
 * @var Static MOZOS_POSIBLES_ESTADOS
 *
 *  esta variable es simplemenete un catalogo de estados posibles que
 *  la mesa pude adoptar en su variable privada this.__estado
 *
 **/
var MOZOS_POSIBLES_ESTADOS =  {
    agragaMesa : {
        msg: 'El mozo tiene una nueva mesa',
        event: 'mozoAgregaMesa'
    },
    sacaMesa: {
        msg: 'El mozo tiene una mesa menos',
        event: 'mozoSacaMesa'
    },
    seleccionado: {
        msg: 'El mozo fue seleccionado',
        event: 'mozoSeleccionado'
    }
};



var Mozo = function(jsonData){    
    return this.initialize(jsonData);
}


Mozo.prototype = {
    id      : function( ) {return 0},
    numero  : function( ) {return 0},
    mesas   : function( ) {return []},

    initialize: function( jsonData ) {
        var mozoNuevo = this,
            jsonData = jsonData || {},
            mapOps  = {};

        if ( jsonData == {} ) return this;
        
        this.id     = ko.observable( 0 );
        this.numero = ko.observable( 0 );
        this.mesas  = ko.observableArray( [] );

        
        if (jsonData) {
            // si aun no fue mappeado
            mapOps = {
                'mesas': {
                    create: function(ops) {
                        return new Mesa(mozoNuevo, ops.data);
        }
                }
            }
        
        } 
        
        ko.mapping.fromJS(jsonData, mapOps, this);
        return this;
    },

    /**
     * devuelve un Button con el elemento mozo
     * @return jQuery Element button
     */
    getButton: function(){
        var btn = document.createElement('button');
        btn.mozo_id = this.id;
        btn.innerHTML = this.numero;
        btn.mozo = this;
        return btn;
    },


    cloneFromJson: function(json){
        //copio solo lo decclarado en el prototype del objecto Mozo
        for (var i in this){
            if ((typeof this[i] != 'function') && (typeof this[i] != 'object')){
                this[i] = json[i];
            }
        }
        return this;
    },


    agregarMesa: function(nuevaMesa){
        this.mesas.push(nuevaMesa);
        var evento = $.Event(MOZOS_POSIBLES_ESTADOS.agragaMesa.event);
        evento.mozo = this;
        evento.mesa = nuevaMesa;
        $(document).trigger(evento);
    },


    sacarMesa: function ( mesa ) {
        if ( this.mesas.remove(mesa) ) {
            delete mesa;            
            return true
        }
        return false;
    },

    /**
     * Cuando un mozo es clickeado o elegido, es seleccionado.
     * Se dispara un evento mozoSeleccionado cuando esto ocurre
     */
    seleccionar: function(){
        this.seleccionado = true;
        var eventoMozoSeleccionado = $.Event(MOZOS_POSIBLES_ESTADOS.seleccionado.event);
        eventoMozoSeleccionado.mozo = this;
        $(document).trigger(eventoMozoSeleccionado);
    },

    
    /**
     * Busca una mesa por su id en el listado de mesas que tiene le mozo
     * @param integer idToSearch 
     * @return Mesa si encontro, null en caso de no encontrar nada
     */
    findMesaById: function( idToSearch ){
        for( var m in this.mesas() ) {
            if ( this.mesas()[m].id() === idToSearch ) {
                return this.mesas()[m];
            }
        }
        return null;
    }
};/**
 * 
 * @scope Risto.Adition
 * 
 * EventHandler
 * 
 * Maneja la DOM
 * Es el encargado de capturar los eventos relacionados con la adicion
 * 
 */

$raeh = Risto.Adition.EventHandler = {
    
    trigger: function( eventName, extra, context ) {  
        if ( Risto.Adition.EventHandler.hasOwnProperty(eventName ) && typeof Risto.Adition.EventHandler[eventName] == 'function') {
                if ( context ) {
                    setTimeout(function(){
                        Risto.Adition.EventHandler[eventName].call(context, extra);
                    }, 1);
                } else {
                    setTimeout(function(){
                        return Risto.Adition.EventHandler[eventName].call(this, extra);
                    }, 1);
                }
        }
        
        return -1;
    },
    
    mesaAbierta: function(e) {
        if (!e.mesa.id) {
            setTimeout(function(){
                abrirMesa(e)
            },1000);
        }
    },
    
    mesaCerrada: function(e){
    },
    
    
    /**
     * 
     *  Procesar los pagos de la mesa
     */
    mesaCobrada: function(e){
        // envio los datos al servidor
        var m = e.mesa;
        var mes = {
            Mesa: {
                id: m.id(),
                estado_id: m.estado_id(),
                time_cobro: m.time_cobro(),
                model: 'Mesa'
            },
            Pago: m.Pago()
        };
        
        // guardo los pagos
        $cakeSaver.send({
            url: urlDomain+'pagos/add',
            obj: mes
        }, function(d){
            
        });
        
        e.mesa.mozo().sacarMesa( e.mesa );
        
    },
    
    mesaBorrada: function(e){
        var mesa = e.mesa;
        e.mesa.mozo().sacarMesa(mesa);
    },
    
    mesaSeleccionada: function(e){
        Risto.Adition.adicionar.setCurrentMesa(e.mesa);
    },
    
    
    /**
     *  Llama a una funcion dependiendo de la pagina en la que estoy
     *  sirve para realizar las mismas acciones de inicializacion, o preparacion
     *  de alguna pagina despues de haber realizado una determinada accion
     *  Utiliza funciones de JQM para determinar la pagina actual
     */
    adicionMesasActualizadas: function () {
        /**
         *
         *  definicion del objeto que manejara las distintas respuestas dependiendo de la pagina activa
         *  Cada clave de este objeto es el ID de la page de JQM utilizada
         *  
         * */
        var onMesasActualizadasHandlerByPage = {
            'listado-mesas': function(){
                var btnMozo = $('#listado-mozos-para-mesas .ui-btn-active'),
                    mozoId = 0;
                if ( btnMozo[0] ) {
                    mozoId = $(btnMozo[0]).attr('data-mozo-id');
                }
                $raeh.mostrarMesasDeMozo(mozoId);
            },
            'mesa-view': function() {
                $('#comanda-detalle-collapsible').trigger('create');
            }
        }
        
        // llamar a la funcion correspondiente segun la pagina en la que estoy
        if ( $.mobile.activePage[0].id && onMesasActualizadasHandlerByPage.hasOwnProperty( $.mobile.activePage[0].id) ) {
            onMesasActualizadasHandlerByPage[$.mobile.activePage[0].id].call();
        }
    },
    
    
    adicionCambioMozo: function(){
        return 1;
    },
    
    
    
    

    cambiarMozo: function(e){    
        var mozoId = $(this).find('[name="mozo_id"]:checked').val();
        var mozo = Risto.Adition.adicionar.findMozoById(mozoId);
        var mozoAnterior = Risto.Adition.adicionar.currentMesa().mozo();
        Risto.Adition.adicionar.currentMesa().setMozo( mozo );

        $('.ui-dialog').dialog('close');

        var sendOb = {
            obj: {
                id: Risto.Adition.adicionar.currentMesa().id(),
                mozo_id: mozoId,
                model: 'Mesa',
                handleAjaxSuccess: function(){}
            },
            url: Risto.Adition.adicionar.currentMesa().urlEdit(),
            error: function(){
                Risto.Adition.adicionar.currentMesa().setMozo( mozoAnterior );
                alert("debido a un error en el servidor, el mozo no fue modificado");
            }
        }

        $cakeSaver.send(sendOb);

        return false;
    },

    cambiarNumeroMesa: function() {
        
        var numeroMesa = $(this).find('[name="numero"]').val();
        var numAnt = Risto.Adition.adicionar.currentMesa().numero( );
        
        Risto.Adition.adicionar.currentMesa().numero( numeroMesa );
        $('.ui-dialog').dialog('close');

        var sendOb = {
            obj: {
                id: Risto.Adition.adicionar.currentMesa().id(),
                numero: numeroMesa,
                model: 'Mesa',
                handleAjaxSuccess: function(){}
            },
            url: Risto.Adition.adicionar.currentMesa().urlEdit(),
            error: function(){
                Risto.Adition.adicionar.currentMesa().numero( numAnt );
                alert("debido a un error en el servidor, el numero de mesa no fue modificado");
            }
        }
        $cakeSaver.send(sendOb);
        return false;
    },
    
    
    
    
    /**
     * 
     * Dado un listado de mesas, solo deja visibles las que fue seleccionado su mozo
     * Es utilizado en el listado de mesas
     * 
     */
    mostrarMesasDeMozo: function( domObj ) {   
        if ( domObj == undefined ) {
            domObj = 0;
        }
        
        var mozoId;
        if ( typeof domObj == 'number') {
            mozoId = domObj;    
        } else {
            mozoId = domObj.getAttribute('data-mozo-id');   
        }
        
        $mesasDom.show();
        $('a.ui-btn-active', $listMozosContainer).removeClass('ui-btn-active');
        if ( mozoId ) {
                $( 'li[mozo!='+mozoId+']', $mesasContainer).hide();
                $( 'li[mozo='+mozoId+']', $mesasContainer).show();
                $('a[data-mozo-id='+mozoId+']', $listMozosContainer).addClass('ui-btn-active');
        } else {
            $listMozosContainer.find('a:first' ).addClass('ui-btn-active');
            $('li', '#mesas_container' ).show();
        }
    }
    
}/**
 * @var Static MESAS_POSIBLES_ESTADOS
 * 
 *  esta variable es simplemenete un catalogo de estados posibles que
 *  la mesa pude adoptar,
 *  
 *  utiliza el objeto adicion.event_handler: EventHandler 
 *
 **/

var MESA_ESTADOS_POSIBLES =  {
    abierta : {
        msg: 'Abierta',
        event: Risto.Adition.EventHandler.mesaAbierta ,
        id: 1,
        icon: 'mesa-abierta',
        url: urlDomain+'mesas/add'
    },
    reabierta : {
        msg: 'Re-Abierta',
        event: Risto.Adition.EventHandler.mesaAbierta ,
        id: 1,
        icon: 'mesa-abierta',
        url: urlDomain+'mesas/reabrir'
    },
    cerrada: {
        msg: 'Cerrada',
        event: Risto.Adition.EventHandler.mesaCerrada,
        id: 2,
        icon: 'mesa-cerrada',
        url: urlDomain+'mesas/cerrarMesa'
    },
    cuponPendiente: {
        msg: 'con Cupón Pendiente',
        event: Risto.Adition.EventHandler.mesaCuponPendiente,
        id: 0,
        icon: 'mesa-cobrada'
    },
    cobrada: {
        msg: 'Cobrada',
        event: Risto.Adition.EventHandler.mesaCobrada,
        id: 3,
        icon: 'mesa-cobrada'
    },
    borrada: {
        msg: 'Borrada',
        event: Risto.Adition.EventHandler.mesaBorrada,
        id: 0,
        icon: '',
        url: urlDomain+'mesas/delete'
    },
    seleccionada: {
        msg: 'Seleccionada',
        event: Risto.Adition.EventHandler.mesaSeleccionada,
        id: 0,
        icon: ''
    }
};
/*--------------------------------------------------------------------------------------------------- Risto.Adicion.mesa
 *
 *
 * Clase Mesa
 * 
 * para inicializarla es necesario pasarle el objeto Mozo
 * tambien se le puede pasar un jsonData para ser mappeado con knockout
 */
var Mesa = function(mozo, jsonData) {
        
        this.id             = ko.observable();
        this.created        = ko.observable();
        this.total          = ko.observable( 0 );
        this.numero         = ko.observable( 0 );
        this.menu           = ko.observable( 0 );
        this.mozo           = ko.observable( new Mozo() );
        this.currentComanda = ko.observable( new Risto.Adition.comandaFabrica() );
        this.Comanda        = ko.observableArray( [] );
        this.mozo_id        = this.mozo().id;
        this.Cliente        = ko.observable( null );
        this.estado         = ko.observable( MESA_ESTADOS_POSIBLES.abierta );
        this.estado_id      = ko.observable();
        this.Pago           = ko.observableArray( [] );
        this.cant_comensales= ko.observable(0);
        
        // agrego atributos generales
        Risto.modelizar(this);
        
        return this.initialize(mozo, jsonData);
}



Mesa.prototype = {
    model       : 'Mesa',
    
    /**
     * es timeCreated o sea la fecha de creacion del mysql timestamp
     * @return string timestamp
     **/
    timeAbrio: function(){
        if (!this.timeCreated) {
            Risto.modelizar(this);
        }
        return this.timeCreated();
    },

    /**
     *@constructor
     */
    initialize: function( mozo, jsonData ) {
        
        if ( typeof jsonData == 'undefined' ) return this;

        // mapea el objeto this usando ko.mapping
        this.__koMapp( jsonData, mozo);
        
        return this;
    },
    
    /**
     *  Actualiza el estado de la mesa con el json pasado
     */
    update: function( mozo, jsonData ) {
        
        // mapea el objeto this usando ko.mapping
        return this.__koMapp( jsonData, mozo );
//        this.setEstadoById();  
    },
    
    
    __koMapp: function( jsonData, mozo ) {
        var jsonData = jsonData || {},
            mapOps          = {};
            mozo = mozo || null;
        // si vino jsonData mapeo con koMapp
        if ( jsonData != {} ) {
            if (jsonData.Cliente && jsonData.Cliente.id){
                this.Cliente( new Risto.Adition.cliente( jsonData.Cliente ) );
            } else {               
                this.Cliente( null );
            }
            delete jsonData.Cliente;
            
            // si aun no fue mappeado
            mapOps = {
//                'ignore': ["Cliente"],
                'Comanda': {
                    create: function(ops) {
                        return new Risto.Adition.comanda(ops.data);
                    },
                    key: function(data) {
                        return ko.utils.unwrapObservable( data.id );
                    }
                }
            }
        }
        
        if ( mozo ) {
            // meto al mozo sin agregarle la mesa al listado porque seguramente vino en el json
            this.setMozo(mozo, false);
        }
        
        ko.mapping.fromJS(jsonData, mapOps, this);
        
        // meto el estado como Objeto Observable Estado
        this.__inicializar_estado( jsonData );

        
        
        return this;
    },
    
    /**
     * Inicializa el estado de la mesa en base al json pasada como parametro
     * o sea, convierte el id del estado que viene de la bbdd, a un objeto
     * "estado" que son los que estan en mesa.estados.class.js
     * @return MesaEstado
     */
    __inicializar_estado: function( jsonData ){
        var estado = MESA_ESTADOS_POSIBLES.abierta,
            ee = 0; // countador de estados posibles
         if (jsonData.estado_id) {
            for(ee in MESA_ESTADOS_POSIBLES){
                if ( MESA_ESTADOS_POSIBLES[ee].id && MESA_ESTADOS_POSIBLES[ee].id == jsonData.estado_id ){
                    estado = MESA_ESTADOS_POSIBLES[ee];
                    break;
                }
            }
         }
        this.setEstado( estado );
        return estado;
    },
    
    
    /**
     * agregar un producto a la comanda que actualmente se esta haciendo
     * no implica que se haya agregado un producto a la mesa.
     * es un estado intermedio de generacion de la comanda
     * @param prod Producto  
     **/
    agregarProducto: function(prod){
        this.currentComanda().agregarProducto(prod);
    },
    
    /**
     * Inicializa currentComanda para poder hacer una nueva comanda con
     * el objeto comandaFabrica
     * @constructor
     */
    nuevaComanda: function(){
        this.currentComanda( new Risto.Adition.comandaFabrica( this ) );
    },
    
    
    getData: function(){
        $.get(this.urlGetData());
    },
    
    
    /* listado de URLS de accion con la mesa */
    urlGetData: function() { return urlDomain+'mesas/ticket_view/'+this.id() },
    urlView: function() { return urlDomain+'mesas/view/'+this.id() },
    urlEdit: function() { return urlDomain+'mesas/ajax_edit/'+this.id() },
    urlDelete: function() { return urlDomain+'mesas/delete/'+this.id() },
    urlComandaAdd: function() { return urlDomain+'comandas/add/'+this.id() },
    urlReimprimirTicket: function() { return urlDomain+'mesas/imprimirTicket/'+this.id() },
    urlCerrarMesa: function() { return urlDomain+'mesas/cerrarMesa/'+this.id() },
    urlReabrir: function() { return urlDomain+'mesas/reabrir/'+this.id() },
    urlAddCliente: function( clienteId ){
        var url = urlDomain+'mesas/addClienteToMesa/'+this.id();
        if (clienteId){
            url += '/'+clienteId;
        }
        url += '.json';
        return url;
    },        
    

    /**
     * Disparador de triggers para el evento
     *
     **/
    __triggerEventCambioDeEstado: function(){
        
        var event =  {};
        event.mesa = this;
        this.estado().event( event );
    },

    /**
     * dispara un evento de mesa seleccionada
     */
    seleccionar: function() {
        var event =  {};
        event.mesa = this;
        MESA_ESTADOS_POSIBLES.seleccionada.event( event );
    },
    
    
    /**
     * cambia el estado de la mesa y lo envia vía ajax. Para ser modificado 
     * en bbdd.
     * En caso de error en el ajax la mesa vuelve a su estado anterior.
     * 
     * dispara el evento de cambio de estado. en caso de error lo dispararia 2 veces
     */
    cambioDeEstadoAjax: function(estado){
        var estadoAnt = this.getEstado(),
            mesa = this,
            $ajax; // jQuery Ajax object
            
        this.setEstado( estado );
        $ajax = $.get( estado.url+'/'+this.id() );
        $ajax.error = function(){
            mesa.setEstado( estadoAnt );
        }
    },

    /**
     * dispara un evento de mesa Abierta
     */
    setEstadoAbierta : function(){
        this.setEstado( MESA_ESTADOS_POSIBLES.abierta );
        return this;
    },
    
    /**
     * dispara un evento de mesa cobrada
     */
    setEstadoCobrada : function(){
        this.time_cobro( jsToMySqlTimestamp() );
        this.setEstado(MESA_ESTADOS_POSIBLES.cobrada);
        return this;
    },


    /**
     * dispara un evento de mesa cerrada
     */
    setEstadoCerrada : function(){
        this.time_cerro = jsToMySqlTimestamp();
        this.setEstado(MESA_ESTADOS_POSIBLES.cerrada);
        return this;
    },

    /**
     * dispara un evento de mesa borrada
     */
    setEstadoBorrada: function() {
        this.setEstado(MESA_ESTADOS_POSIBLES.borrada);
        return this;
    },

    /**
     * dispara un evento de mesa con cupon pendiente
     */
    setEstadoCuponPendiente : function(){        
        this.setEstado(MESA_ESTADOS_POSIBLES.cuponPendiente);
        return this;
    },
    
    /**
     * Cambia el estado de la mesa y genera un disparador del evento
     */
    setEstado: function(nuevoestado){
        this.estado( nuevoestado );
        this.__triggerEventCambioDeEstado();
    },
    
    /**
     * Cambia el estado de la mesa y genera un disparador del evento
     */
    setEstadoById: function(nuevoestado_id){
        var estado_id = nuevoestado_id || this.estado_id();
        
        for (var est in MESA_ESTADOS_POSIBLES) {
            if ( MESA_ESTADOS_POSIBLES[est].id == estado_id ) {
                this.setEstado(MESA_ESTADOS_POSIBLES[est]);
                return this.getEstado();
            }
        }
        return false;
    },

    /**
     * devuelve el estado actual de la mesa
     * @return MesaEstado
     */
    getEstado: function(){
        return this.estado();
    },
    
    
    /**
     * devuelve el string que identifica como nombre al estado
     * es el atributo del objeto estado llamado msg
     * el objeto de estado de la mesa es el de mesa.estados.class.js
     */
    getEstadoName: function(){
        if (this.estado()){
            return this.estado().msg;
        }
        return '';
    },
    
    
    /**
         *  dependentObservable
         *  
         *  devuelve el nombre del icono (jqm data-icon) que tiene el estado 
         *  en el que la mesa se encuentra actualmente
         *  el nombre del icono sirve para manejar cuestiones esteticas y es definido
         *  en "mesa.estados.class.js"
         *  
         *  @return string
         *
         */
     getEstadoIcon: function(){
            if (this.estado()){
                return this.estado().icon;
            }
            return MESA_ESTADOS_POSIBLES.abierta.icon;
            
        },
        
    

    /**
     * Me dice si la mesa pidio el cierre y esta pendiente de cobro
     * @return boolean true si ya cerro, false si esta abierta
     */
    estaAbierta : function(){

        return MESA_ESTADOS_POSIBLES.abierta == this.getEstado();
    },

    /**
     * @deprecated deberia usar estaCerrada
     * Me dice si la mesa pidio el cierre y esta pendiente de cobro
     * @return boolean true si ya cerro, false si esta abierta
     */
    pidioCierre : function(){
        return this.estaCerrada();
    },

    
    /**
     * modifica el ID del la mesa
     */
    setId : function(id){
        this.id = id;
    },


    /**
     *devuelve la cantidad de comensales o cubiertos seteado en la mesa
     *@return integer
     */        
    getCantComensales : function(){
        return this.cantComensales();
    },

    /**
     * Envia un ajax con la peticion de imprimir el ticket para esta mesa
     */
    reimprimir : function(){
        var url = window.urlDomain+'mesas/imprimirTicket';
        $.get( url+"/"+this.id);
    },



    /**
     * re-abre una mesa
     *
     */
    reabrir : function(url){
        var data = {
                'data[Mesa][estado_id]': MESA_ESTADOS_POSIBLES.abierta.id,
                'data[Mesa][id]': this.id
        };

        $.post(url, data);
        this.setEstadoAbierta();
    },

    /**
     * Envia un ajax con la peticion de cerrar esta mesa
     */
    cerrar: function(){
        var url = window.urlDomain + 'mesas/cerrarMesa' + '/' + this.currentMesa.id + '/0',
            self = this;
            
        $.get(url, {}, function(){
            self.setEstadoCerrada();
        });
        return this;
    },

    /**
     * Envia un ajax con la peticion de borrar esta mesa
     */
    borrar : function(){
        var url = window.urlDomain + 'mesas/delete/' +this.id,
            self = this;
        $.get(url, {}, function(){
            self.setEstadoBorrada()
        });
        return this;
    },

    
    
    /**
     * Si tiene un mozo setteado retorna true, caso contrario false
     * Verifica con el id del mozo (si es CERO es que no tiene mozo)
     * @return Boolean
     */
    tieneMozo: function(){
        var tiene = false;
        if ( this.mozo() !== {} || this.mozo() !== null ) {
            tiene = this.mozo().id() ? true: false;
        }
        return tiene;
    },


    /**
     * Setea el mozo a la mesa.
     * si agregarMesa es true, se agrega la mesa al listado de mesas del mozo
     * @param nuevoMozo Mozo es el mozo que voy a setear
     * @param agregarMesa Boolean indica si agrego la mesa al listado de mesas que tiene el mozo, por default es true
     */
    setMozo: function(nuevoMozo, agregarMesa){
        var laAgrego = agregarMesa || true; // por default sera true
        
        // si la mesa que le quiero agregar, tenia otro mozo
        // lo debo sacar, eliminandole la mesa de su listado de mesas
        if ( this.tieneMozo() ){
            var mozoViejo = this.mozo();
            // si era el mismo mozo no hacer nada
            if (mozoViejo.id() == nuevoMozo.id()) {
                return 0;
            }
            mozoViejo.sacarMesa(this);
        }
        
        this.mozo_id( nuevoMozo.id() );
        this.mozo(nuevoMozo);
        if (laAgrego) {
            this.mozo().agregarMesa(this);
        }
        return this;
    },


    /**
     * Realiza una edicion rapida via Ajax del Model Mesa de Cakephp
     * o sea, desde aca se puede tcoar facilmente cualquier campo de la bbdd
     * siempre y cuando el parametro data respete la forma de los inputs de cake.
     * 
     * @param data Array los keys del array deben ser de la forma cake:
     *                      Ej: data['data[Mesa][cant_comensales]'] o data['data[Mesa][cliente_id]']
     *                      
     */
    editar: function(data) {
        if (!data['data[Mesa][id]']) {
            data['data[Mesa][id]'] = this.id();
        }
        $.post( window.urlDomain +'mesas/ajax_edit', data);
        return this;
    },
    
    
    /**
     * Es el callback que recibe la actualizacion de las mesas via json desde 
     * cakeSaver
     */
    handleAjaxSuccess: function(data, action, method) {
        if (data[this.model]) {
            ko.mapping.fromJS( data[this.model], {}, this );
        }
    },
    
    
    /**
     * Dado un objeto cliente se setea el mismo a la mesa
     * @param objCliente Object que debe tener como atributos al menos un id
     */
    setCliente: function( objCliente ){
        var ctx = this, 
            clienteId = null;
        
        if ( objCliente ) {
            clienteId = objCliente.id;
        }
        $.get( this.urlAddCliente( clienteId ), function(data) {
            if ( data.Cliente ){
                ctx.Cliente( new Risto.Adition.cliente(data.Cliente) );
            } else{
                ctx.Cliente(null);
            }
        });
        
        return this;
    },
    
    
    /**
     * A diferencia de los otros totales, este no esta bindeado con knocout por lo tanto da el total real en el momento 
     * que se llama a esta funcion
     */
    totalStatic: function(){
        var total = 0,
            c, // index de Comandas
            dc; // index del for DetalleComandas
            
        for (c in this.Comanda()){
            for (dc in this.Comanda()[c].DetalleComanda() ){
                total += parseFloat( this.Comanda()[c].DetalleComanda()[dc].precio() * this.Comanda()[c].DetalleComanda()[dc].realCant() );
            }
        }

        return Math.round( total*100)/100;
    },
    
    
    /**
     *Devuelve el total neto, sin aplicar descuentos
     *@return float
     */
    totalCalculadoNeto: function(){
        var valorPorCubierto =  Risto.VALOR_POR_CUBIERTO || 0,
            total = this.cant_comensales() * valorPorCubierto,
            c = 0;

        for (c in this.Comanda()){
            for (dc in this.Comanda()[c].DetalleComanda() ){
                total += parseFloat( this.Comanda()[c].DetalleComanda()[dc].precio() * this.Comanda()[c].DetalleComanda()[dc].realCant() );
            }
        }

        return Math.round( total*100)/100;
    },
        
        
        /**
         *
         *  Depende del cliente.
         *  es un atajo al porcentaje de descuento que tiene el cliente
         */
       porcentajeDescuento : function(){
            var porcentaje = 0;
            if (this.Cliente() && !this.Cliente().hasOwnProperty('length') &&  this.Cliente().Descuento()){
                if ( typeof this.Cliente().Descuento().porcentaje == 'function') {
                    porcentaje = this.Cliente().Descuento().porcentaje();
                }
            }
            return parseFloat( porcentaje );
        },
        
        /**
         *Devuelve el total aplicandole los descuentos
         *@return float
         */
        totalCalculado : function(){
            var total = parseFloat( this.total() );
            if ( total ) {
                return total;
            }
            
            total = this.totalCalculadoNeto();
            
            var dto = 0;
               
            dto = Math.floor(total * this.porcentajeDescuento() / 100);
            total = total - dto;
            
            return total;
        },
        
        
        /**
         *Devuelve el total mostrando un texto
         *@return String
         */
        textoTotalCalculado : function(){
            var total = this.totalCalculadoNeto(), 
                dto = 0, 
                totalText = '$'+total ;
            
            
            if (this.Cliente() && !this.Cliente().hasOwnProperty('length') && this.Cliente().tipofactura() && this.Cliente().tipofactura().toLowerCase() == 'a'){               
                totalText = 'Factura "A" '+totalText;
            }

            if ( this.porcentajeDescuento() ) {
                dto = Math.round( Math.floor( total * this.porcentajeDescuento()  / 100 ) *100 ) /100;
                totalText = totalText+' - [Dto '+this.porcentajeDescuento()+'%] $'+dto+' = $'+ this.totalCalculado();
            }
            
            return totalText;
        },
        
        
        
        
         /**
         * dependentObservable
         * 
         * Chequea si la mesa esta con el estado: cerrada. (por lo general, lo que interesa
         * es saber que si no esta cerrada es porque esta abierta :-)
         * @return boolean
         **/
        estaCerrada : function(){
            return MESA_ESTADOS_POSIBLES.cerrada == this.estado();
        },
        
        
        clienteTipoFacturaText: function(){
            var texto = 'B';
            if ( this.Cliente() && typeof this.Cliente().getTipoFactura == 'function' ) {
                texto = this.Cliente().getTipoFactura();
            }
            return texto;
        },
        
        
        clienteDescuentoText: function(){
            var texto = '';
            if ( this.Cliente() &&  this.Cliente().tieneDescuento && this.Cliente().tieneDescuento() != undefined ) {
                texto = this.Cliente().getDescuentoText();
            }
            return texto;
        },
        
        
        /**
         * dependentObservable
         * 
         * Devuelve el nombre del Cliente si es que hay alguno setteado
         * en caso de no haber cliente, devuelve el string vacio ''
         *
         *@return string
         */
        clienteNameData : function() {
            var cliente = this.Cliente();
            if (cliente){
                if (typeof cliente == 'function') {
                    return cliente.nombre();
                } else {
                    return cliente.nombre;
                }
            }
            return '';
        },
        
        
        
        /**
         * Devuelve un texto con la hora
         * si la mesa esta cerrada, dice "Cerró: 14:35"
         * si esta aberta dice: "Abrió 13:22"
         */
        textoHora : function() {
            var date, txt;
            if ( this.getEstado() == MESA_ESTADOS_POSIBLES.cerrada ) {
                txt = 'Cerró a las ';
                if (typeof this.time_cerro == 'function') {
                    date =  mysqlTimeStampToDate(this.time_cerro());
                }
            } else {
                txt = 'Abrió a las ';
                if (typeof this.created == 'function') {
                    date = mysqlTimeStampToDate(this.created());            
                }
            }
            if ( !date ) {
                date = new Date();
            }
            return txt + date.getHours() + ':' + date.getMinutes() + 'hs';
        }

};
/*--------------------------------------------------------------------------------------------------- Risto.Adicion.comanda
 *
 *
 * Clase Comanda
 */

Risto.Adition.comanda = function(jsonData){
    return this.initialize( jsonData );
}


Risto.Adition.comanda.prototype = {
    // Array de DetalleComanda, cada detalleComanda es 1 producto
    DetalleComanda  : function( ) {return []},
    created         : function( ) { },
    model           : 'Comanda',
    imprimir        : function( ) {return true},
    id              : ko.observable(),
    observacion     : function( ) { return '' },
    
    initialize: function(jsonData) {
        this.id = ko.observable();
        this.imprimir = ko.observable( true );
        this.observacion = ko.observable( '' );
        this.created = ko.observable();
        this.DetalleComanda = ko.observableArray( [] );
        
        if ( jsonData ) {
            // si aun no fue mappeado
            var mapOps = {
                'DetalleComanda': {
                    create: function(ops) {
                        return new Risto.Adition.detalleComanda(ops.data);
                    }
                }
            }
        } else {
            jsonData = {};
            mapOps = {};
        }
        ko.mapping.fromJS(jsonData, mapOps, this);
        Risto.modelizar(this);
        return this;
    },
    
    productsStringListing: function(){
        var name = '';        
        for (var dc in this.DetalleComanda() ){
            if ( this.DetalleComanda()[dc].realCant() ) {
                if ( name ){
                    name += ', ';
                }        
                name += this.DetalleComanda()[dc].realCant()+' '+this.DetalleComanda()[dc].Producto().name;
            }
        }
        return name;
    },
    
    imprimirComanda: function() {
        if (window.confirm("¿Seguro desea reimprimir comanda?")) {
            $.get(urlDomain + '/comandas/imprimir/' +this.id());
        }
    },
    
    
    handleAjaxSuccess: function(data){
        this.id( data.Comanda.Comanda.id );
        this.created( data.Comanda.Comanda.created );
        return this;
    },
    
     timeCreated: function(){
         if (!this.timeCreated) {
            Risto.modelizar(this);
    }
        return this.timeCreated();
     },
     
     
     borrarObservacionGeneral: function(){
        this.observacion('');
    },
    
    
    agregarTextoAObservacionGeneral: function( textToAdd ){ 
        var txt = this.observacion();
        if ( txt ) {
            txt += ', ';
        }
        txt += textToAdd;
        this.observacion( txt );
        return txt;
    }
    
}/*--------------------------------------------------------------------------------------------------- Risto.Adicion.comandaFabrica
 *
 *
 * Clase ComandaFabrica
 */

Risto.Adition.comandaFabrica = function(mesa){
    return this.initialize(mesa);
}

Risto.Adition.comandaFabrica.prototype = {
    id: 0,
    mesa: {},
    
    comanda: {},
    
    // array de los sabores del producto seleccionado
    currentSabores: function( ) {return []},
    
    productoSaborTmp: {}, //producto temporal (que esta esperando la seleccion de sabores)
    saboresSeleccionados: [], // listado de sabores seleccionados para el productoSaborTmp
   
    
//    productosSeleccionados: ko.observableArray([]),
//    detallesComandas: ko.observableArray([]),
    
    
    initialize: function(mesa){
        this.productoSaborTmp = {};
        this.saboresSeleccionados = [];
        this.mesa = mesa;
        this.currentSabores = ko.observableArray([]);
        this.comanda = new Risto.Adition.comanda();
        if ( mesa ) {
            this.comanda.mesa_id = mesa.id();
            this.mesa = mesa;
        }
        this.id = undefined;
        return this;
    },
    
    
    /**
     *
     * Inserta el DetalleComanda en la vista de la mesa y las envia ajaxa para guardar
     * inserta tantas comandas como se le hayan pasado de parametro
     * @param comandaJsonCopy Object con los atributos de la comanda
     * @param comanderas Array listado de comandas
     */
    __generarComanda: function( comandaJsonCopy, comanderas ){
         // creo una nueva comanda para cada comandera
        for (var com in comanderas ) {
            comanderaComanda = new Risto.Adition.comanda( comandaJsonCopy );
            comanderaComanda.DetalleComanda( comanderas[com] );
            this.mesa.Comanda.unshift( comanderaComanda );
            
             //  para cada comandera
            $cakeSaver.send({
                url: urlDomain + 'detalle_comandas/add.json', 
                obj: comanderaComanda
            });
        }
    },
    
    
    save: function() {
        if ( !this.mesa){
                jQuery.error("no hay una mesa setteada. No se puede guardar una comanda de ninguna mesa");
                return null;
        }
        
        // si la mesa no tiene ID es porque aun no se guardo.. entonces vuelvo 
        // a llamar a este metodo pero dentro de un rato
        if ( !this.mesa.id() ) {
            var este = this;
            setTimeout( function(){ 
                este.save();
            }, Risto.MESAS_RELOAD_INTERVAL); 
            return null;
        }
        
        
        // separo la comanda generada en varias comandas
        // se genera 1 comanda por cada impresora que haya (comandera)
        var ccdc;
        var comanderas = [];
        
        // separo los detalleComanda por comandera
        for (var dc in this.comanda.DetalleComanda()) {
            ccdc = this.comanda.DetalleComanda()[dc];
            //si el detalleComanda no tiene cantidad mayor a cero (se agregaron demas por error y luego se quitaron)
            // entonces no debo guardarla
            if ( ccdc.realCant() == 0) continue;
            
            // inicializo la cantidad eliminada para que no sea enviada ni guardada
//            ccdc.cant = ccdc.realCant();
//            ccdc.cant_eliminada = 0;
            
            if ( !comanderas[ccdc.comandera_id()] || !comanderas[ccdc.comandera_id()].length ) {
               comanderas[ccdc.comandera_id()] = [];
            }
            comanderas[ccdc.comandera_id()].push(ccdc);
        }
        
        var comandaJsonCopy = {
                mesa_id: this.mesa.id(),
                observacion: this.comanda.observacion(),
                imprimir: this.comanda.imprimir()
            }
        
        this.__generarComanda(comandaJsonCopy, comanderas);
        
        return this.comanda;
    },
    
    /**
     * Busca sabores dentro e una DetalleComanda. Si los sabores conciden con los del objeto
     * entonces devuelve true
     * 
     * @param DetalleComanda buscarAca objeto donde que contiene DetalleSabor, que es el array donde voy a buscar
     * @param Array sabores listado de sabores que quiero comparar
     * 
     * @return Boolean
     */
    __findDetalleComandaPorSabor: function(buscarAca, sabores) {
        var dcIx;
        var encontrados = 0;
        
        // Si no tienen el mismo tamaño, directamente devolver false y ahorra los foreach
        if ( sabores.length != buscarAca.DetalleSabor().length ) {
            return false;
        }
        
        // comparar cada sabor con el quie esta en el DetalleComanda
        for (var ss in sabores ){
            for (var dc in buscarAca.DetalleSabor() ){
                dcIx = buscarAca.DetalleSabor()[dc];
                if ( dcIx.id == sabores[ss].id ) {
                    encontrados++;
                }
            }
        }
        
        return encontrados == sabores.length;
    },
    
    
    
    /**
     * Busca productos dentro de los productos seleccionados
     * Si un producto ya esta en el listado, en lugar de crear uo nuevo, asiciona 1 unidad a ese producto
     * Si un producto tiene muchos sabores, tambien busca para sumar aqueyos cuyos sabores concidan,
     * Por ejemp0lo. si yo tengo una ensalada de tomate y lechuga ya en mi DetalleComanda,
     * y luego se agrega otro producto con lechuga y tomate, en lugar de crear un nuevo producto en el listado
     * le suma 1 unidad al anterior. Entonces nos quedarán 2 ensaladas de tomate y lechuga
     * @param prod Producto es el objeto que quiero agregar
     * @param sabores Array de Sabor. es el aray de sabores del prod
     * 
     * @return Index del array de DetalleComanda. me devuelve el uindex donde esta la comanda que contiene ese producto con esos sabores.
     * Devuelve -1 si no encontró nada
     *
     */
    __findDetalleComandaPorProducto: function(prod, sabores) {
        var dcIx, prodIndex, saborIndex;
        for( var sdc in this.comanda.DetalleComanda() ){
            dcIx = this.comanda.DetalleComanda()[sdc];
            prodIndex = dcIx.Producto();
            
            if ( prodIndex.id == prod.id ) {
                if ( dcIx.tieneSabores() ) {
                    if ( this.__findDetalleComandaPorSabor(dcIx, sabores) ) {
                        return sdc;
                    }
                } else {
                    return sdc;
                }
            }
        } 
        return -1;
    },
    
    limpiarSabores: function(){
        this.saboresSeleccionados = [];
//        $('#page-sabores').dialog('close');
    },
    
    saveSabores: function(prod, sabores) {
//        $('#page-sabores').dialog('close');
        
        this.__doAdd( this.productoSaborTmp, this.saboresSeleccionados );
        
        this.saboresSeleccionados = [];
        this.productoSaborTmp = {};
    },
    
    sacarSabor: function(sabor){
       for (var s in this.saboresSeleccionados) {
           if( this.saboresSeleccionados[s].id == sabor.id ) {
               return this.saboresSeleccionados.splice(s,1);
           }          
       }
       return false;
    },
    
    agregarSabor: function( sabor ) {
        this.saboresSeleccionados.push(sabor);
    },
    
    __doAdd: function(prod, sabores){
        var dc;
            
        // checkeo si el producto ya estaba cargado
        var dcIndex = this.__findDetalleComandaPorProducto(prod, sabores);
        
        if ( dcIndex < 0 ) {
            // producto aun no agregado a la lista, entonces lo agrego
            var dcConProd = {Producto : prod};
            dc = new Risto.Adition.detalleComanda(dcConProd);

            // suma 1 al producto
            dc.seleccionar(); 
            
            if (sabores && sabores.length > 0 ) {
                dc.DetalleSabor( sabores );
            }
            
            this.comanda.DetalleComanda.unshift(dc);
            return true;
        } else {
            // el producto ya estaba agregado, asique simplemente lo sumo
            this.comanda.DetalleComanda()[dcIndex].seleccionar();
            return false;
        }
    },
    
    /**
     * Agrega un producto al listado de productos (DetalleComanda) seleccionados
     */
    agregarProducto: function(prod){
        if ( prod.Categoria.Sabor.length > 0 ) {
            this.productoSaborTmp = prod;
            this.currentSabores( prod.Categoria.Sabor );
//             $('#page-sabores').dialog();             
        } else {
            this.__doAdd(prod);
        }
        
    }
    
    
}

/**
 *
 *  Este objeto maneja las mesas recibidas con el json mozos/mesas_abiertas.json
 *  
 *  Cada uno de los keys, son las claves recibidas en el json que viene de esas mesas recibidas
 *
 */
Risto.Adition.handleMesasRecibidas = {
         /**
         * 
         * Recibiendo un json con el listado de mozos, que a su vez 
         * cada uno tiene el listado de mesas abiertas de c/u, actualiza 
         * el listado de mesas de la adicion
         * 
         */
        created: function ( data ) {
            if (!data.mozos) return -1;

            if ( this.mesas().length ) {
                // si ya hay mesas entonces meto las mesas nuevas de forma indidual
                var mozo;
                
                for ( var z in data.mozos ) {
                    mozo = this.findMozoById(  data.mozos[z].id );
                    for ( var m in data.mozos[z].mesas ) {
                        // si no esta en el listado de mesas, la agrego
                        if ( !this.findMesaById( data.mozos[z].mesas[m].id ) ) {
                            new Mesa(mozo, data.mozos[z].mesas[m] );
                        }
                    }
                }
            } else {
                // si no habia mesas, entonces debo hacer todo el proceso de creacion con el mapping
                var mapOps = {
                    'mozos': {
                        create: function(ops) {
                            return new Mozo(ops.data);
                        },
                        key: function(data) {
                            return ko.utils.unwrapObservable(data.id);
                        }
                    }
                }
            
                ko.mapping.fromJS( data, mapOps, Risto.Adition.adicionar );
            }

            Risto.Adition.EventHandler.adicionMesasActualizadas();
        },
        
        
        /**
         * 
         * Recibiendo un json con el listado de mozos, que a su vez 
         * cada uno tiene el listado de mesas abiertas de c/u, actualiza 
         * el listado de mesas de la adicion
         * 
         */
        modified: function ( data ) {
            if (!data.mozos) return -1;
            var mesaEncontrada, 
                mozo;
            for(var z in data.mozos){
                mozo = Risto.Adition.adicionar.findMozoById( data.mozos[z].id );
                for( var m in data.mozos[z].mesas ) {
                    mesaEncontrada = Risto.Adition.adicionar.findMesaById( data.mozos[z].mesas[m].id );
                    if ( mesaEncontrada ) {
                        mesaEncontrada.update( mozo, data.mozos[z].mesas[m] );
                    }
                }
            }
            Risto.Adition.EventHandler.adicionMesasActualizadas();
            return 1;
        },
        
        
        /**
         * 
         * Recibiendo las mesas cobradas las manejo 
         * 
         */
        cobradas: function ( data ) {
            if (!data.mozos) return -1;
            var mesaEncontrada, 
                z; // contador index de mozos
                       
            for (z in data.mozos) {
                for( var m in data.mozos[z].mesas ) {
                    mesaEncontrada = Risto.Adition.adicionar.findMesaById( data.mozos[z].mesas[m].id );
                    
                    if ( mesaEncontrada ) {  
//                        ko.mapping.fromJS( data.mozos[z].mesas[m], {}, mesaEncontrada );
                        mesaEncontrada.mozo().sacarMesa( mesaEncontrada );
                    }
                }
            }
            // reinicializar vistas
            $raeh.adicionMesasActualizadas();
            return 1;
        },
        
        
        /**
         * 
         * Manejo de las mesas eliminadas
         * 
         */
        deleted: Risto.Adition.handleMesasRecibidas
        
    },
    
    
    

/*-------------------------------------------------------- Risto.Adicion.adicion
 *
 *
 * Clase Adicion
 * ees el Kernel de la aplicacion
 * se lo suele encontrar muchas veces como objeto adicionar o adn() para simplicar
 */

Risto.Adition.adicionar = {

    // Mozo Actualmente Activo
    currentMozo: ko.observable( new Mozo() ),
    
    // Mesa Actualmente activa
    currentMesa: ko.observable( new Mesa() ),
    
    // listado de mozos
    mozos: ko.observableArray( [] ),
     // orden del listado de mozos: Se puede poner cualquier valor que venga como atributo (campos de la bbdd de la tabla mozos)
    mozosOrder: ko.observable('numero'),
    
    mesas: ko.observableArray( [] ),
    
    // microtime de la ultima actualizacion de las mesas
    mesasLastUpdatedTime : ko.observable( 0 ),
    
    // pagos seleccionado de la currentMesa en proceso de pago. es una variable temporal de estado
    pagos: ko.observableArray( [] ),
    
    
    /**
     *  Inicializacion para cargar una nueva comanda, es el que activa las variables
     *  creando un nuevo objeto mediante la Fabrica de Comandas. ComandaFabrica
     */
    nuevaComandaParaCurrentMesa: function () {
        this.currentMesa().nuevaComanda();
        return this;
    },
    
    
    /**
     *  Referencia al objeto Menu para que pueda ser utilizado como un Modelo de Knoclkout.js
     *  desde este objeto de adicion.
     */
    menu: function () {
        return Risto.Adition.koAdicionModel.menu.apply(Risto.Adition.koAdicionModel, arguments);
    },
    

    /**
     * Constructor
     */
    initialize: function () {
        var worker = null, // webWorker
            cbk = 0, // contaddor para el for de mesas
            time = ''; // timestamp php que envia el server
            
        if ( Worker ) {  
            
            // Crea el Web Worker
            worker = new Worker(urlDomain + "adition/js/adicion.model.js");
                
            worker.onmessage = function (evt) {
                // si tiene mesas las proceso
                if ( evt.data && evt.data.mesas ) {
                    for ( cbk in evt.data.mesas ) {
                        if ( typeof Risto.Adition.handleMesasRecibidas[cbk] == 'function' ) {
                            Risto.Adition.handleMesasRecibidas[cbk].call( Risto.Adition.adicionar, evt.data.mesas[cbk] );
                        } else {
                            throw cbk + ' vino como opción en el arrar de mesas, pero no es una función válida que pueda manejar el handleMesasRecibidas';
                            Error('no es una funcion');
                        }
                    }
                }

                if ( evt.data.time ) {
                    Risto.Adition.adicionar.mesasLastUpdatedTime( evt.data.time );
                }
            }        

            // inicializacion y parametros de configuracion del worker
            worker.postMessage( {updateInterval: Risto.MESAS_RELOAD_INTERVAL} );

            $(window).bind("online", function(){
                 worker.postMessage( {onLine: true} );
            });
            $(window).bind("offline", function(){
                 worker.postMessage( {onLine: false} );
            });


            time = this.mesasLastUpdatedTime();
            worker.postMessage( {urlDomain: urlDomain, timeText: time} );
        }
    },    
    
    
    /**
     * Busca una mesa por su ID en el listado de mesas
     * devuelve la mesa en caso de encontrarla.
     * caso contrario devuelve false
     * @param id Integer id de la mesa a buscar
     * @return Mesa en caso de encontrarla, false caso contrario
     */
    findMesaById: function(id){
        var m = 0;
        for (m in this.mesas()) {
            if ( this.mesas()[m].id() == id ) {
                return this.mesas()[m];
            }
        }
        return false;
    },
    
    
    /**
     * Busca un mozo por su ID en el listado de mozos
     * devuelve al objeto Mozo en caso de encontrarlo.
     * caso contrario devuelve false
     * @param id Integer id del Mozo a buscar
     * @return Mozo en caso de encontrarlo, false caso contrario
     */
    findMozoById: function ( id ) {
        var m;
        for (m in this.mozos()) {
            if ( this.mozos()[m].id() == id ) {
                return this.mozos()[m];
            }            
        }
        return false;
    },
    

    /**
     * Setter de la currentMesa
     * @param mesa Mesa or Number . Le puedo pasar una Mesa o un Id de la mesa, da lo mismo.
     * @return Mesa o false en caso de que el ID pasado no exista
     */
    setCurrentMesa: function ( mesa ) {
        if ( typeof mesa == 'number') { // en caso que le paso un ID en lugar del objeto mesa
            mesa = this.findMesaById(mesa);           
        }
        this.currentMesa( mesa );
        if (mesa.mozo) {
            this.setCurrentMozo(mesa.mozo());
        }
        return this.currentMesa();
    },
		
                

    /**
     *  Vista rápida de ticket
     *  @param {DOM Element} elementToUpdate
     *  @return {jQUery} DOM element
     */
    ticketView: function ( elementToUpdate ) {
        var elem = elementToUpdate || document.createElement('div');
        var url = window.urlDomain+'mesas/ticket_view' + '/'+this.currentMesa.id ;
        return $(elem).load(url);
    },

    
    /**
     *  Tira un prompt para settear un numero 
     *  y actualizando el valor en la current mesa
     *
     */
    agregarMenu: function(){
        var menu = prompt('Ingrese Cantidad que aparecerá en el detalle del ticket', this.currentMesa().menu());
        var ops = {
                'data[Mesa][menu]': menu
            };
        this.currentMesa().menu( menu );
        this.currentMesa().editar(ops);
    },
    
    /**
     *  Tira un prompt para settear la cantidad de cubiertos
     */
    agregarCantCubiertos: function(){
        var menu = prompt('Ingrese cantidad de Cubiertos', this.currentMesa().cant_comensales());
        menu = parseInt(menu);
        
        if ( menu && typeof menu == 'number' && menu > 0) {
             var ops = {
                'data[Mesa][cant_comensales]': menu
            };
            
            this.currentMesa().cant_comensales( menu );
            this.currentMesa().editar(ops);
        }        
    },


     /**
     *  Modifica el mozo atual por el que se le pasa como parametro
     *  Dispara el evento "adicionCambioMozo"
     * @param Mozo mozo
     */
    setCurrentMozo: function(mozo){
        this.currentMozo( mozo );
        var event = {};
        event.mozo = mozo;
        $raeh.trigger('adicionCambioMozo',event);
        
    },
    
    ordenarMesasPorNumero: function(){
        return this.mesas().sort(function(left, right) {
            return left.numero() == right.numero() ? 0 : (parseInt(left.numero()) < parseInt(right.numero()) ? -1 : 1) 
        })
    },
    
    
    /**
     *  Pasado un JSON con los datos y atributos de una mesa, lo convierte
     *  en un objeto Mesa
     *  @param Mesa mesaJSON
     *  @return Mesa
     */
    crearNuevaMesa: function( mesaJSON ){
        var mozo = this.findMozoById(mesaJSON.mozo_id),
            mesa = new Mesa(mozo, mesaJSON);
        
        $cakeSaver.send({url:urlDomain+'mesas/abrirMesa.json', obj: mesa});
        return mesa;
    },
    
    
    /**
     *  Devueve todas las mesas qu ehay en el sistema
     *  Concatena las mesas que tiene cada mozo
     *  @return Array
     */
    todasLasMesas : function () {
        var mesasList = [];
        if ( this.mozos ) {
            for ( var m in this.mozos() ) {
                mesasList = mesasList.concat( this.mozos()[m].mesas() );
            }
        }
        return mesasList;
    },
    
    

    /**
     * Variable de estado generada cuando se esta armando una comanda
     * son los productos seleccionados.
     * Retorna todos lso productos seleccionados para el armado de una DetalleComanda
     * @return Array
     */
    productosSeleccionados : function () {
        if ( this.currentMesa() && this.currentMesa().currentComanda() && this.currentMesa().currentComanda().comanda && this.currentMesa().currentComanda().comanda.DetalleComanda()) {
            return this.currentMesa().currentComanda().comanda.DetalleComanda();    
        } else {
            return [];
        }
    },


    /**
     * Variable de estado generada cuando se esta armando una comanda
     * son los sabores de un producto seleccionado
     * Retorna el listado de sabores seleccionados
     * @Return Array
     */
    currentSabores : function(){
        if ( this.currentMesa() && this.currentMesa().currentComanda() && this.currentMesa().currentComanda().currentSabores() ) {
            return this.currentMesa().currentComanda().currentSabores();    
        }
    },


    /**
     *  Toma los valores ingresados en los pagos y calcula el vuelto a devolver
     *  @return Float
     */
    vuelto : function () {
       var pagos = this.pagos(),
           sumPagos = 0,
           totMesa = Risto.Adition.adicionar.currentMesa().totalCalculado(),
           vuelto = 0,
           retText = undefined;
       if (pagos && pagos.length) {
           for (var p in pagos) {
               if ( pagos[p].valor() ) {
                sumPagos += parseFloat(pagos[p].valor());
               }
           }
           vuelto = (sumPagos - totMesa);
           if (vuelto <= 0 ){
               retText = (vuelto);
           } else {
               retText = (vuelto);
           }
       }
       return retText;
    },



    /**
     * El vuelto a devolver pero ingresando un texto
     * Ej: Vuelto: $35
     * @return String
     */
    vueltoText : function () {
       var pagos = this.pagos(),
           sumPagos = 0,
           totMesa = Risto.Adition.adicionar.currentMesa().totalCalculado(),
           vuelto = 0,
           retText = 'Total: '+Risto.Adition.adicionar.currentMesa().textoTotalCalculado();
       if (pagos && pagos.length) {
           for (var p in pagos) {
               if ( pagos[p].valor() ) {
                sumPagos += parseFloat(pagos[p].valor());
               }
           }
           vuelto = (totMesa - sumPagos);
           if (vuelto <= 0 ){
               retText = retText+'   -  Vuelto: $  '+Math.abs(vuelto);
           } else {
               retText = retText+'   -  ¡¡¡¡ Faltan: $  '+vuelto+' !!!';
           }
       }
       return retText;
    }
};


// listado de mesas, depende de las mesas de cada mozo, y el orden que le haya indicado
Risto.Adition.adicionar.mesas = ko.dependentObservable( function(){
                var mesasList = [];
                var order = this.mozosOrder();

                mesasList = this.todasLasMesas();
                
                if ( order ) {
                    mesasList.sort(function(left, right) {
                        return left[order]() == right[order]() ? 0 : (parseInt(left[order]()) < parseInt(right[order]()) ? -1 : 1) 
                    })
                }
                return mesasList;

}, Risto.Adition.adicionar);


    
Risto.Adition.adicionar.mesasCerradas = ko.dependentObservable(function(){
    var mesas = [];
    for ( var m in this.mesas() ) {
        if ( !this.mesas()[m].estaAbierta() ) {
            mesas.push( this.mesas()[m]);
        }
    }
    var order = 'time_cerro';
    if ( order ) {
        mesas.sort(function(left, right) {
            if (left[order] && typeof left[order] == 'function' && right[order] && typeof right[order] == 'function') {
                return left[order]() == right[order]() ? 0 : (parseInt(left[order]()) < parseInt(right[order]()) ? 1 : -1) 
            }
        })
    }
                
    return mesas;

}, Risto.Adition.adicionar);/*--------------------------------------------------------------------------------------------------- Risto.Adicion.producto
 *
 *
 * Clase Producto
 */
Risto.Adition.producto = function(data, categoria) {    
    return this.initialize(data, categoria);
}


Risto.Adition.producto.prototype = {
    Categoria: {},
    
    initialize: function(jsonData, categoria){
        this.id = ko.observable( 0 );
        for (var i in jsonData){
                this[i] = jsonData[i];
        }
        
        this.Categoria = categoria;
        return this;
//        return ko.mapping.fromJS(jsonData, {} , this);;
    },
    
        
    seleccionar: function(){
        var event =  $.Event(MENU_ESTADOS_POSIBLES.productoSeleccionado.event);
        event.producto = this; 
        $(document).trigger(event);
    },
    
    tieneSabores: function(){
        if ( this.Categoria.Sabor.length > 0 ){
            return true;
        }
        return false;
    }
}
/*--------------------------------------------------------------------------------------------------- Risto.Adicion.categoria
 *
 *
 * Clase Categoria
 */
Risto.Adition.categoria = function(data, parent){
    this.initialize(data, parent);
    return this;
}

Risto.Adition.categoria.prototype = {
    Padre: {},
    Hijos: [],
    Producto: [],
    Sabor: [],
    image_url: '',
    
    
    initialize: function(jsonData, parent){

        for (var i in jsonData){
            if ( typeof this[i] == 'undefined' ) {
                this[i] = jsonData[i];
            } 
        }
        
        this.image_url = jsonData.image_url;
        
        if (jsonData.Sabor) {
            this.Sabor = [];
        }
        for (var p in jsonData.Sabor){
            this.Sabor.push( new Risto.Adition.sabor( jsonData.Sabor[p], this) );
        }
        
        if (jsonData.Producto) {
            this.Producto = [];
        }
        for (var p in jsonData.Producto){
            this.Producto.push( new Risto.Adition.producto( jsonData.Producto[p], this) );
        }
        
        if (jsonData.Hijos) {
            this.Hijos = [];
        }
        for (var h in jsonData.Hijos){
            if ( jsonData.Hijos[h].id ) {
                this.Hijos.push( new Risto.Adition.categoria( jsonData.Hijos[h], this) );
            }
        }
        
        if (parent) {
            this.Padre = parent;
        }
        
        return this;
    },
    
    seleccionar: function() {
        Risto.Adition.menu.seleccionarCategoria( this );
    }
}/*--------------------------------------------------------------------------------------------------- Risto.Adicion.sabor
 *
 *
 * Clase Sabor, depende de Productos
 */
Risto.Adition.sabor = function(jsonData){
    
    this.initialize(jsonData);
   
    
    return this;
}

Risto.Adition.sabor.prototype = {
     name: '',
     Categoria: [],
     precio: 0,
     model: 'DetalleSabor',
     cant: 0,
     
     cantSeleccionada: function(val){
        if (val) {
            switch (val) {
                case 'sum':
                    this.cant++;
                    break;
                case 'init':
                    this.cant = 0;
                    break;
            }

        }
        return this.cant;
     },
    

     initialize: function(jsonData){
        this.cantSeleccionada('init');
        for (var i in jsonData){
                this[i] = jsonData[i];
        }
        this.sabor_id = this.id;
        return ko.mapping.fromJS({}, {} , this);
    },
    
    
    seleccionar: function(e) {
        e.preventDefault();
//        $(e.currentTarget).addClass('ui-btn-active');
        if ( this.cantSeleccionada() > 0 ){
            Risto.Adition.adicionar.currentMesa().currentComanda().sacarSabor( this ); 
            this.cantSeleccionada('init');
             $(e.currentTarget).removeClass('ui-btn-active');
            return false;
        } else {
             $(e.currentTarget).addClass('ui-btn-active');
            Risto.Adition.adicionar.currentMesa().currentComanda().agregarSabor( this ); 
            this.cantSeleccionada('sum');
            return true;
        }
        
    },
    
    hrefSegunSabor: function(){
        if ( this.Categoria.Sabor.length > 0 ) {
            return 'page-sabores';
        }
        return '#';
    }
 }/*--------------------------------------------------------------------------------------------------- Risto.Adicion.cliente
 *
 *
 * Clase Cliente
 */

Risto.Adition.cliente = function(jsonMap){   
    
    return this.initialize(jsonMap);
}

Risto.Adition.cliente.prototype = {
    Descuento: ko.observable(null),
    porcentaje: ko.observable( undefined ),
    tipofactura: ko.observable(null),
    
    tieneDescuento: function() {
        var porcentaje = undefined;
        if (this.descuento_id() && this.Descuento() && this.Descuento().porcentaje && this.Descuento().porcentaje()) {
            porcentaje = parseInt( this.Descuento().porcentaje() );
        }
        return porcentaje;
    },
    
    
    getDescuentoText : function(){
        var porcentaje = 0;
        if (this.Descuento() && this.Descuento().porcentaje()) {
            porcentaje = parseInt( this.Descuento().porcentaje() )+ '%';
        }
        return porcentaje;
    },
    
    getTipoFactura: function(){
        var tipo = 'R';
        if ( this.tipofactura() && this.tipofactura() != '0' ) {
            tipo = this.tipofactura();
        }
        return tipo;
    },
    
    initialize: function( jsonMap ){
        if ( !jsonMap ) {
            return null;
        }
        if (jsonMap.hasOwnProperty( 'Cliente' ) ) {
            jsonMap = cliente.Cliente;
        }
        
        this.Descuento  = ko.observable( null );
        this.porcentaje = ko.observable( undefined );
        
        if (jsonMap.Descuento && jsonMap.Descuento.id) {
            this.Descuento( new Risto.Adition.descuento(jsonMap.Descuento) );
        }
        delete jsonMap.Descuento;
        
        ko.mapping.fromJS(jsonMap, {}, this);
        return this;
    }
}/*--------------------------------------------------------------------------------------------------- Risto.Adicion.descuento
 *
 *
 * Clase Descuento
 */

Risto.Adition.descuento = function(jsonData){
    return this.initialize(jsonData);
}


Risto.Adition.descuento.prototype = {
    initialize: function(jsonData){
        return ko.mapping.fromJS(jsonData, {}, this);       
    }
}

/*--------------------------------------------------------------------------------------------------- Risto.Adicion.pago
 *
 *
 * Clase Pago
 */
Risto.Adition.pago = function(jsonOb){
    
    return this.initialize(jsonOb);
}


Risto.Adition.pago.prototype = {
    model       : 'Pago',
    TipoDePago  : function( ) {},
    valor       : function( ) {},
    mesa_id     : function( ) {},
    tipo_de_pago_id: undefined,
    
    initialize: function(jsonOb){
        
        this.valor = ko.observable();
        this.mesa_id = Risto.Adition.adicionar.currentMesa().id();
        
        this.TipoDePago = ko.observable(null);
        if (jsonOb) {
            this.TipoDePago(jsonOb);
            
            this.tipo_de_pago_id = this.TipoDePago().id;
        }
        
        Risto.Adition.adicionar.pagos.push(this);
        
        // hacer auto focus al ultimo ingresado
        var inputs = $('.pagos_creados').find('[name="valor"]');
        inputs[inputs.length-1].focus();
    },
    
    image: function(){
        if (this.TipoDePago() && this.TipoDePago().image_url) {
            return urlDomain + 'img/' + this.TipoDePago().image_url;
        }
        return '';
    }
}/*--------------------------------------------------------------------------------------------------- Risto.Adicion.detalleComanda
 *
 *
 * Clase DetalleComanda
 */


Risto.Adition.detalleComanda = function(jsonData) {
    this.initialize(jsonData);
    
    
    // Observables Dependientes
    this.producto_id = ko.dependentObservable( function(){
        if ( this.Producto() ) {
            return this.Producto().id;
        }
        return undefined;
    },this);
    
    
    this.comandera_id = ko.dependentObservable( function(){
        var prod = this.Producto();
        if ( prod ) {
            return prod.comandera_id;
        }
        return undefined;
    }, this);
    
    
    return this;
}


Risto.Adition.detalleComanda.prototype = {
    Producto    : function( ) {},
    DetalleSabor: function( ) {return []}, // array de Sabores

    // cant de este producto seleccionado
    cant        : function( ) {return 0},
    cant_eliminada: function( ) {return 0},
    es_entrada  : function( ) {return 0},
    observacion : function( ) {return ''},
    modificada  : function( ) {return false},
    model       : 'DetalleComanda',
    
    
    initialize: function(jsonData){
        this.DetalleSabor   = ko.observableArray( [] );
        this.imprimir       = ko.observable( true );
        this.cant           = ko.observable( 0 );
        this.cant_eliminada = ko.observable( 0 );
        this.es_entrada     = ko.observable( 0 );
        this.observacion    = ko.observable( '' );
        this.modificada     = ko.observable( false );

        this.Producto = ko.observable( new Risto.Adition.producto() );
        if ( jsonData ) {
            this.Producto =  ko.observable ( new Risto.Adition.producto( jsonData.Producto ) );
            if ( jsonData.DetalleSabor && jsonData.DetalleSabor.length){
                for(var s in jsonData.DetalleSabor){
                    this.DetalleSabor.push( new Risto.Adition.sabor( jsonData.DetalleSabor[s].Sabor) );
                }
                delete jsonData.DetalleSabor;
            }
            delete jsonData.Producto;
            
            jsonData.es_entrada = parseInt( jsonData.es_entrada );
        } else {
            jsonData = {}
        }
        
        ko.mapping.fromJS( jsonData, {} , this );
        return this;
    },
    
    /**
     *Es el valor del producto sumandole los sabores
     */
    precio: function(){
        var total = parseFloat( this.Producto().precio );
        for (var s in this.DetalleSabor() ){
            total += parseFloat( this.DetalleSabor()[s].precio );
        }
        return total;
    },
    
    
    /**
     * Devuelve la cantidad real del producto que se debe adicionar a la mesa.
     * O sea, la cantidad agregada menos la quitada
     */
    realCant: function(){
        return parseInt( this.cant() ) - parseInt( this.cant_eliminada() );
    },
    
    
    
    /**
     *  Devuelve el nombre del producto y al final, entre parentesis los 
     *  sabores si es que tiene alguno
     *  Ej: Ensalada (tomate, lechuga, cebolla)
     *  @return String
     */
    nameConSabores: function(){
        var nom = '';
        if ( this.Producto ) {
            if ( typeof this.Producto().name == 'function'){
                nom += this.Producto().name();
            } else {
                nom += this.Producto().name;
            }
            
            if ( this.DetalleSabor().length > 0 ){
                var dsname = '';
                for (var ds in this.DetalleSabor()) {
                    if ( ds > 0 ) {
                        // no es el primero
                        dsname += ', ';
                    }
                    if (typeof this.DetalleSabor()[ds].name == 'function') {
                        dsname += this.DetalleSabor()[ds].name();
                    } else {
                        dsname += this.DetalleSabor()[ds].name;
                    }
                }
                
                if (dsname != '' ){
                    nom = nom+' ('+dsname+')';
                }                
            }
        }
        
        return nom;
    },
    
    
    
    /**
     * Dispara un evento de producto seleccionado
     */
    seleccionar: function(){        
        this.cant( parseInt(this.cant() ) + 1 );
        this.modificada(true);
    },
    
    
    deseleccionar: function(){
        if (this.realCant() > 0 ) {
            this.cant_eliminada( parseInt( this.cant_eliminada() ) + 1 );
            this.modificada(true);
        }
    },
    
    deseleccionarYEnviar: function(){
        
        if (!window.confirm('Seguro que desea eliminar 1 unidad de '+this.Producto().name)){
            return false;
        }
        
        if (this.realCant() > 0 ) {
            this.cant_eliminada( parseInt( this.cant_eliminada() ) + 1 );
            this.modificada(true);
        }
        var dc = this;
        $cakeSaver.send({
           url: urlDomain + '/detalle_comandas/edit/' + dc.id(),
           obj: dc
        }, function() {
        });
    },
    
    /**
     * Modifica el estado de el objeto indicando si es entrada o no
     * modifica this.es_entrada
     */
    toggleEsEntrada: function(){
        if ( this.es_entrada() ) {
            this.es_entrada( 0 );
        } else {
            this.es_entrada( 1 );
        }
        
    },
    
    
    /**
     * Si este detalleComanda debe ser una entrada, devuelve true
     * 
     * @return Boolean
     */
    esEntrada: function(){
        // no se por que pero hay veces en que viene el boolean como si fuera un character asique deboi
        // hacer esta verificacion
        return this.es_entrada();
    },
    
    
    /**
     * Lee el formulario de la DOM y le mete el valor de observacion
     * Bindea el evento cuando abrio el formulario, pero cuando lo submiteo lo desbindea, 
     * para que otro lo pueda utilizar. O sea, el mismo formulario sirve para 
     * muchos detallesComandas
     */
    addObservacion: function(e){
        this.modificada(true);
        var cntx = this;
        $('#obstext').val( this.observacion() );
        $('#form-comanda-producto-observacion').submit( function(){
            cntx.observacion(  $('#obstext').val() );
            $('#form-comanda-producto-observacion').unbind();
            return false;
        });
    },
    
    
    /**
     * Si el DetalleComanda tiene sabores asignados, devuelve true, caso contrario false
     * @return Boolean
     */
    tieneSabores: function(){
        if ( this.DetalleSabor().length > 0) {
            return true;
        }
        return false;
    }
}

/*--------------------------------------------------------------------------------------------------- KO MODEL
 *
 *
 * Clase Vista de knockout.js depende de Risto.Adition.adicionar y Risto.Adition.menu
 */



/**
 *
 *
 *  KO Model
 *  
 *  Aca van todos los bindings que se realizaran en la vista
 *
 *  tambien el mapeo de datos entre arrays que vienen del servidor
 *
 *
 */
Risto.Adition.koAdicionModel = {
    
    adn     : ko.observable( Risto.Adition.adicionar ),
    menu    : ko.observable( Risto.Adition.menu ),
    
    tieneCurrentMesa: function(){
        if ( typeof this.adn().currentMesa() == 'object')  {
            return true;
        } else {
            return false;
        }
    },
    
    refreshBinding: function(){
        ko.applyBindings( Risto.Adition.koAdicionModel );
    }
}
/*--------------------------------------------------------------------------------------------------- Adition EVENTS
 *
 *
 * Adition Events
 * el el script que capura los eventos de la pagina adition.php[ctp]
 */

// mensaje de confirmacion cuando se esta por salir de la pagina (evitar perdidas de datos no actualizados)
//window.onbeforeunload=confirmacionDeSalida;



/**
 *JQM 
 * renderizado de cosas que se cargan dinamicamente en javascript
 * en cada cambio de pagina, hacemos que se  vuelva a refrescar JQM 
 * para enriquecer los elementos nuevos
 *
 */

      
$(document).bind("mobileinit", function(){    
    
    /**
     *
     *
     *          Mesa View -> Cambiar Mozo
     *
     *
     */

    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-cambiar-mozo').live('pageshow',function(event, ui){    
        // Form SUBMITS
        $('#form-cambiar-mozo').bind('submit', function(e){
            e.preventDefault();
            $raeh.trigger('cambiarMozo', e, this);
            return false;
        });
    });

    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-cambiar-mozo').live('pagehide',function(event, ui){ 
        // Form SUBMITS
        $('#form-cambiar-mozo').unbind('submit');
    });
    
    
    
    /**
     *  Observacion de los productos
     */
    $('#comanda-add-product-obss').live('pageshow',function(event, ui){    
        $('#obstext').focus();
    });






    /**
     *
     *
     *          COMANDA ADD
     *
     */
    $('#comanda-add-menu').live('pageshow', function(){
        //creacion de comandas
        // producto seleccionado
        $(document).bind(  MENU_ESTADOS_POSIBLES.productoSeleccionado.event , productoSeleccionado);        

        // boton para mostrar el formulario de observacion
        $('#comanda-obervacion-a').bind('click', function(){
            $('#comanda-add-observacion').toggle('slow');
            $('textarea','#comanda-add-observacion').focus();
        });
        
     
        $('#ul-productos-seleccionados').delegate(
                '.ui-options-btn',
                'click',
                function(){
                    var $ops = $(this).parent().find('.ui-options'),
                        $opsBtn = $(this).parent().find('.ui-options-btn');
                        
                    if ( $opsBtn.hasClass('ui-options-btn-open') ) {
                        $ops.hide();
                        $opsBtn.removeClass('ui-options-btn-open');
                    } else {
                        $ops.show();
                        $opsBtn.addClass('ui-options-btn-open');
                    }
                }
        );            

        $('#comanda-add-guardar').bind('click', function(){
            Risto.Adition.adicionar.currentMesa().currentComanda().save();
            Risto.Adition.menu.reset();
        });

        function seleccionar(){
            //retrieve the context
            var context = ko.contextFor(this);
            $(this).addClass('active');
            if (context) {
                // $data es es el objeto producto
                context.$data.seleccionar();
            }
        }

        $('#ul-categorias').delegate("a", "click", seleccionar);
        $('#ul-productos').delegate("a", "click", seleccionar);
        
            
        // Eventos para la observacion General de la Comanda ADD
        (function(){
            var $domObs = $('#comanda-add-observacion');
            $("#mesa-comanda-add-obs-gen-cancel").bind('click', function(){
                $domObs.toggle('slow'); 
                Risto.Adition.adicionar.currentMesa().currentComanda().comanda.borrarObservacionGeneral();
            });

            $("#mesa-comanda-add-obs-gen-aceptar").bind('click', function(){
                $domObs.toggle('slow');
            });

            var domObsList = $('.observaciones-list button', '#comanda-add-menu');
            domObsList.bind('click' , function(e){
                if ( this.value ) {
                    Risto.Adition.adicionar.currentMesa().currentComanda().comanda.agregarTextoAObservacionGeneral( this.value );
                }
            });
        })();
    });

    $('#comanda-add-menu').live('pagebeforehide', function(){
        $(document).unbind(  MENU_ESTADOS_POSIBLES.productoSeleccionado.event);
        
        $('#comanda-obervacion-a').unbind('click');
        
        $('a.active','#ul-productos').removeClass('active');
        
        $('#comanda-add-observacion').hide();
        
        $('#ul-categorias').undelegate("a", 'click');
        $('#ul-productos').undelegate("a", 'click');
        
        
        $('#ul-productos-seleccionados').undelegate(
                '.listado-productos-seleccionados',
                'mouseleave'
        );                
        
        $('#ul-productos-seleccionados').undelegate(
                '.ui-options-btn',
                'click'
        ); 
            
            

        $("#mesa-comanda-add-obs-gen-cancel").unbind('click');
        $("#mesa-comanda-add-obs-gen-aceptar").unbind('click');
        $('.observaciones-list button', '#comanda-add-menu').unbind('click');
        $('#comanda-add-guardar').unbind('click');
        
    });






    /**
     *
     *
     *          Mesa View -> Cambiar N° Mesa
     *
     *
     */

    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-cambiar-numero').live('pageshow',function(event, ui){ 

        $('input:first', '#form-cambiar-numero').focus().val('');
        // Form SUBMITS
        $('#form-cambiar-numero').bind( 'submit', function(){
            $raeh.trigger('cambiarNumeroMesa', null, this);
            return false;
        });
    });

    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-cambiar-numero').live('pagebeforehide',function(event, ui){ 
        // Form SUBMITS
         $('#form-cambiar-numero').unbind( 'submit');
    });


    /**
     *
     *
     *          Mesa View
     *
     *
     */

    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-view').live('pageshow',function(event, ui) {
        $('#comanda-detalle-collapsible').trigger('create');

         // CLICKS
        $('#mesa-action-comanda').bind( 'click', function(){
            Risto.Adition.adicionar.nuevaComandaParaCurrentMesa();
        });

        $('#mesa-action-cobrar').bind('click',function(){
            Risto.Adition.adicionar.pagos( [] );
        });
        
        var $hrefEdit = $('a:first-child','#mesa-action-edit'),
            hrefToEditMesa = $hrefEdit.attr('data-href');
        if ( hrefToEditMesa ) {
            $hrefEdit.attr('href', hrefToEditMesa + Risto.Adition.adicionar.currentMesa().id() );
        }


          $('#mesa-menu').bind( 'click', function(){
              Risto.Adition.adicionar.agregarMenu();
          });

          $('#mesa-cant-comensales').bind('click', function(){
              Risto.Adition.adicionar.agregarCantCubiertos();
          });


        $('#mesa-cerrar').bind('click', function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.cerrada );
        });

        $('#mesa-action-reimprimir').bind('click', function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            var url = mesa.urlReimprimirTicket();
            $.get(url);
        });


        $('#mesa-borrar').bind('click', function(){
            if (window.confirm('Seguro que desea borrar la mesa '+Risto.Adition.adicionar.currentMesa().numero())){
                var mesa = Risto.Adition.adicionar.currentMesa();
                mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.borrada );
            }
        });


        $('#mesa-reabrir').bind('click',function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.reabierta );
        });

    });

    $('#mesa-view').live('pagebeforehide',function(event, ui){  
        $('#mesa-action-comanda').unbind('click');
        $('#mesa-action-cobrar').unbind('click');
        $('#mesa-menu').unbind('click');
        $('#mesa-cant-comensales').unbind('click');
        $('#mesa-cerrar').unbind('click');
        $('#mesa-action-reimprimir').unbind('click');
        $('#mesa-borrar').unbind('click');
        $('#mesa-reabrir').unbind('click');
    });







    /**
     *
     *      LISTADO DE MESAS
     *
     *
     */


    $('#listado-mesas').live('pageshow',function(event, ui){
        var $listadoMozos = $('#listado-mozos-para-mesas');
        $listadoMozos.removeClass('ui-grid-a');


        // al hacer click n un mozo del menu bar
        // se muestran solo lasmesas de ese mozo

        $listadoMozos.delegate('a', 'click', function(e) {
            $raeh.trigger('mostrarMesasDeMozo', e.currentTarget);
            return false;        
        });

    });


    $('#listado-mesas').live('pagebeforehide',function(event, ui){
        $('#listado-mozos-para-mesas').undelegate('a','click');
    });
    
    
    
    /**
     *
     * Logica del abrir Mesa, se activa cuando se aprieta el boton de abrir mesa
     *
     */
    (function(){
        
        var $formMesaAdd = null;
         
         
        /**
         * Desbindea los eventos para liberar memoria
         *
         */
        function unbindALl() {
                     $('#add-mesa-paso3-submit').unbind('click');
                     $('#add-mesa-paso2-volver').unbind('click');
                     $('#add-mesa-paso2-submit').unbind('click');
                     $formMesaAdd.unbind('submit');
                     $('#add-mesa-paso3-volver').unbind('click');
                     $('input[type="radio"]', "#add-mesa-paso1").unbind("change");
        }
                
                
        $('#mesa-add').live( 'pageshow', function(){
                $formMesaAdd = $('#form-mesa-add');
                $p3 = $('#add-mesa-paso3');
                $p2 = $( '#add-mesa-paso2');
                $p1 = $( '#add-mesa-paso1');
                
                
                // init
                $p2.hide();
                $p3.hide();
                $p1.show();
                

                /**
                 *
                 * Luego de apretar el submit del formulario agregar mesa....
                 */
                function agregarNuevaMesa(e){
                    unbindALl();
                    e.preventDefault();

                    var rta = $formMesaAdd.serializeArray(), 
                        miniMesa = {}, // json modelo, para crear la mesa
                        mesa, // nueva mesa creada
                        r; // cada atributo del formuario de mesa

                    for (r in rta ) {
                        if (rta[r].name == 'numero' && !rta[r].value){
                            alert("Debe completar numero de mesa");
                            return false;
                        }

                        if (rta[r].name == 'cant_comensales' && !rta[r].value && Risto.Adition.cubiertosObligatorios){
                            alert("Debe indicar la cantidad de cubiertos");
                            return false;
                        }
                        miniMesa[rta[r].name] = rta[r].value;
                    }

                    mesa = Risto.Adition.adicionar.crearNuevaMesa( miniMesa );
                    Risto.Adition.EventHandler.mesaSeleccionada( {"mesa": mesa} );
                    Risto.Adition.adicionar.setCurrentMesa( mesa );
                    $.mobile.changePage('#mesa-view');
                    document.getElementById('form-mesa-add').reset(); // limpio el formulario

                    return false;
                }
                
                function irPaso1(){
                    $p3.hide();
                    $p2.hide();
                    $p1.show();
                }
                
                function irPaso2(){
                    $p1.hide();
                    $p3.hide();
                    $p2.show();           
                    $('#add-mesa-paso2').find( 'input').focus();
                }
                
                function irPaso3(){
                    $p1.hide();
                    $p2.hide();
                    $p3.show();   
                    $('#add-mesa-paso3').find( 'input').focus();
                }
    
                
                // Ir al paso 1
                $('#add-mesa-paso3-submit').bind('click', irPaso1);
                $('#add-mesa-paso2-volver').bind('click', irPaso1);
                
                // Ir al paso 2
                $('input[type="radio"]', "#add-mesa-paso1").bind("change", irPaso2);
                $('#add-mesa-paso3-volver').bind("click", irPaso2);

                // Ir al paso 3
                $('#add-mesa-paso2-submit').bind('click', irPaso3);
                

                $('#form-mesa-add').bind('submit', agregarNuevaMesa);

        });

        $('#mesa-add').live( 'pagehide', function(){
            unbindALl();
            document.getElementById('form-mesa-add').reset();
        });
    })();
     
    

    /**
     *
     *          COBROS               -------    CAJERO
     *
     */
    $('#mesa-cobrar').live('pageshow',function(event, ui){
        $('#mesa-cajero-reabrir').bind('click',function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.reabierta );
        });
        $('.mesa-reimprimir', '#mesa-cobrar').bind('click', function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            var url = mesa.urlReimprimirTicket();
            $.get(url);
        });
    });

    $('#mesa-cobrar').live('pagebeforehide',function(event, ui){
        $('#mesa-cajero-reabrir').unbind('click');
        $('.mesa-reimprimir', '#mesa-cobrar').unbind('click');
        Risto.Adition.adicionar.pagos([]);
    });


    /**
     *
     *          OPCIONES    ----   CAJERO
     *
     */
    $('#cajero-opciones').live('pageshow',function(event, ui){
        $('#modo-k').bind('change',function(){
            Risto.IMPRIME_REMITO_PRIMERO = !Risto.IMPRIME_REMITO_PRIMERO;
            $.get(urlDomain+'/configs/toggle_remito');

        });
    });

    $('#cajero-opciones').live('pagebeforehide',function(event, ui){
         $('#modo-k').unbind('change');
    });


    /**
     *
     *          CLIENTES LISTADO
     *
     */
    $('#listado_de_clientes').live('pageshow',function(event, ui){

        $('input', '#contenedor-listado-clientes-factura-a').bind('keypress', function(){
                    $('.factura-a-cliente-add').show();
         });

        $('#mesa-eliminar-cliente').bind('click',function(){
            Risto.Adition.adicionar.currentMesa().setCliente( null );
            return true;
        });

    });

    $('#listado_de_clientes').live('pagebeforehide',function(event, ui){

        $('#mesa-eliminar-cliente').unbind('click');
        $('input', '#contenedor-listado-clientes-factura-a').unbind('keypress');
    });



    /**
     *
     *
     *    Agregar Clientes ADD
     */
    $('#clientes-addfacturaa').live('pageshow', function() {
        var $fform = $('#form-cliente-add', '#clientes-addfacturaa');
        $fform.bind('submit', function(e){
          var contenedorForm = $fform.parent();
           e.preventDefault();
           $.post(
               $fform.attr('action'), 
               $fform.serialize(),
               function(data){
                   contenedorForm.html(data);
                   contenedorForm.trigger('create');
                   contenedorForm.trigger('refresh');
               }
           );
           return false; 
        });
    });
    
    $('#clientes-addfacturaa').live('pagehide', function() {
        $('#form-cliente-add', '#clientes-addfacturaa').unbind('submit');
    });


    /**
     *
     *
     *          Page COBRAR
     *
     */
    $('#mesa-cobrar').live('pageshow', function(){

        // Al apretar el boton de cobro de pago procesa los pagos correspondientes
        $('#mesa-pagos-procesar').bind('click', function(){
            // lipieza de pagos, selecciono solo los que se les haya agregado algun valor en el input
            for (var p in Risto.Adition.adicionar.pagos() ) {
                if ( Risto.Adition.adicionar.pagos()[p] ) {
                    // agrego el pago a la mesa
                    Risto.Adition.adicionar.currentMesa().Pago.push( Risto.Adition.adicionar.pagos()[p] );
                }
            }

            // reinicio los pagos
            Risto.Adition.adicionar.pagos([]);

            // cambio el estado de la mesa para disparar el evento
            Risto.Adition.adicionar.currentMesa().setEstadoCobrada();
        });
    });

    $('#mesa-cobrar').live('pagebeforehide', function(){
        $('#mesa-pagos-procesar').unbind('click');
    });





    /**
     *
     *
     *          Page SABORES
     *
     */

    $('#page-sabores').live('pageshow', function(){
        var $closeIcon = $('#page-sabores').find( 'a[data-icon="delete"]' );
        $closeIcon.bind('click',function(){
                    Risto.Adition.adicionar.currentMesa().currentComanda().limpiarSabores();
                    $closeIcon.unbind('click');
                });
                
        function seleccionar(e){
            
            //retrieve the context
            var context = ko.contextFor(this);
            $(this).addClass('active');
            if (context) {
                // $data es es el objeto producto
                context.$data.seleccionar(e);
            }
        }

        $('#ul-sabores').delegate("a", "click", seleccionar);
    });
    
    $('#page-sabores').live('pagehide', function(){
        $('#ul-sabores').undelegate("a", "click");
    });


});


/**
 *
 *                  Eventos ONLOAD
 *
 *
 */ 
$(document).ready(function() {   
  
   hacerQueNoFuncioneElClickEnPagina();
    
    $(document).keydown(onKeyDown);
    $(document).keypress(onKeyPress);
    
    
     // Los botones que tengan la clase silent-click sirven para los dialogs
    // la idea es que al ser apretados el dialog se cierre, pero que se envie 
    // el href via ajax, Es util para las ocasiones en las que quiero mandar
    // una accion al servidor del cual no espero respuesta.    
    $('[data-href]').bind('click',function(e){
        var att = $(this).attr('data-href');
        if (att) {
            $.get( att );
        }
        $('.ui-dialog').dialog('close');
    });   
});



/**
 * Cuando estoy creando una comanda se selecciona un producto y 
 * este debe ser agregado al listado de productos de la currentMesa()
 */
function productoSeleccionado(e) {
    Risto.Adition.adicionar.currentMesa().agregarProducto(e.producto);
}




function confirmacionDeSalida(e) {
	if(!e) e = window.event;
	//e.cancelBubble is supported by IE - this will kill the bubbling process.
	e.cancelBubble = true;
	e.returnValue = 'Seguro que deseas salir de la aplicación?\n si no hay datos guardados, los mismos se perderán'; //This is displayed on the dialog

	//e.stopPropagation works in Firefox.
	if (e.stopPropagation) {
		e.stopPropagation();
		e.preventDefault();
	}
    }
    


/**
 *
 *@param String to. es una funcion de jQuery que hace ir para adelante o para atras en la dom 
 *se puede poner: 
 *                  'next' (por default) busca el siguiente elemento
 *                  'prev' busca el anterior
 */
function __irMesaTo(to) {
    var toWhat = to || 'next';
    
    var mesaContainer = $('.listado-adicion', $.mobile.activePage );
    
    if ( !mesaContainer ) {
        return;
    }

    if ( Risto.Adition.mesaCurrentContainer && Risto.Adition.mesaCurrentContainer.attr('id') != mesaContainer.attr('id') ){
        Risto.Adition.mesaCurrentIndex = null;
    }
    
    Risto.Adition.mesaCurrentContainer = mesaContainer;
        
    if ( Risto.Adition.mesaCurrentIndex !== null) {
        var aaa = Risto.Adition.mesaCurrentIndex.parent()[toWhat]().find('a');
        if ( aaa.length ) {
            Risto.Adition.mesaCurrentIndex = aaa;
        } else {
            return;
        }
    } else {
        Risto.Adition.mesaCurrentIndex = Risto.Adition.mesaCurrentContainer.find('a').first();
    }
    Risto.Adition.mesaCurrentIndex.focus();
}
  

function irMesaPrev() {
    __irMesaTo('prev');
    
}

function irMesaNext() {
    __irMesaTo('next');
}


function onKeyDown(e) {
    var code = e.which;
    
    // al apretar la tecla back, volver atras, menos cuando estoy en un INPUT o TEXTAREA
    if (code == 8 ) { // tecla backspace
        if (document.activeElement.tagName.toLowerCase() != 'input' && document.activeElement.tagName.toLowerCase() != 'textarea') {
            history.back();
        }
    }
    
    
    // Ctrol DERECHO + M ir a modo Cajero
    if( (code == 'l'.charCodeAt() || code == 'L'.charCodeAt()) && e.ctrlKey) {
        var pageId = $.mobile.activePage.attr('id');
        
        if ( pageId == 'listado-mesas-cerradas' ) {
            $.mobile.changePage('#listado-mesas');
        }
        
        if ( pageId == 'listado-mesas' ) {
            $.mobile.changePage('#listado-mesas-cerradas');
        }
        return false;
    }        
    
    
    if(code == 23 && e.ctrlKey) {
        $.mobile.changePage('#mesa-view')
    }
        
    
    // mesa siguiente a la seleccionada (focus) del listado de mesas
    if (code == 39 ) { //btn flecha derecha
        irMesaNext();
    }
    
    // mesa anterior a la seleccionada del listado de mesas
    if (code == 37 ) { // boton flecha izq
        irMesaPrev();
    }
}

var oldTimeOut;
function onKeyPress(e) {
    var code = e.which;
    if ( code > 47){ // desde el numero 0 hasta la ultima letra con simbolos
        
        // buscar la mesa con ese numero, busca por accesskey
        Risto.Adition.mesaBuscarAccessKey += String.fromCharCode( code );
        var domFinded = $("[accesskey^='"+Risto.Adition.mesaBuscarAccessKey+"']", $.mobile.activePage);
        if ( domFinded.length ) {
            Risto.Adition.mesaCurrentIndex = $(domFinded[0]);
            domFinded[0].focus();
        }
        
        if(oldTimeOut){
            clearTimeout(oldTimeOut);
        }
        oldTimeOut = setTimeout(function(){
            Risto.Adition.mesaBuscarAccessKey = '';
        },1000);
    }
}



/**
 *  para que no titile el cursor. Que no se pueda hacer click
 */
function hacerQueNoFuncioneElClickEnPagina() {
    return 1;
   if(document.all){
      document.onselectstart = function(e) {return false;} // ie
   } else {
      document.onmousedown = function(e)
      {
         if(e.target.type!='text' && e.target.type!='button' && e.target.type!='textarea') return false;
         else return true;
      } // mozilla
   }
}/*--------------------------------------------------------------------------------------------------- Risto.Adicion.menu
 *
 *
 * Clase Menu
 */

/**
 * @var Static MESAS_POSIBLES_ESTADOS
 * 
 *  esta variable es simplemenete un catalogo de estados posibles que
 *  la mesa pude adoptar en su variable privada this.__estado
 *
 **/
var MENU_ESTADOS_POSIBLES =  {
    productoSeleccionado: {
        msg: 'Producto Seleccionado',
        event: 'productoSeleccionada'
    }
};

Risto.Adition.menu = {
    // listado de categorias anidadas
    categoriasTree: ko.observable(), 
    
    // categoria actualmente activa o seleccionada
    currentCategoria: ko.observable(), 
    
    
    // path de categorias del menu en la que estoy Ej: "/ - Gaseosas - Sin Alcohol""
    path: ko.observableArray( [] ),
    
    initialize: function(){
        this.__armarMenu();
        Risto.Adition.koAdicionModel.menu(this);
        return this;
    },
    
    
    /**
     *  Reinicia el path de comandas, con la categoria root
     */
    reset: function() {
        this.seleccionarCategoria( this.categoriasTree() );
    },
    
    update: function(){
        localStorage.removeItem( 'categoriasTree' );
        this.__getRemoteMenu();
    },
    
    __getRemoteMenu: function(){
        var este = this;
        // si no hay categorias las cargo via AJAX
        $.getJSON( urlDomain+'categorias/listar.json', function(data){
            este.__iniciarCategoriasTreeServer(data)
        } );
    },
    
    
    __armarMenu: function(){
        var newDay          = new Date(),
            cantMiliseconds = 86400000; // 86400000 equivalen a 1 dia
        
        // si no paso mas de 1 día, no volver a traer el menu
        if ( localStorage.categoriasTree && localStorage.categoriasTreeDate && (localStorage.categoriasTreeDate - newDay.valueOf() ) < cantMiliseconds) {
            this.__iniciarCategoriasTreeLocalStorage();
        } else {
            this.__getRemoteMenu();
        }
    },
    
    
    __iniciarCategoriasTreeLocalStorage: function(){
         var cats = JSON.parse(localStorage.categoriasTree);
         this.categoriasTree( new Risto.Adition.categoria( cats ) );
         
          // pongo la primer categoria como current
         this.currentCategoria( this.categoriasTree() );
    },
    
    __iniciarCategoriasTreeServer: function(cats){
        var date = new Date();
        localStorage.setItem( 'categoriasTree', ko.toJSON(cats) );
        localStorage.setItem( 'categoriasTreeDate', date.valueOf() );
        this.__iniciarCategoriasTreeLocalStorage();
    },
    
    
    
    /**
     * Actualiza la variable observable path
     * en base a la categoria seleccionda
     * @param cat Categoria
     */
    __updatePath: function(cat, pathArg, first ){
        var path = pathArg || [];
        var isFirst = true;
        if (first === false) {
            isFirst = false;
        }
       
        cat.esUltimoDelPath = function(){
            return isFirst;
        }
        
        
        if ( cat.hasOwnProperty('Padre') && cat.Padre ) {
             path = this.__updatePath(cat.Padre, path, false );
        }
        path.push(cat);
          
        return path;
    },
    
    
    seleccionarCategoria: function( cat ){   

        this.currentCategoria( cat );
        
        // actualizo el path
        this.path( this.__updatePath(cat) );
        
        return true;
    },
    
    
    /******---      COMANDA         -----******/
    currentSubCategorias : function() {
            if ( this.currentCategoria ) {
                if (this.currentCategoria() && this.currentCategoria().Hijos ) {
                    return this.currentCategoria().Hijos;
                }
                
            }
            return [];
    },



    
    currentProductos : function(){
        if ( this.currentCategoria ) {
            if (this.currentCategoria() && this.currentCategoria().Producto ) {
                return this.currentCategoria().Producto;
            }
            
        }
        return [];
    }
}




Risto.Adition.menu.initialize();/*! jQuery Mobile v1.0 jquerymobile.com | jquery.org/license */
(function(a,e){if(a.cleanData){var b=a.cleanData;a.cleanData=function(f){for(var c=0,h;(h=f[c])!=null;c++)a(h).triggerHandler("remove");b(f)}}else{var d=a.fn.remove;a.fn.remove=function(b,c){return this.each(function(){c||(!b||a.filter(b,[this]).length)&&a("*",this).add([this]).each(function(){a(this).triggerHandler("remove")});return d.call(a(this),b,c)})}}a.widget=function(b,c,h){var d=b.split(".")[0],e,b=b.split(".")[1];e=d+"-"+b;if(!h)h=c,c=a.Widget;a.expr[":"][e]=function(c){return!!a.data(c,
b)};a[d]=a[d]||{};a[d][b]=function(a,b){arguments.length&&this._createWidget(a,b)};c=new c;c.options=a.extend(true,{},c.options);a[d][b].prototype=a.extend(true,c,{namespace:d,widgetName:b,widgetEventPrefix:a[d][b].prototype.widgetEventPrefix||b,widgetBaseClass:e},h);a.widget.bridge(b,a[d][b])};a.widget.bridge=function(b,c){a.fn[b]=function(d){var g=typeof d==="string",i=Array.prototype.slice.call(arguments,1),k=this,d=!g&&i.length?a.extend.apply(null,[true,d].concat(i)):d;if(g&&d.charAt(0)==="_")return k;
g?this.each(function(){var c=a.data(this,b);if(!c)throw"cannot call methods on "+b+" prior to initialization; attempted to call method '"+d+"'";if(!a.isFunction(c[d]))throw"no such method '"+d+"' for "+b+" widget instance";var g=c[d].apply(c,i);if(g!==c&&g!==e)return k=g,false}):this.each(function(){var e=a.data(this,b);e?e.option(d||{})._init():a.data(this,b,new c(d,this))});return k}};a.Widget=function(a,b){arguments.length&&this._createWidget(a,b)};a.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",
options:{disabled:false},_createWidget:function(b,c){a.data(c,this.widgetName,this);this.element=a(c);this.options=a.extend(true,{},this.options,this._getCreateOptions(),b);var d=this;this.element.bind("remove."+this.widgetName,function(){d.destroy()});this._create();this._trigger("create");this._init()},_getCreateOptions:function(){var b={};a.metadata&&(b=a.metadata.get(element)[this.widgetName]);return b},_create:function(){},_init:function(){},destroy:function(){this.element.unbind("."+this.widgetName).removeData(this.widgetName);
this.widget().unbind("."+this.widgetName).removeAttr("aria-disabled").removeClass(this.widgetBaseClass+"-disabled ui-state-disabled")},widget:function(){return this.element},option:function(b,c){var d=b;if(arguments.length===0)return a.extend({},this.options);if(typeof b==="string"){if(c===e)return this.options[b];d={};d[b]=c}this._setOptions(d);return this},_setOptions:function(b){var c=this;a.each(b,function(a,b){c._setOption(a,b)});return this},_setOption:function(a,b){this.options[a]=b;a==="disabled"&&
this.widget()[b?"addClass":"removeClass"](this.widgetBaseClass+"-disabled ui-state-disabled").attr("aria-disabled",b);return this},enable:function(){return this._setOption("disabled",false)},disable:function(){return this._setOption("disabled",true)},_trigger:function(b,c,d){var e=this.options[b],c=a.Event(c);c.type=(b===this.widgetEventPrefix?b:this.widgetEventPrefix+b).toLowerCase();d=d||{};if(c.originalEvent)for(var b=a.event.props.length,i;b;)i=a.event.props[--b],c[i]=c.originalEvent[i];this.element.trigger(c,
d);return!(a.isFunction(e)&&e.call(this.element[0],c,d)===false||c.isDefaultPrevented())}}})(jQuery);
(function(a,e){a.widget("mobile.widget",{_createWidget:function(){a.Widget.prototype._createWidget.apply(this,arguments);this._trigger("init")},_getCreateOptions:function(){var b=this.element,d={};a.each(this.options,function(a){var c=b.jqmData(a.replace(/[A-Z]/g,function(a){return"-"+a.toLowerCase()}));c!==e&&(d[a]=c)});return d},enhanceWithin:function(b){var d=a(b).closest(":jqmData(role='page')").data("page"),d=d&&d.keepNativeSelector()||"";a(this.options.initSelector,b).not(d)[this.widgetName]()}})})(jQuery);
(function(a){a(window);var e=a("html");a.mobile.media=function(){var b={},d=a("<div id='jquery-mediatest'>"),f=a("<body>").append(d);return function(a){if(!(a in b)){var h=document.createElement("style"),g="@media "+a+" { #jquery-mediatest { position:absolute; } }";h.type="text/css";h.styleSheet?h.styleSheet.cssText=g:h.appendChild(document.createTextNode(g));e.prepend(f).prepend(h);b[a]=d.css("position")==="absolute";f.add(h).remove()}return b[a]}}()})(jQuery);
(function(a,e){function b(a){var b=a.charAt(0).toUpperCase()+a.substr(1),a=(a+" "+c.join(b+" ")+b).split(" "),d;for(d in a)if(f[a[d]]!==e)return true}var d=a("<body>").prependTo("html"),f=d[0].style,c=["Webkit","Moz","O"],h="palmGetResource"in window,g=window.operamini&&{}.toString.call(window.operamini)==="[object OperaMini]",i=window.blackberry;a.mobile.browser={};a.mobile.browser.ie=function(){for(var a=3,b=document.createElement("div"),c=b.all||[];b.innerHTML="<\!--[if gt IE "+ ++a+"]><br><![endif]--\>",
c[0];);return a>4?a:!a}();a.extend(a.support,{orientation:"orientation"in window&&"onorientationchange"in window,touch:"ontouchend"in document,cssTransitions:"WebKitTransitionEvent"in window,pushState:"pushState"in history&&"replaceState"in history,mediaquery:a.mobile.media("only all"),cssPseudoElement:!!b("content"),touchOverflow:!!b("overflowScrolling"),boxShadow:!!b("boxShadow")&&!i,scrollTop:("pageXOffset"in window||"scrollTop"in document.documentElement||"scrollTop"in d[0])&&!h&&!g,dynamicBaseTag:function(){var b=
location.protocol+"//"+location.host+location.pathname+"ui-dir/",c=a("head base"),f=null,e="",h;c.length?e=c.attr("href"):c=f=a("<base>",{href:b}).appendTo("head");h=a("<a href='testurl' />").prependTo(d)[0].href;c[0].href=e||location.pathname;f&&f.remove();return h.indexOf(b)===0}()});d.remove();h=function(){var a=window.navigator.userAgent;return a.indexOf("Nokia")>-1&&(a.indexOf("Symbian/3")>-1||a.indexOf("Series60/5")>-1)&&a.indexOf("AppleWebKit")>-1&&a.match(/(BrowserNG|NokiaBrowser)\/7\.[0-3]/)}();
a.mobile.ajaxBlacklist=window.blackberry&&!window.WebKitPoint||g||h;h&&a(function(){a("head link[rel='stylesheet']").attr("rel","alternate stylesheet").attr("rel","stylesheet")});a.support.boxShadow||a("html").addClass("ui-mobile-nosupport-boxshadow")})(jQuery);
(function(a,e,b,d){function f(a){for(;a&&typeof a.originalEvent!=="undefined";)a=a.originalEvent;return a}function c(b){for(var c={},f,d;b;){f=a.data(b,n);for(d in f)if(f[d])c[d]=c.hasVirtualBinding=true;b=b.parentNode}return c}function h(){v&&(clearTimeout(v),v=0);v=setTimeout(function(){E=v=0;u.length=0;D=false;y=true},a.vmouse.resetTimerDuration)}function g(b,c,r){var e,h;if(!(h=r&&r[b])){if(r=!r)a:{for(r=c.target;r;){if((h=a.data(r,n))&&(!b||h[b]))break a;r=r.parentNode}r=null}h=r}if(h){e=c;var r=
e.type,j,g;e=a.Event(e);e.type=b;h=e.originalEvent;j=a.event.props;if(h)for(g=j.length;g;)b=j[--g],e[b]=h[b];if(r.search(/mouse(down|up)|click/)>-1&&!e.which)e.which=1;if(r.search(/^touch/)!==-1&&(b=f(h),r=b.touches,b=b.changedTouches,r=r&&r.length?r[0]:b&&b.length?b[0]:d))for(h=0,len=z.length;h<len;h++)b=z[h],e[b]=r[b];a(c.target).trigger(e)}return e}function i(b){var c=a.data(b.target,A);if(!D&&(!E||E!==c))if(c=g("v"+b.type,b))c.isDefaultPrevented()&&b.preventDefault(),c.isPropagationStopped()&&
b.stopPropagation(),c.isImmediatePropagationStopped()&&b.stopImmediatePropagation()}function k(b){var d=f(b).touches,e;if(d&&d.length===1&&(e=b.target,d=c(e),d.hasVirtualBinding))E=r++,a.data(e,A,E),v&&(clearTimeout(v),v=0),w=y=false,e=f(b).touches[0],x=e.pageX,t=e.pageY,g("vmouseover",b,d),g("vmousedown",b,d)}function l(a){y||(w||g("vmousecancel",a,c(a.target)),w=true,h())}function o(b){if(!y){var d=f(b).touches[0],r=w,e=a.vmouse.moveDistanceThreshold;w=w||Math.abs(d.pageX-x)>e||Math.abs(d.pageY-
t)>e;flags=c(b.target);w&&!r&&g("vmousecancel",b,flags);g("vmousemove",b,flags);h()}}function m(a){if(!y){y=true;var b=c(a.target),d;g("vmouseup",a,b);if(!w&&(d=g("vclick",a,b))&&d.isDefaultPrevented())d=f(a).changedTouches[0],u.push({touchID:E,x:d.clientX,y:d.clientY}),D=true;g("vmouseout",a,b);w=false;h()}}function p(b){var b=a.data(b,n),c;if(b)for(c in b)if(b[c])return true;return false}function j(){}function q(b){var c=b.substr(1);return{setup:function(){p(this)||a.data(this,n,{});a.data(this,
n)[b]=true;s[b]=(s[b]||0)+1;s[b]===1&&B.bind(c,i);a(this).bind(c,j);if(C)s.touchstart=(s.touchstart||0)+1,s.touchstart===1&&B.bind("touchstart",k).bind("touchend",m).bind("touchmove",o).bind("scroll",l)},teardown:function(){--s[b];s[b]||B.unbind(c,i);C&&(--s.touchstart,s.touchstart||B.unbind("touchstart",k).unbind("touchmove",o).unbind("touchend",m).unbind("scroll",l));var d=a(this),f=a.data(this,n);f&&(f[b]=false);d.unbind(c,j);p(this)||d.removeData(n)}}}var n="virtualMouseBindings",A="virtualTouchID",
e="vmouseover vmousedown vmousemove vmouseup vclick vmouseout vmousecancel".split(" "),z="clientX clientY pageX pageY screenX screenY".split(" "),s={},v=0,x=0,t=0,w=false,u=[],D=false,y=false,C="addEventListener"in b,B=a(b),r=1,E=0;a.vmouse={moveDistanceThreshold:10,clickDistanceThreshold:10,resetTimerDuration:1500};for(var F=0;F<e.length;F++)a.event.special[e[F]]=q(e[F]);C&&b.addEventListener("click",function(b){var c=u.length,d=b.target,f,r,e,h,j;if(c){f=b.clientX;r=b.clientY;threshold=a.vmouse.clickDistanceThreshold;
for(e=d;e;){for(h=0;h<c;h++)if(j=u[h],e===d&&Math.abs(j.x-f)<threshold&&Math.abs(j.y-r)<threshold||a.data(e,A)===j.touchID){b.preventDefault();b.stopPropagation();return}e=e.parentNode}}},true)})(jQuery,window,document);
(function(a,e,b){function d(b,c,d){var f=d.type;d.type=c;a.event.handle.call(b,d);d.type=f}a.each("touchstart touchmove touchend orientationchange throttledresize tap taphold swipe swipeleft swiperight scrollstart scrollstop".split(" "),function(b,c){a.fn[c]=function(a){return a?this.bind(c,a):this.trigger(c)};a.attrFn[c]=true});var f=a.support.touch,c=f?"touchstart":"mousedown",h=f?"touchend":"mouseup",g=f?"touchmove":"mousemove";a.event.special.scrollstart={enabled:true,setup:function(){function b(a,
e){f=e;d(c,f?"scrollstart":"scrollstop",a)}var c=this,f,e;a(c).bind("touchmove scroll",function(c){a.event.special.scrollstart.enabled&&(f||b(c,true),clearTimeout(e),e=setTimeout(function(){b(c,false)},50))})}};a.event.special.tap={setup:function(){var b=this,c=a(b);c.bind("vmousedown",function(f){function e(){clearTimeout(q)}function h(){e();c.unbind("vclick",g).unbind("vmouseup",e).unbind("vmousecancel",h)}function g(a){h();j==a.target&&d(b,"tap",a)}if(f.which&&f.which!==1)return false;var j=f.target,
q;c.bind("vmousecancel",h).bind("vmouseup",e).bind("vclick",g);q=setTimeout(function(){d(b,"taphold",a.Event("taphold"))},750)})}};a.event.special.swipe={scrollSupressionThreshold:10,durationThreshold:1E3,horizontalDistanceThreshold:30,verticalDistanceThreshold:75,setup:function(){var d=a(this);d.bind(c,function(c){function f(b){if(m){var c=b.originalEvent.touches?b.originalEvent.touches[0]:b;p={time:(new Date).getTime(),coords:[c.pageX,c.pageY]};Math.abs(m.coords[0]-p.coords[0])>a.event.special.swipe.scrollSupressionThreshold&&
b.preventDefault()}}var e=c.originalEvent.touches?c.originalEvent.touches[0]:c,m={time:(new Date).getTime(),coords:[e.pageX,e.pageY],origin:a(c.target)},p;d.bind(g,f).one(h,function(){d.unbind(g,f);m&&p&&p.time-m.time<a.event.special.swipe.durationThreshold&&Math.abs(m.coords[0]-p.coords[0])>a.event.special.swipe.horizontalDistanceThreshold&&Math.abs(m.coords[1]-p.coords[1])<a.event.special.swipe.verticalDistanceThreshold&&m.origin.trigger("swipe").trigger(m.coords[0]>p.coords[0]?"swipeleft":"swiperight");
m=p=b})})}};(function(a,b){function c(){var a=f();a!==e&&(e=a,d.trigger("orientationchange"))}var d=a(b),f,e;a.event.special.orientationchange={setup:function(){if(a.support.orientation&&a.mobile.orientationChangeEnabled)return false;e=f();d.bind("throttledresize",c)},teardown:function(){if(a.support.orientation&&a.mobile.orientationChangeEnabled)return false;d.unbind("throttledresize",c)},add:function(a){var b=a.handler;a.handler=function(a){a.orientation=f();return b.apply(this,arguments)}}};a.event.special.orientationchange.orientation=
f=function(){var c=true,c=document.documentElement;return(c=a.support.orientation?b.orientation%180==0:c&&c.clientWidth/c.clientHeight<1.1)?"portrait":"landscape"}})(jQuery,e);(function(){a.event.special.throttledresize={setup:function(){a(this).bind("resize",b)},teardown:function(){a(this).unbind("resize",b)}};var b=function(){f=(new Date).getTime();e=f-c;e>=250?(c=f,a(this).trigger("throttledresize")):(d&&clearTimeout(d),d=setTimeout(b,250-e))},c=0,d,f,e})();a.each({scrollstop:"scrollstart",taphold:"tap",
swipeleft:"swipe",swiperight:"swipe"},function(b,c){a.event.special[b]={setup:function(){a(this).bind(c,a.noop)}}})})(jQuery,this);
(function(a,e,b){function d(a){a=a||location.href;return"#"+a.replace(/^[^#]*#?(.*)$/,"$1")}var f="hashchange",c=document,h,g=a.event.special,i=c.documentMode,k="on"+f in e&&(i===b||i>7);a.fn[f]=function(a){return a?this.bind(f,a):this.trigger(f)};a.fn[f].delay=50;g[f]=a.extend(g[f],{setup:function(){if(k)return false;a(h.start)},teardown:function(){if(k)return false;a(h.stop)}});h=function(){function h(){var b=d(),c=n(p);if(b!==p)q(p=b,c),a(e).trigger(f);else if(c!==p)location.href=location.href.replace(/#.*/,
"")+c;i=setTimeout(h,a.fn[f].delay)}var g={},i,p=d(),j=function(a){return a},q=j,n=j;g.start=function(){i||h()};g.stop=function(){i&&clearTimeout(i);i=b};a.browser.msie&&!k&&function(){var b,e;g.start=function(){if(!b)e=(e=a.fn[f].src)&&e+d(),b=a('<iframe tabindex="-1" title="empty"/>').hide().one("load",function(){e||q(d());h()}).attr("src",e||"javascript:0").insertAfter("body")[0].contentWindow,c.onpropertychange=function(){try{if(event.propertyName==="title")b.document.title=c.title}catch(a){}}};
g.stop=j;n=function(){return d(b.location.href)};q=function(d,e){var h=b.document,g=a.fn[f].domain;if(d!==e)h.title=c.title,h.open(),g&&h.write('<script>document.domain="'+g+'"<\/script>'),h.close(),b.location.hash=d}}();return g}()})(jQuery,this);
(function(a){a.widget("mobile.page",a.mobile.widget,{options:{theme:"c",domCache:false,keepNativeDefault:":jqmData(role='none'), :jqmData(role='nojs')"},_create:function(){this._trigger("beforecreate");this.element.attr("tabindex","0").addClass("ui-page ui-body-"+this.options.theme)},keepNativeSelector:function(){var e=this.options;return e.keepNative&&a.trim(e.keepNative)&&e.keepNative!==e.keepNativeDefault?[e.keepNative,e.keepNativeDefault].join(", "):e.keepNativeDefault}})})(jQuery);
(function(a,e){var b={};a.extend(a.mobile,{ns:"",subPageUrlKey:"ui-page",activePageClass:"ui-page-active",activeBtnClass:"ui-btn-active",ajaxEnabled:true,hashListeningEnabled:true,linkBindingEnabled:true,defaultPageTransition:"slide",minScrollBack:250,defaultDialogTransition:"pop",loadingMessage:"loading",pageLoadErrorMessage:"Error Loading Page",autoInitializePage:true,pushStateEnabled:true,orientationChangeEnabled:true,gradeA:function(){return a.support.mediaquery||a.mobile.browser.ie&&a.mobile.browser.ie>=
7},keyCode:{ALT:18,BACKSPACE:8,CAPS_LOCK:20,COMMA:188,COMMAND:91,COMMAND_LEFT:91,COMMAND_RIGHT:93,CONTROL:17,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,INSERT:45,LEFT:37,MENU:93,NUMPAD_ADD:107,NUMPAD_DECIMAL:110,NUMPAD_DIVIDE:111,NUMPAD_ENTER:108,NUMPAD_MULTIPLY:106,NUMPAD_SUBTRACT:109,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SHIFT:16,SPACE:32,TAB:9,UP:38,WINDOWS:91},silentScroll:function(b){if(a.type(b)!=="number")b=a.mobile.defaultHomeScroll;a.event.special.scrollstart.enabled=false;
setTimeout(function(){e.scrollTo(0,b);a(document).trigger("silentscroll",{x:0,y:b})},20);setTimeout(function(){a.event.special.scrollstart.enabled=true},150)},nsNormalizeDict:b,nsNormalize:function(c){return!c?void 0:b[c]||(b[c]=a.camelCase(a.mobile.ns+c))},getInheritedTheme:function(a,b){for(var d=a[0],f="",e=/ui-(bar|body)-([a-z])\b/,l,o;d;){l=d.className||"";if((o=e.exec(l))&&(f=o[2]))break;d=d.parentNode}return f||b||"a"}});a.fn.jqmData=function(b,d){var f;typeof b!="undefined"&&(f=this.data(b?
a.mobile.nsNormalize(b):b,d));return f};a.jqmData=function(b,d,f){var e;typeof d!="undefined"&&(e=a.data(b,d?a.mobile.nsNormalize(d):d,f));return e};a.fn.jqmRemoveData=function(b){return this.removeData(a.mobile.nsNormalize(b))};a.jqmRemoveData=function(b,d){return a.removeData(b,a.mobile.nsNormalize(d))};a.fn.removeWithDependents=function(){a.removeWithDependents(this)};a.removeWithDependents=function(b){b=a(b);(b.jqmData("dependents")||a()).remove();b.remove()};a.fn.addDependents=function(b){a.addDependents(a(this),
b)};a.addDependents=function(b,d){var f=a(b).jqmData("dependents")||a();a(b).jqmData("dependents",a.merge(f,d))};a.fn.getEncodedText=function(){return a("<div/>").text(a(this).text()).html()};var d=a.find,f=/:jqmData\(([^)]*)\)/g;a.find=function(b,e,g,i){b=b.replace(f,"[data-"+(a.mobile.ns||"")+"$1]");return d.call(this,b,e,g,i)};a.extend(a.find,d);a.find.matches=function(b,d){return a.find(b,null,null,d)};a.find.matchesSelector=function(b,d){return a.find(d,null,null,[b]).length>0}})(jQuery,this);
(function(a,e){function b(a){var b=a.find(".ui-title:eq(0)");b.length?b.focus():a.focus()}function d(b){q&&(!q.closest(".ui-page-active").length||b)&&q.removeClass(a.mobile.activeBtnClass);q=null}function f(){z=false;A.length>0&&a.mobile.changePage.apply(null,A.pop())}function c(c,d,f,e){var g=a.mobile.urlHistory.getActive(),j=a.support.touchOverflow&&a.mobile.touchOverflowEnabled,i=g.lastScroll||(j?0:a.mobile.defaultHomeScroll),g=h();window.scrollTo(0,a.mobile.defaultHomeScroll);d&&d.data("page")._trigger("beforehide",
null,{nextPage:c});j||c.height(g+i);c.data("page")._trigger("beforeshow",null,{prevPage:d||a("")});a.mobile.hidePageLoadingMsg();j&&i&&(c.addClass("ui-mobile-pre-transition"),b(c),c.is(".ui-native-fixed")?c.find(".ui-content").scrollTop(i):c.scrollTop(i));f=(a.mobile.transitionHandlers[f||"none"]||a.mobile.defaultTransitionHandler)(f,e,c,d);f.done(function(){j||(c.height(""),b(c));j||a.mobile.silentScroll(i);d&&(j||d.height(""),d.data("page")._trigger("hide",null,{nextPage:c}));c.data("page")._trigger("show",
null,{prevPage:d||a("")})});return f}function h(){var b=a.event.special.orientationchange.orientation()==="portrait",c=b?screen.availHeight:screen.availWidth,b=Math.max(b?480:320,a(window).height());return Math.min(c,b)}function g(){(!a.support.touchOverflow||!a.mobile.touchOverflowEnabled)&&a("."+a.mobile.activePageClass).css("min-height",h())}function i(b,c){c&&b.attr("data-"+a.mobile.ns+"role",c);b.page()}function k(a){for(;a;){if(typeof a.nodeName==="string"&&a.nodeName.toLowerCase()=="a")break;
a=a.parentNode}return a}function l(b){var b=a(b).closest(".ui-page").jqmData("url"),c=t.hrefNoHash;if(!b||!j.isPath(b))b=c;return j.makeUrlAbsolute(b,c)}var o=a(window),m=a("html"),p=a("head"),j={urlParseRE:/^(((([^:\/#\?]+:)?(?:(\/\/)((?:(([^:@\/#\?]+)(?:\:([^:@\/#\?]+))?)@)?(([^:\/#\?\]\[]+|\[[^\/\]@#?]+\])(?:\:([0-9]+))?))?)?)?((\/?(?:[^\/\?#]+\/+)*)([^\?#]*)))?(\?[^#]+)?)(#.*)?/,parseUrl:function(b){if(a.type(b)==="object")return b;b=j.urlParseRE.exec(b||"")||[];return{href:b[0]||"",hrefNoHash:b[1]||
"",hrefNoSearch:b[2]||"",domain:b[3]||"",protocol:b[4]||"",doubleSlash:b[5]||"",authority:b[6]||"",username:b[8]||"",password:b[9]||"",host:b[10]||"",hostname:b[11]||"",port:b[12]||"",pathname:b[13]||"",directory:b[14]||"",filename:b[15]||"",search:b[16]||"",hash:b[17]||""}},makePathAbsolute:function(a,b){if(a&&a.charAt(0)==="/")return a;for(var a=a||"",c=(b=b?b.replace(/^\/|(\/[^\/]*|[^\/]+)$/g,""):"")?b.split("/"):[],d=a.split("/"),f=0;f<d.length;f++){var e=d[f];switch(e){case ".":break;case "..":c.length&&
c.pop();break;default:c.push(e)}}return"/"+c.join("/")},isSameDomain:function(a,b){return j.parseUrl(a).domain===j.parseUrl(b).domain},isRelativeUrl:function(a){return j.parseUrl(a).protocol===""},isAbsoluteUrl:function(a){return j.parseUrl(a).protocol!==""},makeUrlAbsolute:function(a,b){if(!j.isRelativeUrl(a))return a;var c=j.parseUrl(a),d=j.parseUrl(b),f=c.protocol||d.protocol,e=c.protocol?c.doubleSlash:c.doubleSlash||d.doubleSlash,h=c.authority||d.authority,g=c.pathname!=="",i=j.makePathAbsolute(c.pathname||
d.filename,d.pathname);return f+e+h+i+(c.search||!g&&d.search||"")+c.hash},addSearchParams:function(b,c){var d=j.parseUrl(b),f=typeof c==="object"?a.param(c):c,e=d.search||"?";return d.hrefNoSearch+e+(e.charAt(e.length-1)!=="?"?"&":"")+f+(d.hash||"")},convertUrlToDataUrl:function(a){var b=j.parseUrl(a);if(j.isEmbeddedPage(b))return b.hash.split(s)[0].replace(/^#/,"");else if(j.isSameDomain(b,t))return b.hrefNoHash.replace(t.domain,"");return a},get:function(a){if(a===e)a=location.hash;return j.stripHash(a).replace(/[^\/]*\.[^\/*]+$/,
"")},getFilePath:function(b){var c="&"+a.mobile.subPageUrlKey;return b&&b.split(c)[0].split(s)[0]},set:function(a){location.hash=a},isPath:function(a){return/\//.test(a)},clean:function(a){return a.replace(t.domain,"")},stripHash:function(a){return a.replace(/^#/,"")},cleanHash:function(a){return j.stripHash(a.replace(/\?.*$/,"").replace(s,""))},isExternal:function(a){a=j.parseUrl(a);return a.protocol&&a.domain!==x.domain?true:false},hasProtocol:function(a){return/^(:?\w+:)/.test(a)},isFirstPageUrl:function(b){var b=
j.parseUrl(j.makeUrlAbsolute(b,t)),c=a.mobile.firstPage,c=c&&c[0]?c[0].id:e;return(b.hrefNoHash===x.hrefNoHash||w&&b.hrefNoHash===t.hrefNoHash)&&(!b.hash||b.hash==="#"||c&&b.hash.replace(/^#/,"")===c)},isEmbeddedPage:function(a){a=j.parseUrl(a);return a.protocol!==""?a.hash&&(a.hrefNoHash===x.hrefNoHash||w&&a.hrefNoHash===t.hrefNoHash):/^#/.test(a.href)}},q=null,n={stack:[],activeIndex:0,getActive:function(){return n.stack[n.activeIndex]},getPrev:function(){return n.stack[n.activeIndex-1]},getNext:function(){return n.stack[n.activeIndex+
1]},addNew:function(a,b,c,d,f){n.getNext()&&n.clearForward();n.stack.push({url:a,transition:b,title:c,pageUrl:d,role:f});n.activeIndex=n.stack.length-1},clearForward:function(){n.stack=n.stack.slice(0,n.activeIndex+1)},directHashChange:function(b){var c,d,f;this.getActive();a.each(n.stack,function(a,e){b.currentUrl===e.url&&(c=a<n.activeIndex,d=!c,f=a)});this.activeIndex=f!==e?f:this.activeIndex;c?(b.either||b.isBack)(true):d&&(b.either||b.isForward)(false)},ignoreNextHashChange:false},A=[],z=false,
s="&ui-state=dialog",v=p.children("base"),x=j.parseUrl(location.href),t=v.length?j.parseUrl(j.makeUrlAbsolute(v.attr("href"),x.href)):x,w=x.hrefNoHash!==t.hrefNoHash,u=a.support.dynamicBaseTag?{element:v.length?v:a("<base>",{href:t.hrefNoHash}).prependTo(p),set:function(a){u.element.attr("href",j.makeUrlAbsolute(a,t))},reset:function(){u.element.attr("href",t.hrefNoHash)}}:e,D=true,y,C,B;y=function(){var b=o;a.support.touchOverflow&&a.mobile.touchOverflowEnabled&&(b=a(".ui-page-active"),b=b.is(".ui-native-fixed")?
b.find(".ui-content"):b);return b};C=function(b){if(D){var c=a.mobile.urlHistory.getActive();if(c)b=b&&b.scrollTop(),c.lastScroll=b<a.mobile.minScrollBack?a.mobile.defaultHomeScroll:b}};B=function(){setTimeout(C,100,a(this))};o.bind(a.support.pushState?"popstate":"hashchange",function(){D=false});o.one(a.support.pushState?"popstate":"hashchange",function(){D=true});o.one("pagecontainercreate",function(){a.mobile.pageContainer.bind("pagechange",function(){var a=y();D=true;a.unbind("scrollstop",B);
a.bind("scrollstop",B)})});y().bind("scrollstop",B);a.mobile.getScreenHeight=h;a.fn.animationComplete=function(b){return a.support.cssTransitions?a(this).one("webkitAnimationEnd",b):(setTimeout(b,0),a(this))};a.mobile.path=j;a.mobile.base=u;a.mobile.urlHistory=n;a.mobile.dialogHashKey=s;a.mobile.noneTransitionHandler=function(b,c,d,f){f&&f.removeClass(a.mobile.activePageClass);d.addClass(a.mobile.activePageClass);return a.Deferred().resolve(b,c,d,f).promise()};a.mobile.defaultTransitionHandler=a.mobile.noneTransitionHandler;
a.mobile.transitionHandlers={none:a.mobile.defaultTransitionHandler};a.mobile.allowCrossDomainPages=false;a.mobile.getDocumentUrl=function(b){return b?a.extend({},x):x.href};a.mobile.getDocumentBase=function(b){return b?a.extend({},t):t.href};a.mobile._bindPageRemove=function(){var b=a(this);!b.data("page").options.domCache&&b.is(":jqmData(external-page='true')")&&b.bind("pagehide.remove",function(){var b=a(this),c=new a.Event("pageremove");b.trigger(c);c.isDefaultPrevented()||b.removeWithDependents()})};
a.mobile.loadPage=function(b,c){var d=a.Deferred(),f=a.extend({},a.mobile.loadPage.defaults,c),h=null,g=null,m=j.makeUrlAbsolute(b,a.mobile.activePage&&l(a.mobile.activePage)||t.hrefNoHash);if(f.data&&f.type==="get")m=j.addSearchParams(m,f.data),f.data=e;if(f.data&&f.type==="post")f.reloadPage=true;var s=j.getFilePath(m),p=j.convertUrlToDataUrl(m);f.pageContainer=f.pageContainer||a.mobile.pageContainer;h=f.pageContainer.children(":jqmData(url='"+p+"')");h.length===0&&p&&!j.isPath(p)&&(h=f.pageContainer.children("#"+
p).attr("data-"+a.mobile.ns+"url",p));if(h.length===0)if(a.mobile.firstPage&&j.isFirstPageUrl(s))a.mobile.firstPage.parent().length&&(h=a(a.mobile.firstPage));else if(j.isEmbeddedPage(s))return d.reject(m,c),d.promise();u&&u.reset();if(h.length){if(!f.reloadPage)return i(h,f.role),d.resolve(m,c,h),d.promise();g=h}var n=f.pageContainer,k=new a.Event("pagebeforeload"),q={url:b,absUrl:m,dataUrl:p,deferred:d,options:f};n.trigger(k,q);if(k.isDefaultPrevented())return d.promise();if(f.showLoadMsg)var v=
setTimeout(function(){a.mobile.showPageLoadingMsg()},f.loadMsgDelay);!a.mobile.allowCrossDomainPages&&!j.isSameDomain(x,m)?d.reject(m,c):a.ajax({url:s,type:f.type,data:f.data,dataType:"html",success:function(e,n,k){var o=a("<div></div>"),l=e.match(/<title[^>]*>([^<]*)/)&&RegExp.$1,t=RegExp("\\bdata-"+a.mobile.ns+"url=[\"']?([^\"'>]*)[\"']?");RegExp("(<[^>]+\\bdata-"+a.mobile.ns+"role=[\"']?page[\"']?[^>]*>)").test(e)&&RegExp.$1&&t.test(RegExp.$1)&&RegExp.$1&&(b=s=j.getFilePath(RegExp.$1));u&&u.set(s);
o.get(0).innerHTML=e;h=o.find(":jqmData(role='page'), :jqmData(role='dialog')").first();h.length||(h=a("<div data-"+a.mobile.ns+"role='page'>"+e.split(/<\/?body[^>]*>/gmi)[1]+"</div>"));l&&!h.jqmData("title")&&(~l.indexOf("&")&&(l=a("<div>"+l+"</div>").text()),h.jqmData("title",l));if(!a.support.dynamicBaseTag){var x=j.get(s);h.find("[src], link[href], a[rel='external'], :jqmData(ajax='false'), a[target]").each(function(){var b=a(this).is("[href]")?"href":a(this).is("[src]")?"src":"action",c=a(this).attr(b),
c=c.replace(location.protocol+"//"+location.host+location.pathname,"");/^(\w+:|#|\/)/.test(c)||a(this).attr(b,x+c)})}h.attr("data-"+a.mobile.ns+"url",j.convertUrlToDataUrl(s)).attr("data-"+a.mobile.ns+"external-page",true).appendTo(f.pageContainer);h.one("pagecreate",a.mobile._bindPageRemove);i(h,f.role);m.indexOf("&"+a.mobile.subPageUrlKey)>-1&&(h=f.pageContainer.children(":jqmData(url='"+p+"')"));f.showLoadMsg&&(clearTimeout(v),a.mobile.hidePageLoadingMsg());q.xhr=k;q.textStatus=n;q.page=h;f.pageContainer.trigger("pageload",
q);d.resolve(m,c,h,g)},error:function(b,e,h){u&&u.set(j.get());q.xhr=b;q.textStatus=e;q.errorThrown=h;b=new a.Event("pageloadfailed");f.pageContainer.trigger(b,q);b.isDefaultPrevented()||(f.showLoadMsg&&(clearTimeout(v),a.mobile.hidePageLoadingMsg(),a("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h1>"+a.mobile.pageLoadErrorMessage+"</h1></div>").css({display:"block",opacity:0.96,top:o.scrollTop()+100}).appendTo(f.pageContainer).delay(800).fadeOut(400,function(){a(this).remove()})),
d.reject(m,c))}});return d.promise()};a.mobile.loadPage.defaults={type:"get",data:e,reloadPage:false,role:e,showLoadMsg:false,pageContainer:e,loadMsgDelay:50};a.mobile.changePage=function(b,h){if(z)A.unshift(arguments);else{var g=a.extend({},a.mobile.changePage.defaults,h);g.pageContainer=g.pageContainer||a.mobile.pageContainer;g.fromPage=g.fromPage||a.mobile.activePage;var p=g.pageContainer,k=new a.Event("pagebeforechange"),q={toPage:b,options:g};p.trigger(k,q);if(!k.isDefaultPrevented())if(b=q.toPage,
z=true,typeof b=="string")a.mobile.loadPage(b,g).done(function(b,c,d,f){z=false;c.duplicateCachedPage=f;a.mobile.changePage(d,c)}).fail(function(){z=false;d(true);f();g.pageContainer.trigger("pagechangefailed",q)});else{if(b[0]===a.mobile.firstPage[0]&&!g.dataUrl)g.dataUrl=x.hrefNoHash;var k=g.fromPage,l=g.dataUrl&&j.convertUrlToDataUrl(g.dataUrl)||b.jqmData("url"),v=l;j.getFilePath(l);var o=n.getActive(),t=n.activeIndex===0,w=0,u=document.title,y=g.role==="dialog"||b.jqmData("role")==="dialog";if(k&&
k[0]===b[0]&&!g.allowSamePageTransition)z=false,p.trigger("pagechange",q);else{i(b,g.role);g.fromHashChange&&n.directHashChange({currentUrl:l,isBack:function(){w=-1},isForward:function(){w=1}});try{document.activeElement&&document.activeElement.nodeName.toLowerCase()!="body"?a(document.activeElement).blur():a("input:focus, textarea:focus, select:focus").blur()}catch(B){}y&&o&&(l=(o.url||"")+s);if(g.changeHash!==false&&l)n.ignoreNextHashChange=true,j.set(l);var C=!o?u:b.jqmData("title")||b.children(":jqmData(role='header')").find(".ui-title").getEncodedText();
C&&u==document.title&&(u=C);b.jqmData("title")||b.jqmData("title",u);g.transition=g.transition||(w&&!t?o.transition:e)||(y?a.mobile.defaultDialogTransition:a.mobile.defaultPageTransition);w||n.addNew(l,g.transition,u,v,g.role);document.title=n.getActive().title;a.mobile.activePage=b;g.reverse=g.reverse||w<0;c(b,k,g.transition,g.reverse).done(function(){d();g.duplicateCachedPage&&g.duplicateCachedPage.remove();m.removeClass("ui-mobile-rendering");f();p.trigger("pagechange",q)})}}}};a.mobile.changePage.defaults=
{transition:e,reverse:false,changeHash:true,fromHashChange:false,role:e,duplicateCachedPage:e,pageContainer:e,showLoadMsg:true,dataUrl:e,fromPage:e,allowSamePageTransition:false};a.mobile._registerInternalEvents=function(){a("form").live("submit",function(b){var c=a(this);if(a.mobile.ajaxEnabled&&!c.is(":jqmData(ajax='false')")){var d=c.attr("method"),f=c.attr("target"),e=c.attr("action");if(!e&&(e=l(c),e===t.hrefNoHash))e=x.hrefNoSearch;e=j.makeUrlAbsolute(e,l(c));!j.isExternal(e)&&!f&&(a.mobile.changePage(e,
{type:d&&d.length&&d.toLowerCase()||"get",data:c.serialize(),transition:c.jqmData("transition"),direction:c.jqmData("direction"),reloadPage:true}),b.preventDefault())}});a(document).bind("vclick",function(b){if(!(b.which>1)&&a.mobile.linkBindingEnabled&&(b=k(b.target))&&j.parseUrl(b.getAttribute("href")||"#").hash!=="#")d(true),q=a(b).closest(".ui-btn").not(".ui-disabled"),q.addClass(a.mobile.activeBtnClass),a("."+a.mobile.activePageClass+" .ui-btn").not(b).blur()});a(document).bind("click",function(b){if(a.mobile.linkBindingEnabled){var c=
k(b.target);if(c&&!(b.which>1)){var f=a(c),h=function(){window.setTimeout(function(){d(true)},200)};if(f.is(":jqmData(rel='back')"))return window.history.back(),false;var g=l(f),c=j.makeUrlAbsolute(f.attr("href")||"#",g);if(!a.mobile.ajaxEnabled&&!j.isEmbeddedPage(c))h();else{if(c.search("#")!=-1)if(c=c.replace(/[^#]*#/,""))c=j.isPath(c)?j.makeUrlAbsolute(c,g):j.makeUrlAbsolute("#"+c,x.hrefNoHash);else{b.preventDefault();return}var g=f.is("[rel='external']")||f.is(":jqmData(ajax='false')")||f.is("[target]"),
i=a.mobile.allowCrossDomainPages&&x.protocol==="file:"&&c.search(/^https?:/)!=-1;g||j.isExternal(c)&&!i?h():(h=f.jqmData("transition"),g=(g=f.jqmData("direction"))&&g==="reverse"||f.jqmData("back"),f=f.attr("data-"+a.mobile.ns+"rel")||e,a.mobile.changePage(c,{transition:h,reverse:g,role:f}),b.preventDefault())}}}});a(".ui-page").live("pageshow.prefetch",function(){var b=[];a(this).find("a:jqmData(prefetch)").each(function(){var c=a(this),f=c.attr("href");f&&a.inArray(f,b)===-1&&(b.push(f),a.mobile.loadPage(f,
{role:c.attr("data-"+a.mobile.ns+"rel")}))})});a.mobile._handleHashChange=function(b){var c=j.stripHash(b),f={transition:a.mobile.urlHistory.stack.length===0?"none":e,changeHash:false,fromHashChange:true};if(!a.mobile.hashListeningEnabled||n.ignoreNextHashChange)n.ignoreNextHashChange=false;else{if(n.stack.length>1&&c.indexOf(s)>-1)if(a.mobile.activePage.is(".ui-dialog"))n.directHashChange({currentUrl:c,either:function(b){var d=a.mobile.urlHistory.getActive();c=d.pageUrl;a.extend(f,{role:d.role,transition:d.transition,
reverse:b})}});else{n.directHashChange({currentUrl:c,isBack:function(){window.history.back()},isForward:function(){window.history.forward()}});return}c?(c=typeof c==="string"&&!j.isPath(c)?j.makeUrlAbsolute("#"+c,t):c,a.mobile.changePage(c,f)):a.mobile.changePage(a.mobile.firstPage,f)}};o.bind("hashchange",function(){a.mobile._handleHashChange(location.hash)});a(document).bind("pageshow",g);a(window).bind("throttledresize",g)}})(jQuery);
(function(a,e){var b={},d=a(e),f=a.mobile.path.parseUrl(location.href);a.extend(b,{initialFilePath:f.pathname+f.search,initialHref:f.hrefNoHash,hashchangeFired:false,state:function(){return{hash:location.hash||"#"+b.initialFilePath,title:document.title,initialHref:b.initialHref}},resetUIKeys:function(b){var f="&"+a.mobile.subPageUrlKey,d=b.indexOf(a.mobile.dialogHashKey);d>-1?b=b.slice(0,d)+"#"+b.slice(d):b.indexOf(f)>-1&&(b=b.split(f).join("#"+f));return b},nextHashChangePrevented:function(c){a.mobile.urlHistory.ignoreNextHashChange=
c;b.onHashChangeDisabled=c},onHashChange:function(){if(!b.onHashChangeDisabled){var c,f;c=location.hash;var d=a.mobile.path.isPath(c),e=d?location.href:a.mobile.getDocumentUrl();c=d?c.replace("#",""):c;f=b.state();c=a.mobile.path.makeUrlAbsolute(c,e);d&&(c=b.resetUIKeys(c));history.replaceState(f,document.title,c)}},onPopState:function(c){var f=c.originalEvent.state;f&&(b.nextHashChangePrevented(true),setTimeout(function(){b.nextHashChangePrevented(false);a.mobile._handleHashChange(f.hash)},100))},
init:function(){d.bind("hashchange",b.onHashChange);d.bind("popstate",b.onPopState);location.hash===""&&history.replaceState(b.state(),document.title,location.href)}});a(function(){a.mobile.pushStateEnabled&&a.support.pushState&&b.init()})})(jQuery,this);
(function(a){function e(b,d,f,c){var e=new a.Deferred,g=d?" reverse":"",i="ui-mobile-viewport-transitioning viewport-"+b;f.animationComplete(function(){f.add(c).removeClass("out in reverse "+b);c&&c[0]!==f[0]&&c.removeClass(a.mobile.activePageClass);f.parent().removeClass(i);e.resolve(b,d,f,c)});f.parent().addClass(i);c&&c.addClass(b+" out"+g);f.addClass(a.mobile.activePageClass+" "+b+" in"+g);return e.promise()}a.mobile.css3TransitionHandler=e;if(a.mobile.defaultTransitionHandler===a.mobile.noneTransitionHandler)a.mobile.defaultTransitionHandler=
e})(jQuery,this);
(function(a){a.mobile.page.prototype.options.degradeInputs={color:false,date:false,datetime:false,"datetime-local":false,email:false,month:false,number:false,range:"number",search:"text",tel:false,time:false,url:false,week:false};a(document).bind("pagecreate create",function(e){var b=a(e.target).closest(':jqmData(role="page")').data("page"),d;if(b)d=b.options,a(e.target).find("input").not(b.keepNativeSelector()).each(function(){var b=a(this),c=this.getAttribute("type"),e=d.degradeInputs[c]||"text";
if(d.degradeInputs[c]){var g=a("<div>").html(b.clone()).html(),i=g.indexOf(" type=")>-1;b.replaceWith(g.replace(i?/\s+type=["']?\w+['"]?/:/\/?>/,' type="'+e+'" data-'+a.mobile.ns+'type="'+c+'"'+(i?"":">")))}})})})(jQuery);
(function(a,e){a.widget("mobile.dialog",a.mobile.widget,{options:{closeBtnText:"Close",overlayTheme:"a",initSelector:":jqmData(role='dialog')"},_create:function(){var b=this,d=this.element,f=a("<a href='#' data-"+a.mobile.ns+"icon='delete' data-"+a.mobile.ns+"iconpos='notext'>"+this.options.closeBtnText+"</a>");d.addClass("ui-overlay-"+this.options.overlayTheme);d.attr("role","dialog").addClass("ui-dialog").find(":jqmData(role='header')").addClass("ui-corner-top ui-overlay-shadow").prepend(f).end().find(":jqmData(role='content'),:jqmData(role='footer')").addClass("ui-overlay-shadow").last().addClass("ui-corner-bottom");
f.bind("vclick",function(){b.close()});d.bind("vclick submit",function(b){var b=a(b.target).closest(b.type==="vclick"?"a":"form"),f;b.length&&!b.jqmData("transition")&&(f=a.mobile.urlHistory.getActive()||{},b.attr("data-"+a.mobile.ns+"transition",f.transition||a.mobile.defaultDialogTransition).attr("data-"+a.mobile.ns+"direction","reverse"))}).bind("pagehide",function(){a(this).find("."+a.mobile.activeBtnClass).removeClass(a.mobile.activeBtnClass)})},close:function(){e.history.back()}});a(a.mobile.dialog.prototype.options.initSelector).live("pagecreate",
function(){a(this).dialog()})})(jQuery,this);
(function(a){a.mobile.page.prototype.options.backBtnText="Back";a.mobile.page.prototype.options.addBackBtn=false;a.mobile.page.prototype.options.backBtnTheme=null;a.mobile.page.prototype.options.headerTheme="a";a.mobile.page.prototype.options.footerTheme="a";a.mobile.page.prototype.options.contentTheme=null;a(":jqmData(role='page'), :jqmData(role='dialog')").live("pagecreate",function(){var e=a(this),b=e.data("page").options,d=e.jqmData("role"),f=b.theme;a(":jqmData(role='header'), :jqmData(role='footer'), :jqmData(role='content')",
this).each(function(){var c=a(this),e=c.jqmData("role"),g=c.jqmData("theme"),i=g||b.contentTheme||d==="dialog"&&f,k;c.addClass("ui-"+e);if(e==="header"||e==="footer"){var l=g||(e==="header"?b.headerTheme:b.footerTheme)||f;c.addClass("ui-bar-"+l).attr("role",e==="header"?"banner":"contentinfo");g=c.children("a");i=g.hasClass("ui-btn-left");k=g.hasClass("ui-btn-right");i=i||g.eq(0).not(".ui-btn-right").addClass("ui-btn-left").length;k||g.eq(1).addClass("ui-btn-right");b.addBackBtn&&e==="header"&&a(".ui-page").length>
1&&c.jqmData("url")!==a.mobile.path.stripHash(location.hash)&&!i&&a("<a href='#' class='ui-btn-left' data-"+a.mobile.ns+"rel='back' data-"+a.mobile.ns+"icon='arrow-l'>"+b.backBtnText+"</a>").attr("data-"+a.mobile.ns+"theme",b.backBtnTheme||l).prependTo(c);c.children("h1, h2, h3, h4, h5, h6").addClass("ui-title").attr({tabindex:"0",role:"heading","aria-level":"1"})}else e==="content"&&(i&&c.addClass("ui-body-"+i),c.attr("role","main"))})})})(jQuery);
(function(a){a.widget("mobile.collapsible",a.mobile.widget,{options:{expandCueText:" click to expand contents",collapseCueText:" click to collapse contents",collapsed:true,heading:"h1,h2,h3,h4,h5,h6,legend",theme:null,contentTheme:null,iconTheme:"d",initSelector:":jqmData(role='collapsible')"},_create:function(){var e=this.element,b=this.options,d=e.addClass("ui-collapsible"),f=e.children(b.heading).first(),c=d.wrapInner("<div class='ui-collapsible-content'></div>").find(".ui-collapsible-content"),
h=e.closest(":jqmData(role='collapsible-set')").addClass("ui-collapsible-set"),e=h.children(":jqmData(role='collapsible')");f.is("legend")&&(f=a("<div role='heading'>"+f.html()+"</div>").insertBefore(f),f.next().remove());if(h.length){if(!b.theme)b.theme=h.jqmData("theme");if(!b.contentTheme)b.contentTheme=h.jqmData("content-theme")}c.addClass(b.contentTheme?"ui-body-"+b.contentTheme:"");f.insertBefore(c).addClass("ui-collapsible-heading").append("<span class='ui-collapsible-heading-status'></span>").wrapInner("<a href='#' class='ui-collapsible-heading-toggle'></a>").find("a").first().buttonMarkup({shadow:false,
corners:false,iconPos:"left",icon:"plus",theme:b.theme});h.length?(h.jqmData("collapsiblebound")||h.jqmData("collapsiblebound",true).bind("expand",function(b){a(b.target).closest(".ui-collapsible").siblings(".ui-collapsible").trigger("collapse")}),e.first().find("a").first().addClass("ui-corner-top").find(".ui-btn-inner").addClass("ui-corner-top"),e.last().jqmData("collapsible-last",true).find("a").first().addClass("ui-corner-bottom").find(".ui-btn-inner").addClass("ui-corner-bottom"),d.jqmData("collapsible-last")&&
f.find("a").first().add(f.find(".ui-btn-inner")).addClass("ui-corner-bottom")):f.find("a").first().add(f.find(".ui-btn-inner")).addClass("ui-corner-top ui-corner-bottom");d.bind("expand collapse",function(e){if(!e.isDefaultPrevented()){e.preventDefault();var i=a(this),e=e.type==="collapse",k=b.contentTheme;f.toggleClass("ui-collapsible-heading-collapsed",e).find(".ui-collapsible-heading-status").text(e?b.expandCueText:b.collapseCueText).end().find(".ui-icon").toggleClass("ui-icon-minus",!e).toggleClass("ui-icon-plus",
e);i.toggleClass("ui-collapsible-collapsed",e);c.toggleClass("ui-collapsible-content-collapsed",e).attr("aria-hidden",e);if(k&&(!h.length||d.jqmData("collapsible-last")))f.find("a").first().add(f.find(".ui-btn-inner")).toggleClass("ui-corner-bottom",e),c.toggleClass("ui-corner-bottom",!e);c.trigger("updatelayout")}}).trigger(b.collapsed?"collapse":"expand");f.bind("click",function(a){var b=f.is(".ui-collapsible-heading-collapsed")?"expand":"collapse";d.trigger(b);a.preventDefault()})}});a(document).bind("pagecreate create",
function(e){a(a.mobile.collapsible.prototype.options.initSelector,e.target).collapsible()})})(jQuery);(function(a){a.fn.fieldcontain=function(){return this.addClass("ui-field-contain ui-body ui-br")};a(document).bind("pagecreate create",function(e){a(":jqmData(role='fieldcontain')",e.target).fieldcontain()})})(jQuery);
(function(a){a.fn.grid=function(e){return this.each(function(){var b=a(this),d=a.extend({grid:null},e),f=b.children(),c={solo:1,a:2,b:3,c:4,d:5},d=d.grid;if(!d)if(f.length<=5)for(var h in c)c[h]===f.length&&(d=h);else d="a";c=c[d];b.addClass("ui-grid-"+d);f.filter(":nth-child("+c+"n+1)").addClass("ui-block-a");c>1&&f.filter(":nth-child("+c+"n+2)").addClass("ui-block-b");c>2&&f.filter(":nth-child(3n+3)").addClass("ui-block-c");c>3&&f.filter(":nth-child(4n+4)").addClass("ui-block-d");c>4&&f.filter(":nth-child(5n+5)").addClass("ui-block-e")})}})(jQuery);
(function(a,e){a.widget("mobile.navbar",a.mobile.widget,{options:{iconpos:"top",grid:null,initSelector:":jqmData(role='navbar')"},_create:function(){var b=this.element,d=b.find("a"),f=d.filter(":jqmData(icon)").length?this.options.iconpos:e;b.addClass("ui-navbar").attr("role","navigation").find("ul").grid({grid:this.options.grid});f||b.addClass("ui-navbar-noicons");d.buttonMarkup({corners:false,shadow:false,iconpos:f});b.delegate("a","vclick",function(){d.not(".ui-state-persist").removeClass(a.mobile.activeBtnClass);
a(this).addClass(a.mobile.activeBtnClass)})}});a(document).bind("pagecreate create",function(b){a(a.mobile.navbar.prototype.options.initSelector,b.target).navbar()})})(jQuery);
(function(a){var e={};a.widget("mobile.listview",a.mobile.widget,{options:{theme:null,countTheme:"c",headerTheme:"b",dividerTheme:"b",splitIcon:"arrow-r",splitTheme:"b",inset:false,initSelector:":jqmData(role='listview')"},_create:function(){var a=this;a.element.addClass(function(d,f){return f+" ui-listview "+(a.options.inset?" ui-listview-inset ui-corner-all ui-shadow ":"")});a.refresh(true)},_removeCorners:function(a,d){a=a.add(a.find(".ui-btn-inner, .ui-li-link-alt, .ui-li-thumb"));d==="top"?a.removeClass("ui-corner-top ui-corner-tr ui-corner-tl"):
d==="bottom"?a.removeClass("ui-corner-bottom ui-corner-br ui-corner-bl"):a.removeClass("ui-corner-top ui-corner-tr ui-corner-tl ui-corner-bottom ui-corner-br ui-corner-bl")},_refreshCorners:function(a){var d,f;this.options.inset&&(d=this.element.children("li"),f=a?d.not(".ui-screen-hidden"):d.filter(":visible"),this._removeCorners(d),d=f.first().addClass("ui-corner-top"),d.add(d.find(".ui-btn-inner").not(".ui-li-link-alt span:first-child")).addClass("ui-corner-top").end().find(".ui-li-link-alt, .ui-li-link-alt span:first-child").addClass("ui-corner-tr").end().find(".ui-li-thumb").not(".ui-li-icon").addClass("ui-corner-tl"),
f=f.last().addClass("ui-corner-bottom"),f.add(f.find(".ui-btn-inner")).find(".ui-li-link-alt").addClass("ui-corner-br").end().find(".ui-li-thumb").not(".ui-li-icon").addClass("ui-corner-bl"));a||this.element.trigger("updatelayout")},_findFirstElementByTagName:function(a,d,f,c){var e={};for(e[f]=e[c]=true;a;){if(e[a.nodeName])return a;a=a[d]}return null},_getChildrenByTagName:function(b,d,f){var c=[],e={};e[d]=e[f]=true;for(b=b.firstChild;b;)e[b.nodeName]&&c.push(b),b=b.nextSibling;return a(c)},_addThumbClasses:function(b){var d,
f,c=b.length;for(d=0;d<c;d++)f=a(this._findFirstElementByTagName(b[d].firstChild,"nextSibling","img","IMG")),f.length&&(f.addClass("ui-li-thumb"),a(this._findFirstElementByTagName(f[0].parentNode,"parentNode","li","LI")).addClass(f.is(".ui-li-icon")?"ui-li-has-icon":"ui-li-has-thumb"))},refresh:function(b){this.parentPage=this.element.closest(".ui-page");this._createSubPages();var d=this.options,f=this.element,c=f.jqmData("dividertheme")||d.dividerTheme,e=f.jqmData("splittheme"),g=f.jqmData("spliticon"),
i=this._getChildrenByTagName(f[0],"li","LI"),k=a.support.cssPseudoElement||!a.nodeName(f[0],"ol")?0:1,l={},o,m,p,j,q;k&&f.find(".ui-li-dec").remove();if(!d.theme)d.theme=a.mobile.getInheritedTheme(this.element,"c");for(var n=0,A=i.length;n<A;n++){o=i.eq(n);m="ui-li";if(b||!o.hasClass("ui-li"))p=o.jqmData("theme")||d.theme,j=this._getChildrenByTagName(o[0],"a","A"),j.length?(q=o.jqmData("icon"),o.buttonMarkup({wrapperEls:"div",shadow:false,corners:false,iconpos:"right",icon:j.length>1||q===false?false:
q||"arrow-r",theme:p}),q!=false&&j.length==1&&o.addClass("ui-li-has-arrow"),j.first().addClass("ui-link-inherit"),j.length>1&&(m+=" ui-li-has-alt",j=j.last(),q=e||j.jqmData("theme")||d.splitTheme,j.appendTo(o).attr("title",j.getEncodedText()).addClass("ui-li-link-alt").empty().buttonMarkup({shadow:false,corners:false,theme:p,icon:false,iconpos:false}).find(".ui-btn-inner").append(a(document.createElement("span")).buttonMarkup({shadow:true,corners:true,theme:q,iconpos:"notext",icon:g||j.jqmData("icon")||
d.splitIcon})))):o.jqmData("role")==="list-divider"?(m+=" ui-li-divider ui-btn ui-bar-"+c,o.attr("role","heading"),k&&(k=1)):m+=" ui-li-static ui-body-"+p;k&&m.indexOf("ui-li-divider")<0&&(p=o.is(".ui-li-static:first")?o:o.find(".ui-link-inherit"),p.addClass("ui-li-jsnumbering").prepend("<span class='ui-li-dec'>"+k++ +". </span>"));l[m]||(l[m]=[]);l[m].push(o[0])}for(m in l)a(l[m]).addClass(m).children(".ui-btn-inner").addClass(m);f.find("h1, h2, h3, h4, h5, h6").addClass("ui-li-heading").end().find("p, dl").addClass("ui-li-desc").end().find(".ui-li-aside").each(function(){var b=
a(this);b.prependTo(b.parent())}).end().find(".ui-li-count").each(function(){a(this).closest("li").addClass("ui-li-has-count")}).addClass("ui-btn-up-"+(f.jqmData("counttheme")||this.options.countTheme)+" ui-btn-corner-all");this._addThumbClasses(i);this._addThumbClasses(f.find(".ui-link-inherit"));this._refreshCorners(b)},_idStringEscape:function(a){return a.replace(/[^a-zA-Z0-9]/g,"-")},_createSubPages:function(){var b=this.element,d=b.closest(".ui-page"),f=d.jqmData("url"),c=f||d[0][a.expando],
h=b.attr("id"),g=this.options,i="data-"+a.mobile.ns,k=this,l=d.find(":jqmData(role='footer')").jqmData("id"),o;typeof e[c]==="undefined"&&(e[c]=-1);h=h||++e[c];a(b.find("li>ul, li>ol").toArray().reverse()).each(function(c){var d=a(this),e=d.attr("id")||h+"-"+c,c=d.parent(),k=a(d.prevAll().toArray().reverse()),k=k.length?k:a("<span>"+a.trim(c.contents()[0].nodeValue)+"</span>"),n=k.first().getEncodedText(),e=(f||"")+"&"+a.mobile.subPageUrlKey+"="+e,A=d.jqmData("theme")||g.theme,z=d.jqmData("counttheme")||
b.jqmData("counttheme")||g.countTheme;o=true;d.detach().wrap("<div "+i+"role='page' "+i+"url='"+e+"' "+i+"theme='"+A+"' "+i+"count-theme='"+z+"'><div "+i+"role='content'></div></div>").parent().before("<div "+i+"role='header' "+i+"theme='"+g.headerTheme+"'><div class='ui-title'>"+n+"</div></div>").after(l?a("<div "+i+"role='footer' "+i+"id='"+l+"'>"):"").parent().appendTo(a.mobile.pageContainer).page();d=c.find("a:first");d.length||(d=a("<a/>").html(k||n).prependTo(c.empty()));d.attr("href","#"+e)}).listview();
o&&d.is(":jqmData(external-page='true')")&&d.data("page").options.domCache===false&&d.unbind("pagehide.remove").bind("pagehide.remove",function(b,c){var e=c.nextPage;c.nextPage&&(e=e.jqmData("url"),e.indexOf(f+"&"+a.mobile.subPageUrlKey)!==0&&(k.childPages().remove(),d.remove()))})},childPages:function(){var b=this.parentPage.jqmData("url");return a(":jqmData(url^='"+b+"&"+a.mobile.subPageUrlKey+"')")}});a(document).bind("pagecreate create",function(b){a(a.mobile.listview.prototype.options.initSelector,
b.target).listview()})})(jQuery);
(function(a){a.mobile.listview.prototype.options.filter=false;a.mobile.listview.prototype.options.filterPlaceholder="Filter items...";a.mobile.listview.prototype.options.filterTheme="c";a.mobile.listview.prototype.options.filterCallback=function(a,b){return a.toLowerCase().indexOf(b)===-1};a(":jqmData(role='listview')").live("listviewcreate",function(){var e=a(this),b=e.data("listview");if(b.options.filter){var d=a("<form>",{"class":"ui-listview-filter ui-bar-"+b.options.filterTheme,role:"search"});
a("<input>",{placeholder:b.options.filterPlaceholder}).attr("data-"+a.mobile.ns+"type","search").jqmData("lastval","").bind("keyup change",function(){var d=a(this),c=this.value.toLowerCase(),h=null,h=d.jqmData("lastval")+"",g=false,i="";d.jqmData("lastval",c);i=c.substr(0,h.length-1).replace(h,"");h=c.length<h.length||i.length!=c.length-h.length?e.children():e.children(":not(.ui-screen-hidden)");if(c){for(var k=h.length-1;k>=0;k--)d=a(h[k]),i=d.jqmData("filtertext")||d.text(),d.is("li:jqmData(role=list-divider)")?
(d.toggleClass("ui-filter-hidequeue",!g),g=false):b.options.filterCallback(i,c)?d.toggleClass("ui-filter-hidequeue",true):g=true;h.filter(":not(.ui-filter-hidequeue)").toggleClass("ui-screen-hidden",false);h.filter(".ui-filter-hidequeue").toggleClass("ui-screen-hidden",true).toggleClass("ui-filter-hidequeue",false)}else h.toggleClass("ui-screen-hidden",false);b._refreshCorners()}).appendTo(d).textinput();a(this).jqmData("inset")&&d.addClass("ui-listview-filter-inset");d.bind("submit",function(){return false}).insertBefore(e)}})})(jQuery);
(function(a){a(document).bind("pagecreate create",function(e){a(":jqmData(role='nojs')",e.target).addClass("ui-nojs")})})(jQuery);
(function(a,e){a.widget("mobile.checkboxradio",a.mobile.widget,{options:{theme:null,initSelector:"input[type='checkbox'],input[type='radio']"},_create:function(){var b=this,d=this.element,f=d.closest("form,fieldset,:jqmData(role='page')").find("label[for='"+d[0].id+"']"),c=d.attr("type"),h=c+"-on",g=c+"-off",i=d.parents(":jqmData(type='horizontal')").length?e:g;if(!(c!=="checkbox"&&c!=="radio")){a.extend(this,{label:f,inputtype:c,checkedClass:"ui-"+h+(i?"":" "+a.mobile.activeBtnClass),uncheckedClass:"ui-"+
g,checkedicon:"ui-icon-"+h,uncheckedicon:"ui-icon-"+g});if(!this.options.theme)this.options.theme=this.element.jqmData("theme");f.buttonMarkup({theme:this.options.theme,icon:i,shadow:false});d.add(f).wrapAll("<div class='ui-"+c+"'></div>");f.bind({vmouseover:function(b){a(this).parent().is(".ui-disabled")&&b.stopPropagation()},vclick:function(a){if(d.is(":disabled"))a.preventDefault();else return b._cacheVals(),d.prop("checked",c==="radio"&&true||!d.prop("checked")),d.triggerHandler("click"),b._getInputSet().not(d).prop("checked",
false),b._updateAll(),false}});d.bind({vmousedown:function(){b._cacheVals()},vclick:function(){var c=a(this);c.is(":checked")?(c.prop("checked",true),b._getInputSet().not(c).prop("checked",false)):c.prop("checked",false);b._updateAll()},focus:function(){f.addClass("ui-focus")},blur:function(){f.removeClass("ui-focus")}});this.refresh()}},_cacheVals:function(){this._getInputSet().each(function(){var b=a(this);b.jqmData("cacheVal",b.is(":checked"))})},_getInputSet:function(){return this.inputtype==
"checkbox"?this.element:this.element.closest("form,fieldset,:jqmData(role='page')").find("input[name='"+this.element.attr("name")+"'][type='"+this.inputtype+"']")},_updateAll:function(){var b=this;this._getInputSet().each(function(){var d=a(this);(d.is(":checked")||b.inputtype==="checkbox")&&d.trigger("change")}).checkboxradio("refresh")},refresh:function(){var b=this.element,d=this.label,f=d.find(".ui-icon");a(b[0]).prop("checked")?(d.addClass(this.checkedClass).removeClass(this.uncheckedClass),
f.addClass(this.checkedicon).removeClass(this.uncheckedicon)):(d.removeClass(this.checkedClass).addClass(this.uncheckedClass),f.removeClass(this.checkedicon).addClass(this.uncheckedicon));b.is(":disabled")?this.disable():this.enable()},disable:function(){this.element.prop("disabled",true).parent().addClass("ui-disabled")},enable:function(){this.element.prop("disabled",false).parent().removeClass("ui-disabled")}});a(document).bind("pagecreate create",function(b){a.mobile.checkboxradio.prototype.enhanceWithin(b.target)})})(jQuery);
(function(a,e){a.widget("mobile.button",a.mobile.widget,{options:{theme:null,icon:null,iconpos:null,inline:null,corners:true,shadow:true,iconshadow:true,initSelector:"button, [type='button'], [type='submit'], [type='reset'], [type='image']"},_create:function(){var b=this.element,d=this.options,f,c;this.button=a("<div></div>").text(b.text()||b.val()).insertBefore(b).buttonMarkup({theme:d.theme,icon:d.icon,iconpos:d.iconpos,inline:d.inline,corners:d.corners,shadow:d.shadow,iconshadow:d.iconshadow}).append(b.addClass("ui-btn-hidden"));
d=b.attr("type");f=b.attr("name");d!=="button"&&d!=="reset"&&f&&b.bind("vclick",function(){c===e&&(c=a("<input>",{type:"hidden",name:b.attr("name"),value:b.attr("value")}).insertBefore(b),a(document).one("submit",function(){c.remove();c=e}))});this.refresh()},enable:function(){this.element.attr("disabled",false);this.button.removeClass("ui-disabled").attr("aria-disabled",false);return this._setOption("disabled",false)},disable:function(){this.element.attr("disabled",true);this.button.addClass("ui-disabled").attr("aria-disabled",
true);return this._setOption("disabled",true)},refresh:function(){var a=this.element;a.prop("disabled")?this.disable():this.enable();this.button.data("textWrapper").text(a.text()||a.val())}});a(document).bind("pagecreate create",function(b){a.mobile.button.prototype.enhanceWithin(b.target)})})(jQuery);
(function(a,e){a.widget("mobile.slider",a.mobile.widget,{options:{theme:null,trackTheme:null,disabled:false,initSelector:"input[type='range'], :jqmData(type='range'), :jqmData(role='slider')"},_create:function(){var b=this,d=this.element,f=a.mobile.getInheritedTheme(d,"c"),c=this.options.theme||f,h=this.options.trackTheme||f,g=d[0].nodeName.toLowerCase(),f=g=="select"?"ui-slider-switch":"",i=d.attr("id"),k=i+"-label",i=a("[for='"+i+"']").attr("id",k),l=function(){return g=="input"?parseFloat(d.val()):
d[0].selectedIndex},o=g=="input"?parseFloat(d.attr("min")):0,m=g=="input"?parseFloat(d.attr("max")):d.find("option").length-1,p=window.parseFloat(d.attr("step")||1),j=a("<div class='ui-slider "+f+" ui-btn-down-"+h+" ui-btn-corner-all' role='application'></div>"),q=a("<a href='#' class='ui-slider-handle'></a>").appendTo(j).buttonMarkup({corners:true,theme:c,shadow:true}).attr({role:"slider","aria-valuemin":o,"aria-valuemax":m,"aria-valuenow":l(),"aria-valuetext":l(),title:l(),"aria-labelledby":k});
a.extend(this,{slider:j,handle:q,dragging:false,beforeStart:null,userModified:false,mouseMoved:false});g=="select"&&(j.wrapInner("<div class='ui-slider-inneroffset'></div>"),q.addClass("ui-slider-handle-snapping"),d.find("option"),d.find("option").each(function(b){var c=!b?"b":"a",d=!b?"right":"left",b=!b?" ui-btn-down-"+h:" "+a.mobile.activeBtnClass;a("<div class='ui-slider-labelbg ui-slider-labelbg-"+c+b+" ui-btn-corner-"+d+"'></div>").prependTo(j);a("<span class='ui-slider-label ui-slider-label-"+
c+b+" ui-btn-corner-"+d+"' role='img'>"+a(this).getEncodedText()+"</span>").prependTo(q)}));i.addClass("ui-slider");d.addClass(g==="input"?"ui-slider-input":"ui-slider-switch").change(function(){b.mouseMoved||b.refresh(l(),true)}).keyup(function(){b.refresh(l(),true,true)}).blur(function(){b.refresh(l(),true)});a(document).bind("vmousemove",function(a){if(b.dragging)return b.mouseMoved=true,g==="select"&&q.removeClass("ui-slider-handle-snapping"),b.refresh(a),b.userModified=b.beforeStart!==d[0].selectedIndex,
false});j.bind("vmousedown",function(a){b.dragging=true;b.userModified=false;b.mouseMoved=false;if(g==="select")b.beforeStart=d[0].selectedIndex;b.refresh(a);return false});j.add(document).bind("vmouseup",function(){if(b.dragging)return b.dragging=false,g==="select"&&(q.addClass("ui-slider-handle-snapping"),b.mouseMoved?b.userModified?b.refresh(b.beforeStart==0?1:0):b.refresh(b.beforeStart):b.refresh(b.beforeStart==0?1:0)),b.mouseMoved=false});j.insertAfter(d);this.handle.bind("vmousedown",function(){a(this).focus()}).bind("vclick",
false);this.handle.bind("keydown",function(c){var d=l();if(!b.options.disabled){switch(c.keyCode){case a.mobile.keyCode.HOME:case a.mobile.keyCode.END:case a.mobile.keyCode.PAGE_UP:case a.mobile.keyCode.PAGE_DOWN:case a.mobile.keyCode.UP:case a.mobile.keyCode.RIGHT:case a.mobile.keyCode.DOWN:case a.mobile.keyCode.LEFT:if(c.preventDefault(),!b._keySliding)b._keySliding=true,a(this).addClass("ui-state-active")}switch(c.keyCode){case a.mobile.keyCode.HOME:b.refresh(o);break;case a.mobile.keyCode.END:b.refresh(m);
break;case a.mobile.keyCode.PAGE_UP:case a.mobile.keyCode.UP:case a.mobile.keyCode.RIGHT:b.refresh(d+p);break;case a.mobile.keyCode.PAGE_DOWN:case a.mobile.keyCode.DOWN:case a.mobile.keyCode.LEFT:b.refresh(d-p)}}}).keyup(function(){if(b._keySliding)b._keySliding=false,a(this).removeClass("ui-state-active")});this.refresh(e,e,true)},refresh:function(a,d,f){(this.options.disabled||this.element.attr("disabled"))&&this.disable();var c=this.element,e,g=c[0].nodeName.toLowerCase(),i=g==="input"?parseFloat(c.attr("min")):
0,k=g==="input"?parseFloat(c.attr("max")):c.find("option").length-1;if(typeof a==="object"){if(!this.dragging||a.pageX<this.slider.offset().left-8||a.pageX>this.slider.offset().left+this.slider.width()+8)return;e=Math.round((a.pageX-this.slider.offset().left)/this.slider.width()*100)}else a==null&&(a=g==="input"?parseFloat(c.val()):c[0].selectedIndex),e=(parseFloat(a)-i)/(k-i)*100;if(!isNaN(e)&&(e<0&&(e=0),e>100&&(e=100),a=Math.round(e/100*(k-i))+i,a<i&&(a=i),a>k&&(a=k),this.handle.css("left",e+"%"),
this.handle.attr({"aria-valuenow":g==="input"?a:c.find("option").eq(a).attr("value"),"aria-valuetext":g==="input"?a:c.find("option").eq(a).getEncodedText(),title:a}),g==="select"&&(a===0?this.slider.addClass("ui-slider-switch-a").removeClass("ui-slider-switch-b"):this.slider.addClass("ui-slider-switch-b").removeClass("ui-slider-switch-a")),!f))f=false,g==="input"?(f=c.val()!==a,c.val(a)):(f=c[0].selectedIndex!==a,c[0].selectedIndex=a),!d&&f&&c.trigger("change")},enable:function(){this.element.attr("disabled",
false);this.slider.removeClass("ui-disabled").attr("aria-disabled",false);return this._setOption("disabled",false)},disable:function(){this.element.attr("disabled",true);this.slider.addClass("ui-disabled").attr("aria-disabled",true);return this._setOption("disabled",true)}});a(document).bind("pagecreate create",function(b){a.mobile.slider.prototype.enhanceWithin(b.target)})})(jQuery);
(function(a){a.widget("mobile.textinput",a.mobile.widget,{options:{theme:null,initSelector:"input[type='text'], input[type='search'], :jqmData(type='search'), input[type='number'], :jqmData(type='number'), input[type='password'], input[type='email'], input[type='url'], input[type='tel'], textarea, input[type='time'], input[type='date'], input[type='month'], input[type='week'], input[type='datetime'], input[type='datetime-local'], input[type='color'], input:not([type])"},_create:function(){var e=this.element,
b=this.options.theme||a.mobile.getInheritedTheme(this.element,"c"),d=" ui-body-"+b,f,c;a("label[for='"+e.attr("id")+"']").addClass("ui-input-text");f=e.addClass("ui-input-text ui-body-"+b);typeof e[0].autocorrect!=="undefined"&&!a.support.touchOverflow&&(e[0].setAttribute("autocorrect","off"),e[0].setAttribute("autocomplete","off"));e.is("[type='search'],:jqmData(type='search')")?(f=e.wrap("<div class='ui-input-search ui-shadow-inset ui-btn-corner-all ui-btn-shadow ui-icon-searchfield"+d+"'></div>").parent(),
c=a("<a href='#' class='ui-input-clear' title='clear text'>clear text</a>").tap(function(a){e.val("").focus();e.trigger("change");c.addClass("ui-input-clear-hidden");a.preventDefault()}).appendTo(f).buttonMarkup({icon:"delete",iconpos:"notext",corners:true,shadow:true}),b=function(){setTimeout(function(){c.toggleClass("ui-input-clear-hidden",!e.val())},0)},b(),e.bind("paste cut keyup focus change blur",b)):e.addClass("ui-corner-all ui-shadow-inset"+d);e.focus(function(){f.addClass("ui-focus")}).blur(function(){f.removeClass("ui-focus")});
if(e.is("textarea")){var h=function(){var a=e[0].scrollHeight;e[0].clientHeight<a&&e.height(a+15)},g;e.keyup(function(){clearTimeout(g);g=setTimeout(h,100)});a.trim(e.val())&&(a(window).load(h),a(document).one("pagechange",h))}},disable:function(){(this.element.attr("disabled",true).is("[type='search'],:jqmData(type='search')")?this.element.parent():this.element).addClass("ui-disabled")},enable:function(){(this.element.attr("disabled",false).is("[type='search'],:jqmData(type='search')")?this.element.parent():
this.element).removeClass("ui-disabled")}});a(document).bind("pagecreate create",function(e){a.mobile.textinput.prototype.enhanceWithin(e.target)})})(jQuery);
(function(a){var e=function(b){var d=b.selectID,f=b.label,c=b.select.closest(".ui-page"),e=a("<div>",{"class":"ui-selectmenu-screen ui-screen-hidden"}).appendTo(c),g=b._selectOptions(),i=b.isMultiple=b.select[0].multiple,k=d+"-button",l=d+"-menu",o=a("<div data-"+a.mobile.ns+"role='dialog' data-"+a.mobile.ns+"theme='"+b.options.theme+"' data-"+a.mobile.ns+"overlay-theme='"+b.options.overlayTheme+"'><div data-"+a.mobile.ns+"role='header'><div class='ui-title'>"+f.getEncodedText()+"</div></div><div data-"+
a.mobile.ns+"role='content'></div></div>").appendTo(a.mobile.pageContainer).page(),m=a("<div>",{"class":"ui-selectmenu ui-selectmenu-hidden ui-overlay-shadow ui-corner-all ui-body-"+b.options.overlayTheme+" "+a.mobile.defaultDialogTransition}).insertAfter(e),p=a("<ul>",{"class":"ui-selectmenu-list",id:l,role:"listbox","aria-labelledby":k}).attr("data-"+a.mobile.ns+"theme",b.options.theme).appendTo(m),j=a("<div>",{"class":"ui-header ui-bar-"+b.options.theme}).prependTo(m),q=a("<h1>",{"class":"ui-title"}).appendTo(j),
n=a("<a>",{text:b.options.closeText,href:"#","class":"ui-btn-left"}).attr("data-"+a.mobile.ns+"iconpos","notext").attr("data-"+a.mobile.ns+"icon","delete").appendTo(j).buttonMarkup(),A=o.find(".ui-content"),z=o.find(".ui-header a");a.extend(b,{select:b.select,selectID:d,buttonId:k,menuId:l,thisPage:c,menuPage:o,label:f,screen:e,selectOptions:g,isMultiple:i,theme:b.options.theme,listbox:m,list:p,header:j,headerTitle:q,headerClose:n,menuPageContent:A,menuPageClose:z,placeholder:"",build:function(){var b=
this;b.refresh();b.select.attr("tabindex","-1").focus(function(){a(this).blur();b.button.focus()});b.button.bind("vclick keydown",function(c){if(c.type=="vclick"||c.keyCode&&(c.keyCode===a.mobile.keyCode.ENTER||c.keyCode===a.mobile.keyCode.SPACE))b.open(),c.preventDefault()});b.list.attr("role","listbox").delegate(".ui-li>a","focusin",function(){a(this).attr("tabindex","0")}).delegate(".ui-li>a","focusout",function(){a(this).attr("tabindex","-1")}).delegate("li:not(.ui-disabled, .ui-li-divider)",
"click",function(c){var d=b.select[0].selectedIndex,f=b.list.find("li:not(.ui-li-divider)").index(this),e=b._selectOptions().eq(f)[0];e.selected=b.isMultiple?!e.selected:true;b.isMultiple&&a(this).find(".ui-icon").toggleClass("ui-icon-checkbox-on",e.selected).toggleClass("ui-icon-checkbox-off",!e.selected);(b.isMultiple||d!==f)&&b.select.trigger("change");b.isMultiple||b.close();c.preventDefault()}).keydown(function(b){var c=a(b.target),d=c.closest("li");switch(b.keyCode){case 38:return b=d.prev(),
b.length&&(c.blur().attr("tabindex","-1"),b.find("a").first().focus()),false;case 40:return b=d.next(),b.length&&(c.blur().attr("tabindex","-1"),b.find("a").first().focus()),false;case 13:case 32:return c.trigger("click"),false}});b.menuPage.bind("pagehide",function(){b.list.appendTo(b.listbox);b._focusButton();a.mobile._bindPageRemove.call(b.thisPage)});b.screen.bind("vclick",function(){b.close()});b.headerClose.click(function(){if(b.menuType=="overlay")return b.close(),false});b.thisPage.addDependents(this.menuPage)},
_isRebuildRequired:function(){var a=this.list.find("li");return this._selectOptions().text()!==a.text()},refresh:function(b){var c=this;this._selectOptions();this.selected();var d=this.selectedIndices();(b||this._isRebuildRequired())&&c._buildList();c.setButtonText();c.setButtonCount();c.list.find("li:not(.ui-li-divider)").removeClass(a.mobile.activeBtnClass).attr("aria-selected",false).each(function(b){a.inArray(b,d)>-1&&(b=a(this),b.attr("aria-selected",true),c.isMultiple?b.find(".ui-icon").removeClass("ui-icon-checkbox-off").addClass("ui-icon-checkbox-on"):
b.addClass(a.mobile.activeBtnClass))})},close:function(){if(!this.options.disabled&&this.isOpen)this.menuType=="page"?window.history.back():(this.screen.addClass("ui-screen-hidden"),this.listbox.addClass("ui-selectmenu-hidden").removeAttr("style").removeClass("in"),this.list.appendTo(this.listbox),this._focusButton()),this.isOpen=false},open:function(){if(!this.options.disabled){var b=this,c=b.list.parent().outerHeight(),d=b.list.parent().outerWidth(),f=a(".ui-page-active"),e=a.support.touchOverflow&&
a.mobile.touchOverflowEnabled,f=f.is(".ui-native-fixed")?f.find(".ui-content"):f;scrollTop=e?f.scrollTop():a(window).scrollTop();btnOffset=b.button.offset().top;screenHeight=window.innerHeight;screenWidth=window.innerWidth;b.button.addClass(a.mobile.activeBtnClass);setTimeout(function(){b.button.removeClass(a.mobile.activeBtnClass)},300);if(c>screenHeight-80||!a.support.scrollTop){b.thisPage.unbind("pagehide.remove");if(scrollTop==0&&btnOffset>screenHeight)b.thisPage.one("pagehide",function(){a(this).jqmData("lastScroll",
btnOffset)});b.menuPage.one("pageshow",function(){a(window).one("silentscroll",function(){b.list.find(a.mobile.activeBtnClass).focus()});b.isOpen=true});b.menuType="page";b.menuPageContent.append(b.list);b.menuPage.find("div .ui-title").text(b.label.text());a.mobile.changePage(b.menuPage,{transition:a.mobile.defaultDialogTransition})}else{b.menuType="overlay";b.screen.height(a(document).height()).removeClass("ui-screen-hidden");var f=btnOffset-scrollTop,h=scrollTop+screenHeight-btnOffset,g=c/2,e=
parseFloat(b.list.parent().css("max-width")),c=f>c/2&&h>c/2?btnOffset+b.button.outerHeight()/2-g:f>h?scrollTop+screenHeight-c-30:scrollTop+30;d<e?e=(screenWidth-d)/2:(e=b.button.offset().left+b.button.outerWidth()/2-d/2,e<30?e=30:e+d>screenWidth&&(e=screenWidth-d-30));b.listbox.append(b.list).removeClass("ui-selectmenu-hidden").css({top:c,left:e}).addClass("in");b.list.find(a.mobile.activeBtnClass).focus();b.isOpen=true}}},_buildList:function(){var b=this,c=this.options,d=this.placeholder,f=[],e=
[],h=b.isMultiple?"checkbox-off":"false";b.list.empty().filter(".ui-listview").listview("destroy");b.select.find("option").each(function(g){var j=a(this),i=j.parent(),m=j.getEncodedText(),p="<a href='#'>"+m+"</a>",k=[],n=[];i.is("optgroup")&&(i=i.attr("label"),a.inArray(i,f)===-1&&(e.push("<li data-"+a.mobile.ns+"role='list-divider'>"+i+"</li>"),f.push(i)));if(!this.getAttribute("value")||m.length==0||j.jqmData("placeholder"))c.hidePlaceholderMenuItems&&k.push("ui-selectmenu-placeholder"),d=b.placeholder=
m;this.disabled&&(k.push("ui-disabled"),n.push("aria-disabled='true'"));e.push("<li data-"+a.mobile.ns+"option-index='"+g+"' data-"+a.mobile.ns+"icon='"+h+"' class='"+k.join(" ")+"' "+n.join(" ")+">"+p+"</li>")});b.list.html(e.join(" "));b.list.find("li").attr({role:"option",tabindex:"-1"}).first().attr("tabindex","0");this.isMultiple||this.headerClose.hide();!this.isMultiple&&!d.length?this.header.hide():this.headerTitle.text(this.placeholder);b.list.listview()},_button:function(){return a("<a>",
{href:"#",role:"button",id:this.buttonId,"aria-haspopup":"true","aria-owns":this.menuId})}})};a("select").live("selectmenubeforecreate",function(){var b=a(this).data("selectmenu");b.options.nativeMenu||e(b)})})(jQuery);
(function(a){a.widget("mobile.selectmenu",a.mobile.widget,{options:{theme:null,disabled:false,icon:"arrow-d",iconpos:"right",inline:null,corners:true,shadow:true,iconshadow:true,menuPageTheme:"b",overlayTheme:"a",hidePlaceholderMenuItems:true,closeText:"Close",nativeMenu:true,initSelector:"select:not(:jqmData(role='slider'))"},_button:function(){return a("<div/>")},_setDisabled:function(a){this.element.attr("disabled",a);this.button.attr("aria-disabled",a);return this._setOption("disabled",a)},_focusButton:function(){var a=
this;setTimeout(function(){a.button.focus()},40)},_selectOptions:function(){return this.select.find("option")},_preExtension:function(){this.select=this.element.wrap("<div class='ui-select'>");this.selectID=this.select.attr("id");this.label=a("label[for='"+this.selectID+"']").addClass("ui-select");this.isMultiple=this.select[0].multiple;if(!this.options.theme)this.options.theme=a.mobile.getInheritedTheme(this.select,"c")},_create:function(){this._preExtension();this._trigger("beforeCreate");this.button=
this._button();var e=this,b=this.options,d=this.button.text(a(this.select[0].options.item(this.select[0].selectedIndex==-1?0:this.select[0].selectedIndex)).text()).insertBefore(this.select).buttonMarkup({theme:b.theme,icon:b.icon,iconpos:b.iconpos,inline:b.inline,corners:b.corners,shadow:b.shadow,iconshadow:b.iconshadow});b.nativeMenu&&window.opera&&window.opera.version&&this.select.addClass("ui-select-nativeonly");if(this.isMultiple)this.buttonCount=a("<span>").addClass("ui-li-count ui-btn-up-c ui-btn-corner-all").hide().appendTo(d.addClass("ui-li-has-count"));
(b.disabled||this.element.attr("disabled"))&&this.disable();this.select.change(function(){e.refresh()});this.build()},build:function(){var e=this;this.select.appendTo(e.button).bind("vmousedown",function(){e.button.addClass(a.mobile.activeBtnClass)}).bind("focus vmouseover",function(){e.button.trigger("vmouseover")}).bind("vmousemove",function(){e.button.removeClass(a.mobile.activeBtnClass)}).bind("change blur vmouseout",function(){e.button.trigger("vmouseout").removeClass(a.mobile.activeBtnClass)}).bind("change blur",
function(){e.button.removeClass("ui-btn-down-"+e.options.theme)})},selected:function(){return this._selectOptions().filter(":selected")},selectedIndices:function(){var a=this;return this.selected().map(function(){return a._selectOptions().index(this)}).get()},setButtonText:function(){var e=this,b=this.selected();this.button.find(".ui-btn-text").text(function(){return!e.isMultiple?b.text():b.length?b.map(function(){return a(this).text()}).get().join(", "):e.placeholder})},setButtonCount:function(){var a=
this.selected();this.isMultiple&&this.buttonCount[a.length>1?"show":"hide"]().text(a.length)},refresh:function(){this.setButtonText();this.setButtonCount()},open:a.noop,close:a.noop,disable:function(){this._setDisabled(true);this.button.addClass("ui-disabled")},enable:function(){this._setDisabled(false);this.button.removeClass("ui-disabled")}});a(document).bind("pagecreate create",function(e){a.mobile.selectmenu.prototype.enhanceWithin(e.target)})})(jQuery);
(function(a,e){function b(b){for(var c;b;){if((c=typeof b.className==="string"&&b.className.split(" "))&&a.inArray("ui-btn",c)>-1&&a.inArray("ui-disabled",c)<0)break;b=b.parentNode}return b}a.fn.buttonMarkup=function(b){for(var b=b||{},c=0;c<this.length;c++){var h=this.eq(c),g=h[0],i=a.extend({},a.fn.buttonMarkup.defaults,{icon:b.icon!==e?b.icon:h.jqmData("icon"),iconpos:b.iconpos!==e?b.iconpos:h.jqmData("iconpos"),theme:b.theme!==e?b.theme:h.jqmData("theme"),inline:b.inline!==e?b.inline:h.jqmData("inline"),
shadow:b.shadow!==e?b.shadow:h.jqmData("shadow"),corners:b.corners!==e?b.corners:h.jqmData("corners"),iconshadow:b.iconshadow!==e?b.iconshadow:h.jqmData("iconshadow")},b),k="ui-btn-inner",l,o,m=document.createElement(i.wrapperEls),p=document.createElement(i.wrapperEls),j=i.icon?document.createElement("span"):null;d&&d();if(!i.theme)i.theme=a.mobile.getInheritedTheme(h,"c");l="ui-btn ui-btn-up-"+i.theme;i.inline&&(l+=" ui-btn-inline");if(i.icon)i.icon="ui-icon-"+i.icon,i.iconpos=i.iconpos||"left",
o="ui-icon "+i.icon,i.iconshadow&&(o+=" ui-icon-shadow");i.iconpos&&(l+=" ui-btn-icon-"+i.iconpos,i.iconpos=="notext"&&!h.attr("title")&&h.attr("title",h.getEncodedText()));i.corners&&(l+=" ui-btn-corner-all",k+=" ui-btn-corner-all");i.shadow&&(l+=" ui-shadow");g.setAttribute("data-"+a.mobile.ns+"theme",i.theme);h.addClass(l);m.className=k;m.setAttribute("aria-hidden","true");p.className="ui-btn-text";m.appendChild(p);if(j)j.className=o,m.appendChild(j);for(;g.firstChild;)p.appendChild(g.firstChild);
g.appendChild(m);a.data(g,"textWrapper",a(p))}return this};a.fn.buttonMarkup.defaults={corners:true,shadow:true,iconshadow:true,inline:false,wrapperEls:"span"};var d=function(){a(document).bind({vmousedown:function(d){var d=b(d.target),c;d&&(d=a(d),c=d.attr("data-"+a.mobile.ns+"theme"),d.removeClass("ui-btn-up-"+c).addClass("ui-btn-down-"+c))},"vmousecancel vmouseup":function(d){var d=b(d.target),c;d&&(d=a(d),c=d.attr("data-"+a.mobile.ns+"theme"),d.removeClass("ui-btn-down-"+c).addClass("ui-btn-up-"+
c))},"vmouseover focus":function(d){var d=b(d.target),c;d&&(d=a(d),c=d.attr("data-"+a.mobile.ns+"theme"),d.removeClass("ui-btn-up-"+c).addClass("ui-btn-hover-"+c))},"vmouseout blur":function(d){var d=b(d.target),c;d&&(d=a(d),c=d.attr("data-"+a.mobile.ns+"theme"),d.removeClass("ui-btn-hover-"+c+" ui-btn-down-"+c).addClass("ui-btn-up-"+c))}});d=null};a(document).bind("pagecreate create",function(b){a(":jqmData(role='button'), .ui-bar > a, .ui-header > a, .ui-footer > a, .ui-bar > :jqmData(role='controlgroup') > a",
b.target).not(".ui-btn, :jqmData(role='none'), :jqmData(role='nojs')").buttonMarkup()})})(jQuery);
(function(a){a.fn.controlgroup=function(e){return this.each(function(){function b(a){a.removeClass("ui-btn-corner-all ui-shadow").eq(0).addClass(h[0]).end().last().addClass(h[1]).addClass("ui-controlgroup-last")}var d=a(this),f=a.extend({direction:d.jqmData("type")||"vertical",shadow:false,excludeInvisible:true},e),c=d.children("legend"),h=f.direction=="horizontal"?["ui-corner-left","ui-corner-right"]:["ui-corner-top","ui-corner-bottom"];d.find("input").first().attr("type");c.length&&(d.wrapInner("<div class='ui-controlgroup-controls'></div>"),
a("<div role='heading' class='ui-controlgroup-label'>"+c.html()+"</div>").insertBefore(d.children(0)),c.remove());d.addClass("ui-corner-all ui-controlgroup ui-controlgroup-"+f.direction);b(d.find(".ui-btn"+(f.excludeInvisible?":visible":"")));b(d.find(".ui-btn-inner"));f.shadow&&d.addClass("ui-shadow")})};a(document).bind("pagecreate create",function(e){a(":jqmData(role='controlgroup')",e.target).controlgroup({excludeInvisible:false})})})(jQuery);
(function(a){a(document).bind("pagecreate create",function(e){a(e.target).find("a").not(".ui-btn, .ui-link-inherit, :jqmData(role='none'), :jqmData(role='nojs')").addClass("ui-link")})})(jQuery);
(function(a,e){a.fn.fixHeaderFooter=function(){return!a.support.scrollTop||a.support.touchOverflow&&a.mobile.touchOverflowEnabled?this:this.each(function(){var b=a(this);b.jqmData("fullscreen")&&b.addClass("ui-page-fullscreen");b.find(".ui-header:jqmData(position='fixed')").addClass("ui-header-fixed ui-fixed-inline fade");b.find(".ui-footer:jqmData(position='fixed')").addClass("ui-footer-fixed ui-fixed-inline fade")})};a.mobile.fixedToolbars=function(){function b(){!i&&g==="overlay"&&(h||a.mobile.fixedToolbars.hide(true),
a.mobile.fixedToolbars.startShowTimer())}function d(a){var b=0,c,d;if(a){d=document.body;c=a.offsetParent;for(b=a.offsetTop;a&&a!=d;){b+=a.scrollTop||0;if(a==c)b+=c.offsetTop,c=a.offsetParent;a=a.parentNode}}return b}function f(b){var c=a(window).scrollTop(),e=d(b[0]),f=b.css("top")=="auto"?0:parseFloat(b.css("top")),h=window.innerHeight,g=b.outerHeight(),i=b.parents(".ui-page:not(.ui-page-fullscreen)").length;return b.is(".ui-header-fixed")?(f=c-e+f,f<e&&(f=0),b.css("top",i?f:c)):b.css("top",i?c+
h-g-(e-f):c+h-g)}if(a.support.scrollTop&&(!a.support.touchOverflow||!a.mobile.touchOverflowEnabled)){var c,h,g="inline",i=false,k=null,l=false,o=true;a(function(){var c=a(document),d=a(window);c.bind("vmousedown",function(){o&&(k=g)}).bind("vclick",function(b){o&&!a(b.target).closest("a,input,textarea,select,button,label,.ui-header-fixed,.ui-footer-fixed").length&&!l&&(a.mobile.fixedToolbars.toggle(k),k=null)}).bind("silentscroll",b);(c.scrollTop()===0?d:c).bind("scrollstart",function(){l=true;k===
null&&(k=g);var b=k=="overlay";if(i=b||!!h)a.mobile.fixedToolbars.clearShowTimer(),b&&a.mobile.fixedToolbars.hide(true)}).bind("scrollstop",function(b){a(b.target).closest("a,input,textarea,select,button,label,.ui-header-fixed,.ui-footer-fixed").length||(l=false,i&&(a.mobile.fixedToolbars.startShowTimer(),i=false),k=null)});d.bind("resize updatelayout",b)});a(".ui-page").live("pagebeforeshow",function(b,d){var e=a(b.target).find(":jqmData(role='footer')"),h=e.data("id"),g=d.prevPage,g=g&&g.find(":jqmData(role='footer')"),
g=g.length&&g.jqmData("id")===h;h&&g&&(c=e,f(c.removeClass("fade in out").appendTo(a.mobile.pageContainer)))}).live("pageshow",function(){var b=a(this);c&&c.length&&setTimeout(function(){f(c.appendTo(b).addClass("fade"));c=null},500);a.mobile.fixedToolbars.show(true,this)});a(".ui-collapsible-contain").live("collapse expand",b);return{show:function(b,c){a.mobile.fixedToolbars.clearShowTimer();g="overlay";return(c?a(c):a.mobile.activePage?a.mobile.activePage:a(".ui-page-active")).children(".ui-header-fixed:first, .ui-footer-fixed:not(.ui-footer-duplicate):last").each(function(){var c=
a(this),e=a(window).scrollTop(),h=d(c[0]),g=window.innerHeight,i=c.outerHeight(),e=c.is(".ui-header-fixed")&&e<=h+i||c.is(".ui-footer-fixed")&&h<=e+g;c.addClass("ui-fixed-overlay").removeClass("ui-fixed-inline");!e&&!b&&c.animationComplete(function(){c.removeClass("in")}).addClass("in");f(c)})},hide:function(b){g="inline";return(a.mobile.activePage?a.mobile.activePage:a(".ui-page-active")).children(".ui-header-fixed:first, .ui-footer-fixed:not(.ui-footer-duplicate):last").each(function(){var c=a(this),
d=c.css("top"),d=d=="auto"?0:parseFloat(d);c.addClass("ui-fixed-inline").removeClass("ui-fixed-overlay");if(d<0||c.is(".ui-header-fixed")&&d!==0)b?c.css("top",0):c.css("top")!=="auto"&&parseFloat(c.css("top"))!==0&&c.animationComplete(function(){c.removeClass("out reverse").css("top",0)}).addClass("out reverse")})},startShowTimer:function(){a.mobile.fixedToolbars.clearShowTimer();var b=[].slice.call(arguments);h=setTimeout(function(){h=e;a.mobile.fixedToolbars.show.apply(null,b)},100)},clearShowTimer:function(){h&&
clearTimeout(h);h=e},toggle:function(b){b&&(g=b);return g==="overlay"?a.mobile.fixedToolbars.hide():a.mobile.fixedToolbars.show()},setTouchToggleEnabled:function(a){o=a}}}}();a(document).bind("pagecreate create",function(b){a(":jqmData(position='fixed')",b.target).length&&a(b.target).each(function(){if(!a.support.scrollTop||a.support.touchOverflow&&a.mobile.touchOverflowEnabled)return this;var b=a(this);b.jqmData("fullscreen")&&b.addClass("ui-page-fullscreen");b.find(".ui-header:jqmData(position='fixed')").addClass("ui-header-fixed ui-fixed-inline fade");
b.find(".ui-footer:jqmData(position='fixed')").addClass("ui-footer-fixed ui-fixed-inline fade")})})})(jQuery);
(function(a){a.mobile.touchOverflowEnabled=false;a.mobile.touchOverflowZoomEnabled=false;a(document).bind("pagecreate",function(e){a.support.touchOverflow&&a.mobile.touchOverflowEnabled&&(e=a(e.target),e.is(":jqmData(role='page')")&&e.each(function(){var b=a(this),d=b.find(":jqmData(role='header'), :jqmData(role='footer')").filter(":jqmData(position='fixed')"),e=b.jqmData("fullscreen"),c=d.length?b.find(".ui-content"):b;b.addClass("ui-mobile-touch-overflow");c.bind("scrollstop",function(){c.scrollTop()>
0&&window.scrollTo(0,a.mobile.defaultHomeScroll)});d.length&&(b.addClass("ui-native-fixed"),e&&(b.addClass("ui-native-fullscreen"),d.addClass("fade in"),a(document).bind("vclick",function(){d.removeClass("ui-native-bars-hidden").toggleClass("in out").animationComplete(function(){a(this).not(".in").addClass("ui-native-bars-hidden")})})))}))})})(jQuery);
(function(a,e){function b(){var b=a("meta[name='viewport']");b.length?b.attr("content",b.attr("content")+", user-scalable=no"):a("head").prepend("<meta>",{name:"viewport",content:"user-scalable=no"})}var d=a("html");a("head");var f=a(e);a(e.document).trigger("mobileinit");if(a.mobile.gradeA()){if(a.mobile.ajaxBlacklist)a.mobile.ajaxEnabled=false;d.addClass("ui-mobile ui-mobile-rendering");var c=a("<div class='ui-loader ui-body-a ui-corner-all'><span class='ui-icon ui-icon-loading spin'></span><h1></h1></div>");
a.extend(a.mobile,{showPageLoadingMsg:function(){if(a.mobile.loadingMessage){var b=a("."+a.mobile.activeBtnClass).first();c.find("h1").text(a.mobile.loadingMessage).end().appendTo(a.mobile.pageContainer).css({top:a.support.scrollTop&&f.scrollTop()+f.height()/2||b.length&&b.offset().top||100})}d.addClass("ui-loading")},hidePageLoadingMsg:function(){d.removeClass("ui-loading")},initializePage:function(){var b=a(":jqmData(role='page')");b.length||(b=a("body").wrapInner("<div data-"+a.mobile.ns+"role='page'></div>").children(0));
b.add(":jqmData(role='dialog')").each(function(){var b=a(this);b.jqmData("url")||b.attr("data-"+a.mobile.ns+"url",b.attr("id")||location.pathname+location.search)});a.mobile.firstPage=b.first();a.mobile.pageContainer=b.first().parent().addClass("ui-mobile-viewport");f.trigger("pagecontainercreate");a.mobile.showPageLoadingMsg();!a.mobile.hashListeningEnabled||!a.mobile.path.stripHash(location.hash)?a.mobile.changePage(a.mobile.firstPage,{transition:"none",reverse:true,changeHash:false,fromHashChange:true}):
f.trigger("hashchange",[true])}});a.support.touchOverflow&&a.mobile.touchOverflowEnabled&&!a.mobile.touchOverflowZoomEnabled&&b();a.mobile._registerInternalEvents();a(function(){e.scrollTo(0,1);a.mobile.defaultHomeScroll=!a.support.scrollTop||a(e).scrollTop()===1?0:1;a.mobile.autoInitializePage&&a.mobile.initializePage();f.load(a.mobile.silentScroll)})}})(jQuery,this);
