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

$(function(){
    $.ajax({
        type: "POST",
        url: window.App.baseUrl + 'Dashboard/admin_studentsdata_chart',
        beforeSend: function () {
        },
        success: function (e) {
            var labelMonths = [];
            var stud_abanao = [];
            var stud_arcadian = [];
            var stud_buyagan = [];
            var stud_albergo = [];
            var stud_itogon = [];

            e.students_data.forEach(el => {
                labelMonths.push(el.month_name);
                stud_abanao.push(el.stud_abanao);
                stud_arcadian.push(el.stud_arcadian);
                stud_buyagan.push(el.stud_buyagan);
                stud_albergo.push(el.stud_albergo);
                stud_itogon.push(el.stud_itogon);
            });
            admin_studentsdata_chart(labelMonths , stud_abanao , stud_arcadian , stud_buyagan , stud_albergo , stud_itogon);
        }
    })

    function admin_studentsdata_chart(labelMonths , stud_abanao , stud_arcadian , stud_buyagan , stud_albergo , stud_itogon) {
    var ctx = document.getElementById("admin_studentschart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelMonths,
            datasets: [{
                label: 'Abanao',
                data: stud_abanao,
                backgroundColor: '#007bff',
                borderColor: '#007bff',
                borderWidth: 1
            }, {
                label: 'Arcadian',
                data: stud_arcadian,
                backgroundColor: '#6c757d',
                borderColor: '#6c757d',
                borderWidth: 1
            }, {
                label: 'Buyagan',
                data: stud_buyagan,
                backgroundColor: '#28a745',
                borderColor: '#28a745',
                borderWidth: 1
            }, {
                label: 'Albergo',
                data: stud_albergo,
                backgroundColor: '#ffc107',
                borderColor: '#ffc107',
                borderWidth: 1
            }, {
                label: 'Itogon',
                data: stud_itogon,
                backgroundColor: '#dc3545',
                borderColor: '#dc3545',
                borderWidth: 1
            }, ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}
})