<footer class="footer">
    <div class="footer__inner">
        {{-- Social Media --}}
        <div class="footer__socials">

            {{-- Instagram --}}
            <a href="#" aria-label="Instagram">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <rect x="2" y="2" width="20" height="20" rx="5"
                          stroke="#98A2B3" stroke-width="2"/>
                    <circle cx="12" cy="12" r="4"
                            stroke="#98A2B3" stroke-width="2"/>
                    <circle cx="17.5" cy="6.5" r="1" fill="#98A2B3"/>
                </svg>
            </a>

            {{-- Twitter / X --}}
            <a href="#" aria-label="Twitter">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path d="M4 4l16 16M4 20L20 4"
                          stroke="#98A2B3" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>

            {{-- Facebook --}}
            <a href="#" aria-label="Facebook">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"
                          stroke="#98A2B3" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>

            {{-- YouTube --}}
            <a href="#" aria-label="YouTube">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <rect x="2" y="5" width="20" height="14" rx="4"
                          stroke="#98A2B3" stroke-width="2"/>
                    <path d="M10 9l5 3-5 3V9z" fill="#98A2B3"/>
                </svg>
            </a>

        </div>

        {{-- Copyright --}}
        <p class="footer__copy">
            &copy; {{ date('Y') }} Courtee. All rights reserved.
        </p>

    </div>
</footer>