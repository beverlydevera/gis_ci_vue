Vue.use(VueTables.ClientTable);
var test = new Vue({
    el: '#test',
    data: {
        jpid: $('#jp_id').val(),
        exam: {
            count: {
                multi: 0,
                essay: 0,
            }
        },
        essay: [],
        answer_essay: "",
        essaydata: [],
        ecount: 0,
        cnd: {
            days: "",
            hours: 00,
            minutes: 00,
            seconds: 00,
        },
        exam_start: false,
    }, methods: {
        startExam() {
            var datas = {
                "jp_id": this.jpid,
            }
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "examination/startExamination";
            axios.post(urls, datas)
                .then(function (e) {
                    test.exam_start = true;
                    var time = e.data.time;
                    test.starttimer(time)
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        starttimer(time) {
            const second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24;
            let countDown = new Date(time).getTime(),
                x = setInterval(function () {
                    let now = new Date().getTime(),
                        distance = countDown - now;
                    test.cnd.days = Math.floor(distance / (day));
                    test.cnd.hours = Math.floor((distance % (day)) / (hour));
                    test.cnd.minutes = Math.floor((distance % (hour)) / (minute));
                    test.cnd.seconds = Math.floor((distance % (minute)) / second);
                    if (test.cnd.minutes == 4 && test.cnd.seconds == 59) {
                        Toast.fire({
                            type: 'warning',
                            title: 'You only have 5 minutes left.'
                        })
                    }
                    //do something later when date is reached
                    if (distance < 0) {
                        clearInterval(x);
                        console.log("TIMESUP BOYYY")
                        test.cnd.hours = 00;
                        test.cnd.minutes = 00;
                        test.cnd.seconds = 00;
                    }

                }, second)
        },
        getExamination() {
            var datas = {
                jpid: this.jpid,
            }
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "examination/getExamination";
            axios.post(urls, datas)
                .then(function (e) {
                    test.exam = e.data;
                    test.exam.question_essay.forEach(e => {
                        test.essay.push({ ex_id: e.question.ex_id, answer: e.answer });
                    });

                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        applicantAnswer(ex_id, exan_id, type) {
            console.log(ex_id);
            console.log(exan_id);

            var datas = {
                ex_id: ex_id,
                exan_id: exan_id,
                type: type,
                excode: this.exam.excode,
            }

            if (type == "essay") {
                this.essay.push({ "ex_id": ex_id, "answer": this.answer_essay })
            }
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "examination/saveApplicantAnswer";
            axios.post(urls, datas)
                .then(function (e) {

                })
                .catch(function (error) {
                    console.log(error)
                });

        }

    }, computed: {

    }, watch: {

    },
    mounted: function () {
        this.getExamination();
        // this.countdown();
    },
})