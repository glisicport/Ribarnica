<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kontrolni Panel')</title>

    @include('common.scripts')

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            900: '#0c4a6e'
                        }
                    }
                }
            }
        }
    </script>

    <link href="{{ asset('assets/css/admin/dashboard.css') }}" rel="stylesheet"/>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-brand-100 selection:text-brand-900">

<input type="checkbox" id="sidebar-toggle" class="hidden">
<label for="sidebar-toggle"
       class="overlay hidden fixed inset-0 bg-slate-900/50 z-40 lg:hidden transition-opacity cursor-pointer"></label>

<div class="flex h-screen overflow-hidden">
    @include('common.sidebar')

    <main class="flex-1 flex flex-col overflow-y-auto bg-slate-50">
        @include('common.admin_topbar')

        <div class="p-6 flex-1 min-h-[calc(100vh-4rem)]">
            <!-- Dynamic Content Based on currentPage Type -->
            @if($currentPage === 'products' || empty($currentPage))
                @include('admin.products.index')
            @elseif($currentPage === 'gallery')
                @include('admin.gallery.index')
            @elseif($currentPage === 'about')
                @include('admin.about_us.index')
            @elseif($currentPage === 'employees')
                @include('admin.employees.index')
            @elseif($currentPage === 'settings')
                @include('admin.settings.index')
            @elseif($currentPage === 'orders')
                @include('admin.orders.index')
            @elseif($currentPage === 'faq')
                @include('admin.contact.partials.faq_table', [
                    'items' => $items ?? []
                ])
            @elseif($currentPage === 'quick-facts')
                @include('admin.contact.partials.quick_facts_table', [
                    'items' => $items ?? []
                ])
            @elseif($currentPage === 'poruke')
                @include('admin.contact.partials.questions_table', [
                    'questions' => $questions ?? []
                ])
            @elseif($currentPage === 'contact_info')
                @include('admin.contact.partials.contact_info_table', [
                    'items' => $items ?? []
                ])
            @else
                <p class="text-sm text-slate-500">
                    Izabrani panel ne postoji.
                </p>
            @endif
        </div>
    </main>
</div>

<script>
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('tab-active');
        btn.classList.add('tab-inactive');
    });
    event.target.closest('.tab-btn').classList.remove('tab-inactive');
    event.target.closest('.tab-btn').classList.add('tab-active');
</script>

</body>
</html>
