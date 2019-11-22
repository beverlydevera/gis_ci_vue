Vue.use(VueTables.ClientTable);
var office = new Vue({
    el: '#office',
    data: {
        activenav: '',
        page: {
            title: "",
        },
        form: {
            office_shortname: "",
            office_title: "",
        },
        update_data: {
            office_id: 0,
            office_shortname: "",
            office_title: "",
        },
        delete_data: {
            office_id: 0,
            office_shortname: "",
            office_title: "",
        },
        table: {
            columns: ["office_id", 
                      "office_shortname", 
                      "office_title",  
                      "action",
                      ],
            data: {
                list: []
            },
            options: {
                headings: {
                    office_id: "ID",
                    office_shortname: "Office Short Name",
                    office_title: "Office Title",
                },
                sortable: []
            }
        },
        loading: false,
    }, methods: {
        save: function () {
            this.loading = true;
            var data = frmdata(this.form);
            var urls = window.App.baseUrl + "save-office";
            axios.post(urls, data)
                .then(function (e) {
                    office.resetFields();
                    office.getPageInfo();
                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        getPageInfo: function () {
            this.loading = true;
            var data = frmdata(data);

            var urls = window.App.baseUrl + "get-office";
            axios.post(urls, data)
                .then(function (e) {
                    office.table.data.list = e.data.data;
                    office.loading = false;
                })
                .catch(function (error) {
                    console.log(error)
                });
        }, 

        updateOffice: function(data){
            this.update_data.office_id = data.office_id;
            this.update_data.office_shortname = data.office_shortname;
            this.update_data.office_title = data.office_title;
        },

        deleteOffice: function(data){
            this.delete_data.office_id = data.office_id;
        },

        update_office_form: function () {
            this.loading = true;
            var data = frmdata(this.update_data);
            var urls = window.App.baseUrl + "update-office";
            axios.post(urls, data)
                .then(function (e) {
                    $('#updateOfficeModal').modal('hide')
                    office.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        delete_office_form: function () {
            this.loading = true;
            var data = frmdata(this.delete_data);
            var urls = window.App.baseUrl + "delete-office";
            axios.post(urls, data)
                .then(function (e) {
                    $('#deleteOfficeModal').modal('hide')
                    office.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        resetFields(){
            this.form.office_shortname = "";
            this.form.office_title = "";
        },


    }, computed: {

    }, watch: {

    },
    mounted: function () {
        this.getPageInfo();
    },
})