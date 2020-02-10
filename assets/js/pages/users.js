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
        }
    }, mounted: function () {
        this.getUsers();
    },
})