<style>
    h6{
        font-weight: bold;
        text-decoration: underline;
    }

    .smallerinput {
        font-size: 10pt !important;
        height: 20pt !important;
        padding: 0 0 0 3%;
        color: blue;
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 0.5rem !important;
    }

    table{
        margin-bottom: 0 !important;
    }

    .requiredspan {
        color: red;
    }
    
    th, td{
        padding: 1% !important;
        /* vertical-align: middle; */
    }

    hr{
        border: 1px dotted #000 !important;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="personalinfo-tab" data-toggle="pill" href="#personalinfo" role="tab" aria-controls="personalinfo" aria-selected="true">Personal Information</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link disabled" id="schedulinginfo-tab" data-toggle="pill" href="#schedulinginfo" role="tab" aria-controls="schedulinginfo" aria-selected="false">Scheduling</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link disabled" id="billinginfo-tab" data-toggle="pill" href="#billinginfo" role="tab" aria-controls="billinginfo" aria-selected="false">Billing</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link disabled" id="completeinfo-tab" data-toggle="pill" href="#completeinfo" role="tab" aria-controls="completeinfo" aria-selected="false">Complete</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade active show" id="personalinfo" role="tabpanel" aria-labelledby="personalinfo-tab">
                            <form @submit.prevent="saveNewStudentRegistration">
                                <h6>BASIC INFORMATION</h6>
                                <div class="form-group row">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="15%"><span class="requiredspan">*</span>Full Name:</th>
                                            <th colspan=3>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control smallerinput" placeholder="Last Name" v-model="studentinfo.lastname" required>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control smallerinput" placeholder="First Name" v-model="studentinfo.firstname" required>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control smallerinput" placeholder="Middle Name" v-model="studentinfo.middlename">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control smallerinput" placeholder="Ext Name" v-model="studentinfo.extname">
                                                    </div>
                                                </div>
                                            </th>
                                            <th width="15%">Nickname:</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="studentinfo.nickname"></th>
                                        </tr>
                                        <tr>
                                            <th width="15%"><span class="requiredspan">*</span>Home Address:</th>
                                            <th colspan=5>
                                                <input type="text" class="form-control smallerinput" v-model="studentinfo.address" required>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th width="15%"><span class="requiredspan">*</span>Cellphone Number:</th>
                                            <th><input type="text" class="form-control smallerinput" placeholder="(09)xx-xxxx-xxx" v-model="studentinfo.mobileno" required></th>
                                            <th width="15%">Telephone Number:</th>
                                            <th><input type="text" class="form-control smallerinput" placeholder="(09)xx-xxxx-xxx" v-model="studentinfo.telephoneno"></th>
                                            <th width="15%"><span class="requiredspan">*</span>Email Address:</th>
                                            <th><input type="email" class="form-control smallerinput" placeholder="abc@email.com" v-model="studentinfo.emailadd" required></th>
                                        </tr>
                                        <tr>
                                            <th width="15%"><span class="requiredspan">*</span>Date of Birth:</th>
                                            <th>
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <input type="date" class="form-control datepicker smallerinput" v-model="studentinfo.birthdate" @change="calculate_age()" required>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="number" class="form-control smallerinput" v-model="derivedinfo.studentage" disabled>
                                                    </div>
                                                </div>
                                            </th>
                                            <th width="15%">Religion:</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="studentinfo.religion"></th>
                                            <th width="15%"><span class="requiredspan">*</span>Sex:</th>
                                            <th>
                                                <select class="form-control select2 smallerinput" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true" v-model="studentinfo.sex">
                                                    <option selected disabled></option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th width="15%"><span class="requiredspan">*</span>Height (m):</th>
                                            <th ><input type="number" class="form-control smallerinput" v-model="studentinfo.height" required step="any"></th>
                                            <th width="15%"><span class="requiredspan">*</span>Weight (kg):</th>
                                            <th ><input type="number" class="form-control smallerinput" v-model="studentinfo.weight" required step="any"></th>
                                            <!-- <th width="15%"><span class="requiredspan">*</span>Insurance:</th>
                                            <th>
                                                <div class="row">
                                                    <div class="col-sm-2"></div>
                                                    <div class="col-sm-5">
                                                        <input type="radio" class="form-check-input" :value="1" v-model="studentinfo.insurance" required>
                                                        <label class="form-check-label" for="">Yes</label>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input type="radio" class="form-check-input" :value="0" v-model="studentinfo.insurance" required>
                                                        <label class="form-check-label" for="">No</label>
                                                    </div>
                                                </div>
                                            </th> -->
                                            
                                        </tr>
                                    </table>
                                </div>
                                <hr/>
                                <h6>EDUCATION INFORMATION</h6>
                                <div class="form-group row">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="15%"><span class="requiredspan">*</span>Name of School:</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.schoolname" required></th>
                                            <th width="15%">Year / Grade:</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.schoolyear"></th>
                                            <th width="15%">School Course</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.schoolcourse"></th>
                                        </tr>
                                    </table>
                                </div>
                                <hr/>
                                <h6>WORK INFORMATION <small><i>(if working)</i></small></h6>
                                <div class="form-group row">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="15%">Name of Company:</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.companyname"></th>
                                            <th width="15%">Company Address:</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.companyaddress"></th>
                                        </tr>
                                    </table>
                                </div>
                                <hr/>
                                <h6>PARENTS / GUARDIAN INFORMATION</h6>
                                <div class="form-group row">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="15%"></th>
                                            <th width="15%"><span class="requiredspan">*</span>Father</th>
                                            <th width="15%"><span class="requiredspan">*</span>Mother</th>
                                            <th width="15%">Guardian <small><i>(if any)</i></small></th>
                                        </tr>
                                        <tr>
                                            <th width="15%"><span class="requiredspan">*</span>Name:</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.father_name" required></th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.mother_name" required></th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.guardian_name"></th>
                                        </tr>
                                        <tr>
                                            <th width="15%"><span class="requiredspan">*</span>Occupation:</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.father_occupation" required></th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.mother_occupation" required></th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.guardian_occupation"></th>
                                        </tr>
                                        <tr>
                                            <th width="15%"><span class="requiredspan">*</span>Office Address:</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.father_officeadd" required></th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.mother_officeadd" required></th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.guardian_officeadd"></th>
                                        </tr>
                                        <tr>
                                            <th width="15%"><span class="requiredspan">*</span>Contact No:</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.father_contactno" required></th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.mother_contactno" required></th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.guardian_contactno"></th>
                                        </tr>
                                    </table>
                                </div>
                                <hr/>
                                <h6>EMERGENCY CONTACT INFORMATION <small><i>(Person to contact in case of emergency)</i></small></h6>
                                <div class="form-group row">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="15%"><span class="requiredspan">*</span>Name:</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.emergency_name" required></th>
                                            <th width="15%"><span class="requiredspan">*</span>Relationship</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.emergency_relationship" required></th>
                                        </tr>
                                        <tr>
                                            <th width="15%"><span class="requiredspan">*</span>Address:</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.emergency_address" required></th>
                                            <th width="15%"><span class="requiredspan">*</span>Contact Number:</th>
                                            <th><input type="text" class="form-control smallerinput" v-model="derivedinfo.emergency_mobilenum" required></th>
                                        </tr>
                                    </table>
                                </div>
                                <hr>
                                <h6>OTHER INFORMATION</h6>
                                <div class="form-group row">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="25%">Do you have health problems or physical conditions we should know about that may affect yout training?</th>
                                            <th colspan=2><textarea class="form-control smallerinput" style="min-height: 80px;" v-model="studentinfo.healthproblems"></textarea></th>
                                        </tr>
                                        <tr>
                                            <th width="25%">Have you had any previous martial arts training?</th>
                                            <th width="6%">
                                                <div class="row">
                                                    <div class="col-sm-2"></div>
                                                    <div class="col-sm-1">
                                                        <input type="radio" class="form-check-input" :value="1" v-model="derivedinfo.prevtrain" required>
                                                        <label class="form-check-label" for="">Yes</label>
                                                        <br/>
                                                        <input type="radio" class="form-check-input" :value="0" v-model="derivedinfo.prevtrain" required>
                                                        <label class="form-check-label" for="">No</label>
                                                    </div>
                                                </div>
                                            </th>
                                            <th>
                                                <textarea class="form-control smallerinput" placeholder="If yes, please state the style and degree achieved." style="min-height: 50px;" v-model="derivedinfo.prevtrain_details"></textarea>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                            <th colspan="2">
                                                <div class="checkbox">
                                                    <label><input type="checkbox" required> <a href="#modal">Parent's Consent</a></label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" required> <a href="#modal">Certification and Waiver</a></label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" required> I have read and understood the <a href="#modal">Agreement.</a></label>
                                                </div>
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                                <hr>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" style="width: 20%;">Submit Application Form</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="schedulinginfo" role="tabpanel" aria-labelledby="schedulinginfo-tab">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Student Reference ID: </label>
                                <div class="col-sm-10">
                                    <input type="hidden" v-model="studentinfo.student_id">
                                    <input type="text" class="form-control smallerinput" :disabled="disabled_everything" :readonly = "disabled_everything" name="apprefcode" style="font-weight: 500" value="1" v-model="studentinfo.reference_id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Student Full Name: </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control smallerinput" :disabled="disabled_everything" :readonly = "disabled_everything" placeholder="Last Name" v-model="studentinfo.lastname" required>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control smallerinput" :disabled="disabled_everything" :readonly = "disabled_everything" placeholder="First Name" v-model="studentinfo.firstname" required>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control smallerinput" :disabled="disabled_everything" :readonly = "disabled_everything" placeholder="Middle Name" v-model="studentinfo.middlename">
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control smallerinput" :disabled="disabled_everything" :readonly = "disabled_everything" placeholder="Ext Name" v-model="studentinfo.extname">
                                </div>
                            </div>
                            <hr>
                            Adding to Class here
                        </div>
                        <div class="tab-pane fade" id="billinginfo" role="tabpanel" aria-labelledby="billinginfo-tab">
                            Computation of payment here
                        </div>
                        <div class="tab-pane fade" id="completeinfo" role="tabpanel" aria-labelledby="completeinfo-tab">
                            Printing of Form and Receipt
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>