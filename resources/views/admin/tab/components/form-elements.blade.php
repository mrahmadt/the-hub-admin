
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.tab.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required|max:100'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.tab.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>
     <input type="hidden" v-model="form.tabtype_id"  class="form-control" id="tabtype_id" name="tabtype_id">

<div v-if="tabtype.body_required" class="form-group row align-items-center" :class="{'has-danger': errors.has('body'), 'has-success': fields.body && fields.body.valid }">
    <label for="body" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.tab.columns.body') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.body" v-validate="'required'" id="body" name="body" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('body')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('body') }}</div>
    </div>
</div>

<div v-if="tabtype.url_required" class="form-group row align-items-center" :class="{'has-danger': errors.has('url'), 'has-success': fields.url && fields.url.valid }">
    <label for="url" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.tab.columns.url') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.url" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('url'), 'form-control-success': fields.url && fields.url.valid}" id="url" name="url" placeholder="https://www.example.com">
        <div v-if="errors.has('url')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('url') }}</div>
    </div>
</div>

<div v-if="tabtype.category_required" class="form-group row align-items-center"
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

<div class="form-check row" :class="{'has-danger': errors.has('activated'), 'has-success': fields.activated && fields.activated.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="activated" type="checkbox" v-model="form.activated" v-validate="''" data-vv-name="activated"  name="activated_fake_element">
        <label class="form-check-label" for="activated">
            {{ trans('admin.tab.columns.activated') }}
        </label>
        <input type="hidden" name="activated" :value="form.activated">
        <div v-if="errors.has('activated')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('activated') }}</div>
    </div>
</div>
