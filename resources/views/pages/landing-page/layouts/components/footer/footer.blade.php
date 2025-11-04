<footer id="footer" class="footer position-relative light-background" style="padding-bottom: 0px">
  <style>
    /* ===== Footer Styling ===== */
    #footer {
      background: #f8fafc;
      padding: 30px 0 0 0;
      border-top: 1px solid #e5e7eb;
    }

    #footer .copyright {
      color: #475569;
      font-size: 14px;
      margin-bottom: 10px;
    }

    #footer .sitename {
      color: #1d4ed8;
      font-weight: 700;
    }

    #footer .footer-links {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }

    #footer .footer-links a {
      color: #475569;
      text-decoration: none;
      font-size: 14px;
      transition: color 0.2s ease;
    }

    #footer .footer-links a.active {
      color: #1d4ed8; /* warna biru aktif */
      font-weight: 600;
      text-decoration: none; /* ← HAPUS underline */
      border-bottom: 2px solid #1d4ed8; /* opsional: garis bawah custom */
      padding-bottom: 2px; /* opsional: sedikit jarak */
    }

    #footer p {
      margin: 0;
    }
  </style>

  <div class="container text-center">
    <!-- Link tambahan -->
    <div class="footer-links">
      <a 
        href="{{ route('termsAndCondition') }}" 
        class="{{ request()->routeIs('termsAndCondition') ? 'active' : '' }}"
      >
        Terms & Conditions
      </a>

      <a 
        href="{{ route('privacyPolicy') }}" 
        class="{{ request()->routeIs('privacyPolicy') ? 'active' : '' }}"
      >
        Privacy Policy
      </a>
    </div>

    <!-- Copyright -->
    <div class="copyright">
      <p>
        © <span>Copyright 2024</span>
        <strong class="px-1 sitename">di-kerja.in</strong>
        <span>All Rights Reserved</span>
      </p>
    </div>
  </div>
</footer>
