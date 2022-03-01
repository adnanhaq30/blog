---
layout: post
title:  "CORS Misconfigurations"
author: adnan
categories: [ writeup,cors,adnan ]
image: assets/images/8/0.png

---




If you are a developer, you already know that it’s nearly impossible to keep every resource in one place. It’s expensive (because everything has to be managed by one party) and it gets quite messy. So you maybe thinking that developers can potentially use two different domains to sepereate resources on different servers. An API on a api.web.com and the UI on ui.web.com, But due to the security mechanism called SOP the context and resources of each website is isolated from each other, which means any resource loaded from api.web.com cannot be accessed by ui.web.com. Which again leads us to the same problem, Well here comes the CORS, The method that allows different websites share resources securly.   

## What is CORS:


![1](/blog/assets/images/8/1.png)


CORS stands for CROSS ORIGIN RESOURCE SHARING. This method allows websites to load resources from different domains securely. These resources are usually fonts, images/videos, CSS, ajax requests etc etc. CORS adds flexibility to Same-Origin-Policy which blocks reading resources from different origins by default. With Same-Origin-Policy, JavaScript can only make calls to URLs that live on the same origin as the location where the script is running. For example, if a JavaScript app wishes to make an AJAX call to an API running on a different domain, it would be blocked from doing so thanks to the same-origin policy. To overcome this problem, CORS was introduced. CORS allows servers to specify certain trusted ‘origins’ they are willing to permit requests from.

So how do we define origin? Well, origin can be defined as the combination of:

