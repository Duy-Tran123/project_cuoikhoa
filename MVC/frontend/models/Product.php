<?php
require_once 'models/Model.php';
class Product extends Model{

    public function getAll($params = []){
        $str_category_id = '';
        $str_price = '';
        if (isset($params['str_category_id'])){
            $str_category_id = " AND " . $params['str_category_id'];
        }
        if (isset($params['str_price'])){
            $str_price = " AND " . $params['str_price'];
        }
        $sql_select_all =
            "SELECT products.*, categories.name AS category_name
            FROM products
            INNER JOIN categories 
            ON products.category_id = categories.id
            WHERE TRUE $str_category_id $str_price";
        //comment lại điều kiện WHere cho việc test,
        // tuy nhiên thực tế sẽ dùng
//            WHERE categories.status=1 AND products.status=1";
        $obj_select_all =
            $this->connection->prepare($sql_select_all);
        $obj_select_all->execute();
        $products = $obj_select_all
            ->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
    public function getById($id) {
        $sql_select_one =
            "SELECT products.*, categories.name AS category_name
            FROM products
            INNER JOIN categories 
            ON products.category_id = categories.id
            WHERE products.id = $id";
        $obj_select_one =
            $this->connection->prepare($sql_select_one);
        $obj_select_one->execute();
        $product = $obj_select_one->fetch(PDO::FETCH_ASSOC);
        return $product;
    }
    public function getAllPagination($arr_params)
    {
        $limit = $arr_params['limit'];
        $page = $arr_params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT products.*, categories.name AS category_name FROM products 
                        INNER JOIN categories ON categories.id = products.category_id
//                      
                        ORDER BY products.updated_at DESC, products.created_at DESC
                        LIMIT $start, $limit
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM products ");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }
    public function getProduct(){
        $obj_select = $this->connection
            ->prepare("SELECT products.*, categories.name AS category_name FROM products 
                        INNER JOIN categories ON categories.id = products.category_id
                        LIMIT 8
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }
}