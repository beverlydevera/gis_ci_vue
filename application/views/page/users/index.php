<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users List</h3>
                    </div>
                    <div class="card-body">
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
                                        <span v-if="list.role==0" class="badge bg-success">SYSTEM ADMIN</span>
                                        <span v-else-if="list.role==1" class="badge bg-info">CASHIER</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></i></button>
                                        <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-archive"></i></i></button>
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