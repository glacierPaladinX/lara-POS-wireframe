"use strict";(self.webpackChunkNexoPOS_4x=self.webpackChunkNexoPOS_4x||[]).push([[781],{8781:(e,s,t)=>{t.r(s),t.d(s,{default:()=>o});var i=t(7266),n=t(9671),r=t(2277),a=t(7389);const l={name:"ns-register",data:function(){return{fields:[],xXsrfToken:null,validation:new i.Z}},mounted:function(){var e=this;(0,r.D)([n.ih.get("/api/nexopos/v4/fields/ns.register"),n.ih.get("/sanctum/csrf-cookie")]).subscribe((function(s){e.fields=e.validation.createFields(s[0]),e.xXsrfToken=n.ih.response.config.headers["X-XSRF-TOKEN"],setTimeout((function(){return n.kq.doAction("ns-register-mounted",e)}))}))},methods:{__:a.__,register:function(){var e=this;if(!this.validation.validateFields(this.fields))return n.kX.error((0,a.__)("Unable to proceed the form is not valid.")).subscribe();this.validation.disableFields(this.fields),n.kq.applyFilters("ns-register-submit",!0)&&n.ih.post("/auth/sign-up",this.validation.getValue(this.fields),{headers:{"X-XSRF-TOKEN":this.xXsrfToken}}).subscribe((function(e){n.kX.success(e.message).subscribe(),setTimeout((function(){document.location=e.data.redirectTo}),1500)}),(function(s){e.validation.triggerFieldsErrors(e.fields,s),e.validation.enableFields(e.fields),n.kX.error(s.message).subscribe()}))}}};const o=(0,t(1900).Z)(l,(function(){var e=this,s=e.$createElement,t=e._self._c||s;return t("div",{staticClass:"ns-box rounded shadow overflow-hidden transition-all duration-100"},[t("div",{staticClass:"ns-box-body"},[t("div",{staticClass:"p-3 -my-2"},[e.fields.length>0?t("div",{staticClass:"py-2 fade-in-entrance anim-duration-300"},e._l(e.fields,(function(e,s){return t("ns-field",{key:s,attrs:{field:e}})})),1):e._e()]),e._v(" "),0===e.fields.length?t("div",{staticClass:"flex items-center justify-center"},[t("ns-spinner")],1):e._e(),e._v(" "),t("div",{staticClass:"flex w-full items-center justify-center py-4"},[t("a",{staticClass:"link hover:underline text-sm",attrs:{href:"/sign-in"}},[e._v(e._s(e.__("Already registered ?")))])])]),e._v(" "),t("div",{staticClass:"flex ns-box-footer border-t justify-between items-center p-3"},[t("div",[t("ns-button",{attrs:{type:"info"},on:{click:function(s){return e.register()}}},[e._v(e._s(e.__("Register")))])],1),e._v(" "),t("div",[t("ns-button",{attrs:{link:!0,href:"/sign-in",type:"success"}},[e._v(e._s(e.__("Sign In")))])],1)])])}),[],!1,null,null,null).exports}}]);