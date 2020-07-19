<div class="form-group row align-items-center" :class="{'has-danger': errors.has('url'), 'has-success': fields.url && fields.url.valid }">
    <label for="url" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.url') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.url" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('url'), 'form-control-success': fields.url && fields.url.valid}" id="url" name="url" placeholder="https://www.example-saas-app.com/">
        <span v-if="showLoading"><i class="fa fa-spinner"></i> {{ trans('admin.pleasewait') }}</span>
        <a v-else href="#" @click="getLinkMeta()">{{ trans('admin.application.autofill.data') }}</a>
        <div v-if="errors.has('url')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('url') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.application.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('icon'), 'has-success': fields.icon && fields.icon.valid }">
    <label for="icon" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.icon') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.icon" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('icon'), 'form-control-success': fields.icon && fields.icon.valid}" id="icon" name="icon" placeholder="https://www.example.com/icon.png">
        <span v-if="showIconList">
        <ul>
        <li style="display:inline;" v-for="(item, index) in extraIcons"><img :src="item" @click="changIcon(item)" class="rounded" style="border:1px solid;"></li>
        </ul>
        </span>
        <div v-if="errors.has('icon')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('icon') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': fields.description && fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.application.columns.description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.description" v-validate="''" id="description" name="description" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('isNewPage'), 'has-success': fields.isNewPage && fields.isNewPage.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="isNewPage" type="checkbox" v-model="form.isNewPage" v-validate="''" data-vv-name="isNewPage"  name="isNewPage_fake_element">
        <label class="form-check-label" for="isNewPage">
            {{ trans('admin.application.columns.isNewPage') }}
        </label>
        <input type="hidden" name="isNewPage" :value="form.isNewPage">
        <div v-if="errors.has('isNewPage')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('isNewPage') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('isNewPageForIframe'), 'has-success': fields.isNewPageForIframe && fields.isNewPageForIframe.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="isNewPageForIframe" type="checkbox" v-model="form.isNewPageForIframe" v-validate="''" data-vv-name="isNewPageForIframe"  name="isNewPageForIframe_fake_element">
        <label class="form-check-label" for="isNewPageForIframe">
            {{ trans('admin.application.columns.isNewPageForIframe') }}
        </label>
        <input type="hidden" name="isNewPageForIframe" :value="form.isNewPageForIframe">
        <div v-if="errors.has('isNewPageForIframe')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('isNewPageForIframe') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('activated'), 'has-success': fields.activated && fields.activated.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="activated" type="checkbox" v-model="form.activated" v-validate="''" data-vv-name="activated"  name="activated_fake_element">
        <label class="form-check-label" for="activated">
            {{ trans('admin.application.columns.activated') }}
        </label>
        <input type="hidden" name="activated" :value="form.activated">
        <div v-if="errors.has('activated')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('activated') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('isFeatured'), 'has-success': fields.isFeatured && fields.isFeatured.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="isFeatured" type="checkbox" v-model="form.isFeatured" v-validate="''" data-vv-name="isFeatured"  name="isFeatured_fake_element">
        <label class="form-check-label" for="isFeatured">
            {{ trans('admin.application.columns.isFeatured') }}
        </label>
        <input type="hidden" name="isFeatured" :value="form.isFeatured">
        <div v-if="errors.has('isFeatured')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('isFeatured') }}</div>
    </div>
</div>


<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('category_id'), 'has-success': this.fields.category_id && this.fields.category_id.valid }">
     <label for="category_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.tab.columns.category_id') }}</label>
     <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
     <select v-model="form.category_id" v-validate="'required'" @input="validate($event)" class="custom-select" :class="{'form-control-danger': errors.has('category_id'), 'form-control-success': fields.category_id && fields.category_id.valid}" id="category_id" name="category_id">
     <option disabled value="">{{ __('Select Category') }}</option>
     <option v-for="category in categories" v-bind:value="category.id">
     @{{ category.name }}
     </option>
     </select>
        <div v-if="errors.has('category_id')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('category_id') }}
        </div>
    </div>
</div>
