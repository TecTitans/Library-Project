<?php
// Database connection settings
$host = "127.0.0.1";
$username = "root";
$password = '';
$database = "librarydb";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add a new book
    if (isset($_POST['name']) && isset($_POST['number']) && isset($_POST['author']) && isset($_POST['publishDate'])) {
        $bookName = $_POST['name'];
        $authorName = $_POST['author'];
        $bookNumber = $_POST['number'];
        $publishingDate = $_POST['publishDate'];

        $sql = "INSERT INTO book (name ,author,number,publishDate) VALUES ('$bookName', '$authorName', $bookNumber, '$publishingDate')";
        if ($conn->query($sql) === TRUE) {
            echo "Book added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Retrieve books from the database
$books = array();
$result = $conn->query("SELECT * FROM book");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    
    
    <title>Library</title>
</head>
<body>
    <div class="container">
        <h1>Library</h1>
        
        <!-- Add a Book Form -->
        <h2>Add a Book</h2>
        <form id="add-book-form">
            <input type="text" id="book-name" placeholder="Book Name" required>
            <input type="text" id="author-name" placeholder="Author Name" required>
            <input type="number" id="book-number" placeholder="Book Number" required>
            <input type="date" id="publishing-date" required>
            <button type="button" id="add-book-button" required>Add Book</button>
        </form>

        <!-- Search for Books -->
        <h2>Search for Books</h2>
        <input type="text" id="search-query" placeholder="Search">
        <button type="button" id="search-button">Search</button>

        <!-- Books Table -->
        <h2>Books</h2>
        <table>
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Author Name</th>
                    <th>Book Number</th>
                    <th>Publishing Date</th>
                </tr>
            </thead>
            <tbody id="book-list">
                <!-- Book items will be added here using JavaScript -->
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>
</html>




