var classsched = new Vue({
    el: '#classes_page',
    data: {
        classschedlist: [],  
    },
    methods: {
        getClassSchedulesList(){
            var datas = {
                select: "*",
                orderby: {
                    column: "c.class_title",
                    order: "ASC",
                },
                condition: {
                    "s.status": 1
                }
            };
            var urls = window.App.baseUrl + "Classes/getClassSchedulesList";
            axios.post(urls, datas)
                .then(function (e) {
                    classsched.classschedlist=e.data.data.classschedlist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
    }, mounted: function () {
        this.getClassSchedulesList();
    },
})