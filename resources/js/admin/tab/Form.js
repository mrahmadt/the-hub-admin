import AppForm from '../app-components/Form/AppForm';

Vue.component('tab-form', {
    mixins: [AppForm],
    props: [
        'categories',
        'tabtype'
    ],
    data: function() {
        return {
            form: {
                name:  '' ,
                tabtype_id:  '',
                body:  '' ,
                url:  '' ,
                category_id:  '' ,
                activated: 1,
            }
        }
    }
});
