"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[6085,7103,1883,4556,7664,6434],{1054:(e,t,a)=>{a.d(t,{Z:()=>l});var n=a(3645),o=a.n(n)()((function(e){return e[1]}));o.push([e.id,".brand-link{background:#61a534;padding:0}.brand-link .brand-image{float:none;max-height:60px}.app-name{padding:.8rem}",""]);const l=o},3347:(e,t,a)=>{a.d(t,{Z:()=>l});var n=a(3645),o=a.n(n)()((function(e){return e[1]}));o.push([e.id,".spinner-bounce>span[data-v-1588ef18]{-webkit-animation:bounceDelay-1588ef18 1.4s ease-in-out infinite both;animation:bounceDelay-1588ef18 1.4s ease-in-out infinite both;background-color:#e6e6e6;border-radius:100%;display:inline-block;height:9px;width:9px}.spinner-bounce>span.bounce1[data-v-1588ef18]{-webkit-animation-delay:-.32s;animation-delay:-.32s}.spinner-bounce>span.bounce2[data-v-1588ef18]{-webkit-animation-delay:-.16s;animation-delay:-.16s}.overlay-loader-wrapper[data-v-1588ef18]{background:hsla(0,0%,100%,.4);border-radius:.25rem;bottom:0;height:100%;left:0;right:0;top:0;width:100vw;z-index:10000}.overlay-loader-wrapper .spinner-bounce>span[data-v-1588ef18]{background-color:#61a534;height:11px;width:11px}@-webkit-keyframes bounceDelay-1588ef18{0%,80%,to{-webkit-transform:scale(0)}40%{-webkit-transform:scale(1)}}@keyframes bounceDelay-1588ef18{0%,80%,to{transform:scale(0)}40%{transform:scale(1)}}",""]);const l=o},7523:(e,t,a)=>{a.d(t,{Z:()=>c});var n=a(3645),o=a.n(n),l=a(8045),r=o()((function(e){return e[1]}));r.i(l.Z),r.push([e.id,"",""]);const c=r},8045:(e,t,a)=>{a.d(t,{Z:()=>l});var n=a(3645),o=a.n(n)()((function(e){return e[1]}));o.push([e.id,"/* Style the tab */\n.tab {\n\toverflow: hidden;\n\tborder: 1px solid #ccc;\n\tbackground-color: #f1f1f1;\n  }\n  \n  /* Style the buttons inside the tab */\n  .tab button {\n\tbackground-color: inherit;\n\tfloat: left;\n\tborder: none;\n\toutline: none;\n\tcursor: pointer;\n\tpadding: 14px 16px;\n\ttransition: 0.3s;\n\tfont-size: 17px;\n  }\n  \n  /* Change background color of buttons on hover */\n  .tab button:hover {\n\tbackground-color: #ddd;\n  }\n  \n  /* Create an active/current tablink class */\n  .tab button.active {\n\tbackground-color: #ccc;\n  }\n  \n  /* Style the tab content */\n  .tabContent {\n\tdisplay: none;\n\tpadding: 6px 12px;\n\tborder: 1px solid #ccc;\n\tborder-top: none;\n\theight: 350px !important;\n    overflow-y: scroll;\n  }",""]);const l=o},8059:(e,t,a)=>{a.d(t,{Z:()=>c});var n=a(6598),o=a(9038),l={class:"navbar sticky-top navbar-expand-lg navbar-dark bg-dark mb-3 pl-4"},r=(0,n.createElementVNode)("button",{class:"navbar-toggler",type:"button","data-toggle":"collapse","data-target":"#navbarText","aria-controls":"navbarText","aria-expanded":"false","aria-label":"Toggle navigation"},[(0,n.createElementVNode)("span",{class:"navbar-toggler-icon"})],-1);const c={__name:"Breadcrumb",props:{icon:{type:String,required:!1},title:{type:String,required:!1},route:{type:String,required:!1}},setup:function(e){var t,a,c,s=e,i=(0,n.reactive)({icon:null!==(t=s.icon)&&void 0!==t?t:"",title:null!==(a=s.title)&&void 0!==a?a:"",route:null!==(c=s.route)&&void 0!==c?c:""});return function(e,t){var a=(0,n.resolveComponent)("font-awesome-icon");return(0,n.openBlock)(),(0,n.createElementBlock)("nav",l,[(0,n.createVNode)((0,n.unref)(o.rU),{href:i.route,class:"navbar-brand",style:{color:"#222d32"}},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(a,{icon:["fas","".concat(i.icon)],class:"mr-3"},null,8,["icon"]),(0,n.createTextVNode)(" "+(0,n.toDisplayString)(i.title),1)]})),_:1},8,["href"]),r])}}}},9018:(e,t,a)=>{a.d(t,{Z:()=>l});var n=a(6598),o=["type"];const l={__name:"Button",props:{type:{type:String,default:"submit"},classes:{type:String,default:" focus:shadow-outline-gray transition ease-in-out duration-150"}},setup:function(e){return function(t,a){return(0,n.openBlock)(),(0,n.createElementBlock)("button",{type:e.type,class:(0,n.normalizeClass)(e.classes)},[(0,n.renderSlot)(t.$slots,"default")],10,o)}}}},8962:(e,t,a)=>{a.d(t,{Z:()=>s});var n=a(6598),o={class:"card"},l={key:0,class:"card-header"},r={class:"card-title text-bold"},c={class:"card-body"};const s={__name:"Card",props:{title:{type:String,default:"Card Title"},showHeader:{type:Boolean,default:!1}},setup:function(e){return function(t,a){return(0,n.openBlock)(),(0,n.createElementBlock)("div",o,[e.showHeader?((0,n.openBlock)(),(0,n.createElementBlock)("div",l,[(0,n.createElementVNode)("h3",r,(0,n.toDisplayString)(e.title),1)])):(0,n.createCommentVNode)("",!0),(0,n.createElementVNode)("div",c,[(0,n.renderSlot)(t.$slots,"default")])])}}}},537:(e,t,a)=>{a.d(t,{Z:()=>r});var n=a(6598),o=a(3764),l=a(6300);const r={__name:"PieChart",props:{chartId:{type:String,default:"pie-chart"},datasetIdKey:{type:String,default:"label"},width:{type:Number,default:300},height:{type:Number,default:300},cssClasses:{default:"",type:String},styles:{type:Object,default:function(){}},plugins:{type:Array,default:function(){return[]}},chartData:{type:Object,default:function(){}},chartOptions:{type:Object,default:function(){return{responsive:!0,maintainAspectRatio:!1}}}},setup:function(e){return l.kL.register(l.Dx,l.u,l.De,l.qi,l.uw),function(t,a){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(o.by),{"chart-options":e.chartOptions,"chart-data":e.chartData,"chart-id":e.chartId,"dataset-id-key":e.datasetIdKey,plugins:e.plugins,"css-classes":e.cssClasses,styles:e.styles,width:e.width,height:e.height},null,8,["chart-options","chart-data","chart-id","dataset-id-key","plugins","css-classes","styles","width","height"])}}}},7887:(e,t,a)=>{a.d(t,{Z:()=>l});var n=a(6598),o=["value","id","type","placeholder","autocomplete","step","readonly"];const l={__name:"Input",props:["modelValue","error","value","class","type","id","type","step","placeholder","autocomplete","readonly"],emits:["update:modelValue","getUserData"],setup:function(e){var t=e,a=(0,n.ref)(null);(0,n.onMounted)((function(){a.value.hasAttribute("autofocus")&&a.value.focus()}));var l=(0,n.computed)((function(){return null!=t.error?t.class+" is-invalid":t.class}));return function(t,r){var c;return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[(0,n.createElementVNode)("input",(0,n.mergeProps)({class:(0,n.unref)(l),value:null!==(c=e.value)&&void 0!==c?c:e.modelValue,onInput:r[0]||(r[0]=function(e){return t.$emit("update:modelValue",e.target.value)}),ref_key:"input",ref:a,id:e.id,type:e.type,autofocus:"",placeholder:e.placeholder,autocomplete:e.autocomplete,onChange:r[1]||(r[1]=function(e){return t.$emit("getUserData")}),step:e.step,readonly:e.readonly},t.$attrs),null,16,o),(0,n.withDirectives)((0,n.createElementVNode)("span",{class:"text-danger"},(0,n.toDisplayString)(e.error),513),[[n.vShow,e.error]])],64)}}}},1329:(e,t,a)=>{a.d(t,{Z:()=>c});var n=a(6598),o={class:"block font-medium text-sm text-gray-700"},l={key:0},r={key:1};const c={__name:"Label",props:["value"],setup:function(e){return function(t,a){return(0,n.openBlock)(),(0,n.createElementBlock)("label",o,[e.value?((0,n.openBlock)(),(0,n.createElementBlock)("span",l,(0,n.toDisplayString)(e.value),1)):((0,n.openBlock)(),(0,n.createElementBlock)("span",r,[(0,n.renderSlot)(t.$slots,"default")]))])}}}},4075:(e,t,a)=>{a.d(t,{Z:()=>B});var n=a(6598),o=a(2262),l=a(1329),r=a(7887),c=a(9018),s=a(9038),i={class:"row mt-2"},d={class:"col-12"},u={class:"card card-primary card-outline collapsed-card"},m={class:"card-header"},p={class:"card-title text-bold"},f={class:"mr-1"},h=(0,n.createTextVNode)(" Filter Data "),v={class:"card-tools"},b={class:"card-body"},g={class:"row"},y={key:0,class:"col-4"},N={key:0,class:"card-footer"},k={class:"mr-1"},V=(0,n.createTextVNode)(" SEARCH "),E={class:"mr-1"},w=(0,n.createTextVNode)(" RESET FILTER ");const B={__name:"TableFilter",props:{showSearch:{type:Boolean,default:!0},showSearchBtn:{type:Boolean,default:!0},showResetBtn:{type:Boolean,default:!1},resetLink:{type:String,default:""},showFooter:{type:Boolean,default:!0},label:{type:String,default:"Search"},placeholder:{type:String,default:"Search"}},setup:function(e){var t=(0,o.qj)({isExpanded:!1,search:""}),a=function(){t.isExpanded=!t.isExpanded};return function(o,B){var C=(0,n.resolveComponent)("font-awesome-icon");return(0,n.openBlock)(),(0,n.createElementBlock)("div",i,[(0,n.createElementVNode)("div",d,[(0,n.createElementVNode)("div",u,[(0,n.createElementVNode)("div",m,[(0,n.createElementVNode)("h3",p,[(0,n.createElementVNode)("span",f,[(0,n.createVNode)(C,{icon:["fas","arrow-down-wide-short"]})]),h]),(0,n.createElementVNode)("div",v,[(0,n.createElementVNode)("button",{type:"button",class:"btn btn-tool",onClick:a,"data-card-widget":"collapse",title:"Collapse"},[(0,n.createVNode)(C,{icon:["fas",(0,n.unref)(t).isExpanded?"minus":"plus"]},null,8,["icon"])])])]),(0,n.createElementVNode)("div",b,[(0,n.createElementVNode)("div",g,[(0,n.renderSlot)(o.$slots,"default"),e.showSearch?((0,n.openBlock)(),(0,n.createElementBlock)("div",y,[(0,n.createVNode)(l.Z,{for:"search",value:e.label},null,8,["value"]),(0,n.createVNode)(r.Z,{type:"text",class:"form-control",modelValue:(0,n.unref)(t).search,"onUpdate:modelValue":B[0]||(B[0]=function(e){return(0,n.unref)(t).search=e}),placeholder:e.placeholder,onKeyup:B[1]||(B[1]=(0,n.withKeys)((function(e){return o.$emit("filterTable",(0,n.unref)(t).search)}),["enter"]))},null,8,["modelValue","placeholder"])])):(0,n.createCommentVNode)("",!0)])]),e.showFooter?((0,n.openBlock)(),(0,n.createElementBlock)("div",N,[e.showSearchBtn?((0,n.openBlock)(),(0,n.createBlock)(c.Z,{key:0,type:"button",class:"btn btn-danger btn-sm float-right",onClick:B[2]||(B[2]=function(e){return o.$emit("filterTable",(0,n.unref)(t).search)})},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("span",k,[(0,n.createVNode)(C,{icon:["fas","magnifying-glass"]})]),V]})),_:1})):(0,n.createCommentVNode)("",!0),e.showResetBtn?((0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(s.rU),{key:1,type:"button",class:"btn btn-danger btn-sm float-right",href:e.resetLink},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("span",E,[(0,n.createVNode)(C,{icon:["fas","eraser"]})]),w]})),_:1},8,["href"])):(0,n.createCommentVNode)("",!0)])):(0,n.createCommentVNode)("",!0)])])])}}}},6485:(e,t,a)=>{a.d(t,{Z:()=>z});var n=a(6598),o=a(9038);const l={__name:"DropdownLink",setup:function(e){return function(e,t){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(o.rU),{class:"nav-link","data-widget":"control-sidebar","data-slide":"true",href:"#",role:"button"},{default:(0,n.withCtx)((function(){return[(0,n.renderSlot)(e.$slots,"default")]})),_:3})}}};var r=a(6252);const c={__name:"NavLink",props:["href","active"],setup:function(e){var t=e,a=(0,n.computed)((function(){return t.active?"nav-link active":"nav-link"}));function l(){var e=$(".sidebar-mini");e.hasClass("sidebar-open")&&(e.removeClass("sidebar-open"),e.addClass("sidebar-closed"),e.addClass("sidebar-collapse"))}return function(t,r){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(o.rU),{href:e.href,onClick:(0,n.withModifiers)(l,["prevent"]),class:(0,n.normalizeClass)((0,n.unref)(a))},{default:(0,n.withCtx)((function(){return[(0,n.renderSlot)(t.$slots,"default")]})),_:3},8,["href","onClick","class"])}}};var s={key:2,class:"nav nav-treeview"};const i={__name:"Dropdown",props:{item:Object,key:Number,dropdown:Object},setup:function(e){var t=function(e,t){if(null!=t)return!!(t=t.split("|")).includes(e)};return function(a,o){var l,r,d=(0,n.resolveComponent)("font-awesome-icon");return e.item.have_permission?((0,n.openBlock)(),(0,n.createElementBlock)("li",{key:0,class:(0,n.normalizeClass)(["nav-item",t(a.route().current(),e.item.route)?"menu-is-opening menu-open":" "])},[null!=e.item.child&&0!=e.item.child.length?((0,n.openBlock)(),(0,n.createElementBlock)("a",{key:0,class:(0,n.normalizeClass)(["nav-link",t(a.route().current(),e.item.route)?"active menu-open":" "]),href:"#"},[(0,n.createVNode)(d,{class:(0,n.normalizeClass)("nav-icon"),icon:["fas",e.item.icon]},null,8,["icon"]),(0,n.createElementVNode)("p",null,(0,n.toDisplayString)(a.__(e.item.name)),1)],2)):((0,n.openBlock)(),(0,n.createBlock)(c,{key:1,href:null!=e.item.route?a.route(e.item.route):"#",active:null!=e.item.route?(l=a.route().current(),r=e.item.route,!!r.includes(l)):"null"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(d,{class:(0,n.normalizeClass)("nav-icon"),icon:["fas",e.item.icon]},null,8,["icon"]),(0,n.createElementVNode)("p",null,(0,n.toDisplayString)(a.__(e.item.name)),1)]})),_:1},8,["href","active"])),null!=e.item.child&&0!=e.item.child.length?((0,n.openBlock)(),(0,n.createElementBlock)("ul",s,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(e.item.child,(function(e,t){return(0,n.openBlock)(),(0,n.createBlock)(i,{key:t,item:e,dropdown:e.route},null,8,["item","dropdown"])})),128))])):(0,n.createCommentVNode)("",!0)],2)):(0,n.createCommentVNode)("",!0)}}};var d={class:"main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand"},u={class:"brand-text font-weight-light app-name"},m=(0,n.createElementVNode)("div",{class:"clearfix"},null,-1),p={class:"sidebar os-host os-theme-light sidebar-initial-width"},f={class:"user-panel mt-3 pb-3 mb-3 d-flex"},h={class:"image"},v=["src"],b={class:"info"},g={class:"mt-2"};const y={__name:"Aside",setup:function(e){var t=(0,r.Fl)((function(){return storeData.getters.getAuthUser})),a=(0,r.Fl)((function(){return storeData.getters.getMenus})),l=(0,r.Fl)((function(){return(0,o.qt)().props.value.config.appName}));function c(){var e=$(".sidebar");$(".sidebar-mini").hasClass("sidebar-collapse")?e.addClass("sidebar-mini-new-width"):(e.removeClass("sidebar-initial-width"),e.addClass("expand-sideBar"))}function s(){var e=$(".sidebar");e.addClass("sidebar-initial-width"),e.removeClass("expand-sideBar"),e.hasClass("sidebar-mini-new-width")&&(e.removeClass("sidebar-mini-new-width"),e.addClass("sidebar-mini-initial-width"))}return(0,r.bv)((function(){storeData.dispatch("getUser"),storeData.dispatch("menuRequest",{id:t.value.id})})),(0,r.YP)((function(){return a.value}),(function(e){0==e.length&&storeData.dispatch("menuRequest",{id:t.value.id})}),{immediate:!0}),(0,r.YP)((function(){return t.value}),(function(e){""==e.id&&storeData.dispatch("getUser")}),{immediate:!0}),function(e,r){return(0,n.openBlock)(),(0,n.createElementBlock)("aside",d,[(0,n.createVNode)((0,n.unref)(o.rU),{href:e.route("dashboard"),class:"brand-link text-center"},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",u,(0,n.toDisplayString)((0,n.unref)(l)),1)]})),_:1},8,["href"]),m,(0,n.createElementVNode)("div",p,[(0,n.createElementVNode)("div",f,[(0,n.createElementVNode)("div",h,[(0,n.createElementVNode)("img",{src:e.$page.props.config.avatar,alt:"User Image",class:"img-circle elevation-2"},null,8,v)]),(0,n.createElementVNode)("div",b,[(0,n.createVNode)((0,n.unref)(o.rU),{href:e.route("user.profile"),class:"d-block"},{default:(0,n.withCtx)((function(){return[(0,n.createTextVNode)((0,n.toDisplayString)((0,n.unref)(t).name),1)]})),_:1},8,["href"])])]),(0,n.createElementVNode)("nav",g,[(0,n.createElementVNode)("ul",{class:"nav nav-pills nav-sidebar flex-column mcd-menu",onMouseover:c,onMouseleave:s,"data-widget":"treeview",role:"menu","data-accordion":"false"},[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(a),(function(e,t){return(0,n.openBlock)(),(0,n.createBlock)(i,{key:t,item:e},null,8,["item"])})),128))],32)])])])}}};var N=a(3379),k=a.n(N),V=a(1054),E={insert:"head",singleton:!1};k()(V.Z,E);V.Z.locals;const w=y;var B=a(9680),C={class:"position-absolute overlay-loader-wrapper"},x=[(0,n.createStaticVNode)('<span class="spinner-bounce d-flex align-items-center justify-content-center h-100" data-v-1588ef18><span class="bounce1 mr-1" data-v-1588ef18></span><span class="bounce2 mr-1" data-v-1588ef18></span><span class="bounce3 mr-1" data-v-1588ef18></span><span class="bounce4" data-v-1588ef18></span></span>',1)];var S=a(3347),D={insert:"head",singleton:!1};k()(S.Z,D);S.Z.locals;const _={},Z=(0,a(3744).Z)(_,[["render",function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("div",C,x)}],["__scopeId","data-v-1588ef18"]]);var F={class:"wrapper"},L={class:"main-header navbar navbar-expand navbar-white navbar-light"},T={class:"navbar-nav"},U={class:"nav-item nav-toggle-button"},j={class:"navbar-nav ml-auto"},O=(0,n.createElementVNode)("li",{class:"nav-item"},[(0,n.createElementVNode)("a",{class:"nav-link","data-widget":"fullscreen",href:"#",role:"button"},[(0,n.createElementVNode)("i",{class:"fas fa-expand-arrows-alt"})])],-1),A={class:"nav-item"},I={class:"content-wrapper"},P=(0,n.createElementVNode)("footer",{class:"main-footer"},[(0,n.createElementVNode)("div",{class:"float-right d-none d-sm-block"},[(0,n.createElementVNode)("b",null,"Version"),(0,n.createTextVNode)(" 1.0.0")]),(0,n.createElementVNode)("strong",null,[(0,n.createTextVNode)("Copyright © 2022 "),(0,n.createElementVNode)("a",{href:"#"},"oxFam"),(0,n.createTextVNode)(".")]),(0,n.createTextVNode)(" All rights reserved. ")],-1);const z={__name:"Authenticated",setup:function(e){function t(){var e=$(".sidebar");250==$(".main-sidebar").width()&&window.innerWidth>768?(e.removeClass("sidebar-initial-width"),e.addClass("sidebar-mini-initial-width")):(e.removeClass("sidebar-mini-initial-width"),e.addClass("sidebar-initial-width"))}var a=(0,n.reactive)({isPreloader:!1});return B.Inertia.on("start",(function(e){e.detail.visit;a.isPreloader=!0})),B.Inertia.on("finish",(function(e){e.detail.visit;a.isPreloader=!1})),function(e,o){var r=(0,n.resolveComponent)("font-awesome-icon");return(0,n.openBlock)(),(0,n.createElementBlock)("div",null,[(0,n.createElementVNode)("div",F,[(0,n.createElementVNode)("nav",L,[(0,n.createElementVNode)("ul",T,[(0,n.createElementVNode)("li",U,[(0,n.createElementVNode)("a",{class:"nav-link","data-widget":"pushmenu",href:"#",role:"button",onClick:t},[(0,n.createVNode)(r,{icon:["fas","bars"]})])])]),(0,n.createElementVNode)("ul",j,[O,(0,n.createElementVNode)("li",A,[(0,n.createVNode)(l,{href:e.route("logout"),method:"post"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(r,{icon:["fas","right-from-bracket"]}),(0,n.createTextVNode)(" "+(0,n.toDisplayString)(e.__("message.Logout")),1)]})),_:1},8,["href"])])])]),(0,n.createVNode)(w),(0,n.createElementVNode)("div",I,[(0,n.unref)(a).isPreloader?((0,n.openBlock)(),(0,n.createBlock)(Z,{key:0})):(0,n.createCommentVNode)("",!0),(0,n.renderSlot)(e.$slots,"default")]),P])])}}}},7103:(e,t,a)=>{a.r(t),a.d(t,{default:()=>r});var n=a(6598),o=a(537),l=a(8962);const r={__name:"AFAPieChart",setup:function(e){var t={labels:["IOM","UNHCR","UNICEF"],datasets:[{backgroundColor:["#41B883","#E46651","#00D8FF"],data:[40,20,80]}]};return function(e,a){return(0,n.openBlock)(),(0,n.createBlock)(l.Z,{title:"Per AFA",showHeader:!0},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(o.Z,{"chart-data":t})]})),_:1})}}}},1883:(e,t,a)=>{a.r(t),a.d(t,{default:()=>i});var n=a(6598),o=a(3764),l=a(6300);function r(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}const c={__name:"StackedChart",props:{chartId:{type:String,default:"bar-chart"},datasetIdKey:{type:String,default:"label"},width:{type:Number,default:400},height:{type:Number,default:180},cssClasses:{default:"",type:String},styles:{type:Object,default:function(){}},plugins:{type:Object,default:function(){}},chartData:{type:Object,default:function(){}},chartOptions:{type:Object,default:function(){var e;return r(e={responsive:!0,maintainAspectRatio:!1},"maintainAspectRatio",!0),r(e,"plugins",{legend:{display:!1}}),r(e,"scales",{y:{beginAtZero:!0}}),e}}},setup:function(e){return l.kL.register(l.Dx,l.u,l.De,l.ZL,l.uw,l.f$),function(t,a){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(o.$Q),{"chart-options":e.chartOptions,"chart-data":e.chartData,"chart-id":e.chartId,"dataset-id-key":e.datasetIdKey,plugins:e.plugins,"css-classes":e.cssClasses,styles:e.styles,width:e.width,height:e.height},null,8,["chart-options","chart-data","chart-id","dataset-id-key","plugins","css-classes","styles","width","height"])}}};var s=a(8962);const i={__name:"FirstStackedChart",props:{data:{type:Object,default:{labels:[],datasets:[]}},title:{type:String,default:"Stacked Chart"}},setup:function(e){return function(t,a){return(0,n.openBlock)(),(0,n.createBlock)(s.Z,{title:e.title,showHeader:!0},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(c,{"chart-data":e.data},null,8,["chart-data"])]})),_:1},8,["title"])}}}},4556:(e,t,a)=>{a.r(t),a.d(t,{default:()=>r});var n=a(6598),o=a(537),l=a(8962);const r={__name:"SecondPieChart",setup:function(e){var t={labels:["HouseHold","Source"],datasets:[{backgroundColor:["#41B883","#E46651"],data:[40,20]}]};return function(e,a){return(0,n.openBlock)(),(0,n.createBlock)(l.Z,{title:" Water Samples at Household and Source Level",showHeader:!0},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(o.Z,{"chart-data":t})]})),_:1})}}}},7664:(e,t,a)=>{a.r(t),a.d(t,{default:()=>r});var n=a(6598),o=a(537),l=a(8962);const r={__name:"ThirdPieChart",setup:function(e){var t={labels:["HandPump","RawWater","BottledWater"],datasets:[{backgroundColor:["#41B883","#E46651","#00D8FF"],data:[40,20,50]}]};return function(e,a){return(0,n.openBlock)(),(0,n.createBlock)(l.Z,{title:" Water Samples at Household and Source Level",showHeader:!0},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(o.Z,{"chart-data":t})]})),_:1})}}}},6434:(e,t,a)=>{a.r(t),a.d(t,{default:()=>f});var n=a(6598),o=a(1329),l=(a(7887),a(9018),a(9680),a(2262)),r=a(4075),c={class:"col-3"},s={class:"col-3"},i={class:"col-3"},d={class:"col-3"},u={class:"col-3"},m={class:"col-3"},p={class:"col-3"};const f={__name:"Filter",props:{camps:Object,blocks:Object,years:Object,months:Object,sanitationZones:Object,filterForm:Object},setup:function(e){var t=e,a=(0,l.qj)({campBlocks:t.blocks});return function(l,f){var h=(0,n.resolveComponent)("multi-select");return(0,n.openBlock)(),(0,n.createBlock)(r.Z,{"show-search":!1,"show-search-btn":!1,"show-footer":!0,"show-reset-btn":!0,"reset-link":"dashboard"},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",c,[(0,n.createVNode)(o.Z,{for:"year",value:"Year"}),(0,n.createVNode)(h,{modelValue:e.filterForm.year,"onUpdate:modelValue":f[0]||(f[0]=function(t){return e.filterForm.year=t}),options:(0,n.unref)(t).years,placeholder:"Choose a year",searchable:!0,"close-on-select":!1,mode:"tags"},null,8,["modelValue","options"])]),(0,n.createElementVNode)("div",s,[(0,n.createVNode)(o.Z,{for:"month",value:"Month"}),(0,n.createVNode)(h,{modelValue:e.filterForm.month,"onUpdate:modelValue":f[1]||(f[1]=function(t){return e.filterForm.month=t}),options:(0,n.unref)(t).months,placeholder:"Choose a Month",searchable:!0,"close-on-select":!1,mode:"tags"},null,8,["modelValue","options"])]),(0,n.createElementVNode)("div",i,[(0,n.createVNode)(o.Z,{for:"camp",value:"Camp"}),(0,n.createVNode)(h,{modelValue:e.filterForm.camp,"onUpdate:modelValue":f[2]||(f[2]=function(t){return e.filterForm.camp=t}),onChange:f[3]||(f[3]=function(e){return null!=(n=e)&&(t.filterForm.block=[],a.campBlocks=t.blocks.filter((function(e){return n==e.camp_id}))),l.$emit("onChangeData");var n}),options:e.camps,placeholder:"Choose a camp",searchable:!0,mode:"tags","close-on-select":!1},null,8,["modelValue","options"])]),(0,n.createElementVNode)("div",d,[(0,n.createVNode)(o.Z,{for:"block",value:"Block"}),(0,n.createVNode)(h,{modelValue:e.filterForm.block,"onUpdate:modelValue":f[4]||(f[4]=function(t){return e.filterForm.block=t}),options:(0,n.unref)(a).campBlocks,placeholder:"Choose a block",searchable:!0,mode:"tags","close-on-select":!1},null,8,["modelValue","options"])]),(0,n.createElementVNode)("div",u,[(0,n.createVNode)(o.Z,{for:"sanitationZones",value:"Sanitation Zone"}),(0,n.createVNode)(h,{modelValue:e.filterForm.sanitationZones,"onUpdate:modelValue":f[5]||(f[5]=function(t){return e.filterForm.sanitationZones=t}),options:(0,n.unref)(t).sanitationZones,placeholder:"Choose a Sanitation Zone",searchable:!0,mode:"tags","close-on-select":!1},null,8,["modelValue","options"])]),(0,n.createElementVNode)("div",m,[(0,n.createVNode)(o.Z,{for:"fromDate",value:"From Date"}),(0,n.withDirectives)((0,n.createElementVNode)("input",{"onUpdate:modelValue":f[6]||(f[6]=function(t){return e.filterForm.fromDate=t}),class:(0,n.normalizeClass)("form-control"),type:"date"},null,512),[[n.vModelText,e.filterForm.fromDate]])]),(0,n.createElementVNode)("div",p,[(0,n.createVNode)(o.Z,{for:"toDate",value:"To Date"}),(0,n.withDirectives)((0,n.createElementVNode)("input",{"onUpdate:modelValue":f[7]||(f[7]=function(t){return e.filterForm.toDate=t}),class:(0,n.normalizeClass)("form-control"),type:"date"},null,512),[[n.vModelText,e.filterForm.toDate]])])]})),_:1})}}}},6085:(e,t,a)=>{a.r(t),a.d(t,{default:()=>ne});var n=a(6598),o=a(6252),l=a(2262),r=a(6485),c=a(9038),s=a(8059),i={class:"info-box-content"},d={class:"info-box-number"},u={class:"info-box-text"};const m={__name:"Widget",props:{class:{type:String,default:null},style:{type:String,default:null},title:{type:String,default:null},icon:{type:String,default:null},value:{type:Number,default:0},backgroundColor:{default:"bg-info"}},setup:function(e){return function(t,a){var o=(0,n.resolveComponent)("font-awesome-icon");return(0,n.openBlock)(),(0,n.createElementBlock)("div",{class:(0,n.normalizeClass)(["info-box",e.class]),style:(0,n.normalizeStyle)(e.style)},[(0,n.createElementVNode)("span",{class:(0,n.normalizeClass)(["info-box-icon",e.backgroundColor])},[(0,n.createVNode)(o,{class:(0,n.normalizeClass)("nav-icon"),icon:["fas",e.icon]},null,8,["icon"])],2),(0,n.createElementVNode)("div",i,[(0,n.createElementVNode)("span",d,(0,n.toDisplayString)(e.value),1),(0,n.createElementVNode)("span",u,(0,n.toDisplayString)(e.title),1)])],6)}}};var p=a(6434),f=(a(8962),a(7103),a(4556),a(7664),a(1883)),h=function(e){return(0,n.pushScopeId)("data-v-27548ea0"),e=e(),(0,n.popScopeId)(),e},v={class:"content"},b={class:"container-fluid"},g={class:"row"},y={class:"col-12"},N={class:"d-flex"},k={class:"flex-fill"},V={class:"flex-fill"},E={class:"flex-fill"},w={class:"flex-fill"},B={class:"flex-fill"},C={class:"flex-fill"},x={class:"flex-fill"},S={class:"row"},D={class:"col-8"},_={class:"card card-danger card-outline",style:{height:"455px !important"}},Z=h((function(){return(0,n.createElementVNode)("div",{class:"card-header"},[(0,n.createElementVNode)("h3",{class:"card-title text-bold"},"Desludging schedule")],-1)})),F={class:"tab"},L=["onClick"],T=["id"],U={class:"table table-striped table-hover display"},j=h((function(){return(0,n.createElementVNode)("thead",{class:"table-header"},[(0,n.createElementVNode)("tr",null,[(0,n.createElementVNode)("th",null,"UID No. "),(0,n.createElementVNode)("th",null,"Block Name"),(0,n.createElementVNode)("th",null,"Camp Name"),(0,n.createElementVNode)("th",null,"Sanitation Zone Name"),(0,n.createElementVNode)("th",null,"Days Left"),(0,n.createElementVNode)("th",null,"Last Desludge Date"),(0,n.createElementVNode)("th",null,"Last Volume Desludged")])],-1)})),O={class:"col-4"},A={class:"card card-warning card-outline"},I=h((function(){return(0,n.createElementVNode)("div",{class:"card-header"},[(0,n.createElementVNode)("h3",{class:"card-title text-bold"}," Most required desludge needed sanitation zones ")],-1)})),P={class:"card-body",style:{height:"405px !important","overflow-y":"scroll"}},$={class:"table table-striped table-hover display"},z=h((function(){return(0,n.createElementVNode)("thead",{class:"table-header"},[(0,n.createElementVNode)("th",null,"#"),(0,n.createElementVNode)("th",null,"Name"),(0,n.createElementVNode)("th",null,"Red"),(0,n.createElementVNode)("th",null,"Yellow")],-1)})),q={class:"row"},H={class:"col-md-6"},M={class:"col-md-6"},R={class:"row"},Y={class:"col-md-6"},K={class:"col-md-6"},W={class:"row"},J={class:"col-md-6"},Q=h((function(){return(0,n.createElementVNode)("div",{class:"col-md-6"},null,-1)}));const G={__name:"Index",props:{camps:{type:Array,default:[]},totalCamps:{type:Number,default:0},blocks:{type:Array,default:[]},totalBlocks:{type:Number,default:0},sanitationZones:{type:Array,default:[]},totalSanitationZones:{type:Number,default:0},agencies:{type:Array,default:[]},totalAgencies:{type:Number,default:0},teams:{type:Array,default:[]},totalTeams:{type:Number,default:0},totalLatrines:{type:Number,default:0},totalUsers:{type:Number,default:0},years:{type:Array,default:[]},months:{type:Array,default:[]}},setup:function(e){var t=(0,l.qj)({TotalVolumeDesludged:[],LatrineScheduleDate:[],LatrineScheduleDataList:[],typeofLatrine:[],totalHoursUsed:[],seeForeignMaterials:[],totalLitterFuelUsed:[],requiredSanitationZone:[]}),a=(0,l.qj)({sanitationZones:[],block:[],camp:[],year:[],month:[],toDate:"",fromDate:""}),i=(0,l.qj)({params:{camp:null,block:null,year:null,month:null,sanitationZones:null,toDate:null,fromDate:null}});(0,o.YP)((function(){return a.sanitationZones}),(function(e){i.params.sanitationZones=e.length>0?JSON.stringify(e):null,setTimeout((function(){d()}),1)}),{immediate:!1}),(0,o.YP)((function(){return a.camp}),(function(e){i.params.camp=e.length>0?JSON.stringify(e):null,setTimeout((function(){d()}),1)}),{immediate:!1}),(0,o.YP)((function(){return a.block}),(function(e){i.params.block=e.length>0?JSON.stringify(e):null,setTimeout((function(){d()}),1)}),{immediate:!1}),(0,o.YP)((function(){return a.year}),(function(e){i.params.year=e.length>0?JSON.stringify(e):null,setTimeout((function(){d()}),1)}),{immediate:!1}),(0,o.YP)((function(){return a.month}),(function(e){i.params.month=e.length>0?JSON.stringify(e):null,setTimeout((function(){d()}),1)}),{immediate:!1}),(0,o.YP)((function(){return a.fromDate}),(function(e){i.params.fromDate=e||null,setTimeout((function(){d()}),1)}),{immediate:!1}),(0,o.YP)((function(){return a.toDate}),(function(e){i.params.toDate=e||null,setTimeout((function(){d()}),1)}),{immediate:!1});var d=function(){axios.get("ajax/latrine-desludge-schedule",i).then((function(e){var a,n;t.LatrineScheduleDate=null!==(a=e.data.dateData)&&void 0!==a?a:[],t.LatrineScheduleDataList=null!==(n=e.data.listData)&&void 0!==n?n:[]})).catch((function(e){toast.warning(e)})),axios.get("ajax/total-volume-desludged",i).then((function(e){t.TotalVolumeDesludged=e.data})).catch((function(e){toast.warning(e)})),axios.get("ajax/typeof-latrine",i).then((function(e){var a;t.typeofLatrine=null!==(a=e.data)&&void 0!==a?a:[]})).catch((function(e){toast.warning(e)})),axios.get("ajax/total-hours-used",i).then((function(e){var a;t.totalHoursUsed=null!==(a=e.data)&&void 0!==a?a:[]})).catch((function(e){toast.warning(e)})),axios.get("ajax/see-foreign-materials",i).then((function(e){var a;t.seeForeignMaterials=null!==(a=e.data)&&void 0!==a?a:[]})).catch((function(e){toast.warning(e)})),axios.get("ajax/total-litter-fuel-used",i).then((function(e){var a;t.totalLitterFuelUsed=null!==(a=e.data)&&void 0!==a?a:[]})).catch((function(e){toast.warning(e)})),axios.get("ajax/required-sanitation-zone",i).then((function(e){var a;t.requiredSanitationZone=null!==(a=e.data)&&void 0!==a?a:[]})).catch((function(e){toast.warning(e)}))};(0,o.bv)((function(){d()}));return function(o,l){return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[(0,n.createVNode)((0,n.unref)(c.Fb),{title:"Dashboard"}),(0,n.createVNode)(r.Z,null,{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(s.Z,{icon:"border-all",title:"Dashboard"}),(0,n.createElementVNode)("section",v,[(0,n.createElementVNode)("div",b,[(0,n.createElementVNode)("div",g,[(0,n.createElementVNode)("div",y,[(0,n.createElementVNode)("div",N,[(0,n.createElementVNode)("div",k,[(0,n.createVNode)(m,{style:"background-color: transparent; box-shadow: none",title:"Camps",icon:"campground","background-color":"bg-primary",value:e.totalCamps},null,8,["value"])]),(0,n.createElementVNode)("div",V,[(0,n.createVNode)(m,{style:"background-color: transparent; box-shadow: none",title:"Blocks",icon:"map",value:e.totalBlocks},null,8,["value"])]),(0,n.createElementVNode)("div",E,[(0,n.createVNode)(m,{style:"background-color: transparent; box-shadow: none",title:"Zones",icon:"map-location-dot","background-color":"bg-danger",value:e.totalSanitationZones},null,8,["value"])]),(0,n.createElementVNode)("div",w,[(0,n.createVNode)(m,{style:"background-color: transparent; box-shadow: none",title:"Latrines",icon:"toilet","background-color":"bg-success",value:e.totalLatrines},null,8,["value"])]),(0,n.createElementVNode)("div",B,[(0,n.createVNode)(m,{style:"background-color: transparent; box-shadow: none",title:"Agencies",icon:"house","background-color":"bg-warning",value:e.totalAgencies},null,8,["value"])]),(0,n.createElementVNode)("div",C,[(0,n.createVNode)(m,{style:"background-color: transparent; box-shadow: none",title:"Teams",icon:"people-group","background-color":"bg-secondary",value:e.totalTeams},null,8,["value"])]),(0,n.createElementVNode)("div",x,[(0,n.createVNode)(m,{style:"background-color: transparent; box-shadow: none",title:"Users",icon:"users","background-color":"bg-danger",value:e.totalUsers},null,8,["value"])])])])])]),(0,n.createVNode)(p.default,{camps:e.camps,blocks:e.blocks,years:e.years,months:e.months,sanitationZones:e.sanitationZones,filterForm:(0,n.unref)(a)},null,8,["camps","blocks","years","months","sanitationZones","filterForm"]),(0,n.createElementVNode)("div",S,[(0,n.createElementVNode)("div",D,[(0,n.createElementVNode)("div",_,[Z,(0,n.createElementVNode)("div",F,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(t).LatrineScheduleDate,(function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("button",{class:(0,n.normalizeClass)(["tabLinks",0==t?"active":""]),onClick:function(t){return function(e,t){var a,n,o;for(n=document.getElementsByClassName("tabContent"),a=0;a<n.length;a++)n[a].style.display="none";for(o=document.getElementsByClassName("tabLinks"),a=0;a<o.length;a++)o[a].className=o[a].className.replace(" active","");document.getElementById(t).style.display="block",e.currentTarget.className+=" active"}(t,"".concat(e))},key:t},(0,n.toDisplayString)(e),11,L)})),128))]),((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(t).LatrineScheduleDate,(function(e,a){return(0,n.openBlock)(),(0,n.createElementBlock)("div",{id:"".concat(e),class:(0,n.normalizeClass)(["tabContent",0==a?"active":""]),style:(0,n.normalizeStyle)(0==a?"display: block;":""),key:a},[(0,n.createElementVNode)("table",U,[j,(0,n.createElementVNode)("tbody",null,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(t).LatrineScheduleDataList[a],(function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("tr",{key:t},[(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(e.uid_no),1),(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(e.block_name),1),(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(e.camp_name),1),(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(e.sanitation_zone_name),1),(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(e.days_left),1),(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(e.last_desludge_date),1),(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(e.last_volume_desludged),1)])})),128))])])],14,T)})),128))])]),(0,n.createElementVNode)("div",O,[(0,n.createElementVNode)("div",A,[I,(0,n.createElementVNode)("div",P,[(0,n.createElementVNode)("table",$,[z,(0,n.createElementVNode)("tbody",null,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(t).requiredSanitationZone,(function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("tr",{key:t,style:(0,n.normalizeStyle)("2ecc71"!=e.color?{backgroundColor:"#".concat(e.color)}:"")},[(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(e.id),1),(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(e.name),1),(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(e.danger)+"%",1),(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(e.warning)+"%",1)],4)})),128))])])])])])]),(0,n.createElementVNode)("div",q,[(0,n.createElementVNode)("div",H,[(0,n.createVNode)(f.default,{data:(0,n.unref)(t).TotalVolumeDesludged,title:"Total volume desludged"},null,8,["data"])]),(0,n.createElementVNode)("div",M,[(0,n.createVNode)(f.default,{data:(0,n.unref)(t).typeofLatrine,title:"Type of latrines"},null,8,["data"])])]),(0,n.createElementVNode)("div",R,[(0,n.createElementVNode)("div",Y,[(0,n.createVNode)(f.default,{data:(0,n.unref)(t).totalHoursUsed,title:"Total hour used for this latrine desludging"},null,8,["data"])]),(0,n.createElementVNode)("div",K,[(0,n.createVNode)(f.default,{data:(0,n.unref)(t).seeForeignMaterials,title:"See any foreign materials ( Plastic bottle, shoes, cloths etc )"},null,8,["data","title"])])]),(0,n.createElementVNode)("div",W,[(0,n.createElementVNode)("div",J,[(0,n.createVNode)(f.default,{data:(0,n.unref)(t).totalLitterFuelUsed,title:"Liter of Petrol/ Diesel  used"},null,8,["data"])]),Q])])]})),_:1})],64)}}};var X=a(3379),ee=a.n(X),te=a(7523),ae={insert:"head",singleton:!1};ee()(te.Z,ae);te.Z.locals;const ne=(0,a(3744).Z)(G,[["__scopeId","data-v-27548ea0"]])}}]);