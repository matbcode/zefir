<script setup></script>

<template>
	<div class="flex flex-col gap-6 rounded-xl border border-neutral-200 bg-white p-6">
		<div class="flex flex-row justify-between">
			<div class="flex flex-col gap-1">
				<h2 class="text-xl font-semibold text-neutral-800"><slot name="title" /></h2>
				<p class="text-sm text-neutral-700"><slot name="description" /></p>
			</div>
			<div>
				<slot name="controls" />
			</div>
		</div>
		<div>
			<slot name="content" />
		</div>
	</div>
</template>
