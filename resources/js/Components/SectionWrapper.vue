<script setup></script>

<template>
	<section class="flex flex-col content-stretch overflow-hidden">
		<div class="flex h-16 shrink-0 flex-row items-center justify-between border-b border-neutral-200 bg-neutral-50 px-6">
			<div class="flex flex-row items-end gap-10">
				<h1 class="text-2xl font-semibold"><slot name="title" /></h1>
			</div>
			<div class="flex gap-4"><slot name="controls" /></div>
		</div>
		<div class="h-full w-full overflow-y-auto p-6">
			<slot name="default" />
		</div>
	</section>
</template>
