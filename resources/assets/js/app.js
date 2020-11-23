import Vue from 'vue';
import './globals/components.js';

const app = new Vue({
    el: '#app',
    data: {
        title: 'Aztlan'
    }
});

if (process.env.VUE_APP_TEST === 'e2e') {
    window.__app__ = app
}
