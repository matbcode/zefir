<script setup>
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/Authenticated/AuthenticatedLayout.vue'
</script>

<template>
	<Head title="Dashboard" />
	<AuthenticatedLayout>
		<template #title>Dashboard</template>
	</AuthenticatedLayout>
</template>
