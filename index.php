<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Online Cinema Tickets</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="CinemaTicket/img/cinema.jpg" rel="icon">
  <link href="CinemaTicket/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="CinemaTicket/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="CinemaTicket/lib/nivo-slider/css/nivo-slider.css" rel="stylesheet">
  <link href="CinemaTicket/lib/owlcarousel/owl.carousel.css" rel="stylesheet">
  <link href="CinemaTicket/lib/owlcarousel/owl.transitions.css" rel="stylesheet">
  <link href="CinemaTicket/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="CinemaTicket/lib/animate/animate.min.css" rel="stylesheet">
  <link href="CinemaTicket/lib/venobox/venobox.css" rel="stylesheet">

  <!-- Nivo Slider Theme -->
  <link href="CinemaTicket/css/nivo-slider-theme.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="CinemaTicket/css/style.css" rel="stylesheet">

  <!-- Responsive Stylesheet File -->
  <link href="CinemaTicket/css/responsive.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: eBusiness
    Theme URL: https://bootstrapmade.com/ebusiness-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body data-spy="scroll" data-target="#navbar-example">

  <div id="preloader"></div>

  <header>
    <!-- header-area start -->
    <div id="sticker" class="header-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">

            <!-- Navigation -->
            <nav class="navbar navbar-default">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".bs-example-navbar-collapse-1" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
                <!-- Brand -->
                <a class="navbar-brand page-scroll sticky-logo" href="index.php">
                  <h1><span>Cinema</span>Tickets</h1>
                  <!-- Uncomment below if you prefer to use an image logo -->
                  <!-- <img src="img/logo.png" alt="" title=""> -->
								</a>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse main-menu bs-example-navbar-collapse-1" id="navbar-example">
                <ul class="nav navbar-nav navbar-right">
                  <li class="active">
                    <a class="page-scroll" href="index.php">Home</a>
                  </li>
                  
                  
                </ul>
              </div>
              <!-- navbar-collapse -->
            </nav>
            <!-- END: Navigation -->
          </div>
        </div>
      </div>
    </div>
    <!-- header-area end -->
  </header>
  <!-- header end -->

  <!-- Start Slider Area -->
  <div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        <img src="CinemaTicket/img/slider/6underground (1).jpg" alt=""/>
        <img src="CinemaTicket/img/slider/free guy (1).jpg" alt="" />
        <img src="CinemaTicket/img/slider/wp9456679 (1).jpg" alt="" />
      </div>

      <!-- direction 1 -->
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
               
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 2 -->
      <div id="slider-direction-2" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content text-center">
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 3 -->
      <div id="slider-direction-3" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
             
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Slider Area -->





  <!-- Start team Area -->
  <div id="team" class="our-team-area ">
     <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="section-headline text-center">
           <div class="title"><h2>Now Showing</h2></div> 

          </div>
        </div>
     
      </div>
      
          
             
                
<!--------------------------   --------------------------------------->

  
      
<?php

require_once "connection.php";

if(isset($_REQUEST['delete_id']))
{
    // select image from db to delete
    $id=$_REQUEST['delete_id'];	//get delete_id and store in $id variable
    
    $select_stmt= $db->prepare('SELECT * FROM tbl_file WHERE id =:id');	//sql select query
    $select_stmt->bindParam(':id',$id);
    $select_stmt->execute();
    $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
    unlink("upload/".$row['image']); //unlink function permanently remove your file
    
    //delete an orignal record from db
    $delete_stmt = $db->prepare('DELETE FROM tbl_file WHERE id =:id');
    $delete_stmt->bindParam(':id',$id);
    $delete_stmt->execute();
    
    header("Location:index.php");
}

?>


<?php
									$select_stmt=$db->prepare("SELECT * FROM tbl_file ORDER BY id DESC ");	//sql select query
									$select_stmt->execute();
									while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
									{
                  ?>
                  
<div class ="gallery  responsive">
<a href="watch.php?update_id=<?php echo $row['id']; ?> " target="_blank"> <video loop muted onmouseover="this.play();" onmouseout="this.pause();" width="300" height="200" preload>
         <source src="upload/<?php echo $row['image']; ?>"></video>
                                           
               <div class="des">
                      <h6><?php echo $row['name']; ?></h6>
                                            
                                            	
                                    </div>
                                    </a>
                                    </div>  
                                        
                                    <?php
									}
									?>

    </div>  

                  
             

     <!---------------------------------------------------->          
             
    
     
  </div>
<!---------------------                           --------------------------->
    </div>
    </div>
  </div>
             
          
             
          
     
  <!-- End Team Area -->

  
  <!-- Start Footer bottom Area -->
  <footer>
    <div class="footer-area">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="footer-content">
              
                
              </div>
            </div>
          </div>
          
          <!-- end single footer -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="footer-content">
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-area-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="copyright text-center">
              
                <strong>Online Cinema Tickets</strong>. 
              
            </div>
            <div class="credits">
              Web Developer: <strong>March</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>


  
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="CinemaTicket/lib/jquery/jquery.min.js"></script>
  <script src="CinemaTicket/lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="CinemaTicket/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="CinemaTicket/lib/venobox/venobox.min.js"></script>
  <script src="CinemaTicket/lib/knob/jquery.knob.js"></script>
  <script src="CinemaTicket/lib/wow/wow.min.js"></script>
  <script src="CinemaTicket/lib/parallax/parallax.js"></script>
  <script src="CinemaTicket/lib/easing/easing.min.js"></script>
  <script src="CinemaTicket/lib/nivo-slider/js/jquery.nivo.slider.js" type="text/javascript"></script>
  <script src="CinemaTicket/lib/appear/jquery.appear.js"></script>
  <script src="CinemaTicket/lib/isotope/isotope.pkgd.min.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="CinemaTicket/contactform/contactform.js"></script>

  <script src="CinemaTicket/js/main.js"></script>
</body>

</html>
