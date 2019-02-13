<?php

declare(strict_types=1);

namespace Shelf\User\Controllers\Admin;

use Shelf\Admin\Controllers\AdminActionAbstract;
use Shelf\Auth\Api\AuthenticateInterface;
use Shelf\Framework\Api\Http\ResponseInterface;
use Shelf\Framework\App\Http\HtmlResponse;
use Shelf\Framework\Session\FlashMessage;
use Shelf\Framework\View\Api\TemplateRendererInterface;
use Shelf\User\Api\Data\UserInterface;
use Shelf\User\Helper\Validation;

/**
 * Class UserNewAction
 * @package Shelf\User\Controllers\Admin
 */
class UserNewOrUpdateAction extends AdminActionAbstract
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
        Validation $validation,
        AuthenticateInterface $authenticate
    ) {
        parent::__construct($authenticate);
        $this->user = $user;
        $this->templateRenderer = $templateRenderer;
        $this->validation = $validation;
    }

    /**
     * @return ResponseInterface
     */
    public function __invoke() : ResponseInterface
    {
        $postParams = filter_input_array(INPUT_POST);
        $id = null;
        $userData = [];
        $action = '/admin/user/new';

        if (count(func_get_args())) {
            $id = func_get_arg(0);
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
     * @return void
     */
    private function addNewUser($postParams) : void
    {
        $validation = $this->validation;

        if (!  $validation->validate($postParams)) {
            foreach ($validation->getMessages() as $message) {
                FlashMessage::addNotificationMessage(
                    FlashMessage::TYPE_DANGER,
                    $message
                );
            }

            $this->redirect('/admin/user/new');
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

        $this->redirect('/admin/user');
    }

    /**
     * @param array $postParams
     * @param string|int $id
     */
    private function updateUser($postParams, $id) : void
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

            $this->redirect('/admin/user/update');
        }

        $user = $this->user->load($id);

        if (! $user->getId()) {
            FlashMessage::addNotificationMessage(
                FlashMessage::TYPE_DANGER,
                'User does not exist.'
            );

            $this->redirect('/admin/user');
        }

        $user->setData($postParams);
        $user->save();

        FlashMessage::addNotificationMessage(
            FlashMessage::TYPE_SUCCESS,
            'User data updated successfully!'
        );

        $this->redirect('/admin/user');
    }
}
