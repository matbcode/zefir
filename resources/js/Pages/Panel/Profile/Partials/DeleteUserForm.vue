<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Modal from '@/Components/Modal.vue'
import Button from 'primevue/button'
import InputText from 'primevue/inputtext'
import { useForm } from '@inertiajs/vue3'
import { nextTick, ref } from 'vue'
import Tile from '@/Components/Tile.vue'

const confirmingUserDeletion = ref(false)
const passwordInput = ref(null)

const form = useForm({
	password: '',
})

const confirmUserDeletion = () => {
	confirmingUserDeletion.value = true

	nextTick(() => passwordInput.value.focus())
}

const deleteUser = () => {
	form.delete(route('profile.destroy'), {
		preserveScroll: true,
		onSuccess: () => closeModal(),
		onError: () => passwordInput.value.focus(),
		onFinish: () => form.reset(),
	})
}

const closeModal = () => {
	confirmingUserDeletion.value = false

	form.reset()
}
</script>

<template>
	<Tile>
		<template #title>Delete Account</template>
		<template #description>Once your account is deleted, all of its resources and data will be permanently deleted.</template>
		<template #content>
			<Button severity="danger" @click="confirmUserDeletion">Delete Account</Button>
			<Modal :show="confirmingUserDeletion" @close="closeModal">
				<div class="p-6">
					<h2 class="text-lg font-medium text-gray-900">Are you sure you want to delete your account?</h2>

					<p class="mt-1 text-sm text-gray-600">
						Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
					</p>

					<div class="mt-6">
						<InputLabel for="password" value="Password" class="sr-only" />

						<InputText id="password" ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-3/4" placeholder="Password" @keyup.enter="deleteUser" />

						<InputError :message="form.errors.password" class="mt-2" />
					</div>

					<div class="mt-6 flex justify-end gap-3">
						<Button severity="secondary" @click="closeModal"> Cancel </Button>

						<Button severity="danger" type="submit" :disabled="form.processing" @click="deleteUser"> Delete Account </Button>
					</div>
				</div>
			</Modal>
		</template>
	</Tile>
</template>
