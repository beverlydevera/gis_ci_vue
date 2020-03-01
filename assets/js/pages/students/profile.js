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
        //second tab
        studentpackages: {
            regular: [],
            unlimited: [],
            summerpromo: []
        },
        package_select: {
            packagetype: "Regular"
        },
        studentattendance: [],
        //third tab
        newstudentCompetition: {
            comp_awards: [{
                award_name: ""
            }]
        },
        competitionDetails: {
            comp_awards: [{
                award_name: ""
            }]
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
            },
            promotionlist: []
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
            
                            if(enroll.studentinfo.photo!=null){
                                reader.onload = function (e) {
                                    $('#editStudentImage')
                                        .attr('src', e.target.result)
                                        .width("80%");
                                };
                            }else{
                                reader.onload = function (e) {
                                    $('#editStudentImage1')
                                        .attr('src', e.target.result)
                                        .width("80%");
                                };
                            }
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
        //first tab
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
                    Swal.close();
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
        },
        viewAttendance(schedule_id,type){
            var datas = {
                schedule_id: schedule_id,
                student_id: this.student_id
            }
            //iba yung ipapasa pag unlimited yung package
            var urls = window.App.baseUrl + "students/getStudentAttendance";
            showloading();
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    if(e.data.success){
                        profile.studentattendance = e.data.data.studentattendance;
                        $('#'+type+'_attendanceModal').modal('show');
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
        //third tab
        submitNewStudentCompetition(){
            var datas = {
                competition_info: this.newstudentCompetition,
                student_id: this.student_id
            }
            var urls = window.App.baseUrl + "students/saveStudentCompetition";
            showloading();
            axios.post(urls, datas)
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
                        }]
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
            var datas = {
                competitiondata: this.competitionDetails
            }
            var urls = window.App.baseUrl + "students/saveCompetitionDataChanges";
            showloading();
            axios.post(urls, datas)
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
                        }]
                    };
                    $('#editCompetitionModal').modal('hide');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        //fourth tab
        saveStudentPromotion(){
            var pt_index = this.studentRankInfo.newstudentPromotion.rank_id;
            this.studentRankInfo.newstudentPromotion.rank_id = this.rankslist[pt_index].rank_id;
            var rank_title = this.rankslist[pt_index].rank_title;

            var nr_index = this.studentRankInfo.newstudentPromotion.next_rank.rank_id;
            this.studentRankInfo.newstudentPromotion.next_rank.rank_id = this.rankslist[nr_index].rank_id;
            this.studentRankInfo.newstudentPromotion.next_rank.rank_title = this.rankslist[nr_index].rank_title;

            var datas = {
                promotion_info: this.studentRankInfo.newstudentPromotion,
                student_id: this.student_id
            }
            var urls = window.App.baseUrl + "students/saveStudentPromotion";
            showloading();
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    Swal.fire({
                        type: e.data.type,
                        title: e.data.message
                    })
                    if(e.data.success){
                        profile.studentRankInfo.newstudentPromotion.rank_title = rank_title;
                        profile.studentRankInfo.newstudentPromotion.promotion_id = e.data.data.promotion_id;

                        if(profile.studentRankInfo.promotionlist!=null){ profile.studentRankInfo.promotionlist.push(profile.studentRankInfo.newstudentPromotion); }
                        else{ profile.studentRankInfo.promotionlist = [profile.studentRankInfo.newstudentPromotion]; }
                        
                        profile.studentRankInfo.currentRank = profile.studentRankInfo.newstudentPromotion;

                        profile.studentRankInfo.newstudentPromotion = {
                            next_rank: {
                                rank_id: "",
                                rank_title: "",
                                ses_needed: ""
                            },
                            ses_attended: 0,
                        };
                    }
                    $('#addNewPromotionModal').modal('hide');
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
            showloading("Loading Data");
            axios.post(urls, datas)
                .then(function (e) {
                    swal.close();
                    profile.invoicelist = e.data.data.invoicelist;
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
    },
})