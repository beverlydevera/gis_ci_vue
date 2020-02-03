<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h5>Add Payment</h5>
        <hr>
        <table class="table table-bordered table-responsive-sm table-sm billing-table">
            <tr>
                <th width="20%">Invoice No:</th>
                <th><input type="text" :readonly="readonly_everything" class="form-control smallerinput" v-model="otherinfo.invoicedetails.studmembership.invoice_number" required></th>
            </tr>
            <tr>
                <th width="20%">OR Number:</th>
                <th><input type="text" class="form-control smallerinput" v-model="paymentdetails.ornumber" required></th>
            </tr>
            <tr>
                <th width="20%">OR Date:</th>
                <th><input type="text" class="form-control smallerinput" v-model="paymentdetails.ordate" required></th>
            </tr>
            <tr>
                <th width="20%">Payment Options:</th>
                <th>
                    <select class="form-control smallerinput" required v-model="paymentdetails.paymentoption">
                        <option disabled selected>Select Payment Options</option>
                        <option>Full Payment</option>
                        <option>Staggered Payment</option>
                    </select>
                </th>
            </tr>
            <tr>
                <th width="20%">Amount:</th>
                <th><input type="text" class="form-control smallerinput" v-model="paymentdetails.amount" required></th>
            </tr>
        </table>
        <button type="button" class="btn btn-primary btn-sm" style="float:right;">Save Payment</button>
    </div>
    <div class="col-md-2"></div>
</div>