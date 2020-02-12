<h6>ATTENDANCE AND CLASSES
    <select class="form-control col-md-3" required style="float:right;" v-model="package_select.packagetype" @change="changePackagetype()">
        <option disabled selected>Select Package Type</option>
        <option>Regular</option>
        <option>Unlimited</option>
        <option>Summer Promo</option>
    </select>
    <button id="package_regular_add" type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#enrollToClassModal" style="float:right;">Enroll to a Class</button>
    <button id="package_unlimited_add" type="button" class="btn btn-primary mr-2" style="float:right; display:none;">Avail Unlimited Package</button>
    <button id="package_summerpromo_add" type="button" class="btn btn-primary mr-2" style="float:right; display:none;">Avail Summer Promo Package</button>
</h6>
<br>

<div class="row" id="package_regular">
    <div class="col-md-12">
        <table class="table table-bordered table-responsive-sm table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>CLASS</th>
                    <th>SCHEDULE</th>
                    <th>SESSIONS</th>
                    <th>REMAINING SESSIONS</th>
                    <th>ATTENDANCE</th>
                </tr>
            </thead>
            <tbody v-for="(list,index) in studentpackages.regular">
                <tr>
                    <td>{{index+1}}</td>
                    <td>{{list.details.class}}</td>
                    <td>{{list.details.sched_day}} / {{list.details.sched_time}}</td>
                    <td>{{list.packagedetails.sessions}}</td>
                    <td>{{list.details.sessions-list.details.sessions_attended}}</td>
                    <td><button type="button" class="btn btn-primary btn-xs" @click="viewAttendance(list.details.schedule_id,'regular')">View</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row" id="package_unlimited" style="display:none;">
    <div class="col-md-12">
        <table class="table table-bordered table-responsive-sm table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date From</th>
                    <th>Date To</th>
                    <th>Sessions Attended</th>
                    <th>Attendance</th>
                </tr>
            </thead>
            <tbody v-for="(list,index) in studentpackages.unlimited">
                <tr>
                    <td>{{index+1}}</td>
                    <td>{{list.date_from}}</td>
                    <td>{{list.date_to}}</td>
                    <td>{{list.details.sessions_attended}}</td>
                    <td><button type="button" class="btn btn-primary btn-xs" @click="viewAttendance(list.details.schedule_id,'unlimited')">View</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row" id="package_summerpromo" style="display:none;">
    <div class="col-md-12">
        summer promo package attendance
    </div>
</div>

<div class="modal fade" id="regular_attendanceModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Student Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Present/Absent</th>
                            </tr>
                        </thead>
                        <tbody v-for="(list,index) in studentattendance">
                            <tr>
                                <td>{{index}}</td>
                                <td>{{list.schedule_date}}</td>
                                <td>
                                    <span v-if="list.status==1" class="badge bg-success">PRESENT</span>
                                    <span v-else-if="list.status==2" class="badge bg-danger">PRESENT</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="unlimited_attendanceModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Student Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Class</th>
                                <th>Schedule</th>
                            </tr>
                        </thead>
                        <tbody v-for="(list,index) in studentattendance">
                            <tr>
                                <td>{{index}}</td>
                                <td>{{list.schedule_date}}</td>
                                <td>{{list.class_name}}</td>
                                <td>{{list.sched_day}} / {{list.sched_time}}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>