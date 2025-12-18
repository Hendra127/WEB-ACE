<nav class="fixed top-0 left-0 w-full z-50 bg-white border-b border-gray-200 transition-transform duration-300" id="navbar">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-3 px-6">

        <!-- LEFT: LOGO + TEXT -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logoace.png') }}" alt="Logo" class="h-16 w-16 object-contain">

            <div class="leading-tight">
                <p class="font-bold text-[13px] text-gray-800 uppercase">
                    ASOSIASI CHIEF ENGINEER LOMBOK
                </p>
                <p class="text-[11px] text-gray-600 uppercase tracking-wide">
                    LOMBOK Chief Engineers Association
                </p>
            </div>
        </div>

        <!-- CENTER: MENU -->
        <ul class="hidden md:flex items-center gap-6 font-semibold">
            <li>
                <a href="{{ route('home') }}" class="text-[13px] text-[#1f2a44] hover:text-yellow-500">
                    HOME
                </a>
            </li>

            <li>
                <a href="{{ route('aboutus') }}" class="text-[13px] text-[#1f2a44] hover:text-yellow-500">
                    ABOUT
                </a>
            </li>

            <li class="relative group">
                <button class="text-[13px] text-[#1f2a44] hover:text-yellow-500 flex items-center gap-1">
                    STRUKTUR ORGANISASI
                    <span>▾</span>
                </button>
                <ul class="absolute hidden group-hover:block bg-white shadow-md border mt-1 w-40">
                    <li><a class="block px-4 py-2 text-sm hover:bg-gray-100" href="{{ route('pembina') }}">PEMBINA</a></li>
                    <li><a class="block px-4 py-2 text-sm hover:bg-gray-100" href="{{ route('pengurus') }}">PENGURUS</a></li>
                </ul>
            </li>

            <a href="{{ route('galeri') }}" class="text-[13px] text-[#1f2a44] hover:text-yellow-500">
                    GALLERY
            </a>

            <li class="relative group">
                <button class="text-[13px] text-[#1f2a44] hover:text-yellow-500 flex items-center gap-1">
                    EVENT
                    <span>▾</span>
                </button>
                <ul class="absolute hidden group-hover:block bg-white shadow-md border mt-1 w-40">
                    <li><a class="block px-4 py-2 text-sm hover:bg-gray-100" href="{{ route('upcoming-event') }}">UPCOMING-EVENT</a></li>
                    <li><a class="block px-4 py-2 text-sm hover:bg-gray-100" href="#">PELATIHAN</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ route('artikel') }}" class="text-[13px] text-[#1f2a44] hover:text-yellow-500">
                    ARTIKEL
                </a>
            </li>
            <li><a href="{{ route('lowongan') }}" class="text-[13px] text-[#1f2a44] hover:text-yellow-500">LOWONGAN</a></li>
            <li>
                <a href="{{ route('mitrakami') }}" class="text-[13px] text-[#1f2a44] hover:text-yellow-500">
                    MITRA
                </a>
            </li>
        </ul>

        <!-- RIGHT: BUTTON -->
        <a href="#daftar"
           class="hidden md:block bg-[#1e324c] text-white px-6 py-4 text-[12px] font-bold tracking-wider">
            DAFTAR ANGGOTA
        </a>

        <!-- MOBILE MENU BUTTON -->
        <button id="mobileMenuBtn" class="md:hidden text-gray-700 text-3xl z-50 relative">☰</button>

        <!-- MOBILE DROPDOWN MENU -->
        <div id="mobileMenu" class="hidden absolute top-full left-0 w-full bg-white shadow-md border-t">
            <ul class="flex flex-col text-left p-4 font-semibold">
                <li><a href="{{ route('home') }}" class="py-2 block">HOME</a></li>
                <li><a href="{{ route('aboutus') }}" class="py-2 block">ABOUT</a></li>

                <li class="py-2">
                    <button type="button"
                        class="w-full text-left flex justify-between items-center py-2"
                        aria-expanded="true"
                        onclick="(function(btn){ const sub = btn.nextElementSibling; sub.classList.toggle('hidden'); btn.setAttribute('aria-expanded', !sub.classList.contains('hidden')); btn.querySelector('span').textContent = sub.classList.contains('hidden') ? '▾' : '▴'; })(this)">
                        STRUKTUR ORGANISASI <span>▾</span>
                    </button>
                    <ul class="pl-4">
                        <li><a href="{{ route('pembina') }}" class="py-2 block">PEMBINA</a></li>
                        <li><a href="{{ route('pengurus') }}" class="py-2 block">PENGURUS</a></li>
                    </ul>
                </li>

                <li class="py-2">
                    <button type="button"
                        class="w-full text-left flex justify-between items-center py-2"
                        aria-expanded="true"
                        onclick="(function(btn){ const sub = btn.nextElementSibling; sub.classList.toggle('hidden'); btn.setAttribute('aria-expanded', !sub.classList.contains('hidden')); btn.querySelector('span').textContent = sub.classList.contains('hidden') ? '▾' : '▴'; })(this)">
                        EVENT <span>▾</span>
                    </button>
                    <ul class="pl-4">
                        <li><a href="{{ route('upcoming-event') }}" class="py-2 block">KEGIATAN</a></li>
                        <li><a href="#" class="py-2 block">PelatPELATIHAN</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('galeri') }}" class="py-2 block">GALLERY</a></li>
                <li><a href="{{ route('artikel') }}" class="py-2 block">ARTIKEL</a></li>
                <li><a href="{{ route('lowongan') }}" class="py-2 block">LOWONGAN</a></li>
                <li><a href="{{ route('mitrakami') }}" class="py-2 block">MITRA</a></li>

                <li>
                    <a href="#daftar" class="py-3 block text-center bg-[#1e324c] text-white font-bold mt-2">
                        DAFTAR ANGGOTA
                    </a>
                </li>
            </ul>
        </div>

        <script>
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');

            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });

            // Close menu when a link is clicked
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                });
            });
        </script>

    </div>
</nav>

<script>
    let lastScrollTop = 0;
    const navbar = document.getElementById('navbar');

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            // Scroll Down
            navbar.style.transform = 'translateY(-100%)';
        } else {
            // Scroll Up
            navbar.style.transform = 'translateY(0)';
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });
</script>
