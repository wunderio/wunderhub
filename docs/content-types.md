WunderHub Content Types
=======================

The WunderHub contains the main content types that any Wunder site should need to syndicate.


Article
-------
Use articles for time-sensitive content like news, press releases or blog posts.

#### Fields

* **Body** - standard formatted long text field (with summary)
* **Image** - files uploaded to field/image
* **Tags** - taxonomy term entity reference to _Tags_ vocabulary. Creates referenced entities if they don't already exist.

Basic page
----------
Use basic pages for your static content, such as an 'About us' page.

#### Fields

* **Body** - standard formatted long text field (with summary)

Blog
----
A post on our company blog.

#### Fields

* **Body** - standard formatted long text field (with summary)
* **Country** - taxonomy term entity reference to _Country_ vocabulary.
* **Deck/intro** - formatted long text field. 
  * The deck intro is used as the summary of your blog. **It is the first copy a reader reads. *It may be the only copy a reader reads.***
* **Image** - image file field, files uploaded to field/image
* **Kicker** - formatted long text field. 
  * A call to action at the end of your blog entry.
* **Tags** - taxonomy term entity reference to _Tags_ vocabulary. Creates referenced entities if they don't already exist.
	
Case Study
----------
A case study of specific work carried out on a project.

#### Fields

* **Body** - standard formatted long text field (with summary)
* **Country** - taxonomy term entity reference to _Country_ vocabulary.
* **Deck/intro** - formatted long text field. 
  * The deck intro is used as the summary of your case study. **It is the first copy a reader reads. *It may be the only copy a reader reads.***
* **Image** - files uploaded to field/image
* **Kicker** - formatted long text field. 
  * A call to action at the end of your case study.
	
Client
------
Metadata about a Wunder client

#### Fields

* **Body** - standard formatted long text field (with summary)
* **Country** - taxonomy term entity reference to _Country_ vocabulary.
	
Principle
---------
A principle for Wunder and our ways of working.

#### Fields

* **Description** - standard body formatted long text field (with summary)
	
Project
-------
Overview information about a client or internal project.

#### Fields

* **Client** - content entity reference to [Client](/#!content-types.md#Client) content type
* **Mission patch** - image file for the project mission patch, files uploaded to missionpatch/[date:custom:Y]-[date:custom:m] 
* **Office** - taxonomy term entity reference to _Office_ vocabulary.
* **Type** - simple list field. Options currently just: Client; Internal

Service
-------
Details of a specific service offering.

#### Fields

* **Body** - standard formatted long text field (with summary)
* **Country** - taxonomy term entity reference to _Country_ vocabulary.
* **Deck/intro** - formatted long text field. 
  * The deck intro is used as the summary of your service. **It is the first copy a reader reads. *It may be the only copy a reader reads.***
* **Image** - files uploaded to field/image
* **Kicker** - formatted long text field. 
  * A call to action at the end of your service.
* **Service Area** - content entity reference to [Service Area](/#!content-types.md#Service_Area) content type
* **Subtitle** - plain text



Service Area
------------
A service area is a collection of different services.

#### Fields

* **Body** - standard formatted long text field (with summary)
* **Country** - taxonomy term entity reference to _Country_ vocabulary.
* **Deck/intro** - formatted long text field. 
  * The deck intro is used as the summary of your service area. **It is the first copy a reader reads. *It may be the only copy a reader reads.***
* **Image** - files uploaded to field/image
* **Kicker** - formatted long text field. 
  * A call to action at the end of your service area.
* **Subtitle** - plain text