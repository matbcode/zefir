<script setup>
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/Authenticated/AuthenticatedLayout.vue'
</script>

<template>
	<Head title="Dashboard" />
	<AuthenticatedLayout>
		<h1 class="text-2xl font-semibold leading-4 text-neutral-800">Navigations</h1>
	</AuthenticatedLayout>
</template>
