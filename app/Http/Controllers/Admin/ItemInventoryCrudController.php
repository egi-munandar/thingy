<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItemInventoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ItemInventoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ItemInventoryCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ItemInventory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/item-inventory');
        CRUD::setEntityNameStrings('item inventory', 'item inventories');
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
        $this->crud->setColumnDetails('user_id', [
            'label' => 'User',
            'type' => 'select',
            'entity' => 'user',
            'attribute' => 'name',
            'model' => "App\Models\User"
        ]);
        $this->crud->setColumnDetails('item_id', [
            'type' => 'select',
            'entity' => 'item',
            'attribute' => 'name',
            'model' => "App\Models\Master\Item"
        ]);
        $this->crud->setColumnDetails('location_id', [
            'type' => 'select',
            'entity' => 'location',
            'attribute' => 'name',
            'model' => "App\Models\Master\Location"
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
        CRUD::setValidation(ItemInventoryRequest::class);
        CRUD::setFromDb(); // set fields from db columns.
        CRUD::field([
            'label' => 'Location',
            'type' => 'select',
            'name' => 'location_id',
            'model' => "App\Models\Master\Location",
            'attribute' => 'path',
        ]);
        CRUD::field([
            'label' => 'Item',
            'type' => 'select',
            'name' => 'item_id',
            'model' => "App\Models\Master\Item",
            'attribute' => 'name',
        ]);
        CRUD::field('user_id')->remove();
        CRUD::setOperationSetting('strippedRequest', function ($request) {
            $input = $request->only(CRUD::getAllFieldNames());
            $input['user_id'] = backpack_user()->id;
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
