---
layout: post
title:  "[Security Simplified] - Reflected XSS"
author: imran
categories: [ Jekyll, tutorial,imran ]
image: assets/images/SecuritySimplified/rxss-1/1.jpg
---




## What is Reflected XSS

_Cross-site scripting (also known as XSS) is a web security vulnerability that allows an attacker to compromise the interactions that users have with a vulnerable application, Reflected XSS arises when an application receives data in an HTTP request and includes that data within the immediate response in an unsafe way, Which eventually allows attackers to design specially creafted URL which if visited by victim will run attacker controlled javascript code with victims browser and can lead to different attacks purely based on the code written by the attacker._  - Portswigger


## Vulnerable Code Snipped


```php
<?php

if(isset($_GET['name'])){
echo "Hello " .$_GET['name'];
}

?>

```

So basically the code cosists of two line, The first line with the if statement and the second line with the echo statement. 

- isset() is basically a function, Which checks whether a variable is empty or not. Also check whether the variable is set/declared, If the varible is not empty it return True otherwise false.


- `$_GET` is a PHP super global variable which is used to access GET based Parameters from anywhere in the PHP script, As example if you visiting a URL `https://snapsec.co?book.php?id=1` , The GET based `id` parameter in the URL can be accessed by the book.php by using the following code `$_GET['id']`.

- The `echo ""` statement is used to echo/print/reflect any values passed within single quotes, This data is written in a response sent to the user.


> So in conclusion what we really understood from this code snipped is that it check if the GET Based parameter `name` is set in the URL, if its set it prepends "Hello" to the `name` and sends response to the user.

## Exploitation

- On visiting the code snipped via the Browser and passing `name` paramter, It can be clearly seen that the value of the `name` parameter is being reflected to user.

![1](/blog/assets/images/SecuritySimplified/rxss-1/1.png)



- Now what happens if the value of the `name` paramter is changed to something like a HTML, Javascript piece of code. You can see the HTML code was executed rather than being displayed to the user.

![1](/blog/assets/images/SecuritySimplified/rxss-1/2.png)



- On having an closed look to the source code of the page, You can see the reflected value is being treated as an HTML code and gets executed in the browser.


![1](/blog/assets/images/SecuritySimplified/rxss-1/3.png)




- Whic also means that if the javascript code is passed to the paramter, On being reflected back to the browser the browser will treat it as a javascript code and hence excute it

![1](/blog/assets/images/SecuritySimplified/rxss-1/4.png)



## Where is the problem

Now the question is which part of the code snippet is vulnerable , and What makes it vulnerable?

The answer to that is quite simple, The peice of code which is responsible to reflect data back to the user is not encoding special characters before sending it to the user, Hence allow attacker to achive XSS, So to be more speicific the `echo ""` is responsible for the vulnerability.


## Metigating the Issue

In general the solution is use different encoding techniques perform careful input validation and context-sensitive encoding on the user input. For example in this case the `htmlentitie(str)` function can be wrapped up to the User imput which will Convert majority of the speicial characters to HTML entities:




Hence the final code will look like this

```php
<?php

if(isset($_GET['name'])){

echo "Hello " .htmlentities($_GET['name']);
}

?>
```


## Confirming the FIX

- On going back and trying to inject an image in name parameter you can see we were not able to inject new HTML code

![1](/blog/assets/images/SecuritySimplified/rxss-1/5.png)


- This is because all the special character were properly encoded by htmlentities() function before sending them to the user.

![1](/blog/assets/images/SecuritySimplified/rxss-1/6.png)


Thanks and see you soon.



