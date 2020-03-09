var monthlist = [ "", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];

Vue.use(VueTables.ServerTable);
var userlogs = new Vue({
    el: '#userlogs_page',
    data: {
        table: {
        column: [
            'userlog_id',
            "username",
            "fullname",
            "module",
            "ulog_title",
            "date_added",
            "log_time"],
        data: [],
        options: {
            headings: {
                fullname: 'Names (Lastname, Firstname)',
                ulog_title: 'Log Title',
                date_added: 'Log Date',
                log_duration: 'Log Time',
            },
            sortable: ['username','ulog_title','fullname','module','date_added'],
            filterable: ['username','ulog_title','fullname','module','date_added']
        }
    },
    },
    methods: {
        properDateFormat(date_added){
            var time = "AM";
            var d = new Date(date_added),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            var hr = d.getHours();
            var min = d.getMinutes();
            var sec = d.getSeconds();

            hr = hr < 10 ? "0" + hr : hr;
            min = min < 10 ? "0" + min : min;
            sec = sec < 10 ? "0" + sec : sec;

            time = hr < 12 ? 'AM' : 'PM';
            
            hr = hr % 12 || 12
            

            month = monthlist[month];
            var returndateformat = month + " " + day + ", " + year + " | " + hr + ":" + min + ":" + sec + " " + time;
            return returndateformat;
        },
        computerLogTime(date_added){
            var d = new Date(date_added);
            var d_year = d.getFullYear();
            var d_month = '' + (d.getMonth() + 1);
            var d_day = '' + d.getDate();
            var d_hr = d.getHours();
            var d_min = d.getMinutes();
            var d_sec = d.getSeconds();

            var n = new Date();
            var n_year = n.getFullYear();
            var n_month = '' + (n.getMonth() + 1);
            var n_day = '' + n.getDate();
            var n_hr = n.getHours();
            var n_min = n.getMinutes();
            var n_sec = n.getSeconds();

            if(n_year-d_year > 0){
                var time = n_year-d_year > 1 ? " years ago" : " year ago";
                return n_year-d_year + time;
            }else if(n_month-d_month > 0){
                var time = n_month-d_month > 1 ? " months ago" : " month ago";
                return n_month-d_month + time;
            }else if(n_day-d_day > 0){
                var time = n_day-d_day > 1 ? " days ago" : " day ago";
                return n_day-d_day + time;
            }else if(n_hr-d_hr > 0){
                var time = n_hr-d_hr > 1 ? " hrs ago" : " hr ago";
                return n_hr-d_hr + time;
            }else if(n_min-d_min > 0){
                var time = n_min-d_min > 1 ? " mins ago" : " min ago";
                return n_min-d_min + time;
            }else if(n_sec-d_sec > 0){
                var time = n_sec-d_sec > 1 ? " secs ago" : " sec ago";
                return n_sec-d_sec + time;
            }
        },
    }, mounted: function () {
    },
})