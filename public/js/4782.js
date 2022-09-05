"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[4782,6952],{1054:(e,t,a)=>{a.d(t,{Z:()=>o});var n=a(3645),r=a.n(n)()((function(e){return e[1]}));r.push([e.id,".brand-link{background:#61a534;padding:0}.brand-link .brand-image{float:none;max-height:60px}.app-name{padding:.8rem}",""]);const o=r},3347:(e,t,a)=>{a.d(t,{Z:()=>o});var n=a(3645),r=a.n(n)()((function(e){return e[1]}));r.push([e.id,".spinner-bounce>span[data-v-1588ef18]{-webkit-animation:bounceDelay-1588ef18 1.4s ease-in-out infinite both;animation:bounceDelay-1588ef18 1.4s ease-in-out infinite both;background-color:#e6e6e6;border-radius:100%;display:inline-block;height:9px;width:9px}.spinner-bounce>span.bounce1[data-v-1588ef18]{-webkit-animation-delay:-.32s;animation-delay:-.32s}.spinner-bounce>span.bounce2[data-v-1588ef18]{-webkit-animation-delay:-.16s;animation-delay:-.16s}.overlay-loader-wrapper[data-v-1588ef18]{background:hsla(0,0%,100%,.4);border-radius:.25rem;bottom:0;height:100%;left:0;right:0;top:0;width:100vw;z-index:10000}.overlay-loader-wrapper .spinner-bounce>span[data-v-1588ef18]{background-color:#61a534;height:11px;width:11px}@-webkit-keyframes bounceDelay-1588ef18{0%,80%,to{-webkit-transform:scale(0)}40%{-webkit-transform:scale(1)}}@keyframes bounceDelay-1588ef18{0%,80%,to{transform:scale(0)}40%{transform:scale(1)}}",""]);const o=r},3150:(e,t,a)=>{a.d(t,{Z:()=>o});var n=a(3645),r=a.n(n)()((function(e){return e[1]}));r.push([e.id,".header-cursor{cursor:pointer}",""]);const o=r},8059:(e,t,a)=>{a.d(t,{Z:()=>c});var n=a(6598),r=a(9038),o={class:"navbar sticky-top navbar-expand-lg navbar-dark bg-dark mb-3 pl-4"},l=(0,n.createElementVNode)("button",{class:"navbar-toggler",type:"button","data-toggle":"collapse","data-target":"#navbarText","aria-controls":"navbarText","aria-expanded":"false","aria-label":"Toggle navigation"},[(0,n.createElementVNode)("span",{class:"navbar-toggler-icon"})],-1);const c={__name:"Breadcrumb",props:{icon:{type:String,required:!1},title:{type:String,required:!1},route:{type:String,required:!1}},setup:function(e){var t,a,c,s=e,i=(0,n.reactive)({icon:null!==(t=s.icon)&&void 0!==t?t:"",title:null!==(a=s.title)&&void 0!==a?a:"",route:null!==(c=s.route)&&void 0!==c?c:""});return function(e,t){var a=(0,n.resolveComponent)("font-awesome-icon");return(0,n.openBlock)(),(0,n.createElementBlock)("nav",o,[(0,n.createVNode)((0,n.unref)(r.rU),{href:i.route,class:"navbar-brand",style:{color:"#222d32"}},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(a,{icon:["fas","".concat(i.icon)],class:"mr-3"},null,8,["icon"]),(0,n.createTextVNode)(" "+(0,n.toDisplayString)(i.title),1)]})),_:1},8,["href"]),l])}}}},9018:(e,t,a)=>{a.d(t,{Z:()=>o});var n=a(6598),r=["type"];const o={__name:"Button",props:{type:{type:String,default:"submit"},classes:{type:String,default:" focus:shadow-outline-gray transition ease-in-out duration-150"}},setup:function(e){return function(t,a){return(0,n.openBlock)(),(0,n.createElementBlock)("button",{type:e.type,class:(0,n.normalizeClass)(e.classes)},[(0,n.renderSlot)(t.$slots,"default")],10,r)}}}},8962:(e,t,a)=>{a.d(t,{Z:()=>i});var n=a(6598),r=a(2262),o={class:"card"},l={key:0,class:"card-header"},c={class:"card-title text-bold"},s={class:"card-body"};const i={__name:"Card",props:{title:{type:String,default:"Card Title"},showHeader:{type:Boolean,default:!1}},setup:function(e){var t=function(){a.fullscreen=!a.fullscreen},a=(0,r.qj)({fullscreen:!1});return function(r,i){var u=(0,n.resolveComponent)("font-awesome-icon"),d=(0,n.resolveComponent)("fullscreen");return(0,n.openBlock)(),(0,n.createBlock)(d,{modelValue:(0,n.unref)(a).fullscreen,"onUpdate:modelValue":i[0]||(i[0]=function(e){return(0,n.unref)(a).fullscreen=e}),"page-only":(0,n.unref)(a).pageOnly},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",o,[e.showHeader?((0,n.openBlock)(),(0,n.createElementBlock)("div",l,[(0,n.createElementVNode)("h3",c,(0,n.toDisplayString)(e.title),1),(0,n.createElementVNode)("button",{class:"float-right btn btn-danger btn-sm",onClick:t},[(0,n.createVNode)(u,{icon:["fas","expand"]})])])):(0,n.createCommentVNode)("",!0),(0,n.createElementVNode)("div",s,[(0,n.renderSlot)(r.$slots,"default")])])]})),_:3},8,["modelValue","page-only"])}}}},7887:(e,t,a)=>{a.d(t,{Z:()=>o});var n=a(6598),r=["value","id","type","placeholder","autocomplete","step","readonly"];const o={__name:"Input",props:["modelValue","error","value","class","type","id","type","step","placeholder","autocomplete","readonly"],emits:["update:modelValue","getUserData"],setup:function(e){var t=e,a=(0,n.ref)(null);(0,n.onMounted)((function(){a.value.hasAttribute("autofocus")&&a.value.focus()}));var o=(0,n.computed)((function(){return null!=t.error?t.class+" is-invalid":t.class}));return function(t,l){var c;return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[(0,n.createElementVNode)("input",(0,n.mergeProps)({class:(0,n.unref)(o),value:null!==(c=e.value)&&void 0!==c?c:e.modelValue,onInput:l[0]||(l[0]=function(e){return t.$emit("update:modelValue",e.target.value)}),ref_key:"input",ref:a,id:e.id,type:e.type,autofocus:"",placeholder:e.placeholder,autocomplete:e.autocomplete,onChange:l[1]||(l[1]=function(e){return t.$emit("getUserData")}),step:e.step,readonly:e.readonly},t.$attrs),null,16,r),(0,n.withDirectives)((0,n.createElementVNode)("span",{class:"text-danger"},(0,n.toDisplayString)(e.error),513),[[n.vShow,e.error]])],64)}}}},1329:(e,t,a)=>{a.d(t,{Z:()=>c});var n=a(6598),r={class:"block font-medium text-sm text-gray-700"},o={key:0},l={key:1};const c={__name:"Label",props:["value"],setup:function(e){return function(t,a){return(0,n.openBlock)(),(0,n.createElementBlock)("label",r,[e.value?((0,n.openBlock)(),(0,n.createElementBlock)("span",o,(0,n.toDisplayString)(e.value),1)):((0,n.openBlock)(),(0,n.createElementBlock)("span",l,[(0,n.renderSlot)(t.$slots,"default")]))])}}}},2437:(e,t,a)=>{a.d(t,{Z:()=>ee});var n=a(6598),r=a(9038),o=a(9018),l=a(2262),c=a(6252),s={class:"form-group"},i=["onClick"],u=["checked","id"],d=["for"];const m={__name:"Switch",props:{routeName:{type:String,required:!0},data:{type:Object,required:!0}},setup:function(e){var t=e,a=(0,l.iH)(["latrine","team","agency","user","role","inspection","complaint","setup.block"]),o=(0,c.Fl)((function(){return t.data})),m=(0,r.cI)(o.value),p=function(){if(confirm("Are you sure?")){var e=t.routeName+(a.value.includes(t.routeName)?".status":".update");o.value.active=m.active=!o.value.active,m.put(route(e,o.value.id),{preserveScroll:!0,onSuccess:function(e){e.props.flash&&null!=e.props.flash.message?toast.warning(e.props.flash.message):toast.success("".concat(t.routeName," status updated successfully!"))}})}};return function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("div",s,[(0,n.createElementVNode)("div",{class:"custom-control custom-switch custom-switch-off-danger custom-switch-on-success",onClick:(0,n.withModifiers)(p,["prevent"])},[(0,n.createElementVNode)("input",{type:"checkbox",class:"custom-control-input",checked:(0,n.unref)(o).active,id:"customSwitch"+(0,n.unref)(o).id},null,8,u),(0,n.createElementVNode)("label",{class:"custom-control-label",for:"customSwitch"+(0,n.unref)(o).id},null,8,d)],8,i)])}}};var p=a(9680);function f(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function v(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?f(Object(a),!0).forEach((function(t){h(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):f(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function h(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}var k={"aria-label":"Page navigation",class:"align-items-center"},b={class:"pagination"},g=[(0,n.createElementVNode)("span",{"aria-hidden":"true"},"Previous",-1)],y=["onClick"],N=[(0,n.createElementVNode)("span",{"aria-hidden":"true"},"Next",-1)];const V={__name:"CustomPagination",props:{initialData:{type:Object,required:!0},queryParams:{type:Object,required:!0},dataSet:{type:Object,required:!0},routeName:{type:String,required:!0}},setup:function(e){var t=e,a=(0,n.computed)((function(){return t.initialData.currentPage>1?"":"disabled"})),r=(0,n.computed)((function(){return t.initialData.currentPage>=t.initialData.lastPage?"disabled":""})),o=function(e){!function(e){t.queryParams=v(v({},t.queryParams),route().params),t.queryParams.page=e;var a=route("".concat(t.routeName,".index"),t.queryParams);p.Inertia.get(a,t.queryParams,{preserveState:!0})}(e)},l=(0,n.computed)((function(){var e=[],a=t.dataSet.current_page-Math.floor(5);a<1&&(a=1);var n=a+10-1;for(n>t.dataSet.last_page&&(n=t.dataSet.last_page);a<=n;)e.push(a),a++;return e}));return function(e,c){return(0,n.openBlock)(),(0,n.createElementBlock)("nav",k,[(0,n.createElementVNode)("ul",b,[(0,n.createElementVNode)("li",{class:(0,n.normalizeClass)("page-item me-3 ".concat((0,n.unref)(a)))},[(0,n.createElementVNode)("a",{class:"page-link",href:"#","aria-label":"Previous",onClick:c[0]||(c[0]=(0,n.withModifiers)((function(e){return o((0,n.unref)(t).initialData.currentPage-1)}),["prevent"]))},g)],2),((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(l),(function(e,a){return(0,n.openBlock)(),(0,n.createElementBlock)("li",{key:a,class:(0,n.normalizeClass)("page-item ".concat((0,n.unref)(t).initialData.currentPage==e?"active":""))},[(0,n.createElementVNode)("a",{class:"page-link",href:"#","aria-label":"Previous",onClick:(0,n.withModifiers)((function(t){return o(e)}),["prevent"])},(0,n.toDisplayString)(e),9,y)],2)})),128)),(0,n.createElementVNode)("li",{class:(0,n.normalizeClass)("page-item ".concat((0,n.unref)(r)))},[(0,n.createElementVNode)("a",{class:"page-link",href:"#","aria-label":"Next",onClick:c[1]||(c[1]=(0,n.withModifiers)((function(e){return o((0,n.unref)(t).initialData.currentPage+1)}),["prevent"]))},N)],2)])])}}};function w(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function B(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?w(Object(a),!0).forEach((function(t){E(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):w(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function E(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}var C={key:0,class:"row"},x={class:"col-md-12 text-right"},_=(0,n.createTextVNode)(" Create "),S={options:{select:!0},class:"table table-striped table-hover display"},D={class:"table-header"},P=["onClick"],O={key:0,class:"ml-1"},j={key:0,scope:"col",class:"text-center",style:{width:"110px"}},q={key:1,scope:"col",class:"text-center",style:{width:"110px"}},Z={key:0},L=["innerHTML"],T={key:1},F={key:0,class:"text-center"},A={key:1,scope:"col",class:"text-center"},U={key:1},$=["colspan"],I={key:1,class:"d-flex justify-content-between bd-highlight"},z={class:"p-2 bd-highlight ml-2"},M={class:"row"},R=(0,n.createElementVNode)("div",null,"Rows per page:",-1),H={class:"mx-2"},K=["value","selected"],Y={key:0,class:"p-2 bd-highlight"};const W={__name:"Table",props:{nonDestroyId:{type:Array,required:!1},routeName:{type:String,required:!0},showCreateButton:{type:Boolean,default:!0},modal:{type:Boolean,required:!0,default:!1},header:{type:Object,required:!0,default:[{title:"Id",type:"text",key:"id"},{title:"Name",type:"text",key:"name"}]},showAction:{type:Boolean,required:!0,default:!0},actions:{type:Array,required:!1,default:["show","edit","destroy"]},dataSet:{type:Object,required:!0,default:null},deleteMessage:{type:String,required:!0,default:"Are you sure you want to delete this item?"}},setup:function(e){var t,a=e,l=[10,25,50,100],c=(0,n.reactive)({route:["role","user"],id:null!==(t=a.nonDestroyId)&&void 0!==t?t:[]}),s=(0,n.reactive)({currentPage:0,lastPage:1,totalRow:0,limit:0,dataList:[]}),i=(0,n.reactive)({page:null,max_count:10,sort:"desc",name:"id"});(0,n.watch)((function(){return a.dataSet}),(function(e){void 0!==e.data?(s.dataList=e.data,s.currentPage=e.current_page,s.lastPage=e.last_page,s.totalRow=e.total,s.limit=e.per_page):s.dataList=e}),{immediate:!0});return function(t,u){var d=(0,n.resolveComponent)("font-awesome-icon");return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[e.showCreateButton&&e.actions.includes("create")?((0,n.openBlock)(),(0,n.createElementBlock)("div",C,[(0,n.createElementVNode)("div",x,[(0,n.createVNode)((0,n.unref)(r.rU),{class:(0,n.normalizeClass)("btn btn-info btn-sm"),href:t.route("".concat(e.routeName,".create"))},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(d,{icon:["fas","plus"]}),_]})),_:1},8,["href"])])])):(0,n.createCommentVNode)("",!0),(0,n.createElementVNode)("div",{class:(0,n.normalizeClass)(["table-responsive",e.showCreateButton&&e.actions.includes("create")?"mt-3":""])},[(0,n.createElementVNode)("table",S,[(0,n.createElementVNode)("thead",D,[(0,n.createElementVNode)("tr",null,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(e.header,(function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("th",{key:"-head-"+t,scope:"col",class:(0,n.normalizeClass)("".concat(e.sort?"header-cursor":"")),onClick:function(t){return function(e){if(e.sort){var t;(i=B(B({},i),route().params)).name=null!==(t=e.sortBy)&&void 0!==t?t:e.key,i.sort="desc"==i.sort?"asc":"desc";var n=route("".concat(a.routeName,".index"),i);p.Inertia.get(n,{preserveState:!0})}}(e)}},[(0,n.createElementVNode)("span",null,(0,n.toDisplayString)(e.title),1),e.sort?((0,n.openBlock)(),(0,n.createElementBlock)("span",O,[(0,n.createVNode)(d,{icon:["fas","sort"]})])):(0,n.createCommentVNode)("",!0)],10,P)})),128)),e.showAction&&e.actions.includes("status")?((0,n.openBlock)(),(0,n.createElementBlock)("th",j," Status ")):(0,n.createCommentVNode)("",!0),e.showAction&&(e.actions.includes("show")||e.actions.includes("edit")||e.actions.includes("destroy"))?((0,n.openBlock)(),(0,n.createElementBlock)("th",q," Actions ")):(0,n.createCommentVNode)("",!0)])]),(0,n.unref)(s).dataList&&(0,n.unref)(s).dataList.length>0?((0,n.openBlock)(),(0,n.createElementBlock)("tbody",Z,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(s).dataList,(function(l,s){return(0,n.openBlock)(),(0,n.createElementBlock)("tr",{key:"-row-"+s},[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(e.header,(function(e,t){var a;return(0,n.openBlock)(),(0,n.createElementBlock)("td",{key:t},["html"==e.type?((0,n.openBlock)(),(0,n.createElementBlock)("span",{key:0,innerHTML:e.modifier(l[e.key],l)},null,8,L)):((0,n.openBlock)(),(0,n.createElementBlock)("span",T,(0,n.toDisplayString)(null!==(a=l[e.key])&&void 0!==a?a:"N/A"),1))])})),128)),e.showAction&&e.actions.includes("status")?((0,n.openBlock)(),(0,n.createElementBlock)("td",F,[(0,n.createVNode)(m,{index:s,data:l,"route-name":e.routeName},null,8,["index","data","route-name"])])):(0,n.createCommentVNode)("",!0),e.showAction?((0,n.openBlock)(),(0,n.createElementBlock)("td",A,[e.actions.includes("show")?((0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(r.rU),{key:0,class:(0,n.normalizeClass)("btn btn-outline-success btn-xs"),href:t.route("".concat(e.routeName,".show"),{id:l.id})},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(d,{icon:["fas","eye"]})]})),_:2},1032,["href"])):(0,n.createCommentVNode)("",!0),e.actions.includes("edit")?((0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(r.rU),{key:1,class:(0,n.normalizeClass)("btn btn-outline-primary btn-xs ml-2"),href:t.route("".concat(e.routeName,".edit"),{id:l.id})},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(d,{icon:["fas","file-pen"]})]})),_:2},1032,["href"])):(0,n.createCommentVNode)("",!0),!e.actions.includes("destroy")||c.route.includes(e.routeName)&&c.id.includes(l.id)?(0,n.createCommentVNode)("",!0):((0,n.openBlock)(),(0,n.createBlock)(o.Z,{key:2,class:(0,n.normalizeClass)("btn btn-outline-danger btn-xs ml-2"),onClick:function(e){return t=l.id,void(confirm(a.deleteMessage)&&p.Inertia.delete(route("".concat(a.routeName,".destroy"),t),{preserveScroll:!0,onSuccess:function(e){e.props.flash&&null!=e.props.flash.message?toast.warning(e.props.flash.message):toast.error("".concat(a.routeName," delete successfully!"))}}));var t}},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(d,{icon:["fas","trash"]})]})),_:2},1032,["onClick"]))])):(0,n.createCommentVNode)("",!0)])})),128))])):((0,n.openBlock)(),(0,n.createElementBlock)("tbody",U,[(0,n.createElementVNode)("tr",null,[(0,n.createElementVNode)("td",{class:"text-center text-danger",colspan:e.header.length+(e.showAction?e.actions.includes("status")?2:1:0)}," No Data Found ",8,$)])]))])],2),(0,n.unref)(s).dataList&&(0,n.unref)(s).dataList.length>0&&e.routeName?((0,n.openBlock)(),(0,n.createElementBlock)("div",I,[(0,n.createElementVNode)("div",z,[(0,n.createElementVNode)("div",M,[R,(0,n.createElementVNode)("div",H,[(0,n.createElementVNode)("select",{class:"form-control form-control-sm me-2","aria-label":"Default select",onChange:u[0]||(u[0]=function(e){return function(e){(i=B(B({},i),route().params)).max_count=e.target.value,i.page=1;var t=route("".concat(a.routeName,".index"),i);p.Inertia.get(t,{preserveState:!0})}(e)})},[((0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(l,(function(e,a){return(0,n.createElementVNode)("option",{key:"list-count-".concat(a),value:e,selected:e==t.route().params.max_count},(0,n.toDisplayString)(e),9,K)})),64))],32)]),(0,n.createElementVNode)("div",null," Showing "+(0,n.toDisplayString)(e.dataSet.from)+" to "+(0,n.toDisplayString)(e.dataSet.to)+" of "+(0,n.toDisplayString)(e.dataSet.total)+" entries ",1)])]),e.dataSet.links&&(0,n.unref)(s).currentPage>0?((0,n.openBlock)(),(0,n.createElementBlock)("div",Y,[(0,n.createVNode)(V,{queryParams:B(B({},(0,n.unref)(i)),t.route().params),initialData:(0,n.unref)(s),routeName:e.routeName,dataSet:e.dataSet},null,8,["queryParams","initialData","routeName","dataSet"])])):(0,n.createCommentVNode)("",!0)])):(0,n.createCommentVNode)("",!0)],64)}}};var G=a(3379),J=a.n(G),Q=a(3150),X={insert:"head",singleton:!1};J()(Q.Z,X);Q.Z.locals;const ee=W},4075:(e,t,a)=>{a.d(t,{Z:()=>E});var n=a(6598),r=a(2262),o=a(1329),l=a(7887),c=a(9018),s=a(9038),i={class:"row mt-2"},u={class:"col-md-12"},d={class:"card card-primary card-outline collapsed-card"},m={class:"card-header"},p={class:"card-title text-bold"},f={class:"mr-1"},v=(0,n.createTextVNode)(" Filter Data "),h={class:"card-tools"},k={class:"card-body"},b={class:"row"},g={key:0,class:"col-md-4"},y={key:0,class:"card-footer"},N={class:"mr-1"},V=(0,n.createTextVNode)(" SEARCH "),w={class:"mr-1"},B=(0,n.createTextVNode)(" RESET FILTER ");const E={__name:"TableFilter",props:{showSearch:{type:Boolean,default:!0},showSearchBtn:{type:Boolean,default:!0},showResetBtn:{type:Boolean,default:!1},resetLink:{type:String,default:""},showFooter:{type:Boolean,default:!0},label:{type:String,default:"Search"},placeholder:{type:String,default:"Search"}},setup:function(e){var t=(0,r.qj)({isExpanded:!1,search:""}),a=function(){t.isExpanded=!t.isExpanded};return function(r,E){var C=(0,n.resolveComponent)("font-awesome-icon");return(0,n.openBlock)(),(0,n.createElementBlock)("div",i,[(0,n.createElementVNode)("div",u,[(0,n.createElementVNode)("div",d,[(0,n.createElementVNode)("div",m,[(0,n.createElementVNode)("h3",p,[(0,n.createElementVNode)("span",f,[(0,n.createVNode)(C,{icon:["fas","arrow-down-wide-short"]})]),v]),(0,n.createElementVNode)("div",h,[(0,n.createElementVNode)("button",{type:"button",class:"btn btn-tool",onClick:a,"data-card-widget":"collapse",title:"Collapse"},[(0,n.createVNode)(C,{icon:["fas",(0,n.unref)(t).isExpanded?"minus":"plus"]},null,8,["icon"])])])]),(0,n.createElementVNode)("div",k,[(0,n.createElementVNode)("div",b,[(0,n.renderSlot)(r.$slots,"default"),e.showSearch?((0,n.openBlock)(),(0,n.createElementBlock)("div",g,[(0,n.createVNode)(o.Z,{for:"search",value:e.label},null,8,["value"]),(0,n.createVNode)(l.Z,{type:"text",class:"form-control",modelValue:(0,n.unref)(t).search,"onUpdate:modelValue":E[0]||(E[0]=function(e){return(0,n.unref)(t).search=e}),placeholder:e.placeholder,onKeyup:E[1]||(E[1]=(0,n.withKeys)((function(e){return r.$emit("filterTable",(0,n.unref)(t).search)}),["enter"]))},null,8,["modelValue","placeholder"])])):(0,n.createCommentVNode)("",!0)])]),e.showFooter?((0,n.openBlock)(),(0,n.createElementBlock)("div",y,[e.showSearchBtn?((0,n.openBlock)(),(0,n.createBlock)(c.Z,{key:0,type:"button",class:"btn btn-danger btn-sm float-right",onClick:E[2]||(E[2]=function(e){return r.$emit("filterTable",(0,n.unref)(t).search)})},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("span",N,[(0,n.createVNode)(C,{icon:["fas","magnifying-glass"]})]),V]})),_:1})):(0,n.createCommentVNode)("",!0),e.showResetBtn?((0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(s.rU),{key:1,type:"button",class:"btn btn-danger btn-sm float-right",href:e.resetLink},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("span",w,[(0,n.createVNode)(C,{icon:["fas","eraser"]})]),B]})),_:1},8,["href"])):(0,n.createCommentVNode)("",!0)])):(0,n.createCommentVNode)("",!0)])])])}}}},6485:(e,t,a)=>{a.d(t,{Z:()=>I});var n=a(6598),r=a(9038);const o={__name:"DropdownLink",setup:function(e){return function(e,t){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(r.rU),{class:"nav-link","data-widget":"control-sidebar","data-slide":"true",href:"#",role:"button"},{default:(0,n.withCtx)((function(){return[(0,n.renderSlot)(e.$slots,"default")]})),_:3})}}};var l=a(6252);const c={__name:"NavLink",props:["href","active"],setup:function(e){var t=e,a=(0,n.computed)((function(){return t.active?"nav-link active":"nav-link"}));function o(){var e=$(".sidebar-mini");e.hasClass("sidebar-open")&&(e.removeClass("sidebar-open"),e.addClass("sidebar-closed"),e.addClass("sidebar-collapse"))}return function(t,l){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(r.rU),{href:e.href,onClick:(0,n.withModifiers)(o,["prevent"]),class:(0,n.normalizeClass)((0,n.unref)(a))},{default:(0,n.withCtx)((function(){return[(0,n.renderSlot)(t.$slots,"default")]})),_:3},8,["href","onClick","class"])}}};var s={key:2,class:"nav nav-treeview"};const i={__name:"Dropdown",props:{item:Object,key:Number,dropdown:Object},setup:function(e){var t=function(e,t){if(null!=t)return!!(t=t.split("|")).includes(e)};return function(a,r){var o,l,u=(0,n.resolveComponent)("font-awesome-icon");return e.item.have_permission?((0,n.openBlock)(),(0,n.createElementBlock)("li",{key:0,class:(0,n.normalizeClass)(["nav-item",t(a.route().current(),e.item.route)?"menu-is-opening menu-open":" "])},[null!=e.item.child&&0!=e.item.child.length?((0,n.openBlock)(),(0,n.createElementBlock)("a",{key:0,class:(0,n.normalizeClass)(["nav-link",t(a.route().current(),e.item.route)?"active menu-open":" "]),href:"#"},[(0,n.createVNode)(u,{class:(0,n.normalizeClass)("nav-icon"),icon:["fas",e.item.icon]},null,8,["icon"]),(0,n.createElementVNode)("p",null,(0,n.toDisplayString)(a.__(e.item.name)),1)],2)):((0,n.openBlock)(),(0,n.createBlock)(c,{key:1,href:null!=e.item.route?a.route(e.item.route):"#",active:null!=e.item.route?(o=a.route().current(),l=e.item.route,!!l.includes(o)):"null"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(u,{class:(0,n.normalizeClass)("nav-icon"),icon:["fas",e.item.icon]},null,8,["icon"]),(0,n.createElementVNode)("p",null,(0,n.toDisplayString)(a.__(e.item.name)),1)]})),_:1},8,["href","active"])),null!=e.item.child&&0!=e.item.child.length?((0,n.openBlock)(),(0,n.createElementBlock)("ul",s,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(e.item.child,(function(e,t){return(0,n.openBlock)(),(0,n.createBlock)(i,{key:t,item:e,dropdown:e.route},null,8,["item","dropdown"])})),128))])):(0,n.createCommentVNode)("",!0)],2)):(0,n.createCommentVNode)("",!0)}}};var u={class:"main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand"},d={class:"brand-text font-weight-light app-name"},m=(0,n.createElementVNode)("div",{class:"clearfix"},null,-1),p={class:"sidebar os-host os-theme-light sidebar-initial-width"},f={class:"user-panel mt-3 pb-3 mb-3 d-flex"},v={class:"image"},h=["src"],k={class:"info"},b={class:"mt-2"};const g={__name:"Aside",setup:function(e){var t=(0,l.Fl)((function(){return storeData.getters.getAuthUser})),a=(0,l.Fl)((function(){return storeData.getters.getMenus})),o=(0,l.Fl)((function(){return(0,r.qt)().props.value.config.appName}));function c(){var e=$(".sidebar");$(".sidebar-mini").hasClass("sidebar-collapse")?e.addClass("sidebar-mini-new-width"):(e.removeClass("sidebar-initial-width"),e.addClass("expand-sideBar"))}function s(){var e=$(".sidebar");e.addClass("sidebar-initial-width"),e.removeClass("expand-sideBar"),e.hasClass("sidebar-mini-new-width")&&(e.removeClass("sidebar-mini-new-width"),e.addClass("sidebar-mini-initial-width"))}return(0,l.bv)((function(){storeData.dispatch("getUser"),storeData.dispatch("menuRequest",{id:t.value.id})})),(0,l.YP)((function(){return a.value}),(function(e){0==e.length&&storeData.dispatch("menuRequest",{id:t.value.id})}),{immediate:!0}),(0,l.YP)((function(){return t.value}),(function(e){""==e.id&&storeData.dispatch("getUser")}),{immediate:!0}),function(e,l){return(0,n.openBlock)(),(0,n.createElementBlock)("aside",u,[(0,n.createVNode)((0,n.unref)(r.rU),{href:e.route("dashboard"),class:"brand-link text-center"},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",d,(0,n.toDisplayString)((0,n.unref)(o)),1)]})),_:1},8,["href"]),m,(0,n.createElementVNode)("div",p,[(0,n.createElementVNode)("div",f,[(0,n.createElementVNode)("div",v,[(0,n.createElementVNode)("img",{src:e.$page.props.config.avatar,alt:"User Image",class:"img-circle elevation-2"},null,8,h)]),(0,n.createElementVNode)("div",k,[(0,n.createVNode)((0,n.unref)(r.rU),{href:e.route("user.profile"),class:"d-block"},{default:(0,n.withCtx)((function(){return[(0,n.createTextVNode)((0,n.toDisplayString)((0,n.unref)(t).name),1)]})),_:1},8,["href"])])]),(0,n.createElementVNode)("nav",b,[(0,n.createElementVNode)("ul",{class:"nav nav-pills nav-sidebar flex-column mcd-menu",onMouseover:c,onMouseleave:s,"data-widget":"treeview",role:"menu","data-accordion":"false"},[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(a),(function(e,t){return(0,n.openBlock)(),(0,n.createBlock)(i,{key:t,item:e},null,8,["item"])})),128))],32)])])])}}};var y=a(3379),N=a.n(y),V=a(1054),w={insert:"head",singleton:!1};N()(V.Z,w);V.Z.locals;const B=g;var E=a(9680),C={class:"position-absolute overlay-loader-wrapper"},x=[(0,n.createStaticVNode)('<span class="spinner-bounce d-flex align-items-center justify-content-center h-100" data-v-1588ef18><span class="bounce1 mr-1" data-v-1588ef18></span><span class="bounce2 mr-1" data-v-1588ef18></span><span class="bounce3 mr-1" data-v-1588ef18></span><span class="bounce4" data-v-1588ef18></span></span>',1)];var _=a(3347),S={insert:"head",singleton:!1};N()(_.Z,S);_.Z.locals;const D={},P=(0,a(3744).Z)(D,[["render",function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("div",C,x)}],["__scopeId","data-v-1588ef18"]]);var O={class:"wrapper"},j={class:"main-header navbar navbar-expand navbar-white navbar-light"},q={class:"navbar-nav"},Z={class:"nav-item nav-toggle-button"},L={class:"navbar-nav ml-auto"},T=(0,n.createElementVNode)("li",{class:"nav-item"},[(0,n.createElementVNode)("a",{class:"nav-link","data-widget":"fullscreen",href:"#",role:"button"},[(0,n.createElementVNode)("i",{class:"fas fa-expand-arrows-alt"})])],-1),F={class:"nav-item"},A={class:"content-wrapper"},U=(0,n.createElementVNode)("footer",{class:"main-footer"},[(0,n.createElementVNode)("div",{class:"float-right d-none d-sm-block"},[(0,n.createElementVNode)("b",null,"Version"),(0,n.createTextVNode)(" 1.0.0")]),(0,n.createElementVNode)("strong",null,[(0,n.createTextVNode)("Copyright © 2022 "),(0,n.createElementVNode)("a",{href:"#"},"oxFam"),(0,n.createTextVNode)(".")]),(0,n.createTextVNode)(" All rights reserved. ")],-1);const I={__name:"Authenticated",setup:function(e){function t(){var e=$(".sidebar");250==$(".main-sidebar").width()&&window.innerWidth>768?(e.removeClass("sidebar-initial-width"),e.addClass("sidebar-mini-initial-width")):(e.removeClass("sidebar-mini-initial-width"),e.addClass("sidebar-initial-width"))}var a=(0,n.reactive)({isPreloader:!1});return E.Inertia.on("start",(function(e){e.detail.visit;a.isPreloader=!0})),E.Inertia.on("finish",(function(e){e.detail.visit;a.isPreloader=!1})),function(e,r){var l=(0,n.resolveComponent)("font-awesome-icon");return(0,n.openBlock)(),(0,n.createElementBlock)("div",null,[(0,n.createElementVNode)("div",O,[(0,n.createElementVNode)("nav",j,[(0,n.createElementVNode)("ul",q,[(0,n.createElementVNode)("li",Z,[(0,n.createElementVNode)("a",{class:"nav-link","data-widget":"pushmenu",href:"#",role:"button",onClick:t},[(0,n.createVNode)(l,{icon:["fas","bars"]})])])]),(0,n.createElementVNode)("ul",L,[T,(0,n.createElementVNode)("li",F,[(0,n.createVNode)(o,{href:e.route("logout"),method:"post"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(l,{icon:["fas","right-from-bracket"]}),(0,n.createTextVNode)(" "+(0,n.toDisplayString)(e.__("message.Logout")),1)]})),_:1},8,["href"])])])]),(0,n.createVNode)(B),(0,n.createElementVNode)("div",A,[(0,n.unref)(a).isPreloader?((0,n.openBlock)(),(0,n.createBlock)(P,{key:0})):(0,n.createCommentVNode)("",!0),(0,n.renderSlot)(e.$slots,"default")]),U])])}}}},6952:(e,t,a)=>{a.r(t),a.d(t,{default:()=>u});var n=a(6598),r=a(1329),o=(a(7887),a(9018),a(9680)),l=a(2262),c=a(4075),s={class:"col-md-4"},i={class:"col-md-4"};const u={__name:"Filter",props:{camps:Object,blocks:Object},setup:function(e){var t,a,u,d,m,p,f,v=e,h=(0,l.qj)({campBlocks:v.blocks}),k=(0,l.qj)({page:null!==(t=route().params.page)&&void 0!==t?t:1,sort:null!==(a=route().params.sort)&&void 0!==a?a:"desc",name:null!==(u=route().params.name)&&void 0!==u?u:"id",max_count:null!==(d=route().params.max_count)&&void 0!==d?d:10,search:null!==(m=route().params.search)&&void 0!==m?m:"",camp:null!==(p=route().params.camp)&&void 0!==p?p:"",block:null!==(f=route().params.block)&&void 0!==f?f:""}),b=function(e){k.search=e,o.Inertia.get("desludge",k,{preserveState:!0})};return function(t,a){var o=(0,n.resolveComponent)("multi-select");return(0,n.openBlock)(),(0,n.createBlock)(c.Z,{onFilterTable:b},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",s,[(0,n.createVNode)(r.Z,{for:"camp",value:"Camp"}),(0,n.createVNode)(o,{modelValue:(0,n.unref)(k).camp,"onUpdate:modelValue":a[0]||(a[0]=function(e){return(0,n.unref)(k).camp=e}),onChange:a[1]||(a[1]=function(e){return function(e){if(null!=e&&(k.block="",h.campBlocks=v.blocks.filter((function(t){return e==t.camp_id}))),null!=e&&0==h.campBlocks.length){var t={params:{camp_id:e}};k.block="",axios.get("latrine/create",t).then((function(e){h.campBlocks=e.data})).catch((function(e){toast.warning(e)}))}}(e)}),options:e.camps,placeholder:"Choose a camp",searchable:!0},null,8,["modelValue","options"])]),(0,n.createElementVNode)("div",i,[(0,n.createVNode)(r.Z,{for:"block",value:"Block"}),(0,n.createVNode)(o,{modelValue:(0,n.unref)(k).block,"onUpdate:modelValue":a[2]||(a[2]=function(e){return(0,n.unref)(k).block=e}),searchable:!0,options:(0,n.unref)(h).campBlocks,placeholder:"Choose a block"},null,8,["modelValue","options"])])]})),_:1})}}}},4782:(e,t,a)=>{a.r(t),a.d(t,{default:()=>m});var n=a(6598),r=a(9038),o=a(6485),l=a(8059),c=a(8962),s=a(2437),i=a(2262),u=a(6952),d={class:"content"};const m={__name:"index",props:{lists:{type:Array,default:[]},message:{type:String,default:null},access:{type:Array,default:[]},camps:Object,blocks:Object},setup:function(e){var t=(0,i.iH)([{title:"Id",type:"text",key:"id"},{title:"Latrine",type:"text",key:"uid_no"},{title:"Collection Date",type:"text",key:"collection_date_time"},{title:"Count Ring",type:"text",key:"count_desludge_ring"},{title:"Height From Top",type:"text",key:"desludged_height_from_top"},{title:"Total Volume",type:"text",key:"total_volume_desludged"},{title:"Petrol(l)",type:"text",key:"litre_of_petrol"},{title:"Status",type:"text",key:"status"}]);return function(a,i){return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[(0,n.createVNode)((0,n.unref)(r.Fb),{title:"Desludge List"}),(0,n.createVNode)(o.Z,null,{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(l.Z,{icon:"person-digging",title:"Desludge List",route:a.route("desludge.index")},null,8,["route"]),(0,n.createElementVNode)("section",d,[(0,n.createVNode)(c.Z,{title:"Desludge"},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(u.default,{camps:e.camps,blocks:e.blocks},null,8,["camps","blocks"]),(0,n.createVNode)(s.Z,{"route-name":"desludge",modal:!1,header:t.value,"data-set":e.lists,actions:e.access},null,8,["header","data-set","actions"])]})),_:1})])]})),_:1})],64)}}}}}]);