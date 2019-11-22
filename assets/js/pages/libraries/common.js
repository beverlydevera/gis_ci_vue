Vue.use(VueTables.ClientTable);
var comp = new Vue({
    el: '#lib_common',
    data: {
        activenav: '',
        page: {
            title: "",
        },
        form: {
            new: {
                name: "",
                status: 0,
            }
        },
        table: {
            columns: [],
            data: {
                list: []
            },
            options: {
                headings: {
                    cd_name: "Name",
                    cd_status: "Status",
                    div_name: "Name",
                    div_status: "Status",
                    sec_name: "Name",
                    sec_status: "Status",
                    pos_name: "Name",
                    pos_status: "Status",
                    des_name: "Name",
                    des_status: "Status",
                    edu_name: "Name",
                    edu_status: "Status",
                    tra_name: "Name",
                    tra_status: "Status",
                    exp_name: "Name",
                    exp_status: "Status",
                    eli_name: "Name",
                    eli_status: "Status",
                },
                sortable: []
            }
        },
        loading: false,
    }, methods: {
        save: function () {
            this.loading = true;
            var datas = frmdata(this.form.new);
            var urls = window.App.baseUrl + "lib/auth/insert/" + $('#comtype').val();;
            // console.log(datas)
            axios.post(urls, datas)
                .then(function (e) {
                    comp.getPageInfo();

                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        getPageInfo: function () {
            this.loading = true;
            var datas = frmdata(datas);
            nav.activenav = $('#comtype').val();
            var urls = window.App.baseUrl + "/lib/api/get/" + $('#comtype').val() + "/1";
            // console.log(datas)
            axios.post(urls, datas)
                .then(function (e) {
                    comp.table.data = e.data.data.data
                    comp.table.columns = [e.data.prefix + "name", e.data.prefix + "status"];
                    var name = e.data.prefix + "name";
                    var status = e.data.prefix + "status";
                    comp.table.options.headings[name] = "Name";
                    comp.table.options.headings[status] = "Status";
                    comp.loading = false;


                })
                .catch(function (error) {
                    console.log(error)
                });
        }

    }, computed: {

    }, watch: {

    },
    mounted: function () {
        this.getPageInfo();
    },
})