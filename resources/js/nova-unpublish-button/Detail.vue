<template>
  <button
    v-if="field.isUnpublishable"
    ref="unpublishButton"
    type="button"
    class="mr-3 btn btn-default btn-danger"
    @click="unpublish"
  >
    {{ __('novaDrafts.unpublishButtonText') }}
  </button>
</template>

<script>
import { InteractsWithResourceInformation, Deletable } from 'laravel-nova';
import FindsNovaElements from '../mixins/FindsNovaElements';
import UnpublishesModels from '../mixins/UnpublishesModels';

export default {
  props: ['resource', 'resourceId', 'field', 'resourceName'],
  mixins: [Deletable, InteractsWithResourceInformation, FindsNovaElements, UnpublishesModels],

  mounted() {
    if (this.field.isUnpublishable) {
      const deleteButton = this.getDetailDeleteButton();
      const unpublishButton = this.$refs.unpublishButton;

      if (deleteButton && unpublishButton) {
        deleteButton.parentElement.insertBefore(unpublishButton, deleteButton);
      }
    }
  },
};
</script>
