<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
</style>

<body>

<?php include("app/features/header.php"); ?>





<section class="home">
  <div id="carousel" class="carousel slide" data-ride="carousel">

    <div class="carousel-controls">
      <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" style="background-image: url(img/photo-1495107334309-fcf20504a5ab.avif);"></li>
        <li data-target="#carousel" data-slide-to="1" style="background-image: url(img/photo-1444858291040-58f756a3bdd6.avif);"></li>
        <li data-target="#carousel" data-slide-to="2" style="background-image: url(img/photo-1543051932-6ef9fecfbc80.avif);"></li>
      </ol>

      <a class="carousel-control-prev" role="button" data-slide="prev" href="#carousel">
        <img src="img/left-arrow.svg" alt="Previous">
      </a>
      <a class="carousel-control-next" role="button" data-slide="next" href="#carousel">
        <img src="img/right-arrow.svg" alt="Next">
      </a>

    </div>
    
    <div class="carousel-inner">
  <div class="carousel-item active" style="background-image: url(img/photo-1495107334309-fcf20504a5ab.avif);">
    <div class="container">
      <p>Talk About Farming<p>
      <p>An online community for farming enthusiasts.</p>
    </div>
  </div>

  <div class="carousel-item" style="background-image: url(img/photo-1444858291040-58f756a3bdd6.avif);">
    <div class="container">
      <p>Interact and Share<pack>
      <p>Join the conversation and share your farming experiences.</p>
    </div>
  </div>

  <div class="carousel-item" style="background-image: url(img/1.avif);">
    <div class="container">
      <p>Your Concert<p>
      <p>Discover upcoming farming events and concerts near you.</p>
    </div>
  </div>
</div>


<script src="assets/js/script.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
