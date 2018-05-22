<?php require('db_connect.php');
    session_start();

$user = $_SESSION['id'];

$old = $conn->query("SELECT fname, lname, table_id, reserved_for, people FROM users INNER JOIN reservations ON users.id=reserved_by INNER JOIN tables ON tables.id=table_id WHERE reserved_by=$user AND reserved_for<now()");

	if($old->num_rows > 0):

	while($row_old = $old->fetch_assoc()):
		$res_fname[] = $row_old['fname'];
		$res_lname[] = $row_old['lname'];
		$res_table[] = $row_old['table_id'];
		$res_date[] = $row_old['reserved_for'];
		$res_people[] = $row_old['people'];
		$reservations = TRUE;
	endwhile;

else:

	$none = "Δεν έχετε κάνει καμία κράτηση στο παρελθόν.";

endif;

?>

<!doctype html>
<html>
<?php include('header.php'); ?>

<body>

<?php include ('navigation.php'); ?>


<section id="history" class="main">

<div class="container pt-2 pb-5">

<?php   if(isset($none)): ?>

              <div class="alert alert-danger p-2 mt-2" role="alert">
                    <?= $none;      ?>

              </div>

    <?php else: ?>
<h4 class="text-center pb-3">ΙΣΤΟΡΙΚΟ ΚΡΑΤΗΣΕΩΝ</h4>
<table class="table table-striped text-center">
<thead class="thead-dark">
<tr>

<th scope="col">ΗΜΕΡΟΜΗΝΙΑ ΚΡΑΤΗΣΗΣ</th>
<th scope="col">ΑΡΙΘΜΟΣ ΤΡΑΠΕΖΙΟΥ</th>
<th scope="col">ΑΡΙΘΜΟΣ ΑΤΟΜΩΝ</th>
</tr>
</thead>
<tbody>

<?php for($i=0; $i<sizeof($res_fname); $i++): ?>

<tr>

<td scope="row"><?= $res_date[$i]; ?></td>
<td><?= $res_table[$i]; ?></td>
<td><?= $res_people[$i]; ?></td>
</tr>

<?php endfor;  ?>

</tbody>

</table>

<?php endif; ?>
</div>

	</section>



<?php include('footer.php') ?>

</body>
</html>
