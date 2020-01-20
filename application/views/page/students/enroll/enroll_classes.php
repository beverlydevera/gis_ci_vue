<table class="table table-bordered table-responsive-sm table-sm">
    <tr>
        <th width="15%">Student Reference ID:</th>
        <th><input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentrefid" required></th>
    </tr>
    <tr>
        <th width="15%">Full Name:</th>
        <th>
            <div class="row">
                <div class="col-sm-3">
                    <input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentinfo.lastname" required>
                </div>
                <div class="col-sm-4">
                    <input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentinfo.firstname" required>
                </div>
                <div class="col-sm-3">
                    <input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentinfo.middlename">
                </div>
                <div class="col-sm-2">
                    <input type="text" :readonly="disabled_everything" class="form-control smallerinput" v-model="studentinfo.extname">
                </div>
            </div>
        </th>
    </tr>
</table>
<hr/>
<h5>Classes
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#enrollToClassModal" style="float:right;" @click="getClassScheds">Enroll to a Class</button>
</h5>
<br>
<table class="table table-bordered table-responsive-sm table-sm">
    <thead>                  
        <tr>
            <th width="3%">#</th>
            <th>Class Title</th>
            <th>Class Schedule</th>
            <th>Sessions</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(list,index) in studentclasses" :value="list.studpack_id">
            <td>{{index+1}}</td>
            <td>{{list.class_title}}</td>
            <td>{{list.sched_day}} / {{list.sched_time}}</td>
            <td>{{list.sessions}}</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" @click="deleteStudentClass(list.studpack_id)"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
    </tbody>
</table>

<div class="modal fade" id="enrollToClassModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">            
            <form @submit.prevent="enrollToClass">
                <div class="modal-header">
                    <h5 class="modal-title">Enroll to a Class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">List of Class Packages</h3>
                                </div>
                                <div class="card-body">
                                    
                                        <table class="table table-bordered table-responsive-sm table-sm">
                                        <thead>                  
                                            <tr>
                                                <th>#</th>
                                                <th>Class Title</th>
                                                <th>Class Schedule</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(list,index) in classschedlist" :value="list.class_id">
                                                <td>{{index+1}}</td>
                                                <td>{{list.class_title}}</td>
                                                <td>{{list.sched_day}} / {{list.sched_time}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Pick a Schedule</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Pick a Class Schedule</label>
                                        <select class="form-control select2" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true" v-model="classenroll.class_id" @change="getClassPackages">
                                            <option selected disabled>Select a Schedule</option>
                                            <option v-for="(list,index) in classschedlist" :value="list.class_id"> {{index+1}} &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; {{list.class_title}} &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; {{list.sched_day}} / {{list.sched_time}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Input <small>(from Available)</small> Number of Sessions</label>
                                        <select class="form-control select2" style="width: 100%;" :disabled="disabled_everything" data-select2-id="12" tabindex="-1" aria-hidden="true" v-model="classenroll.package_id" @change="checkPayment">
                                            <option selected disabled></option>
                                            <option v-for="(list,index) in classpackagelist" :value="list.package_id">{{list.sessions}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Pick Mode of Payment</label>
                                        <select class="form-control select2" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true" v-model="classenroll.payment" @change="checkPayment">
                                            <option selected disabled></option>
                                            <option value="fullPayment">Full Payment</option>
                                            <option value="staggeredPayment">Staggered Payment</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Amount to Pay <br/><small>(Input if Staggered Payment)</small></label>
                                        <input type="number" :readonly="readonly_everything" min="0" id="amountpay" class="form-control" v-model="classenroll.amounttopay">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>