<?php
/**
 * Plugin Name: Custom Gutenberg Block
 * Description: A simple custom Gutenberg block.
 * Version: 3.0.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function custom_gutenberg_block_register() {
    wp_register_script(
        'custom-gutenberg-block-editor',
        plugins_url('block.js', __FILE__),
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'),
        filemtime(plugin_dir_path(__FILE__) . 'block.js')
    );

    wp_register_style(
        'custom-gutenberg-block-editor-style',
        plugins_url('editor.css', __FILE__),
        array('wp-edit-blocks'),
        filemtime(plugin_dir_path(__FILE__) . 'editor.css')
    );

    register_block_type('custom/block', array(
        'editor_script' => 'custom-gutenberg-block-editor',
        'editor_style' => 'custom-gutenberg-block-editor-style',
        'attributes' => array(
            'content' => array(
                'type' => 'string',
                'default' => 'Hello, Gutenberg!'
            ),
            'textColor' => array(
                'type' => 'string',
                'default' => '#000000'
            ),
            'backgroundColor' => array(
                'type' => 'string',
                'default' => '#ffffff'
            )
        ),
        'render_callback' => 'custom_gutenberg_block_render'
    ));
}
add_action('init', 'custom_gutenberg_block_register');

function custom_gutenberg_block_render($attributes) {
    $content = esc_html($attributes['content']);
    $textColor = esc_attr($attributes['textColor']);
    $backgroundColor = esc_attr($attributes['backgroundColor']);
    return "<p style='color: {$textColor}; background-color: {$backgroundColor}; padding: 10px;'>{$content}</p>";
}
