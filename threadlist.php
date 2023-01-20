<?php include('partials/header.php');
include('database/_dbconnect.php'); ?>


<body>
    <?php

    $thread_id = $_GET['id'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$thread_id";
    $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_assoc($result);


    // $thread_user_id= $row['thread_user_id'];
    while ($row = mysqli_fetch_assoc($result)) {
        $thread_title = $row['thread_title'];
        $thread_desc =  $row['thread_desc'];
        $thread_id  = $row['thread_id'];
        $thread_user = $row['thread_user']



    ?>
        <div class="container-fluid">


            <h2 class="text-center pt-2"> Problem Id : <span class="text-success"><?php echo $thread_id; ?></span></h2>
            <hr class="bg-success">
        </div>

        <div class="container-fluid ">

            <div class="container ">
                <div class="d-flex align-items-center justify-content-center pb-3 ">
                    <div class="row mb-2 d-flex align-items-center justify-content-center p-5 ">
                        <div class="d-flex flex-fill">
                            <div class="flex-shrink-0">
                                <img src="img/avatar.png" alt="..." width="70px">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <a href="threadlist.php?id=<?php echo $thread_id; ?>">
                                    <h3 class="my-2 py-2 text-success"><?php echo $thread_title; ?></h3>
                                </a>
                                <p> <?php echo $thread_desc; ?> Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Similique qui fuga voluptatem quisquam, error excepturi earum ducimus iusto pariatur
                                    soluta quibusdam cupiditate id, assumenda adipisci nisi eveniet architecto accusamus.
                                    Soluta! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel, sed explicabo
                                    facilis quibusdam quas obcaecati et accusamus perspiciatis, commodi minus assumenda,
                                    aliquam molestiae ducimus! Quas fuga error ad sunt? Autem.</p>
                                <span class="text-center ">Posted by <strong class="text-success"><?php echo $thread_user; ?> </strong></span>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="container-fluid p-4">
            <div class="container">
                <h2 class="mt-4">Leave a Comment</h2>
            </div>
        </div>

        <div class="container-fluid bg-light">

            <div class="container">
                <div class="p-5 mb-4 rounded-3 ">
                    <div class="container-fluid py-5 text-center ">
                        <h2 class="display-5 fw-bold text-center text-success"> Remeber the Rules</h2>
                        <p class="fs-4 text-center p-1">
                            This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed.
                            Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do
                            not cross post questions. Remain respectful of other members at all times.
                        </p>
                        <hr class="my-4">

                        <blockquote>
                            <p>Service to others is the rent you pay for your room here on earth. </p>
                        </blockquote>
                        <button class="btn btn-lg text-center"> - MOHAMMAD ALI</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid ">
            <div class="container">
                <h2> Add Comment </h2>
            </div>
            <hr class="bg-success">
        </div>


        <div class="container-fluid">
            <div class="container">
                <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="POST">

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Submit Comment</label>
                        <textarea class="form-control" id="Comment" name="cmnt" rows="3"></textarea>
                    </div><?php
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
            $comment = $_POST['cmnt'];
            $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_time`, `comment_by`) VALUES ('$comment', '$thread_id ', current_timestamp(), 'random')";
            $result = mysqli_query($conn, $sql);
        ?>

            <?php $alert = true;
            if ($alert) {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> Congratz </strong> Your comment has been added Successfully. Your comment can be found at the bottom
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

        <?php
            }
        } ?>

        <div class="container-fluid mt-2 pt-2">
            <div class="container">
                <h2> All Comments </h2>
            </div>
            <hr class="bg-success">
        </div>




        <?php
        $no_comment = true;
        $sql = "SELECT * FROM `comments` WHERE thread_id=$thread_id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $no_comment = false;
            $comment_time = $row['comment_time'];
            $comment_by = $row['comment_by'];
            $comment_content = $row['comment_content'];
            $comment_id = $row['comment_id'];
        ?>

            <div class="container my-3">

                <div class="card " style=" border:none; ">
                    <div class="card-body ">
                        <div class="d-flex flex-start  align-items-center">
                            <img class="rounded-circle shadow-1-strong me-3" src="img/avatar.png" alt="avatar" width="60" height="60" />
                            <div>
                                <h6 class="fw-bold text-primary mb-1  text-success ">
                                    <?php echo $comment_by; ?>
                                </h6>
                                <p class="text-muted small mb-0">
                                    Shared publicly - <?php echo $comment_time; ?>
                                </p>
                            </div>
                        </div>

                        <p class="mt-3 mb-4 pb-2  text-success ">
                            <?php echo $comment_content; ?>
                        </p>

                        <div class="small d-flex justify-content-start">
                            <a href="#!" class="d-flex align-items-center text-success me-3">
                                <i class=" text-success  far fa-thumbs-up me-2"></i>
                                <p class="mb-0  text-success ">Upvote</p>
                            </a>
                            <!-- <a href="#!" class="d-flex align-items-center text-success me-3">
                <i class=" text-success  far fa-comment-dots me-2"></i>
                <p class="mb-0  text-success ">Comment</p>
            </a> -->
                            <a href="#!" class="d-flex align-items-center text-success me-3">
                                <i class=" text-success fas fa-share me-2"></i>
                                <p class="mb-0  text-success ">Share</p>
                            </a>
                        </div>
                    </div>
                    <?php
                    // include('comments.php');
                    ?>

                </div>
            </div>


            <hr>
    <?php
        }
        if ($no_comment == true) {
            echo '<div class="container-fluid">
        <div class="container">
            <div class="py-4">
                <h2 class="text-dark"> 😞Unfortunately no Comments found ! </h2>
                <p> Be the first person to add a comment. </p>
            </div>
        </div>
    </div>';
        }
    }
    // endwhile

    ?>