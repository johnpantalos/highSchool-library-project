<?php

// SQL to create Admins table
$sql_Admins = "CREATE TABLE IF NOT EXISTS Admins (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_Admins) === TRUE) {
    echo '<p style="text-align: center;"> Table Admins created successfully.</p>';
} else {
    echo '<p style="text-align: center;">' . $conn->error . '</p>'; 
}


// SQL to create Students table
$sql_students = "CREATE TABLE IF NOT EXISTS Students (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    borrowed_books_count INT(6) DEFAULT 0,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_students) === TRUE) {
    echo '<p style="text-align: center;"> Table Students created successfully.</p>';
} else {
    echo '<p style="text-align: center;"> Error creating table Students: ' . $conn->error . '</p>'; 
}


// SQL to create Books table
$sql_books = "CREATE TABLE IF NOT EXISTS Books (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    copies_available INT(6) NOT NULL
)";

if ($conn->query($sql_books) === TRUE) {
    echo '<p style="text-align: center;"> Table Books created successfully.</p>';
} else {
    echo '<p style="text-align: center;"> Error creating table Books: ' . $conn->error . '</p>'; 
}


// SQL to create BorrowRecords table
$sql_borrow_records = "CREATE TABLE IF NOT EXISTS BorrowRecords (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_id INT(6) UNSIGNED NOT NULL,
    book_id INT(6) UNSIGNED NOT NULL,
    borrow_date DATE NOT NULL,
    due_date DATE NOT NULL,
    return_date DATE,
    FOREIGN KEY (student_id) REFERENCES Students(id),
    FOREIGN KEY (book_id) REFERENCES Books(id)
)";

if ($conn->query($sql_borrow_records) === TRUE) {
    echo '<p style="text-align: center;"> Table BorrowRecords created successfully.</p>';
} else {
    echo '<p style="text-align: center;"> Error creating table BorrowRecords: ' . $conn->error . '</p>'; 
}

?>
