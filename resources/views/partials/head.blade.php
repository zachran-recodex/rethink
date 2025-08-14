<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    /* Force immediate CSS usage to prevent preload warning */
    html, body { 
        font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; 
        margin: 0; 
        padding: 0;
        background-color: white;
        color: #0E1A1F;
        line-height: 1.5;
    }
    
    /* Force light mode only */
    html { 
        color-scheme: light only; 
    }
    
    /* Use common Tailwind classes immediately to trigger CSS usage */
    .min-h-screen { min-height: 100vh; }
    .bg-white { background-color: white; }
    .text-zinc-600 { color: #525252; }
    .flex { display: flex; }
    .items-center { align-items: center; }
    .justify-center { justify-content: center; }
    .rounded-xl { border-radius: 0.75rem; }
    .border { border-width: 1px; }
    .border-neutral-200 { border-color: #e5e5e5; }
    .p-4 { padding: 1rem; }
    .text-sm { font-size: 0.875rem; }
    .font-medium { font-weight: 500; }
    .shadow-lg { box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1); }
    
    /* Force usage of brand colors */
    .text-primary { color: #6967FB; }
    .bg-primary { background-color: #6967FB; }
    .text-accent { color: #C8F904; }
    .bg-accent { background-color: #C8F904; }
    .text-dark { color: #0E1A1F; }
    .bg-dark { background-color: #0E1A1F; }
</style>

<script>
    // Force immediate usage of CSS classes
    document.documentElement.className = 'min-h-screen bg-white';
    
    // Create a temporary element to force CSS usage
    const tempDiv = document.createElement('div');
    tempDiv.className = 'flex items-center justify-center p-4 text-sm font-medium rounded-xl border border-neutral-200 shadow-lg text-primary bg-accent text-dark';
    tempDiv.style.position = 'absolute';
    tempDiv.style.left = '-9999px';
    tempDiv.style.visibility = 'hidden';
    document.head.appendChild(tempDiv);
    
    // Remove after a short delay
    setTimeout(() => {
        if (tempDiv.parentNode) {
            tempDiv.parentNode.removeChild(tempDiv);
        }
    }, 100);
</script>
