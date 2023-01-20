<?php  //External Files

$site = [__FILE__, 'Php Forum'];
include('database/_dbconnect.php');
include('partials/header.php');
include('test.php');
include('Variables/variables.php');


?>

<body>

    <!-- Card section Starts -->
    <div class="container-fluid ">

        <h2 class=" display-6 heading-section text-center  mt-3 "> - All Categories</h2>


        <div class="container">
            <div class="card-group">
                <?php
                $sql = "SELECT * FROM `categories`";
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


    </div>

    <br>

    <?php //footer files
    include('partials/footer.php'); ?>
</body>