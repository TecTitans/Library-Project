// Sample data structure to store books
const books = [];

document.addEventListener("DOMContentLoaded", function () {
    const addBookButton = document.getElementById("add-book-button");
    const searchButton = document.getElementById("search-button");
    const bookList = document.getElementById("book-list");

    addBookButton.addEventListener("click", function () {
        // Get input values
        const bookName = document.getElementById("book-name").value;
        const authorName = document.getElementById("author-name").value;
        const bookNumber = document.getElementById("book-number").value;
        const publishingDate = document.getElementById("publishing-date").value;

        // Create a new book object
        const newBook = {
            bookName,
            authorName,
            bookNumber,
            publishingDate,
        };

        // Add the new book to the data structure and update the table
        books.push(newBook);
        displayBooks();
    });

    searchButton.addEventListener("click", function () {
        // Get the search query
        const searchQuery = document.getElementById("search-query").value;

        // Implement search logic and update the table based on the search query
        const searchResults = books.filter(book => {
            return (
                book.bookName.includes(searchQuery) ||
                book.authorName.includes(searchQuery) ||
                book.bookNumber.toString().includes(searchQuery) ||
                book.publishingDate.includes(searchQuery)
            );
        });

        displayBooks(searchResults);
    });

    function displayBooks(bookArray = books) {
        // Clear the table
        bookList.innerHTML = "";

        // Populate the table with books
        bookArray.forEach(book => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${book.bookName}</td>
                <td>${book.authorName}</td>
                <td>${book.bookNumber}</td>
                <td>${book.publishingDate}</td>
            `;
            bookList.appendChild(row);
        });
    }

    // Initial display of books
    displayBooks();
});

document.addEventListener("DOMContentLoaded", function () {
    const addBookButton = document.getElementById("add-book-button");
    const searchButton = document.getElementById("search-button");
    const bookList = document.getElementById("book-list");

    addBookButton.addEventListener("click", function () {
        // Get input values
        const bookName = document.getElementById("book-name").value;
        const authorName = document.getElementById("author-name").value;
        const bookNumber = document.getElementById("book-number").value;
        const publishingDate = document.getElementById("publishing-date").value;

        // Check if all fields are filled
        if (!bookName || !authorName || !bookNumber || !publishingDate) {
            alert("Please fill in all the book information.");
            return;
        }

        // Create a new book object
        const newBook = {
            bookName,
            authorName,
            bookNumber,
            publishingDate,
        };

        // Add the new book to the data structure and update the table
        books.push(newBook);
        displayBooks();

        // Clear the input fields
        document.getElementById("book-name").value = '';
        document.getElementById("author-name").value = '';
        document.getElementById("book-number").value = '';
        document.getElementById("publishing-date").value = '';
    });

    // ... Rest of your JavaScript code

});
