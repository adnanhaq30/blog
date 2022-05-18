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

- Before Directly Jumping into the Vulnerable code snipped, Imagine the following database structure:
	- e-commerce [Database]
		- products [Table]
		- customers [Table]


__Products__
|id | name | Description|
|---|---|---|
|1|Milk|This is the description of Milk|1|
|2|Eggs|This is the description of Eggs|1|
|3|Bread|This is the description of Bread|1|
|4|apple| This is the description of Milk|2|
|5|mango| This is the description of mango|2|
|6|banana| This is the description of banana|2|


__Customers__
|id | email | password|
|---|---|---|
|1|user1@gmail.com|pass1|
|2|user2@gmail.com|pass2|
|3|user3@gmail.com|pass3|
|4|user4@gmail.com|pass4|
|5|user5@gmail.com|pass5|
|6|user6@gmail.com|pass6|
|7|user7@gmail.com|pass7|
|8|user8@gmail.com|pass8|
|9|user9@gmail.com|pass9|
|10|user10@gmail.com|pass10|






```php
<?php

if(isset($_GET['id'])){
$cid=$_GET['id'];
$connection=mysqli_connect("localhost","root","","e-commerce");
$q="SELECT * FROM products where category='$cid'";
$data=mysqli_query($connection,$q);
while($pdata=mysqli_fetch_assoc($data)){

echo '<center> ';
echo '<b>Name:</b> '.$pdata['name'].'<br>';
echo '<b>Description:</b> '.$pdata['description'];
echo '<br><a href="">Order Now</a></center><br><br><br>';
}
}

?>
```

	
- isset() is basically a function, Which checks whether a variable is empty or not. Also check whether the variable is set/declared, If the varible is not empty it return True otherwise false.

- `$_GET` is a PHP super global variable which is used to access GET based Parameters from anywhere in the PHP script, As example if you visiting a URL `https://snapsec.co?book.php?id=1` , The GET based `id` parameter in the URL can be accessed by the book.php by using the following code `$_GET['id']`.

- Then the code is creating an connection with a Mysql Server Running on `localhost` with the username `root` and selects `e-commerce` as a database.

- In the next line the SQL query is dynamically generated which includes the id set by the user in the get based parameter id. 

- Lastly, The query is executed an the data is finally saved in `data` varibale.

- After that the while loop is run and all the products of the catogory of `?id=` is sent to the user using the `echo ""` in the php





__Conclusion:__

> So in conclusion what we understand from this code snippet is that it check if the GET Based parameter `id` is set in the URL, if the the `id` parameter is set it then creates an connection the database and retrives the product information from product table of specific catogary and then returns the name and the description of the product to the customer.



### In Browser

- On browsing the sqli.php?id=1 , the following query is executed, hence Returns all the products of category 1
```sql
SELECT * FROM products where category='1';
```

![1](![1](/blog/assets/images/SecuritySimplified/sqli-3/1.png)


- Similarly on browsing the sqli.php?id=1 , the following query is executed:
```sql
SELECT * FROM products where category='2';
```

![2](![1](/blog/assets/images/SecuritySimplified/sqli-3/2.png)







## Exploitation

- Now the science behind its exploitation is pretty simple, We are aware of the fact that the mysql queries are dynamically generated in the code, Hence a user controllable input `id` is used to generate those queries. Since the input is not properly validated is it possible for us as users to control other parts of the mysql queries and retrive other senstive information from other tables of the database.


Now on visiting the following URL, In place of simple id we are adding `' UNION SELECT id,email,password,null FROM customers-- -` as an id, which is not validated and henc simply added the the dynamically generated sql query and hence provide the final query as


![3](![1](/blog/assets/images/SecuritySimplified/sqli-3/3.png)


```sql
SELECT * FROM products where category='2' UNION SELECT id,email,password,null FROM customers-- -;
```


Since the `UNION` operator is used to combine the result-set of two or more SELECT statements. Our final Array`($data)` in the code is filled with the rows returned from the 1st and 2nd select query which is `SELECT * FROM products where category='2'` and `SELECT id,email,password,null FROM customers` hence echo's back the customers emails and passwords on the screen.


## Where is the problem

the following part of code is responsible to generate SQL queries

```php
$cid=$_GET['id'];
$connection=mysqli_connect("localhost","root","","e-commerce");
$q="SELECT * FROM products where category='$cid'";
```
the GET parameter id `$_GET['id']` is directly taken from the user and without any validation added the query varible `$q`, Hence Allows attacker to escape the previous query by adding `'` to the id (`?id=2'`) and then append any MYSQL Query to the `$q` variable, Hence allows him to execute arbitar SQL commands on the vulnerable SERVER.



## Fix

```php
<?php

if(isset($_GET['id'])){
$connection=mysqli_connect("localhost","root","","e-commerce");
$cid=mysqli_real_escape_string($connection,$_GET['id']);
$q="SELECT * FROM products where category='$cid'";
$data=mysqli_query($connection,$q);
while($pdata=mysqli_fetch_assoc($data)){

echo '<center> ';
echo '<b>Name:</b> '.$pdata['name'].'<br>';
echo '<b>Description:</b> '.$pdata['description'];
echo '<br><a href="">Order Now</a></center><br><br><br>';
}
}

?>
```

in the following code snipped we have introduce an new function `mysqli_real_escape_string` that wraps the user input `id` before its passed for becomming a part of the dynamically generated sql query. Escapes special characters in a string for use in an SQL statement. 



## Confirming the FIX

- To make sure our fix is working a intended, You can see the script is working as intended on adding the milicious SQLi payload to the id parameter, As for the reason the Mysql Query generated right now is as followed:

```mysql
SELECT * FROM products where category='2\' UNION SELECT id,email,password FROM customers-- -'
```

You can see the `\` escaping slash added before `'` in the user input prevents attacker from escaping the context of the id parmeter hence whole set of payload which is `2' UNION SELECT id,email,password FROM customers-- -` is treated as a value of id `category` in the mysql query.


![4](![1](/blog/assets/images/SecuritySimplified/sqli-3/4.png)




- Just to make sure none other MYSQLi exploitation techniques are working i ran a quick sqlmap scan on the script and it seems we are perfectly fine.


![5](![1](/blog/assets/images/SecuritySimplified/sqli-3/5.png)




