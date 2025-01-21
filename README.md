# LARAVEL BOOK API

### Features

- **RESTful API**: Create, read, update, and delete books, register as author, fetch authors with their books.

### Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/Sirjamesarua/Book-API.git
   cd Book-api
   ```

**Setting the Application**
   ```bash
   composer install
   ```

   ```bash
   cp .env.example .env
   ```

   ```bash
   php artisan key:generate
   ```

   ```bash
   php artisan migrate
   ```

### Running the Application

**Serve the Application**
   ```bash
   php artisan serve
   ```

### API Endpoints

- **Authentication**
    - `POST /api/register` – Register a new author.
    - `POST /api/login` – Log in a author and retrieve a token.
    - `POST /api/logout` – Log out the authenticated author.

- **Books**
    - `GET /api/books` – List all books.
    - `GET /api/books/{id}` – Fetch book details with author information.
    - `POST /api/books` – Create a new book.
    - `PUT /api/books/{id}` – Update a book.
    - `DELETE /api/books/{id}` – Delete a book.

  
### Support

If you have any questions or need further assistance, please don't hesitate to [contact me](08140480701).
