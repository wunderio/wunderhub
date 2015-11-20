<?php

/**
 * @file
 * settings.php file for Drupal 8.
 */
// You should modify the hash_salt so that it is specific to your application.
$settings['hash_salt'] = '';
if (isset($_SERVER["WUNDERHUB_HASH_SALT"])) {
  $settings['hash_salt'] = file_get_contents($_SERVER["WUNDERHUB_HASH_SALT"]);
}
/**
 * Default Drupal 8 settings.
 *
 * These are already explained with detailed comments in Drupal's
 * default.settings.php file.
 *
 * See https://api.drupal.org/api/drupal/sites!default!default.settings.php/8
 */
$databases = array();
// Install with WK profile
$settings['install_profile'] = 'wk';
$settings['update_free_access'] = FALSE;
$settings['container_yamls'][] = __DIR__ . '/services.yml';

$config_directories = array();
// Paths for config files
if (isset($_SERVER["WUNDERHUB_DIR"])) {
  $config_directories = array(
    'active' => $_SERVER["WUNDERHUB_DIR"] . '/config/active',
    'staging' => $_SERVER["WUNDERHUB_DIR"] . '/config/staging',
  );
}
// Include Database, trusted host and other environment-specific settings in
// a settings.local.php file
if (file_exists(__DIR__ . '/settings.local.php')) {
  include __DIR__ . '/settings.local.php';
}
