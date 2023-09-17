<?php

namespace App\Providers;

use Godruoyi\Snowflake\LaravelSequenceResolver;
use Godruoyi\Snowflake\Snowflake;
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

        $this->app->singleton('snowflake', function ($app) {
            return (new Snowflake())
                ->setStartTimeStamp(strtotime('2023-09-09')*1000)
                ->setSequenceResolver(new LaravelSequenceResolver($app->get('cache.store')));
        });

        JsonResource::withoutWrapping();

//        $this->app->bind(LengthAwarePaginator::class, function ($app, $options) {
//            return new \App\Pagination\LengthAwarePaginator(
//                $options['items'], $options['total'], $options['perPage'], $options['options']
//            );
//        });
    }
}
