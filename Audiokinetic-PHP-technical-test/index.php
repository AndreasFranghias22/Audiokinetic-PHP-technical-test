<?php
	// Disable PHP notices
	error_reporting(E_ALL & ~E_NOTICE);
	require_once 'db_con.php';

?>
<!DOCTYPE HTML>
<html>
<head>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/solid.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/script.js"></script>
	<script>
	$(document).ready(function() {
		/* Your JQuery here */
	});
	</script>
</head>
<body>
	<h1 class="text-primary"><i class="fas fa-users"></i>All Users<small class="text-warning"></small></h1>
<table class="table  table-striped table-hover table-bordered" id="data" >
  <thead class="thead-dark">
    <tr>
      <th scope="col">id</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Age</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $query=mysqli_query($db_con,'SELECT * FROM `users`');
      $i=1;
      while ($result = mysqli_fetch_array($query)) { ?>
      <tr>
        <?php 
        echo '<td>'.$result['id'].'</td>
          <td>'.$result['FirstName'].'</td>
          <td>'.ucwords($result['LastName']).'</td>      
          <td>'.$result['age'].'</td>';?>
      </tr>  
     <?php $i++;} ?>
    
  </tbody>
</table>

<?php 

  if (isset($_POST['adduser'])) {
  	$FirstName = $_POST['FirstName'];
  	$LastName = $_POST['LastName'];
  	$Age = $_POST['Age'];

  	$query = "INSERT INTO `users`(`FirstName`, `LastName`, `Age`) VALUES ('$FirstName', '$LastName', '$Age');";
  	if (mysqli_query($db_con,$query)) {
  		$datainsert['insertsucess'] = '<p style="color: green;">User Inserted!</p>';
  		header("Refresh:0");
  		 		
  	}else{
  		$datainsert['inserterror']= '<p style="color: red;">User Not Inserted, please input right informations!</p>';
  		 		var_dump($query);
  	}
  }
?>
<div class="row" style="display: inline; margin: auto;">
	
<div class="col-sm-6">
		<?php if (isset($datainsert)) {?>
	<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
	  <div class="toast-header">
	    <strong class="mr-auto">User Insert Alert</strong>
	    <small><?php echo date('d-M-Y'); ?></small>
	    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
	      <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	  <div class="toast-body">
	    <?php 
	    	if (isset($datainsert['insertsucess'])) {
	    		echo $datainsert['insertsucess'];
	    	}
	    	if (isset($datainsert['inserterror'])) {
	    		echo $datainsert['inserterror'];
	    	}
	    ?>
	  </div>
	</div>
		<?php } ?>
	<form enctype="multipart/form-data" method="POST" action="" style="width: 825px;">
		<div class="form-group">
		    <label for="FirstName">First Name</label>
		    <input name="FirstName" type="text" class="form-control" id="FirstName" value="<?= isset($FirstName)? $FirstName: '' ; ?>" required>
	  	</div>
	  	<div class="form-group">
		    <label for="LastName">Last Name</label>
		    <input name="LastName" type="text" value="<?= isset($LastName)? $LastName: '' ; ?>" class="form-control" id="LastName" required>
	  	</div>
	  	<div class="form-group">
		    <label for="Age">Age</label>
		    <input name="Age" type="text" value="<?= isset($Age)? $Age: '' ; ?>" class="form-control" id="Age" required>
	  	</div>
	  	<div class="form-group text-center">
		    <input name="adduser" value="Add User" type="submit" class="btn btn-danger">
	  	</div>
	 </form>
</div>
</div>
</body>
</html>
