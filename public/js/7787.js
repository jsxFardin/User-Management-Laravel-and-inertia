"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[7787],{9018:(e,a,o)=>{o.d(a,{Z:()=>l});var t=o(6598),r=["type"];const l={__name:"Button",props:{type:{type:String,default:"submit"},classes:{type:String,default:" focus:shadow-outline-gray transition ease-in-out duration-150"}},setup:function(e){return function(a,o){return(0,t.openBlock)(),(0,t.createElementBlock)("button",{type:e.type,class:(0,t.normalizeClass)(e.classes)},[(0,t.renderSlot)(a.$slots,"default")],10,r)}}}},215:(e,a,o)=>{o.d(a,{Z:()=>c});var t=o(6598),r=(o(1329),{class:"form-check pl-0"}),l=["id"],n=["for"];const c={__name:"Checkbox",props:{checked:{type:[Array,Boolean],default:!1},value:{default:null},label_class:{type:String,default:"form-check-label"},class:String,error:Object,id:String,label:String},emits:["update:checked"],setup:function(e,a){var o=a.emit,c=e,u=(0,t.computed)({get:function(){return Boolean(c.checked)},set:function(e){o("update:checked",e)}}),s=(0,t.computed)((function(){return null!=c.error?c.class+" is-invalid":c.class}));return function(a,o){return(0,t.openBlock)(),(0,t.createElementBlock)("div",r,[(0,t.withDirectives)((0,t.createElementVNode)("input",{class:(0,t.normalizeClass)((0,t.unref)(s)),type:"checkbox",id:e.id,"onUpdate:modelValue":o[0]||(o[0]=function(e){return(0,t.isRef)(u)?u.value=e:null})},null,10,l),[[t.vModelCheckbox,(0,t.unref)(u)]]),(0,t.createElementVNode)("label",{class:(0,t.normalizeClass)(e.label_class),for:e.id},(0,t.toDisplayString)(e.label),11,n)])}}}},7887:(e,a,o)=>{o.d(a,{Z:()=>l});var t=o(6598),r=["value","id","type","placeholder","autocomplete","step","readonly"];const l={__name:"Input",props:["modelValue","error","value","class","type","id","type","step","placeholder","autocomplete","readonly"],emits:["update:modelValue","getUserData"],setup:function(e){var a=e,o=(0,t.ref)(null);(0,t.onMounted)((function(){o.value.hasAttribute("autofocus")&&o.value.focus()}));var l=(0,t.computed)((function(){return null!=a.error?a.class+" is-invalid":a.class}));return function(a,n){var c;return(0,t.openBlock)(),(0,t.createElementBlock)(t.Fragment,null,[(0,t.createElementVNode)("input",(0,t.mergeProps)({class:(0,t.unref)(l),value:null!==(c=e.value)&&void 0!==c?c:e.modelValue,onInput:n[0]||(n[0]=function(e){return a.$emit("update:modelValue",e.target.value)}),ref_key:"input",ref:o,id:e.id,type:e.type,autofocus:"",placeholder:e.placeholder,autocomplete:e.autocomplete,onChange:n[1]||(n[1]=function(e){return a.$emit("getUserData")}),step:e.step,readonly:e.readonly},a.$attrs),null,16,r),(0,t.withDirectives)((0,t.createElementVNode)("span",{class:"text-danger"},(0,t.toDisplayString)(e.error),513),[[t.vShow,e.error]])],64)}}}},1329:(e,a,o)=>{o.d(a,{Z:()=>c});var t=o(6598),r={class:"block font-medium text-sm text-gray-700"},l={key:0},n={key:1};const c={__name:"Label",props:["value"],setup:function(e){return function(a,o){return(0,t.openBlock)(),(0,t.createElementBlock)("label",r,[e.value?((0,t.openBlock)(),(0,t.createElementBlock)("span",l,(0,t.toDisplayString)(e.value),1)):((0,t.openBlock)(),(0,t.createElementBlock)("span",n,[(0,t.renderSlot)(a.$slots,"default")]))])}}}},7692:(e,a,o)=>{o.d(a,{Z:()=>u});var t=o(6598),r=o(1957),l=["multiple"],n=(0,t.createElementVNode)("option",{value:""},"Select",-1),c=["value","selected"];const u={__name:"Select",props:{options:{type:r.Array,default:null},modelValue:{type:Number,default:null},error:Object,class:String,type:String,id:String,multiple:{type:Boolean,default:!1},keyName:{type:String,default:"value"},valueName:{type:String,default:"label"}},emits:["update:modelValue"],setup:function(e){var a=e,o=(0,t.ref)(null);(0,t.onMounted)((function(){o.value.hasAttribute("autofocus")&&o.value.focus()}));var r=(0,t.computed)((function(){return null!=a.error?a.class+" is-invalid":a.class}));return function(u,s){return(0,t.openBlock)(),(0,t.createElementBlock)(t.Fragment,null,[(0,t.createElementVNode)("select",{class:(0,t.normalizeClass)((0,t.unref)(r)),onChange:s[0]||(s[0]=function(e){return u.$emit("update:modelValue",e.target.value)}),ref_key:"input",ref:o,multiple:e.multiple},[n,((0,t.openBlock)(!0),(0,t.createElementBlock)(t.Fragment,null,(0,t.renderList)(a.options,(function(a,o){var r;return(0,t.openBlock)(),(0,t.createElementBlock)("option",{key:o,value:a[e.keyName],selected:null!==(r=a[e.keyName]==e.modelValue)&&void 0!==r?r:0},(0,t.toDisplayString)(a[e.valueName]),9,c)})),128))],42,l),(0,t.withDirectives)((0,t.createElementVNode)("span",{class:"text-danger"},(0,t.toDisplayString)(e.error),513),[[t.vShow,e.error]])],64)}}}},6548:(e,a,o)=>{o.d(a,{Z:()=>l});var t=o(6598),r=["value"];const l={__name:"Textarea",props:["modelValue"],emits:["update:modelValue"],setup:function(e){var a=(0,t.ref)(null);return(0,t.onMounted)((function(){a.value.hasAttribute("autofocus")&&a.value.focus()})),function(o,l){return(0,t.openBlock)(),(0,t.createElementBlock)("textarea",{class:"border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm",value:e.modelValue,onInput:l[0]||(l[0]=function(e){return o.$emit("update:modelValue",e.target.value)}),ref_key:"input",ref:a},null,40,r)}}}},7787:(e,a,o)=>{o.r(a),o.d(a,{default:()=>Ve});var t=o(6598),r=o(1329),l=o(7887),n=o(9018),c=(o(7692),o(215)),u=o(6548),s=o(2262),m={class:"row"},d={class:"col mb-3"},i={class:"text-danger"},f={class:"col mb-3"},p={class:"text-danger"},_={class:"col mb-3"},V={class:"text-danger"},b={class:"col mb-3"},h={class:"text-danger"},D={class:"row"},v={class:"col mb-3"},N={class:"text-danger"},k={class:"col mb-3"},g={class:"text-danger"},y={class:"col mb-3"},E={class:"text-danger"},w={class:"col mb-3"},Z={class:"text-danger"},S={class:"row"},U={class:"col mb-3"},B={class:"text-danger"},C={class:"col mb-3"},x={class:"text-danger"},j={class:"col mb-3"},O={class:"col mb-3"},T={class:"row"},F={class:"col mb-3"},M={class:"col mb-3"},P={class:"col mb-3"},W={class:"col mb-3"},z={class:"row"},L={class:"col mb-3"},$={class:"col mb-3"},A={class:"col mb-3"},I={class:"col mb-3"},R={class:"row"},H={class:"col mb-3"},q={class:"text-danger"},Y={class:"col mb-3"},G={class:"col mb-3"},J={class:"col mb-3"},K={class:"row"},Q={class:"col mb-3"},X={class:"col mb-3"},ee={class:"col mb-3"},ae={class:"col mb-3"},oe={class:"row"},te={class:"col mb-3"},re={class:"col mb-3"},le={class:"col mb-3"},ne={class:"col mb-3"},ce={class:"row"},ue={class:"col mb-3"},se={class:"col mb-3"},me={class:"col mb-3"},de={class:"col mb-3"},ie={class:"row"},fe={class:"col mb-3"},pe={class:"col-md-12 text-right"},_e=(0,t.createTextVNode)("SAVE");const Ve={__name:"Form",props:{formData:Object,camps:Object,blocks:Object,facilityTypes:Object,facilityUseds:Object,constructionStatus:Object,latrineStructure:Object,donor:Object,pits:Object,subBlocks:Object,sanitationZones:Object},setup:function(e){var a=e,o=(0,s.qj)({campBlocks:a.blocks,subBlocks:a.subBlocks,pwsn:[{value:1,label:"YES"},{value:0,label:"NO"}]}),Ve=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null,o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,t=arguments.length>2?arguments[2]:void 0,r=a.camps.filter((function(e){return a.formData.camp_id==e.value})),l=e?a.blocks.filter((function(a){return e==a.value})):"",n=o?t.filter((function(e){return o==e.value})):"";a.formData.camp_sn=Object.keys(r).length>0&&""!=r[0].short_name?r[0].short_name:"",a.formData.block_sn=Object.keys(l).length>0&&""!=l[0].short_name?l[0].short_name:"",a.formData.subBlock_sn=Object.keys(n).length>0&&""!=n[0].short_name?n[0].short_name:""};return function(s,be){var he=(0,t.resolveComponent)("multi-select");return(0,t.openBlock)(),(0,t.createElementBlock)(t.Fragment,null,[(0,t.createElementVNode)("div",m,[(0,t.createElementVNode)("div",d,[(0,t.createVNode)(r.Z,{for:"camp_id",value:"Camps"}),(0,t.createVNode)(he,{modelValue:e.formData.camp_id,"onUpdate:modelValue":be[0]||(be[0]=function(a){return e.formData.camp_id=a}),options:e.camps,placeholder:"Choose a camp",onChange:be[1]||(be[1]=function(e){return function(e){if(null!=e&&(a.formData.block_id="",a.formData.sub_block_id="",o.campBlocks=a.blocks.filter((function(a){return e==a.camp_id}))),null!=e&&0==o.campBlocks.length){var t={params:{camp_id:e}};a.formData.sub_block_id="",axios.get("ajax/block-details",t).then((function(e){o.campBlocks=e.data})).catch((function(e){toast.warning(e)}))}}(e)}),searchable:!0},null,8,["modelValue","options"]),(0,t.createElementVNode)("span",i,(0,t.toDisplayString)(e.formData.errors.camp_id),1)]),(0,t.createElementVNode)("div",f,[(0,t.createVNode)(r.Z,{for:"block_id",value:"Block"}),(0,t.createVNode)(he,{modelValue:e.formData.block_id,"onUpdate:modelValue":be[2]||(be[2]=function(a){return e.formData.block_id=a}),options:(0,t.unref)(o).campBlocks,placeholder:"Choose a Blocks",onChange:be[3]||(be[3]=function(e){return function(e){if(e){var t={params:{get_parent_id:e}};a.formData.sub_block_id="",axios.get("ajax/block-details",t).then((function(a){o.subBlocks=a.data,Ve(e,null,o.subBlocks)})).catch((function(e){toast.warning(e)}))}}(e)}),searchable:!0},null,8,["modelValue","options"]),(0,t.createElementVNode)("span",p,(0,t.toDisplayString)(e.formData.errors.block_id),1)]),(0,t.createElementVNode)("div",_,[(0,t.createVNode)(r.Z,{for:"sub_block_id",value:"Sub-Block"}),(0,t.createVNode)(he,{modelValue:e.formData.sub_block_id,"onUpdate:modelValue":be[4]||(be[4]=function(a){return e.formData.sub_block_id=a}),options:(0,t.unref)(o).subBlocks,placeholder:"Choose a Sub-Blocks",onChange:be[5]||(be[5]=function(e){return t=e,void Ve(a.formData.block_id,t,o.subBlocks);var t}),searchable:!0},null,8,["modelValue","options"]),(0,t.createElementVNode)("span",V,(0,t.toDisplayString)(e.formData.errors.sub_block_id),1)]),(0,t.createElementVNode)("div",b,[(0,t.createVNode)(r.Z,{for:"construction_status_id",value:"Construction Status"}),(0,t.createVNode)(he,{modelValue:e.formData.construction_status_id,"onUpdate:modelValue":be[6]||(be[6]=function(a){return e.formData.construction_status_id=a}),options:e.constructionStatus,placeholder:"Choose a Construction Status",searchable:!0},null,8,["modelValue","options"]),(0,t.createElementVNode)("span",h,(0,t.toDisplayString)(e.formData.errors.construction_status_id),1)])]),(0,t.createElementVNode)("div",D,[(0,t.createElementVNode)("div",v,[(0,t.createVNode)(r.Z,{for:"pit_type_id",value:"PIT Type"}),(0,t.createVNode)(he,{modelValue:e.formData.pit_type_id,"onUpdate:modelValue":be[7]||(be[7]=function(a){return e.formData.pit_type_id=a}),options:e.pits,placeholder:"Choose a PIT Type",searchable:!0},null,8,["modelValue","options"]),(0,t.createElementVNode)("span",N,(0,t.toDisplayString)(e.formData.errors.pit_type_id),1)]),(0,t.createElementVNode)("div",k,[(0,t.createVNode)(r.Z,{for:"constructor_id",value:"Constructor"}),(0,t.createVNode)(he,{modelValue:e.formData.constructor_id,"onUpdate:modelValue":be[8]||(be[8]=function(a){return e.formData.constructor_id=a}),options:e.donor,placeholder:"Choose a Constructor",searchable:!0},null,8,["modelValue","options"]),(0,t.createElementVNode)("span",g,(0,t.toDisplayString)(e.formData.errors.constructor_id),1)]),(0,t.createElementVNode)("div",y,[(0,t.createVNode)(r.Z,{for:"facility_type_id",value:"Facility Type"}),(0,t.createVNode)(he,{modelValue:e.formData.facility_type_id,"onUpdate:modelValue":be[9]||(be[9]=function(a){return e.formData.facility_type_id=a}),options:e.facilityTypes,placeholder:"Choose a Facility Type",searchable:!0},null,8,["modelValue","options"]),(0,t.createElementVNode)("span",E,(0,t.toDisplayString)(e.formData.errors.facility_type_id),1)]),(0,t.createElementVNode)("div",w,[(0,t.createVNode)(r.Z,{for:"facility_used_id",value:"Facility Used"}),(0,t.createVNode)(he,{modelValue:e.formData.facility_used_id,"onUpdate:modelValue":be[10]||(be[10]=function(a){return e.formData.facility_used_id=a}),options:e.facilityUseds,placeholder:"Choose a Facility Used",searchable:!0},null,8,["modelValue","options"]),(0,t.createElementVNode)("span",Z,(0,t.toDisplayString)(e.formData.errors.facility_used_id),1)])]),(0,t.createElementVNode)("div",S,[(0,t.createElementVNode)("div",U,[(0,t.createVNode)(r.Z,{for:"latrine_structure_id",value:"Latrine Structure"}),(0,t.createVNode)(he,{modelValue:e.formData.latrine_structure_id,"onUpdate:modelValue":be[11]||(be[11]=function(a){return e.formData.latrine_structure_id=a}),options:e.latrineStructure,placeholder:"Choose a Structure",searchable:!0},null,8,["modelValue","options"]),(0,t.createElementVNode)("span",B,(0,t.toDisplayString)(e.formData.errors.latrine_structure_id),1)]),(0,t.createElementVNode)("div",C,[(0,t.createVNode)(r.Z,{for:"sanitation_zone_id",value:"Sanitation Zone"}),(0,t.createVNode)(he,{modelValue:e.formData.sanitation_zone_id,"onUpdate:modelValue":be[12]||(be[12]=function(a){return e.formData.sanitation_zone_id=a}),options:e.sanitationZones,placeholder:"Choose a Zone",searchable:!0},null,8,["modelValue","options"]),(0,t.createElementVNode)("span",x,(0,t.toDisplayString)(e.formData.errors.sanitation_zone_id),1)]),(0,t.createElementVNode)("div",j,[(0,t.createVNode)(r.Z,{for:"functional",value:"Functional"}),(0,t.createVNode)(l.Z,{id:"functional",type:"number",class:"form-control",modelValue:e.formData.functional,"onUpdate:modelValue":be[13]||(be[13]=function(a){return e.formData.functional=a}),autofocus:"",placeholder:"Functional",autocomplete:e.formData.functional,error:e.formData.errors.functional},null,8,["modelValue","autocomplete","error"])]),(0,t.createElementVNode)("div",O,[(0,t.createVNode)(r.Z,{for:"non_functional",value:"Non functional"}),(0,t.createVNode)(l.Z,{id:"non_functional",type:"number",class:"form-control",modelValue:e.formData.non_functional,"onUpdate:modelValue":be[14]||(be[14]=function(a){return e.formData.non_functional=a}),autofocus:"",placeholder:"Non functional",autocomplete:e.formData.non_functional,error:e.formData.errors.non_functional},null,8,["modelValue","autocomplete","error"])])]),(0,t.createElementVNode)("div",T,[(0,t.createElementVNode)("div",F,[(0,t.createVNode)(r.Z,{for:"longitude",value:"Longitude"}),(0,t.createVNode)(l.Z,{id:"longitude",type:"number",class:"form-control",modelValue:e.formData.longitude,"onUpdate:modelValue":be[15]||(be[15]=function(a){return e.formData.longitude=a}),autofocus:"",placeholder:"Longitude",autocomplete:e.formData.longitude,error:e.formData.errors.longitude,step:1e-7},null,8,["modelValue","autocomplete","error","step"])]),(0,t.createElementVNode)("div",M,[(0,t.createVNode)(r.Z,{for:"latitude",value:"Latitude"}),(0,t.createVNode)(l.Z,{id:"latitude",type:"number",class:"form-control",modelValue:e.formData.latitude,"onUpdate:modelValue":be[16]||(be[16]=function(a){return e.formData.latitude=a}),autofocus:"",placeholder:"Latitude",autocomplete:e.formData.latitude,error:e.formData.errors.latitude,step:1e-7},null,8,["modelValue","autocomplete","error","step"])]),(0,t.createElementVNode)("div",P,[(0,t.createVNode)(r.Z,{for:"male_number_user",value:"Male number user"}),(0,t.createVNode)(l.Z,{id:"male_number_user",type:"number",class:"form-control",modelValue:e.formData.male_number_user,"onUpdate:modelValue":be[17]||(be[17]=function(a){return e.formData.male_number_user=a}),autofocus:"",placeholder:"Male number user",autocomplete:e.formData.male_number_user,error:e.formData.errors.male_number_user},null,8,["modelValue","autocomplete","error"])]),(0,t.createElementVNode)("div",W,[(0,t.createVNode)(r.Z,{for:"male_number_stickers",value:"Male number stickers"}),(0,t.createVNode)(l.Z,{id:"male_number_stickers",type:"number",class:"form-control",modelValue:e.formData.male_number_stickers,"onUpdate:modelValue":be[18]||(be[18]=function(a){return e.formData.male_number_stickers=a}),autofocus:"",placeholder:"Male number stickers",autocomplete:e.formData.male_number_stickers,error:e.formData.errors.male_number_stickers},null,8,["modelValue","autocomplete","error"])])]),(0,t.createElementVNode)("div",z,[(0,t.createElementVNode)("div",L,[(0,t.createVNode)(r.Z,{for:"female_number_user",value:"Female number user"}),(0,t.createVNode)(l.Z,{id:"female_number_user",type:"number",class:"form-control",modelValue:e.formData.female_number_user,"onUpdate:modelValue":be[19]||(be[19]=function(a){return e.formData.female_number_user=a}),autofocus:"",placeholder:"Female number user",autocomplete:e.formData.female_number_user,error:e.formData.errors.female_number_user},null,8,["modelValue","autocomplete","error"])]),(0,t.createElementVNode)("div",$,[(0,t.createVNode)(r.Z,{for:"female_number_stickers",value:"Female number stickers"}),(0,t.createVNode)(l.Z,{id:"female_number_stickers",type:"number",class:"form-control",modelValue:e.formData.female_number_stickers,"onUpdate:modelValue":be[20]||(be[20]=function(a){return e.formData.female_number_stickers=a}),autofocus:"",placeholder:"Male number stickers",autocomplete:e.formData.female_number_stickers,error:e.formData.errors.female_number_stickers},null,8,["modelValue","autocomplete","error"])]),(0,t.createElementVNode)("div",A,[(0,t.createVNode)(r.Z,{for:"children_number",value:"Children number"}),(0,t.createVNode)(l.Z,{id:"children_number",type:"number",class:"form-control",modelValue:e.formData.children_number,"onUpdate:modelValue":be[21]||(be[21]=function(a){return e.formData.children_number=a}),autofocus:"",placeholder:"Children number",autocomplete:e.formData.children_number,error:e.formData.errors.children_number},null,8,["modelValue","autocomplete","error"])]),(0,t.createElementVNode)("div",I,[(0,t.createVNode)(r.Z,{for:"common_shared",value:"Common shared"}),(0,t.createVNode)(l.Z,{id:"common_shared",type:"number",class:"form-control",modelValue:e.formData.common_shared,"onUpdate:modelValue":be[22]||(be[22]=function(a){return e.formData.common_shared=a}),autofocus:"",placeholder:"Common shared",autocomplete:e.formData.common_shared,error:e.formData.errors.common_shared},null,8,["modelValue","autocomplete","error"])])]),(0,t.createElementVNode)("div",R,[(0,t.createElementVNode)("div",H,[(0,t.createVNode)(r.Z,{for:"pwsn",value:"PWSN "}),(0,t.createVNode)(he,{modelValue:e.formData.pwsn,"onUpdate:modelValue":be[23]||(be[23]=function(a){return e.formData.pwsn=a}),options:(0,t.unref)(o).pwsn,placeholder:"Choose a PWSN",searchable:!0},null,8,["modelValue","options"]),(0,t.createElementVNode)("span",q,(0,t.toDisplayString)(e.formData.errors.pwsn),1)]),(0,t.createElementVNode)("div",Y,[(0,t.createVNode)(r.Z,{for:"chamber_door",value:"Chamber of door"}),(0,t.createVNode)(l.Z,{id:"chamber_door",type:"number",class:"form-control",modelValue:e.formData.chamber_door,"onUpdate:modelValue":be[24]||(be[24]=function(a){return e.formData.chamber_door=a}),autofocus:"",placeholder:"Chamber door",autocomplete:e.formData.chamber_door,error:e.formData.errors.chamber_door},null,8,["modelValue","autocomplete","error"])]),(0,t.createElementVNode)("div",G,[(0,t.createVNode)(r.Z,{for:"total_chamber",value:"Total chamber"}),(0,t.createVNode)(l.Z,{id:"total_chamber",type:"number",class:"form-control",modelValue:e.formData.total_chamber,"onUpdate:modelValue":be[25]||(be[25]=function(a){return e.formData.total_chamber=a}),autofocus:"",placeholder:"Total chamber",autocomplete:e.formData.total_chamber,error:e.formData.errors.total_chamber},null,8,["modelValue","autocomplete","error"])]),(0,t.createElementVNode)("div",J,[(0,t.createVNode)(r.Z,{for:"total_ring_number",value:"Total ring number"}),(0,t.createVNode)(l.Z,{id:"total_ring_number",type:"number",class:"form-control",modelValue:e.formData.total_ring_number,"onUpdate:modelValue":be[26]||(be[26]=function(a){return e.formData.total_ring_number=a}),autofocus:"",placeholder:"Total ring number",autocomplete:e.formData.total_ring_number,error:e.formData.errors.total_ring_number,step:.01},null,8,["modelValue","autocomplete","error","step"])])]),(0,t.createElementVNode)("div",K,[(0,t.createElementVNode)("div",Q,[(0,t.createVNode)(r.Z,{for:"dia_of_ring",value:"Dia of ring(Inch)"}),(0,t.createVNode)(l.Z,{id:"dia_of_ring",type:"number",class:"form-control",modelValue:e.formData.dia_of_ring,"onUpdate:modelValue":be[27]||(be[27]=function(a){return e.formData.dia_of_ring=a}),autofocus:"",placeholder:"Dia of ring",autocomplete:e.formData.dia_of_ring,error:e.formData.errors.dia_of_ring,step:.01},null,8,["modelValue","autocomplete","error","step"])]),(0,t.createElementVNode)("div",X,[(0,t.createVNode)(r.Z,{for:"septic_tank_dimension",value:"Septic tank dimension"}),(0,t.createVNode)(l.Z,{id:"septic_tank_dimension",type:"number",class:"form-control",modelValue:e.formData.septic_tank_dimension,"onUpdate:modelValue":be[28]||(be[28]=function(a){return e.formData.septic_tank_dimension=a}),autofocus:"",placeholder:"Septic tank dimension",autocomplete:e.formData.septic_tank_dimension,error:e.formData.errors.septic_tank_dimension,step:.01},null,8,["modelValue","autocomplete","error","step"])]),(0,t.createElementVNode)("div",ee,[(0,t.createVNode)(r.Z,{for:"total_volume",value:"Total volume (m³)"}),(0,t.createVNode)(l.Z,{id:"total_volume",type:"number",class:"form-control",modelValue:e.formData.total_volume,"onUpdate:modelValue":be[29]||(be[29]=function(a){return e.formData.total_volume=a}),autofocus:"",placeholder:"Total volume",autocomplete:e.formData.total_volume,error:e.formData.errors.total_volume,step:.01},null,8,["modelValue","autocomplete","error","step"])]),(0,t.createElementVNode)("div",ae,[(0,t.createVNode)(r.Z,{for:"remarks",value:"Remarks"}),(0,t.createVNode)(u.Z,{id:"remarks",type:"text",class:"form-control",modelValue:e.formData.remarks,"onUpdate:modelValue":be[30]||(be[30]=function(a){return e.formData.remarks=a}),autofocus:"",placeholder:"Remarks",autocomplete:e.formData.remarks,error:e.formData.errors.remarks},null,8,["modelValue","autocomplete","error"])])]),(0,t.createElementVNode)("div",oe,[(0,t.createElementVNode)("div",te,[(0,t.createVNode)(c.Z,{id:"pwsn_hand_rail_outside",name:"pwsn_hand_rail_outside",label:"PWSN hand rail outside",label_class:" ml-2 ",checked:e.formData.pwsn_hand_rail_outside,"onUpdate:checked":be[31]||(be[31]=function(a){return e.formData.pwsn_hand_rail_outside=a})},null,8,["checked"])]),(0,t.createElementVNode)("div",re,[(0,t.createVNode)(c.Z,{id:"pwsn_hand_rail_inside",name:"pwsn_hand_rail_inside",label_class:"ml-2",label:"PWSN hand rail inside",checked:e.formData.pwsn_hand_rail_inside,"onUpdate:checked":be[32]||(be[32]=function(a){return e.formData.pwsn_hand_rail_inside=a})},null,8,["checked"])]),(0,t.createElementVNode)("div",le,[(0,t.createVNode)(c.Z,{id:"pwsn_ramp",name:"pwsn_ramp",label_class:"ml-2",label:"PWSN ramp",checked:e.formData.pwsn_ramp,"onUpdate:checked":be[33]||(be[33]=function(a){return e.formData.pwsn_ramp=a})},null,8,["checked"])]),(0,t.createElementVNode)("div",ne,[(0,t.createVNode)(c.Z,{id:"pwsn_stair",name:"pwsn_stair",label_class:"ml-2",label:"PWSN stair",checked:e.formData.pwsn_stair,"onUpdate:checked":be[34]||(be[34]=function(a){return e.formData.pwsn_stair=a})},null,8,["checked"])])]),(0,t.createElementVNode)("div",ce,[(0,t.createElementVNode)("div",ue,[(0,t.createVNode)(c.Z,{id:"pwsn_high_commode",name:"pwsn_high_commode",label_class:"ml-2",label:"PWSN high commode",checked:e.formData.pwsn_high_commode,"onUpdate:checked":be[35]||(be[35]=function(a){return e.formData.pwsn_high_commode=a})},null,8,["checked"])]),(0,t.createElementVNode)("div",se,[(0,t.createVNode)(c.Z,{id:"hwd",name:"hwd",label_class:"ml-2",label:"HWD",checked:e.formData.hwd,"onUpdate:checked":be[36]||(be[36]=function(a){return e.formData.hwd=a})},null,8,["checked"])]),(0,t.createElementVNode)("div",me,[(0,t.createVNode)(c.Z,{id:"hwd_water",name:"hwd_water",label_class:"ml-2",label:"HWD water",checked:e.formData.hwd_water,"onUpdate:checked":be[37]||(be[37]=function(a){return e.formData.hwd_water=a})},null,8,["checked"])]),(0,t.createElementVNode)("div",de,[(0,t.createVNode)(c.Z,{id:"hwd_soap",name:"hwd_soap",label_class:"ml-2",label:"HWD soap",checked:e.formData.hwd_soap,"onUpdate:checked":be[38]||(be[38]=function(a){return e.formData.hwd_soap=a})},null,8,["checked"])])]),(0,t.createElementVNode)("div",ie,[(0,t.createElementVNode)("div",fe,[(0,t.createVNode)(c.Z,{id:"min_or_repair",name:"min_or_repair",label_class:"ml-2",label:"Min or Repair",checked:e.formData.min_or_repair,"onUpdate:checked":be[39]||(be[39]=function(a){return e.formData.min_or_repair=a})},null,8,["checked"])])]),(0,t.createElementVNode)("div",pe,[(0,t.createVNode)(n.Z,{type:"submit",class:"btn btn-success"},{default:(0,t.withCtx)((function(){return[_e]})),_:1})])],64)}}}}}]);