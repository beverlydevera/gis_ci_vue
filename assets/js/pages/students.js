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
            studentinfo:{
                student_id: "",
                reference_id: "",
                lastname: "",
                firstname: "",
                middlename: "",
                birthdate: "",
                sex: "",
                mobileno: "",
                telephoneno: "",
                emailadd: "",
                address: "",
                citizenship: "",
                height: "",
                weight: "",
                insurance: "",
                religion: "",
                school: "",
                company: "",
                fatherinfo: "",
                motherinfo: "",
                guardianinfo: "",
                emergencyinfo: "",
                status: "",
                archived: "",
                date_added: "",
                date_updated: "",
            },
            derivedinfo:{
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
            }
        },
        methods: {
            calculate_age() {
                var dob = this.studentinfo.birthdate;
                var dob = dob.split("-");
                var dob = new Date(dob[0], dob[1], dob[2]);
                var diff_ms = Date.now() - dob.getTime();
                var age_dt = new Date(diff_ms);
                this.derivedinfo.studentage = Math.abs(age_dt.getUTCFullYear() - 1970);
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
                        
                        if(dat.school!=null){
                            profile.derivedinfo.schoolname=dat.school.split("/")['0'];
                            profile.derivedinfo.schoolyear=dat.school.split("/")['1'];
                            profile.derivedinfo.schoolcourse=dat.school.split("/")['2'];
                            profile.derivedinfo.companyname=dat.company.split("/")['0'];
                            profile.derivedinfo.companyaddress=dat.company.split("/")['1'];
                        }
                        
                        if(dat.fatherinfo!=null){
                            profile.derivedinfo.father_name=dat.fatherinfo.split("/")['0'];
                            profile.derivedinfo.father_birthdate=dat.fatherinfo.split("/")['1'];
                            profile.derivedinfo.father_occupation=dat.fatherinfo.split("/")['2'];
                            profile.derivedinfo.father_contactno=dat.fatherinfo.split("/")['3'];
                        }
                        
                        if(dat.motherinfo!=null){
                            profile.derivedinfo.mother_name=dat.motherinfo.split("/")['0'];
                            profile.derivedinfo.mother_birthdate=dat.motherinfo.split("/")['1'];
                            profile.derivedinfo.mother_occupation=dat.motherinfo.split("/")['2'];
                            profile.derivedinfo.mother_contactno=dat.motherinfo.split("/")['3'];
                        }
                        
                        if(dat.guardianinfo!=null){
                            profile.derivedinfo.guardian_name=dat.guardianinfo.split("/")['0'];
                            profile.derivedinfo.guardian_birthdate=dat.guardianinfo.split("/")['1'];
                            profile.derivedinfo.guardian_occupation=dat.guardianinfo.split("/")['2'];
                            profile.derivedinfo.guardian_contactno=dat.guardianinfo.split("/")['3'];
                        }
                        
                        if(dat.emergencyinfo!=null){
                            profile.derivedinfo.emergency_name=dat.emergencyinfo.split("/")['0'];
                            profile.derivedinfo.emergency_relationship=dat.emergencyinfo.split("/")['1'];
                            profile.derivedinfo.emergency_address=dat.emergencyinfo.split("/")['2'];
                            profile.derivedinfo.emergency_mobilenum=dat.emergencyinfo.split("/")['3'];
                        }

                        profile.calculate_age();
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            updateProfile(){
                this.studentinfo.school = this.derivedinfo.schoolname+"/"+this.derivedinfo.schoolyear+"/"+this.derivedinfo.schoolcourse;
                this.studentinfo.company = this.derivedinfo.companyname+"/"+this.derivedinfo.companyaddress;
                this.studentinfo.fatherinfo = this.derivedinfo.father_name+"/"+this.derivedinfo.father_birthdate+"/"+this.derivedinfo.father_occupation+"/"+this.derivedinfo.father_contactno;
                this.studentinfo.motherinfo = this.derivedinfo.mother_name+"/"+this.derivedinfo.mother_birthdate+"/"+this.derivedinfo.mother_occupation+"/"+this.derivedinfo.mother_contactno;
                this.studentinfo.guardianinfo = this.derivedinfo.guardian_name+"/"+this.derivedinfo.guardian_birthdate+"/"+this.derivedinfo.guardian_occupation+"/"+this.derivedinfo.guardian_contactno;
                this.studentinfo.emergencyinfo = this.derivedinfo.emergency_name+"/"+this.derivedinfo.emergency_relationship+"/"+this.derivedinfo.emergency_address+"/"+this.derivedinfo.emergency_mobilenum;
                
                var currentdate = new Date(); 
                var datetime = currentdate.getFullYear() + "-" + (currentdate.getMonth()+1) + "-" + (currentdate.getDate()) + " " + currentdate.getHours() + ":" + currentdate.getMinutes() + ":" + currentdate.getSeconds();
                this.studentinfo.date_updated = datetime;
                
                var datas = frmdata(this.studentinfo);
                var urls = window.App.baseUrl + "students/UpdateProfile";
                axios.post(urls, datas)
                    .then(function (e) {
                        console.log(e);
                        if (e.data.success) {
                            Toast.fire({
                                type: "success",
                                title: e.data.message
                            })
                        }else{
                            Toast.fire({
                                type: "warning",
                                title: e.data.message
                            })
                        }
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            }
        }, mounted: function () {
            this.getStudentProfile();
        },
    })

}