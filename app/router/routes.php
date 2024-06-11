<?php

$routes = [
  '/' => 'HomeController@index',
  '/login' => 'HomeController@login',
  '/verify' => 'HomeController@verifyCredentials',
  '/logout' => 'HomeController@logout',

  '/importIndex' => 'ImportController@index',
  '/import' => 'ImportController@import',

  '/client' => 'ClientController@index',
  '/client/create' => 'ClientController@create',
  '/client/store' => 'ClientController@store',
  '/client/{id}' => 'ClientController@edit',
  '/client/update/{id}' => 'ClientController@update',
  '/client/delete/{id}' => 'ClientController@delete',
  '/client/typeClients' => 'ClientController@fetchClientsByType',

  '/order' => 'OrderController@index',
  '/order/create' => 'OrderController@create',
  '/order/store' => 'OrderController@store',
  '/order/{id}' => 'OrderController@edit',
  '/order/update/{id}' => 'OrderController@update',
  '/order/delete/{id}' => 'OrderController@delete',
  '/order/client/{id}' => 'OrderController@orderByClient',

  '/mail/statement' => 'MailController@index',
  '/mail/sendStatement' => 'MailController@sendStatement',
  '/mail/order-status' => 'MailController@orderStatusMail',
  '/mail/sendOrderStatus' => 'MailController@sendOrderStatus'
];