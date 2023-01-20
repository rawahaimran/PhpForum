<?php  //External Files

$site = [__FILE__, 'Php Forum'];
include('database/_dbconnect.php');
include('partials/header.php');




?>


<body>
    <div class="search p-5">
        <div class="query">
            <h2 class="text-center p-3">
                Results for "<?php echo $_GET['search'];?>"
            </h2>
        <div class="results">
            <h4 class="text-center"> Unable to Hack </h4>
        </div>
        </div>
    </div>
</body>


<?php

include('partials/footer.php');
?>