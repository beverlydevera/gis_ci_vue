// Vue.use(VueTables.ClientTable);
var schedadd = new Vue({
    el: '#scheduleadd_page',
    data: {
        brancheslist: [],
        classeslist: [],
        newScheduleInfo: {
            branch_id: 0,
            class_id: 0,
            sched_day: 0,
            status: 1
        },
    },
    methods: {
        getBranchesList(){
            var urls = window.App.baseUrl + "Libraries/getBranches";
            axios.post(urls, "")
                .then(function (e) {
                    schedadd.brancheslist=e.data.data.brancheslist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getClassesList(){
            var urls = window.App.baseUrl + "Libraries/getClassesList";
            axios.post(urls, "")
                .then(function (e) {
                    schedadd.classeslist=e.data.data.classeslist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        saveSchedule(){
            var datas = this.newScheduleInfo;
            var urls = window.App.baseUrl + "Schedules/saveSchedule";
            axios.post(urls, datas)
                .then(function (e) {
                    Toast.fire({
                        type: e.data.type,
                        text: e.data.message
                    });
                    schedadd.newScheduleInfo = {
                        branch_id: 0,
                        class_id: 0,
                        sched_day: 0,
                        status: 1
                    };
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
    }, mounted: function () {
        this.getBranchesList();
        this.getClassesList();
    },
})