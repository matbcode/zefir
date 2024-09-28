<script setup>
import Card from 'primevue/card'
</script>

<template>
	<div class="flex h-screen w-screen items-center justify-center bg-slate-100">
		<Card class="w-full max-w-sm">
			<template #title>
				<slot name="title" />
			</template>
			<template #content>
				<slot name="content" />
			</template>
		</Card>
	</div>
</template>
