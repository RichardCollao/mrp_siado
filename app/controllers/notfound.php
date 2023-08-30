<?php

 class NotFound extends MainController
 {
     public function __construct()
     {
         parent::__construct();
     }

     public function index()
     {
         View::keep('notfound.php', array(), 'content');
     }
 }

?>