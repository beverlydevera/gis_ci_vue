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
        Account Balance: 2,500.00
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
                    <td>OR000001</td>
                    <td>View Invoice</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>INV000002</td>
                    <td>01/02/2020</td>
                    <td>2,500.00</td>
                    <td style="text-align:left;">
                    • Class Enrollment
                    </td>
                    <td>Not Yet Paid</td>
                    <td>View Invoice</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="tab-pane fade" id="paymenthistory" role="tabpanel" aria-labelledby="paymenthistory-tab">
        <table class="table table-bordered table-responsive-sm table-sm">
            <thead>                  
                <tr>
                    <th>#</th>
                    <th>OR No.</th>
                    <th>OR Date</th>
                    <th>OR Amount</th>
                    <th>Invoice No.</th>
                    <th>View OR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>OR000001</td>
                    <td>01/01/2020</td>
                    <td>1,500.00</td>
                    <td>INV000001</td>
                    <td>View OR</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>