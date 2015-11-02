<?php
/**
 * @file
 * Contains \Drupal\wk\Plugin\rest\resource\WunderHubApiResource.
 */

namespace Drupal\wk\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\Core\Url;
use Drupal\Core\Access\AccessResult;
use Drupal\views\Views;

/**
 * Provides a root resource for the WunderHub API to facilitate self-discovery.
 *
 * @RestResource(
 *   id = "root",
 *   label = @Translation("WunderHub: API self-discovery"),
 *   uri_paths = {
 *     "canonical" = "/api"
 *   }
 * )
 */
class WunderHubApiResource extends ResourceBase {

  /**
   * Responds to GET requests.
   *
   * Returns a menu tree for the specified menu name.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The response containing the menu tree.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   */
  public function get() {
    $items = array();

    // Menu tree item
    $menutree_url = Url::fromUri('base:/api/menutree/:menu_name', array('absolute' => TRUE));
    $items['menutree_url'] = urldecode($menutree_url->toString());

    // Get all enabled Views in the site with a RESTful export
    foreach (Views::getEnabledViews() as $view) {
      foreach ($view->get('display') as $display) {
        // Get all views with a RESTful export that are accessible to the request
        if ($display['display_plugin'] == 'rest_export' && $view->access($display['id'])) {
          // If the view path has a placeholder, replace it with something more readable
          $view_path = str_replace('/%', '{/:item_id}', $display['display_options']['path']);
          $view_url = Url::fromUri('base:' . $view_path, array('absolute' => TRUE));
          // Can we just overwrite paths of the same view?
          $items[$view->get('id') . '_url'] = urldecode($view_url->toString());
        }
      }
    }


    return new ResourceResponse($items);
  }

  public function access() {
    return AccessResult::allowed()->setCacheMaxAge(0);
  }

}
