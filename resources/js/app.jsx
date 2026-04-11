import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createRoot } from 'react-dom/client';
import { LanguageProvider } from './i18n/LanguageContext';

const appName = import.meta.env.VITE_APP_NAME || 'Syntaxhub.';

// ====== ULTRA-MODERN KINETIC PRELOADER ======
function showPreloader() {
    const loader = document.createElement('div');
    loader.id = 'app-preloader';
    
    // An elegant dark preloader with a counting percentage and split reveal
    loader.innerHTML = `
        <div class="loader-bg top"></div>
        <div class="loader-bg bottom"></div>
        <div class="loader-content">
            <div class="magnetic-wrap">
                <div class="percentage" id="loader-percent">0%</div>
            </div>
            <div class="loader-tagline">
                <span class="overflow-hidden"><span class="reveal-text">Initiating</span></span>
                <span class="overflow-hidden"><span class="reveal-text">Interactive</span></span>
                <span class="overflow-hidden"><span class="reveal-text">Hub</span></span>
            </div>
            <div class="loader-progress-container">
                <div class="loader-progress-bar" id="loader-bar"></div>
            </div>
        </div>
    `;
    document.body.prepend(loader);

    // Kinetic counting effect
    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.floor(Math.random() * 10) + 5;
        if (progress > 100) progress = 100;
        
        const percentEl = document.getElementById('loader-percent');
        const barEl = document.getElementById('loader-bar');
        
        if (percentEl) percentEl.innerText = progress + '%';
        if (barEl) barEl.style.width = progress + '%';
        
        if (progress === 100) clearInterval(interval);
    }, 40);
}

function hidePreloader() {
    const loader = document.getElementById('app-preloader');
    if (loader) {
        loader.classList.add('preloader-exit');
        setTimeout(() => loader.remove(), 1200);
    }
}

showPreloader();

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.jsx`,
            import.meta.glob('./Pages/**/*.jsx'),
        ),
    setup({ el, App, props }) {
        const root = createRoot(el);
        root.render(
            <LanguageProvider>
                <App {...props} />
            </LanguageProvider>
        );

        // Wait a bit to ensure fonts/css render properly, then hide
        setTimeout(hidePreloader, 800);
    },
    progress: {
        color: '#ffffff',
        showSpinner: false,
    },
});
