var classsched = new Vue({
    el: '#classes_page',
    data: {
        classschedlist: [],
        class_id:$('#class_id').val(),
        classschedinfo: {},
        classschedsheld: [],
        classstudents: [],
        newClassAttendance: [],
        addStudent: {
            searchInput: "",
            searchstudentslist: []
        }        
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
            showloading("Loading Data");
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    classsched.classschedinfo   = e.data.data.classschedinfo;
                    classsched.classschedsheld  = e.data.data.classschedsheld;
                    classsched.classstudents    = e.data.data.classstudents;
                    classsched.classstudents.forEach((e,index) => {
                        classsched.classstudents[index].details = JSON.parse(e.details);
                    });
                    // classsched.classschedinfo.schedule_date = formatDate(currentdate);
                    e.data.data.classstudents.forEach(e => {
                        classsched.newClassAttendance.push({
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
        searchStudent(){
            var existing = ["0"];
            this.newClassAttendance.forEach(e => {
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
    }, mounted: function () {
        this.getClassSchedulesList();
        if(this.class_id!=0){
            this.getclassSchedInfo();
            this.classschedlist=[];
        }
    },
})