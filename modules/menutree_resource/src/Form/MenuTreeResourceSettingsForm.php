<?php
/**
 * @file
 * Contains \Drupal\menutree_resource\Form\MenuTreeResourceSettingsForm.
 */

namespace Drupal\menutree_resource\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Url;

class MenuTreeResourceSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'menutree_resource_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'menutree_resource.services_settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, Request $request = NULL) {
    $menutree_resource_config = $this->config('menutree_resource.services_settings');

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
      '#default_value' => $menutree_resource_config->get('services_menus'),
      '#description' => $this->t('Choose the menus that should be available as menu trees in the WunderHub API.'),
    );

    return parent::buildForm($form, $form_state);
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->config('menutree_resource.services_settings')
      ->set('services_menus', $values['services_menus'])
      ->save();
  }

}