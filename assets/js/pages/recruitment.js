// Vue.use(VueTables.ClientTable);

var pds = new Vue({
    el: '#recruitment_page',
    data: {
        disabled_everything : false,
        vacancyid:$('#vacancyid').val(),
        page_status: "new",
        form: {
            pos_apply: "",
            app_details: {
                app_id: "",
                app_reference_code: "",
                surname: "",
                first_name: "",
                middle_name: "",
                ext_name: "",
                sex: "",
                birthday: "",
                age: 0,
                civil_status: "",
                indigenous_group: "",
                currently_employed: "",
                area_assign: [],
                willing_otherpos: "",
                smoke: "",
                cessation: "",
                disability: "",
                medical_condi: "",
                medical_details: "",
            },
            app_personal: {
                citizenship: "",
                citizenship_dual_type: "",
                citizenship_dual_country: "",
                place_of_birth: "",
                house_no: "",
                street: "",
                subdivision: "",
                barangay: "",
                city: "",
                province: "",
                zipcode: "",
                height: "",
                weight: "",
                blood_type: "",
                p_house_no: "",
                p_street: "",
                p_subdivision: "",
                p_barangay: "",
                p_city: "",
                p_province: "",
                p_zipcode: "",
                gsis: "", 
                pagibig: "",
                philhealth: "",
                sss: "",
                tin: "",
                telephone: "",
                mobile: "",
                agency_no: "",
                email_address: "",
            }
        }
    },
    methods: {
        firstrun(){
            alert();
        },
        calculate_age() {
            var dob = this.form.app_details.birthday;
            var dob = dob.split("-");
            var dob = new Date(dob[0], dob[1], dob[2])
            var diff_ms = Date.now() - dob.getTime();
            var age_dt = new Date(diff_ms);
            this.form.app_details.age = Math.abs(age_dt.getUTCFullYear() - 1970);
        },
        getVacancy(){
            var datas = { vacancyid:this.vacancyid };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "recruitment/getVacancy";
            axios.post(urls, datas)
                .then(function (e) {
                    pds.form.pos_apply = e.data.jobvacancies.pos_title;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getApplicantDetails(){
            if(this.form.app_details.app_reference_code!=""){
            var datas = { apprefcode:this.form.app_details.app_reference_code };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "recruitment/getApplicantDetails";
            axios.post(urls, datas)
                .then(function (e) {
                    if(e.data.success){
                        Toast.fire({
                            type: 'success',
                            title: e.data.message
                        })
                        pds.disabled_everything = true;
                        $('.disabled').removeClass('disabled');

                        //auto-fill fields in forms

                        //app_details and app_personal
                        var datas = e.data.data;
                        pds.form.app_details=datas.applicant_personal;
                        pds.calculate_age();
                        pds.form.app_details.area_assign=datas.applicant_personal.area_assign.split(",");
                        pds.form.app_details.smoke=datas.applicant_personal.smoke.split("/")['0'];
                        pds.form.app_details.cessation=datas.applicant_personal.smoke.split("/")['1'];
                        pds.form.app_details.medical_condi=datas.applicant_personal.medical_condi.split("/")['0'];
                        pds.form.app_details.medical_details=datas.applicant_personal.medical_condi.split("/")['1'];

                        //app_eligibility

                        //app_trainings

                        //app_reference

                        pds.page_status = "old";
                    }else{
                        Toast.fire({
                            type: "warning",
                            title: e.data.message
                        })
                        pds.form.app_details.app_id="";
                        pds.form.app_details.app_reference_code="";
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
            }
        },
        checkUserExist() {
            if (this.page_status == "new") {
                var datas = {
                    surname: this.form.app_details.surname,
                    first_name: this.form.app_details.first_name,
                    middle_name: this.form.app_details.middle_name,
                    birthday: this.form.app_details.birthday,
                };
                var datas = frmdata(datas);
                var urls = window.App.baseUrl + "recruitment/checkExistApplicant";
                axios.post(urls, datas)
                    .then(function (e) {
                        if (!e.data.success) {
                            Swal.fire({
                                title: e.data.title,
                                text: e.data.message
                                // then(()=>{}) //shortcut
                            }).then(function(e){
                                pds.form.app_details.app_id="";
                                pds.form.app_details.app_reference_code="";
                                pds.form.app_details.surname="";
                                pds.form.app_details.first_name="";
                                pds.form.app_details.middle_name="";
                                pds.form.app_details.ext_name="";
                                pds.form.app_details.sex="";
                                pds.form.app_details.birthday="";
                                pds.form.app_details.age="";
                                pds.form.app_details.civil_status="";
                                pds.form.app_details.indigenous_group="";
                            })
                        }
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            }
        },
        saveApplication() {
            var medata = this.form.app_details;
            var datas = {
                app_id: medata.app_id,
                app_reference_code: medata.app_reference_code,
                surname: medata.surname,
                first_name: medata.first_name,
                middle_name: medata.middle_name,
                ext_name: medata.ext_name,
                sex: medata.sex,
                birthday: medata.birthday,
                age: medata.age,
                civil_status: medata.civil_status,
                vacancyid: this.vacancyid,
                pos_apply: pds.form.pos_apply,
                indigenous_group: medata.indigenous_group,
                currently_employed: medata.currently_employed,
                willing_otherpos: medata.willing_otherpos,
                area_assign: medata.area_assign,
                available_startdate: medata.available_startdate,
                desired_payrange: medata.desired_payrange,
                intended_staydswd: medata.intended_staydswd,
                smoke: medata.smoke,
                cessation: medata.cessation,
                disability: medata.disability,
                medical_condi: medata.medical_condi,
                medical_details: medata.medical_details,
            };
            var datas = frmdata(datas);

            var urls = window.App.baseUrl + "recruitment/saveApplication";
            axios.post(urls, datas)
                .then(function (e) {
                    console.log(e);
                    if (e.data.success) {
                        var success = e.data.success ? "success" : "warning";
                        if(e.data.action=="new") {
                            Swal.fire({
                                html: e.data.message
                            })
                        }else{
                            Toast.fire({
                                type: 'success',
                                title: e.data.message
                            })
                        }
                        pds.form.app_details.app_id = e.data.data.app_id;
                        pds.form.app_details.app_reference_code = e.data.data.app_reference_code;
                        pds.disabled_everything = true;
                        $('.active').removeClass('active');
                        $('.disabled').removeClass('disabled');

                        $('#personal_sheet-tab').addClass('active');
                        $('#personal_sheet').addClass('active show');            
                        pds.page_status = "old";
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        savePersonalInfo() {
            alert();
            // var datas = {
                
            // };
            // var urls = window.app.baseUrl + "recruitment/savePDS";
        }

    }, mounted: function () {
        this.getVacancy();
        this.firstrun();
    },
})