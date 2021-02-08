
<header class="main-header">
    <!-- Logo -->
    <a href="dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CO</b>NE</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b> CONE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="MyUploadImages/pictu.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['Fname']; echo" "; echo $_SESSION['Lname'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="MyUploadImages/pictu.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['Fname']; echo" "; echo $_SESSION['Lname']; ?>
                  <small>Position: <?php echo $_SESSION['position']; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body ">
                <div class="row">
                  <div class="col-sm-6 text-center">
                    <a href="#">Privilege: </a>
                  </div>
                  <div class="col-sm-6 text-center bg-red">
                    <span class=""><?php echo $_SESSION['privilege']; ?></span>
                  </div>

                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right my-2 my-lg-0">
                  <a href='login.php?logout=1'><button type="submit" class="btn btn-outline-success my-2 my-sm-0 ">Sign out</button></a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="MyUploadImages/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> <?php echo $_SESSION['Fname']; echo" "; echo $_SESSION['Lname']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" readonly class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Students Information</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ><a href="#" id ="regStd"><i class="fa fa-circle-o"></i> Registration</a></li>
            <li><a href="#" id="AllStd"><i class="fa fa-circle-o"></i> All students</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Update Registration</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i>
            <span> View Questions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" class="clickquestion" data-value= "Mathematics"><i class="fa fa-circle-o"></i> Mathematics</a></li>
            <li><a href="#" class="clickquestion" data-value= "English"><i class="fa fa-circle-o"></i> English</a></li>
            <li><a href="#" class="clickquestion" data-value= "Physics"><i class="fa fa-circle-o"></i> Physics</a></li>
            <li><a href="#" class="clickquestion" data-value= "Chemistry"><i class="fa fa-circle-o"></i> Chemistry</a></li>
            <li><a href="#" class="clickquestion" data-value= "Biology"><i class="fa fa-circle-o"></i> Biology</a></li>
            <li><a href="#" class="clickquestion" data-value= "Current-Affairs"><i class="fa fa-circle-o"></i> Current Affairs</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-calculator"></i> <span>Result</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" class="clickSTD"><i class="fa fa-circle-o"></i> Student Result page</a></li>
            <li><a href="#" id="revPg"><i class="fa fa-circle-o"></i> Examination review Page</a></li>
          </ul>
        </li>


        <li><a href="/cbt exam/WelcomePage.php"><i class="fa fa-book"></i> <span>Examination Page</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="register.php"><i class="fa fa-circle-o text-aqua"></i> <span>Register Account</span></a></li>
        <li><a href="login.php?logout=1"><i class="fa fa-circle-o text-red"></i> <span>Sign Out</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


   <nav class=" navbar-fixed-bottom bg-primary">
   <div style="text-align : center;">
    <strong>Copyright &copy; 2019 <a href="">College of Nursing</a>. </strong> All rights
    reserved.
	</div>
  </nav>
