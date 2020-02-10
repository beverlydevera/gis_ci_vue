// Vue.use(VueTables.ClientTable);
var walkin = new Vue({
    el: '#walkin_page',
    data: {
        walkinslist: {},
        newWalkinInfo: {
            lastname: "",
            firstname: "",
            middlename: "",
            extname: "",
            birthdate: "",
            age: "",
            sex: "",
            homeaddress: "",
            contactno: "",
            emailaddress: "",
            branch_id: 1,
            branchname: "Abanao",
            walkintype: "Walk-in",
            status: 1
        },
        walkindetails: {}
    },
    methods: {
        calculate_age() {
            var dob = this.newWalkinInfo.birthdate;
            var dob = dob.split("-");
            var dob = new Date(dob[0], dob[1], dob[2]);
            var diff_ms = Date.now() - dob.getTime();
            var age_dt = new Date(diff_ms);
            this.newWalkinInfo.age = Math.abs(age_dt.getUTCFullYear() - 1970);
        },
        savenewWalkin(){
            var datas = { 
                newWalkinInfo: this.newWalkinInfo };
            var urls = window.App.baseUrl + "Walkin/savenewWalkin";
            showloading();
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    Swal.fire({
                        type: e.data.type,
                        title: e.data.message
                    }).then(function (e) {
                        $('#addNewWalkinClientModal').modal('hide');
                        walkin.getWalkins();
                    })
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getWalkins(){
            var datas = {
                join: {
                    table: "tbl_branches b",
                    key: "b.branch_id=w.branch_id",
                    jointype: "inner",
                },
                orderby: {
                    column: "w.date_added",
                    order: "DESC",
                }
            };
            var urls = window.App.baseUrl + "walkin/getWalkins";
            showloading("Loading Data");
            axios.post(urls, datas)
                .then(function (e) {
                    swal.close();
                    walkin.walkinslist=e.data.data;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        editNewWalkinClient(walkin_id){
            var datas = {
                join: {
                    table: "tbl_branches b",
                    key: "b.branch_id=w.branch_id",
                    jointype: "inner",
                },
                condition: {
                    walkin_id: walkin_id
                },
                type: "row"
            };
            var urls = window.App.baseUrl + "walkin/getWalkins";
            showloading("Loading Data");
            axios.post(urls, datas)
                .then(function (e) {
                    swal.close();
                    walkin.walkindetails = e.data.data;
                    walkin.walkindetails.date_added = formatDate(walkin.walkindetails.date_added);
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        saveWalkinChanges(){
            var datas = { 
                walkindetails: this.walkindetails };
            var urls = window.App.baseUrl + "Walkin/saveWalkinChanges";
            showloading();
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    Swal.fire({
                        type: e.data.type,
                        title: e.data.message
                    }).then(function (e) {
                        $('#editNewWalkinClientModal').modal('hide');
                        walkin.getWalkins();
                    })
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
    }, mounted: function () {
        this.getWalkins();
    },
})