# Hell Scripts FW

Hell Scripts FW is a web page for learning purposes built at classroom using PHP7, AngularJS, MVC, SQL, Apache, a PHP Object Oriented Framework to manage objects from the database, an external login API and an internal API based on authentication and permissions to resources.

### Pages

  - Home
  - Projects
  - Profile
  - Contact
  - Users
  -- Login
  -- Register
  - Cart

### Technologies

Hell Scripts FW uses a number of open source projects to work properly:

* PHP7
* Bootstrap 
* AngularJS - v1.4.9
* MySQL

### Features

<table>
<tbody>
<tr>
<td bgcolor="#CCFFFF"><strong>PAGE</strong></td>
<td bgcolor="#CCFFFF"><strong>Features</strong></td>
</tr>
<tr>
<td >Home</td>
<td >Search, pager, list/details, autoredirect, </td>
</tr>
<tr>
<td>Projects</td>
<td>Datatable, CRUD, DELETE ALL, get projects owned by the user, the user can also create his projects, admin features</td>
</tr>
<tr>
<td>Login</td>
<td>Register, login, logout, encrypt password, avatar, token based auth, recover password, toastr, Social Login Auth0 PHP, Social logout, activation email</td>
</tr>
<tr>
<td>Contact</td>
<td>Send email (mailgun)</td>
</tr>
 <tr>
<td>Profile</td>
<td>User info, dependent dropdown, dropzone, projects created by the user</td>
</tr>
<tr>
<td>Cart</td>
<td>Add in home,list and details, increase and decrease, checkout</td>
</tr>
<tr>
<td>PHP Framework</td>
<td>2 user tables, clean controllers, classes with extends, yml, user authorized, autoload, ORM, pretty URLs</td>
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

### PHP Authorization Framework
This project uses a resource-based authentication <strong>generic</strong> API that enables different types of users to have different types of permissions on the diferent resources of the app.

License
----
[GPL-3.0](https://www.gnu.org/licenses/gpl-3.0.html)

