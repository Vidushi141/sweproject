
<?php

require('backends/connection-pdo.php');


if (isset($_REQUEST['id'])) {

	$sql = 'SELECT * FROM food WHERE cat_id = "'.$_REQUEST['id'].'"';
	
} else {

	$sql = 'SELECT * FROM food';

}

$query  = $pdoconn->prepare($sql);
$query->execute();
$arr_all = $query->fetchAll(PDO::FETCH_ASSOC);



?>


<section class="fcategories">

	<div class="container">

		<?php

			if (isset($_SESSION['msg'])) {
				echo '<div class="section pink center" style="margin: 10px; padding: 3px 10px; margin-top: 35px; border: 2px solid black; border-radius: 5px; color: white;">
						<p><b>'.$_SESSION['msg'].'</b></p>
					</div>';

				unset($_SESSION['msg']);
			}
		?>

		<div class="section white center">
			<h3 class="header">Foods Area!</h3>
		</div>

		<?php if (count($arr_all) == 0) {
	echo '<div class="section gray center" style="border: 1px solid black; border-radius: 5px;">
			<p class="header">Sorry No Categories to Display!</p>
		</div>';
} else {  ?>

<?php for ($i=1; $i <= count($arr_all); ) { ?>
		
		<div class="row">
			
			<?php for ($j=1; $j <= 3; $j++) { ?>


				<?php if ($i+$j-2 == count($arr_all)) {
					break;
				}  ?>

			<div class="col s12 m4">
				<div class="card">
				    <div class="card-image waves-effect waves-block waves-light">
				      <img class="activator" src="images/banner<?php echo $j; ?>.jpg">
				    </div>
				    <div class="card-content">
				      <span class="card-title activator grey-text text-darken-4"><a class="black-text" href=""><?php echo $arr_all[$i+$j-2]['fname']; ?></a><i class="material-icons right">more_vert</i></span>
				      <div class="card-content">
			          <p>This is a popular Food of India. Order Now to Grab a bite of it!</p>
			        </div>
			        <div class="card-content center">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $arr_all[$i+$j-2]['id']; ?>">
	Order Now
  </button>
  
  <!-- Modal -->
  <div class="modal fade modal-dialog modal-dialog-centered" id="exampleModal<?php echo $arr_all[$i+$j-2]['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="
    position: absolute;
    min-width: 500px; height: 700px;">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <h1 class="modal-title fs-5" id="exampleModalLabel">Order Now</h1>
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
		   <form method="get" action="backends/order-food.php">
			<input type="hidden" value="<?php echo $arr_all[$i+$j-2]['id']; ?>" name="id">
			<select name="pay" class="form-control form-select ">
				<option value="Google_Pay">Google Pay</option>
				<option value="Phonepe">Phonepe</option>
				<option value="Debit_Card">Debit Card</option>
				<option value="Cash">Cash</option>
			</select>
			<label class="float-start">Add Comment</label>
			<textarea class="form-control mb-2" placeholder="Add Comment" name="comment" wrap="soft"></textarea>
			<button class="btn btn-primary w-100" type="submit">Pay & Place Order</button>
		   </form>
		</div>
		
	  </div>
	</div>
  </div>			         
			        </div>
				    </div>
				    <div class="card-reveal">
				      <span class="card-title grey-text text-darken-4"><?php echo $arr_all[$i+$j-2]['fname']; ?><i class="material-icons right">close</i></span>
				      <p><?php echo $arr_all[$i+$j-2]['description']; ?></p>

                       <h2>Rating</h2>
					 <?php
					 $k = 0;
					 $food_id = $arr_all[$i+$j-2]['id'];

			// Get the food_id for the current review
		
			// Select orders for the current food_id
			$sql = 'SELECT * FROM orders WHERE food_id = :food_id';
			$query = $pdoconn->prepare($sql);
			$query->bindParam(':food_id', $food_id, PDO::PARAM_INT);
			$query->execute();
		
			// Fetch the results
			$arr_all_p = $query->fetchAll(PDO::FETCH_ASSOC);
			for ($p = 1; $p < count($arr_all_p); $p++) {

			// Iterate through each order
			foreach ($arr_all_p as $order) {
				// Display the review associated with this order
				echo $order['review'];
				echo "<br>";
			}
		}

?>
				    </div>
				  </div>
			</div>

			<?php } ?>

			<?php $i = $i + 3; ?>


		</div>

		<?php
				}
			} 
		?>




	</div>
	
</section>