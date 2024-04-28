<?php require('layout/header.php'); ?>
<?php require('layout/left-sidebar-long.php'); ?>
<?php require('layout/topnav.php'); ?>
<?php require('layout/left-sidebar-short.php'); ?>


<?php

require('../backends/connection-pdo.php');

$sql = 'SELECT orders.order_id, orders.user_name, orders.timestamp, orders.payment, orders.comment, orders.review, orders.Time, orders.Statues, food.fname FROM orders LEFT JOIN food ON orders.food_id = food.id';

$query  = $pdoconn->prepare($sql);
$query->execute();
$arr_all = $query->fetchAll(PDO::FETCH_ASSOC);



?>
						

<div class="section white-text" style="background: #B35458;">

	<div class="section">
		<h3>Orders</h3>
	</div>

  <?php

    if (isset($_SESSION['msg'])) {
        echo '<div class="section center" style="margin: 5px 35px;"><div class="row" style="background: red; color: white;">
        <div class="col s12">
            <h6>'.$_SESSION['msg'].'</h6>
            </div>
        </div></div>';
        unset($_SESSION['msg']);
    }

    ?>
	
	<div class="section center" style="padding: 20px;">
		<table class="centered responsive-table">
        <thead>
          <tr>
              <th>Order ID</th>
              <th>Payment Id</th>
              <th>User Name</th>
              <th>Food Name</th>
              <th>Comment</th>
              <th>Review</th>
              <th>Timestamp</th>
              <th>Time & Statues</th>
              <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php

            foreach ($arr_all as $key) {

          ?>
          
    <tr>
        <td><?php echo $key['order_id']; ?></td>
        <td><?php echo $key['payment']; ?></td>
        <td><?php echo $key['user_name']; ?></td>
        <td><?php echo $key['fname']; ?></td>
        <td><?php echo $key['comment']; ?></td>
        <td><?php echo $key['review']; ?></td>
        <td><?php echo $key['timestamp']; ?></td>

        <td>
        <form action="update_order.php" method="POST">

            <input type="hidden" name="order_id" value="<?php echo $key['order_id']; ?>">
           <input type="number" name="Time" value="<?php echo $key['Time']; ?>" required><br>
            <select name="Statues">
                <option value="<?php if($key['Statues'] == ""){echo "Pending";}else{echo $key['Statues'];}  ?>"><?php if($key['Statues'] == ""){echo "Pending";}else{echo $key['Statues'];}  ?></option>
                <option value="Complete">Complete</option>
                <option value="Pending">Pending</option>
            </select>
            <td><button class="btn btn-primary" type="submit">Update</button></td>

            </form>
        </td>
        <td>
            
        </td>
    </tr>
      

          

          <?php } ?>
         
        </tbody>
      </table>
	</div>
</div>

<?php require('layout/about-modal.php'); ?>
<?php require('layout/footer.php'); ?>