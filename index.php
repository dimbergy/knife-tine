<?php require('db_connect.php');
    session_start();
?>
<!doctype html>
<html>
<?php include('header.php'); ?>

<body>

<?php include ('navigation.php'); ?>


<section id="home" class="main">



	  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="images/pic-1a.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="images/pic-2a.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="images/pic-3a.jpg" alt="Third slide">
    </div>
	  <div class="carousel-item">
      <img class="d-block w-100" src="images/pic-4a.jpg" alt="Fourth slide">
    </div>
	  <div class="carousel-item">
      <img class="d-block w-100" src="images/pic-5a.jpg" alt="Fifth slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

	<div class="container mt-5 mb-5">
		<div class="row">

			<div class="col-md-6">

				<center><img src="images/logo.png" width="324" height="187" alt=""/> </center>

				<h3 class="heading pt-5 pb-3">Κομψότητα, αυθεντικότητα και αισθητική</h3>

			<p>Αυτές είναι οι λέξεις που συνοψίζουν την ατμόσφαιρα και τη φιλοσοφία του Knife & Tine, που δημιουργήθηκε το 2014 στο Illinois του Chicago από Έλληνες ομογενείς και από φέτος λειτουργεί παράστημά του στην Αθήνα.</p>

			<p>Στα πιάτα μας χρησιμοποιούμε τα πιο φρέσκα προϊόντα και για αυτό το λόγο, τα μενού αλλάζουν ανάλογα με τα προϊόντα της εποχής, αλλά βέβαια και τη δημιουργική έμπνευση του σεφ μας. Ακροβατεί ανάμεσα στην παράδοση και το ταλέντο, στην κλασσική και τη μοντέρνα Γαλλική κουζίνα. Η παρουσίαση των πιάτων του ικανοποιεί την όραση, με φίνα αρώματα και μια δόση εξωτισμού στη γεύση.</p>

			<p>Αυτές οι δημιουργίες του σεφ μας, σερβίρονται εξαιρετικά από μια ενημερωμένη ομάδα σέρβις, μέσα σε ένα μοντέρνο πλαίσιο αισθητικής, όπως ταιριάζει σε ένα μέλος των “Les Grandes Tables du Monde”.</p>

			</div>



			<div class="col-md-6">

				<h5 class="heading pt-5 pb-3 text-center">ΒΡΕΙΤΕ ΜΑΣ</h5>
				<ul class="info">

					<li>
						<h4 class="text-center">Knife & Tine</h4>
					</li>

				<li>
					<i class="fa fa-home fa-2x" aria-hidden="true"></i> &emsp;Πύρρωνος 5, 11636, Παγκράτι, Αθήνα
					</li>
				<li>
				<i class="fa fa-phone fa-2x" aria-hidden="true"></i>
					&emsp;<a href="tel:00302107564021">+30 2107 564 021</a>
					</li>

				<li>
				<i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
					&emsp;<a href="mailto:info@knife-tine.com">info@knife-tine.com</a>
					</li>


					<li>
						<i class="fa fa-motorcycle fa-2x" aria-hidden="true">
						</i>
						&nbsp;<span class="font-weight-bold align-top">Το κατάστημά μας διαθέτει υπηρεσία delivery.</span><br /> <span class="font-weight-bold text-center d-block pt-3">Ώρες διανομής:</span><br />  <span class="text-center d-block">Καθημερινές 21:00-00:00</span><br /><span class="text-center d-block">Σάββατο & Κυριακή 13:00-12:00</span>
					</li>
				</ul>

			</div>
		</div>
	</div>



		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3143.6246575537675!2d23.80815431538169!3d38.009214506409265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14a198532e2c0801%3A0x6d2f97897f3905f5!2sTerpsitheas+4%2C+Ag.+Paraskevi+153+41!5e0!3m2!1sen!2sgr!4v1524966704362" frameborder="0" style="border:0; width:100%; height: 500px" allowfullscreen></iframe>

</section>
<?php include('footer.php') ?>
</body>
</html>
