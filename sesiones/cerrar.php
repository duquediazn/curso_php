<?php
    session_name("LOGIN"); 
    session_start();

    session_destroy(); //https://www.php.net/manual/en/function.session-destroy.php

    echo "<script> window.location.href='index.php'; </script>";