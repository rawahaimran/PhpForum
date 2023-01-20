<?php

session_start();
include('partials/signup.php');
include('partials/login.php');
include('partials/handlesignup.php');
include('_dbconnect.php');

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Php Forum - Welcome </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

</head>

<nav class=" navbar navbar-expand-lg navbar-dark bg-dark sticky-top  ">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Php Forum</a>



        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/category.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Thread Topics
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        $sql = "SELECT * FROM `categories` LIMIT 5";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {

                            $category_name = $row['category_name']; ?>
                            <li><a class="dropdown-item" href="forum.php?category=<?php echo $category_id; ?>"><?php echo $category_name; ?></a>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        <?php

                        }
                        ?>
                </li>
            </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
            </ul>
            <?php
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {

                echo '<form class="d-flex m-2" method="get" action="/search.php">
            <p class="m-2 text-white"> Hello' . $_SESSION['UserName'] . '</p>
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class=" mr-2 btn btn-success" type="submit">Search</button>
                </form>';
                

                $_SESSION['logout'] = '<button class="btn btn-success" type="submit">Signout</button>';
                if (isset($_SESSION['logout'])) {
                    session_unset();
                    session_destroy();
                }
                echo '<a href="partials/logout.php"class="btn btn-success text-light" >Signout</a>';
            
            } else {

                echo '<button type="button" class="btn btn-success" id="signinModal" data-bs-toggle="modal" data-bs-target="#signinModal">Login</button>
            <button type="button" class="btn btn-success ms-2" id="signupModal " data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
            }
            ?>

        </div>
    </div>
</nav>
<?php

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success!</strong> You can now login
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}


?>