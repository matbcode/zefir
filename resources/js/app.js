import './bootstrap'
import '../css/panel.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { createPinia } from 'pinia'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import PrimeVue from 'primevue/config'
import ToastService from 'primevue/toastservice'
import DialogService from 'primevue/dialogservice'
import Aura from './presets/aura'
import AuthenticatedLayout from '@/Layouts/Authenticated/AuthenticatedLayout.vue'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'
const pinia = createPinia()

createInertiaApp({
	title: (title) => `${title} - ${appName}`,
	resolve: (name) => {
		const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
		let page = pages[`./Pages/${name}.vue`]
		// Swap the conditions here
		page.default.layout = name.startsWith('Panel/') ? AuthenticatedLayout : undefined
		return page
	},
	setup({ el, App, props, plugin }) {
		return createApp({ render: () => h(App, props) })
			.use(plugin)
			.use(ZiggyVue)
			.use(pinia)
			.use(PrimeVue, {
				unstyled: true,
				pt: Aura,
			})
			.use(ToastService)
			.use(DialogService)
			.mount(el)
	},
	progress: {
		color: '#000',
	},
})
