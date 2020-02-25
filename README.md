# online-bookings-management-system
As per requirements of an online bookings management system, I would Like to share Online Bookings Management System and would like to share the method how you can install it on your local or live environment.

# Installation Process:
1. Paste the zip file in your localhost htdocs/ directory
2. Unzip / Extract the file (It will create a folder "online-booking")
3. Go to inside the new folder
4. Create a database i.e online_booking
5. Open .env file in your root folder of online-booking
6. Change the database name, password and the project path
7. Open CMD in the project directory
8. Run the following commands respectively
composer dump-autoload
php artisan migrate
php artisan db:seed
9. Run the project in browser i.e http://localhost/online-booking/login
username: super_admin
password: Admin@123

# Congratulations! you have successfully installed Online Booking System Application.

# API Documentation:

# Base URL: 
http://localhost/online-booking/api/

# Headers:
subKey: AbdulRehmanSheikh
Content-Type: application/json

# 1. Post Bookings (Insert / Update)

URL: /api/post/booking/store
Insert Params:
{"id":null,"action":"Add","hotel_id":1,"adults":"7","children":"5","first_name":"Sheikh","last_name":"Abdul","email":"sheikhabdulrehman8@gmail.com","phone":"03464357146","cnic":"8787878787878787","ntn":"03464357146","total":"2000","advance":"1500","notes":"notes for booking","status":"1","booking_duration":"15-01-2020 12:00 AM to 21-02-2020 11:59 PM","checkin_at":"2020-01-15 00:00:00","checkout_at":"2020-02-21 23:59:00"}
Success Response:
{"code":200,"status":"Success","message":"Request Entertained Successfully."}


Update Params:
{"id":1,"action":"Edit","hotel_id":1,"adults":"7","children":"5","first_name":"Sheikh","last_name":"Abdul","email":"sheikhabdulrehman8@gmail.com","phone":"03464357146","cnic":"8787878787878787","ntn":"03464357146","total":"2000","advance":"1500","notes":"notes for booking","status":"1","booking_duration":"15-01-2020 12:00 AM to 21-02-2020 11:59 PM","checkin_at":"2020-01-15 00:00:00","checkout_at":"2020-02-21 23:59:00"}
Success Response:
{"code":200,"status":"Success","message":"Request Entertained Successfully."}

# 2. Post Hotels (Insert / Update)

URL: /api/post/hotel/store
Insert Params:
{"id":null,"action":"Add","name":"Al-Nakhal","email":"sheikhabdulrehman8@gmail.com","UAN":"3235652648421841","contact_first_name":"Abdulrehman","contact_last_name":"Sheikh","contact_number_1":"03464357146","contact_number_2":"03464357146","contact_email":"sheikhabdulrehman8@gmail.com","address_line_1":"33 F\/A Sarwar Rd, Cantonment Board Staff Colony","address_line_2":"33 F\/A Sarwar Rd, Cantonment Board Staff Colony","city":"Lahore","state":"Punjab","postal_code":"54000","country":"Pakistan","website_uri":"https:\/\/www.fedex.com\/","status":"1"}
Success Response:
{"code":200,"status":"Success","message":"Request Entertained Successfully."}


Update Params:
{"id":1,"action":"Edit","name":"Al-Nakhal","email":"sheikhabdulrehman8@gmail.com","UAN":"3235652648421841","contact_first_name":"Abdulrehman","contact_last_name":"Sheikh","contact_number_1":"03464357146","contact_number_2":"03464357146","contact_email":"sheikhabdulrehman8@gmail.com","address_line_1":"33 F\/A Sarwar Rd, Cantonment Board Staff Colony","address_line_2":"33 F\/A Sarwar Rd, Cantonment Board Staff Colony","city":"Lahore","state":"Punjab","postal_code":"54000","country":"Pakistan","website_uri":"https:\/\/www.fedex.com\/","status":"1"}
Success Response:
{"code":200,"status":"Success","message":"Request Entertained Successfully."}

# 3. Post Users (Insert / Update)

URL: /api/post/user/store
Insert Params:
{"id":null,"action":"Add","first_name":"Sheikh","last_name":"Sheikh","username":"haideral44","email":"sheikhabdulrehman8@gmail.com","phone":"03464357146","cnic":"8787878787878787","ntn":"654564654465","address_line_1":"33 F\/A Sarwar Rd, Cantonment Board Staff Colony","address_line_2":"33 F\/A Sarwar Rd, Cantonment Board Staff Colony","state":"Punjab","postal_code":"54000"}
Success Response:
{"code":200,"status":"Success","message":"Request Entertained Successfully."}


Update Params:
{"id":1,"action":"Edit","first_name":"Sheikh","last_name":"Sheikh","username":"haideral44","email":"sheikhabdulrehman8@gmail.com","phone":"03464357146","cnic":"8787878787878787","ntn":"654564654465","address_line_1":"33 F\/A Sarwar Rd, Cantonment Board Staff Colony","address_line_2":"33 F\/A Sarwar Rd, Cantonment Board Staff Colony","state":"Punjab","postal_code":"54000"}
Success Response:
{"code":200,"status":"Success","message":"Request Entertained Successfully."}

# 4. Post Passengers (Insert / Update)

URL: /api/post/user/store
Insert Params:
{"id":null,"action":"Add","hotel_id":1,"first_name":"Sheikh","last_name":"Zayan","email":"sheikhabdulrehman8@gmail.com","phone":"03464357146","cnic":"8787878787878787","ntn":"654564654465","address_line_1":"33 F\/A Sarwar Rd, Cantonment Board Staff Colony","address_line_2":"33 F\/A Sarwar Rd, Cantonment Board Staff Colony","state":"Punjab","postal_code":"54000"}
Success Response:
{"code":200,"status":"Success","message":"Request Entertained Successfully."}


Update Params:
{"id":1,"action":"Edit","hotel_id":1,"first_name":"Sheikh","last_name":"Zayan","email":"sheikhabdulrehman8@gmail.com","phone":"03464357146","cnic":"8787878787878787","ntn":"654564654465","address_line_1":"33 F\/A Sarwar Rd, Cantonment Board Staff Colony","address_line_2":"33 F\/A Sarwar Rd, Cantonment Board Staff Colony","state":"Punjab","postal_code":"54000"}
Success Response:
{"code":200,"status":"Success","message":"Request Entertained Successfully."}

# 5. Get Bookings List

URL: /api/get/bookings

# 5. Get Hotels List

URL: /api/get/hotels

# 6. Get Users List

URL: /api/get/users

# 7. Get Passengers List

URL: /api/get/passengers

Feel free to discuss any inquiry about the project or anything.
