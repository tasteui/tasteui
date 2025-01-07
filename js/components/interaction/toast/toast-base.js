export default (flash) => ({
  show: false,
  toasts: [],
  init () {
    if (flash) window.onload = () => this.add(flash);
    if (flash) document.addEventListener('livewire:navigated', () => this.add(flash), { once: true });
  },
  /**
   * Add a new toast to the list.
   *
   * @param {Event} event
   * @return {void}
   */
  add(event) {
    this.$nextTick(() => this.show = true);

    if (flash) {
      // Since flash tends to be something to be
      // displayed later, we clear the array before
      // sending to prevent duplication.
      this.toasts = [];

      this.toasts.push(flash);
    }

    if (event.detail) {
      event.detail.id = event.timeStamp;

      this.toasts.push(event.detail);
    }
  },
  /**
   * Remove a toast from the list.
   *
   * @param {Object} toast
   * @return {void}
   */
  remove(toast) {
    this.toasts = this.toasts.filter((element) => element.id !== toast.id);
  },
});
