-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS movieDB;
USE movieDB;

-- Users table
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

-- Movies table
CREATE TABLE IF NOT EXISTS movies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  genre VARCHAR(100),
  description TEXT,
  release_year INT
);

-- Reviews table
CREATE TABLE IF NOT EXISTS reviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  movie_id INT,
  rating INT,
  review TEXT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (movie_id) REFERENCES movies(id)
);

-- Favorites table
CREATE TABLE IF NOT EXISTS favorites (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  movie_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (movie_id) REFERENCES movies(id)
);

-- Sample Movies
INSERT INTO movies (title, genre, description, release_year) VALUES
('Inception', 'Sci-Fi', 'A mind-bending thriller by Christopher Nolan.', 2010),
('Titanic', 'Romance', 'A romantic drama set on the ill-fated Titanic.', 1997),
('The Dark Knight', 'Action', 'Batman battles the Joker.', 2008),
('Interstellar', 'Sci-Fi', 'A journey through space and time to save humanity.', 2014),
('Avengers: Endgame', 'Action', 'The Avengers assemble for a final stand against Thanos.', 2019),
('The Notebook', 'Romance', 'A heartfelt story of enduring love.', 2004),
('Gravity', 'Sci-Fi', 'A stranded astronaut fights for survival.', 2013),
('John Wick', 'Action', 'A retired hitman seeks revenge for his dog.', 2014),
('La La Land', 'Romance', 'A jazz musician and actress fall in love in LA.', 2016);
