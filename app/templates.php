<?php

app()->attachView(Leaf\Blade::class);
app()->blade()->configure([
  'views' => 'app/views',
  'cache' => 'storage/cache'
]);
