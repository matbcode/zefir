<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
	name: '',
	email: '',
	password: '',
	password_confirmation: '',
})

const submit = () => {
	form.post(route('register'), {
		onFinish: () => form.reset('password', 'password_confirmation'),
	})
}
</script>

<template>
	<GuestLayout>
		<Head title="Register" />
		<template v-slot:title>Register</template>
		<template v-slot:content>
			<form @submit.prevent="submit">
				<div>
					<InputLabel for="name" value="Name" />
					<InputText id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
					<InputError class="mt-2" :message="form.errors.name" />
				</div>

				<div class="mt-4">
					<InputLabel for="email" value="Email" />
					<InputText id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
					<InputError class="mt-2" :message="form.errors.email" />
				</div>

				<div class="mt-4">
					<InputLabel for="password" value="Password" />
					<InputText id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
					<InputError class="mt-2" :message="form.errors.password" />
				</div>

				<div class="mt-4">
					<InputLabel for="password_confirmation" value="Confirm Password" />
					<InputText id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
					<InputError class="mt-2" :message="form.errors.password_confirmation" />
				</div>

				<div class="mt-4 flex items-center justify-end gap-4">
					<Link :href="route('login')" class="text-sm text-gray-600 underline hover:text-gray-700"> Already registered? </Link>
					<Button :loading="form.processing">Register</Button>
				</div>
			</form>
		</template>
	</GuestLayout>
</template>
