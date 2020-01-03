Nova.booting((Vue, router, store) => {
  Vue.component('index-nova-drafts', require('./components/IndexField'))
  Vue.component('detail-nova-drafts', require('./components/DetailField'))
  Vue.component('form-nova-drafts', require('./components/FormField'))
})
