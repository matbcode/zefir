<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import { Head, useForm } from '@inertiajs/vue3'

const form = useForm({
	password: '',
})

const submit = () => {
	form.post(route('password.confirm'), {
		onFinish: () => form.reset(),
	})
}
</script>

<template>
	<GuestLayout>
		<Head title="Confirm Password" />
		<template v-slot:title>Confirm password</template>
		<template v-slot:content>
			<div class="mb-4 text-sm text-gray-600">This is a secure area of the application. Please confirm your password before continuing.</div>

			<form @submit.prevent="submit">
				<div>
					<InputLabel for="password" value="Password" />
					<InputText id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" autofocus />
					<InputError class="mt-2" :message="form.errors.password" />
				</div>

				<div class="mt-4 flex justify-end">
					<Button :loading="form.processing">Confirm</Button>
				</div>
			</form>
		</template>
	</GuestLayout>
</template>
