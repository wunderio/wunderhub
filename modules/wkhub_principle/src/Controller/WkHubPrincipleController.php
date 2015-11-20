<?php
/**
 * @file
 * Contains Drupal\wkhub_principle\Controller\WkHubPrincipleController
 */

namespace Drupal\wkhub_principle\Controller;

use Drupal\wkhub_principle\WkHubPrincipleManagerInterface;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Render\RendererInterface;
use Drupal\Component\Utility\Xss;

class WkHubPrincipleController extends ControllerBase {

  /**
   * The principle manager.
   *
   * @var \Drupal\wkhub_principle\WkHubPrincipleManagerInterface
   */
  protected $principleManager;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * Constructs a WkHubPrincipleController object.
   *
   * @param \Drupal\wkhub_principle\WkHubPrincipleManagerInterface $principleManager
   *   The principle manager.
   */
  public function __construct(WkHubPrincipleManagerInterface $principleManager, RendererInterface $renderer) {
    $this->principleManager = $principleManager;
    $this->renderer = $renderer;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('wkhub_principle.manager'),
      $container->get('renderer')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function zen() {
    $principles = $this->principleManager->getAllPrinciples();
    $title = t('My mind is empty.');
    if (count($principles) > 0 ){
      // Get a random item from the array of principles
      $k = array_rand($principles);
      $principle = $principles[$k];
      $title = Xss::filter($principle->title);
    }
    $build = array(
      '#type' => 'markup',
      '#markup' => $title,
    );
    return new Response(\Drupal::service('renderer')->renderRoot($build));
  }

}
