@if(isset($setting) && $setting->getFirstMediaUrl('logo'))
    <img src="{{ $setting->getFirstMediaUrl('logo') }}" 
         alt="{{ $setting->site_name }}" 
         class="h-8 w-auto object-contain">
@else
    <svg viewBox="0 0 200 50" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-8 w-auto">
        <!-- Government of Indonesia style logo -->
        <defs>
            <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#059669;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#047857;stop-opacity:1" />
            </linearGradient>
        </defs>
        
        <!-- Shield shape -->
        <path d="M10 8 C10 8, 25 3, 40 8 C40 8, 45 15, 45 25 C45 35, 25 45, 25 45 C25 45, 5 35, 5 25 C5 15, 10 8, 10 8" fill="url(#logoGradient)" />
        
        <!-- Inner shield details -->
        <path d="M15 12 C15 12, 25 9, 35 12 C35 12, 38 17, 38 25 C38 33, 25 38, 25 38 C25 38, 12 33, 12 25 C12 17, 15 12, 15 12" fill="#ffffff" opacity="0.3" />
        
        <!-- Star -->
        <path d="M25 14 L27 20 L33 20 L28 24 L30 30 L25 26 L20 30 L22 24 L17 20 L23 20 Z" fill="#ffffff" />
        
        <!-- Text -->
        <text x="55" y="25" font-family="system-ui, sans-serif" font-size="12" font-weight="600" fill="currentColor">
            <tspan x="55" y="20">PEMERINTAH</tspan>
            <tspan x="55" y="34">KAB. LOMBOK TIMUR</tspan>
        </text>
    </svg>
@endif
