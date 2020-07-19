import AppListing from '../app-components/Listing/AppListing';

Vue.component('upload-listing', {
    mixins: [AppListing],
    data: function() {
        var url = new URL(window.location.href);
        var current_directory = url.searchParams.get("current_directory");
        return {
            filters: {
                current_directory: current_directory,
            }
        }
    }
});
