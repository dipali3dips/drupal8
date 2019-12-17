<?php 
namespace Drupal\add_siteapi_key\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * Add Form Field for site settings form
   *
   * @param \Symfony\Component\Routing\RouteCollection $collection
   *   RouteCollection object.
   */
  protected function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('system.site_information_settings')) { 
      $route->setDefault('_form', '\Drupal\add_siteapi_key\Form\AddFieldToSiteInformationForm');
    }	  
  }

}