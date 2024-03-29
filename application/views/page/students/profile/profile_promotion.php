<link rel="stylesheet" href="<?= base_url('assets/css/profile_promotion.css') ?>">

<div class="container-fluid">
    <h6>PROMOTION
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addNewPromotionModal" style="float:right;">Add Promotion</button>
    </h6>
    <div class="row">
        <div class="col-md-12">
            <div class="main-timeline3">
                <template v-for="(list,index) in studentRankInfo.promotionlist">
                    <div class="timeline" @click="viewPromotionInfo(index)">
                        <a href="#" class="timeline-content">
                            <span class="year">{{list.rank_title}}</span>
                            <h3 class="title">{{list.date_promoted}}</h3>
                            <p class="description">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" v-bind:src="'data:image/jpeg;base64,'+list.photo" alt="Promotion picture">
                                </div>
                            </p>
                        </a>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewPromotionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Promote Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th width="30%">Date:</th>
                            <th><input type="date" class="form-control smallerinput" value="<?=date("Y-m-d")?>" disabled required></th>
                        </tr>
                        <tr>
                            <th width="30%">Current Rank:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="studentRankInfo.currentRank.rank_title" disabled required></th>
                        </tr>
                        <tr>
                            <th width="30%">Promote To:</th>
                            <th>
                                <select class="form-control smallerinput" v-model="studentRankInfo.newstudentPromotion.rank_id" required>
                                    <option disabled selected>Select Rank</option>
                                    <template v-for="(list,index) in rankslist">
                                        <option v-if="list.rank_id>studentRankInfo.currentRank.rank_id" :value="index">{{list.rank_title}}</option>
                                        <option v-else :value="index" disabled>{{list.rank_title}} | DISABLED</option>
                                    </template>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th width="30%">Next Promotion:</th>
                            <th>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control smallerinput" v-model="studentRankInfo.newstudentPromotion.next_rank.rank_id" required>
                                            <option disabled selected>Select Rank</option>
                                            <template v-for="(list,index) in rankslist">
                                                <option v-if="list.rank_id>studentRankInfo.currentRank.rank_id+1" :value="index">{{list.rank_title}}</option>
                                                <option v-else :value="index" disabled>{{list.rank_title}} | DISABLED</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control smallerinput" v-model="studentRankInfo.newstudentPromotion.next_rank.ses_needed" placeholder="Sessions Needed" required>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="30%">Remarks:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="studentRankInfo.newstudentPromotion.remarks"></th>
                        </tr>
                        <tr>
                            <th width="30%">Upload Photo:</th>
                            <th>
                                <input id="selectPromImage_add" type="file" @change="addPromotionImageSelect" ref="promotion_photo_add" accept="image/*">
                                <img id="addselectedImage_Promotion" src="#" alt="your image" style="display:none;" @click="changePromotionImage_add"/>
                                </th>
                        </tr>
                    </table>
                    <hr>
                    <h6>EVALUATION</h6>
                    <table class="table table-bordered table-responsive-sm table-sm">
                        <thead>
                            <tr>
                                <th style="width:3%;">#</th>
                                <th>CRITERIA</th>
                                <th>O</th>
                                <th>VG</th>
                                <th>G</th>
                                <th>S</th>
                                <th>NI</th>
                            </tr>
                        </thead>
                            <tr><td colspan=7><b>- - - TECHNIQUE - - -</b></td></tr>
                        <tbody v-for="(list,index) in evaluation_add.eval_technique">
                            <tr>
                                <td>{{index+1}}</td>
                                <td>{{list.name}}</td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'add','technique','rate_o')" :value="1" v-model="list.rate_o"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'add','technique','rate_vg')" :value="1" v-model="list.rate_vg"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'add','technique','rate_g')" :value="1" v-model="list.rate_g"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'add','technique','rate_s')" :value="1" v-model="list.rate_s"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'add','technique','rate_ni')" :value="1" v-model="list.rate_ni"></td>
                            </tr>
                        </tbody>
                            <tr><td colspan=7><b>- - - ATTITUDE - - -</b></td></tr>
                        <tbody v-for="(list,index) in evaluation_add.eval_attitude">
                            <tr>
                                <td>{{index+1}}</td>
                                <td>{{list.name}}</td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'add','attitude','rate_o')" :value="1" v-model="list.rate_o"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'add','attitude','rate_vg')" :value="1" v-model="list.rate_vg"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'add','attitude','rate_g')" :value="1" v-model="list.rate_g"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'add','attitude','rate_s')" :value="1" v-model="list.rate_s"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'add','attitude','rate_ni')" :value="1" v-model="list.rate_ni"></td>
                            </tr>
                        </tbody>
                            <tr><td colspan=7></td></tr>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Remarks</th>
                                <td colspan=5><textarea v-model="evaluation_add.eval_remarks" class="form-control"></textarea></td>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" @click="saveStudentPromotion()">Save Promotion</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editPromotionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Student Promotion Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th width="30%">Date Promoted:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="studentRankInfo.viewStudentPromotion.date_promoted" disabled></th>
                        </tr>
                        <tr>
                            <th width="30%">Promoted To:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="studentRankInfo.viewStudentPromotion.rank_title" disabled></th>
                        </tr>
                        <tr>
                            <th width="30%">Next Promotion:</th>
                            <th>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control smallerinput" v-model="studentRankInfo.viewStudentPromotion.next_rank.rank_title" disabled>
                                    </div>
                                    <div class="2">Sessions:</div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control smallerinput" v-model="studentRankInfo.viewStudentPromotion.next_rank.ses_needed" placeholder="Sessions Needed" required>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="30%">Remarks:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="studentRankInfo.viewStudentPromotion.remarks"></th>
                        </tr>
                        <tr>
                            <th width="30%">Upload Photo:</th>
                            <th>
                                <img id="editselectedImage_Promotion" @click="changePromotionImage_edit" style="width:100%;" v-bind:src="'data:image/jpeg;base64,'+studentRankInfo.viewStudentPromotion.photo" alt="Promotion picture">
                                <input type="file" id="selectPromImage_edit" accept="image/*" ref="promotion_photo_edit" @change="editPromotionImageSelect" style="display: none;">
                            </th>
                        </tr>
                    </table>
                    <hr>
                    <h6>EVALUATION</h6>
                    <table class="table table-bordered table-responsive-sm table-sm">
                        <thead>
                            <tr>
                                <th style="width:3%;">#</th>
                                <th>CRITERIA</th>
                                <th>O</th>
                                <th>VG</th>
                                <th>G</th>
                                <th>S</th>
                                <th>NI</th>
                            </tr>
                        </thead>
                            <tr><td colspan=7><b>- - - TECHNIQUE - - -</b></td></tr>
                        <tbody v-for="(list,index) in evaluation_edit.eval_technique">
                            <tr>
                                <td>{{index+1}}</td>
                                <td>{{list.name}}</td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'edit','technique','rate_o')" :value="1" v-model="list.rate_o"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'edit','technique','rate_vg')" :value="1" v-model="list.rate_vg"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'edit','technique','rate_g')" :value="1" v-model="list.rate_g"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'edit','technique','rate_s')" :value="1" v-model="list.rate_s"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'edit','technique','rate_ni')" :value="1" v-model="list.rate_ni"></td>
                            </tr>
                        </tbody>
                            <tr><td colspan=7><b>- - - ATTITUDE - - -</b></td></tr>
                        <tbody v-for="(list,index) in evaluation_edit.eval_attitude">
                            <tr>
                                <td>{{index+1}}</td>
                                <td>{{list.name}}</td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'edit','attitude','rate_o')" :value="1" v-model="list.rate_o"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'edit','attitude','rate_vg')" :value="1" v-model="list.rate_vg"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'edit','attitude','rate_g')" :value="1" v-model="list.rate_g"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'edit','attitude','rate_s')" :value="1" v-model="list.rate_s"></td>
                                <td><input type="radio" :name="list.name" @change="checked_eval(index,'edit','attitude','rate_ni')" :value="1" v-model="list.rate_ni"></td>
                            </tr>
                        </tbody>
                            <tr><td colspan=7></td></tr>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Remarks</th>
                                <td colspan=5><textarea v-model="evaluation_edit.eval_remarks" class="form-control"></textarea></td>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" @click="savePromotionChanges()">Save Changes</button>
            </div>
        </div>
    </div>
</div>