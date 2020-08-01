<?php
require_once 'controllers/Controller.php';
class AboutController extends Controller{
    public function about(){
        $this->content =
            $this->render('views/about/index.php');
        require_once 'views/layouts/main.php';
    }
}