<?php

/**
 * @file
 * Renders administrative pages for Commerce Addressbook module
 */

function commerce_addressbook_admin_settings() {
  $form = array();

  $form['commerce_addressbook_auto_prefill'] = array(
    '#type' => 'checkbox',
    '#title' => t('Automatically prefill fields on checkout form with the latest saved customer profile info'),
    '#default_value' => variable_get('commerce_addressbook_auto_prefill', FALSE),
    );

  return system_settings_form($form);
}