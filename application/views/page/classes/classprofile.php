<div class="row" id="classes_page">
<input type="hidden" value="<?=$class_id?>" id="class_id"/>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Students Masterlist</h3>
      </div>
      <div class="card-body">
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
                <button type="button" class="btn bg-gradient-primary">Mark as Present</button>
                <button type="button" class="btn bg-gradient-danger">Mark as Absent</button>
            </div>
        </div>
        <table class="table table-bordered">
          <thead>                  
            <tr>
              <th style="width: 10px">#</th>
              <th style="width: 10px"><input type="checkbox"></th>
              <th>Student Reference ID</th>
              <th>Names</th>
              <th>Sex</th>
              <!-- <th>Action</th> -->
            </tr>
          </thead>
          <tbody>
            <tr v-for="(list,index) in classschedprofile" :value="list.student_id">
              <td>{{index+1}}</td>
              <td><input type="checkbox"/></td>
              <td>{{list.student_id}}</td>
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