<?php

app()->registerMiddleware('session.is-inactive', function () {
  $sessionExpiry = auth()->config('session.lifetime');
  $lastActivity = session()->get('auth.lastActivity');

  if ($lastActivity && time() - $lastActivity > $sessionExpiry) {
    if (auth()->logout()) {
      return response()->withFlash('warning', 'You have been logged out due to inactivity.');
    }
  }
});