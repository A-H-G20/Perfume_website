
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfume Luxury</title>
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-REbMhQ/SLg4MkBRo4DqcS8k3nQVK0u/58GK2D29+Xg+5gQET1b9s/yY78A7dqGFWKqOz19dYSL4y1j9iJMBC7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>
  <div class="banner">
    <video class="video-slide active" src="./pinterest-720p-3.mp4" autoplay muted loop> </video> 
    <div class="navbar">
      <img src="./logo.png" alt="logo" class="logo">
      <ul>
        <li><a href="index.php">home</a></li>
        <li><a href="new_arivale.php">newArrivals</a></li>
        <li><a href="collections.php">Collections</a></li>
        <li><a href="order.php">My order</a></li>
        <li><a href="aboutUs.php">About Us</a></li>
      </ul>
    </div>

    <div class="content">
      <h1>"Scented Splendor Awaits"</h1>
      <p>"Embark on a sensory journey through our curated collection of captivating perfumes. <br> Indulge in elegance and discover your signature scent today."</p>
      <div>
        <button type="button"><span></span>View More</button>
        <button type="button" onclick="window.location.href='login.php';">Login</button>


      </div>
    </div>

    <div class="icons">
      <a href="https://www.facebook.com"> <i class="fab fa-facebook-f"></i></a>
      <a href="https://www.instagram.com"> <i class="fab fa-instagram"></i></a>
      <a href="https://wa.me/76832282"> <i class="fab fa-whatsapp"></i></a>
    </div>

  </div>

<!-- <script>
const slides = document.querySelectorAll('.slide');
let currentSlide = 0;

function nextSlide() {
  slides[currentSlide].classList.remove('active');
  currentSlide = (currentSlide + 1) % slides.length;
  slides[currentSlide].classList.add('active');
}

setInterval(nextSlide, 5000);

</script> -->

</body>
</html>