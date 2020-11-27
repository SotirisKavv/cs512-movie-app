CREATE DATABASE IF NOT EXISTS moviedb;
USE moviedb;

CREATE TABLE IF NOT EXISTS Users (
   id INT NOT NULL auto_increment,
   name VARCHAR(255),
   surname VARCHAR(255),
   username VARCHAR(255),
   password VARCHAR(255),
   email VARCHAR(255),
   role ENUM('ADMIN', 'CINEMAOWNER', 'USER'),
   confirmed BOOLEAN,
   PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS Cinemas (
   id INT NOT NULL auto_increment,
   owner_id INT,
   name VARCHAR(255),
   PRIMARY KEY (id),
   FOREIGN KEY (owner_id) REFERENCES Users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Movies (
  id INT NOT NULL auto_increment,
  title VARCHAR(255),
  release_year INT,
  poster_link varchar(255),
  start_date DATE,
  end_date DATE,
  cinema_id VARCHAR(255),
  category VARCHAR(255),
  PRIMARY KEY (id),
  FOREIGN KEY (cinema_id) REFERENCES Cinemas(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Favourites (
  user_id INT,
  movie_id INT,
  FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE,
  FOREIGN KEY (movie_id) REFERENCES Movies(id) ON DELETE CASCADE
);
