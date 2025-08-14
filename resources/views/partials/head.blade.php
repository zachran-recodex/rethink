<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance

<style>
    /* Force immediate CSS usage to prevent preload warning */
    html, body { 
        font-family: var(--font-sans); 
        margin: 0; 
        padding: 0;
        background-color: white;
        color: #0E1A1F;
    }
    
    /* Force light mode only */
    html { color-scheme: light only; }
    html.dark { color-scheme: light only; }
    
    /* Use some Tailwind classes immediately */
    .min-h-screen { min-height: 100vh; }
    .bg-white { background-color: white; }
    .text-zinc-600 { color: #525252; }
</style>

<script>
    // Force light mode and prevent dark mode
    document.documentElement.classList.remove('dark');
    document.documentElement.setAttribute('data-flux-appearance', 'light');
    
    // Force use CSS by applying classes immediately
    document.documentElement.className = 'min-h-screen bg-white';
    
    // Override any dark mode detection
    if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function() {
            document.documentElement.classList.remove('dark');
            document.documentElement.setAttribute('data-flux-appearance', 'light');
        });
    }
</script>
