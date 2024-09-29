<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue'
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue'
import { Head } from '@inertiajs/vue3'
import SectionWrapper from '@/Components/SectionWrapper.vue'

defineProps({
	mustVerifyEmail: {
		type: Boolean,
	},
	status: {
		type: String,
	},
})
</script>

<template>
	<Head title="Profile" />
	<SectionWrapper>
		<template v-slot:title>Profile</template>
		<div class="flex items-start gap-6 max-xl:flex-col">
			<UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" />
			<UpdatePasswordForm />
			<DeleteUserForm />
		</div>
	</SectionWrapper>
</template>
