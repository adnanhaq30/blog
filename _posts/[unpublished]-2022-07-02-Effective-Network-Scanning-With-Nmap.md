---
layout: post
title:  "Effective Network Scanning with Nmap"
author: snapsec
categories: [ network-scanning,nmap ]
image: assets/images/nmap/0.png
---


Nmap acronym is Network Mapper. This tool is best known as a scanning tool for doing pentesting. In this blog, we are going to see its features along with some important useful commands.

## What is Nmap?

Nmap is a network scanning tool. It is an open-source Linux command-line tool. It is used when a pentester/an ethical hacker needs to scan IP addresses, and ports in a network to discover the open communication medium and to detect installed services.

Gordon Lyon (pseudonym Fyodor Vaskovich) wrote this tool to scan an entire network with few commands & able to find a live host on a network, version detection(services that are installed on the network), operating system(OS) detection, ping sweeps(ping scan), traceroute, open ports and services.

It very popular tool in the Infosec community, being featured in popular series like Mr.Robot.

## Why use Nmap?

Nmap takes IP packets & in return, it provides users detailed, instantaneous information about that networks, as well as the devices (routers, servers, switches, mobile devices) associated with them and complex scripting through the Nmap scripting engine.

#### Here’s a breakdown of the foremost use of Nmap:

-   **Scan every active IP address**. Each IP address that is currently active on your network can be fully analyzed by the user to discover whether it has been compromised. If a legitimate service or an outside hacker is using the IP, Nmap will let you know.
-   **Perform entire network scanning**. You will obtain information about your whole network, including a list of live hosts and open ports, as well as the operating system of every connected device. As a result, Nmap is excellent at monitoring your system and assisting with pen-testing.
-   **Identify server vulnerabilities.** To safeguard personal and business websites, you can use the program to examine your web server for security flaws. Nmap simulates the method that a hostile agent would use to attack your website.
-   **Develop visual mappings.** Zenmap is the graphical user interface for Nmap. It enables you to create visual network maps for improved usability and reporting.
-   **Automate system and vulnerability scans.** Nmap features a fantastic feature known as the “Nmap Scripting Engine” (NSE). It is a scripting engine that allows you to automate networking features by using a preset collection of scripts.

## Nmap Installation

The software must be installed before you can begin using Nmap.

The installation procedure is straightforward, although it may differ depending upon your operating system.

We’ve covered how to install the application for Mac, Windows, and Linux below.

-   **For Mac OS:** Start the dedicated installation by running the Nmap `<version>` mpkg file (you get this with Nmap).
-   **For Windows OS:** Download and execute the Nmap-supplied custom installer. (namp<version>setup.exe). This will configure Nmap on your Microsoft machine automatically.
-   **For Linux OS:** Run the following commands after opening the terminal to install Nmap
-   **CentOS/Fedora:** sudo dnf install nmap
-   **Ubuntu/Debian:** sudo apt-get install Nmap

## Understanding the Most Commonly used Nmap Commands

Now we have got all the basic knowledge of a nmap & now we can move to the main part of this blog.Here we will see almost all commands that are used while doing pentesting from beginner to advanced level.

  

### Basic Scan

##### Simple Scan

  

    root@root:~# nmap localhost

  

Scans a single host for 1000 well-known ports. These are the ports that are utilised by prominent services such as MySQL, SSH, SMPT, and others.

##### Simple TCP scan (Explicit 3-way handshake scan)

  

  

      root@root:~# nmap -sT localhost

  

Scans for TCP Scan for host. `-sT` command is used for a TCP scan.

##### Simple UDP Scan

  

    root@root:~# nmap -sU localhost

Scans for UDP Scan for host. `-sU` command is used for a UDP scan.

##### Nmap OS scan

  

    root@root:~# nmap -p80 -O localhost

Scans for OS scan. `-O` is used for OS detection to get information about host

##### Nmap Service Detection

  

    root@root:~# nmap -sV -p80 localhost

Scans for service detection. `-sV` is used for service detection for getting information about which service are used on host network.

  

##### Dont ping just Scan

  

    root@root:~# nmap -Pn -p80 localhost

Treat host as alive & without doing ping scan. `-Pn` is used for direct scan.

