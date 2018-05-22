<?php require('db_connect.php');

    session_start();


    if(isset($_POST['edit_tab'])):

    	$edit_people = $_POST['edit_people'];
      $edit_id = $_POST['edit_id'];

    	$edit = $conn->query("UPDATE tables SET people=$edit_people WHERE id=$edit_id");

    	if($edit===TRUE):
    		$success = "Η τροποποίηση των ατόμων του τραπεζιού πραγματοποιήθηκε με επιτυχία.";
    	else:
    		$fail = "Η τροποποίηση των ατόμων του τραπεζιού απέτυχε.";
    	endif;

    else:

    endif;




if(isset($_POST['add_tab'])):

	$people_num = $_POST['people_num'];

	$add = $conn->query("INSERT INTO tables (id, people) VALUES (NULL, $people_num)");

	if($add===TRUE):
		$success = "Η προσθήκη του τραπεζιού πραγματοποιήθηκε με επιτυχία.";
	else:
		$fail = "Η προσθήκη του τραπεζιού απέτυχε.";
	endif;

else:

endif;




if(isset($_POST['del_tab'])):

	$del = $_POST['tab_id'];

	$delete = $conn->query("DELETE FROM tables WHERE id=$del");

	if($delete===TRUE):
		$success = "Η κατάργηση του τραπεζιού πραγματοποιήθηκε με επιτυχία.";
	else:
		$fail = "Η κατάργηση του τραπεζιού απέτυχε.";
	endif;

else:

endif;

    ?>


<!doctype html>
<html>
<?php include('header.php'); ?>

<body>

<?php include ('navigation.php'); ?>

<section id="dashboard" class="main">



<div class="container pt-2 pb-5">


<h4 class="text-center pb-3">ΔΙΑΧΕΙΡΙΣΗ ΤΡΑΠΕΖΙΩΝ</h4>

<?php   if(isset($success) ): ?>

              <div class="alert alert-success p-2 mt-2 text-center" role="alert">
                    <?= $success;      ?>

              </div>

    <?php endif;
      if(isset($fail)):
    ?>

          <div class="alert alert-danger p-2 mt-2 text-center" role="alert">
                    <?= $fail;      ?>

              </div>

    <?php endif; ?>


<table  id="tables" class="table table-striped text-center mb-5">
<thead class="thead-dark">

<tr>

<th scope="col">ΚΩΔΙΚΟΣ ΤΡΑΠΕΖΙΟΥ</th>
<th scope="col">ΑΡΙΘΜΟΣ ΑΤΟΜΩΝ</th>
<th scope="col">ΤΡΟΠΟΠΟΙΗΣΗ ΘΕΣΕΩΝ</th>
<th scope="col">ΠΡΟΣΘΗΚΗ ΤΡΑΠΕΖΙΟΥ</th>
<th scope="col">ΚΑΤΑΡΓΗΣΗ ΤΡΑΠΕΖΙΟΥ</th>
</tr>

</thead>
<tbody>


<?php

$tables = $conn->query("SELECT id, people FROM tables");
	if($tables->num_rows > 0):
		while($row_tab = $tables->fetch_assoc()):

?>

<tr>
<td><?= $row_tab['id']; ?></td>
<td><?= $row_tab['people']; ?></td>
<td><button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#editab<?= $row_tab['id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>
<td><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#addtab"><i class="fa fa-plus" aria-hidden="true"></i></button></td>
<td><button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deltab<?= $row_tab['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
</tr>





<!-- Modal -->
<div class="modal fade" id="editab<?= $row_tab['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form id="editab" name="editab" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Κωδικός τραπεζιού: <?= $row_tab['id']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label for="people_num">Aριθμός ατόμων:&emsp;</label>
      	<input type="number" id="edit_people" name="edit_people" class="text-center" min="1" max="6" step="1" placeholder="<?= $row_tab['people'] ?>">
      	<input type="number" id="edit_id" name="edit_id" value="<?= $row_tab['id']; ?>" hidden>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Ακύρωση</button>
        <button type="submit" name="edit_tab" id="edit_tab" class="btn btn-outline-success">Τροποποίηση</button>
      </div>
  </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addtab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form id="deltab" name="deltab" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Θέλετε πρσθέσετε το τραπέζι;</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<label for="people_num">Aριθμός ατόμων:&emsp;</label>
      	<input type="number" id="people_num" name="people_num" class="text-center" min="1" max="6" step="1" required>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Ακύρωση</button>
        <button type="submit" name="add_tab" id="add_tab" class="btn btn-outline-success">Προσθήκη</button>
      </div>
  </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="deltab<?= $row_tab['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form id="deltab" name="deltab" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Κωδικός τραπεζιού: <?= $row_tab['id']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<input type="number" name="tab_id" value="<?= $row_tab['id']; ?>" hidden>
       Θέλετε καταργήσετε το τραπέζι;
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Ακύρωση</button>
        <button type="submit" name="del_tab" id="del_tab" class="btn btn-outline-danger">Κατάργηση</button>
      </div>
  </form>
    </div>
  </div>
</div>

<?php 	endwhile;

	endif; ?>

</tbody>
</table>


</div>




<?php include('footer.php') ?>
</body>
</html>
