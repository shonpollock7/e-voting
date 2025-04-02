# E-Voting System

The eVoting System is a web-based application developed to facilitate electronic voting processes. This system allows registered users, both voters and administrators, to participate in the election process efficiently and securely.

## Features

### Admin Panel

- **Authentication and Security**:
  - Email verification system for admin login.
  - Ensured security measures for protecting sensitive data.

- **Election Management**:
  - View, add, edit, and delete elections.
  - Create posts for different positions in an election.

- **Voter Management**:
  - View, add, edit, and delete voter profiles.

- **Candidate Management**:
  - Add candidates for various posts.
  - Assign candidates to specific posts.

- **Voting Report**:
  - Generate and view voting reports.
  - Print out voting reports for record-keeping.

- **Data Reset**:
  - Reset all data for system testing or administrative needs.

### Voter Panel

- **Account Creation and Verification**:
  - Voter registration with email verification.
  - Change password and forgot password functionality with email verification.

- **Voting Process**:
  - Secure login to the voter panel.
  - Ability to submit votes for preferred candidates.
  - Prevent voters from voting more than once.

## Technologies Used

- **Frontend**:
  - HTML, CSS, Bootstrap for user interface design.
  - JavaScript and jQuery for dynamic frontend behavior.

- **Backend**:
  - PHP for server-side scripting.

- **Database**:
  - MySQL for data storage and retrieval.

## Installation and Setup

1. Set up your web server (e.g., Apache) to serve the project directory.
2. Create a MySQL database and import the provided SQL dump to set up the database schema.
3. Update the database configuration in `/php/db.php`,`/Dashboard/php/db.php`,`/voter/php/db.php` files.
4. Configure email settings for verification and password reset functionalities.
5. Access the admin panel via `http://yourserver/index.php` and the voter panel via `http://yourserver/voter/index.php`.

## Usage

- Admin Panel: Manage elections, voters, candidates, and generate reports.
- Voter Panel: Register, login, and vote for candidates in ongoing elections.

## Notes

- This project is for educational and demonstrative purposes.
- Ensure proper security measures are in place before deploying in a real-world scenario.

## License

This project is licensed under the &copy; 2023 Md. Miraz Hossain(UG02-51-19-001), Shon Pollock Hawlader(UG02-51-19-011),
Nurnahar Akter(UG02-51-19-004)
