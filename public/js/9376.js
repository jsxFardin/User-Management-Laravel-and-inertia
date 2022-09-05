"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[9376,7103,1883,4556,7664,6434],{1054:(e,t,a)=>{a.d(t,{Z:()=>r});var n=a(3645),o=a.n(n)()((function(e){return e[1]}));o.push([e.id,".brand-link{background:#61a534;padding:0}.brand-link .brand-image{float:none;max-height:60px}.app-name{padding:.8rem}",""]);const r=o},3347:(e,t,a)=>{a.d(t,{Z:()=>r});var n=a(3645),o=a.n(n)()((function(e){return e[1]}));o.push([e.id,".spinner-bounce>span[data-v-1588ef18]{-webkit-animation:bounceDelay-1588ef18 1.4s ease-in-out infinite both;animation:bounceDelay-1588ef18 1.4s ease-in-out infinite both;background-color:#e6e6e6;border-radius:100%;display:inline-block;height:9px;width:9px}.spinner-bounce>span.bounce1[data-v-1588ef18]{-webkit-animation-delay:-.32s;animation-delay:-.32s}.spinner-bounce>span.bounce2[data-v-1588ef18]{-webkit-animation-delay:-.16s;animation-delay:-.16s}.overlay-loader-wrapper[data-v-1588ef18]{background:hsla(0,0%,100%,.4);border-radius:.25rem;bottom:0;height:100%;left:0;right:0;top:0;width:100vw;z-index:10000}.overlay-loader-wrapper .spinner-bounce>span[data-v-1588ef18]{background-color:#61a534;height:11px;width:11px}@-webkit-keyframes bounceDelay-1588ef18{0%,80%,to{-webkit-transform:scale(0)}40%{-webkit-transform:scale(1)}}@keyframes bounceDelay-1588ef18{0%,80%,to{transform:scale(0)}40%{transform:scale(1)}}",""]);const r=o},8059:(e,t,a)=>{a.d(t,{Z:()=>c});var n=a(6598),o=a(9038),r={class:"navbar sticky-top navbar-expand-lg navbar-dark bg-dark mb-3 pl-4"},l=(0,n.createElementVNode)("button",{class:"navbar-toggler",type:"button","data-toggle":"collapse","data-target":"#navbarText","aria-controls":"navbarText","aria-expanded":"false","aria-label":"Toggle navigation"},[(0,n.createElementVNode)("span",{class:"navbar-toggler-icon"})],-1);const c={__name:"Breadcrumb",props:{icon:{type:String,required:!1},title:{type:String,required:!1},route:{type:String,required:!1}},setup:function(e){var t,a,c,s=e,i=(0,n.reactive)({icon:null!==(t=s.icon)&&void 0!==t?t:"",title:null!==(a=s.title)&&void 0!==a?a:"",route:null!==(c=s.route)&&void 0!==c?c:""});return function(e,t){var a=(0,n.resolveComponent)("font-awesome-icon");return(0,n.openBlock)(),(0,n.createElementBlock)("nav",r,[(0,n.createVNode)((0,n.unref)(o.rU),{href:i.route,class:"navbar-brand",style:{color:"#222d32"}},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(a,{icon:["fas","".concat(i.icon)],class:"mr-3"},null,8,["icon"]),(0,n.createTextVNode)(" "+(0,n.toDisplayString)(i.title),1)]})),_:1},8,["href"]),l])}}}},9018:(e,t,a)=>{a.d(t,{Z:()=>r});var n=a(6598),o=["type"];const r={__name:"Button",props:{type:{type:String,default:"submit"},classes:{type:String,default:" focus:shadow-outline-gray transition ease-in-out duration-150"}},setup:function(e){return function(t,a){return(0,n.openBlock)(),(0,n.createElementBlock)("button",{type:e.type,class:(0,n.normalizeClass)(e.classes)},[(0,n.renderSlot)(t.$slots,"default")],10,o)}}}},8962:(e,t,a)=>{a.d(t,{Z:()=>s});var n=a(6598),o={class:"card"},r={key:0,class:"card-header"},l={class:"card-title"},c={class:"card-body"};const s={__name:"Card",props:{title:{type:String,default:"Card Title"},showHeader:{type:Boolean,default:!1}},setup:function(e){return function(t,a){return(0,n.openBlock)(),(0,n.createElementBlock)("div",o,[e.showHeader?((0,n.openBlock)(),(0,n.createElementBlock)("div",r,[(0,n.createElementVNode)("h3",l,(0,n.toDisplayString)(e.title),1)])):(0,n.createCommentVNode)("",!0),(0,n.createElementVNode)("div",c,[(0,n.renderSlot)(t.$slots,"default")])])}}}},537:(e,t,a)=>{a.d(t,{Z:()=>l});var n=a(6598),o=a(3764),r=a(6300);const l={__name:"PieChart",props:{chartId:{type:String,default:"pie-chart"},datasetIdKey:{type:String,default:"label"},width:{type:Number,default:300},height:{type:Number,default:300},cssClasses:{default:"",type:String},styles:{type:Object,default:function(){}},plugins:{type:Array,default:function(){return[]}},chartData:{type:Object,default:function(){}},chartOptions:{type:Object,default:function(){return{responsive:!0,maintainAspectRatio:!1}}}},setup:function(e){return r.kL.register(r.Dx,r.u,r.De,r.qi,r.uw),function(t,a){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(o.by),{"chart-options":e.chartOptions,"chart-data":e.chartData,"chart-id":e.chartId,"dataset-id-key":e.datasetIdKey,plugins:e.plugins,"css-classes":e.cssClasses,styles:e.styles,width:e.width,height:e.height},null,8,["chart-options","chart-data","chart-id","dataset-id-key","plugins","css-classes","styles","width","height"])}}}},7887:(e,t,a)=>{a.d(t,{Z:()=>r});var n=a(6598),o=["value","id","type","placeholder","autocomplete","step","readonly"];const r={__name:"Input",props:["modelValue","error","value","class","type","id","type","step","placeholder","autocomplete","readonly"],emits:["update:modelValue","getUserData"],setup:function(e){var t=e,a=(0,n.ref)(null);(0,n.onMounted)((function(){a.value.hasAttribute("autofocus")&&a.value.focus()}));var r=(0,n.computed)((function(){return null!=t.error?t.class+" is-invalid":t.class}));return function(t,l){var c;return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[(0,n.createElementVNode)("input",(0,n.mergeProps)({class:(0,n.unref)(r),value:null!==(c=e.value)&&void 0!==c?c:e.modelValue,onInput:l[0]||(l[0]=function(e){return t.$emit("update:modelValue",e.target.value)}),ref_key:"input",ref:a,id:e.id,type:e.type,autofocus:"",placeholder:e.placeholder,autocomplete:e.autocomplete,onChange:l[1]||(l[1]=function(e){return t.$emit("getUserData")}),step:e.step,readonly:e.readonly},t.$attrs),null,16,o),(0,n.withDirectives)((0,n.createElementVNode)("span",{class:"text-danger"},(0,n.toDisplayString)(e.error),513),[[n.vShow,e.error]])],64)}}}},1329:(e,t,a)=>{a.d(t,{Z:()=>c});var n=a(6598),o={class:"block font-medium text-sm text-gray-700"},r={key:0},l={key:1};const c={__name:"Label",props:["value"],setup:function(e){return function(t,a){return(0,n.openBlock)(),(0,n.createElementBlock)("label",o,[e.value?((0,n.openBlock)(),(0,n.createElementBlock)("span",r,(0,n.toDisplayString)(e.value),1)):((0,n.openBlock)(),(0,n.createElementBlock)("span",l,[(0,n.renderSlot)(t.$slots,"default")]))])}}}},4075:(e,t,a)=>{a.d(t,{Z:()=>y});var n=a(6598),o=a(2262),r=a(1329),l=a(7887),c=a(9018),s={class:"row mt-2"},i={class:"col-12"},d={class:"card card-primary card-outline collapsed-card"},u={class:"card-header"},m={class:"card-title text-bold"},p={class:"mr-1"},f=(0,n.createTextVNode)(" Filter Data "),h={class:"card-tools"},v={class:"card-body"},b={class:"row"},k={key:0,class:"col-4"},g={class:"card-footer"},V={class:"mr-1"},N=(0,n.createTextVNode)(" SEARCH ");const y={__name:"TableFilter",props:{showSearch:{type:Boolean,default:!0},label:{type:String,default:"Search"},placeholder:{type:String,default:"Search"}},setup:function(e){var t=(0,o.qj)({isExpanded:!1,search:""}),a=function(){t.isExpanded=!t.isExpanded};return function(o,y){var w=(0,n.resolveComponent)("font-awesome-icon");return(0,n.openBlock)(),(0,n.createElementBlock)("div",s,[(0,n.createElementVNode)("div",i,[(0,n.createElementVNode)("div",d,[(0,n.createElementVNode)("div",u,[(0,n.createElementVNode)("h3",m,[(0,n.createElementVNode)("span",p,[(0,n.createVNode)(w,{icon:["fas","arrow-down-wide-short"]})]),f]),(0,n.createElementVNode)("div",h,[(0,n.createElementVNode)("button",{type:"button",class:"btn btn-tool",onClick:a,"data-card-widget":"collapse",title:"Collapse"},[(0,n.createVNode)(w,{icon:["fas",(0,n.unref)(t).isExpanded?"minus":"plus"]},null,8,["icon"])])])]),(0,n.createElementVNode)("div",v,[(0,n.createElementVNode)("div",b,[(0,n.renderSlot)(o.$slots,"default"),e.showSearch?((0,n.openBlock)(),(0,n.createElementBlock)("div",k,[(0,n.createVNode)(r.Z,{for:"search",value:e.label},null,8,["value"]),(0,n.createVNode)(l.Z,{type:"text",class:"form-control",modelValue:(0,n.unref)(t).search,"onUpdate:modelValue":y[0]||(y[0]=function(e){return(0,n.unref)(t).search=e}),placeholder:e.placeholder,onKeyup:y[1]||(y[1]=(0,n.withKeys)((function(e){return o.$emit("filterTable",(0,n.unref)(t).search)}),["enter"]))},null,8,["modelValue","placeholder"])])):(0,n.createCommentVNode)("",!0)])]),(0,n.createElementVNode)("div",g,[(0,n.createVNode)(c.Z,{type:"button",class:"btn btn-danger btn-sm float-right",onClick:y[2]||(y[2]=function(e){return o.$emit("filterTable",(0,n.unref)(t).search)})},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("span",V,[(0,n.createVNode)(w,{icon:["fas","magnifying-glass"]})]),N]})),_:1})])])])])}}}},6485:(e,t,a)=>{a.d(t,{Z:()=>L});var n=a(6598),o=a(9038);const r={__name:"DropdownLink",setup:function(e){return function(e,t){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(o.rU),{class:"nav-link","data-widget":"control-sidebar","data-slide":"true",href:"#",role:"button"},{default:(0,n.withCtx)((function(){return[(0,n.renderSlot)(e.$slots,"default")]})),_:3})}}};var l=a(6252);const c={__name:"NavLink",props:["href","active"],setup:function(e){var t=e,a=(0,n.computed)((function(){return t.active?"nav-link active":"nav-link"}));function r(){var e=$(".sidebar-mini");e.hasClass("sidebar-open")&&(e.removeClass("sidebar-open"),e.addClass("sidebar-closed"),e.addClass("sidebar-collapse"))}return function(t,l){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(o.rU),{href:e.href,onClick:(0,n.withModifiers)(r,["prevent"]),class:(0,n.normalizeClass)((0,n.unref)(a))},{default:(0,n.withCtx)((function(){return[(0,n.renderSlot)(t.$slots,"default")]})),_:3},8,["href","onClick","class"])}}};var s={key:2,class:"nav nav-treeview"};const i={__name:"Dropdown",props:{item:Object,key:Number,dropdown:Object},setup:function(e){var t=function(e,t){if(null!=t)return!!(t=t.split("|")).includes(e)};return function(a,o){var r,l,d=(0,n.resolveComponent)("font-awesome-icon");return e.item.have_permission?((0,n.openBlock)(),(0,n.createElementBlock)("li",{key:0,class:(0,n.normalizeClass)(["nav-item",t(a.route().current(),e.item.route)?"menu-is-opening menu-open":" "])},[null!=e.item.child&&0!=e.item.child.length?((0,n.openBlock)(),(0,n.createElementBlock)("a",{key:0,class:(0,n.normalizeClass)(["nav-link",t(a.route().current(),e.item.route)?"active menu-open":" "]),href:"#"},[(0,n.createVNode)(d,{class:(0,n.normalizeClass)("nav-icon"),icon:["fas",e.item.icon]},null,8,["icon"]),(0,n.createElementVNode)("p",null,(0,n.toDisplayString)(a.__(e.item.name)),1)],2)):((0,n.openBlock)(),(0,n.createBlock)(c,{key:1,href:null!=e.item.route?a.route(e.item.route):"#",active:null!=e.item.route?(r=a.route().current(),l=e.item.route,!!l.includes(r)):"null"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(d,{class:(0,n.normalizeClass)("nav-icon"),icon:["fas",e.item.icon]},null,8,["icon"]),(0,n.createElementVNode)("p",null,(0,n.toDisplayString)(a.__(e.item.name)),1)]})),_:1},8,["href","active"])),null!=e.item.child&&0!=e.item.child.length?((0,n.openBlock)(),(0,n.createElementBlock)("ul",s,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(e.item.child,(function(e,t){return(0,n.openBlock)(),(0,n.createBlock)(i,{key:t,item:e,dropdown:e.route},null,8,["item","dropdown"])})),128))])):(0,n.createCommentVNode)("",!0)],2)):(0,n.createCommentVNode)("",!0)}}};var d={class:"main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand"},u={class:"brand-text font-weight-light app-name"},m=(0,n.createElementVNode)("div",{class:"clearfix"},null,-1),p={class:"sidebar os-host os-theme-light sidebar-initial-width"},f={class:"user-panel mt-3 pb-3 mb-3 d-flex"},h={class:"image"},v=["src"],b={class:"info"},k={class:"mt-2"};const g={__name:"Aside",setup:function(e){var t=(0,l.Fl)((function(){return storeData.getters.getAuthUser})),a=(0,l.Fl)((function(){return storeData.getters.getMenus})),r=(0,l.Fl)((function(){return(0,o.qt)().props.value.config.appName}));function c(){var e=$(".sidebar");$(".sidebar-mini").hasClass("sidebar-collapse")?e.addClass("sidebar-mini-new-width"):(e.removeClass("sidebar-initial-width"),e.addClass("expand-sideBar"))}function s(){var e=$(".sidebar");e.addClass("sidebar-initial-width"),e.removeClass("expand-sideBar"),e.hasClass("sidebar-mini-new-width")&&(e.removeClass("sidebar-mini-new-width"),e.addClass("sidebar-mini-initial-width"))}return(0,l.bv)((function(){storeData.dispatch("getUser"),storeData.dispatch("menuRequest",{id:t.value.id})})),(0,l.YP)((function(){return a.value}),(function(e){0==e.length&&storeData.dispatch("menuRequest",{id:t.value.id})}),{immediate:!0}),(0,l.YP)((function(){return t.value}),(function(e){""==e.id&&storeData.dispatch("getUser")}),{immediate:!0}),function(e,l){return(0,n.openBlock)(),(0,n.createElementBlock)("aside",d,[(0,n.createVNode)((0,n.unref)(o.rU),{href:e.route("dashboard"),class:"brand-link text-center"},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",u,(0,n.toDisplayString)((0,n.unref)(r)),1)]})),_:1},8,["href"]),m,(0,n.createElementVNode)("div",p,[(0,n.createElementVNode)("div",f,[(0,n.createElementVNode)("div",h,[(0,n.createElementVNode)("img",{src:e.$page.props.config.avatar,alt:"User Image",class:"img-circle elevation-2"},null,8,v)]),(0,n.createElementVNode)("div",b,[(0,n.createVNode)((0,n.unref)(o.rU),{href:e.route("user.profile"),class:"d-block"},{default:(0,n.withCtx)((function(){return[(0,n.createTextVNode)((0,n.toDisplayString)((0,n.unref)(t).name),1)]})),_:1},8,["href"])])]),(0,n.createElementVNode)("nav",k,[(0,n.createElementVNode)("ul",{class:"nav nav-pills nav-sidebar flex-column mcd-menu",onMouseover:c,onMouseleave:s,"data-widget":"treeview",role:"menu","data-accordion":"false"},[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(a),(function(e,t){return(0,n.openBlock)(),(0,n.createBlock)(i,{key:t,item:e},null,8,["item"])})),128))],32)])])])}}};var V=a(3379),N=a.n(V),y=a(1054),w={insert:"head",singleton:!1};N()(y.Z,w);y.Z.locals;const E=g;var C=a(9680),B={class:"position-absolute overlay-loader-wrapper"},x=[(0,n.createStaticVNode)('<span class="spinner-bounce d-flex align-items-center justify-content-center h-100" data-v-1588ef18><span class="bounce1 mr-1" data-v-1588ef18></span><span class="bounce2 mr-1" data-v-1588ef18></span><span class="bounce3 mr-1" data-v-1588ef18></span><span class="bounce4" data-v-1588ef18></span></span>',1)];var _=a(3347),S={insert:"head",singleton:!1};N()(_.Z,S);_.Z.locals;const D={},Z=(0,a(3744).Z)(D,[["render",function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("div",B,x)}],["__scopeId","data-v-1588ef18"]]);var F={class:"wrapper"},T={class:"main-header navbar navbar-expand navbar-white navbar-light"},U={class:"navbar-nav"},I={class:"nav-item nav-toggle-button"},A={class:"navbar-nav ml-auto"},j=(0,n.createElementVNode)("li",{class:"nav-item"},[(0,n.createElementVNode)("a",{class:"nav-link","data-widget":"fullscreen",href:"#",role:"button"},[(0,n.createElementVNode)("i",{class:"fas fa-expand-arrows-alt"})])],-1),O={class:"nav-item"},P={class:"content-wrapper"},H=(0,n.createElementVNode)("footer",{class:"main-footer"},[(0,n.createElementVNode)("div",{class:"float-right d-none d-sm-block"},[(0,n.createElementVNode)("b",null,"Version"),(0,n.createTextVNode)(" 1.0.0")]),(0,n.createElementVNode)("strong",null,[(0,n.createTextVNode)("Copyright © 2022 "),(0,n.createElementVNode)("a",{href:"#"},"oxFam"),(0,n.createTextVNode)(".")]),(0,n.createTextVNode)(" All rights reserved. ")],-1);const L={__name:"Authenticated",setup:function(e){function t(){var e=$(".sidebar");250==$(".main-sidebar").width()&&window.innerWidth>768?(e.removeClass("sidebar-initial-width"),e.addClass("sidebar-mini-initial-width")):(e.removeClass("sidebar-mini-initial-width"),e.addClass("sidebar-initial-width"))}var a=(0,n.reactive)({isPreloader:!1});return C.Inertia.on("start",(function(e){e.detail.visit;a.isPreloader=!0})),C.Inertia.on("finish",(function(e){e.detail.visit;a.isPreloader=!1})),function(e,o){var l=(0,n.resolveComponent)("font-awesome-icon");return(0,n.openBlock)(),(0,n.createElementBlock)("div",null,[(0,n.createElementVNode)("div",F,[(0,n.createElementVNode)("nav",T,[(0,n.createElementVNode)("ul",U,[(0,n.createElementVNode)("li",I,[(0,n.createElementVNode)("a",{class:"nav-link","data-widget":"pushmenu",href:"#",role:"button",onClick:t},[(0,n.createVNode)(l,{icon:["fas","bars"]})])])]),(0,n.createElementVNode)("ul",A,[j,(0,n.createElementVNode)("li",O,[(0,n.createVNode)(r,{href:e.route("logout"),method:"post"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(l,{icon:["fas","right-from-bracket"]}),(0,n.createTextVNode)(" "+(0,n.toDisplayString)(e.__("message.Logout")),1)]})),_:1},8,["href"])])])]),(0,n.createVNode)(E),(0,n.createElementVNode)("div",P,[(0,n.unref)(a).isPreloader?((0,n.openBlock)(),(0,n.createBlock)(Z,{key:0})):(0,n.createCommentVNode)("",!0),(0,n.renderSlot)(e.$slots,"default")]),H])])}}}},7103:(e,t,a)=>{a.r(t),a.d(t,{default:()=>l});var n=a(6598),o=a(537),r=a(8962);const l={__name:"AFAPieChart",setup:function(e){var t={labels:["IOM","UNHCR","UNICEF"],datasets:[{backgroundColor:["#41B883","#E46651","#00D8FF"],data:[40,20,80]}]};return function(e,a){return(0,n.openBlock)(),(0,n.createBlock)(r.Z,{title:"Per AFA",showHeader:!0},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(o.Z,{"chart-data":t})]})),_:1})}}}},1883:(e,t,a)=>{a.r(t),a.d(t,{default:()=>s});var n=a(6598),o=a(3764),r=a(6300);const l={__name:"StackedChart",props:{chartId:{type:String,default:"bar-chart"},datasetIdKey:{type:String,default:"label"},width:{type:Number,default:400},height:{type:Number,default:300},cssClasses:{default:"",type:String},styles:{type:Object,default:function(){}},plugins:{type:Object,default:function(){}},chartData:{type:Object,default:function(){}},chartOptions:{type:Object,default:function(){return{responsive:!0,maintainAspectRatio:!1}}}},setup:function(e){return r.kL.register(r.Dx,r.u,r.De,r.ZL,r.uw,r.f$),function(t,a){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(o.$Q),{"chart-options":e.chartOptions,"chart-data":e.chartData,"chart-id":e.chartId,"dataset-id-key":e.datasetIdKey,plugins:e.plugins,"css-classes":e.cssClasses,styles:e.styles,width:e.width,height:e.height},null,8,["chart-options","chart-data","chart-id","dataset-id-key","plugins","css-classes","styles","width","height"])}}};var c=a(8962);const s={__name:"FirstStackedChart",setup:function(e){var t={labels:["January","February","March"],datasets:[{data:[10,20,30],label:"2021",backgroundColor:"#ffe100",stack:"stack 1"},{data:[15,30,50],label:"2021 Total",backgroundColor:"#ee0000",stack:"stack 1"},{data:[6,19,50],label:"2022 YTD",backgroundColor:"#555555",stack:"stack 1"}]};return function(e,a){return(0,n.openBlock)(),(0,n.createBlock)(c.Z,{title:"Stacked Chart",showHeader:!0},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(l,{"chart-data":t})]})),_:1})}}}},4556:(e,t,a)=>{a.r(t),a.d(t,{default:()=>l});var n=a(6598),o=a(537),r=a(8962);const l={__name:"SecondPieChart",setup:function(e){var t={labels:["HouseHold","Source"],datasets:[{backgroundColor:["#41B883","#E46651"],data:[40,20]}]};return function(e,a){return(0,n.openBlock)(),(0,n.createBlock)(r.Z,{title:" Water Samples at Household and Source Level",showHeader:!0},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(o.Z,{"chart-data":t})]})),_:1})}}}},7664:(e,t,a)=>{a.r(t),a.d(t,{default:()=>l});var n=a(6598),o=a(537),r=a(8962);const l={__name:"ThirdPieChart",setup:function(e){var t={labels:["HandPump","RawWater","BottledWater"],datasets:[{backgroundColor:["#41B883","#E46651","#00D8FF"],data:[40,20,50]}]};return function(e,a){return(0,n.openBlock)(),(0,n.createBlock)(r.Z,{title:" Water Samples at Household and Source Level",showHeader:!0},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(o.Z,{"chart-data":t})]})),_:1})}}}},6434:(e,t,a)=>{a.r(t),a.d(t,{default:()=>p});var n=a(6598),o=a(1329),r=(a(7887),a(9018),a(9680)),l=a(2262),c=a(4075),s={class:"col-3"},i={class:"col-3"},d={class:"col-3"},u={class:"col-3"},m={class:"col-3"};const p={__name:"Filter",props:{camps:Object,blocks:Object},setup:function(e){var t,a,p,f,h,v,b,k=e,g=(0,l.qj)({page:null!==(t=route().params.page)&&void 0!==t?t:1,sort:null!==(a=route().params.sort)&&void 0!==a?a:"desc",name:null!==(p=route().params.name)&&void 0!==p?p:"id",max_count:null!==(f=route().params.max_count)&&void 0!==f?f:10,search:null!==(h=route().params.search)&&void 0!==h?h:"",camp:null!==(v=route().params.camp)&&void 0!==v?v:"",block:null!==(b=route().params.block)&&void 0!==b?b:""}),V=(0,l.qj)({campBlocks:k.blocks}),N=function(e){g.search=e,r.Inertia.get("agency",g,{preserveState:!0})};return function(t,a){var r=(0,n.resolveComponent)("multi-select");return(0,n.openBlock)(),(0,n.createBlock)(c.Z,{onFilterTable:N,"show-search":!1,placeholder:"Agency Name || Contact Person || Email || Mobile"},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",s,[(0,n.createVNode)(o.Z,{for:"year",value:"Year"}),(0,n.createVNode)(r,{modelValue:(0,n.unref)(g).block,"onUpdate:modelValue":a[0]||(a[0]=function(e){return(0,n.unref)(g).block=e}),options:[],placeholder:"Choose a year",searchable:!0},null,8,["modelValue"])]),(0,n.createElementVNode)("div",i,[(0,n.createVNode)(o.Z,{for:"month",value:"Month"}),(0,n.createVNode)(r,{modelValue:(0,n.unref)(g).block,"onUpdate:modelValue":a[1]||(a[1]=function(e){return(0,n.unref)(g).block=e}),options:[],placeholder:"Choose a Month",searchable:!0},null,8,["modelValue"])]),(0,n.createElementVNode)("div",d,[(0,n.createVNode)(o.Z,{for:"camp",value:"Camp"}),(0,n.createVNode)(r,{modelValue:(0,n.unref)(g).camp,"onUpdate:modelValue":a[2]||(a[2]=function(e){return(0,n.unref)(g).camp=e}),onChange:a[3]||(a[3]=function(e){return function(e){if(null!=e&&(g.block="",V.campBlocks=k.blocks.filter((function(t){return e==t.camp_id}))),null!=e&&0==V.campBlocks.length){g.block="";var t={params:{camp_id:e}};axios.get("ajax/block-details",t).then((function(e){V.campBlocks=e.data})).catch((function(e){toast.warning(e)}))}}(e)}),options:e.camps,placeholder:"Choose a camp",searchable:!0},null,8,["modelValue","options"])]),(0,n.createElementVNode)("div",u,[(0,n.createVNode)(o.Z,{for:"block",value:"Block"}),(0,n.createVNode)(r,{modelValue:(0,n.unref)(g).block,"onUpdate:modelValue":a[4]||(a[4]=function(e){return(0,n.unref)(g).block=e}),options:(0,n.unref)(V).campBlocks,placeholder:"Choose a block",searchable:!0},null,8,["modelValue","options"])]),(0,n.createElementVNode)("div",m,[(0,n.createVNode)(o.Z,{for:"agency",value:"Agency"}),(0,n.createVNode)(r,{modelValue:(0,n.unref)(g).block,"onUpdate:modelValue":a[5]||(a[5]=function(e){return(0,n.unref)(g).block=e}),options:(0,n.unref)(V).campBlocks,placeholder:"Choose a Agency",searchable:!0},null,8,["modelValue","options"])])]})),_:1})}}}},9376:(e,t,a)=>{a.r(t),a.d(t,{default:()=>F});var n=a(6598),o=a(6485),r=a(9038),l=a(8059),c={class:"info-box"},s={class:"info-box-content"},i={class:"info-box-text"},d={class:"info-box-number"};const u={__name:"Widget",props:{title:{type:String,default:null},icon:{type:String,default:null},value:{type:Number,default:0},backgroundColor:{default:"bg-info"}},setup:function(e){return function(t,a){var o=(0,n.resolveComponent)("font-awesome-icon");return(0,n.openBlock)(),(0,n.createElementBlock)("div",c,[(0,n.createElementVNode)("span",{class:(0,n.normalizeClass)(["info-box-icon",e.backgroundColor])},[(0,n.createVNode)(o,{class:(0,n.normalizeClass)("nav-icon"),icon:["fas",e.icon]},null,8,["icon"])],2),(0,n.createElementVNode)("div",s,[(0,n.createElementVNode)("span",i,(0,n.toDisplayString)(e.title),1),(0,n.createElementVNode)("span",d,(0,n.toDisplayString)(e.value),1)])])}}};var m=a(6434),p=(a(8962),a(7103)),f=a(4556),h=a(7664),v=a(1883),b={class:"content"},k={class:"container-fluid"},g={class:"row"},V={class:"col-md-2 col-sm-6 col-12"},N={class:"col-md-2 col-sm-6 col-12"},y={class:"col-md-2 col-sm-6 col-12"},w={class:"col-md-2 col-sm-6 col-12"},E={class:"col-md-2 col-sm-6 col-12"},C={class:"col-md-2 col-sm-6 col-12"},B={class:"row"},x={class:"col-md-3"},_={class:"col-md-3"},S={class:"col-md-3"},D={class:"row"},Z={class:"col-md-4"};const F={__name:"Index",props:{camps:{type:Number,default:0},blocks:{default:0},sanitationZones:{default:0},latrines:{default:0},agencies:{default:0},teams:{default:0},users:{default:0}},setup:function(e){return function(t,a){return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[(0,n.createVNode)((0,n.unref)(r.Fb),{title:"Dashboard"}),(0,n.createVNode)(o.Z,null,{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(l.Z,{icon:"border-all",title:"Dashboard"}),(0,n.createElementVNode)("section",b,[(0,n.createElementVNode)("div",k,[(0,n.createElementVNode)("div",g,[(0,n.createElementVNode)("div",V,[(0,n.createVNode)(u,{title:"Camps",icon:"campground","background-color":"bg-primary",value:e.camps},null,8,["value"])]),(0,n.createElementVNode)("div",N,[(0,n.createVNode)(u,{title:"Blocks",icon:"map",value:e.blocks},null,8,["value"])]),(0,n.createElementVNode)("div",y,[(0,n.createVNode)(u,{title:"Latrines",icon:"toilet","background-color":"bg-success",value:e.latrines},null,8,["value"])]),(0,n.createElementVNode)("div",w,[(0,n.createVNode)(u,{title:"Agencies",icon:"house","background-color":"bg-warning",value:e.agencies},null,8,["value"])]),(0,n.createElementVNode)("div",E,[(0,n.createVNode)(u,{title:"Teams",icon:"people-group","background-color":"bg-secondary",value:e.teams},null,8,["value"])]),(0,n.createElementVNode)("div",C,[(0,n.createVNode)(u,{title:"Users",icon:"users","background-color":"bg-danger",value:e.users},null,8,["value"])])])]),(0,n.createVNode)(m.default,{camps:[],blocks:[]}),(0,n.createElementVNode)("div",B,[(0,n.createElementVNode)("div",x,[(0,n.createVNode)(p.default)]),(0,n.createElementVNode)("div",_,[(0,n.createVNode)(f.default)]),(0,n.createElementVNode)("div",S,[(0,n.createVNode)(h.default)])]),(0,n.createElementVNode)("div",D,[(0,n.createElementVNode)("div",Z,[(0,n.createVNode)(v.default)])])])]})),_:1})],64)}}}}}]);