---
layout: post
title:  "[Security Simplified] - Open Redirect (Server Side)"
author: imran
categories: [ tutorial,imran ]
image: assets/images/SecuritySimplified/or-2/0.png
---


## What is Open Redirect

Open redirection vulnerabilities arise when an application incorporates user-controllable data into the target of a redirection in an unsafe way. An attacker can construct a URL within the application that causes a redirection to an arbitrary external domain. _-portswigger_

Please note that open redirection can be caused by the code sitting at the server side as well as code at the front-end. We will have a look at both the perespectives here.


## Vulnerable Code Snippet (Server Side)


```php
<?php
if(isset($_GET['url'])){
	$url=$_GET['url'];
	header('Location:'.$url);
}
?>
```

	
- isset() is basically a function, Which checks whether a variable is empty or not. Also check whether the variable is set/declared, If the varible is not empty it return True otherwise false.

- `$_GET` is a PHP super global variable which is used to access GET based Parameters from anywhere in the PHP script, As example if you visiting a URL `https://snapsec.co?book.php?id=1` , The GET based `id` parameter in the URL can be accessed by the book.php by using the following code `$_GET['id']`.

- The `echo ""` statement is used to echo/print/reflect any values passed within single quotes, This data is written in a response sent to the user.
> So in conclusion what we really understood from this code snipped is that it check if the GET Based parameter `name` is set in the URL, if its set it prepends "Hello" to the `name` and sends response to the user.


- The __header()__ function sends a raw HTTP header to a client. 

- The HTTP __Location header__ is a response header indicates the URL to redirect a user to.


__Conclusion:__

> So in conclusion what we understand from this code snippet is that it check if the GET Based parameter `url` is set in the URL, if the the `url` parameter is set it then send a raw HTTP Response Header `Location` set to the client with value set to whatever is sent in the request by cleint.

In other words it redirects the user to whatever the value he has passed in the url paramter.


## Exploitation

The Exploitation is pretty simple, If the website is not validating the url paramters , We can simply add any web address in the url parameter and it will redirect us to the page.

<video src="https://github.com/Snap-sec/blog/blob/gh-pages/assets/images/SecuritySimplified/or-2/vid1.mp4?raw=true"></video>


	
## Where is the problem

Now the question is which part of the code snippet is vulnerable , and What makes it vulnerable?


The vulnerability is pretty simple here, The current code snippet doesn't have any kind of restrictions imposed to the input, Which means it directly adds the `url` parameter value to the response header sent to the client. So i believe `header('Location:'.$url);` is the actual peice of code which gives rise to this vulnerability.




## Fix

The fix can vary for company to company, One of the fixes will be allowing whitelisted domains or only allowing relative urls to redirected to. 

__While Listed Domains__


```php

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


```


In the following php code we introduce an new function callled `Validate(url)`, The function takes and User input url as paramyter and then checks if the host of url is equal to the while listed domain, If that that's the code we it allows redirection to happen otherwise the redirection is blocked and a Error message `Domain Not Allowed` is blocked.



__Allowing Only Absolute URL's__


One of the interesting fixes would be only allowing relative URL's which would block all open reditection attempts.

```php

<?php

function validate($url)
{
    $pattern = "/^(?:\/|\\|\w\:\\|\w\:\/).*$/";
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


```

In the following php code we introduce an new function callled `Validate(url)`, The function takes and User input url as parameter and then checks if the value is a absulute url by matching it to an regular expression save in `pattern` varibale. If url is relative we allow the redirection to happen otherwise the redirection is blocked.


## Confirming the FIX
- On going back and trying to reproduce open redirection on both the fixes , Yon can see we were able to fix the vulnerabilities


confirm.vid


Thanks and see you soon.



