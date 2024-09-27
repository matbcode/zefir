<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import { Head, useForm } from '@inertiajs/vue3'

defineProps({
	status: {
		type: String,
	},
})

const form = useForm({
	email: '',
})

const submit = () => {
	form.post(route('password.email'))
}
</script>

<template>
	<GuestLayout>
		<Head title="Forgot Password" />
		<template v-slot:title>Forgot password</template>
		<template v-slot:content>
			<div class="mb-4 text-sm text-gray-600">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</div>

			<div v-if="status" class="mb-4 text-sm font-medium text-green-600">
				{{ status }}
			</div>

			<form @submit.prevent="submit">
				<div>
					<InputLabel for="email" value="Email" />

					<InputText id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />

					<InputError class="mt-2" :message="form.errors.email" />
				</div>

				<div class="mt-4 flex items-center justify-end">
					<Button :loading="form.processing">Email Password Reset Link</Button>
				</div>
			</form>
		</template>
	</GuestLayout>
</template>
