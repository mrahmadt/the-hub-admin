import AppForm from '../app-components/Form/AppForm';

Vue.component('upload-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                
            }
        }
    }

});