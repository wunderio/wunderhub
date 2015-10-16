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

    // Team item
    $team_url =  Url::fromUri('base:/api/team{/:uid}', array('absolute' => TRUE));
    $items['team_url'] = urldecode($team_url->toString());

    // Menu tree item
    $menutree_url = Url::fromUri('base:/api/menutree/:menu_name', array('absolute' => TRUE));
    $items['menutree_url'] = urldecode($menutree_url->toString());

    foreach (Views::getEnabledViews() as $view) {
//      foreach ($view->get('display') as $display) {
//        if ($display['display_plugin'] == 'rest_export') {
//          print_r($display);
//        }
//      }
      foreach ($view->get('display') as $display) {

        if ($display['display_plugin'] == 'rest_export')
        print_r($view->get('id') . ' | ');
        print '<pre>';
        print_r($display['display_options']);
        print '</pre>';
//        print "\n";
//        break;
      }
    }


    return new ResourceResponse($items);
  }

  public function access() {
    return AccessResult::allowed()->setCacheMaxAge(0);
  }

}
