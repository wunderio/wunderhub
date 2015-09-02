<?php
/**
 * @file
 * Contains \Drupal\wkhub_principle\WkHubPrincipleManagerInterface.
 */

namespace Drupal\wkhub_principle;

/**
 * Provides an interface defining a WkHub Principle Manager
 */
interface WkHubPrincipleManagerInterface {
  /**
   * Returns an array of all WunderPrinciples.
   *
   * This list may be used for generating a list of all the WunderPrinciples,
   * or for building the options for a form select.
   *
   * @return array
   *   An array of all WunderPrinciples.
   */
  public function getAllPrinciples();
}
