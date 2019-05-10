# Database Final Project: Digital Song Library
Final Project for CS3380

This web application intends to fulfill the requirements for the Final Project for CS 3380 - Databse Applications and Information Systems.
The application is currently being hosted on AWS here: http://ec2-3-16-213-5.us-east-2.compute.amazonaws.com

# Team Members
Matt Hudson

# Description

This application serves as an online library of songs. The home page is a media player that allows anyone who accesses
the site to play from the library. It constructs a dynamic menu using database information. Each menu item contains
info related to that song. When selected, the song is played on the media player and its data is displayed in a separate window.
The media player allows the user to control position, play/pause, and volume, including a mute option.

To add songs to the library, the user must first login or create a user account. There is error checking so that duplicate
users cannot be created, passwords match a confirm password, etc. The user can login using their credentials. Once logged in,
some additional pages open in the navigation bar to add songs and view all users, as well as to update their password and delete their user account.

To add a song, the user must provide song info and upload an mp3 file. The user can optionally upload an associated image to that song.
By default, it will be assigned 'default.png' which is already on the server. This adds the song to the database, so it will be
added to the library once the user goes back to the home screen.

The user can update their password (as long as the new one is different than the old one, and they can provide their old password).

The user can also delete their user account permanently.

The application also allows anyone (logged in or not) to search for a user. If logged in, a user can view all users at once as well.
    
    Database Schema:
    table users:
      varchar[256] username not null unique primary key;
      varchar[256] password; // (encrypted using php hash function unsalted)
      varchar[256] firstName;
      varchar[256] lastName;
      Date addDate;
      varchar[256] favGenre; // selected from genre choices
      
    table songs:
      int id not null primary key unique auto_increment; 
      varchar[256] title; // title of the song (entered by user)
      varchar[256] artist; // artist of the song (entered by user)
      // these next three properties were chosen from a list of options when the user uploaded the song
      varchar[256] category;
      varchar[256] genre;
      varchar[256] decade;
      varchar[256] addedBy; // user who uploaded the song
      Date addDate; // date song was uploaded
      varchar[256] filepath; // path to the associate mp3 file for this song is located
      varchar[256] imagepath; // path to the associated image for this song is located
    
    
Here is how it meets the project requirements:


     - utilizes more than one table. The database aspect of the project uses the database 'songapp' which has two tables: songs and passwords.
     The songs table is used to store information regarding the songs that are uploaded to the application.
     The users table is used to store user information.
     
    - The tables must be normalized (BCNF is the goal). The tables are normalized since redundant information is not stored in either table.
    
    -Implements full CRUD (create, read, update and delete) with at least some of the data.
    Create: The user is able to add songs, which creates new rows in the songs table. Also, creating an account adds a row
    in the users table.
    Read: On the main page, PHP reads in song data (read from the songs table) to dynamically contstruct the song menu.
    Also, to login, PHP reads the users table.
    Update: The Update Password tab allows a user to update their password in the users table.
    Delete: The DELETE USER tab (only visible if logged in) deletes the currently logged in user and destroys their session data.
    It deletes their row from the user table.
    
    -serves a purpose. The application serves a purpose: to allow users to upload songs as mp3 files and be able to play
    them from a library consisting of all uploads from all users.
    -is not trivial. The application is not trivial, as it involves a lot of error checking, navigation and database functions.
    
# ERD

![ERD]https://github.com/hudso1898/DatabaseFinal/blob/master/songlibraryerd.PNG "Song Library ERD")

# Video Demonstration
https://youtu.be/ysncr31SIh8



