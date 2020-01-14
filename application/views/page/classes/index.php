<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Classes</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <v-server-table url="<?= base_url('Classes/getClassScheds') ?>" :columns="table.column" :options="table.options">
                                    <template slot="sched_day" slot-scope="e">
                                        {{e.row.sched_day}} / {{e.row.sched_time}}
                                    </template>
                                    <template slot="enrolled" slot-scope="e">
                                        000
                                    </template>
                                    <template slot="status" slot-scope="e">
                                        <span v-if="e.row.status" class="badge bg-success">Active</span>
                                        <span v-else class="badge bg-danger">Inactive</span>
                                    </template>
                                    <template slot="action" slot-scope="e">
                                        <!-- <button class="btn btn-info btn-sm" @click="viewApplicantModal(1,e.row.app_id)"><i class="fa fa-eye "></i></button> -->
                                        <a v-bind:href="'classHistoryInfo/'+e.row.schedule_id" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></a>
                                    </template>
                                </v-server-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>