"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[2702],{791:(e,t,r)=>{r.d(t,{Z:()=>l});var n=r(3645),o=r.n(n)()((function(e){return e[1]}));o.push([e.id,".w-20{width:5rem}.height{height:5rem}",""]);const l=o},6949:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(6598),o=["src"];const l={},a=(0,r(3744).Z)(l,[["render",function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("img",{src:e.$page.props.config.logo,alt:"User Image",class:"img-circle elevation-2"},null,8,o)}]])},9018:(e,t,r)=>{r.d(t,{Z:()=>l});var n=r(6598),o=["type"];const l={__name:"Button",props:{type:{type:String,default:"submit"},classes:{type:String,default:" focus:shadow-outline-gray transition ease-in-out duration-150"}},setup:function(e){return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("button",{type:e.type,class:(0,n.normalizeClass)(e.classes)},[(0,n.renderSlot)(t.$slots,"default")],10,o)}}}},215:(e,t,r)=>{r.d(t,{Z:()=>c});var n=r(6598),o=(r(1329),{class:"form-check"}),l=["id"],a=["for"];const c={__name:"Checkbox",props:{checked:{type:[Array,Boolean],default:!1},value:{default:null},label_class:{type:String,default:"form-check-label"},class:String,error:Object,id:String,label:String},emits:["update:checked"],setup:function(e,t){var r=t.emit,c=e,s=(0,n.computed)({get:function(){return Boolean(c.checked)},set:function(e){r("update:checked",e)}}),u=(0,n.computed)((function(){return null!=c.error?c.class+" is-invalid":c.class}));return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("div",o,[(0,n.withDirectives)((0,n.createElementVNode)("input",{class:(0,n.normalizeClass)((0,n.unref)(u)),type:"checkbox",id:e.id,"onUpdate:modelValue":r[0]||(r[0]=function(e){return(0,n.isRef)(s)?s.value=e:null})},null,10,l),[[n.vModelCheckbox,(0,n.unref)(s)]]),(0,n.createElementVNode)("label",{class:(0,n.normalizeClass)(e.label_class),for:e.id},(0,n.toDisplayString)(e.label),11,a)])}}}},7887:(e,t,r)=>{r.d(t,{Z:()=>l});var n=r(6598),o=["value","id","type","placeholder","autocomplete","step"];const l={__name:"Input",props:["modelValue","error","class","type","id","type","step","placeholder","autocomplete"],emits:["update:modelValue","getUserData"],setup:function(e){var t=e,r=(0,n.ref)(null);(0,n.onMounted)((function(){r.value.hasAttribute("autofocus")&&r.value.focus()}));var l=(0,n.computed)((function(){return null!=t.error?t.class+" is-invalid":t.class}));return function(t,a){return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[(0,n.createElementVNode)("input",{class:(0,n.normalizeClass)((0,n.unref)(l)),value:e.modelValue,onInput:a[0]||(a[0]=function(e){return t.$emit("update:modelValue",e.target.value)}),ref_key:"input",ref:r,id:e.id,type:e.type,autofocus:"",placeholder:e.placeholder,autocomplete:e.autocomplete,onChange:a[1]||(a[1]=function(e){return t.$emit("getUserData")}),step:e.step},null,42,o),(0,n.withDirectives)((0,n.createElementVNode)("span",{class:"text-danger"},(0,n.toDisplayString)(e.error),513),[[n.vShow,e.error]])],64)}}}},1329:(e,t,r)=>{r.d(t,{Z:()=>c});var n=r(6598),o={class:"block font-medium text-sm text-gray-700"},l={key:0},a={key:1};const c={__name:"Label",props:["value"],setup:function(e){return function(t,r){return(0,n.openBlock)(),(0,n.createElementBlock)("label",o,[e.value?((0,n.openBlock)(),(0,n.createElementBlock)("span",l,(0,n.toDisplayString)(e.value),1)):((0,n.openBlock)(),(0,n.createElementBlock)("span",a,[(0,n.renderSlot)(t.$slots,"default")]))])}}}},5414:(e,t,r)=>{r.d(t,{Z:()=>s});var n=r(6598),o=r(9038),l={key:0},a=(0,n.createElementVNode)("div",{class:"font-medium text-danger"},"Whoops! Something went wrong.",-1),c={class:"mt-3 list-disc list-inside text-sm text-danger"};const s={__name:"ValidationErrors",setup:function(e){var t=(0,n.computed)((function(){return(0,o.qt)().props.value.errors})),r=(0,n.computed)((function(){return Object.keys(t.value).length>0}));return function(e,o){return(0,n.unref)(r)?((0,n.openBlock)(),(0,n.createElementBlock)("div",l,[a,(0,n.createElementVNode)("ul",c,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)((0,n.unref)(t),(function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("li",{key:t},(0,n.toDisplayString)(t)+" is "+(0,n.toDisplayString)(e),1)})),128))])])):(0,n.createCommentVNode)("",!0)}}}},7317:(e,t,r)=>{r.d(t,{Z:()=>a});var n=r(6598),o=r(6252),l={class:"login-page"};const a={__name:"Guest",setup:function(e){return(0,o.bv)((function(){storeData.commit("resetState"),storeData.commit("resetUserState")})),function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)("div",l,[(0,n.renderSlot)(e.$slots,"default")])}}}},2702:(e,t,r)=>{r.r(t),r.d(t,{default:()=>Z});var n=r(6598),o=(r(6949),r(9018)),l=r(215),a=r(7317),c=r(7887),s=(r(1329),r(5414),r(9038)),u={class:"login-box"},i=(0,n.createElementVNode)("div",{class:"login-logo text-bold"}," Digitized Operation ",-1),d={class:"card"},m={class:"card-body login-card-body"},p=(0,n.createElementVNode)("p",{class:"login-box-msg"},"Sign in to start your session",-1),f={key:0,class:"mb-4 font-medium text-sm text-green-600"},g=["onSubmit"],k={class:"form-row mt-3 mb-3"},v={class:"form-group col-12 mb-3"},b={class:"form-group col-12 mb-3"},h={class:"row"},V={class:"col-8"},y={class:"icheck-primary"},E={class:"col-4"},B=(0,n.createTextVNode)(" Sign in ");const N={__name:"Login",props:{canResetPassword:Boolean,status:String},setup:function(e){var t=(0,s.cI)({email:"",password:"",remember:!1}),r=function(){t.post(route("login"),{onFinish:function(){return t.reset("password")},onSuccess:function(e){console.log(e)}})};return function(N,w){return(0,n.openBlock)(),(0,n.createBlock)(a.Z,null,{default:(0,n.withCtx)((function(){return[(0,n.createVNode)((0,n.unref)(s.Fb),{title:"Log in"}),(0,n.createElementVNode)("div",u,[i,(0,n.createElementVNode)("div",d,[(0,n.createElementVNode)("div",m,[p,e.status?((0,n.openBlock)(),(0,n.createElementBlock)("div",f,(0,n.toDisplayString)(e.status),1)):(0,n.createCommentVNode)("",!0),(0,n.createElementVNode)("form",{onSubmit:(0,n.withModifiers)(r,["prevent"])},[(0,n.createElementVNode)("div",k,[(0,n.createElementVNode)("div",v,[(0,n.createVNode)(c.Z,{id:"email",type:"email",class:"form-control",modelValue:(0,n.unref)(t).email,"onUpdate:modelValue":w[0]||(w[0]=function(e){return(0,n.unref)(t).email=e}),required:"",autofocus:"",placeholder:"Email",autocomplete:"username",error:(0,n.unref)(t).errors.email},null,8,["modelValue","error"])]),(0,n.createElementVNode)("div",b,[(0,n.createVNode)(c.Z,{id:"password",type:"password",class:"form-control",modelValue:(0,n.unref)(t).password,"onUpdate:modelValue":w[1]||(w[1]=function(e){return(0,n.unref)(t).password=e}),required:"",placeholder:"Password",autocomplete:"current-password",error:(0,n.unref)(t).errors.password},null,8,["modelValue","error"])])]),(0,n.createElementVNode)("div",h,[(0,n.createElementVNode)("div",V,[(0,n.createElementVNode)("div",y,[(0,n.createVNode)(l.Z,{id:"remember",name:"remember",label:"Remember me",label_class:" ml-2 ",checked:(0,n.unref)(t).remember,"onUpdate:checked":w[2]||(w[2]=function(e){return(0,n.unref)(t).remember=e})},null,8,["checked"])])]),(0,n.createElementVNode)("div",E,[(0,n.createVNode)(o.Z,{class:(0,n.normalizeClass)(["btn btn-primary btn-block",{"opacity-25":(0,n.unref)(t).processing}]),disabled:(0,n.unref)(t).processing},{default:(0,n.withCtx)((function(){return[B]})),_:1},8,["class","disabled"])])])],40,g)])])])]})),_:1})}}};var w=r(3379),S=r.n(w),_=r(791),x={insert:"head",singleton:!1};S()(_.Z,x);_.Z.locals;const Z=N}}]);