---
layout: post
title:  "[Security Simplified] - SQL Injection"
author: imran
categories: [ tutorial,imran ]
image: assets/images/SecuritySimplified/or-2/0.png
---


## What is SQL Injection
SQL injection is a web security vulnerability that allows an attacker to interfere with the queries that an application makes to its database. It generally allows an attacker to view data that they are not normally able to retrieve. This might include data belonging to other users, or any other data that the application itself is able to access. In many cases, an attacker can modify or delete this data, causing persistent changes to the application's content or behavior. _portswigger_

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


	
## Where is the problem




## Fix




## Confirming the FIX



