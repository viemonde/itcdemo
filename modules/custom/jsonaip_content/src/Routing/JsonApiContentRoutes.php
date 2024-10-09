<?php

namespace Drupal\jsonapi_content\Routing;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

/**
 * Defines JSON API content routes.
 */
class JsonApiContentRoutes {
  /**
   * Returns the collection of routes.
   */
  public function routes() {
    $collection = new RouteCollection();

    // Route for handling path-based requests.
    $collection->add('jsonapi_content.path', new Route(
      '/jsonapi/path',
      [
        '_controller' => '\Drupal\jsonapi_content\Controller\JsonApiContentController::handlePath',
        '_title' => 'JSONAPI Path Handler',
      ],
      [],
      [],
      '',
      [],
      ['GET']
    ));

    // Route for handling block by ID.
    $collection->add('jsonapi_content.block', new Route(
      '/jsonapi/block',
      [
        '_controller' => '\Drupal\jsonapi_content\Controller\JsonApiContentController::handleBlock',
        '_title' => 'JSONAPI Block Handler',
      ],
      [],
      [],
      '',
      [],
      ['GET']
    ));

    // Route for handling block by region.
    $collection->add('jsonapi_content.region_block', new Route(
      '/jsonapi/block-region',
      [
        '_controller' => '\Drupal\jsonapi_content\Controller\JsonApiContentController::handleRegionBlock',
        '_title' => 'JSONAPI Region Block Handler',
      ],
      [],
      [],
      '',
      [],
      ['GET']
    ));

    return $collection;
  }
}
