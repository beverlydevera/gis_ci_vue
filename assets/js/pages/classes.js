if($('#classes_page').length){

    var classsched = new Vue({
        el: '#classes_page',
        data: {
            classschedlist: {},
        },
        methods: {
            getClassScheds(){
                var urls = window.App.baseUrl + "classes/getClassScheds";
                axios.post(urls, "")
                    .then(function (e) {
                        classsched.classschedlist=e.data.data;
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            },
        }, mounted: function () {
            this.getClassScheds();
        },
    })

}