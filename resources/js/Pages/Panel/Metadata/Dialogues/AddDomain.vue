<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { useToast } from 'primevue/usetoast'
import InputText from 'primevue/inputtext'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Button from 'primevue/button'
import { inject, computed } from 'vue'
import Select from 'primevue/select'

const toast = useToast()
const dialogRef = inject('dialogRef')

const page = usePage()

const languages = computed(() => page.props.languages)

const closeDialog = () => {
	dialogRef.value.close()
}

const form = useForm({
	name: null,
	language_id: null,
})

function submit() {
	form.put(route('domain.store'), {
		onSuccess: () => {
			dialogRef.value.close()
			toast.add({
				severity: 'success',
				summary: 'Success',
				detail: form.name + ' has been added to domains',
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
			<InputError class="mt-2" :message="form.errors.domain" />
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
