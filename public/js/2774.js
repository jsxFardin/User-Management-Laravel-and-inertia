"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[2774],{9018:(e,o,a)=>{a.d(o,{Z:()=>l});var t=a(6598),r=["type"];const l={__name:"Button",props:{type:{type:String,default:"submit"},classes:{type:String,default:" focus:shadow-outline-gray transition ease-in-out duration-150"}},setup:function(e){return function(o,a){return(0,t.openBlock)(),(0,t.createElementBlock)("button",{type:e.type,class:(0,t.normalizeClass)(e.classes)},[(0,t.renderSlot)(o.$slots,"default")],10,r)}}}},7887:(e,o,a)=>{a.d(o,{Z:()=>l});var t=a(6598),r=["value","id","type","placeholder","autocomplete","step","readonly"];const l={__name:"Input",props:["modelValue","error","value","class","type","id","type","step","placeholder","autocomplete","readonly"],emits:["update:modelValue","getUserData"],setup:function(e){var o=e,a=(0,t.ref)(null);(0,t.onMounted)((function(){a.value.hasAttribute("autofocus")&&a.value.focus()}));var l=(0,t.computed)((function(){return null!=o.error?o.class+" is-invalid":o.class}));return function(o,n){var c;return(0,t.openBlock)(),(0,t.createElementBlock)(t.Fragment,null,[(0,t.createElementVNode)("input",(0,t.mergeProps)({class:(0,t.unref)(l),value:null!==(c=e.value)&&void 0!==c?c:e.modelValue,onInput:n[0]||(n[0]=function(e){return o.$emit("update:modelValue",e.target.value)}),ref_key:"input",ref:a,id:e.id,type:e.type,autofocus:"",placeholder:e.placeholder,autocomplete:e.autocomplete,onChange:n[1]||(n[1]=function(e){return o.$emit("getUserData")}),step:e.step,readonly:e.readonly},o.$attrs),null,16,r),(0,t.withDirectives)((0,t.createElementVNode)("span",{class:"text-danger"},(0,t.toDisplayString)(e.error),513),[[t.vShow,e.error]])],64)}}}},1329:(e,o,a)=>{a.d(o,{Z:()=>c});var t=a(6598),r={class:"block font-medium text-sm text-gray-700"},l={key:0},n={key:1};const c={__name:"Label",props:["value"],setup:function(e){return function(o,a){return(0,t.openBlock)(),(0,t.createElementBlock)("label",r,[e.value?((0,t.openBlock)(),(0,t.createElementBlock)("span",l,(0,t.toDisplayString)(e.value),1)):((0,t.openBlock)(),(0,t.createElementBlock)("span",n,[(0,t.renderSlot)(o.$slots,"default")]))])}}}},6548:(e,o,a)=>{a.d(o,{Z:()=>l});var t=a(6598),r=["value"];const l={__name:"Textarea",props:["modelValue"],emits:["update:modelValue"],setup:function(e){var o=(0,t.ref)(null);return(0,t.onMounted)((function(){o.value.hasAttribute("autofocus")&&o.value.focus()})),function(a,l){return(0,t.openBlock)(),(0,t.createElementBlock)("textarea",{class:"border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm",value:e.modelValue,onInput:l[0]||(l[0]=function(e){return a.$emit("update:modelValue",e.target.value)}),ref_key:"input",ref:o},null,40,r)}}}},2774:(e,o,a)=>{a.r(o),a.d(o,{default:()=>j});var t=a(6598),r=a(1329),l=a(7887),n=a(6548),c=a(9018);function s(e,o){var a="undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(!a){if(Array.isArray(e)||(a=function(e,o){if(!e)return;if("string"==typeof e)return u(e,o);var a=Object.prototype.toString.call(e).slice(8,-1);"Object"===a&&e.constructor&&(a=e.constructor.name);if("Map"===a||"Set"===a)return Array.from(e);if("Arguments"===a||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(a))return u(e,o)}(e))||o&&e&&"number"==typeof e.length){a&&(e=a);var t=0,r=function(){};return{s:r,n:function(){return t>=e.length?{done:!0}:{done:!1,value:e[t++]}},e:function(e){throw e},f:r}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var l,n=!0,c=!1;return{s:function(){a=a.call(e)},n:function(){var e=a.next();return n=e.done,e},e:function(e){c=!0,l=e},f:function(){try{n||null==a.return||a.return()}finally{if(c)throw l}}}}function u(e,o){(null==o||o>e.length)&&(o=e.length);for(var a=0,t=new Array(o);a<o;a++)t[a]=e[a];return t}var m={class:"form-row"},d={class:"form-group col-md-6"},i={class:"form-group col-md-6"},p={class:"form-group col-md-6"},f={key:0,class:"form-group col-md-6"},v={class:"form-group col-md-6"},V={class:"form-group col-md-6"},g={class:"form-group col-md-6"},b={class:"col-md-12"},y=(0,t.createElementVNode)("hr",null,null,-1),N={class:"form-row mb-4"},h={class:"col-md-12"},k=(0,t.createTextVNode)("Add "),D={class:"col-md-5"},_={class:"form-group"},E={key:0,class:"text-danger"},w={class:"col-md-6"},B={class:"form-group"},C={key:0,class:"text-danger"},x={key:0,class:"m-auto col-md-1"},Z={class:"form-group mt-2"},A=["onClick"],S=(0,t.createTextVNode)(" Remove "),U={class:"col-md-12 text-right"},P=(0,t.createTextVNode)("SAVE");const j={__name:"Form",props:{formData:Object,campNames:Object,blockNames:Object,password:{type:Boolean,default:!0}},setup:function(e){var o=e,a=(0,t.reactive)({campNames:o.campNames,blockNames:o.formData.id?o.blockNames:[o.blockNames],password:o.password}),u=function(e){var t,r,l,n,c,s;o.formData.role_id=null!==(t=e.user&&e.user.role_id)&&void 0!==t?t:"",o.formData.user_id=null!==(r=e.user&&e.user.id)&&void 0!==r?r:"",o.formData.mobile=null!==(l=e.user&&e.user.mobile)&&void 0!==l?l:"",o.formData.contact_person=null!==(n=e.user&&e.user.name)&&void 0!==n?n:"",o.formData.agency=null!==(c=e.agency)&&void 0!==c?c:[],o.formData.team=null!==(s=e.team)&&void 0!==s?s:[],a.password=!e.user||!e.user.id},j=function(){var e,t=[],r=s(o.formData.assigns);try{for(r.s();!(e=r.n()).done;){var l=e.value;""!=l.camp_id&&null!=l.camp_id&&t.push(l.camp_id)}}catch(e){r.e(e)}finally{r.f()}if(t.length>0){a.campNames.map((function(e){t.includes(e.value)?e.disabled=!0:e.disabled=!1}));o.formData.assigns.push({camp_id:"",block_id:[]}),o.formData.errors={}}else o.formData.errors["assigns.0.camp_id"]="Please select camp first."};return function(s,$){var I=(0,t.resolveComponent)("font-awesome-icon"),M=(0,t.resolveComponent)("multi-select");return(0,t.openBlock)(),(0,t.createElementBlock)("div",m,[(0,t.createElementVNode)("div",d,[(0,t.createVNode)(r.Z,{for:"agency_name",value:"Agency Name"}),(0,t.createVNode)(l.Z,{id:"agency_name",type:"text",class:"form-control",modelValue:o.formData.agency_name,"onUpdate:modelValue":$[0]||($[0]=function(e){return o.formData.agency_name=e}),placeholder:"Agency Name",autocomplete:o.formData.agency_name,error:o.formData.errors.agency_name},null,8,["modelValue","autocomplete","error"])]),(0,t.createElementVNode)("div",i,[(0,t.createVNode)(r.Z,{for:"email",value:"Email"}),(0,t.createVNode)(l.Z,{id:"email",type:"email",class:"form-control",modelValue:o.formData.email,"onUpdate:modelValue":$[1]||($[1]=function(e){return o.formData.email=e}),placeholder:"Email",autocomplete:o.formData.email,error:o.formData.errors.email,onGetUserData:$[2]||($[2]=function(e){return a={params:{email:o.formData.email,mobile:o.formData.mobile}},void axios.get("ajax/user-details",a).then((function(e){var o=e.data;null!=o.user?u(o):u([])})).catch((function(e){toast.warning(e)}));var a})},null,8,["modelValue","autocomplete","error"])]),(0,t.createElementVNode)("div",p,[(0,t.createVNode)(r.Z,{for:"contact_person",value:"Contact Person Name"}),(0,t.createVNode)(l.Z,{id:"contact_person",type:"text",class:"form-control",modelValue:o.formData.contact_person,"onUpdate:modelValue":$[3]||($[3]=function(e){return o.formData.contact_person=e}),placeholder:"Contact Person Name",autocomplete:o.formData.contact_person,error:o.formData.errors.contact_person},null,8,["modelValue","autocomplete","error"])]),(0,t.unref)(a).password?((0,t.openBlock)(),(0,t.createElementBlock)("div",f,[(0,t.createVNode)(r.Z,{for:"password",value:"Password"}),(0,t.createVNode)(l.Z,{id:"password",type:"password",class:"form-control",modelValue:o.formData.password,"onUpdate:modelValue":$[4]||($[4]=function(e){return o.formData.password=e}),placeholder:"Password",autocomplete:o.formData.password,error:o.formData.errors.password},null,8,["modelValue","autocomplete","error"])])):(0,t.createCommentVNode)("",!0),(0,t.createElementVNode)("div",v,[(0,t.createVNode)(r.Z,{for:"mobile",value:"Mobile"}),(0,t.createVNode)(l.Z,{id:"mobile",type:"text",class:"form-control",modelValue:o.formData.mobile,"onUpdate:modelValue":$[5]||($[5]=function(e){return o.formData.mobile=e}),placeholder:"Contact Person Mobile",autocomplete:o.formData.mobile,error:o.formData.errors.mobile},null,8,["modelValue","autocomplete","error"])]),(0,t.createElementVNode)("div",V,[(0,t.createVNode)(r.Z,{for:"phone",value:"Phone"}),(0,t.createVNode)(l.Z,{id:"phone",type:"text",class:"form-control",modelValue:o.formData.phone,"onUpdate:modelValue":$[6]||($[6]=function(e){return o.formData.phone=e}),placeholder:"Phone",autocomplete:o.formData.phone,error:o.formData.errors.phone},null,8,["modelValue","autocomplete","error"])]),(0,t.createElementVNode)("div",g,[(0,t.createVNode)(r.Z,{for:"address",value:"Address"}),(0,t.createVNode)(n.Z,{id:"address",type:"address",class:"form-control",modelValue:o.formData.address,"onUpdate:modelValue":$[7]||($[7]=function(e){return o.formData.address=e}),placeholder:"Agency Address",autocomplete:o.formData.address,error:o.formData.errors.address},null,8,["modelValue","autocomplete","error"])]),(0,t.createElementVNode)("div",b,[y,(0,t.createElementVNode)("div",N,[(0,t.createElementVNode)("div",h,[(0,t.createElementVNode)("button",{class:"btn btn-info btn-sm float-right",type:"button",onClick:j},[(0,t.createVNode)(I,{icon:["fas","plus"]}),k])]),((0,t.openBlock)(!0),(0,t.createElementBlock)(t.Fragment,null,(0,t.renderList)(e.formData.assigns,(function(e,l){return(0,t.openBlock)(),(0,t.createElementBlock)("div",{class:"row col-md-12",key:l},[(0,t.createElementVNode)("div",D,[(0,t.createElementVNode)("div",_,[(0,t.createVNode)(r.Z,{for:"camp_id",value:"Camp"}),(0,t.createVNode)(M,{modelValue:e.camp_id,"onUpdate:modelValue":function(o){return e.camp_id=o},options:(0,t.unref)(a).campNames,searchable:!0,placeholder:"Choose a camp",onChange:function(e){return function(e,t){if(o.formData.assigns[t].block_id=[],e){var r={params:{camp_id:e}};axios.get("ajax/block-details",r).then((function(e){a.blockNames[t]=e.data})).catch((function(e){toast.warning(e)}))}}(e,l)}},null,8,["modelValue","onUpdate:modelValue","options","onChange"]),o.formData.errors["assigns.".concat(l,".camp_id")]?((0,t.openBlock)(),(0,t.createElementBlock)("span",E,(0,t.toDisplayString)(o.formData.errors["assigns.".concat(l,".camp_id")]),1)):(0,t.createCommentVNode)("",!0)])]),(0,t.createElementVNode)("div",w,[(0,t.createElementVNode)("div",B,[(0,t.createVNode)(r.Z,{for:"block_id",value:"Block"}),(0,t.createVNode)(M,{modelValue:e.block_id,"onUpdate:modelValue":function(o){return e.block_id=o},options:(0,t.unref)(a).blockNames[l],placeholder:"Choose a block",mode:"tags",searchable:!0},null,8,["modelValue","onUpdate:modelValue","options"]),o.formData.errors["assigns.".concat(l,".block_id")]?((0,t.openBlock)(),(0,t.createElementBlock)("span",C,(0,t.toDisplayString)(o.formData.errors["assigns.".concat(l,".block_id")]),1)):(0,t.createCommentVNode)("",!0)])]),0!=l?((0,t.openBlock)(),(0,t.createElementBlock)("div",x,[(0,t.createElementVNode)("div",Z,[(0,t.createElementVNode)("button",{type:"button",class:"btn btn-danger btn-sm float-right",onClick:function(t){return function(e,t){a.blockNames.splice(e,1),o.formData.assigns.splice(e,1),a.campNames.map((function(e){e.value==t&&(e.disabled=!e.disabled)}))}(l,e.camp_id)}},[(0,t.createVNode)(I,{icon:["fas","trash"]}),S],8,A)])])):(0,t.createCommentVNode)("",!0)])})),128))])]),(0,t.createElementVNode)("div",U,[(0,t.createVNode)(c.Z,{class:"btn btn-success",disabled:o.formData.processing},{default:(0,t.withCtx)((function(){return[P]})),_:1},8,["disabled"])])])}}}}}]);