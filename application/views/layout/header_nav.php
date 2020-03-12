<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <!-- <li class="nav-item d-none d-sm-inline-block">
    <a href="index3.html" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link">Contact</a>
    </li> -->
</ul>

<ul class="navbar-nav ml-auto" id="header_nav">
    
    <!-- Messages Dropdown Menu -->
    <!-- <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge">3</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        <a href="#" class="dropdown-item">
        <div class="media">
            <img src="<?=base_url('assets/img/other_avatar.png')?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
            <h3 class="dropdown-item-title">
                Brad Diesel
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
            </h3>
            <p class="text-sm">Call me whenever you can...</p>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
        </div>
        </a>
        <div class="dropdown-divider"></div>

        <a href="#" class="dropdown-item">
        <div class="media">
            <img src="<?=base_url('assets/img/other_avatar.png')?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
            <h3 class="dropdown-item-title">
                John Pierce
                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
            </h3>
            <p class="text-sm">I got your message bro</p>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
        </div>
        </a>
        <div class="dropdown-divider"></div>

        <a href="#" class="dropdown-item">
        <div class="media">
            <img src="<?=base_url('assets/img/other_avatar.png')?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
            <h3 class="dropdown-item-title">
                Nora Silvester
                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
            </h3>
            <p class="text-sm">The subject goes here</p>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
        </div>
        </a>
        <div class="dropdown-divider"></div>

        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
    </div>
    </li> -->
    <!-- End of Messages Menu -->

    <!-- Pre-Registered Notifs -->
    <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{preregisteredlist.length}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg notification-menu dropdown-menu-right">
        <div v-if="preregisteredlist==''" class="dropdown-item">
            No existing notifications.
            <div class="dropdown-divider"></div>
        </div>
        <template v-for="(list,index) in preregisteredlist">
            <a href="#" class="dropdown-item">
                <div class="media">
                    <img src="<?=base_url('assets/img/bravehearts_logo.jpg')?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
                    <div class="media-body">
                        <h3 class="dropdown-item-title"> NEW PRE-REGISTRATION </h3>
                        <p class="text-sm">Name: {{list.lastname}}, {{list.firstname}}</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{list.timeinterval}}</p>
                        <p class="text-sm text-muted">
                            <span @click="setStatusRead(index,'view')" class="btn btn-xxs btn-info">View</span>
                            <span @click="setStatusRead(index,'setRead')" class="btn btn-xxs btn-info">Mark as Read</span>
                        </p>
                    </div>
                </div>
            </a>
            <div class="dropdown-divider"></div>
        </template>
        <a href="<?=base_url()?>walkin" class="dropdown-item dropdown-footer">See All Walk-in/Pre-Registrations</a>
    </div>
    </li>
    <!-- End of PreRegistered Menu -->

    <!-- Notifications Dropdown Menu -->
    <!-- <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
        <i class="fas fa-envelope mr-2"></i> 4 new messages
        <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
        <i class="fas fa-users mr-2"></i> 8 friend requests
        <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
        <i class="fas fa-file mr-2"></i> 3 new reports
        <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
    </li> -->
    <!-- End of Notifications Menu -->

    <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img id="editProfileImage1" v-bind:src="'data:image/jpeg;base64,'+userdata.photo" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline"><?=strtoupper(sesdata('fullname'))?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-primary">
            <img id="editProfileImage2" v-bind:src="'data:image/jpeg;base64,'+userdata.photo" class="img-circle elevation-2" alt="User Image">
            <p>
            <?=strtoupper(sesdata('fullname'))?>
            <small>Role: 
                <?php
                    if(sesdata('role')==1){ echo "System Administrator"; }
                    else if(sesdata('role')==2){ echo "Cashier"; }
                ?>
            </small>
            </p>
        </li>
        <li class="user-footer">
            <input type="hidden" id="user_id" value="<?=sesdata('id')?>"/>
            <a href="#" data-toggle="modal" data-target="#editUserProfileModal" class="btn btn-default btn-flat">View Profile</a><br>
            <a href="#" @click="changePassword()" class="btn btn-default btn-flat">Change Password</a><br>
        </li>
        </ul>
    </li>

    <li class="nav-item">
        <a href="<?= base_url('users/logout') ?>" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i> Logout
        </a>
    </li>
</ul>