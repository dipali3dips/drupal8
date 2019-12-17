<?php

namespace Drupal\add_siteapi_key\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;

/**
 * Add the SITE API key.
 */
class AddFieldToSiteInformationForm extends SiteInformationForm {

  /**
   * Create Field SITE API key.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $site_config = $this->config('system.site');
    $form =  parent::buildForm($form, $form_state);
	$form['site_information']['siteapikey'] = [
      '#type' => 'textfield',
      '#title' => t('Site API Key'),
      '#default_value' => $site_config->get('siteapikey') ?: 'No API Key yet',
	  '#description' => t("Set the Site API Key"),
    ];
    $form['actions']['submit']['#value'] = t('Update configuration');
    return $form;
  }

  /**
   * {@inheritdoc}
   */  
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('system.site')
      ->set('siteapikey', $form_state->getValue('siteapikey'))
      ->save();
    parent::submitForm($form, $form_state);

	// Add message that Site API Key has been set
    drupal_set_message("Successfully saved Site API Key - " . $form_state->getValue('siteapikey'));
  }

}