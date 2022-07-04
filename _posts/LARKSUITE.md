## We Hacked  Larksuite for 2 months: This is all summarized


# Introduction

{{WE ARE OFTEN OUT OF PENTESTING WORK}} Almost a year back in March 2020 shuffling our private invites stock inorder to crash into a programme worthy of our time and excitement. In a while we stumbled upon a programme by name of **Lark Technologies**. Larksuite is basically a _collaborrative platform_ where users can collaborate on various tasks. This *product comprised of various interconnected services and functionalities* and hence the name _suite_. The stats on the bugbounty page spoke that they were *responsive and were unselfish* with their bounties. All this was interesting and solidified the notion of choosing *larksuite* as our next target for some time to hack on. Choosing a *programme/target only on above apparaent things* can't be an intelligent step one should take. So, we started exploring the *target* and we found enough reasons to deem it as our next target. 

{{As snapsec we like indepth assesments and its compulsory for applicate to be complex in terms of its app logic and needs huge to be in terms of the size , in this here are the few reasons we prefered to stay on lark for almost a month}}


- __Higher application size__: This in simple terms means a **larger attack surface**, _more depth_ and *less burnouts*. With respect to above *programme* it provided various services like _messenger, meetings, calendars, email services, docs and cloud storage_ .

- __Access controls were implemented__ : This is something we can hardly resist from testing, being specialized in *testing access controls* this was one of our strongest cues. Larksuite iplemented various **RBAC (Role based access controls)**  in the application meaning there were exclusive *permission sets* for specific roles in the *organization*.

- __File management and sharing systems__ :  One of the *fun and interesting* feature to exploit and fiddle with. Larksuite *implemented file sharing systems* in their product as well which allowed users to **upload and share various files and documents** and they could also *edit/create new versions of those files*.

These were a some of the principal points on basis of which we choose a new target, though there are more but we can't add all of them here.

# Recon

The rule of thumb when it comes to hacking any target is to know it well and collect as much as information as you can.

```
If you give a hacker a new toy, the first thing he’ll do is take it apart to figure out how it works. — Jamie Zawinski
```
Reconnaissance is a set of processes and techniques used to covertly discover and collect information about a target system. In the reconnaissance stage, attackers act like detectives, gathering information to truly understand their target. If you think *Recon is only* the process of the running a set of tools blindly while watcing the *flashing clolors*  with your arms *crossed*, then you need to rethink the *process of recon*. Or you are going to know a different kind of recon in this section.

Prior to running tools and gathering data our recon comprises of **Reading product documenatation, checking their youtube channels, third party product walkthroughs and tutorials. webinars etc**. We will be briefly describing the mentioned approaches in our *Recon process*.

-  __Reading Product documentation__: These are one of the accurate and simplified resources you can get your hands on. They are built or documented for the users/customers of this application and the've simplified it to the level that anyone can understand it. The perks of reading this documentation that *you get to understand* the application from a *user's perspective* and all of the *features get revealed to you*, their use and dependence. Moreover the logic of the application gets clear to you. We spent a few days reading the documentation and using the application as *simple users* and meanwhile if any test case came to our mind we just noted it down. 

{{screenshot1}}

- __Browsing their youtube channels__ :  In this case we *visited the official channel of larksuite*  which is under the name of *Lark* on youtube, there was again a treasure of information. Step by step tutorials explaining difficult features, in other words it is visual docementation of the product. We went through almost all of the vedioes thoroughly and it sedimented the *understanding of product* and we were able to understand it better.

