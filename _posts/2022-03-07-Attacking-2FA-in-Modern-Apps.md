---
layout: post
title:  "Attacking 2FA in Modern Web Applications"
author: danish
categories: [ 2FA,geneal,danish ]
image: assets/images/9/1.png
---





You might be familiar with the _annoying_ otps or other autthentication tokens delivered right after you log into your favourite site. This article will help you to understand the purpose of **2FA** and its _exploitation_ . I have also drafted some of the 2FA bypasses you can use these techniques to exploit the authentication of an  application.
## What is two factor authentication or 2FA?

![1](/blog/assets/images/9/2.png)


Two-factor authentication (2FA), sometimes referred to as two-step verification_ or _dual-factor authentication , is a security process in which users provide two different authentication factors to verify themselves. 2FA is implemented to better protect both a user’s credentials and the resources the user can access.

## Why is it implemented

Two-factor authentication provides a higher level of security than authentication methods that depend on single-factor authentication (SFA), in which the user provides only one factor – typically, a password or passcode.Two-factor authentication methods rely on a user providing a password as the first factor and a second, different factor – usually either a security token or a biometric factor, such as a fingerprint or facial scan. Two-factor authentication adds an additional layer of security to the authentication process by making it harder for attackers to gain access to a person’s devices or online accounts because, even if the victim’s password is hacked, a password alone is not enough to pass the authentication check.

Two-factor authentication has long been used to control access to sensitive systems and data. Online service providers are increasingly using 2FA to protect their users’ credentials from being used by hackers who stole a password database or used phishing campaigns to obtain user passwords.

## Exploiting weak or improper 2FA in web applications

![1](/blog/assets/images/9/3.png)

Many modern web applications implement an external layer of security i,e 2FA which is no brainer to most of the us it was devised to protect but exploting this issue hackers can sometimes compromise the accounts of users without much toil. In this section we will take a look on how this _extra layer of security can be exploited and what its exploitation will land an attacker on_.

Bad implementation of 2FA by an organization or company can let an attacker to compromise their accounts on mass level . Like On July 15th, the popular social media site Twitter was hacked causing a disruption in service for users as internal security teams scrambled to mitigate damage. Using social engineering and SIM swapping, hackers were able to successfully access Twitter’s admin panel made only available to internal support teams. The results were over 130 hacked user accounts and $120,000 worth of funds stolen from victims of a vicious phishing attack. This was one of drastic effects caused by the exploitation of the 2FA.

Similarly hacking a company's Slack channel hosting system admin credentials, hackers were able to gain access to employee accounts and even bypass two-factor authentication (2FA) – a security policy often cited by security experts as a ‘necessary’ tool to safeguard company data. The primary flaw in 2FA is that it’s only as strong as the trust its users place in it. Once a user receives a phishing message requesting them to log in to their account, the manipulation of social engineering begins. Next, the user may enter their username, password, and 2FA information into a site completely unaware it is a phishing site designed to convince them they are logging in to their real account. Afterall 2FA is but a agame of numbers coceived by an algorithm.Since the user seemingly trusted the phishing site, they easily gave away their credentials and rendered 2FA useless.

In addition, 2FA data can also be recorded in session cookies. Once a victim adds their 2FA code to a website, a hacker has the ability to sniff session cookies from a developer tool in a web browser. Using the session cookie, hackers have no need for a victim’s username and password –– they simply need to paste the session cookie into a browser to log in to the victim’s account.

Furthermore attacker can also perform a critical actions even bypassing a 2FA. So now the attacker can delete accounts, update emails and do much more critical actions and totally compromise victims accounts. Many Corporative giants, various banks using the two-factor authentication technique to ensure security to its users. Although, these companies don’t make this kind operations by themselves, they hire third part companies to do so, integrating the API products for onwards delivery. Because of this implementation technique they are also vulnerable to serious breaches that can be exploited.The third party companies stays between the client and the website being in a privileged place to attack any unsuspecting victim.

# 2FA/OTP Bypasses

![1](/blog/assets/images/9/4.png)


This extra layer of security implementation is gaining fame in modern day web applications and is implemented on huge scale. But as discussed above _improper implementation_ poses risk to both organizations as well as users residing on their 2FA. As a _pen-tester, bug humter_whenvever you come across these 2FA's mechanisms* inside an app make sure you test and try every bypass to identify _vulnerability_. Because at the end of the day you are securing the internet not just breaching it. Below are few of my techniques i use to _bypass 2FA_ in the application.

