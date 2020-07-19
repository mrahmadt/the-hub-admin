@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.upload.actions.index'))

@section('body')

    <upload-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/uploads') }}'"
        :current_directory="'{{$current_directory}}'"
        inline-template>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header ">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.upload.actions.index') }}
                    
                    <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/uploads/createfolder') }}?current_directory={{$current_directory}}" role="button"><i class="fa fa-folder"></i>&nbsp; {{ trans('admin.upload.actions.createFolder') }}</a>
                         <div style="color:red">{{ trans('admin.upload.warning') }}</div>
                    </div>
                    <div class="card-body uploadindex" v-cloak>
                        <div class="card-block">
                            <table class="uploadtable table table-hover table-listing">
                                <thead>
                                    <tr>

                                        <th>
                                            @if($current_directory == '/')
                                            /
                                            @else
                                            <a href="javascript:window.history.back();" class="upload-link">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 0 1 0 .708L3.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/>
                                                <path fill-rule="evenodd" d="M2.5 8a.5.5 0 0 1 .5-.5h10.5a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                            </svg></a>
                                            <a href="{{ url('admin/uploads') }}" class="upload-link">/</a>{{$current_directory}}/
                                            @endif
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in collection" :key="item.id">
                                        <td>
                                            <a :href="item.link" class="upload-link" :target="item.type==0 ? '':'_new'">
                                            <svg v-if="item.type==1" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V5.707A1 1 0 0 0 13.707 5L10 1.293A1 1 0 0 0 9.293 1H4zm5 1v3a1 1 0 0 0 1 1h3L9 2z"/>
                                            </svg>
                                            <svg v-else width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"/>
                                                <path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"/>
                                            </svg>
                                              @{{item.name}}
                                            </a>

                                            </td>
                                        <td>
                                            <div v-if="item.type==1" class="row no-gutters">


                                            <form class="col" @submit.prevent="deleteItem('{{url('/admin/uploads/delete')}}?current_directory={{$current_directory}}&obj='+item.name)">
                                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

<div class="card-header">
<i class="fa fa-file-o"></i> {{trans('admin.upload.actions.uploadFile')}}
</div>

<media-upload
		ref="gallery_uploader"
		:collection="'gallery_uploader'"
        :url="'{{ route('admin/uploads/uploadfile') . '?current_directory=' .$current_directory}}'"
        :max-number-of-files="1000"
        :max-file-size-in-mb="500"
></media-upload>
                            <div class="row" v-if="pagination.state.total > 0">
                                <div class="col-sm">
                                    <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                                </div>
                            </div>
                            <div class="no-items-found" v-if="!collection.length > 0">
                                <i class="icon-magnifier"></i>
                                <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                                <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </upload-listing>

@endsection
