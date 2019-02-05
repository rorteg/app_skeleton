<?php

declare(strict_types=1);

namespace MadeiraMadeira\User\Controllers\User;

use MadeiraMadeira\Framework\Api\Http\ResponseInterface;
use MadeiraMadeira\Framework\App\Http\JsonResponse;
use MadeiraMadeira\Framework\Controller\ActionAbstract;
use MadeiraMadeira\User\Model\User;

/**
 * Class UpdateAction
 * @package MadeiraMadeira\User\Controllers\User
 */
class UpdateAction extends ActionAbstract
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
     * @return ResponseInterface
     * @throws \Exception
     */
    public function __invoke() : ResponseInterface
    {
        $postParams = filter_input_array(INPUT_POST);
        $user = $this->userModel->load(func_get_arg(0));

        if (! $user->getId()) {
            $response = new JsonResponse(['message' => 'Usuário não existe.'], 400);
            return $response;
        }

        if (! count($postParams)) {
            $response = new JsonResponse(['message' => 'Não foi possível atualizar.'], 400);
            return $response;
        }

        $user = $this->userModel->setData($postParams);
        $user->save();

        if ($user->getId()) {
            $response = new JsonResponse([
                'user' => $user->getData()
            ], 202);

            return $response;
        }
    }
}
