import './bootstrap';

import jQuery from "jquery";
window.$ = window.jQuery = jQuery;

import { createApp, h } from 'vue'
import { createInertiaApp , Link } from '@inertiajs/vue3'
import { ZiggyVue } from 'ziggy';
import { Ziggy } from './ziggy';
import MainLayout from './Layouts/MainLayout.vue'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page = pages[`./Pages/${name}.vue`]
    page.default.layout = name.startsWith('Public/') ? undefined : MainLayout
    return page
  },


  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue, Ziggy)
      .component("Link" , Link)
      .mixin({ methods: {route} })
      .mount(el)
  },
})
