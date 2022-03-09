<?php




function validate($url)
{
$pattern="/^(?:\/|\\|\w\:\\|\w\:\/).*$/";
return preg_match($pattern, $url);
 
}


if (isset($_GET["url"])) {
    $url = $_GET["url"];

    if (validate($url)) {
        header("Location:" . $url);
    } else {
        echo "Absulute URL's Not Allowed";
    }
}

?>
