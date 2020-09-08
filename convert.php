<?php

$files = scandir(__DIR__);

$files = array_filter($files, static function (string $file) {
    return false !== strpos($file, '.svg');
});

foreach ($files as $file) {
    convertSVG($file);
}

function convertSVG(string $file) {

    $fileName = str_replace('.svg', '', $file);

    $fileNameParts = explode('_', $fileName);

    $prefix = $fileNameParts[0];
    $iconNameParts = array_slice($fileNameParts, 1);

    $xml = file_get_contents(__DIR__ . '/' . $file);

    $svg = new SimpleXMLElement($xml);

    $viewBox = (string) $svg->attributes()->viewBox;
    $viewBoxParts = explode(' ', $viewBox);
    $width = $viewBoxParts[2] ?? 32;
    $height = $viewBoxParts[3] ?? 32;

    $paths = [];
    foreach ($svg->path as $path) {
        $d = (string) $path->attributes()->d;
        $paths[] = trim($d);
    }
    $pathsString = implode(' ', $paths);

    $iconNameClass = implode('-', $iconNameParts);
    $iconNameCamelCase = implode('', array_map('ucfirst', $iconNameParts));

$iconJS = "'use strict';
Object.defineProperty(exports, '__esModule', { value: true });
var prefix = '$prefix';
var iconName = '$iconNameClass';
var width = $width;
var height = $height;
var ligatures = [];
var unicode = 'f2b9';
var svgPathData = '$pathsString';

exports.definition = {
  prefix: prefix,
  iconName: iconName,
  icon: [
    width,
    height,
    ligatures,
    unicode,
    svgPathData
  ]
};

exports.$prefix$iconNameCamelCase = exports.definition;

exports.prefix = prefix;
exports.iconName = iconName;
exports.width = width;
exports.height = height;
exports.ligatures = ligatures;
exports.unicode = unicode;
exports.svgPathData = svgPathData;
";

    file_put_contents($prefix.$iconNameCamelCase.'.js', $iconJS);
}
