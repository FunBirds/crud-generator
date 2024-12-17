<?php
namespace Foxdevuz\CrudGenerator\Console;

use Exception;
use Foxdevuz\CrudGenerator\Traits\FileHelper;
use Foxdevuz\CrudGenerator\Traits\RequestCreateHelper;
use Foxdevuz\CrudGenerator\Traits\RouteCreater;
use http\Exception\InvalidArgumentException;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as ArtisanCommand;

class MakeCrud extends Command
{
    use RequestCreateHelper,
        FileHelper,
        RouteCreater;
    protected $signature = 'make:crud';

    protected $description = 'Generate a CRUD Controller bound to a Model';

    /**
     * @throws Exception
     */
    public function handle()
    {
        $json = $this->getJson();
        if (isset($json['config']) && is_array($json['config'])) {
            foreach ($json['config'] as $configItem) {
                if (isset($configItem['fields']) && is_array($configItem['fields'])) {
                    foreach ($configItem['fields'] as $fieldGroup) {
                        foreach ($fieldGroup as $type => $rules) {
                            print_r($rules);
                        }
                    }
                } else {
                    throw new InvalidArgumentException("fields section must be array! Please take a look how to make config file");
                }
            }
        }
    }
}