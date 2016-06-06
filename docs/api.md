WunderHub API Endpoints
=======================

List of the API endpoints provided by the WunderHub

/api/team(/{uid}) - Team listing
--------------------------------

Provides json data for all Hub users with the 'Employee' role. ***Provided by Views view***

Parameters:

* User uid - optional

* authentication: cookie
* formats: json

/api/blog(/{uuid}) - Blog listing
--------------------------------

Provides json data of blogs. ***Provided by Views view***

Parameters:

* Blog node uuid - optional

* authentication: cookie
* formats: json

/api/casestudies(/{uuid}) - Case Studies listing
-----------------------------------------------

Provides json data of case studies. ***Provided by Views view***

Parameters:

* Case study node uuid - optional

* authentication: cookie
* formats: json

/api/services(/{uuid}) - Services listing
----------------------------------------

Provides json data of services. ***Provided by Views view***

Parameters:

* Service node uuid - optional

* authentication: cookie
* formats: json

/api/services/areas(/{uuid}) - Service Areas listing
---------------------------------------------------

Provides json data of service areas. ***Provided by Views view***

Parameters:

* Service area node uuid - optional

* authentication: cookie
* formats: json

/api/principles(/{uuid}) - WunderPrinciples listing
------------------------------------------

Provides json data of Wunder principles. ***Provided by Views view***

Parameters:

* Principle node uuid - optional

* authentication: cookie
* formats: json

/api/menutree/{menu} - Menu tree
--------------------------------

Provide a menu tree as json data. Allows consuming sites to construct a navigation menu based on the structure of published menus of content on the Hub.

Parameters:

* menu machine name - required

* authentication: cookie
* formats: hal_json, json

