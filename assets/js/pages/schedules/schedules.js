// Vue.use(VueTables.ClientTable);
var sched = new Vue({
    el: '#schedules_page',
    data: {
        branch_id: 1,
        headerlist: ["TIME","MONDAY","TUESDAY","WEDNESDAY","THURSDAY","FRIDAY","SATURDAY","SUNDAY"],
        datalist: [
            {
                time: "9:00 - 9:30",
                timedata: [{
                    id: 1,
                    day: "Monday",
                    rowspan: 3,
                    name: "Staff Meeting and Training",
                    rowclass: "fill-gray stroke-text",
                    type: "not-clickable"
                },{
                    id: 3,
                    day: "Tuesday",
                    rowspan: 3,
                    name: "Open Mats",
                    rowclass: "fill-gray stroke-text",
                    type: "not-clickable"
                },{
                    id: 2,
                    day: "Wednesday",
                    rowspan: 6,
                    name: "Open Mats",
                    rowclass: "fill-gray stroke-text",
                    type: "not-clickable"
                },{
                    id: 3,
                    day: "Thursday",
                    rowspan: 3,
                    name: "Open Mats",
                    rowclass: "fill-gray stroke-text",
                    type: "not-clickable"
                },{
                    id: 4,
                    day: "Friday",
                    rowspan: 6,
                    name: "Open Mats",
                    rowclass: "fill-gray stroke-text",
                    type: "not-clickable"
                },{
                    id: 5,
                    day: "Saturday",
                    rowspan: 3,
                    name: "White Belts All Ages",
                    rowclass: "fill-gray",
                    textclass: "stroke-text",
                    href: "#",
                    type: "clickable",
                },{
                    id: 6,
                    day: "Sunday",
                    rowspan: 22,
                    name: "Gym Closed",
                    rowclass: "fill-dark-gray stroke-text",
                    type: "not-clickable"
                }]
            },{
                time: "9:30 - 10:00",
                timedata: []
            },{
                time: "10:00 - 10:30",
                timedata: []
            },{
                time: "10:30 - 11:00",
                timedata: [{
                    id: 1,
                    rowspan: 3,
                    name: "Open Mats",
                    rowclass: "fill-gray stroke-text",
                    type: "not-clickable",
                },{
                    id: 2,
                    rowspan: 3,
                    name: "All Levels Regular Class",
                    rowclass: "fill-light-orange",
                    textclass: "stroke-text",
                    href: "#",
                    type: "clickable",
                }]
            }
        ]
    },
    methods: {
        getScheduleTable(){
            var datas = {
                "branch_id": 1
            };
            var urls = window.App.baseUrl + "Schedules/getScheduleTable";
            axios.post(urls, datas)
                .then(function (e) {
                    sched.datalist = e.data.data.schedlist;
                    sched.datalist.forEach((e,index) => {
                        sched.datalist[index].timedata = JSON.parse(e.timedata);
                    });
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
    }, mounted: function () {
        this.getScheduleTable();
    },
})