<?php

require_once "connection.php";

if(isset($_REQUEST['btn_insert']))
{
	try
	{
		$name	= $_REQUEST['txt_name'];	//textbox name "txt_name"
		$genre	= $_REQUEST['txt_genre'];	
		$actor	= $_REQUEST['txt_actor'];	//textbox name "txt_name"
		$release_date	= $_REQUEST['txt_release_date'];


		$image_file	= $_FILES["file"]["name"];
		$type		= $_FILES["file"]["type"];	//file name "txt_file"	
		$size		= $_FILES["file"]["size"];
		$temp		= $_FILES["file"]["tmp_name"];
		
	


		$path="upload/".$image_file; //set upload folder path
		
		if(empty($name)){
			$errorMsg="Please Enter Title";
		}
		else if(empty($genre)){
			$errorMsg="Please Select Genre";

		}else if(empty($actor)){
			$errorMsg="Please Select Actor";

		}else if(empty($release_date)){
			$errorMsg="Please Select Date";

		}else if(empty($image_file)){
			$errorMsg="Please Select Video";

		}else if($type=="video/mp4" || $type=='video/webm' || $type=='video/ogg' || $type=='video/mpg'  || $type=='video/avi' || $type=='video/flv' || $type=='video/avchd'  || $type=='video/mkv' || $type=='video/wmv'  || $type=='video/mov') //check file extension
     
			

			{ if(!file_exists($path)) //check file not exist in your upload folder path
			{
				if($size < 9990000000000000000000000000000000000000000) //check file size 5MB
				{
					move_uploaded_file($temp,"upload/".$image_file); //move upload file temperory directory to your upload folder
				}
				else
				{
					$errorMsg="Your File To large Please Upload 5MB Size"; //error message file size not large than 5MB
				}
			}
			else
			{	
				$errorMsg="File Already Exists...Check Upload Folder"; //error message file not exists your upload folder path
			}
		}
		else
		{
			$errorMsg="Upload MP4  Video Formate.....CHECK FILE EXTENSION"; //error message file extension
		}
		
		if(!isset($errorMsg))
		{
			$insert_stmt=$db->prepare('INSERT INTO tbl_file(name,image,genre,actor,release_date) VALUES(:fname,:fimage,:fgenre,:factor,:frelease)'); //sql insert query					
			$insert_stmt->bindParam(':fname',$name);
			$insert_stmt->bindParam(':fgenre',$genre);
			$insert_stmt->bindParam(':factor',$actor);
			$insert_stmt->bindParam(':frelease',$release_date);
			$insert_stmt->bindParam(':fimage',$image_file);	  //bind all parameter 
			
			if($insert_stmt->execute())
			{
				$insertMsg="File Upload Successfully........"; //execute query success message
				header("refresh:3;crude.php"); //refresh 3 second and redirect to index.php page
			}
		}
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>Online Cinema Tickets</title>
<link href="CinemaTicket/img/cinema.jpg" rel="icon">		
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
		
</head>

	<body>
	
	
	<nav class="navbar panel-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="crude.php">CRUDE PANNEL</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="crude.php">ONLINE CINEMA TICKETS</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="wrapper">
	
	<div class="container">
			
		<div class="col-lg-12">
		
		<?php
		if(isset($errorMsg))
		{
			?>
            <div class="alert alert-danger">
            	<strong>WRONG ! <?php echo $errorMsg; ?></strong>
            </div>
            <?php
		}
		if(isset($insertMsg)){
		?>
			<div class="alert alert-success">
				<strong>SUCCESS ! <?php echo $insertMsg; ?></strong>
			</div>
        <?php
		}
		?>   
		
			<form method="post" class="form-horizontal" enctype="multipart/form-data">
					
				<div class="form-group">
				<label class="col-sm-3 control-label">Title :</label>
				<div class="col-sm-6">
				<input type="text" name="txt_name" class="form-control" placeholder="Enter Title" />
				</div>
				</div>

				

				<div class="form-group">
				<label class="col-sm-3 control-label">Genre :</label>
				<div class="col-sm-6">
				<input type="text" name="txt_genre" class="form-control" placeholder="Enter Genre ex. Horror , Action ,Sci-Fi, War, Drama, Romance, Educational.." />
				</div>
				</div>	


					
				<div class="form-group">
				<label class="col-sm-3 control-label">Actor :</label>
				<div class="col-sm-6">
				<input type="text" name="txt_actor" class="form-control" placeholder="Enter Actor" />
				</div>
				</div>


					
				<div class="form-group">
				<label class="col-sm-3 control-label">Date :</label>
				<div class="col-sm-6">
				<input type="date" name="txt_release_date" class="form-control" placeholder="Enter Date" />
				</div>
				</div>



				<div class="form-group">
				<label class="col-sm-3 control-label">Browse :</label>
				<div class="col-sm-6">
				<input type="file" name="file" class="form-control" />
				</div>
				</div>
					




				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9 m-t-15">
				<input type="submit"  name="btn_insert" class="btn btn-success " value="Upload">
				<a href="crude.php" class="btn btn-danger">Cancel</a>
				</div>
				</div>
					
			</form>
			
		</div>
		
	</div>
			
	</div>
										
	</body>
</html>