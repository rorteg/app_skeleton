<?php

declare(strict_types=1);

namespace Shelf\User\Controllers\Admin;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Shelf\Framework\Session\FlashMessage;
use Shelf\Framework\View\Api\TemplateRendererInterface;
use Shelf\User\Api\Data\UserInterface;
use Shelf\User\Helper\Validation;
use Zend\Diactoros\Response\RedirectResponse;

/**
 * Class UserNewAction
 * @package Shelf\User\Controllers\Admin
 */
class UserNewOrUpdateAction
{
    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * @var Validation
     */
    private $validation;

    /**
     * UserNewAction constructor.
     * @param UserInterface $user
     * @param TemplateRendererInterface $templateRenderer
     * @param Validation $validation
     * @param AuthenticateInterface $authenticate
     */
    public function __construct(
        UserInterface $user,
        TemplateRendererInterface $templateRenderer,
        Validation $validation
    ) {
        $this->user = $user;
        $this->templateRenderer = $templateRenderer;
        $this->validation = $validation;
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, array $args = []) : ResponseInterface
    {
        $postParams = $request->getParsedBody();
        $id = null;
        $userData = [];
        $action = '/admin/user/new';

        if (count($args) && isset($args['id'])) {
            $id = $args['id'];
            $userData = $this->user->load($id)->getData();
            $action = '/admin/user/edit/' . $id;
        }

        if (count($postParams)) {
            if (is_null($id)) {
                $this->addNewUser($postParams);
            }
            $this->updateUser($postParams, $id);
        }

        return new HtmlResponse(
            $this->templateRenderer->render(
                '@user/admin/user_form.html',
                [
                    'user' => $userData,
                    'action' => $action
                ]
            )
        );
    }

    /**
     * @param array $postParams
     * @return RedirectResponse
     */
    private function addNewUser($postParams) : RedirectResponse
    {
        $validation = $this->validation;

        if (!  $validation->validate($postParams)) {
            foreach ($validation->getMessages() as $message) {
                FlashMessage::addNotificationMessage(
                    FlashMessage::TYPE_DANGER,
                    $message
                );
            }

            return new RedirectResponse('/admin/user/new');
        }

        $user = $this->user;
        $user->setData($postParams);

        try {
            $user->save();

            FlashMessage::addNotificationMessage(
                FlashMessage::TYPE_SUCCESS,
                'User added successfully!'
            );
        } catch (\Exception $e) {
            FlashMessage::addNotificationMessage(
                FlashMessage::TYPE_DANGER,
                'There was a problem trying to save the user.'
            );
        }

        return new RedirectResponse('/admin/user');
    }

    /**
     * @param array $postParams
     * @param string|int $id
     * @return RedirectResponse
     */
    private function updateUser($postParams, $id) : RedirectResponse
    {
        $validation = $this->validation;

        if ($postParams['password'] == '') {
            $validated = $validation->validate($postParams, false);
            unset($postParams['password']);
        } else {
            $validated = $validation->validate($postParams);
        }

        if (! $validated) {
            foreach ($validation->getMessages() as $message) {
                FlashMessage::addNotificationMessage(
                    FlashMessage::TYPE_DANGER,
                    $message
                );
            }

            return new RedirectResponse('/admin/user/update');
        }

        $user = $this->user->load($id);

        if (! $user->getId()) {
            FlashMessage::addNotificationMessage(
                FlashMessage::TYPE_DANGER,
                'User does not exist.'
            );

            return new RedirectResponse('/admin/user');
        }

        $user->setData($postParams);
        $user->save();

        FlashMessage::addNotificationMessage(
            FlashMessage::TYPE_SUCCESS,
            'User data updated successfully!'
        );

        return new RedirectResponse('/admin/user');
    }
}
