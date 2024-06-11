<?php

class ClientModel extends Database
{
  private $pdo;

  public function __construct()
  {
    $conn = $this->getConnection();
    $this->pdo = $conn;
  }

  public function create($name, $email, $type, $last_order_date, $last_order_cost)
  {
    try {
      $stm = $this->pdo->prepare("INSERT INTO clients (name, email, type, last_order_date, last_order_cost) VALUES (?, ?, ?, ?, ?)");
      $stm->execute([$name, $email, $type, $last_order_date, $last_order_cost]);

      return $this->findOne($this->pdo->lastInsertId());
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function findAll()
  {
    try {
      $stm = $this->pdo->query("SELECT * FROM clients");
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
      $stm = $this->pdo->prepare("SELECT * FROM clients WHERE id = ?");
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

  public function update($id, $name, $email, $last_order_date, $last_order_cost)
  {
    try {
      $stm = $this->pdo->prepare("UPDATE clients SET name = ?, email = ?, last_order_date = ?, last_order_cost = ? WHERE id = ?");
      $stm->execute([$name, $email, $last_order_date, $last_order_cost, $id]);

      return $this->findOne($id);
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function delete($id)
  {
    try {
      $stm = $this->pdo->prepare("DELETE FROM clients WHERE id = ?");
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

  public function checkClientExists($nameOrEmail)
  {
    try {
      $stm = $this->pdo->prepare("SELECT * FROM clients WHERE name = ? or email = ?");
      $stm->execute([$nameOrEmail, $nameOrEmail]);

      if ($stm->rowCount() > 0) {
        return $stm->fetch(PDO::FETCH_ASSOC);
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function findByType($type)
  {
    try {
      $query = "SELECT * FROM clients WHERE type = ?";
      $stm = $this->pdo->prepare($query);
      $stm->execute([$type]);
      if ($stm->rowCount() > 0) {
        return $stm->fetchAll(PDO::FETCH_ASSOC);
      } else {
        return [];
      }
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
}
