import DetailNovaDraftButton from './nova-draft-button/components/DetailButton';
import FormNovaDraftButton from './nova-draft-button/components/FormButton';
import IndexNovaPublishedField from './nova-published-field/components/IndexField';
import DetailNovaPublishedField from './nova-published-field/components/DetailButton';

Nova.booting((Vue, router, store) => {
  Vue.component('detail-nova-draft-button', DetailNovaDraftButton);
  Vue.component('form-nova-draft-button', FormNovaDraftButton);

  Vue.component('index-nova-published-field', IndexNovaPublishedField);
  Vue.component('detail-nova-published-field', DetailNovaPublishedField);
});
