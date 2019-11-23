<nav class="mt-2" id = "navigationpanel">
  <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact" data-widget="treeview" role="menu" data-accordion="false">

    <li class="nav-item">
      <a href="<?= base_url('dashboard') ?>" class="nav-link" v-bind:class="checkactive('dashboard')">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('classes/') ?>" class="nav-link" v-bind:class="checkactive('examination/t')">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
          Classes
        </p>
      </a>
    </li>
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link " >
        <i class="nav-icon fas fa-users"></i>
        <p>
          Students
          <i class="right fas fa-angle-left"></i>
          <i class="fas fa-users-class"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?= base_url('students') ?>" class="nav-link"  v-bind:class="checkactive('office')">
            <i class="fas fa-list-alt nav-icon"></i>
            <p>Student Masterlist</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('students/enroll') ?>" class="nav-link" v-bind:class="checkactive('division')">
            <i class="fas fa-address-card nav-icon"></i>
            <p>Enroll New Student</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('cashier/index') ?>" class="nav-link">
        <i class="nav-icon fas fa-cash-register"></i>
        <p>
          Cashier
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('users/logs') ?>" class="nav-link">
        <i class="nav-icon fas fa-history"></i>
        <p>
          User Logs
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('users/logout') ?>" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>
          Logout
        </p>
      </a>
    </li>
  </ul>
</nav>