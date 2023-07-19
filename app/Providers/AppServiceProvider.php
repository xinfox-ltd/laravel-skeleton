<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('success', function (mixed $data, string $message = 'success', int $code = 200) {
            return Response::make(new \App\Http\Response($data, $message, $code));
        });

        JsonResource::withoutWrapping();

//        $this->app->bind(LengthAwarePaginator::class, function ($app, $options) {
//            return new \App\Pagination\LengthAwarePaginator(
//                $options['items'], $options['total'], $options['perPage'], $options['options']
//            );
//        });
    }
}
