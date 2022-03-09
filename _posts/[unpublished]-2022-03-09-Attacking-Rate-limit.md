### What is rate limiting

Rate limiting is a process to limit requests. It is used to control network traffic.
Suppose a web server allows upto 20 requests per minute. If you try to send more than 20 requests, an error will be triggered. A rate limiting algorithm is used to check if the user session (or IP address) has to be limited based on the information in the session cache. In case a client made too many requests within a given time frame, HTTP servers can respond with status code 429: Too Many Requests.

## Why is it implemented?

This is necessary to prevent the attackers from sending excessive requests to the server. Rate limiting helps prevent a user from exhausting the system’s resources. Rate limiting applies to the number of calls a user can make to an API within a set time frame. This is used to help control the load that’s put on the system. An API that utillizes rate limiting may throttle clients that attempt to make too many calls or temporarily block them altogether. Users who have been throttled may either have their requests denied or slowed down for a set time. This will allow legitimate requests to still be fulfilled without slowing down the entire application. Without rate limiting, it’s easier for a malicious party to overwhelm the system. This is done when the system is flooded with requests for information, thereby consuming memory, storage, and network capacity. It reduces the excessive load on web servers. it helps to stop certain kinds of malicious bot activity like login to an account using multiple guess passwords and user ids. It also prevents the modern web applications from bruteforce attacks.

### No rate limit flaw and its exploitation:-

No rate limit is a flaw that doesn’t limit the no. of attempts one makes on a website server to extract data. It is a vulnerability which can prove to be critical when misused by attackers. The zoom app has become popular in the lockdown , it has become an essential alternative to offline classes.Attackers were successfully able to crack the password of the private meetings by exploiting the no-rate limit flaw vulnerability of zoom app. Zoom web client allowed brute force attempts to crack password protected private meetings that occurred in Zoom.Later, this vulnerability was patched by security experts.

This vulnerability type is made possible because endpoints that serve data can be called upon many times per second by users/attackers. If the user/attacker requests so data so many times the system can no longer keep up and starts consuming all of its resources this can even lead to a DOS (Denial Of Service) attack but the consequences might be even greater than that on certain authentication endpoints which might open the API up to forgotten password reset token brute forcing. This security vulnerability is common in the wild and thus we may often encounter API's that contain no or weak rate limiting.

Thus the impact can range from something like DOS up to enable authentication attacks, these are all in the higher end of the impact range because they have some serious potential to disrupt the normal workings of our API. Whenever an API is served a request it will have to respond, to generate this response the API requires resources (CPU, RAM, network and at times even disk space) but how much are required highly depends on the task at hand. The more logic processing happens or data is returned, the more resources are taken up by a single call and this can stack on quick. If we do not rate limit our API endpoints. This issue is made even worse by the fact that most API's reside on shared hosts which means they are all fighting for the same resources which could mean the attacker is disabling a secondary unrelated API by consuming all the resources.

### No rate limit bypasses:-

1:**Using similar endpoints:** If you are attacking the `/api/v3/sign-up` endpoint try to perform bruteforce to `/Sing-up`, `/SignUp`, `/singup`. 
2:**Blank chars in code/params**:Try adding some blank byte like `%00, %0d%0a, %0d, %0a, %09, %0C, %20` to the code and/or params. For example `code=1234%0a` or if you are requesting a code for an email and you only have 5 tries, use the 5 tries for `example@email.com`, then for `example@email.com%0a`, then for `example@email.com%0a%0a`, and continue. 
3:**Changing IP origin using headers**: X-Originating-IP: 127.0.0.1 X-Forwarded-For: 127.0.0.1 X-Remote-IP: 127.0.0.1 X-Remote-Addr: 127.0.0.1 X-Client-IP: 127.0.0.1 X-Host: 127.0.0.1 X-Forwared-Host: 127.0.0.1 #or use double X-Forwared-For header X-Forwarded-For: X-Forwarded-For: 127.0.0.1 
4:**Change other headers:** Try changing the user-agent, the cookies... anything that could be able to identify you. 
5:**Login in your account before each attempt:** Maybe if you login into your account before each attempt (or each set of X tries), the rate limit is restarted. If you are attacking a login functionality, you can do this in burp using a Pitchfork attack in setting your credentials every X tries (and marking follow redirects). 
6:**OTP Brute-Force Via Rate Limit Bypass**: If the rate limiting is blocking all the requests by showing the server error. Try to add an extra header X-Forwarded-For header in the request. Looped the request 50 times, from 127.0.0.1 till 127.0.0.50 (value of the X-Forwarded-For header). 
7:**Adding extra params to the path**:If the limit in in the path /resetpwd, try modify that path, and once the rate limit is reached try /resetpwd?someparam=1

## Conclusion

No rate limit is **a flaw that doesn't limit the no. of attempts one makes on a website server to extract data** .It is a vulnerability which can prove to be critical when misused by attackers.

Bypassing

There are some headers which can be used to Bypass Rate Limitation. All you have to do is to Use the Header just under the Host Header in the Request:

1.  X-Forwarded-For : IP
2.  X-Forwarded-Host : IP
3.  X-Client-IP : IP

There are more bypasses i have mentioned in the above section as well.
