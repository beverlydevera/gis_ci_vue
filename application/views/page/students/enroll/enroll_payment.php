<div class="row">
    <div class="col-md-12">
        <h5>Add Payment</h5>
        <hr>
        <table class="table table-bordered table-responsive-sm table-sm billing-table">
            <tr>
                <th width="15%">OR Number:</th>
                <th><input type="text" class="form-control smallerinput" v-model="studentrefid" required></th>
            </tr>
            <tr>
                <th width="15%">OR Date:</th>
                <th><input type="text" class="form-control smallerinput" v-model="studentrefid" required></th>
            </tr>
            <tr>
                <th width="15%">Amount:</th>
                <th><input type="text" class="form-control smallerinput" v-model="studentrefid" required></th>
            </tr>
            <tr>
                <th width="15%">Invoice No:</th>
                <th><input type="text" :readonly="readonly_everything" class="form-control smallerinput" v-model="studentrefid" required></th>
            </tr>
        </table>
        <button type="button" class="btn btn-primary btn-sm" style="float:right;">Save Payment</button>
    </div>
</div>