import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
	darkMode: 'false',

	content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		'./resources/js/**/*.{vue,js}',
		'./node_modules/primevue/**/*.{vue,js,ts,jsx,tsx}',
	],

	theme: {
		fontFamily: {
			sans: ['Assistant', ...defaultTheme.fontFamily.sans],
		},
		container: {
			center: true,
		},
		extend: {
			gridTemplateColumns: {
				main: '288px minmax(0, 1fr)',
			},
			gridTemplateRows: {
				main: '72px minmax(0, 1fr)',
			},
		},
	},

	plugins: [forms, require('tailwindcss-primeui')],
}
