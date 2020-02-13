require('./bootstrap');
import Vue from 'vue';

import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'

Vue.use(VueMaterial)
import App from './components/App';
const app = new Vue({
    el: '#app',
    components:{
        App,
    }
});
