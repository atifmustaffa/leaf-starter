<?php

app()->registerMiddleware('auth.required', function () {
  if (!auth()->user()) {
    response()->redirect('/login');
  }
});

app()->registerMiddleware('guest.required', function () {
  if (auth()->user()) {
    response()->redirect('/home');
  }
});