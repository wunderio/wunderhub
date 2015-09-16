<?php
/**
 * @file
 * Contains \Drupal\wkhub_principle\WkHubPrincipleStorage.
 */

namespace Drupal\wkhub_principle;

use Drupal\Core\Database\Connection;

class WkHubPrincipleStorage implements WkHubPrincipleStorageInterface {

  /**
   * Database Service Object.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * Constructs a WkHubPrincipleStorage object.
   */
  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  /**
   * {@inheritdoc}
   */
  public function getPrinciples() {
    return $this->connection->query("SELECT DISTINCT(nid) FROM {node} WHERE type = :type", array(':type' => 'wunderprinciple'))->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function loadMultiple($nids, $access = TRUE) {
    $query = $this->connection->select('node', 'n', array('fetch' => \PDO::FETCH_ASSOC));
    $query->fields('n');
    $query->condition('n.nid', $nids, 'IN');

    if ($access) {
      $query->addTag('node_access');
    }

    return $query->execute();
  }
}