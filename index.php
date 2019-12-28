<?php
require_once('./core/constants.php');
require_once('./core/functions.php');

require_once('./inc/header.php');
require_once('./inc/navigation.php');

?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <!--Put couresel here-->
   <section>
    <div class="cotainer-fluid">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
         <!-- Indicators -->
         <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
         </ol>
         <!-- Wrapper for slides -->
         <div class="carousel-inner">
            <div class="item active">
               <img src="assets/img/dhan.jpg"  style="width:100%;">
               <div class="carousel-caption">
                  <h3>Fruits Production</h3>
                  <p>It is useful to detect the fruits</p>
               </div>
            </div>
           <div></div> <div class="item">
               <img src="assets/img/gahu.jpg"  style="width:100%; ">
               <div class="carousel-caption">
                  <h3>Nepali</h3>
                  <p>This is how farmers do labor</p>
               </div>
            </div>
            <div class="item">
               <img src="assets/img/sau.jpg"  style="width:100%; ">
               <div class="carousel-caption">
                  <h3>Kisan</h3>
                  <p>This is how farmers do labor</p>
               </div>
            </div>
            <div class="item">
               <img src="assets/img/sth.jpg"  style="width:100%;">
               <div class="carousel-caption">
                  <h3>Potato Farming</h3>
                  <p>It tooks some time to farm</p>
               </div>
            </div>
         </div>
         <!-- Left and right controls -->
         <a class="left carousel-control" href="#myCarousel" data-slide="prev">
         <span class="glyphicon glyphicon-chevron-left"></span>
         <span class="sr-only">Previous</span>
         </a>
         <a class="right carousel-control" href="#myCarousel" data-slide="next">
         <span class="glyphicon glyphicon-chevron-right"></span>
         <span class="sr-only">Next</span>
         </a>
      </div>
</div>
</section>
<!--product list here-->
<div class="container">

<?php

$conn=db_get_conn();
$query="SELECT * FROM tblproduct";

if($result = $conn->query($query))
{
    while ($row=$result->fetch_assoc()) {

      echo"<div class='col-md-4'>
          <img src='/ams/assets/img/product/{$row['product_image']}'width=300 height=200>
          <h3>{$row['name']}</h3>
          <p>{$row['description']}</p>
          <p>Nrs. {$row['price']} per Kg</p>
          <p><a class='btn btn-primary' href='orderdetail.php?id={$row['id']}' role='button'>Order Now &raquo;</a></p>
        </div>";

    }
  }
?>


</div>

 <?php
require_once('./inc/footer.php');

?>