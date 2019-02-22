<?php

declare(strict_types=1);

namespace Shelf\User\Controllers\User;

use Shelf\Framework\Api\Http\ResponseInterface;
use Shelf\Framework\App\Http\JsonResponse;
use Shelf\Framework\Controller\ActionAbstract;
use Shelf\User\Model\User;

/**
 * Class RegisterAction
 * @package Shelf\User\Controllers\User
 */
class RegisterAction extends ActionAbstract
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

    /**
     * @return \Shelf\Framework\Api\Http\ResponseInterface
     * @throws \Exception
     */
    public function __invoke() : ResponseInterface
    {
        $postParams = filter_input_array(INPUT_POST);

        if (! isset($postParams['username'])
            || ! isset($postParams['email'])
            || ! isset($postParams['first_name'])
            || ! isset($postParams['last_name'])
            || ! isset($postParams['password'])
        ) {
            $response = new JsonResponse(['message' => 'Não foi possível registrar.'], 400);
            return $response;
        }

        $user = $this->userModel->setData($postParams);
        $user->save();

        if ($user->getId()) {
            $response = new JsonResponse([
                'user' => $user->getData()
            ], 201);

            return $response;
        }
    }
}
