import Vue from 'vue';
import './globals/components.js';

const app = new Vue({
    el: '#app',
    data: {
        title: 'Aztlan'
    }
});


// If running e2e tests...
if (process.env.VUE_APP_TEST === 'e2e') {
    // Attach the app to the window, which can be useful
    // for manually setting state in Cypress commands
    // such as `cy.logIn()`.
    window.__app__ = app
}
