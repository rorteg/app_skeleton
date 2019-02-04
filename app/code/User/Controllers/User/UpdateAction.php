<?php

declare(strict_types=1);

namespace MadeiraMadeira\User\Controllers\User;

use MadeiraMadeira\Framework\App\Http\JsonResponse;
use MadeiraMadeira\User\Model\User;

/**
 * Class UpdateAction
 * @package MadeiraMadeira\User\Controllers\User
 */
class UpdateAction
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

    public function __invoke($id)
    {
        $postParams = filter_input_array(INPUT_POST);
        $user = $this->userModel->load($id);

        if (! $user->getId()) {
            $response = new JsonResponse(['message' => 'Usuário não existe.'], 400);
            echo $response->sendResponse();
            exit(1);
        }

        if (! count($postParams)) {
            $response = new JsonResponse(['message' => 'Não foi possível atualizar.'], 400);
            echo $response->sendResponse();
            exit(1);
        }

        $user = $this->userModel->setData($postParams);
        $user->save();

        if ($user->getId()) {
            $response = new JsonResponse([
                'user' => $user->getData()
            ], 202);

            echo $response->sendResponse();
            exit(1);
        }
    }
}