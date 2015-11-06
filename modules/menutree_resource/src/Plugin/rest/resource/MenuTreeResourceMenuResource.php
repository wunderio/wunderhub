<?php
/**
 * @file
 * Contains \Drupal\menutree_resource\Plugin\rest\resource\MenuTreeResourceMenuResource.
 */

namespace Drupal\menutree_resource\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\Core\Menu\MenuTreeParameters;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Provides a resource for displaying menu trees.
 *
 * @RestResource(
 *   id = "menutree",
 *   label = @Translation("Resource: Menu tree"),
 *   uri_paths = {
 *     "canonical" = "/api/menutree/{menu}"
 *   }
 * )
 */
class MenuTreeResourceMenuResource extends ResourceBase {

  /**
   * Responds to GET requests.
   *
   * Returns a menu tree for the specified menu name.
   *
   * @param int $menu_name
   *   The machine name of the Drupal menu.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The response containing the menu tree.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   */
  public function get($menu_name = NULL) {
    if ($menu_name) {
      // Get menu tree resource config, set at /admin/config/services/menutree.
      $config = \Drupal::config('menutree_resource.services_settings');
      $services_menus = $config->get('services_menus');

      // Only allow a response if the menu is in config
      if (in_array($menu_name, array_filter(array_values($services_menus)))) {
        $menu_tree = \Drupal::menuTree();
        $parameters = new MenuTreeParameters();
        $parameters->onlyEnabledLinks();
        $tree = $menu_tree->load($menu_name, $parameters);

        if (!empty($tree)) {

          $manipulators = array(
            array('callable' => 'menu.default_tree_manipulators:checkAccess'),
            array('callable' => 'menu.default_tree_manipulators:generateIndexAndSort'),
          );
          $tree = $menu_tree->transform($tree, $manipulators);
          $build = $menu_tree->build($tree);
          // Clean the menu tree so it's ready for serialisation in a resource response.
          $items = $this->clean_tree($build['#items']);

          return new ResourceResponse($items);
        }

        throw new NotFoundHttpException(t('Menu with name @menu_name was not found', array('@menu_name' => $menu_name)));
      }

      throw new NotFoundHttpException(t('Menu tree @menu_name not allowed.', array('@menu_name' => $menu_name)));
    }

    throw new HttpException(t('No menu name was provided'));
  }

  /**
   * Clean a menu tree, adding the generated menu item URLs from their URL object
   *
   * @param $items
   * @return array - cleaned menu tree
   */
  private function clean_tree($items) {
    foreach ($items as $k => $item) {
      $options = $item['url']->getOptions();
      $url = $item['url']->setOptions($options)->toString(TRUE);
      $item['path'] = $url->getGeneratedUrl();
      // Keeping these two objects in the tree cause serialization problems, and are not really needed.
      unset($item['url']);
      unset($item['original_link']);
      if (!empty($item['below'])) {
        // If there's child items, clean them also
        $item['below'] = $this->clean_tree($item['below']);
      }
      $items[$k] = $item;
    }
    return $items;
  }
}
