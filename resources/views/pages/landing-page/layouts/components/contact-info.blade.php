{{-- Email & alamat dari menu Master > Kontak, WhatsApp dari menu Pengaturan & SEO --}}
@php
    $whatsappNumber = \App\Support\WhatsApp::number();
@endphp
<p>
    @if (filled($contact?->email))
        Email: <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a><br>
    @endif
    @if ($whatsappNumber)
        WhatsApp: <a href="{{ \App\Support\WhatsApp::link() }}" target="_blank" rel="noopener">+{{ $whatsappNumber }}</a><br>
    @endif
    @if (! empty($withAddress) && filled($contact?->address))
        Alamat: {{ $contact->address }}
    @endif
</p>
