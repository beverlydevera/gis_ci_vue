var classsched = new Vue({
    el: '#classes_page',
    data: {
        classschedlist: [],
        class_id:$('#class_id').val(),
        classschedinfo: {},
        classschedsheld: [],
        classstudents: []
    },
    methods: {
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
            axios.post(urls, datas)
                .then(function (e) {
                    classsched.classschedinfo   = e.data.data.classschedinfo;
                    classsched.classschedsheld  = e.data.data.classschedsheld;
                    classsched.classstudents    = e.data.data.classstudents;
                    classsched.classstudents.forEach((e,index) => {
                        classsched.classstudents[index].details = JSON.parse(e.details);
                    });
                    // classsched.classAttendanceInfo.schedule_date = formatDate(currentdate);
                    // classsched.classAttendanceInfo.attendance = [];
                    // e.data.data.classStudents.forEach(e => {
                    //     classsched.classAttendanceInfo.attendance.push({
                    //         student_id: e.student_id,
                    //         studpack_id: e.studpack_id,
                    //         status: true
                    //     })
                    // });
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
    }, mounted: function () {
        this.getClassSchedulesList();
        if(this.class_id!=0){
            this.getclassSchedInfo();
            this.classschedlist=[];
        }
    },
})