<section class="content" id="classes_page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Classes</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <!-- filters -->
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>                  
                                <tr>
                                <th style="width: 10px">#</th>
                                <th>Class Title</th>
                                <th>Class Schedule</th>
                                <th>Current Students</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(list,index) in classschedlist" :value="list.class_id">
                                <td>{{index+1}}</td>
                                <td>{{list.class_title}}</td>
                                <td>{{list.sched_day}}/{{list.sched_time}}</td>
                                <td>000</td>
                                <td>
                                    <span v-if="list.status" class="badge bg-success">Active</span>
                                    <span v-else class="badge bg-danger">Inactive</span>
                                </td>
                                <td>
                                    <!-- <a v-bind:href="'classHistoryInfo/'+(list.class_title).replace(/ /g,'')+'-'+list.class_id" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></a> -->
                                    <a v-bind:href="'classHistoryInfo/'+list.class_id" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></a>
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