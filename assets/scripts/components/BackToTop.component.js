import $ from 'jquery'

export default class BackToTop {
    constructor(selector) {
        this.showHide()
        selector.addEventListener("click", () => {
            this.backToTop()
        });
    }

    backToTop() {
        $('html,body').animate({ scrollTop: 0 }, 'slow');
    }

    showHide() {
        const self = this

        const element = document.querySelector(".back-to-top")
        const add_class_on_scroll = () => element.classList.add('back-to-top--show')
        const remove_class_on_scroll = () => element.classList.remove('back-to-top--show')

        window.addEventListener('scroll', function() {
            self.scrollpos = window.scrollY;

            if (self.scrollpos >= 400) { add_class_on_scroll() }
            else { remove_class_on_scroll() }
        })
    }
}