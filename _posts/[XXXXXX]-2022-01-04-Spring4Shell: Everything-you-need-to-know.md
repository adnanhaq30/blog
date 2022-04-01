
A Spring MVC or Spring WebFlux application running on JDK 9+ may be vulnerable to remote code execution (RCE) via data binding. The specific exploit requires the application to run on Tomcat as a WAR deployment. If the application is deployed as a Spring Boot executable jar, i.e. the default, it is not vulnerable to the exploit. However, the nature of the vulnerability is more general, and there may be other ways to exploit it.

Spring WebFlux is a fully non-blocking, annotation-based web framework built on Project Reactor that makes it possible to build reactive applications on the HTTP layer. WebFlux uses a new router functions feature to apply functional programming to the web layer and bypass declarative controllers and RequestMappings.

To understand how to Build Web Api's or Web Applications in Spring WebFlux [Read this article](https://howtodoinjava.com/spring-webflux/spring-webflux-tutorial/#:~:text=What%20is%20Spring%20WebFlux%20%3F,easily%20work%20on%20webflux%20also.)



## Prerequisites for the exploit:

- JDK 9 or higher
- Apache Tomcat as the Servlet container.
- Packaged as a traditional WAR (in contrast to a Spring Boot executable jar).
- spring-webmvc or spring-webflux dependency.
- Spring Framework versions 5.3.0 to 5.3.17, 5.2.0 to 5.2.19, and older versions.
> However, the nature of the vulnerability is more general, and there may be other ways to exploit it that have not been reported yet.


## Severity

The Severity is __CRITICAL__, Click the following [Link to CVSS-v3](https://www.first.org/cvss/calculator/3.0#CVSS:3.0/AV:N/AC:L/PR:N/UI:N/S:U/C:H/I:H/A:H)  to have a indepth look at how this vulnerability effects the CIA of the target system.

## Scanning Your Networks



Recently one of the security researchers have build a Nuclie Teamplate to Detect Spring4Shell, This template can be easily run to scan for Spring4Shell on your Networking, routing or security devices inside your network.

Template Links: https://github.com/projectdiscovery/nuclei-templates/blob/master/cves/2022/CVE-2022-22965.yaml

__How to run a Scan:__

- Download the template in the current dir
- Save all your target IP's or Web Addresses in `urls.txt`
- run `nuclei -list urls.txt -t CVE-2022-22965.yaml`

> Scanning 

## Refrences:

https://spring.io/blog/2022/03/31/spring-framework-rce-early-announcement
https://tanzu.vmware.com/security/cve-2022-22965
