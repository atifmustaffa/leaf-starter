<?php
/**
 * Load all PHP middleware files from a defined middlewares folder
 * Files should just contain functions, no class definitions
 */

$middlewaresPath = __DIR__ . '/middlewares';

$middlewareFiles = new RecursiveIteratorIterator(
  new RecursiveDirectoryIterator($middlewaresPath)
);

foreach ($middlewareFiles as $file) {
  if ($file->isFile() && $file->getExtension() === 'php') {
    require_once $file->getRealPath();
  }
}