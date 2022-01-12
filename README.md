# task-for-channelpro

First thing to do is to import database.<br />
using phpMyadmin create new database with name users_portal<br />
and import the file users_portal.sql<br />
this file exist on the users_portal folder.<br />
<br />
A- inside the folder "tasks" you will find the code related to the "Common Task" from the email.<br />

.        Set up a NodeJS Express server and connect it to MySQL OR a PHP (no framework allowed) server  and connect it to MySQL
·        Create a database with a simple users table (First Name, Last Name, Email, Password, Role: [“admin”,“client”])
·        Add JWT Authentication
·        Create Restful APIs to: Login / Sign UP, Create User and Edit User details
<br />
* To test the APIs use Postman (you will find a file inside this folder named"node-project.postman_collection.json")<br />
- import the collection and test the APIs<br />
- to run the code: open the projuct with "Visual Studio" and form the terminal downside add "node server.js" and now you are ready to test the APIs.<br />
- you will find 5 APIs (Register, Login, Get User, Create User and Update User)<br />
- to use the last 3 APIs you have to take the token from the Login API first.<br />
- From the Login API copy the token and on the last three APIs add it in the headers<br />
example:<br />
Key: Authorization<br />
Value: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZF91c2VycyI6MTIsImlhdCI6MTY0MTkzOTQ5NywiZXhwIjoxNjQxOTQzMDk3fQ.6n5mBhQUsQqfZIkr3RUypISWEl87hWsxoalwwE0tYk8
<br />

B- <b>PHP Task:</b><br />
use the second folder "users_portal" <br />
you need to have wampserver to run the application<br />
copy this folder and paste it on the www folder <br />
run it throught the browser as: localhost/users_portal<br />
Note: I used to work on codeigniter or larave frameworks but because the product used a native PHP code I chose to make this task using the native PHP code.<br />
you will get a login page first:<br />
use this credentials:<br />
Email: ramimiari1985@gmail.com<br />
Password: 123456<br />
<br />
After login you will see the users list <br />
you can Add, edit or delet any users if you are with Admin role <br />
and if you are not you will can only view the users list.<br />
<br />
and you can logout from the top and login with your new user that you will create.<br />



