<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <select class="form-control select2" required v-model="newScheduleInfo.branch_id">
                    <option value=0 disabled selected>Select Branch</option>
                    <template v-for="(list,index) in brancheslist">
                        <option :value="list.branch_id">{{list.branch_name}}</option>
                    </template>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <select class="form-control select2" required v-model="newScheduleInfo.class_id">
                    <option value=0 disabled selected>Select Class</option>
                    <template v-for="(list,index) in classeslist">
                        <option :value="list.class_id">{{list.class_title}}</option>
                    </template>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <select class="form-control select2" required v-model="newScheduleInfo.sched_day">
                    <option value=0 disabled selected>Select Sched Day</option>
                    <option>Monday</option>
                    <option>Tuesday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                    <option>Friday</option>
                    <option>Saturday</option>
                    <option>Sunday</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Sched Time" v-model="newScheduleInfo.sched_time" required>
            </div>
        </div>
        <br>
        <button class="btn btn-secondary" type="button" @click="saveSchedule()">Submit Schedule</button>
    </div>
</div>