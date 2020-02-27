<div class="row">
<input type="hidden" value="<?=$class_id?>" id="class_id"/>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-4">
            <ul class="nav nav-pills">
              <a  style="border-bottom:1px solid #000; border-radius: .3em; margin-right: 2px;" href="<?= base_url('classes/') ?>" class="btn bg-gradient-primary btn-sm"><i class="fas fa-arrow-left" style="color:#fff;"></i></a>
              <li style="border-bottom:1px solid #000; border-radius: .3em; margin-right: 2px;" class="nav-item"><a class="nav-link active" id="classscheds-tab" data-toggle="tab" href="#classscheds" role="tab" aria-controls="classscheds" aria-selected="true">Class Schedules Held</a></li>
              <li style="border-bottom:1px solid #000; border-radius: .3em; margin-right: 2px;" class="nav-item"><a class="nav-link" id="classstudents-tab" data-toggle="tab" href="#classstudents" role="tab" aria-controls="classstudents" aria-selected="false">Students Enrolled</a></li>
            </ul>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-3">
            <b>Class Title:</b> <u>{{classschedinfo.class_title}}</u><br>
            <b>Branch Name:</b> <u>{{classschedinfo.branch_name}}</u>
          </div>
          <div class="col-md-3">
            <b>Schedule:</b> <u>{{classschedinfo.sched_day}} / {{classschedinfo.sched_time}}</u><br>
            <b>Current Enrolled:</b> <u>{{classstudents.length}}</u>
          </div>
        </div>
      </div>
      <div class="card-body">
          <div class="tab-content" id="">
              <div class="tab-pane fade active show" id="classscheds" role="tabpanel" aria-labelledby="classscheds-tab">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                        <div class="input-group-prepend smallerinput">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control smallerinput" placeholder="Search for Class Schedule">
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
                    <tr v-for="(list,index) in classschedsheld">
                      <td>{{index+1}}</td>
                      <td>{{changeDateFormat(list.schedule_date)}}</td>
                      <td>{{list.present + list.absent}}</td>
                      <td>{{list.present}}</td>
                      <td>{{list.absent}}</td>
                      <td>{{list.date_added}}</td>
                      <td><button class="btn btn-primary btn-xs" @click="editAttendance(list.classsched_id)"><i class="fa fa-edit"></i></button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="classstudents" role="tabpanel" aria-labelledby="classstudents-tab">
                  <div class="row">
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                        <div class="input-group-prepend smallerinput">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control smallerinput" placeholder="Search for Student Name">
                        </div>
                    </div>
                  </div>
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
                        <tr v-for="(list,index) in classstudents">
                          <td>{{index+1}}</td>
                          <td>{{list.reference_id}}</td>
                          <td>{{list.lastname}}, {{list.firstname}} {{list.middlename}}</td>
                          <td>{{list.sex}}</td>
                          <td>{{list.details.sessions-list.details.sessions_attended}}</td>
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
    </div>
  </div>
</div>

<div class="modal fade" id="addNewClassAttendanceModal" tabindex="-1" role="dialog" ref="addmodal">
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
                  <input type="date" class="form-control smallerinput" max="<?=date("Y-m-d")?>" v-model="newClassAttendance.schedule_date"/>
                </div>
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
                          </label>
                          <br/>
                        </th>
                        <th>Student Reference ID</th>
                        <th>Names</th>
                        <th>Sex</th>
                        <th>Remaining Sessions</th>
                      </tr>
                    </thead>
                    <tbody v-if="classstudents!=null">
                      <tr v-for="(list,index) in classstudents">
                        <td>{{index+1}}</td>
                        <td>
                          <label class="container">
                            <input type="checkbox" v-if="newClassAttendance.attendance[index].student_id=list.student_id" v-model="newClassAttendance.attendance[index].status"><span class="checkmark"></span>
                          </label>
                        </td>
                        <td>{{list.reference_id}}</td>
                        <td>{{list.lastname}}, {{list.firstname}} {{list.middlename}}</td>
                        <td>{{list.sex}}</td>
                        <td v-if="newClassAttendance.attendance[index].student_id=list.student_id">
                          <button v-if="newClassAttendance.attendance[index].remove" type="button" class="btn btn-danger btn-xs" @click="removefromAttendance('add',index)"><i class="fas fa-minus"></i></button>
                          <span v-else>{{list.details.sessions-list.details.sessions_attended}}</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <input type="text" class="form-control smallerinput" placeholder="Search Student" @input="searchStudent('add')" v-model="addStudent.searchInput">
                </div>
                <table class="table table-bordered table-responsive-sm table-sm">
                  <thead><tr>
                    <th>#</th>
                    <th>Student Reference ID</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Add to List</th>
                  </tr></thead>
                  <tbody v-for="(list,index) in addStudent.searchstudentslist">
                    <tr>
                      <td>{{index+1}}</td>
                      <td>{{list.reference_id}}</td>
                      <td>{{list.lastname}}, {{list.firstname}} {{list.middlename}}</td>
                      <td>{{list.sex}}</td>
                      <td><button class="btn btn-primary btn-xs" @click="addtoAttendance('add',index)">Add to Attendance List</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" @click="submitNewAttendanceInfo()" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editClassAttendanceModal" tabindex="-1" role="dialog" ref="editmodal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Edit Class Attendance</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-5">
                  <h6>Class Date:</h6>
                  <input type="date" class="form-control smallerinput" max="<?=date("Y-m-d")?>" v-model="classattendanceinfo.schedule_date"/>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-bordered table-responsive-sm table-sm">
                    <thead>                  
                      <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 10px">Attendance</th>
                        <th>Student Reference ID</th>
                        <th>Names</th>
                        <th>Sex</th>
                        <th>Remaining Sessions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(list,index) in classattendancestudents" :value="list.student_id">
                        <td>{{index+1}}</td>
                        <td v-if="classattendanceinfo.attendance[index].student_id==list.student_id">
                          <button @click="changeAttendanceStat(index)" class="btn btn-primary btn-xs" v-if="classattendanceinfo.attendance[index].status">Present</button>
                          <button @click="changeAttendanceStat(index)" class="btn btn-danger btn-xs" v-else>Absent</button>
                        </td>
                        <td>{{list.reference_id}}</td>
                        <td>{{list.lastname}}, {{list.firstname}} {{list.middlename}}</td>
                        <td>{{list.sex}}</td>
                        <td v-if="classattendanceinfo.attendance[index].student_id=list.student_id">
                          <button v-if="classattendanceinfo.attendance[index].remove" type="button" class="btn btn-danger btn-xs" @click="removefromAttendance('edit',index)"><i class="fas fa-minus"></i></button>
                          <span v-else>{{list.details.sessions-list.details.sessions_attended}}</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <input type="text" class="form-control smallerinput" placeholder="Search Student" @input="searchStudent('edit')" v-model="addStudent.searchInput">
                </div>
                <table class="table table-bordered table-responsive-sm table-sm">
                  <thead><tr>
                    <th>#</th>
                    <th>Student Reference ID</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Add to List</th>
                  </tr></thead>
                  <tbody v-for="(list,index) in addStudent.searchstudentslist">
                    <tr>
                      <td>{{index+1}}</td>
                      <td>{{list.reference_id}}</td>
                      <td>{{list.lastname}}, {{list.firstname}} {{list.middlename}}</td>
                      <td>{{list.sex}}</td>
                      <td><button class="btn btn-primary btn-xs" @click="addtoAttendance('edit',index)">Add to Attendance List</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" @click="submitAttendanceChanges()" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>