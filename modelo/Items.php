<?php

class Items
{
  public $conn;
  public $itemsTable = 'items'; // Default table name

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  public function create(string $name, string $description, int $price, int $category_id): bool
  {
    $stmt = $this->conn->prepare("
      INSERT INTO {$this->itemsTable} (`name`, `description`, `price`, `category_id`)
      VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param('ssii', $name, $description, $price, $category_id);

    if ($stmt->execute()) {
      return true;
    } else {
      // Handle errors (e.g., throw an exception)
      throw new PDOException($stmt->error);
    }
  }

  public function read(int $id = null): mysqli_result
  {
    $stmt = $this->conn->prepare(
      $id ?
        "SELECT * FROM {$this->itemsTable} WHERE id = ?" :
        "SELECT * FROM {$this->itemsTable}"
    );

    if ($id) {
      $stmt->bind_param('i', $id);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
  }

  public function update(int $id, string $name, string $description, int $price, int $category_id): bool
  {
    $stmt = $this->conn->prepare("
      UPDATE {$this->itemsTable}
      SET name = ?, description = ?, price = ?, category_id = ?
      WHERE id = ?
    ");

    $stmt->bind_param('ssiii', $name, $description, $price, $category_id, $id);

    if ($stmt->execute()) {
      return true;
    } else {
      // Handle errors (e.g., throw an exception)
      throw new PDOException($stmt->error);
    }
  }

  public function delete(int $id): bool
  {
    $stmt = $this->conn->prepare("
      DELETE FROM {$this->itemsTable}
      WHERE id = ?
    ");

    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
      return true;
    } else {
      // Handle errors (e.g., throw an exception)
      throw new PDOException($stmt->error);
    }
  }
}
