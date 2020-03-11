// Vue.use(VueTables.ClientTable);
var preregister = new Vue({
    el: '#preregister_page',
    data: {
        preRegistration_Data: {
            sex: 0,
            branch_id: 0,
            walkintype: "Website",
            status: 1
        },
        brancheslist: []
    },
    methods: {
        getBranchesList(){
            var urls = window.App.baseUrl + "Landing/getBranches";
            axios.post(urls, "")
                .then(function (e) {
                    preregister.brancheslist=e.data.data.brancheslist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
    }, mounted: function () {
        this.getBranchesList();
    },
})