##### Nmap Aggressive Scan

  

    root@root:~# nmap -A localhost

`-A` is known for aggressive scanning. Enables version detection , OS detection , script scanning and traceroute.Regular scans yield significantly less information than aggressive scans.This scan is also not recommended while doing pentesting because send out more probes,It is also more likely to be discovered during security audits.

  

##### Nmap ACK Scan

  

    root@root:~# nmap -sA localhost

`-sA` is used for an ACK scan. The TCP ACK scanning technique examines packets with the ACK flag set to see if a port is filtered. This technique is useful for determining whether the firewall protecting a host is stateful or stateless.

##### Nmap FIN Scan (Use fin Packets)

  

    root@root:~# nmap -sF localhost

`-sF` used for FIN scan. In such cases, the Nmap FIN scan comes in handy. A FIN packet is often used to terminate a TCP connection when the data transfer is complete. Nmap starts a FIN scan with a FIN packet rather than a SYN packet.

  

##### Nmap Xmas Scan

  

    root@root:~# nmap -sX localhost

`-sX` used for a Xmas scan. The Nmap Xmas scan is a covert scan that analyses responses to Xmas packets to discover the type of the responding device. Each operating system or network device responds to Xmas packets differently, giving local information like as the OS (Operating System), port state, and more. Many firewalls and intrusion detection systems can currently detect Xmas packets, making a stealth scan ineffective.

##### Nmap Fast Mode (Top 100 Ports)

  

    root@root:~# nmap -F localhost

If you need to run a scan quickly, use the `-F` flag. The `-F` flag will display a list of ports from the nmap-services files. Because the "Fast Scan" flag scans fewer ports, it is less thorough.

  

### Using wildcards

We can specify the targets in 3 different ways:

  

    - Wildcards -- 192.168.43.*
    
    - Range -- 192.168.0-255.0-255
    
    - CIDR -- 192.168.0.0/16

  

#### Options:

  

    nmap 192.168.43.*
    
    nmap 192.168.43.0-255
    
    nmap 192.168.43.0/10

Here, all three options will give the same output. It's just on user preference in which practice is comfortable.

### Other options

##### **Nmap Verbose**

  

    root@root:~# nmap 192.168.43.239 -v

Verbos is denoted by `-v` . The verbose output provides more information about the scan being run. It is useful to observe Nmap's activity on a network step by step, especially if you are an outsider scanning a client's network.

##### **Nmap Very Verbose**

  

    root@root:~# nmap 192.168.43.239 -vvv

Increases the level of verbosity, causing Nmap to print more information about the current scan.

When Nmap believes a scan will take more than a few minutes, it displays open ports as they are discovered, and it provides completion time estimates. Use it twice or more to increase the verbosity.

##### **Nmap debug mode**

  

    nmap -p80 localhost -d

When even verbose mode does not provide enough information, debugging is available to flood you with even more! Debugging, like verbosity, is enabled with a command-line flag (`-d`), and the debug level can be increased by supplying it numerous times. Alternatively, you can provide a debug level using the -d option. Level nine, for example, is set by -d9. Unless you conduct a very simple scan with very few ports and targets, this is the most effective level and will generate thousands of lines.

##### **Nmap Use packets fragmentation**

  

    root@root:~# nmap 192.168.43.239 -f

The `-f` option instructs the programme to utilise tiny fragmented IP packets for the required scan (including ping scans). The aim is to spread the TCP header across multiple packets to make packet filters work harder. To detect what you are doing, intrusion detection systems and other annoyances are used. Take care of this! Some programmes have difficulty managing these little packets. Sniffit, an old-school sniffer The segmentation failed soon after getting the first fragment. Select this option only once, and after the IP header, Nmap breaks the packets into eight bytes or fewer. As an example, a 20-byte TCP header might be divided into three packets Two with the first eight bytes of the TCP header and one with the last four. Each fragment, of course, contains an IP header. Specify -f once again to utilise 16 bytes per fragment (which reduces the number of fragments). You can also use the `--mtu` option to choose your own offset size. If you use `--mtu`, leave off the `-f` option. The offset must be a power of eight. While fragmented packets will not pass through packet filters and firewalls that queue all IP fragments, such as the Linux kernel's `CONFIG_IP_ALWAYS_DEFRAG` option, some networks cannot afford the speed penalty these causes and hence keep it disabled. Others cannot do so because fragments may enter their networks via other pathways. Outgoing packets are defragmented in the kernel of some source systems. One such example is Linux's iptables connection tracking module. Scan with a sniffer, such as Wireshark, to confirm that sent packets are fragmented. If your host operating system is causing issues, use the `--send-eth`. option to skip the IP layer and send raw ethernet frames.

