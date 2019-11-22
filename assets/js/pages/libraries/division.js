Vue.use(VueTables.ClientTable);
var division = new Vue({
    el: '#division',
    data: {
        activenav: '',
        page: {
            title: "",
        },
        form: {
            office_id: 0,
            div_shortname: "",
            div_title: "",
        },
        update_data: {
            div_id: 0,
            office_id: 0,
            div_shortname: "",
            div_title: "",
        },
        delete_data: {
            div_id: 0,
            office_id: 0,
            div_shortname: "",
            div_title: "",
        },
        table: {
            columns: ["div_id", 
                      "div_shortname", 
                      "div_title",  
                      "office_shortname", 
                      "action",
                      ],
            data: {
                list: []
            },
            options: {
                headings: {
                    div_id: "ID",
                    div_shortname: "Division Short Name",
                    div_title: "Division Title",
                    office_shortname: "Office",
                },
                sortable: []
            }
        },
        offices: [],
        loading: false,
    }, methods: {
        save: function () {
            this.loading = true;
            var data = frmdata(this.form);
            var urls = window.App.baseUrl + "save-division";
            axios.post(urls, data)
                .then(function (e) {
                    division.getPageInfo();
                    division.resetFields();
                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        getPageInfo: function () {
            this.loading = true;
            var data = frmdata(data);

            var urls = window.App.baseUrl + "get-division";
            axios.post(urls, data)
                .then(function (e) {
                    division.table.data.list = e.data.data;
                    division.offices = e.data.offices;
                    division.loading = false;
                })
                .catch(function (error) {
                    console.log(error)
                });
        }, 

        updateDivision: function(data){
            this.update_data.div_id = data.div_id;
            this.update_data.office_id = data.office_id;
            this.update_data.div_shortname = data.div_shortname;
            this.update_data.div_title = data.div_title;
        },

        deleteDivision: function(data){
            this.delete_data.div_id = data.div_id;
        },

        update_division_form: function () {
            this.loading = true;
            var data = frmdata(this.update_data);
            var urls = window.App.baseUrl + "update-division";
            axios.post(urls, data)
                .then(function (e) {
                    $('#updateDivisionModal').modal('hide')
                    division.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        delete_division_form: function () {
            this.loading = true;
            var data = frmdata(this.delete_data);
            var urls = window.App.baseUrl + "delete-division";
            axios.post(urls, data)
                .then(function (e) {
                    $('#deleteDivisionModal').modal('hide')
                    division.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        resetFields(){
            this.form.office_id = 0;
            this.form.div_shortname = "";
            this.form.div_title = "";
        },


    }, computed: {

    }, watch: {

    },
    mounted: function () {
        this.getPageInfo();
    },
})