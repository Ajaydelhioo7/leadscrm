<?php
// Get the root URL of the website
$rootUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . "localhost";


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
  <h6 class="ml-3 mt-3">Reception</h6>
    <ul class="nav" id="sidebarNav">
        <li class="<?= $currentFile == 'dashboard.php' ? 'active' : '' ?>">
            <a href="../counsellors/dashboard.php">
                <i class="nc-icon nc-bank"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="<?= $currentFile == 'followups.php' ? 'active' : '' ?>">
            <a href="../counsellors/followups.php">
                <i class="nc-icon nc-bank"></i>
                <p>Follow Up</p>
            </a>
        </li>
        <li class="<?= $currentFile == 'manage_status.php' ? 'active' : '' ?>">
            <a href="../counsellors/manage_status.php">
                <i class="nc-icon nc-bank"></i>
                <p>Status</p>
            </a>
        </li>
    </ul>
</div>
    </div>