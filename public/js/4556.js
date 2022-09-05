"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[4556],{8962:(e,t,a)=>{a.d(t,{Z:()=>u});var n=a(6598),r=a(2262),l={class:"card"},s={key:0,class:"card-header"},o={class:"card-title text-bold"},c={class:"card-body"};const u={__name:"Card",props:{title:{type:String,default:"Card Title"},showHeader:{type:Boolean,default:!1}},setup:function(e){var t=function(){a.fullscreen=!a.fullscreen},a=(0,r.qj)({fullscreen:!1});return function(r,u){var d=(0,n.resolveComponent)("font-awesome-icon"),i=(0,n.resolveComponent)("fullscreen");return(0,n.openBlock)(),(0,n.createBlock)(i,{modelValue:(0,n.unref)(a).fullscreen,"onUpdate:modelValue":u[0]||(u[0]=function(e){return(0,n.unref)(a).fullscreen=e}),"page-only":(0,n.unref)(a).pageOnly},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",l,[e.showHeader?((0,n.openBlock)(),(0,n.createElementBlock)("div",s,[(0,n.createElementVNode)("h3",o,(0,n.toDisplayString)(e.title),1),(0,n.createElementVNode)("button",{class:"float-right btn btn-danger btn-sm",onClick:t},[(0,n.createVNode)(d,{icon:["fas","expand"]})])])):(0,n.createCommentVNode)("",!0),(0,n.createElementVNode)("div",c,[(0,n.renderSlot)(r.$slots,"default")])])]})),_:3},8,["modelValue","page-only"])}}}},537:(e,t,a)=>{a.d(t,{Z:()=>s});var n=a(6598),r=a(3764),l=a(6300);const s={__name:"PieChart",props:{chartId:{type:String,default:"pie-chart"},datasetIdKey:{type:String,default:"label"},width:{type:Number,default:300},height:{type:Number,default:300},cssClasses:{default:"",type:String},styles:{type:Object,default:function(){}},plugins:{type:Array,default:function(){return[]}},chartData:{type:Object,default:function(){}},chartOptions:{type:Object,default:function(){return{responsive:!0,maintainAspectRatio:!1}}}},setup:function(e){return l.kL.register(l.Dx,l.u,l.De,l.qi,l.uw),function(t,a){return(0,n.openBlock)(),(0,n.createBlock)((0,n.unref)(r.by),{"chart-options":e.chartOptions,"chart-data":e.chartData,"chart-id":e.chartId,"dataset-id-key":e.datasetIdKey,plugins:e.plugins,"css-classes":e.cssClasses,styles:e.styles,width:e.width,height:e.height},null,8,["chart-options","chart-data","chart-id","dataset-id-key","plugins","css-classes","styles","width","height"])}}}},4556:(e,t,a)=>{a.r(t),a.d(t,{default:()=>s});var n=a(6598),r=a(537),l=a(8962);const s={__name:"SecondPieChart",setup:function(e){var t={labels:["HouseHold","Source"],datasets:[{backgroundColor:["#41B883","#E46651"],data:[40,20]}]};return function(e,a){return(0,n.openBlock)(),(0,n.createBlock)(l.Z,{title:" Water Samples at Household and Source Level",showHeader:!0},{default:(0,n.withCtx)((function(){return[(0,n.createVNode)(r.Z,{"chart-data":t})]})),_:1})}}}}}]);