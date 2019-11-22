Vue.use(VueTables.ClientTable);
var position = new Vue({
    el: '#position',
    data: {
        activenav: '',
        page: {
            title: "",
        },
        form: {
            pos_code: "",
            pos_title: "",
            // office_id: 0,
            // div_id: 0,
            // sec_id: 0,
            // unit_id: 0,
        },
        update_data: {
            pos_id: 0,
            pos_code: "",
            pos_title: "",
            // office_id: 0,
            // div_id: 0,
            // sec_id: 0,
            // unit_id: 0,
        },
        delete_data: {
            pos_id: 0,
        },
        table: {
            columns: ["pos_id", 
                      "pos_code", 
                      "pos_title",  
                      "action",
                      ],
            data: {
                list: []
            },
            options: {
                headings: {
                    pos_id: "ID",
                    pos_code: "Position Code",
                    pos_title: "Position Title",
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
            var urls = window.App.baseUrl + "save-position";
            axios.post(urls, data)
                .then(function (e) {
                    position.resetFields();
                    position.getPageInfo();
                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        getPageInfo: function () {
            this.loading = true;
            var data = frmdata(data);

            var urls = window.App.baseUrl + "get-position";
            axios.post(urls, data)
                .then(function (e) {
                    position.table.data.list = e.data.data;
                    // position.sections = e.data.sections;
                    position.loading = false;
                })
                .catch(function (error) {
                    console.log(error)
                });
        }, 

        updatePosition: function(data){
            // this.update_data.sec_id = data.sec_id;
            this.update_data.pos_id = data.pos_id;
            this.update_data.pos_code = data.pos_code;
            this.update_data.pos_title = data.pos_title;
        },

        deletePosition: function(data){
            this.delete_data.pos_id = data.pos_id;
        },

        update_position_form: function () {
            this.loading = true;
            var data = frmdata(this.update_data);
            var urls = window.App.baseUrl + "update-position";
            axios.post(urls, data)
                .then(function (e) {
                    $('#updatePositionModal').modal('hide')
                    position.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        delete_position_form: function () {
            this.loading = true;
            var data = frmdata(this.delete_data);
            var urls = window.App.baseUrl + "delete-position";
            axios.post(urls, data)
                .then(function (e) {
                    $('#deletePositionModal').modal('hide')
                    position.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        resetFields(){
            this.form.pos_code = "";
            this.form.pos_title = "";
            this.form.office_id = 0;
            this.form.div_id = 0;
            this.form.sec_id = 0;
            this.form.unit_id = 0;
        },


    }, computed: {

    }, watch: {

    },
    mounted: function () {
        this.getPageInfo();
    },
})