<?php
// echo "Loggin You out.Please Wait...";
session_destroy();
header("Location: /forum/index.php");
