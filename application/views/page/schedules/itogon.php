<section class="content">
    <div class="container-fluid">
    <!-- <div class="row">
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
    </div> -->
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
                <h3 class="card-title">Gym Schedule - Itogon</h3>
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
                                    Staff Meeting and Training (Main Gym)
                                </td>
                                <td rowspan="19" class="fill-dark-gray stroke-text">Gym Closed</span></td>
                                <td></td>
                                <td rowspan="19" class="fill-dark-gray stroke-text">Gym Closed</span></td>
                                <td></td>
                                <td></td>
                                <td rowspan="29" class="fill-dark-gray stroke-text">Gym Closed</span></td>
                            </tr>
                            <tr>
                                <td class="stroke-text">9:30 - 10:00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr> 
                                <td class="stroke-text">10:00 - 10:30</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="stroke-text">10:30 - 11:00</td>
                                <td rowspan="16" class="fill-dark-gray stroke-text">Gym Closed</span></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr> 
                                <td class="stroke-text">11:00 - 11:30</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr> 
                                <td class="stroke-text">11:30 - 12:00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="stroke-text">12:00 - 12:30</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="stroke-text">12:30 - 1:00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="stroke-text">1:00 - 1:30</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="stroke-text">1:30 - 2:00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="stroke-text">2:00 - 2:30</td>
                                <td rowspan="3" class="fill-yellow"><a href="<?=base_url('classes/classSchedInfo/132')?>"><span class="stroke-text">White Belts All Ages</span></a></td>
                                <td rowspan="3" class="fill-yellow"><a href="<?=base_url('classes/classSchedInfo/133')?>"><span class="stroke-text">White Belts All Ages</span></a></td>
                                <td rowspan="3" class="fill-yellow"><a href="<?=base_url('classes/classSchedInfo/134')?>"><span class="stroke-text">White Belts All Ages</span></a></td>
                            </tr>
                            <tr> 
                                <td class="stroke-text">2:30 - 3:00</td>
                               
                            </tr>
                            <tr> <td class="stroke-text">3:00 - 3:30</td></tr>
                            <tr>
                                <td><span class="stroke-text">3:30 - 4:00</span></td>
                                <td rowspan="3" class="fill-semi-orange"><a href="<?=base_url('classes/classSchedInfo/135')?>"><span class="stroke-text">All Levels Regular Class</span></a></td>
                                <td rowspan="3" class="fill-semi-orange"><a href="<?=base_url('classes/classSchedInfo/136')?>"><span class="stroke-text">All Levels Regular Class</span></a></td>
                                <td rowspan="3" class="fill-semi-orange"><a href="<?=base_url('classes/classSchedInfo/137')?>"><span class="stroke-text">All Levels Regular Class</span></a></td>
                            
                            </tr>
                            <tr> <td class="stroke-text">4:00 - 4:30</td></tr>
                            <tr> <td class="stroke-text">4:30 - 5:00</td></tr>
                            <tr>
                                <td class="stroke-text">5:00 - 5:30</td>
                                <td rowspan="3" class="fill-dark-orange"><a href="<?=base_url('classes/classSchedInfo/138')?>"><span class="stroke-text">All Levels Regular Class</span></a></td>
                             
                                <td rowspan="3" class="fill-red"><a href="<?=base_url('classes/classSchedInfo/139')?>"><span class="stroke-text">All Levels Sparring Class</span></a></td>
                                <td rowspan="3" class="fill-red"><a href="<?=base_url('classes/classSchedInfo/140')?>"><span class="stroke-text">All Levels Sparring Class</span></a></td>
                            
                            </tr>
                            <tr> <td class="stroke-text">5:30 - 6:00</td></tr>
                            <tr> <td class="stroke-text">6:00 - 6:30</td></tr>
                            <tr>
                                <td class="stroke-text">6:30 - 7:00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="stroke-text">7:00 - 7:30</td>
                                <td></td>
                                <td></td>
                                <td></td>
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

    
