import AppListing from '../app-components/Listing/AppListing';

Vue.component('page-listing', {
    mixins: [AppListing],
    methods: {
        copyURL(url){
            let url_text_input = document.querySelector('#url-text')
            url_text_input.setAttribute('type', 'text')
            url_text_input.value = url
            url_text_input.select()
            try {
                var successful = document.execCommand('copy');
                if(successful){
                    this.$notify({ type: 'success', title: 'Success!', text: 'URL was copied.'});
                }else{
                    this.$notify({ type: 'error', title: 'Error!', text: 'URL was not copied.'});
                }
            } catch (err) {
                this.$notify({ type: 'error', title: 'Oops!', text: 'unable to copy.'});
            }
            url_text_input.setAttribute('type', 'hidden')
            window.getSelection().removeAllRanges()
  
        }
    }
});
