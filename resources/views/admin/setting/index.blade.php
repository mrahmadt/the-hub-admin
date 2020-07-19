@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.setting.actions.index'))

@section('body')

    <setting-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/settings') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.setting.actions.index') }}
                    </div>
                    <div class="card-body" v-cloak>
                        <div class="card-block">
                            <table class="table table-hover table-listing">
                                <thead>
                                    <tr style="border:0px;">
                                        <th>{{ trans('admin.setting.Setting') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in collection" :key="item.id">
                                        <td>@{{ item.description }}</td>
                                        
                                        <td>
                                            <div class="row no-gutters">
                                                <div class="col-auto">
                                                    <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </setting-listing>

@endsection
