Vue.use(VueTables.ClientTable);
var add_jp = new Vue({
    el: '#add_job_position',
    data: {
        page: {
            title: "",
        },
        form: {
            jp_vacancy: 1,
            item_number: [],
            emp_status: 0,
            office_id: 0,
            div_id: 0,
            sec_id: 0,
            unit_id: 0,
            fund_source_id: [],
            area_assignment_id: [],
            office_id: 0,
            sg_id: 0,
            pos_id: 0,
            req_edu_id: 0,
            req_exp_id: 0,
            req_tra_id: 0,
            req_eli_id: 0,
            req_others: "",
            vice: "",
            description: "",
            salary: "",
            rp_type: [],
            rp_start_date: [],
            rp_end_date: [],
            rp_remarks: [],
        },
        table: {
            columns: ["pos_name", 
                      "jp_sg_id", 
                      "jp_salary",  
                      "des_name", 
                      "jp_job_type",
                      "jp_fill", 
                      "action", 
                      ],
            data: {
                list: []
            },
            options: {
                headings: {
                    pos_name: "Position",
                    jp_sg_id: "SG",
                    jp_salary: "Monthly Salary",
                    des_name: "Designation",
                    jp_job_type: "Job Type",
                    jp_fill: "Status",
                    action: "Action",
                },
                sortable: []
            }
        },
        options: {
            fund_source: [],
            area_assignment: [],
            office: [],
            div: [],
            section: [],
            unit: [],
            position: [],
            sg: [],
            quali_edu: [],
            quali_exp: [],
            quali_tra: [],
            quali_eli: [],
        },
        rps: [],
        loading: false,
    }, methods: {
        save: function () {
            this.loading = true;
            var urls = window.App.baseUrl + "save-job-position";
            axios.post(urls, this.form)
                .then(function (e) {
                    console.log(e)
                    if(e.data.success){
                        window.location.href = window.App.baseUrl + "job-position";
                    }

                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getPageInfo: function () {
            this.loading = true;

            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "get-jp-options";
            axios.post(urls, datas)
                .then(function (e) {
                    add_jp.options.fund_source = e.data.divisions;
                    add_jp.options.area_assignment = e.data.divisions;
                    add_jp.options.office = e.data.offices;
                    add_jp.options.div = e.data.divisions;
                    add_jp.options.section = e.data.sections;
                    add_jp.options.unit = e.data.units;
                    add_jp.options.position = e.data.positions;
                    add_jp.options.sg = e.data.salary_grades;
                    add_jp.options.quali_edu = e.data.req_edu;
                    add_jp.options.quali_exp = e.data.req_exp;
                    add_jp.options.quali_tra = e.data.req_tra;
                    add_jp.options.quali_eli = e.data.req_eli;
                    add_jp.loading = false;

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        getRequirements: function(sg_id, type = 1){
            console.log(sg_id)
            console.log(type)
            let element = this.quali;
            switch (type) {
                case 2:
                    element = this.view
                    break;
                case 3:
                    element = this.update_data
                    break;
            }

            if(sg_id != 0){
                let data = this.options.sg[sg_id];
                element.edu = data.edu_name;
                element.tra = data.tra_name;
                element.exp = data.exp_name;
                element.eli = data.eli_name;
                element.show = true;
            } else{
                element.edu = "";
                element.tra = "";
                element.exp = "";
                element.eli = "";
                element.show = false;
            }
        },

        getSalary: function(sg_id = 0, jp_job_type = "", type = 1){
            console.log(type)

            let element = (type == 1) ? this.form : this.update_data;
            let element2 = (type == 1) ? this.quali : this.update_data;
            if(element.jp_sg_id != 0){
                let data = this.options.sg[element.jp_sg_id];
                if(element.jp_job_type != 'Job Order'){
                    element.jp_salary = data.sg_salary;
                    element2.jp_salary_readonly = true;
                } else {
                    element.jp_salary = data.sg_salary;
                    element2.jp_salary_readonly = false;
                }
            } else {
                element2.jp_salary_readonly = false;
                element.jp_salary = "";
            }
        },

        addRP(){
            this.rps.push({
                rp_type: "",
                rp_start_date: "",
                rp_end_date: "",
                rp_remarks: "",
            });
        },

        removeRP(index){
            this.rps.splice(index,1)
        },

    }, computed: {

    }, watch: {

    },
    mounted: function () {
        this.addRP();
        this.getPageInfo();
    },
})