##### **Randomize Hosts while scanning**

  

    root@root:~# nmap 192.168.43.200-239 --randomize_hosts -f

Nmap has a `--randomize_hosts` option that divides the target network into blocks of 16384 IPs and then randomises the hosts within each block. If you are scanning a big network, such as class B or larger, randomising larger blocks may yield better (more stealthy) results.

  

##### **Nmap show Reason**

  

    root@root:~# nmap 192.168.43.239 -p80,21 --open --reason

`--reason` shows, Nmap output reveals whether or not a host is up, but it does not detail the discovery tests that the host responded to. It can be beneficial to understand why a port is shown as open, closed, or filtered, as well as why the host is marked as alive.

##### **To exclude the Host**

  

    nmap 127.0.0.1-255 --exclude 127.0.0.1

Specifies a comma-separated list of targets to exclude from the scan, even if they are within the network range you define. The list you supply in follows standard Nmap syntax and can include hostnames, CIDR netblocks, octet ranges, and so on. This is important when the network you want to monitor contains untouchable mission-critical servers, systems that react negatively to port scans, or subnets managed by others.

  

##### **Input list**

  

    nmap 127.0.0.1-255 -iL hosts.txt

We read the target specifications from the input filename. On the command line, passing a long list of hosts is typically awkward, but it is a common demand. For instance, your DHCP server may provide a list of 10,000 current leases for you to scan. Alternatively, you might scan all IP addresses except those used to locate hosts utilising illegitimate static IP addresses. Simply construct a list of hosts to scan and send that filename as an argument to Nmap's `-iL` option. Entries can be in any of the forms that Nmap accepts on the command line (IP address, hostname, CIDR, IPv6, or octet ranges). One or more spaces, tabs, or newlines must separate each entry. If you want Nmap to read hosts from standard input rather than a file, you can give a hyphen (-) as the filename.Comments beginning with # and extending to the end of the line are permitted in the input file.

  

##### **Exclude the range of ip addresses**

  

    nmap 127.0.0.1-255 --excludefile hosts.list

The excluded targets are provided in a newline, space, or tab delimited exclude file rather than on the command line, as with the --exclude option.The exclusion file may contain comments that begin with # and go all the way to the end of the line.

  

### Script Engine

  

##### **Simple Script scan** ,**Default Script scan** ,**Catogary Script scan**

  

    nmap 192.168.43.* --script script-name
    
    nmap 192.168.43.* -sC script-name
    
    nmap 192.168.43.* --script safe|intrusive|malware|version|discovery|vuln|auth|default

Uses the comma-separated list of filenames, script categories, and directories to perform a script scan. Each item on the list can also be a Boolean expression that describes a more advanced set of scripts. We process each element as an expression first, then as a category, and ultimately as the name of a file or directory. The special argument all makes all scripts in Nmap's script database executable. Because NSE may contain harmful scripts such as exploits, brute force authentication crackers, and denial of service attacks, the all parameters should be used with caution.

### Ports

Here, we will see some techinques we can be used in Nmap. To use the ports as per our requirement & the commands are self-explanatory.

##### **Top 1000 Ports**

  

    nmap 192.168.43.*

  

##### **All ports**

  

    nmap -p- localhost

  

##### **Port range**

  

    nmap -p 0-65535 localhost

  

##### **All from 1 to all**

  

    nmap 192.168.43.* -p1-

  

##### **Specific Ports**

  

    nmap 192.168.43.1/24 -p 80

  

##### **Top Ports**

  

    nmap 192.168.43.1/24 --top-ports 500 80

  

##### **TCP and UDP Ports**

  

    nmap 192.168.43.1/24 -p T:80,U:53

  

##### **Show only open ports**

  

    root@root:~# nmap 192.168.43.239 -p- --open

  

