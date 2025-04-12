<script setup>
import { ref, computed, watch } from 'vue'
import { useDisplay } from 'vuetify'

const props = defineProps({ mode: String })

const search = ref('')
const headers = [
  { title: 'No', key: 'no' },
  { title: 'Part No.', key: 'part_no' },
  { title: 'Job No.', key: 'job_no' },
  { title: 'Status', key: 'status' },
  { title: 'Plan', key: 'plan' },
  { title: 'Actual', key: 'actual' },
  { title: 'Remarks', key: 'remarks' },
]

const items = ref([
  { no: 1, part_no: 'Product A', job_no: 'P001', status: 'FP', plan: 10, actual: 10, remarks: '' },
  { no: 2, part_no: 'Product B', job_no: 'P002', status: 'FP', plan: 20, actual: 10, remarks: 'Problem' },
  { no: 3, part_no: 'Product C', job_no: 'P003', status: 'FP', plan: 10, actual: 30, remarks: '' },
  { no: 4, part_no: 'Product D', job_no: 'P004', status: 'FP', plan: 50, actual: 50, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 5, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
  { no: 10, part_no: 'Product F', job_no: 'P005', status: 'WIP', plan: 120, actual: 100, remarks: '' },
])


const filteredItems = computed(() =>
  items.value.filter(item =>
    Object.values(item).some(val =>
      String(val).toLowerCase().includes(search.value.toLowerCase())
    )
  )
)

function startEditing(row, col) {
  if (props.mode !== 'edit') return
  focusedRow.value = row
  focusedCol.value = col
  editingCell.value = { row, col }
}

const focusedRow = ref(null)
const focusedCol = ref(null)
const editingCell = ref({ row: null, col: null })

function isFocused(row, col) {
  return focusedRow.value === row && focusedCol.value === col
}

function isEditing(row, col) {
  return props.mode === 'edit' && editingCell.value.row === row && editingCell.value.col === col
}

function focusCell(row, col) {
  if (props.mode !== 'edit') return
  focusedRow.value = row
  focusedCol.value = col
  editingCell.value = { row: null, col: null }
}

function editFocusedCell() {
  if (props.mode !== 'edit') return
  editingCell.value = { row: focusedRow.value, col: focusedCol.value }
}

function stopEditing() {
  editingCell.value = { row: null, col: null }
}

function moveFocus(direction) {
  if (props.mode !== 'edit') return
  const colIndex = headers.findIndex(h => h.key === focusedCol.value)
  if (direction === 'right') {
    const nextCol = headers[colIndex + 1]?.key
    if (nextCol) focusedCol.value = nextCol
  } else if (direction === 'left') {
    const nextCol = headers[colIndex - 1]?.key
    if (nextCol) focusedCol.value = nextCol
  } else if (direction === 'down') {
    if (focusedRow.value < items.value.length - 1) focusedRow.value++
  }
}
</script>

<template>
  <div>
    <v-card flat>
      <v-card-title class="d-flex justify-space-between align-center">
        <span v-if="mode === 'edit'">Edit Production Sheet</span>
        <span v-else-if="mode === 'view'">View Production Sheet</span>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          label="Search"
          prepend-inner-icon="$magnify"
          variant="outlined"
          hide-details
        ></v-text-field>
      </v-card-title>

      <v-data-table
        :headers="headers"
        :items="filteredItems"
        item-value="id"
        class="editable-table"
        hide-default-footer
        density="comfortable"
        @keydown.tab.prevent="moveFocus('right')"
        @keydown.shift.tab.prevent="moveFocus('left')"
        @keydown.enter.prevent="moveFocus('down')"
        @keydown.f2.prevent="editFocusedCell"
      >
        <template v-slot:item="{ item, index }">
          <tr
            :class="{ 'focused-row': focusedRow === index }"
            @click="focusedRow = index"
          >
          <td
            v-for="(header, colIndex) in headers"
            :key="header.key"
            @click="focusCell(index, header.key)"
            @dblclick="startEditing(index, header.key)"
          >
              <template v-if="isEditing(index, header.key)">
                <v-text-field
                  v-model="items[index][header.key]"
                  dense
                  variant="outlined"
                  hide-details
                  autofocus
                  @blur="stopEditing"
                />
              </template>
              <template v-else>
                <div
                  :class="{
                    'focused-cell': isFocused(index, header.key),
                    'editable-cell': mode === 'edit'
                  }"
                >
                  {{ item[header.key] }}
                </div>
              </template>
            </td>
          </tr>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>

<style scoped>
.editable-table .v-data-table__wrapper {
  overflow-x: auto;
  overflow-y: auto;
}
.focused-row {
  background-color: #e0e0e0 !important;
}
.focused-cell {
  outline: 2px solid #3f51b5;
  padding: 8px;
}
.editable-cell {
  cursor: pointer;
}
</style>
