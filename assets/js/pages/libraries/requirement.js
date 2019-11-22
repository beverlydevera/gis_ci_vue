Vue.use(VueTables.ClientTable);
var requirement = new Vue({
    el: '#requirement',
    data: {
        activenav: '',
        page: {
            title: "",
        },
        form: {
            req_shortname: "",
            req_title: "",
            type: 0,
        },
        update_data: {
            req_id: 0,
            req_shortname: "",
            req_title: "",
            type: 0,
        },
        delete_data: {
            req_id: 0,
        },
        table: {
            columns: ["req_id", 
                      "req_shortname", 
                      "req_title",  
                      "type",  
                      "action",
                      ],
            data: {
                list: []
            },
            options: {
                headings: {
                    req_id: "ID",
                    req_shortname: "Requirement Short Name",
                    req_title: "Requirement Title",
                    type: "Type",
                },
                sortable: []
            }
        },
        type_title: ["", "Education", "Experience", "Training", "Eligibility"],
        loading: false,
    }, methods: {
        save: function () {
            this.loading = true;
            var data = frmdata(this.form);
            var urls = window.App.baseUrl + "save-requirement";
            axios.post(urls, data)
                .then(function (e) {
                    requirement.resetFields();
                    requirement.getPageInfo();
                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        getPageInfo: function () {
            this.loading = true;
            var data = frmdata(data);

            var urls = window.App.baseUrl + "get-requirement";
            axios.post(urls, data)
                .then(function (e) {
                    requirement.table.data.list = e.data.data;
                    requirement.loading = false;
                })
                .catch(function (error) {
                    console.log(error)
                });
        }, 

        updateRequirement: function(data){
            this.update_data.req_id = data.req_id;
            this.update_data.req_shortname = data.req_shortname;
            this.update_data.req_title = data.req_title;
            this.update_data.type = data.type;
        },

        deleteRequirement: function(data){
            this.delete_data.req_id = data.req_id;
        },

        update_requirement_form: function () {
            this.loading = true;
            var data = frmdata(this.update_data);
            var urls = window.App.baseUrl + "update-requirement";
            axios.post(urls, data)
                .then(function (e) {
                    $('#updateRequirementModal').modal('hide')
                    requirement.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        delete_requirement_form: function () {
            this.loading = true;
            var data = frmdata(this.delete_data);
            var urls = window.App.baseUrl + "delete-requirement";
            axios.post(urls, data)
                .then(function (e) {
                    $('#deleteRequirementModal').modal('hide')
                    requirement.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        resetFields(){
            this.form.req_shortname = "";
            this.form.req_title = "";
            this.form.type = 0;
        },


    }, computed: {

    }, watch: {

    },
    mounted: function () {
        this.getPageInfo();
    },
})