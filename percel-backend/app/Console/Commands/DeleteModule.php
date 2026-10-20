<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\Menus;
use App\Models\AdminPrivilege;

class DeleteModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:module {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete module (Model, Controller, Views, Routes)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        if (!$name) {
            $name = $this->ask('Enter module name to delete');
        }

        $names = $this->normalizeModuleName($name);

        if (!$this->confirm("Are you sure you want to delete '{$name}' module?")) {
            $this->info('Operation cancelled.');
            return;
        }

        $this->deleteModel($names['class']);
        $this->deleteController($names['class']);
        $this->deleteViews($names['view']);
        $this->removeRoute($names['route']);
        $this->removeMenu($names['route']);

        $this->info("Module '{$name}' deleted successfully!");
    }

    private function deleteModel($name)
    {
        $path = app_path("Models/{$name}.php");

        if (File::exists($path)) {
            File::delete($path);
            $this->info("Model deleted");
        } else {
            $this->warn("Model not found");
        }
    }

    private function deleteController($name)
    {
        $path = app_path("Http/Controllers/Admin/{$name}Controller.php");

        if (File::exists($path)) {
            File::delete($path);
            $this->info("Controller deleted");
        } else {
            $this->warn("Controller not found");
        }
    }

    private function deleteViews($name)
    {
        $path = resource_path('views/admin/' . strtolower($name));

        if (File::exists($path)) {
            File::deleteDirectory($path);
            $this->info("Views deleted");
        } else {
            $this->warn("Views folder not found");
        }
    }

    private function removeRoute($name)
    {
        $routeFile = base_path('routes/web.php');
        $routeName = strtolower($name);

        $content = file_get_contents($routeFile);

        $pattern = "/\s*Route::resource\('{$routeName}'.*?\);\n/";

        $newContent = preg_replace($pattern, '', $content);

        if ($content !== $newContent) {
            file_put_contents($routeFile, $newContent);
            $this->info("Route removed");
        } else {
            $this->warn("Route not found");
        }
    }

    private function normalizeModuleName($input)
    {
        return [
            'class' => str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $input))),
            'view'  => strtolower(str_replace(' ', '_', $input)),
            'route' => strtolower(str_replace(' ', '-', $input)),
        ];
    }

    private function removeMenu($route)
    {
        Menus::where('path', $route.'.index')->delete();
    }

}
