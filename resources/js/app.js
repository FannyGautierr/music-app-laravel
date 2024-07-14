import './bootstrap';
import '../css/app.css';
import 'primeicons/primeicons.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const AudioPlugin = {
    install(app) {
        app.config.globalProperties.$playAudio = (audio) => {
            const audioElement = new Audio(audio);
            audioElement.play();
        }
        app.config.globalProperties.$pauseAudio = () => {
            app.config.globalProperties.$playAudio('/audio/success.mp3');
        }
    },
}

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(AudioPlugin)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
