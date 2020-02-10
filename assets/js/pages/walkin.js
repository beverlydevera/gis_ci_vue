// Vue.use(VueTables.ClientTable);
var walkin = new Vue({
    el: '#walkin_page',
    data: {
        // studentslist: {},
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
            status: 1,
            // date_added: ""
        }
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
                    // action
                    Swal.close();
                    Toast.fire({
                        type: e.data.type,
                        title: e.data.message
                    })
                    // walkin.getWalkins();
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
        // getStudents(){
        //     var urls = window.App.baseUrl + "students/getStudents";
        //     axios.post(urls, "")
        //         .then(function (e) {
        //             // console.log(e);
        //             students.studentslist=e.data.data;
        //         })
        //         .catch(function (error) {
        //             console.log(error)
        //         });
        // },
    }, mounted: function () {
        // this.getStudents();
    },
})