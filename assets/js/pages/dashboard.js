// Vue.use(VueTables.ClientTable);
var dashboard = new Vue({
    el: '#dashboard_page',
    data: {
        reportsummary: {
            students: 0,
            newstudents: 0,
            classes: 0,
            awards: 0
        },
        reportdetails: {

        }
    },
    methods: {
        getReportSummary(){
            var datas = {
                "branch_id": 1
            };
            var urls = window.App.baseUrl + "Dashboard/getReportSummary";
            axios.post(urls, datas)
                .then(function (e) {
                    dashboard.reportsummary=e.data.data.reportsummary;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        viewMoreInfo(reporttype){
            var datas = {
                "reporttype": reporttype
            };
            var urls = window.App.baseUrl + "Dashboard/getReportDetails";
            axios.post(urls, datas)
                .then(function (e) {
                    dashboard.reportdetails = e.data.data.reportdetails;
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
    }, mounted: function () {
        this.getReportSummary();
    },
})