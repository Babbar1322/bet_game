
require('./bootstrap');

window.Vue = require('vue')

import router from './router'
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
import Vuikit from 'vuikit'
import VuikitIcons from '@vuikit/icons';

import '@vuikit/theme';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import common from './common';
import PerfectScrollbar from 'vue2-perfect-scrollbar'
import 'vue2-perfect-scrollbar/dist/vue2-perfect-scrollbar.css';

import FullpageModal from 'vue-fullpage-modal'
import Clipboard from 'v-clipboard';
import VueCountdownTimer from 'vuejs-countdown-timer';
import 'vue-loaders/dist/vue-loaders.css';
import VueLoaders from 'vue-loaders';

Vue.use(VueLoaders);
Vue.use(Clipboard)
Vue.use(VueCountdownTimer);
Vue.use(FullpageModal)
Vue.use(PerfectScrollbar)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(Vuikit)
Vue.use(VuikitIcons)
Vue.use(ViewUI);
import Vue from 'vue';
Vue.component('mainapp', require('./components/mainapp.vue').default);
Vue.mixin(common);
// Vue.mixin(require('./asset'));

const app = new Vue({
    el: '#app',
    router
});
