<section class="content">
    <input type="hidden" value="<?=sesdata('role')?>" id="userrole"/>
    <input type="hidden" value="<?=sesdata('branch_id')?>" id="branch_id"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                <h3 class="card-title">Students</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="position-relative mb-4">
                                    <canvas id="studentschart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                <h3 class="card-title">Medals</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="position-relative mb-4">
                                    <canvas id="medalschart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Announcements</h3>
                            </div>
                            <div class="card-body">
                                <template v-if="announcementslist.length>0" v-for="(list,index) in announcementslist">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="announcement-heading">{{list.title}}</h6>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="announcement-date">{{list.date_added}}</p>
                                    </div>
                                    <div class="col-md-12 announcement-contact">
                                        <span v-bind:id="'show_announcementtext-'+list.announcement_id">{{list.text.substring(0,200)}}...</span>
                                        <span v-bind:id="'hide_announcementtext-'+list.announcement_id" style="display:none;">{{list.text}}</span>
                                        <br>
                                        <a v-if="list.text.length>200" v-bind:id="'readMore-'+list.announcement_id" @click="announcement_ReadMore(list.announcement_id)" style="color:blue;font-style:italic;">Read More</a>
                                        <a v-bind:id="'lessData-'+list.announcement_id" @click="announcement_ShowLess(list.announcement_id)" style="color:blue;font-style:italic;display:none;">Show Less</a>
                                    </div>
                                </div>
                                <hr>
                                </template>
                                <template v-else>
                                <div class="row">
                                    <div class="col-md-12">No announcements yet.</div>
                                </div>
                                </template>
                            </div>
                        </div>
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
                    <table class="table table-bordered table-responsive-sm table-sm">
                    <template v-if="otherdata.role==1">
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
                    </template>
                    <template v-else>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th v-if="otherdata.reporttype!='Classes'">Reference ID</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(list,index) in reportdata">
                                <td>{{index+1}}</td>
                                <td v-if="otherdata.reporttype!='Classes'">{{list.rdid}}</td>
                                <td>{{list.name}}</td>
                            </tr>
                        </tbody>
                    </template>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</section>