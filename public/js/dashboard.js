(window.webpackJsonp=window.webpackJsonp||[]).push([[5],{260:function(e,t,r){e.exports=r(261)},261:function(e,t,r){"use strict";r.r(t),r.d(t,"Dashboard",(function(){return o}));var s=r(42),n=r(0),o=function(){function e(){for(var e in this._reports={day:n.nsHttpClient.get("/api/nexopos/v4/dashboard/day"),bestCustomers:n.nsHttpClient.get("/api/nexopos/v4/dashboard/best-customers"),weeksSummary:n.nsHttpClient.get("/api/nexopos/v4/dashboard/weeks"),bestCashiers:n.nsHttpClient.get("/api/nexopos/v4/dashboard/best-cashiers"),recentOrders:n.nsHttpClient.get("/api/nexopos/v4/dashboard/recent-orders")},this._day=new s.a({}),this._bestCustomers=new s.a([]),this._weeksSummary=new s.a({}),this._bestCashiers=new s.a([]),this._recentOrders=new s.a([]),this._reports)this.loadReport(e)}return e.prototype.loadReport=function(e){var t=this;return this._reports[e].subscribe((function(r){t["_"+e].next(r)}))},Object.defineProperty(e.prototype,"day",{get:function(){return this._day},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"bestCustomers",{get:function(){return this._bestCustomers},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"bestCashiers",{get:function(){return this._bestCashiers},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"recentOrders",{get:function(){return this._recentOrders},enumerable:!1,configurable:!0}),Object.defineProperty(e.prototype,"weeksSummary",{get:function(){return this._weeksSummary},enumerable:!1,configurable:!0}),e}();window.Dashboard=new o}},[[260,0,1]]]);
//# sourceMappingURL=dashboard.js.map