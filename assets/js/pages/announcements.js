// Vue.use(VueTables.ClientTable);
var announcements = new Vue({
    el: '#announcements_page',
    data: {
        file: {
            title: "",
            text: "",
            photo: ""
        },
    },
    methods: {
        saveNewAnnouncement: function(){

            this.file.photo = this.$refs.file.files[0];

            let formData = new FormData();
            formData.append('title', this.file.title);
            formData.append('text', this.file.text);
            formData.append('file', this.file.photo);

            var urls = window.App.baseUrl + "Announcements/saveNewAnnouncement";
            axios.post(urls, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
            .then(function (e) {
                Swal.fire({
                    type: e.data.type,
                    title: e.data.message
                }).then(function (e) {
                    $('#addNewAnnouncementModal').modal('hide');
                    //push to announcementslist
                })

            })
            .catch(function (error) {
                console.log(error);
            });

        }
    }, mounted: function () {
        // this.getStudents();
    },
})