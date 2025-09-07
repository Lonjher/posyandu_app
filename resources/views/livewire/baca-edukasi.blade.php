<div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Artikel -->
        <header class="mb-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400 line-clamp-1">{{ $edukasi->judul }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Kategori -->
            <div class="mb-4">
                <span class="px-3 py-1 text-xs font-medium rounded-full
                          {{ $kategoriColor }} text-{{ $kategoriTextColor }}">
                    {{ $edukasi->kategori }}
                </span>
            </div>

            <!-- Judul -->
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ $edukasi->judul }}</h1>

            <!-- Meta Info -->
            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <span class="flex items-center mr-4">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    {{ $edukasi->user->name ?? 'Admin' }}
                </span>
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ $edukasi->created_at->translatedFormat('d F Y') }}
                </span>
            </div>
        </header>

        <!-- Gambar Utama -->
        <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
            <img src="{{ $edukasi->gambar ? asset('storage/' . $edukasi->gambar) : asset('images/placeholder-education.jpg') }}"
                 alt="{{ $edukasi->judul }}" class="w-full h-auto object-cover">
        </div>

        <!-- Konten Artikel -->
        <article class="prose prose-lg max-w-none dark:prose-invert prose-headings:text-gray-900 dark:prose-headings:text-white
                     prose-a:text-blue-600 dark:prose-a:text-blue-400 prose-strong:text-gray-900 dark:prose-strong:text-white
                     prose-blockquote:border-blue-600 prose-blockquote:bg-gray-50 dark:prose-blockquote:bg-gray-800
                     prose-pre:bg-gray-100 dark:prose-pre:bg-gray-800 mb-8">
            {!! $edukasi->konten !!}
        </article>

        <!-- Bagian Berbagi -->
        {{-- <div class="border-t border-b border-gray-200 dark:border-gray-700 py-6 mb-8">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Bagikan artikel ini:</span>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-500 hover:text-blue-600 dark:hover:text-blue-400">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-blue-400 dark:hover:text-blue-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-red-600 dark:hover:text-red-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.017 1.995C8.306 1.995 5.282 5.057 5.282 8.831c0 2.5 1.135 3.797 2.197 5.07a17.97 17.97 0 012.143 2.785c.356.527.735 1.088 1.16 1.639.229.298.525.62.87.943.325.302.749.62 1.232.62.483 0 .907-.318 1.232-.62.345-.323.641-.645.87-.943a17.525 17.525 0 011.16-1.639 17.97 17.97 0 012.143-2.785c1.062-1.273 2.197-2.57 2.197-5.07 0-3.774-3.024-6.836-6.735-6.836zm4.718 11.97a16.474 16.474 0 01-1.963 2.562 15.57 15.57 0 01-1.157 1.366c-.044.052-.127.152-.244.285-.117.133-.197.216-.233.248a.612.612 0 01-.117.098.304.304 0 01-.117-.098 8.76 8.76 0 01-.477-.533 16.013 16.013 0 01-1.4-2.052 16.474 16.474 0 01-1.963-2.562c-.856-1.197-1.508-2.303-1.508-3.539 0-2.153 1.725-3.902 3.852-3.902s3.852 1.749 3.852 3.902c0 1.236-.652 2.342-1.508 3.539z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div> --}}

        <!-- Navigasi Artikel -->
        {{-- <div class="flex justify-between mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
            @if($previousEdukasi)
                <a href="{{ route('edukasi.baca', $previousEdukasi->id) }}" class="flex items-center text-blue-600 dark:text-blue-400 hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <div>
                        <span class="text-sm block text-gray-500 dark:text-gray-400">Artikel Sebelumnya</span>
                        <span class="font-medium">{{ Str::limit($previousEdukasi->judul, 40) }}</span>
                    </div>
                </a>
            @else
                <div></div>
            @endif

            @if($nextEdukasi)
                <a href="{{ route('edukasi.baca', $nextEdukasi->id) }}" class="flex items-center text-right text-blue-600 dark:text-blue-400 hover:underline">
                    <div>
                        <span class="text-sm block text-gray-500 dark:text-gray-400">Artikel Selanjutnya</span>
                        <span class="font-medium">{{ Str::limit($nextEdukasi->judul, 40) }}</span>
                    </div>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            @endif
        </div> --}}
    </div>
</div>
@slot('title')
    Baca Edukasi
@endslot
@push('style')
    <style>
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Gaya khusus untuk konten artikel */
        .prose {
            color: #374151;
        }

        .dark .prose {
            color: #D1D5DB;
        }

        .prose img {
            border-radius: 0.75rem;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .prose h2, .prose h3 {
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .prose ul, .prose ol {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .prose li {
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
@endpush
