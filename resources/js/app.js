import './bootstrap';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';
import Alpine from 'alpinejs';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';

window.Swiper = Swiper;
window.SwiperModules = { Navigation, Pagination, Autoplay, EffectFade };

// Initialize Alpine.js (prevent multiple instances)
if (!window.Alpine) {
    window.Alpine = Alpine;
    Alpine.start();
}
