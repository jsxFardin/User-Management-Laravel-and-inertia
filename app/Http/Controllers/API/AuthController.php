<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Traits\AutoUserActivityLog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Hash;
class AuthController extends BaseController
{
    use AutoUserActivityLog;
    /**
     *
     * @var string
     */
    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 3; // Default is 1
    /**
     * @OA\Post(
     * path="/api/v1/login",
     * operationId="authLogin",
     * tags={"Login"},
     * summary="User Login",
     * description="Login User Here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"email", "password"},
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="password", type="password")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function login(AuthRequest $request)
    {
        try {
            $executed = RateLimiter::attempt(
                'send-message:' . $request->email,
                $perMinute = 5,
                function () {
                    // Send message...
                    return false;
                }
            );

            if (!$executed) {
                return $this->sendError('Too many attempts!', JsonResponse::HTTP_TOO_MANY_REQUESTS);
            }

            $credentials = [
                'email' => $request->post('email'),
                'password' => $request->post('password')
            ];

            if (auth()->attempt($credentials)) {
                $user = auth()->user();

                if ($user->active != 1) :
                    return $this->sendError('Account Inactive', JsonResponse::HTTP_FORBIDDEN);
                endif;

                $resultToken = $this->getTokenAndRefreshToken($user->email, $request->password);
                $token = json_decode($resultToken->getContent());

                //GET USER LOG
                $this->userLogs('login');
                return $this->sendSuccess(__('Welcome Back ' . $user->name), JsonResponse::HTTP_OK, ['user' => new UserResource($user), 'token' => $token]);
            } else {
                return $this->sendError('UnAuthorised', JsonResponse::HTTP_UNAUTHORIZED);
            }
        } catch (\Exception $error) {
            return $this->sendError($error->getMessage(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $error);
        }
    }

    protected function getTokenAndRefreshToken($email, $password)
    {
        $request = Request::create(config('services.front.app_url') . config('services.passport.login_endpoint'), 'POST', [
            'grant_type' => 'password',
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'username' => $email,
            'password' => $password,
        ]);

        return app()->handle($request);
    }
    public function getAuthUser()
    {
        if (Auth::check())
            return $this->sendSuccess('Success', JsonResponse::HTTP_OK, Auth::user());
        return  $this->sendError("User not authenticated", JsonResponse::HTTP_OK, "No auth user found");
    }
}
