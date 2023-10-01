<?php
// Database connection settings
$host = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add a new book
    if (isset($_POST['bookName']) && isset($_POST['authorName']) && isset($_POST['bookNumber']) && isset($_POST['publishingDate'])) {
        $bookName = $_POST['bookName'];
        $authorName = $_POST['authorName'];
        $bookNumber = $_POST['bookNumber'];
        $publishingDate = $_POST['publishingDate'];

        $sql = "INSERT INTO books (book_name, author_name, book_number, publishing_date) VALUES ('$bookName', '$authorName', $bookNumber, '$publishingDate')";
        if ($conn->query($sql) === TRUE) {
            echo "Book added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Retrieve books from the database
$books = array();
$result = $conn->query("SELECT * FROM books");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-wA5MQ0lw9lqRuGwU2DS5fejqgU6hx4u3bmkj/3/KtZc6zERgXLbY6zvccYlHO7sS" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Library</title>
</head>
<body>
    <div class="container">
        <h1 class="display-4">Library</h1>
        
        <!-- Add a Book Form -->
        <h2>Add a Book</h2>
        <form id="add-book-form">
            <div class="form-group">
                <input type="text" class="form-control" id="book-name" placeholder="Book Name" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="author-name" placeholder="Author Name" required>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" id="book-number" placeholder="Book Number" required>
            </div>
            <div class="form-group">
                <input type="date" class="form-control" id="publishing-date" required>
            </div>
            <button type="button" class="btn btn-primary" id="add-book-button">Add Book</button>
        </form>

        <!-- Search for Books -->
        <h2>Search for Books</h2>
        <div class="input-group">
            <input type="text" class="form-control" id="search-query" placeholder="Search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="search-button">Search</button>
            </div>
        </div>

        <!-- Books Table -->
        <h2>Books</h2>
        <table class="table">
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
    <script src="app.js"></script>
</body>
</html>

