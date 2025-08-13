# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 12 application using Livewire and Flux UI components as a starter kit. The project follows a component-based architecture with Livewire components for interactive features and Blade templates with Flux UI for the frontend.

## Development Commands

### PHP/Laravel Commands
- `composer dev` - Start development environment (runs Laravel server, queue worker, and Vite in parallel)
- `composer test` - Run the test suite (clears config and runs tests)
- `php artisan serve` - Start Laravel development server
- `php artisan test` - Run tests using Artisan
- `./vendor/bin/pest` - Run tests using Pest directly
- `vendor/bin/pint` - Run Laravel Pint for code formatting

### Frontend Commands
- `npm run dev` - Start Vite development server with hot reloading
- `npm run build` - Build assets for production
- `npm install` - Install Node.js dependencies

### Testing
- Tests use Pest framework (configured in `tests/Pest.php`)
- Test suites: Unit tests in `tests/Unit/`, Feature tests in `tests/Feature/`
- PHPUnit configuration in `phpunit.xml` with SQLite in-memory database for testing

## Architecture

### Frontend Stack
- **Livewire Volt**: For reactive components and server-side rendering
- **Flux UI**: Component library for UI elements
- **Tailwind CSS 4**: For styling (configured via Vite plugin)
- **Vite**: Build tool and development server

### Backend Structure
- **Models**: Located in `app/Models/` (standard Laravel location)
- **Livewire Components**: Organized in `app/Livewire/` with subdirectories:
  - `Actions/` - Action components (e.g., Logout)
  - `Auth/` - Authentication components
  - `Settings/` - User settings components
- **Controllers**: Minimal usage, mainly auth controllers in `app/Http/Controllers/`
- **Routes**: Web routes in `routes/web.php`, auth routes in `routes/auth.php`

### View Structure
- **Blade Components**: Located in `resources/views/components/`
- **Layouts**: App layout system with sidebar in `resources/views/components/layouts/`
- **Livewire Views**: Component templates in `resources/views/livewire/`
- **Flux Components**: Custom Flux components in `resources/views/flux/`

### Key Patterns
- Uses Livewire components instead of traditional controllers for most user interactions
- Settings pages are implemented as separate Livewire components (Profile, Password, Appearance)
- Authentication is handled through dedicated Livewire components
- Component-based architecture with reusable Blade components

## Development Environment

### Requirements
- PHP 8.2+
- Node.js (for frontend assets)
- SQLite (used for local database)

### Local Setup
- Copy `.env.example` to `.env`
- Run `php artisan key:generate`
- Database file created automatically at `database/database.sqlite`
- Migrations run automatically during project setup

### CI/CD
- GitHub Actions workflows for testing and linting
- Tests run on PHP 8.4 with Node.js 22
- Requires Flux UI credentials via secrets for CI
- Laravel Pint used for code style enforcement