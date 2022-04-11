---
layout: post
title:  "Attacking File Uploads in Modern Web Applications"
author: adnan
categories: [ general,blog-post,imran ]
image: assets/images/14/1.png
---







File sharing or simple file upload functionality is a widely used feature in web apps now a days. Any misconfiguration in this one feature can put the entire application or even organization at a great risk. In this article I will talk about this vulnerability, how to attack it and how to mitigate such vulnerabilities.

## Vulnerability in file upload feature

File upload vulnerability occurs when a web app does not pass the user input files through a filter or doesn’t perform proper input sanitization. Misconfiguration in this feature can could put organizations at high security risk. This vulnerability can expose website to large vector of attacks and can lead to critical cyberattacks which can then put organization at high risk, affecting its confidentiality, integrity and availability of company data/resources. 

Let’s take an example of a website where you can find and apply for jobs, now in this website there must be a feature of uploading your resume. This website should only allow file types of pdf, png, jpeg or doc file. However, if it is not properly configured an attacker could upload arbitrary files on server and can even execute them, this can lead to RCE(Remote code execution), complete takeover of company servers, access to restricted data and can even delete/modify company data.


## How does file uploads work.

Well different programming languages handle file upload differently, Here is an example of how an php developer would design an PHP handler do handler file send from the user.

```php
<?php
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      
      if($file_size > 2097152){
         move_uploaded_file($file_tmp,"file/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
?>
```

In the following example the code is attempting to upload image, The developer has restricted users for uploading files under 2 mb. And all the file uploaded will be saved under `file` drectory, Now this looks like a normal peice of code that should just work fine when it comes to uploading file, But as notice there is no validation and filtration in terms of what kinds of files can be uploaded to the server. This can expose website to large vector of attacks and can lead to remote code execution on the remote server. Here are few vulnerabilities that can be tested on file uploads:


## Common File upload misconfiguration


![1](/blog/assets/images/14/2.png)


- **No input sanitization:**

This is the worst case scenario. If a web app does not filter the upload content at all, the attacker can upload any type of file like PHP, JavaScript, Python etc and configure them to execute commands on internal servers of the company. If attacker is able to execute web shell, he/she can then execute arbitrary code on the server and can takeover the whole network.
    
| For example if an attacker is able to execute this command below, he/she can read arbitrary files from server:

```php
<?php echo file_get_contents('/etc/passwd'); ?>
```
    
- **Weak Blacklist on file types:**

In this filter developers try to block files that are in blocklist, all the files types other than blacklist will not be blocked. and, this filter can be bypassed by figuring our which milicious filetype is allowed to be uploaded on the server and then used to to pefrom any milicious attacks like RCE, XSS , CORS bypass.


    
- **Filtration on Content type:**
    
Some websites use content type to check type of files and block them if they do not match the MIME format. If this filter is misconfigured, an attacker could easily bypass this filter using burp repeater.
    
For example we have a website where we upload our avatar, when we upload our file, it sends a POST request with the content type header set to image/png. Now if we try to upload a .php file it would block it. We take this Blocked request, send it to repeater and change it’s content type to image/png . If filter is misconfigured, it will upload the file successfully thus bypassing the content type filter.
    
- **Pixel flooding:**
    
If website doesn’t check for the size of image we can upload a file with large number pixels referred to as pixel flooding, this can lead to DOS. For example we have a website the converts the file type, we upload a simple image file with 200 x 200 pixels, then we change the value to 0xfafa x 0xfafa which is (64250x64250 pixels). Now when website tries to convert it, it will have to use lot more of resources which may lead to application level DOS


- **ZIP SLIP:**
    
Let’s say we have a website that accepts archive file and then later unzips it to perform further operations. If website just validates the file type of zip folder only, the attacker could place a malicious script file inside this archive file. When website will unarchive the file, since it doesn’t perform any validation on files inside the folder, the attacker could execute arbitrary code in the server. Thus, leading to many attacks including RCE. If a website is vulnerable to LFI, an attacker could name the files as paths to server file like `../../../../../../etc/passwd.png` . This might retrieve the server files too.


