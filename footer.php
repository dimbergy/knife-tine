
<?php

$open = $conn->query("SELECT day_name, opened_at, closed_at FROM days INNER JOIN hours ON days.id=day_id ORDER BY days.id");
if ($open->num_rows > 0):

   while($row_open = $open->fetch_assoc()):
    $day[] = $row_open['day_name'];
    $open_at[] = $row_open['opened_at'];
    $close_at[] = $row_open['closed_at'];

   endwhile;


endif;
?>




<footer>
       <div class="container">
           <div class="row text-center">




                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 opening">
                  <ul class="adress">
                        <span>ΗΜΕΡΕΣ</span>


                        <?php for($i=0; $i<sizeof($day); $i++): ?>
                          <li><?= $day[$i]; ?></li>
                        <?php endfor; ?>

                  </ul>
                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 opening">
                    <ul class="adress">
                         <span>ΩΡΕΣ</span>

                         <?php for($i=0; $i<sizeof($day); $i++): ?>
                           <li><?= date('H:i', strtotime($open_at[$i])); ?> - <?= date('H:i', strtotime($close_at[$i])); ?></li>
                          <?php endfor; ?>



                  </ul>
                </div>





                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <ul class="menu">
                        <span>SITEMAP</span>
                        <li>
                            <a href="index.php">Αρχική</a>
                        </li>

                        <li>
                            <a href="login.php">Log In</a>
                        </li>

                        <li>
                           <a href="reservation.php">Νέα κράτηση</a>
                        </li>

                        <li>
                           <a href="history.php">Παλιές κρατήσεις</a>
                        </li>
                  </ul>
               </div>


               <div class="col-lg-12 col-lg-offset-2" id="icons">

                         <a href="#"><i class="fa fa-facebook"></i></a>

                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                         <a href="#"><i class="fa fa-linkedin"></i></a>

               </div>


           </div>
  </div>

	<?php include('scripts.php'); ?>
</footer>
