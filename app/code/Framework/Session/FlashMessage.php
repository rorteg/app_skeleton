<?php

declare(strict_types=1);

namespace MadeiraMadeira\Framework\Session;

class FlashMessage
{
    const TYPE_PRIMARY = 'primary';
    const TYPE_SECONDARY = 'secondary';
    const TYPE_SUCCESS = 'success';
    const TYPE_DANGER = 'danger';
    const TYPE_WARNING = 'warning';
    const TYPE_INFO = 'info';
    const TYPE_LIGHT = 'light';
    const TYPE_DART = 'dark';

    /**
     * @param string $type Type (primary,secondary,success,danger,warning,info,light,dark)
     * @param string $message Message
     * @param string $strong
     * @param string $title Title
     */
    public static function addMessage($type, $message, $strong = '', $title = '') : void
    {
        Session::sessionStart();

        $flashMessage = [
                'type' => $type,
                'title' => $title,
                'strong' => $strong,
                'message' => $message
            ];

        if (! isset($_SESSION['flash'])) {
            $_SESSION['flash'] = [
                $flashMessage
            ];
        } else {
            $_SESSION['flash'][] = $flashMessage;
        }
    }

    /**
     * @return null|string
     */
    public static function flash() : ?string
    {
        Session::sessionStart();
        $messages = '';

        if (isset($_SESSION['flash'])) {
            foreach ($_SESSION['flash'] as $flashMessage) {
                $messages .= '<div class="alert alert-'
                    . $flashMessage['type'] . ' alert-dismissible fade show" role="alert">';

                if ($flashMessage['title'] !== '') {
                    $messages .= '<h4 class="alert-heading">' . $flashMessage['title'] . '</h4>';
                }

                if ($flashMessage['strong'] !== '') {
                    $messages .= '<strong>Holy guacamole!</strong>';
                }

                $messages .= $flashMessage['message'] . '
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
            }

            unset($_SESSION['flash']);
        }

        echo $messages;
        return null;
    }
}
