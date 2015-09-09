<?php
/**
 * @file
 * Contains \Drupal\wk\Form\WunderHubServicesSettingsForm.
 */

namespace Drupal\wk\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Url;

class WunderHubServicesSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'wk_admin_services_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'wk.services_settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, Request $request = NULL) {
    $wk_services_config = $this->config('wk.services_settings');

    $menus = \Drupal::entityManager()->getStorage('menu')->loadMultiple();
    $menu_options = array();
    foreach ($menus as $menu) {
      $menu_options[$menu->id()] = $menu->label();
    }

    $form['menutree'] = array(
      '#type' => 'details',
      '#title' => $this->t('Available menus'),
      '#open' => TRUE,
    );

    $form['menutree']['services_menus'] = array(
      '#type' => 'checkboxes',
      '#title' => $this->t('Menus'),
      '#options' => $menu_options,
      '#default_value' => $wk_services_config->get('services_menus'),
      '#description' => $this->t('Choose the menus that should be available as menu trees in the WunderHub API.'),
    );

    return parent::buildForm($form, $form_state);
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->config('wk.services_settings')
      ->set('services_menus', $values['services_menus'])
      ->save();
  }

}