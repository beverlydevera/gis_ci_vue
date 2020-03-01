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
                                <a style="float:right;" data-target="#addNewWalkinClientModal" data-toggle="modal" class="btn bg-gradient-primary btn-xs">Add New Walk-in Client</a>
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
                            <tbody v-for="(list,index) in walkinslist">
                                <tr>
                                    <td>{{index+1}}</td>
                                    <td>{{list.lastname}}, {{list.firstname}} {{list.middlename}}</td>
                                    <td>{{list.sex}}</td>
                                    <td>{{list.branch_name}}</td>
                                    <td>{{list.walkintype}}</td>
                                    <td>{{list.wdate_added}}</td>
                                    <td>
                                        <span v-if="list.wstatus==1" class="badge bg-warning">PENDING</span>
                                        <span v-else-if="list.wstatus==2" class="badge bg-success">ACTIVE</span>
                                        <span v-else-if="list.wstatus==3" class="badge bg-danger">INACTIVE</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-xs" data-target="#editNewWalkinClientModal" data-toggle="modal" @click="editNewWalkinClient(list.walkin_id)"><i class="fas fa-edit"></i></button>
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

<div class="modal fade" id="addNewWalkinClientModal">
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
                                    <div class="col-md-6">
                                        <input type="text" v-model="newWalkinInfo.branchname" class="form-control smallerinput" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" v-model="newWalkinInfo.walkintype" class="form-control smallerinput" readonly>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Last Name:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="newWalkinInfo.lastname" required placeholder="Last Name"></th>
                        </tr>
                        <tr>
                            <th width="25%">First Name:</th>
                            <th>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control smallerinput" v-model="newWalkinInfo.firstname" placeholder="First Name">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control smallerinput" v-model="newWalkinInfo.extname" placeholder="Ext Name">
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Middle Name:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="newWalkinInfo.middlename" required placeholder="Middle Name"></th>
                        </tr>
                        <tr>
                            <th width="25%">Birthday:</th>
                            <th>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control datepicker smallerinput" v-model="newWalkinInfo.birthdate" @change="calculate_age()" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control smallerinput" v-model="newWalkinInfo.age" disabled placeholder="Age">
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Sex:</th>
                            <th>
                                <select class="form-control select2 smallerinput" v-model="newWalkinInfo.sex" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                    <option selected disabled></option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Home Address:</th>
                            <th>
                                <textarea class="form-control" v-model="newWalkinInfo.homeaddress" rows=2></textarea>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Contact Number:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="newWalkinInfo.contactno" required></th>
                        </tr>
                        <tr>
                            <th width="25%">Email Address:</th>
                            <th><input type="email" class="form-control smallerinput" v-model="newWalkinInfo.emailaddress" required></th>
                        </tr>
                        <tr>
                            <th width="25%">Upload Photo:</th>
                            <th><input type="file" accept=".jpg,.png,.jpeg"></th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" @click="savenewWalkin()">Save Walk-in</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editNewWalkinClientModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Walk-in Client Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th width="25%">Date Added:</th>
                            <th><input type="date" v-model="walkindetails.date_added" class="form-control smallerinput" readonly></th>
                        </tr>
                        <tr>
                            <th width="25%">Branch:</th>
                            <th>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" v-model="walkindetails.branch_name" class="form-control smallerinput" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" v-model="walkindetails.walkintype" class="form-control smallerinput" readonly>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Last Name:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="walkindetails.lastname" required placeholder="Last Name"></th>
                        </tr>
                        <tr>
                            <th width="25%">First Name:</th>
                            <th>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control smallerinput" v-model="walkindetails.firstname" placeholder="First Name">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control smallerinput" v-model="walkindetails.extname" placeholder="Ext Name">
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Middle Name:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="walkindetails.middlename" required placeholder="Middle Name"></th>
                        </tr>
                        <tr>
                            <th width="25%">Birthday:</th>
                            <th>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control datepicker smallerinput" v-model="walkindetails.birthdate" @change="calculate_age()" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control smallerinput" v-model="walkindetails.age" disabled placeholder="Age">
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Sex:</th>
                            <th>
                                <select class="form-control select2 smallerinput" v-model="walkindetails.sex" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                    <option selected disabled></option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Home Address:</th>
                            <th>
                                <textarea class="form-control" v-model="walkindetails.homeaddress" rows=2></textarea>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Contact Number:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="walkindetails.contactno" required></th>
                        </tr>
                        <tr>
                            <th width="25%">Email Address:</th>
                            <th><input type="email" class="form-control smallerinput" v-model="walkindetails.emailaddress" required></th>
                        </tr>
                        <tr>
                            <th width="25%">Upload Photo:</th>
                            <th><input type="file" accept=".jpg,.png,.jpeg"></th>
                        </tr>
                        <tr>
                            <th width="25%">Status:</th>
                            <th>
                                <select class="form-control select2 smallerinput" v-model="walkindetails.wstatus" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                    <option selected disabled></option>
                                    <option :value="1">Pending</option>
                                    <option :value="2">Active</option>
                                    <option :value="3">Inactive</option>
                                </select>
                            </th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" @click="saveWalkinChanges()">Save Changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>