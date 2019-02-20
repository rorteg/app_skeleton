<?php declare(strict_types=1);

namespace Shelf\Auth\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Shelf\Auth\Api\AuthenticateInterface;
use Zend\Diactoros\Response\RedirectResponse;

class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @var AuthenticateInterface
     */
    private $authenticate;

    public function __construct(
        AuthenticateInterface $authenticate
    ) {
        $this->authenticate = $authenticate;
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($this->authenticate->isValid()) {
            return $handler->handle($request);
        }

        return new RedirectResponse('/login');
    }
}
