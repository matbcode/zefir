<script setup>
import { Head, router } from '@inertiajs/vue3'
import SectionWrapper from '@/Components/SectionWrapper.vue'
import Button from 'primevue/button'
import Tile from '@/Components/Tile.vue'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Menu from 'primevue/menu'
import { ref } from 'vue'
import { useDialog } from 'primevue/usedialog'
import { useToast } from 'primevue/usetoast'
import AddUser from '@/Pages/Panel/User/Dialogues/AddUser.vue'
import EditUser from '@/Pages/Panel/User/Dialogues/EditUser.vue'
const toast = useToast()

// Define props for incoming languages data
defineProps({
	users: {
		type: Object,
	},
})

// Dialog setup for adding languages
const dialog = useDialog()

const showAddDialog = () => {
	dialog.open(AddUser, {
		props: {
			header: 'Add User',
			style: {
				width: '400px',
			},
			modal: true,
		},
	})
}

const showEditDialog = (data) => {
	dialog.open(EditUser, {
		props: {
			header: 'Edit User',
			style: {
				width: '400px',
			},
			modal: true,
		},
		data: data,
	})
}

// Refs to manage the menu state
const rowMenu = ref(null)

// Placeholder for selected row data (you can use it if needed)
const selectedRow = ref(null)

// Define menu items for row actions
const menuItems = ref([
	{ label: 'Edit', icon: 'pi pi-wrench', command: () => showEditDialog(selectedRow.value) },
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
	router.delete(route('user.destroy', row.id))
}
</script>

<template>
	<Head title="Profile" />
	<SectionWrapper>
		<template v-slot:title>Users</template>
		<template v-slot:controls>
			<Button @click="showAddDialog" icon="pi pi-plus" label="Add User" severity="success"></Button>
		</template>

		<div class="flex items-start gap-6 max-xl:flex-col">
			<Tile>
				<template #title>Manage Users</template>
				<template #description>Manage your available domains.</template>
				<template #content>
					<DataTable :value="users">
						<Column field="id" header="ID"></Column>
						<Column field="name" header="Name"></Column>
						<Column field="email" header="Email"></Column>
						<Column header="Action">
							<template #body="slotProps">
								<!-- Action button that triggers the menu -->
								<Button
									rounded
									severity="secondary"
									type="button"
									icon="pi pi-ellipsis-v"
									@click="openMenu($event, slotProps.data)"
									aria-haspopup="true" />
							</template>
						</Column>
					</DataTable>

					<!-- Global Menu component -->
					<Menu :model="menuItems" ref="rowMenu" :popup="true" />
				</template>
			</Tile>
		</div>
	</SectionWrapper>
</template>
