<?php
add_action('wp_enqueue_scripts', function () {

    /**
     * 0) Parent stylesheet (make sure child overrides reliably)
     * If the parent already enqueues its own CSS this won't break anything,
     * but it ensures we have a dependable dependency handle.
     */
    wp_enqueue_style(
        'egovt-parent-style',
        get_template_directory_uri() . '/style.css',
        [],
        wp_get_theme(get_template())->get('Version')
    );

    /**
     * 1) Inter font (Google Fonts)
     */
    wp_enqueue_style(
        'rw-inter',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        [],
        null
    );

    /**
     * 2) Child stylesheet last, with cache-busting
     */
    $child_css = get_stylesheet_directory() . '/style.css';

    wp_enqueue_style(
        'egovt-child-style',
        get_stylesheet_uri(),
        ['egovt-parent-style', 'rw-inter'],
        file_exists($child_css) ? filemtime($child_css) : wp_get_theme()->get('Version')
    );

    /**
     * 3) Zoom hero script (loads in footer)
     * File path: /wp-content/themes/egovt-child/assets/js/rw-zoom-hero.js
     */
    $zoom_js_path = get_stylesheet_directory() . '/assets/js/rw-zoom-hero.js';
    $zoom_js_uri  = get_stylesheet_directory_uri() . '/assets/js/rw-zoom-hero.js';

    if (file_exists($zoom_js_path)) {
        wp_enqueue_script(
            'rw-zoom-hero',
            $zoom_js_uri,
            [],
            filemtime($zoom_js_path),
            true
        );
    }

}, 99);

/**
 * Optional: Preconnect to speed up Google Fonts
 */
add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 1);
?>