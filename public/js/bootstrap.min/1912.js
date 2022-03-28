"use strict";(self.webpackChunkNexoPOS_4x=self.webpackChunkNexoPOS_4x||[]).push([[1912],{1912:(e,t,i)=>{i.r(t),i.d(t,{default:()=>_});var n=i(7757),a=i.n(n),o=i(7389),r=i(7266),s=i(6386),u=i(8603),l=i(2277),d=i(9671);function c(e,t,i,n,a,o,r){try{var s=e[o](r),u=s.value}catch(e){return void i(e)}s.done?t(u):Promise.resolve(u).then(n,a)}const p={name:"ns-pos-quick-product-popup",methods:{__:o.__,popupCloser:u.Z,popupResolver:s.Z,close:function(){this.popupResolver(!1)},addProduct:function(){var e,t=this;return(e=a().mark((function e(){var i,n;return a().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(t.validation.validateFields(t.fields)){e.next=3;break}return e.abrupt("return",d.kX.error((0,o.__)("Unable to proceed. The form is not valid.")).subscribe());case 3:return i=t.validation.extractFields(t.fields),e.next=6,POS.defineQuantities(i,t.units);case 6:n=e.sent,i.$quantities=function(){return n},i.$original=function(){return{stock_management:"disabled",category_id:0,tax_group:t.tax_groups.filter((function(e){return parseInt(e.id)===parseInt(i.tax_group_id)}))[0],tax_group_id:i.tax_group_id,tax_type:i.tax_type}},i.unit_name=t.units.filter((function(e){return e.id===i.unit_id}))[0].name,i.quantity=parseFloat(i.quantity),POS.addToCart(i),t.close();case 13:case"end":return e.stop()}}),e)})),function(){var t=this,i=arguments;return new Promise((function(n,a){var o=e.apply(t,i);function r(e){c(o,n,a,r,s,"next",e)}function s(e){c(o,n,a,r,s,"throw",e)}r(void 0)}))})()},loadData:function(){var e=this;this.loaded=!1,(0,l.D)(nsHttpClient.get("/api/nexopos/v4/units"),nsHttpClient.get("/api/nexopos/v4/taxes/groups")).subscribe({next:function(t){e.units=t[0],e.tax_groups=t[1],e.fields.filter((function(e){"tax_group_id"===e.name&&(e.options=t[1].map((function(e){return{label:e.name,value:e.id}}))),"unit_id"===e.name&&(e.options=t[0].map((function(e){return{label:e.name,value:e.id}})))})),e.buildForm()},error:function(e){}})},buildForm:function(){this.fields=this.validation.createFields(this.fields),this.loaded=!0}},data:function(){return{units:[],tax_groups:[],loaded:!1,validation:new r.Z,fields:[{label:(0,o.__)("Name"),name:"name",type:"text",description:(0,o.__)("Provide a unique name for the product."),validation:"required"},{label:(0,o.__)("Unit Price"),name:"unit_price",type:"text",description:(0,o.__)("Define what is the sale price of the item."),validation:"required"},{label:(0,o.__)("Quantity"),name:"quantity",type:"text",value:1,description:(0,o.__)("Set the quantity of the product."),validation:"required"},{label:(0,o.__)("Unit"),name:"unit_id",type:"select",options:[],description:(0,o.__)("Assign a unit to the product."),validation:"required"},{label:(0,o.__)("Tax Type"),name:"tax_type",type:"select",options:[{label:(0,o.__)("Disabled"),value:""},{label:(0,o.__)("Inclusive"),value:"inclusive"},{label:(0,o.__)("Exclusive"),value:"exclusive"}],description:(0,o.__)("Define what is tax type of the item.")},{label:(0,o.__)("Tax Group"),name:"tax_group_id",type:"select",options:[],description:(0,o.__)("Choose the tax group that should apply to the item.")}]}},mounted:function(){this.popupCloser(),this.loadData()}};const _=(0,i(1900).Z)(p,(function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",{staticClass:"w-95vw flex flex-col h-95vh shadow-lg md:w-3/5-screen lg:w-2/5-screen md:h-3/5-screen bg-white"},[i("div",{staticClass:"header bg-white border-b flex justify-between p-2 items-center"},[i("h3",[e._v(e._s(e.__("Product / Service")))]),e._v(" "),i("div",[i("ns-close-button",{on:{click:function(t){return e.close()}}})],1)]),e._v(" "),i("div",{staticClass:"p-2 flex-auto overflow-y-auto"},[e.loaded?e._e():i("div",{staticClass:"h-full w-full flex justify-center items-center"},[i("ns-spinner")],1),e._v(" "),e.loaded?e._l(e.fields,(function(e,t){return i("ns-field",{key:t,attrs:{field:e}})})):e._e()],2),e._v(" "),i("div",{staticClass:"border-t flex justify-between p-2"},[i("div"),e._v(" "),i("div",[i("ns-button",{attrs:{type:"info"},on:{click:function(t){return e.addProduct()}}},[e._v(e._s(e.__("Create")))])],1)])])}),[],!1,null,null,null).exports}}]);