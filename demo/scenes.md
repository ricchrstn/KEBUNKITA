Scene list and suggested narration (use as script)

Scene 1 — Intro & Site Landing (20–30s)
- Action: Open browser to http://127.0.0.1:8000 (or your local host)
- Narration: "Ini KebunKita — dashboard sederhana untuk memantau tanaman, cuaca, dan berita pertanian. Saya akan tunjukkan UI dan sebagian kode yang menjalankannya."
- Files to open after UI: `resources/views/home.blade.php` (show guest/anon version)

Scene 2 — Hero & CTA (20–30s)
- Action: Show hero section, click CTA (if links available)
- Narration: "Hero area dirancang untuk menarik pengguna baru dan menonjolkan panggilan aksi. Sekarang saya buka file blade yang mengatur tampilan ini."
- Files: `resources/views/home.blade.php` — highlight hero markup and Tailwind classes

Scene 3 — News / Articles (20–30s)
- Action: Show article cards (or empty state)
- Narration: "Berita ditampilkan menggunakan komponen kartu. Komponen ini bisa digunakan ulang di beberapa tempat."
- Files: `resources/views/components/article-card.blade.php` or `resources/views/components/*`

Scene 4 — Weather Forecast component (30–45s)
- Action: Navigate to tanaman page (weather forecast horizontal layout)
- Narration: "Bagian cuaca menampilkan jam per jam secara horizontal untuk kemudahan baca. Saya buka file yang mengatur layout ini."
- Files: `resources/views/tanaman/index.blade.php`, `resources/js/...` (if relevant)

Scene 5 — Controller & Data (30s)
- Action: Open `app/Http/Controllers/HomeController.php`
- Narration: "Data diambil oleh controller — misalnya artikel, statistik, dan data cuaca. Inilah bagaimana backend menyiapkan data untuk tampilan."

Scene 6 — Seeder / Factory (20–30s)
- Action: Open `database/seeders/DatabaseSeeder.php` and `database/factories/UserFactory.php`
- Narration: "Untuk demo saya menyiapkan seed sehingga halaman penuh konten. Inilah bagaimana saya membuat data contoh."

Scene 7 — Quick code walk: component implementation (45–60s)
- Action: Choose one component (article-card or weather item) and walk through blade + styles + small JS (if any)
- Narration: "Sekarang kita lihat lebih dalam pada komponen: struktur, styling Tailwind, dan interaksi kecil."

Scene 8 — Deployment note (30s)
- Action: Show `.env` snippet (redact secrets) and `public/index.php` path change
- Narration: "Untuk hosting di shared host (InfinityFree), saya menyesuaikan `index.php` dan `.env` — jangan upload secrets ke repo."

Scene 9 — Closing (15–20s)
- Action: Return to UI, summary
- Narration: "Itu demo singkat KebunKita — UI yang sederhana, komponen yang bisa di-reuse, dan arsitektur Laravel standar. Terima kasih." 

Timing & recording tips
- Keep each scene short and focused; aim total demo 4–6 minutes.
- Use zoom or highlight mouse for clarity when pointing at small code.
- If showing secrets, blur or redact them in post-production.

Optional extras (if you want longer demo)
- Show editing a component and live-reloading (npm run dev)
- Show simple API call (weather) with Chrome DevTools network tab
