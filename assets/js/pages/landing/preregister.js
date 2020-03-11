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
        savePreRegistration(){
            var datas = this.preRegistration_Data;
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "Landing/savePreRegistration";
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.fire({
                        type: e.data.type,
                        title: e.data.title,
                        text: e.data.message
                    })
                    preregister.preRegistration_Data = {
                        sex: 0,
                        branch_id: 0,
                        walkintype: "Website",
                        status: 1
                    };
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
    }, mounted: function () {
        this.getBranchesList();
    },
})