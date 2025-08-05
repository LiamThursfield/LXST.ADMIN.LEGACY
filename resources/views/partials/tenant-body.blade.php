@php
    $thirdParty = app(\App\Models\Settings\ThirdPartySettings::class)
@endphp

@if($thirdParty->gtm_id)
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe
            src="https://www.googletagmanager.com/ns.html?id={{ $thirdParty->gtm_id }}"
            height="0"
            width="0"
            style="display:none;visibility:hidden">
        </iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
@endif
