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
        classAttendanceInfo: {
            schedule_date: formatDate(currentdate),
            attendance: [],
            attendance_id: [],
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
                    classsched.classAttendanceInfo.schedule_date = formatDate(currentdate);
                    classsched.classAttendanceInfo.attendance = [];
                    e.data.data.classStudents.forEach(e => {
                        classsched.classAttendanceInfo.attendance.push({
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
                }).then((result) => {
                    if (result.value) {
                        var datas = { 
                            schedule_id: this.classschedinfo.schedule_id,
                            attendanceinfo: this.classAttendanceInfo
                        };
                        var urls = window.App.baseUrl + "classes/addNewAttendance";
                        
                        axios.post(urls, datas)
                            .then(function (e) {
                                if(e.data.success){
                                    classsched.getclassSchedInfo();
                                }
                                Toast.fire({
                                    type: e.data.type,
                                    title: e.data.message
                                })
                                $('#addNewClassAttendanceModal').modal('hide');
                            })
                            .catch(function (error) {
                                console.log(error)
                            });
                    }
            })
        },
        editClassAttendanceModal(attendance_id){
            var datas = { 
                class_id: this.class_id,
                attendance_id: attendance_id
            };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "classes/getclassSchedInfo";
            axios.post(urls, datas)
                .then(function (e) {
                    classsched.classStudents=e.data.data.classStudents;
                    classsched.classAttendanceInfo.attendance = [];
                    JSON.parse(e.data.data.classScheds.attendance).forEach(e => {
                        classsched.classAttendanceInfo.attendance.push({
                            student_id: e.student_id,
                            studpack_id: e.studpack_id,
                            status: e.status,
                            origstat: e.status,
                        })
                    });
                    classsched.classAttendanceInfo.attendance_id = e.data.data.classScheds.attendance_id;
                    classsched.classAttendanceInfo.schedule_date = e.data.data.classScheds.schedule_date;
                    $('#editClassAttendanceModal').modal('show');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        changeAttendanceStat(index){
            var attinfo = this.classAttendanceInfo.attendance[index];
            attinfo.tmp_sessions_attended = parseInt(this.classStudents[index].sessions_attended);
            
            if(attinfo.status==true){
                attinfo.status=false;
                if(attinfo.origstat!=attinfo.status){
                    attinfo.tmp_sessions_attended -= 1;
                }
            }else{ 
                attinfo.status=true;
                if(attinfo.origstat!=attinfo.status){
                    attinfo.tmp_sessions_attended += 1;
                }
            }
        },
        submitAttendanceChanges(){
            Swal.fire({
                text: "Are you sure you want to save changes?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save changes',
                }).then((result) => {
                    if (result.value) {
                        var datas = { 
                            schedule_id: this.classschedinfo.schedule_id,
                            attendanceinfo: this.classAttendanceInfo,
                        };
                        var urls = window.App.baseUrl + "classes/saveAttendanceChanges";
                        
                        axios.post(urls, datas)
                            .then(function (e) {
                                if(e.data.success){
                                    classsched.getclassSchedInfo();
                                }
                                Toast.fire({
                                    type: e.data.type,
                                    title: e.data.message
                                })
                                $('#editClassAttendanceModal').modal('hide');
                            })
                            .catch(function (error) {
                                console.log(error)
                            });
                    }
            })
        }
    }, mounted: function () {
        this.getClassScheds();
        if(this.class_id!=0){
            this.getclassSchedInfo();
        }
    },
})