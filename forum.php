<?php
include('partials/header.php');
include('database/_dbconnect.php');


?>


<body>
    <?php
    $category_id = $_GET['category'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$category_id";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        $category_name = $row['category_name'];
        $category_desc = $row['category_desc'];
    }




    ?>



    <div class="container-fluid py-3">
        <div class="container">
            <div class="p-5 mb-4 bg-light rounded-3 ">
                <div class="container-fluid py-5 text-center ">
                    <h2 class="display-5 fw-bold text-center text-success"> <?php echo $category_name; ?></h2>
                    <p class="fs-4 text-center p-1">
                        <?php echo $category_desc; ?>
                    </p>
                    <hr class="my-4">
                    <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed.
                        Do not
                        post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross
                        post
                        questions. Remain respectful of other members at all times.</p>
                    <button class="btn btn-success btn-lg text-center" type="button">Learn More</button>
                </div>
            </div>
        </div>



        <div class="container-fluid bg-light p-4">
            <div class="container">
                <h2 class="mt-4">Start a Discussion</h2>

                <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Problem Title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                            possible</small>
                    </div>
                    <input type="hidden" name="sno" value="">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Ellaborate Your Concern</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    </div>
                    <?php 
                    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
                        echo '<button type="submit" class="btn btn-success mt-2 ">Submit</button>';
                    } else {
                        echo '<button type="button" class="btn btn-success ms-2" id="signupModal " data-bs-toggle="modal"
                        data-bs-target="#signupModal">Submit</button>';
                    } ?>

                </form>
            </div>
        </div>
        <?php
        $alert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            $thread_title = $_POST['title'];
            $thread_desc = $_POST['desc'];


            // $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_category_id`, `thread_user_id`, `timestamp`) VALUES ( '$thread_title', '$thread_desc', '$category_id', '0', current_timestamp())";
            $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_category_id`, `thread_time`, `thread_user`) VALUES ('$thread_title', '$thread_desc', '$category_id', current_timestamp(), 
            '  ')";

            $result = mysqli_query($conn, $sql);
            $alert = true;
            if ($alert) {
        ?>
        <div class="alert alert-success alert-dismissible  fixed-top fade show" role="alert">
            <strong> Congratz </strong> Your Post has been added Successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php  }
        }
        ?>
    </div>
    <div class="container-fluid">

        <div class="container">
            <h2 class="mt-4 ">Browse Questions</h2>
        </div>
        <div class="container-fluid">
            <hr>
        </div>
        <div class="container ">
            <?php
            $category_id = $_GET['category'];
            $sql = "SELECT * FROM `threads` WHERE thread_category_id=$category_id";
            $result = mysqli_query($conn, $sql);
            $noResult = true;

            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $thread_title = $row['thread_title'];
                $thread_desc =  $row['thread_desc'];
                $thread_id  = $row['thread_id'];
                $thread_time = $row['thread_time'];
                $thread_user = $row['thread_user'];

            ?>
            <a href="threadlist.php?id=<?php echo $thread_id; ?>">
                <div class="card " style=" border:none; ">
                    <div class="card-body ">
                        <div class="d-flex flex-start  align-items-center">
                            <img class="rounded-circle shadow-1-strong me-3" src="img/avatar.png" alt="avatar"
                                width="60" height="60" />
                            <div>
                                <h6 class="fw-bold text-primary mb-1  text-success ">
                                    <?php
                                        // echo $thread_user
                                        echo $thread_user; ?>
                                </h6>
                                <p class="text-muted small mb-0">
                                    Shared publicly - <?php echo $thread_time; ?>
                                </p>
                            </div>
                        </div>

                        <p class="mt-3 mb-4 pb-2  text-success ">
                            <?php echo $thread_desc; ?>
                        </p>

                        <div class="small d-flex justify-content-start">
                            <a href="#!" class="d-flex align-items-center text-success me-3">
                                <i class=" text-success  far fa-thumbs-up me-2"></i>
                                <p class="mb-0  text-success ">Upvote</p>
                            </a>
                            <a href="#!" class="d-flex align-items-center text-success me-3">
                                <i class=" text-success  far fa-comment-dots me-2"></i>
                                <p class="mb-0  text-success ">Comment</p>
                            </a>
                            <a href="#!" class="d-flex align-items-center text-success me-3">
                                <i class=" text-success fas fa-share me-2"></i>
                                <p class="mb-0  text-success ">Share</p>
                            </a>
                        </div>
                    </div>
                </div>
            </a>
            <hr>
            <?php
            } ?>



        </div>
    </div>



    <?php

    if ($noResult == true) {


    ?>
    <div class="container-fluid">
        <div class="container">
            <div class="py-4">
                <h2 class="text-dark"> 😞Unfortunately no threads found ! </h2>
                <p> Be the first person to ask a question. </p>
            </div>
        </div>
    </div>

    <?php
    } ?>


    <?php
    include('partials/footer.php');
    ?>