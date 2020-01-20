<h6>MY CLASSES
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#enrollToClassModal" style="float:right;" @click="getClassScheds">Enroll to a Class</button>
</h6>
<br>
<div class="row">
    <div class="col-md-3">
        <div class="input-group mb-3">
        <div class="input-group-prepend smallerinput">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
        <input type="text" class="form-control smallerinput" placeholder="Search">
        </div>
    </div>
    <div class="col-md-3">
        <select class="form-control smallerinput">
            <option disabled selected>Select Class SchedDay</option>
            <option>Monday</option>
        </select>
    </div>
    <div class="col-md-1">
        <button class="btn btn-primary btn-xs">Filter</button>
    </div>
</div>
<!-- <br> -->
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
            <td>{{list.sessions-list.sessions_attended}}</td>
            <td>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#StudentClassDetailsModal" @click="getStudentClassDetails(list.studpack_id,list.schedule_id)"><i class="fas fa-eye"></i></button>
                <button type="button" class="btn btn-danger btn-sm" @click="deleteStudentClass(list.studpack_id)"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
    </tbody>
</table>

<div class="modal fade" id="enrollToClassModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">            
            <form @submit.prevent="enrollToClass">
                <div class="modal-header">
                    <h5 class="modal-title">Enroll to a Class</h5>
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
                <h5 class="modal-title">My Class Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <table class="table table-bordered table-responsive-sm table-sm">
                    <tr>
                        <th colspan=2>Class Title</th>
                        <td colspan=2>{{studentclassdetails.class_title}}</td>
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
                        <th colspan=2>Payment Option</th>
                        <td colspan=2>{{studentclassdetails.payment_options}}</td>
                    </tr>
                    <tr>
                        <th width="30%">Sessions Registered</th>
                        <td width="20%">{{studentclassdetails.sessions}}</td>
                        <th width="30%">Remaining Sessions</th>
                        <td width="20%">{{studentclassdetails.sessions-studentclassdetails.sessions_attended}}</td>
                    </tr>
                    <tr>
                        <th colspan=4>Classes Facilitated</th>
                    </tr>
                    <tr v-for="(list,index) in studentattendance">
                        <td>{{index+1}}</td>
                        <td colspan=2>{{changeDateFormat(list.schedule_date)}}</td>
                        <td>
                            <span v-if="list.status" class="badge bg-success">Present</span>
                            <span v-else class="badge bg-danger">Absent</span>
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