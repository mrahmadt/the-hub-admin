<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\BulkDestroySetting;
use App\Http\Requests\Admin\Setting\DestroySetting;
use App\Http\Requests\Admin\Setting\IndexSetting;
use App\Http\Requests\Admin\Setting\StoreSetting;
use App\Http\Requests\Admin\Setting\UpdateSetting;
use App\Models\Setting;
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

class SettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexSetting $request
     * @return array|Factory|View
     */
    public function index(IndexSetting $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Setting::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'description', 'key', 'inputType'],

            // set columns to searchIn
            ['description']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.setting.index', ['data' => $data]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Setting $setting
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Setting $setting)
    {
        $this->authorize('admin.setting.edit', $setting);


        return view('admin.setting.edit', [
            'setting' => $setting,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSetting $request
     * @param Setting $setting
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateSetting $request, Setting $setting)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Setting
        $setting->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/settings'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/settings');
    }

}
