<?php

session_start();
session_unset();
session_destroy();


//redirect to index.php

header("location:index.php");

?>