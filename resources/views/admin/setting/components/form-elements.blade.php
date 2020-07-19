

<div v-if="data.inputType != 3" class="form-group row align-items-center">
        <div class="col-12 text-center">@{{form.description}}</div>
</div>
<div v-if="data.inputType == 0" class="form-group row align-items-center" :class="{'has-danger': errors.has('value'), 'has-success': fields.value && fields.value.valid }">
    <div class="col-12">
        <div>
            <input type="text" v-model="form.value" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('value'), 'form-control-success': fields.value && fields.value.valid}" id="value" name="value">
        </div>
        <div v-if="errors.has('value')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('value') }}</div>
    </div>
</div>
<div v-if="data.inputType == 1" class="form-group row align-items-center" :class="{'has-danger': errors.has('value'), 'has-success': fields.value && fields.value.valid }">
    <div class="col-12">
        <div>
            <wysiwyg v-model="form.value" v-validate="''" id="value" name="value" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('value')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('value') }}</div>
    </div>
</div>
<div v-if="data.inputType == 2" class="form-group row align-items-center" :class="{'has-danger': errors.has('value'), 'has-success': fields.value && fields.value.valid }">
    <div class="col-12">
        <div>
            <textarea class="form-control" v-model="form.value" v-validate="''" id="value" name="value"></textarea>
        </div>
        <div v-if="errors.has('value')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('value') }}</div>
    </div>
</div>

<div v-if="data.inputType == 3" class="form-check row" :class="{'has-danger': errors.has('value'), 'has-success': fields.value && fields.value.valid }">
    <div class="ml-md-auto col-12">
        <input class="form-check-input" id="value" type="checkbox" v-model="form.value" v-validate="''" data-vv-name="value"  name="value_fake_element">
        <label class="form-check-label" for="value">
            @{{form.description}}
        </label>
        <input type="hidden" name="value" :value="form.value">
        <div v-if="errors.has('value')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('value') }}</div>
    </div>
</div>


<div v-if="data.inputType == 4" class="form-group row align-items-center" :class="{'has-danger': errors.has('value'), 'has-success': fields.value && fields.value.valid }">
    <div class="col-12 text-center">
        <div>
            <input type="text" v-model="form.value" v-validate="'numeric'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('value'), 'form-control-success': fields.value && fields.value.valid}" id="value" name="value">
        </div>
        <div v-if="errors.has('value')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('value') }}</div>
    </div>
</div>

