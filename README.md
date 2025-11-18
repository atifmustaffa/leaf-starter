# Leaf PHP Starter Project

This is a starter project built with Leaf PHP. It provides a simple structure to get started quickly with modern PHP development using Leaf's core libraries.

## Main Libraries

- **Leaf Framework**: Handles routing, requests, and app structure.
- **Leaf DB**: Database abstraction.
- **Leaf Auth**: Authentication.
- **Leaf Session**: Session handling.
- **Leaf Form**: Form helpers and validation.
- **Leaf CSRF**: CSRF protection.
- **Leaf Blade**: Templating engine.
- **phpdotenv**: Environment variable management.

## Installation

1. Clone the repository:

```bash
git clone https://github.com/atifmustaffa/leaf-starter.git
```

2. Install dependencies using Composer:

```bash
composer install
```

3. Copy `.env.example` to `.env` and update your environment settings.

## Usage

Use `mydb()` to access database connections.

You can organize helpers, middlewares etc in app/\*/ and include them automatically in your app.

The routes are defined in the `routes.php` file. They are currently basic, but you can improve them in a similar way to how helpers and middleware are structured—by creating reusable route groups, adding route-specific middleware, or building custom route helper functions for cleaner code.

## License

This project is open-sourced under the [MIT License](LICENSE).

