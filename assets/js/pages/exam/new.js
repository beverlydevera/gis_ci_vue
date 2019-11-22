Vue.use(VueTables.ClientTable);
var newexam = new Vue({
    el: '#newexam',
    data: {
        jpid: $('#jp_id').val(),
        job_details: {
            count: "0",
            data: {
                jpid: "",
                title: "",
            }
        },
        form: {
            jpid: $('#jp_id').val(),
            type: "",
            question: "",
            answer: [{
                text: "",
                correct: false,
            }],
            essay_score: 0
        },
        question: {
            count: 0,
            data: [{
                question: "",
                type: "",
                jpid: this.jpid,
                answer: [{
                    title: "",
                    answer: false,
                }]
            }]
        },
        errormessage: "",
        settings: {
            ex_timer: 0,
            ex_pass_score: 0,
            ex_instruction: ""
        },
        total_points: 0,
    }, methods: {

        newanswer(type = "", index = "") {
            if (type == "edit") {
                this.question.data[index].answer.push({
                    text: "",
                    correct: false,
                });
            } else {
                this.form.answer.push({
                    text: "",
                    correct: false,
                });
            }

        },
        saveQuestion(exid = 0) {
            this.form.exid = exid;
            var datas = this.form;
            var urls = window.App.baseUrl + "examination/saveQuestion";
            axios.post(urls, datas)
                .then(function (e) {
                    newexam.getNewIndex();
                    newexam.form = {
                        jpid: $('#jp_id').val(),
                        type: "",
                        question: "",
                        answer: [{
                            text: "",
                            correct: false,
                        }]
                    };
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        fixPassing() {
            // if (this.passing_score > this.total_points || this.passing_score <= -1) {
            //     this.passing_score = this.total_points;
            // }
        },
        saveExamSettings() {

            var datas = {
                jp_id: this.jpid,
                passing_score: this.settings.ex_pass_score,
                instruction: this.settings.ex_instruction,
                timer: this.settings.ex_timer,
            };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "examination/saveExamSettings";
            // console.log(datas)
            axios.post(urls, datas)
                .then(function (e) {
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getNewIndex() {
            var datas = {
                jpid: this.jpid,
            };
            var datas = frmdata(datas);
            var urls = window.App.baseUrl + "examination/getNewPage";
            // console.log(datas)
            axios.post(urls, datas)
                .then(function (e) {
                    newexam.job_details = e.data.job;
                    newexam.question = e.data.question;
                    newexam.total_points = e.data.total_points;
                    newexam.settings = e.data.settings;
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
    }, computed: {
        instruction_previw() {
            if (this.settings.ex_instruction.length) {
                var instruction = this.settings.ex_instruction;
                instruction = instruction.replace("_TIMER_", this.settings.ex_timer);
                instruction = instruction.replace("_PASSINGSCORE_", this.settings.ex_pass_score);
                instruction = instruction.replace("_EXAMPOINTS_", this.total_points);
                return instruction;
            }

        },
        btndisabledsave() {
            var count_correct = 0
            this.form.answer.forEach(e => {
                if (e.correct && e.text != "") {
                    count_correct++;
                }
                if (e.text == "") {
                    count_correct = 0;
                }
            });
            if (this.form.type == "multiplechoice") {
                if (this.question != "" && count_correct >= 1) {
                    return false;
                }
            } else {
                if (this.form.essay_score >= 1) {
                    return false
                }
            }
            return true;

        },
    }, watch: {

    },
    mounted: function () {
        this.getNewIndex();
    },
})