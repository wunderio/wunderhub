WunderHub Custom Modules
========================

This is a description of the purpose and functionality of custom modules in the Hub.

Custom modules are actually built in the `web/profiles/wunderhub` directory - where I put them when I first started writing custom code for D8, coz it felt like that was the right thing to do after all my D7 experience. ;-P

Wundersites::HUB profile
------------------------

Installation profile.

* Includes an **important custom plugin** for a **content filter that turns internal image URLs into absolute URLs**, so that images placed in body text with a WYSIWYG have absolute URLs to the image on the WunderHub when syndicated via API endpoints.
* Includes **WunderSimple** profile theme, also.
 
menutree_resource
-----------------

Wundersites::Hub: provide a menu tree as an REST API endpoint. Allows consuming sites to construct a navigation menu based on the structure of published menus of content on the Hub.

Provides:

* Admin form at /admin/config/services/menutree
  * select which menus are available via the API endpoint.
* API endpoint at /api/menutree/{menu}
  * authentication: cookie
  * formats: hal_json, json

wkhub_blog
----------

Wundersites::Hub: Blog content type and API.

This may be redundant in preference for configuration management export/import.

wkhub_casestudies
-----------------

Wundersites::Hub: Case Studies, includes case studies content types and API.

This may be redundant in preference for configuration management export/import.

wkhub_company
-------------

Wundersites::Hub: Company and office information.

This may be redundant in preference for configuration management export/import.

wkhub_person
------------

Wundersites::Hub: Users and user profiles.

This may be redundant in preference for configuration management export/import.

wkhub_principle
---------------

Wundersites::Hub: WunderPrinciples.

Provides:

* API endpoint at api/principles
  * JSON list of all principles
* API endpoint at api/principles/zen
  * functions in the same way as https://api.github.com/zen - returns random title of a [Principle](/#!content-types.md#Principle) node.

wkhub_search
------------

Search API for the WunderHub

This may be redundant in preference for configuration management export/import.

wkhub_services
--------------

Wundersites::Hub: Services, includes services and service areas content types and API.

This may be redundant in preference for configuration management export/import.
