CAMPUS CLUB MANAGEMENT SYSTEM - COMPLETE MINI PROJECT

Technology: PHP 8.x, MySQL, HTML5, CSS3, JavaScript, XAMPP, VS Code.

SETUP
1. Keep folder name: CampusClubManagement_Complete
2. Copy to C:\xampp\htdocs\CampusClubManagement_Complete
3. Start Apache and MySQL in XAMPP.
4. Open phpMyAdmin and import database/campus_club_complete.sql.
5. Open http://localhost/CampusClubManagement_Complete/

ADMIN SETUP
Register a normal account first. Then run:
UPDATE users SET role='admin' WHERE email='YOUR_EMAIL';
Logout and login again.

STUDENT MODULES
Register/Login, Dashboard, Club search/filter, Join Club, Events, Register Event,
My Events, Profile, Feedback and Attendance tracking.

ADMIN MODULES
Dashboard, Manage Clubs (Add/Edit/Delete), Manage Events (Add/Edit/Delete),
View Club Members, Event Registrations & Attendance, Reports and Analytics.

FLOW
CAMPUS CLUB
  STUDENT -> Register/Login -> Dashboard -> Clubs -> Join
                           -> Events -> Register
                           -> Profile / My Events / Feedback / Attendance
  ADMIN   -> Dashboard -> Manage Clubs -> View Members
                     -> Manage Events
                     -> Attendance / Reports / Analytics

Database uses UNIQUE(user_id, club_id) and UNIQUE(user_id, event_id), so one
student can join multiple clubs and register for multiple events.
