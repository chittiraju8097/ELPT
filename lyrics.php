<?php
include 'init.php';
$usr = $user_data['username'];
$sql=mysql_query("SELECT * FROM read_score WHERE userid='$usr'");
$get=mysql_fetch_array($sql);
$c=1;
while($get['slide'.$c.'r']>0)
{
	$c=$c+1;
	if($c==6){
		break;
	}
}
if($c<6){
?>
<html>
	<head>
		<title></title>
	</head>
		
		<script  type="text/javascript">
!function(a){if("function"==typeof define&&define.amd&&define("uikit",function(){var b=a(window,window.jQuery,window.document);return b.load=function(a,c,d,e){var f,g=a.split(","),h=[],i=(e.config&&e.config.uikit&&e.config.uikit.base?e.config.uikit.base:"").replace(/\/+$/g,"");if(!i)throw new Error("Please define base path to uikit in the requirejs config.");for(f=0;f<g.length;f+=1){var j=g[f].replace(/\./g,"/");h.push(i+"/js/addons/"+j)}c(h,function(){d(b)})},b}),!window.jQuery)throw new Error("UIkit requires jQuery");window&&window.jQuery&&a(window,window.jQuery,window.document)}(function(a,b,c){"use strict";var d=b.UIkit||{},e=b("html"),f=b(window),g=b(document);if(d.fn)return d;if(d.version="2.8.0",d.$doc=g,d.$win=f,d.fn=function(a,c){var e=arguments,f=a.match(/^([a-z\-]+)(?:\.([a-z]+))?/i),g=f[1],h=f[2];return d[g]?this.each(function(){var a=b(this),f=a.data(g);f||a.data(g,f=d[g](this,h?void 0:c)),h&&f[h].apply(f,Array.prototype.slice.call(e,1))}):(b.error("UIkit component ["+g+"] does not exist."),this)},d.support={},d.support.transition=function(){var a=function(){var a,b=c.body||c.documentElement,d={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(a in d)if(void 0!==b.style[a])return d[a]}();return a&&{end:a}}(),d.support.animation=function(){var a=function(){var a,b=c.body||c.documentElement,d={WebkitAnimation:"webkitAnimationEnd",MozAnimation:"animationend",OAnimation:"oAnimationEnd oanimationend",animation:"animationend"};for(a in d)if(void 0!==b.style[a])return d[a]}();return a&&{end:a}}(),d.support.requestAnimationFrame=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.msRequestAnimationFrame||window.oRequestAnimationFrame||function(a){setTimeout(a,1e3/60)},d.support.touch="ontouchstart"in window&&navigator.userAgent.toLowerCase().match(/mobile|tablet/)||a.DocumentTouch&&document instanceof a.DocumentTouch||a.navigator.msPointerEnabled&&a.navigator.msMaxTouchPoints>0||a.navigator.pointerEnabled&&a.navigator.maxTouchPoints>0||!1,d.support.mutationobserver=a.MutationObserver||a.WebKitMutationObserver||a.MozMutationObserver||null,d.Utils={},d.Utils.debounce=function(a,b,c){var d;return function(){var e=this,f=arguments,g=function(){d=null,c||a.apply(e,f)},h=c&&!d;clearTimeout(d),d=setTimeout(g,b),h&&a.apply(e,f)}},d.Utils.removeCssRules=function(a){var b,c,d,e,f,g,h,i,j,k;a&&setTimeout(function(){try{for(k=document.styleSheets,e=0,h=k.length;h>e;e++){for(d=k[e],c=[],d.cssRules=d.cssRules,b=f=0,i=d.cssRules.length;i>f;b=++f)d.cssRules[b].type===CSSRule.STYLE_RULE&&a.test(d.cssRules[b].selectorText)&&c.unshift(b);for(g=0,j=c.length;j>g;g++)d.deleteRule(c[g])}}catch(l){}},0)},d.Utils.isInView=function(a,c){var d=b(a);if(!d.is(":visible"))return!1;var e=f.scrollLeft(),g=f.scrollTop(),h=d.offset(),i=h.left,j=h.top;return c=b.extend({topoffset:0,leftoffset:0},c),j+d.height()>=g&&j-c.topoffset<=g+f.height()&&i+d.width()>=e&&i-c.leftoffset<=e+f.width()?!0:!1},d.Utils.options=function(a){if(b.isPlainObject(a))return a;var c=a?a.indexOf("{"):-1,d={};if(-1!=c)try{d=new Function("","var json = "+a.substr(c)+"; return JSON.parse(JSON.stringify(json));")()}catch(e){}return d},d.Utils.template=function(a,b){for(var c,d,e,f,g=a.replace(/\n/g,"\\n").replace(/\{\{\{\s*(.+?)\s*\}\}\}/g,"{{!$1}}").split(/(\{\{\s*(.+?)\s*\}\})/g),h=0,i=[],j=0;h<g.length;){if(c=g[h],c.match(/\{\{\s*(.+?)\s*\}\}/))switch(h+=1,c=g[h],d=c[0],e=c.substring(c.match(/^(\^|\#|\!|\~|\:)/)?1:0),d){case"~":i.push("for(var $i=0;$i<"+e+".length;$i++) { var $item = "+e+"[$i];"),j++;break;case":":i.push("for(var $key in "+e+") { var $val = "+e+"[$key];"),j++;break;case"#":i.push("if("+e+") {"),j++;break;case"^":i.push("if(!"+e+") {"),j++;break;case"/":i.push("}"),j--;break;case"!":i.push("__ret.push("+e+");");break;default:i.push("__ret.push(escape("+e+"));")}else i.push("__ret.push('"+c.replace(/\'/g,"\\'")+"');");h+=1}f=["var __ret = [];","try {","with($data){",j?'__ret = ["Not all blocks are closed correctly."]':i.join(""),"};","}catch(e){__ret = [e.message];}",'return __ret.join("").replace(/\\n\\n/g, "\\n");',"function escape(html) { return String(html).replace(/&/g, '&amp;').replace(/\"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');}"].join("\n");var k=new Function("$data",f);return b?k(b):k},d.Utils.events={},d.Utils.events.click=d.support.touch?"tap":"click",b.UIkit=d,b.fn.uk=d.fn,b.UIkit.langdirection="rtl"==e.attr("dir")?"right":"left",b(function(){if(g.trigger("uk-domready"),setInterval(function(){var a={x:window.scrollX,y:window.scrollY},c=function(){(a.x!=window.scrollX||a.y!=window.scrollY)&&(a={x:window.scrollX,y:window.scrollY},g.trigger("uk-scroll",[a]))};return b.UIkit.support.touch&&g.on("touchmove touchend MSPointerMove MSPointerUp",c),(a.x||a.y)&&c(),c}(),15),d.support.mutationobserver){try{var a=new d.support.mutationobserver(d.Utils.debounce(function(){g.trigger("uk-domready")},150));a.observe(document.body,{childList:!0,subtree:!0})}catch(c){}d.support.touch&&d.Utils.removeCssRules(/\.uk-(?!navbar).*:hover/)}}),e.addClass(d.support.touch?"uk-touch":"uk-notouch"),d.support.touch){var h,i=!1,j=".uk-overlay, .uk-overlay-toggle, .uk-has-hover";g.on("touchstart MSPointerDown",j,function(){i&&b(".uk-hover").removeClass("uk-hover"),i=b(this).addClass("uk-hover")}).on("touchend MSPointerUp",function(a){h=b(a.target).parents(j),i&&i.not(h).removeClass("uk-hover")})}return d}),function(a){a.Promise=a.Promise||function(a,b){function c(a,b){return(typeof b)[0]==a}function d(f,g){return g=function h(i,j,k,l,m,n){if(l=h.q,i!=c)return d(function(a,b){l.push({p:this,r:a,j:b,1:i,0:j})});if(k&&c(a,k)|c(b,k))try{m=k.then}catch(o){j=0,k=o}if(c(a,m)){var p=function(a){return function(b){return m&&(m=0,h(c,a,b))}};try{m.call(k,p(1),j=p(0))}catch(o){j(o)}}else for(g=function(b,g){return c(a,b=j?b:g)?d(function(a,c){e(this,a,c,k,b)}):f},n=0;n<l.length;)m=l[n++],c(a,i=m[j])?e(m.p,m.r,m.j,k,i):(j?m.r:m.j)(k)},g.q=[],f.call(f={then:function(a,b){return g(a,b)},"catch":function(a){return g(0,a)}},function(a){g(c,1,a)},function(a){g(c,0,a)}),f}function e(d,e,f,g,h){setTimeout(function(){try{g=h(g),h=g&&c(b,g)|c(a,g)&&g.then,c(a,h)?g==d?f(TypeError()):h.call(g,e,f):e(g)}catch(i){f(i)}},0)}function f(a){return d(function(b){b(a)})}return d.resolve=f,d.reject=function(a){return d(function(b,c){c(a)})},d.all=function(a){return d(function(b,c,d,e){e=[],d=a.length||b(e),a.map(function(a,g){f(a).then(function(a){e[g]=a,d-=1,d||b(e)},c)})})},d}("f","o")}(this),function(a,b){"use strict";b.components={},b.component=function(c,d){var e=function(b,d){var f=this;this.element=b?a(b):null,this.options=a.extend(!0,{},this.defaults,d),this.plugins={},this.element&&this.element.data(c,this),this.init(),(this.options.plugins.length?this.options.plugins:Object.keys(e.plugins)).forEach(function(a){e.plugins[a].init&&(e.plugins[a].init(f),f.plugins[a]=!0)}),this.trigger("init",[this])};return e.plugins={},a.extend(!0,e.prototype,{defaults:{plugins:[]},init:function(){},on:function(){return a(this.element||this).on.apply(this.element||this,arguments)},one:function(){return a(this.element||this).one.apply(this.element||this,arguments)},off:function(b){return a(this.element||this).off(b)},trigger:function(b,c){return a(this.element||this).trigger(b,c)},find:function(b){return this.element?this.element.find(b):a([])},proxy:function(a,b){var c=this;b.split(" ").forEach(function(b){c[b]||(c[b]=function(){return a[b].apply(a,arguments)})})},mixin:function(a,b){var c=this;b.split(" ").forEach(function(b){c[b]||(c[b]=a[b].bind(c))})}},d),this.components[c]=e,this[c]=function(){var d,e;if(arguments.length)switch(arguments.length){case 1:"string"==typeof arguments[0]||arguments[0].nodeType||arguments[0]instanceof jQuery?d=a(arguments[0]):e=arguments[0];break;case 2:d=a(arguments[0]),e=arguments[1]}return d&&d.data(c)?d.data(c):new b.components[c](d,e)},e},b.plugin=function(a,b,c){this.components[a].plugins[b]=c}}(jQuery,jQuery.UIkit),function(a,b){"use strict";var c=a(window),d="resize orientationchange",e=[];b.component("stackMargin",{defaults:{cls:"uk-margin-small-top"},init:function(){var f=this;this.columns=this.element.children(),this.columns.length&&(c.on(d,function(){var d=function(){f.process()};return a(function(){d(),c.on("load",d)}),b.Utils.debounce(d,150)}()),a(document).on("uk-domready",function(){f.columns=f.element.children(),f.process()}),e.push(this))},process:function(){var b=this;this.revert();var c=!1,d=this.columns.filter(":visible:first"),e=d.length?d.offset().top:!1;if(e!==!1)return this.columns.each(function(){var d=a(this);d.is(":visible")&&(c?d.addClass(b.options.cls):d.offset().top!=e&&(d.addClass(b.options.cls),c=!0))}),this},revert:function(){return this.columns.removeClass(this.options.cls),this}}),a(document).on("uk-domready",function(){a("[data-uk-margin]").each(function(){var c,d=a(this);d.data("stackMargin")||(c=b.stackMargin(d,b.Utils.options(d.attr("data-uk-margin"))))})}),a(document).on("uk-check-display",function(){e.forEach(function(a){a.element.is(":visible")&&a.process()})})}(jQuery,jQuery.UIkit),function(a){function b(a,b,c,d){return Math.abs(a-b)>=Math.abs(c-d)?a-b>0?"Left":"Right":c-d>0?"Up":"Down"}function c(){j=null,l.last&&(l.el.trigger("longTap"),l={})}function d(){j&&clearTimeout(j),j=null}function e(){g&&clearTimeout(g),h&&clearTimeout(h),i&&clearTimeout(i),j&&clearTimeout(j),g=h=i=j=null,l={}}function f(a){return a.pointerType==a.MSPOINTER_TYPE_TOUCH&&a.isPrimary}var g,h,i,j,k,l={},m=750;a(function(){var n,o,p,q=0,r=0;"MSGesture"in window&&(k=new MSGesture,k.target=document.body),a(document).bind("MSGestureEnd",function(a){var b=a.originalEvent.velocityX>1?"Right":a.originalEvent.velocityX<-1?"Left":a.originalEvent.velocityY>1?"Down":a.originalEvent.velocityY<-1?"Up":null;b&&(l.el.trigger("swipe"),l.el.trigger("swipe"+b))}).on("touchstart MSPointerDown",function(b){("MSPointerDown"!=b.type||f(b.originalEvent))&&(p="MSPointerDown"==b.type?b:b.originalEvent.touches[0],n=Date.now(),o=n-(l.last||n),l.el=a("tagName"in p.target?p.target:p.target.parentNode),g&&clearTimeout(g),l.x1=p.pageX,l.y1=p.pageY,o>0&&250>=o&&(l.isDoubleTap=!0),l.last=n,j=setTimeout(c,m),k&&"MSPointerDown"==b.type&&k.addPointer(b.originalEvent.pointerId))}).on("touchmove MSPointerMove",function(a){("MSPointerMove"!=a.type||f(a.originalEvent))&&(p="MSPointerMove"==a.type?a:a.originalEvent.touches[0],d(),l.x2=p.pageX,l.y2=p.pageY,q+=Math.abs(l.x1-l.x2),r+=Math.abs(l.y1-l.y2))}).on("touchend MSPointerUp",function(c){("MSPointerUp"!=c.type||f(c.originalEvent))&&(d(),l.x2&&Math.abs(l.x1-l.x2)>30||l.y2&&Math.abs(l.y1-l.y2)>30?i=setTimeout(function(){l.el.trigger("swipe"),l.el.trigger("swipe"+b(l.x1,l.x2,l.y1,l.y2)),l={}},0):"last"in l&&(isNaN(q)||30>q&&30>r?h=setTimeout(function(){var b=a.Event("tap");b.cancelTouch=e,l.el.trigger(b),l.isDoubleTap?(l.el.trigger("doubleTap"),l={}):g=setTimeout(function(){g=null,l.el.trigger("singleTap"),l={}},250)},0):l={},q=r=0))}).on("touchcancel MSPointerCancel",e),a(window).on("scroll",e)}),["swipe","swipeLeft","swipeRight","swipeUp","swipeDown","doubleTap","tap","singleTap","longTap"].forEach(function(b){a.fn[b]=function(c){return a(this).on(b,c)}})}(jQuery),function(a,b){"use strict";b.component("alert",{defaults:{fade:!0,duration:200,trigger:".uk-alert-close"},init:function(){var a=this;this.on("click",this.options.trigger,function(b){b.preventDefault(),a.close()})},close:function(){function a(){b.trigger("closed").remove()}var b=this.trigger("close");this.options.fade?b.css("overflow","hidden").css("max-height",b.height()).animate({height:0,opacity:0,"padding-top":0,"padding-bottom":0,"margin-top":0,"margin-bottom":0},this.options.duration,a):a()}}),a(document).on("click.alert.uikit","[data-uk-alert]",function(c){var d=a(this);if(!d.data("alert")){var e=b.alert(d,b.Utils.options(d.data("uk-alert")));a(c.target).is(d.data("alert").options.trigger)&&(c.preventDefault(),e.close())}})}(jQuery,jQuery.UIkit),function(a,b){"use strict";b.component("buttonRadio",{defaults:{target:".uk-button"},init:function(){var b=this;this.on("click",this.options.target,function(c){a(this).is('a[href="#"]')&&c.preventDefault(),b.find(b.options.target).not(this).removeClass("uk-active").blur(),b.trigger("change",[a(this).addClass("uk-active")])})},getSelected:function(){this.find(".uk-active")}}),b.component("buttonCheckbox",{defaults:{target:".uk-button"},init:function(){var b=this;this.on("click",this.options.target,function(c){a(this).is('a[href="#"]')&&c.preventDefault(),b.trigger("change",[a(this).toggleClass("uk-active").blur()])})},getSelected:function(){this.find(".uk-active")}}),b.component("button",{defaults:{},init:function(){var a=this;this.on("click",function(b){a.element.is('a[href="#"]')&&b.preventDefault(),a.toggle(),a.trigger("change",[$element.blur().hasClass("uk-active")])})},toggle:function(){this.element.toggleClass("uk-active")}}),a(document).on("click.buttonradio.uikit","[data-uk-button-radio]",function(c){var d=a(this);if(!d.data("buttonRadio")){var e=b.buttonRadio(d,b.Utils.options(d.attr("data-uk-button-radio")));a(c.target).is(e.options.target)&&a(c.target).trigger("click")}}),a(document).on("click.buttoncheckbox.uikit","[data-uk-button-checkbox]",function(c){var d=a(this);if(!d.data("buttonCheckbox")){var e=b.buttonCheckbox(d,b.Utils.options(d.attr("data-uk-button-checkbox"))),f=a(c.target);f.is(e.options.target)&&d.trigger("change",[f.toggleClass("uk-active").blur()])}}),a(document).on("click.button.uikit","[data-uk-button]",function(){var c=a(this);if(!c.data("button")){{b.button(c,b.Utils.options(c.attr("data-uk-button")))}c.trigger("click")}})}(jQuery,jQuery.UIkit),function(a,b){"use strict";var c,d=!1;b.component("dropdown",{defaults:{mode:"hover",remaintime:800,justify:!1,boundary:a(window),delay:0},remainIdle:!1,init:function(){var e=this;this.dropdown=this.find(".uk-dropdown"),this.centered=this.dropdown.hasClass("uk-dropdown-center"),this.justified=this.options.justify?a(this.options.justify):!1,this.boundary=a(this.options.boundary),this.flipped=this.dropdown.hasClass("uk-dropdown-flip"),this.boundary.length||(this.boundary=a(window)),"click"==this.options.mode||b.support.touch?this.on("click",function(b){var c=a(b.target);c.parents(".uk-dropdown").length||((c.is("a[href='#']")||c.parent().is("a[href='#']"))&&b.preventDefault(),c.blur()),e.element.hasClass("uk-open")?(c.is("a:not(.js-uk-prevent)")||c.is(".uk-dropdown-close")||!e.dropdown.find(b.target).length)&&(e.element.removeClass("uk-open"),d=!1):e.show()}):this.on("mouseenter",function(){e.remainIdle&&clearTimeout(e.remainIdle),c&&clearTimeout(c),c=setTimeout(e.show.bind(e),e.options.delay)}).on("mouseleave",function(){c&&clearTimeout(c),e.remainIdle=setTimeout(function(){e.element.removeClass("uk-open"),e.remainIdle=!1,d&&d[0]==e.element[0]&&(d=!1)},e.options.remaintime)}).on("click",function(b){var c=a(b.target);e.remainIdle&&clearTimeout(e.remainIdle),(c.is("a[href='#']")||c.parent().is("a[href='#']"))&&b.preventDefault(),e.show()})},show:function(){d&&d[0]!=this.element[0]&&d.removeClass("uk-open"),c&&clearTimeout(c),this.checkDimensions(),this.element.addClass("uk-open"),this.trigger("uk.dropdown.show",[this]),d=this.element,this.registerOuterClick()},registerOuterClick:function(){var b=this;a(document).off("click.outer.dropdown"),setTimeout(function(){a(document).on("click.outer.dropdown",function(e){c&&clearTimeout(c);var f=a(e.target);d&&d[0]==b.element[0]&&(f.is("a:not(.js-uk-prevent)")||f.is(".uk-dropdown-close")||!b.dropdown.find(e.target).length)&&(d.removeClass("uk-open"),a(document).off("click.outer.dropdown"))})},10)},checkDimensions:function(){if(this.dropdown.length){this.justified&&this.justified.length&&this.dropdown.css("min-width","");var b=this,c=this.dropdown.css("margin-"+a.UIkit.langdirection,""),d=c.show().offset(),e=c.outerWidth(),f=this.boundary.width(),g=this.boundary.offset()?this.boundary.offset().left:0;if(this.centered&&(c.css("margin-"+a.UIkit.langdirection,-1*(parseFloat(e)/2-c.parent().width()/2)),d=c.offset(),(e+d.left>f||d.left<0)&&(c.css("margin-"+a.UIkit.langdirection,""),d=c.offset())),this.justified&&this.justified.length){var h=this.justified.outerWidth();if(c.css("min-width",h),"right"==a.UIkit.langdirection){var i=f-(this.justified.offset().left+h),j=f-(c.offset().left+c.outerWidth());c.css("margin-right",i-j)}else c.css("margin-left",this.justified.offset().left-d.left);d=c.offset()}e+(d.left-g)>f&&(c.addClass("uk-dropdown-flip"),d=c.offset()),d.left-g<0&&(c.addClass("uk-dropdown-stack"),c.hasClass("uk-dropdown-flip")&&(this.flipped||(c.removeClass("uk-dropdown-flip"),d=c.offset(),c.addClass("uk-dropdown-flip")),setTimeout(function(){(c.offset().left-g<0||!b.flipped&&c.outerWidth()+(d.left-g)<f)&&c.removeClass("uk-dropdown-flip")},0)),this.trigger("uk.dropdown.stack",[this])),c.css("display","")}}});var e=b.support.touch?"click":"mouseenter";a(document).on(e+".dropdown.uikit","[data-uk-dropdown]",function(c){var d=a(this);if(!d.data("dropdown")){var f=b.dropdown(d,b.Utils.options(d.data("uk-dropdown")));("click"==e||"mouseenter"==e&&"hover"==f.options.mode)&&f.element.trigger(e),f.element.find(".uk-dropdown").length&&c.preventDefault()}})}(jQuery,jQuery.UIkit),function(a,b){"use strict";var c=a(window),d="resize orientationchange",e=[];b.component("gridMatchHeight",{defaults:{target:!1,row:!0},init:function(){var f=this;this.columns=this.element.children(),this.elements=this.options.target?this.find(this.options.target):this.columns,this.columns.length&&(c.on(d,function(){var d=function(){f.match()};return a(function(){d(),c.on("load",d)}),b.Utils.debounce(d,150)}()),a(document).on("uk-domready",function(){f.columns=f.element.children(),f.elements=f.options.target?f.find(f.options.target):f.columns,f.match()}),e.push(this))},match:function(){this.revert();var b=this.columns.filter(":visible:first");if(b.length){var c=Math.ceil(100*parseFloat(b.css("width"))/parseFloat(b.parent().css("width")))>=100?!0:!1,d=this;if(!c)return this.options.row?(this.element.width(),setTimeout(function(){var b=!1,c=[];d.elements.each(function(){var e=a(this),f=e.offset().top;f!=b&&c.length&&(d.matchHeights(a(c)),c=[],f=e.offset().top),c.push(e),b=f}),c.length&&d.matchHeights(a(c))},0)):this.matchHeights(this.elements),this}},revert:function(){return this.elements.css("min-height",""),this},matchHeights:function(b){if(!(b.length<2)){var c=0;b.each(function(){c=Math.max(c,a(this).outerHeight())}).each(function(){var b=a(this),d=c-(b.outerHeight()-b.height());b.css("min-height",d+"px")})}}}),b.component("gridMargin",{defaults:{cls:"uk-grid-margin"},init:function(){b.stackMargin(this.element,this.options)}}),a(document).on("uk-domready",function(){a("[data-uk-grid-match],[data-uk-grid-margin]").each(function(){var c,d=a(this);d.is("[data-uk-grid-match]")&&!d.data("gridMatchHeight")&&(c=b.gridMatchHeight(d,b.Utils.options(d.attr("data-uk-grid-match")))),d.is("[data-uk-grid-margin]")&&!d.data("gridMargin")&&(c=b.gridMargin(d,b.Utils.options(d.attr("data-uk-grid-margin"))))})}),a(document).on("uk-check-display",function(){e.forEach(function(a){a.element.is(":visible")&&a.match()})})}(jQuery,jQuery.UIkit),function(a,b,c){"use strict";function d(b,c){return c?("object"==typeof b?(b=b instanceof jQuery?b:a(b),b.parent().length&&(c.persist=b,c.persist.data("modalPersistParent",b.parent()))):b=a("<div></div>").html("string"==typeof b||"number"==typeof b?b:"$.UIkitt.modal Error: Unsupported data type: "+typeof b),b.appendTo(c.element.find(".uk-modal-dialog")),c):void 0}var e,f=!1,g=a("html");b.component("modal",{defaults:{keyboard:!0,bgclose:!0,minScrollHeight:150},scrollable:!1,transition:!1,init:function(){e||(e=a("body"));var c=this;this.transition=b.support.transition,this.dialog=this.find(".uk-modal-dialog"),this.on("click",".uk-modal-close",function(a){a.preventDefault(),c.hide()}).on("click",function(b){var d=a(b.target);d[0]==c.element[0]&&c.options.bgclose&&c.hide()})},toggle:function(){return this[this.isActive()?"hide":"show"]()},show:function(){if(!this.isActive())return f&&f.hide(!0),this.element.removeClass("uk-open").show(),this.resize(),f=this,g.addClass("uk-modal-page").height(),this.element.addClass("uk-open").trigger("uk.modal.show"),a(document).trigger("uk-check-display"),this},hide:function(a){if(this.isActive()){if(!a&&b.support.transition){var c=this;this.one(b.support.transition.end,function(){c._hide()}).removeClass("uk-open")}else this._hide();return this}},resize:function(){var a="padding-"+("left"==b.langdirection?"left":"right"),c="margin-"+("left"==b.langdirection?"left":"right"),d=e.width();this.scrollbarwidth=window.innerWidth-d,g.css(c,-1*this.scrollbarwidth),this.element.css(a,""),this.dialog.offset().left>this.scrollbarwidth&&this.element.css(a,this.scrollbarwidth-(this.element[0].scrollHeight==window.innerHeight?0:this.scrollbarwidth)),this.updateScrollable()},updateScrollable:function(){var a=this.dialog.find(".uk-overflow-container:visible:first");if(a){a.css("height",0);var b=Math.abs(parseInt(this.dialog.css("margin-top"),10)),c=this.dialog.outerHeight(),d=window.innerHeight,e=d-2*(20>b?20:b)-c;a.css("height",e<this.options.minScrollHeight?"":e)}},_hide:function(){this.element.hide().removeClass("uk-open"),g.removeClass("uk-modal-page").css("margin-"+("left"==b.langdirection?"left":"right"),""),f===this&&(f=!1),this.trigger("uk.modal.hide")},isActive:function(){return f==this}}),b.component("modalTrigger",{init:function(){var c=this;this.options=a.extend({target:c.element.is("a")?c.element.attr("href"):!1},this.options),this.modal=b.modal(this.options.target,this.options),this.on("click",function(a){a.preventDefault(),c.show()}),this.proxy(this.modal,"show hide isActive")}}),b.modal.dialog=function(c,e){var f=b.modal(a(b.modal.dialog.template).appendTo("body"),e);return f.on("uk.modal.hide",function(){f.persist&&(f.persist.appendTo(f.persist.data("modalPersistParent")),f.persist=!1),f.element.remove()}),d(c,f),f},b.modal.dialog.template='<div class="uk-modal"><div class="uk-modal-dialog"></div></div>',b.modal.alert=function(c,d){b.modal.dialog(['<div class="uk-margin uk-modal-content">'+String(c)+"</div>",'<div class="uk-modal-buttons"><button class="uk-button uk-button-primary uk-modal-close">Ok</button></div>'].join(""),a.extend({bgclose:!1,keyboard:!1},d)).show()},b.modal.confirm=function(c,d,e){d=a.isFunction(d)?d:function(){};var f=b.modal.dialog(['<div class="uk-margin uk-modal-content">'+String(c)+"</div>",'<div class="uk-modal-buttons"><button class="uk-button uk-button-primary js-modal-confirm">Ok</button> <button class="uk-button uk-modal-close">Cancel</button></div>'].join(""),a.extend({bgclose:!1,keyboard:!1},e));f.element.find(".js-modal-confirm").on("click",function(){d(),f.hide()}),f.show()},a(document).on("click.modal.uikit","[data-uk-modal]",function(c){var d=a(this);if(d.is("a")&&c.preventDefault(),!d.data("modalTrigger")){var e=b.modalTrigger(d,b.Utils.options(d.attr("data-uk-modal")));e.show()}}),a(document).on("keydown.modal.uikit",function(a){f&&27===a.keyCode&&f.options.keyboard&&(a.preventDefault(),f.hide())}),c.on("resize orientationchange",b.Utils.debounce(function(){f&&f.resize()},150))}(jQuery,jQuery.UIkit,jQuery(window)),function(a,b){"use strict";var c={x:window.scrollX,y:window.scrollY},d=a(window),e=a(document),f=a("html"),g={show:function(b){if(b=a(b),b.length){var h=a("body"),i=(d.width(),b.find(".uk-offcanvas-bar:first")),j="right"==a.UIkit.langdirection,k=i.hasClass("uk-offcanvas-bar-flip")?-1:1,l=k*(j?-1:1);c={x:window.scrollX,y:window.scrollY},b.addClass("uk-active"),h.css({width:window.innerWidth,height:d.height()}).addClass("uk-offcanvas-page"),h.css(j?"margin-right":"margin-left",(j?-1:1)*i.outerWidth()*l).width(),f.css("margin-top",-1*c.y),i.addClass("uk-offcanvas-bar-show"),b.off(".ukoffcanvas").on("click.ukoffcanvas swipeRight.ukoffcanvas swipeLeft.ukoffcanvas",function(b){var c=a(b.target);if(!b.type.match(/swipe/)&&!c.hasClass("uk-offcanvas-close")){if(c.hasClass("uk-offcanvas-bar"))return;if(c.parents(".uk-offcanvas-bar:first").length)return}b.stopImmediatePropagation(),g.hide()}),e.on("keydown.ukoffcanvas",function(a){27===a.keyCode&&g.hide()})}},hide:function(b){var d=a("body"),g=a(".uk-offcanvas.uk-active"),h="right"==a.UIkit.langdirection,i=g.find(".uk-offcanvas-bar:first");g.length&&(a.UIkit.support.transition&&!b?(d.one(a.UIkit.support.transition.end,function(){d.removeClass("uk-offcanvas-page").css({width:"",height:""}),g.removeClass("uk-active"),f.css("margin-top",""),window.scrollTo(c.x,c.y)}).css(h?"margin-right":"margin-left",""),setTimeout(function(){i.removeClass("uk-offcanvas-bar-show")},0)):(d.removeClass("uk-offcanvas-page").css({width:"",height:""}),g.removeClass("uk-active"),i.removeClass("uk-offcanvas-bar-show"),f.css("margin-top",""),window.scrollTo(c.x,c.y)),g.off(".ukoffcanvas"),e.off(".ukoffcanvas"))}};b.component("offcanvasTrigger",{init:function(){var b=this;this.options=a.extend({target:b.element.is("a")?b.element.attr("href"):!1},this.options),this.on("click",function(a){a.preventDefault(),g.show(b.options.target)})}}),b.offcanvas=g,e.on("click.offcanvas.uikit","[data-uk-offcanvas]",function(c){c.preventDefault();var d=a(this);if(!d.data("offcanvasTrigger")){{b.offcanvasTrigger(d,b.Utils.options(d.attr("data-uk-offcanvas")))}d.trigger("click")}})}(jQuery,jQuery.UIkit),function(a,b){"use strict";function c(b){var c=a(b),d="auto";if(c.is(":visible"))d=c.outerHeight();else{var e={position:c.css("position"),visibility:c.css("visibility"),display:c.css("display")};d=c.css({position:"absolute",visibility:"hidden",display:"block"}).outerHeight(),c.css(e)}return d}b.component("nav",{defaults:{toggle:">li.uk-parent > a[href='#']",lists:">li.uk-parent > ul",multiple:!1},init:function(){var b=this;this.on("click",this.options.toggle,function(c){c.preventDefault();var d=a(this);b.open(d.parent()[0]==b.element[0]?d:d.parent("li"))}),this.find(this.options.lists).each(function(){var c=a(this),d=c.parent(),e=d.hasClass("uk-active");c.wrap('<div style="overflow:hidden;height:0;position:relative;"></div>'),d.data("list-container",c.parent()),e&&b.open(d,!0)})},open:function(b,d){var e=this.element,f=a(b);this.options.multiple||e.children(".uk-open").not(b).each(function(){a(this).data("list-container")&&a(this).data("list-container").stop().animate({height:0},function(){a(this).parent().removeClass("uk-open")})}),f.toggleClass("uk-open"),f.data("list-container")&&(d?f.data("list-container").stop().height(f.hasClass("uk-open")?"auto":0):f.data("list-container").stop().animate({height:f.hasClass("uk-open")?c(f.data("list-container").find("ul:first")):0}))}}),a(document).on("uk-domready",function(){a("[data-uk-nav]").each(function(){var c=a(this);if(!c.data("nav")){b.nav(c,b.Utils.options(c.attr("data-uk-nav")))}})})}(jQuery,jQuery.UIkit),function(a,b,c){"use strict";var d,e;b.component("tooltip",{defaults:{offset:5,pos:"top",animation:!1,delay:0,src:function(){return this.attr("title")}},tip:"",init:function(){var b=this;d||(d=a('<div class="uk-tooltip"></div>').appendTo("body")),this.on({focus:function(){b.show()},blur:function(){b.hide()},mouseenter:function(){b.show()},mouseleave:function(){b.hide()}}),this.tip="function"==typeof this.options.src?this.options.src.call(this.element):this.options.src,this.element.attr("data-cached-title",this.element.attr("title")).attr("title","")},show:function(){if(e&&clearTimeout(e),this.tip.length){d.stop().css({top:-2e3,visibility:"hidden"}).show(),d.html('<div class="uk-tooltip-inner">'+this.tip+"</div>");var b=this,c=a("body").offset(),f=a.extend({},this.element.offset(),{width:this.element[0].offsetWidth,height:this.element[0].offsetHeight}),g=d[0].offsetWidth,h=d[0].offsetHeight,i="function"==typeof this.options.offset?this.options.offset.call(this.element):this.options.offset,j="function"==typeof this.options.pos?this.options.pos.call(this.element):this.options.pos,k=j.split("-"),l={display:"none",visibility:"visible",top:f.top+f.height+h,left:f.left};f.left-=c.left,f.top-=c.top,"left"!=k[0]&&"right"!=k[0]||"right"!=a.UIkit.langdirection||(k[0]="left"==k[0]?"right":"left");var m={bottom:{top:f.top+f.height+i,left:f.left+f.width/2-g/2},top:{top:f.top-h-i,left:f.left+f.width/2-g/2},left:{top:f.top+f.height/2-h/2,left:f.left-g-i},right:{top:f.top+f.height/2-h/2,left:f.left+f.width+i}};a.extend(l,m[k[0]]),2==k.length&&(l.left="left"==k[1]?f.left:f.left+f.width-g);var n=this.checkBoundary(l.left,l.top,g,h);if(n){switch(n){case"x":j=2==k.length?k[0]+"-"+(l.left<0?"left":"right"):l.left<0?"right":"left";break;case"y":j=2==k.length?(l.top<0?"bottom":"top")+"-"+k[1]:l.top<0?"bottom":"top";break;case"xy":j=2==k.length?(l.top<0?"bottom":"top")+"-"+(l.left<0?"left":"right"):l.left<0?"right":"left"}k=j.split("-"),a.extend(l,m[k[0]]),2==k.length&&(l.left="left"==k[1]?f.left:f.left+f.width-g)}l.left-=a("body").position().left,e=setTimeout(function(){d.css(l).attr("class","uk-tooltip uk-tooltip-"+j),b.options.animation?d.css({opacity:0,display:"block"}).animate({opacity:1},parseInt(b.options.animation,10)||400):d.show(),e=!1},parseInt(this.options.delay,10)||0)}},hide:function(){this.element.is("input")&&this.element[0]===document.activeElement||(e&&clearTimeout(e),d.stop(),this.options.animation?d.fadeOut(parseInt(this.options.animation,10)||400):d.hide())},content:function(){return this.tip},checkBoundary:function(a,b,d,e){var f="";return(0>a||a-c.scrollLeft()+d>window.innerWidth)&&(f+="x"),(0>b||b-c.scrollTop()+e>window.innerHeight)&&(f+="y"),f}}),a(document).on("mouseenter.tooltip.uikit focus.tooltip.uikit","[data-uk-tooltip]",function(){var c=a(this);if(!c.data("tooltip")){{b.tooltip(c,b.Utils.options(c.attr("data-uk-tooltip")))}c.trigger("mouseenter")}})}(jQuery,jQuery.UIkit,jQuery(window)),function(a,b){"use strict";b.component("switcher",{defaults:{connect:!1,toggle:">*",active:0},init:function(){var b=this;if(this.on("click",this.options.toggle,function(a){a.preventDefault(),b.show(this)}),this.options.connect){this.connect=a(this.options.connect).find(".uk-active").removeClass(".uk-active").end();var c=this.find(this.options.toggle),d=c.filter(".uk-active");d.length?this.show(d):(d=c.eq(this.options.active),this.show(d.length?d:c.eq(0)))}},show:function(b){b=isNaN(b)?a(b):this.find(this.options.toggle).eq(b);var c=b;if(!c.hasClass("uk-disabled")){if(this.find(this.options.toggle).filter(".uk-active").removeClass("uk-active"),c.addClass("uk-active"),this.options.connect&&this.connect.length){var d=this.find(this.options.toggle).index(c);this.connect.children().removeClass("uk-active").eq(d).addClass("uk-active")}this.trigger("uk.switcher.show",[c]),a(document).trigger("uk-check-display")}}}),a(document).on("uk-domready",function(){a("[data-uk-switcher]").each(function(){var c=a(this);if(!c.data("switcher")){b.switcher(c,b.Utils.options(c.attr("data-uk-switcher")))}})})}(jQuery,jQuery.UIkit),function(a,b){"use strict";b.component("tab",{defaults:{connect:!1,active:0},init:function(){var b=this;if(this.on("click",this.options.target,function(c){c.preventDefault(),b.find(b.options.target).not(this).removeClass("uk-active").blur(),b.trigger("change",[a(this).addClass("uk-active")])}),this.options.connect&&(this.connect=a(this.options.connect)),location.hash&&location.hash.match(/^#[a-z0-9_-]+$/)){var c=this.element.children().filter(window.location.hash);c.length&&this.element.children().removeClass("uk-active").filter(c).addClass("uk-active")}var d=a('<li class="uk-tab-responsive uk-active"><a href="javascript:void(0);"></a></li>'),e=d.find("a:first"),f=a('<div class="uk-dropdown uk-dropdown-small"><ul class="uk-nav uk-nav-dropdown"></ul><div>'),g=f.find("ul");e.html(this.find("li.uk-active:first").find("a").text()),this.element.hasClass("uk-tab-bottom")&&f.addClass("uk-dropdown-up"),this.element.hasClass("uk-tab-flip")&&f.addClass("uk-dropdown-flip"),this.find("a").each(function(c){var d=a(this).parent(),e=a('<li><a href="javascript:void(0);">'+d.text()+"</a></li>").on("click",function(){b.element.data("switcher").show(c)
});a(this).parents(".uk-disabled:first").length||g.append(e)}),this.element.uk("switcher",{toggle:">li:not(.uk-tab-responsive)",connect:this.options.connect,active:this.options.active}),d.append(f).uk("dropdown",{mode:"click"}),this.element.append(d).data({dropdown:d.data("dropdown"),mobilecaption:e}).on("uk.switcher.show",function(a,b){d.addClass("uk-active"),e.html(b.find("a").text())})}}),a(document).on("uk-domready",function(){a("[data-uk-tab]").each(function(){var c=a(this);if(!c.data("tab")){b.tab(c,b.Utils.options(c.attr("data-uk-tab")))}})})}(jQuery,jQuery.UIkit),function(a,b){"use strict";var c=a(window),d=a(document),e=[],f=function(){for(var a=0;a<e.length;a++)b.support.requestAnimationFrame.apply(window,[e[a].check])};b.component("scrollspy",{defaults:{cls:"uk-scrollspy-inview",initcls:"uk-scrollspy-init-inview",topoffset:0,leftoffset:0,repeat:!1,delay:0},init:function(){var a,c,d,f=this,g=function(){var e=b.Utils.isInView(f.element,f.options);e&&!c&&(a&&clearTimeout(a),d||(f.element.addClass(f.options.initcls),f.offset=f.element.offset(),d=!0,f.trigger("uk.scrollspy.init")),a=setTimeout(function(){e&&f.element.addClass("uk-scrollspy-inview").addClass(f.options.cls).width()},f.options.delay),c=!0,f.trigger("uk.scrollspy.inview")),!e&&c&&f.options.repeat&&(f.element.removeClass("uk-scrollspy-inview").removeClass(f.options.cls),c=!1,f.trigger("uk.scrollspy.outview"))};g(),this.check=g,e.push(this)}});var g=[],h=function(){for(var a=0;a<g.length;a++)b.support.requestAnimationFrame.apply(window,[g[a].check])};b.component("scrollspynav",{defaults:{cls:"uk-active",closest:!1,topoffset:0,leftoffset:0,smoothscroll:!1},init:function(){var d,e=[],f=this.find("a[href^='#']").each(function(){e.push(a(this).attr("href"))}),h=a(e.join(",")),i=this,j=function(){d=[];for(var a=0;a<h.length;a++)b.Utils.isInView(h.eq(a),i.options)&&d.push(h.eq(a));if(d.length){var e=c.scrollTop(),g=function(){for(var a=0;a<d.length;a++)if(d[a].offset().top>=e)return d[a]}();if(!g)return;i.options.closest?f.closest(i.options.closest).removeClass(i.options.cls).end().filter("a[href='#"+g.attr("id")+"']").closest(i.options.closest).addClass(i.options.cls):f.removeClass(i.options.cls).filter("a[href='#"+g.attr("id")+"']").addClass(i.options.cls)}};this.options.smoothscroll&&b.smoothScroll&&f.each(function(){b.smoothScroll(this,i.options.smoothscroll)}),j(),this.element.data("scrollspynav",this),this.check=j,g.push(this)}});var i=function(){f(),h()};d.on("uk-scroll",i),c.on("resize orientationchange",b.Utils.debounce(i,50)),d.on("uk-domready",function(){a("[data-uk-scrollspy]").each(function(){var c=a(this);if(!c.data("scrollspy")){b.scrollspy(c,b.Utils.options(c.attr("data-uk-scrollspy")))}}),a("[data-uk-scrollspy-nav]").each(function(){var c=a(this);if(!c.data("scrollspynav")){b.scrollspynav(c,b.Utils.options(c.attr("data-uk-scrollspy-nav")))}})})}(jQuery,jQuery.UIkit),function(a,b){"use strict";b.component("smoothScroll",{defaults:{duration:1e3,transition:"easeOutExpo",offset:0,complete:function(){}},init:function(){var b=this;this.on("click",function(){{var c=a(a(this.hash).length?this.hash:"body"),d=c.offset().top-b.options.offset,e=a(document).height(),f=a(window).height();c.outerHeight()}return d+f>e&&(d=e-f),a("html,body").stop().animate({scrollTop:d},b.options.duration,b.options.transition).promise().done(b.options.complete),!1})}}),a.easing.easeOutExpo||(a.easing.easeOutExpo=function(a,b,c,d,e){return b==e?c+d:d*(-Math.pow(2,-10*b/e)+1)+c}),a(document).on("click.smooth-scroll.uikit","[data-uk-smooth-scroll]",function(){var c=a(this);if(!c.data("smoothScroll")){{b.smoothScroll(c,b.Utils.options(c.attr("data-uk-smooth-scroll")))}c.trigger("click")}return!1})}(jQuery,jQuery.UIkit),function(a,b,c){c.component("toggle",{defaults:{target:!1,cls:"uk-hidden"},init:function(){var a=this;this.totoggle=this.options.target?b(this.options.target):[],this.on("click",function(b){a.element.is('a[href="#"]')&&b.preventDefault(),a.toggle()})},toggle:function(){this.totoggle.length&&(this.totoggle.toggleClass(this.options.cls),"uk-hidden"==this.options.cls&&b(document).trigger("uk-check-display"))}}),b(document).on("uk-domready",function(){b("[data-uk-toggle]").each(function(){var a=b(this);if(!a.data("toggle")){c.toggle(a,c.Utils.options(a.attr("data-uk-toggle")))}})})}(this,jQuery,jQuery.UIkit);
		function marks() {
				var score=0;
				var r=confirm("Are you Sure?");
				if(r==true)
				{
					for(var j=1;j<=4;j++)
					{
						var radios = document.getElementsByName("q"+j);
						var found = 1;
						for (var i = 0; i < radios.length; i++) {       
							if (radios[i].checked) 
							{
								if(radios[i].value == ans[j])
									score=score+1;
								found = 0;
								break;
							}
						}
						   if(found==1)
						   {
							 alert("Please Answer the Question "+j);
							 return;
						   } 
					   }
			//		  document.location.href='check.php?count='+count+'&max_time='+max_time+'&search_words='+search_words+'&total='+x+'&score='+score;
					  $('#content1').load('lyrics.php?count='+count1+'&max_time='+ti+'&search_words='+search_words+'&total='+x+'&score='+score);
				}		  
		}
		var search_words=0;
		count1=document.getElementById("count").value;
		function getSelectionText() {
			var text = "";
			if (window.getSelection) {
				text = window.getSelection().toString();
			} else if (document.selection && document.selection.type != "Control") {
				text = document.selection.createRange().text;
			}
			search_words++;
			return text;
		}
		$('#read_con').dblclick(function (e){
			  showmean(getSelectionText());
		 });
		 $('#offcanvas-1').dblclick(function (e){
			  showmean(getSelectionText());
		 });
		function showmean(term)
		{
			$("#mydict").html("<h3 style=\"color:white;align:center;font-size:22px;\">Loading..</h>");
			$("#mydict").load("dict.php?word="+term);
			$.UIkit.offcanvas.show('#offcanvas-1');
		}

	</script>
	<body>
		<div id="offcanvas-1" class="uk-offcanvas">
			<div class="uk-offcanvas-bar" style="background-color:#009999;">
				<div class="uk-panel">
					<span id="mydict" >
					</span>
				</div>										
			</div>
		</div>  
			<div>
			<input type="hidden" id="count" value="<?php echo $c;?>"/>
			<?php
				$res=mysql_query("SELECT * FROM `read_score` WHERE `userid`='".$usr."'");
				$start=0;
				while($row1=mysql_fetch_array($res))
					{
						$start=$start+1;
					}
				if($start==0)
				{
					mysql_query("INSERT INTO `read_score` (`userid`) VALUES ( '".$usr."')");
				}
				else if($start<=5){
			?>
			<div>
				<?php
				
					if(isset($_GET['count']))
					{
						if(preg_match("/^\d{1}$/",$_GET['count']))
						{
							$count=mysql_real_escape_string($_GET['count']);
							$sql=mysql_query("SELECT * FROM read_score WHERE userid='$usr'");
							$get=mysql_fetch_array($sql);		
							$maxtime=mysql_real_escape_string($_GET['max_time']);
							$clicks=mysql_real_escape_string($_GET['search_words']);
							if(isset($_GET['total']))
								$total=mysql_real_escape_string($_GET['total']);
							if(isset($_GET['score']))
							$score=mysql_real_escape_string($_GET['score']);
							$uname=$user_data['username'];
							$slide=$count;
							if($maxtime>0)
							{			
								mysql_query("UPDATE read_score SET slide".$slide."r='$total',slide".$slide."t='$maxtime',slide".$slide."s='$score',slide".$slide."c='$clicks' WHERE userid='".$uname."'");
								$sql=mysql_query("SELECT * FROM read_score WHERE userid='$usr'");
								$get=mysql_fetch_array($sql);
								$c=1;
								while($get['slide'.$c.'r']>0)
								{
									$c=$c+1;
									if($c==6){
										break;
									}
								}	
							}			
						}
					}
				?>
					<script type="text/javascript">
							var search_words=0;
							function getSelectionText() {
								var text = "";
								if (window.getSelection) {
									text = window.getSelection().toString();
								} else if (document.selection && document.selection.type != "Control") {
									text = document.selection.createRange().text;
								}
								search_words++;
								return text;
							}
							var max_time = 0;
							var t;
							var ti;
							function countdown_timer()
							{
								max_time=max_time+1;
								document.getElementById('countdown').innerHTML = max_time;
								clearTimeout(t);
							}
							t=setInterval('countdown_timer()',1000); 
							function alertType()
							{
								x=document.getElementById("total").value;
								if(max_time>20)
								{
									var r=confirm("Are you Sure?");
									if(r==true)
									{
										//count=count+1;
							//			var increment=count-1;
										ti=max_time;	
										$('#read_con').load('slides/slide'+count1+'/Questions.php?count='+count1+'&max_time='+ti+'&search_words='+search_words+'&total='+x);
										max_time=-1;
									}
									else
										{
											return false;
										}
								}	
								else
								{
									alert('You have to read the content first');
								}
							}
							function alertFinish()
							{
								x=document.getElementById("finish").value;
								if(max_time>20)
								{
									count+=1;
									$('#content1').load('lyrics.php?count='+count+'&max_time='+max_time+'&search_words='+search_words+'&total='+x);
									max_time=-1;
								}	
								else
								{
									alert('You have to read the content first');
								}
							}
					</script>
					<?php
					if ($c<=5){
						?>
					<div class="panel panel-default" style="min-height:410px;">
						<div class="panel-heading font-bold" style="text-align:center;">
							SLIDE - <?php echo $c; ?><div style="float:right;">Time : <b><span id="countdown"></span></b> Secs</div> 
						</div>
						<div style="color:#323754;font-weight:700px;padding-left:20px;padding-right:20px;margin-top:10px;margin-bottom:10px;"><marquee behaviour="alternate" speed="1">Double-click on a word to know the Meaning...</marquee></div>
						<div class="panel-body1" id="read_con" style="left:0.5em;color:#10696E;padding:10px;font-weight:bold;border:1px dashed #323754;">
							
								<?php										
										$file=fopen("slides/slide".$c."/slide".$c."1.html","r");
										$letters_count=letters(1);
										$words_count=words(1);
										$syllable_count=syllables(1);
										$sentence_count=sentences(1);
										$wordsbysent=$words_count/$sentence_count;
										$letterbyword=$letters_count/$words_count;
										$syllablebyword=$syllable_count/$words_count;									
										$total=206.85-(1.015*$wordsbysent)-(84.6*$syllablebyword); 	
										echo "<pre>";
while(!feof($file))
{
echo fgets($file);
}
								?>
								</pre>
								<?php
								$result=mysql_query("SELECT * FROM `answers` WHERE `slide`=".$c);
								while($row=mysql_fetch_array($result))
								{
									$ans1=$row['ans1'];
									$ans2=$row['ans2'];
									$ans3=$row['ans3'];
									$ans4=$row['ans4'];
								}
								?>
								<script type="text/javascript">
									var ans = new Array;
									var done = new Array;
									var score = 0;
									var wrong=0;
									ans[1] = <?php echo '"'.$ans1.'"';  ?>;
									ans[2] = <?php echo '"'.$ans2.'"';  ?>;
									ans[3] = <?php echo '"'.$ans3.'"';  ?>;
									ans[4] = <?php echo '"'.$ans4.'"';  ?>;
								</script>
								<center><button id="total" value="<?php echo $total; ?>" onClick="alertType()" class="" type="submit" style="position:relative;width:200px;text-align:center;">Submit</button></center>
						</div>
					</div>	
					<?php
						}
						else{
							echo "<center><p style='color:#10696E;font-size:20px;margin-top:20px;margin-left:30px;'>Thank you for cooperating with us... Next session will be coming on Monday...</p></center>";
					}
					}
					
					?>				
			</div>
		</div>

<?php
}
else{
	echo "<center><p style='color:#10696E;font-size:20px;margin-top:20px;margin-left:30px;'>Thank you for cooperating with us... Next session will be coming on Monday...</p></center>";
}
