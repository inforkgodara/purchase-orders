import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import App from './App'
import router from './router'
import store from './store'
import Toasted from 'vue-toasted'
import VeeValidate from 'vee-validate'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

Vue.use(Toasted, {
    iconPack : 'fontawesome',
    position: 'bottom-right',
    duration: 6000,
    action: {
        text: 'Close',
        class: 'large-font',
        onClick: (e, toastObject) => {
            toastObject.goAway(0);
        }
    },
});


Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('v-select', vSelect)

Vue.use(Toasted)
Vue.use(BootstrapVue)
Vue.use(VeeValidate);
 
window.Vue = new Vue({
    el        : '#app',
    router    : router,
    store     : store,
    template  : '<App/>',
    components: { App },
})
