CREATE DATABASE IF NOT EXISTS campus_club;
USE campus_club;

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS feedback;
DROP TABLE IF EXISTS attendance;
DROP TABLE IF EXISTS notifications;
DROP TABLE IF EXISTS event_registrations;
DROP TABLE IF EXISTS club_members;
DROP TABLE IF EXISTS events;
DROP TABLE IF EXISTS clubs;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS users;
SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL,
 register_no VARCHAR(50) NOT NULL UNIQUE,
 email VARCHAR(100) NOT NULL UNIQUE,
 department VARCHAR(100) NOT NULL,
 year INT NOT NULL,
 password VARCHAR(255) NOT NULL,
 role ENUM('student','admin') DEFAULT 'student',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
 category_id INT AUTO_INCREMENT PRIMARY KEY,
 category_name VARCHAR(80) NOT NULL UNIQUE
);

CREATE TABLE clubs (
 club_id INT AUTO_INCREMENT PRIMARY KEY,
 club_name VARCHAR(120) NOT NULL,
 category_id INT,
 description TEXT,
 coordinator VARCHAR(120),
 image VARCHAR(255),
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(category_id) REFERENCES categories(category_id) ON DELETE SET NULL
);

CREATE TABLE events (
 event_id INT AUTO_INCREMENT PRIMARY KEY,
 club_id INT NOT NULL,
 event_name VARCHAR(150) NOT NULL,
 description TEXT,
 event_date DATE NOT NULL,
 event_time TIME NOT NULL,
 venue VARCHAR(150),
 max_participants INT DEFAULT 100,
 registration_deadline DATE,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(club_id) REFERENCES clubs(club_id) ON DELETE CASCADE
);

CREATE TABLE club_members (
 member_id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 club_id INT NOT NULL,
 joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY unique_user_club(user_id,club_id),
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(club_id) REFERENCES clubs(club_id) ON DELETE CASCADE
);

CREATE TABLE event_registrations (
 registration_id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 event_id INT NOT NULL,
 registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY unique_user_event(user_id,event_id),
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(event_id) REFERENCES events(event_id) ON DELETE CASCADE
);

CREATE TABLE attendance (
 attendance_id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 event_id INT NOT NULL,
 status ENUM('Present','Absent') DEFAULT 'Present',
 marked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY unique_attendance(user_id,event_id),
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(event_id) REFERENCES events(event_id) ON DELETE CASCADE
);

CREATE TABLE feedback (
 feedback_id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 event_id INT NOT NULL,
 rating INT NOT NULL CHECK(rating BETWEEN 1 AND 5),
 comments TEXT,
 submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY unique_feedback(user_id,event_id),
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(event_id) REFERENCES events(event_id) ON DELETE CASCADE
);

CREATE TABLE notifications (
 notification_id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 message VARCHAR(255) NOT NULL,
 is_read TINYINT(1) DEFAULT 0,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO categories(category_name) VALUES
('Technical'),('Cultural'),('Sports'),('Arts'),('Photography');

INSERT INTO clubs(club_name,category_id,description,coordinator) VALUES
('Coding Club',1,'Programming, coding contests and technical workshops.','Faculty Coordinator'),
('Cultural Club',2,'Cultural events, celebrations and stage activities.','Cultural Coordinator'),
('Sports Club',3,'Sports activities and inter-department competitions.','Sports Coordinator'),
('Photography Club',5,'Photography walks, editing workshops and competitions.','Photography Coordinator');

INSERT INTO events(club_id,event_name,description,event_date,event_time,venue,max_participants,registration_deadline) VALUES
(1,'CodeSprint 2026','Coding contest and problem solving challenge.','2026-10-10','10:00:00','CS Lab',100,'2026-10-08'),
(4,'Campus Photo Walk','Campus photography and editing activity.','2026-10-15','09:00:00','Main Block',50,'2026-10-13'),
(2,'Cultural Fest','Annual cultural celebration.','2026-10-20','10:00:00','Auditorium',200,'2026-10-18'),
(3,'Sports Meet','Inter department sports meet.','2026-10-25','08:00:00','Sports Ground',150,'2026-10-23');
