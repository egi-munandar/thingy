<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Requests\Master\LocationRequest;
use App\Models\Master\Location;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LocationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LocationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Master\Location::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/master/location');
        CRUD::setEntityNameStrings('location', 'locations');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.
        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
        $this->crud->setColumnDetails('parent_id', [
            'label' => 'Parent',
            'type' => 'select',
            'entity' => 'parent',
            'attribute' => 'name',
            'model' => "App\Models\Location"
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation([
            'name' => 'required',
        ]);
        CRUD::setFromDb(); // set fields from db columns.
        CRUD::field([
            'label' => 'Parent',
            'type' => 'select',
            'name' => 'parent_id',
            'model' => "App\Models\Master\Location",
            'attribute' => 'path',
        ]);
        CRUD::field('path')->remove();
        CRUD::setOperationSetting('strippedRequest', function ($request) {
            $input = $request->only(CRUD::getAllFieldNames());
            if ($request->parent_id > 0) {
                $parent = Location::find($request->parent_id);
                $input['path'] = $parent->path . '/' . $request->name;
            } else {
                $input['path'] =  $request->name;
            }
            return $input;
        });
        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
