<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/Category.php';
require_once 'models/Pagination.php';
class ProductController extends Controller{
    public function index()
    {
        $product_model = new Product();

        //lấy tổng số bản ghi đang có trong bảng products
        $count_total = $product_model->countTotal();
        //        xử lý phân trang
        $query_additional = '';
        if (isset($_GET['title'])) {
            $query_additional .= '&title=' . $_GET['title'];
        }
        if (isset($_GET['category_id'])) {
            $query_additional .= '&category_id=' . $_GET['category_id'];
        }
        $arr_params = [
            'total' => $count_total,
            'limit' => 8,
            'query_string' => 'page',
            'controller' => 'product',
            'action' => 'index',
            'full_mode' => false,
            'query_additional' => $query_additional,
            'page' => isset($_GET['page']) ? $_GET['page'] : 1
        ];
        $params = [];
        if (isset($_POST['filter'])){
            $str_price = '';
            $str_category_id = '';
            if (isset($_POST['category'])){
                $str_category_id = implode(',',$_POST['category']);
                $str_category_id = "($str_category_id)";
                $str_category_id = "products.category_id IN $str_category_id";
                $params['str_category_id'] = $str_category_id;
            }
            if (isset($_POST['price'])){
                foreach ($_POST['price'] AS $price){
                    switch ($price){
                        case 1:$str_price .= " OR products.price < 100";
                            break;
                        case 2:$str_price .= " OR (products.price BETWEEN 100 AND 200)";
                            break;
                        case 3: $str_price .= " OR (products.price BETWEEN 200 AND 300)";
                            break;
                        case 4: $str_price .= " OR (products.price > 300)";
                            break;
                    }
                }
                $str_price = substr($str_price,3);
                $str_price = "($str_price)";
                $params['str_price'] = $str_price;
            }

        }
        $category_model = new Category();
        $categories = $category_model->getAll();
        $product_model = new Product();
        $products = $product_model->getAll($params);
        $product = $product_model->getAllPagination($arr_params);
        $pagination = new Pagination($arr_params);
        $pages = $pagination->getPagination();

        //lấy danh sách category đang có trên hệ thống để phục vụ cho search
        $category_model = new Category();
        $categories = $category_model->getAll();

        $this->content = $this->render('views/products/show_all.php', [
            'product' => $product,
            'categories' => $categories,
            'pages' => $pages,
            'products' => $products

        ]);

        require_once 'views/layouts/main.php';
    }
    public function detail(){
        $id = $_GET['id'];
        $product_model = new Product();
        $product = $product_model->getById($id);
        $this->content = $this->render('views/products/detail.php',[
            'product' => $product
        ]);
        require_once 'views/layouts/main.php';
    }
    public function showAll(){


        $this->content = $this->render('views/products/show_all.php',[
            'categories' => $categories,
            'products' => $products
        ]);
        require_once 'views/layouts/main.php';
    }
}