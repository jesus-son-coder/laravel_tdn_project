<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API Gift-Boxes Order Les Collectionneurs",
 *      description="Welcome to les Collectionneurs Webservices interface documentation The following documentation has been produced in order to facilitate the integration of our Webservices. This is dedicated to the technical team of our partners who want to be connected to our Hôtels & Restaurants.",
 *      @OA\Contact(
 *          email="support@lescollectionneurs.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 *
 *  @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Serveur"
 *  )
 *
 */

/**
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     description="Utilisez client_id / client_secret et votre email / password pour obtenir un token",
 *     name="Password Based",
 *     in="header",
 *     scheme="bearer",
 *     securityScheme="Oauth2Password",
 *     @OA\Flow(
 *         flow="password",
 *         authorizationUrl="/oauth/authorize",
 *         tokenUrl="/oauth/token",
 *         refreshUrl="/oauth/token/refresh",
 *         scopes={}
 *     )
 * )
 */


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
