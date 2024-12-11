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

    if (event.detail) event.detail.id = event.timeStamp;

    this.toasts.push(event.detail ?? flash);
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
