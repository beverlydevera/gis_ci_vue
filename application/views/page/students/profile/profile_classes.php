<h6>CLASSES AND ATTENDANCE</h6>
<br>

<div class="row" id="package_regular">
    <div class="col-md-12">
        <table class="table table-bordered table-responsive-sm table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>TYPE</th>
                    <th>DETAILS</th>
                    <th>YEAR</th>
                    <th>SESSIONS ATTENDED</th>
                    <th>ATTENDANCE</th>
                </tr>
            </thead>
            <tbody v-for="(list,index) in studentpackages">
                <tr>
                    <td>{{index+1}}</td>
                    <td>{{list.packagetype}}</td>
                    <td v-if="list.packagetype=='Regular'">
                        Class: {{list.details.class}} <br>
                        Schedule: {{list.details.sched_day}} / {{list.details.sched_time}} <br>
                        Sessions: {{list.details.sessions}} <br>
                        Remaining Sessions: {{list.details.sessions-list.details.sessions_attended}}
                    </td>
                    <td v-else-if="list.packagetype=='Unlimited'">
                        {{list.details.detail}}
                    </td>
                    <td v-else-if="list.packagetype=='Summer Promo'">
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <tr>
                                <th>PARTICULAR</th>
                                <th>PRICE</th>
                            </tr>
                        <template v-for="(ll,ii) in list.details">
                            <tr v-if="ll.type=='input'">
                                <td>{{ll.particular}}</td>
                                <td>{{ll.price}}</td>
                            </tr>
                        </template>
                        </table>
                    </td>
                    <td>{{list.year}}</td>
                    <td>{{list.details.sessions_attended}}</td>
                    <td><button type="button" class="btn btn-primary btn-xs" @click="viewAttendance(list.studpack_id)">View</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="viewAttendanceModal">
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
                                <th>Class Schedule ID</th>
                                <th>Schedule Date</th>
                                <th>Present/Absent</th>
                            </tr>
                        </thead>
                        <tbody v-for="(list,index) in studentattendance">
                            <tr>
                                <td>{{index+1}}</td>
                                <td>{{list.classsched_id}}</td>
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