##### **Mixed Style**

  

    root@root:~# nmap 192.168.43.239 -p80,21-25,8080-8090 --open

### Logging

##### **Show All packets Send and Receaved**

  

    nmap localhost --packet-trace

Nmap prints a summary of all packets delivered or received. This is frequently used for troubleshooting, but it is also a useful way for new users to grasp what Nmap is doing behind the scenes. You may want to specify a limited number of ports to scan, such as -p20-30, to avoid publishing thousands of lines. If you're solely interested in the activities of the version detection subsystem, use `--version-trace` instead. If you simply want script tracing, use `--script-trace`. You get everything of the above with `-packet-trace`.

  

##### **Nmap Simple Human Normal Output**

  

    root@root:~# nmap 192.168.43.239 -p- -oN output.file

Requests that standard output be directed to the specified filename.

##### Nmap Simple XML Readable Output

  

    root@root:~# nmap 192.168.43.239 -p- -oX output.file

Specifies that XML output be directed to the specified filename. Nmap includes a document type definition (DTD) that XML parsers can use to validate Nmap XML output. While it is designed primarily for programmatic use, it can also assist humans in interpreting Nmap XML output. The DTD defines the format's legal elements and frequently enumerates the attributes and values that can be assigned to them. The most recent version can always be found at http://nmap.org/data/nmap.dtd.

  

##### **Nmap Simple All Output**

  

    root@root:~# nmap 192.168.43.239 -p- -oA output.file

You can use the `-oA` basename option to save scan results in regular, XML, and grepable forms all at once. They are saved in the files basename.nmap, basename.xml, and basename.gnmap, in that order. As with other applications, the filenames can be prefixed by a directory path, such as `/nmaplogs/foocorp/` on Unix or `c:\hacking\sco` on Windows.

  

### Os and Version detection

OS detection is far more effective if at least _one open_ and _one_ closed TCP _port_ are found.

##### **default os scan**

  

    nmap -O 192.168.43.239

  

##### **Nmap Service Detection**

  

    root@root:~# nmap -sV -p80 localhost

  

##### **Limit Os scan**

  

    nmap -O --osscan-limit 192.168.43.239

  

If at least one open and one closed TCP port is detected, OS detection becomes significantly more successful. If you choose this option, Nmap will not even attempt OS detection on hosts that do not satisfy this criterion. This can save a lot of time, especially when scanning multiple hosts with -PN. It only matters when the -O or -A options are used to requesting OS detection.

##### **Aggresive Os scan**

  

    nmap -O --osscan-guess 192.168.43.239

  

When Nmap is unable to discover a precise OS match, it may provide near-matches as alternatives. For Nmap to perform this by default, the match must be quite near. Either of these (identical) choices causes Nmap to make more aggressive guesses. When an imperfect match is printed, Nmap will notify you and provide its confidence level (%) for each guess.

##### **Version Intensity**

  

    nmap 192.168.43.239 --version-intensity <level>

  

Nmap sends a series of probes with rarity values ranging from one to nine when performing a version scan (-sV). Lower-numbered probes are effective against a wide range of targets. The lower numbers represent common services, while the higher numbers are rarely beneficial. The intensity level indicates what probes should be used The greater the number, the more probable the service will be provided. accurately recognised High-intensity scans, on the other hand, take longer. The intensity must range from 0 to When a probe is registered to the target port using the nmap-service-probes command, the default value is 7. ports command, regardless of intensity level, that probe is tried. This ensures that DNS probes are always attempted against any open port 53, SSL probes are always attempted against 443, and so on.

  

##### **High Version Intensity**

  

    nmap 192.168.43.239 --version-all

An alias for —version-intensity 9, which ensures that each port is probed individually.

### Performance

##### **Min Parallelism**(minimum hosts to be scanned parallely)

  

    nmap 192.168.43.0-255 --min-parallelism 10

  

These settings determine the total number of probes that can be active for a host group. They're utilised for port scanning and discovering hosts. Nmap estimates an ever-changing optimum parallelism based on network performance by default. Nmap slows down and allows fewer pending probes if packets are dropped. As the network establishes its worth, the ideal probe number gradually grows. These parameters set the variable's minimum and maximum values. By default, optimal parallelism can be as low as one if the network is unreliable and as high as several hundred in ideal conditions.

  

