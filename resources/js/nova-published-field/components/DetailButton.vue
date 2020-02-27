<template>
  <panel-item :field="field">
    <template slot="value">
      <publish-indicator :draft="isDraft" :published="field.value" />
      <publish-button :draftId="draftId" :resourceClass="field.class" ref="publishButton" v-if="!field.value" />
    </template>
  </panel-item>
</template>

<script>
import PublishButton from './PublishButton';
import PublishIndicator from './PublishIndicator';

export default {
  components: { PublishButton, PublishIndicator },
  props: ['resource', 'field'],

  data() {
    return {
      draftId: this.resource.id.value,
    };
  },

  computed: {
    isDraft() {
      return !this.field.value || (this.field.value && (this.field.childDraft || this.field.draftParent));
    },
  },

  mounted() {
    if (!this.field.value) {
      const editButtonEl = document.querySelector('.content').querySelector('[dusk="edit-resource-button"]');
      editButtonEl.parentNode.append(this.$refs.publishButton.$el);
    }
  },
};
</script>
