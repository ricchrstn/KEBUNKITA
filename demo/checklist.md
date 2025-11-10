Pre-recording checklist

1) Install dependencies (if not already):
   - composer install
   - npm install

2) Build frontend assets (optional real-time edit):
   - npm run build
   - or npm run dev if you want HMR during recording

3) Prepare database (optional):
   - php artisan migrate --seed
   - or import a small dump via phpMyAdmin

4) Ensure writable storage:
   - storage/ and bootstrap/cache are writable by the web server

5) Start server and open editor (helper script available):
   - PowerShell: .\demo\start-demo.ps1

6) Recording tips:
   - Use 1080p@30fps for screen recordings.
   - Keep mouse cursor smooth and avoid long idle periods.
   - Narration: Short sentences, explain what you click and why, then show the code that implements it.

Files to keep ready in editor:
- resources/views/home.blade.php
- resources/views/components/article-card.blade.php (if present)
- resources/views/tanaman/index.blade.php (weather forecast)
- resources/css/app.css
- app/Http/Controllers/HomeController.php
- database/seeders/DatabaseSeeder.php
- database/factories/UserFactory.php

Record each scene twice: once with voice, once without (backup).