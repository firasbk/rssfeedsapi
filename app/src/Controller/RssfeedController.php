<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\RssfeedService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
 
 /**
  * Class RssfeedController
  * @package App\Controller
  * @Route("/api/v1", name="rssfeed_api")
  */
class RssfeedController extends AbstractFOSRestController{

    private RssfeedService $rssfeedService;
    
    public function __construct(RssfeedService $rssfeedService)
    {
        $this->rssfeedService = $rssfeedService;
    }

    
  /**
   * This method get the rss feeds from all api provider bases on settings
   *
   * 
   * @return JsonResponse
   * @Route("/rssfeeds", name="rssfeeds_list", methods={"GET"})
   */
    public function getRssFeeds(): JsonResponse
    {
        $feeds = $this->rssfeedService->getRssFeeds();
        return $this->response($feeds);
    }
  
    /**
   * Returns a JSON response
   *
   * @param array $data
   * @param $status
   * @param array $headers
   * @return JsonResponse
   */
  public function response($data, $status = 200, $headers = []) : JsonResponse
  {
   return new JsonResponse($data, $status, $headers);
  }
}
