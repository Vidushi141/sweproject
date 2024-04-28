<?php
session_start();


require('backends/connection-pdo.php');
$user_id = $_SESSION['user_id'];


    $sql = "SELECT * FROM book_table WHERE user_id = ?";
    $query  = $pdoconn->prepare($sql);
    $query->execute([$user_id]);


$arr_all = $query->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>RES - Categories!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <meta http-equiv="refresh" content="1"> -->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Bree+Serif&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link rel="stylesheet" href="css/style.css">


</head>

<body>

    <?php require('chunks/login-modal.php'); ?>


    <?php require('chunks/register-modal.php'); ?>


    <?php require('chunks/info-modal.php'); ?>


    <?php require('chunks/navbar.php'); ?>


    <?php require('chunks/banner-slider.php'); ?>
     <form method="post" action="book_table_now.php">
       <div class="card">
        <div class="card-body">
            <input type="hidden" name="user_id" value="<?php echo $user_id?>">
            <input type="date" class="form-control " name="date" required>
            <input type="time" class="form-control " name="time" required>
            <select class="form-control " name="Table" required>
                <option value="Table 1">Table 1</option>
                <option value="Table 2">Table 2</option>
                <option value="Table 3">Table 3</option>
                <option value="Table 4">Table 4</option>
                <option value="Table 5">Table 5</option>
                <option value="Table 6">Table 6</option>
                <option value="Table 7">Table 7</option>
            </select>
            <button class="btn btn-primary w-100">Book Table</button>
        </div>
       </div>
     </form>

    <?php for ($i=1; $i <= count($arr_all); ) { ?>

    <div class="row">
        <?php for ($j=1; $j <= 3; $j++) { ?>


            <?php if ($i+$j-2 == count($arr_all)) {
                break;
            }  ?>

        <div class="col-6">
            <div class="card p-2 m-2">
                <p>Table - <?php echo $arr_all[$i+$j-2]['Table']; ?></p>
                <p>Date Time - <?php echo $arr_all[$i+$j-2]['date']; echo $arr_all[$i+$j-2]['time']; ?></p>
                

            </div>
        </div>
        <?php } ?>

        <?php $i = $i + 3; ?>

    </div>
    <?php
				}
			 
		?>









    <?php require('chunks/footer.php'); ?>



    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <script src="js/loaders.js"></script>
    <script src="js/ajax.js"></script>
</body>

</html>