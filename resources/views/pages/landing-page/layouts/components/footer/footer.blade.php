@php
    $footerSocials = collect([
        ['url' => $footerContact?->link_fb, 'icon' => 'bi-facebook', 'label' => 'Facebook'],
        ['url' => $footerContact?->link_ig, 'icon' => 'bi-instagram', 'label' => 'Instagram'],
        ['url' => $footerContact?->link_twitter, 'icon' => 'bi-twitter-x', 'label' => 'X (Twitter)'],
        ['url' => $footerContact?->link_tiktok, 'icon' => 'bi-tiktok', 'label' => 'TikTok'],
    ])->filter(fn ($social) => filled($social['url']) && str_starts_with($social['url'], 'http'));
    $footerWhatsApp = \App\Support\WhatsApp::number();
@endphp
<footer id="footer" class="footer position-relative">

  <div class="container footer-top">
    <div class="row gy-4">

      <div class="col-lg-5 col-md-12 footer-about">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
          <img src="{{ url('/assets-images') }}/logo_aplikasi.png" alt="Logo {{ $setting['site_name'] }}" width="40" height="40" loading="lazy">
          <span class="sitename">{{ $setting['site_name'] }}</span>
        </a>
        <p>{{ $setting['seo_description'] }}</p>
        @if ($footerSocials->isNotEmpty())
          <div class="social-links">
            @foreach ($footerSocials as $social)
              <a href="{{ $social['url'] }}" target="_blank" rel="noopener" aria-label="{{ $social['label'] }} {{ $setting['site_name'] }}">
                <i class="bi {{ $social['icon'] }}"></i>
              </a>
            @endforeach
          </div>
        @endif
      </div>

      <div class="col-lg-3 col-sm-6 footer-links">
        <h4>Menu</h4>
        <ul>
          <li><a href="{{ url('/') }}#about">Tentang Kami</a></li>
          <li><a href="{{ url('/') }}#pricing">Harga</a></li>
          <li><a href="{{ url('/') }}#produk">Produk</a></li>
          <li><a href="{{ url('/') }}#contact">Kontak</a></li>
        </ul>
      </div>

      <div class="col-lg-4 col-sm-6 footer-contact">
        <h4>Kontak</h4>
        @if (filled($footerContact?->address))
          <p>{{ $footerContact->address }}</p>
        @endif
        @if ($footerWhatsApp)
          <p><a href="{{ \App\Support\WhatsApp::link() }}" target="_blank" rel="noopener">WhatsApp: +{{ $footerWhatsApp }}</a></p>
        @endif
        @if (filled($footerContact?->email))
          <p><a href="mailto:{{ $footerContact->email }}">{{ $footerContact->email }}</a></p>
        @endif
      </div>

    </div>
  </div>

  <div class="footer-bottom">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <p>
        © {{ date('Y') }} <strong class="sitename">{{ $setting['site_name'] }}</strong>
        @if (filled($setting['footer_text']))
          · {{ $setting['footer_text'] }}
        @endif
      </p>
      <div class="footer-legal">
        <a href="{{ route('termsAndCondition') }}" class="{{ request()->routeIs('termsAndCondition') ? 'active' : '' }}">Syarat & Ketentuan</a>
        <a href="{{ route('privacyPolicy') }}" class="{{ request()->routeIs('privacyPolicy') ? 'active' : '' }}">Kebijakan Privasi</a>
      </div>
    </div>
  </div>

</footer>
