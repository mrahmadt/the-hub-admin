import AppForm from '../app-components/Form/AppForm';

Vue.component('application-form', {
    mixins: [AppForm],
    props: [
        'categories',
    ],
    data: function() {
        return {
            form: {
                name:  '' ,
                url:  '' ,
                icon:  '' ,
                description:  '' ,
                isNewPage:  false ,
                isNewPageForIframe:  false ,
                activated:  true ,
                isFeatured:  false ,
                category_id:  '' ,
            },
            showLoading: false,
            showIconList: false,
            extraIcons: []
        }
    },
    methods: {
        changIcon(iconURL){
            this.form.icon = iconURL;
        },
        getLinkMeta () {
            if(this.form.url=="") return false;
            //alert(form.url);
            this.showLoading = true;
            this.showIconList = false;
            axios.get("/admin/links/meta?url="+this.form.url)
            .then(response => {
                this.form.name = '';
                this.form.icon = '';
                this.form.description = '';

                this.form.name = response.data.title;
                this.form.icon = response.data.icon;
                this.form.description = response.data.description;
                this.showLoading = false;

                this.showIconList = true;
                this.extraIcons = response.data.extra_icons
                console.log(response)
            })
            .catch(err => {
                this.showLoading = false;
                //alert('Network error!');
                console.log('error')
                console.log(err)
            })
            //this.form.name = "sadasdas";
            //this.form.icon = "HEEEEEL";
            //this.form.description = "HEEEEEL"
        }
    }

});
