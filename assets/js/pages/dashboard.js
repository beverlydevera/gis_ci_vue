// Vue.use(VueTables.ClientTable);
var monthlist = [ "", "Jan", "Febr", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
var dashboard = new Vue({
    el: '#dashboard_page',
    data: {
        userrole:$('#userrole').val(),
        branch_id:$('#branch_id').val(),
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
        url: window.App.baseUrl + 'Dashboard/chartsdata',
        beforeSend: function () {
        },
        success: function (e) {
            var labelMonths = [];

            if($('#userrole').val()==1){
                var stud_abanao = [];
                var stud_arcadian = [];
                var stud_buyagan = [];
                var stud_albergo = [];
                var stud_itogon = [];
                
                var medals_abanao = [];
                var medals_arcadian = [];
                var medals_buyagan = [];
                var medals_albergo = [];
                var medals_itogon = [];

                e.students_data.forEach(el => {
                    labelMonths.push(el.month_name);
                    stud_abanao.push(el.stud_abanao);
                    stud_arcadian.push(el.stud_arcadian);
                    stud_buyagan.push(el.stud_buyagan);
                    stud_albergo.push(el.stud_albergo);
                    stud_itogon.push(el.stud_itogon);
                });
                admin_studentsdata_chart(labelMonths , stud_abanao , stud_arcadian , stud_buyagan , stud_albergo , stud_itogon);
    
                e.medals_data.forEach(el => {
                    medals_abanao.push(el.medals_abanao);
                    medals_arcadian.push(el.medals_arcadian);
                    medals_buyagan.push(el.medals_buyagan);
                    medals_albergo.push(el.medals_albergo);
                    medals_itogon.push(el.medals_itogon);
                });
                admin_medalsdata_chart(labelMonths , medals_abanao , medals_arcadian , medals_buyagan , medals_albergo , medals_itogon);
            }else{
                var stud_data = [];
                var mdls_data = [];
                var branch_name = "";

                branch_name = e.branch_name;
                e.students_data.forEach(el => {
                    labelMonths.push(el.month_name);
                    stud_data.push(el.stud_data);
                });
                cashier_studentsdata_chart(labelMonths , stud_data, branch_name);

                e.medals_data.forEach(el => {
                    mdls_data.push(el.mdls_data);
                });
                cashier_medalsdata_chart(labelMonths , mdls_data, branch_name);
            }
            
        }
    })

    function admin_studentsdata_chart(labelMonths , stud_abanao , stud_arcadian , stud_buyagan , stud_albergo , stud_itogon) {
        var ctx = document.getElementById("studentschart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelMonths,
                datasets: [{
                    label: 'Abanao',
                    data: stud_abanao,
                    backgroundColor: '#007bff',
                    borderColor: '#000',
                    borderWidth: 0.5
                }, {
                    label: 'Arcadian',
                    data: stud_arcadian,
                    backgroundColor: '#6c757d',
                    borderColor: '#000',
                    borderWidth: 0.5
                }, {
                    label: 'Buyagan',
                    data: stud_buyagan,
                    backgroundColor: '#28a745',
                    borderColor: '#000',
                    borderWidth: 0.5
                }, {
                    label: 'Albergo',
                    data: stud_albergo,
                    backgroundColor: '#ffc107',
                    borderColor: '#000',
                    borderWidth: 0.5
                }, {
                    label: 'Itogon',
                    data: stud_itogon,
                    backgroundColor: '#dc3545',
                    borderColor: '#000',
                    borderWidth: 0.5
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

    function admin_medalsdata_chart(labelMonths , medals_abanao , medals_arcadian , medals_buyagan , medals_albergo , medals_itogon) {
        var ctx = document.getElementById("medalschart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labelMonths,
                datasets: [{
                    label: 'Abanao',
                    data: medals_abanao,
                    // backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    borderWidth: 1
                }, {
                    label: 'Arcadian',
                    data: medals_arcadian,
                    // backgroundColor: '#6c757d',
                    borderColor: '#6c757d',
                    borderWidth: 1
                }, {
                    label: 'Buyagan',
                    data: medals_buyagan,
                    // backgroundColor: '#28a745',
                    borderColor: '#28a745',
                    borderWidth: 1
                }, {
                    label: 'Albergo',
                    data: medals_albergo,
                    // backgroundColor: '#ffc107',
                    borderColor: '#ffc107',
                    borderWidth: 1
                }, {
                    label: 'Itogon',
                    data: medals_itogon,
                    // backgroundColor: '#dc3545',
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

    function cashier_studentsdata_chart(labelMonths , stud_data, branch_name) {
        var ctx = document.getElementById("studentschart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelMonths,
                datasets: [{
                    label: branch_name,
                    data: stud_data,
                    backgroundColor: '#007bff',
                    borderColor: '#000',
                    borderWidth: 0.5
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

    function cashier_medalsdata_chart(labelMonths , mdls_data, branch_name) {
        var ctx = document.getElementById("medalschart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labelMonths,
                datasets: [{
                    label: branch_name,
                    data: mdls_data,
                    // backgroundColor: '#007bff',
                    borderColor: '#007bff',
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