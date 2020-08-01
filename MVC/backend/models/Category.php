<?php
require_once 'models/Model.php';
class Category extends Model{
    public $id;
    public $name;
    public $avatar;
    public $description;
    public $status;
    public $created_at;
    public $updated_at;
    public function insert(){
        $sql_insert =
            "INSERT INTO categories(`name`, `avatar`, `description`, `status`)
            VALUES (:name, :avatar, :description, :status)";
        //cbi đối tượng truy vấn
        $obj_insert = $this->connection
            ->prepare($sql_insert);
        //gán giá trị thật cho các placeholder
        $arr_insert = [
            ':name' => $this->name,
            ':avatar' => $this->avatar,
            ':description' => $this->description,
            ':status' => $this->status
        ];
        return $obj_insert->execute($arr_insert);
    }
    public function getAll($params = []){
        echo "<pre>";
        print_r($params);
        echo "</pre>";
        $str_search = 'WHERE TRUE';
        if (isset($params['name']) && !empty($params['name'])){
            $name = $params['name'];
            $str_search .= " AND `name` LIKE '%$name%'";
        }
        if (isset($params['status'])){
            $status = $params['status'];
            $str_search .= " AND `status` = $status";
        }
        $start = isset($params['start']) ? $params['start'] : 0;
        $limit = isset($params['limit']) ? $params['limit'] : 1000;
        $obj_select_all = $this->connection->prepare(
            "SELECT * FROM categories $str_search 
            LIMIT $start,$limit");
        $obj_select_all->execute();
        $categories = $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }
    public function getTotal() {
        //count tổng số bản ghi sẽ thì count dựa trên khóa chính
        $sql_select_count =
            "SELECT COUNT(id) AS count_id FROM categories";
        $obj_select_count = $this->connection
            ->prepare($sql_select_count);
        $obj_select_count->execute();
        //vì mục đích là trả về 1 số và câu truy vấn
        // chỉ select duy nhất 1 trường là tổng số bản ghi
        //nên sẽ gọi phương thức fetchColmn để trả về giá trị
        //của cột trong câu truy vấn select luôn
        $count = $obj_select_count->fetchColumn();
//      var_dump($count);
        return $count;
    }
    public function getCategoryById($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM categories WHERE id = $id");
        $obj_select->execute();
        $category = $obj_select->fetch(PDO::FETCH_ASSOC);

        return $category;
    }
    public function update($id)
    {
        $obj_update = $this->connection->prepare("UPDATE categories SET `name` = :name, `avatar` = :avatar, `description` = :description, `status` = :status, `updated_at` = :updated_at 
         WHERE id = $id");
        $arr_update = [
            ':name' => $this->name,
            ':avatar' => $this->avatar,
            ':description' => $this->description,
            ':status' => $this->status,
            ':updated_at' => $this->updated_at,
        ];

        return $obj_update->execute($arr_update);
    }
    public function delete($id)
    {
        $obj_delete = $this->connection
            ->prepare("DELETE FROM categories WHERE id = $id");
        $is_delete = $obj_delete->execute();
        //để đảm bảo toàn vẹn dữ liệu, sau khi xóa category thì cần xóa cả các product nào đang thuộc về category này
        $obj_delete_product = $this->connection
            ->prepare("DELETE FROM products WHERE category_id = $id");
        $obj_delete_product->execute();

        return $is_delete;
    }
}