<div class="row" id="students_page">
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
            <div class="col-md-9">
                <!-- filters -->
            </div>
        </div>
        <table class="table table-bordered">
          <thead>                  
            <tr>
              <th style="width: 10px">#</th>
              <th>Student Reference ID</th>
              <th>Names</th>
              <th>Sex</th>
              <th>Birthdate</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(list,index) in studentslist" :value="list.student_id">
              <td>{{index+1}}</td>
              <td>{{list.reference_id}}</td>
              <td>{{list.lastname}}, {{list.firstname}} {{list.middlename}}</td>
              <td>{{list.sex}}</td>
              <td>{{list.birthdate}}</td>
              <td>
                  <a v-bind:href="'students/profile/'+(list.firstname).replace(/ /g,'')+(list.lastname).replace(/ /g,'')+'-'+list.student_id" class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></a>
                  <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-archive"></i></i></button>
              </td>
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