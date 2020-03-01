var currentdate = formatDate(new Date());
var currenttime = formatTime(new Date());

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

function formatTime(date) {
    var d = new Date(date);
    var hr = d.getHours();
    var min = d.getMinutes();
    var sec = d.getSeconds();

    if (hr < 10)
        hr = "0" + hr;
    if (min < 10)
        min = "0" + min;
    if (sec < 10)
        sec = "0" + sec;

    return [hr, min, sec].join(':');
}

var enroll = new Vue({
    el: '#studentenroll_page',
    data: {
        disabled_everything: false,
        disabled_packages: false,
        studentrefid:"",
        student_id:"",
        studentinfo:{
            telephoneno: "",
            religion: "",
            nickname: "",
        },
        otherinfo:{
            insurance: {
                avail: 1,
                price: 60
            },
            studmem_id: 0,
            invoiceno: 1,
            invoicedetails: {
                studmembership: {},
                studpackages: []
            },
            invoicetotal: 0
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
        selectedPackages: [],
        paymentdetails: {
            paymentoption: "full",
            ordate: currentdate
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

            if(this.derivedinfo.studentage>=25){
                this.otherinfo.insurance.price = 150;
            }else{
                this.otherinfo.insurance.price = 60;
            }
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
            var urls = window.App.baseUrl + "students/enroll_saveNewStudentRegistration";
            showloading();
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    Toast.fire({
                        type: e.data.type,
                        title: e.data.message
                    })
                    if(e.data.success){
                        enroll.studentrefid = e.data.data.reference_id;
                        enroll.student_id = e.data.data.student_id;
                        enroll.otherinfo.studmem_id = e.data.data.studmem_id;
                        enroll.disabled_everything = true;
                        enroll.otherinfo.invoice_id = e.data.data.invoice_id;
                        enroll.otherinfo.invoice_number = e.data.data.invoice_number;

                        $('.active').removeClass('active');                        
                        $('#availpackages-tab').removeClass('disabled');
                        $('#availpackages-tab').addClass('active');
                        $('#availpackages').addClass('active show');

                        $('#submitapplicationform').css({'display': 'none',});
                        $('#updateapplicationform').css({'display': '',});
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
            Swal.fire({
                title: "Are you sure you want to save selected packages and proceed to billing?",
                text: "You won't be able to undo this.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save and proceed',
                }).then((result) => {
                    if (result.value) {
                        if(this.otherinfo.insurance.avail==0){ this.otherinfo.insurance.price=0; }
                        var datas = {
                            insurance: this.otherinfo.insurance,
                            studentpackages: this.selectedPackages,
                            invoice_id: this.otherinfo.invoice_id,
                            studmem_id: this.otherinfo.studmem_id
                        };
                        var urls = window.App.baseUrl + "Students/enroll_saveNewStudentPackages";
                        showloading();
                        axios.post(urls, datas)
                            .then(function (e) {
                                Swal.close();
                                Toast.fire({
                                    type: e.data.type,
                                    title: e.data.message
                                })
                                if(e.data.success){
                                    enroll.getInvoiceDetails();
                                    $('.active').removeClass('active');                        
                                    $('#billinginfo-tab').removeClass('disabled');
                                    $('#billinginfo-tab').addClass('active');
                                    $('#billinginfo').addClass('active show');
    
                                    enroll.packagelist = [];
                                    enroll.packages_selects.packagetype = "";
                                    enroll.disabled_packages = true;
                                    
                                    $('#packagetype_regular').css({'display': 'none',});
                                    $('#regular_schedules').css({'display': 'none',});
                                    $('#packagetype_unlimited').css({'display': 'none',});
                                    $('#packagetype_summerpromo').css({'display': 'none',});
                                    $('#savenewstudentpackages').css({'display': 'none',});
                                }
                            })
                            .catch(function (error) {
                                console.log(error)
                            }); 
                    }
            })
        },
        getInvoiceDetails(){
            var datas = {
                student_id: this.student_id,
                invoice_id: this.otherinfo.invoice_id,
            };
            var urls = window.App.baseUrl + "Students/enroll_getInvoiceDetails";
            axios.post(urls, datas)
                .then(function (e) {
                    enroll.otherinfo.invoicedetails.studmembership = e.data.data.invoice_membership;
                    enroll.otherinfo.invoicetotal = parseInt(1000);
                    if(enroll.otherinfo.insurance.avail!=0){
                        if(enroll.derivedinfo.studentage>=25){
                            enroll.otherinfo.invoicetotal += parseInt(150);
                        }else{
                            enroll.otherinfo.invoicetotal += parseInt(60);
                        }
                    }

                    e.data.data.invoice_packages.forEach(e => {
                        if(e.packagetype=="Unlimited"){
                            var package = {
                                invoice_id: e.invoice_id,
                                student_id: e.student_id,
                                studpack_id: e.studpack_id,
                                year: e.year,
                                package_id: e.package_id,
                                details: JSON.parse(e.details),
                                packagedetails: e.packagedetails,
                                packagetype: e.packagetype,
                                pricerate: e.pricerate
                            }
                        }else{
                            var package = {
                                invoice_id: e.invoice_id,
                                student_id: e.student_id,
                                studpack_id: e.studpack_id,
                                year: e.year,
                                package_id: e.package_id,
                                details: JSON.parse(e.details),
                                packagedetails: JSON.parse(e.packagedetails),
                                packagetype: e.packagetype,
                                pricerate: e.pricerate
                            }
                        }
                        enroll.otherinfo.invoicedetails.studpackages.push(package)
                        enroll.otherinfo.invoicetotal += parseInt(e.pricerate);
                        enroll.paymentdetails.amount = enroll.otherinfo.invoicetotal;
                    });
                })
                .catch(function (error) {
                    console.log(error)
                }); 
        },
        proceedtoPayment(){
            // Swal.fire({
            //     title: "Are you sure you want to proceed to payment?",
            //     // text: "You won't be able to undo this.",
            //     type: 'warning',
            //     showCancelButton: true,
            //     confirmButtonColor: '#3085d6',
            //     cancelButtonColor: '#d33',
            //     confirmButtonText: 'Yes, proceed to payment',
            //     }).then((result) => {
            //         if (result.value) {
                        $('.active').removeClass('active');
                        $('#payment-tab').removeClass('disabled');
                        $('#payment-tab').addClass('active');
                        $('#payment').addClass('active show');
            //             $('#proceedtoPayment').css({'display': 'none',});
            //         }
            // })
        },
        changePaymentOption(){
            if(this.paymentdetails.paymentoption=="full"){
                this.paymentdetails.amount = this.otherinfo.invoicetotal;
            }else if(this.paymentdetails.paymentoption=="staggered"){
                this.paymentdetails.amount = "";
            }
        },
        savePayment(){
            Swal.fire({
                title: "Are you sure you want to save payment?",
                text: "You won't be able to undo this.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save payment',
                }).then((result) => {
                    if (result.value) {
                        this.paymentdetails.invoice_id = this.otherinfo.invoice_id;
                        this.paymentdetails.student_id = this.student_id;
                        this.otherinfo.paymentordate = this.paymentdetails.ordate;
                        this.paymentdetails.ordate += " " + currenttime;
                        var datas = {
                            paymentdetails: this.paymentdetails,
                            invoiceamount: this.otherinfo.invoicetotal
                        };
                        showloading();
                        var urls = window.App.baseUrl + "Students/enroll_savePayment";
                        axios.post(urls, datas)
                            .then(function (e) {
                                if(e.data.success){
                                    Swal.close();
                                    Swal.fire({
                                        text: e.data.message,
                                        type: 'success',
                                    }).then((result) => {
                                        enroll.paymentdetails.payment_id = e.data.data.result.lastid;
                                        enroll.paymentdetails.ordate = enroll.otherinfo.paymentordate;
                                        console.log(enroll.paymentdetails.payment_id);
                                        $('.active').removeClass('active');
                                        $('#complete-tab').removeClass('disabled');
                                        $('#complete-tab').addClass('active');
                                        $('#complete').addClass('active show');

                                        $("input").attr("disabled", true);
                                        $("select").attr("disabled", true);
                                        $("textarea").attr("disabled", true);
                                        $('button').css({'display': 'none',});
                                    })
                                }else{
                                    Toast.fire({
                                        type: "error",
                                        title: e.data.message
                                    })
                                }
                            })
                            .catch(function (error) {
                                console.log(error)
                            }); 
                    }
            })
        }
    },
    watch: {
        // app_reference_code: function(val) {
        //     this.getExamination();
        // }
    },
    mounted: function () {
        //firstrun
    },
})