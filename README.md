COMP 1044 Database and Interfaces Group 20
CW2 (Design, Implement Database with its interface)
University of Nottingham Malaysia

xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

--Group Members--

1. Tan Shao Lin
2. Alvin Kho Yien Yang
3. Gan Xiao Thung
4. Khor Jinming 

xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

--Project Description--

Students will have to build a web front-end to the database using HTML, 
CSS and Javascript that will connect to your database and execute 
queries using PHP and SQL. The functionality should include:

• Adding a book to the database
• Adding a member to the database
• Searching for a book in the database
• Searching for a member in the database
• Update borrow details record in the database
• Update member details in the database
• Deleting a book from the database
• Deleting a member from the database

xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

--How to run the project--

1. Create a database and name it "library". Go into the database and import the library.sql file 
to create the tables.

2. For Windows:
Locate the following folder (C://xampp/htdocs). Download the php files and put into the htdocs. 

For MacOS:
For XAMPP-vm user, go to "Volumes" tab and click "Mount". Then click "Explore". You should
see a file name "lampp" pop out. Find file "htdocs" and put the php files into it.

For non vm user, open XAMPP and click "Open Application Folder". You should see a file name
"Xamppfiles" pop out. Find htdocs and put the php files into it.

3. Make sure "Apache", "MySQL", "ProFTPD" services are already started.

4. Go to the browser and type “localhost/auth.php”.
(For XAMPP-vm user, please follow your network port [ex: localhost:8080/auth.php] ) 

xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

--How to use the project--

1. User should create an account through registration form. It can be found through clicking a link beside login button 
in main login page (auth.php).

2. After login, user will be redirected to library page (1ndex.php). There is a sidebar locate at the top of the screen containing 5 
buttons which are "Library", "Members", "Borrow Records", "Search", and "Log Out". Clicking each button will redirect the page to library
list, member list, borrow record list, search page and login page.

3. Library page lists out every book that are currently own by the library and it's details. Each row of the table has 2 options to 
delete or update, same to member list and borrow record list. Member page lists out every member details that are already register with 
the library. Borrow Record page lists out history of every borrow record details. 

4. After clicking update button, a confirmation log will pop out. After clicking "Yes", user will be redirected to update page. 
In this update form, user can edit the information and details of the record. After clicking update button, user will be redirected to 
library list (assuming user updates book details). Same to member list and borrow details list, after update each record user 
will be redirected to the list respectively.

5. After clicking delete button, a confirmation log will pop out. After clicking "Yes", the record will be deleted and 
user will be redirected to library list (assuming user deletes a book). Same to member list and borrow details list, 
after delete each record user will be redirected to the list respectively.

6. After clicking search button, user will be redirected to search page containing a long search bar and 3 options : Books, Members, Borrow Records.
Fill in the search bar and pick one of the options and click search will give user the result of the keywords in selected field. 

7. After clicking log out button, a confirmation log will pop out. After clicking "Yes", user will be redirected to login page. 

xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
