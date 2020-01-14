// if($('#classes_page').length){
Vue.use(VueTables.ServerTable);
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
        selectedStudents: {},
        table: {
            column: [
                "class_title",
                "branch_name",
                "sched_day",
                "enrolled",
                "status",
                "action", ],
            data: [],
            options: {
                sortable: ['class_title','branch_name'],
                filterable: ['class_title','branch_name'],
                headings: {
                    class_title: "Class Title",
                    branch_name: "Branch Name",
                    sched_day: "Schedule",
                    enrolled: "Enrollees",
                    status: "Status",
                    action: "Action",
                },
            }
        },
    },
    methods: {
        // getClassHistoryInfo(){
        //     // alert();
        //     var datas = { class_id:this.class_id };
        //     var datas = frmdata(datas);
        //     var urls = window.App.baseUrl + "classes/getClassHistoryInfo";
        //     axios.post(urls, datas)
        //         .then(function (e) {
        //             classsched.classhistoryinfo=e.data.data;
        //         })
        //         .catch(function (error) {
        //             console.log(error)
        //         });
        // },
        // viewClassSchedProfileModal(attendance_id){
        //     var datas = { 
        //         class_id:this.class_id,
        //         attendance_id: attendance_id
        //     };
        //     var datas = frmdata(datas);
        //     var urls = window.App.baseUrl + "classes/getClassSchedInfo";
        //     axios.post(urls, datas)
        //         .then(function (e) {
        //             classsched.classschedprofile=e.data.data;
        //             $('#viewClassSchedProfileModal').modal('show');
        //         })
        //         .catch(function (error) {
        //             console.log(error)
        //         });
        // },
        // markAsPresent(){
        //     alert();
        // },
    }, mounted: function () {
    },
})

// }