<?php
/**
 * @file
 * Contains \Drupal\add_siteapi_key\Controller\AddSiteApiKeyController.
 */
namespace Drupal\add_siteapi_key\Controller;

use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


class AddSiteApiKeyController{
  /**
   * @param $added_site_api_key SITE API key
   * @param NodeInterface $node
   * @return JsonResponse
   */
  public function content($added_site_api_key, NodeInterface $node){
    // Site API Key configuration value
    $added_site_api_key_saved = \Drupal::config('system.site')->get('siteapikey');
    // Make sure the supplied node is a page, the configuration key is set and matches the supplied key
    if($node->getType() == 'page' && $added_site_api_key_saved != 'No API Key yet' && $added_site_api_key_saved == $added_site_api_key){

    // Respond with the json representation of the node
      return new JsonResponse($node->toArray(), 200, ['Content-Type'=> 'application/json']);
    }
    // Respond with access denied
    return new JsonResponse(array("error" => "access denied"), 401, ['Content-Type'=> 'application/json']);
  }
}