<?php
function _horsens_cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

function _horsens_fix_svg_mime_type($data, $file, $filename, $mimes) {
    $filetype = wp_check_filetype($filename, $mimes);
    if ($filetype['ext'] === 'svg') {
        $data['ext'] = 'svg';
        $data['type'] = 'image/svg+xml';
    }
    return $data;
}