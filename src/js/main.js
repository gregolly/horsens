import initMenuModal from "./components/menuModal";
import initSearchModal from "./components/searchModal";
import initSliderControls from "./components/sliderControl";
import initFaqAccordion from "./components/faq-accordion";
import initScrollReveal from "./components/scrollReveal";

document.addEventListener('DOMContentLoaded', function() {
    initMenuModal();
    initSearchModal();
    initSliderControls();
    initFaqAccordion();
    initScrollReveal();
});