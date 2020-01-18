var enroll = new Vue({
    el: '#studentenroll_page',
    data: {
        disabled_everything: false,
        studentinfo:{},
        derivedinfo:{
            studentage: 0,
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
        saveNewStudentRegistration(){
            this.studentinfo.school = this.derivedinfo.schoolname+"/"+this.derivedinfo.schoolyear+"/"+this.derivedinfo.schoolcourse;
            this.studentinfo.company = this.derivedinfo.companyname+"/"+this.derivedinfo.companyaddress;
            this.studentinfo.fatherinfo = this.derivedinfo.father_name+"/"+this.derivedinfo.father_occupation+"/"+this.derivedinfo.father_officeadd+"/"+this.derivedinfo.father_contactno;
            this.studentinfo.motherinfo = this.derivedinfo.mother_name+"/"+this.derivedinfo.mother_occupation+"/"+this.derivedinfo.mother_officeadd+"/"+this.derivedinfo.mother_contactno;
            this.studentinfo.guardianinfo = this.derivedinfo.guardian_name+"/"+this.derivedinfo.guardian_occupation+"/"+this.derivedinfo.guardian_officeadd+"/"+this.derivedinfo.guardian_contactno;
            this.studentinfo.emergencyinfo = this.derivedinfo.emergency_name+"/"+this.derivedinfo.emergency_relationship+"/"+this.derivedinfo.emergency_address+"/"+this.derivedinfo.emergency_mobilenum;
                        
            var datas = frmdata(this.studentinfo);
            var urls = window.App.baseUrl + "students/saveNewStudentRegistration";
            axios.post(urls, datas)
                .then(function (e) {
                    // console.log(e);
                    if (e.data.success) {
                        Toast.fire({
                            type: "success",
                            title: e.data.message
                        })
                        enroll.disabled_everything = true;
                        $('.active').removeClass('active');
                        $('.disabled').removeClass('disabled');

                        $('#schedulinginfo-tab').addClass('active');
                        $('#schedulinginfo').addClass('active show')
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
        //firstrun
    },
})