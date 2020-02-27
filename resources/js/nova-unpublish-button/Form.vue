<template>
  <button
    v-if="field.isUnpublishable"
    ref="unpublishButton"
    type="button"
    class="mr-3 btn btn-default btn-danger text-base"
    @click="unpublish"
  >
    {{ this.field.name }}
  </button>
</template>

<script>
import { FormField } from 'laravel-nova';
import FindsNovaElements from '../mixins/FindsNovaElements';
import UnpublishesModels from '../mixins/UnpublishesModels';

export default {
  props: ['resource', 'resourceId', 'field', 'resourceName'],
  mixins: [FormField, FindsNovaElements, UnpublishesModels],

  mounted() {
    const formHeading = this.getFormHeading();
    const unpublishButton = this.$refs.unpublishButton;

    if (formHeading && unpublishButton) {
      formHeading.style.display = 'flex';
      formHeading.style['align-items'] = 'center';
      formHeading.append(unpublishButton);
    }
  },

  methods: {
    fill(formData) {
      // Do nothing
    },
  },
};
</script>

<style>
form h1 > *:first-child {
  margin-left: auto;
}

form h1 > *:last-child {
  margin-right: 0;
}
</style>
