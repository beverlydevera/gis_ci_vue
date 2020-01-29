// Vue.use(VueTables.ClientTable);
var students = new Vue({
    el: '#students_page',
    data: {
        studentslist: {},
    },
    methods: {
        getStudents(){
            var urls = window.App.baseUrl + "students/getStudents";
            axios.post(urls, "")
                .then(function (e) {
                    // console.log(e);
                    students.studentslist=e.data.data;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
    }, mounted: function () {
        this.getStudents();
    },
})