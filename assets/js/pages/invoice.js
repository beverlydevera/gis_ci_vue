// Vue.use(VueTables.ClientTable);
var invoice = new Vue({
    el: '#invoice_page',
    data: {
        invoicelist: [],
    },
    methods: {
        getInvoiceList(){
            var urls = window.App.baseUrl + "invoice/getInvoiceList";
            showloading("Loading Data");
            axios.post(urls, "")
                .then(function (e) {
                    swal.close();
                    invoice.invoicelist = e.data.data.invoicelist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
    }, mounted: function () {
        this.getInvoiceList();
    },
})