> [https://www.youtube.com/c/Larksuite/videos](https://www.youtube.com/c/Larksuite/videos)

{{screenshot 2}}

- __Reading about product from third party resources__ : One of the prime benefit of reading from *third party resources* the *product information and one's user knowledge* get diversified and sometimes you can *know the issues or errors* from those resources which can be *directly abused* and you can have easy bugs.

- __Product helpdesk and community support__: People have always listed their typical queries and concerns on these platforms and the companies have answered them. We read the queries as well so that we can grasp some typical issues faced by maximum users and look into them if they can be abused.

Surely our recon doesn't end here but this forms the *fundamentals* of our recon to any *organization or target* we choose to hack. 


## Vulnerabilities Discovered



|id| Report Date      | Title | Severity     |
| :---        |    :----:   |          ---: |
|1| Nov 04-2020      | Accessing/Editing Folders of Other Users in the Orginisation       | High  |
|2| Oct 10   | Privilege Escalation to All-staff group (editing/accessing/deleting All-staff group)       | Medium      |
|3| Oct ran-10   | Viewer is able to leak the previous versions of the file      | Medium      |
|4| Oct-11-jan   | User without permission can download file's even if it's restricted.       | Medium      |
|5| Oct-12-jan   | Viewer was able to permanentaly delete bin files of Admin | Medium|
|6| Oct-12-2021 | Access to private file's of other users in helpdesk conversation | High |
|7| xxxx | Sub-Dept User Can Add User's To Main Department |xxxx|
|8| xxxx | Auto approving own apps from a lower level role leading to mass privilege escalations | xxx|
|9| xxxx | Attacker can join any tenant on larksuite and view personal files/chats. | xxxx |
|10| xxxx | Low privileged user is abel to access the Admin log | xxxx |
|11| xxxx | Viewing comments on files and documents. | xxxx|



## Pending

| Oct-11-jan   | IDOR allows viewer to delete bin's files of Admin       | Medium      |
| Oct-11-jan    | Bypassing Required Validation on Survey Questions     | Low      |




## Accessing and Editing other users folders in the organization

Lark-suite allows Super-admins to invite other admin's/users. The invited users are allowed to view/modify their folders in the lark app. But we found a Security issue which allows other users to view/modify directory structure of other users in the organisation, without having any access on those files.

![](https://hackerone-us-west-2-production-attachments.s3.us-west-2.amazonaws.com/2s8ZBjFmYWEdKyABmKXpUNJL?response-content-disposition=attachment%3B%20filename%3D%221.png%22%3B%20filename%2A%3DUTF-8%27%271.png&response-content-type=image%2Fpng&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ASIAQGK6FURQ47PMAVVH%2F20220608%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20220608T054216Z&X-Amz-Expires=3600&X-Amz-Security-Token=IQoJb3JpZ2luX2VjEOv%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEaCXVzLXdlc3QtMiJGMEQCIAm%2BRYTpd7QHtHUeg%2B5XIGJH4wCJ9x5P26fgOzlpisaSAiAHNrEyzdtRsd7z8j6cmBv%2FlPrMlg0tlq3xQMIBhdI5EyrbBAjk%2F%2F%2F%2F%2F%2F%2F%2F%2F%2F8BEAIaDDAxMzYxOTI3NDg0OSIM9lzlLph4bSZKshGuKq8EYlE4G6hnXf6xkIN2wYqjwgNlnoVU0dmSOI63dLWxB%2F6Tj04m%2Bm%2BGvhsd3Qbowt%2FKdqGZSMP8UmCKljd%2FNpdtgORv2YytCMkgdEZ3Qko37nzCM7f9BH57Ea%2BNHv4UdVKAWZpr3gtgqBXRAxylovjZeULLOIUDXZOrLkBZGmJVDfsrDNN9DNjUhO2nDS8T%2BFKj04%2FLYccSSfRkErKNAtqHejcXfKO1XMuoCA2pgw5lRLMUISjTc1uc1qHi90BGRctLU6H2TCAlcjOoS1LJFIxfCit0PGU7QhwaI9R3IjwlDyGwGKTPm8NYkMyAtIjN%2Bzq6MVXpaaph8pEB%2BjgyzOlFFZkQOtgnG13KGEsYyxgbYlFWvCGznopyxHNUPHTwMHOh3R%2FmChnv9hSuhwFy%2BR%2FlipmRr8QT2c%2FL1hARN5eYp9zVTc0Y0iWz7NktLcl%2FBAL3WWPbKfkHxoMpYrvhWvORmySQuuJD88ku61w9CJc4Z64oWkDcZXvLVlDlQp%2FoFVB348C4YgAgLYtDPcQ5n7A%2B8Rzlw9nZVESsU9LnHF77qthosyVwRNMjQsNGCHmcK51YBiDM1iWMAEcg5uIlzJ30jG8N92ZdZVWQCbRDhF3Zy4wq48Q4Sh40V2zmoMs6dbymEzTvfDHZ%2BQcNbdGDReH29zTd1mqs6Y%2BlEsItL5EfP1NzXxpfUy5%2BXuAr3%2Bb8mB6rEUI37kdNGLmaijgcNQLA%2Fv%2FA6DjU0Dhi%2F2ilD6mRqjC2nICVBjqqAdx6xbmnBEFVuSCwoA%2FY9UGd8qlG0gFMDVEMAy8Zry%2FypKV%2FeWcGPfVEbrxdYdiznskAHd5ulU9LqaagqQfGGLeCgnVzKptZHlDR7D19L5y0JjGjAVlE%2F5LhPcWVl4VWNGuU8azgxb7GL5aRFETmKv633KTy5EVuXWQldcmISo5WQsf5C0EhFqXG400vMWhlEqaabhpT0eSmhnDzhLD2AGhzjfJpP7KB6DlO&X-Amz-SignedHeaders=host&X-Amz-Signature=f2e3088a339bb8c35fe6f1c4c11e0e0c357c760990b0e82a1b05a722837083ea)

Once *Super Admin* added another user he was only able to *access the company information* but he lacked access on the *files and directories* of other members. On digging a bit we found a *GET Request* which takes user id in a parameter and *returns the directories and tokens of that user* in the response.

```http
GET  /suite/admin/space_manage/user_folder?userID=6782777787976515850  HTTP/1.1
```

![](https://hackerone-us-west-2-production-attachments.s3.us-west-2.amazonaws.com/ModNpiErLpTWn14uEEXg1Wy4?response-content-disposition=attachment%3B%20filename%3D%224.png%22%3B%20filename%2A%3DUTF-8%27%274.png&response-content-type=image%2Fpng&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ASIAQGK6FURQ47PMAVVH%2F20220608%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20220608T054216Z&X-Amz-Expires=3600&X-Amz-Security-Token=IQoJb3JpZ2luX2VjEOv%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEaCXVzLXdlc3QtMiJGMEQCIAm%2BRYTpd7QHtHUeg%2B5XIGJH4wCJ9x5P26fgOzlpisaSAiAHNrEyzdtRsd7z8j6cmBv%2FlPrMlg0tlq3xQMIBhdI5EyrbBAjk%2F%2F%2F%2F%2F%2F%2F%2F%2F%2F8BEAIaDDAxMzYxOTI3NDg0OSIM9lzlLph4bSZKshGuKq8EYlE4G6hnXf6xkIN2wYqjwgNlnoVU0dmSOI63dLWxB%2F6Tj04m%2Bm%2BGvhsd3Qbowt%2FKdqGZSMP8UmCKljd%2FNpdtgORv2YytCMkgdEZ3Qko37nzCM7f9BH57Ea%2BNHv4UdVKAWZpr3gtgqBXRAxylovjZeULLOIUDXZOrLkBZGmJVDfsrDNN9DNjUhO2nDS8T%2BFKj04%2FLYccSSfRkErKNAtqHejcXfKO1XMuoCA2pgw5lRLMUISjTc1uc1qHi90BGRctLU6H2TCAlcjOoS1LJFIxfCit0PGU7QhwaI9R3IjwlDyGwGKTPm8NYkMyAtIjN%2Bzq6MVXpaaph8pEB%2BjgyzOlFFZkQOtgnG13KGEsYyxgbYlFWvCGznopyxHNUPHTwMHOh3R%2FmChnv9hSuhwFy%2BR%2FlipmRr8QT2c%2FL1hARN5eYp9zVTc0Y0iWz7NktLcl%2FBAL3WWPbKfkHxoMpYrvhWvORmySQuuJD88ku61w9CJc4Z64oWkDcZXvLVlDlQp%2FoFVB348C4YgAgLYtDPcQ5n7A%2B8Rzlw9nZVESsU9LnHF77qthosyVwRNMjQsNGCHmcK51YBiDM1iWMAEcg5uIlzJ30jG8N92ZdZVWQCbRDhF3Zy4wq48Q4Sh40V2zmoMs6dbymEzTvfDHZ%2BQcNbdGDReH29zTd1mqs6Y%2BlEsItL5EfP1NzXxpfUy5%2BXuAr3%2Bb8mB6rEUI37kdNGLmaijgcNQLA%2Fv%2FA6DjU0Dhi%2F2ilD6mRqjC2nICVBjqqAdx6xbmnBEFVuSCwoA%2FY9UGd8qlG0gFMDVEMAy8Zry%2FypKV%2FeWcGPfVEbrxdYdiznskAHd5ulU9LqaagqQfGGLeCgnVzKptZHlDR7D19L5y0JjGjAVlE%2F5LhPcWVl4VWNGuU8azgxb7GL5aRFETmKv633KTy5EVuXWQldcmISo5WQsf5C0EhFqXG400vMWhlEqaabhpT0eSmhnDzhLD2AGhzjfJpP7KB6DlO&X-Amz-SignedHeaders=host&X-Amz-Signature=5da50ed074660f6f59af7dd95952b2a89c4945f5cd07cef920e5073cc6281911)

On the above request we appended another token in the *parameter query* and added a *parentToken* and we gave its *value* as the _user's folder token_ we got in the response of the above request. Request looks something like this:

```http
GET  /suite/admin/space_manage/user_folder?userID=6782777787976515850&parentToken=nodusaSEPbExvXtWY01IboMcwQf  HTTP/1.1
```
The response of this request returned us all of the *files* inside that parent directoryand we were able to *view the files inside that folder*.

![](https://hackerone-us-west-2-production-attachments.s3.us-west-2.amazonaws.com/bhb6k4ZygSuqwzVy3ENQgwwL?response-content-disposition=attachment%3B%20filename%3D%225.png%22%3B%20filename%2A%3DUTF-8%27%275.png&response-content-type=image%2Fpng&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ASIAQGK6FURQ47PMAVVH%2F20220608%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20220608T054216Z&X-Amz-Expires=3600&X-Amz-Security-Token=IQoJb3JpZ2luX2VjEOv%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEaCXVzLXdlc3QtMiJGMEQCIAm%2BRYTpd7QHtHUeg%2B5XIGJH4wCJ9x5P26fgOzlpisaSAiAHNrEyzdtRsd7z8j6cmBv%2FlPrMlg0tlq3xQMIBhdI5EyrbBAjk%2F%2F%2F%2F%2F%2F%2F%2F%2F%2F8BEAIaDDAxMzYxOTI3NDg0OSIM9lzlLph4bSZKshGuKq8EYlE4G6hnXf6xkIN2wYqjwgNlnoVU0dmSOI63dLWxB%2F6Tj04m%2Bm%2BGvhsd3Qbowt%2FKdqGZSMP8UmCKljd%2FNpdtgORv2YytCMkgdEZ3Qko37nzCM7f9BH57Ea%2BNHv4UdVKAWZpr3gtgqBXRAxylovjZeULLOIUDXZOrLkBZGmJVDfsrDNN9DNjUhO2nDS8T%2BFKj04%2FLYccSSfRkErKNAtqHejcXfKO1XMuoCA2pgw5lRLMUISjTc1uc1qHi90BGRctLU6H2TCAlcjOoS1LJFIxfCit0PGU7QhwaI9R3IjwlDyGwGKTPm8NYkMyAtIjN%2Bzq6MVXpaaph8pEB%2BjgyzOlFFZkQOtgnG13KGEsYyxgbYlFWvCGznopyxHNUPHTwMHOh3R%2FmChnv9hSuhwFy%2BR%2FlipmRr8QT2c%2FL1hARN5eYp9zVTc0Y0iWz7NktLcl%2FBAL3WWPbKfkHxoMpYrvhWvORmySQuuJD88ku61w9CJc4Z64oWkDcZXvLVlDlQp%2FoFVB348C4YgAgLYtDPcQ5n7A%2B8Rzlw9nZVESsU9LnHF77qthosyVwRNMjQsNGCHmcK51YBiDM1iWMAEcg5uIlzJ30jG8N92ZdZVWQCbRDhF3Zy4wq48Q4Sh40V2zmoMs6dbymEzTvfDHZ%2BQcNbdGDReH29zTd1mqs6Y%2BlEsItL5EfP1NzXxpfUy5%2BXuAr3%2Bb8mB6rEUI37kdNGLmaijgcNQLA%2Fv%2FA6DjU0Dhi%2F2ilD6mRqjC2nICVBjqqAdx6xbmnBEFVuSCwoA%2FY9UGd8qlG0gFMDVEMAy8Zry%2FypKV%2FeWcGPfVEbrxdYdiznskAHd5ulU9LqaagqQfGGLeCgnVzKptZHlDR7D19L5y0JjGjAVlE%2F5LhPcWVl4VWNGuU8azgxb7GL5aRFETmKv633KTy5EVuXWQldcmISo5WQsf5C0EhFqXG400vMWhlEqaabhpT0eSmhnDzhLD2AGhzjfJpP7KB6DlO&X-Amz-SignedHeaders=host&X-Amz-Signature=be3ca8a037eb9ffb4e3cebe722292ea870076ef28d8ef098a4f273041015cda1)

Moving a step further, we tried if we can *create new files* inside that *folder* and enquiring a bit we found a *below http request* was used to create new folders in a *directory*

```http
POST  /suite/admin/space_manage/user_folder  HTTP/1.1
```
We used the *leaking directory tokens* in this request and response was **200 ok** and upon confirmation we found *new sub directory* was created in that folder.

![](https://hackerone-us-west-2-production-attachments.s3.us-west-2.amazonaws.com/PPFEka7XSt2tXD7FPkKW5P81?response-content-disposition=attachment%3B%20filename%3D%227.png%22%3B%20filename%2A%3DUTF-8%27%277.png&response-content-type=image%2Fpng&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ASIAQGK6FURQ47PMAVVH%2F20220608%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20220608T054216Z&X-Amz-Expires=3600&X-Amz-Security-Token=IQoJb3JpZ2luX2VjEOv%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEaCXVzLXdlc3QtMiJGMEQCIAm%2BRYTpd7QHtHUeg%2B5XIGJH4wCJ9x5P26fgOzlpisaSAiAHNrEyzdtRsd7z8j6cmBv%2FlPrMlg0tlq3xQMIBhdI5EyrbBAjk%2F%2F%2F%2F%2F%2F%2F%2F%2F%2F8BEAIaDDAxMzYxOTI3NDg0OSIM9lzlLph4bSZKshGuKq8EYlE4G6hnXf6xkIN2wYqjwgNlnoVU0dmSOI63dLWxB%2F6Tj04m%2Bm%2BGvhsd3Qbowt%2FKdqGZSMP8UmCKljd%2FNpdtgORv2YytCMkgdEZ3Qko37nzCM7f9BH57Ea%2BNHv4UdVKAWZpr3gtgqBXRAxylovjZeULLOIUDXZOrLkBZGmJVDfsrDNN9DNjUhO2nDS8T%2BFKj04%2FLYccSSfRkErKNAtqHejcXfKO1XMuoCA2pgw5lRLMUISjTc1uc1qHi90BGRctLU6H2TCAlcjOoS1LJFIxfCit0PGU7QhwaI9R3IjwlDyGwGKTPm8NYkMyAtIjN%2Bzq6MVXpaaph8pEB%2BjgyzOlFFZkQOtgnG13KGEsYyxgbYlFWvCGznopyxHNUPHTwMHOh3R%2FmChnv9hSuhwFy%2BR%2FlipmRr8QT2c%2FL1hARN5eYp9zVTc0Y0iWz7NktLcl%2FBAL3WWPbKfkHxoMpYrvhWvORmySQuuJD88ku61w9CJc4Z64oWkDcZXvLVlDlQp%2FoFVB348C4YgAgLYtDPcQ5n7A%2B8Rzlw9nZVESsU9LnHF77qthosyVwRNMjQsNGCHmcK51YBiDM1iWMAEcg5uIlzJ30jG8N92ZdZVWQCbRDhF3Zy4wq48Q4Sh40V2zmoMs6dbymEzTvfDHZ%2BQcNbdGDReH29zTd1mqs6Y%2BlEsItL5EfP1NzXxpfUy5%2BXuAr3%2Bb8mB6rEUI37kdNGLmaijgcNQLA%2Fv%2FA6DjU0Dhi%2F2ilD6mRqjC2nICVBjqqAdx6xbmnBEFVuSCwoA%2FY9UGd8qlG0gFMDVEMAy8Zry%2FypKV%2FeWcGPfVEbrxdYdiznskAHd5ulU9LqaagqQfGGLeCgnVzKptZHlDR7D19L5y0JjGjAVlE%2F5LhPcWVl4VWNGuU8azgxb7GL5aRFETmKv633KTy5EVuXWQldcmISo5WQsf5C0EhFqXG400vMWhlEqaabhpT0eSmhnDzhLD2AGhzjfJpP7KB6DlO&X-Amz-SignedHeaders=host&X-Amz-Signature=016ae34686b75c3fe8fc60a427d83198ad4e0ade804b4d56ede067ed9c170bf0)


## Privilege escalation from only view company info to adding and removing staff members.

Lark-suite allowed admins to invite other admin's with the specific permissions. There was a *specific permission set* which comprised of various permissions and among them admin can specify the *permissions with which he wants users on board*.

In this case *we added a user with only* view company information as shown in this image.

![](https://hackerone-us-west-2-production-attachments.s3.us-west-2.amazonaws.com/tB6VFpv5urP29NjrPwWZmDTQ?response-content-disposition=attachment%3B%20filename%3D%222.png%22%3B%20filename%2A%3DUTF-8%27%272.png&response-content-type=image%2Fpng&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ASIAQGK6FURQSF4YW5QU%2F20220608%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20220608T062407Z&X-Amz-Expires=3600&X-Amz-Security-Token=IQoJb3JpZ2luX2VjEO3%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEaCXVzLXdlc3QtMiJHMEUCIFo66sctWLAYeaqQDx5qy%2Bbu7WbYndyuOV9orpcvowi8AiEAp6CXp9f7vD4hfdt7p8bM1Y%2Bx6yppGl25V3kkhTD%2FaQ4q2wQI5v%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FARACGgwwMTM2MTkyNzQ4NDkiDLN3qg1lVxTybumT3SqvBNbQMYXlMqJHeUBjPBWEdSENYdYZdU1EGh%2BcNde2JwXvsFrAzGGrQcgB1oJ1JSS%2BnoXQEgcXSf9JpTf47B3au9XGLmc7przBQc6vZ0QaacL5POavh5PkxYQjITQ97fASH%2BBaQPFGVhrsPsM7NuEVFsob%2Fo%2FPRvAUD%2FiRsHy%2FQ8YfL6PQGsx%2FjufNsEgwhxV60joh8Bf04TNbfuG6h8m7z0kWnsZLQk6kJKxFUN%2BZ0EB%2B7v6EiAmZbBlCS%2BG8O%2Bf85Mq4ZZdscsSlOp62%2BfkKy1uauTX14cnnyKXALUZ5VBkiMcH%2BLelGvpXhxvKkj26HikH1aLObQjhRzyK888BtUpAJInnBOjYqJBvtHW2yvZt8LObEe9mpi0k0psyucuN4YqeAG%2Fw%2Fgk00kDGs3I1ffQPGNkH4FslLVhHf6z13q7ng0PDNFwPwA2LYEXmbc4RdDeMAHWakdNYRWMh7usoep2Gx201IVsK0vwNXKo21%2Fmc8U5EShxlKWUAKB%2FxMzkksOcIqTjLrzF%2BwblTQj5TLA9hBXmCgWUDEte%2BNvB1xpyaNK6dsTz%2BfVqmdYI0jr0mWEzOyb2y51tMfRTbxETeOOyXayvBaUJYLlTotm482YZY1PYZm8pahsiZIrsecX418GbQCWwWWMvCx50VeF%2FTPMT5SAz3OCBG%2FtUOQgZ%2B3jszc2DFQARuGIHRZoYi%2BYpfSMUO5RgZL%2B%2BdsrCo0GjvTbMjBNLeg45VQ95v9sdJWZKAwkNqAlQY6qQFGq1xBKYDCX0%2F%2B%2BPRSMP2Xwjkb7T17k3S4iq25Qdgo90zT1hUDCEjrV8WbKqPDWN9Lw0%2F2zoeIxGNshtw0CdQyAehQj7Fnvi34x6N9N6GFg4gWf%2BqfcLOnt5CN0Ge0ZEgWdz9666v8BtCRScSaTRvAqzecFQoSr9aAZVxZG36CKUlNy8X%2BeVjMRgf0rhspsm%2FaUxXk3TNLqBude%2Bb4PE6ZS90CPc6rIhpC&X-Amz-SignedHeaders=host&X-Amz-Signature=115f48a2e5ee5d4ff587f74f129b99b02f34ce9aca8c2a7b63da8eb54d075dbb)

We gave the new user this permission and restricted him from other permissions available, means he should not be able to access other information of the company. An only admin functionality was there and it read as *All staff Group*. This basically *grouped all staff* as per their roles in the *company*, there were various groups and *Admin can create new groups as well*.

We sent this `http` request and returned us the *data of the* all of the groups and *unauthorized user was abel to access* the *staff group information*.

```http
GET  /suite/admin/tenant/chatSetting?_t=1603952121293  HTTP/1.1
```
Spending a time with this *unusual behaviour* we found a few more *issues* on this feature. As an unprivileged user we were ablt to escalate our *privileges* and we identified various issues which are as *under*:

- Creating new staff groups in the organization
- Editing settings of various staff groups of Admin
- Deleting staff group

![](https://hackerone-us-west-2-production-attachments.s3.us-west-2.amazonaws.com/Ytv35XvU2BzGRDy85V9C84jU?response-content-disposition=attachment%3B%20filename%3D%224.png%22%3B%20filename%2A%3DUTF-8%27%274.png&response-content-type=image%2Fpng&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ASIAQGK6FURQSF4YW5QU%2F20220608%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20220608T062407Z&X-Amz-Expires=3600&X-Amz-Security-Token=IQoJb3JpZ2luX2VjEO3%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEaCXVzLXdlc3QtMiJHMEUCIFo66sctWLAYeaqQDx5qy%2Bbu7WbYndyuOV9orpcvowi8AiEAp6CXp9f7vD4hfdt7p8bM1Y%2Bx6yppGl25V3kkhTD%2FaQ4q2wQI5v%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FARACGgwwMTM2MTkyNzQ4NDkiDLN3qg1lVxTybumT3SqvBNbQMYXlMqJHeUBjPBWEdSENYdYZdU1EGh%2BcNde2JwXvsFrAzGGrQcgB1oJ1JSS%2BnoXQEgcXSf9JpTf47B3au9XGLmc7przBQc6vZ0QaacL5POavh5PkxYQjITQ97fASH%2BBaQPFGVhrsPsM7NuEVFsob%2Fo%2FPRvAUD%2FiRsHy%2FQ8YfL6PQGsx%2FjufNsEgwhxV60joh8Bf04TNbfuG6h8m7z0kWnsZLQk6kJKxFUN%2BZ0EB%2B7v6EiAmZbBlCS%2BG8O%2Bf85Mq4ZZdscsSlOp62%2BfkKy1uauTX14cnnyKXALUZ5VBkiMcH%2BLelGvpXhxvKkj26HikH1aLObQjhRzyK888BtUpAJInnBOjYqJBvtHW2yvZt8LObEe9mpi0k0psyucuN4YqeAG%2Fw%2Fgk00kDGs3I1ffQPGNkH4FslLVhHf6z13q7ng0PDNFwPwA2LYEXmbc4RdDeMAHWakdNYRWMh7usoep2Gx201IVsK0vwNXKo21%2Fmc8U5EShxlKWUAKB%2FxMzkksOcIqTjLrzF%2BwblTQj5TLA9hBXmCgWUDEte%2BNvB1xpyaNK6dsTz%2BfVqmdYI0jr0mWEzOyb2y51tMfRTbxETeOOyXayvBaUJYLlTotm482YZY1PYZm8pahsiZIrsecX418GbQCWwWWMvCx50VeF%2FTPMT5SAz3OCBG%2FtUOQgZ%2B3jszc2DFQARuGIHRZoYi%2BYpfSMUO5RgZL%2B%2BdsrCo0GjvTbMjBNLeg45VQ95v9sdJWZKAwkNqAlQY6qQFGq1xBKYDCX0%2F%2B%2BPRSMP2Xwjkb7T17k3S4iq25Qdgo90zT1hUDCEjrV8WbKqPDWN9Lw0%2F2zoeIxGNshtw0CdQyAehQj7Fnvi34x6N9N6GFg4gWf%2BqfcLOnt5CN0Ge0ZEgWdz9666v8BtCRScSaTRvAqzecFQoSr9aAZVxZG36CKUlNy8X%2BeVjMRgf0rhspsm%2FaUxXk3TNLqBude%2Bb4PE6ZS90CPc6rIhpC&X-Amz-SignedHeaders=host&X-Amz-Signature=96938d1ecaf78b7e2a077afebd3e75456b7bbc5010fb3e797e37572c20f136b7)

In general an unprivileged user was able to manage a staff department without having access on it. << add some tip here>>

## Viewer is able to download previous versions of a file

As mentioned earlier *larksuite allows* users to share *files with others* .A file can have *multiple versions* and from documentation we *remember that previous versions should not be accessible* to the *viewers* of the file. But in this case we abused that *functionality and were able to download teh previous versions of the files* as viewers. 

While *browsing* a file as a user and at the same tiem analyzingteh requests via burp we *saw an* `http` request  which leaked the *current version id* of the *file* including the *previous versions id's of file*.

![](https://hackerone-us-west-2-production-attachments.s3.us-west-2.amazonaws.com/5njqsmjymleq3wx42asyjswbhktq?response-content-disposition=attachment%3B%20filename%3D%226asli.PNG%22%3B%20filename%2A%3DUTF-8%27%276asli.PNG&response-content-type=image%2Fpng&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ASIAQGK6FURQQHZQFFNY%2F20220608%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20220608T065332Z&X-Amz-Expires=3600&X-Amz-Security-Token=IQoJb3JpZ2luX2VjEOz%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEaCXVzLXdlc3QtMiJGMEQCIFUJ9yV7fBoeZqCGz4cDAu7r7JtlyhveEZerTvCzC7HSAiBJ7%2FOug1dIY9r37LIcG9%2BXTQFFk8KDW%2BQVkHod9izdPCrbBAjl%2F%2F%2F%2F%2F%2F%2F%2F%2F%2F8BEAIaDDAxMzYxOTI3NDg0OSIMIxIvD8ySMt%2BK405jKq8ELMMVVGSrwTS72WaU1NQeg5CNVJn4fXrEWp8TPG7mK8v0xVWdKuilKQQIzlDU%2BA%2Bf2exrJg3XGQGv7FcfmlfgvNn2H59cAqQWqYV75vD%2BTFf93V4sNA5ZUXt%2FEVzV62N9u0DqAx5QeAaUDv8Clbl8LzXV7plKIGYDu4SgU2GX7gPMENinS8dU%2B2Mua9yCXLgrQ0sSalcdR2LKRFa7ArJI8n4KFSDUilmYqDfXeFoLdZs6U7h4SshnHJERrv8AznjmXjhz4xYr%2FUIVSRctcEMfzOWNbgxDBbKd6fRY3dVH4hgcX2Di3hsryl4wM4kInwVC8qljm%2Bj9q5p72R44Q2r0Z4hsGnpOHauou%2FhpeSwEXxjxzStYEyUZlRWeZhtTQrB5cUj5%2FpufABYRlossRNE8H9RebjQWXJhSXw9edUuCW8ty4Wd1kQ1sVDMZwM%2Bx7aw89Vr7WK1U1ZjnAyE8KPboziNyNAPGoN9fUEy6Hap4%2FrZYYo9fRWCALDYJauNUA8k%2BD%2Fqtgjt7cbNnQcfAegOrSjBw1841dWW%2FQKPySBsmXi8KjxnY8UkAnW%2BdaBAkhVIdgm%2B1l%2BBSD90nxnypKVv0GgbLLbyUeoqcwq392i8sSaRfn4GDfhSPFRI7W8ZJdpcF51JxV20yvj3mtMW5yUghYIytXxjvC6esvxOIGQ%2BgOm3XfS8%2FlaET10oY96rerrAzKJChazEyikVs9nF72fFsBmqI6p7w%2FFqfgT63j5Vy9TDNuYCVBjqqAf8iRSrcEHEwgnTj9bObkm8Lzxqk3rj7hJnn0IxQvIHy8kdVw2z8CWDgehzFnZhiMPJBi61IbADB%2F9H4JYPlBcgpBOrnmVh5HzQzbX08M5zbJx7J8PQ55xnbUFFqFuYfb09FCcg0%2Fw1q0nA%2BNi32Z%2BcpWu37gt0WCNIO98YHUNIMs%2FZNUwu1QO%2B5OMAkUpOYg4MJUfthvViXPjfQoKrmlL%2FvmV%2FmLWopKppG&X-Amz-SignedHeaders=host&X-Amz-Signature=6fbc325b998ec7d9fda98bc4188fafa2cc2854a6d4a6228b487a76b7b6c4e1d0)

We also found another `http` POST request and in its body we *posted* the leaked *previous version id* and in the *response* it gave us variosu details of teh *previous version* alongwith the *download url of that file*.

Request is as below:

```http
POST  /space/api/box/file/info/  HTTP/1.1

{"version":"leaked_versionid","caller":"explorer","file_token":"ofcurrentfile","option_params":["preview_meta"]}
```

![](https://hackerone-us-west-2-production-attachments.s3.us-west-2.amazonaws.com/azb8pm8tiqplm8lomdei1ozgaw25?response-content-disposition=attachment%3B%20filename%3D%227asli.PNG%22%3B%20filename%2A%3DUTF-8%27%277asli.PNG&response-content-type=image%2Fpng&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ASIAQGK6FURQQHZQFFNY%2F20220608%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20220608T065332Z&X-Amz-Expires=3600&X-Amz-Security-Token=IQoJb3JpZ2luX2VjEOz%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEaCXVzLXdlc3QtMiJGMEQCIFUJ9yV7fBoeZqCGz4cDAu7r7JtlyhveEZerTvCzC7HSAiBJ7%2FOug1dIY9r37LIcG9%2BXTQFFk8KDW%2BQVkHod9izdPCrbBAjl%2F%2F%2F%2F%2F%2F%2F%2F%2F%2F8BEAIaDDAxMzYxOTI3NDg0OSIMIxIvD8ySMt%2BK405jKq8ELMMVVGSrwTS72WaU1NQeg5CNVJn4fXrEWp8TPG7mK8v0xVWdKuilKQQIzlDU%2BA%2Bf2exrJg3XGQGv7FcfmlfgvNn2H59cAqQWqYV75vD%2BTFf93V4sNA5ZUXt%2FEVzV62N9u0DqAx5QeAaUDv8Clbl8LzXV7plKIGYDu4SgU2GX7gPMENinS8dU%2B2Mua9yCXLgrQ0sSalcdR2LKRFa7ArJI8n4KFSDUilmYqDfXeFoLdZs6U7h4SshnHJERrv8AznjmXjhz4xYr%2FUIVSRctcEMfzOWNbgxDBbKd6fRY3dVH4hgcX2Di3hsryl4wM4kInwVC8qljm%2Bj9q5p72R44Q2r0Z4hsGnpOHauou%2FhpeSwEXxjxzStYEyUZlRWeZhtTQrB5cUj5%2FpufABYRlossRNE8H9RebjQWXJhSXw9edUuCW8ty4Wd1kQ1sVDMZwM%2Bx7aw89Vr7WK1U1ZjnAyE8KPboziNyNAPGoN9fUEy6Hap4%2FrZYYo9fRWCALDYJauNUA8k%2BD%2Fqtgjt7cbNnQcfAegOrSjBw1841dWW%2FQKPySBsmXi8KjxnY8UkAnW%2BdaBAkhVIdgm%2B1l%2BBSD90nxnypKVv0GgbLLbyUeoqcwq392i8sSaRfn4GDfhSPFRI7W8ZJdpcF51JxV20yvj3mtMW5yUghYIytXxjvC6esvxOIGQ%2BgOm3XfS8%2FlaET10oY96rerrAzKJChazEyikVs9nF72fFsBmqI6p7w%2FFqfgT63j5Vy9TDNuYCVBjqqAf8iRSrcEHEwgnTj9bObkm8Lzxqk3rj7hJnn0IxQvIHy8kdVw2z8CWDgehzFnZhiMPJBi61IbADB%2F9H4JYPlBcgpBOrnmVh5HzQzbX08M5zbJx7J8PQ55xnbUFFqFuYfb09FCcg0%2Fw1q0nA%2BNi32Z%2BcpWu37gt0WCNIO98YHUNIMs%2FZNUwu1QO%2B5OMAkUpOYg4MJUfthvViXPjfQoKrmlL%2FvmV%2FmLWopKppG&X-Amz-SignedHeaders=host&X-Amz-Signature=61adb0006b34ce32626a9f52646454ed03f5ddf0e0080e2149ecc1682c7aba74)

Browsing this *url in browser* we were able to download all of the *previosu versions* of the file.

## User without permission can download file's even if it's restricted.

In previous issue we mentioned that larksuite allowed users to *share files* and the *file access* was controlled by ceratin *permissions* which only *Admins of the file* can set.

In this case *we shared our file* with a user and *restricted the download permissions* , iplying that the user with whom file is being shared will be unable to download (as seen download button is disabled) the *file* but can *only view it*.

![](https://hackerone-us-west-2-production-attachments.s3.us-west-2.amazonaws.com/6RtiRyvpS4SzhVjM13sTZhGL?response-content-disposition=attachment%3B%20filename%3D%221.png%22%3B%20filename%2A%3DUTF-8%27%271.png&response-content-type=image%2Fpng&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ASIAQGK6FURQXIN3WWCY%2F20220608%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20220608T071502Z&X-Amz-Expires=3600&X-Amz-Security-Token=IQoJb3JpZ2luX2VjEO3%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEaCXVzLXdlc3QtMiJHMEUCIQCaIPjwND%2BJ7a4EOfI4vCJyg7zJlvE1TswWYAYOaWvwAQIgYF%2FdCnwMvoUhW%2F%2FjU%2F6aj0ljEtvKudJdLsavaopYmWwq2wQI5v%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FARACGgwwMTM2MTkyNzQ4NDkiDJmtWv32RVa0pkmpLSqvBAWCxtxZVJnRbg8G5O%2FvnHvcP676hZp41dd2Bmuxvc1PB4u0K%2BiS6azTRsj5SiYYDnMu4nFT6eL5uLPpsEBexHQ6U1p%2BRU010bC2GTycJMaE6aFt6liUfmiePOrjvMBtDJMEu4SiwWtoRBsM%2BDLzs4Nn8rHI6YjYpp5T71uTJXrJ%2FMq1DrkLK6mmRiJ1wd%2FOd5QTIFmCXyQO7EkyKoYhstctaH%2FRwtBP94Fr9QteN3sg3TvlKGDLJIEd3Yotu9IFm%2BfpaHdkvpAFZndNA1rU5qtSo0dWYrCIoT4TE%2FmX%2F51KV%2BlYpia%2BzqwZlzKD%2F8AjuoKPmSVqGJXhkYHDUbl0K8WQLRxfkwnw58rQoLuYYVa%2BrGO9%2FdLBy7pbp1GLQyXbnOynFhCcPsIZkmVSU69m0dJKgnD45KDY0h4FDX9GVLbRqPhGvHaX3nO%2FyosjLS5VYB3revle0h5Mqli3Dra6qwqPjYGjgH0I2%2FNMAdqiqh4niLWbU%2FTEzGSkNKtJ%2BYfvvrXSyIF42J%2F%2FeKcZVhtVIOMVh7c8apLycih66AuIgf4ZzaDeO%2B2yFXhKwheM5zlRkgUX9sm4OKScwRtfSKUiICBsYA7lJTvMnivYZUCo%2FoX39ZEUTWyqefm5B3caUm3lKiFHvxD2c%2FExl6a22DNYs58JZOOvwLHKPe5j502nThMibBfGBGrmBfciP781Gz18tNvEs6hm605lpjVuP02D6TH9AqzGz1bimC8NSSnMWEowjMiAlQY6qQGGCYqsk6HsYeQpFALzntbCKTNFNgh%2FnTQipkkWW0DKaGsYVELnT0QvJ54VQAV0%2FnWzkelFaVHvLrN9KrYfJh5VpOvKbnl8N4fqxosNnwMFFWOtIsWnyyQKRjIp8STcyNKoj0A1ANkxlqYS3RSZEsSvScLQ4YIfEmB1A6fK06TmsGlZt2NM2W2DFSfP5YsJENbehSRdsxDZd3WoumVlfqhQIsWvsF0nR5A%2B&X-Amz-SignedHeaders=host&X-Amz-Signature=d5499334158caf622790e232bc75421a7043f4b53ad93ea5d6d0e713fadebe42)

We were able to bypass this restriction simply by *sending this http request*:
```http
GET  /space/api/box/stream/download/all/<<file id>>/  HTTP/1.1
``` 

In the response of this request we got the *downlaod url of the file* and pasting this *url in the browser* , we were simply able to downlaod the *file irrespective of the permissions*.

Downlao URL will look something like this:

Url will look like `https://internal-api-space.larksuite.com/space/api/box/stream/download/all/<<file id>>/`



## Viewer was able to permanentaly delete bin files of Admin

This issue was also found in file systems of *larksuite*. In this case we were able to *permanently delete* files from the trashbin of *Admin*. Trash and permanent delete functions seemed to be *interesting* that too when access controls are adminstered.

The *Admin* invited a user in his personal *directory*  with only *view permissions* and he *couldn't delete or edit the files* in that directory.  The shared *folder* contained many *files and sub-folders*  and the *viewer could not delete or edit them*. Admin deleted the *shared folder* and this *folder alongwith its files* is moved into the **trash bin of admin** and the viewer has no access on it.

Logically *viewers access from that folder* should be removed when it is *moved into admins trash bin*, but we noticed that *viewer was still able to get the files inside that folder*, via a `GET` request which materialized the  thought that *viewer still has access* on the *folder*. We tried to *perform other restricted* operations by sending *various http requests* but *no luck with that*. Then we *noticed that* there is a *delete permmanent* feature available *in the trash* we tried to twitch this. 

![](https://hackerone-us-west-2-production-attachments.s3.us-west-2.amazonaws.com/antpqdwvkeaixg9ms965c4y5tsmp?response-content-disposition=attachment%3B%20filename%3D%22Capture5.PNG%22%3B%20filename%2A%3DUTF-8%27%27Capture5.PNG&response-content-type=image%2Fpng&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ASIAQGK6FURQ4M7I4TQ2%2F20220609%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20220609T040821Z&X-Amz-Expires=3600&X-Amz-Security-Token=IQoJb3JpZ2luX2VjEAMaCXVzLXdlc3QtMiJIMEYCIQD6Pp%2FzKY%2FAu8E%2B1insxw7pBpgl8yv30ckuTalg7dnQYAIhAOPELyreLJY0fwfABian9XXm2UP0qufkyxM%2B90j07DRfKtsECPz%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEQAhoMMDEzNjE5Mjc0ODQ5IgymF8Obfm5smFxQHlIqrwRcrRXT6CCqUh%2FjKvCaRV1YWpJOUwx0E9VaqpkJ5aAHnrilNV6%2FkRCP91FHgWuPul%2Bl%2BeXFbCt09nTeBmhqkz1bYTBO1poCs1JIQWSzXNwaSPr4WuQXzUew72DbwMVNFJt3Lp9F6a66%2F9TAa3aK9%2BD5Ff0WCAA6ZvYflexPVe3lsnDMTdj8a51d1wk%2FlaqqNZExGf0wZZWddzIb%2FHtuUvt6osmxwtWJ6WTst9pQifck4JGavTZpdNV2uTwf3AWjomc3Zy2H0R5b6tU4f30b1rvo5ADkPrISzKTWaOX2nJgxXkSs8Q7s30QsdY3HfOMqJ1tIercUnfvdUANFq3U%2BkcccxfTLF6p2gEitD0yd1Zu%2BoKBuYB5N29XCkjVZKHA9KcnMvbIbxEzR%2FpcSWinRoYG7lYVl%2BaqwUythReRm1m9dDA0DiuioTfa%2BHzUcKPDefKkoQ8YNqHNjzbSGWBMsIj2WA1DEDb2QgtOSoVQ8EtJPO7RNOlq5dDYp4JVxi7OdSWGUp0VHkH%2BIuu4Ve3ukKyQbO9vBqLazEZWCTVMKvl3cFx%2FnV0SS%2Brzd%2Fod1t3stmiKdkYofN5qo1%2BFg406MJ1imfZ%2BB83GqN8xr6KVCTQYJfUldA3R2wH9pSNJCCnqFtfgPsKLKlHnmTMDotyCMBbnBJogxgL8Cj4DuCMWv5CsyY7EWTvPqklOaXoEGMCoaW1X96Z0NNX6n96gVJvp%2F%2B0pxK5lYL6k%2BoDs4F0X45FKPMKm%2BhZUGOqgBggHaY2ax6Lc49fGLJxG%2FZsn6b0n%2FLHCq%2Fthq9c%2F7fVRR9jF48ZfY9L%2FvPz1jwqd2e8vmGARlen1oXdLgNhBWDAkQEJirNT8FORP7O7I9h9uCMh9Vbyl2W9E7vamPj6agK1iZd7zIRbHA%2Bt0xBD4CEag9uUULU9Jfhywp%2Bfk33RedoaLDhY9h%2Bwkdf9uXqP69EcJiMwd%2BEChAQ0jY2HZYGmq88r5IOqlw&X-Amz-SignedHeaders=host&X-Amz-Signature=d0fde57c815d335450a8e7b600c795334ede19452278e756b7948a8ad1fd8740)

HTTP request we *analyzed* that was responsibel for *deleting permanentaly* a *folder looked something* like this:

```http
POST  /space/api/explorer/trash/delete/  HTTP/1.1

token=<< folder token>>
```

We sent this request as a viewer  and using the *folder id*  of the *admisn folder* , we got **200 ok** and upon confirmation, the *folder was permanentaly deleted* from **Admins trash**.

## Access to private file's of other users in helpdesk conversation.

Remember previously i mentioned helpdesk is a golden nugget of information in every stance and this time we were able to access the *private files* used in conversation with the *larksuite staff*.

The conversations are meant to be *private* not public and *hence every message and file* was confidential. Larkhelpdesk was simply a _support portal_ which i hope you have crossed anywhere.

The clicking factor here was that we identified that they were saving the *files* on same domain of which *one member created a ticket*, a *file url* looked something like this:

`https://name.larksuite.com/saipan/v2/api/ticket/image?ticket_id=26678` 

Since *created ticket ids*  were viewable by the *other teammates* and they can just copy the *file url* and paste it in their *browser* and *putting in the random file id*, in link if that file existe they were able to view that file. Eventhough it was private and not accessible by other users.

## Sub-Dept User Can Add User's To Main Department

In larksuite an owner of the tenant can create sub-department's for convenience and user management. It can only be done by the owner of the tenant. If a user is *added ina  subdepartment* he can only access that department and *he won't be able to access* other departments of the organization or add *new users* in them.

When adding a suer in a sub-department we observed the http request and it looks like this:

```http
POST /suite/admin/employees/ HTTP/1.1
Host: hackeron1.larksuite.com 
Connection: close 
Content-Length: 149 

{"mobile":"","customFields":{"C-6826729584252157957":""},"name":"test","departments":["department_id"],"email":"ooo@gmail.com","joinTime":"","isInvite":true}
```

With this *request the sub-department* group member can add the *member only in this sub deparment* but intercepting this *request* and *sending* **departments** key with empty value, we noticed that we got **200 ok** response and the new user was added in the main organization by a low privileged member.

## Auto approving own apps from a lower level role leading to mass privilege escalations

Larksuite allowed users with *specific permissions* to be invited in the team and one of such permissions was **App management**. In this case we abused this permission to *auto approve our own app*.

Admins can add a user with *App management permission* on a specific *app* and once the *users create* an app, they will have to *submit it to admin* who will approve the *application*. After approval from the admin, that application wil be successfula nd the *api token* will get validated. 

Since we know user couldn't approve an app by himslef so noticed a request *that was responsible for approving the application*, it looked something like this:

```http
PUT /suite/admin/appcenter/app/<<application id>>/auditWhiteList HTTP/1.1
Host: larksuite1.larksuite.com 
Connection: close Content-Length: 29 

{"audit_white_list_status":1}
```

Sending this request from the *low privileged user* the response was **200ok** and the app got approved by the attacker. Once the *app was auto approved*  the user can now use this *fully functional app*, he can add new members in this, he can also  delete departments via this app.

## Attacker can join any tenant on larksuite and view personal files/chats.

We stepped on a new feature on one of the domains of larksuite  which is known as __Test companies and user's__. This feature was basically introduced so that lark user's can create sandbox tenants where they can test their app's in a whole different environment but by bringing new feature we mean bringing new vulnerabilities this feature can be abused in such a way that user's can get access to other user's tenant without any interaction. The lark *admins or tenant admins* can add new memebers *in these tenants* for different testing *puproses*.

An invitation request in a *tenant* when analyzed was as follows:

```http
POST /sandbox/AddTestTenantMember HTTP/2 
Host: open.larksuite.com 
Cookie: Content-Length: 73 
X-Csrf-Token: 

{"TestTenantID":"TENANT_ID","Email":"EMAIL"}
```

Attacker *simply changed* the _TestTenantID_ value (which was a random numeric id and forwarded the request and response was **200 ok**. The used email id was mailed that he has been invited in a tenant of someone else. 

Inside that *tenant attacker can access* the files, conversations and other sensitive information.

## Low privileged user is abel to access the Admin log

A permission in a larksuite permission set named as  **internal risk control** when assigned to any user he is able to view all the admin logs of the company.

Admin logs contains all the senstive information like recent changes made, Permission changes,  View newly added or removed users,  View newly created files and deleted files. It keeps record of all the recent activities in the organization. We found a user *without the above mentioned permission* was able to *access teh company logs* via broken authentication on mentioned api endpoint.

The restriction was only *implemented on the UI but not on the pai request*, sending that request we were able to *fetch all logs of the organization* in burpsuite. The `http` request was as follows:

```http
GET /suite/admin/logs/?count=30&offset=0&min_time=1586025000&max_time=1649356199&_t=1649312050201
```

##  Viewing comments on files and documents.

Lark file systems let users to share files and documents and collaborate on them. The collaborators on  on a file can post comments on the file as well. But the *unauthorized users* or the users with whom the *file is shared* via an external link can *only view the file and not post or view comments on it*. This is becasue tehy are external users on the *file/document* and not collaborators.

Analyzing the *comment request* of a file, we found a **GET request**  returned us all comments in the response. The request was as following:
`/space/api/message/get_message.v3/`. We tried to sedn this request from an *unauthorized role* and we got **403**.

 In an instance we changed the *v3 to v2* and we got all of the comments of the *file in a response*. This is how *another version of api* leaked the commenst to the attacker.


