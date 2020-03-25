<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{reportsummary.students}}</h3>
                        <p>Students</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a @click="viewMoreInfo('Students')" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{reportsummary.newstudents}}</h3>
                        <p>New Students</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a @click="viewMoreInfo('Newstudents')" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{reportsummary.classes}}</h3>
                        <p>Classes for Today</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <a @click="viewMoreInfo('Classes')" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{reportsummary.awards}}</h3>
                        <p>Awards and Medals</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <a @click="viewMoreInfo('Awards')" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                        <h3 class="card-title">Enrollees</h3>
                        <a href="javascript:void(0);">View Report</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">820</span>
                            <span>Enrollees Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                            <i class="fas fa-arrow-up"></i> 12.5%
                            </span>
                            <span class="text-muted">Since last week</span>
                        </p>
                        </div>
                        <div class="position-relative mb-4">
                            <canvas id="visitors-chart" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> Abanao
                            </span>
                            <span>
                                <i class="fas fa-square text-gray"></i> Arcadian
                            </span>
                            <span>
                                <i class="fas fa-square text-success"></i> Buyagan
                            </span>
                            <span>
                                <i class="fas fa-square text-warning"></i> EGI Albergo
                            </span>
                            <span>
                                <i class="fas fa-square text-danger"></i> Itogon
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                        <h3 class="card-title">Enrollees</h3>
                        <a href="javascript:void(0);">View Report</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">880</span>
                            <span>Enrollees</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                            <i class="fas fa-arrow-up"></i> 33.1%
                            </span>
                            <span class="text-muted">Since last month</span>
                        </p>
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4">
                            <canvas id="sales-chart" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> Abanao
                            </span>
                            <span>
                                <i class="fas fa-square text-gray"></i> Arcadian
                            </span>
                            <span>
                                <i class="fas fa-square text-success"></i> Buyagan
                            </span>
                            <span>
                                <i class="fas fa-square text-warning"></i> EGI Albergo
                            </span>
                            <span>
                                <i class="fas fa-square text-danger"></i> Itogon
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Announcements</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="announcement-heading">Milo Summer Clinic 2019</h6>
                            </div>
                            <div class="col-md-4">
                                <p class="announcement-date">Jan. 20, 2019</p>
                            </div>
                            <div class="col-md-12 announcement-contact">
                                <span>Enroll now for free trial at your nearest Bravehearts Martial Arts Institute branch. 
                                    Join us in the place where champions are made. For more information...
                                </span>
                                <br><a href="">Read More</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="announcement-heading">Vision / Mission</h6>
                            </div>
                            <div class="col-md-4">
                                <p class="announcement-date">Jan. 20, 2019</p>
                            </div>
                            <div class="col-md-12 announcement-contact">
                                <label>Our Mission</label>
                                <span>
                                <br>
                                    We commit to become the leading Martial Arts Institute by providing scientific, 
                                    structured and top of the line martial arts instructions with core values of 
                                    “Discipline, Character and Excellence,” in an environment where love, camaraderie 
                                    and friendship emanates.
                                </span>
                                <br>
                                <label>Our Vision</label>
                                <span>
                                <br>
                                    We help every member of Bravehearts Martial Arts Institute experience satisfaction 
                                    and by creating in them their desire to excel making sure that every student feels 
                                    great about themselves as they quest for their personal best in an atmosphere of success 
                                    and accomplishment through our carefully selected martial arts instructions and values.
                                </span>
                                <br>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="announcement-heading">Contact Numbers</h6>
                            </div>
                            <div class="col-md-4">
                                <p class="announcement-date">Jan. 18, 2019</p>
                            </div>
                            <div class="col-md-12 announcement-contact">
                                <p class="announcement-text">
                                    <label>ABANAO SQUARE MALL</label>
                                    <br>
                                    <span>Roofdeck, Abanao Square Mall
                                    <br>Smart 0939 094 0117 / Globe 0926 733 8773
                                    </span>
                                    <br>
                                    <label>KM 5, LA TRINIDAD</label>
                                    <br>
                                    <span>Rm. 212, 2nd Floor VC Arcadian Bldg Km 5
                                    <br>Smart 0920 529 1056 / Landline: 422-8923
                                    </span>
                                    <br>
                                    <label>UCAB ITOGON BENGUET</label>
                                    <br>
                                    <span>Lower Gomok Consumer Cooperative, Ucab Itogon Benguet
                                    <br>Smart 0929 180 2642
                                    <br>
                                    </span>
                                    <label>BUYAGAN, LA TRINIDAD</label>
                                    <br>
                                    <span>AE224 Western Buyagan, Poblacion, La Trinidad Benguet
                                    <br>Smart: 0949 303 5571
                                    </span>
                                    <br>
                                    <label>ALBERGO RESIDENCES</label>
                                    <br>
                                    <span>116 Albergo Residences, 01 Ignacio Villamor St., Baguio CIty
                                    <br>Globe: 0967-211-5673 / ​Landline: 665-8193
                                    </span>
                                    <br>
                                </p>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="reportDetails_modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{otherdata.reporttype}} Report Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <template v-if="otherdata.role==1">
                    <table class="table table-bordered table-responsive-sm table-sm">
                        <thead>
                            <tr>
                                <th>Branch Name</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(list,index) in reportdata">
                                <th>{{list.branch_name}}</th>
                                <td v-if="list.count!=null">{{list.count}}</td>
                                <td v-else>0</td>
                            </tr>
                        </tbody>
                    </table>
                    </template>
                    <template v-else>
                        CASHIER
                    </template>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</section>