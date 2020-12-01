import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';

import './globals/components.js';

Vue.use(VueSweetalert2);
const app = new Vue({
    el: '#app',
    data: {
        title: 'Aztlan'
    }
});

if (process.env.VUE_APP_TEST === 'e2e') {
    window.__app__ = app
}
