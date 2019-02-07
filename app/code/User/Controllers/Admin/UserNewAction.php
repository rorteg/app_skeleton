<?php

declare(strict_types=1);

namespace MadeiraMadeira\User\Controllers\Admin;

use MadeiraMadeira\Admin\Controllers\AdminActionAbstract;
use MadeiraMadeira\Auth\Api\AuthenticateInterface;
use MadeiraMadeira\Framework\Api\Http\ResponseInterface;
use MadeiraMadeira\Framework\App\Http\HtmlResponse;
use MadeiraMadeira\Framework\Session\FlashMessage;
use MadeiraMadeira\Framework\View\Api\TemplateRendererInterface;
use MadeiraMadeira\User\Api\Data\UserInterface;
use MadeiraMadeira\User\Helper\Validation;

/**
 * Class UserNewAction
 * @package MadeiraMadeira\User\Controllers\Admin
 */
class UserNewAction extends AdminActionAbstract
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

        if (count($postParams)) {
            $this->addNewUser($postParams);
        }

        return new HtmlResponse(
            $this->templateRenderer->render('@user/admin/user_form.html')
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
        $user->save();

        FlashMessage::addNotificationMessage(
            FlashMessage::TYPE_SUCCESS,
            'User added successfully!'
        );

        $this->redirect('/admin/user');
    }
}
