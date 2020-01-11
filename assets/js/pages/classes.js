if($('#classes_page').length){

    var classsched = new Vue({
        el: '#classes_page',
        data: {
            classschedlist: {},
            classhistoryinfo: {
                present: {},
                absent: {},
            },
            classschedprofile: {},
            class_id:$('#class_id').val(),
            selectedStudents: {}
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
            getClassHistoryInfo(){
                // alert();
                var datas = { class_id:this.class_id };
                var datas = frmdata(datas);
                var urls = window.App.baseUrl + "classes/getClassHistoryInfo";
                axios.post(urls, datas)
                    .then(function (e) {
                        classsched.classhistoryinfo=e.data.data;
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            viewClassSchedProfileModal(attendance_id){
                var datas = { 
                    class_id:this.class_id,
                    attendance_id: attendance_id
                };
                var datas = frmdata(datas);
                var urls = window.App.baseUrl + "classes/getClassSchedInfo";
                axios.post(urls, datas)
                    .then(function (e) {
                        classsched.classschedprofile=e.data.data;
                        $('#viewClassSchedProfileModal').modal('show');
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            markAsPresent(){
                alert();
            },
            addNewAttendance(){
                alert();
            }
        }, mounted: function () {
            this.getClassScheds();
            if(this.class_id.length){
                this.getClassHistoryInfo();
            }
        },
    })

}