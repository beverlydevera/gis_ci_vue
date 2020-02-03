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
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>INV000001</td>
                                    <td>01/01/2010</td>
                                    <td>2019-F1</td>
                                    <td>DE VERA, BEVERLY MARIELLE JOAN</td>
                                    <td><span class="badge bg-success">PAID</span><br></td>
                                    <td><button type="button" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></button>
                                        <button type="button" class="btn btn-primary btn-xs"><i class="fas fa-print"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>INV000002</td>
                                    <td>01/01/2010</td>
                                    <td>2019-F2</td>
                                    <td>ABC, DEF GHI</td>
                                    <td><span class="badge bg-warning">PARTIAL</span><br></td>
                                    <td><button type="button" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></button></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></button>
                                        <button type="button" class="btn btn-primary btn-xs"><i class="fas fa-print"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>INV000003</td>
                                    <td>01/01/2010</td>
                                    <td>2019-F2</td>
                                    <td>ABC, DEF GHI</td>
                                    <td><span class="badge bg-danger">UNPAID</span><br></td>
                                    <td><button type="button" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></button></td>
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