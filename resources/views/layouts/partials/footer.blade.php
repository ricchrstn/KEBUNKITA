{{-- resources/views/layouts/partials/footer.blade.php --}}
<footer class="bg-card border-t border-border mt-auto">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            {{-- Bagian Kiri: Logo & Copyright --}}
            <div class="flex justify-center md:order-1">
                <div class="text-center md:text-left">
                    <a href="{{ route('home') }}" class="inline-flex items-center space-x-2">
                        <img src="{{ asset('img/Modern Logo with House and Leaf Emblem.png') }}" alt="KebunKita Logo"
                            class="h-6 w-6 mx-auto md:mx-0">
                        <span class="text-lg font-bold text-primary">KebunKita</span>
                    </a>
                    <p class="mt-2 text-center text-sm text-muted-foreground">
                        © {{ date('Y') }} KebunKita. <span class="hidden sm:inline">|</span> <br class="sm:hidden">
                        Membangun Masa Depan Pertanian Bersama
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
