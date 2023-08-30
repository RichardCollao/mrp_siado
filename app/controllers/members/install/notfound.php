<?php

 class NotFoundController extends MainController
 {
     public function __construct()
     {
         parent::__construct();
     }

     public function index()
     {
         View::keep(path::appViews('notfound.php'), array(), 'content');
     }
 }