-- create database if not exists
CREATE DATABASE IF NOT EXISTS tp_mvc;
USE tp_mvc;
DROP TABLE IF EXISTS students, majors, projects;

CREATE TABLE majors (
    major_id INT AUTO_INCREMENT PRIMARY KEY,
    major_code VARCHAR(10) NOT NULL UNIQUE,
    major_name VARCHAR(255) NOT NULL
);

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    nim VARCHAR(50) NOT NULL UNIQUE, 
    phone VARCHAR(20) NOT NULL,
    join_date DATE NOT NULL,
    major_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (major_id) REFERENCES majors(major_id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE projects (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(255) NOT NULL,
    description TEXT,
    start_date DATE NOT NULL,
    end_date DATE,
    student_id INT,
    major_id INT,
    status ENUM('Planned', 'Ongoing', 'Completed') DEFAULT 'Planned',
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE RESTRICT ON UPDATE CASCADE, 
    FOREIGN KEY (major_id) REFERENCES majors(major_id) ON DELETE RESTRICT ON UPDATE CASCADE 
);

INSERT INTO majors (major_code, major_name) VALUES
('DS', 'Delusional Science'),
('GE', 'Gunvarrel Engineering');

INSERT INTO students (name, nim, phone, join_date, major_id) VALUES
('Kurisu Makise', '0987654321', '08987654321', '2022-09-02', 2),
('Mayuri Shiina', '2233445566', '08654321098', '2022-09-04', 2),
('Rintarou Okabe', '3344556677', '08543210987', '2022-09-05', 1);

INSERT INTO projects (project_name, description, start_date, end_date, student_id, major_id, status) VALUES
('Gunvarrel Project', 'A project about Gunvarrel', '2023-01-01', '2023-12-31', 1, 2, 'Ongoing'),
('Time Machine', 'A project about time travel', '2023-02-01', NULL, 2, 1, 'Planned');