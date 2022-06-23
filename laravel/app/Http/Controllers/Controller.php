<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
    * title="learn Laravel angular project",
    * version="0.0.1",
    * description="L5 Swagger OpenApi description",
    * @OA\Contact(
*          email="admin@admin.com"
*      ),
*      @OA\License(
*          name="Apache 2.0",
*          url="http://www.apache.org/licenses/LICENSE-2.0.html"
*      )
 * )
 *
 * @OA\Server(
*      url="/api/documentation"
*  )
*
 * @OA\Tag(name="UnAuthorize", description="No user login required")
 * @OA\Tag(name="Authorize", description="User login required")
 * @OA\Tag(name="Builders", description="Builder model controller")
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
