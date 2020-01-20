<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="basicinfo-tab" data-toggle="pill" href="#basicinfo" role="tab" aria-controls="basicinfo" aria-selected="true">Personal Information</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link disabled" id="schedulinginfo-tab" data-toggle="pill" href="#schedulinginfo" role="tab" aria-controls="schedulinginfo" aria-selected="false">Class Enrollment</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link disabled" id="billinginfo-tab" data-toggle="pill" href="#billinginfo" role="tab" aria-controls="billinginfo" aria-selected="false">Billing</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link disabled" id="payment-tab" data-toggle="pill" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Payment</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link disabled" id="complete-tab" data-toggle="pill" href="#complete" role="tab" aria-controls="complete" aria-selected="false">Complete</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade active show" id="basicinfo" role="tabpanel" aria-labelledby="basicinfo-tab">
                            <?php include('enroll/enroll_basicinfo.php');?>
                        </div>
                        <div class="tab-pane fade" id="schedulinginfo" role="tabpanel" aria-labelledby="schedulinginfo-tab">
                            <?php include('enroll/enroll_classes.php');?>
                        </div>
                        <div class="tab-pane fade" id="billinginfo" role="tabpanel" aria-labelledby="billinginfo-tab">
                            <?php include('enroll/enroll_billing.php');?>
                        </div>
                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <?php include('enroll/enroll_payment.php');?>
                        </div>
                        <div class="tab-pane fade" id="complete" role="tabpanel" aria-labelledby="complete-tab">
                            <?php include('enroll/enroll_complete.php');?>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>