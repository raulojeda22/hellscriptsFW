# Hell Scripts FW

Hell Scripts FW is a web page for learning purposes built at classroom using PHP7, Jquery, MVC, SQL, Apache, a PHP Object Oriented Framework to manage objects from the database, an external API and an internal API based on authentication and permissions to resources.

### Pages

  - Home
  - Explore
  - Projects
  - JqWidgets
  - Profile
  - Contact
  - Users
  -- Login
  -- Register
  - Cart

### Technologies

Hell Scripts FW uses a number of open source projects to work properly:

* PHP
* Bootstrap
* jQuery
* SQL

### Features

<table width="673">
<tbody>
<tr>
<td style="text-align:center;" width="183" bgcolor="#CCFFFF"><strong>PAGE</strong></td>
<td style="text-align:center;" bgcolor="#CCFFFF"><strong>Features</strong></td>
</tr>
<tr>
<td style="text-align:center;" >Home</td>
<td style="text-align:center;" bgcolor="#CCFFFF">Carousel, Filters Search, Projects, Github API</td>
</tr>
<tr>
<td style="text-align:center;">Explore</td>
<td style="text-align:center;">List, Details, Github API</td>
</tr>
<tr>
<td style="text-align:center;">Projects</td>
<td style="text-align:center;">Datatable, modal, validation PHP/JS, CRUD, DELETE ALL, Get Projects owned by User, The user can also create his projects, Admin features, Redirect non registered user</td>
</tr>
<tr>
<td style="text-align:center;">JqWidgets</td>
<td style="text-align:center;">CSS to dark-red theme</td>
</tr>
<tr>
<td style="text-align:center;">Login</td>
<td style="text-align:center;">Register, Login, Logout, validation PHP / JS, encrypt passwd, avatar, Enter, Token based Auth</td>
</tr>
<tr>
<td style="text-align:center;">Contact</td>
<td style="text-align:center;">GMaps, Hide key, CSS dark-red theme</td>
</tr>
 <tr>
<td style="text-align:center;">Profile</td>
<td style="text-align:center;">User Info, Projects created by the user, Redirect non registered user</td>
</tr>
<tr>
<td style="text-align:center;">Cart</td>
<td style="text-align:center;">Add in home,list and details, validation PHP/JS and checkout</td>
</tr>
<tr>
<td style="text-align:center;">Application</td>
<td style="text-align:center;">Template, 404, MVC, Github: readme, .gitignore, constants, API PHP Database Object Framework</td>
</tr>
</tbody>
</table>

### Installation
You will need a LAMP server with Apache, PHP 7, and MySQL. You can use this [tutorial](https://www.howtoforge.com/tutorial/install-apache-with-php-and-mysql-on-ubuntu-16-04-lamp/).

Then you should change the configuration of on the file /backend/includes/constants.php to match your system configuration.

You can also change the SQL configuration on the /backend/models/Connection.class.php file.

Finally you should create the tables located on the /backend/mwb/hellscripts.mwb file (You will need to open it using [MySql Workbench](https://www.mysql.com/products/workbench/))

### BBDD

![alt text](https://raw.githubusercontent.com/raulojeda22/hellscriptsFW/master/backend/models/mwb/databaseScheme.png)

### Todos

 - Chats
 - Developers page
 - Vinculate projects with git

License
----

[GPL-3.0](https://www.gnu.org/licenses/gpl-3.0.html)


**Free Software, Hell Yeah!**
