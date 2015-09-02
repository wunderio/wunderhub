<?php
/**
 * @file
 * Contains \Drupal\wkhub_principle\WkHubPrincipleManager.
 */

namespace Drupal\wkhub_principle;

use Drupal\wkhub_principle\WkHubPrincipleStorageInterface;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Defines as WunderPrinciple manager.
 */
class WkHubPrincipleManager implements WkHubPrincipleManagerInterface {

  /**
   * Principles Array.
   *
   * @var array
   */
  protected $principles;

  /**
   * Entity manager Service Object.
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityManager;

  /**
   * Config Factory Service Object.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Book outline storage.
   *
   * @var \Drupal\wkhub_principle\WkHubPrincipleStorageInterface
   */
  protected $principleStorage;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * Constructs a WkHubPrincipleManager object.
   */
  public function __construct(EntityManagerInterface $entityManager, TranslationInterface $translation, ConfigFactoryInterface $configFactory, WkHubPrincipleStorageInterface $principleStorage, RendererInterface $renderer) {
    $this->entityManager = $entityManager;
    $this->stringTranslation = $translation;
    $this->configFactory = $configFactory;
    $this->principleStorage = $principleStorage;
    $this->renderer = $renderer;
  }

  /**
   * {@inheritdoc}
   */
  public function getAllPrinciples() {
    if (!isset($this->principles)) {
      $this->loadPrinciples();
    }
    return $this->principles;
  }

  /**
   * Loads Principles Array.
   */
  protected function loadPrinciples() {
    $this->principles = array();
    $nids = $this->principleStorage->getPrinciples();

    if ($nids) {
      $principle_links = $this->principleStorage->loadMultiple($nids);
      $nodes = $this->entityManager->getStorage('node')->loadMultiple($nids);

      // @todo: use route name for links, not system path.
      foreach ($principle_links as $link) {
        $nid = $link['nid'];
        if (isset($nodes[$nid]) && $nodes[$nid]->isPublished()) {
          $link['uuid'] = $nodes[$nid]->uuid();
          $link['title'] = $nodes[$nid]->label();
          $link['type'] = $nodes[$nid]->bundle();
          $link['url'] = $nodes[$nid]->url();
//          $link['url_info'] = $nodes[$nid]->urlInfo();
          $this->principles[$link['nid']] = $link;
        }
      }
    }
  }

}
