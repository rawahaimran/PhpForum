<div class="card-footer py-3 " style="background-color:#fff;">
    <?php
    $sql = "SELECT * FROM `reply` WHERE reply_thread_id=$comment_id";
    $result = mysqli_query($conn, $sql);
    $show = true;
    while ($row = mysqli_fetch_assoc($result)) {
        $reply_content = $row['reply_content'];
        $show = false;
        if ($show) {

            echo '<div class="d-flex flex-start w-100">
        <img class="rounded-circle shadow-1-strong me-3" src="img/avatar.png" alt="avatar" width="40" height="40" />

        <div class=" w-100">
            <output class="form-control" id="textAreaExample" rows="4" style="background: #fff;">
                <?php echo $reply_content; ?>
    <label class="form-label" for="textAreaExample"></label>
</div>
</div>';
        }
    } ?>








    <form class="d-flex flex-start w-100 mt-3" action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
        <img class="me-3" src="img/avatar.png" alt="avatar" width="40" height="40" />
        <div class=" w-100">
            <textarea class="form-control border-1 border-success" id="reply" name="_reply" rows="4" placeholder="Type your Reply here"></textarea>
        </div>
        <div class="float-end mt-2 pt-1">
            <button type="submit" class="btn btn-success  btn-sm">Add Reply</button>
        </div>
    </form>
    <?php $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $reply = $_POST['_reply'];
        $sql = "INSERT INTO `reply` ( `reply_thread_id`, `reply_content`, `reply_by`, `reply_time`) VALUES ( '$comment_id','$reply', 'random', current_timestamp())";
        $result = mysqli_query($conn, $sql);
    ?>
    <?php
    }
    ?>
</div>