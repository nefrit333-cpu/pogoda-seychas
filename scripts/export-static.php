<?php

$source = __DIR__ . '/../resources/views/welcome.blade.php';
$targetDirectory = __DIR__ . '/../vercel';
$target = $targetDirectory . '/index.html';
$assetSourceDirectory = __DIR__ . '/../public/weather-assets';
$assetTargetDirectory = $targetDirectory . '/weather-assets';

if (! is_file($source)) {
    fwrite(STDERR, "Source Blade view not found: {$source}\n");
    exit(1);
}

if (! is_dir($targetDirectory) && ! mkdir($targetDirectory, 0775, true)) {
    fwrite(STDERR, "Unable to create target directory: {$targetDirectory}\n");
    exit(1);
}

$html = file_get_contents($source);

if ($html === false) {
    fwrite(STDERR, "Unable to read source Blade view: {$source}\n");
    exit(1);
}

$html = str_replace(
    '<html lang="{{ str_replace(\'_\', \'-\', app()->getLocale()) }}">',
    '<html lang="ru">',
    $html
);

if (file_put_contents($target, $html) === false) {
    fwrite(STDERR, "Unable to write static export: {$target}\n");
    exit(1);
}

if (is_dir($assetSourceDirectory)) {
    if (! is_dir($assetTargetDirectory) && ! mkdir($assetTargetDirectory, 0775, true)) {
        fwrite(STDERR, "Unable to create asset target directory: {$assetTargetDirectory}\n");
        exit(1);
    }

    foreach (glob($assetSourceDirectory . '/*') ?: [] as $asset) {
        $targetAsset = $assetTargetDirectory . '/' . basename($asset);

        if (is_file($asset) && ! copy($asset, $targetAsset)) {
            fwrite(STDERR, "Unable to copy weather asset: {$asset}\n");
            exit(1);
        }
    }
}

echo "Static export written to {$target}\n";
