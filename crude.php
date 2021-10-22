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
		
		header("Location:crude.php");
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
<link rel="stylesheet" href="bootstrap/css/style/css">
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
            <li class="active"><a href="index.php" target="_blank">ONLINE CINEMA TICKETS</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="wrapper">
	
	<div class="container-fluid">
			
		<div class="col-lg-12 ">
			<div class="col-lg-12">
                    <div class="panel panel-default" style="border:3px solid black;box-shadow:10px 10px">
                        <div class="panel-heading">
                           <h4><a href="add.php"style="color:green" ><span class="glyphicon glyphicon-plus " ></span>&nbsp; UPLOAD VIDEO</a></h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" >
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" style="border:2px solid black">
                                    <thead>
                                        <tr style="border:2px solid black">
                                            <th style="border:2px solid black">ID</th>
                                            <th style="border:2px solid black">TITLE </th>                                     
                                            <th style="border:2px solid black">VIDEOS </th>
                                            <th style="border:2px solid black">FILE &nbsp;FORMAT</th>
                                            <th style="border:2px solid black">GENRE </th>
                                            <th style="border:2px solid black">ACTOR </th>
                                            <th style="border:2px solid black">DATE &nbsp; RELEASED </th>
                                            <th style="border:2px solid black">EDIT </th>
                                            <th style="border:2px solid black">DELETE </th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$select_stmt=$db->prepare("SELECT * FROM tbl_file ORDER BY id DESC ");	//sql select query
									$select_stmt->execute();
									while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
									{
									?>
                                        <tr style="border:2px solid black">
                                            <td style="border:2px solid black"><span><?php echo $row['id']; ?></span></td>
                                            <td style="border:2px solid black"><span><?php echo $row['name']; ?></span></td>                                      
                                            <td style="border:2px solid black"><video  loop onmouseover="this.play();" onmouseout="this.pause();" width="150px" height="100px" preload> <source src="upload/<?php echo $row['image']; ?>"></video></td>
                                            <td style="border:2px solid black"><span><?php echo $row['image']; ?></span></td>
                                            <td style="border:2px solid black"><span><?php echo $row['genre']; ?></span></td>
                                            <td style="border:2px solid black"><span><?php echo $row['actor']; ?></span></td>
                                            <td style="border:2px solid black"><span><?php echo $row['release_date']; ?></span></td>
                                            <td style="border:2px solid black"><a href="edit.php?update_id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a></td>
                                            <td style="border:2px solid black"><a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                                            <a href="blog.php?update_id=<?php echo $row['id']; ?>"></a>
                                        </tr>
                                    <?php
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
				
		</div>
		
	</div>
			
	</div>
									
	</body>
</html>