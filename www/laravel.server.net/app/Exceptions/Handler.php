<?php

namespace App\Exceptions;

use Exception;
use App\Kernel\Traits\ApiResponseTrait;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\{
    HttpException,
    NotFoundHttpException,
    MethodNotAllowedHttpException,
};

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        ValidationException::class,
        MethodNotAllowedHttpException::class,
        NotFoundHttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * @var array
     */
    protected $handles = [
        ApiResponseTrait::class       => 'handleApiRequestException',
        RuntimeException::class       => 'handelRuntimeException',
        HttpException::class          => 'handelHttpException',
        ModelNotFoundException::class => 'handleModelNotFoundException',
        ValidationException::class    => 'handleValidationException',
        AppException::class           => 'handleAppException',
        ApiException::class           => 'handleApiException',
        NotFoundHttpException::class  => 'handleNotFoundHttpException',
    ];

    /**
     * Handler constructor.
     */
    public function __construct()
    {
        if (config('app.env') == 'local')
        {
            $this->dontReport = [];
        }
    }

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Exception $e
     * @throws Exception
     */
    public function report(Exception $e)
    {
        if (config('app.env') != 'local')
        {
            if(method_exists($e, 'needReport') && !$e->needReport()){
                return ;
            }
        }

        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        foreach ($this->handles as $class => $func)
        {
            if (get_class($exception) == $class)
            {
                return $this->$func($exception, $request);
            }
        }

        return parent::render($request, $exception);
    }

    /**
     * Handel runtime exception response.
     *
     * @param RuntimeException $exception
     * @param $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    protected function handelRuntimeException(RuntimeException $exception, $request)
    {
        if ($this->wantJson($request))
        {
            $data = (new AppException(100002))->all();

            return $this->ok($data);
        }

        return parent::render($request, $exception);
    }

    /**
     * handel http exception response
     *
     * @param $exception
     * @param $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    protected function handelHttpException($exception, $request)
    {
        if ($this->wantJson($request))
        {
            $data = (new AppException(100000))->all();

            return $this->ok($data);
        }

        return parent::render($request, $exception);
    }

    /**
     * Handle model not found exception response
     *
     * @param ModelNotFoundException $exception
     * @param $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    protected function handleModelNotFoundException(ModelNotFoundException $exception, $request)
    {
        if ($this->wantJson($request))
        {
            $data = (new AppException(100001))->all();

            return $this->ok($data);
        }

        return parent::render($request, $exception);
    }

    /**
     * Handle app exception response
     *
     * @param AppException $exception
     * @param $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    protected function handleAppException(AppException $exception, $request)
    {
        if ($this->wantJson($request))
        {
            return $this->ok($exception->all());
        }

        return parent::render($request, $exception);
    }

    /**
     * Handle api exception response
     *
     * @param ApiException $exception
     * @param $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    protected function handleApiException(ApiException $exception, $request)
    {
        if ($this->wantJson($request))
        {
            return $this->ok($exception->getData());
        }

        return parent::render($request, $exception);
    }

    /**
     * Handle not found http exception response
     *
     * @param NotFoundHttpException $exception
     * @param $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    protected function handleNotFoundHttpException(NotFoundHttpException $exception, $request)
    {
        if ($this->wantJson($request))
        {
            $data = (new AppException(100001))->all();

            return $this->ok($data);
        }

        return parent::render($request, $exception);
    }

    /**
     * Handle validation exception response
     *
     * @param ValidationException $exception
     * @param $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    protected function handleValidationException(ValidationException $exception, $request)
    {
        if ($this->wantJson($request))
        {
            $data = (new AppException(100003, $exception->errors()))->all();

            return $this->ok($data);
        }

        return parent::render($request, $exception);
    }

    /**
     * 是否需要 json 响应
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function wantJson($request)
    {
        if (config('api.response')) return true;

        return $request->expectsJson();
    }
}
