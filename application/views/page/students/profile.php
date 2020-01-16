<style>
    h6{
        font-weight: bold;
        text-decoration: underline;
    }

    .smallerinput {
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
                                <a class="nav-link" href="#balancepayments" data-toggle="tab">
                                    <i class="far fa-credit-card"></i>
                                    Balance and Payments
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#audittrail" data-toggle="tab">
                                    <i class="fas fa-history"></i>
                                    Audit Trail
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" href="#gallery" data-toggle="tab">
                                    <i class="far fa-images"></i>
                                    Gallery
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
                                            <table class="table table-bordered table-responsive-sm table-sm">
                                                <tr>
                                                    <th width="15%"><span class="requiredspan">*</span>Full Name:</th>
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
                                                    <th width="15%">Nickname:</th>
                                                    <th><input type="text" class="form-control smallerinput" v-model="studentinfo.nickname"></th>
                                                </tr>
                                                <tr>
                                                    <th width="15%"><span class="requiredspan">*</span>Home Address:</th>
                                                    <th colspan=5>
                                                        <input type="text" class="form-control smallerinput" v-model="studentinfo.address" required>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th width="15%"><span class="requiredspan">*</span>Cellphone Number:</th>
                                                    <th><input type="text" class="form-control smallerinput" placeholder="(09)xx-xxxx-xxx" v-model="studentinfo.mobileno" required></th>
                                                    <th width="15%">Telephone Number:</th>
                                                    <th><input type="text" class="form-control smallerinput" placeholder="(09)xx-xxxx-xxx" v-model="studentinfo.telephoneno"></th>
                                                    <th width="15%"><span class="requiredspan">*</span>Email Address:</th>
                                                    <th><input type="email" class="form-control smallerinput" placeholder="abc@email.com" v-model="studentinfo.emailadd" required></th>
                                                </tr>
                                                <tr>
                                                    <th width="15%"><span class="requiredspan">*</span>Date of Birth:</th>
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
                                                    <th width="15%">Religion:</th>
                                                    <th><input type="text" class="form-control smallerinput" v-model="studentinfo.religion"></th>
                                                    <th width="15%"><span class="requiredspan">*</span>Sex:</th>
                                                    <th>
                                                        <select class="form-control select2 smallerinput" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true" v-model="studentinfo.sex">
                                                            <option selected disabled></option>
                                                            <option value="M">Male</option>
                                                            <option value="F">Female</option>
                                                        </select>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th width="15%"><span class="requiredspan">*</span>Height (m):</th>
                                                    <th><input type="number" class="form-control smallerinput" v-model="studentinfo.height" required></th>
                                                    <th width="15%"><span class="requiredspan">*</span>Weight (kg):</th>
                                                    <th><input type="number" class="form-control smallerinput" v-model="studentinfo.weight" required></th>
                                                    <th width="15%"><span class="requiredspan">*</span>Insurance:</th>
                                                    <th>
                                                        <div class="row">
                                                            <div class="col-sm-2"></div>
                                                            <div class="col-sm-5">
                                                                <input type="radio" class="form-check-input" :value="1" v-model="studentinfo.insurance" required>
                                                                <label class="form-check-label" for="">Yes</label>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <input type="radio" class="form-check-input" :value="0" v-model="studentinfo.insurance" required>
                                                                <label class="form-check-label" for="">No</label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    
                                                </tr>
                                            </table>
                                        </div>
                                        <hr/>
                                        <h6>EDUCATION INFORMATION</h6>
                                        <div class="form-group row">
                                            <table class="table table-bordered table-responsive-sm table-sm">
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
                                        <h6>WORK INFORMATION <small><i>(if working)</i></small></h6>
                                        <div class="form-group row">
                                            <table class="table table-bordered table-responsive-sm table-sm">
                                                <tr>
                                                    <th width="20%">Name of Company:</th>
                                                    <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.companyname"></th>
                                                    <th width="20%">Company Address:</th>
                                                    <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.companyaddress"></th>
                                                </tr>
                                            </table>
                                        </div>
                                        <hr>
                                        <h6>PARENTS / GUARDIAN INFORMATION</h6>
                                        <div class="form-group row">
                                            <table class="table table-bordered table-responsive-sm table-sm">
                                                <tr>
                                                    <th width="20%"></th>
                                                    <th width="20%"><span class="requiredspan">*</span>Father</th>
                                                    <th width="20%"><span class="requiredspan">*</span>Mother</th>
                                                    <th width="20%">Guardian <small><i>(if any)</i></small></th>
                                                </tr>
                                                <tr>
                                                    <th width="20%"><span class="requiredspan">*</span>Name:</th>
                                                    <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.father_name" required></th>
                                                    <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.mother_name" required></th>
                                                    <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.guardian_name"></th>
                                                </tr>
                                                <tr>
                                                    <th width="20%"><span class="requiredspan">*</span>Occupation:</th>
                                                    <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.father_occupation" required></th>
                                                    <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.mother_occupation" required></th>
                                                    <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.guardian_occupation"></th>
                                                </tr>
                                                <tr>
                                                    <th width="20%"><span class="requiredspan">*</span>Office Address:</th>
                                                    <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.father_officeadd" required></th>
                                                    <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.mother_officeadd" required></th>
                                                    <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.guardian_officeadd"></th>
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
                                            <table class="table table-bordered table-responsive-sm table-sm">
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
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary" style="width: 20%;">Update Profile</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="activity">
                                    <h6>MY CLASSES
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#enrollToClassModal" style="float:right;" @click="getClassScheds">Enroll to a Class</button>
                                    </h6>
                                    <br>
                                    <table class="table table-bordered table-responsive-sm table-sm">
                                        <thead>                  
                                            <tr>
                                                <th width="3%">#</th>
                                                <th>Class Title</th>
                                                <th>Class Schedule</th>
                                                <th>Remaining Sessions</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(list,index) in studentclasses" :value="list.studpack_id">
                                                <td>{{index+1}}</td>
                                                <td>{{list.class_title}}</td>
                                                <td>{{list.sched_day}} / {{list.sched_time}}</td>
                                                <td>00</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#StudentClassDetailsModal" @click="getStudentClassDetails(list.studpack_id)"><i class="fas fa-eye"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm" @click="deleteStudentClass(list.studpack_id)"><i class="fas fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="enrollToClassModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">            
                <form @submit.prevent="enrollToClass">
                    <div class="modal-header">
                        <h4 class="modal-title">Enroll to a Class</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">List of Class Packages</h3>
                                    </div>
                                    <div class="card-body">
                                        
                                            <table class="table table-bordered table-responsive-sm table-sm">
                                            <thead>                  
                                                <tr>
                                                    <th>#</th>
                                                    <th>Class Title</th>
                                                    <th>Class Schedule</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(list,index) in classschedlist" :value="list.class_id">
                                                    <td>{{index+1}}</td>
                                                    <td>{{list.class_title}}</td>
                                                    <td>{{list.sched_day}} / {{list.sched_time}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Pick a Schedule</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Pick a Class Schedule</label>
                                            <select class="form-control select2" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true" v-model="classenroll.class_id" @change="getClassPackages">
                                                <option selected disabled>Select a Schedule</option>
                                                <option v-for="(list,index) in classschedlist" :value="list.class_id"> {{index+1}} &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; {{list.class_title}} &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; {{list.sched_day}} / {{list.sched_time}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Input <small>(from Available)</small> Number of Sessions</label>
                                            <select class="form-control select2" style="width: 100%;" :disabled="disabled_everything" data-select2-id="12" tabindex="-1" aria-hidden="true" v-model="classenroll.package_id" @change="checkPayment">
                                                <option selected disabled></option>
                                                <option v-for="(list,index) in classpackagelist" :value="list.package_id">{{list.sessions}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Pick Mode of Payment</label>
                                            <select class="form-control select2" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true" v-model="classenroll.payment" @change="checkPayment">
                                                <option selected disabled></option>
                                                <option value="fullPayment">Full Payment</option>
                                                <option value="staggeredPayment">Staggered Payment</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Amount to Pay <br/><small>(Input if Staggered Payment)</small></label>
                                            <input type="number" :readonly="readonly_everything" min="0" id="amountpay" class="form-control" v-model="classenroll.amounttopay">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="StudentClassDetailsModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">My Class Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                                            <table class="table table-bordered table-responsive-sm table-sm">
                        <tr>
                            <th colspan=2>Class Title</th>
                            <th colspan=2>{{studentclassdetails.class_title}}</th>
                        </tr>
                        <tr>
                            <th colspan=2>Class Schedule</th>
                            <td colspan=2>{{studentclassdetails.sched_day}} / {{studentclassdetails.sched_time}}</td>
                        </tr>
                        <tr>
                            <th colspan=2>Date Enrolled</th>
                            <td colspan=2>{{studentclassdetails.date_added}}</td>
                        </tr>
                        <tr>
                            <th colspan=4>Payment History and Details</th>
                        </tr>
                        <tr>
                            <th colspan=2>Payment Option</th>
                            <td colspan=2>{{studentclassdetails.payment_options}}</td>
                        </tr>
                        <tr>
                            <th colspan=2>Dates</th>
                            <th colspan=2>Amount Paid</th>
                        </tr>
                        <tr>
                            <th colspan=4>Attendance Details</th>
                        </tr>
                        <tr>
                            <th width="30%">Sessions Registered</th>
                            <td width="20%">{{studentclassdetails.sessions}}</td>
                            <th width="30%">Remaining Sessions</th>
                            <td width="20%">00</td>
                        </tr>
                        <tr>
                            <th colspan=4>Classes Facilitated</th>
                        </tr>
                        <tr>
                            <td colspan=2>Dates</td>
                            <td colspan=2>
                                <span class="badge bg-success">Present</span>
                                <span class="badge bg-danger">Absent</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</section>