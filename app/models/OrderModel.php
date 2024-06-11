<?php

class OrderModel extends Database
{
  private $pdo;

  public function __construct()
  {
    $conn = $this->getConnection();
    $this->pdo = $conn;
  }

  public function create($clientId, $product, $quantity, $status)
  {
    try {
      $stm = $this->pdo->prepare("INSERT INTO orders (client_id, product, quantity, status) VALUES (?, ?, ?, ?)");
      $stm->execute([$clientId, $product, $quantity, $status]);

      return $this->findOne($this->pdo->lastInsertId());
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function findAll()
  {
    try {
      $stm = $this->pdo->query("SELECT * FROM orders");
      if ($stm->rowCount() > 0) {
        return $stm->fetchAll(PDO::FETCH_ASSOC);
      } else {
        return [];
      }
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function findAllWithClient()
  {
    try {
      $query = "SELECT
          orders.*,
          clients.name AS client_name,
          clients.email AS client_email
          FROM orders
          INNER JOIN clients ON clients.id = orders.client_id";
      $stm = $this->pdo->prepare($query);
      $stm->execute();
      if ($stm->rowCount() > 0) {
        return $stm->fetchAll(PDO::FETCH_ASSOC);
      } else {
        return [];
      }
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function findOne($id)
  {
    try {
      $stm = $this->pdo->prepare("SELECT * FROM orders WHERE id = ?");
      $stm->execute([$id]);

      if ($stm->rowCount() > 0) {
        return $stm->fetch(PDO::FETCH_ASSOC);
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function update($id, $clientId, $product, $quantity, $status)
  {
    try {
      $stm = $this->pdo->prepare("UPDATE orders SET client_id = ?, product = ?, quantity = ?, status = ? WHERE id = ?");
      $stm->execute([$clientId, $product, $quantity, $status, $id]);

      return $this->findOne($id);
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function delete($id)
  {
    try {
      $stm = $this->pdo->prepare("DELETE FROM orders WHERE id = ?");
      $stm->execute([$id]);
      if ($stm->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function findByClient($clientId)
  {
    try {
      $query = "SELECT
          orders.*,
          clients.name AS client_name,
          clients.email AS client_email
          FROM orders
          INNER JOIN clients ON clients.id = orders.client_id
          WHERE client_id = ?";
      $stm = $this->pdo->prepare($query);
      $stm->execute([$clientId,]);

      if ($stm->rowCount() > 0) {
        return $stm->fetchAll(PDO::FETCH_ASSOC);
      } else {
        return [];
      }
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function updateStatus($id, $status)
  {
    try {
      $stm = $this->pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
      $stm->execute([$status, $id]);

      return $this->findOne($id);
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function orderWithClient($id)
  {
    try {
      $query = "SELECT
          orders.*,
          clients.name AS client_name,
          clients.email AS client_email
          FROM orders
          INNER JOIN clients ON clients.id = orders.client_id
          WHERE orders.id = ?";
      $stm = $this->pdo->prepare($query);
      $stm->execute([$id,]);

      if ($stm->rowCount() > 0) {
        return $stm->fetch(PDO::FETCH_ASSOC);
      } else {
        return [];
      }
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
}
