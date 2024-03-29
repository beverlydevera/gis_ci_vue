<h6>COMPETITIONS JOINED
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addNewCompetitionModal" style="float:right;">Add New Competition</button>
</h6>
<br>
<div class="row">
    <div class="col-md-3">
        <div class="input-group mb-3">
        <div class="input-group-prepend smallerinput">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
        <input type="text" class="form-control smallerinput" placeholder="Search Competitions" v-model="filterdetails.competitions_search" @input="searchTable('competitions')">
        </div>
    </div>
</div>

<table class="table table-bordered table-responsive-sm table-sm">
    <thead>
        <tr>
            <th width="3%">#</th>
            <th>Date</th>
            <th>Competition Title</th>
            <th>Competition Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody v-for="(list,index) in competitionslist">
        <tr>
            <td>{{index+1}}</td>
            <td>{{list.comp_date}}</td>
            <td>{{list.comp_title}}</td>
            <td>{{list.comp_type}}</td>
            <td>
                <button type="button" class="btn btn-primary btn-xs" @click="getCompetitionDetails(list.studcomp_id,index)"><i class="fas fa-edit"></i></button>
            </td>
        </tr>
    </tbody>
</table>

<div class="modal fade" id="addNewCompetitionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Competition Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th width="30%">Competition Title:</th>
                            <th><input type="text" v-model="newstudentCompetition.comp_title" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="30%">Competition Type:</th>
                            <th><input type="text" v-model="newstudentCompetition.comp_type" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="30%">Competition Date:</th>
                            <th><input type="date" v-model="newstudentCompetition.comp_date" class="form-control smallerinput" required max="<?=date("Y-m-d")?>"></th>
                        </tr>
                        <tr>
                            <th width="30%">Competition Venue:</th>
                            <th><input type="text" v-model="newstudentCompetition.comp_venue" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="30%">Awards Received:</th>
                            <th>
                                <div class="row" v-for="(list,index) in newstudentCompetition.comp_awards">
                                    <div class="col-md-11">
                                        <input type="text" v-model="list.award_name" class="form-control smallerinput">
                                    </div>
                                    <div class="col-md-1" style="padding:0;">
                                        <button v-if="index==0" type="button" class="btn btn-primary btn-xs" @click="addAward_item('add')"><i class="fas fa-plus"></i></button>
                                        <button v-else-if="index>0" type="button" class="btn btn-danger btn-xs" @click="cancelAward_item('add',index)"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="30%">Remarks:</th>
                            <th><input type="text" v-model="newstudentCompetition.remarks" class="form-control smallerinput"></th>
                        </tr>
                        <tr>
                            <th width="30%">Upload Photos:</th>
                            <th>
                                <input id="selectCompImage_add" type="file" @change="addCompetitionImageSelect" ref="competition_photo_add" accept="image/*">
                                <img id="addselectedImage_Competition" src="#" alt="your image" style="display:none;" @click="changeCompetitionImage_add"/>
                            </th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" @click="submitNewStudentCompetition()">Save competition</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editCompetitionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Competition Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th width="30%">Competition Title:</th>
                            <th><input type="text" v-model="competitionDetails.comp_title" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="30%">Competition Type:</th>
                            <th><input type="text" v-model="competitionDetails.comp_type" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="30%">Competition Date:</th>
                            <th><input type="date" v-model="competitionDetails.comp_date" class="form-control smallerinput" required max="<?=date("Y-m-d")?>"></th>
                        </tr>
                        <tr>
                            <th width="30%">Competition Venue:</th>
                            <th><input type="text" v-model="competitionDetails.comp_venue" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="30%">Awards Received:</th>
                            <th>
                                <div class="row" v-for="(list,index) in competitionDetails.comp_awards">
                                    <div class="col-md-11">
                                        <input type="text" v-model="list.award_name" class="form-control smallerinput">
                                    </div>
                                    <div class="col-md-1" style="padding:0;">
                                        <button v-if="index==0" type="button" class="btn btn-primary btn-xs" @click="addAward_item('edit')"><i class="fas fa-plus"></i></button>
                                        <button v-else-if="index>0" type="button" class="btn btn-danger btn-xs" @click="cancelAward_item('edit',index)"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="30%">Remarks:</th>
                            <th><input type="text" v-model="competitionDetails.remarks" class="form-control smallerinput"></th>
                        </tr>
                        <tr>
                            <th width="30%">Upload Photos:</th>
                            <th>
                                <img id="editselectedImage_Competition" @click="changeCompetitionImage_edit" style="width:100%;" v-bind:src="'data:image/jpeg;base64,'+competitionDetails.photos" alt="Competition picture">
                                <input type="file" id="selectCompImage_edit" accept="image/*" ref="competition_photo_edit" @change="editCompetitionImageSelect" style="display: none;">
                            </th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" @click="submitCompetitionDataChanges()">Save competition</button>
            </div>
        </div>
    </div>
</div>