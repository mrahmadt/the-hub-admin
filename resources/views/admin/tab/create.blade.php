@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.tab.actions.create'))

@section('body')

    <div class="container-xl">
                <div class="card">
        <tab-form
            :action="'{{ url('admin/tabs') }}'"
            :categories="{{$categories->toJson()}}"
            :tabtype="{{$tabtype->toJson()}}"
            :data="{{ $tab->toJson() }}"
            v-cloak
            inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action" novalidate>
                
                <div class="card-header">
                    <i class="fa fa-plus"></i> {{ trans('admin.tab.actions.create') }} - @{{tabtype.name}}
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
