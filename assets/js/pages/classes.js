var monthlist = [ "", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];

var currentdate = formatDate(new Date());

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

var classsched = new Vue({
    el: '#classes_page',
    data: {
        classschedlist: {},
        classschedsheld: {},
        classschedinfo: {},
        classStudents: {},
        class_id:$('#class_id').val(),
        newClassAttendanceInfo: {
            schedule_date: formatDate(currentdate),
            attendance: []
        },
    },
    methods: {
        changeDateFormat(date){
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            // alert(month.length);
            // if (month.length < 2) month = '0' + month;
            // if (day.length < 2) day = '0' + day;

            month = monthlist[month];
            var returndateformat = month + " " + day + ", " + year;
            return returndateformat;
        },
        getClassScheds(){
            var urls = window.App.baseUrl + "classes/getClassScheds";
            axios.post(urls, "")
                .then(function (e) {
                    classsched.classschedlist=e.data.data;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getclassSchedInfo(){
            var datas = { class_id:this.class_id };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "classes/getclassSchedInfo";
            axios.post(urls, datas)
                .then(function (e) {
                    classsched.classschedinfo=e.data.data.classSchedinfo;
                    classsched.classschedsheld=e.data.data.classScheds;
                    classsched.classStudents=e.data.data.classStudents;
                    classsched.newClassAttendanceInfo.attendance = [];
                    e.data.data.classStudents.forEach(e => {
                        classsched.newClassAttendanceInfo.attendance.push({
                            student_id: e.student_id,
                            studpack_id: e.studpack_id,
                            status: true
                        })
                    });

                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        addNewAttendanceInfo(){
            Swal.fire({
                text: "Are you sure you want to submit attendance?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit attendance',
                // buttonsStyling: false
                }).then((result) => {
                    if (result.value) {
                        var datas = { 
                            schedule_id: this.classschedinfo.schedule_id,
                            attendanceinfo: this.newClassAttendanceInfo
                        };
                        var urls = window.App.baseUrl + "classes/addNewAttendance";
                        
                        axios.post(urls, datas)
                            .then(function (e) {
                                if(e.data.success){
                                    $('#addNewClassAttendanceModal').modal('hide');
                                    classsched.getclassSchedInfo();
                                }
                                Toast.fire({
                                    type: e.data.type,
                                    title: e.data.message
                                })
                            })
                            .catch(function (error) {
                                console.log(error)
                            });
                    }
            })
        },
        markAsPresent(){
            alert();
        },
    }, mounted: function () {
        this.getClassScheds();
        if(this.class_id!=0){
            this.getclassSchedInfo();
        }
    },
})