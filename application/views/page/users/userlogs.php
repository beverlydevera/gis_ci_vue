<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Audit Trail</h3>
                    </div>
                    <div class="card-body">
                        <v-server-table url="<?= base_url('Users/getUserLogs') ?>" :columns="table.column" :options="table.options">
                            <template slot="date_added" slot-scope="e">
                                {{properDateFormat(e.row.date_added)}}
                            </template>
                            <template slot="log_time" slot-scope="e">
                                {{computerLogTime(e.row.date_added)}}
                            </template>
                            <!-- <template slot="age" slot-scope="e">
                            {{getAge(e.row.birthdate)}}
                            </template>
                            <template slot="status" slot-scope="e">
                            <span class="badge bg-success" v-if="e.row.status">Active</span>
                            <span class="badge bg-danger" v-else-if="e.row.status">Inactive</span>
                            </template>
                            <template slot="action" slot-scope="e">
                            <a v-bind:href="'students/profile/'+(e.row.firstname).replace(/ /g,'')+(e.row.lastname).replace(/ /g,'')+'-'+e.row.student_id" class="btn btn-primary btn-xs"><i class="fas fa-edit" style="color:#000;"></i></a>
                            </template> -->
                        </v-server-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>