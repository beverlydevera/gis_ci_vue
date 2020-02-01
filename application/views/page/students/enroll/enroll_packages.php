<table class="table table-bordered table-responsive-sm table-sm">
    <tr>
        <th width="15%">Student Reference ID:</th>
        <th><input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentrefid" required></th>
    </tr>
    <tr>
        <th width="15%">Full Name:</th>
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
    </tr>
</table>
<hr/>
<h5>Packages</h5>
<div class="row">
    <div class="col-md-5">
        Select Package Type:
        <select class="form-control" required @change="changePackageType()" v-model="packages_selects.packagetype">
            <option disabled selected>Select Package Type</option>
            <option>Regular</option>
            <option>Unlimited</option>
            <option>Summer Promo</option>
        </select>
        <br>
        <div id="packagetype_regular" style="display:none;">
            <table class="table table-bordered table-responsive-sm table-sm">
                <thead>
                    <th>Class</th>
                    <th>Schedule</th>
                    <th>Sessions</th>
                    <th>Price Rate</th>
                    <th>Remarks</th>
                </thead>
                <tbody v-for="(list,index) in packagelist">
                    <tr>
                        <td>{{list.packagedetails.schedule}}</td>
                        <td>{{list.packagedetails.schedule}}</td>
                        <td>{{list.packagedetails.sessions}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="packagetype_unlimited" style="display:none;">
            Select Unlimited Info
        </div>
        <div id="packagetype_summerpromo" style="display:none;">
            Select from Packages
        </div>
    </div>
    <div class="col-md-7">
        Packages Info
    </div>
</div>