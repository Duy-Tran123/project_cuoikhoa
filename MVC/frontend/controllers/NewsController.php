<?php
require_once 'controllers/Controller.php';
class NewsController extends Controller{
    public function news(){
        $this->content =
            $this->render('views/news/index.php');
        require_once 'views/layouts/main.php';
    }
    public function newsDetail(){
        $this->content =
            $this->render('views/news/news_detail.php');
        require_once 'views/layouts/main.php';
    }

}