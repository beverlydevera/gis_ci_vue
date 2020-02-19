<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Students Masterlist</h3>
      </div>
      <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="input-group mb-3">
                <div class="input-group-prepend smallerinput">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control smallerinput" placeholder="Search for Name">
                </div>
            </div>
            <div class="col-md-2">
              <select class="form-control smallerinput">
                  <option disabled selected>Select Sex</option>
                  <option>Male</option>
                  <option>Female</option>
              </select>
            </div>
            <div class="col-md-2">
              <select class="form-control smallerinput">
                  <option disabled selected>Select Status</option>
                  <option>Active</option>
                  <option>Inactive</option>
              </select>
            </div>
            <div class="col-md-1">
                <button class="btn btn-primary btn-xs">Filter</button>
            </div>
            <div class="col-md-4" style="text-align:right;">
              <h6>Count: 000</h6>
            </div>
        </div>
        <table class="table table-bordered table-responsive-sm table-sm">
          <thead>                  
            <tr>
              <th style="width: 10px">#</th>
              <th>Student Reference ID</th>
              <th>Names (Lastname, Firstname, Middlename)</th>
              <th>Sex</th>
              <th>Birthdate</th>
              <th>Membership</th>
              <th>Rank/Belt</th>
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
                  <span v-if="list.status">Regular</span>
                  <span v-else class="badge bg-danger">Inactive</span>
              </td>
              <td>7th Yellow</td>
              <td>
                  <a v-bind:href="'students/profile/'+(list.firstname).replace(/ /g,'')+(list.lastname).replace(/ /g,'')+'-'+list.student_id" class="btn btn-primary btn-xs"><i class="fas fa-edit" style="color:#000;"></i></a>
                  <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-archive"></i></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
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
  </div>
</div>