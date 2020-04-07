<?php declare(strict_types=1);
namespace App\Http\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Http\Server\Contract\MiddlewareInterface;

/**
 * @Bean()
 * Class ControllerMiddleware
 * @package App\Http\Middleware
 */
class ControllerMiddleware implements MiddlewareInterface
{

    /**
     * Process an incoming server request.
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     * @inheritdoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var $ret \Swoft\Http\Message\Response; */
        $ret = $handler->handle($request);
//        var_dump($ret->getData());
        return $ret;
    }
}
