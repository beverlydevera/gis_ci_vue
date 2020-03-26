// Vue.use(VueTables.ClientTable);
var monthlist = [ "", "Jan", "Febr", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
var dashboard = new Vue({
    el: '#dashboard_page',
    data: {
        reportsummary: {
            students: 0,
            newstudents: 0,
            classes: 0,
            awards: 0
        },
        reportdata: [],
        otherdata: {
            role: 0,
            branch_id: 0,
            reporttype: ""
        },
        announcementslist: [],
        announcementsdata: {}
    },
    methods: {
        changeDateFormat(date){
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();
            month = monthlist[month];
            var returndateformat = month + ". " + day + ", " + year;
            return returndateformat;
        },
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
                    dashboard.reportdata = e.data.data.reportdata;
                    dashboard.otherdata.role       = e.data.data.role;
                    dashboard.otherdata.branch_id  = e.data.data.branch_id;
                    dashboard.otherdata.reporttype  = reporttype;
                    $('#reportDetails_modal').modal('show');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getNewAnnouncements(){
            var d = new Date();
            var datas = {
                "select": "announcement_id,title,text,date_added",
                "condition": "date_posted>="+d.setDate(d.getDate()-5),
                "pager": {
                    "limit": 5,
                    "offset": ""
                }
            };
            var urls = window.App.baseUrl + "Announcements/getAnnouncements";
            axios.post(urls, datas)
                .then(function (e) {
                    dashboard.announcementslist = e.data.data.announcementslist;
                    dashboard.announcementslist.forEach((e,index) => {
                        dashboard.announcementslist[index].date_added = dashboard.changeDateFormat(e.date_added);
                    });
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        announcement_ReadMore(announcement_id){
            $('#show_announcementtext-'+announcement_id).css({'display': 'none',});
            $('#hide_announcementtext-'+announcement_id).css({'display': '',});
            $('#readMore-'+announcement_id).css({'display': 'none',});
            $('#lessData-'+announcement_id).css({'display': '',});
        },
        announcement_ShowLess(announcement_id){
            $('#show_announcementtext-'+announcement_id).css({'display': '',});
            $('#hide_announcementtext-'+announcement_id).css({'display': 'none',});
            $('#readMore-'+announcement_id).css({'display': '',});
            $('#lessData-'+announcement_id).css({'display': 'none',});
        }
    }, mounted: function () {
        this.getReportSummary();
        this.getNewAnnouncements();
    },
})