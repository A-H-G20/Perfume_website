<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/collection.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
</head>
<body>
    <header class="header">
        <a href="#" class="logo"><i class="fas fa-shop-perfume"></i>Perfume Luxury</a>
        <nav class="navbar">
        <a href="index.php">home</a>
            <a href="new_arivale.php">newArrivals</a>
            <a href="collections.php">Collections</a>
            <a href="order.php">My order</a>
            <a href="aboutUs.php">About Us</a>
            <a href="logout.php">Logout</a>
        </nav>

        <div class="icons">
        <div class="fas fa-shopping-cart" id="cart-btn" onclick="window.location.href='cart.php';"></div>

        </div>

        <form action="" class="search-form">
            <input type="search" name="" id="search-box" placeholder="search here...">
            <label for="search-box" class="fas fa"></label>
        </form>

       
              
           

       

    </header>
 
    <!-- high -->
    <br> <br>
    <section class="high" id="high">
        <div class="content">
            <h3>Men's Perfume <span>Collection</span></h3>
            <a href="mens.php" class="btn">View Collection</a>
    </section>
    <!-- low -->
    <section class="low" id="low">
        <div class="content">
            <h3>Women's Perfume <span>Collection</span></h3>
            <a href="womens.php" class="btn">View Collection</a>
    </section>

    
    <footer>
        <h1>"Fill the Senses with the Mysterious"</h1>
        <div class="icons">
          <a href="https://www.facebook.com"> <i
              class="fa-brands fa-square-facebook"></i></a>
          <a href="https://www.instagram.com">
            <i class="fa-brands fa-square-instagram"></i></a>
          <a href="https://wa.me"> <i class="fa-brands fa-square-whatsapp"></i></a>
          <p>Copyright &copy; 2024 PerfumeLuxury®. All rights reserved</p>
    
          <!-- <img src="./images/image3.jpeg" alt="" width="200px" height="200px"> -->
        </div>
      </footer>


    


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    <script src="js/all.js"></script>

</body>
</html>