1. Protocol: Protocol could be a HTTP or HTTPS.
2. Host: This is where your website lives. like [example.com](http://example.com) or it could be an IP address
3. Port: These are communication endpoints. Default port of HTTP is `80` and or HTTPS it is `443`

So from above definition we see that `http://example.com` and `https://example.com` are two completely different hosts.

## How is CORS implemented

When we want a website different than our own to access the resources on our server or API, we have to include the trusted origins on our server or we can add a wildcard(*). Wildcard means anyone can access our resources regardless of their origin. For example, if we want to allow specific domains to access our server resources, we have to enable the CORS in server configuration. This can be done like:

```
💡 “origins: “https://example.com:8080”
```

Or we if we want to give access to all website we add

```
💡  origins: *
```

By default, CORS does not include cookies in cross-origin requests. So there is another header that we have to add and that is `Access-control-Allow-Credentials` This lets the browser to allow the requested whitelisted domain to read the credentials like cookies, authorization headers, tokens or TLS client certificates. The client code *must* set the `withCredentials` property on the `XMLHttpRequest` to `true` in order to give permission.

However, this header alone is not enough. The server *must* respond with the `Access-Control-Allow-Credentials` header. Responding with this header to `true` means that the server allows cookies (or other user credentials) to be included in cross-origin requests.

The server response typically looks like:

```
💡 Access-Control-Allow-Arigin: [http://example.com](http://example.com)                                                        Access-control-allow-credentials: true
```

## Types of CORS requests

![1](/blog/assets/images/8/2.png)


There are two types of CORS requests viz

- Simple request
- Preflight request

**Simple request:** Any request with the method of ***GET, POST and HEAD*** is called simple request. In these cases, the browser will directly make a request with origin header in it, without any pre-check. After sending the request, HTTP response headers are checked to determine whether the request should go through or not.

The request with the origin header would go as:

**`Origin: http://example.com`**

Response from the destination would be either of the following:

1. **Access- Control-Allow-Origin: [http://example.com](http://xyz.com/) (which conveys that this domain is allowed)**
2. **Access-Control-Allow-Origin: * (which conveys that all domains are allowed)**
3. **An error if the cross-origin requests are not allowed (which conveys that access is not allowed)**

**Preflight requests:** Any request with the method of **PUT and DELETE** is deemed as unsafe methods because they affect the integrity of server data. Therefore, before these requests are made to the server, an extra **OPTIONS** request is sent by the browser, this request is called preflight check request. There are several headers that need to be sent with options request:

- **Origin** — The origin header that would be included with the actual request being made by the website.
- **Access-Control-Request-Method** — The method of the actual request being made by the website.
- **Access-Control-Request-Headers** — A comma-separated list of headers that would be included in the actual request.

for example:

```
💡 Origin: example.com

Access-Control-Request-Method: DELETE
Access-Control-Request-Headers: Content-type, Authorization-Bearer
```

The response from server would look like:

```
💡 Access-Control-Allow-Origin: example.com

Access-Control-Allow-Methods: PUT,DELETE,PATCH,GET,POST,HEAD
Access-Control-Allow-Headers: Content-type, Authorization-Bearer

```

If any of the information in the response headers does not match the actual parameters of the request, the browser will not send the actual request, thus preventing unwanted side-effects from the server receiving the cross-origin request.

## CORS misconfigration and exploitation

![1](/blog/assets/images/8/3.png)


Misconfiguration in CORS has a high impact on the security of a website. A CORS misconfiguration can leave the application at a high-risk of compromise resulting in an impact on the confidentiality and integrity of data by allowing third-party sites to carry out privileged requests to vulnerable websites by posing as authenticated users. The malicious website can also retrieve user setting information or saved payments, cookies etc etc

Here are few common misconfigrations and how to exploit them:

1. **Wildcard(*) misconfigration:** 

Wildcard means that any domain can access the resources of the server. The misconfiguration in this can cause serious security risk. For example:

```
💡 Get /api/userinfo

Host: vulnerablewebsite.com
Origin: attacker.com
```

After sending the above request if server responds with

```
💡 Access-Control-Allow-Origin: *
Access-Control-Allow-Credentials: true
```

This is a worst case scenario of a misconfigured server which can be easily exploited and can be used to steal user data and credentials, hence affecting the confidentiality and integrity of data.

1. **Whitelisted domain misconfigration:**

Mistakes often arise when implementing CORS origin whitelists. Some organizations decide to allow access from all their subdomains including the ones not in existence yet(like *.example.com). And some applications allow access from various other organizations' domains, including their subdomains. These rules are often implemented by matching URL prefixes or suffixes, or using regular expressions. Any mistakes in the implementation can lead to access being granted to unintended external domains.

The attacker can use the following methods of origin on vulnerable website :

1. Origin: [evil.vulnerable.com](http://evil.vulnerable.com) [allowing access from all subdomains]
2. Origin: [evilvulnerable.com](http://evilvulnerable.com) [matching a certain part of url like ‘vulnerable’ in this example
3. Origin: vulnerable.com.evil.com

If a server responds with any of the above domain in response with credentials set to true, then the server is exploitable.

1. **Exploiting CORS via XSS:**

Suppose we have a website, [secure.com](http://secure.com/) and it has some whitelisted subdomains in CORS policy. Since these domains trust each other completely, if the subdomain is vulnerable to XSS, attacker can exploit the XSS in vulnerable subdomain and inject some JavaScript that uses CORS to retrieve sensitive information from the [securesite.com](http://securesite.com/) that trusts the vulnerable application.

1. **Whitelisted NULL origin:**

If any websites has whitelist NULL origin and returns ACAC set to `true`  this website can be vulnerable and can be exploited via sandboxed iframes.

## Conclusion

Cors was implemented to make it possible for websites to share resources with each other with least impact on security. However, this introduced a vast number of security risks. If CORS is not properly configured it can lead to high security impact on the website, affecting Confidentiality, Integrity and Availability of company data.


## About us

Snapsec is a team of security experts specialized in providing pentesting and other security services to secure your online assets. We have a specialized testing methodology which ensures indepth testing of your business logic and other latest vulnerabilities. 

 If you are looking for a team which values your security and ensures that you are fully secure against online security threats, feel free to get in touch with us #[support@snapsec.co](mailto:support@snapsec.co)
