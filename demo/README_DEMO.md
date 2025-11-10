Demo plan for KebunKita frontend

Purpose

This folder helps you record a short demo video that shows the front-end UI and the source code behind it. The goal: a short, focused recording demonstrating the user experience and the implementation (no slides).

Files in this folder

- checklist.md  — pre-recording checklist and quick commands
- scenes.md     — ordered scene list with recommended narration and exact files to open
- start-demo.ps1 — helper PowerShell script to build assets, run server and open browser/editor

How to use

1. Prepare environment:
   - Make sure dependencies are installed locally (composer install, npm install).
   - Ensure database is seeded (optional) so UI shows content: php artisan migrate --seed
   - Make sure `storage/` and `bootstrap/cache` are writable.

2. Run the helper script (PowerShell):
   - Open PowerShell in project root and run:
     .\demo\start-demo.ps1
   - This will build assets, clear config cache, start php artisan serve and open the site in your browser. It will also attempt to open key files in VS Code.

3. Follow the `scenes.md` file during recording to navigate the site and open files in the code editor at the points indicated.

Notes

- The script uses the `code` CLI to open files in VS Code. If `code` isn't available in PATH, open those files manually.
- For hosting/deploy steps (InfinityFree), follow the steps you already used — but those are not part of the short UI demo.

Good luck recording! Keep each scene short (20–45 seconds) and move with intent: show the UI, then jump to the code that implements it.
