<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h5>Add Payment</h5>
        <hr>
        <table class="table table-bordered table-responsive-sm table-sm billing-table">
            <tr>
                <th width="20%">Name:</th>
                <th>
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentinfo.lastname" required placeholder="Last Name">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentinfo.firstname" required placeholder="First Name">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentinfo.middlename"  placeholder="Middle Name">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentinfo.extname" placeholder="Ext Name">
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th width="20%">Invoice No:</th>
                <th><input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="otherinfo.invoicedetails.studmembership.invoice_number" required></th>
            </tr>
            <tr>
                <th width="20%">OR Number:</th>
                <th><input type="text" class="form-control smallerinput" v-model="paymentdetails.ornumber" required></th>
            </tr>
            <tr>
                <th width="20%">OR Date:</th>
                <th><input type="date" class="form-control smallerinput" v-model="paymentdetails.ordate" required></th>
            </tr>
            <tr>
                <th width="20%">Payment Options:</th>
                <th>
                    <select class="form-control smallerinput" required v-model="paymentdetails.paymentoption" @change="changePaymentOption()">
                        <option disabled selected>Select Payment Options</option>
                        <option value="full">Full Payment</option>
                        <option value="staggered">Staggered Payment</option>
                    </select>
                </th>
            </tr>
            <tr>
                <th width="20%">Amount:</th>
                <th><input type="text" class="form-control smallerinput" v-model="paymentdetails.amount" required></th>
            </tr>
        </table>
        <button type="button" class="btn btn-primary btn-sm" style="float:right;" @click="savePayment()">Save Payment</button>
    </div>
    <div class="col-md-2"></div>
</div>