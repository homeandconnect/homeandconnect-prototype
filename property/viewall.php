<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Home and Connect</title>
  <!-- Bootstrap -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { 
      padding-top: 70px; 
      overflow: hidden;
    }
    .navbar{
      border-radius: 0;
      margin-bottom: 0;
    }
    .panel-footer{
      background-color:rgb(66,66,66);
      color:white;
    }

    .navbar-fixed-bottom{
      border-radius: 0;
    }
  </style>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
    <div class="header">
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Home and Connect</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="#">Home <span class="sr-only">(current)</span></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Accounts <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="../account/addnewtenant.php">Add new tenant</a></li>
                  <li><a href="../account/billing.php">Bill-a-tenant</a></li>
                  <li><a href="../rent.php">Assign to property</a></li>
                  <li role="separator" class="divider"></li>
                  <li class=""><a href="#">View all</a></li>
                </ul>
              </li>
              <li class="active dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Properties <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="addnewproperty.php">Add new Property</a></li>
                  <li><a href="#">Maintenance</a></li>
                  <li class="active"><a href="property/viewall.php">View all</a></li>
                </ul>
              </li>
              <li><a href="../payment.php">Payment</a></li>
              <li><a href="../reports.php">Reports</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
<?php
  require_once '../header.php';
  if (!$loggedin){
    die("<script>window.location.href = 'login.php';</script>");
  }
  $result = MySqlQuery("SELECT lname,fname from tbl_user natural join tbl_personalinfo where username = '$username'");
  if($result->num_rows){
    $row = $result->fetch_array();
    $name = ucfirst(capitalFirstLetter($row['lname'])).", ".capitalFirstLetter(sanitizeString($row['fname']));
  echo <<<_END
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">$name <span class="caret"></span></a>
_END;
}
?>
                <ul class="dropdown-menu">
                  <li><a href="#">Profile</a></li>
                  <li><a href="#">Reports</a></li>
                  <li><a href="#">Settings</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="../logout.php">Log out</a></li>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav><!-- end of navigation bar -->
    </div><!-- end of header -->

  <div class="container-fluid">
  <div class="col-md-12 col-sm-12">
      <div class="row">
<?php
  $result = MySqlQuery("SELECT * from tbl_housedesc");
  $row = $result->num_rows;
  for( $ctr = 0 ; $ctr < $row ; ++$ctr)
  {
    $result->data_seek($ctr);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $unitname = $row['unitno'];
    $description = $row['description'];
    $status = $row['status'];
    if($status == "lease")
    {
      $btn_type = "btn-success";
      $btn_name = "Lease";
      $label_type = "label-success";
      $house_status = "Unoccupied";
    }
    if($status == "occupied")
    {
      $btn_type = "btn-danger";
      $btn_name = "Free";
      $label_type = "label-danger";
      $house_status = "Occupied";
    }
    if($status == "undermaintenance")
    {
      $btn_type = "btn-danger";
      $btn_name = "Make Functional";
      $label_type = "label-danger";
      $house_status = "Undermaintenance";
    }
    if($unitname != "")
  echo <<<_HOUSEINFO
        <div class="clearfix visible-xs-block"></div>
        <div class="col-md-4">
        <div class="panel panel-success">
          <div class="panel-heading">
            Unit Number: $unitname <span class="label $label_type"> $house_status </span>
          </div>
          <div class="panel-body">
            $description
            <!--<button type="submit" class="btn $btn_type btn-md btn-block" data-toggle="modal" data-target="#tenantnamemodal">$btn_name</button>-->
          </div>
        </div>
        </div>
_HOUSEINFO;
}
?>
</div>
        </div>
        </div>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="../js/jquery.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../js/bootstrap.min.js"></script>
</body>
</html>