<?php

function validate($url)
{
    $whilt_list_domain = "snapsec.co";

    $info = parse_url($url);
    $host = $info["host"];

    if ($host == $whilt_list_domain) {
        return true;
    } else {
        return false;
    }
}

if (isset($_GET["url"])) {
    $url = $_GET["url"];

    if (validate($url)) {
        header("Location:" . $url);
    } else {
        echo "Domain Not Allowed";
    }
}

?>