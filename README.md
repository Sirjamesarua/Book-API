# LARAVEL/PHP API CRUD ASSESSMENTS

### Features

- **Authentication**: User registration, login, and logout.
- **Laravel Sanctum**: API token-based authentication.
- **Policy**: Authorization using policies.
- **RESTful API**: Create, read, update, and delete posts.

### Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/Sirjamesarua/laravel-crud-api.git
   cd laravel-api-crud
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
    - `POST /api/register` – Register a new user.
    - `POST /api/login` – Log in a user and retrieve a token.
    - `POST /api/logout` – Log out the authenticated user.

- **Posts**
    - `GET /api/posts` – List all posts.
    - `GET /api/my-posts` – List all owned posts.
    - `GET /api/posts/{id}` – Show a single post.
    - `POST /api/posts` – Create a new post.
    - `PUT /api/posts/{id}` – Update an post.
    - `DELETE /api/posts/{id}` – Delete an post.

- **Activities Logs**
    - `GET /api/activity-logs` – List all activities.
  
### Support

If you have any questions or need further assistance, please don't hesitate to [contact me](08140480701).
