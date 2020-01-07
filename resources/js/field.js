Nova.booting((Vue, router, store) => {
    Vue.component('detail-nova-draft-button', require('./nova-draft-button/components/DetailButton'));
    Vue.component('form-nova-draft-button', require('./nova-draft-button/components/FormButton'));

    Vue.component('index-nova-published-field', require('./nova-published-field/components/IndexField'));
    Vue.component('detail-nova-published-field', require('./nova-published-field/components/DetailButton'));
});
