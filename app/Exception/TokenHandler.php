<?php
namespace App\Exception;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Throwable;

/**
 * Class HttpExceptionHandler
 *
 * @ExceptionHandler(Swoft\Validator\Exception\ValidatorException::class)
 */
class TokenHandler extends AbstractHttpErrorHandler{

    /**
     * @param Throwable $e
     * @param Response $response
     *
     * @return Response
     */
    public function handle(Throwable $e, Response $response): Response
    {
        $data=["errcode"=>40013,"errmsg"=>$e->getMessage()];

         return $response->withData($data);
    }
}