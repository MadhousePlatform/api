<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\AccountCreateException;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\CreateRequest;


class RegisterController extends Controller
{
    /**
     * Override the default amount (5).
     */
    protected const MAX_TRANSACTION_ATTEMPTS = 1;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(null, Response::HTTP_NOT_FOUND);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     * @throws Throwable
     */
    public function store(CreateRequest $request)
    {
        try {
            DB::transaction(
                static function() use ($request) {
                    $user = new User;

                    $user->setUuid(Uuid::uuid4())
                        ->setName($request->get('name'))
                        ->setUsername($request->get('username'))
                        ->setEmail($request->get('email'))
                        ->setPassword($request->get('password'));

                    if ( $user->save() ) {
                        return response()->json([
                            'message' => __('account.create_success'),
                        ], Response::HTTP_OK);
                    }

                    throw new AccountCreateException(
                        __('account.create_fail'),
                        config('app.debug') ? Response::HTTP_I_AM_A_TEAPOT : Response::HTTP_INTERNAL_SERVER_ERROR
                    );
                },
            self::MAX_TRANSACTION_ATTEMPTS
            );
        } catch (AccountCreateException $e) {
            Log::error($e->getMessage(), $request->all());
            return response()->json([

            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
