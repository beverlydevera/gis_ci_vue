Vue.use(VueTables.ClientTable);
var section = new Vue({
    el: '#section',
    data: {
        activenav: '',
        page: {
            title: "",
        },
        form: {
            div_id: 0,
            sec_shortname: "",
            sec_title: "",
        },
        update_data: {
            sec_id: 0,
            div_id: 0,
            sec_shortname: "",
            sec_title: "",
        },
        delete_data: {
            sec_id: 0,
            div_id: 0,
            sec_shortname: "",
            sec_title: "",
        },
        table: {
            columns: ["sec_id", 
                      "sec_shortname", 
                      "sec_title",  
                      "div_shortname", 
                      "action",
                      ],
            data: {
                list: []
            },
            options: {
                headings: {
                    sec_id: "ID",
                    sec_shortname: "Section Short Name",
                    sec_title: "Section Title",
                    div_shortname: "Division",
                },
                sortable: []
            }
        },
        divisions: [],
        loading: false,
    }, methods: {
        save: function () {
            this.loading = true;
            var data = frmdata(this.form);
            var urls = window.App.baseUrl + "save-section";
            axios.post(urls, data)
                .then(function (e) {
                    section.resetFields();
                    section.getPageInfo();
                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        getPageInfo: function () {
            this.loading = true;
            var data = frmdata(data);

            var urls = window.App.baseUrl + "get-section";
            axios.post(urls, data)
                .then(function (e) {
                    section.table.data.list = e.data.data;
                    section.divisions = e.data.divisions;
                    section.loading = false;
                })
                .catch(function (error) {
                    console.log(error)
                });
        }, 

        updateSection: function(data){
            this.update_data.sec_id = data.sec_id;
            this.update_data.div_id = data.div_id;
            this.update_data.sec_shortname = data.sec_shortname;
            this.update_data.sec_title = data.sec_title;
        },

        deleteSection: function(data){
            this.delete_data.sec_id = data.sec_id;
        },

        update_section_form: function () {
            this.loading = true;
            var data = frmdata(this.update_data);
            var urls = window.App.baseUrl + "update-section";
            axios.post(urls, data)
                .then(function (e) {
                    $('#updateSectionModal').modal('hide')
                    section.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        delete_section_form: function () {
            this.loading = true;
            var data = frmdata(this.delete_data);
            var urls = window.App.baseUrl + "delete-section";
            axios.post(urls, data)
                .then(function (e) {
                    $('#deleteSectionModal').modal('hide')
                    section.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        resetFields(){
            this.form.div_id = 0;
            this.form.sec_shortname = "";
            this.form.sec_title = "";
        },


    }, computed: {

    }, watch: {

    },
    mounted: function () {
        this.getPageInfo();
    },
})