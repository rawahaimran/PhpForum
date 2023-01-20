$category_id = $_GET['id'];
$sql = "SELECT * FROM `comments` WHERE thread_id=$category_id";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        $category_name = $row['category_name'];
        $category_desc = $row['category_desc'];
    }




    ?>

    <?php
        $thread_id = $_GET['id'];
        $sql = "SELECT * FROM `threads` WHERE thread_id=$thread_id";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {

            $thread_title = $row['thread_title'];
            $thread_desc =  $row['thread_desc'];
            $thread_id  = $row['thread_id']; ?>

            <div class="container">
                <div class="p-5 mb-4 bg-light rounded-3 ">
                    <div class="container-fluid py-5 text-center ">
                        <h2 class="display-5 fw-bold text-center text-success"> Remeber the Rules</h2>
                        <p class=" fs-4 mx-5 py-3" style="padding-left:8rem; padding-right:8rem;">
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



        <?php
        }


        ?>