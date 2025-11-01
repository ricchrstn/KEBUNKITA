<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">
            Tentang Tim Kami
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- Bagian Header Halaman --}}
            <section class="bg-card p-10 rounded-2xl border border-border shadow-md text-center">
                <h1 class="text-4xl font-extrabold text-foreground tracking-tight">
                    Kenali Tim di Balik Aplikasi <span class="text-primary">Kebunkita</span>
                </h1>
                <p class="mt-5 text-lg text-muted-foreground max-w-3xl mx-auto leading-relaxed">
                    <strong>Kebunkita</strong> merupakan aplikasi berbasis web yang berfungsi sebagai 
                    <em>Sistem Pemantauan Cuaca, Berita Pertanian, dan Manajemen Tanaman untuk Para Petani</em>. 
                    Aplikasi ini dikembangkan untuk membantu petani dalam mengambil keputusan yang lebih tepat dan efisien 
                    dengan dukungan data cuaca terkini, informasi pertanian terbaru, serta sistem pengelolaan tanaman yang terintegrasi.
                </p>
            </section>

            {{-- Grid Anggota Tim --}}
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($team as $member)
                    <div
                        class="bg-card border border-border rounded-xl p-6 text-center shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
                        <div class="mx-auto h-32 w-32 rounded-full mb-4 overflow-hidden ring-2 ring-primary/40">
                            <img class="object-cover h-full w-full" src="{{ $member['imageUrl'] }}"
                                alt="Foto {{ $member['name'] }}">
                        </div>
                        <h3 class="text-xl font-semibold text-foreground">{{ $member['name'] }}</h3>
                        <p class="text-sm text-primary font-medium mt-1">{{ $member['role'] }}</p>
                        @if (!empty($member['instagramUrl']))
                            <div class="mt-4 flex justify-center">
                                <a href="{{ $member['instagramUrl'] }}" target="_blank"
                                    class="text-muted-foreground hover:text-primary transition-colors duration-200"
                                    aria-label="Instagram">
                                    {{-- Ikon Instagram --}}
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.337 3.608 1.312.975.975 1.25 2.242 1.312 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.337 2.633-1.312 3.608-.975.975-2.242 1.25-3.608 1.312-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.337-3.608-1.312-.975-.975-1.25-2.242-1.312-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.85c.062-1.366.337-2.633 1.312-3.608.975-.975 2.242-1.25 3.608-1.312C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.741 0 8.332.013 7.052.072 5.775.131 4.608.402 3.64 1.37 2.671 2.339 2.4 3.506 2.341 4.783 2.282 6.063 2.269 6.472 2.269 9.731v4.538c0 3.259.013 3.668.072 4.948.059 1.277.33 2.444 1.299 3.412.969.969 2.136 1.24 3.412 1.299 1.28.059 1.689.072 4.948.072s3.668-.013 4.948-.072c1.277-.059 2.444-.33 3.412-1.299.969-.969 1.24-2.136 1.299-3.412.059-1.28.072-1.689.072-4.948V9.731c0-3.259-.013-3.668-.072-4.948-.059-1.277-.33-2.444-1.299-3.412C19.392.402 18.225.131 16.948.072 15.668.013 15.259 0 12 0z" />
                                        <path
                                            d="M12 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zm0 10.162a3.999 3.999 0 1 1 0-7.998 3.999 3.999 0 0 1 0 7.998zm6.406-11.845a1.44 1.44 0 1 0 0 2.88 1.44 1.44 0 0 0 0-2.88z" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </section>

            {{-- Bagian Kampus --}}
            <section class="bg-card p-10 rounded-2xl border border-border shadow-md text-center">
                <h2 class="text-3xl font-extrabold text-foreground">
                    Dikembangkan oleh Mahasiswa <span class="text-primary">Telkom University Purwokerto</span>
                </h2>
                <p class="mt-5 text-lg text-muted-foreground max-w-3xl mx-auto leading-relaxed">
                    Aplikasi ini dikembangkan sebagai bagian dari mata kuliah 
                    <em>Implementasi dan Pengujian Perangkat Lunak</em>, 
                    dengan tujuan untuk menerapkan teknologi digital dalam peningkatan produktivitas pertanian 
                    serta penyediaan informasi yang relevan bagi para petani di seluruh Indonesia.
                </p>
                <a href="https://purwokerto.telkomuniversity.ac.id/" target="_blank"
                    class="inline-block bg-primary text-primary-foreground font-semibold py-3 px-6 rounded-lg mt-6 hover:bg-primary/90 focus:ring-4 focus:ring-primary/40 transition-transform duration-300 hover:scale-105">
                    Kunjungi Website Kampus
                </a>
            </section>
        </div>
    </div>
</x-app-layout>
