<?php

if(isset($_GET['name'])){

echo "Hello " .htmlentities($_GET['name']);
}

?>