@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.tab.actions.index'))

@section('body')

    <tab-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/tabs') }}'"
        inline-template>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.tab.actions.index') }}
<div class="dropdown pull-right m-b-0">
  <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
  <i class="fa fa-plus"></i>&nbsp; {{ trans('admin.tab.actions.create') }}
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  @foreach ($tabtypes as $tabtype)
    <a class="dropdown-item" href="{{ url('admin/tabs/create') }}?t={{$tabtype->id}}">{{$tabtype->name}}</a>
@endforeach
  </div>
</div>

                    </div>
                    <div class="card-body" v-cloak>
                        <div class="card-block">
                            <form @submit.prevent="">
                                <div class="row justify-content-md-between">
                                    <div class="col col-lg-7 col-xl-5 form-group">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto form-group ">
                                        <select class="form-control" v-model="pagination.state.per_page">
                                            
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>


                            <div class="row" v-if="showCategoriesFilter">
                                <div class="col-sm-auto form-group" style="margin-bottom: 0;">
                                    <p style="line-height: 40px; margin:0;">{{ __('Select Categories/s') }}</p>
                                </div>
                                <div class="col col-lg-12 col-xl-12 form-group" style="max-width: 590px; ">
                                    <multiselect v-model="categoriesMultiselect"
                                                 :options="{{ $categories->map(function($category) { return ['key' => $category->id, 'label' =>  $category->name]; })->toJson() }}"
                                                 label="label"
                                                 track-by="key"
                                                 placeholder="{{ __('Type to search a category/s') }}"
                                                 :limit="2"
                                                 :multiple="true">
                                    </multiselect>
                                </div>
                            </div>


                            <div class="row" v-if="showTabtypesFilter">
                                <div class="col-sm-auto form-group" style="margin-bottom: 0;">
                                    <p style="line-height: 40px; margin:0;">{{ __('Select Types/s') }}</p>
                                </div>
                                <div class="col col-lg-12 col-xl-12 form-group" style="max-width: 590px; ">
                                    <multiselect v-model="tabtypesMultiselect"
                                                 :options="{{ $tabtypes->map(function($tabtype) { return ['key' => $tabtype->id, 'label' =>  $tabtype->name]; })->toJson() }}"
                                                 label="label"
                                                 track-by="key"
                                                 placeholder="{{ __('Type to search a link type/s') }}"
                                                 :limit="2"
                                                 :multiple="true">
                                    </multiselect>
                                </div>
                            </div>

                            </form>

                            <table class="table table-hover table-listing">
                                <thead>
                                    <tr>
                                        <th class="bulk-checkbox">
                                            <input class="form-check-input" id="enabled" type="checkbox" v-model="isClickedAll" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()">
                                            <label class="form-check-label" for="enabled">
                                            </label>
                                        </th>
                                        <th>{{ trans('admin.tab.columns.name') }}</th>
                                        <th>{{ trans('admin.tab.columns.type') }}</th>
                                        <th></th>
                                    </tr>
                                    <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                        <td class="bg-bulk-info d-table-cell text-center" colspan="8">
                                            <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a href="#" class="text-primary" @click="onBulkItemsClickedAll('/admin/tabs')" v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                        href="#" class="text-primary" @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>  </span>

                                            <span class="pull-right pr-2">
                                                <button class="btn btn-sm btn-danger pr-3 pl-3" @click="bulkDelete('/admin/tabs/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                            </span>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                        <td class="bulk-checkbox">
                                            <input class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="bulkItems[item.id]" v-validate="''" :data-vv-name="'enabled' + item.id"  :name="'enabled' + item.id + '_fake_element'" @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                            <label class="form-check-label" :for="'enabled' + item.id">
                                            </label>
                                        </td>

                                        <td>@{{ item.name }}</td>
                                        <td>@{{ item.tabtype.name }}<span v-if="item.category !== null"> (@{{ item.category.name }})</span></td>
                                        <td>
                                            <div class="row no-gutters">
                                                <div class="col-auto">
                                                <a v-if="item.itemorder!=1" class="btn btn-sm  btn-dark" :href="item.resource_url + '/itemup'" :title="item.itemorder" role="button"><i class="fa fa-arrow-up"></i></a>
                                                    <span v-if="pagination.state.current_page==pagination.state.last_page && collection.length == (index+1)"> </span>
                                                    <a v-else class="btn btn-sm  btn-dark" :href="item.resource_url + '/itemdown'" :title="item.itemorder" role="button"><i class="fa fa-arrow-down"></i></a>
                                                    <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                                </div>
                                                <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row" v-if="pagination.state.total > 0">
                                <div class="col-sm">
                                    <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                                </div>
                                <div class="col-sm-auto">
                                    <pagination></pagination>
                                </div>
                            </div>

                            <div class="no-items-found" v-if="!collection.length > 0">
                                <i class="icon-magnifier"></i>
                                <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                                <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>


                                <div class="dropdown pull-right m-b-0">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
  <i class="fa fa-plus"></i>&nbsp; {{ trans('admin.tab.actions.create') }}
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  @foreach ($tabtypes as $tabtype)
    <a class="dropdown-item" href="{{ url('admin/tabs/create') }}?t={{$tabtype->id}}">{{$tabtype->name}}</a>
@endforeach
  </div>
</div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </tab-listing>

@endsection
