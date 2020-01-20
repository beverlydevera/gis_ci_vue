<section class="content">
    <!-- <form @submit.prevent="updateProfile"> -->
        <input type="hidden" value="<?=$student_id?>" id="student_id">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url("assets/img/student_avatar.png") ?>" alt="User profile picture">
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
                                    <b>Current Class: </b><br>
                                    <a>Mighty Cubs Level 2</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Current Rank: </b> <br>
                                    <a >7th Yellow</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status: </b> <br>
                                    <a ><span class="badge bg-success">Active</span></a>
                                </li>
                            </ul>
                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
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
                                <a class="nav-link" href="#activity" data-toggle="tab">
                                    <i class="fas fa-calendar-day"></i>    
                                    Schedules and Classes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#timeline" data-toggle="tab">
                                    <i class="fas fa-trophy"></i>
                                    Promotion Timeline
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
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#audittrail" data-toggle="tab">
                                    <i class="fas fa-history"></i>
                                    Audit Trail
                                </a>
                            </li> -->
                        </ul>
                        </div>
                        
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalinfo">
                                    <?php include('profile/profile_basicinfo.php');?>
                                </div>
                                <div class="tab-pane" id="activity">
                                    <?php include('profile/profile_classes.php');?>
                                </div>
                                <div class="tab-pane" id="timeline">
                                    <?php include('profile/profile_timeline.php');?>
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
    <!-- </form> -->

</section>