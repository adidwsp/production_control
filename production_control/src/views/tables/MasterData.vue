<template>
  <v-card flat>
    <v-card-title>
      Master Data
      <v-spacer />
      <v-sheet class="pl-2 pr-2 d-flex align-center" elevation="0" rounded>
        <!-- Add Part Button -->
        <v-btn color="primary" @click="openDialog('create')">Add Part</v-btn>
        <v-btn icon @click="refreshData()" class="ml-4">
          <v-icon icon="$refresh"></v-icon>
        </v-btn>
        <v-spacer />
        <v-spacer />
        <v-text-field
          v-model="search"
          label="Search"
          variant="outlined"
          hide-details
          clearable
        />
    </v-sheet>
    </v-card-title>

    <v-card-text style="overflow-x: auto;" max-width="auto">
      <v-sheet border rounded style="min-width: max-content;">
      <v-data-table
        :headers="headers"
        :items="allItems"
        :search="search"
        :loading="isLoading"
        loading-text="Loading data..."
        class="elevation-1"
        :sort-by="[ { key: 'part_no', order: 'asc' } ]"
      >
        <template #item.created_at="{ item }">
          {{ formatDate(item.created_at) }}
        </template>
        <template #item.updated_at="{ item }">
          {{ formatDate(item.updated_at) }}
        </template>
        <template #item.actions="{ item }">
          <v-btn icon small @click="openDialog('edit', item)">
            <v-icon icon="$pencil"></v-icon>
          </v-btn>
          <v-btn icon small @click="deleteItem(item.part_no)">
            <v-icon color="red" icon="$delete"></v-icon>
          </v-btn>
        </template>
      </v-data-table>
    </v-sheet>
    </v-card-text>

    <v-card-actions>
      <v-alert v-if="errorMessage" type="error" dense>
        {{ errorMessage }}
      </v-alert>
    </v-card-actions>

    <!-- Dialog for Create/Edit -->
    <v-dialog v-model="dialog.visible" max-width="600px">
      <v-card>
        <v-card-title>{{ dialog.mode === 'create' ? 'Add Part' : 'Edit Part' }}</v-card-title>
        <v-card-text>
          <v-form ref="formRef" v-model="isValid">
            <v-text-field
              v-model="form.part_no"
              label="Part No"
              :disabled="dialog.mode === 'edit'"
              variant="outlined"
              hide-details
              required
            />
            <br />
            <v-text-field v-model="form.job_no" label="Job No" required
              variant="outlined"
              hide-details /><br />
            <v-text-field v-model="form.part_name" label="Part Name" required
              variant="outlined"
              hide-details /><br />
            <v-text-field
              v-model.number="form.pack_qty"
              label="Pack Qty"
              type="number"
              variant="outlined"
              hide-details              
              required
            /><br />
            <v-text-field v-model="form.part_status" label="Status" required 
              variant="outlined"
              hide-details/><br />
            <v-text-field
              v-model="form.routing_process"
              label="Routing Process"
              required
              variant="outlined"
              hide-details
            /><br />
            <v-text-field v-model="form.process" label="Process" required 
              variant="outlined"
              hide-details/><br />
            <v-text-field v-model="form.machine_id" label="Machine ID" required 
              variant="outlined"
              hide-details/><br />
            <v-text-field
              v-model.number="form.uph"
              label="UPH"
              type="number"
              required
              variant="outlined"
              hide-details
            /><br />
            <v-text-field v-model="form.model_id" label="Model ID" required 
              variant="outlined"
              hide-details/><br />
            <v-text-field
              v-model="form.customer_id"
              label="Customer ID"
              required
              variant="outlined"
              hide-details
            /><br />
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-btn text="true" @click="closeDialog()">Cancel</v-btn>
          <v-btn color="primary" :disabled="!isValid" @click="saveItem()">
            {{ dialog.mode === 'create' ? 'Create' : 'Update' }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>

<script setup lang="ts">
import { ref, onMounted, reactive } from 'vue'
import { useDataStore } from '@/stores/dataStore'
import { storeToRefs } from 'pinia'

// Define Item interface
type Item = {
  part_no: string
  job_no: string
  part_name: string
  pack_qty: number
  part_status: string
  routing_process: string
  process: string
  machine_id: string
  uph: number
  model_id: string
  customer_id: string
  created_at: string | null
  updated_at: string | null
}

// Store
const dataStore = useDataStore()
const { items: allItems, loading: isLoading, error: errorMessage } = storeToRefs(dataStore)

// Search and dialog state
const search = ref('')
const dialog = reactive({ visible: false as boolean, mode: 'create' as 'create' | 'edit' })
const isValid = ref(false)
const formRef = ref()
const form = reactive<Omit<Item, 'created_at' | 'updated_at'>>({
  part_no: '',
  job_no: '',
  part_name: '',
  pack_qty: 0,
  part_status: '',
  routing_process: '',
  process: '',
  machine_id: '',
  uph: 0,
  model_id: '',
  customer_id: '',
})

// Table headers
const headers = [
  { key: 'part_no', title: 'Part No', align: 'center' as const, sortable: true},
  { key: 'job_no', title: 'Job No', align: 'center' as const, sortable: true },
  { key: 'part_name', title: 'Part Name', align: 'center' as const, sortable: true },
  { key: 'pack_qty', title: 'Pack Qty', align: 'center' as const, sortable: true },
  { key: 'part_status', title: 'Status', align: 'center' as const, sortable: true },
  { key: 'routing_process', title: 'Routing Process', align: 'center' as const, sortable: true },
  { key: 'process', title: 'Process', align: 'center' as const, sortable: true },
  { key: 'machine_id', title: 'Machine ID', align: 'center' as const, sortable: true },
  { key: 'uph', title: 'UPH', align: 'end' as const, sortable: true },
  { key: 'model_id', title: 'Model ID', align: 'center' as const, sortable: true },
  { key: 'customer_id', title: 'Customer ID', align: 'center' as const, sortable: true },
  { key: 'created_at', title: 'Created At', align: 'center' as const, sortable: true },
  { key: 'updated_at', title: 'Updated At', align: 'center' as const, sortable: true },
  { key: 'actions', title: 'Actions', align: 'center' as const, sortable: false },
]

// Lifecycle
onMounted(() => refreshData())

// Methods
function refreshData() {
  dataStore.fetchItems('partlists')
}

function openDialog(mode: 'create' | 'edit', item?: Item) {
  dialog.mode = mode
  if (mode === 'edit' && item) {
    Object.assign(form, item)
  } else {
    Object.keys(form).forEach(k => {
      // @ts-ignore
      form[k] = typeof form[k] === 'number' ? 0 : ''
    })
  }
  dialog.visible = true
}

function closeDialog() {
  dialog.visible = false
}

async function saveItem() {
  try {
    if (dialog.mode === 'create') {
      await dataStore.createItem('partlists', form)
    } else {
      await dataStore.updateItem(`partlists/${form.part_no}`, form)
    }
    closeDialog()
    refreshData()
  } catch (err) {
    console.error(err)
  }
}

async function deleteItem(partNo: string) {
  if (confirm(`Hapus part ${partNo}?`)) {
    try {
      await dataStore.deleteItem(`partlists/${partNo}`)
      refreshData()
    } catch (err) {
      console.error(err)
    }
  }
}

function formatDate(dateStr: string | null) {
  return dateStr ? new Date(dateStr).toLocaleString() : '-'
}
</script>

<style scoped>
/* Optional styling */
</style>
