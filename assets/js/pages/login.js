var login = new Vue({
    el: '#login_page',
    data: {
        userdata: {},
    },
    methods: {
        // firstrun(){
        //     alert();
        // },
        checkUser(){
            var urls = window.App.baseUrl + "login/checkUser";
            axios.post(urls, "")
                .then(function (e) {
                    console.log(e);
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
    }, mounted: function () {
// this.firstrun();
    },
})