Nova.booting((Vue, router, store) => {
  Vue.component('index-nova-draft-button', require('./components/IndexField'))
  Vue.component('detail-nova-draft-button', require('./components/DetailField'))
  Vue.component('form-nova-draft-button', require('./components/FormField'))
})
