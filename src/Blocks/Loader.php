<?php

namespace Edw\Theme\Blocks;

class Loader
{
    public static function init()
    {
        add_action('init', [static::class, 'registerAll']);
    }

    public static function registerAll()
    {
        $baseDir = get_stylesheet_directory() . '/blocks';
        $baseUri = get_stylesheet_directory_uri() . '/blocks';

        if (!is_dir($baseDir)) return;

        // Find every block that has a block.json
        foreach (glob($baseDir . '/*/block.json') as $jsonPath) {
            $dir = dirname($jsonPath);
            $folder = basename($dir);
            $uri = $baseUri . '/' . $folder;

            // Read metadata (mainly for the "name")
            $meta = json_decode(@file_get_contents($jsonPath), true);
            if (!is_array($meta) || empty($meta['name'])) continue;

            $name = $meta['name']; // e.g., "edw/hero"
            $handleBase = preg_replace('~[^a-z0-9\-]~i', '-', $name); // edw-hero

            // Register editor script with explicit deps (crucial for no-build)
            $editorJs = $dir . '/block.js';
            if (file_exists($editorJs)) {
                wp_register_script(
                    $handleBase . '-editor',
                    $uri . '/block.js',
                    ['wp-blocks', 'wp-i18n', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-server-side-render'],
                    filemtime($editorJs),
                    true
                );
            }

            // Front-end + editor styles if present
            $frontCss = $dir . '/style.css';
            if (file_exists($frontCss)) {
                wp_register_style($handleBase . '-style', $uri . '/style.css', [], filemtime($frontCss));
            }

            $editorCss = $dir . '/editor.css';
            if (file_exists($editorCss)) {
                wp_register_style($handleBase . '-editor-style', $uri . '/editor.css', ['wp-edit-blocks'], filemtime($editorCss));
            }

            // Register the block from metadata, but force our handles (symlink-safe)
            $args = [];
            if (wp_script_is($handleBase . '-editor', 'registered'))   $args['editor_script'] = $handleBase . '-editor';
            if (wp_style_is($handleBase . '-style', 'registered'))     $args['style']         = $handleBase . '-style';
            if (wp_style_is($handleBase . '-editor-style', 'registered')) $args['editor_style']  = $handleBase . '-editor-style';

            $ok = register_block_type($dir, $args);

            if (!$ok) {
                error_log('edw blocks: failed to register ' . $name . ' from ' . $dir);
            }
        }
    }
}
