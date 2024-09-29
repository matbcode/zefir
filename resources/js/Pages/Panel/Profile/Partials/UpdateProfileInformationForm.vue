<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Button from 'primevue/button'
import { Link, useForm, usePage } from '@inertiajs/vue3'
import Tile from '@/Components/Tile.vue'
import InputText from 'primevue/inputtext'
import { useToast } from 'primevue/usetoast'

const toast = useToast()

defineProps({
	mustVerifyEmail: {
		type: Boolean,
	},
	status: {
		type: String,
	},
})

const user = usePage().props.auth.user

const form = useForm({
	name: user.name,
	email: user.email,
})

function submit() {
	form.patch(route('profile.update'), {
		onSuccess: () => {
			toast.add({
				severity: 'success',
				summary: 'Success',
				detail: 'Your profile information has been updated',
				life: 6000,
			})
		},
	})
}
</script>

<template>
	<Tile>
		<template #title>Profile Information</template>
		<template #description>Update your account's profile information and email address.</template>
		<template #content>
			<form @submit.prevent="submit" class="space-y-6">
				<div>
					<InputLabel for="name" value="Name" />

					<InputText id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />

					<InputError class="mt-2" :message="form.errors.name" />
				</div>

				<div>
					<InputLabel for="email" value="Email" />

					<InputText id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />

					<InputError class="mt-2" :message="form.errors.email" />
				</div>

				<div v-if="mustVerifyEmail && user.email_verified_at === null">
					<p class="mt-2 text-sm text-gray-800">
						Your email address is unverified.
						<Link
							:href="route('verification.send')"
							method="post"
							as="button"
							class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
							Click here to re-send the verification email.
						</Link>
					</p>

					<div v-show="status === 'verification-link-sent'" class="mt-2 text-sm font-medium text-green-600">A new verification link has been sent to your email address.</div>
				</div>

				<div class="flex items-center gap-4">
					<Button severity="contrast" type="submit" :loading="form.processing">Save</Button>
				</div>
			</form>
		</template>
	</Tile>
</template>
