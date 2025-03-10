<?php

include 'components/connect.php';
if(isset(($_COOKIE['user_id']))){

    $user_id = $_COOKIE['user_id'];

}
else{
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

if(isset($_POST['add_product'])){

    $id = create_unique_id();
    $name = $_POST['name'];
    $name = filter_var($name,);
    $price = $_POST['price'];
    $price = filter_var($price,);

    $image = $_FILES['image']['name'];
    $image = filter_var($image,);

    $ext = pathinfo($image,PATHINFO_EXTENSION);
    $rename = create_unique_id().'.'.$ext;
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder ='uploaded_files/'.$rename;

    if($image_size > 2000000){

        $warning_msg[] = 'Image size is too large! ';

    }else{

        
        $insert_product = $conn->prepare("INSERT INTO `product`(id, name, price, image) VALUES (?,?,?,?)");
        $insert_product->execute([$id, $name, $price, $rename]);
        $success_msg[] = 'Product uploaded!';
        move_uploaded_file($image_tmp_name, $image_folder);

    }


    

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>


     <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- //custom css file link -->
    <link rel="stylesheet" href="assets/css/style.css">

    
        
       
   
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

    <style>
      .navbar .time{
        align-items: end;
      }
    </style>

    <!-- //footer -->

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

    <div class="image-container">
        <img src="assets/Image/5.jpg" alt="Product Image 1" class="animated-image">
        <img src="assets/Image/2a.webp" alt="Product Image 2" class="animated-image">
        <img src="assets/Image/3a.webp" alt="Product Image 3" class="animated-image">
        <img src="assets/Image/4a.webp" alt="Product Image 4" class="animated-image">
        <img src="assets/Image/5a.webp" alt="Product Image 5" class="animated-image">
    </div>
    <div class="image-container">
        <img src="assets/Image/a.webp" alt="Product Image 1" class="animated-image">
        <img src="assets/Image/b.webp" alt="Product Image 2" class="animated-image">
        <img src="assets/Image/e.webp" alt="Product Image 3" class="animated-image">
        <img src="assets/Image/c.webp" alt="Product Image 4" class="animated-image">
        <img src="assets/Image/d.webp" alt="Product Image 5" class="animated-image">
        
    </div>
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

    

    

     <!-- add product section starts -->
     <section class="add-product">
     <div> 
        <img src="assets/Image/port.webp" style="width:55%; height: 50%; object-fit: contain;" alt="">
    </div>
    <div> 
        <img src="assets/Image/port.jpg" style="width:55%; height: 50%; object-fit: contain;" alt="">
    </div>

        <form action="" method="POST" enctype="multipart/form-data">
           <h3>product details</h3>
           <p>product name <span>*</span></p>
            <input type="text" name="name" required maxlength="50"
            placeholder="enter product name" class="box">
            <p>product price <span>*</span></p>
            <input type="number" name="price" required maxlength="10" min="0"
            max="9999999999" placeholder="enter product price" class="box">
            <p>product image</p>
            <input type="file" name="image" required accept="image/*" class="box">
            <input type="submit" value="add product" name="add_product" class="btn">
            

        </form>
     </section>

 
     <!-- footer -->
   
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