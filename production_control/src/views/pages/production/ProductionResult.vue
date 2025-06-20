<template>
  <v-card flat>
    <v-card-title>
      Production History
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

    <v-card-text style="overflow-x: auto;">
      <v-sheet border rounded>
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
              required
            />
            <v-text-field v-model="form.shift" label="Shift" required />
            <v-text-field
              v-model.number="form.production_qty"
              label="Production Qty"
              type="number"
              required
            />
            
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


<style scoped>
/* Optional styling */
.v-data-table-header {
  width: inherit;
}
</style>

<script setup lang="ts">
import { ref, onMounted, reactive } from 'vue'
import { useDataStore } from '@/stores/dataStore'
import { storeToRefs } from 'pinia'

// Define Item interface
type Item = {
  part_no: string,
  shift: number,
  production_qty: number,
  problem: string,
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
  shift: 0,
  production_qty: 0,
  problem: '',
  })

// Table headers
const headers = [
  { key: 'part_no', title: 'Part No', align: 'center' as const, sortable: true},
  { key: 'shift', title: 'Shift', align: 'center' as const, sortable: true },
  { key: 'production_qty', title: 'Production Qty', align: 'center' as const, sortable: true },
  { key: 'created_at', title: 'Created At', align: 'center' as const, sortable: true },
  { key: 'updated_at', title: 'Updated At', align: 'center' as const, sortable: true },
  { key: 'actions', title: 'Actions', align: 'center' as const, sortable: false },
]

// Lifecycle
onMounted(() => refreshData())

// Methods
function refreshData() {
  dataStore.fetchItems('productionresult')
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
      await dataStore.createItem('productionresult', form)
    } else {
      await dataStore.updateItem(`productionresult/${form.part_no}`, form)
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
      await dataStore.deleteItem(`productionresult/${partNo}`)
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

