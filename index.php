<?php
//Mengirimkan Token Keamanan Ajax Request (Csrf Token)
session_start();
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
    
    <html>
    <head>
        
        <meta name="csrf-token" content="<?= $_SESSION['csrf_token'] ?>">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Komentar - Update Corona</title>

		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

		<link href="css/clean-blog.min.css" rel="stylesheet">
    </head>
    <body>
      <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="index.html">Update Corona</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">Tentang Saya</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Komentar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="masthead" style="background-image: url('img/telpon.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>komentar</h1>
            <span class="subheading">tempat semua berimajinasi</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
		<p><h3>jika ada yang masih kuranag jelas bisa anda diskusikan di sini ya</h3></p>
		
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

			<div class="container mb-3">
				<form method="POST" id="form_komen">
					<div class="form-group">
						<input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" placeholder="Masukkan Nama" />
					</div>
					<div class="form-group">
						<textarea name="komen" id="komen" class="form-control" placeholder="Tulis Komentar" rows="5"></textarea>
					</div>
					<div class="form-group">
						<input type="hidden" name="komentar_id" id="komentar_id" value="0" />
						<input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
					</div>
				</form>
				<hr>
				<h4 class="mb-3">Komentar :</h4>
				<span id="message"></span>
			
				<div id="display_comment"></div>
			</div>

			<script>
				$(document).ready(function(){
					$.ajaxSetup({
							headers : {
								'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
							}
							});
				
					$('#form_komen').on('submit', function(event){
						event.preventDefault();
						var form_data = $(this).serialize();
						$.ajax({
							url:"tambah_komentar.php",
							method:"POST",
							data:form_data,
							success:function(data){
								$('#form_komen')[0].reset();
								$('#komentar_id').val('0');
								load_comment();
							}, error: function(data) {
								console.log(data.responseText)
							}
						})
					});

					load_comment();

					function load_comment(){
						$.ajax({
							url:"ambil_komentar.php",
							method:"POST",
							success:function(data){
								$('#display_comment').html(data);
							}, error: function(data) {
								console.log(data.responseText)
							}
						})
					}

					$(document).on('click', '.reply', function(){
						var komentar_id = $(this).attr("id");
						$('#komentar_id').val(komentar_id);
						$('#nama_pengirim').focus();
					});
				});
			</script>
		</div>
    </div>
  </div>
  <hr>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </li>
          <li class="list-inline-item">
            <a href="#">
              <span class="fa-stack fa-lg">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
              </span>
            </a>
          </li>
        </li>
        <li class="list-inline-item">
          <a href="#">
            <span class="fa-stack fa-lg">
              <i class="fas fa-circle fa-stack-2x"></i>
              <i class="fab fa-linkedin fa-stack-1x fa-inverse"></i>
            </span>
          </a>
        </li>
          </ul>
          <p class="copyright text-muted">Copyright &copy; Adhitya Izza 2020</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <script src="js/clean-blog.min.js"></script>


    </body>
    </html>