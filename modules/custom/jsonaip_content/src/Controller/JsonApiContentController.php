<?php
namespace Drupal\jsonapi_content\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Render\RendererInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Routing\TrustedRedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
/**
 * Controller for JSON API content.
 */
class JsonApiContentController extends ControllerBase {
  /**
   * Render service.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * Constructs a JsonApiContentController object.
   */
  public function __construct(RendererInterface $renderer) {
    $this->renderer = $renderer;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('renderer')
    );
  }

  /**
   * Handle JSON API path requests.
   */
  public function handlePath() {
    $request = \Drupal::request();
    $path = $request->query->get('path');
    if (!$path) {
        // Handle the case where 'path' query parameter is not provided.
        return new JsonResponse(['error' => 'Path query parameter is missing'], 400);
    }
    // Resolve the alias to an internal path.
    $aliasManager = \Drupal::service('path_alias.manager');
    $internal_path = $aliasManager->getPathByAlias($path);
    
    // Create a sub-request based on the current path.
    $request = Request::create($internal_path);
    $request->query->set('jsoncontent', 1);
    // Get the HTTP Kernel service for handling sub-requests.
    $http_kernel = \Drupal::service('http_kernel');
    // Handle the sub-request using the MASTER_REQUEST context.
    $response = $http_kernel->handle($request, HttpKernelInterface::SUB_REQUEST);
    $content = $response->getContent();
    return new JsonResponse(['data' => ['attributes' => ['title' => '', 'body' => ['value' => $content]]]]);
  }
  /**
   * Handle JSON API block requests.
   */
  public function handleBlock($block_id) {
    return new JsonResponse(['data' => $block_id]);
  }

  /**
   * Handle JSON API region block requests.
   */
  public function handleRegionBlock($region, $url) {
    return new JsonResponse(['data' => $region]);
  }
}
