# Symfony2 Sitemap

Create symfony2 sitemap , gzipped, multi page  without bundle

## Overview

Symfony2 is a nice PHP framework that provides different ways to solve problems. XML sitemap files are very important to inform search engines about the content your website. Using Symfony2 to generate xml sitemaps with a simple controller/template solution is described below.

## Features

 * Sitemapindex
 * Respect constraints (30k items per page)
 * No database required
 * GZIP Encoding (enabled by default)


## Requirements

There are no special requirements. This solution does not require special bundles or libraries. To view the generated sitemaps file with a browser.

###### app/config/config.yml

```yml```
parameters:
    sitemap:
        limit: 30000
        gzip: 1
``` 
gzip can be 1 or 0 , it send gzip 
