var monthlist = [ "", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
var news = new Vue({
    el: '#news',
    data: {
        newsarticles_list: [],
        newsimages_list: []
    },
    methods: {
        changeDateFormat(date){
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();
            month = monthlist[month];
            var returndateformat = month + " " + day + ", " + year;
            return returndateformat;
        },
        getNewsArticles(){
            var datas = {data: "articles"};
            var urls = window.App.baseUrl + "Landing/getNewsAnnouncements";
            var datas = frmdata(datas);
            axios.post(urls, datas)
                .then(function (e) {
                    news.newsarticles_list=e.data.data.newslist;
                    news.newsarticles_list.forEach((e,index) => {
                        news.newsarticles_list[index].date_added = news.changeDateFormat(e.date_added);
                    });
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getNewsImages(){
            var datas = {data: "images"};
            var urls = window.App.baseUrl + "Landing/getNewsAnnouncements";
            var datas = frmdata(datas);
            axios.post(urls, datas)
                .then(function (e) {
                    news.newsimages_list=e.data.data.newslist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
    }, mounted: function () {
        this.getNewsArticles();
        this.getNewsImages();
    },
})