# SSRF

SSRF stands for **Server Side Request Forgery.** SSRF is a web security vulnerability that allows an attacker to induce the server-side application to make requests to an unintended location. In a typical SSRF attack, the attacker might cause the server to make a connection to internal-only services within the organisation's infrastructure.

[https://portswigger.net/web-security/ssrf](https://portswigger.net/web-security/ssrf)

**Types of SSRF:**

1. **Blind SSRF**: In a Blind SSRF, the attacker is unable to control the data of packets sent to a trusted internal network application. The attacker has complete control over the server’s IP address and ports. We must supply a URL followed by a colon and a port number to attack this sort of SSRF; we can determine the open and closed ports of the server by analysing responses and error messages from the server. To verify the status of the various ports, we used this approach.
2. **Partial Response SSRF**: We get a restricted response from the server with this form of SSRF, such as the title of the page or access to resources, but we can’t see the data. This type of vulnerability can be leveraged to read local system files such as **/etc/config, /etc/hosts**, etc/passwd, and many others by controlling only certain parts of the packet that arrive internal program. We can read files on the system using the file:/ protocol. In some circumstances, XXE injection and DDoS vulnerabilities like these can be used to exploit partial SSRF vulnerabilities.
3. **Full Response SSRF**: We have complete control over the Packet in Full SSRF. Now we may access the internal network’s services and look for vulnerabilities. We can use protocols like file:/, dict:/, HTTP://, gopher:/, and so on with this form of SSRF. We have a lot of freedom here to make different requests and abuse the internal network if there are any weaknesses. By submitting huge strings in the request, the whole SSRF vulnerability might cause the application to crash due to buffer overflow.

[https://zindagitech.com/what-is-server-side-request-forgery-ssrf-and-the-types-of-attacks/](https://zindagitech.com/what-is-server-side-request-forgery-ssrf-and-the-types-of-attacks/)

### Vulnerable code snippet

```php
<?php
if(isset($_GET['url'])){
	$url=$_GET['url'];
	$output=file_get_contents('http://'.$url);
	echo $output;
}
?>
```

Understanding the code

`$_GET` is used here to get URL from user.

`file_get_contents()` This function is the preferred way to read the contents of a file into a string. The website here allows us make requests to URL from server.

Then we store the contents in `$output` and return using `echo`

### Where is the issue?

The issue in the above code is in `file_get_contents` part. Here we are passing the URL argument from user directly to `file_get_contents` without filtration. This can lead to an attacker passing an internal IP in the argument. The request will be originated from the server, since the host server has access to internal network, the server will send the request to internal IP, get the response and send that to attacker.  This can lead to  leaking sensitive data such as authorization credentials, tokens, keys.

## Exploitation

## Mitigating the issue

## Confirming the fix
