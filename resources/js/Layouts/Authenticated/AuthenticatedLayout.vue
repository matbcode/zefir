<script setup>
import PanelNavigation from '@/Layouts/Authenticated/Partials/PanelNavigation.vue'
import InputText from 'primevue/inputtext'
import { ref } from 'vue'

const search = ref(null)
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
			<nav class="flex justify-between pr-6">
				<span class="relative">
					<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-neutral-400">search</span>
					<InputText placeholder="Find anything..." class="w-96 pl-10" />
				</span>
				<div class="flex items-center gap-1">
					<span>Mateusz</span>
					<span class="material-symbols-outlined text-xl">person</span>
				</div>
			</nav>
		</header>
		<main class="grid-cols-main grid">
			<PanelNavigation />
			<section class="overflow-y-scroll bg-neutral-50 p-6">
				<slot />
			</section>
		</main>
	</div>
</template>
