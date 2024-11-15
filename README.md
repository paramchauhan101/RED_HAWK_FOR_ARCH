#### Version 2.0.0
#### By **ParamChauhan101** (Arch Optimized) A.K.A R3D#@0R_2H1N
All in one tool for **Information Gathering** and **Vulnerability Scanning**

# Scans That You Can Perform Using RED HAWK :
+ Basic Scan
	- Site Title **NEW**
	- IP Address
	- Web Server Detection `IMPROVED`
	- CMS Detection
	- Cloudflare Detection
	- robots.txt Scanner
+ Whois Lookup `IMPROVED`
+ Geo-IP Lookup
+ Grab Banners `IMPROVED`
+ DNS Lookup
+ Subnet Calculator
+ Nmap Port Scan
+ Sub-Domain Scanner `IMPROVED`
	- Sub Domain
	- IP Address
+ Reverse IP Lookup & CMS Detection `IMPROVED`
	- Hostname
	- IP Address
	- CMS
+ Error Based SQLi Scanner
+ Bloggers View **NEW**
	- HTTP Response Code
	- Site Title
	- Alexa Ranking
	- Domain Authority
	- Page Authority
	- Social Links Extractor
	- Link Grabber
+ WordPress Scan **NEW**
	- Sensitive Files Crawling
	- Version Detection
	- Version Vulnerability Scanner
+ Crawler
+ MX Lookup **NEW**
+ Scan For Everything - _The Old Lame Scanner_

---
# Released Versions:
    - Version 1.0.0 [11-06-2017]
    - Version 1.1.0 [15-06-2017]
    - Version 2.0.0 [11-08-2017]

# Changelog:
- Version 1.0.0
    - Initial Launch
- Version 1.1.0
    - Updated The `fix` command
- Version 2.0.0
	- Separated all scans so that you are served the amount of information you need
	- `Sub-Domain Scanner` improved
	- `fix` command improved
	- `Web Server Detection` Improved
	- `CMS Detection` Improved
	- `Banner Grabbing` Improved
	- Added `WordPress Scanner`
	- Added `Bloggers View`
	- Added `MX Lookup`
	- Added `Update` option
	- RED HAWK Banner Updated
	- Many Other Internal Fixes

# Installation:
1. Run the tool and type `fix`. This will install all required modules for **Arch Linux**.
2. For the Bloggers View to work properly, you need to configure RED HAWK with moz.com's API keys. Follow these steps:

**How To Configure RED HAWK with moz.com for Bloggers View Scan**
+ Create an account on moz by following this link: https://moz.com/community/join
+ After successful account creation and verification, generate your API keys here: https://moz.com/products/mozscape/access
+ Replace the `$accessID` and `$secretKey` variables' values in the `config.php` file with your AccessID and SecretKey.
+ Now you can enjoy the Bloggers View.

# Usage:
- `git clone https://github.com/paramchauhan101/RED_HAWK_FOR_ARCH.git`
- `cd RED_HAWK_FOR_ARCH`
- `php rhawk.php`
- Use the "help" command to see the list of commands or type in the domain name you want to scan (without Http:// or Https://).
- Select whether the site runs on HTTPS or not.
- Choose the type of scan you want to perform.
- Leave the rest to the scanner.

# List of CMS Supported
RED HAWK's `CMS Detector` can detect the following CMSs (Content Management Systems). If the website is using a different CMS, it will return _could not detect_.

- WordPress
- Joomla
- Drupal
- Magento

# Known Issues
**ISSUE:** Scanner stops working after Cloudflare detection.

**SOLUTION:** Use the `fix` command or manually install *php-curl* & *php-xml* using the following Arch-specific commands:
```bash
sudo pacman -S php-curl php-xml
