<script setup></script>

<template>
	<section class="flex flex-col gap-6 overflow-y-scroll bg-neutral-100 p-6">
		<div class="flex flex-row justify-between">
			<h1 class="text-2xl font-semibold leading-4 text-neutral-800"><slot name="title" /></h1>
			<div class="flex gap-4"><slot name="controls" /></div>
		</div>
		<div>
			<slot name="default" />
		</div>
	</section>
</template>
