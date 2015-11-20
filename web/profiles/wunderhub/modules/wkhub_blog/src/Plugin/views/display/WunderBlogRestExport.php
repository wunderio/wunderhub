<?php
/**
 * @file
 * Contains \Drupal\wkhub_blog\Plugin\views\display\WunderBlogRestExport.
 */

namespace Drupal\wkhub_blog\Plugin\views\display;

use Drupal\views\Plugin\views\display\ResponseDisplayPluginInterface;
use Drupal\rest\Plugin\views\display\RestExport;

/**
 * The plugin that handles Data response callbacks for REST resources.
 *
 * @ingroup views_display_plugins
 *
 * @ViewsDisplay(
 *   id = "rest_export",
 *   title = @Translation("REST export"),
 *   help = @Translation("Create a REST export resource."),
 *   uses_route = TRUE,
 *   admin = @Translation("REST export"),
 *   returns_response = TRUE
 * )
 */
class WunderBlogRestExport extends RestExport implements ResponseDisplayPluginInterface {
  /**
   * {@inheritdoc}
   */
  public function usesExposed() {
    return TRUE;
  }
}
