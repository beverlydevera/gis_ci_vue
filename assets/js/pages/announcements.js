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
        announcementdetails: {}
    },
    methods: {
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
                "select"    : "announcement_id,title,date_added"
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
        editAnnouncement(announcement_id){
            var datas = {
                "select"    : "announcement_id,title,text,photos,date_added",
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
                    $('#editAnnouncementModal').modal('show');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        postAnnouncement(announcement_id){

        },
    }, mounted: function () {
        this.getAnnouncements();
    },
})