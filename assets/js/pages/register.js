var register = new Vue({
    el: '#register_page',
    data: {
        registration_info: {
            lastname: "",
            firstname: "",
            middlename: "",
        },
    },
    methods: {
        checkifAccountExist(inputcol){
            if(inputcol=='Account Name'){
                if( this.registration_info.lastname!='' && this.registration_info.firstname!='' && this.registration_info.middlename!=''){
                    var datas = {
                        inputcol: inputcol,
                        datacheck: {
                            lastname: this.registration_info.lastname,
                            firstname: this.registration_info.firstname,
                            middlename: this.registration_info.middlename
                        }
                    }
                }
            }else if(inputcol=='Username'){
                var datas = {
                    inputcol: inputcol,
                    datacheck: { username: this.registration_info.username }
                }
            }else if(inputcol=='Email Address'){
                var datas = {
                    inputcol: inputcol,
                    datacheck: { emailadd: this.registration_info.emailadd }
                }
            }
            var urls = window.App.baseUrl + "Register/checkifAccountExist";
            axios.post(urls, datas)
                .then(function (e) {
                    if(e.data.success){
                        Toast.fire({
                            type: e.data.type,
                            title: e.data.message
                        })
                        if(inputcol=='Account Name'){ register.registration_info.lastname = register.registration_info.firstname = register.registration_info.middlename = ""; }
                        else if(inputcol=='Username'){ register.registration_info.username = ""; }
                        else if(inputcol=='Email Address'){ register.registration_info.emailadd = ""; }
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        checkPasswordSame(){
            var newpass = this.registration_info.password;
            var conpass = this.registration_info.confirmpass;

            if(conpass!=""){
                if(newpass!=conpass){
                    Toast.fire({
                        type: "warning",
                        title: "Passwords do not match"
                    }) 
                }
            }
        },
        registerNewAccount(){

        }
    }, mounted: function () {
        // this.getStudents();
    },
})