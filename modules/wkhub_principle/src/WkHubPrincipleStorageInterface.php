<?php
/**
 * @file
 * Contains \Drupal\wkhub_principle\WkHubPrincipleStorageInterface.
 */

namespace Drupal\wkhub_principle;

/**
 * Defines a common interface for WunderPrinciple storage classes.
 */
interface WkHubPrincipleStorageInterface {
  /**
   * Gets principles.
   *
   * @return array
   *   An array of principle IDs.
   */
  public function getPrinciples();

  /**
   * Loads principles.
   *
   * Each principle entry consists of the following keys:
   *   - nid: The node ID of the principle entry itself.
   *
   * @param array $nids
   *   An array of node IDs.
   * @param bool $access
   *   Whether access checking should be taken into account.
   *
   * @return array
   *   Array of loaded book items.
   */
  public function loadMultiple($nids, $access = TRUE);
}
