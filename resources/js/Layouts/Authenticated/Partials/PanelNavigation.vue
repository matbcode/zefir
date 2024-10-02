<script setup>
import { ref } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage()

const items = ref([
	{
		label: 'Structure',
		icon: 'dashboard',
		expanded: false,
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
		expanded: false,
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
		expanded: false,
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
		icon: 'deployed_code',
		expanded: false,
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
		expanded: false,
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
		expanded: false,
		items: [
			{
				label: 'Languages',
				icon: 'language',
				href: route('language.index'),
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
		expanded: false,
		items: [
			{
				label: 'Users',
				icon: 'group',
				href: route('user.index'),
			},
			{
				label: 'Domains',
				icon: 'domain',
				href: route('domain.index'),
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
	<div class="overflow-y-auto overflow-x-hidden border-r border-neutral-200 bg-neutral-50">
		<div class="flex w-72 flex-col gap-2 overflow-hidden p-6">
			<div v-for="item in items">
				<div
					@click="item.expanded = !item.expanded"
					:class="item.expanded ? 'bg-neutral-200' : 'bg-neutral-100'"
					class="flex cursor-pointer flex-row items-center gap-2 rounded-lg border border-neutral-200 bg-neutral-100 p-3 transition-colors duration-200 ease-in-out hover:bg-neutral-200">
					<span class="material-symbols-outlined">{{ item.icon }}</span>
					<span class="text-sm font-semibold text-neutral-900">{{ item.label }}</span>
				</div>
				<div
					:class="item.expanded ? 'max-h-96 py-3 opacity-100' : 'max-h-0 py-0 opacity-0'"
					class="flex cursor-pointer flex-col gap-3 overflow-hidden pl-4 transition-all duration-300 ease-in-out">
					<Link
						v-for="item in item.items"
						:href="item.href"
						class="flex items-center gap-1.5 transition-all duration-200 ease-in-out hover:pl-2"
						:class="page.props.ziggy.location === item.href ? 'pl-2 text-blue-500' : 'text-neutral-900'">
						<span class="material-symbols-outlined">{{ item.icon }}</span>
						<span class="text-sm font-semibold">{{ item.label }}</span>
					</Link>
				</div>
			</div>
		</div>
	</div>
</template>
