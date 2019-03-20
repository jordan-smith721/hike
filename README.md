# hike
Hike tracking

1. Separates all database/business logic using the MVC pattern.
We separated all the logic in different directories. The models were stored in a
model folder, views were stored in a view directory, and the controller is our
index.php page that pulls it all together.

2. Routes all URLs and leverages a templating language using the Fat-Free framework.
In our index page we have multiple routes and reroutes that display different
views that we created using Templates. 

3. Has a clearly defined database layer using PDO and prepared statements.
Under model/db-functions.php we have all database functions that use PDO
and prepared statements. 

4. Data can be viewed, added, updated, and deleted.
On the landing page after signing in, hikes and goals can be views. Add and remove
buttons are found on the hike page and update goals can be found on the goal
tab. 

5. Has a history of commits from both team members to a Git repository.
https://github.com/jordan-smith721/hike

6. Uses OOP, and defines multiple classes, including at least one inheritance relationship.
A user class is made for people who sign up, if the premium user check box
is selected, then the user becomes a Premium User that extends from the user
class. Premium Users are allowed access to goals, Users are not. 

7. Contains full Docblocks for all PHP files.
Docblocks are used in each php file that contains a function

8. Has full validation on the client side through JavaScript and server side through PHP.
The js directory contains Javascript validation and index.php contains server
side validation. 

9. Incorporates jQuery and Ajax.
Ajax and Jquery can be found in the js/update-goal-js.js and js/modal-js.js

BONUS:  Utilizes an API (Note:  If you do use an API, be sure to talk about it in your presentation.)
API was not used. 