<template>
  <v-card flat>
    <v-card-title class="d-flex justify-space-between align-center">
      <div>
        <strong>DATA STOCK WIP INHOUSE</strong>
      </div>
    </v-card-title>

    <v-card-text style="overflow-x: auto;">
      <v-sheet border rounded style="min-width: max-content;">
        <v-data-table
          :headers="headers"
          :items="stocks"
          class="elevation-1"
          :sort-by="[{ key: 'material', order: 'asc' }]"
        >
          <template #item.no="{ index }">
            {{ index + 1 }}
          </template>
          <template #item.strength="{ item }">
            <div class="bar-bg">
              <div
                class="bar-fill"
                :style="{
                  width: (item.strength * 100) + '%',
                  backgroundColor: item.strength >= 1 ? '#4CAF50' : '#F44336'
                }"
              ></div>
            </div>
          </template>
        </v-data-table>
      </v-sheet>
    </v-card-text>

    <div class="pa-4">Working Days: </div>
  </v-card>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const now = ref('')

const headers = [
  { key: 'no', title: 'No', align: 'center' },
  { key: 'material', title: 'Material Number', align: 'center' },
  { key: 'planDays', title: 'Plan / Days', align: 'center' },
  { key: 'planHour', title: 'Plan / Hour', align: 'center' },
  { key: 'stock', title: 'Stock', align: 'center' },
  { key: 'strength', title: 'Strength', align: 'center' },
]

const stocks = ref([
  {  material: '71566-I7000', planDays: 251, planHour: 16, stock: 0, strength: 0.00,},
  {  material: '66722-I7000', planDays: 136, planHour: 9, stock: 48, strength: 0.35,},
  {  material: '71588-I7000', planDays: 251, planHour: 16, stock: 150, strength: 0.60,},
  {  material: '71578-I7000', planDays: 251, planHour: 16, stock: 150, strength: 0.60,},
  {  material: '66736-I7900', planDays: 365, planHour: 23, stock: 252, strength: 0.69,},
  {  material: '66332-I7000', planDays: 365, planHour: 23, stock: 258, strength: 0.71,},
  {  material: '715B2-I7900', planDays: 251, planHour: 16, stock: 200, strength: 0.80,},
  {  material: '715A2-I7900', planDays: 251, planHour: 16, stock: 200, strength: 0.80,},
  {  material: '66786-I7900', planDays: 1117, planHour: 70, stock: 897, strength: 0.80,},
  {  material: '71518-BW000', planDays: 752, planHour: 47, stock: 680, strength: 0.90,},
  {  material: '71514-I7000', planDays: 251, planHour: 16, stock: 240, strength: 0.96,},
  {  material: '71556-I7000', planDays: 251, planHour: 16, stock: 250, strength: 1.00,},
  {  material: '66762-I7000', planDays: 365, planHour: 23, stock: 384, strength: 1.05,},
  {  material: '66342-I7000', planDays: 709, planHour: 44, stock: 752, strength: 1.06,},
  {  material: '66752-I7000', planDays: 365, planHour: 23, stock: 388, strength: 1.06,},
  {  material: '66722-I7900', planDays: 115, planHour: 7, stock: 138, strength: 1.20,},
  {  material: '64992-I7000', planDays: 251, planHour: 16, stock: 320, strength: 1.27,},
  {  material: '66754-BX000', planDays: 365, planHour: 23, stock: 521, strength: 1.43,},
  {  material: '64934-I7000', planDays: 251, planHour: 16, stock: 384, strength: 1.53,},
  {  material: '66746-I7900', planDays: 365, planHour: 23, stock: 560, strength: 1.53,},
])

onMounted(() => {
  const date = new Date()
  now.value = date.toLocaleString('en-GB')
})
</script>

<style scoped>
.bar-bg {
  width: 100%;
  height: 20px;
  background: #eee;
  border: 1px solid #ccc;
  position: relative;
}
.bar-fill {
  height: 100%;
  transition: width 0.3s;
}
</style>