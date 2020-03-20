var monthlist = [ "", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
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
            photo: "",
            user_id: 1
        },
        newMessage: {
            "message_text": "",
            "date_added": currentdate + " " + currenttime
        }
    },
    methods: {
        format_datetime(date_added){
            var time = "AM";
            var todate = "";
            var d = new Date(date_added),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            var hr = d.getHours();
            var min = d.getMinutes();
            var sec = d.getSeconds();

            hr = hr < 10 ? "0" + hr : hr;
            min = min < 10 ? "0" + min : min;
            sec = sec < 10 ? "0" + sec : sec;

            month1 = month;
            month = month.length < 2 ? "0" + month : month;
            day = day.length < 2 ? "0" + day : day;

            time = hr < 12 ? 'AM' : 'PM';
            hr = hr % 12 || 12

            if(currentdate==[year, month, day].join('-')){
                todate = "Today";
            }else{
                month = monthlist[month1];
                todate = month + " " + day + ", " + year;
            }

            // var returndateformat = month + " " + day + ", " + year + " | " + hr + ":" + min + ":" + sec + " " + time;
            var returndatetimeformat = hr + ":" + min + " " + time + ", " + todate;
            return returndatetimeformat;
        },
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
                    chat.to_userdata.user_id = chat.userlist[0].user_id
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
                    if(chat.chatmessages!=null){
                        chat.chatmessages.forEach((el,index) => {
                            chat.chatmessages[index].proper_datetime = chat.format_datetime(el.date_added);
                        })
                    }
                    if(chat.chatmessagescount!=0 && chat.chatmessagescount<e.data.data.chatmessagescount){
                        var audio = new Audio(window.App.baseUrl + "assets/audio/insight.mp3")
                        audio.play();
                    }
                    chat.chatmessagescount = e.data.data.chatmessagescount;
                    $('#chat_header').css({'display': '',});
                    $('#chat_body').css({'display': '',});
                    $('#chat_footer').css({'display': '',});
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        sendNewMessage(){
            this.newMessage.to_user_id = this.to_userdata.user_id;
            this.newMessage.from_user_id = this.user_id;
            this.newMessage.proper_datetime = this.format_datetime(this.newMessage.date_added);

            // if(chat.chatmessages!=null){ chat.chatmessages.push(chat.newMessage); }
            // else{ chat.chatmessages = [chat.newMessage]; }
            var urls = window.App.baseUrl + "Chat/sendNewMessage";
            axios.post(urls, this.newMessage)
                .then(function (e) {
                    if(e.data.success){
                        chat.newMessage.message_id = e.data.data.message_id;
                        chat.newMessage.date_added = e.data.data.date_added;
                        chat.newMessage.proper_datetime = chat.format_datetime(e.data.data.date_added);
                        if(chat.chatmessages!=null){ chat.chatmessages.push(chat.newMessage); }
                        else{ chat.chatmessages = [chat.newMessage]; }

                        chat.newMessage = { 
                            "message_text": "",
                            "date_added": e.data.data.date_added
                        }
                        chat.chatmessagescount = parseInt(chat.chatmessagescount) + 1;
                    }else{
                        alert(e.data.message);
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
    }, mounted: function () {
        this.getUsersList();
        this.getUserData();
    }, created() {
        this.interval = setInterval(() => this.getChatMessages(this.to_userdata.user_id), 5000);
    },
})