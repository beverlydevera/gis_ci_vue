Vue.use(VueTables.ClientTable);
var unit = new Vue({
    el: '#unit',
    data: {
        activenav: '',
        page: {
            title: "",
        },
        form: {
            sec_id: 0,
            unit_shortname: "",
            unit_title: "",
        },
        update_data: {
            unit_id: 0,
            sec_id: 0,
            unit_shortname: "",
            unit_title: "",
        },
        delete_data: {
            unit_id: 0,
            sec_id: 0,
            unit_shortname: "",
            unit_title: "",
        },
        table: {
            columns: ["unit_id", 
                      "unit_shortname", 
                      "unit_title",  
                      "sec_shortname", 
                      "action",
                      ],
            data: {
                list: []
            },
            options: {
                headings: {
                    unit_id: "ID",
                    unit_shortname: "Unit Short Name",
                    unit_title: "Unit Title",
                    sec_shortname: "Section",
                },
                sortable: []
            }
        },
        sections: [],
        loading: false,
    }, methods: {
        save: function () {
            this.loading = true;
            var data = frmdata(this.form);
            var urls = window.App.baseUrl + "save-unit";
            axios.post(urls, data)
                .then(function (e) {
                    unit.resetFields();
                    unit.getPageInfo();
                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        getPageInfo: function () {
            this.loading = true;
            var data = frmdata(data);

            var urls = window.App.baseUrl + "get-unit";
            axios.post(urls, data)
                .then(function (e) {
                    unit.table.data.list = e.data.data;
                    unit.sections = e.data.sections;
                    unit.loading = false;
                })
                .catch(function (error) {
                    console.log(error)
                });
        }, 

        updateUnit: function(data){
            this.update_data.unit_id = data.unit_id;
            this.update_data.sec_id = data.sec_id;
            this.update_data.unit_shortname = data.unit_shortname;
            this.update_data.unit_title = data.unit_title;
        },

        deleteUnit: function(data){
            this.delete_data.unit_id = data.unit_id;
        },

        update_unit_form: function () {
            this.loading = true;
            var data = frmdata(this.update_data);
            var urls = window.App.baseUrl + "update-unit";
            axios.post(urls, data)
                .then(function (e) {
                    $('#updateUnitModal').modal('hide')
                    unit.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        delete_unit_form: function () {
            this.loading = true;
            var data = frmdata(this.delete_data);
            var urls = window.App.baseUrl + "delete-unit";
            axios.post(urls, data)
                .then(function (e) {
                    $('#deleteUnitModal').modal('hide')
                    unit.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        resetFields(){
            this.form.sec_id = 0;
            this.form.unit_shortname = "";
            this.form.unit_title = "";
        },


    }, computed: {

    }, watch: {

    },
    mounted: function () {
        this.getPageInfo();
    },
})