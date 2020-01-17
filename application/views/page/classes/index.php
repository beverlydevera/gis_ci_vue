<section class="content">
    <div class="container-fluid">
        <div class="row">
            <input type="hidden" value="0" id="class_id"/>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Classes</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend smallerinput">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control smallerinput" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control smallerinput">
                                    <option disabled selected>Select Branch</option>
                                    <option>Sample 1</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control smallerinput">
                                    <option disabled selected>Select Class</option>
                                    <option>Sample 1</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control smallerinput">
                                    <option disabled selected>Select Day</option>
                                    <option>Monday</option>
                                </select>
                            </div>
                            <!-- <div class="col-md-2">
                                <select class="form-control smallerinput">
                                    <option disabled selected>Select Time</option>
                                    <option>Monday</option>
                                </select>
                            </div> -->
                            <div class="col-md-1">
                                <button class="btn btn-primary btn-xs">Filter</button>
                            </div>
                        </div>
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead>                  
                                <tr>
                                <th>#</th>
                                <th>Class Title</th>
                                <th>Branch</th>
                                <th>Class Schedule</th>
                                <th>Enrollees</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(list,index) in classschedlist" :value="list.class_id">
                                <td>{{index+1}}</td>
                                <td>{{list.class_title}}</td>
                                <td>{{list.branch_name}}</td>
                                <td>{{list.sched_day}}/{{list.sched_time}}</td>
                                <td>{{list.enrollees}}</td>
                                <td>
                                    <span v-if="list.status" class="badge bg-success">Active</span>
                                    <span v-else class="badge bg-danger">Inactive</span>
                                </td>
                                <td>
                                    <!-- <a v-bind:href="'classHistoryInfo/'+(list.class_title).replace(/ /g,'')+'-'+list.class_id" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></a> -->
                                    <a v-bind:href="'classSchedInfo/'+list.class_id" class="btn btn-primary btn-xs"><i class="fas fa-eye" style="color:#000;"></i></a>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>