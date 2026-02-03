<?php
/**
 * eGovt Child Theme functions
 */

add_action('wp_enqueue_scripts', function () {

    // 1) Load Inter font (Google Fonts)
    wp_enqueue_style(
        'rw-inter',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        [],
        null
    );

    // 2) Load child stylesheet last, with cache-busting
    $child_css = get_stylesheet_directory() . '/style.css';

    wp_enqueue_style(
        'egovt-child-style',
        get_stylesheet_uri(),
        [], // if we know the parent handle, we can put it here
        file_exists($child_css) ? filemtime($child_css) : wp_get_theme()->get('Version')
    );

}, 99);
?>

