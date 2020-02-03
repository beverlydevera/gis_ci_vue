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
            insurance: 1,
            studmem_id: 0,
        },
        derivedinfo:{
            studentage: 0,
            schoolyear: "",
            schoolcourse: "",
            companyname: "",
            companyaddress: "",
        },
        packages_selects: {
            packagetype: ""
        },
        packagelist: [],
        packagedetails: {
            package_id: "",
            package_data: []
        },
        disabled_showbtn: false,
        disabled_hidebtn: true,
        scheduleslist: {
            package_id: "",
            data: []
        },
        selectedPackages: []
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
                studentinfo: this.studentinfo
            };
            // var datas = frmdata(datas);
            var urls = window.App.baseUrl + "students/enroll_saveNewStudentRegistration";
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
                        $('#availpackages-tab').removeClass('disabled');
                        $('#availpackages-tab').addClass('active');
                        $('#availpackages').addClass('active show');

                        $('#submitapplicationform').css({'display': 'none',});
                        $('#updateapplicationform').css({'display': '',});
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
            this.disabled_showbtn=false,
            this.disabled_hidebtn=true,
            this.packagelist=[];
            var packagetype = this.packages_selects.packagetype;
            var datas={ 
                packagetype: packagetype
            };
            var urls = window.App.baseUrl + "Libraries/getPackageList";
            axios.post(urls, datas)
                .then(function (e) {
                    if(packagetype=="Regular"){

                        e.data.data.packagelist.forEach((e,index) => {
                            enroll.packagelist.push({
                                package_id: e.package_id,
                                packagetype: e.packagetype,
                                packagedetails: JSON.parse(e.packagedetails),
                                pricerate: e.pricerate,
                                year: e.year,
                                remarks: e.remarks,
                            })
                            enroll.getClassDetails(index);
                        });
                        $('#packagetype_regular').css({'display': '',});
                        $('#regular_schedules').css({'display': 'none',});
                        $('#packagetype_unlimited').css({'display': 'none',});
                        $('#packagetype_summerpromo').css({'display': 'none',});

                    }else if(packagetype=="Unlimited"){

                        enroll.packagelist = e.data.data.packagelist;
                        $('#packagetype_regular').css({'display': 'none',});
                        $('#regular_schedules').css({'display': 'none',});
                        $('#packagetype_unlimited').css({'display': '',});
                        $('#packagetype_summerpromo').css({'display': 'none',});

                    }else if(packagetype=="Summer Promo"){
                        
                        // enroll.packagelist = e.data.data.packagelist;
                        e.data.data.packagelist.forEach((e,index) => {
                            enroll.packagelist.push({
                                package_id: e.package_id,
                                packagetype: e.packagetype,
                                packagedetails: JSON.parse(e.packagedetails),
                                pricerate: e.pricerate,
                                year: e.year,
                                remarks: e.remarks,
                            })
                        });
                        $('#packagetype_regular').css({'display': 'none',});
                        $('#regular_schedules').css({'display': 'none',});
                        $('#packagetype_unlimited').css({'display': 'none',});
                        $('#packagetype_summerpromo').css({'display': '',});

                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getClassDetails(index){
            var class_id = this.packagelist[index].packagedetails.class;
            var datas = {
                condition: { "c.class_id": class_id },
            };
            var urls = window.App.baseUrl + "Classes/getClassesList";
            axios.post(urls, datas)
                .then(function (e) {
                    enroll.packagelist[index].packagedetails.class_id = enroll.packagelist[index].packagedetails.class;
                    enroll.packagelist[index].packagedetails.class = e.data.data.classeslist.class_title;
                })
                .catch(function (error) {
                    console.log(error)
                }); 
        },
        showDetails(package_id){
            var datas = {package_id:package_id}
            var urls = window.App.baseUrl + "Libraries/getPackageList";
            axios.post(urls, datas)
                .then(function (e) {
                    JSON.parse(e.data.data.packagelist.packagedetails).forEach((e,index) => {
                        enroll.packagedetails.package_data.push({
                            particular: e.particular,
                            price: e.price,
                            type: e.type
                        })
                        if(e.type=='inventory'){ enroll.getItemDetails(index); }
                    });

                    enroll.packagedetails.package_id = package_id;
                    $('#summerpromodetails-'+package_id).css({'display': '',});
                    $('#showDetailsbtn-'+package_id).css({'display': 'none',});
                    $('#hideDetailsbtn-'+package_id).css({'display': '',});
                    enroll.disabled_showbtn = true;
                    enroll.disabled_hidebtn = false;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        hideDetails(package_id){
            enroll.packagedetails = {
                package_id: "",
                package_data: []
            };
            $('#summerpromodetails-'+package_id).css({'display': 'none',});
            $('#showDetailsbtn-'+package_id).css({'display': '',});
            $('#hideDetailsbtn-'+package_id).css({'display': 'none',});
            enroll.disabled_showbtn = false;
            enroll.disabled_hidebtn = true;
        },
        getItemDetails(index){
            var stock_id = this.packagedetails.package_data[index].particular;
            var datas = {
                condition: { "s.stock_id": stock_id },
                groupby: ""
            };
            var urls = window.App.baseUrl + "Inventory/getInventoryList";
            axios.post(urls, datas)
                .then(function (e) {
                    enroll.packagedetails.package_data[index].stock_id = enroll.packagedetails.package_data[index].particular;
                    console.log( e.data.data.inventorylist);
                    enroll.packagedetails.package_data[index].particular = e.data.data.inventorylist.item_name;
                    console.log(enroll.packagedetails.package_data[index]);
                })
                .catch(function (error) {
                    console.log(error)
                }); 
        },
        getSchedulesList(class_id,package_id,packageindex){
            var datas = {
                condition: { "s.class_id": class_id },
            };
            var urls = window.App.baseUrl + "Classes/getSchedulesList";
            axios.post(urls, datas)
                .then(function (e) {
                    $('#regular_schedules').css({'display': '',});
                    enroll.scheduleslist.package_id = package_id;
                    enroll.scheduleslist.packageindex = packageindex;
                    enroll.scheduleslist.data = e.data.data.scheduleslist;
                    
                    $('#showSchedulesbtn-'+package_id).css({'display': 'none',});
                    $('#hideSchedulesbtn-'+package_id).css({'display': '',});
                    enroll.disabled_showbtn = true;
                    enroll.disabled_hidebtn = false;
                })
                .catch(function (error) {
                    console.log(error)
                }); 
        },
        hideSchedules(package_id){
            enroll.scheduleslist = {};
            $('#regular_schedules').css({'display': 'none',});
            $('#showSchedulesbtn-'+package_id).css({'display': '',});
            $('#hideSchedulesbtn-'+package_id).css({'display': 'none',});
            enroll.disabled_showbtn = false;
            enroll.disabled_hidebtn = true;
        },
        selectPackage(scheduleindex,packagetype,packageindex){
            if(packagetype=="regular"){
                var selected = {
                    "student_id": this.student_id,
                    "package_id": this.packagelist[packageindex].package_id,
                    "package_type": this.packagelist[packageindex].packagetype,
                    "price_rate": this.packagelist[packageindex].pricerate,
                    "details": {
                        "class": this.packagelist[packageindex].packagedetails.class,
                        "class_id": this.packagelist[packageindex].packagedetails.class_id,
                        "schedule_id": this.scheduleslist.data[scheduleindex].schedule_id,
                        "sched_day": this.scheduleslist.data[scheduleindex].sched_day,
                        "sched_time": this.scheduleslist.data[scheduleindex].sched_time,
                        "branch": this.scheduleslist.data[scheduleindex].branch_name,
                        "sessions": this.packagelist[packageindex].packagedetails.sessions,
                        "sessions_attended": 0,
                    },
                };
            }else if(packagetype=="unlimited"){
                var selected = {
                    "student_id": this.student_id,
                    "package_id": this.packagelist[packageindex].package_id,
                    "package_type": this.packagelist[packageindex].packagetype,
                    "price_rate": this.packagelist[packageindex].pricerate,
                    "details": this.packagelist[packageindex].packagedetails
                };
            }else if(packagetype=="summer promo"){
                var selected = {
                    "student_id": this.student_id,
                    "package_id": this.packagelist[packageindex].package_id,
                    "package_type": this.packagelist[packageindex].packagetype,
                    "price_rate": this.packagelist[packageindex].pricerate,
                    "details": this.packagelist[packageindex].packagedetails
                };
            }
            
            // $('#selectPackage-'+schedule_id). prop('disabled', true);
            $('.selectpack'). prop('disabled', true);
            $('#selected_packages').css({'display': '',});
            if(this.selectedPackages!=null){
                this.selectedPackages.push(selected);
            }else{
                this.selectedPackages = selected;
            }
        },
        saveSelectedPackages(){
            var datas = {
                student_id: this.student_id,
                insurance: this.otherinfo.insurance,
                studentpackages: this.selectedPackages,
                studmem_id: this.otherinfo.studmem_id
            };
            var urls = window.App.baseUrl + "Students/enroll_saveNewStudentPackages";
            axios.post(urls, datas)
                .then(function (e) {
                    enroll.otherinfo.invoice_id = e.data.data.invoice_id;
                    enroll.studentpackageslist = e.data.data.studentpackages;
                    $('.active').removeClass('active');                        
                    $('#billinginfo-tab').removeClass('disabled');
                    $('#billinginfo-tab').addClass('active');
                    $('#billinginfo').addClass('active show');
                })
                .catch(function (error) {
                    console.log(error)
                }); 
        }
    }, mounted: function () {
        //firstrun
    },
})