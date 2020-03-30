<h6>CLASSES AND ATTENDANCE
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#availNewPackage" style="float:right;">Avail New Package</button>
</h6>
<!-- <br> -->
<div class="row">
    <div class="col-md-2">
        <select class="form-control smallerinput" v-model="filterdetails.classes_packagetype" @change="searchTable('packages')">
            <option value="0" disabled selected>Select Package Type</option>
            <option>Regular</option>
            <option>Unlimited</option>
            <option>Summer Promo</option>
        </select>
    </div>
    <div class="col-md-2">
        <select class="form-control smallerinput" v-model="filterdetails.classes_year" @change="searchTable('packages')">
            <option value="0" disabled selected>Select Year</option>
            <option>2020</option>
            <option>2019</option>
        </select>
    </div>
    <div class="col-md-4">
        <button class="btn btn-primary btn-xs" @click="searchTable('clearpackages')">Clear Filter</button>
    </div>
</div>
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
                        <template v-for="(ll,ii) in list.details.detail">
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

<div class="modal fade" id="availNewPackage">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Avail New Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6" style="border-right:1px solid #000;">
                        <select class="form-control col-md-6" required @change="changePackageType()" v-model="packages_selects.packagetype">
                            <option disabled selected>Select Package Type</option>
                            <option>Regular</option>
                            <option>Unlimited</option>
                            <option>Summer Promo</option>
                        </select>
                        <br>
                        <h6>List of {{packages_selects.packagetype}} Packages</h6>

                        <div id="packagetype_regular" style="display:none;">
                            <table class="table table-bordered table-responsive-sm table-sm">
                                <thead>
                                    <th>#</th>
                                    <th>Class</th>
                                    <th>Sessions</th>
                                    <th>Price Rate</th>
                                    <th>Remarks</th>
                                    <th>Schedules</th>
                                </thead>
                                <tbody v-for="(list,index) in packagelist">
                                    <tr>
                                        <td>{{index+1}}</td>
                                        <td>{{list.packagedetails.class}}</td>
                                        <td>{{list.packagedetails.sessions}}</td>
                                        <td>{{list.pricerate}}</td>
                                        <td>{{list.remarks}}</td>
                                        <td>
                                            <button v-bind:id="'showSchedulesbtn-'+list.package_id" :disabled="disabled_showbtn" class="btn btn-primary btn-xs" @click="getSchedulesList(list.packagedetails.class_id,list.package_id,index)">View Schedules</button>
                                            <button v-bind:id="'hideSchedulesbtn-'+list.package_id" :disabled="disabled_hidebtn" class="btn btn-warning btn-xs" @click="hideSchedules(list.package_id)" style="display:none;">Hide Schedules</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div id="regular_schedules" style="display:none;">
                            <br/>
                            <h6>List of Class Schedules</h6>
                            <table class="table table-bordered table-responsive-sm table-sm">
                                <thead>
                                    <th>#</th>
                                    <th>Branch</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </thead>
                                <tbody v-for="(list,index) in scheduleslist.data">
                                    <tr>
                                        <td>{{index+1}}</td>
                                        <td>{{list.branch_name}}</td>
                                        <td>{{list.sched_day}}</td>
                                        <td>{{list.sched_time}}</td>
                                        <td>
                                            <button v-bind:id="'selectPackage-'+list.schedule_id" class="selectpack btn btn-success btn-xs" @click="selectPackage(index,'regular',scheduleslist.packageindex)">Select Class</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div id="packagetype_unlimited" style="display:none;">
                            <table class="table table-bordered table-responsive-sm table-sm">
                                <thead>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Price Rate</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </thead>
                                <tbody v-for="(list,index) in packagelist">
                                    <tr>
                                        <td>{{index+1}}</td>
                                        <td>{{list.packagedetails}}</td>
                                        <td>{{list.pricerate}}</td>
                                        <td>{{list.remarks}}</td>
                                        <td>
                                            <button v-bind:id="'selectPackage-'+list.package_id" class="selectpack btn btn-success btn-xs" @click="selectPackage('','unlimited',index)">Select Package</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div id="packagetype_summerpromo" style="display:none;">
                            <table class="table table-bordered table-responsive-sm table-sm">
                                <thead>
                                    <th>#</th>
                                    <th>Details</th>
                                    <th>Price Rate</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </thead>
                                <tbody v-for="(list,index) in packagelist">
                                    <tr>
                                        <td>{{index+1}}</td>
                                        <td>
                                            <button v-bind:id="'showDetailsbtn-'+list.package_id" :disabled="disabled_showbtn" class="btn btn-primary btn-xs" @click="showDetails(list.package_id)">Show Details</button>
                                            <button v-bind:id="'hideDetailsbtn-'+list.package_id" :disabled="disabled_hidebtn" class="btn btn-warning btn-xs" @click="hideDetails(list.package_id)" style="display:none;">Hide Details</button>
                                            <template v-if="packagedetails.package_data.length>0">
                                                <table class="table table-bordered table-responsive-sm table-sm" v-if="list.package_id==packagedetails.package_id">
                                                    <tr>
                                                        <th>PARTICULAR</th>
                                                        <th>PRICE</th>
                                                    </tr>
                                                <template id="summerpromodetails" v-for="(ll,ii) in packagedetails.package_data" style="display:none;">
                                                    <tr>
                                                        <td>{{ll.particular}}</td>
                                                        <td>{{ll.price}}</td>
                                                    </tr>
                                                </template>
                                                </table>
                                            </template>
                                        </td>
                                        <td>{{list.pricerate}}</td>
                                        <td>{{list.remarks}}</td>
                                        <td>
                                            <button v-bind:id="'selectPackage-'+list.package_id" class="selectpack btn btn-success btn-xs" @click="selectPackage('','summer promo',index)">Select Package</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6>Summary of Selected Packages</h6>
                        <div id="selected_packages" style="display:none">
                            <table class="table table-bordered table-responsive-sm table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Package Type</th>
                                        <th>Details</th>
                                        <th>Price Rate</th>
                                    </tr>
                                </thead>
                                <tbody v-for="(list,index) in selectedPackages">
                                    <tr>
                                        <td>{{index+1}}</td>
                                        <td>{{list.package_type}}</td>
                                        <td v-if="list.package_type=='Regular'">
                                            Branch: {{list.details.branch}} <br>
                                            Class: {{list.details.class}} <br>
                                            Schedule: {{list.details.sched_day}} / {{list.details.sched_time}} <br>
                                            Sessions: {{list.details.sessions}}
                                        </td>
                                        <td v-else-if="list.package_type=='Unlimited'">
                                            {{list.details.detail}}
                                        </td>
                                        <td v-else-if="list.package_type=='Summer Promo'">
                                            <table class="table table-bordered table-responsive-sm table-sm">
                                                <tr>
                                                    <th>PARTICULAR</th>
                                                    <th>PRICE</th>
                                                </tr>
                                            <template v-for="(ll,ii) in list.details.detail">
                                                <tr v-if="ll.type=='input'">
                                                    <td>{{ll.particular}}</td>
                                                    <td>{{ll.price}}</td>
                                                </tr>
                                            </template>
                                            </table>
                                        </td>
                                        <td>{{list.price_rate}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <button id="savenewstudentpackages" class="btn btn-primary float-right" @click="saveSelectedPackages()">Save Selected Packages</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>