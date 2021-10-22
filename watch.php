<?php

require_once "connection.php";

if(isset($_REQUEST['update_id']))
{
	try
	{
		$id = $_REQUEST['update_id']; //get "update_id" from index.php page through anchor tag operation and store in "$id" variable
		$select_stmt = $db->prepare('SELECT * FROM tbl_file WHERE id =:id'); //sql select query
		$select_stmt->bindParam(':id',$id);
		$select_stmt->execute(); 
		$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
	}
	catch(PDOException $e)
	{
		$e->getMessage();
	}
	
}

if(isset($_REQUEST['btn_update']))
{
	try
	{
		$name	        =$_REQUEST['txt_name'];	//textbox name "txt_name"
		$genre	        =$_REQUEST['txt_genre'];
		$actor	        =$_REQUEST['txt_actor'];	//textbox name "txt_name"
		$release_date	=$_REQUEST['txt_release_date'];
		

		$image_file	= $_FILES["file"]["name"];
		$type		= $_FILES["file"]["type"];	//file name "txt_file"
		$size		= $_FILES["file"]["size"];
		$temp		= $_FILES["file"]["tmp_name"];
			
		$path="upload/".$image_file; //set upload folder path
		
		$directory="upload/"; //set upload folder path for update time previous file remove and new file upload for next use
		
		if($image_file)
		{
			if($type=="video/mp4" || $type=='video/webm' || $type=='video/ogg' || $type=='video/mpg'  || $type=='video/avi' || $type=='video/flv' || $type=='video/avchd') //check file extension
			{	
				if(!file_exists($path)) //check file not exist in your upload folder path
				{
					if($size < 9990000000000000000000000000000000000000000) //check file size 5MB
					{
						unlink($directory.$row['image']); //unlink function remove previous file
						move_uploaded_file($temp, "upload/" .$image_file);	//move upload file temperory directory to your upload folder	
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
				$errorMsg="Upload JPG, JPEG, PNG & GIF File Formate.....CHECK FILE EXTENSION"; //error message file extension
			}
		}
		else
		{
			$image_file=$row['image']; //if you not select new image than previous image sam it is it.
		}
	
		if(!isset($errorMsg))
		{
			$update_stmt=$db->prepare('UPDATE tbl_file SET name=:name_up, image=:file_up, genre=:genre_up, actor=:actor_up, release_date=:release_up WHERE id=:id'); //sql update query
			$update_stmt->bindParam(':name_up',$name);
			$update_stmt->bindParam(':file_up',$image_file);	//bind all parameter
			$update_stmt->bindParam(':genre_up',$genre);
			$update_stmt->bindParam(':actor_up',$actor);
			$update_stmt->bindParam(':release_up',$release_date);
			$update_stmt->bindParam(':id',$id);
			 
			if($update_stmt->execute())
			{
				$updateMsg="File Update Successfully.......";	//file update success message
				header("refresh:3;crude.php");	//refresh 3 second and redirect to index.php page
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
<!-- Nivo Slider Theme -->
<link href="CinemaTicket/css/nivo-slider-theme.css" rel="stylesheet">

<!-- Main Stylesheet File -->
<link href="CinemaTicket/style.css" rel="stylesheet">

<!-- Responsive Stylesheet File -->
<link href="CinemaTicket/css/responsive.css" rel="stylesheet">

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
          <a class="navbar-brand" href="index.php"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="wrapper">
	
	<div class="container-fluid">
			
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
		if(isset($updateMsg)){
		?>
			<div class="alert alert-success">
				<strong>UPDATE ! <?php echo $updateMsg; ?></strong>
			</div>
        <?php
    }
    
		?>   
        


			<form method="post" class="form-horizontal" enctype="multipart/form-data">
				
					
					
				<div class="form-group">
				<div class="col-lg-12" >
        <video loop controls autoplay width="80%" height="auto" preload> <source src="upload/<?php echo $row['image']; ?>"></video>
                                            <h4><?php echo $row['name']; ?></h4>
                                           <hr style="border:1px solid silver;width:80%;margin-left:0px;"/>
                                           <h5>Genre :<?php echo $row['genre']; ?></h5>
                                           <h5>Actor :<?php echo $row['actor']; ?>
                                           <h5>Released <?php echo $row['release_date']; ?></h5>                 
				</div>
                                            
				</div>
					
					
				</div>
					
			</form>
			
		</div>
		
	</div>
			
	</div>
										
	</body>
</html>