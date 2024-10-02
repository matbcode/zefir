<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { useToast } from 'primevue/usetoast'
import InputText from 'primevue/inputtext'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Button from 'primevue/button'
import { computed, inject } from 'vue'
import Select from 'primevue/select'

const page = usePage()

const languages = computed(() => page.props.languages)

const toast = useToast()
const dialogRef = inject('dialogRef')

const closeDialog = () => {
	dialogRef.value.close()
}

const form = useForm({
	name: dialogRef.value.data.name,
	language_id: dialogRef.value.data.language_id,
})

function submit() {
	form.patch(route('domain.update', dialogRef.value.data.id), {
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
			<InputLabel for="name" value="Domain" />
			<InputText id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus />
			<InputError class="mt-2" :message="form.errors.name" />
		</div>
		<div>
			<InputLabel for="language_id" value="Language" />
			<Select
				v-model="form.language_id"
				:options="languages"
				optionValue="id"
				optionLabel="name"
				placeholder="Select a language"
				class="mt-1 block w-full" />
			<InputError class="mt-2" :message="form.errors.language_id" />
		</div>
		<div class="flex items-center gap-2">
			<Button severity="success" type="submit" :loading="form.processing">Save</Button>
			<Button @click="closeDialog" severity="secondary" type="button" :loading="form.processing">Cancel</Button>
		</div>
	</form>
</template>
