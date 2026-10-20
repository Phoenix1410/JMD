<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Menus;
use App\Models\AdminPrivilege;
use App\Models\AdminPrivilegeRole;
use \App\Helpers\AdminHelper;
use Illuminate\Support\Facades\Session;

class MakeModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Controller, Model, View & Route for a admin module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        if (!$name) {
            $name = $this->ask('What is your module name?');
        }
        $names = $this->normalizeModuleName($name);        
        $this->createModel($names['class']);
        $this->createController($names['class'], $names['view'], $names['route']);
        $this->createViews($names['class'], $names['view'], $names['route']);
        $this->addRoute($names['class'], $names['route']);
        $this->addMenuWithPriviledge($name, $names['route']);

        $this->info("Module '{$names['class']}' created successfully!");
    }

    private function createModel($name)
    {
        $modelPath = app_path("Models/{$name}.php");

        if (\File::exists($modelPath)) {
            $this->warn('Model already exists!');
            return;
        }

        $modelTemplate = <<<PHP
    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class {$name} extends Model
    {
        use HasFactory;

        protected \$guarded = [];
    }
    PHP;

        \File::put($modelPath, $modelTemplate);
    }

    private function createController($name, $view, $route)
    {
        \File::ensureDirectoryExists(app_path('Http/Controllers/Admin'));
        $controllerPath = app_path("Http/Controllers/Admin/{$name}Controller.php");

        if (\File::exists($controllerPath)) {
            $this->warn('Controller already exists!');
            return;
        }

        $controllerTemplate = <<<PHP
    <?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Helpers\AdminHelper;
    use App\Models\\{$name};    

    class {$name}Controller extends Controller
    {
        public function index()
        {
            if (!AdminHelper::isView()) {
                return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
            }

            \$data = [];
            \$data['page_title'] = '{$name}';
            \$limit = (!empty(request()->get('limit'))?request()->get('limit'):20);
            \$data['limit'] = \$limit;
            \$q = request()->get('q');
            \$filter_column = request()->get('filter_column', 'created_at');
            \$sorting = (!empty(request()->get('sorting'))?request()->get('sorting'):'desc');
            \$data['rows'] = {$name}::when(\$q, function (\$query) use (\$q) {
                \$query->where('name', 'like', "%{\$q}%");
            })
            ->orderBy(\$filter_column, \$sorting)
            ->paginate(\$limit);
            
            return view('admin.{$view}.index', \$data);
        }

        public function create()
        {
            if (!AdminHelper::isCreate()) {
                return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
            }

            \$data = [];
            \$data['page_title'] = 'Add {$name}';        
            
            return view('admin.{$view}.create', \$data);
        }

        public function store(Request \$request)
        {
            if (!AdminHelper::isCreate()) {
                return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
            }

            \$request->validate([]);
            {$name}::create(\$request->all());
            
            \$return_url = (!empty(\$request->input('return_url'))?\$request->input('return_url'):route('{$route}.index'));
            if(\$request->input('submit')=='Save')
            {
                return redirect(\$return_url)->withSuccess('Data added successfully!');
            }else{
                return redirect()->back()->withSuccess('Data added successfully!');
            }
        }

        public function show(\$id)
        {
            if (!AdminHelper::isRead()) {
                return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
            }

            \$data = [];
            \$data['page_title'] = '{$name} Details';
            \$data['row'] = {$name}::findOrFail(\$id);

            return view('admin.{$view}.show', \$data);
        }

        public function edit(\$id)
        {
            if (!AdminHelper::isUpdate()) {
                return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
            }

            \$data = [];
            \$data['page_title'] = 'Edit {$name}';
            \$data['row'] = {$name}::findOrFail(\$id);

            return view('admin.{$view}.edit', \$data);
        }

        public function update(Request \$request, \$id)
        {
            if (!AdminHelper::isUpdate()) {
                return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
            }

            \$request->validate([]);

            \$row = {$name}::findOrFail(\$id);
            \$row->update(\$request->all());
           
            \$return_url = (!empty(\$request->input('return_url'))?\$request->input('return_url'):route('{$route}.index'));
        return redirect(\$return_url)->withSuccess('Data updated successfully!');
        }

        public function destroy(\$id)
        {
            if (!AdminHelper::isDelete()) {
                return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
            }

            \$row = {$name}::findOrFail(\$id);
            \$row->delete();

            return redirect()->back()->withSuccess('Data deleted successfully!');
        }
    }
    PHP;

        \File::put($controllerPath, $controllerTemplate);
    }

    private function createViews($name, $view, $route)
    {
        $viewFolder = resource_path('views/admin/' . $view);

        \File::ensureDirectoryExists($viewFolder);

        \File::put("{$viewFolder}/index.blade.php", <<<HTML
    @extends('admin::layouts.admin_template')
    @section('content')
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">{{ \$page_title }}</h4>
            <div class="box-tools pull-right" style="position: relative;margin-top: -5px;margin-right: -10px">   
                <form method="get" style="display:inline-block;width: 290px;" action="{{ route('{$route}.index') }}">
                    <div class="input-group">
                        <input type="text" name="q" value="{{ request()->get('q') }}" class="form-control rounded-0 pull-right" placeholder="Search">

                        <div class="input-group-btn">
                            @if(!empty(request()->get('q')))
                            <button type="button" onclick="location.href='{{ route('{$route}.create') }}'" title="Reset" class="btn rounded-0 btn-warning"><i class="fa fa-ban"></i></button>
                            @endif
                            <button type="submit" class="btn rounded-0 btn-primary me-2"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>


                <form method="get" id="form-limit-paging" style="display:inline-block"
                    action="{{ route('{$route}.create') }}">
                    @php \$limits =[5,10,20,25,50,100,200]; @endphp
                    <div class="input-group">
                        <select onchange="$('#form-limit-paging').submit()" name="limit" style="width: 56px;"
                            class="form-control input-sm">
                            @foreach(\$limits as \$lmt)
                                <option value="{{ \$lmt }}" {{ (\$lmt==\$limit)?'selected':'' }}>{{\$lmt}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>

            </div>

            <br style="clear:both">
        </div>
        <div class="card-body">
            <div class="table-responsive">
            </div>
        </div>
    </div>
    @endsection
    HTML);

        \File::put("{$viewFolder}/create.blade.php", <<<HTML
    @extends('admin::layouts.admin_template')
    @section('content')
    <p><a title="Main Module" href="{{ route('{$route}.index') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data {$name}</a></p>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header card-primary align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ \$page_title }}</h4>
                    <div class="flex-shrink-0">
                    </div>
                </div> 

                <div class="card-body">
                <form action="{{ route('{$route}.store') }}" method="post" enctype="multipart/form-data"> 
                    @csrf
                    <input type="hidden" name="return_url" value="{{ route('{$route}.index') }}">
                    <div class="row">
                        <div class="col-md-12">
                                               
                        </div>
                    </div>
                    <div class="row g-3">
                            <div class="form-group">
                                <label class="control-label col-sm-2"></label>
                                <div class="col-sm-10">
                                    <a href="{{ route('{$route}.index') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                                    <input type="submit" name="submit" value="Save & Add More" class="btn btn-primary">
                                    <input type="submit" name="submit" value="Save" class="btn btn-primary">                                
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
    HTML);

        \File::put("{$viewFolder}/edit.blade.php", <<<HTML
    @extends('admin::layouts.admin_template')
    @section('content')
    <p><a title="Main Module" href="{{ route('{$route}.index') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data {$name}</a></p>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header card-primary align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ \$page_title }}</h4>
                    <div class="flex-shrink-0">
                    </div>
                </div> 

                <div class="card-body">
                <form action="{{ route('{$route}.update', \$row->id) }}" method="post" enctype="multipart/form-data"> 
                    @csrf
                    <input type="hidden" name="return_url" value="{{ route('{$route}.index') }}">
                    <div class="row">
                        <div class="col-md-12">
                                               
                        </div>
                    </div>
                    <div class="row g-3">
                            <div class="form-group">
                                <label class="control-label col-sm-2"></label>
                                <div class="col-sm-10">
                                    <a href="{{ route('{$route}.index') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                                    <input type="submit" name="submit" value="Save" class="btn btn-primary">                                
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
    HTML);

        \File::put("{$viewFolder}/show.blade.php", <<<HTML
    @extends('admin::layouts.admin_template')
    @section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header card-primary align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ \$page_title }}</h4>
                    <div class="flex-shrink-0">
                    </div>
                </div>

                <div class="card-body">                
                        <div class="row g-3">
                            <div class="table-responsive">
                                <table id="table-detail" class="table table-striped">
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>               

                    </form>

                </div>
            </div>
        </div>
    </div>
    @endsection
    HTML);
    }

    private function addRoute($name, $routeName)
    {
        $routeFile = base_path('routes/web.php');        

        $route = "    Route::resource('{$routeName}', {$name}Controller::class);\n";

        $content = file_get_contents($routeFile);

        if (!str_contains($content, 'AUTO-ADMIN-ROUTES-START')) {
            $this->error('Admin route markers not found!');
            return;
        }

        if (str_contains($content, "Route::resource('{$routeName}'")) {
            $this->warn('Route already exists!');
            return;
        }

        $content = str_replace(
            '// AUTO-ADMIN-ROUTES-END',
            $route . '    // AUTO-ADMIN-ROUTES-END',
            $content
        );        

        file_put_contents($routeFile, $content);
    }

    private function normalizeModuleName($input)
    {
        return [
            'class' => str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $input))),
            'view'  => strtolower(str_replace(' ', '_', $input)),
            'route' => strtolower(str_replace(' ', '-', $input)),
        ];
    }

    private function addMenuWithPriviledge($name, $route)
    {
        if(Menus::where('name', $name)->exists()){
            $this->error('Menu name already exists!');
          return;  
        }
        if(Menus::where('path', $route.'.index')->exists()){
            $this->error('Route already exists!');
          return;  
        }
        $sorting = Menus::max('sorting');
        $menu_id = Menus::insertGetId([
            'name' => $name,
            'type' => 'Route',
            'path' => $route.'.index',
            'icon' => 'fa fa-th-list',
            'parent_id' => 0,
            'is_active' => 1,
            'sorting' => ($sorting+1),
            'sql_query' => NULL,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        //Set Superadmin Priviledge
        $id = 1;
        AdminPrivilegeRole::insert([
            'is_visible' => 1,
            'is_create' => 1,
            'is_read' => 1,
            'is_edit' => 1,
            'is_delete' => 1,
            'id_admin_privileges' => 1,
            'id_admin_menus' => $menu_id,
            'created_by' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);     

        //Refresh Session Roles
        $roles = DB::table('admin_privileges_roles')->where('id_admin_privileges', 1)->join('admin_menus', 'admin_menus.id', '=', 'id_admin_menus')->select('admin_menus.name', 'admin_menus.path', 'admin_menus.type', 'is_visible', 'is_create', 'is_read', 'is_edit', 'is_delete')->get();
        Session::put('admin_privileges_roles', $roles);
    }
}
