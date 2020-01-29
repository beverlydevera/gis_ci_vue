<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Packages</h3>
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
                                    <option disabled selected>Select Package Type</option>
                                    <option>Regular</option>
                                    <option>Unlimited</option>
                                    <option>Summer Promo</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control smallerinput">
                                    <option disabled selected>Select Year</option>
                                    <option>2020</option>
                                    <option>2019</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-primary btn-xs">Filter</button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addNewPackageModal" style="float:right;">Add a New Package</button>
                            </div>
                        </div>
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Package Type</th>
                                    <th>Details</th>
                                    <th>Price Rate</th>
                                    <th>Year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><span class="badge bg-success">REGULAR</span></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-8" style="border-right:1px solid #000;">
                                            All Levels Regular Class | Tuesday / 11:30 - 12:00
                                            </div>
                                            <div class="col-md-4">8 Sessions</div>
                                        </div>
                                    </td>
                                    <td>2,200.00</td>
                                    <td>2020</td>
                                    <td><button type="button" class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><span class="badge bg-info">UNLIMITED</span></td>
                                    <td>26 days / 1 month</td>
                                    <td>2,200.00</td>
                                    <td>2020</td>
                                    <td><button type="button" class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="badge bg-warning">SUMMER PROMO</span></td>
                                    <td>Package 1 : <button class="btn btn-warning btn-xs">View Details</button></td>
                                    <td>10,500.00</td>
                                    <td>2020</td>
                                    <td><button type="button" class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addNewPackageModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th width="25%">Package Type:</th>
                            <th>
                                <select class="form-control smallerinput" @change="changePackageType()" v-model="newPackage.packagetype">
                                    <option disabled selected>Select Package Type</option>
                                    <option>Regular</option>
                                    <option>Unlimited</option>
                                    <option>Summer Promo</option>
                                </select>
                            </th>
                        </tr>
                        <tr id="regular_package" style="display:none;">
                            <th width="25%">Package Details:</th>
                            <th>
                                <select class="form-control smallerinput">
                                    <option disabled selected>Select Schedule</option>
                                    <option>All Levels Regular Class | Monday / 09:30-10:00</option>
                                    <option>All Levels Regular Class | Monday / 09:30-10:00</option>
                                    <option>All Levels Regular Class | Monday / 09:30-10:00</option>
                                </select>
                                <input type="text" class="form-control smallerinput" placeholder="Input Number of Sessions">
                            </th>
                        </tr>
                        <tr id="unlimited_package" style="display:none;">
                            <th width="25%">Package Details:</th>
                            <th><input type="text" class="form-control smallerinput"></th>
                        </tr>
                        <tr id="summerpromo_package" style="display:none;">
                            <th width="25%">Package Details:</th>
                            <th>
                                <div class="row" v-for="(list,index) in newPackage.packagedetails">
                                    <div class="col-md-6"><input type="text" class="form-control smallerinput" v-model="list.particular" placeholder="Particular"></div>
                                    <div class="col-md-5"><input type="number" class="form-control smallerinput" v-model="list.price" placeholder="Price"></div>
                                    <div class="col-md-1" style="padding:0;">
                                        <button v-if="index==0" type="button" class="btn btn-primary btn-xs" @click="addnewParticular_item()"><i class="fas fa-plus"></i></button>
                                        <button v-if="index>0" type="button" class="btn btn-danger btn-xs" @click="cancelParticular_item(index)"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Price Rate:</th>
                            <th><input type="number" id="pricerate" v-model="newPackage.pricerate" class="form-control smallerinput"></th>
                        </tr>
                        <tr>
                            <th width="25%">Year:</th>
                            <th><input type="text" class="form-control smallerinput"></th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Package</button>
            </div>
        </div>
    </div>
</div>