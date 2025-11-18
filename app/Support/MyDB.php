<?php

namespace App\Support;

class MyDb
{
  protected $db;
  protected $myConnections;

  protected $currentConnection;

  public function __construct(\Leaf\Db $db, array $myConnections = [])
  {
    $this->db = $db;
    $this->myConnections = $myConnections;
    $this->currentConnection = null;
  }

  /**
   * Switch DB connection
   */
  public function useConnection(string $name): self
  {
    if (!isset($this->myConnections[$name])) {
      throw new \Exception("Unknown DB connection: {$name}");
    }

    $this->currentConnection = $this->db->connection($this->myConnections[$name]);

    return $this;
  }

  public function getConnection(): \PDO
  {
    return $this->currentConnection;
  }

  public function addConnection(string $name, \PDO $pdo): self
  {
    $this->myConnections[$name] = $pdo;
    return $this;
  }

  /**
   * Proxy to any missing method (magic forwarder)
   */
  public function __call($method, $args)
  {
    if (!method_exists($this->db, $method)) {
      throw new \BadMethodCallException("Method {$method} does not exist on Leaf\\Db");
    }

    return $this->db->$method(...$args);
  }
}