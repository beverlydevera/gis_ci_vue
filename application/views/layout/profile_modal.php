<div class="modal fade" id="editUserProfileModal">
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
                                <img id="editProfileImage" style="display:block; margin:auto;" v-bind:src="'data:image/jpeg;base64,'+userdata.photo"/>
                            </th>
                        </tr>
                        <tr>
                            <th colspan=2>
                                <input type="file" accept="image/*" ref="userprofileimage" @change="editProfileImageSelect">
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Username:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="userdata.username" readonly></th>
                        </tr>
                        <tr>
                            <th width="25%">Last Name:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="userdata.lastname" required placeholder="Last Name"></th>
                        </tr>
                        <tr>
                            <th width="25%">First Name:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="userdata.firstname" placeholder="First Name"></th>
                        </tr>
                        <tr>
                            <th width="25%">Middle Name:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="userdata.middlename" required placeholder="Middle Name"></th>
                        </tr>
                        <tr>
                            <th width="25%">Contact Number:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="userdata.contactno" required></th>
                        </tr>
                        <tr>
                            <th width="25%">Email Address:</th>
                            <th><input type="email" class="form-control smallerinput" v-model="userdata.emailadd" required></th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" @click="saveUserDataChanges()">Save Changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>