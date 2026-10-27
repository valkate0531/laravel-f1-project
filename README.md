# Laravel F1 Project

This repository contains two applications:

- `laravel-f1-project` - Laravel API backend
- `react-frontend` - React/Vite post interface

## Run locally

Start the API:

```powershell
cd laravel-f1-project
php artisan serve --host=127.0.0.1 --port=8000
```

Start the frontend in a second terminal:

```powershell
cd react-frontend
npm install
npm run dev
```

The post interface uses the Laravel endpoints under `/api/posts`.
