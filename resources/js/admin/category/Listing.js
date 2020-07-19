import AppListing from '../app-components/Listing/AppListing';

Vue.component('category-listing', {
    mixins: [AppListing],
    data: function data() {
        return {
            orderBy: {
                column: 'itemorder',
                direction: 'asc'
            },
        }
    }
});
