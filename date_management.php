<?php require('db_connect.php');

    session_start();

if(isset($_POST['date_upd'])):

    $day_upd = $_POST['day_upd'];
    $day_id = (int)$day_upd;
    $open = $_POST['opening_upd'];
    $opening_upd = date('H:i:s', strtotime($open));
    $close = $_POST['closing_upd'];
    $closing_upd = date('H:i:s', strtotime($close));


    $sql = $conn->query("SELECT day_id FROM days INNER JOIN hours ON days.id=day_id WHERE day_id=$day_id");
      if($sql->num_rows > 0):

          $d_update = $conn->query("UPDATE hours SET opened_at=$opening_upd, closed_at=$closing_upd WHERE day_id=$day_id");
              if($d_update===TRUE):
            		$success = "Η τροποποίηση του ωραρίου λειτουργίας πραγματοποιήθηκε με επιτυχία.";
            	else:
            		$fail = "Η τροποποίηση του ωραρίου λειτουργίας απέτυχε.";
            	endif;

      else:

        $d_edit = $conn->query("INSERT INTO hours (id, opened_at, closed_at, day_id) VALUES (NULL, '$opening_upd', '$closing_upd', $day_id)");
            if($d_edit===TRUE):
              $success = "Η τροποποίηση του ωραρίου λειτουργίας πραγματοποιήθηκε με επιτυχία.";
            else:
              $fail = "Η τροποποίηση του ωραρίου λειτουργίας απέτυχε.";
            endif;

      endif;

endif;


if(isset($_POST['day_close'])):

    $day_close_id = $_POST['day_close_id'];
    $day_close = (int)$day_close_id;


    $del = $conn->query("DELETE FROM hours WHERE day_id=$day_close");

              if($del===TRUE):
            		$success = "Η τροποποίηση της ημέρας αργίας πραγματοποιήθηκε με επιτυχία.";
            	else:
            		$fail = "Η τροποποίηση της ημέρας αργίας απέτυχε.";
            	endif;

endif;

    ?>


<!doctype html>
<html>
<?php include('header.php'); ?>

<body>

<?php include ('navigation.php'); ?>

<section id="dashboard" class="main">



<div class="container pt-2 pb-5">



<h4 class="text-center pb-3">ΔΙΑΧΕΙΡΙΣΗ ΩΡΑΡΙΟΥ</h4>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-open-tab" data-toggle="tab" href="#nav-open" role="tab" aria-controls="nav-open" aria-selected="true">Ωράριο λειτουργίας</a>
    <a class="nav-item nav-link" id="nav-close-tab" data-toggle="tab" href="#nav-close" role="tab" aria-controls="nav-close" aria-selected="false">Ημέρες αργίας</a>

  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-open" role="tabpanel" aria-labelledby="nav-open-tab">




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

        <?php endif;
    		if(isset($err_day)):
        ?>

        <div class="alert alert-danger p-2 mt-2 text-center" role="alert">
                        <?= $err_day;      ?>

                  </div>
              <?php endif; ?>



              <form name="opening" id="opening" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="d-block mr-auto ml-auto reg-form mt-5 mb-5">


                <div class="form-group">
                  <label for="day_upd">Ημέρα</label>
                <select id="day_upd" name="day_upd" class="form-control" required>
                  <option value="" disabled selected>Επιλέξτε ημέρα</option>
    <?php
        $days = $conn->query("SELECT id, day_name FROM days");
          if($days->num_rows > 0):
            while ($row_days = $days->fetch_assoc()):
    ?>

                    <option value="<?= $row_days['id'] ?>"><?= $row_days['day_name'] ?></option>

    <?php
            endwhile;
          endif;
    ?>
                </select>
                </div>

              <div class="form-group">
                <label for="opening_upd">Ανοικτά από:</label>
              <input type="time" class="form-control" id="opening_upd" name="opening_upd" required>
              </div>

              <div class="form-group">
                <label for="closing_upd">Ανοικτά μέχρι:</label>
              <input type="time" class="form-control" id="closing_upd" name="closing_upd" required>
              </div>

              <button type="submit" name="date_upd" id="date_upd" class="submit-btn btn btn-dark d-block mr-auto ml-auto">Υποβολή</button>



              </form>


  </div>








  <div class="tab-pane fade" id="nav-close" role="tabpanel" aria-labelledby="nav-close-tab">


              <form name="closing" id="closing" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="d-block mr-auto ml-auto reg-form mt-5 mb-5">


                <div class="form-group">
                  <label for="day_close">Ημέρα</label>
                <select id="day_close" name="day_close_id" class="form-control" required>
                  <option value="" selected disabled>Επιλέξτε ημέρα</option>
    <?php
        $days = $conn->query("SELECT id, day_name FROM days");
          if($days->num_rows > 0):
            while ($row_days = $days->fetch_assoc()):
    ?>

                    <option value="<?= $row_days['id'] ?>"><?= $row_days['day_name'] ?></option>

    <?php
            endwhile;
          endif;
    ?>
                </select>
                </div>


              <button type="submit" name="day_close" id="day_close" class="submit-btn btn btn-dark d-block mr-auto ml-auto">Υποβολή</button>



              <?php if (isset($fail)): ?>
              <div class="alert alert-danger p-2 mt-2" role="alert"><?= $fail; ?></div>
              <?php endif; ?>


              </form>



  </div>
</div>








</div>




<?php include('footer.php') ?>
</body>
</html>
