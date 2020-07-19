@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.upload.actions.createFolder'))

@section('body')

    <div class="container-xl">

                <div class="card">
        
        <upload-form
            :action="'{{ url('admin/uploads/createfolder') }}'"
            :data="{current_directory:'{{$current_directory}}'}"
            v-cloak
            inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action" novalidate>
                
                <div class="card-header">
                    <i class="fa fa-plus"></i> {{ trans('admin.upload.actions.createFolder') }}
                </div>

                <div class="card-body">
                    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
                        <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.upload.columns.foldername') }}</label>
                            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.upload.columns.name') }}">
                            <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
                        </div>
                    </div>
                </div>
                <input type="hidden" v-model="form.current_directory" name="current_directory">
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                        {{ trans('admin.upload.columns.create') }}
                    </button>
                </div>
                
            </form>

        </upload-form>

        </div>

        </div>

    
@endsection
