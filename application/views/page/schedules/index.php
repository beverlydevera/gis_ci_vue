<section class="content">
    <div class="container-fluid">
    <?php if(sesdata('role')==1){ ?>
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                Select Branch
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="index">Abanao Square</a>
                                <a class="dropdown-item" href="arcadian">Arcadian</a>
                                <a class="dropdown-item" href="buyagan">Buyagan</a>
                                <a class="dropdown-item" href="albergo">EGI Albergo</a>
                                <a class="dropdown-item" href="itogon">Itogon</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Gym Schedule - Abanao</h3>
                </div>
                <div class="card-body">
                    <table class="table-sched">
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
                                <td rowspan="3" class="fill-gray"><a href="<?=base_url('classes/classSchedInfo/26')?>"><span class="stroke-text">White Belts All Ages</span></a></td>
                                <td rowspan="22" class="fill-dark-gray stroke-text">Gym Closed</span></td>
                            </tr>
                            <tr> <td class="stroke-text">9:30 - 10:00</td></tr>
                            <tr> <td class="stroke-text">10:00 - 10:30</td></tr>
                            <tr>
                                <td class="stroke-text">10:30 - 11:00</td>
                                <td rowspan="3" class="fill-gray stroke-text">Open Mats</td>
                                <td rowspan="3" class="fill-light-orange"><a href="<?=base_url('classes/classSchedInfo/6')?>"><span class="stroke-text">All Levels Regular Class</span></a></td>
                                <td rowspan="3" class="fill-light-orange"><a href="<?=base_url('classes/classSchedInfo/16')?>"><span class="stroke-text">All Levels Regular Class</span></a></td>
                                <td rowspan="3" class="fill-semi-orange"><a href="<?=base_url('classes/classSchedInfo/27')?>"><span class="stroke-text">Level 1 Regular & Geardrills 10 and Below</span></a></td>
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
                                <td rowspan="3" class="fill-dark-orange"><a href="<?=base_url('classes/classSchedInfo/28')?>"><span class="stroke-text">Level 2 Regular & Geardrills 10 and Below</span></a></td>
                            </tr>
                            <tr>
                                <td class="stroke-text">12:30 - 1:00</td>
                            </tr>
                            <tr>
                                <td class="stroke-text">1:00 - 1:30</td>
                                <td rowspan="2" class="fill-green"><a href="<?=base_url('classes/classSchedInfo/7')?>"><span class="stroke-text">Mighty Cubs Level 2</span></a></td>
                                <td rowspan="2" class="fill-green"><a href="<?=base_url('classes/classSchedInfo/17')?>"><span class="stroke-text">Mighty Cubs Level 2</span></a></td>
                            </tr>
                            <tr>
                                <td class="stroke-text">1:30 - 2:00</td>
                                <td class="fill-cubs"><a href="<?=base_url('classes/classSchedInfo/1')?>"><span class="stroke-text">Mighty Cubs</span></a></td>
                                <td class="fill-cubs"><a href="<?=base_url('classes/classSchedInfo/11')?>"><span class="stroke-text">Mighty Cubs</span></a></td>
                                <td class="fill-cubs"><a href="<?=base_url('classes/classSchedInfo/21')?>"><span class="stroke-text">Mighty Cubs</span></a></td>
                                <td class="fill-gray stroke-text">Lunch Break</td>
                            </tr>
                            <tr>
                                <td class="stroke-text">2:00 - 2:30</td>
                                <td rowspan="3" class="fill-blue hoverable"><a href="<?=base_url('classes/classSchedInfo/2')?>"><span class="stroke-text">All Levels Pomsae Class</span></a></td>
                                <td rowspan="3" class="fill-semi-orange hoverable"><a href="<?=base_url('classes/classSchedInfo/8')?>"><span class="stroke-text">All Levels Regular & Geardrills</span></a></td>
                                <td rowspan="3" class="fill-yellow hoverable"><a href="<?=base_url('classes/classSchedInfo/12')?>"><span class="stroke-text">All Levels High Intensity Gears Requierd</span></a></td>
                                <td rowspan="3" class="fill-semi-orange hoverable"><a href="<?=base_url('classes/classSchedInfo/18')?>"><span class="stroke-text">All Levels Regular & Geardrills</span></a></td>
                                <td rowspan="3" class="fill-red"><a href="<?=base_url('classes/classSchedInfo/22')?>"><span class="stroke-text">All Levels Sparring Class</span></a></td>
                                <td rowspan="3" class="fill-dark-blue"><a href="<?=base_url('classes/classSchedInfo/29')?>"><span class="stroke-text">All Levels Regular & Geardrills Teen Class</span></a></td>
                            </tr>
                            <tr> <td class="stroke-text">2:30 - 3:00</td></tr>
                            <tr> <td class="stroke-text">3:00 - 3:30</td></tr>
                            <tr>
                                <td><span class="stroke-text">3:30 - 4:00</span></td>
                                <td rowspan="3" class="fill-blue"><a href="<?=base_url('classes/classSchedInfo/3')?>"><span class="stroke-text">All Levels Pomsae Class</span></a></td>
                                <td rowspan="3" class="fill-semi-orange"><a href="<?=base_url('classes/classSchedInfo/9')?>"><span class="stroke-text">All Levels Regular & Geardrills</span></a></td>
                                <td rowspan="3" class="fill-yellow"><a href="<?=base_url('classes/classSchedInfo/13')?>"><span class="stroke-text">All Levels High Intensity Gears Requierd</span></a></td>
                                <td rowspan="3" class="fill-semi-orange"><a href="<?=base_url('classes/classSchedInfo/19')?>"><span class="stroke-text">All Levels Regular & Geardrills</span></a></td>
                                <td rowspan="3" class="fill-red"><a href="<?=base_url('classes/classSchedInfo/23')?>"><span class="stroke-text">All Levels Sparring Class</span></a></td>
                                <td rowspan="3" class="fill-gray"><a href="<?=base_url('classes/classSchedInfo/30')?>"><span class="stroke-text">Lions Team Kyorugi</span></a></td>
                            </tr>
                            <tr> <td class="stroke-text">4:00 - 4:30</td></tr>
                            <tr> <td class="stroke-text">4:30 - 5:00</td></tr>
                            <tr>
                                <td class="stroke-text">5:00 - 5:30</td>
                                <td rowspan="3" class="fill-blue"><a href="<?=base_url('classes/classSchedInfo/4')?>"><span class="stroke-text">All Levels Pomsae Class</span></a></td>
                                <td rowspan="3" class="fill-semi-orange"><a href="<?=base_url('classes/classSchedInfo/10')?>"><span class="stroke-text">All Levels Regular & Geardrills</span></a></td>
                                <td rowspan="3" class="fill-yellow"><a href="<?=base_url('classes/classSchedInfo/14')?>"><span class="stroke-text">All Levels High Intensity Gears Requierd</span></a></td>
                                <td rowspan="3" class="fill-semi-orange"><a href="<?=base_url('classes/classSchedInfo/20')?>"><span class="stroke-text">All Levels Regular & Geardrills</span></a></td>
                                <td rowspan="3" class="fill-red"><a href="<?=base_url('classes/classSchedInfo/24')?>"><span class="stroke-text">All Levels Sparring Class</span></a></td>
                                <td rowspan="3" class="fill-gray"><a href="<?=base_url('classes/classSchedInfo/31')?>"><span class="stroke-text">Lions Team Pomsae</span></a></td>
                            </tr>
                            <tr> <td class="stroke-text">5:30 - 6:00</td></tr>
                            <tr> <td class="stroke-text">6:00 - 6:30</td></tr>
                            <tr>
                                <td class="stroke-text">6:30 - 7:00</td>
                                <td rowspan="2" class="fill-gray"><a href="<?=base_url('classes/classSchedInfo/5')?>"><span class="stroke-text">Active for Life</span></a></td>
                                <td></td>
                                <td rowspan="2" class="fill-gray"><a href="<?=base_url('classes/classSchedInfo/15')?>"><span class="stroke-text">Active for Life</span></a></td>
                                <td></td>
                                <td rowspan="2" class="fill-gray"><a href="<?=base_url('classes/classSchedInfo/25')?>"><span class="stroke-text">Active for Life</span></a></td>
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
    </div>
    </div>
</section>

    
