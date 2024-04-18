<div id="sidebar" class="fixed md:sticky top-0 -left-full opacity-0 md:opacity-100 md:left-0 w-full md:w-60 z-50 h-screen bg-neutral-100 dark:bg-neutral-900 transition-all duration-500
    flex flex-shrink-0 flex-col gap-8 md:border-r border-transparent md:hover:border-neutral-200 dark:md:hover:border-r-neutral-800 md:hover:shadow-lg">
    <div class="w-full p-4 md:py-6 flex justify-between gap-2 md:justify-center items-center text-black dark:text-white">
        <p class="text-3xl md:text-4xl font-bold">MUSCLE MAX 💪🏼</p>
        <button type="button" class="sidebar-toggle-button md:hidden">
            @svg("heroicon-s-x-mark", 'w-6 h-6')
        </button>
    </div>

    <div class="w-full flex flex-col gap-3 md:gap-2 px-4 md:p-0 overflow-y-auto">
        @include('components.dashboard.sidebar-item.default', [
            'url' => route('home'),
            'current' => request()->routeIs('home'),
            'label' => "Statistiques",
            'icon' => 'chart-pie',
        ])

        @include('components.dashboard.sidebar-item.default', [
            'url' => route('home'),
            'current' => request()->routeIs('home'),
            'label' => "Paramètres",
            'icon' => 'cog-6-tooth'
        ])
    </div>

    <div class="w-full flex flex-col gap-1 mt-auto pb-3 px-4 md:px-0">
        @include('components.dashboard.sidebar-item.default', [
            'url' => route('logout'),
            'label' => "Déconnexion",
            'icon' => 'arrow-left-end-on-rectangle'
        ])
    </div>
</div>

@push('page.scripts')
    <script type="module">
        function toggleSidebar()
        {
            $('#sidebar').toggleClass('-left-full opacity-0 left-0');
            $('main').toggleClass('right-0 -right-full opacity-0');
        }

        $('.sidebar-toggle-button').on('click', function () {
            toggleSidebar();
        });
    </script>
@endpush