export default {
  methods: {
    async unpublish() {
      try {
        await Nova.request().post(`/nova-vendor/nova-drafts/draft-unpublish/${this.resourceId}`, {
          class: this.field.class,
        });

        // Reload page
        this.$router.go();
      } catch (e) {
        this.$toasted.show(`Unpublishing failed (${e.message})`, { type: 'error' });
        return;
      }
    },
  },
};
