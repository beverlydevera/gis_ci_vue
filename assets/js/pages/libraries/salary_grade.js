Vue.use(VueTables.ClientTable);
var sg = new Vue({
    el: '#sg',
    data: {
        activenav: '',
        page: {
            title: "",
        },
        form: {
            sg: "",
            sg_salary: "",
            sg_step_inc: "",
            sg_step_amount: "",
        },
        update_data: {
            sg_id: 0,
            sg: "",
            sg_salary: "",
            sg_step_inc: 0,
            sg_step_amount: "",
        },
        delete_data: {
            sg_id: 0,
        },
        table: {
            columns: ["sg_id", 
                      "sg", 
                      "sg_salary", 
                      "sg_step_inc",  
                      "sg_step_amount",  
                      "action",
                      ],
            data: {
                list: []
            },
            options: {
                headings: {
                    sg_id: "ID",
                    sg: "Salary Grade",
                    sg_salary: "Monthly Salary",
                    sg_step_inc: "Step Increment",
                    sg_step_amount: "Step Amount",
                },
                sortable: []
            }
        },
        loading: false,
    }, methods: {
        save: function () {
            this.loading = true;
            var data = frmdata(this.form);
            var urls = window.App.baseUrl + "save-sg";
            axios.post(urls, data)
                .then(function (e) {
                    sg.resetFields();
                    sg.getPageInfo();
                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        getPageInfo: function () {
            this.loading = true;
            var data = frmdata(data);

            var urls = window.App.baseUrl + "get-sg";
            axios.post(urls, data)
                .then(function (e) {
                    sg.table.data.list = e.data.data;
                    sg.loading = false;
                })
                .catch(function (error) {
                    console.log(error)
                });
        }, 

        updateSG: function(data){
            this.update_data.sg_id = data.sg_id;
            this.update_data.sg = data.sg;
            this.update_data.sg_salary = data.sg_salary;
            this.update_data.sg_step_inc = data.sg_step_inc;
            this.update_data.sg_step_amount = data.sg_step_amount;
        },

        deleteSG: function(data){
            this.delete_data.sg_id = data.sg_id;
        },

        update_sg_form: function () {
            this.loading = true;
            var data = frmdata(this.update_data);
            var urls = window.App.baseUrl + "update-sg";
            axios.post(urls, data)
                .then(function (e) {
                    $('#updateSGModal').modal('hide')
                    sg.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        delete_sg_form: function () {
            this.loading = true;
            var data = frmdata(this.delete_data);
            var urls = window.App.baseUrl + "delete-sg";
            axios.post(urls, data)
                .then(function (e) {
                    $('#deleteSGModal').modal('hide')
                    sg.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        resetFields(){
            this.sg = "";
            this.sg_salary = "";
            this.sg_step_inc = 0;
            this.sg_step_amount = "";
        },


    }, computed: {

    }, watch: {

    },
    mounted: function () {
        this.getPageInfo();
    },
})