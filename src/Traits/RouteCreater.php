<?php

namespace Foxdevuz\CrudGenerator\Traits;

use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;

trait RouteCreater
{
    use FileHelper;
    /**
     * @throws FileNotFoundException
     * @throws Exception
     */
    protected function appendApiRequest(string $url, string $controllerName): void
    {
        $file = base_path("/routes/api.php");
        if (!File::exists($file)){
            throw new FileNotFoundException("api.php is not found, please do `php artisan install:api` then try again");
        }
        $api_stub = $this->getPreparedToCreateApiRoute($url, $controllerName);
        File::append($file, $api_stub);
    }
}