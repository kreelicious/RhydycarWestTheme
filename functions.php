<?php
/**
 * eGovt Child Theme functions
 */

add_action('wp_enqueue_scripts', function () {
    // Load child stylesheet last, with cache-busting
    $child_css = get_stylesheet_directory() . '/style.css';

    wp_enqueue_style(
        'egovt-child-style',
        get_stylesheet_uri(),
        [],
        file_exists($child_css) ? filemtime($child_css) : wp_get_theme()->get('Version')
    );
}, 99);

function rw_fonts() {
  wp_enqueue_style(
    'rw-inter',
    'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap',
    [],
    null
  );
}
add_action('wp_enqueue_scripts', 'rw_fonts');

