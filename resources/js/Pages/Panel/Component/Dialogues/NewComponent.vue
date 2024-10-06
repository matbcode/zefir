<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { useToast } from 'primevue/usetoast'
import InputText from 'primevue/inputtext'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Button from 'primevue/button'
import { inject } from 'vue'
import Select from 'primevue/select'

const toast = useToast()
const dialogRef = inject('dialogRef')

const page = usePage()

const closeDialog = () => {
	dialogRef.value.close()
}

const types = ['snippet']

const form = useForm({
	type: null,
	name: null,
})

function submit() {
	form.put(route('component.store'), {
		onSuccess: () => {
			dialogRef.value.close()
			toast.add({
				severity: 'success',
				summary: 'Success',
				detail: form.name + ' has been created',
				life: 6000,
			})
		},
	})
}
</script>

<template>
	<form @submit.prevent="submit" class="space-y-4">
		<div>
			<InputLabel for="name" value="Name" />
			<InputText id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus />
			<InputError class="mt-2" :message="form.errors.name" />
		</div>
		<div>
			<InputLabel for="type" value="Name" />
			<Select v-model="form.type" :options="types" placeholder="Select a Type" class="mt-1 block w-full" />
			<InputError class="mt-2" :message="form.errors.type" />
		</div>
		<div class="flex items-center gap-2">
			<Button severity="success" type="submit" :loading="form.processing">Save</Button>
			<Button @click="closeDialog" severity="secondary" type="button" :loading="form.processing">Cancel</Button>
		</div>
	</form>
</template>
