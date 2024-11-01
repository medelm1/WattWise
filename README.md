# WattWise - Energy Consumption Estimator

A web application to estimate the energy consumption in a household. The app allows users to list electrical devices, specify their power ratings and usage hours, and calculate the daily and monthly energy consumption.

## Features

- List electrical devices and their power ratings
- Estimate daily and monthly energy consumption
- API endpoints for CRUD operations on appliances
- Frontend interface to interact with the API

## Technologies

- Backend: Laravel 11
- Frontend: Vue.js 3
- State Management: Pinia
- Database: MySQL
- Build Tool: Vite
- Styling: PrimeVue v4
- HTTP Client: Axios

## Getting Started

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js and npm
- MySQL

## Installation Instructions

### 1. Clone the repository:

```bash
git clone https://github.com/medelm1/WattWise
cd WattWise
```
### 2. Install Backend Dependencies:

```bash
composer install
```

### 3. Set Up Environment:

Copy `.env.example` to `.env` and update the database configuration and other necessary settings.

```bash
cp .env.example .env
```

### 4. Generate Application Key:

```bash
php artisan key:generate
```

### 5. Run Migrations:

```bash
php artisan migrate
```

### 6. Install Frontend Dependencies:

```bash
npm install
```

### 7. Run the Development Server:

```bash
npm run dev
```

### 8. Start the Backend Server:

```bash
php artisan serve
```

Now your application should be running at `http://localhost:8000`.

## Contributing

Contributions are welcome! If you would like to contribute to the project, please follow these steps:

### 1. Fork the repository.
### 2. Create a new branch for your feature or bug fix:

```bash
git checkout -b feature/my-feature
```

### 3. Make your changes and commit them:

```bash
git commit -m "Add my feature"
```

### 4. Push to the branch:

```bash
git push origin feature/my-feature
```

### 5. Open a Pull Request and describe your changes.

Thank you for contributing!
