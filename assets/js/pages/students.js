// Vue.use(VueTables.ClientTable);

if($('#students_page').length){

    var students = new Vue({
        el: '#students_page',
        data: {
            studentslist: {},
        },
        methods: {
            getStudents(){
                var urls = window.App.baseUrl + "students/getStudents";
                axios.post(urls, "")
                    .then(function (e) {
                        // console.log(e);
                        students.studentslist=e.data.data;
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            },
        }, mounted: function () {
            this.getStudents();
        },
    })

}else if($('#studentprofile_page').length){

	var profile = new Vue({
        el: '#studentprofile_page',
        data: {
            student_id:$('#student_id').val(),
            studentinfo: {
                studentage: 0,
                schoolname: "",
                schoolyear: "",
                schoolcourse: "",
                companyname: "",
                companyaddress: "",
                father_name: "",
                father_birthdate: "",
                father_occupation: "",
                father_contactno: "",
                mother_name: "",
                mother_birthdate: "",
                mother_occupation: "",
                mother_contactno: "",
                guardian_name: "",
                guardian_birthdate: "",
                guardian_occupation: "",
                guardian_contactno: "",
                emergency_name: "",
                emergency_relationship: "",
                emergency_address: "",
                emergency_mobilenum: "",
            },
        },
        methods: {
            calculate_age() {
                var dob = this.studentinfo.birthdate;
                var dob = dob.split("-");
                var dob = new Date(dob[0], dob[1], dob[2]);
                var diff_ms = Date.now() - dob.getTime();
                var age_dt = new Date(diff_ms);
                this.studentinfo.studentage = Math.abs(age_dt.getUTCFullYear() - 1970);
            },
            getStudentProfile(){
                var datas = { student_id:this.student_id };
                var datas = frmdata(datas);
                var urls = window.App.baseUrl + "students/getStudentProfile";
                axios.post(urls, datas)
                    .then(function (e) {
                        // console.log(e);
                        dat = e.data.data;
                        profile.studentinfo=dat;
                        profile.studentinfo.schoolname=dat.school.split("/")['0'];
                        profile.studentinfo.schoolyear=dat.school.split("/")['1'];
                        profile.studentinfo.schoolcourse=dat.school.split("/")['2'];
                        profile.studentinfo.companyname=dat.company.split("/")['0'];
                        profile.studentinfo.companyaddress=dat.company.split("/")['1'];
                        
                        profile.studentinfo.father_name=dat.fatherinfo.split("/")['0'];
                        profile.studentinfo.father_birthdate=dat.fatherinfo.split("/")['1'];
                        profile.studentinfo.father_occupation=dat.fatherinfo.split("/")['2'];
                        profile.studentinfo.father_contactno=dat.fatherinfo.split("/")['3'];
                        
                        profile.studentinfo.mother_name=dat.motherinfo.split("/")['0'];
                        profile.studentinfo.mother_birthdate=dat.motherinfo.split("/")['1'];
                        profile.studentinfo.mother_occupation=dat.motherinfo.split("/")['2'];
                        profile.studentinfo.mother_contactno=dat.motherinfo.split("/")['3'];
                        
                        if(dat.guardianinfo!=null){
                            profile.studentinfo.guardian_name=dat.guardianinfo.split("/")['0'];
                            profile.studentinfo.guardian_birthdate=dat.guardianinfo.split("/")['1'];
                            profile.studentinfo.guardian_occupation=dat.guardianinfo.split("/")['2'];
                            profile.studentinfo.guardian_contactno=dat.guardianinfo.split("/")['3'];
                        }
                        
                        profile.studentinfo.emergency_name=dat.emergencyinfo.split("/")['0'];
                        profile.studentinfo.emergency_relationship=dat.emergencyinfo.split("/")['1'];
                        profile.studentinfo.emergency_address=dat.emergencyinfo.split("/")['2'];
                        profile.studentinfo.emergency_mobilenum=dat.emergencyinfo.split("/")['3'];

                        profile.calculate_age();
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            },
        }, mounted: function () {
            this.getStudentProfile();
        },
    })

}