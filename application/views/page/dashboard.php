<style>
    /* line 2042, ../sass/_stilo.scss */
    .stroke-text {
    color: white;
    text-shadow: -1px -1px 0 #000,   1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
    font-weight: 800;
    }
    
    .stroke-text{
    color: white;
    text-shadow:
    -1px -1px 0 #000,  
    1px -1px 0 #000,
    -1px 1px 0 #000,
    1px 1px 0 #000;
    font-weight: 800;
    }

    /* line 2053, ../sass/_stilo.scss */
    .fill-yellow {
    background-image: linear-gradient(to bottom, #fbe295, #fccc38);
    }

    /* line 2057, ../sass/_stilo.scss */
    .fill-blue {
    background-image: linear-gradient(to bottom, #e7f3fd, #bdd7ee);
    }

    /* line 2061, ../sass/_stilo.scss */
    .fill-red {
    background-image: linear-gradient(to bottom, #f66160, #f13533);
    }

    /* line 2065, ../sass/_stilo.scss */
    .fill-light-orange {
    background-image: linear-gradient(to bottom, #fdddc8, #efb894);
    }

    /* line 2069, ../sass/_stilo.scss */
    .fill-cubs {
    background-image: linear-gradient(to bottom, #dbe2d5, #b7c3ae);
    }

    /* line 2073, ../sass/_stilo.scss */
    .fill-gray {
    background-image: linear-gradient(to bottom, #ffffff, #cacaca);
    }

    /* line 2077, ../sass/_stilo.scss */
    .fill-green {
    background-image: linear-gradient(to bottom, #39dc7f, #00b34d);
    }

    /* line 2081, ../sass/_stilo.scss */
    .fill-semi-orange {
    background-image: linear-gradient(to bottom, #d69e7a, #c8865c);
    }

    /* line 2085, ../sass/_stilo.scss */
    .fill-dark-orange {
    background-image: linear-gradient(to bottom, #d26d33, #bd5215);
    }

    /* line 2089, ../sass/_stilo.scss */
    .fill-dark-blue {
    background-image: linear-gradient(to bottom, #405c86, #1e3a63);
    }

    /* line 2093, ../sass/_stilo.scss */
    .fill-dark-gray {
    background-image: linear-gradient(to bottom, #a2a4a8, #515254);
    }

    /* line 2098, ../sass/_stilo.scss */
    .table-sched a {
    display: block;
    height: 100%;
    width: 100%;
    padding: 10px 10px 60px 10px;
    /*table default padding except on bottom 500px for example*/
    margin-bottom: -50px;
    }

    .fill-yellow{
    background-image: linear-gradient(to bottom, #fbe295 , #fccc38);
    }

    .fill-blue{
    background-image: linear-gradient(to bottom, #e7f3fd , #bdd7ee);
    }

    .fill-red{
    background-image: linear-gradient(to bottom, #f66160 , #f13533);
    }

    .fill-light-orange{
    background-image: linear-gradient(to bottom, #fdddc8 , #efb894);
    }

    .fill-cubs{
    background-image: linear-gradient(to bottom, #dbe2d5 , #b7c3ae);
    }

    .fill-gray{
    background-image: linear-gradient(to bottom, #ffffff , #cacaca);
    }

    .fill-green{
    background-image: linear-gradient(to bottom, #39dc7f , #00b34d);
    }

    .fill-semi-orange{
    background-image: linear-gradient(to bottom, #d69e7a , #c8865c);
    }

    .fill-dark-orange{
    background-image: linear-gradient(to bottom, #d26d33 , #bd5215);
    }

    .fill-dark-blue{
    background-image: linear-gradient(to bottom, #405c86 , #1e3a63);
    }

    .fill-dark-gray{
    background-image: linear-gradient(to bottom, #a2a4a8 , #515254);
    }

    .table-sched{
        a{
            display: block;
            height: 100%;        
            width: 100%;
            padding: 10px 10px 60px 10px; /*table default padding except on bottom 500px for example*/
            margin-bottom: -50px;
        }
    }

    th, td{
    text-align: center;
    vertical-align: middle !important;
    padding: 0.25% !important;
    border: 2px solid #000 !important;
    }

    .header-style{
    background-color: #0800ff;
    }

    .emphasize-border {
    -webkit-box-shadow: inset 0px 0px 16px 2px rgba(48,48,48,48.75);
    -moz-box-shadow: inset 0px 0px 16px 2px rgba(48,48,48,48.75);
    box-shadow: inset 0px 0px 16px 2px rgba(48,48,48,48.75);
    }

    /* .comment:after {
        content: "";
        position: relative;
        top: 0.5em;
        border-left: 0.5em solid transparent;
        border-top: 0.5em solid red;
    } */
    
</style>
<section class="content" id="dashboard_page">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Gym Schedule</h3>
                </div>
                <div class="card-body">
                    <table class="">
                        <thead>                  
                            <tr>
                                <th width="13%" class="stroke-text header-style">TIME</th>
                                <th width="12%" class="stroke-text header-style">MONDAY</th>
                                <th width="12%" class="stroke-text header-style">TUESDAY</th>
                                <th width="12%" class="stroke-text header-style">WEDNESDAY</th>
                                <th width="12%" class="stroke-text header-style">THURSDAY</th>
                                <th width="12%" class="stroke-text header-style">FRIDAY</th>
                                <th width="12%" class="stroke-text header-style">SATURDAY</th>
                                <th width="12%" class="stroke-text header-style">SUNDAY</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="stroke-text">9:00 - 9:30</td>
                                <td rowspan="3" class="fill-gray stroke-text">
                                    Staff Meeting and Training
                                </td>
                                <td rowspan="3" class="fill-gray stroke-text">Open Mats</td>
                                <td rowspan="6" class="fill-gray stroke-text">Open Mats</td>
                                <td rowspan="3" class="fill-gray stroke-text">Open Mats</td>
                                <td rowspan="6" class="fill-gray stroke-text">Open Mats</td>
                                <td rowspan="3" class="fill-gray emphasize-border"><a href="class_schedule.php"><span class="stroke-text">White Belts All Ages</span></a></td>
                                <td rowspan="22" class="fill-dark-gray stroke-text">Gym Closed</span></td>
                            </tr>
                            <tr> <td class="stroke-text">9:30 - 10:00</td></tr>
                            <tr> <td class="stroke-text">10:00 - 10:30</td></tr>
                            <tr>
                                <td class="stroke-text">10:30 - 11:00</td>
                                <td rowspan="3" class="fill-gray stroke-text">Open Mats</td>
                                <td rowspan="3" class="fill-light-orange emphasize-border"><a href="<?=base_url('classes/classSchedInfo/AllLevelsRegularClass-1')?>"><span class="stroke-text">All Levels Regular Class</span></a></td>
                                <td rowspan="3" class="fill-light-orange emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels Regular Class</span></a></td>
                                <td rowspan="3" class="fill-semi-orange emphasize-border"><a href="class_schedule.php"><span class="stroke-text">Level 1 Regular & Geardrills 10 and Below</span></a></td>
                            </tr>
                            <tr> <td class="stroke-text">11:00 - 11:30</td></tr>
                            <tr> <td class="stroke-text">11:30 - 12:00</td></tr>
                            <tr>
                                <td class="stroke-text">12:00 - 12:30</td>
                                <td rowspan="3" class="fill-gray stroke-text">Lunch Break</td>
                                <td rowspan="2" class="fill-gray stroke-text">Lunch Break</td>
                                <td rowspan="3" class="fill-gray stroke-text">Lunch Break</td>
                                <td rowspan="2" class="fill-gray stroke-text">Lunch Break</td>
                                <td rowspan="3" class="fill-gray stroke-text">Lunch Break</td>
                                <td rowspan="3" class="fill-dark-orange emphasize-border"><a href="class_schedule.php"><span class="stroke-text">Level 2 Regular & Geardrills 10 and Below</span></a></td>
                            </tr>
                            <tr>
                                <td class="stroke-text">12:30 - 1:00</td>
                            </tr>
                            <tr>
                                <td class="stroke-text">1:00 - 1:30</td>
                                <td rowspan="2" class="fill-green emphasize-border"><a href="class_schedule.php"><span class="stroke-text">Mighty Cubs Level 2</span></a></td>
                                <td rowspan="2" class="fill-green emphasize-border"><a href="class_schedule.php"><span class="stroke-text">Mighty Cubs Level 2</span></a></td>
                            </tr>
                            <tr>
                                <td class="stroke-text">1:30 - 2:00</td>
                                <td class="fill-cubs emphasize-border"><a href="class_schedule.php"><span class="stroke-text">Mighty Cubs</span></a></td>
                                <td class="fill-cubs emphasize-border"><a href="class_schedule.php"><span class="stroke-text">Mighty Cubs</span></a></td>
                                <td class="fill-cubs emphasize-border"><a href="class_schedule.php"><span class="stroke-text">Mighty Cubs</span></a></td>
                                <td class="fill-gray stroke-text">Lunch Break</td>
                            </tr>
                            <tr>
                                <td class="stroke-text">2:00 - 2:30</td>
                                <td rowspan="3" class="fill-blue emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels Pomsae Class</span></a></td>
                                <td rowspan="3" class="fill-semi-orange emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels Regular & Geardrills</span></a></td>
                                <td rowspan="3" class="fill-yellow emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels High Intensity Gears Requierd</span></a></td>
                                <td rowspan="3" class="fill-semi-orange emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels Regular & Geardrills</span></a></td>
                                <td rowspan="3" class="fill-red emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels Sparring Class</span></a></td>
                                <td rowspan="3" class="fill-dark-blue emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels Regular & Geardrills Teen Class</span></a></td>
                            </tr>
                            <tr> <td class="stroke-text">2:30 - 3:00</td></tr>
                            <tr> <td class="stroke-text">3:00 - 3:30</td></tr>
                            <tr>
                                <td><span class="stroke-text">3:30 - 4:00</span></td>
                                <td rowspan="3" class="fill-blue emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels Pomsae Class</span></a></td>
                                <td rowspan="3" class="fill-semi-orange emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels Regular & Geardrills</span></a></td>
                                <td rowspan="3" class="fill-yellow emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels High Intensity Gears Requierd</span></a></td>
                                <td rowspan="3" class="fill-semi-orange emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels Regular & Geardrills</span></a></td>
                                <td rowspan="3" class="fill-red emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels Sparring Class</span></a></td>
                                <td rowspan="3" class="fill-gray emphasize-border"><a href="class_schedule.php"><span class="stroke-text">Lions Team Kyorugi</span></a></td>
                            </tr>
                            <tr> <td class="stroke-text">4:00 - 4:30</td></tr>
                            <tr> <td class="stroke-text">4:30 - 5:00</td></tr>
                            <tr>
                                <td class="stroke-text">5:00 - 5:30</td>
                                <td rowspan="3" class="fill-blue emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels Pomsae Class</span></a></td>
                                <td rowspan="3" class="fill-semi-orange emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels Regular & Geardrills</span></a></td>
                                <td rowspan="3" class="fill-yellow emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels High Intensity Gears Requierd</span></a></td>
                                <td rowspan="3" class="fill-semi-orange emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels Regular & Geardrills</span></a></td>
                                <td rowspan="3" class="fill-red emphasize-border"><a href="class_schedule.php"><span class="stroke-text">All Levels Sparring Class</span></a></td>
                                <td rowspan="3" class="fill-gray emphasize-border"><a href="class_schedule.php"><span class="stroke-text">Lions Team Pomsae</span></a></td>
                            </tr>
                            <tr> <td class="stroke-text">5:30 - 6:00</td></tr>
                            <tr> <td class="stroke-text">6:00 - 6:30</td></tr>
                            <tr>
                                <td class="stroke-text">6:30 - 7:00</td>
                                <td rowspan="2" class="fill-gray emphasize-border"><a href="class_schedule.php"><span class="stroke-text">Active for Life</span></a></td>
                                <td></td>
                                <td rowspan="2" class="fill-gray emphasize-border"><a href="class_schedule.php"><span class="stroke-text">Active for Life</span></a></td>
                                <td></td>
                                <td rowspan="2" class="fill-gray emphasize-border"><a href="class_schedule.php"><span class="stroke-text">Active for Life</span></a></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="stroke-text">7:00 - 7:30</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="stroke-text">7:30 - 8:00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Announcements</h3>
                </div>
                <div class="card-body">
                    <div class="post">
                        Sample text 1
                    </div>
                    <div class="post">
                        Sample text 2
                    </div>
                </div>
            </div>

            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Active Students</span>
                    <span class="info-box-number">300</span>
                </div>
            </div>
            
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="nav-icon fas fa-tasks"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Active Classes</span>
                    <span class="info-box-number">10</span>
                </div>
            </div>

            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-address-card nav-icon"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">New Enrollees</span>
                    <span class="info-box-number">5</span>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>