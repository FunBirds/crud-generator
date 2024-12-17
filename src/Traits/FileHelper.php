<?php

namespace Foxdevuz\CrudGenerator\Traits;

use Exception;
use TypeError;

trait FileHelper
{
    /**
     * @return mixed
     * @throws Exception
     */
    protected function getJson(): mixed
    {
        try {
            // TODO: Before pushing it to release change the path to base_path() then use crud-config.json because user has to publish the file after installing the package
            $json = __DIR__ . "/../../crud-config.json";
            return json_decode($json);
        } catch (Exception){
            throw new Exception("Config Json is not exits, please publish it");
        }
    }

    /**
     * @param string $type Either create or update
     * @return string
     */
    protected function getRequestStub(string $type): string
    {
        if ($type == "create"){
            return __DIR__ . "/../stubs/request/store.request.stub";
        } else if ($type == "update") {
            return __DIR__ . "/../stubs/request/update.request.stub";
        } else {
            throw new TypeError("Type should be either create or update, other methods are not supported");
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    protected function getApiStub(): string
    {
        try {
            return __DIR__ . "/../stubs/api/api.stub";
        } catch (Exception $e) {
            throw new Exception("Failed to get API stub: " . $e->getMessage());
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    protected function getControllerStub(): string
    {
       try {
            return __DIR__ . "/../stubs/crud.controller.stub";
        } catch (Exception $e) {
            throw new Exception("Failed to get Controller stub: " . $e->getMessage());
        }
    }


    // API Route Creation

    /**
     * @throws Exception
     */
    protected function getPreparedToCreateApiRoute(string $url, string $controller): string
    {
        $api_stub = $this->getApiStub();
        return str_replace(
            ['{{url}}','{{controllerName}}'],
            [$url, $controller],
            $api_stub
        );
    }
}