@extends('layouts.public', ['title' => 'Tentang Kami — FluxBlade UI System'])

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto">
            <x-ui.badge variant="primary">Tentang Kami</x-ui.badge>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
                Membangun antarmuka modern yang menghargai waktu pengembang
            </h1>
            <p class="mt-4 text-sm sm:text-base text-zinc-600 dark:text-zinc-400 leading-relaxed">
                FluxBlade dibuat dengan filosofi bahwa keindahan visual sebuah aplikasi SaaS enterprise tidak harus
                mengorbankan performa, kesederhanaan arsitektur, dan kemudahan pemeliharaan kode.
            </p>
        </div>

        <!-- Values Grid -->
        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="p-6 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <h3 class="text-base font-semibold text-zinc-900 dark:text-white">Kesederhanaan Tanpa Hambatan</h3>
                <p class="mt-2 text-xs leading-relaxed text-zinc-600 dark:text-zinc-400">
                    Kami menghindari abstraksi JavaScript yang berlebihan. Laravel Blade adalah mesin rendering yang sangat
                    matang dan cepat, dikombinasikan dengan utility Tailwind CSS murni.
                </p>
            </div>

            <div class="p-6 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <h3 class="text-base font-semibold text-zinc-900 dark:text-white">Ketelitian Detail Flux UI</h3>
                <p class="mt-2 text-xs leading-relaxed text-zinc-600 dark:text-zinc-400">
                    Border halus 1px, shadow bertingkat yang tidak berlebihan, palet warna netral slate dan zinc dengan satu
                    aksen warna biru terarah menghasilkan kesan mewah dan kredibel.
                </p>
            </div>

            <div class="p-6 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <h3 class="text-base font-semibold text-zinc-900 dark:text-white">Aksesibilitas Kelas Satu</h3>
                <p class="mt-2 text-xs leading-relaxed text-zinc-600 dark:text-zinc-400">
                    Navigasi keyboard yang jelas dengan focus ring berstandar tinggi, penamaan form field dengan label
                    eksplisit, dan atribut ARIA semantik untuk modal dan dropdown.
                </p>
            </div>

            <div class="p-6 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <h3 class="text-base font-semibold text-zinc-900 dark:text-white">Sepenuhnya Siap Laravel 13</h3>
                <p class="mt-2 text-xs leading-relaxed text-zinc-600 dark:text-zinc-400">
                    Setiap file disusun mengikuti konvensi standar `resources/views` Laravel. Tim Anda dapat langsung
                    menghubungkan controller dan model tanpa perlu merestrukturisasi folder.
                </p>
            </div>
        </div>
    </div>
@endsection