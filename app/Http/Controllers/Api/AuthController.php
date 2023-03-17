<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Requests\Auth\VerificationRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @param AuthService $service
     */
    function __construct (private readonly AuthService $service) { }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login (LoginRequest $request): JsonResponse
    {
        return response()->json( $this->service->processLogin( $request->all()));
    }

    /**
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function register (RegistrationRequest $request): JsonResponse
    {
        return response()->json( $this->service->processRegistration( $request->all()));
    }

    /**
     * @param VerificationRequest $request
     * @return JsonResponse
     */
    public function verify (VerificationRequest $request): JsonResponse
    {
        return response()->json( $this->service->processVerification( $request->all()));
    }

    /**
     * @return JsonResponse
     */
    public function logout (): JsonResponse
    {
        return response()->json( $this->service->logout());
    }
}
