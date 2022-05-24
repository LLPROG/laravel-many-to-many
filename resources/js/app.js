
require('./bootstrap');
import Axios from 'axios';
import 'bootstrap';
import { values } from 'lodash';

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});


const btnSlugger = document.getElementById('btn-slugger');

// function for button slugger

if (btnSlugger) {
    btnSlugger.addEventListener('click', function() {
        const eleSlug = document.getElementById('slug');
        const title = document.getElementById('title').value;

        Axios.post('/admin/slugger', {
            originalTitle: title
        })
            .then(function (response) {
                eleSlug.value = response.data.slug;
            })
    })
}


const confirmationOverlay = document.querySelector('#confirmation-overlay');

if (confirmationOverlay) {
    const confirmationForm = confirmationOverlay.querySelector('form');

    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            const index = this.closest('tr').dataset.id;
            const action = confirmationForm.dataset.base.replace('*****', index);
            confirmationForm.action = action;

            confirmationOverlay.classList.remove('d-none');

        })
    });

    const btnNo = document.querySelector('#btn-no');
    btnNo.addEventListener('click', function () {
        confirmationForm.action = '';
        confirmationOverlay.classList.add('d-none');
    })
}
