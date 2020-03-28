// Vue.use(VueTables.ClientTable);
var announcements = new Vue({
    el: '#announcements_page',
    data: {
        newAnnouncement: {
            title: "",
            text: "",
            photo: ""
        },
        announcementslist: [],
        announcementdetails: {
            photo: null
        },
        disabled_edit: false,
        searchInput: "",
    },
    methods: {
        newimageSelect(event){
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#newselectedImage')
                        .attr('src', e.target.result)
                        .width("100%");
                        // .height(200);
                };

                reader.readAsDataURL(event.target.files[0]);
            }
        },
        editimageSelect(event){
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#editselectedImage')
                        .attr('src', e.target.result)
                        .width("100%");
                        // .height(200);
                };

                reader.readAsDataURL(event.target.files[0]);
            }
        },
        saveNewAnnouncement: function(){

            this.newAnnouncement.photo = this.$refs.filenew.files[0];

            let formData = new FormData();
            formData.append('title', this.newAnnouncement.title);
            formData.append('text', this.newAnnouncement.text);
            formData.append('file', this.newAnnouncement.photo);

            var urls = window.App.baseUrl + "Announcements/saveNewAnnouncement";
            showloading();
            axios.post(urls, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
            .then(function (e) {
                Swal.close();
                Swal.fire({
                    type: e.data.type,
                    title: e.data.message
                }).then(function (e) {
                    $('#addNewAnnouncementModal').modal('hide');
                    announcements.getAnnouncements();
                    announcements.newAnnouncement = {
                        title: "",
                        text: "",
                        photo: ""
                    };
                    announcements.$refs.filenew.type = 'text';
                    announcements.$refs.filenew.type = 'file';
                })

            })
            .catch(function (error) {
                console.log(error);
            });
        },
        getAnnouncements(){
            var datas = {
                "select"    : "announcement_id,title,status,date_added"
            }
            var urls = window.App.baseUrl + "Announcements/getAnnouncements";
            showloading("Fetching Data from Server");
            axios.post(urls, datas)
                .then(function (e) {
                    swal.close();
                    announcements.announcementslist = e.data.data.announcementslist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        viewAnnouncementDetails(announcement_id){
            var datas = {
                "select"    : "announcement_id,title,text,photos,status,date_added",
                "condition" : { announcement_id: announcement_id },
                "type"      : "row"
            }
            var urls = window.App.baseUrl + "Announcements/getAnnouncements";
            showloading("Fetching Data from Server");
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    announcements.announcementdetails = e.data.data.announcementslist;
                    announcements.$refs.fileedit.files[0] = e.data.data.announcementslist.photos;
                    if(announcements.announcementdetails.status==1){ announcements.disabled_edit=true; }
                    $('#editAnnouncementModal').modal('show');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        saveAnnouncementChanges(){
            
            this.announcementdetails.photo = this.$refs.fileedit.files[0];

            let formData = new FormData();
            formData.append('announcement_id', this.announcementdetails.announcement_id);
            formData.append('title', this.announcementdetails.title);
            formData.append('text', this.announcementdetails.text);
            formData.append('file', this.announcementdetails.photo);

            var urls = window.App.baseUrl + "Announcements/saveAnnouncementChanges";
            showloading();
            axios.post(urls, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
            .then(function (e) {
                Swal.close();
                Swal.fire({
                    type: e.data.type,
                    title: e.data.message
                }).then(function (e) {
                    $('#editAnnouncementModal').modal('hide');
                    announcements.getAnnouncements();
                    announcements.announcementdetails = {
                        title: "",
                        text: "",
                        photo: ""
                    };
                    announcements.$refs.fileedit.type = 'text';
                    announcements.$refs.fileedit.type = 'file';
                })

            })
            .catch(function (error) {
                console.log(error);
            });
        },
        postAnnouncement(index){
            Swal.fire({
                title: "Are you sure you want to post announcement to website?",
                text: "You won't be able to undo this (and changes will be locked).",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Post Announcement',
                }).then((result) => {
                    if (result.value) {
                        var datas = {
                            announcement_id: this.announcementslist[index].announcement_id,
                        };
                        var urls = window.App.baseUrl + "Announcements/postAnnouncement";
                        showloading();
                        axios.post(urls, datas)
                            .then(function (e) {
                                Swal.close();
                                Toast.fire({
                                    type: e.data.type,
                                    title: e.data.message
                                })
                                announcements.announcementslist[index].status = 1;
                            })
                            .catch(function (error) {
                                console.log(error)
                            }); 
                    }else{
                        Toast.fire({
                            type: "error",
                            title: "Cancelled Posting of Announcement."
                        })
                    }
            })
        },
        searchAnnouncement(){
            if(this.searchInput!=""){
                var datas = {
                    "select"    : "announcement_id,title,status,date_added",
                    "condition" : "title LIKE '%"+this.searchInput+"%'"
                };
            }else{
                var datas = {
                    "select"    : "announcement_id,title,status,date_added"
                };
            }
                var urls = window.App.baseUrl + "Announcements/getAnnouncements";
                axios.post(urls, datas)
                    .then(function (e) {
                        if(e.data!=null){
                            announcements.announcementslist = e.data.data.announcementslist;
                        }
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
        },
    }, mounted: function () {
        this.getAnnouncements();
    },
})