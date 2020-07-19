import AppListing from '../app-components/Listing/AppListing';

Vue.component('tab-listing', {
    mixins: [AppListing],
    data() {
        return {
            showCategoriesFilter: false,
            categoriesMultiselect: {},
            showTabtypesFilter: false,
            tabtypesMultiselect: {},

            filters: {
                categories: [],
                tabtypes: [],
            },
            orderBy: {
                column: 'itemorder',
                direction: 'asc'
            }
        }
    },
    
    watch: {
        showCategoriesFilter: function (newVal, oldVal) {
            this.categoriesMultiselect = [];
        },
        showTabtypesFilter: function (newVal, oldVal) {
            this.tabtypesMultiselect = [];
        },
        categoriesMultiselect: function(newVal, oldVal) {
            this.filters.categories = newVal.map(function(object) { return object['key']; });
            this.filter('categories', this.filters.categories);
        },
        tabtypesMultiselect: function(newVal, oldVal) {
            this.filters.tabtypes = newVal.map(function(object) { return object['key']; });
            this.filter('tabtypes', this.filters.tabtypes);
        }
    }
});
