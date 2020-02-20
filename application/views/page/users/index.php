<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users List</h3>
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
                        </div>
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Contact Number</th>
                                    <th>Email Address</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody v-for="(list,index) in userslist">
                                <tr>
                                    <td>{{index+1}}</td>
                                    <td>{{list.username}}</td>
                                    <td>{{list.lastname}}</td>
                                    <td>{{list.firstname}}</td>
                                    <td>{{list.middlename}}</td>
                                    <td>{{list.contactno}}</td>
                                    <td>{{list.emailadd}}</td>
                                    <td>
                                        <span v-if="list.role==1" class="badge bg-success">SYSTEM ADMIN</span>
                                        <template v-else-if="list.role==2">
                                            <span class="badge bg-info">CASHIER</span><br>
                                            Branch: {{list.branch_name}}
                                        </template>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-xs" @click="editUserDetails(index)"><i class="fas fa-edit"></i></i></button>
                                        <button type="button" class="btn btn-warning btn-xs" @click="resetPassword(list.user_id)"><i class="fas fa-lock-open"></i></i></button>
                                        <button type="button" class="btn btn-danger btn-xs" @click="archiveAccount(list.user_id)"><i class="fas fa-archive"></i></i></button>
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

<div class="modal fade" id="editUserDetailsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th colspan=2>
                                <img id="editUserImage" style="display:block; margin:auto; width:40%;" v-bind:src="'data:image/jpeg;base64,'+userdetails.photo"/>
                            </th>
                        </tr>
                        <tr>
                            <th colspan=2>
                                <input type="file" accept="image/*" ref="userdetailsimage" @change="editUserImageSelect">
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Username:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="userdetails.username" readonly></th>
                        </tr>
                        <tr>
                            <th width="25%">Last Name:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="userdetails.lastname" required placeholder="Last Name"></th>
                        </tr>
                        <tr>
                            <th width="25%">First Name:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="userdetails.firstname" placeholder="First Name"></th>
                        </tr>
                        <tr>
                            <th width="25%">Middle Name:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="userdetails.middlename" required placeholder="Middle Name"></th>
                        </tr>
                        <tr>
                            <th width="25%">Contact Number:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="userdetails.contactno" required></th>
                        </tr>
                        <tr>
                            <th width="25%">Email Address:</th>
                            <th><input type="email" class="form-control smallerinput" v-model="userdetails.emailadd" required></th>
                        </tr>
                        <tr>
                            <th width="25%">Role:</th>
                            <th>
                                <select class="form-control select2 smallerinput" v-model="userdetails.role" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                    <option selected disabled></option>
                                    <option :value="1">System Admin</option>
                                    <option :value="2">Cashier</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Branch:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="userdetails.branch_name" required></th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" @click="saveUserDetailChanges()">Save Changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>