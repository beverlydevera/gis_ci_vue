var login = new Vue({
    el: '#login_page',
    data: {
        userdata: {
            username: "",
            password: "",
        },
    },
    methods: {
        checkUser(){
            var datas = frmdata(this.userdata);
            var urls = window.App.baseUrl + "login/checkUser";
            axios.post(urls, datas)
                .then(function (e) {
                    console.log(e);
                    if (e.data.success) {
                        Toast.fire({
                            type: "success",
                            title: e.data.message
                        })
                        setTimeout(function(){
                            location.reload();
                        }, 500);
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
        forgotpass(){
            Swal.fire({
                title: "Password Recovery warning",
                text: "Please contact your system administrator to recover your account/password.",
                type: 'warning',
            })
        }
    }, mounted: function () {
        //a
    },
})