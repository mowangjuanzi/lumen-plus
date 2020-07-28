<?php
namespace Mowangjuanzi\Plus;

use Illuminate\Http\Response;
use Illuminate\Routing\Router;
use Illuminate\Routing\RoutingServiceProvider;
use Laravel\Lumen\Application;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class LumenPlusApplication extends Application
{
    /**
     * The Router instance.
     *
     * @var Router
     */
    public $router;

    /**
     * Bootstrap the router instance.
     *
     * @return void
     */
    public function bootstrapRouter()
    {
        $this->register(RoutingServiceProvider::class);
        $this->router = $this['router'];
        $this->router->middlewareGroup("web", []);
    }

    /**
     * Dispatch the incoming request.
     *
     * @param  SymfonyRequest|null  $request
     * @return Response
     */
    public function dispatch($request = null)
    {
        $this->parseIncomingRequest($request);

        try {
            $this->boot();

            return $this->sendThroughPipeline($this->middleware, function ($request) {
                $this->app->instance('request', $request);

                return $this->router->dispatch($request);
            });
        } catch (\Throwable $e) {
            return $this->prepareResponse($this->sendExceptionToHandler($e));
        }
    }
}
