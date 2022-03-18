IDOR (Insecure Direct Object Reference) is a vulnerability that could allow unauthorized access to web pages or files. The most common case of IDOR is for an attacker to enumerate a predictable identifier, thereby gaining access to someone else’s data.
A Direct Object Reference is a web application design method in which entity names are used to identify application-controlled resources that are passed in URLs or request parameters.
Insecure Direct Object Reference represents a vulnerable Direct Object Reference. It involves replacing the entity name with a different value without the user’s authorization. As a result, users will be directed to links, pages, or sites other than the ones they intended to visit, without having the slightest clue about it.
Insecure Direct Object References (or IDOR) is a simple bug that packs a punch. When exploited, it can provide attackers with access to sensitive data or passwords or give them the ability to modify information.



## Its Impact

Exposure of Confidential Information: When the attacker will have control over your account via this vulnerability, it is obvious that an attacker will be able to come across your personal information. Authentication Bypass: As the attacker can have access to millions of account with this vulnerability, it will be a type of Authentication bypass mechanism. Alteration of Data: An attacker may have privileges to access your data and alter it. By this, an attacker may have permission to make changes to your data, which may lead to manipulation of records. Account Takeover: While an attacker may have multiple access to user accounts just by changing the “UID” values, this will lead to account takeover vulnerability. When one vulnerability leads to another vulnerability(like in this case), It is known as Chaining of BUGS.
    
So we can say in general that the impact of an insecure direct object reference vulnerability depends very much on the application’s functionality. Therefore, a clear list can not be easily given. Generally speaking, an IDOR vulnerability can introduce a risk for CIA (confidentiality, integrity, availability) of data.
 
As you can probably imagine, IDORs can be quite catastrophic for businesses. In this case, think about all the bad PR example.com will face when its users find out that anyone could have read their private messages!


 

## Example
 
For example suppose there is a website which allows to users to setup profile like linkedin and share info about users, and logged user can get the all private details of their own account using below api

/myprofile/uid=1200

Now if a malicious user temper the uid parameter by changing it to 1201 and get access to another user private details then in this case the application is vulnerable to IDOR  and by increasing / decreasing the uid values attacker can access all users private details.



## Our Approach for Looking IDOR

IDOR's are considered to be one of most of easiest bugs to look for, But I am going to break down this into a couple of parts.

- __Understanding the APP__:

Well the first step is always to understand the puprpose of the application, What is your target app made for , and what type of services does this app provide to the customers , Understanding such things is critical to us, Becuase it allows us to understand application features in the context of its purpose. 

_ __Understand the identifiers__:



## Causes of IDOR:

The root cause of IDOR vulnerabilities is missing access control. If you can check the user’s permissions before returning sensitive resources, direct object references wouldn’t be such a problem after all. So the second thing you should do to prevent IDORs is to implement robust access control. For each piece of application resource that should be restricted, you should verify that the user is indeed authorized to access it.

## Few best practices.

   
- Validation of parameters should be properly implemented.
- Verification of all the referenced objects should be checked.
- Tokens should be generated in such a way that it can only be mapped to the user and is not public.
- Ensure that queries are scoped to the owner of the resource.
- Avoid things like using UUIDs (Universally unique identifier) over Sequential IDs as UUIDs often let IDOR vulnerabilities go undetected.

## Conclusion




