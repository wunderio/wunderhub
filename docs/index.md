WunderHub Documentation
=======================

**This file contains the general documentation on the WunderHub. The production WunderHub is located at https://hub.wunder.io/.**

It is intended for developers who are involved in the project, and to ease the handover of activities and support to colleagues.

Our Client
----------

The WunderHub is an internal system for Wunder Group staff only.

Web Application Goal
--------------------

The WunderHub is an internal system that syndicates content for other Wunder sites to consume. 

The content in the WunderHub should not be available to the general public directly. Consequently, the site does not need to have a beautiful UI beyond a very usable admin interface - it is mostly an admin-only site.


Project Management
------------------

* **GitHub repo**
  - https://github.com/wunderkraut/wunderhub
  - updates to the repo are published automagically in the HipChat room (see below) - important for visibility!
* **User stories and project tasks**
  - https://github.com/wunderkraut/wunderhub/issues
* **HipChat room**
  - \*Project: Wundersites

Repository Structure
--------------------

The code repository uses a very simple branch structure.
  
* **master**
  * Production branch
  * Deployed to the production servers
  * Always equal to the actual code currently running on production servers
* **feature branches**
  * new features may be available as feature branches in the repo.
    * feature branches should be named with feature/ as a prefix

The site build is taken directly from the [Composer Template for Drupal Projects](https://github.com/drupal-composer/drupal-project).

Deployment
----------

Deployment currently is entirely manual.

SSH password login is disabled on the production machine. Access is only possible via SSH key. 

To ssh into the production machine:
 
```
$ ssh www-admin@hub.wunder.io
```

The site can be found on the server at:

```
/var/www/hub.wunder.io-composer
```

The site is deployed with the www-admin user, so no need to switch to a different user.

Since this system is derived from the [Drupal Composer](https://github.com/drupal-composer/drupal-project) project, the Drupal installation is in the `web`-directory.

The composer.lock file in the repo means that code should be deployed with:

```
$ composer install
```

