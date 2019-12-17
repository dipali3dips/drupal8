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
    // Check if the node id given is of page type and the $added_site_api_key is same as site api key on configuration page
    if($node->getType() == 'page' && $added_site_api_key_saved != 'No API Key yet' && $added_site_api_key_saved == $added_site_api_key){

    // return json response with node id supplied as argument
      return new JsonResponse($node->toArray(), 200, ['Content-Type'=> 'application/json']);
    }
    // Respond with access denied
    return new JsonResponse(["error" => "access denied"], 401, ['Content-Type'=> 'application/json']);
  }
}