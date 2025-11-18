<?php

app()->get('/', [
  function () {
    response()->redirect('/home');
  }
]);

app()->get('/login', [
  'middleware' => 'guest.required',
  'name' => 'login',
  function () {
    response()->render('pages.login');
  }
]);

app()->post('/auth/login', [
  'middleware' => 'guest.required',
  'name' => 'auth.login',
  function () {
    $data = request()->postData();
    $success = auth()->login([
      'username' => $data['username'],
      'password' => $data['password']
    ]);

    if ($success) {
      response()->redirect('/home');
    }
    response()->withFlash('danger', 'Invalid username or password')->redirect('/login');
  }
]);

app()->group('/', [
  'middleware' => 'auth.required',
  function () {
    app()->get('/home', [
      'name' => 'home',
      function () {
        response()->render('pages.home');
      }
    ]);

    app()->get('/logout', [
      'name' => 'logout',
      function () {
        auth()->logout();
        response()->redirect('/login');
      }
    ]);
  }
]);