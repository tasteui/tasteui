export default (model, min, max, delay, step) => ({
  model: model,
  min: min,
  max: max,
  interval: null,
  delay: delay,
  init() {
    if (this.defined) {
      this.disableMinus = this.atMinus;
      this.disablePlus = this.atPlus;
    }

    this.$watch('model', (value) => {
      if (isNaN(value) || !value) return;

      this.$refs.input.value = this.model = value;
    });
  },
  /**
   * Increment the value.
   *
   * @return {void}
   */
  increment() {
    if (this.limiters) {
      if (this.defined && this.atPlus) {
        this.disablePlus = true;
        return;
      }

      if ((parseInt(this.model) + step) > this.max) {
        this.model = this.max;
        this.$refs.input.value = this.max;
        this.disablePlus = true;

        return;
      }

      this.model ||= this.min;
      this.$refs.input.value ||= this.min;
    }

    this.$refs.input.stepUp(step);
    this.$refs.input.dispatchEvent(new Event('change'));
    this.update();
  },
  /**
   * Decrement the value.
   *
   * @return {void}
   */
  decrement() {
    if (this.limiters) {
      if (this.defined && this.atMinus) {
        this.disableMinus = true;
        return;
      }

      if ((parseInt(this.model) - step) < this.min) {
        this.model = this.min;
        this.$refs.input.value = this.min;
        this.disableMinus = true;

        return;
      }

      this.model ||= this.min;
      this.$refs.input.value ||= this.min;
    }

    this.$refs.input.stepDown(step);
    this.$refs.input.dispatchEvent(new Event('change'));
    this.update();
  },
  /**
   * Update the value of the model.
   *
   * @return {void}
   */
  update() {
    this.model = this.$refs.input.value;

    if (!this.limiters) {
      return;
    }

    this.disableMinus = this.defined && this.atMinus;
    this.disablePlus = this.defined && this.atPlus;
  },
  /**
   * Performs validations on the input value when blur effect occurs.
   */
  validate() {
    const value = this.$refs.input.value;

    if (this.min !== null && value < this.min) {
      this.$refs.input.value = this.model = null;
    }

    if (this.max !== null && value > this.max) {
      this.$refs.input.value = this.model = null;
    }

    this.disablePlus = this.atPlus;
    this.disableMinus = this.atMinus;
  },
  /**
   * Check if the model is defined.
   *
   * @return {Boolean}
   */
  get defined() {
    return this.model === 0 || Boolean(this.model);
  },
  /**
   * Check if the model is at the minimum value.
   *
   * @return {Boolean}
   */
  get atMinus() {
    return this.min !== null && (this.model <= this.min);
  },
  /**
   * Check if the model is at the maximum value.
   *
   * @return {Boolean}
   */
  get atPlus() {
    return this.max !== null && (this.model >= this.max);
  },
  /**
   * Disable the minus button.
   *
   * @return {void}
   */
  set disableMinus(disabled) {
    this.$refs.minus.disabled = disabled;
  },
  /**
   * Disable the plus button.
   *
   * @return {void}
   */
  set disablePlus(disabled) {
    this.$refs.plus.disabled = disabled;
  },
  /**
   * Check if the model has limiters.
   *
   * @return {Boolean}
   */
  get limiters() {
    return this.min !== null || this.max !== null;
  },
});
