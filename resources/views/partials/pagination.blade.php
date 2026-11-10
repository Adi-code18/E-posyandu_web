@if ($paginator->hasPages())
    <nav class="epos-pagination-container" role="navigation" aria-label="Navigasi Halaman">
        <!-- Informasi Rentang Data -->
        <div class="epos-pagination-info">
            Menampilkan 
            <span class="epos-pagination-highlight">{{ $paginator->firstItem() }}</span>
            sampai 
            <span class="epos-pagination-highlight">{{ $paginator->lastItem() }}</span>
            dari 
            <span class="epos-pagination-highlight">{{ $paginator->total() }}</span>
            warga terdaftar
        </div>

        <!-- Tombol Navigasi Halaman -->
        <ul class="epos-pagination-list">
            {{-- Tombol Sebelumnya --}}
            @if ($paginator->onFirstPage())
                <li class="epos-page-item disabled" aria-disabled="true" aria-label="Sebelumnya">
                    <span class="epos-page-btn epos-page-prev">
                        <i class="fa-solid fa-chevron-left"></i>
                        <span class="epos-page-text">Sebelumnya</span>
                    </span>
                </li>
            @else
                <li class="epos-page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="epos-page-btn epos-page-prev" aria-label="Sebelumnya">
                        <i class="fa-solid fa-chevron-left"></i>
                        <span class="epos-page-text">Sebelumnya</span>
                    </a>
                </li>
            @endif

            {{-- Elemen Nomor Halaman --}}
            @foreach ($elements as $element)
                {{-- Separator Titik-titik (...) --}}
                @if (is_string($element))
                    <li class="epos-page-item disabled" aria-disabled="true">
                        <span class="epos-page-btn epos-page-dots">{{ $element }}</span>
                    </li>
                @endif

                {{-- Nomor Halaman Aktif / Tersedia --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="epos-page-item active" aria-current="page">
                                <span class="epos-page-btn epos-page-num active">{{ $page }}</span>
                            </li>
                        @else
                            <li class="epos-page-item">
                                <a href="{{ $url }}" class="epos-page-btn epos-page-num">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Selanjutnya --}}
            @if ($paginator->hasMorePages())
                <li class="epos-page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="epos-page-btn epos-page-next" aria-label="Selanjutnya">
                        <span class="epos-page-text">Selanjutnya</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="epos-page-item disabled" aria-disabled="true" aria-label="Selanjutnya">
                    <span class="epos-page-btn epos-page-next">
                        <span class="epos-page-text">Selanjutnya</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

