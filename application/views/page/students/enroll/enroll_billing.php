<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h5>Date: <?=date(" F d, Y")?>
            <a href="" class="btn btn-primary btn-sm" style="float:right; color:#fff;">Print Invoice</a>
        </h5>
        <hr>
        <h5>Billing Summary</h5>
        <table class="table table-bordered table-responsive-sm table-sm billing-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td class="billing-desc">Membership Fee (<?=date("Y")?>)</td>
                    <td>500.00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="billing-desc">Insurance Fee (<?=date("Y")?>)</td>
                    <td>1,000.00</td>
                </tr>
                <tr>
                    <th class="billing-desc" colspan="5">Class Fees</th>
                </tr>
                <tr>
                    <td>3</td>
                    <td class="billing-desc">
                        All Levels Regular Class <br>
                        Sessions: 8 <br>
                        Payment Option: Full Payment
                    </td>
                    <td>500.00</td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    <th>2,000.00</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="col-md-2"></div>
</div>