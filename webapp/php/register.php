<?php
    
    if(isset($_POST["submit"])){
        include_once("../dbconnect.php");
        $id=$_POST["id"];
        $contact = $_POST["contact"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $deposit = $_POST["deposit"];
        $date = $_POST["date"];
        $state = $_POST["state"];
        $area = $_POST["area"];
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        $sqlregister = "INSERT INTO `tbl_room`(`id`, `contact`, `title`, `description`, `price`, `deposit`, `state`, `area`, `date`, `latitude`, `longitude`)
         VALUES('$id', '$contact', '$title', '$description', '$price', '$deposit' , '$state', '$area','$date', '$latitude', '$longitude')";
    
        try{
            $conn->exec($sqlregister);
            if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])){
                uploadImage($id);
                echo "<script>alert('Registration successful')</script>";
                echo "<script>window.location.replace('mainpage.php')</script>";
            }    
            
        }catch (PDOException $e) {
                echo"<script>alert('Registration failed')</script>";
                echo "<script>window.location.replace('register.php')</script>";
            }
    }

        function uploadImage($id){
            $target_dir = "../res/images/";
            $target_file = $target_dir . $id . ".png";
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-aswsome.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <script src="../javascript/jscript.js"></script>
    <title>Customer Details</title>
</head>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
body, html {
  height: 100%;
  color: #777;
  line-height: 1.8;
}
/* Create a Parallax Effect */
.bgimg-1 {
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

/* First image (Logo. Full height) */
.bgimg-1 {
  background-image: url('https://q-xx.bstatic.com/xdata/images/hotel/840x460/159527836.jpg?k=f18ef60f1ac9b51a3173b47357b9fcda7ea4de22a2b423d9c908e2360d3e510e&o=?raw=true');
  min-height: 100%;
}

.w3-wide {letter-spacing: 10px;}
.w3-hover-opacity {cursor: pointer;}

/* Turn off parallax scrolling for tablets and phones */
@media only screen and (max-device-width: 1600px) {
  .bgimg-1{
    background-attachment: scroll;
    min-height: 400px;
  }
}

</style>

<body>
<div class="w3-header w3-container w3-padding-32 w3-center">
    <div class="bgimg-1 w3-display-container w3-opacity-min" id="home">
  <div class="w3-display-middle" style="white-space:nowrap;">
    <span class="w3-center w3-padding-large w3-black w3-xlarge w3-wide w3-animate-opacity">Rent <span class="w3-hide-small">A</span> Room</span>
  </div>
    </div>

    <div class="w3-header w3-container w3-green w3-padding w3-center">
    <a href="#contact" class="w3-bar-item w3-button w3-right">Logout</a>
    <a href="mainpage.php" class="w3-bar-item w3-button w3-left">Home</a>
    </div>
    
    <div class="w3-container w3-padding-64 form-container">
        <div class="w3-card">
            <div class="w3-container w3-green">
                <p>Room Registration</p>
            </div>
            <form class="w3-container w3-padding " name="registerForm" action="register.php" method="post" onsubmit="return confirmDialog()" enctype="multipart/form-data">
                <div class="w3-container w3-border w3-center w3-padding">
                    <img class="w3-image w3-round w3-margin"
                    src="../res/images/profile.png" style="width:100%;
                    max-width:600px"><br>
                    <input type="file" onchange="previewFile()" name="fileToUpload"
                    id="fileToUpload"><br>
                </div>

            
                <p>
                <label class="w3-text-black"><b>Room ID</b></label>
                <input class="w3-input w3-border w3-round" name="id" type="text" id="idroom" required>
            </p>

            <p>
                <label class="w3-text-black"><b>Contact</b></label>
                <input class="w3-input w3-border w3-round" name="contact" type="contact" id="idcontact" >
            </p>  

            <p>
                <label class="w3-text-black"><b>Title</b></label>
                <input class="w3-input w3-border w3-round" name="title" type="text" id="idtitle" >
            </p> 

            <p>
                <label class="w3-text-black"><b>Description</b></label>
                <input class="w3-input w3-border w3-round" name="description" type="text" id="iddescription" >
            </p> 

            <p>
                <label class="w3-text-black"><b>Price</b></label>
                <input class="w3-input w3-border w3-round" name="price" type="text" id="idprice" >
            </p> 

            <p>
                <label class="w3-text-black"><b>Deposit</b></label>
                <input class="w3-input w3-border w3-round" name="deposit" type="text" id="iddeposit" >
            </p> 

            <p>
                <label class="w3-text-black"><b>Date</b></label>
                <input class="w3-input w3-border w3-round" name="date" type="date" id="iddate" >
            </p> 

            <p>
                <label class="w3-text-black"><b>State</b></label>
                <input class="w3-input w3-border w3-round" name="state" type="text" id="idstate" >
            </p> 

            <p>
                <label class="w3-text-black"><b>Area</b></label>
                <input class="w3-input w3-border w3-round" name="area" type="text" id="idarea" >
            </p> 

            <p>
                <label class="w3-text-black"><b>Latitude</b></label>
                <input class="w3-input w3-border w3-round" name="latitude" type="text" id="idlatitude" >
                
            </p> 

            <p>
                <label class="w3-text-black"><b>Longitude</b></label>
                <input class="w3-input w3-border w3-round" name="longitude" type="text" id="idlongitude" >
            </p> 

            <p>
                <button class='w3-btn w3-round w3-brown w3-block' name="submit">Sign Up</button>
            </p>
    </form>
    </div>
    </div>

<!--Footer-->

<footer class="w3-footer w3-center w3-green">
    <p>Copyright: RentARoom</p>
</footer>

    </body>
</html>
