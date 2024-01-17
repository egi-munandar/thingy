{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>
<x-backpack::menu-dropdown title="Master" icon="la la-server">
    <x-backpack::menu-dropdown-item title="Locations" icon="la la-map" :link="backpack_url('master/location')" />
    <x-backpack::menu-dropdown-item title="Currencies" icon="la la-hand-holding-usd" :link="backpack_url('master/currency')" />
    <x-backpack::menu-dropdown-item title="Items" icon="la la-boxes" :link="backpack_url('master/item')" />
</x-backpack::menu-dropdown>
<x-backpack::menu-item title="Inventory" icon="la la-retweet" :link="backpack_url('item-inventory')" />
