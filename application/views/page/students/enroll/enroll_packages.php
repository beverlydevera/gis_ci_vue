<table class="table table-bordered table-responsive-sm table-sm">
    <tr>
        <th width="15%">Student Reference ID:</th>
        <th width="15%"><input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentrefid" required></th>
        <th width="8%">Full Name:</th>
        <th>
            <div class="row">
                <div class="col-sm-3">
                    <input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentinfo.lastname" required>
                </div>
                <div class="col-sm-4">
                    <input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentinfo.firstname" required>
                </div>
                <div class="col-sm-3">
                    <input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentinfo.middlename">
                </div>
                <div class="col-sm-2">
                    <input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentinfo.extname">
                </div>
            </div>
        </th>
        <th width="8%">Insurance:</th>
        <th>
            <select class="form-control smallerinput" required v-model="otherinfo.insurance.avail" :disabled="disabled_packages">
                <option disabled selected>Select Insurance</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </th>
    </tr>
</table>
<hr>
<h5>Packages</h5>
<div class="row">
    <div class="col-md-6" style="border-right:1px solid #000;">
        Select Package Type:
        <select class="form-control col-md-6" required @change="changePackageType()" v-model="packages_selects.packagetype" :disabled="disabled_packages">
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
                            {{list.details}}
                        </td>
                        <td v-else-if="list.package_type=='Summer Promo'">
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
                        <td>{{list.price_rate}}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <button id="savenewstudentpackages" class="btn btn-primary float-right" @click="saveSelectedPackages()">Save Selected Packages</button>
        </div>
    </div>
</div>