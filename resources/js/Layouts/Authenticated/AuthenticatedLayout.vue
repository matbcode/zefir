<script setup>
import PanelNavigation from '@/Layouts/Authenticated/Partials/PanelNavigation.vue'
import InputText from 'primevue/inputtext'
import { computed, ref } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import Toast from 'primevue/toast'
import DynamicDialog from 'primevue/dynamicdialog'
import Menu from 'primevue/menu'

const page = usePage()

const user = computed(() => page.props.auth.user)
const languages = computed(() => page.props.languages)

const currentLanguage = computed(() => {
	return languages.value.find((language) => language.id === user.value.language_id)?.name || 'Unknown'
})

const languageMenuItems = ref(
	languages.value.map((language) => ({
		label: language.name,
		command: () => selectLanguage(language.id),
	})),
)

const userMenuItems = ref([
	{ label: 'Profile', icon: 'pi pi-user', command: () => router.visit(route('profile.edit')) },
	{ label: 'Log out', icon: 'pi pi-lock', command: () => router.post(route('logout')) },
])

const languageSelectionMenu = ref()
const userMenu = ref()
const search = ref(null)

const toggleLanguageSelectionMenu = (event) => {
	languageSelectionMenu.value.toggle(event)
}

const toggleUserMenu = (event) => {
	userMenu.value.toggle(event)
}

// Function to handle language selection
const selectLanguage = (language_id) => {
	router.get(route('current-language.update', language_id))
}
</script>

<template>
	<div class="grid-rows-main grid h-screen w-full">
		<header class="grid-cols-main grid items-center border-b border-neutral-200 bg-neutral-50 text-neutral-900">
			<div class="flex w-72 items-center justify-center">
				<div class="flex items-baseline gap-1">
					<span class="text-lg font-bold">Zefir</span>
					<span class="text-xs text-neutral-500">pre-alpha</span>
				</div>
			</div>
			<nav class="flex items-center justify-between pr-6">
				<span class="relative">
					<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-neutral-400">search</span>
					<InputText placeholder="Find anything..." class="w-96 pl-10" />
				</span>
				<div class="flex flex-row items-center gap-4">
					<div
						class="flex h-10 w-10 cursor-pointer items-center justify-center rounded-full border border-neutral-200 bg-neutral-100 transition-colors duration-200 ease-in-out hover:bg-neutral-200">
						<span class="material-symbols-outlined">notifications</span>
					</div>
					<div
						class="flex h-10 cursor-pointer items-center gap-1 rounded-xl border border-neutral-200 bg-neutral-100 pl-4 pr-3 transition-colors duration-200 ease-in-out hover:bg-neutral-200"
						@click="toggleLanguageSelectionMenu">
						<span>{{ currentLanguage }}</span>
						<span class="material-symbols-outlined">translate</span>
					</div>
					<Menu ref="languageSelectionMenu" :model="languageMenuItems" :popup="true" />
					<div
						class="flex h-10 cursor-pointer items-center gap-1 rounded-xl border border-neutral-200 bg-neutral-100 pl-4 pr-3 transition-colors duration-200 ease-in-out hover:bg-neutral-200"
						@click="toggleUserMenu">
						<span>{{ user.name }}</span>
						<span class="material-symbols-outlined">person</span>
					</div>
					<Menu ref="userMenu" :model="userMenuItems" :popup="true" />
				</div>
			</nav>
		</header>
		<main class="grid-cols-main grid h-full">
			<PanelNavigation />
			<slot />
		</main>
	</div>
	<Toast position="bottom-right" />
	<DynamicDialog />
</template>
