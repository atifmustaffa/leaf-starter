<?php
/**
 * Load all PHP helper files from a defined helpers folder
 * Files should just contain functions, no class definitions
 */

$helpersPath = __DIR__ . '/helpers';

$helperFiles = new RecursiveIteratorIterator(
  new RecursiveDirectoryIterator($helpersPath)
);

foreach ($helperFiles as $file) {
  if ($file->isFile() && $file->getExtension() === 'php') {
    require_once $file->getRealPath();
  }
}