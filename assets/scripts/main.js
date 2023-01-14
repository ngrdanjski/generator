require('./vue/vue');
import BackToTop from "./components/BackToTop.component";

const components = [
    {
        class: BackToTop,
        selector: '.back-to-top'
    }
];

components.forEach(component => {
    if (document.querySelector(component.selector) !== null) {
        document.querySelectorAll(component.selector).forEach(
            element => new component.class(element, component.options)
        );
    }
});
