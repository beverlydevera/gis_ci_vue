var enroll = new Vue({
    el: '#studentenroll_page',
    data: {
        disabled_everything: false,
        readonly_everything: true,
        studentrefid:"",
        student_id:"",
        studentinfo:{
            telephoneno: "",
            religion: "",
            nickname: "",
        },
        otherinfo:{
            insurance: 0,
            studmem_id: 0,
        },
        derivedinfo:{
            studentage: 0,
            schoolyear: "",
            schoolcourse: "",
            companyname: "",
            companyaddress: "",
        },
        packages_selects: {},
        packagelist: []
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
            
            var datas = {
                insurance: this.otherinfo.insurance,
                studentinfo: this.studentinfo
            };
            // var datas = frmdata(datas);
            var urls = window.App.baseUrl + "students/saveNewStudentRegistration";
            axios.post(urls, datas)
                .then(function (e) {
                    // console.log(e);
                    if (e.data.success) {
                        Toast.fire({
                            type: "success",
                            title: e.data.message
                        })
                        enroll.studentrefid = e.data.data.reference_id;
                        enroll.student_id = e.data.data.student_id;
                        enroll.otherinfo.studmem_id = e.data.data.studmem_id;
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
        },
        getStudentProfile(){
            var datas = { student_id:this.student_id };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "students/getStudentProfile";
            axios.post(urls, datas)
                .then(function (e) {
                    dat = e.data.data;
                    enroll.studentclasses=dat.studentclasses;
                    enroll.studentinfo=dat.studentprofile;
                    dat = e.data.data.studentprofile;
                    
                    if(dat.school!=null){
                        enroll.derivedinfo.schoolname=dat.school.split("/")['0'];
                        enroll.derivedinfo.schoolyear=dat.school.split("/")['1'];
                        enroll.derivedinfo.schoolcourse=dat.school.split("/")['2'];
                    }

                    if(dat.company!=null){
                        enroll.derivedinfo.companyname=dat.company.split("/")['0'];
                        enroll.derivedinfo.companyaddress=dat.company.split("/")['1'];
                    }
                    
                    if(dat.fatherinfo!=null){
                        enroll.derivedinfo.father_name=dat.fatherinfo.split("/")['0'];
                        enroll.derivedinfo.father_occupation=dat.fatherinfo.split("/")['1'];
                        enroll.derivedinfo.father_officeadd=dat.fatherinfo.split("/")['2'];
                        enroll.derivedinfo.father_contactno=dat.fatherinfo.split("/")['3'];
                    }
                    
                    if(dat.motherinfo!=null){
                        enroll.derivedinfo.mother_name=dat.motherinfo.split("/")['0'];
                        enroll.derivedinfo.mother_occupation=dat.motherinfo.split("/")['1'];
                        enroll.derivedinfo.mother_officeadd=dat.motherinfo.split("/")['2'];
                        enroll.derivedinfo.mother_contactno=dat.motherinfo.split("/")['3'];
                    }
                    
                    if(dat.guardianinfo!=null){
                        enroll.derivedinfo.guardian_name=dat.guardianinfo.split("/")['0'];
                        enroll.derivedinfo.guardian_occupation=dat.guardianinfo.split("/")['1'];
                        enroll.derivedinfo.guardian_officeadd=dat.guardianinfo.split("/")['2'];
                        enroll.derivedinfo.guardian_contactno=dat.guardianinfo.split("/")['3'];
                    }
                    
                    if(dat.emergencyinfo!=null){
                        enroll.derivedinfo.emergency_name=dat.emergencyinfo.split("/")['0'];
                        enroll.derivedinfo.emergency_relationship=dat.emergencyinfo.split("/")['1'];
                        enroll.derivedinfo.emergency_address=dat.emergencyinfo.split("/")['2'];
                        enroll.derivedinfo.emergency_mobilenum=dat.emergencyinfo.split("/")['3'];
                    }

                    enroll.calculate_age();
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        changePackageType(){
            if(this.packages_selects.packagetype=="Regular"){
                //get regular packages
                var datas={
                    packagetype: "Regular"
                };
                var urls = window.App.baseUrl + "Libraries/getPackageList";
                axios.post(urls, datas)
                    .then(function (e) {
                        e.data.data.packagelist.forEach(e => {
                            enroll.packagelist.push({
                                package_id: e.package_id,
                                packagetype: e.packagetype,
                                packagedetails: JSON.parse(e.packagedetails),
                                pricerate: e.pricerate,
                                year: e.year,
                                remarks: e.remarks,
                            })
                        });
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
                $('#packagetype_regular').css({'display': '',});
                $('#packagetype_unlimited').css({'display': 'none',});
                $('#packagetype_summerpromo').css({'display': 'none',});
            }else if(this.packages_selects.packagetype=="Unlimited"){
                //get unlimited packages
                $('#packagetype_regular').css({'display': 'none',});
                $('#packagetype_unlimited').css({'display': '',});
                $('#packagetype_summerpromo').css({'display': 'none',});
            }else if(this.packages_selects.packagetype=="Summer Promo"){
                //get summer promo packages
                $('#packagetype_regular').css({'display': 'none',});
                $('#packagetype_unlimited').css({'display': 'none',});
                $('#packagetype_summerpromo').css({'display': '',});
            }
        }
    }, mounted: function () {
        //firstrun
    },
})