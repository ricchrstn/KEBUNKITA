# start-demo.ps1 - helper to prepare app for recording
# Usage: Open PowerShell in project root and run: .\demo\start-demo.ps1

Write-Output "Building frontend assets..."
if (Test-Path package.json) {
    npm run build
} else {
    Write-Output "No package.json found — skipping asset build."
}

Write-Output "Clearing Laravel caches..."
php artisan config:clear
php artisan cache:clear

Write-Output "Starting Laravel dev server (background)..."
# Start server in new window
Start-Process -FilePath "php" -ArgumentList "artisan","serve","--host=127.0.0.1","--port=8000"
Start-Sleep -Seconds 2

Write-Output "Opening browser to http://127.0.0.1:8000"
Start-Process "http://127.0.0.1:8000"

# Attempt to open key files in VS Code (optional)
if (Get-Command code -ErrorAction SilentlyContinue) {
    Write-Output "Opening files in VS Code..."
    code resources/views/home.blade.php
    code resources/views/tanaman/index.blade.php
    code resources/css/app.css
    code app/Http/Controllers/HomeController.php
} else {
    Write-Output "VS Code CLI ('code') not found. Open files manually if you want to show source code during recording."
}

Write-Output "Ready for recording. Follow demo/scenes.md for the script."
