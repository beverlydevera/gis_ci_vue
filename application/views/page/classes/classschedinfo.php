<div class="row">
<input type="hidden" value="<?=$class_id?>" id="class_id"/>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" id="classscheds-tab" data-toggle="tab" href="#classscheds" role="tab" aria-controls="classscheds" aria-selected="true">Class Schedules Held</a></li>
          <li class="nav-item"><a class="nav-link" id="classstudents-tab" data-toggle="tab" href="#classstudents" role="tab" aria-controls="classstudents" aria-selected="false">Students Enrolled</a></li>
        </ul>
      </div>
      <div class="card-body">
          <div class="tab-content" id="pds-tabContent">
              <div class="tab-pane fade active show" id="classscheds" role="tabpanel" aria-labelledby="classscheds-tab">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                        <div class="input-group-prepend smallerinput">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control smallerinput" placeholder="Search for Class Schedules">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- filters -->
                    </div>
                    <div class="col-md-3">
                        <a style="float:right;" data-target="#addNewClassAttendanceModal" data-toggle="modal" class="btn bg-gradient-primary btn-xs">Add New Class Attendance</a>
                    </div>
                </div>
                <table class="table table-bordered table-responsive-sm table-sm">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Class Date</th>
                      <th># of Enrolled</th>
                      <th># of Present</th>
                      <th># of Absent</th>
                      <th>Date Added</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(list,index) in classschedinfo">
                      <td>{{index+1}}</td>
                      <td>{{changeDateFormat(list.schedule_date)}}</td>
                      <td>
                          000
                      </td>
                      <td>
                          000
                      </td>
                      <td>
                          000
                      </td>
                      <td>{{list.date_added}}</td>
                      <td><button class="btn btn-primary btn-xs" @click="viewClassSchedProfileModal(list.attendance_id)"><i class="fa fa-edit"></i></button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="classstudents" role="tabpanel" aria-labelledby="classstudents-tab">
                  <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm">
                      <thead>                  
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Student Reference ID</th>
                          <th>Names</th>
                          <th>Sex</th>
                          <th>Remaining Sessions</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(list,index) in classStudents" :value="list.student_id">
                          <td>{{index+1}}</td>
                          <td>{{list.reference_id}}</td>
                          <td>{{list.lastname}}, {{list.firstname}} {{list.middlename}}</td>
                          <td>{{list.sex}}</td>
                          <td>
                            000
                          </td>
                          <td>
                            <a v-bind:href="'../.././students/profile/'+(list.firstname).replace(/ /g,'')+(list.lastname).replace(/ /g,'')+'-'+list.student_id" class="btn btn-primary btn-xs"><span style="color:#000;">View Profile</span></a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          <li class="page-item"><a class="page-link" href="#">«</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">»</a></li>
        </ul>
      </div>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>

<div class="modal fade" id="addNewClassAttendanceModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Add New Class Attendance</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-5">
                  <h6>Class Date:</h6>
                  <input type="date" class="form-control smallerinput" value="<?=date("Y-m-d")?>"/>
                </div>
                <!-- <div class="col-md-4"></div>
                <div class="col-md-3">
                  <button style="float:right; width:70%;" class="btn bg-gradient-primary btn-xs">Mark as Present</button>
                  <button style="float:right; margin-top: 2px; width:70%;" class="btn bg-gradient-danger btn-xs">Mark as Absent</button>
                </div> -->
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <span class="requiredspan">Mark All Students that are Present</span>
                  <table class="table table-bordered table-responsive-sm table-sm">
                    <thead>                  
                      <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 10px">
                          <label class="container">Present
                            <input type="checkbox"><span class="checkmark"></span>
                          </label>
                          <br/>
                        </th>
                        <th>Student Reference ID</th>
                        <th>Names</th>
                        <th>Sex</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(list,index) in classStudents" :value="list.student_id">
                        <td>{{index+1}}</td>
                        <td>
                          <label class="container">
                            <input type="checkbox" v-model="selectedStudents[list.student_id]"><span class="checkmark"></span>
                          </label>
                        </td>
                        <td>{{list.reference_id}}</td>
                        <td>{{list.lastname}}, {{list.firstname}} {{list.middlename}}</td>
                        <td>{{list.sex}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>