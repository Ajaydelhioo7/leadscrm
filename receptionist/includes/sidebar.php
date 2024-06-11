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
  <h6 class="ml-3 mt-3">Reception</h6>
    <ul class="nav" id="sidebarNav">
        <li class="<?= $currentFile == 'dashboard.php' ? 'active' : '' ?>">
            <a href="../receptionist/dashboard.php">
                <i class="nc-icon nc-bank"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="<?= $currentFile == 'manage_centers.php' ? 'active' : '' ?>">
            <a href="../receptionist/manage_centers.php">
                <i class="nc-icon nc-bank"></i>
                <p>Centers</p>
            </a>
        </li>
        <li class="<?= $currentFile == 'manage_enquiry_by.php' ? 'active' : '' ?>">
            <a href="../receptionist/manage_enquiry_by.php">
                <i class="nc-icon nc-bank"></i>
                <p>Marketers</p>
            </a>
        </li>
        
    </ul>
</div>
    </div>