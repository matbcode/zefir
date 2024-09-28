<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import PanelMenu from 'primevue/panelmenu'
import Badge from 'primevue/badge'

const items = ref([
	{
		label: 'Structure',
		icon: 'dashboard',
		items: [
			{
				label: 'Navigations',
				icon: 'toolbar',
			},
			{
				label: 'Pages',
				icon: 'space_dashboard',
			},
		],
	},
	{
		label: 'Content',
		icon: 'stacks',
		items: [
			{
				label: 'Articles',
				icon: 'news',
			},
			{
				label: 'Components',
				icon: 'widgets',
			},
			{
				label: 'Files',
				icon: 'hard_drive',
			},
		],
	},
	{
		label: 'Data Collection',
		icon: 'assignment',
		items: [
			{
				label: 'Forms',
				icon: 'move_to_inbox',
			},
			{
				label: 'Data',
				icon: 'database',
				badge: 4,
			},
		],
	},
	{
		label: 'Integrations',
		icon: 'category',
		items: [
			{
				label: 'Analytics',
				icon: 'analytics',
			},
			{
				label: 'Newsletter',
				icon: 'mail',
			},
		],
	},
	{
		label: 'SEO',
		icon: 'troubleshoot',
		items: [
			{
				label: 'Metadata',
				icon: 'description',
			},
			{
				label: 'Sitemap',
				icon: 'explore',
			},
			{
				label: 'Robots',
				icon: 'robot_2',
			},
		],
	},
	{
		label: 'Localisation',
		icon: 'globe_uk',
		items: [
			{
				label: 'Languages',
				icon: 'language',
			},
			{
				label: 'Translations',
				icon: 'translate',
			},
		],
	},
	{
		label: 'Configuration',
		icon: 'settings',
		items: [
			{
				label: 'Users',
				icon: 'group',
			},
			{
				label: 'Domains',
				icon: 'domain',
			},
			{
				label: 'Redirects',
				icon: 'forward',
			},
			{
				label: 'Settings',
				icon: 'tune',
			},
			{
				label: 'Security',
				icon: 'security',
			},
		],
	},
])
</script>

<template>
	<Head title="Dashboard" />
	<main class="flex flex-row">
		<div class="h-screen w-full max-w-xs bg-slate-50 p-4 shadow-md">
			<PanelMenu :model="items" class="w-full">
				<template #item="{ item }">
					<component :is="items.href ? 'Link' : 'div'" class="group flex cursor-pointer items-center px-4 py-2">
						<span class="material-symbols-outlined">{{ item.icon }}</span>
						<span :class="['ml-2', { 'font-semibold': item.items }]">{{ item.label }}</span>
						<Badge v-if="item.badge" class="ml-auto" :value="item.badge" />
					</component>
				</template>
			</PanelMenu>
		</div>
		<div>
			<header></header>
		</div>
	</main>
	<footer></footer>
</template>
