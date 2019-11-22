Vue.use(VueTables.ClientTable);
var jp = new Vue({
    el: '#job_position',
    data: {
        page: {
            title: "",
        },
        view: {
            jp_id: 0,
            jp_vacancy: 1,
            pos_title: "",
            item_number: "",
            emp_status: "",
            fund_source: "",
            area_assignment: "",
            vice: "",
            office: "",
            div: "",
            sec: "",
            unit: "",
            sg: "",
            salary: "",
            req_edu: "",
            req_exp: "",
            req_tra: "",
            req_eli: "",
            req_others: "",
            description: "",

            rp_type: [],
            rp_start_date: [],
            rp_end_date: [],
            rp_remarks: [],
            deadline: "",
        },
        update_data: {
            jp_id: 0,
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
            description: "",
            req_others: "",
            vice: "",
            salary: "",
        },
        delete_data: {
            jp_id: 0,
        },
        table: {
            columns: ["item_number", 
                      "pos_title",
                      "sg", 
                      "emp_status", 
                      "div_shortname",  
                      "div_shortname", 
                      "salary", 
                      "action", 
                      ],
            data: {
                list: [],
                div_names: []
            },
            options: {
                headings: {
                    item_number: "Item Number", 
                    pos_title: "Position Title",
                    emp_status: "Employement Status", 
                    div_shortname: "Area of Assignment",  
                    div_shortname: "Source of Fund", 
                    sg: "SG", 
                    salary: "Salary", 
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
        quali: {
            jp_salary_readonly: false,
            show: false,
            edu: "",
            tra: "",
            exp: "",
            eli: "",
        },
        rps: [],
        rps_update: [],
        loading: false,
        ete_rating: {
            jp_id: 0,
            position: "",
            vice: "",
            area: "",
            fund_source: "",
            criteria: {
                1: [{name:'EDUCATION',rating:""}],
                2: [{name:'RELEVANT TRAINING',rating:""}],
                3: [{name:'RELEVANT EXPERIENCE',rating:""}],
            }
        },
        resetCriteria:{
            1: [{name:'EDUCATION',rating:""}],
            2: [{name:'RELEVANT TRAINING',rating:""}],
            3: [{name:'RELEVANT EXPERIENCE',rating:""}],
        },
    }, methods: {
        add_posting: function () {
            this.loading = true;
            var datas = frmdata(this.view);
            var urls = window.App.baseUrl + "add-posting";
            // console.log(datas)
            axios.post(urls, datas)
                .then(function (e) {
                    $('#viewPositionModal').modal('hide')
                    jp.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        update: function () {
            this.loading = true;
            // var datas = frmdata(this.update_data);
            var urls = window.App.baseUrl + "update-job-position";
            var data = {'update_data': this.update_data, 'rps_update': this.rps_update};
            axios.post(urls, data)
                .then(function (e) {
                    $('#updatePositionModal').modal('hide')
                    jp.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        delete_pos: function () {
            this.loading = true;
            var datas = frmdata(this.delete_data);
            var urls = window.App.baseUrl + "delete-job-position";
            // console.log(datas)
            axios.post(urls, datas)
                .then(function (e) {
                    $('#deletePositionModal').modal('hide')
                    jp.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getPageInfo: function () {
            this.loading = true;

            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "get-job-position";
            axios.post(urls, datas)
                .then(function (e) {
                    jp.table.data.list = e.data.data;
                    jp.table.data.div_names = e.data.div_names;
                    jp.rps = e.data.rps;
                    jp.page.title = e.data.title;
                    jp.loading = false;

                    jp.options.fund_source = e.data.options.divisions;
                    jp.options.area_assignment = e.data.options.divisions;
                    jp.options.office = e.data.options.offices;
                    jp.options.div = e.data.options.divisions;
                    jp.options.section = e.data.options.sections;
                    jp.options.unit = e.data.options.units;
                    jp.options.position = e.data.options.positions;
                    jp.options.sg = e.data.options.salary_grades;
                    jp.options.quali_edu = e.data.options.req_edu;
                    jp.options.quali_exp = e.data.options.req_exp;
                    jp.options.quali_tra = e.data.options.req_tra;
                    jp.options.quali_eli = e.data.options.req_eli;

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        viewPosition: function(data){

            this.view.jp_id = data.jp_id;
            this.view.pos_title = data.pos_title;
            this.view.item_number = data.item_number;
            this.view.emp_status = data.emp_status;
            this.view.fund_source = this.table.data.div_names[data.fund_source_id].div_shortname;
            this.view.area_assignment = this.table.data.div_names[data.area_assignment_id].div_shortname;
            this.view.vice = (data.vice == null) ? "N/A" : data.vice;
            this.view.office = data.office_title;
            this.view.div = data.div_title;
            this.view.sec = data.sec_title;
            this.view.unit = data.unit_title;
            this.view.sg = data.sg;
            this.view.salary = data.salary;
            this.view.req_others = data.req_others;
            this.view.description = data.description;

            this.view.req_edu_id = data.req_edu_id;
            this.view.req_exp_id = data.req_exp_id;
            this.view.req_tra_id = data.req_tra_id;
            this.view.req_eli_id = data.req_eli_id;
            this.get_rps(data.jp_id, 1);
            this.get_reqs(data.jp_id, 1);
        },

        editPosition: function(data){
            this.update_data.jp_id = data.jp_id;
            this.update_data.emp_status = data.emp_status;
            this.update_data.office_id = data.office_id;
            this.update_data.div_id = data.div_id;
            this.update_data.sec_id = data.sec_id;
            this.update_data.unit_id = data.unit_id;
            this.update_data.office_id = data.office_id;
            this.update_data.sg_id = data.sg_id;
            this.update_data.pos_id = data.pos_id;
            this.update_data.req_edu_id = data.req_edu_id;
            this.update_data.req_exp_id = data.req_exp_id;
            this.update_data.req_tra_id = data.req_tra_id;
            this.update_data.req_eli_id = data.req_eli_id;
            this.update_data.description = data.description; 
            this.update_data.salary = data.salary; 
            this.update_data.item_number = data.item_number;
            this.update_data.fund_source_id = data.fund_source_id;
            this.update_data.area_assignment_id = data.area_assignment_id;
            this.get_rps(data.jp_id, 2);
        },

        get_rps(jp_id, type){
            var urls = window.App.baseUrl + "get-rps";
            axios.post(urls, {'jp_id': jp_id})
                .then(function (e) {
                    if(type == 1){ // view
                        jp.rps = e.data.rps;
                    } else { // update
                        jp.rps_update = e.data.rps;
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        get_reqs(jp_id, type){
            var urls = window.App.baseUrl + "get-reqs";
            axios.post(urls, {'jp_id': jp_id})
                .then(function (e) {
                    
                    jp.view.req_edu = e.data.reqs.edu;
                    jp.view.req_exp = e.data.reqs.exp;
                    jp.view.req_tra = e.data.reqs.tra;
                    jp.view.req_eli = e.data.reqs.eli;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        addRP(){
            this.rps_update.push({
                rp_type: "",
                rp_start_date: "",
                rp_end_date: "",
                rp_remarks: "",
            });
        },

        removeRP(index){
            this.rps_update.splice(index,1)
        },
        deletePosition: function(data){
            this.delete_data.jp_id = data.jp_id;

        },
        
        viewETE: function(data){
            this.reset_criteria()
            this.ete_rating.jp_id = data.jp_id;
            this.ete_rating.position = data.pos_title;
            this.ete_rating.vice = (data.vice == null) ? "N/A" : data.vice;
            this.ete_rating.area = this.table.data.div_names[data.area_assignment_id].div_title;
            this.ete_rating.fund_source = this.table.data.div_names[data.fund_source_id].div_title;

            var urls = window.App.baseUrl + "get-ete-form";
            axios.post(urls, {'jp_id': this.ete_rating.jp_id})
                .then(function (e) {
                    $.each(e, function(index, value){
                        $.each(value, function(i, v){
                            if(v.type == 1){
                                jp.ete_rating.criteria[v.criteria_type][0]['rating'] = v.rating
                            } else{
                                jp.ete_rating.criteria[v.criteria_type].push({
                                    name:v.criteria,
                                    rating:v.rating
                                })
                            }
                        })
                        
                    })

                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        reset_criteria() {
            jp.ete_rating.criteria = {
                1: [{name:'EDUCATION',rating:""}],
                2: [{name:'RELEVANT TRAINING',rating:""}],
                3: [{name:'RELEVANT EXPERIENCE',rating:""}],
            };
        },
        add_item(type){
            this.ete_rating.criteria[type].push({
                name:"",
                rating:""
            });
        },

        set_highest_rating(type){
            let rating_arr = [];
            $.each(this.ete_rating.criteria[type], function(index, value){
                if(index != 0){
                    rating_arr.push(value.rating)
                }
            })
            this.ete_rating.criteria[type][0]['rating'] = Math.max(...rating_arr);
        },

        add_ete_rating(){
            this.loading = true;
            var urls = window.App.baseUrl + "save-ete-form";
            axios.post(urls, this.ete_rating)
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

        removeETE(index,type){
            this.ete_rating.criteria[type].splice(index,1);
            this.set_highest_rating(type);
        },

        get_exam_url(jp_id){
            return window.App.baseUrl + "examination/new/" + jp_id;
        },

    }, computed: {

    }, watch: {

    },
    mounted: function () {
        this.getPageInfo();
    },
});

