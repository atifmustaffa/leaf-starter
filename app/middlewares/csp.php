<?php

use App\Support\MyCSP;

app()->register('nonce', function ($c) {
  return base64_encode(random_bytes(16));
});

app()->blade()->directive('cspNonce', function () {
  return "<?php echo 'nonce=\"' . app()->nonce . '\"'; ?>";
});

app()->use(function () {

  $nonce = app()->nonce;

  $csp = new MyCSP();
  $csp
    ->add('default-src', ["'self'"])

    ->add('script-src', [
      "'self'",
      "'nonce-{$nonce}'",
      'https://cdn.jsdelivr.net'
    ])

    ->add('style-src', [
      "'self'",
      "'nonce-{$nonce}'",
      'https://cdn.jsdelivr.net',
      'https://fonts.googleapis.com'
    ])

    ->add('font-src', [
      "'self'",
      'https://fonts.gstatic.com',
      'https://cdn.jsdelivr.net'
    ])

    ->add('img-src', [
      "'self'",
      'data:',
      'blob:'
    ])

    ->add('connect-src', [
      "'self'",
      'https://cdn.jsdelivr.net'
    ])

    ->add('form-action', ["'self'"])

    ->add('frame-ancestors', ["'none'"])

    ->add('object-src', ["'none'"])

    ->add('base-uri', ["'self'"])

    ->add('upgrade-insecure-requests', [])

    ->reportOnly(app()->config('mode') === 'development');

  // Build headers array
  $headers = [
    $csp->headerName()       => $csp->header(),
    'X-Content-Type-Options' => 'nosniff',
    'X-Frame-Options'        => 'DENY',
    'X-XSS-Protection'       => '1; mode=block',
    'Referrer-Policy'        => 'strict-origin-when-cross-origin',
    'Permissions-Policy'     => 'geolocation=(), microphone=(), camera=()'
  ];

  // Set all headers at once
  app()->response()->withHeader($headers);
});