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

$(function () {
    'use strict'
  
    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }
  
    var mode      = 'index'
    var intersect = true
  
    var $salesChart = $('#sales-chart')
    var salesChart  = new Chart($salesChart, {
      type   : 'bar',
      data   : {
        labels  : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN'],
        datasets: [
          {
            backgroundColor: '#007bff',
            borderColor    : '#007bff',
            data           : [10, 20, 30, 25, 27, 25]
          },
          {
            backgroundColor: '#6c757d',
            borderColor    : '#6c757d',
            data           : [70, 17, 27, 20, 18, 15]
          },
          {
            backgroundColor: '#28a745',
            borderColor    : '#28a745',
            data           : [59, 50, 70, 100, 80, 85]
          },
          {
            backgroundColor: '#ffc107',
            borderColor    : '#ffc107',
            data           : [80, 85, 55, 95, 120, 100]
          },
          {
            backgroundColor: '#dc3545',
            borderColor    : '#dc3545',
            data           : [120, 100, 90, 95, 80, 45]
          },
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
            // display: false,
            gridLines: {
              display      : true,
              lineWidth    : '4px',
              color        : 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
              beginAtZero: true,
  
              // Include a dollar sign in the ticks
              callback: function (value, index, values) {
                if (value >= 1000) {
                  value /= 1000
                  value += 'k'
                }
                return '$' + value
              }
            }, ticksStyle)
          }],
          xAxes: [{
            display  : true,
            gridLines: {
              display: false
            },
            ticks    : ticksStyle
          }]
        }
      }
    })
  
    var $visitorsChart = $('#visitors-chart')
    var visitorsChart  = new Chart($visitorsChart, {
      data   : {
        labels  : ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
        datasets: [
          {
          type                : 'line',
          data                : [100, 120, 170, 167, 180, 177, 160],
          backgroundColor     : 'transparent',
          borderColor         : '#007bff',
          pointBorderColor    : '#007bff',
          pointBackgroundColor: '#007bff',
          fill                : false
          // pointHoverBackgroundColor: '#007bff',
          // pointHoverBorderColor    : '#007bff'
          },
          {
            type                : 'line',
            data                : [60, 80, 70, 67, 80, 77, 100],
            backgroundColor     : 'tansparent',
            borderColor         : '#6c757d',
            pointBorderColor    : '#6c757d',
            pointBackgroundColor: '#6c757d',
            fill                : false
            // pointHoverBackgroundColor: '#6c757d',
            // pointHoverBorderColor    : '#6c757d'
          },
          {
            type                : 'line',
            data                : [200, 140, 190, 170, 200, 205, 165],
            backgroundColor     : 'tansparent',
            borderColor         : '#28a745',
            pointBorderColor    : '#28a745',
            pointBackgroundColor: '#28a745',
            fill                : false
            // pointHoverBackgroundColor: '#28a745',
            // pointHoverBorderColor    : '#28a745'
          },
          {
            type                : 'line',
            data                : [10, 50, 60, 70, 130, 150, 210],
            backgroundColor     : 'tansparent',
            borderColor         : '#dc3545',
            pointBorderColor    : '#dc3545',
            pointBackgroundColor: '#dc3545',
            fill                : false
            // pointHoverBackgroundColor: '#dc3545',
            // pointHoverBorderColor    : '#dc3545'
          },
          {
            type                : 'line',
            data                : [120, 100, 90, 87, 100, 97, 120],
            backgroundColor     : 'tansparent',
            borderColor         : '#ffc107',
            pointBorderColor    : '#ffc107',
            pointBackgroundColor: '#ffc107',
            fill                : false
            // pointHoverBackgroundColor: '#ffc107',
            // pointHoverBorderColor    : '#ffc107'
          },
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
            // display: false,
            gridLines: {
              display      : true,
              lineWidth    : '4px',
              color        : 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
              beginAtZero : true,
              suggestedMax: 200
            }, ticksStyle)
          }],
          xAxes: [{
            display  : true,
            gridLines: {
              display: false
            },
            ticks    : ticksStyle
          }]
        }
      }
    })
  })
  