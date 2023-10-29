<?php

session_start();
echo "Logging you out! Please Wait......";
session_reset();
session_destroy();

header("location: /Forum");

?>