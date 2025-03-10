<?php

include 'components/connect.php';
if(isset(($_COOKIE['user_id']))){

    $user_id = $_COOKIE['user_id'];

}
else{
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
     <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- //custom css file link -->
    <link rel="stylesheet" href="assets/css/style.css">

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
        /* Container for images */
        .image-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 5 equal-width columns */
            gap: 20px;
            margin: 50px auto;
            max-width: 1200px;
        }

        /* Styling for each image */
        .animated-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.4s ease, filter 0.4s ease; /* Smooth transition for effects */
            opacity: 0; /* Initially hidden */
            animation: slideIn 1s ease-out forwards, zoomIn 0.6s ease-out forwards; /* Slide and zoom animation */
        }

        /* Hover effect (zoom, rotate, brightness) */
        .animated-image:hover {
            transform: scale(1.1) rotate(10deg); /* Zoom and rotate */
            filter: brightness(1.2); /* Brightness increase */
        }

        /* Slide-in animation (from left to right) */
        @keyframes slideIn {
            from {
                transform: translateX(-100%); /* Start off-screen to the left */
                opacity: 0; /* Initially hidden */
            }
            to {
                transform: translateX(0); /* Slide to the original position */
                opacity: 1; /* Fade in */
            }
        }

        /* Zoom-in animation on load */
        @keyframes zoomIn {
            from {
                transform: scale(0.8); /* Start small */
            }
            to {
                transform: scale(1); /* Return to original size */
            }
        }
    </style>

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
            background-color: #004d26;
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
            background-color: #007a33;
        }
        .time {
            font-size: 16px;
            margin-right: 20px;
        }
    </style>
<!-- ---------------------------------- -->
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
            background-color:rgb(11, 72, 90);
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
<!-- ------------------------ -->
    <style>
      .navbar .time{
        align-items: end;
      }
    </style>
    
    <style>
    /* Container for the ad */
    .ad-container {
      display: flex;
      justify-content: space-between;
      margin: 20px;
      gap: 10px; /* Adds space between images */
    }
    /* Styling for each image */
    .ad-item {
      flex: 1;
      position: relative;
    }
    .ad-image {
      width: 100%;
      height: auto;
      border-radius: 8px; /* Optional: Adds rounded corners to images */
      transition: transform 1s ease-in-out;
    }
    /* Overlay text */
    .ad-text {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      font-size: 24px;
      font-weight: bold;
      opacity: 0;
      transition: opacity 0.5s ease;
    }
    /* Responsive design for smaller screens */
    @media (max-width: 768px) {
      .ad-container {
        flex-direction: column;
        align-items: center;
      }
      .ad-item {
        width: 80%; /* Stacks images vertically on smaller screens */
        margin-bottom: 10px;
      }
    }
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


    <div class="image-container">
        <img src="assets/Image/5.jpg" alt="Product Image 1" class="animated-image">
        <img src="assets/Image/1a.webp" alt="Product Image 2" class="animated-image">
        <img src="assets/Image/2a.webp" alt="Product Image 3" class="animated-image">
        <img src="assets/Image/3a.webp" alt="Product Image 4" class="animated-image">
        <img src="assets/Image/4a.webp" alt="Product Image 5" class="animated-image">
    </div>

    <div class="ad-container" style="background-color:#004d26; height:150% ; box-shadow:10px 10px 40px -7px aqua;">
    <div class="ad-item">
      <img src="assets/Image/I.webp" alt="Ad Image 1" class="ad-image">
      <div class="ad-text">Discount</div>
    </div>
    <div class="ad-item">
      <img src="assets/Image/II.webp" alt="Ad Image 2" class="ad-image">
      <div class="ad-text">Khmer New Year </div>
    </div>
    <div class="ad-item">
      <img src="assets/Image/III.webp" alt="Ad Image 3" class="ad-image">
      <div class="ad-text">Black Friday</div>
    </div>
    <div class="ad-item">
      <img src="assets/Image/IIII.webp" alt="Ad Image 4" class="ad-image">
      <div class="ad-text">Special Day</div>
    </div>
  </div>

  <script>
    // Function to trigger the animation
    function animateAd() {
      const adImages = document.querySelectorAll('.ad-image');
      const adTexts = document.querySelectorAll('.ad-text');

      adImages.forEach((image, index) => {
        // Scale the image
        image.style.transform = 'scale(1.1)';
        // Fade in the text
        adTexts[index].style.opacity = '1';

        // Reset after animation
        setTimeout(() => {
          image.style.transform = 'scale(1)';
          adTexts[index].style.opacity = '0';
        }, 3000); // Reset after 3 seconds
      });
    }

    // Run the animation every 5 seconds
    setInterval(animateAd, 5000);

    // Run the animation once on page load
    window.onload = animateAd;
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



<script>
    function updateTime() {
        const now = new Date();
        document.getElementById("current-time").textContent = now.toLocaleTimeString();
    }
    setInterval(updateTime, 1000); // Update every second
    updateTime(); // Initialize time immediately
</script>

    <section class="checkout">
         <h1 class="heading">checkout summary </h1>
         <div class="row">
            <form action="" method="POST">
                <h3>billing details</h3>
                <div class="flex">
                   <div class="box">
                    <p>your name <span>*</span></p>
                    <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="input">
                    <p>your email <span>*</span></p>
                    <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="input">
                    <p>your name <span>*</span></p>
                    <input type="number" name="number" required maxlength="10" min="10" max="999999999" placeholder="enter your number" class="input">
                    <p>payment method <span>*</span></p>
                    <select name="method" class="input" required>
                        <option  style="cursor: pointer;"value="cash on delivery">cash on delivery</option>
                        <option  style="cursor: pointer;"value="net banking">net banking</option>
                        <option  style="cursor: pointer;"value="credit or debit card">credit or debit card</option>
                        <option  style="cursor: pointer;"value="UPI or RuPay">UPI or RuPay</option>

                    </select>
                    <p>address type <span>*</span></p>
                    <select name="address_type" class="input" required>
                        <option  style="cursor: pointer;"value="home">home</option>
                        <option  style="cursor: pointer;"value="home">office</option>
                        
                    </select>
                   </div>
                   <div class="box">
                       <p>address line01 <span>*</span></p>
                       <input type="text" name="flat" required maxlength="50" placeholder="e.g. flat no & building no" class="input">
                       <p>address line02 <span>*</span></p>
                       <input type="text" name="" required maxlength="50" placeholder="e.g. flat street name" class="input">
                       <p>city name <span>*</span></p>
                       <input type="text" name="city" required maxlength="50" placeholder="enter your city name" class="input">
                       <p>country name <span>*</span></p>
                       <input type="text" name="country" required maxlength="50" placeholder="enter your country name" class="input">
                       <p>pin code <span>*</span></p>
                       <input type="number" name="pin_code" required maxlength="6" min="0" max="999999"  placeholder="enter your pin code" class="input">
                   </div>
                </div>
                <input type="submit" value="place order" name="place_order" class="btn">
            </form>   
    
         </div>
    </section>



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
                <img src="assets/Image/visa-logo-freelogovectors.net_.png" alt="Visa">
                <img src="assets/Image/Visa-Card-Logo-No-Background (1).png" alt="MasterCard">
                <img src="assets/Image/acleda.jpg" alt="JCB">
                <img src="assets/Image/aba.png" alt="SCB">
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