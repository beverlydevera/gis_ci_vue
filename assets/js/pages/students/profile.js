var profile = new Vue({
    el: '#studentprofile_page',
    data: {
        readonly_everything: true,
        disabled_everything: true,
        student_id:$('#student_id').val(),
        studentinfo:{},
        derivedinfo:{
            studentage: 0,
        },
        classschedlist: {},
        classpackagelist: {},
        classenroll: {
            class_id: "",
            package_id: "",
            payment: "",
            amounttopay: "",
        },
        studentclasses:{},
        studentclassdetails:{},
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
        getClassPackages(){
            var datas = { class_id: this.classenroll.class_id };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "students/getClassPackage";
            axios.post(urls, datas)
                .then(function (e) {
                    if (e.data.success) {
                       profile.classpackagelist = e.data.data;
                       profile.disabled_everything = false;
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        checkPayment(){
                var datas = { package_id: this.classenroll.package_id };
                var datas = frmdata(datas);
                var urls = window.App.baseUrl + "students/checkPayment";
                axios.post(urls, datas)
                    .then(function (e) {
                        if (e.data.success) {
                            if(profile.classenroll.payment=="fullPayment"){
                                profile.classenroll.amounttopay = e.data.data;
                                profile.readonly_everything = true;
                            }else{
                                $("#amountpay").attr({ "max" : e.data.data, });
                                profile.classenroll.amounttopay = "";
                                profile.readonly_everything = false;
                            }
                        }
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
        },
        getClassScheds(){
            var urls = window.App.baseUrl + "classes/getClassScheds";
            axios.post(urls, "")
                .then(function (e) {
                    profile.classschedlist=e.data.data;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getStudentClassDetails(studpack_id){
            var datas = { studpack_id: studpack_id };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "students/getStudentClassDetails";
            axios.post(urls, datas)
                .then(function (e) {
                    profile.studentclassdetails=e.data.data;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getStudentProfile(){
            var datas = { student_id:this.student_id };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "students/getStudentProfile";
            axios.post(urls, datas)
                .then(function (e) {
                    dat = e.data.data;
                    profile.studentclasses=dat.studentclasses;
                    profile.studentinfo=dat.studentprofile;
                    dat = e.data.data.studentprofile;
                    
                    if(dat.school!=null){
                        profile.derivedinfo.schoolname=dat.school.split("/")['0'];
                        profile.derivedinfo.schoolyear=dat.school.split("/")['1'];
                        profile.derivedinfo.schoolcourse=dat.school.split("/")['2'];
                    }

                    if(dat.company!=null){
                        profile.derivedinfo.companyname=dat.company.split("/")['0'];
                        profile.derivedinfo.companyaddress=dat.company.split("/")['1'];
                    }
                    
                    if(dat.fatherinfo!=null){
                        profile.derivedinfo.father_name=dat.fatherinfo.split("/")['0'];
                        profile.derivedinfo.father_occupation=dat.fatherinfo.split("/")['1'];
                        profile.derivedinfo.father_officeadd=dat.fatherinfo.split("/")['2'];
                        profile.derivedinfo.father_contactno=dat.fatherinfo.split("/")['3'];
                    }
                    
                    if(dat.motherinfo!=null){
                        profile.derivedinfo.mother_name=dat.motherinfo.split("/")['0'];
                        profile.derivedinfo.mother_occupation=dat.motherinfo.split("/")['1'];
                        profile.derivedinfo.mother_officeadd=dat.motherinfo.split("/")['2'];
                        profile.derivedinfo.mother_contactno=dat.motherinfo.split("/")['3'];
                    }
                    
                    if(dat.guardianinfo!=null){
                        profile.derivedinfo.guardian_name=dat.guardianinfo.split("/")['0'];
                        profile.derivedinfo.guardian_occupation=dat.guardianinfo.split("/")['1'];
                        profile.derivedinfo.guardian_officeadd=dat.guardianinfo.split("/")['2'];
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
            this.studentinfo.fatherinfo = this.derivedinfo.father_name+"/"+this.derivedinfo.father_occupation+"/"+this.derivedinfo.father_officeadd+"/"+this.derivedinfo.father_contactno;
            this.studentinfo.motherinfo = this.derivedinfo.mother_name+"/"+this.derivedinfo.mother_occupation+"/"+this.derivedinfo.mother_officeadd+"/"+this.derivedinfo.mother_contactno;
            this.studentinfo.guardianinfo = this.derivedinfo.guardian_name+"/"+this.derivedinfo.guardian_occupation+"/"+this.derivedinfo.guardian_officeadd+"/"+this.derivedinfo.guardian_contactno;
            this.studentinfo.emergencyinfo = this.derivedinfo.emergency_name+"/"+this.derivedinfo.emergency_relationship+"/"+this.derivedinfo.emergency_address+"/"+this.derivedinfo.emergency_mobilenum;
            
            var datas = frmdata(this.studentinfo);
            var urls = window.App.baseUrl + "students/UpdateProfile";
            axios.post(urls, datas)
                .then(function (e) {
                    // console.log(e);
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
        },
        enrollToClass(){
            var datas = { 
                student_id: this.student_id,
                package_id: this.classenroll.package_id,
                payment_options: this.classenroll.payment
            };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "students/enrollToClass";
            axios.post(urls, datas)
                .then(function (e) {
                    // console.log(e);
                    if (e.data.success) {
                        Toast.fire({
                            type: "success",
                            title: e.data.message
                        })
                        profile.getStudentProfile();
                    }else{
                        Toast.fire({
                            type: "warning",
                            title: e.data.message
                        })
                    }
                    profile.classenroll.class_id = "";
                    profile.classenroll.package_id = "";
                    profile.classenroll.payment = "";
                    profile.classenroll.amounttopay = "";
                    $('#enrollToClassModal').modal('hide');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        deleteStudentClass(studpack_id){
            var datas = { studpack_id: studpack_id };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "students/deleteStudentClass";
            axios.post(urls, datas)
                .then(function (e) {
                    if (e.data.success) {
                        Toast.fire({
                            type: "success",
                            title: e.data.message
                        })
                        profile.getStudentProfile();
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