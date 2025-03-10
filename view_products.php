<?php

include 'components/connect.php';
if(isset(($_COOKIE['user_id']))){

    $user_id = $_COOKIE['user_id'];

}
else{
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

if(isset($_POST['add_to_cart'])){
    $id = create_unique_id();
    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id);
    $qty = $_POST['qty'];
    $qty = filter_var($qty);

    $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
    $verify_cart->execute([$user_id, $product_id]);

    $max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $max_cart_items->execute([$user_id]);

    if($verify_cart->rowCount() > 0){
        $warning_msg[] = 'Already added to cart!';
    }else if($max_cart_items->rowCount() == 12){
        $warning_msg[] = 'Cart is full!';
    }else{

        $select_p = $conn->prepare("SELECT * FROM  `product` WHERE id= ? LIMIT 1");
        $select_p->execute([$product_id]);
        $fetch_p =$select_p->fetch(PDO::FETCH_ASSOC);

        $insert_cart = $conn->prepare("INSERT INTO `cart`(id, user_id, product_id, price, qty) VALUES (?,?,?,?,?)");
        $insert_cart->execute([$id, $user_id, $product_id, $fetch_p['price'], $qty]);

        $success_msg[] = 'Add to cart!';
    }


}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
     <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- //custom css file link -->
    <link rel="stylesheet" href="assets/css/style.css">
  

<style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .banner {
            width: 100%;
            display: block;
        }
        .navbar {
            background-color:rgb(14, 58, 70);
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 15px;
            font-size: 18px;
        }
        .nav-links a:hover {
            background-color:rgb(10, 50, 67);
        }
        .time {
            font-size: 16px;
            margin-right: 20px;
        }
    </style>

<style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            font-weight: 300;
        }
        .banner {
            width: 100%;
            display: block;
        }
        .navbar {
            background-color:rgb(13, 44, 59);
            padding: 15px;
            text-align: center;
            border-radius: 10px 10px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            font-size: 18px;
            cursor: pointer;
        }
        .navbar a:hover {
            background-color:rgb(13, 57, 76);
            border-radius: 10px 10px;
            box-shadow: var(--box-shadow);
        }
    </style>

    <style>
      .navbar .time{
        align-items: end;
      }
    </style>

<style>
       

       footer {
          
           background-color: #f8f8f8;
           padding: 30px 50px;
           color: #333;
       
       }
       
       .footer-container {
           display: flex;
           justify-content: space-between;
           flex-wrap: wrap;
       }
       
       .footer-section {
           flex: 1;
           min-width: 200px;
           margin-bottom: 20px;
       }
       
       .footer-section h3 {
           font-size: 16px;
           font-weight: bold;
           margin-bottom: 10px;
       }
       
       .footer-section ul {
           list-style: none;
           padding: 0;
       }
       
       .footer-section ul li {
           margin-bottom: 5px;
           font-size: 14px;
       }
       
       .footer-section p {
           font-size: 14px;
           margin: 5px 0;
       }
       
       .social-icons {
           margin-top: 10px;
       }
       
       .social-icons i {
           font-size: 20px;
           margin-right: 10px;
           cursor: pointer;
       }
       
       .footer-bottom {
           display: flex;
           justify-content: space-between;
           align-items: center;
           margin-top: 20px;
           border-top: 1px solid #ccc;
           padding-top: 20px;
       }
       
       .payments img, .app-links img {
           width: 100px;
           margin-right: 10px;
       }
       
           </style>


<style>
        .ad-container {
  display: flex;
  flex-direction: row;
  overflow: hidden;
  width: 100%;
  position: relative;
}

.ad {
  min-width: 200px;
  margin: 10px;
  background-color: #f9f9f9;
  padding: 20px;
  text-align: center;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  position: relative;
  transform: translateX(100%);
  animation: slideIn 5s infinite alternate;
}

@keyframes slideIn {
  0% {
    transform: translateX(100%);
  }
  100% {
    transform: translateX(-100%);
  }
}

.ad img {
  width: 650PX;
  height: 325px;
 
  border-radius: 5px;
}

.ad p {
  font-size: 18px;
  font-weight: bold;
}

.ad a {
  display: inline-block;
  padding: 10px 20px;
  background-color: #007BFF;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  margin-top: 10px;
}

    </style>

