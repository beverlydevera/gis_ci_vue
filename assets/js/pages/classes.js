if($('#classes_page').length){

    var classsched = new Vue({
        el: '#classes_page',
        data: {
            classschedlist: {},
            classschedprofile: {},
            class_id:$('#class_id').val(),
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
            getClassSchedProfile(){
                // alert();
                var datas = { class_id:this.class_id };
                var datas = frmdata(datas);
                var urls = window.App.baseUrl + "classes/getClassSchedInfo";
                axios.post(urls, datas)
                    .then(function (e) {
                        classsched.classschedprofile=e.data.data;
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            }
        }, mounted: function () {
            this.getClassScheds();
            if((this.class_id).length){
                this.getClassSchedProfile();
            }
        },
    })

}