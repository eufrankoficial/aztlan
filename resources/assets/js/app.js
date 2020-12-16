import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import Vuelidate from 'vuelidate'
import VueMask from 'v-mask';

import './globals/components.js';

Vue.use(VueSweetalert2);
Vue.use(Vuelidate);
Vue.use(VueMask);

const app = new Vue({
    el: '#app',
    data: {
        title: 'Aztlan'
    }
});

if (process.env.VUE_APP_TEST === 'e2e') {
    window.__app__ = app
}