<style>
        
        .flash-sale-title {
            font-size: 2.5em;
            font-weight: bold;
            margin: 20px 0;
            cursor: pointer;
            text-align: center;
        }
        .countdown {
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .carousel-container {
             font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #ff9900, #ff6600);
            color: #fff;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            width: 90%;
            margin: auto;
        }
        .product-carousel {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 20px;
        }
        .product-card {
            background: #fff;
            color: #000;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            min-width: 200px;
        }
        .product-card img {
            width: 100%;
            border-radius: 10px;
        }
        .price {
            font-size: 1.2em;
            color: red;
        }
        .original-price {
            text-decoration: line-through;
            color: gray;
            font-size: 0.9em;
        }
        .buy-now {
            background: #ff6600;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
        }
        .prev, .next {
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
        .prev { left: 10px; }
        .next { right: 10px; }
    </style>


</head>
<body>
    <!-- header section starts -->
    <?php include 'components/header.php'; ?>

    <img src="assets/Image/Top-Heading-banner_E-Tax-3 (1).webp" alt="Banner" class="banner">

<nav class="navbar">
    <div class="nav-links">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
    </div>
    <div class="time" id="current-time"></div>
</nav>

<script>
    function updateTime() {
        const now = new Date();
        document.getElementById("current-time").textContent = now.toLocaleTimeString();
    }
    setInterval(updateTime, 1000); // Update every second
    updateTime(); // Initialize time immediately
</script>
    
    

    <script>
        // Optional JavaScript for dynamic interactions, if needed
        // Here it's just setting up some basic behavior on hover, no major changes needed.

        const images = document.querySelectorAll('.animated-image');

        images.forEach(image => {
            image.addEventListener('mouseenter', function() {
                this.style.transition = 'transform 0.4s ease, filter 0.4s ease';
            });

            image.addEventListener('mouseleave', function() {
                this.style.transition = 'transform 0.4s ease, filter 0.4s ease';
            });
        });
    </script>


<div class="ad-container">
       
          <div class="ad">
            <img src="assets/Image/I.webp" alt="Ad 2">
            <p>Exclusive Discounts Available Now!</p>
            <a href="#">Shop Now</a>
          </div>
          <div class="ad">
            <img src="assets/Image/II.webp" alt="Ad 2">
            <p>Exclusive Discounts Available Now!</p>
            <a href="#">Shop Now</a>
          </div>
          <div class="ad">
            <img src="assets/Image/III.webp" alt="Ad 2">
            <p>Exclusive Discounts Available Now!</p>
            <a href="#">Shop Now</a>
          </div>
          <div class="ad">
            <img src="assets/Image/IIII.webp" alt="Ad 2">
            <p>Exclusive Discounts Available Now!</p>
            <a href="#">Shop Now</a>
          </div>
          <div class="ad">
            <img src="assets/Image/e.webp" alt="Ad 2">
            <p>Exclusive Discounts Available Now!</p>
            <a href="#">Shop Now</a>
          </div>
</div>

      <script>
        const ads = document.querySelectorAll('.ad');
let currentIndex = 0;

function changeAd() {
  ads.forEach((ad, index) => {
    ad.style.display = (index === currentIndex) ? 'block' : 'none';
  });

  currentIndex = (currentIndex + 1) % ads.length;
}

setInterval(changeAd, 3000); // Change ad every 3 seconds

      </script>


  <script>
    // Function to trigger the animation
    function animateAd() {
      const adImage = document.getElementById('adImage');
      const adText = document.getElementById('adText');

      // Scale the image
      adImage.style.transform = 'scale(1.1)';

      // Fade in the text
      adText.style.opacity = '1';

      // Reset after animation
      setTimeout(() => {
        adImage.style.transform = 'scale(1)';
        adText.style.opacity = '0';
      }, 3000); // Reset after 3 seconds
    }

    // Run the animation every 5 seconds
    setInterval(animateAd, 5000);

    // Run the animation once on page load
    window.onload = animateAd;
  </script>


    <!-- <header style="text-align: center; font-size:large">
       
            <span id="days" style="color: #ff9900; font-weight: bold; font-size: medium;">00</span> <span style="font-weight: 300;">Days </span>
            <span id="hours" style="color: #ff9900; font-weight: bold;">00</span> Hours 
            <span id="minutes" style="color: #ff9900; font-weight: bold;">00</span> Minutes 
            <span id="seconds" style="color: #ff9900; font-weight: bold;">00</span> Seconds
        
    </header> -->
    <h1 class="flash-sale-title" style="color: #ff9900; font-size: 40px;">FLASH <span style="color: #000; font-size:30px; font-weight: 100;">SALE</span></h1>
    <div class="carousel-container">
        <button class="prev" onclick="scrollCarousel(-1)">&#9664;</button>
        <div class="product-carousel">
            <div class="product-card">
                <img src="assets/Image/a (2).webp" alt="Product 1">
                <h3>Product Name</h3>
                <p class="price">$199 <span class="original-price">$299</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/Image/b (2).webp" alt="Product 2">
                <h3>Another Product</h3>
                <p class="price">$99 <span class="original-price">$150</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/Image/c (2).webp" alt="Product 2">
                <h3>Another Product</h3>
                <p class="price">$99 <span class="original-price">$150</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/Image/d (2).webp" alt="Product 2">
                <h3>Another Product</h3>
                <p class="price">$99 <span class="original-price">$150</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/Image/e (2).webp" alt="Product 2">
                <h3>Another Product</h3>
                <p class="price">$99 <span class="original-price">$150</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/Image/h.webp" alt="Product 2">
                <h3>Another Product</h3>
                <p class="price">$99 <span class="original-price">$150</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/Image/z.webp" alt="Product 2">
                <h3>Another Product</h3>
                <p class="price">$99 <span class="original-price">$150</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/Image/j.webp" alt="Product 2">
                <h3>Another Product</h3>
                <p class="price">$99 <span class="original-price">$150</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/Image/k.webp" alt="Product 2">
                <h3>Another Product</h3>
                <p class="price">$99 <span class="original-price">$150</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
           
            <div class="product-card">
                <img src="assets/Image/n.webp" alt="Product 2">
                <h3>Another Product</h3>
                <p class="price">$99 <span class="original-price">$150</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/Image/o.webp" alt="Product 2">
                <h3>Another Product</h3>
                <p class="price">$99 <span class="original-price">$150</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/Image/p.webp" alt="Product 2">
                <h3>Another Product</h3>
                <p class="price">$99 <span class="original-price">$150</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/Image/q.webp" alt="Product 2">
                <h3>Another Product</h3>
                <p class="price">$99 <span class="original-price">$150</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/Image/r.webp" alt="Product 2">
                <h3>Another Product</h3>
                <p class="price">$99 <span class="original-price">$150</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/Image/s.png" alt="Product 2">
                <h3>Another Product</h3>
                <p class="price">$99 <span class="original-price">$150</span></p>
                <button class="buy-now">Add to Cart</button>
            </div>
            
        </div>
        <button class="next" onclick="scrollCarousel(1)">&#9654;</button>
    </div>
    
    <script>
        function updateCountdown() {
            const targetDate = new Date().getTime() + 86400000;
            setInterval(() => {
                const now = new Date().getTime();
                const difference = targetDate - now;
                document.getElementById("days").innerText = Math.floor(difference / (1000 * 60 * 60 * 24));
                document.getElementById("hours").innerText = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                document.getElementById("minutes").innerText = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                document.getElementById("seconds").innerText = Math.floor((difference % (1000 * 60)) / 1000);
            }, 1000);
        }
        function scrollCarousel(direction) {
            document.querySelector(".product-carousel").scrollBy({ left: direction * 220, behavior: 'smooth' });
        }
        updateCountdown();
    </script>



     <!-- view product section starts -->
      <section class="products">
        <h1 class="heading">all products</h1>
        <div class="box-container">
            <?php
                 $select_products = $conn->prepare("SELECT * FROM `product`");
                 $select_products->execute();
                 if($select_products->rowCount() > 0){
                    while($fetch_product =$select_products->fetch(PDO::FETCH_ASSOC)){

                

            ?>
              <form action="" method="POST" class="box">
                <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
                <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="Image" style="width: 200px;  height: 200px; cursor: pointer; " alt="">
                <h3 class="name"><?= $fetch_product['name']; ?></h3>
                <div class="flex">
                   <p class="price"><i class="fas fa-dollar-sign"></i><?= $fetch_product['price'];?></p>
                   <input type="number" name="qty" maxlength="2" min="1" value="1" max="99" required  class="qty">
                </div>
                <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="delete-btn">Buy now</a>
                <input type="submit" value="add to cart" name="add_to_cart" class="btn">
              </form>
            <?php
                     }
                    }
                    else{
                       echo '<p class="empty">no products found!</p>';
                    }
            ?>

        </div>
      </section>

      <!-- view product section end -->
  
  







      <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>About Global House</h3>
                <ul>
                    <li>About Us</li>
                    <li>Best products for using</li>
                </ul>
                <h3>Investors</h3>
                <ul>
                    <li>Investor Relations</li>
                    <li>Contact Investor Relations</li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Work With Us</h3>
                <ul>
                    <li>Careers</li>
                    <li>Register as a Customer</li>
                </ul>
                <h3>Online Shopping</h3>
                <ul>
                    <li>Store Locations</li>
                    <li>Credit Card Payments</li>
                    <li>Global Service</li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Policies</h3>
                <ul>
                    <li>Privacy Policy</li>
                    <li>Terms of Use</li>
                    <li>Return & Exchange Policy</li>
                    <li>Cookie Policy</li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact Us</h3>
                <p><i class="fas fa-phone"></i> 1160</p>
                <p><i class="fas fa-envelope"></i> callcenter@globalhouse.co.ca</p>
                <p><i class="fas fa-map-marker-alt"></i>Terk la'ork ,Toul Kork, Phnom Penh, Cambodia</p>
                <p><i class="fas fa-clock"></i> Open Daily: 08:30 - 19:00</p>
                <div class="social-icons">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-line"></i>
                    <i class="fab fa-youtube"></i>
                    <i class="fab fa-tiktok"></i>
                    <i class="fab fa-twitter"></i>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="payments">
                <img src="assets/Image/visa-logo-freelogovectors.net_.png" style="cursor:pointer;" alt="Visa">
                <img src="assets/Image/Visa-Card-Logo-No-Background (1).png" style="cursor:pointer;" alt="MasterCard">
                <img src="assets/Image/acleda.jpg" style="cursor:pointer;" alt="JCB">
                <img src="assets/Image/aba.png" style="cursor:pointer;" alt="SCB">
            </div>
            <div class="app-links">
                <img src="assets/Image/play store.webp" style="width: 70px; height: 70px; cursor: pointer;" alt="/a">
                <img src="assets/Image/app store.png" style="width: 70px; height: 70px; cursor: pointer;" alt="App Store">
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- custom js file link -->
    <script src="assets/js/script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>