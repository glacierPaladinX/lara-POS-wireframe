"use strict";(self.webpackChunkNexoPOS_4x=self.webpackChunkNexoPOS_4x||[]).push([[8774],{8774:(t,e,s)=>{s.r(e),s.d(e,{default:()=>r});const i={data:function(){return{title:"",message:""}},computed:{size:function(){return this.$popupParams.size||"h-full w-full"}},mounted:function(){var t=this;this.title=this.$popupParams.title,this.message=this.$popupParams.message,this.$popup.event.subscribe((function(e){"click-overlay"===e.event&&(t.$popupParams.onAction(!1),t.$popup.close())}))},methods:{__:s(7389).__,emitAction:function(t){this.$popupParams.onAction(t),this.$popup.close()}}};const r=(0,s(1900).Z)(i,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"flex flex-col bg-white shadow-lg w-5/7-screen md:w-4/7-screen lg:w-2/7-screen",class:t.size,attrs:{id:"popup"}},[s("div",{staticClass:"flex items-center justify-center flex-col flex-auto p-4"},[s("h2",{staticClass:"text-xl md:text-3xl font-body text-gray-700 text-center"},[t._v(t._s(t.title))]),t._v(" "),s("p",{staticClass:"py-4 text-sm md:text-base text-gray-600 text-center"},[t._v(t._s(t.message))])]),t._v(" "),s("div",{staticClass:"flex border-t border-gray-200 text-gray-700"},[s("button",{staticClass:"hover:bg-gray-100 flex-auto w-1/2 h-16 flex items-center justify-center uppercase",on:{click:function(e){return t.emitAction(!0)}}},[t._v(t._s(t.__("Yes")))]),t._v(" "),s("hr",{staticClass:"border-r border-gray-200"}),t._v(" "),s("button",{staticClass:"hover:bg-gray-100 flex-auto w-1/2 h-16 flex items-center justify-center uppercase",on:{click:function(e){return t.emitAction(!1)}}},[t._v(t._s(t.__("No")))])])])}),[],!1,null,null,null).exports}}]);