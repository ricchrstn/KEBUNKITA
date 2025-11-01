<svg xmlns="http://www.w3.org/2000/svg" {{ $attributes }} viewBox="0 0 160 40">
    <!-- Icon Container -->
    <g transform="translate(10, 5)">
        <!-- Rumah/Kebun Base -->
        <path d="M20 30 L35 15 L50 30 L45 30 L45 35 L25 35 L25 30 Z" 
            class="text-primary"
            fill="currentColor"/>

        <!-- Daun Kiri -->
        <path d="M30 25 C25 20 30 15 35 20 C35 15 40 20 35 25" 
            fill="currentColor"
            class="text-primary/80"/>

        <!-- Daun Kanan -->
        <path d="M40 25 C45 20 40 15 35 20 C35 15 30 20 35 25" 
            fill="currentColor"
            class="text-primary/80"/>

        <!-- Tunas Tengah -->
        <path d="M35 22 L35 12 C35 8 38 10 35 6 C32 10 35 8 35 12" 
            fill="currentColor"
            class="text-primary"/>
    </g>

    <!-- Text "KebunKita" -->
    <text x="70" y="28" 
        font-family="Inter, sans-serif" 
        font-weight="700"
        font-size="20"
        class="text-foreground">
        Kebun<tspan fill="#059669">Kita</tspan>
    </text>

    <!-- Subtitle -->
    <text x="70" y="38"
        font-family="Inter, sans-serif"
        font-size="10"
        class="text-muted-foreground">
        Tumbuh Bersama
    </text>
</svg>
