
<div class="row">
<input type="hidden" value="<?=$class_id?>" id="class_id"/>
<input type="hidden" value="classhistoryinfo" id="currentpage"/>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Class Schedules Held</h3>
      </div>
      <div class="card-body">
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
                <button type="button" @click="addNewAttendance" class="btn bg-gradient-primary">Add New Class Attendance</button>
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

              </td>
              <td>{{list.date_added}}</td>
              <td><button class="btn btn-info btn-sm" @click="viewClassSchedProfileModal(list.attendance_id)"><i class="fa fa-edit"></i></button></td>
              
            </tr>
          </tbody>
        </table>
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

<div class="modal" id="viewClassSchedProfileModal" tabindex="-1" role="dialog">
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