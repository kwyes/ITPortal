<?php
//   session_start();
  $page = $_GET['page'];
  $roleSys = $_SESSION['roleSys'];
  $start_time = $_SESSION['start_time'];
  $time = time();
?>
<div class="sidebar" data-active-color="red" data-background-color="black" data-image="assets/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
      Tip 2: you can also add an image using data-image tag
      Tip 3: you can change the color of the sidebar with data-background-color="white | black"
  -->

    <div class="logo">
        <a href="?page=dashboard" class="simple-text logo-mini">
            IT
        </a>

        <span class="simple-text logo-normal">
            Admin
        </span>
    </div>

    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="https://asset.bodwell.edu/OB4mpVpg/staff/<?=$_SESSION['staffId']?>.jpg" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                        <?=$_SESSION['staffName']?>
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                  <ul class="nav">
                      <li>
                          <a href="?page=logout">
                              <span class="sidebar-mini"> <i class="material-icons">account_box</i>  </span>
                              <span class="sidebar-normal"> Sign Out </span>
                          </a>
                      </li>
                  </ul>
              </div>
            </div>
        </div>
        <ul class="nav">

            <li class="<?php echo ($page=='dashboard')?" active":"";?>">
                <a href="?page=dashboard">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>

            <!-- <li class="<?php echo ($page=='student')?" active":"";?>">
                <a href="?page=student">
                    <i class="material-icons">school</i>
                    <p> Student </p>
                </a>
            </li>

            <li class="<?php echo ($page=='staff')?" active":"";?>">
                <a href="?page=staff">
                    <i class="material-icons">person</i>
                    <p> Staff </p>
                </a>
            </li> -->

            <li class="<?php echo ($page=='device')?" active":"";?>">
                <a href="?page=device">
                    <i class="material-icons">devices</i>
                    <p> Device </p>
                </a>
            </li>

            <li class="<?php echo ($page=='asset')?" active":"";?>">
                <a href="?page=asset">
                    <i class="material-icons">keyboard</i>
                    <p> AssetMaster </p>
                </a>
            </li>

            <li class="<?php echo ($page=='resetEmail')?" active":"";?>">
                <a href="?page=resetEmail">
                    <i class="material-icons">mail_outline</i>
                    <p> Reset Pasword Request</p>
                </a>
            </li>

            <li class="<?php echo ($page=='returnDevice')?" active":"";?>">
                <a href="?page=returnDevice">
                    <i class="material-icons">laptop</i>
                    <p> Return Device</p>
                </a>
            </li>

            <li class="<?php echo ($page=='updateStaff')?" active":"";?>">
                <a href="?page=updateStaff">
                    <i class="material-icons">person</i>
                    <p> Update Staff Info</p>
                </a>
            </li>
        </ul>

    </div>
</div>
