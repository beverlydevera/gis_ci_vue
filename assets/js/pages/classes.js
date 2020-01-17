var monthlist = [ "", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];

var classsched = new Vue({
    el: '#classes_page',
    data: {
        classschedlist: {},
        classschedsheld: {},
        classschedinfo: {        },
        classStudents: {},
        class_id:$('#class_id').val(),
        selectedStudents: {}
    },
    methods: {
        changeDateFormat(date){
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            month = monthlist[month];
            var returndateformat = month + " " + day + ", " + year;
            return returndateformat;
        },
        getClassScheds(){
            var urls = window.App.baseUrl + "classes/getClassScheds";
            axios.post(urls, "")
                .then(function (e) {
                    classsched.classschedlist=e.data.data;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getclassSchedInfo(){
            // alert();
            var datas = { class_id:this.class_id };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "classes/getclassSchedInfo";
            axios.post(urls, datas)
                .then(function (e) {
                    classsched.classschedinfo=e.data.data.classSchedinfo;
                    classsched.classschedsheld=e.data.data.classScheds;
                    classsched.classStudents=e.data.data.classStudents;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        markAsPresent(){
            alert();
        },
    }, mounted: function () {
        this.getClassScheds();
        if(this.class_id!=0){
            this.getclassSchedInfo();
        }
    },
})