- **Forced Browsing**: In this technique the attacker can try accessing different endpoints directly with the avilable token. The reason 2FA is always prompted after user passes the 1st authenticate mechanism there will always be a session token generated by 1st auth mechanism. So the trick is to check if the application allows users to visit several endpoint based on the Auth token generated by 1st Authanticate mechanism , If this doesn’t work, try to change the Referrer header as if you came from the 2FA page.



- **Reusing token**: Try Re-using the Auth code sent to your phone number twice or thrice, If you are able to do so an attacker could use older OTP to bypass 2FA in target account anytime in future.


- **Sharing unused tokens**: Check if you can get for your account a token and try to use it to bypass the 2FA in a different account.

- **Leaked Token**: the token leaked on a response from the web application can be reused or may be used to bypass all authentications.

- **Password reset function**: In almost all web applications the password reset function automatically logs the user into the application after the reset procedure is completed. Check if a mail is sent with a link to reset the password and if you can reuse that link to reset the password as many times as you want (even if the victim changes his email address).

- **Lack of Rate limit**: 
Developers often use rate limits to control the number of requests per user. Basically, the rate limit is used to control the rate of traffic sent or received on the network. But these headers can be used to bypass several rate limit protections by forging the origin or requests in many cases, If There is no limit in the amount of codes that you can try on a single account, then you can just brute force it. Be careful with a possible “silent” rate-limit, always try several codes and then the real one to confirm the vulnerability.


    The possibility that any of these bypasses will work completely depends on the internal infrastructre of target network, To be sure with our customers we do run a little brutefoce to confirm if the bruteforce protection is working completely fine on 2FA endpoint. To test this on your side All you have to do is to Use the mentioned list of Headers just under the Host Header in the Request responsible to send the 2FA code to the server:


```
1.  X-Originating-IP: 127.0.0.1
2.  X-Forwarded-For: 127.0.0.1
3.  X-Remote-IP: 127.0.0.1
4.  X-Remote-Addr: 127.0.0.1
5.  X-Forwarded-Host : 127.0.0.1
6.  X-Client-IP : 127.0.0.1
7.  X-Host : 127.0.0.1
8.  Forwarded: 127.0.0.1
9.  X-Forwarded-By: 127.0.0.1
10.  X-Forwarded-For-IP: 127.0.0.1
11.  X-True-IP: 127.0.0.1
```


- **Re-send code reset the limit**: In this case there is a flow rate limit (you have to brute force it very slowly: 1 thread and some sleep before 2 tries) but no rate limit. So with enough time you can be able to find the valid code.


- **CSRF/Clickjacking: Check if there is a CSRF or a Clickjacking vulnerability to disable the 2FA.**

- __Response Manipulation__: Every request generated from your browser will have a response which is receaved by the code at front end and later the data in the response is used to take several decision on which functionalaties/links/UI features should be visible to the user. Some time developers assume that if the web-server response 200OK response to the request contains 2FA code the logic at the fron-end assumes that the code is correct hence logs in user to their accounts, But this flawed logic can be used to bypass 2FA completely by intercepting the Incorrect Response code and then changing to the 200OK and hence bypass the 2FA authentication on any target account.

Example:

Changing Response Body:

```json
{"success":"false"} -> {"success":"true"}
```

Changing Response Code:

```
change 403 -> 200
```


- __Cross Token Usage__: Try using the 2FA codes send to Account1 on Account2, This simple technique can sometimes lead to 2FA Bypass. The science behind this is pretty simple, If the web application is generating Random tokens and sending them to users and at the same time saving those token to their database, When the user submits his 2FA code to the server the code gets matched to the list of codes saved in the database. You see, the codes are not session concious in this case so as long as user is able to get any valid code, Which is any code stored in the database in that paticular timeframe he will be able to bypass 2FA on any target account.



- __Using Different Authentication Methods__: when implementing different ways to authenticate a user, The 2FA needs to be enforced on each different mechanism supporte by an Application. Somtimes web developer forgot to enforce 2FA on login via google,facebook,apple Etc, Which may allow attacker to bypass 2FA.



## Conclusion:- 
- Two-factor authentication provides an extra  level layer of security on modern web applications.
- improper implementation of 2FA can cause damage to compromise the users accounts.
- I have already mentioned above some cool bypasses you can use those bypasses to check the authentication of an application.



## About us

Snapsec is a team of security experts specialized in providing pentesting and other security services to secure your online assets. We have a specialized testing methodology which ensures indepth testing of your business logic and other latest vulnerabilities. 

 If you are looking for a team which values your security and ensures that you are fully secure against online security threats, feel free to get in touch with us #[support@snapsec.co](mailto:support@snapsec.co)
