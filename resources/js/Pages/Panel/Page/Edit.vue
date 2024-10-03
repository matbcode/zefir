<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
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
const toast = useToast()

// Define props for incoming languages data
defineProps({
	page: {
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

const filters = ref({
	global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})
</script>

<template>
	<Head title="Profile" />
	<SectionWrapper>
		<template v-slot:title>Edit Page</template>
		<template v-slot:controls>
			<Link><Button icon="pi pi-chevron-left" label="Pages" severity="secondary"></Button></Link>
			<Button @click="showAddDialog" icon="pi pi-save" label="Save" severity="success"></Button>
		</template>

		<div class="flex items-start gap-6">
			<Tile class="">
				<template #title>{{ page.name }}</template>
				<template #controls>
					<div></div>
				</template>
				<template #content>
					<!-- Global Menu component -->
					<Menu :model="menuItems" ref="rowMenu" :popup="true" />
				</template>
			</Tile>
		</div>
	</SectionWrapper>
</template>
