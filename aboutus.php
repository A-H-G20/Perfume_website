<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

        <div class="shopping-cart">
            <div class="box">
                <i class="fas fa-trash"></i>
                <img src="./Men's France Collection/IMG-20240503-WA0212.jpg" alt="">
                <div class="content">
                    <h3>SAUVAGE Dior</h3>
                    <span class="price">$230/-</span>
                    <span class="quantity">qty: 1</span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-trash"></i>
                <img src="./Men's Italian Collection/IMG-20240503-WA0522.jpg" alt="">
                <div class="content">
                    <h3>YOU</h3>
                    <span class="price">$159/-</span>
                    <span class="quantity">qty: 1</span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-trash"></i>
                <img src="./Men's Arab Collection/IMG-20240504-WA0351.jpg" alt="">
                <div class="content">
                    <h3>Fattan</h3>
                    <span class="price">$15/-</span>
                    <span class="quantity">qty: 2</span>
                </div>
            </div>
            <div class="total">total: $419/-</div>
            <a href="checkout.html" class="btn">checkout</a>
        </div>

        <form action="" class="login-form">
            <h3>login now</h3>
            <input type="email" placeholder="your email" class="box">
            <input type="password" placeholder="your password" class="box">
            <p>forget your password <a href="#">click here</a></p>
            <p>don't have an account <a href="#">create now</a></p>
            <input type="submit"  value="login now" class="btn">
        </form>

    </header>



    <main>
        <div id="about">
            <h1>Who We Are?</h1>
            <p> <i class="fa-solid fa-user-tie"></i>Perfume Luxury Store</p>
            <p>  <i class="fa-solid fa-users"></i>We are team of 3</p>
    
            <p> <i class="fa-solid fa-calendar-days"></i> Started on 1/1/2023</p>
            <p><i class="fa-solid fa-clock"></i>Opened from 8am to 5pm,</p>
            <p><i class="fa-solid fa-gift"></i> Choose your special perfume</p>
            <p><i class="fa-solid fa-location-dot"></i> Lebanon, tyre</p>
       </div>
    </main>

    <footer>
        <h1>"Fill the Senses with the Mysterious"</h1>
        <div class="icons">
          <a href="https://www.facebook.com"> <i
              class="fa-brands fa-square-facebook"></i></a>
          <a href="https://www.instagram.com">
            <i class="fa-brands fa-square-instagram"></i></a>
          <a href="https://wa.me"> <i class="fa-brands fa-square-whatsapp"></i></a>
          <p>Copyright &copy; 2024 PerfumeLuxury®. All rights reserved</p>
    
          <!-- <img src="" alt="" width="200px" height="200px"> -->
        </div>
      </footer>

    <script src="js/all.js"></script>

</body>
</html>