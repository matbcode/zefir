<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Button from 'primevue/button'
import InputText from 'primevue/inputtext'
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import Tile from '@/Components/Tile.vue'
import { useToast } from 'primevue/usetoast'

const toast = useToast()

const passwordInput = ref(null)
const currentPasswordInput = ref(null)

const form = useForm({
	current_password: '',
	password: '',
	password_confirmation: '',
})

const updatePassword = () => {
	form.put(route('password.update'), {
		preserveScroll: true,
		onSuccess: () => {
			toast.add({
				severity: 'success',
				summary: 'Success',
				detail: 'Your password has been updated.',
				life: 6000,
			})
			form.reset()
		},
		onError: () => {
			toast.add({ severity: 'warn', summary: 'Warning', detail: 'Your password has not been updated', life: 6000 })
			if (form.errors.password) {
				form.reset('password', 'password_confirmation')
				passwordInput.value.focus()
			}
			if (form.errors.current_password) {
				form.reset('current_password')
				currentPasswordInput.value.focus()
			}
		},
	})
}
</script>

<template>
	<Tile>
		<template #title>Update Password</template>
		<template #description>Ensure your account is using a long, random password to stay secure.</template>
		<template #content>
			<form @submit.prevent="updatePassword" class="space-y-6">
				<div>
					<InputLabel for="current_password" value="Current Password" />

					<InputText id="current_password" ref="currentPasswordInput" v-model="form.current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />

					<InputError :message="form.errors.current_password" class="mt-2" />
				</div>

				<div>
					<InputLabel for="password" value="New Password" />

					<InputText id="password" ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-full" autocomplete="new-password" />

					<InputError :message="form.errors.password" class="mt-2" />
				</div>

				<div>
					<InputLabel for="password_confirmation" value="Confirm Password" />

					<InputText id="password_confirmation" v-model="form.password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />

					<InputError :message="form.errors.password_confirmation" class="mt-2" />
				</div>

				<div class="flex items-center gap-4">
					<Button severity="contrast" type="submit" :loading="form.processing">Save</Button>
				</div>
			</form>
		</template>
	</Tile>
</template>
