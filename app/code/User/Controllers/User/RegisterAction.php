<?php

declare(strict_types=1);

namespace MadeiraMadeira\User\Controllers\User;

use MadeiraMadeira\Framework\App\Http\JsonResponse;
use MadeiraMadeira\User\Model\User;

/**
 * Class RegisterAction
 * @package MadeiraMadeira\User\Controllers\User
 */
class RegisterAction
{
    /**
     * @var User
     */
    private $userModel;

    /**
     * RegisterAction constructor.
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function __invoke()
    {
        $postParams = filter_input_array(INPUT_POST);

        if (
            ! isset($postParams['username'])
            || ! isset($postParams['email'])
            || ! isset($postParams['first_name'])
            || ! isset($postParams['last_name'])
            || ! isset($postParams['password'])
        ) {
            $response = new JsonResponse(['message' => 'Não foi possível registrar.'], 400);
            echo $response->sendResponse();
            exit(1);
        }

        $user = $this->userModel->setData($postParams);
        $user->save();

        if ($user->getId()) {
            $response = new JsonResponse([
                'user' => $user->getData()
            ], 201);

            echo $response->sendResponse();
            exit(1);
        }
    }
}