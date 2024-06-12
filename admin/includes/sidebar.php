<?php
// Get the root URL of the website
$rootUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . "lms.99notes.org";


// If your application is in a subfolder, append the folder name to the root URL
// For example, if your app is located in the 'myapp' folder, uncomment the line below and replace 'myapp' with the actual folder name
// $rootUrl .= '/myapp';
?>
<div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <!-- <div class="logo-image-small">
            <img src="../assets/img/logo-small.png">
          </div> -->
          <!-- <p>CT</p> -->
        </a>
        <a href="#" class="simple-text logo-normal">
          99notes
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <?php
$currentFile = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar-wrapper">
  <h6 class="ml-3 mt-3">Admin</h6>
    <ul class="nav" id="sidebarNav">
    <li class="<?= $currentFile == 'admin_dashboard.php' ? 'active' : '' ?>">
            <a href="../admin/admin_dashboard.php">
                <i class="nc-icon nc-bank"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="<?= $currentFile == 'register.php' ? 'active' : '' ?>">
            <a href="../admin/register.php">
                <i class="nc-icon nc-bank"></i>
                <p>Register User</p>
            </a>
        </li>
        <li class="<?= $currentFile == 'register_admin.php' ? 'active' : '' ?>">
            <a href="../admin/register_admin.php">
                <i class="nc-icon nc-bank"></i>
                <p>Register Admin</p>
            </a>
        </li>
        <li class="<?= $currentFile == 'manage_enquiries.php' ? 'active' : '' ?>">
            <a href="../admin/manage_enquiries.php">
                <i class="nc-icon nc-bank"></i>
                <p>Manage Enquiry</p>
            </a>
        </li>
        <li class="<?= $currentFile == 'manage_counsellors.php' ? 'active' : '' ?>">
            <a href="../admin/manage_counsellors.php">
                <i class="nc-icon nc-bank"></i>
                <p>Manage Counsellor</p>
            </a>
        </li>
        <li class="<?= $currentFile == 'manage_status.php' ? 'active' : '' ?>">
            <a href="../admin/manage_status.php">
                <i class="nc-icon nc-bank"></i>
                <p>Manage Status</p>
            </a>
        </li>
        <li class="<?= $currentFile == 'manage_admins.php' ? 'active' : '' ?>">
            <a href="../admin/manage_admins.php">
                <i class="nc-icon nc-bank"></i>
                <p>Manage Admin</p>
            </a>
        </li>
    </ul>
</div>
    </div>