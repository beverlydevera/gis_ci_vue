<section class="content">
    <input type="hidden" value="<?=$student_id?>" id="student_id">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img id="editStudentImage" @click="inputImage" class="profile-user-img img-fluid img-circle" v-bind:src="'data:image/jpeg;base64,'+studentinfo.photo" alt="User profile picture">
                            <!-- <img v-if="studentinfo.photo!=null" id="editStudentImage" @click="inputImage" class="profile-user-img img-fluid img-circle" v-bind:src="'data:image/jpeg;base64,'+studentinfo.photo" alt="User profile picture">
                            <img v-else class="profile-user-img img-fluid img-circle" @click="inputImage" src="<?= base_url("assets/img/student_avatar.png") ?>" alt="User profile picture"> -->
                            <input type="file" id="studentpicture" accept="image/*" ref="studentimage" @change="editStudentImageSelect" style="display: none;">
                        </div>
                        <h3 class="profile-username text-center">
                            {{studentinfo.firstname}} {{studentinfo.lastname}}
                        </h3>
                        <p class="text-muted text-center"><b>" {{studentinfo.nickname}} "</b></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Student Reference ID No: </b>
                                <a>{{studentinfo.reference_id}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Membership/s:</b>
                                <span class="btn btn-success btn-xs float-right" v-if="studentmembership.year<currentyear" @click="changeMembershipModal(studentmembership.studmem_id)"><i class="fas fa-edit"></i></span><br>
                                <a v-for="(list,index) in derivedinfo.studentmembership">
                                    <span class="badge bg-success">{{list}}</span> <br/>
                                </a>
                                <template v-if="studentmembership.insurance.avail">• With Insurance</template>
                            </li>
                            <li class="list-group-item">
                                <b>Current Rank: </b> <br>
                                <a >{{studentRankInfo.currentRank.rank_title}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Next Promotion: </b> <br>
                                <a>{{studentRankInfo.currentRank.next_rank.ses_needed-studentRankInfo.currentRank.ses_attended}} training sessions</a>
                            </li>
                            <li class="list-group-item">
                                <b>Status: </b> <br>
                                <a><span class="badge bg-success">Active</span></a>
                            </li>
                        </ul>
                        <!-- <a class="btn btn-primary btn-block btn-xs"><b>Change Photo</b></a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#personalinfo" data-toggle="tab">
                                <i class="fas fa-user"></i></i> 
                                Personal Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#classes" data-toggle="tab">
                                <i class="fas fa-calendar-day"></i>    
                                Classes and Attendance
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#competition" data-toggle="tab">
                                <i class="fas fa-medal"></i>
                                Competitions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#promotion" data-toggle="tab">
                                <i class="fas fa-trophy"></i>
                                Promotion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#gallery" data-toggle="tab">
                                <i class="far fa-images"></i>
                                Gallery
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#balancepayments" data-toggle="tab">
                                <i class="far fa-credit-card"></i>
                                Accounts
                            </a>
                        </li>
                    </ul>
                    </div>
                    
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalinfo">
                                <?php include('profile/profile_basicinfo.php');?>
                            </div>
                            <div class="tab-pane" id="classes">
                                <?php include('profile/profile_classes.php');?>
                            </div>
                            <div class="tab-pane" id="competition">
                                <?php include('profile/profile_competition.php');?>
                            </div>
                            <div class="tab-pane" id="promotion">
                                <?php include('profile/profile_promotion.php');?>
                            </div>
                            <div class="tab-pane" id="gallery">
                                <?php include('profile/profile_gallery.php');?>
                            </div>
                            <div class="tab-pane" id="balancepayments">
                                <?php include('profile/profile_balpay.php');?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateMembershipModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Membership</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Year:</h6>
                            <input type="text" v-model="currentyear" class="form-control" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Membership Type:</h6>
                            <input v-model="membership_info.membership_update.membership_type" type="checkbox"> Regular <br>
                            <input v-model="membership_info.membership_update.membership_type" type="checkbox"> BBC <br>
                            <input v-model="membership_info.membership_update.membership_type" type="checkbox"> Pomsae <br>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Insurance:</h6>
                            <select class="form-control smallerinput" required v-model="membership_info.membership_update.insurance.avail">
                                <option disabled selected>Select Insurance</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</section>