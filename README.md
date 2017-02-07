# Default Theme Development

## Front-end Workflow

FE workflow is using Grunt.
Default theme is located here : config/themes/default/

First time working on the project run :

```
grunt init
```

When doings devs run :

```
grunt dev
```

Main CSS file is main.css, this one is versioned unminified.

## Deploying to staging

```
grunt staging
```

This task will create a /dist folder inside the theme/default folder.
This /dist folder will contain everything that should be send to production : images, fonts, JS, CSS, PHP.
At last, the task will sftp the content of this dist folder to staging using SFTP-DEPLOY task : https://github.com/thrashr888/grunt-sftp-deploy

# About Subfolio

Subfolio provides an elegant, practical and customizable web interface to your file system. Super fast to set-up and use, you’ll be up and running in minutes. Flexible and feature-rich, you’ll soon be inventing new ways to use it.

Subfolio is made for creative types to share their work online with speed and elegance — publicly or privately. It’s good for freelancers, studios, agencies, enterprise or even the classroom.

Subfolio is a lightweight PHP5 file browser app that installs on your own server. No database or content management needed. And for you geeks out there, it’s extensible too.

Learn more about Subfolio and its features at:

  http://www.subfolio.com

## Installation

To install Subfolio, we recommend that you read the installation documentation at:

  http://area17.github.io/subfolio

## Upgrading

We strongly recommend that you read the "version release notes" and documentation on upgrades before you begin any upgrade, especially if you have customized your engine or a theme. 

  http://area17.github.io/subfolio

## Support and Documentation

If you have a problem, question, suggestion or to see full documentation, please visit our support site at:

  http://area17.github.io/subfolio
  
## Enhancers

To download Subfolio Enhancers, please visit:
https://github.com/area17/subfolio-enhancers

## Mailing List

Join us at Twitter: twitter.com/subfolio or join our email newsletter at:

  http://www.subfolio.com/newsletter

(c) 2009-2016 Subfolio by AREA 17. All rights reserved.
