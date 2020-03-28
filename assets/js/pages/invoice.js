// Vue.use(VueTables.ClientTable);
var invoice = new Vue({
    el: '#invoice_page',
    data: {
        branch_id:$('#branch_id').val(),
        invoicelist: [],
        invoicedetails: {
            details: {
                amount: 0,
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
        },
        filterdetails: {
            searchInput: "",
            invstatus: 0,
            branch_id: 0,
        },
        brancheslist: [],
    },
    methods: {
        getBranchesList(){
            var urls = window.App.baseUrl + "Libraries/getBranches";
            axios.post(urls, "")
                .then(function (e) {
                    invoice.brancheslist=e.data.data.brancheslist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getInvoiceList(){
            var datas = "";
            if(this.branch_id>0){
                datas = {"condition":"si.branch_id="+this.branch_id}
            }
            var urls = window.App.baseUrl + "invoice/getInvoiceList";
            showloading("Loading Data");
            axios.post(urls, datas)
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
        addPaymentModalshow(){
            $('#viewPaymentsModal').modal('hide');
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
        },
        searchInvoice(action){
            var datas = "";
            if(action=='filter'){
                if(this.filterdetails.searchInput!=""){
                    datas = { "condition": "invoice_number LIKE '%"+this.filterdetails.searchInput+"%' OR reference_id LIKE '%"+this.filterdetails.searchInput+"%' OR lastname LIKE '%"+this.filterdetails.searchInput+"%' OR firstname LIKE '%"+this.filterdetails.searchInput+"%'" }
                }
                if(this.filterdetails.invstatus!=0){
                    if(datas!=""){
                        datas = { "condition":"(invoice_number LIKE '%"+this.filterdetails.searchInput+"%' OR reference_id LIKE '%"+this.filterdetails.searchInput+"%' OR lastname LIKE '%"+this.filterdetails.searchInput+"%' OR firstname LIKE '%"+this.filterdetails.searchInput+"%') AND si.status='"+this.filterdetails.invstatus+"'" }
                    }else{
                        datas = {"condition":"si.status='"+this.filterdetails.invstatus+"'"}
                    }
                }
                if(this.filterdetails.branch_id!=0){
                    if(datas!=""){
                        if(this.filterdetails.invstatus!=0){
                            datas = { "condition":"(invoice_number LIKE '%"+this.filterdetails.searchInput+"%' OR reference_id LIKE '%"+this.filterdetails.searchInput+"%' OR lastname LIKE '%"+this.filterdetails.searchInput+"%' OR firstname LIKE '%"+this.filterdetails.searchInput+"%') AND si.status='"+this.filterdetails.invstatus+"' AND si.branch_id='"+this.filterdetails.branch_id+"'"}
                        }else{
                            datas = { "condition":"(invoice_number LIKE '%"+this.filterdetails.searchInput+"%' OR reference_id LIKE '%"+this.filterdetails.searchInput+"%' OR lastname LIKE '%"+this.filterdetails.searchInput+"%' OR firstname LIKE '%"+this.filterdetails.searchInput+"%') AND si.branch_id='"+this.filterdetails.branch_id+"'" }
                        }
                    }else{
                        datas = {"condition":"si.branch_id='"+this.filterdetails.branch_id+"'"}
                    }
                }
            }else{
                this.filterdetails = {
                    searchInput: "",
                    invstatus: 0,
                    branch_id: 0,
                };
            }

            var urls = window.App.baseUrl + "invoice/getInvoiceList";
            axios.post(urls, datas)
                .then(function (e) {
                    if(e.data.data.invoicelist!=null){
                        invoice.invoicelist = e.data.data.invoicelist;
                    }else{ invoice.invoicelist = []; }
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
    }, mounted: function () {
        this.getInvoiceList();
        this.getBranchesList();
    },
})