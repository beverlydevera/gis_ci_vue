<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Walk-in / Pre-Registered</h3>
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
                            <div class="col-md-6"></div>
                            <div class="col-md-3">
                                <a style="float:right;" data-target="#addNewWalkinClient" data-toggle="modal" class="btn bg-gradient-primary btn-xs">Add New Walk-in Client</a>
                            </div>
                        </div>
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead>                  
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Names (Lastname, Firstname, Middlename)</th>
                                    <th>Sex</th>
                                    <th>Branch</th>
                                    <th>Registration Type</th>
                                    <th>Registration Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>ABC DEF GHI</td>
                                    <td>F</td>
                                    <td>Abanao</td>
                                    <td>Walk-in / Website</td>
                                    <td>January 20, 2020</td>
                                    <td>
                                        <span class="badge bg-success">ACTIVE</span>
                                        <span class="badge bg-warning">PENDING</span>
                                        <span class="badge bg-danger">INACTIVE</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-xs"><i class="fas fa-edit"></i></button>
                                        <!-- <span class="badge badge-success">POSTED</span> -->
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

<div class="modal fade" id="addNewWalkinClient">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Walk-in Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th width="25%">Date:</th>
                            <th>January 30, 2020</th>
                        </tr>
                        <tr>
                            <th width="25%">Branch:</th>
                            <th>
                                <div class="row">
                                    <div class="col-md-6"><input type="text" value="Abanao" class="form-control smallerinput" readonly></div>
                                    <div class="col-md-6"><input type="text" value="Walk-in" class="form-control smallerinput" readonly></div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Last Name:</th>
                            <th><input type="text" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="25%">First Name:</th>
                            <th><input type="text" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="25%">Middle Name:</th>
                            <th><input type="text" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="25%">Birthday:</th>
                            <th>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control datepicker smallerinput" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control smallerinput" disabled>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Sex:</th>
                            <th>
                                <select class="form-control select2 smallerinput" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                    <option selected disabled></option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Home Address:</th>
                            <th>
                                <textarea class="form-control" rows=2></textarea>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Contact Number:</th>
                            <th><input type="text" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="25%">Email Address:</th>
                            <th><input type="email" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="25%">Upload Photo:</th>
                            <th><input type="file"></th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>