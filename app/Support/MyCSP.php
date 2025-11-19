<?php

namespace App\Support;

class MyCSP
{
  private array $rules = [];
  private bool $reportOnly = false;

  public function add(string $directive, array $values): self
  {
    $directive = strtolower($directive);

    if (isset($this->rules[$directive])) {
      $this->rules[$directive] = array_unique(array_merge($this->rules[$directive], $values));
    } else {
      $this->rules[$directive] = $values;
    }

    return $this;
  }

  public function reportOnly(bool $enabled = true): self
  {
    $this->reportOnly = $enabled;

    // Remove upgrade-insecure-requests if switching to report-only
    if ($enabled && isset($this->rules['upgrade-insecure-requests'])) {
      unset($this->rules['upgrade-insecure-requests']);
    }

    return $this;
  }

  public function header(): string
  {
    $parts = [];

    foreach ($this->rules as $directive => $values) {
      if (empty($values)) {
        $parts[] = $directive;
      } else {
        $parts[] = $directive . ' ' . implode(' ', $values);
      }
    }

    return implode('; ', $parts);
  }

  public function headerName(): string
  {
    return $this->reportOnly
      ? 'Content-Security-Policy-Report-Only'
      : 'Content-Security-Policy';
  }
}