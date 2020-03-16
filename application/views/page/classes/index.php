<section class="content">
    <div class="container-fluid">
        <div class="row">
            <input type="hidden" value="0" id="schedule_id"/>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Classes</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php if(sesdata('role')==1){ ?>
                            <div class="col-md-2">
                                <select class="form-control smallerinput" v-model="filterdetails.branch_id" @change="filterData('filter')">
                                    <option value=0 disabled selected>Select Branch</option>
                                    <template v-for="(list,index) in brancheslist">
                                    <option :value=list.branch_id>{{list.branch_name}}</option>
                                    </template>
                                </select>
                            </div>
                            <?php } ?>
                            <div class="col-md-2">
                                <select class="form-control smallerinput" v-model="filterdetails.class_id" @change="filterData('filter')">
                                    <option value=0 disabled selected>Select Class</option>
                                    <template v-for="(list,index) in classeslist">
                                    <option :value=list.class_id>{{list.class_title}}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control smallerinput" v-model="filterdetails.sched_day" @change="filterData('filter')">
                                    <option value=0 disabled selected>Select Class SchedDay</option>
                                    <option>Monday</option>
                                    <option>Tuesday</option>
                                    <option>Wednesday</option>
                                    <option>Thursday</option>
                                    <option>Friday</option>
                                    <option>Saturday</option>
                                    <option>Sunday</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-xs" @click="filterData('clear')">Clear Filter</button>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead>                  
                                <tr>
                                <th>#</th>
                                <th>Class Title</th>
                                <?php if(sesdata('role')==1){ ?>
                                <th>Branch</th>
                                <?php } ?>
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
                                <?php if(sesdata('role')==1){ ?>
                                <td>{{list.branch_name}}</td>
                                <?php } ?>
                                <td>{{list.sched_day}} / {{list.sched_time}}</td>
                                <td>000</td>
                                <td>
                                    <span v-if="list.status" class="badge bg-success">Active</span>
                                    <span v-else class="badge bg-danger">Inactive</span>
                                </td>
                                <td>
                                    <a v-bind:href="'classSchedInfo/'+(list.class_title).replace(/ /g,'')+'-'+list.schedule_id" class="btn btn-primary btn-xs"><i class="fas fa-eye" style="color:#000;"></i></a>
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