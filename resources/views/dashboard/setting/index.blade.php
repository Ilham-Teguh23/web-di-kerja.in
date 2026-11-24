@extends('layout.index')

@section('title', 'Pengaturan & SEO')

@section('breadcumb')
    <div class="page-header">
        <h1 class="my-auto page-title">Pengaturan Website & SEO</h1>
        <div>
            <ol class="mb-0 breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Pengaturan & SEO
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

    <style>
        .serp-preview {
            font-family: Arial, sans-serif;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 16px;
            background: #fff;
        }

        .serp-preview .serp-url {
            color: #202124;
            font-size: 13px;
        }

        .serp-preview .serp-title {
            color: #1a0dab;
            font-size: 19px;
            line-height: 1.3;
            margin: 4px 0;
        }

        .serp-preview .serp-description {
            color: #4d5156;
            font-size: 14px;
            line-height: 1.5;
        }

        .og-preview {
            max-width: 100%;
            max-height: 180px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }
    </style>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Pengaturan belum tersimpan.</strong> Periksa kembali isian berikut:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xl-8">

                <!-- SEO -->
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">SEO (Mesin Pencari & Media Sosial)</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="site_name" class="form-label">Nama Website</label>
                            <input type="text" class="form-control" id="site_name" name="site_name"
                                value="{{ old('site_name', $setting['site_name']) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="seo_title" class="form-label">Judul Halaman (Meta Title)</label>
                            <input type="text" class="form-control seo-counter" id="seo_title" name="seo_title"
                                data-max="60" value="{{ old('seo_title', $setting['seo_title']) }}" required>
                            <small class="text-muted"><span data-counter-for="seo_title"></span> karakter. Disarankan maksimal 60 karakter agar tidak terpotong di Google.</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="seo_description" class="form-label">Deskripsi (Meta Description)</label>
                            <textarea class="form-control seo-counter" id="seo_description" name="seo_description" rows="3"
                                data-max="160" required>{{ old('seo_description', $setting['seo_description']) }}</textarea>
                            <small class="text-muted"><span data-counter-for="seo_description"></span> karakter. Disarankan 120 - 160 karakter.</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="seo_keywords" class="form-label">Kata Kunci</label>
                            <textarea class="form-control" id="seo_keywords" name="seo_keywords" rows="2"
                                placeholder="jasa pembuatan website, jasa pembuatan aplikasi">{{ old('seo_keywords', $setting['seo_keywords']) }}</textarea>
                            <small class="text-muted">Pisahkan dengan koma.</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="seo_og_image" class="form-label">Gambar Saat Link Dibagikan (OG Image)</label>
                            @if ($setting['seo_og_image'])
                                <div class="mb-2">
                                    <img src="{{ asset('storage/setting/' . $setting['seo_og_image']) }}" class="og-preview" alt="OG Image">
                                </div>
                            @endif
                            <input type="file" class="form-control" id="seo_og_image" name="seo_og_image" accept="image/jpeg,image/png,image/webp">
                            <small class="text-muted">
                                Tampil saat link website dibagikan ke WhatsApp, Facebook, X, dll. Ukuran ideal 1200 x 630 px, maksimal 2 MB.
                                Jika kosong, dipakai gambar Hero yang aktif.
                            </small>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group mb-3">
                                <label for="twitter_site" class="form-label">Akun X / Twitter</label>
                                <input type="text" class="form-control" id="twitter_site" name="twitter_site"
                                    placeholder="@namaakun" value="{{ old('twitter_site', $setting['twitter_site']) }}">
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="google_site_verification" class="form-label">Kode Verifikasi Google</label>
                                <input type="text" class="form-control" id="google_site_verification" name="google_site_verification"
                                    value="{{ old('google_site_verification', $setting['google_site_verification']) }}">
                                <small class="text-muted">Dari Google Search Console (metode tag HTML), isi bagian <code>content</code> saja.</small>
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="google_analytics_id" class="form-label">Google Analytics ID</label>
                                <input type="text" class="form-control" id="google_analytics_id" name="google_analytics_id"
                                    placeholder="G-XXXXXXXXXX" value="{{ old('google_analytics_id', $setting['google_analytics_id']) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hero -->
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">Hero (Bagian Paling Atas)</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="hero_title" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="hero_title" name="hero_title"
                                    value="{{ old('hero_title', $setting['hero_title']) }}" required>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="hero_highlight" class="form-label">Judul Berwarna</label>
                                <input type="text" class="form-control" id="hero_highlight" name="hero_highlight"
                                    value="{{ old('hero_highlight', $setting['hero_highlight']) }}">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="hero_subtitle" class="form-label">Subjudul</label>
                            <input type="text" class="form-control" id="hero_subtitle" name="hero_subtitle"
                                value="{{ old('hero_subtitle', $setting['hero_subtitle']) }}">
                        </div>
                        <small class="text-muted">Gambar hero diatur dari menu Master &rsaquo; Hero Image (status Aktif).</small>
                    </div>
                </div>

                <!-- Judul Section -->
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">Judul Section Landing Page</div>
                    </div>
                    <div class="card-body">
                        @foreach ($sections as $key => $label)
                            <div class="row">
                                <div class="col-md-5 form-group mb-3">
                                    <label for="{{ $key }}_title" class="form-label">Judul {{ $label }}</label>
                                    <input type="text" class="form-control" id="{{ $key }}_title" name="{{ $key }}_title"
                                        value="{{ old($key . '_title', $setting[$key . '_title']) }}" required>
                                </div>
                                <div class="col-md-7 form-group mb-3">
                                    <label for="{{ $key }}_subtitle" class="form-label">Subjudul {{ $label }}</label>
                                    <input type="text" class="form-control" id="{{ $key }}_subtitle" name="{{ $key }}_subtitle"
                                        value="{{ old($key . '_subtitle', $setting[$key . '_subtitle']) }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- WhatsApp & Footer -->
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">WhatsApp & Footer</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 form-group mb-3">
                                <label for="whatsapp_number" class="form-label">Nomor WhatsApp Admin</label>
                                <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number"
                                    placeholder="6281234567890" value="{{ old('whatsapp_number', $setting['whatsapp_number']) }}" required>
                                <small class="text-muted">Boleh diawali 08, otomatis diubah ke format 62.</small>
                            </div>
                            <div class="col-md-7 form-group mb-3">
                                <label for="whatsapp_message" class="form-label">Awalan Pesan Tombol "Hubungi Admin"</label>
                                <input type="text" class="form-control" id="whatsapp_message" name="whatsapp_message"
                                    value="{{ old('whatsapp_message', $setting['whatsapp_message']) }}">
                                <small class="text-muted">Nama paket otomatis ditambahkan di belakang pesan.</small>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="footer_text" class="form-label">Teks Footer</label>
                            <input type="text" class="form-control" id="footer_text" name="footer_text"
                                value="{{ old('footer_text', $setting['footer_text']) }}">
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-4">
                <div class="card custom-card" style="position: sticky; top: 90px;">
                    <div class="card-header">
                        <div class="card-title">Pratinjau di Google</div>
                    </div>
                    <div class="card-body">
                        <div class="serp-preview mb-3">
                            <div class="serp-url">{{ url('/') }}</div>
                            <div class="serp-title" id="previewTitle"></div>
                            <div class="serp-description" id="previewDescription"></div>
                        </div>
                        <ul class="small text-muted ps-3 mb-3">
                            <li>Sitemap: <a href="{{ route('sitemap') }}" target="_blank">{{ route('sitemap') }}</a></li>
                            <li>Robots: <a href="{{ route('robots') }}" target="_blank">{{ route('robots') }}</a></li>
                            <li>Daftarkan sitemap di Google Search Console agar halaman cepat terindeks.</li>
                        </ul>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fe fe-save"></i> Simpan Pengaturan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('script')
    <script>
        function updateSeoPreview() {
            $('.seo-counter').each(function () {
                const length = $(this).val().length;
                const max = parseInt($(this).data('max'), 10);

                $(`[data-counter-for="${this.id}"]`)
                    .text(length)
                    .toggleClass('text-danger fw-bold', length > max);
            });

            $('#previewTitle').text($('#seo_title').val());
            $('#previewDescription').text($('#seo_description').val());
        }

        $(document).on('input', '#seo_title, #seo_description', updateSeoPreview);
        $(document).ready(updateSeoPreview);

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: @json(session('success')),
                timer: 1800,
                showConfirmButton: false
            });
        @endif
    </script>
@endsection
