import VueMaterial from "vue-material";
import "vue-material/dist/vue-material.min.css";
import "@/assets/scss/material-ui.scss";
import "@/assets/custom.scss";
import globalDirectives from "./globalDirectives";
import globalMixins from "./globalMixins";
import globalComponents from "./globalComponents";
import VueLazyload from "vue-lazyload";
import VueCarousel from "vue-carousel";

// Sidebar on the right. Used as a local plugin in Dashboard.vue
import SideBar from "@/components/SidebarPlugin";

// library auto imports
import "es6-promise/auto";


export default {
  install(Vue) {
    Vue.use(SideBar);
    Vue.use(VueMaterial);
    Vue.use(globalDirectives);
    Vue.use(globalMixins);
    Vue.use(globalComponents);
    Vue.use(VueCarousel);
    Vue.use(VueLazyload, {
      observer: true,
      // optional
      observerOptions: {
        rootMargin: "0px",
        threshold: 0.1
      }
    });
  }
};
