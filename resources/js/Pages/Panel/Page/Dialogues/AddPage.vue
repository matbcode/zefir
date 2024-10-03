<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { useToast } from 'primevue/usetoast'
import InputText from 'primevue/inputtext'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Button from 'primevue/button'
import { inject, computed } from 'vue'
import Select from 'primevue/select'
import ToggleSwitch from 'primevue/toggleswitch'

const toast = useToast()
const dialogRef = inject('dialogRef')

const page = usePage()

const languages = computed(() => page.props.languages)

const closeDialog = () => {
	dialogRef.value.close()
}

const form = useForm({
	public: false,
	name: null,
	path: null,
})

function submit() {
	form.put(route('page.store'), {
		onSuccess: () => {
			dialogRef.value.close()
			toast.add({
				severity: 'success',
				summary: 'Success',
				detail: form.name + ' has been added to pages',
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
			<InputLabel for="path" value="Path" />
			<InputText id="path" type="text" class="mt-1 block w-full" v-model="form.path" required autofocus />
			<InputError class="mt-2" :message="form.errors.path" />
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
