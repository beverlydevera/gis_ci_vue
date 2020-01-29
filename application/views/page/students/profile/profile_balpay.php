

<h5 style="float:right;">
    Account Balance: <u>2,500.00</u>
</h5>
<ul class="nav nav-tabs" id="balpay-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="accounthistory-tab" data-toggle="pill" href="#accounthistory" role="tab" aria-controls="accounthistory" aria-selected="true">Invoice History</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="paymenthistory-tab" data-toggle="pill" href="#paymenthistory" role="tab" aria-controls="paymenthistory" aria-selected="false">Payments History</a>
    </li>
</ul>

<div class="tab-content" id="balpay-tabContent">

    <div class="tab-pane fade active show" id="accounthistory" role="tabpanel" aria-labelledby="accounthistory-tab">
        <br>
        <div class="row">
            <div class="col-md-3">
                <div class="input-group mb-3">
                <div class="input-group-prepend smallerinput">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control smallerinput" placeholder="Search">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-control smallerinput">
                    <option disabled selected>Select Payment Status</option>
                    <option>Paid</option>
                    <option>Unpaid</option>
                </select>
            </div>
            <div class="col-md-1">
                <button class="btn btn-primary btn-xs">Filter</button>
            </div>
        </div>
        <table class="table table-bordered table-responsive-sm table-sm">
            <thead>                  
                <tr>
                    <th>#</th>
                    <th>Invoice No.</th>
                    <th>Invoice Date</th>
                    <th>Invoice Amount</th>
                    <th>Invoice Particulars</th>
                    <th>Paid(OR Number)</th>
                    <th>View Invoice</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>INV000001</td>
                    <td>01/01/2020</td>
                    <td>1,500.00</td>
                    <td style="text-align:left;">
                    • Insurance<br/>
                    • Class Enrollment
                    </td>
                    <td>
                        <span class="badge bg-success">PAID</span><br>
                        <u>(OR000001)</u>
                    </td>
                    <td><button type="button" class="btn btn-primary btn-xs">View Invoice</button></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>INV000002</td>
                    <td>01/02/2020</td>
                    <td>2,500.00</td>
                    <td style="text-align:left;">
                    • Class Enrollment
                    </td>
                    <td>
                        <span class="badge bg-danger">UNPAID</span><br>
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addPaymentModal">Add Payment</button>
                    </td>
                    <td><button type="button" class="btn btn-primary btn-xs">View Invoice</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="tab-pane fade" id="paymenthistory" role="tabpanel" aria-labelledby="paymenthistory-tab">
        <br>
        <div class="row">
            <div class="col-md-3">
                <div class="input-group mb-3">
                <div class="input-group-prepend smallerinput">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control smallerinput" placeholder="Search">
                </div>
            </div>
        </div>
        <table class="table table-bordered table-responsive-sm table-sm">
            <thead>                  
                <tr>
                    <th>#</th>
                    <th>OR No.</th>
                    <th>OR Date</th>
                    <th>OR Amount</th>
                    <th>Invoice No.</th>
                    <!-- <th>View OR</th> -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>OR000001</td>
                    <td>01/01/2020</td>
                    <td>1,500.00</td>
                    <td>INV000001</td>
                    <!-- <td><button type="button" class="btn btn-primary btn-xs">View OR</button></td> -->
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addPaymentModal">
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
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th width="20%">OR Number:</th>
                            <th><input type="text" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="20%">OR Date:</th>
                            <th><input type="text" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="20%">Amount:</th>
                            <th><input type="text" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="20%">Invoice No:</th>
                            <th><input type="text" :readonly="readonly_everything" class="form-control smallerinput" required></th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save payment</button>
            </div>
        </div>
    </div>
</div>