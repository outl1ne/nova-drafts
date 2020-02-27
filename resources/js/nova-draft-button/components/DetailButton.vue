<template>
  <button
    ref="deleteNovaDraftButton"
    type="button"
    class="mr-3 btn btn-default btn-danger"
    v-if="isDraft"
    v-on:click="discard"
  >
    {{ __('novaDrafts.discardDraftButtonText') }}
  </button>
</template>

<script>
import { InteractsWithResourceInformation, Deletable } from 'laravel-nova';
import FindsNovaElements from '../../mixins/FindsNovaElements';

export default {
  mixins: [Deletable, InteractsWithResourceInformation, FindsNovaElements],

  props: ['resource', 'resourceId', 'field', 'resourceName'],

  mounted() {
    if (this.isDraft) {
      const deleteButton = this.getDetailDeleteButton();
      if (deleteButton) {
        deleteButton.style.display = 'none';
        deleteButton.parentNode.insertBefore(this.$refs.deleteNovaDraftButton, deleteButton);
      }
    }
  },

  beforeMount() {
    if (this.field.childDraft && this.field.childDraft.id) {
      this.$router.replace(`${this.field.childDraft.id}`);
      this.$nextTick(this.$parent.$parent.getFields); // ! Might break with new Laravel Nova versions
    }
  },

  computed: {
    isDraft() {
      return this.field.isDraft;
    },
  },

  methods: {
    discard() {
      this.forceDeleteResources([this.resource], () => {
        this.$toasted.show(this.__('novaDrafts.dicardSuccessToast'), { type: 'success' });
        this.$router.push({ name: 'index', params: { resourceName: this.resourceName } });
      });
    },
  },
};
</script>

<style scoped>
.btn-danger {
  white-space: nowrap;
}
</style>
