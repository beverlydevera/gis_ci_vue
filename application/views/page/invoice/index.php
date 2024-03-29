<section class="content">
    <input type="hidden" id="branch_id" value="<?=sesdata('branch_id')?>"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Invoice and Payments</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend smallerinput">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control smallerinput" v-model="filterdetails.searchInput" @input="searchInvoice('filter')" placeholder="Search">
                                </div>
                            </div>                            
                            <?php if(sesdata('role')==1){ ?>
                            <div class="col-md-2">
                                <select class="form-control smallerinput" v-model="filterdetails.branch_id" @change="searchInvoice('filter')">
                                    <option value=0 disabled selected>Select Branch</option>
                                    <template v-for="(list,index) in brancheslist">
                                    <option :value=list.branch_id>{{list.branch_name}}</option>
                                    </template>
                                </select>
                            </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <select class="form-control smallerinput" v-model="filterdetails.invstatus" @change="searchInvoice('filter')">
                                    <option value="0" disabled selected>Select Payment Status</option>
                                    <option>Paid</option>
                                    <option>Partial</option>
                                    <option>Unpaid</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-xs" @click="searchInvoice('clearfilter')">Clear Filter</button>
                            </div>
                        </div>
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice No.</th>
                                    <th>Invoice Date</th>
                                    <th>Student Ref No.</th>
                                    <th>Student Name</th>
                                    <?php if(sesdata('role')==1){ ?>
                                    <th>Branch Name</th>
                                    <?php } ?>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody v-for="(list,index) in invoicelist">
                                <tr>
                                    <td>{{index+1}}</td>
                                    <td>{{list.invoice_number}}</td>
                                    <td>{{list.date_added}}</td>
                                    <td>{{list.reference_id}}</td>
                                    <td>{{list.lastname}}, {{list.firstname}}</td>
                                    <?php if(sesdata('role')==1){ ?>
                                    <td>{{list.branch_name}}</td>
                                    <?php } ?>
                                    <td>
                                        <span v-if="list.invstatus=='paid'" class="badge bg-success">PAID</span>
                                        <span v-else-if="list.invstatus=='partial'" class="badge bg-warning">PARTIAL</span>
                                        <span v-else-if="list.invstatus=='unpaid'" class="badge bg-danger">UNPAID</span>
                                    </td>
                                    <td>{{list.amount}}</td>
                                    <td>
                                        <button @click="viewPaymentsModal(index)" type="button" class="btn btn-primary btn-xs">
                                            <i class="fas fa-eye"></i> View Payments
                                        </button>
                                        <button type="button" class="btn btn-primary btn-xs" @click="printInvoice(list.invoice_id)">
                                            <i class="fas fa-print"></i> Print Invoice
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="viewPaymentsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">List of Payments for Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <b>Invoice No:</b> <u>{{invoicedetails.details.invoice_number}}</u><br>
                        <b>Client Name:</b> <u>{{invoicedetails.details.lastname}}, {{invoicedetails.details.firstname}}</u>
                    </div>
                    <div class="col-md-6">
                        <b>Payment Status:</b>
                        <span v-if="invoicedetails.details.invstatus=='paid'" class="badge bg-success">PAID</span>
                        <span v-else-if="invoicedetails.details.invstatus=='partial'" class="badge bg-warning">PARTIAL</span>
                        <span v-else-if="invoicedetails.details.invstatus=='unpaid'" class="badge bg-danger">UNPAID</span> <br>
                        <b>Invoice Amount:</b> <u>{{invoicedetails.details.amount}}</u>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>OR Number</th>
                                <th>OR Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody v-for="(list,index) in invoicedetails.paymentslist">
                            <tr>
                                <td>{{index+1}}</td>
                                <td>{{list.ornumber}}</td>
                                <td>{{list.ordate}}</td>
                                <td>{{list.amount}}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan=3>TOTAL</th>
                                <th>{{invoicedetails.details.paymentstotal}}</th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button v-if="invoicedetails.details.paymentstotal!=invoicedetails.details.amount" type="button" class="btn btn-primary" @click="addPaymentModalshow()"><i class="fas fa-plus"></i> Add a New Payment</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addPaymentsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <b>Invoice No:</b> <u>{{invoicedetails.details.invoice_number}}</u><br>
                        <b>Client Name:</b> <u>{{invoicedetails.details.lastname}}, {{invoicedetails.details.firstname}}</u>
                    </div>
                    <div class="col-md-6">
                        <b>Payment Status:</b>
                        <span v-if="invoicedetails.details.invstatus=='paid'" class="badge bg-success">PAID</span>
                        <span v-else-if="invoicedetails.details.invstatus=='partial'" class="badge bg-warning">PARTIAL</span>
                        <span v-else-if="invoicedetails.details.invstatus=='unpaid'" class="badge bg-danger">UNPAID</span> <br>
                        <b>Invoice Amount:</b> <u>{{invoicedetails.details.amount}}</u><br>
                        <b>Remaining Balance:</b> <u>{{paymentdetails.amountmax}}</u>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-responsive-sm table-sm billing-table">
                            <tr>
                                <th width="30%">OR Number:</th>
                                <th><input type="text" class="form-control smallerinput" required v-model="paymentdetails.ornumber"></th>
                            </tr>
                            <tr>
                                <th width="30%">OR Date:</th>
                                <th><input type="date" class="form-control smallerinput" required v-model="paymentdetails.paymentdate"></th>
                            </tr>
                            <tr>
                                <th width="30%">Payment Options:</th>
                                <th>
                                    <select class="form-control smallerinput" required v-model="paymentdetails.paymentoption" @change="changePaymentOption()">
                                        <option disabled selected>Select Payment Options</option>
                                        <option value="full">Full Payment</option>
                                        <option value="staggered">Staggered Payment</option>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th width="30%">Amount:</th>
                                <th><input type="number" class="form-control smallerinput" required v-model="paymentdetails.amount" v-bind:max="paymentdetails.amountmax" @blur="amountchange()"></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="savePayment()">Save Payment</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>