// Vue.use(VueTables.ClientTable);
var currentdate = formatDate(new Date());
var currenttime = formatTime(new Date());

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

function formatTime(date) {
    var d = new Date(date);
    var hr = d.getHours();
    var min = d.getMinutes();
    var sec = d.getSeconds();

    if (hr < 10)
        hr = "0" + hr;
    if (min < 10)
        min = "0" + min;
    if (sec < 10)
        sec = "0" + sec;

    return [hr, min, sec].join(':');
}

var invoice = new Vue({
    el: '#invoice_page',
    data: {
        invoicelist: [],
        invoicedetails: {
            details: {
                paymentstotal: 0
            },
            paymentslist: [],
        },
        paymentdetails: {
            invoice_id: "",
            student_id: "",
            ornumber: "",
            paymentdate: currentdate,
            ordate: currentdate,
            paymentoption: "full",
            amount: 0,
        }
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
        viewPaymentsModal(index){
            this.paymentdetails = {
                invoice_id: "",
                student_id: "",
                ornumber: "",
                paymentdate: currentdate,
                ordate: currentdate,
                paymentoption: "full",
                amount: 0,
            }
            var invoice_id = this.invoicelist[index].invoice_id;
            var datas = {
                "invoice_id": invoice_id
            };
            var urls = window.App.baseUrl + "invoice/viewPayments";
            axios.post(urls, datas)
                .then(function (e) {
                    invoice.invoicedetails.paymentslist = e.data.data.paymentslist;
                    invoice.addPaymentModal(invoice_id);
                    $('#viewPaymentsModal').modal('show');
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        addPaymentModalshow(invoice_id){
            if(invoice_id>0){ this.addPaymentModal(invoice_id); }
            else{ $('#viewPaymentsModal').modal('hide'); }
            $('#addPaymentsModal').modal('show');
        },
        addPaymentModal(invoice_id){
            this.paymentdetails = {
                invoice_id: "",
                student_id: "",
                ornumber: "",
                paymentdate: currentdate,
                ordate: currentdate,
                paymentoption: "full",
                amount: 0,
            }
            var datas = {
                "invoice_id": invoice_id,
            };
            var urls = window.App.baseUrl + "invoice/getInvoiceDetails";
            showloading("Loading Data");
            axios.post(urls, datas)
                .then(function (e) {
                    invoice.invoicedetails.details = e.data.data.invoicedetails;
                    invoice.invoicedetails.details.paymentstotal = e.data.data.paymentstotal;

                    invoice.paymentdetails.invoice_id = e.data.data.invoicedetails.invoice_id;
                    invoice.paymentdetails.amountmax = invoice.invoicedetails.details.amount - invoice.invoicedetails.details.paymentstotal;
                    invoice.paymentdetails.amount = invoice.invoicedetails.details.amount - invoice.invoicedetails.details.paymentstotal;
                    Swal.close();
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        amountchange(){
            if(this.paymentdetails.amount == this.invoicedetails.details.amount - this.invoicedetails.details.paymentstotal){
                this.paymentdetails.paymentoption = "full";
                this.paymentdetails.amount = this.invoicedetails.details.amount - this.invoicedetails.details.paymentstotal;
            }else{
                this.paymentdetails.paymentoption = "staggered";
            }
        },
        changePaymentOption(){
            if(this.paymentdetails.paymentoption=="full"){
                this.paymentdetails.amount = invoice.paymentdetails.amountmax;
            }else if(this.paymentdetails.paymentoption=="staggered"){
                this.paymentdetails.amount = "";
            }
        },
        savePayment(){
            if(this.invoicedetails.details.amount==(parseInt(this.invoicedetails.details.paymentstotal)+parseInt(this.paymentdetails.amount))){
                var invstat = "paid";
            }else{ var invstat = "partial"; }
            
            this.paymentdetails.student_id = this.invoicedetails.details.student_id;
            this.paymentdetails.ordate += " " + currenttime;
            var datas = {
                "paymentdetails": this.paymentdetails,
                "invoicestatus": invstat
            };
            var urls = window.App.baseUrl + "invoice/savePayment";
            showloading();
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    Swal.fire({
                        type: e.data.type,
                        title: e.data.message
                    }).then(function (e) {
                        invoice.getInvoiceList();
                        $('#addPaymentsModal').modal('hide');
                    })
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        printInvoice(invoice_id){
            var urls = window.App.baseUrl + "Invoice/printInvoice/"+invoice_id;
            window.open(urls, "_blank");
        }
    }, mounted: function () {
        this.getInvoiceList();
    },
})