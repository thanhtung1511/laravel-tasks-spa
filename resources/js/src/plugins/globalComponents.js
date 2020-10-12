import {DropDown} from '../components';
import {
  CollapseTransition,
  SlideYDownTransition,
  FadeTransition,
  ZoomCenterTransition,
} from 'vue2-transitions';

const GlobalComponents = {
  install(Vue) {
    Vue.component('drop-down', DropDown);
    Vue.component('CollapseTransition', CollapseTransition);
    Vue.component('SlideYDownTransition', SlideYDownTransition);
    Vue.component('FadeTransition', FadeTransition);
    Vue.component('ZoomCenterTransition', ZoomCenterTransition);
  },
};

export default GlobalComponents;
