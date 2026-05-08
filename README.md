# 🎮 Gaming Community (In Progress)

A social platform for gamers built with **Laravel 12** and **Livewire 3**. Connect with other players, share your experiences, follow your favourite gamers, and unlock achievements as you engage with the community.

---

## ✨ Features

### 👥 Social
- User registration and login
- Customisable profiles with avatar, banner, and bio
- Followers / following system
- Real-time presence indicator (online/offline)
- Direct messaging between users

### 📝 Content
- Real-time post feed with live updates (Livewire)
- Create, view, and comment on posts
- Like system
- Tags on posts
- Global search for users and content

### 🕹️ Games
- Game library
- Users can link games to their profile
- Game selector when creating posts

### 🏆 Gamification
- XP and level system (quadratic progression)
- User reputation
- Unlockable achievements based on activity:

| Achievement | Type | Requirement | XP |
|---|---|---|---|
| First Post | Posts | 1 post | 10 |
| Content Creator | Posts | 10 posts | 50 |
| Prolific Writer | Posts | 50 posts | 150 |
| Liked! | Likes received | 10 | 20 |
| Popular Post | Likes received | 100 | 100 |
| Getting Followers | Followers | 5 | 20 |
| Influencer | Followers | 50 | 200 |
| Social Starter | Following | 5 | 10 |
| Network Builder | Following | 20 | 50 |
| First Comment | Comments | 1 | 5 |
| Conversationalist | Comments | 25 | 80 |
| Rising Star | Reputation | 100 | 50 |
| Legend | Reputation | 1000 | 500 |

### 🔔 Notifications
- Real-time notifications (bell icon)
- Events: new follower, like, comment, achievement unlocked, level up

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.2+, Laravel 12 |
| Reactive frontend | Livewire 3 |
| Database | SQLite (default) / MySQL |
| Queues & cache | Database driver |
| Frontend build | Vite + NPM |
| Testing | PHPUnit 11 |

---

## 🚀 Installation

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & NPM

### Quick start

```bash
# 1. Clone the repository
git clone https://github.com/your-username/gaming-community.git
cd gaming-community/app

# 2. One-command setup (installs dependencies, sets up .env, runs migrations, builds assets)
composer run setup

# 3. (Optional) Seed the database with sample data
php artisan db:seed
```

### Manual setup (step by step)

```bash
# Install PHP dependencies
composer install

# Create the environment file
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Install JS dependencies and build assets
npm install
npm run build
```

---

## ▶️ Local Development

```bash
composer run dev
```

This command runs the following processes in parallel:
- `php artisan serve` — web server
- `php artisan queue:listen` — queue worker (events & notifications)
- `php artisan pail` — real-time log viewer
- `npm run dev` — Vite with hot reload

The app will be available at [http://localhost:8000](http://localhost:8000).

---

## ⚙️ Environment Variables

Copy `.env.example` to `.env` and adjust as needed:

```env
APP_NAME=GamingCommunity
APP_URL=http://localhost

# Database (SQLite by default, uncomment for MySQL)
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=gaming_community
# DB_USERNAME=root
# DB_PASSWORD=

# Job queue
QUEUE_CONNECTION=database
```

---

## 🗂️ Project Structure

```
app/
├── app/
│   ├── Events/          # Domain events (post, like, follow, achievements...)
│   ├── Listeners/       # Event handlers
│   ├── Http/
│   │   ├── Controllers/ # Auth, Posts, Comments, Games, Users...
│   │   └── Middleware/  # UpdateLastSeen (online presence)
│   ├── Livewire/        # Reactive components
│   │   ├── Achievements/
│   │   ├── Feed/
│   │   ├── Games/
│   │   ├── Interactions/
│   │   ├── Notifications/
│   │   └── Users/
│   └── Models/          # User, Post, Comment, Like, Follow, Game, Achievement...
├── database/
│   ├── migrations/      # Database schema
│   └── seeders/         # Sample data
└── resources/views/     # Blade templates
```

---

## 🧪 Tests

```bash
composer run test
```

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).
