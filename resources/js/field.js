import DetailNovaUnpublishButton from './nova-unpublish-button/Detail';
import FormNovaUnpublishButton from './nova-unpublish-button/Form';
import DetailNovaDraftButton from './nova-draft-button/components/DetailButton';
import FormNovaDraftButton from './nova-draft-button/components/FormButton';
import DetailNovaPublishedField from './nova-published-field/components/DetailButton';
import IndexNovaPublishedField from './nova-published-field/components/IndexField';

Nova.booting((Vue) => {
    // Nova.inertia('DetailNovaDraftButton', DetailNovaDraftButton)
  Vue.component('detail-nova-draft-button', DetailNovaDraftButton);

  Vue.component('form-nova-draft-button', FormNovaDraftButton);

  Vue.component('index-nova-published-field', IndexNovaPublishedField);
  Vue.component('detail-nova-published-field', DetailNovaPublishedField);

  Vue.component('detail-nova-unpublish-button', DetailNovaUnpublishButton);
  Vue.component('form-nova-unpublish-button', FormNovaUnpublishButton);
});
