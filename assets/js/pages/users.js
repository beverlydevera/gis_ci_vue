// Vue.use(VueTables.ClientTable);
var users = new Vue({
    el: '#users_page',
    data: {
        userslist: [],
        userdetails: {}
    },
    methods: {
        getUsers(){
            var datas = {
                orderby: {
                    column: "u.lastname",
                    order: "ASC",
                },
                join: {
                    table: "tbl_branches b",
                    key: "b.branch_id=u.branch_id",
                    jointype: "left",
                }
            };
            var urls = window.App.baseUrl + "users/getUsersList";
            axios.post(urls, datas)
                .then(function (e) {
                    users.userslist=e.data.data;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        editUserDetails(index){
            var user_id = this.userslist[index].user_id;
            var datas = {
                condition: {
                    "user_id": user_id
                },
                type: "row",
                join: {
                    table: "tbl_branches b",
                    key: "b.branch_id=u.branch_id",
                    jointype: "left",
                }
            };
            var urls = window.App.baseUrl + "users/getUsersList";
            showloading("Loading Data");
            axios.post(urls, datas)
                .then(function (e) {
                    swal.close();
                    users.userdetails=e.data.data;
                    $('#editUserDetailsModal').modal('show');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        saveUserDetailChanges(){
            var datas = {
                userdetails: this.userdetails
            };
            var urls = window.App.baseUrl + "users/saveUserDetails";
            showloading();
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    Swal.fire({
                        type: e.data.type,
                        title: e.data.message
                    }).then(function (e) {
                        $('#editUserDetailsModal').modal('hide');
                        users.getUsers();
                    })
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        resetPassword(user_id){
            Swal.fire({
                title: "Password Reset",
                input: 'password',
                inputPlaceholder: 'Enter new password',
                inputAttributes: {
                    maxlength: 15,
                    autocapitalize: 'off',
                    autocorrect: 'off'
                },
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: "Are you sure you want to reset user password?",
                        // text: "You won't be able to undo this.",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, reset and proceed',
                        }).then((e) => {
                            if(e.value){
                                var datas = {
                                    user_id: user_id,
                                    password: result.value
                                };
                                var urls = window.App.baseUrl + "users/resetUserPassword";
                                showloading();
                                axios.post(urls, datas)
                                    .then(function (e) {
                                        Swal.close();
                                        Toast.fire({
                                            type: e.data.type,
                                            title: e.data.message
                                        })
                                    })
                                    .catch(function (error) {
                                        console.log(error)
                                    });
                            }
                        })
                }
            })
        },
        archiveAccount(user_id){

        },
    }, mounted: function () {
        this.getUsers();
    },
})