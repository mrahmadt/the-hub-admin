<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

class UploadsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexUpload $request
     * @return array|Factory|View
     */
    public function index(Request $request)
    {
        //$this->authorize('admin.upload.index');
        
        //http://localhost:8000/admin/uploads?per_page=1000&page=1&orderBy=id&orderDirection=asc
        
        $current_directory = $request->input('current_directory','/');
        if($current_directory=='') $current_directory = '/';
        $files = Storage::disk(config('app.cloud_disk'))->files($current_directory);
        $directories = Storage::disk(config('app.cloud_disk'))->directories($current_directory);
        
        $root_url = Storage::disk(config('app.cloud_disk'))->url('/');


        $id = 0;
        $Items_data = collect();
        foreach($directories as $directory){
            $id++;
            $tmp = new Upload;
            $tmp->id = $id;
            $tmp->type = 0;
            $tmp->name = $directory;
            $tmp->link = '?current_directory=' . $directory;
            $Items_data->push($tmp);
        }
        foreach($files as $file){
            $id++;
            $tmp = new Upload;
            $tmp->id = $id;
            $tmp->type = 1;
            $tmp->name = $file;
            $tmp->link = $root_url . $file;
            //$data[] = $tmp;
            $Items_data->push($tmp);
        }
        //
        //,['current_directory'=>$current_directory]
        $data = new \Illuminate\Pagination\LengthAwarePaginator($Items_data,count($Items_data),1000,0);
        $data->appends(['current_directory'=>$current_directory]);

        //dd($data);
        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.upload.index', ['data' => $data,'root_url'=>$root_url,'current_directory'=>$current_directory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function createfolder(Request $request)
    {
        $this->authorize('admin.upload.create');

        $current_directory = $request->input('current_directory','/');
        return view('admin.upload.createfolder',['current_directory'=>$current_directory]);
    }
    public function uploadfile(Request $request){
        exit;
    }
    
    public function storeFile(Request $request)
    {
        $json = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'file' => ['The name field is required.']
            ]
        ];


        if(!$request->hasFile('file')){
            throw new HttpResponseException(response()->json($json, 422)); 
        }

        if(!$request->file('file')->isValid()){
            throw new HttpResponseException(response()->json($json, 422)); 
        }

        $temporaryFile = $request->file('file');
        
        if($request->has('current_directory')){
            $current_directory = $request->input('current_directory');
        }else{
            $current_directory = '';
        }

        //$file_name = time() . $temporaryFile->getClientOriginalName();
        $file_name = $temporaryFile->getClientOriginalName();

        try{
            $output = Storage::disk(config('app.cloud_disk'))->put(
                $current_directory . '/' . $file_name,
                file_get_contents($temporaryFile->path())
            );
    
        } catch (Exception $e) {
            $json = [
                'message' => 'The given data was invalid.',
                'errors' => [
                    'file' => ['The given data was invalid.']
                ]
            ];
            throw new HttpResponseException(response()->json($json, 422)); 
        }


        if ($request->ajax()) {
            return ['redirect' => url('admin/uploads?current_directory='.$current_directory), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/uploads?current_directory='. $current_directory);
    }


    public function storefolder(Request $request)
    {

        $json = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'name' => ['The name field is required.']
            ]
        ];

        $post_content = $request->getContent();
        if($post_content=='') {
            throw new HttpResponseException(response()->json($json, 422)); 
        }

        $post_content = \json_decode($post_content);
        if(json_last_error()!=JSON_ERROR_NONE) exit;
        if($post_content->name==''){
            throw new HttpResponseException(response()->json($json, 422)); 
        }
        
        if(!ctype_alnum($post_content->name)){
            $json = [
                'message' => 'The given data was invalid.',
                'errors' => [
                    'name' => ['Name must be only alphanumeric.']
                ]
            ];
    
            throw new HttpResponseException(response()->json($json, 422)); 
        }

        $current_directory = $post_content->current_directory == '/' ? '' : $post_content->current_directory;

        $new_dir = $current_directory  . '/' . $post_content->name . '/';
        
        try{
            //$output = Storage::disk(config('app.cloud_disk'))->makeDirectory($new_dir,0777,true,true);
            $output = Storage::disk(config('app.cloud_disk'))->put($new_dir . 'index.html','');

        } catch (Exception $e) {
            $json = [
                'message' => 'The given data was invalid.',
                'errors' => [
                    'name' => ['Name must be only alphanumeric.']
                ]
            ];
            throw new HttpResponseException(response()->json($json, 422)); 
        }


        if ($request->ajax()) {
            return ['redirect' => url('admin/uploads?current_directory='.$current_directory), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/uploads?current_directory='. $current_directory);
    }

 
    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyUpload $request
     * @param Upload $upload
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(Request $request)
    {
        $json = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'file' => ['The file is required.']
            ]
        ];


        
        if($request->has('obj')){
            $obj = $request->input('obj');
        }else{
            $obj = '';
        }


        try{
            Storage::disk(config('app.cloud_disk'))->delete($obj);

        } catch (Exception $e) {
            $json = [
                'message' => 'The given data was invalid.',
                'errors' => [
                    'file' => ['The given data was invalid.']
                ]
            ];
            throw new HttpResponseException(response()->json($json, 422)); 
        }

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

}
