<section class="content">
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
                                <input type="text" class="form-control smallerinput" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control smallerinput">
                                    <option disabled selected>Select Payment Status</option>
                                    <option>Paid</option>
                                    <option>Partial</option>
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
                                    <th>Student Ref No.</th>
                                    <th>Student Name</th>
                                    <th>Status</th>
                                    <th>Payments</th>
                                    <th>Invoice</th>
                                </tr>
                            </thead>
                            <tbody v-for="(list,index) in invoicelist">
                                <tr>
                                    <td>{{index+1}}</td>
                                    <td>{{list.invoice_number}}</td>
                                    <td>{{list.date_added}}</td>
                                    <td>{{list.reference_id}}</td>
                                    <td>{{list.lastname}}, {{list.firstname}}</td>
                                    <td>
                                        <span v-if="list.invstatus=='paid'" class="badge bg-success">PAID</span>
                                        <span v-else-if="list.invstatus=='partial'" class="badge bg-warning">PARTIAL</span>
                                        <span v-else-if="list.invstatus=='unpaid'" class="badge bg-danger">UNPAID</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></button>
                                        <button v-if="list.invstatus!='paid'" type="button" class="btn btn-primary btn-xs"><i class="fas fa-plus"></i></button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></button>
                                        <button type="button" class="btn btn-primary btn-xs"><i class="fas fa-print"></i></button>
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