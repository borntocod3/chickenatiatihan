<?php 
	print_r($reservation_args);
	print_r( $reservation_post_meta);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $reservation_args['post_title'];?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri().'/library/bootstrap/css/bootstrap.css'; ?>">

</head>
<body>

	<div class="col-md-2">&nbsp;</div>
	<div class="container col-md-8">
	  <h2>Reservation Details</h2>
	  <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>            
	  <table class="table">
	    <thead>
	      <tr>
	        <th>Firstname</th>
	        <th>Lastname</th>
	        <th>Email</th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <td>John</td>
	        <td>Doe</td>
	        <td>john@example.com</td>
	      </tr>
	      <tr>
	        <td>Mary</td>
	        <td>Moe</td>
	        <td>mary@example.com</td>
	      </tr>
	      <tr>
	        <td>July</td>
	        <td>Dooley</td>
	        <td>july@example.com</td>
	      </tr>
	    </tbody>
	  </table>
	</div>
	<div class="col-md-2">&nbsp;</div>
</body>
<?php echo '<script type="text/javascript">window.print();</script>';?>
</html>