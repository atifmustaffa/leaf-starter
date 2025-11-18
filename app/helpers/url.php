<?php

/**
 * Returns the base path of the current app
 */
function base_path(): string
{
  // Detect the current script folder relative to document root
  $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
  $scriptDir = dirname($scriptName);

  // Remove trailing slash
  $basePath = rtrim($scriptDir, '/');

  return $basePath === '' ? '/' : $basePath;
}

/**
 * Generate full URL
 * 
 * @param string $path   Path relative to base_path
 * @param array  $query  Optional query parameters
 */
function url(string $path = '', array $query = []): string
{
  $base = base_path();

  // Remove leading slash from $path to avoid double slash
  $path = ltrim($path, '/');

  $full = $base . ($path !== '' ? '/' . $path : '');

  if (!empty($query)) {
    $full .= '?' . http_build_query($query);
  }

  return $full;
}

/**
 * Generate asset URL from public/assets folder
 * 
 * @param string $path   Path inside assets folder
 * @param array  $query  Optional query parameters
 */
function assets(string $path = '', array $query = []): string
{
  $base = url('public/assets'); // use url() to respect base_path
  $path = ltrim($path, '/');
  $full = $base . ($path !== '' ? '/' . $path : '');

  if (!empty($query)) {
    $full .= '?' . http_build_query($query);
  }

  return $full;
}

/**
 * Generate full URL from a route name
 * 
 * @param string $routeName The name of the route
 * @param array|string|null $params Optional parameters to pass to the route
 */
function route(string $routeName, array|string|null $params = []): string
{
  $path = app()->route($routeName, $params);
  return url($path);
}