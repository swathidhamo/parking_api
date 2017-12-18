# parking_api
This repository consists of the api routes for a shopping mall parking management system. 
It is written in native PHP, with a MySql Database. 
There are three main tables in the database 'parking_app' for the api. 
There are 6 routes, 
1. 'signup' route for a user registration
2. 'login' route for user login verification 
3. 'book_slot' for getting an avaliable slot in a given mall for a car with one of three sizes ranging from 1 for Hunch Back, 2 for Sedan and 3 for SUV and to book the slot for that user with the timestamp recorded at the time of entering 
4. 'fetch_slot' to fetch the slot for a given username 
5. 'end_slot' for ending slot when the user leaves and the end_time slot is recorded to denote the amount to be paid
6. 'bring_offers' for better in-mall navigation for a user to get offers from stores based on their preference 
# TABLE 1: auth 
This is the table that is used for user registrations and verification, routes 1 & 2. 

# TABLE 2: mall
This is the table for the slot booking, verification in malls, routes 3, 4 & 6

# TABLE 3: stores
This is what keeps track of the store discounts in malls, route 6

