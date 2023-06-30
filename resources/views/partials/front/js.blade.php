@vite('resources/js/app.js')

@livewireScripts

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11.7.12"></script>

<x-livewire-alert::scripts />

@stack('scripts')

{{-- <x-core-web-vital-core-web-component /> --}}

<script>
    // Get all links on the page
    const links = document.querySelectorAll('.trackClick');
    // Loop through each link and change the href
    links.forEach(link => {
        // Save the original href in a data attribute
        link.dataset.originalHref = link.href;
        // Set the new href for tracking
        link.href = '/track-links?link=' + encodeURIComponent(link.dataset.originalHref) + '&data='+ link.getAttribute("track-data") ;
    });
</script>