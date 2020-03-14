var monthlist = [ "", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];

var profile = new Vue({
    el: '#studentprofile_page',
    data: {
        readonly_everything: true,
        disabled_everything: true,
        student_id:$('#student_id').val(),
        //first tab
        studentinfo:{
            telephoneno: "",
            religion: "",
            nickname: "",
            photo: ""
        },
        studentmembership: {
            insurance: {
                avail: 0
            },
        },
        derivedinfo:{
            studentage: 0,
            schoolyear: "",
            schoolcourse: "",
            companyname: "",
            companyaddress: "",
            studentmembership: {}
        },
        currentyear: new Date().getFullYear(),
        membership_info: {
            membershiplist: [],
            membership_update: {
                insurance: {
                    avail: 1,
                    price: 60
                },
                membership_type: [],
            },
        },
        //second tab
        studentpackages: [],
        studentattendance: [],
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
        selectedPackages: [],
        //third tab
        newstudentCompetition: {
            comp_awards: [{
                award_name: ""
            }],
            photos: ""
        },
        competitionDetails: {
            comp_awards: [{
                award_name: ""
            }],
            photos: ""
        },
        competitionslist: [],
        //fourth tab
        rankslist: [],
        studentRankInfo: {
            currentRank: {
                rank_id: 0,
                rank_title: "",
                ses_attended: 0,
                next_rank: {
                    ses_needed: 0
                }
            },
            newstudentPromotion: {
                next_rank: {
                    rank_id: "",
                    rank_title: "",
                    ses_needed: ""
                },
                ses_attended: 0,
                photo: "",
                remarks: ""
            },
            viewStudentPromotion: {
                next_rank: {
                    rank_id: "",
                    rank_title: "",
                    ses_needed: ""
                },
                ses_attended: 0,
                photo: "",
                remarks: ""
            },
            promotionlist: []
        },
        evaluation_add: {
            eval_technique: [{
                name: "POOMSAE",
                rate_o: '1',
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "DEFENSE FORM",
                rate_o: '1',
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "KICKINGS",
                rate_o: '1',
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "COMBINATIONS",
                rate_o: '1',
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "SPARRING",
                rate_o: '1',
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            }],
            eval_attitude: [{
                name: "Attendance and Punctuality",
                rate_o: '1',
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "Accomplishment of Tasks",
                rate_o: '1',
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "Intereset and Initiative",
                rate_o: '1',
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "Courtesy and Discipline",
                rate_o: '1',
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "Consent for Other",
                rate_o: '1',
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            }],
            eval_remarks: null
        },
        evaluation_edit: {
            eval_technique: [{
                name: "POOMSAE",
                rate_o: 1,
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "DEFENSE FORM",
                rate_o: 1,
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "KICKINGS",
                rate_o: 1,
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "COMBINATIONS",
                rate_o: 1,
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "SPARRING",
                rate_o: 1,
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            }],
            eval_attitude: [{
                name: "Attendance and Punctuality",
                rate_o: 1,
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "Accomplishment of Tasks",
                rate_o: 1,
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "Intereset and Initiative",
                rate_o: 1,
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "Courtesy and Discipline",
                rate_o: 1,
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            },{
                name: "Consent for Other",
                rate_o: 1,
                rate_vg: '',
                rate_g: '',
                rate_s: '',
                rate_ni: ''
            }],
            eval_remarks: null
        },
        //sixth tab
        invoicelist: [],
        invoiceinfo: {},
        invoicedetails: {
            details: {
                paymentstotal: 0
            },
            paymentslist: [],
        },
        paymentdetails: {
            invoice_id: "",
            student_id: "",
            ornumber: "",
            paymentdate: currentdate,
            ordate: currentdate,
            paymentoption: "full",
            amount: 0,
        }
    },
    methods: {
        inputImage(){ 
            $("input[id='studentpicture']").click();
        },
        editStudentImageSelect(event){
            Swal.fire({
                title: "Are you sure you want to set selected image as student picture?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, set and save',
                }).then((result) => {
                    if(result.value){
                        if (event.target.files && event.target.files[0]) {
                            var reader = new FileReader();
            
                            reader.onload = function (e) {
                                $('#editStudentImage')
                                    .attr('src', e.target.result)
                                    .width("80%");
                            };
                            reader.readAsDataURL(event.target.files[0]);
    
                            let formData = new FormData();
                            formData.append('student_id', this.student_id);
                            formData.append('file', this.$refs.studentimage.files[0]);
                
                            var urls = window.App.baseUrl + "Students/saveStudentImage";
                            showloading();
                            axios.post(urls, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
                            .then(function (e) {
                                Swal.close();
                                Swal.fire({
                                    title: e.data.message,
                                    type: e.data.type
                                })
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        }
                    }
                })
        },
        updateMembershipPrompt(studmem_id){
            Swal.fire({
                title: "Student Membership Warning",
                text: "Student membership has not been updated, please update for the current year.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Update Membership',
                }).then((result) => {
                    if (result.value) {
                        this.changeMembershipModal(studmem_id);
                    }else{
                        Toast.fire({
                            type: "error",
                            title: "Please update membership ASAP."
                        })
                    }
            })
        },
        changeMembershipModal(studmem_id){
            var urls = window.App.baseUrl + "students/getMembershipList";
            axios.post(urls, "")
                .then(function (e) {
                    profile.membership_info.membershiplist=e.data.data.membershiplist;
                })
                .catch(function (error) {
                    console.log(error)
                });
            $('#updateMembershipModal').modal('show');
        },
        saveMembershipUpdate(){
            if(this.membership_info.membership_update.insurance.avail==0){ this.membership_info.membership_update.insurance.price=0; }
            var datas = {
                "membership_info" : this.membership_info.membership_update,
                "student_id" : this.student_id
            };
            var urls = window.App.baseUrl + "students/saveMembershipUpdate";
            axios.post(urls, datas)
                .then(function (e) {
                    var dat = e.data.data.membership_info;
                    profile.studentmembership=dat;
                    profile.studentmembership.insurance = JSON.parse(dat.insurance);
                    if(dat!=null){
                        if(dat.membership_type.includes("/")){
                            profile.derivedinfo.studentmembership[0] = dat.membership_type.split("/")['0'];
                            profile.derivedinfo.studentmembership[1] = dat.membership_type.split("/")['1'];
                        }else{
                            profile.derivedinfo.studentmembership[0] = dat.membership_type;
                        }
                    }
                    Swal.fire({
                        type: e.data.type,
                        title: e.data.message
                    })
                    $('#updateMembershipModal').modal('hide');
                    profile.getInvoiceList();
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        //first tab
        calculate_age() {
            var dob = this.studentinfo.birthdate;
            var dob = dob.split("-");
            var dob = new Date(dob[0], dob[1], dob[2]);
            var diff_ms = Date.now() - dob.getTime();
            var age_dt = new Date(diff_ms);
            this.derivedinfo.studentage = Math.abs(age_dt.getUTCFullYear() - 1970);

            if(this.derivedinfo.studentage>=25){
                this.membership_info.membership_update.insurance.price = 150;
            }else{
                this.membership_info.membership_update.insurance.price = 60;
            }
        },
        getStudentProfile(){
            var datas = { student_id:this.student_id };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "students/getStudentProfile";
            showloading("Fetching Data from Server");
            axios.post(urls, datas)
                .then(function (e) {
                    dat = e.data.data;

                    profile.competitionslist = dat.competitionslist;
                    profile.rankslist = dat.rankslist;

                    if(dat.rankinfo!=null){
                        profile.studentRankInfo.currentRank = dat.rankinfo;
                        profile.studentRankInfo.currentRank.next_rank = JSON.parse(dat.rankinfo.next_rank);
                    }
                    profile.studentRankInfo.promotionlist = dat.promotionlist;
                    profile.invoicelist = dat.invoicelist;
                    profile.invoiceinfo = dat.invoiceinfo;
                    
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
                    Swal.close();
                    if(profile.studentmembership.year<profile.currentyear){
                        profile.updateMembershipPrompt(profile.studentmembership.studmem_id);
                    }
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
        //second tab
        getStudentPackages(){
            var datas = { student_id:this.student_id };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "students/getStudentPackages";
            axios.post(urls, datas)
                .then(function (e) {
                    profile.studentpackages = e.data.data.studentpackages;
                    if(profile.studentpackages!=null){
                        profile.studentpackages.forEach((el,ind) => {
                            profile.studentpackages[ind].details = JSON.parse(el.details);
                        })
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        viewAttendance(studpack_id){
            var datas = {
                studpack_id: studpack_id
            };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "students/getStudentAttendance";
            axios.post(urls, datas)
                .then(function (e) {
                    profile.studentattendance = e.data.data.studentattendance;
                    $('#viewAttendanceModal').modal('show');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        changePackageType() {
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
                            profile.packagelist.push({
                                package_id: e.package_id,
                                packagetype: e.packagetype,
                                packagedetails: JSON.parse(e.packagedetails),
                                pricerate: e.pricerate,
                                year: e.year,
                                remarks: e.remarks,
                            })
                            profile.getClassDetails(index);
                        });
                        $('#packagetype_regular').css({'display': '',});
                        $('#regular_schedules').css({'display': 'none',});
                        $('#packagetype_unlimited').css({'display': 'none',});
                        $('#packagetype_summerpromo').css({'display': 'none',});

                    }else if(packagetype=="Unlimited"){

                        profile.packagelist = e.data.data.packagelist;
                        $('#packagetype_regular').css({'display': 'none',});
                        $('#regular_schedules').css({'display': 'none',});
                        $('#packagetype_unlimited').css({'display': '',});
                        $('#packagetype_summerpromo').css({'display': 'none',});

                    }else if(packagetype=="Summer Promo"){
                        
                        e.data.data.packagelist.forEach((e,index) => {
                            profile.packagelist.push({
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
                    profile.packagelist[index].packagedetails.class_id = profile.packagelist[index].packagedetails.class;
                    profile.packagelist[index].packagedetails.class = e.data.data.classeslist.class_title;
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
                    profile.scheduleslist.package_id = package_id;
                    profile.scheduleslist.packageindex = packageindex;
                    profile.scheduleslist.data = e.data.data.scheduleslist;
                    
                    $('#showSchedulesbtn-'+package_id).css({'display': 'none',});
                    $('#hideSchedulesbtn-'+package_id).css({'display': '',});
                    profile.disabled_showbtn = true;
                    profile.disabled_hidebtn = false;
                })
                .catch(function (error) {
                    console.log(error)
                }); 
        },
        hideSchedules(package_id){
            profile.scheduleslist = {};
            $('#regular_schedules').css({'display': 'none',});
            $('#showSchedulesbtn-'+package_id).css({'display': '',});
            $('#hideSchedulesbtn-'+package_id).css({'display': 'none',});
            profile.disabled_showbtn = false;
            profile.disabled_hidebtn = true;
        },
        showDetails(package_id){
            var datas = {package_id:package_id}
            var urls = window.App.baseUrl + "Libraries/getPackageList";
            axios.post(urls, datas)
                .then(function (e) {
                    JSON.parse(e.data.data.packagelist.packagedetails).forEach((e,index) => {
                        profile.packagedetails.package_data.push({
                            particular: e.particular,
                            price: e.price,
                            type: e.type
                        })
                        if(e.type=='inventory'){ profile.getItemDetails(index); }
                    });

                    profile.packagedetails.package_id = package_id;
                    $('#summerpromodetails-'+package_id).css({'display': '',});
                    $('#showDetailsbtn-'+package_id).css({'display': 'none',});
                    $('#hideDetailsbtn-'+package_id).css({'display': '',});
                    profile.disabled_showbtn = true;
                    profile.disabled_hidebtn = false;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        hideDetails(package_id){
            profile.packagedetails = {
                package_id: "",
                package_data: []
            };
            $('#summerpromodetails-'+package_id).css({'display': 'none',});
            $('#showDetailsbtn-'+package_id).css({'display': '',});
            $('#hideDetailsbtn-'+package_id).css({'display': 'none',});
            profile.disabled_showbtn = false;
            profile.disabled_hidebtn = true;
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
                    profile.packagedetails.package_data[index].stock_id = profile.packagedetails.package_data[index].particular;
                    // console.log( e.data.data.inventorylist);
                    profile.packagedetails.package_data[index].particular = e.data.data.inventorylist.item_name;
                    // console.log(profile.packagedetails.package_data[index]);
                })
                .catch(function (error) {
                    console.log(error)
                }); 
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
                    "details": {
                        "detail": this.packagelist[packageindex].packagedetails,
                        "sessions_attended": 0
                    }
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
            
            $('.selectpack'). prop('disabled', true);
            $('#selected_packages').css({'display': '',});
            if(this.selectedPackages!=null){
                this.selectedPackages.push(selected);
            }else{
                this.selectedPackages = selected;
            }
        },
        //third tab
        addCompetitionImageSelect(event){
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#addselectedImage_Competition')
                        .attr('src', e.target.result)
                        .width("100%");
                };
                $('#addselectedImage_Competition').css({'display': '',});
                $('#selectCompImage_add').css({'display': 'none',});

                reader.readAsDataURL(event.target.files[0]);
            }
        },
        changeCompetitionImage_add(){
            $("input[id='selectCompImage_add']").click();
        },
        editCompetitionImageSelect(event){
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#editselectedImage_Competition')
                        .attr('src', e.target.result)
                        .width("100%");
                };
                $('#editselectedImage_Competition').css({'display': '',});
                $('#selectCompImage_edit').css({'display': 'none',});

                reader.readAsDataURL(event.target.files[0]);
            }
        },
        changeCompetitionImage_edit(){
            $("input[id='selectCompImage_edit']").click();
        },
        submitNewStudentCompetition(){
            let formData = new FormData();
            formData.append('competition_info', JSON.stringify(this.newstudentCompetition));
            formData.append('student_id', this.student_id);
            formData.append('file', this.$refs.competition_photo_add.files[0]);

            var urls = window.App.baseUrl + "students/saveStudentCompetition";
            showloading();
            axios.post(urls, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
                .then(function (e) {
                    Swal.close();
                    Swal.fire({
                        type: e.data.type,
                        title: e.data.message
                    })
                    if(e.data.success){
                        profile.newstudentCompetition.studcomp_id = e.data.data.studcomp_id;
                        if(profile.competitionslist!=null){ profile.competitionslist.push(profile.newstudentCompetition); }
                        else{ profile.competitionslist = [profile.newstudentCompetition]; }
                    }
                    profile.newstudentCompetition = {
                        comp_awards: [{
                            award_name: ""
                        }],
                        photos: ""
                    };
                    $('#addNewCompetitionModal').modal('hide');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        addAward_item(action){
            var awards = {
                award_name: "",
            };
            if(action=='add'){
                if(this.newstudentCompetition.comp_awards!=null){                    
                    this.newstudentCompetition.comp_awards.push(awards);
                }else{
                    this.newstudentCompetition.comp_awards = [awards];
                }
            }else if(action=="edit"){
                if(this.competitionDetails.comp_awards!=null){                    
                    this.competitionDetails.comp_awards.push(awards);
                }else{
                    this.competitionDetails.comp_awards = [awards];
                }
            }
        },        
        cancelAward_item(action,index){
            if(action=="add"){
                this.newstudentCompetition.comp_awards.splice(index, 1);
            }else if(action=="edit"){
                this.competitionDetails.comp_awards.splice(index, 1);
            }
        },
        getCompetitionDetails(studcomp_id,index){
            var datas = {
                studcomp_id: studcomp_id
            }
            var urls = window.App.baseUrl + "students/getCompetitionDetails";
            showloading("Loading Data");
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    profile.competitionDetails = e.data.data.competitiondetails;
                    profile.competitionDetails.comp_awards = JSON.parse(profile.competitionDetails.comp_awards);
                    profile.competitionDetails.complistindex = index;
                    $('#editCompetitionModal').modal('show');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        submitCompetitionDataChanges(){
            let formData = new FormData();
            formData.append('competitiondata', JSON.stringify(this.competitionDetails));
            formData.append('file', this.$refs.competition_photo_edit.files[0]);

            var urls = window.App.baseUrl + "students/saveCompetitionDataChanges";
            showloading();
            axios.post(urls, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
                .then(function (e) {
                    Swal.close();
                    Swal.fire({
                        type: e.data.type,
                        title: e.data.message
                    })
                    var index = profile.competitionDetails.complistindex;
                    profile.competitionslist[index].comp_date = profile.competitionDetails.comp_date;
                    profile.competitionslist[index].comp_title = profile.competitionDetails.comp_title;
                    profile.competitionslist[index].comp_type = profile.competitionDetails.comp_type;
                    
                    profile.competitionDetails = {
                        comp_awards: [{
                            award_name: ""
                        }],
                        photos: ""
                    };
                    $('#editCompetitionModal').modal('hide');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        //fourth tab
        checked_eval(index,action,type,rating){
            if(action=='add'){
                if(type=='technique'){ var data = this.evaluation_add.eval_technique[index]; }
                else if(type=='attitude'){ var data = this.evaluation_add.eval_attitude[index]; }
            }
            else if(action=='edit'){
                if(type=='technique'){ var data = this.evaluation_edit.eval_technique[index]; }
                else if(type=='attitude'){ var data = this.evaluation_edit.eval_attitude[index]; }
            }
            if(rating!='rate_o'){ data.rate_o = ''; }
            if(rating!='rate_vg'){ data.rate_vg = ''; }
            if(rating!='rate_g'){ data.rate_g = ''; }
            if(rating!='rate_s'){ data.rate_s = ''; }
            if(rating!='rate_ni'){ data.rate_ni = ''; }
        },
        saveStudentPromotion(){
            var pt_index = this.studentRankInfo.newstudentPromotion.rank_id;
            this.studentRankInfo.newstudentPromotion.rank_id = this.rankslist[pt_index].rank_id;
            var rank_title = this.rankslist[pt_index].rank_title;

            var nr_index = this.studentRankInfo.newstudentPromotion.next_rank.rank_id;
            this.studentRankInfo.newstudentPromotion.next_rank.rank_id = this.rankslist[nr_index].rank_id;
            this.studentRankInfo.newstudentPromotion.next_rank.rank_title = this.rankslist[nr_index].rank_title;

            this.studentRankInfo.newstudentPromotion.photo = this.$refs.promotion_photo_add.files[0];
            let formData = new FormData();

            formData.append('promotion_info', JSON.stringify(this.studentRankInfo.newstudentPromotion));
            formData.append('evaluation_info', JSON.stringify(this.evaluation_add));
            formData.append('student_id', this.student_id);
            formData.append('file', this.studentRankInfo.newstudentPromotion.photo);

            var urls = window.App.baseUrl + "students/saveStudentPromotion";
            showloading();
            axios.post(urls, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
                .then(function (e) {
                    Swal.close();
                    Swal.fire({
                        type: e.data.type,
                        title: e.data.message
                    }).then(function (el) {
                        if(e.data.success){
                            profile.studentRankInfo.newstudentPromotion.rank_title = rank_title;
                            profile.studentRankInfo.newstudentPromotion.promotion_id = e.data.data.promotion_id;

                            profile.getPromotionsList();
                            profile.studentRankInfo.currentRank = profile.studentRankInfo.newstudentPromotion;

                            profile.studentRankInfo.newstudentPromotion = {
                                next_rank: {
                                    rank_id: "",
                                    rank_title: "",
                                    ses_needed: ""
                                },
                                ses_attended: 0,
                            };
                            profile.evaluation_add = {
                                eval_technique: [{
                                    name: "POOMSAE",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "DEFENSE FORM",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "KICKINGS",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "COMBINATIONS",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "SPARRING",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                }],
                                eval_attitude: [{
                                    name: "Attendance and Punctuality",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "Accomplishment of Tasks",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "Intereset and Initiative",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "Courtesy and Discipline",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "Consent for Other",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                }],
                                eval_remarks: null
                            }
                        }
                        $('#addNewPromotionModal').modal('hide');
                    })
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getPromotionsList(){
            var datas = {
                student_id: this.student_id,
            };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "students/getPromotionList";
            showloading("Loading Data");
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    profile.studentRankInfo.promotionlist = e.data.data.promotioninfos;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        viewPromotionInfo(index){
            var datas = {
                promotion_id: this.studentRankInfo.promotionlist[index].promotion_id,
            };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "students/getPromotionList";
            showloading("Loading Data");
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    profile.studentRankInfo.viewStudentPromotion = e.data.data.promotioninfos;
                    profile.evaluation_edit.eval_remarks = profile.studentRankInfo.viewStudentPromotion.eval_remarks;
                    profile.evaluation_edit.eval_attitude = JSON.parse(profile.studentRankInfo.viewStudentPromotion.eval_attitude);
                    profile.evaluation_edit.eval_technique = JSON.parse(profile.studentRankInfo.viewStudentPromotion.eval_technique);
                    profile.studentRankInfo.viewStudentPromotion.next_rank = JSON.parse(profile.studentRankInfo.viewStudentPromotion.next_rank);
                    $('#editPromotionModal').modal('show');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        changePromotionImage_add(){
            $("input[id='selectPromImage_add']").click();
        },
        addPromotionImageSelect(event){
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#addselectedImage_Promotion')
                        .attr('src', e.target.result)
                        .width("100%");
                };
                $('#addselectedImage_Promotion').css({'display': '',});
                $('#selectPromImage_add').css({'display': 'none',});

                reader.readAsDataURL(event.target.files[0]);
            }
        },
        editPromotionImageSelect(event){
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#editselectedImage_Promotion')
                        .attr('src', e.target.result)
                        .width("100%");
                };

                reader.readAsDataURL(event.target.files[0]);
            }
        },
        changePromotionImage_edit(){
            $("input[id='selectPromImage_edit']").click();
        },
        savePromotionChanges(){
            this.studentRankInfo.viewStudentPromotion.photosel = this.$refs.promotion_photo_edit.files[0];
            let formData = new FormData();

            formData.append('next_rank', JSON.stringify(this.studentRankInfo.viewStudentPromotion.next_rank));
            formData.append('remarks', this.studentRankInfo.viewStudentPromotion.remarks);
            formData.append('evaluation_info', JSON.stringify(this.evaluation_edit));
            formData.append('promotion_id', this.studentRankInfo.viewStudentPromotion.promotion_id);
            formData.append('file', this.studentRankInfo.viewStudentPromotion.photosel);

            var urls = window.App.baseUrl + "students/savePromotionChanges";
            showloading();
            axios.post(urls, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
                .then(function (e) {
                    Swal.close();
                    Swal.fire({
                        type: e.data.type,
                        title: e.data.message
                    }).then(function (el) {
                        if(e.data.success){
                            profile.getPromotionsList();
                            profile.studentRankInfo.viewStudentPromotion = {
                                next_rank: {
                                    rank_id: "",
                                    rank_title: "",
                                    ses_needed: ""
                                },
                                ses_attended: 0,
                                photo: ""
                            };
                            profile.evaluation_edit = {
                                eval_technique: [{
                                    name: "POOMSAE",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "DEFENSE FORM",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "KICKINGS",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "COMBINATIONS",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "SPARRING",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                }],
                                eval_attitude: [{
                                    name: "Attendance and Punctuality",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "Accomplishment of Tasks",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "Intereset and Initiative",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "Courtesy and Discipline",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                },{
                                    name: "Consent for Other",
                                    rate_o: 1,
                                    rate_vg: '',
                                    rate_g: '',
                                    rate_s: '',
                                    rate_ni: ''
                                }],
                                eval_remarks: null
                            }
                        }
                        $('#editPromotionModal').modal('hide');
                    })
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        //sixth tab
        viewPaymentsModal(index){
            this.paymentdetails = {
                invoice_id: "",
                student_id: "",
                ornumber: "",
                paymentdate: currentdate,
                ordate: currentdate,
                paymentoption: "full",
                amount: 0,
            }
            var invoice_id = this.invoicelist[index].invoice_id;
            var datas = {
                "invoice_id": invoice_id
            };
            var urls = window.App.baseUrl + "invoice/viewPayments";
            axios.post(urls, datas)
                .then(function (e) {
                    profile.invoicedetails.paymentslist = e.data.data.paymentslist;
                    profile.addPaymentModal(invoice_id);
                    $('#viewPaymentsModal').modal('show');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        addPaymentModal(invoice_id){
            this.paymentdetails = {
                invoice_id: "",
                student_id: "",
                ornumber: "",
                paymentdate: currentdate,
                ordate: currentdate,
                paymentoption: "full",
                amount: 0,
            }
            var datas = {
                "invoice_id": invoice_id,
            };
            var urls = window.App.baseUrl + "invoice/getInvoiceDetails";
            showloading("Loading Data");
            axios.post(urls, datas)
                .then(function (e) {
                    profile.invoicedetails.details = e.data.data.invoicedetails;
                    profile.invoicedetails.details.paymentstotal = e.data.data.paymentstotal;

                    profile.paymentdetails.invoice_id = e.data.data.invoicedetails.invoice_id;
                    profile.paymentdetails.amountmax = profile.invoicedetails.details.amount - profile.invoicedetails.details.paymentstotal;
                    profile.paymentdetails.amount = profile.invoicedetails.details.amount - profile.invoicedetails.details.paymentstotal;
                    Swal.close();
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        addPaymentModalshow(){
            $('#viewPaymentsModal').modal('hide');
            $('#addPaymentsModal').modal('show');
        },
        savePayment(){
            if(this.invoicedetails.details.amount==(parseInt(this.invoicedetails.details.paymentstotal)+parseInt(this.paymentdetails.amount))){
                var invstat = "paid";
            }else{ var invstat = "partial"; }
            
            this.paymentdetails.student_id = this.student_id;
            this.paymentdetails.ordate += " " + currenttime;
            var datas = {
                "paymentdetails": this.paymentdetails,
                "invoicestatus": invstat
            };
            var urls = window.App.baseUrl + "invoice/savePayment";
            showloading();
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    Swal.fire({
                        type: e.data.type,
                        title: e.data.message
                    }).then(function (e) {
                        profile.getInvoiceList();
                        $('#addPaymentsModal').modal('hide');
                    })
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        amountchange(){
            if(this.paymentdetails.amount == this.invoicedetails.details.amount - this.invoicedetails.details.paymentstotal){
                this.paymentdetails.paymentoption = "full";
                this.paymentdetails.amount = this.invoicedetails.details.amount - this.invoicedetails.details.paymentstotal;
            }else{
                this.paymentdetails.paymentoption = "staggered";
            }
        },
        changePaymentOption(){
            if(this.paymentdetails.paymentoption=="full"){
                this.paymentdetails.amount = this.paymentdetails.amountmax;
            }else if(this.paymentdetails.paymentoption=="staggered"){
                this.paymentdetails.amount = "";
            }
        },
        getInvoiceList(){
            var datas = {
                condition: { "si.student_id": this.student_id  }
            }
            var urls = window.App.baseUrl + "invoice/getInvoiceList";
            axios.post(urls, datas)
                .then(function (e) {
                    profile.invoicelist = e.data.data.invoicelist;
                    profile.invoiceinfo = e.data.data.invoiceinfo;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        printInvoice(invoice_id){
            var urls = window.App.baseUrl + "Invoice/printInvoice/"+invoice_id;
            window.open(urls, "_blank");
        }
    }, mounted: function () {
        this.getStudentProfile();
        this.getStudentPackages();
    },
})