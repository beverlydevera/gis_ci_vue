// Vue.use(VueTables.ClientTable);
var students = new Vue({
    el: '#students_page',
    data: {
        studentslist: {},
    },
    methods: {
        getStudents(){
            var urls = window.App.baseUrl + "students/getStudents";
            showloading("Loading Data");
            axios.post(urls, "")
                .then(function (e) {
                    Swal.close();
                    students.studentslist = e.data.data.studentslist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
    }, mounted: function () {
        this.getStudents();
    },
})