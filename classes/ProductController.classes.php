<?php

class ProductController extends Dbh {

    /**
     * @var string $table;
     */

    private $table = "products";

    private function executeStmt(string $command, array $values)
    {
        $stmt = $this->connect()->prepare($command);

        if(!$stmt->execute($values)) {
            $stmt = null;
            return false;
        }
        $stmt = null;

        return true;
    }

    public function insertProduct(string $title, float $price, int $quantity, string $img):boolval
    {
        $command = "INSERT INTO " .$this->table ." (title, price, quantity, image_name) VALUES (?, ?, ?, ?);";
        $done = $this->executeStmt($command, array($title, $price, $quantity, $img));
        return $done;
    }

    public function deleteProduct(int $id):boolval
    {
        $command = "DELETE FROM " .$this->table ." WHERE id = ?;";
        $done = $this->executeStmt($command, array($id));
        return $done;
    }

    public function editProduct(int $id, string $title, float $price, int $quantity, $img):boolval
    {
        if($img == null) {
            $command = "UPDATE " .$this->table ." SET title = ?, price = ?, quantity = ? WHERE id = ?;";
            $done = $this->executeStmt($command, array($title, $price, $quantity, $id));
            return $done;
        }

        $command = "UPDATE " .$this->table ." SET title = ?, price = ?, quantity = ?, image_name = ? WHERE id = ?;";
        $done = $this->executeStmt($command, array($title, $price, $quantity, $img, $id));
        return $done;
    }

    public function fetchProduct():array
    {
        $command = $this->connect()->prepare("SELECT * FROM " .$this->table);

        if(!$command->execute()) {
            $command = null;
            die();
        }

        $fetchedDat = $command->fetchAll(PDO::FETCH_ASSOC);
        $command = null;

        return $fetchedDat;
    }

    public function addImage($file):string
    {
        $fileName = explode('.', $file['name']);
        $fileExt = end($fileName);
        $image = uniqid('', true) ."." .strtolower($fileExt);
        $fileDestination = '../images/products/' .$image;

        move_uploaded_file($file['tmp_name'], $fileDestination);

        return $image;
    }

    public function echoJson(array $arr) {
        echo @json_encode(array(
            'success' => 'true',
            'data' => $arr)
        );
    }
}