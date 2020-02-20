// Vue.use(VueTables.ClientTable);
var announcements = new Vue({
    el: '#announcements_page',
    data: {
        file: {
            title: "",
            text: "",
            photo: ""
        },
        announcementslist: []
    },
    methods: {
        saveNewAnnouncement: function(){

            this.file.photo = this.$refs.file.files[0];

            let formData = new FormData();
            formData.append('title', this.file.title);
            formData.append('text', this.file.text);
            formData.append('file', this.file.photo);

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
                    announcements.file = {
                        title: "",
                        text: "",
                        photo: ""
                    };
                    announcements.$refs.file.type = 'text';
                    announcements.$refs.file.type = 'file';
                })

            })
            .catch(function (error) {
                console.log(error);
            });
        },
        getAnnouncements(){
            var urls = window.App.baseUrl + "Announcements/getAnnouncements";
            showloading("Fetching Data from Server");
            axios.post(urls, "")
                .then(function (e) {
                    swal.close();
                    announcements.announcementslist = e.data.data.announcementslist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
    }, mounted: function () {
        this.getAnnouncements();
    },
})