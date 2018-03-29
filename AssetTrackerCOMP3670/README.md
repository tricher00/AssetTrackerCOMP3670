# AssetTrackerCOMP3670

**First time setup**

Since there isn't an easy way to share a MySQL database we need to all follow the same steps for initial setup, so that our databases all have the same structure.
First you need to clone the repo in your htdocs. Open cmd/terminal and navigate to /xampp/htdocs then enter `git clone https://github.com/tricher00/AssetTrackerCOMP3670`.
Next open XAMPP and start both Apache and MySQL. Then open a browser and got localhost/phpmyadmin. Click "New" on the lefthand side and create a database named "assettracker".
It should now appear in the list of databases on the left. Click on it and then click the SQL tab. You'll be taken to a page where you can run SQL queries.
You should then open createTables.txt located in the root of the repo. In it is a few SQL queries to create the needed tables and fill a couple of them. After running the queries your database should be set.
In order to connect to your database check the crendentials in dbConnect.php and make sure they match your PHPMyAdmin credentials. The current credentials are the defaults.
Now to access any page other than the login page you will need a account to login. **Do not** create an account via PHPMyAdmin. That account will not work.
To create the initial admin account navigate to localhost/AssetTrackerCOMP3670/insertAdmin.php. You should see a page saying "New record created successfully".
If it does not, ensure you followed the previous steps correctly. If it does work you should be ready to login. Navigate to localhost/AssetTrackerCOMP3670/login.php.
There enter sample@test.com for the email and P@ssw0rd for the password. You will then be prompted to change the password. Change it whatever you like and now you can access all pages.
