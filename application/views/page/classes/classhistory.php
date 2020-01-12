<div class="row">
<input type="hidden" value="<?=$class_id?>" id="class_id"/>
<input type="hidden" value="classhistoryinfo" id="currentpage"/>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <ul class="nav nav-tabs" id="myTab1" role="tablist">
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
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search for Class Schedules">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- filters -->
                    </div>
                    <div class="col-md-3">
                        <a data-target="#addNewClassAttendanceModal" data-toggle="modal" class="btn bg-gradient-primary">Add New Class Attendance</a>
                    </div>
                </div>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Class Date</th>
                      <th># of Present</th>
                      <th># of Absent</th>
                      <th>Date Added</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(list,index) in classhistoryinfo">
                      <td>{{index+1}}</td>
                      <td>{{list.class_date}}</td>
                      <td>
                          <span v-if="list.attendance!=null">{{list.attendance.split(",").length}}</span>
                          <span v-else>0</span>
                      </td>
                      <td>
                          count of present and absent based from status in db
                      </td>
                      <td>{{list.date_added}}</td>
                      <td><button class="btn btn-info btn-sm" @click="viewClassSchedProfileModal(list.attendance_id)"><i class="fa fa-edit"></i></button></td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="classstudents" role="tabpanel" aria-labelledby="classstudents-tab">
                  students enrolled sa class - active or hindi na status
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
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Class Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-1">
                  <h6>Class Date:</h6>
                </div>
                <div class="col-md-3">
                  <input type="date" class="form-control smallerinput" value="<?=date("Y-m-d")?>"/>
                </div>
              </div>
              <hr>
              <div class="row">
                students table tagging:
                <br/>Yung dapat mag-aappear dito, yung enrolled na meron pang remaining classes
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewClassSchedProfileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Class Schedule Students</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-3">
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Search for Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- filters -->
                </div>
                <div class="col-md-3">
                    <button type="button" @click="markAsPresent" class="btn bg-gradient-primary">Mark as Present</button>
                    <!-- <button type="button" @click="markAsAbsent" class="btn bg-gradient-warning">Mark as Absent</button> -->
                </div>
              </div>
              <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th style="width: 10px">#</th>
                    <th style="width: 10px">Present
                      <label class="container">
                        <input type="checkbox"><span class="checkmark"></span>
                      </label>
                      <br/>
                    </th>
                    <th>Student Reference ID</th>
                    <th>Names</th>
                    <th>Sex</th>
                    <!-- <th>Action</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(list,index) in classschedprofile" :value="list.student_id">
                    <td>{{index+1}}</td>
                    <td>
                      <label class="container">
                        <input type="checkbox" v-model="selectedStudents[list.student_id]"><span class="checkmark"></span>
                      </label>
                    </td>
                    <td>{{list.reference_id}}</td>
                    <td>{{list.lastname}}, {{list.firstname}} {{list.middlename}}</td>
                    <td>{{list.sex}}</td>
                    <!-- <td>
                      <span v-if="list.status" class="badge bg-success">Present</span>
                      <span v-else class="badge bg-danger">Absent</span>
                    </td> -->
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>