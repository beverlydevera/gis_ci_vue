// Vue.use(VueTables.ClientTable);
var users = new Vue({
    el: '#users_page',
    data: {
        brancheslist: [],
        userslist: [],
        userdetails: {
            photo: null,
            branch_id: 0
        },
        filterdetails: {
            searchInput: "",
            userrole: 0
        }
    },
    methods: {
        getBranchesList(){
            var urls = window.App.baseUrl + "Libraries/getBranches";
            axios.post(urls, "")
                .then(function (e) {
                    users.brancheslist=e.data.data.brancheslist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getUsers(){
            var datas = {
                select: "user_id,username,lastname,firstname,middlename,contactno,emailadd,role,branch_name",
                orderby: {
                    column: "u.lastname",
                    order: "ASC",
                },
                condition: {
                    "u.status": 1
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
                    "user_id": user_id,
                    "u.status": 1
                },
                type: "row"
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
            
            let formData = new FormData();
            formData.append('user_id', this.userdetails.user_id);
            formData.append('lastname', this.userdetails.lastname);
            formData.append('firstname', this.userdetails.firstname);
            formData.append('middlename', this.userdetails.middlename);
            formData.append('contactno', this.userdetails.contactno);
            formData.append('emailadd', this.userdetails.emailadd);
            formData.append('branch_id', this.userdetails.branch_id);
            formData.append('role', this.userdetails.role);
            formData.append('file', this.$refs.userdetailsimage.files[0]);

            var urls = window.App.baseUrl + "Users/saveUserDetails";
            showloading();
            axios.post(urls, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
            .then(function (e) {                
                users.userdetails = {
                    photo: null
                };
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
                console.log(error);
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
            Swal.fire({
                title: "Are you sure you want to archive this user account?",
                // text: "You won't be able to undo this.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, archive account',
                }).then((e) => {
                    if(e.value){
                        var datas = {
                            user_id: user_id
                        };
                        var urls = window.App.baseUrl + "users/archiveUserAccount";
                        showloading();
                        axios.post(urls, datas)
                            .then(function (e) {
                                Swal.close();
                                Toast.fire({
                                    type: e.data.type,
                                    title: e.data.message
                                })
                                users.getUsers();
                            })
                            .catch(function (error) {
                                console.log(error)
                            });
                    }
                })
        },
        editUserImageSelect(event){
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#editUserImage')
                        .attr('src', e.target.result)
                        .width("40%");
                        // .height(200);
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        },
        searchTable(){
            if(this.filterdetails.searchInput!=""){
                var searchinput = this.filterdetails.searchInput;
                var condition = "u.status = 1 AND (username LIKE '%"+searchinput+"%' OR lastname LIKE '%"+searchinput+"%' OR firstname LIKE '%"+searchinput+"%' OR middlename LIKE '%"+searchinput+"%')"
                var datas = {
                    select: "user_id,username,lastname,firstname,middlename,contactno,emailadd,role,branch_name",
                    orderby: {
                        column: "u.lastname",
                        order: "ASC",
                    },
                    condition: condition
                };
            }else{
                var datas = {
                    select: "user_id,username,lastname,firstname,middlename,contactno,emailadd,role,branch_name",
                    orderby: {
                        column: "u.lastname",
                        order: "ASC",
                    },
                    condition: {
                        "u.status": 1
                    }
                };
            }
            var urls = window.App.baseUrl + "users/getUsersList";
            axios.post(urls, datas)
                .then(function (e) {
                    users.userslist=e.data.data;
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
    }, mounted: function () {
        this.getUsers();
        this.getBranchesList();
    },
})