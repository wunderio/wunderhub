<?php

/**
 * @file
 * Contains \Drupal\wk\Plugin\Filter\WunderHubFilterImageAbsoluteUrls.
 */

namespace Drupal\wk\Plugin\Filter;

use Drupal\Component\Utility\Html;
use Drupal\Component\Utility\Unicode;
use Drupal\Core\Url;
use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * Provides a filter to caption elements.
 *
 * When used in combination with the filter_align filter, this must run last.
 *
 * @Filter(
 *   id = "filter_image_absolute_urls",
 *   title = @Translation("Absolute URLs for images"),
 *   description = @Translation("Ensure all images have absolute URLs."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_REVERSIBLE
 * )
 */
class WunderHubFilterImageAbsoluteUrls extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $result = new FilterProcessResult($text);
    if (stristr($text, '<img ') !== FALSE) {
      $dom = Html::load($text);
      $images = $dom->getElementsByTagName('img');
      foreach ($images as $image) {
        $src = $image->getAttribute("src");

        // The src must be non-empty.
        if (Unicode::strlen($src) === 0) {
          continue;
        }
        // The src must not already be an external URL
        if (stristr($src, 'http://') !== FALSE || stristr($src, 'https://') !== FALSE) {
          continue;
        }
        $url = Url::fromUri('internal:' . $src, array('absolute' => TRUE));
        $url_string = $url->toString();
        $image->setAttribute('src', $url_string);
      }

      $result->setProcessedText(Html::serialize($dom));
    }

    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function tips($long = FALSE) {
    return $this->t('URLs for images will be automatically turned into absolute URLs.');
  }
}
