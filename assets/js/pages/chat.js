var chat = new Vue({
    el: '#chat_page',
    data: {
        user_id:$('#user_id').val(),
        userlist: [],
        chatmessages: [],
        chatmessagescount: 0,
        from_userdata: {
            photo: ""
        },
        to_userdata: {
            photo: ""
        }
    },
    methods: {
        getUsersList(){
            var datas = {
                select: "user_id,username,lastname,firstname,middlename,contactno,emailadd,role,branch_name,photo",
                orderby: {
                    column: "u.lastname",
                    order: "ASC",
                },
                join: {
                    table: "tbl_branches b",
                    key: "b.branch_id=u.branch_id",
                    jointype: "left",
                },
                condition: {
                    "u.status": 1,
                    "user_id!=": this.user_id
                }
            };
            var urls = window.App.baseUrl + "users/getUsersList";
            axios.post(urls, datas)
                .then(function (e) {
                    chat.userlist = e.data.data;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getUserData(){
            var datas = {
                select: "user_id,username,lastname,firstname,middlename,contactno,emailadd,role,branch_name,photo",
                orderby: {
                    column: "u.lastname",
                    order: "ASC",
                },
                join: {
                    table: "tbl_branches b",
                    key: "b.branch_id=u.branch_id",
                    jointype: "left",
                },
                condition: {
                    "u.status" : 1,
                    "user_id=" : this.user_id
                },
                type: "row"
            };
            var urls = window.App.baseUrl + "users/getUsersList";
            axios.post(urls, datas)
                .then(function (e) {
                    chat.from_userdata = e.data.data;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getChatMessages(to_user_id){
            var datas = {
                "to_user_id": to_user_id,
                "from_user_id": this.user_id
            }
            var urls = window.App.baseUrl + "Chat/getChatMessages";
            axios.post(urls, datas)
                .then(function (e) {
                    chat.to_userdata = e.data.data.to_userdata;
                    chat.chatmessages = e.data.data.chatmessages;
                    chat.chatmessagescount = e.data.data.chatmessagescount;
                    $('#chat_header').css({'display': '',});
                    $('#chat_body').css({'display': '',});
                    $('#chat_footer').css({'display': '',});
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
    }, mounted: function () {
        this.getUsersList();
        this.getUserData();
    }, created() {
        if(this.to_userdata!=null){
            this.interval = setInterval(() => this.getChatMessages(this.to_userdata.user_id), 5000);
        }
    },
})