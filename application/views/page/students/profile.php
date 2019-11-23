<style>
    h6{
        font-weight: bold;
        text-decoration: underline;
    }

    .smallerinput {
        font-size: 10pt !important;
        height: 20pt !important;
        padding: 0 0 0 3%;
        color: blue;
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 0.5rem !important;
    }

    table{
        margin-bottom: 0 !important;
    }

    .requiredspan {
        color: red;
    }
    
    th, td{
        padding: 1% !important;
        /* vertical-align: middle; */
    }

    hr{
        border: 1px dotted #000 !important;
    }
</style>
<section class="content" id="studentprofile_page">
    <form @submit.prevent="updateProfile">
    <input type="hidden" value="<?=$student_id?>" id="student_id">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url("assets/img/student_avatar.png") ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">
                            {{studentinfo.firstname}} {{studentinfo.lastname}}
                        </h3>
                        <p class="text-muted text-center"><b>Student Reference ID: </b> {{studentinfo.reference_id}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Current Class: </b>
                                <a class="float-right">Mighty Cubs Level 2</a>
                            </li>
                            <li class="list-group-item">
                                <b>Current Rank: </b> 
                                <a class="float-right">7th Yellow</a>
                            </li>
                            <li class="list-group-item">
                                <b>Status: </b> 
                                <a class="float-right"><span class="badge bg-success">Active</span></a>
                            </li>
                        </ul>
                    <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-9">
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
                            <a class="nav-link" href="#activity" data-toggle="tab">
                                <i class="fas fa-calendar-day"></i>    
                                Schedules and Classes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#timeline" data-toggle="tab">
                                <i class="fas fa-trophy"></i>
                                Promotion History
                            </a>
                        </li>
                    </ul>
                    </div>
                    
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalinfo">
                                <form class="form-horizontal">
                                    <h6>BASIC INFORMATION</h6>
                                    <div class="form-group row">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="20%"><span class="requiredspan">*</span>Full Name:</th>
                                                <th colspan=3>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control smallerinput" placeholder="Last Name" v-model="studentinfo.lastname" required>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control smallerinput" placeholder="First Name" v-model="studentinfo.firstname" required>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control smallerinput" placeholder="Middle Name" v-model="studentinfo.middlename">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input type="text" class="form-control smallerinput" placeholder="Ext Name" v-model="studentinfo.extname">
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="20%"><span class="requiredspan">*</span>Sex:</th>
                                                <th>
                                                    <select class="form-control select2 smallerinput" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true" v-model="studentinfo.sex">
                                                        <option selected disabled></option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    </select>
                                                </th>
                                                <th width="20%"><span class="requiredspan">*</span>Citizenship:</th>
                                                <th><input type="text" class="form-control smallerinput" v-model="studentinfo.citizenship" required></th>
                                            </tr>
                                            <tr>
                                                <th width="20%"><span class="requiredspan">*</span>Date of Birth:</th>
                                                <th>
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <input type="date" class="form-control datepicker smallerinput" v-model="studentinfo.birthdate" @change="calculate_age()" required>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="number" class="form-control smallerinput" v-model="derivedinfo.studentage" disabled>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th width="20%"><span class="requiredspan">*</span>Place of Birth:</th>
                                                <th><input type="text" class="form-control smallerinput" v-model="studentinfo.birthplace" required></th>
                                            </tr>
                                            <tr>
                                                <th width="20%"><span class="requiredspan">*</span>Home Address:</th>
                                                <th colspan=3>
                                                    <input type="text" class="form-control smallerinput" v-model="studentinfo.address" required>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="20%"><span class="requiredspan">*</span>Mobile Number:</th>
                                                <th><input type="text" class="form-control smallerinput" placeholder="(09)xx-xxxx-xxx" v-model="studentinfo.mobileno" required></th>
                                                <th width="20%">Telephone Number</th>
                                                <th><input type="text" class="form-control smallerinput" placeholder="(09)xx-xxxx-xxx" v-model="studentinfo.telephoneno"></th>
                                            </tr>
                                            <tr>
                                                <th width="20%"><span class="requiredspan">*</span>Email Address:</th>
                                                <th colspan=3><input type="email" class="form-control smallerinput" placeholder="abc@email.com" v-model="studentinfo.emailadd" required></th>
                                            </tr>
                                            <tr>
                                                <th width="20%"><span class="requiredspan">*</span>Height (m):</th>
                                                <th><input type="number" class="form-control smallerinput" v-model="studentinfo.height" required></th>
                                                <th width="20%"><span class="requiredspan">*</span>Weight (kg):</th>
                                                <th><input type="number" class="form-control smallerinput" v-model="studentinfo.weight" required></th>
                                            </tr>
                                            <tr>
                                                <th width="20%"><span class="requiredspan">*</span>Insurance:</th>
                                                <th>
                                                    <div class="row">
                                                        <div class="col-sm-2"></div>
                                                        <div class="col-sm-3">
                                                            <input type="radio" class="form-check-input" :value="1" v-model="studentinfo.insurance" required>
                                                            <label class="form-check-label" for="">Yes</label>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <input type="radio" class="form-check-input" :value="0" v-model="studentinfo.insurance" required>
                                                            <label class="form-check-label" for="">No</label>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th width="20%">Religion:</th>
                                                <th><input type="text" class="form-control smallerinput" v-model="studentinfo.religion"></th>
                                            </tr>
                                        </table>
                                    </div>
                                    <hr/>
                                    <h6>PARENTS / GUARDIAN INFORMATION</h6>
                                    <div class="form-group row">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="20%"></th>
                                                <th width="20%"><span class="requiredspan">*</span>Father</th>
                                                <th width="20%"><span class="requiredspan">*</span>Mother</th>
                                                <th width="20%">Guardian</th>
                                            </tr>
                                            <tr>
                                                <th width="20%"><span class="requiredspan">*</span>Name:</th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.father_name" required></th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.mother_name" required></th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.guardian_name"></th>
                                            </tr>
                                            <tr>
                                                <th width="20%"><span class="requiredspan">*</span>Date of Birth:</th>
                                                <th><input type="date" class="form-control datepicker smallerinput" v-model="derivedinfo.father_birthdate" required></th>
                                                <th><input type="date" class="form-control datepicker smallerinput" v-model="derivedinfo.mother_birthdate" required></th>
                                                <th><input type="date" class="form-control datepicker smallerinput" v-model="derivedinfo.guardian_birthdate"></th>
                                            </tr>
                                            <tr>
                                                <th width="20%">Occupation:</th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.father_occupation"></th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.mother_occupation"></th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.guardian_occupation"></th>
                                            </tr>
                                            <tr>
                                                <th width="20%"><span class="requiredspan">*</span>Contact No:</th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.father_contactno" required></th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.mother_contactno" required></th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.guardian_contactno"></th>
                                            </tr>
                                        </table>
                                    </div>
                                    <hr/>
                                    <h6>EMERGENCY CONTACT INFORMATION</h6>
                                    <div class="form-group row">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="20%"><span class="requiredspan">*</span>Name:</th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.emergency_name" required></th>
                                                <th width="20%"><span class="requiredspan">*</span>Relationship</th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.emergency_relationship" required></th>
                                            </tr>
                                            <tr>
                                                <th width="20%"><span class="requiredspan">*</span>Address:</th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.emergency_address" required></th>
                                                <th width="20%"><span class="requiredspan">*</span>Mobile Number:</th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.emergency_mobilenum" required></th>
                                            </tr>
                                        </table>
                                    </div>
                                    <hr/>
                                    <h6>EDUCATION INFORMATION</h6>
                                    <div class="form-group row">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="20%"><span class="requiredspan">*</span>Name of School:</th>
                                                <th colspan=3><input type="text" class="form-control smallerinput" v-model="derivedinfo.schoolname" required></th>
                                            </tr>
                                            <tr>
                                                <th width="20%">Year / Grade:</th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.schoolyear"></th>
                                                <th width="20%">School Course</th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.schoolcourse"></th>
                                            </tr>
                                        </table>
                                    </div>
                                    <hr/>
                                    <h6>WORK INFORMATION</h6>
                                    <div class="form-group row">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="20%">Name of Company:</th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.companyname"></th>
                                                <th width="20%">Company Address:</th>
                                                <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.companyaddress"></th>
                                            </tr>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary" style="width: 20%;">Update Profile</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="<?= base_url("assets/img/other_avatar.png") ?>" alt="user image">
                                    <span class="username">
                                        <a href="#">Jonathan Burke Jr.</a>
                                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                    </span>
                                    <span class="description">Shared publicly - 7:30 PM today</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore the hate as they create awesome
                                    tools to help create filler text for everyone from bacon lovers
                                    to Charlie Sheen fans.
                                    </p>

                                    <p>
                                    <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                    <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                    <span class="float-right">
                                        <a href="#" class="link-black text-sm">
                                        <i class="far fa-comments mr-1"></i> Comments (5)
                                        </a>
                                    </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post clearfix">
                                    <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="<?= base_url("assets/img/other_avatar.png") ?>" alt="User Image">
                                    <span class="username">
                                        <a href="#">Sarah Ross</a>
                                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                    </span>
                                    <span class="description">Sent you a message - 3 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore the hate as they create awesome
                                    tools to help create filler text for everyone from bacon lovers
                                    to Charlie Sheen fans.
                                    </p>

                                    <form class="form-horizontal">
                                    <div class="input-group input-group-sm mb-0">
                                        <input class="form-control form-control-sm" placeholder="Response">
                                        <div class="input-group-append">
                                        <button type="submit" class="btn btn-danger">Send</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="<?= base_url("assets/img/other_avatar.png") ?>" alt="User Image">
                                    <span class="username">
                                        <a href="#">Adam Jones</a>
                                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                    </span>
                                    <span class="description">Posted 5 photos - 5 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <img class="img-fluid" src="<?= base_url("assets/img/samplepic1.png") ?>" alt="Photo">
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                        <div class="row">
                                        <div class="col-sm-6">
                                            <img class="img-fluid mb-3" src="<?= base_url("assets/img/samplepic2.jfif") ?>" alt="Photo">
                                            <img class="img-fluid" src="<?= base_url("assets/img/samplepic3.jfif") ?>" alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                            <img class="img-fluid mb-3" src="<?= base_url("assets/img/samplepic4.jfif") ?>" alt="Photo">
                                            <img class="img-fluid" src="<?= base_url("assets/img/samplepic5.jfif") ?>" alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <p>
                                    <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                    <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                    <span class="float-right">
                                        <a href="#" class="link-black text-sm">
                                        <i class="far fa-comments mr-1"></i> Comments (5)
                                        </a>
                                    </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                </div>
                            <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                    <span class="bg-danger">
                                        10 Feb. 2014
                                    </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                    <i class="fas fa-envelope bg-primary"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                        <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                        </div>
                                        <div class="timeline-footer">
                                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                    <i class="fas fa-user bg-info"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                        </h3>
                                    </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                    <i class="fas fa-comments bg-warning"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                        <div class="timeline-body">
                                        Take me to your leader!
                                        Switzerland is small and neutral!
                                        We are more like Germany, ambitious and misunderstood!
                                        </div>
                                        <div class="timeline-footer">
                                        <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                    <span class="bg-success">
                                        3 Jan. 2014
                                    </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                    <i class="fas fa-camera bg-purple"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                        <div class="timeline-body">
                                        <img src="http://placehold.it/150x100" alt="...">
                                        <img src="http://placehold.it/150x100" alt="...">
                                        <img src="http://placehold.it/150x100" alt="...">
                                        <img src="http://placehold.it/150x100" alt="...">
                                        </div>
                                    </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <div>
                                    <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</section>