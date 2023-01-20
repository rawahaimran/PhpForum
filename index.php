<?php  //External Files

$site = [__FILE__, 'Php Forum'];
include('database/_dbconnect.php');
include('partials/header.php');




?>

<body>


    <!-- banner image -->
    <?php
    $sql = "SELECT * FROM `categories` ORDER BY RAND ( ) LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $category_name = $row['category_name'];
    $category_desc = $row['category_desc'];
    $category_id = $row['category_id']; ?>
    <div class=" text-center bg-image " style="
      background-image: url('https://source.unsplash.com/weekly/?<?php echo $category_name; ?>,programming-language');
      height: 400px;
      margin-top: 1px;
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      ">
        <!-- overlay -->
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.6); height:100%; ">
            <div class="d-flex justify-content-center align-items-center  ">
                <div class="text-white " style="margin-top: 5rem;">
                    <h2 class="mb-3"><?php echo $category_name; ?></h2>
                    <h4 class="text-center mb-4"><?php echo  substr($category_desc, 0, 100); ?>...</h4>
                    <!-- <a class="" href="#!">View More</a> -->
                    <a href="forum.php?category=<?php echo $category_id; ?>" class="btn btn-outline-light btn-lg"  role="button"> View More</a>
                </div>
            </div>
        </div>
    </div>

    <!-- background-image and overlay ends -->


    <!-- Card section Starts -->
    <div class="container-fluid ">

        <h2 class=" display-6 heading-section text-center  mt-3 "> <?php echo $site[1]; ?> - Categories</h2>


        <div class="container">
            <div class="card-group">
                <?php
                $sql = "SELECT * FROM `categories` LIMIT 9";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {

                    $category_name = $row['category_name'];
                    $category_desc = $row['category_desc'];
                    $category_id = $row['category_id'];



                    // while($row = mysqli_fetch_assoc($resul))
                ?>

                <div class="col">

                    <div class="card my-1" style="width : 18rem;">
                        <img src="https://source.unsplash.com/500x400/?<?php echo $category_name; ?>,programming-coding"
                            class="card-img-top" alt="">
                        <div class="card-body bg-dark ">
                            <h5 class="card-title text-light"><?php echo $category_name; ?></h5>
                            <p class="card-text text-light"><?php echo  substr($category_desc, 0, 110); ?>...</p>
                            <a href="forum.php?category=<?php echo $category_id; ?>"><button type="button"
                                    class="btn btn-outline-success">View
                                    Thread</button></a>

                        </div>
                    </div>
                </div>
                <?php
                }

                ?>

            </div>

        </div>

        <!--  Card Section Ends ! -->

        <form class="container d-flex align-items-center justify-content-center mt-4" action="/forum/category.php" method="GET">
            <button type="submit" class="btn-lg btn-success text-center">View All</button>
        </form>
    </div>

    <br>

    <?php //footer files
    include('partials/footer.php'); ?>


</body>

</html>