"use strict";(self.webpackChunknexopos_4x=self.webpackChunknexopos_4x||[]).push([[232],{5232:(e,t,n)=>{n.r(t),n.d(t,{default:()=>d});var o=n(381),r=n.n(o),s=n(1544),i=n(1828),a=n(9671),u=n(3601),c=n(2744);const p={name:"ns-yearly-report",mounted:function(){""!==this.timezone&&(this.year=ns.date.getMoment().format("Y"),this.loadReport())},components:{nsDatepicker:s.Z,nsNotice:i.Z,nsDateTimePicker:c.Z},data:function(){return{startDate:r()(),endDate:r()(),report:{},timezone:ns.date.timeZone,year:"",labels:["month_paid_orders","month_taxes","month_expenses","month_income"]}},computed:{totalDebit:function(){return 0},totalCredit:function(){return 0}},methods:{setStartDate:function(e){this.startDate=e.format()},setEndDate:function(e){this.endDate=e.format()},printSaleReport:function(){this.$htmlToPaper("annual-report")},sumOf:function(e){return Object.values(this.report).length>0?Object.values(this.report).map((function(t){return parseFloat(t[e])||0})).reduce((function(e,t){return e+t})):0},recomputeForSpecificYear:function(){var e=this;Popup.show(u.default,{title:__("Would you like to proceed ?"),message:__("The report will be computed for the current year, a job will be dispatched and you'll be informed once it's completed."),onAction:function(t){t&&a.ih.post("/api/nexopos/v4/reports/compute/yearly",{year:e.year}).subscribe((function(e){a.kX.success(e.message).subscribe()}),(function(e){a.kX.success(e.message||__("An unexpected error has occured.")).subscribe()}))}})},getReportForMonth:function(e){return console.log(this.report,e),this.report[e]},loadReport:function(){var e=this,t=this.year;a.ih.post("/api/nexopos/v4/reports/annual-report",{year:t}).subscribe((function(t){e.report=t}),(function(e){a.kX.error(e.message).subscribe()}))}}},l=p;const d=(0,n(1900).Z)(l,undefined,undefined,!1,null,null,null).exports}}]);