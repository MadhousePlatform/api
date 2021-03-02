<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MLL\GraphQLScalars\MixedScalar;
use Nuwave\Lighthouse\Exceptions\DefinitionException;
use Nuwave\Lighthouse\Schema\TypeRegistry;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws DefinitionException
     */
    public function boot()
    {
        $typeRegistry = app(TypeRegistry::class);
        $typeRegistry->register(new MixedScalar());
    }
}
