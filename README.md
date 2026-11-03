# CineSphere – Movie Review & Rating Platform

CineSphere is a full-stack web application designed to provide an interactive platform for discovering, reviewing, and rating movies.

Built with **Laravel and PHP**, the application allows users to explore a movie catalog, share their opinions, rate movies, and interact with other users through comments and voting features.

The project was initially developed using MySQL and later migrated to **MongoDB**, while preserving the existing frontend functionality.

## Key Features

### User Management & Authentication
- User registration, login, and logout.
- Profile management and account updates.
- Role-based access control with administrator privileges.

### Movie Management
- Browse and explore the movie catalog.
- Search and filter movies.
- View detailed movie information.
- Administrative movie management (Create, Read, Update, Delete).

### Reviews & Ratings
- Post comments and reviews on movies.
- Rate movies on a scale from 0 to 10.
- Like and dislike comments.
- Manage and moderate user-generated content.

### Administration
- Dedicated administrator privileges.
- Manage movie records.
- Moderate comments and user-generated content.

## Technology Stack

| Category | Technologies |
|---|---|
| Backend | PHP, Laravel |
| Database | MongoDB |
| Database Integration | Laravel Eloquent, mongodb/laravel-mongodb (formerly jenssegers/mongodb) |
| Frontend | HTML5, CSS3, JavaScript, Blade |
| Package Management | Composer, NPM |
| Architecture | MVC (Model-View-Controller) |

## Database Migration: MySQL to MongoDB

One of the main technical aspects of this project was migrating the database from MySQL to MongoDB.

The migration involved:
- Replacing the relational database with MongoDB (NoSQL).
- Integrating MongoDB through the `mongodb/laravel-mongodb` package (formerly `jenssegers/mongodb`).
- Adapting Eloquent models to work with MongoDB collections.
- Preserving the existing frontend and application functionality.

MongoDB collections are created automatically when documents are first inserted. Database indexes can be initialized through Laravel migrations.

## Project Architecture

The application follows the **MVC architecture** provided by Laravel:

- **Models:** Handle database interactions and application data.
- **Views:** Render the user interface using Blade templates.
- **Controllers:** Manage application logic and HTTP requests.
- **Routes:** Define application endpoints and navigation.

## Installation & Setup

### Prerequisites

Make sure you have the following installed:

- PHP
- Composer
- Node.js and NPM
- MongoDB Server
- Git

### 1. Clone the repository

```bash
git clone https://github.com/yazidixon/cinesphere.git
cd cinesphere
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Configure environment variables

Copy the example environment file:

```bash
cp .env.example .env
```

On Windows PowerShell, you can use:

```powershell
Copy-Item .env.example .env
```

Configure your MongoDB connection in `.env`:

```env
DB_CONNECTION=mongodb
DB_HOST=127.0.0.1
DB_PORT=27017
DB_DATABASE=cinesphere
DB_USERNAME=
DB_PASSWORD=
```

Make sure MongoDB is running locally or that your connection settings point to an accessible MongoDB instance.

Sessions and cache are stored in files:

```env
SESSION_DRIVER=file
CACHE_STORE=file
```

To enable the OMDb movie search, add your [OMDb API key](https://www.omdbapi.com/apikey.aspx):

```env
OMDB_API_KEY=your_api_key
```

### 4. Generate the application key

```bash
php artisan key:generate
```

### 5. Initialize database indexes

```bash
php artisan migrate
```

This step is used to initialize the database indexes defined by the project migrations.

### 6. Seed the movie catalog

```bash
php artisan db:seed --class=MovieSeeder
```

This adds a set of sample movies to the catalog.

### 7. Build frontend assets

```bash
npm run build
```

### 8. Start the application

```bash
php artisan serve
```

Access the application at:

`http://127.0.0.1:8000`

## Project Highlights

- Full-stack web application development using Laravel.
- Implementation of authentication and role-based authorization.
- Database design and integration with MongoDB.
- Migration from a relational database (MySQL) to a NoSQL database (MongoDB).
- Implementation of CRUD operations and content moderation.
- Development of interactive movie review and rating features.

## Author

**Yazid Zoubaidi**

Engineering Student – Digital Development & Information Systems

- GitHub: [@yazidixon](https://github.com/yazidixon)
- LinkedIn: [Yazid Zoubaidi](https://linkedin.com/in/yazid-zoubaidi)

---

*Developed as part of a web development project.*
