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
                    <td><button type="button" class="btn btn-primary btn-xs">View</button></td>
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
                    <td><button type="button" class="btn btn-primary btn-xs">View</button></td>
                </tr>
            </tbody>
        </table>

        
        <table class="table table-bordered table-responsive-sm table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Class</th>
                    <th>Schedule</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>January 21, 2020</td>
                    <td>All Levels Regular Class</td>
                    <td>Tuesday / 10:30-11:00</td>
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