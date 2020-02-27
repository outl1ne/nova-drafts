export default {
  methods: {
    getDetailDeleteButton() {
      return document.querySelector('.content').querySelector('[dusk=open-delete-modal-button]');
    },

    getFormHeading() {
      return document.querySelector('form > * > h1');
    },
  },
};
