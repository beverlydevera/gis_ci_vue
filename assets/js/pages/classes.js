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
        classschedlist: [],
        class_id:$('#class_id').val(),
        classschedinfo: {},
        classschedsheld: [],
        classstudents: [],
        newClassAttendance: {
            schedule_date: "",
            attendance: []
        },
        addStudent: {
            searchInput: "",
            searchstudentslist: []
        },
        classattendanceinfo: {
            schedule_date: "",
            attendance: []
        },
        classattendancestudents: []
    },
    methods: {
        changeDateFormat(date){
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();
            // if (month.length < 2) month = '0' + month;
            // if (day.length < 2) day = '0' + day;
            month = monthlist[month];
            var returndateformat = month + " " + day + ", " + year;
            return returndateformat;
        },
        getClassSchedulesList(){
            var datas = {
                select: "*",
                orderby: {
                    column: "c.class_title",
                    order: "ASC",
                },
                condition: {
                    "s.status": 1
                }
            };
            var urls = window.App.baseUrl + "Classes/getClassSchedulesList";
            axios.post(urls, datas)
                .then(function (e) {
                    classsched.classschedlist=e.data.data.classschedlist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getclassSchedInfo(){
            var datas = { 
                class_id:this.class_id
            };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "Classes/getclassSchedInfo";
            showloading("Loading Data");
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    classsched.classschedinfo   = e.data.data.classschedinfo;

                    classsched.classschedsheld  = e.data.data.classschedsheld;
                    if(e.data.data.classschedsheld!=null){
                        classsched.classschedsheld.forEach((e,index) => {
                            classsched.classschedsheld[index].attendance = JSON.parse(e.attendance);

                            var present = absent = 0;
                            e.attendance.forEach(el => {    
                                if(el.status){ present++; }
                                else{ absent++; }
                                classsched.classschedsheld[index].present = present;
                                classsched.classschedsheld[index].absent = absent;
                            });
                        });
                    }

                    classsched.classstudents = e.data.data.classstudents;
                    if(e.data.data.classstudents!=null){
                        classsched.newClassAttendance = {
                            schedule_date: "",
                            attendance: []
                        };
                        classsched.classstudents.forEach((e,index) => {
                            classsched.classstudents[index].details = JSON.parse(e.details);
                            if(classsched.newClassAttendance!=null){
                                classsched.newClassAttendance.attendance.push({
                                    student_id: e.student_id,
                                    studpack_id: e.studpack_id,
                                    status: true,
                                    remove: false
                                })
                            }else{
                                classsched.newClassAttendance.attendance = ({
                                    student_id: e.student_id,
                                    studpack_id: e.studpack_id,
                                    status: true,
                                    remove: false
                                })
                            }
                        });
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        searchStudent(){
            if(this.addStudent.searchInput!=""){
                var existing = ["0"];
                this.newClassAttendance.attendance.forEach(e => {
                    existing.push(e.student_id);
                });
                var datas = { 
                    searchInput: this.addStudent.searchInput,
                    existing: existing
                };
                var datas = frmdata(datas);
                var urls = window.App.baseUrl + "Classes/getStudentsList";
                axios.post(urls, datas)
                    .then(function (e) {
                        classsched.addStudent.searchstudentslist = e.data.data.studentslist;
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            }
        },
        addtoAttendance(action,index){
            if(action=='add'){
                var studentsdata = {
                    student_id     : this.addStudent.searchstudentslist[index].student_id,
                    lastname       : this.addStudent.searchstudentslist[index].lastname,
                    firstname      : this.addStudent.searchstudentslist[index].firstname,
                    middlename     : this.addStudent.searchstudentslist[index].middlename,
                    reference_id   : this.addStudent.searchstudentslist[index].reference_id,
                    sex            : this.addStudent.searchstudentslist[index].sex,
                    details:{
                        sessions: 0,
                        sessions_attended: 0
                    }
                };
                this.classstudents.push(studentsdata);
                var attendancedata = {
                    studpack_id: this.addStudent.searchstudentslist[index].studpack_id,
                    student_id: this.addStudent.searchstudentslist[index].student_id,
                    status: true,
                    remove: true
                };
                this.newClassAttendance.attendance.push(attendancedata);
                this.addStudent.searchstudentslist.splice(index, 1);
            }
        },
        removefromAttendance(action,index){
            if(action=="add"){
                this.classstudents.splice(index, 1);
                this.newClassAttendance.attendance.splice(index, 1);
                this.searchStudent();
            }else if(action=="edit"){
                this.classattendancestudents.splice(index, 1);
                this.classattendanceinfo.attendance.splice(index, 1);
                // this.searchStudent();
            }
        },
        submitNewAttendanceInfo(){
            this.newClassAttendance.schedule_id = this.classschedinfo.schedule_id;
            var datas = { 
                attendanceinfo: this.newClassAttendance
            };
            var urls = window.App.baseUrl + "Classes/submitNewAttendanceInfo";
            showloading();
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    Swal.fire({
                        type: e.data.type,
                        title: e.data.message
                    }).then(function (e) {
                        $('#addNewClassAttendanceModal').modal('hide');
                        classsched.addStudent = {
                            searchInput: "",
                            searchstudentslist: []
                        }
                        classsched.getclassSchedInfo();
                    })
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        editAttendance(classsched_id){
            var datas = { 
                classsched_id: classsched_id
            };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "Classes/getClassAttendanceInfo";
            showloading("Loading Data");
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    classsched.classattendanceinfo = e.data.data.classattendanceinfo;
                    classsched.classattendanceinfo.attendance = JSON.parse(classsched.classattendanceinfo.attendance);
                    classsched.classattendancestudents = e.data.data.classattendancestudents;
                    classsched.classattendancestudents.forEach((e,index) => {
                        classsched.classattendancestudents[index].details = JSON.parse(e.details);
                    });
                    $('#editClassAttendanceModal').modal('show');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        changeAttendanceStat(index){
            var attinfo = this.classattendanceinfo.attendance[index];
            attinfo.origstat = attinfo.status;
            attinfo.tmp_sessions_attended = parseInt(this.classattendancestudents[index].details.sessions_attended);
            if(attinfo.status){
                attinfo.status = false;
                if(attinfo.origstat!=attinfo.status){
                    attinfo.tmp_sessions_attended -= 1;
                }
            }else{
                attinfo.status = true;
                if(attinfo.origstat!=attinfo.status){
                    attinfo.tmp_sessions_attended += 1;
                }
            }
        },
    }, mounted: function () {
        this.getClassSchedulesList();
        if(this.class_id!=0){
            this.getclassSchedInfo();
            this.classschedlist=[];
        }
    },
})