##### **Max Parallelism**(Maximum hosts to be scanned parallely)

  

    nmap 192.168.43.0-255 --max-parallelism 10

The `--max-parallelism` option is sometimes set to one to prevent Nmap from sending multiple probes to hosts at the same time.

  

##### **Host Timeout**(give up on this target after this time default:30min)

  

    nmap 192.168.43.0-255 --host-time <time>

  

##### **Min Packet Rate**(rate can be 1-100000000000)

  

    nmap 192.168.43.0-255 --min-rate <Number>

When the `--min-rate` option is given Nmap will do its best to send packets as fast as or faster than the rate. The argument is a positive real number representing a packet rate in packets per second. For example, specifying `--min-rate300` means that Nmap will try to keep the sending rate at or above 300 packets per second. Specifying a minimum rate does not keep Nmap from going faster if conditions warrant.

##### **Max Packet Rate**(rate can be 1-100000000000)

  

    nmap 192.168.43.0-255 --max-rate <Number>

`--max-rate` restricts the transmission rate of a scan to a specified maximum. On a fast network, for example, use `--max-rate` 100 to limit transmitting to 100 packets per second. For a slow scan of one packet every ten seconds, use `--max-rate` 0.1. To keep the rate within a specified range, use `--min-rate` and `--max-rate` simultaneously.

##### **Scan delay**(Adjust delay between probes)

  

    nmap 192.168.43.0-255 --scan-delay <time>

This option instructs Nmap to wait at least the specified amount of time between probes sent to a given host. This is very useful when it comes to rate restriction. Solaris machines (among many others) often react to UDP scan probe packets with a single ICMP message every second. Any more than what Nmap sends is wasteful. A scan-delay of 1s will keep Nmap running at that slow speed.

Nmap attempts to detect rate limiting and change the scan delay accordingly, but if you already know what rate works best, it doesn't harm to specify it explicitly. Another application of `--scan-delay` is to avoid detection by threshold-based intrusion detection and prevention systems (IDS/IPS).

  

##### **Performance template** (-T(1|2|3|4|5)

  

    nmap 192.168.43.0-255 -T1

While the fine-grained timing controls outlined in the previous section are powerful and useful, they can be confusing to certain users. Furthermore, selecting the suitable parameters can sometimes take longer than the scan you are attempting to optimise. As a result, Nmap provides a simplified solution, with six timing templates. You can use the -T option and their number (0-5) or name to designate them. Paranoid (0), sneaky (1), courteous (2), normal (3), aggressive (4), and mad are the template names (5). The first two are for avoiding IDS. Polite mode reduces the scan speed to utilise less bandwidth and target machine resources.

**T1**

  

hostgroups: min 1, max 100000

rtt-timeouts: init 15000, min 100, max 15000

max-scan-delay: TCP 1000, UDP 1000, SCTP 1000

parallelism: min 0, max 1

max-retries: 10, host-timeout: 0

min-rate: 0, max-rate: 0

  

**T2**

  

hostgroups: min 1, max 100000

rtt-timeouts: init 1000, min 100, max 10000

max-scan-delay: TCP 1000, UDP 1000, SCTP 1000

parallelism: min 0, max 1

max-retries: 10, host-timeout: 0

min-rate: 0, max-rate: 0

  

**T3**

  

hostgroups: min 1, max 100000

rtt-timeouts: init 1000, min 100, max 10000

max-scan-delay: TCP 1000, UDP 1000, SCTP 1000

parallelism: min 0, max 0

max-retries: 10, host-timeout: 0

min-rate: 0, max-rate: 0

  

**T4**

  

hostgroups: min 1, max 100000

rtt-timeouts: init 500, min 100, max 1250

max-scan-delay: TCP 10, UDP 1000, SCTP 10

parallelism: min 0, max 0

max-retries: 6, host-timeout: 0

min-rate: 0, max-rate: 0

  

**T5**

  

hostgroups: min 1, max 100000

rtt-timeouts: init 250, min 50, max 300

max-scan-delay: TCP 5, UDP 1000, SCTP 5

parallelism: min 0, max 0

max-retries: 2, host-timeout: 900000

min-rate: 0, max-rate: 0





