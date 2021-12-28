<?php
$results_per_page = 4;
if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
} else {
    $pageno = 1;
    $page_first_result = 0;
}

include_once("../dbconnect.php");

if (isset($_GET['op'])) {
    $op = $_GET['op'];
    if ($op == 'delete') {
        $id = $_GET['id'];
        $sqldelete = "DELETE FROM tbl_room WHERE id = '$id'";
        $stmt = $conn->prepare($sqldelete);
        if ($stmt->execute()) {
            echo "<script> alert('Delete Success')</script>";
            echo "<script>window.location.replace('mainpage.php')</script>";
        } else {
            echo "<script> alert('Delete Failed')</script>";
            echo "<script>window.location.replace('mainpage.php')</script>";
        }
    }
}

if (isset($_GET['button'])) {
    $op = $_GET['button'];
    $option = $_GET['option'];
    $search = $_GET['search'];
    if ($op == 'search') {
        if ($option == "contact") {
            $sqlcustomer = "SELECT * FROM tbl_room WHERE contact LIKE '%$search%'";
        }
        if ($option == "id") {
            $sqlcustomer = "SELECT * FROM tbl_room WHERE id LIKE '%$search%'";
        }
    }
} else {
    $sqlcustomer = "SELECT * FROM tbl_room ORDER BY date DESC";
}

$stmt = $conn->prepare($sqlcustomer);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlcustomer = $sqlcustomer . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlcustomer);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
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
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta contact="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script src="../javascript/jscript.js"></script>
    <title>RentARoom</title>
</head>

<body>
    
<div class="w3-header w3-container w3-padding-32 w3-center">
    <div class="bgimg-1 w3-display-container w3-opacity-min" id="home">
  <div class="w3-display-middle" style="white-space:nowrap;">
    <span class="w3-center w3-padding-large w3-black w3-xlarge w3-wide w3-animate-opacity">Rent <span class="w3-hide-small">A</span> Room</span>
  </div>
    </div>

    <div class="w3-header w3-container w3-green w3-padding w3-center">
    <a href="#contact" class="w3-bar-item w3-button w3-right">Logout</a>
    <a href="register.php" class="w3-bar-item w3-button w3-left">Register Room</a>
    </div>

    <div class="w3-card w3-container w3-padding w3-margin w3-round">
        <h4>Renter Search</h4>
        <form action="mainpage.php">
            <div class="w3-row">
                <div class="w3-half w3-container">
                    <p><input class="w3-input w3-block w3-round w3-border" type="search" id="idsearch" contact="search" placeholder="Enter search term" /></p>
                </div>
                <div class="w3-half w3-container">
                    <p><select class="w3-input w3-block w3-round w3-border" contact="option" id="srcid">
                            <option value="contact">By Phone Number</option>
                            <option value="id">By Room ID</option>
                            <option value="today">Today</option>
                        </select>
                    <p>
                </div>
            </div>
            <div class="w3-container">
                <p><button class="w3-button w3-green w3-round w3-right" type="submit" contact="button" value="search">search</button></p>
            </div>

        </form>
    </div>

    <div class="w3-grid-template">
        <?php
        foreach ($rows as $customer) {
            $id = $customer['id'];
            $contact = $customer['contact'];
            $title = $customer['title'];
            $description = $customer['description'];
            $price = $customer['price'];
            $deposit = $customer['deposit'];
            $state = $customer['state'];
            $area = $customer['area'];
            $date= $customer['date'];
            $date= $customer['date'];
            $latitude= $customer['latitude'];
            $longitude= $customer['longitude'];
            echo "<div class='w3-center w3-padding'>";
            echo "<div class='w3-card-4 w3-dark-grey'>";
            echo "<header class='w3-container w3-green'";
            echo "<h5>$id</h5>";
            echo "</header>";
            echo "<div class='w3-padding'><img class='w3-image' src=../res/images/$id.png" .
                " onerror=this.onerror=null;this.src='../res/images/profile.png'"
                . " '></div>";
            echo "<div class='w3-container w3-left-align'><hr>";
            echo "<p>
            <i class='fa fa-phone' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp$contact<br>
            <i class='fa fa-flag' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp$title<br>
            <i class='fa fa-flag' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp$description<br>
            <i class='fa fa-money' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp$price<br>
            <i class='fa fa-money' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp$deposit<br>
            <i class='fa fa-map' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp$state<br>
            <i class='fa fa-map' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp$area<br>
            <i class='fa fa-calendar' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp$date<br>
            <i class='fa fa-globe' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp$latitude<br>
            <i class='fa fa-globe' style='font-size:16px'></i>
             &nbsp&nbsp$longitude<br></p><hr>";
             
            echo "<table class='w3-table'><tr>
            <td class='w3-center'><a href='mainpage.php?op=delete&id=$id'>
            <i class='fa fa-trash-o' style='font-size:32px' onClick=
            'return deleteDialog($id)' style='text-decoration:none'></i></a></td>
            </tr></table>";


            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
    <?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + $results_per_page;
    } else {
        $num = $pageno * $results_per_page - 9;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "mainpage.php?pageno=' . $page . '" style=
        "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>

<footer class="w3-footer w3-center w3-green">
    <p>Copyright: RentARoom</p>
</footer>

</body>

</html>