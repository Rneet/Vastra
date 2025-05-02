// Vercel Analytics implementation
(function() {
    // Import the Vercel Analytics package
    import('@vercel/analytics').then(({ inject }) => {
        // Initialize analytics
        inject();
        console.log('Vercel Analytics initialized');
    }).catch(err => {
        console.error('Failed to load Vercel Analytics:', err);
    });
})();
