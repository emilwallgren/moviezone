MovieZone Settings & Configurations 
===================================

So you've chosen to download MovieZone!
Good, this application is ready to go.
MovieZone is an application in which you can publish movie-information together with a blog. 
There is a good looking, summarizing firstpage and there is possibility to search for movies by text or category.
MovieZone has it's own built CMS-system for the application where there's possibility to CRUD the movies or the blogposts.
Theres also functionality to edit back-end users of the application. 

All you need to do is follow these steps:
-----------------------------------------

1. Go to MovieZone/Webroot/config.php. Open file and insert your host, databasename, username and password on line 53,54,55 where there for now is default text.
2. Name your logo image "logo.png". Place it in MovieZone/Webroot/Images.
3. Got to MovieZone/Webroot/omoss.php. Where there is an image tag, enter your image-filename instead of emilwallgren.jpg. Keep the other questionmarks and ampersand signs. They are important. Also, write your own company description instead of the default description found in the paragraph with a class of descriptions.
4. Write the following three SQL-statements in your SQL-terminal to create tables:

	CREATE TABLE blog
	(
	  id int NOT NULL AUTO_INCREMENT,
	  title VARCHAR(300),
	  author VARCHAR(100),
	  description TEXT,
	  category VARCHAR(50),
	  PRIMARY KEY (id)
	);

	CREATE TABLE filmer
	(
	  id int NOT NULL AUTO_INCREMENT,
	  title VARCHAR(300),
	  description TEXT,
	  trailerlink VARCHAR(100),
	  IMDBlink VARCHAR(100),
	  imageName VARCHAR(100),
	  imageOne VARCHAR(100),
	  imageTwo VARCHAR(100),
	  imageThree VARCHAR(100),
	  category VARCHAR(50),
	  dateTime datetime,
	  PRIMARY KEY (id)
	);

	CREATE TABLE users
	(
	  id int NOT NULL AUTO_INCREMENT,
	  username VARCHAR(100),
	  password VARCHAR(100),
	  PRIMARY KEY (id)
	);


These tables are working, but there is serious room for security issues. One example could be to hash the passwords.

When you are done with all of the above. You can start using MovieZone and publish some of the best movies out there, together with a well functioning blog.

NOTE: The current version of MovieZone contains Swedish language. MovieZone is built upon ANAX which is created by Micael Roos at Blekinge Tekniska Högskola.

ENJOY :-)

/Emil Wallgren (Creator of MovieZone)







