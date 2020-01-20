<!-- <section class="content" id="dashboard_page">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Other Dashboard</h3>
                </div>
                <div class="card-body">
                    Graphs
                    Announcements
                    Calendar
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
</section> -->

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Students</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>
                        <p>New Students</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>Active Classes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>
                        <p>Medals</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                                <h6 class="announcement-heading">Sample Heading 1</h6>
                            </div>
                            <div class="col-md-4">
                                <p class="announcement-date">Jan. 20, 2019</p>
                            </div>
                            <div class="col-md-12">
                                <p class="announcement-text">Sample Paragraph 1 Sample Paragraph 1 Sample Paragraph 1 Sample Paragraph 1 Sample Paragraph 1 Sample Paragraph 1 Sample Paragraph 1 Sample Paragraph 1...<a href="">Read More</a></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="announcement-heading">Sample Heading 2</h6>
                            </div>
                            <div class="col-md-4">
                                <p class="announcement-date">Jan. 20, 2019</p>
                            </div>
                            <div class="col-md-12">
                                <p class="announcement-text">Sample Paragraph 2 Sample Paragraph 2 Sample Paragraph 2 Sample Paragraph 2 Sample Paragraph 2 Sample Paragraph 2 Sample Paragraph 2 Sample Paragraph 2...<a href="">Read More</a></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="announcement-heading">Sample Heading 3</h6>
                            </div>
                            <div class="col-md-4">
                                <p class="announcement-date">Jan. 18, 2019</p>
                            </div>
                            <div class="col-md-12">
                                <p class="announcement-text">Sample Paragraph 3 Sample Paragraph 3 Sample Paragraph 3 Sample Paragraph 3 Sample Paragraph 3 Sample Paragraph 3 Sample Paragraph 3 Sample Paragraph 3...<a href="">Read More</a></p>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>