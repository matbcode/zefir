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
import AddPage from '@/Pages/Panel/Page/Dialogues/AddPage.vue'
import { FilterMatchMode } from '@primevue/core/api'
import InputText from 'primevue/inputtext'
import Tag from 'primevue/tag'
const toast = useToast()

// Define props for incoming languages data
defineProps({
	pages: {
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
	{ label: 'Edit', icon: 'pi pi-wrench', command: () => router.visit(route('page.edit', selectedRow.value)) },
	{ label: 'Preview', icon: 'pi pi-eye', command: () => router.visit(route('page.edit', selectedRow.value)) },
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
		<template v-slot:title>Pages</template>
		<template v-slot:controls>
			<Button @click="showAddDialog" icon="pi pi-plus" label="Add Page" severity="success"></Button>
		</template>

		<div class="grid items-start gap-6">
			<Tile class="">
				<template #title>Manage Pages</template>
				<template #controls>
					<span class="relative">
						<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-neutral-400">search</span>
						<InputText v-model="filters['global'].value" placeholder="Search..." class="pl-10" />
					</span>
				</template>
				<template #content>
					<DataTable dataKey="id" :globalFilterFields="['name', 'path']" v-model:filters="filters" :value="pages" paginator :rows="7">
						<Column sortable field="id" header="ID"></Column>
						<Column sortable field="public" header="Status">
							<template #body="slotProps">
								<Tag v-if="slotProps.data.public" severity="success" value="Public" rounded></Tag>
								<Tag v-else severity="danger" value="Hidden" rounded></Tag>
							</template>
						</Column>
						<Column sortable field="name" header="Name"></Column>
						<Column sortable field="path" header="Path"></Column>
						<Column field="language.name" header="Language"></Column>
						<Column header="Navigations">
							<template #body="slotProps">
								<div class="flex gap-1.5">
									<Tag severity="secondary" value="Main" rounded></Tag>
									<Tag severity="secondary" value="Footer" rounded></Tag>
								</div>
							</template>
						</Column>
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