- **Using Versions:**
    
Sometimes a website uses blocklist that may contain blocked extensions, however it doesn’t specify the versions so an attacker could just use the file name as `upload.php5` and server might accept and execute it.
    
- **Override existing file:**
    
We can name our files same as the system files, the website may interpret it as a system file and override the existing system file. For example we can name our file `system.config` . The website may override the existing file which may lead to system crash. 
    
- **Weak Regex blocklist:** 

If web app checks for file extension in blocklist by exact match cases we can bypass this filter by using
        1. `script.Php`
        2. `script.PHP`
        3. `script.pHp`

- __Uploading .htaccess file__: 

if the web application allows us to upload `.htaccess` file somehow, he .htaccess file is a powerful website file that controls high-level configuration of your website. On servers that run Apache (a web server software), the .htaccess file allows you to make changes to your website’s configuration without having to edit server configuration files. The .htaccess file can configured in such a way that server can be constructed to execute jpg file as php code file which may again resuts in Remote code execution on the server.

For example if we managed to upload `.htaccess` with the following content, 

```
AddType application/x-httpd-php .txt
```

All the txt files in the directory when browsed through the browser will be treated and executed as PHP code.

- __SVG Files:__

If the file upload functionality isn't handling SVG file properly , an attacker could upload a crafted SVG file and perform a stored XSS with Dom access. SVG can use JavaScript in them and still be treated as images by the website, special care is needed to be taken with SVG files to prevent stored xss.

- __SQLi via File upload__:

Web developers often try to save file name to sql Databases, and these name should be fileted our before passing to the sql queries, If there is no filteration or validation done of the file names, It can lead to SQLi attacks in the web application.

Example, Uploading file names with these payloads can cause an sleep of 10 seconds in the upload response.

```
'sleep(10).jpg
sleep(10)-- -.jpg
```

## CheatSheet

Use the following cheatsheet to examine any file upload functionality


```
upload.random123		---	To test if random file extensions can be uploaded.
upload.php			---	try to upload a simple php file.
upload.php.jpeg 		--- 	To bypass the blacklist.
upload.jpg.php 			---	To bypass the blacklist. 
upload.php 			---	and Then Change the content type of the file to image or jpeg.
upload.php*			---	version - 1 2 3 4 5 6 7.
upload.PHP			---	To bypass The BlackList.
upload.PhP			---	To bypass The BlackList.
upload.pHp			---	To bypass The BlackList.
upload .htaccess 		--- 	By uploading this [jpg,png] files can be executed as php with milicious code within it.
pixelFlood.jpg			---	To test againt the DOS.
frameflood.gif			---	upload gif file with 10^10 Frames
Malicious zTXT  		--- 	upload UBER.jpg 
Upload zip file			---	test againts Zip slip (only when file upload supports zip file)
Check Overwrite Issue		--- 	Upload file.txt and file.txt with different content and check if 2nd file.txt overwrites 1st file
SVG to XSS			---	Check if you can upload SVG files and can turn them to cause XSS on the target app
SQLi Via File upload		---	Try uploading `sleep(10)-- -.jpg` as file
```





## Mitigating file upload vulnerability

1. Check file extension against whitelisted rather than block-listed, because block-listed can have many bypasses.
2. Block all files containing path like `../` or even just `/`
3. Rename the uploaded files so that already existing file may not be overridden.
4. Enforce size of uploaded file.



## About us

Snapsec is a team of security experts specialized in providing pentesting and other security services to secure your online assets. We have a specialized testing methodology which ensures indepth testing of your business logic and other latest vulnerabilities. 

 If you are looking for a team which values your security and ensures that you are fully secure against online security threats, feel free to get in touch with us #[support@snapsec.co](mailto:support@snapsec.co)
