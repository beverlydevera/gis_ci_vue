<style>
.nav-treeview{
  margin-left:10%;
}
</style>
<nav class="mt-2" id = "navigationpanel">
  <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact" data-widget="treeview" role="menu" data-accordion="false">

    <li class="nav-item">
      <a href="<?= base_url('dashboard') ?>" class="nav-link" v-bind:class="checkactive('dashboard')">
        <i class="nav-icon fas fa-chart-line"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('schedules/') ?>" class="nav-link" v-bind:class="checkactive('schedules')">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>
          Schedules
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('classes/') ?>" class="nav-link" v-bind:class="checkactive('classes')">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
          Classes
        </p>
      </a>
    </li>
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link" v-bind:class="checkactive('students')">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Students
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?= base_url('students') ?>" class="nav-link">
            <i class="fas fa-list-alt nav-icon"></i>
            <p>Student Masterlist</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('students/newStudentRegistration') ?>" class="nav-link">
            <i class="fas fa-address-card nav-icon"></i>
            <p>Enroll New Student</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('invoice/index') ?>" class="nav-link" v-bind:class="checkactive('invoice')">
        <i class="nav-icon fas fa-cash-register"></i>
        <p>
          Invoice Statements
        </p>
      </a>
    </li>
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link" v-bind:class="checkactive('users')">
        <i class="nav-icon fas fa-book"></i>
        <p>
          Libraries
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?= base_url('libraries/branches') ?>" class="nav-link">
            <i class="nav-icon fas fa-circle-notch nav-icon"></i>
            <p>Branches</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link" v-bind:class="checkactive('users')">
        <i class="nav-icon fas fa-users-cog"></i>
        <p>
          Users
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?= base_url('users/index') ?>" class="nav-link">
            <i class="nav-icon fas fa-list-alt nav-icon"></i>
            <p>Users List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('users/logs') ?>" class="nav-link">
            <i class="nav-icon fas fa-history"></i>
            <p>User Logs</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>