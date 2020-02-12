var monthlist = [ "", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];

var profile = new Vue({
    el: '#studentprofile_page',
    data: {
        readonly_everything: true,
        disabled_everything: true,
        student_id:$('#student_id').val(),
        studentinfo:{
            telephoneno: "",
            religion: "",
            nickname: "",
        },
        studentmembership: {
            insurance: {
                avail: 0
            }
        },
        derivedinfo:{
            studentage: 0,
            schoolyear: "",
            schoolcourse: "",
            companyname: "",
            companyaddress: "",
            studentmembership: {}
        },
        //second tab
        studentpackages: {
            regular: [],
            unlimited: [],
            summerpromo: []
        },
        package_select: {
            packagetype: "Regular"
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
                    dat = e.data.data;

                    if(dat.studentpackages.regular!=null){
                        profile.studentpackages.regular = dat.studentpackages.regular;
                        profile.studentpackages.regular.forEach(e => {
                            e.details = JSON.parse(e.details);
                            e.packagedetails = JSON.parse(e.packagedetails);
                        })
                    }

                    if(dat.studentpackages.unlimited!=null){
                        profile.studentpackages.unlimited = dat.studentpackages.unlimited;
                        profile.studentpackages.unlimited.forEach(e => {
                            e.details = JSON.parse(e.details);
                            e.date_from = formatDate(e.date_added);
                            
                            var d = new Date(e.date_added);
                            var date_to = new Date(d.getFullYear(), (d.getMonth() + 1), d.getDate());
                            date_to.setMonth(d.getMonth()+1);
                            e.date_to = formatDate(date_to);
                        })
                    }

                    if(dat.studentpackages.summerpromo!=null){
                        profile.studentpackages.summerpromo = dat.studentpackages.summerpromo;
                        profile.studentpackages.summerpromo.forEach(e => {
                            e.details = JSON.parse(e.details);
                            e.packagedetails = JSON.parse(e.packagedetails);
                        })
                    }
                    
                    profile.studentinfo=dat.studentprofile;

                    profile.studentmembership=dat.studentmembership;
                    profile.studentmembership.insurance = JSON.parse(dat.studentmembership.insurance);
                    if(dat.studentmembership!=null){
                        if(dat.studentmembership.membership_type.includes("/")){
                            profile.derivedinfo.studentmembership[0] = dat.studentmembership.membership_type.split("/")['0'];
                            profile.derivedinfo.studentmembership[1] = dat.studentmembership.membership_type.split("/")['1'];
                        }else{
                            profile.derivedinfo.studentmembership[0] = dat.studentmembership.membership_type;
                        }
                    }
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
        changePackagetype(){
            var packagetype = this.package_select.packagetype;

            if(packagetype=="Regular"){
                $('#package_regular_add').css({'display': '',});
                $('#package_regular').css({'display': '',});
                $('#package_unlimited_add').css({'display': 'none',});
                $('#package_unlimited').css({'display': 'none',});
                $('#package_summerpromo_add').css({'display': 'none',});
                $('#package_summerpromo').css({'display': 'none',});
            }else if(packagetype=="Unlimited"){
                $('#package_regular_add').css({'display': 'none',});
                $('#package_regular').css({'display': 'none',});
                $('#package_unlimited_add').css({'display': '',});
                $('#package_unlimited').css({'display': '',});
                $('#package_summerpromo_add').css({'display': 'none',});
                $('#package_summerpromo').css({'display': 'none',});                
            }else if(packagetype=="Summer Promo"){
                $('#package_regular_add').css({'display': 'none',});
                $('#package_regular').css({'display': 'none',});
                $('#package_unlimited_add').css({'display': 'none',});
                $('#package_unlimited').css({'display': 'none',});
                $('#package_summerpromo_add').css({'display': '',});
                $('#package_summerpromo').css({'display': '',});
            }
        }
    }, mounted: function () {
        this.getStudentProfile();
    },
})