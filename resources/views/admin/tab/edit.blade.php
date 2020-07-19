@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.tab.actions.edit', ['name' => $tab->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <tab-form
                :action="'{{ $tab->resource_url }}'"
                :categories="{{$categories->toJson()}}"
                :tabtype="{{$tabtype->toJson()}}"
                :data="{{ $tab->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.tab.actions.edit', ['name' => $tab->id]) }} - @{{tabtype.name}}
                    </div>

                    <div class="card-body">
                        @include('admin.tab.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </tab-form>

        </div>
    
</div>

@endsection
