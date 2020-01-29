<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Inventory</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend smallerinput">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control smallerinput" placeholder="Search Inventory">
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-3">
                                <a style="float:right;" data-target="#addNewInventoryItem" data-toggle="modal" class="btn bg-gradient-primary btn-xs">Add New Inventory Item</a>
                            </div>
                        </div>
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead>                  
                                <tr>
                                    <th>#</th>
                                    <th>Item No.</th>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Remaining Stocks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>ITEM-0001</td>
                                    <td>Uniform</td>
                                    <td>Pomsae Uniform</td>
                                    <td>500.00</td>
                                    <td>
                                        <span class="badge bg-success">7 SETS</span>
                                        <span class="badge bg-danger">OUT OF STOCK</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-xs"><i class="fas fa-eye"></i></button>
                                        <button type="button" class="btn btn-success btn-xs"><i class="fas fa-plus"></i></button>
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

<div class="modal fade" id="addNewInventoryItem">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th width="20%">Date:</th>
                            <th>January 30, 2020</th>
                        </tr>
                        <tr>
                            <th width="20%">Item Name:</th>
                            <th><input type="text" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="20%">Description:</th>
                            <th><input type="text" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="20%">Unit Price:</th>
                            <th><input type="text" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="20%">Quantity:</th>
                            <th><input type="number" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="20%">Branch:</th>
                            <th>
                                <select class="form-control smallerinput">
                                    <option disabled selected>Select Branch</option>
                                    <option>Sample 1</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th width="20%">Supplier:</th>
                            <th><input type="text" class="form-control smallerinput"></th>
                        </tr>
                        <tr>
                            <th width="20%">Remarks:</th>
                            <th><textarea class="form-control" rows=2></textarea></th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Item</button>
            </div>
        </div>
    </div>
</div>