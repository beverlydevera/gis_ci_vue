// Vue.use(VueTables.ClientTable);
var users = new Vue({
    el: '#users_page',
    data: {
        userslist: {},
    },
    methods: {
        getUsers(){
            var datas = {
                // join: {
                //     table: "tbl_branches b",
                //     key: "b.branch_id=u.branch_id",
                //     jointype: "inner",
                // },
                orderby: {
                    column: "u.lastname",
                    order: "ASC",
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
    }, mounted: function () {
        this.getUsers();
    },
})