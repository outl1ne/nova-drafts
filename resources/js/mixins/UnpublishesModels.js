export default {
  methods: {
    async unpublish() {
      try {
        await Nova.request().post(`/nova-vendor/nova-drafts/draft-unpublish/${this.resourceId}`, {
          class: this.field.class,
        });

        // Reload page
        this.$router.go(null);
        this.$toasted.show(this.__('novaDrafts.unpublishSuccessToast'), { type: 'success' });
      } catch (e) {
        console.error(e);
        this.$toasted.show(this.__('novaDrafts.unpublishFailedToast'), { type: 'error' });
        return;
      }
    },
  },
};
