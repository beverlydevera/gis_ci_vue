Vue.use(VueTables.ServerTable);
var membership = "";
var students = new Vue({
    el: '#students_page',
    data: {
        table: {
            column: [
                'reference_id',
                "fullname",
                "sex",
                "birthdate",
                "age",
                "membership_type",
                "rank_title",
                "branch_name",
                "status",
                "action" ],
            data: [],
            options: {
                headings: {
                    reference_id: 'Student Reference ID',
                    fullname: 'Names (Lastname, Firstname, Middlename)',
                    rank_title: 'Rank/Belt',
                },
                sortable: ['fullname','reference_id'],
                filterable: ['fullname','reference_id']
            }
        },
    },
    methods: {
        getAge(bday) {
            var dob = bday;
            var dob = dob.split("-");
            var dob = new Date(dob[0], dob[1], dob[2])
            var diff_ms = Date.now() - dob.getTime();
            var age_dt = new Date(diff_ms);
            return Math.abs(age_dt.getUTCFullYear() - 1970);
        },
    }, mounted: function () {
        // this.getIndex();
    },
})