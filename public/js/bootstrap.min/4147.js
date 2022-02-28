"use strict";(self.webpackChunkNexoPOS_4x=self.webpackChunkNexoPOS_4x||[]).push([[4147],{4147:(e,t,r)=>{r.r(t),r.d(t,{default:()=>d});var n=r(7266),s=r(9671),a=r(7389);function i(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function o(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?i(Object(r),!0).forEach((function(t){l(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):i(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function l(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}function u(e){return u="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},u(e)}const c={name:"ns-pos-layaway-popup",data:function(){return{fields:[],instalments:[],formValidation:new n.Z,subscription:null,totalPayments:0}},mounted:function(){var e=this;this.loadFields(),this.subscription=this.$popup.event.subscribe((function(t){["click-overlay","press-esc"].includes(t.event)&&e.close()}))},updated:function(){var e=this;setTimeout((function(){document.querySelector(".is-popup #total_instalments").addEventListener("change",(function(){var t=e.formValidation.extractFields(e.fields).total_instalments;e.generatePaymentFields(t)})),document.querySelector(".is-popup #total_instalments").addEventListener("focus",(function(){document.querySelector(".is-popup #total_instalments").select()}))}),200)},computed:{expectedPayment:function(){var e=this.order.customer.group.minimal_credit_payment;return nsRawCurrency(this.order.total*e/100)},order:function(){return this.$popupParams.order.instalments=this.$popupParams.order.instalments.map((function(e){for(var t in e)if("object"!==u(e[t]))if("date"===t){var r={type:"date",name:t,label:(0,a.__)("Date"),disabled:1===e.paid,value:moment(e.date).format("YYYY-MM-DD")};e[t]=r}else if("amount"===t){var n={type:"number",name:t,label:(0,a.__)("Amount"),disabled:1===e.paid,value:e.amount};e[t]=n}else if(!["paid","id"].includes(t)){var s={type:"hidden",name:t,value:e[t]};e[t]=s}return e})),this.$popupParams.order}},destroyed:function(){this.subscription.unsubscribe()},methods:{__:a.__,refreshTotalPayments:function(){if(this.order.instalments.length>0){var e=nsRawCurrency(this.order.instalments.map((function(e){return parseFloat(e.amount.value)||0})).reduce((function(e,t){return parseFloat(e)+parseFloat(t)})));this.totalPayments=this.order.total-e}else this.totalPayments=0},generatePaymentFields:function(e){var t=this;this.order.instalments=new Array(parseInt(e)).fill("").map((function(e,r){return{date:{type:"date",name:"date",label:"Date",value:0===r?ns.date.moment.format("YYYY-MM-DD"):""},amount:{type:"number",name:"amount",label:"Amount",value:0===r?t.expectedPayment:0},readonly:{type:"hidden",name:"readonly",value:t.expectedPayment>0&&0===r}}})),this.$forceUpdate(),this.refreshTotalPayments()},close:function(){this.$popupParams.reject({status:"failed",message:(0,a.__)("You must define layaway settings before proceeding.")}),this.$popup.close()},updateOrder:function(){var e=this;if(0===this.order.instalments.length)return s.kX.error((0,a.__)("Please provide instalments before proceeding.")).subscribe();if(this.fields.forEach((function(t){return e.formValidation.validateField(t)})),!this.formValidation.fieldsValid(this.fields))return s.kX.error((0,a.__)("Unable to procee the form is not valid")).subscribe();this.$forceUpdate();var t=this.order.instalments.map((function(e){return{amount:parseFloat(e.amount.value),date:e.date.value}})),r=nsRawCurrency(t.map((function(e){return e.amount})).reduce((function(e,t){return parseFloat(e)+parseFloat(t)})));if(t.filter((function(e){return void 0===e.date||""===e.date})).length>0)return s.kX.error((0,a.__)("One or more instalments has an invalid date.")).subscribe();if(t.filter((function(e){return!(e.amount>0)})).length>0)return s.kX.error((0,a.__)("One or more instalments has an invalid amount.")).subscribe();if(t.filter((function(e){return moment(e.date).isBefore(ns.date.moment.startOf("day"))})).length>0)return s.kX.error((0,a.__)("One or more instalments has a date prior to the current date.")).subscribe();var n=t.filter((function(e){return moment(e.date).isSame(ns.date.moment.startOf("day"),"day")})),i=0;if(n.forEach((function(e){i+=parseFloat(e.amount)})),i<this.expectedPayment)return s.kX.error((0,a.__)("The payment to be made today is less than what is expected.")).subscribe();if(r<nsRawCurrency(this.order.total))return s.kX.error((0,a.__)("Total instalments must be equal to the order total.")).subscribe();t.sort((function(e,t){var r=moment(e.date),n=moment(t.date);return r.isBefore(n)?-1:r.isAfter(n)?1:0}));var l=this.formValidation.extractFields(this.fields);l.final_payment_date=t.reverse()[0].date,l.total_instalments=t.length;var u=o(o(o({},this.$popupParams.order),l),{},{instalments:t}),c=this.$popupParams,d=c.resolve;c.reject;return this.$popup.close(),POS.order.next(u),d(u)},loadFields:function(){var e=this;s.ih.get("/api/nexopos/v4/fields/ns.layaway").subscribe((function(t){e.fields=e.formValidation.createFields(t),e.fields.forEach((function(t){"total_instalments"===t.name&&(t.value=e.order.total_instalments||0)}))}))}}};const d=(0,r(1900).Z)(c,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"shadow-lg h-95vh md:h-5/6-screen lg:h-5/6-screen w-95vw md:w-4/6-screen lg:w-3/6-screen bg-surface-tertiary flex flex-col"},[r("div",{staticClass:"p-2 border-b border-surface-secondary flex justify-between items-center"},[r("h3",{staticClass:"font-semibold"},[e._v(e._s(e.__("Layaway Parameters")))]),e._v(" "),r("div",[r("ns-close-button",{on:{click:function(t){return e.close()}}})],1)]),e._v(" "),r("div",{staticClass:"p-2 flex-auto flex flex-col relative overflow-y-auto"},[0===e.fields.length?r("div",{staticClass:"absolute h-full w-full flex items-center justify-center"},[r("ns-spinner")],1):e._e(),e._v(" "),r("div",{staticClass:"p-2 text-white bg-info-primary mb-2 text-center text-2xl font-bold flex justify-between"},[r("span",[e._v(e._s(e.__("Minimum Payment")))]),e._v(" "),r("span",[e._v(e._s(e._f("currency")(e.expectedPayment)))])]),e._v(" "),r("div",e._l(e.fields,(function(e,t){return r("ns-field",{key:t,attrs:{field:e}})})),1),e._v(" "),r("div",{staticClass:"flex flex-col flex-auto overflow-hidden"},[r("div",{staticClass:"border-b border-surface-secondary"},[r("h3",{staticClass:"text-2xl flex justify-between py-2 text-primary"},[r("span",[e._v(e._s(e.__("Instalments & Payments")))]),e._v(" "),r("p",[r("span",{staticClass:"text-sm"},[e._v("("+e._s(e._f("currency")(e.totalPayments))+")")]),e._v(" "),r("span",[e._v("\n                        "+e._s(e._f("currency")(e.order.total))+"\n                        ")])])]),e._v(" "),r("p",{staticClass:"p-2 mb-2 text-center bg-green-200 text-green-700"},[e._v("\n                    "+e._s(e.__("The final payment date must be the last within the instalments."))+"\n                ")])]),e._v(" "),r("div",{staticClass:"flex-auto overflow-y-auto"},[e._l(e.order.instalments,(function(t,n){return r("div",{key:n,staticClass:"flex w-full -mx-1 py-2"},[r("div",{staticClass:"flex flex-auto"},[r("div",{staticClass:"px-1 w-full md:w-1/2"},[r("ns-field",{attrs:{field:t.date},on:{change:function(t){return e.refreshTotalPayments()}}})],1),e._v(" "),r("div",{staticClass:"px-1 w-full md:w-1/2"},[r("ns-field",{attrs:{field:t.amount},on:{change:function(t){return e.refreshTotalPayments()}}})],1)]),e._v(" "),e._m(0,!0)])})),e._v(" "),0===e.order.instalments.length?r("div",{staticClass:"my-2"},[r("p",{staticClass:"p-2 bg-surface-secondary text-primary text-center"},[e._v(e._s(e.__("There is no instalment defined. Please set how many instalments are allowed for this order")))])]):e._e()],2)])]),e._v(" "),r("div",{staticClass:"p-2 flex border-t border-surface-secondary justify-between flex-shrink-0"},[r("div"),e._v(" "),r("div",{staticClass:"-mx-1 flex"},[r("div",{staticClass:"px-1"},[r("ns-button",{attrs:{type:"danger"},on:{click:function(t){return e.close()}}},[e._v(e._s(e.__("Cancel")))])],1),e._v(" "),r("div",{staticClass:"px-1"},[r("ns-button",{attrs:{type:"info"},on:{click:function(t){return e.updateOrder()}}},[e._v(e._s(e.__("Proceed")))])],1)])])])}),[function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"flex items-center"},[t("button",{staticClass:"items-center flex justify-center h-8 w-8 rounded border border-surface-secondary hover:bg-error-primary text-primary hover:border-error-primary hover:text-white"},[t("i",{staticClass:"las la-times"})])])}],!1,null,null,null).exports}}]);