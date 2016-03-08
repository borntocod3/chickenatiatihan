<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $reservation_args['post_title'];?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri().'/library/bootstrap/css/bootstrap.css'; ?>">
	<style type="text/css">
		@media print{
			#btn-actions-container{
				display: none;
			}
		}
	</style>
</head>
<body>

	<div class="col-md-2">&nbsp;</div>
	<div class="container col-md-8">
	  <h2>Reservation Details</h2>
		<h3>Reservation #: <strong><?php echo $insert_id; ?></strong></h3>
	  <p>Date:<?php echo $reservation_args['post_date'];?></p>            
	  <table class="table">
	  	<thead>
	  		<tr><th colspan="2"><?php echo $reservation_args['post_title']; ?></th></tr>
	  	</thead>
	    <tbody>
	      <tr>
	        <td>Name</td>
	        <td><?php echo $reservation_post_meta['ca_name'];?></td>
	      </tr>

	      <tr>
	        <td>Email</td>
	        <td><?php echo $reservation_post_meta['email'];?></td>
	      </tr>

	      <tr>
	        <td>Number of heads</td>
	        <td><?php echo $reservation_post_meta['num_heads'];?></td>
	      </tr>

	      <tr>
	        <td>Contact No.</td>
	        <td><?php echo $reservation_post_meta['ca_contact_no'];?></td>
	      </tr>

	      <tr>
	        <td>Venue</td>
	        <td><?php echo $reservation_post_meta['ca_venue'];?></td>
	      </tr>

	       <tr>
	        <td>Notes</td>
	        <td><?php echo $reservation_args['post_content'];?></td>
	      </tr>

	    </tbody>
	  </table>

	  <?php 
	  	if(!empty($reservation_post_meta['ca_food_tray_ids'])){
	  		?>

	  			<table class="table">
				  	<thead>
				  		<tr><th colspan="2">Food Tray</th></tr>
				  	</thead>
				    <tbody>
				      <?php
					  $total = 0;
				      	foreach ($reservation_post_meta['ca_food_tray_ids'] as $product_id) {
			  				$post = get_post($product_id);
			                $product_link = get_edit_post_link($product_id);
			                $product_name  = '<a href="'.$product_link.'"> '.$post->post_title.'</a>';
							$product_price  = get_post_meta($product_id,'ca_product_price', true);
							$total += $product_price;
				      	?>
				      		 <tr>
								 <td><?php echo $post->post_title;?></td>
								 <td><?php echo 'Php '.$product_price; ?></td>
						      </tr>
						
				      	<?php
			            }
					  $total_payable = $total * $reservation_post_meta['num_heads'];
				      ?>
				    </tbody>
					<tfoot>
						<tr>
							<td colspan="2"><strong><?php echo 'Total Php '.$total_payable;?></strong></td>
						</tr>
					</tfoot>
			  </table>
	  		<?php
	  	}
	  ?>


		<div class="col-md-12">
			<h4>“Dear Customer, should you choose to confirm this reservation please present this document in the attending personnel of chickenatiatihan,
				in the event that you don’t have a printing device, you can choose to take a picture of this document or secure a copy of the reservation number. Thankyou."</h4>
		</div>
		<div id="btn-actions-container">
			<button class="btn btn-info" onclick="print_receipt()">Print</button>
			<a  href="<?php echo get_permalink(get_page_by_path('reserve-now'));?>" class="btn btn-warning">Go Back</a>
		</div>
	</div>

</body>
<?php echo '
			<script type="text/javascript">

				function print_receipt(){
					window.print();
				}
				window.print();
			</script>';
?>
</html>