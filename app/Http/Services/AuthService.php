<?php

namespace App\Http\Services;

use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthService extends Service
{
    /**
     * @param array $data
     * @return array
     */
    public function processLogin (array $data): array
    {
        try {
            $user = User::where('email', $data['email'])->first();
            if (!$user) {
                return $this->responseError("Email not found");
            }
            if (!Hash::check($data['password'], $user->password)) {
                return $this->responseError("Wrong Email Or Password");
            }
            $authorization = [
                'token' =>  $user->createToken($user->email)->accessToken,
                'token_type' =>  'Bearer'
            ];
            return $this->responseSuccess("Login Successful!", ['authorization' => $authorization]);
        }
        catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function processRegistration (array $data): array
    {
        try {
            $code = "randomNumber(4)";
            $formattedData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'verification_code' => $code,
                'password' => Hash::make($data['password']),
            ];
            $user = User::create($formattedData);
//            $sendEmailJob = new SendEmailJob($user->email, $user->name, $code);
//            dispatch($sendEmailJob);

            return $this->responseSuccess("Registration Successful! Please check email for code");
        }
        catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function processVerification (array $data): array
    {
        try {
            $user = User::where('email', $data['email'])->where('verification_code', $data['code'])->first();
            if (!$user) {
                return $this->responseError("Invalid Code");
            }
            $formattedData = [
                'verification_code' => null,
                'email_verified' => true
            ];
            User::where('id', $user->id)->update($formattedData);

            return $this->responseSuccess("Verification Successful!");
        }
        catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * @return array
     */
    public function logout (): array
    {
        try  {
            Auth::user()->token()->revoke();
            return $this->responseSuccess("Logged Out Successful!");
        }
        catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }
}
