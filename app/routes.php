<?php

app()->get('/', [
  function () {
    return response()->redirect(['dashboard']);
  }
]);

app()->get('/auth/login', [
  'middleware' => 'auth.guest',
  'name'       => 'auth.login',
  function () {
    return response()->render('pages.login');
  }
]);

app()->post('/auth/login', [
  'middleware' => 'auth.guest',
  'name'       => 'auth.login',
  function () {
    $data = request()->postData();
    $success = auth()->login([
      'username' => $data['username'],
      'password' => $data['password']
    ]);

    if ($success) {
      return response()->redirect(['dashboard']);
    }
    return response()->withFlash('danger', 'Invalid username or password')->redirect(['auth.login']);
  }
]);

app()->group('/', [
  'middleware' => ['session.is-inactive', 'auth.required'],
  function () {
    app()->get('/dashboard', [
      'name' => 'dashboard',
      function () {
        return response()->render('pages.dashboard');
      }
    ]);

    app()->get('/auth/logout', [
      'name' => 'auth.logout',
      function () {
        if (auth()->logout()) {
          return response()->redirect(['auth.login']);
        } else {
          return response()->withFlash('danger', 'Failed to logout')->redirect(['dashboard']);
        }
      }
    ]);
  }
]);