export default (images, cover = 1, autoplay, interval) => ({
    images: images,
    time: interval,
    current: cover,
    interval: null,
    paused: false,
    init() {
        if (autoplay) this.play();
    },
    play() {
        this.interval = setInterval(() => {
            if (!this.paused) {
                this.next()
            }
        }, this.time)
    },
    reset() {
        if (!autoplay) return;

        clearInterval(this.interval)

        this.time = interval;

        this.play()
    },
    next() {

        if (this.current < this.images.length) {
            this.current = this.current + 1

            this.event('next');

            return;
        }

        this.current = 1

        this.event('next');
    },
    previous() {
        if (this.current > 1) {
            this.current = this.current - 1

            this.event('previous');

            return;
        }

        this.current = this.images.length

        this.event('previous');
    },
    /**
     * Dispatch event
     * @param {String} type
     */
    event(type) {
        this.$refs.carousel.dispatchEvent(new CustomEvent(`x-on:${type}`, {
            detail : { current: this.current, image: this.images[this.current] }
        }))
    }
})
