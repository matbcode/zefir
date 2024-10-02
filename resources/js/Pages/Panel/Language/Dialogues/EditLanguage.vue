<script setup>
import { router, useForm } from '@inertiajs/vue3'
import { useToast } from 'primevue/usetoast'
import InputText from 'primevue/inputtext'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Button from 'primevue/button'
import { inject } from 'vue'
import ToggleSwitch from 'primevue/toggleswitch'

const toast = useToast()
const dialogRef = inject('dialogRef')

const closeDialog = () => {
	dialogRef.value.close()
}

const form = useForm({
	public: dialogRef.value.data.public,
	name: dialogRef.value.data.name,
	abbreviation: dialogRef.value.data.abbreviation,
	code: dialogRef.value.data.code,
})

function submit() {
	form.patch(route('language.update', dialogRef.value.data.id), {
		onSuccess: () => {
			dialogRef.value.close()
			toast.add({
				severity: 'success',
				summary: 'Success',
				detail: form.name + ' has been updated',
				life: 6000,
			})
		},
	})
}
</script>

<template>
	<form @submit.prevent="submit" class="space-y-4">
		<div>
			<InputLabel for="name" value="Language" />
			<InputText id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus />
			<InputError class="mt-2" :message="form.errors.name" />
		</div>
		<div>
			<InputLabel for="abbreviation" value="Abbreviation" />
			<InputText id="abbreviation" type="text" class="mt-1 block w-full" v-model="form.abbreviation" required />
			<InputError class="mt-2" :message="form.errors.abbreviation" />
		</div>
		<div>
			<InputLabel for="code" value="Code" />
			<InputText id="code" type="text" class="mt-1 block w-full" v-model="form.code" required />
			<InputError class="mt-2" :message="form.errors.code" />
		</div>
		<div class="flex items-center">
			<ToggleSwitch v-model="form.public" />
			<label class="ml-2">Public</label>
		</div>
		<div class="flex items-center gap-2">
			<Button severity="success" type="submit" :loading="form.processing">Save</Button>
			<Button @click="closeDialog" severity="secondary" type="button" :loading="form.processing">Cancel</Button>
		</div>
	</form>
</template>
