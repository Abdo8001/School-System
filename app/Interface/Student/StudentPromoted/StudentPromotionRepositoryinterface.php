<?php

namespace  App\Interface\Student\StudentPromoted;

interface   StudentPromotionRepositoryinterface  {
// index function
public function index();
// promote the student function
 public function  store_New_promotion($request);
// show promotion and mange it
public function showAll();
// promotion delete function
public function DestroyAll($request);
}
