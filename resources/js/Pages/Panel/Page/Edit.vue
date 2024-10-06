<script setup>
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3'
import SectionWrapper from '@/Components/SectionWrapper.vue'
import Button from 'primevue/button'
import Tile from '@/Components/Tile.vue'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Menu from 'primevue/menu'
import { ref } from 'vue'
import { useDialog } from 'primevue/usedialog'
import { useToast } from 'primevue/usetoast'
import AddPage from '@/Pages/Panel/Page/Dialogues/AddPage.vue'
import { FilterMatchMode } from '@primevue/core/api'
import InputText from 'primevue/inputtext'
import Tag from 'primevue/tag'
import ToggleSwitch from 'primevue/toggleswitch'
import InputError from '@/Components/InputError.vue'
import InputNumber from 'primevue/inputnumber'
import InputLabel from '@/Components/InputLabel.vue'

const toast = useToast()

// Define props for incoming languages data
const props = defineProps({
	page: {
		type: Object,
	},
	metadata: {
		type: Object,
	},
})

// Dialog setup for adding languages
const dialog = useDialog()

const showAddDialog = () => {
	dialog.open(AddPage, {
		props: {
			header: 'Add Page',
			style: {
				width: '400px',
			},
			modal: true,
		},
	})
}

// Refs to manage the menu state
const rowMenu = ref(null)

// Placeholder for selected row data (you can use it if needed)
const selectedRow = ref(null)

// Define menu items for row actions
const menuItems = ref([
	{ label: 'Edit', icon: 'pi pi-wrench', command: () => router.visit(route('page.edit')) },
	{ label: 'Delete', icon: 'pi pi-trash', command: () => deleteRow(selectedRow.value) },
])

// Function to open the Menu for a specific row
const openMenu = (event, row) => {
	selectedRow.value = row
	rowMenu.value.toggle(event)
}

const deleteRow = (row) => {
	toast.add({
		severity: 'success',
		summary: 'Success',
		detail: row.name + ' has been deleted',
		life: 6000,
	})
	router.delete(route('domain.destroy', row.id))
}

const detailsForm = useForm({
	public: props.page.public,
	name: props.page.name,
	path: props.page.path,
})

const metadataForm = useForm({
	title: props.metadata.title,
	description: props.metadata.description,
	keywords: props.metadata.keywords,
	image: props.metadata.image,
	priority: props.metadata.priority,
})

function submitDetailsForm() {
	detailsForm.patch(route('page.update', props.page.id), {
		onSuccess: () => {
			toast.add({
				severity: 'success',
				summary: 'Success',
				detail: props.page.name + ' details have been updated',
				life: 6000,
			})
		},
	})
}

function submitMetadataForm() {
	metadataForm.post(route('page.metadata', props.page.id), {
		onSuccess: () => {
			toast.add({
				severity: 'success',
				summary: 'Success',
				detail: props.page.name + ' metadata has been updated',
				life: 6000,
			})
		},
	})
}
</script>

<template>
	<Head title="Profile" />
	<SectionWrapper>
		<template v-slot:title>Edit Page</template>
		<template v-slot:controls>
			<Link :href="route('page.index')"><Button icon="pi pi-chevron-left" label="Pages" severity="secondary"></Button></Link>
			<Button @click="showAddDialog" icon="pi pi-eye" label="Preview" severity="info"></Button>
			<Button @click="showAddDialog" icon="pi pi-trash" label="Delete" severity="danger"></Button>
		</template>

		<div class="flex items-start gap-6">
			<Tile class="w-full">
				<template #title>{{ page.name }}</template>
				<template #controls>
					<div></div>
				</template>
				<template #content>
					<!-- Global Menu component -->
					<Menu :model="menuItems" ref="rowMenu" :popup="true" />
				</template>
			</Tile>
			<div class="flex w-96 shrink-0 flex-col gap-6">
				<Tile>
					<template #title>Details</template>
					<template #description>Update page details.</template>
					<template #content>
						<form @submit.prevent="submitDetailsForm" class="space-y-4">
							<div>
								<InputLabel for="name" value="Name" />
								<InputText id="name" type="text" class="mt-1 block w-full" v-model="detailsForm.name" required autofocus />
								<InputError class="mt-2" :message="detailsForm.errors.name" />
							</div>
							<div>
								<InputLabel for="path" value="Path" />
								<InputText id="path" type="text" class="mt-1 block w-full" v-model="detailsForm.path" required autofocus />
								<InputError class="mt-2" :message="detailsForm.errors.path" />
							</div>
							<div class="flex items-center">
								<ToggleSwitch v-model="detailsForm.public" />
								<label class="ml-2">Public</label>
							</div>
							<div class="flex items-center gap-2">
								<Button severity="success" type="submit" :loading="detailsForm.processing">Save</Button>
								<Button @click="detailsForm.reset()" severity="secondary" type="button" :loading="detailsForm.processing">Cancel</Button>
							</div>
						</form>
					</template>
				</Tile>
				<Tile>
					<template #title>Metadata</template>
					<template #description>Update the metadata or leave fields blank to auto-fill with defaults</template>
					<template #content>
						<form @submit.prevent="submitMetadataForm" class="space-y-4">
							<div>
								<InputLabel for="title" value="Meta Title" />
								<InputText id="title" type="text" class="mt-1 block w-full" v-model="metadataForm.title" required />
								<InputError class="mt-2" :message="metadataForm.errors.title" />
							</div>
							<div>
								<InputLabel for="description" value="Meta Description" />
								<InputText id="description" type="text" class="mt-1 block w-full" v-model="metadataForm.description" />
								<InputError class="mt-2" :message="metadataForm.errors.description" />
							</div>
							<div>
								<InputLabel for="keywords" value="Keywords" />
								<InputText id="keywords" type="text" class="mt-1 block w-full" v-model="metadataForm.keywords" />
								<InputError class="mt-2" :message="metadataForm.errors.keywords" />
							</div>
							<div>
								<InputLabel for="image" value="Image" />
								<InputText id="image" type="text" class="mt-1 block w-full" v-model="metadataForm.image" />
								<InputError class="mt-2" :message="metadataForm.errors.image" />
							</div>
							<div>
								<InputLabel for="priority" value="Priority" />
								<InputNumber
									showButtons
									:step="0.1"
									buttonLayout="horizontal"
									id="priority"
									class="mt-1 block w-full"
									:min="0.0"
									:max="1.0"
									min-fraction-digits="1"
									max-fraction-digits="1"
									v-model="metadataForm.priority">
									<template #incrementbuttonicon>
										<span class="pi pi-plus" />
									</template>
									<template #decrementbuttonicon>
										<span class="pi pi-minus" />
									</template>
								</InputNumber>
								<InputError class="mt-2" :message="metadataForm.errors.priority" />
							</div>
							<div class="flex items-center gap-2">
								<Button severity="success" type="submit" :loading="detailsForm.processing">Save</Button>
								<Button @click="detailsForm.reset()" severity="secondary" type="button" :loading="detailsForm.processing">Cancel</Button>
							</div>
						</form>
					</template>
				</Tile>
			</div>
		</div>
	</SectionWrapper>
</template>
