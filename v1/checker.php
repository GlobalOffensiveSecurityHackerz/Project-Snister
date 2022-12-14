<!DOCTYPE html>
<html lang="en-gb" dir="ltr">

<head>
  <?php

session_start();
$userLogged = false;
$isAdmin = false;
$is_active = false;
$access_tok = 'null';
if (isset($_SESSION['username'])) {
  $userLogged = true;
  if ($_SESSION['roles'] === "admin") {
    $isAdmin = true;
  }
   if ($_SESSION['status'] === 'active'){
      $is_active =true;
  }
  if($_SESSION['access']!== null){
      $access_tok = $_SESSION['access'];
  }
}
if($is_active === false){
  return header("location: ./dashboard?message=account_not_active");
}
if ($userLogged !== true) {
  return header("location: ./?message=user_not_logged");
}
?>
    <meta charset="utf-8">
	
	
	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/pace.css">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CVV CHECKER</title>
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600%7CRoboto:400" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    
    <!-- Head Libs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script data-pace-options='{ "ajax": false, "selectors": [ "img" ]}' src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <script>
var myVar=setInterval(function(){myTimer()},1000);
function myTimer() {
    var d = new Date();
    document.getElementById("horas").innerHTML = d.toLocaleTimeString();
}
</script>
<script type="text/javascript">
function Mudaestado(el) {
        var display = document.getElementById(el).style.display;
        if(display == "none")
            document.getElementById(el).style.display = 'block';
        else
            document.getElementById(el).style.display = 'none';
    }
</script>
</head>

<body>


<body class="content-dark">
        <!-- /.site-sidebar -->
        <main class="main-wrapper clearfix">
            <!-- Page Title Area -->
            <div class="row page-title clearfix">
                <div class="page-title-left">
                    <h6 class="page-title-heading mr-0 mr-r-5"><strong>Project Snis</strong></h6>
                    <p class="page-title-description mr-0 d-none d-md-inline-block"></p>
                </div>
                <!-- /.page-title-left -->
                
                <!-- /.page-title-right -->
            </div>
            <!-- /.page-title -->
            <!-- =================================== -->
            <!-- Different data widgets ============ -->
            <!-- =================================== -->
            <div class="widget-list row">
                
                <!-- /.widget-holder -->
                <div class="widget-holder widget-full-height widget-flex col-lg-6">
                    <div class="widget-bg">
                        <div class="widget-heading">
                            <h5 class="widget-title"> Braintree </h5>
                            <div class="widget-graph-info">
                                <div class="dropdown"><a href="javascript:void(0)" class="dropdown-toggle text-muted fs-16" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a>  <a class="dropdown-item" href="#">Another action</a>  <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.widget-graph-info -->
                        </div>
                        <!-- /.widget-heading -->
                        <div class="widget-body">
                            <button type="button" id="sh_apr" onclick="Mudaestado('aprovadasapp');" class="btn btn-success" style="background-image: linear-gradient(45deg, #9000ff, #0069d4);border-color: #ffffff;">APPROVED [ <span id="aprovada_conta">0</span> ]</button>

                            <br>

                            <p id="aprovadasapp"></p>

                            <br><br>

                            <button type="button" id="sh_rep" onclick="Mudaestado('reprovadasapp');" class="btn btn-danger"  style="background-image: linear-gradient(45deg, #fc9210, #dd2222);border-color: #ffffff;">DECLINED [ <span id="reprovada_conta">0</span> ]</button>

                            <br>

                            <p id="reprovadasapp"></p>
                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>
                <!-- /.widget-holder -->
                <div class="widget-holder widget-full-content widget-full-height col-lg-6">
                    <div class="widget-bg">
                        <div class="widget-heading">
                            <h5 class="widget-title">FILL IN THE INFORMATION.</h5>
                            <div class="widget-graph-info">
                                <div class="dropdown"><a href="javascript:void(0)" class="dropdown-toggle text-muted fs-16" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a>  <a class="dropdown-item" href="#">Another action</a>  <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.widget-graph-info -->
                        </div>
                        <!-- .widget-heading -->
                        <div class="widget-body">
                            <div class="container-fluid pd-20">
                                <div class="row">
                                    <div class="col">
                                        

                                    <textarea id="lista" placeholder="FORMAT: 0000000000000000|00|0000|000" class="form-control" style="resize:yes;outline:none;width:200; height:150px;"></textarea><br>

                                    <button type="button" id="iniciar"  onclick="start()" class="btn btn-success" style="background-image: linear-gradient(45deg, #9000ff, #0069d4);border-color: #ffffff;">Start</button> 
                                    <button type="button" onclick="stop()" id="parar" class="btn btn-danger" style="background-image: linear-gradient(45deg, #fc9210, #dd2222);border-color: #ffffff;" >Stop</button>

                                    <br><br>

                                    <small>STATUS: <span class="bagde badge-pill badge-primary" id="demo">WAITING FOR BEGINNING</span> - 
                                    APPROVED: <span id="CLIVE" class="badge badge-success">0</span> - 
                                    DECLINED: <span id="CDIE" class="badge badge-danger">0</span> - 
                                    TESTED: <span id="testado" class="badge badge-warning">0</span> - 
                                    TOTAL: <span id="carregada" class="badge badge-info">0</span></small>

                                    <br><br>

                                    Time: <span class="badge badge-primary" id="horas">NULL</span>

                                    <br><br>

                                    <p>Rebuild & Edited By :  <a target="_BLANK" href="https://t.me/+sVFkRRLNYt9hNTdl">
                                    Snister</a></p>


                                            <!-- /.col-6 -->
                                    </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.col-lg-6 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>
                <!-- /.widget-holder -->
            </div>
            <!-- /.widget-list -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.chat-panel -->
    </div>
    <!-- /.content-wrapper -->
    <!-- FOOTER -->
    </div>
    <!--/ #wrapper -->
    <!-- Scripts -->



<script src="../js/awesomplete.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/hyper.js?v=1.2"></script>
<script src="../js/hyper.notify.js?v=1.2"></script>
<script src="../js/hyper.checker.js?v=1.9"></script>
<!-- <script src="js/session.js"></script> -->



</body>

</html>