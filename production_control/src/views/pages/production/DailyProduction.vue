<script setup lang="ts">
import { ref, shallowRef } from 'vue';

import BaseBreadcrumb from '@/components/shared/BaseBreadcrumb.vue';
import UiParentCard from '@/components/shared/UiParentCard.vue';
import ProductionSheet from '@/views/forms/ProductionSheet.vue';

const dialog = ref(false);
const mode = ref<'edit' | 'view'>('view'); // Bisa diisi 'edit' atau 'view'

const page = ref({ title: 'Production Welding' });
const breadcrumbs = shallowRef([
  {
    title: 'Production',
    disabled: false,
    href: '#'
  },
  {
    title: 'Production Welding',
    disabled: true,
    href: '#'
  }
]);

const edit = () => {
  mode.value = 'edit';
  dialog.value = true;
};

const view = () => {
  mode.value = 'view';
  dialog.value = true;
};
</script>

<template>
  <BaseBreadcrumb :title="page.title" :breadcrumbs="breadcrumbs"></BaseBreadcrumb>
  <v-row>
    <v-col cols="12" md="12">
      <UiParentCard title="Welding Line Sub Assy ADM">

        <v-row class="d-flex justify-space-between"
        >
            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">SUB ASSY ROBOT</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>
            
            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">SUB ASSY MANUAL</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>

            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">S/A CO ROBOT</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>

        </v-row>
        
      </UiParentCard>
    </v-col>
  </v-row>
  <v-row>
    <v-col cols="12" md="12">
      <UiParentCard title="Welding Line WSS ADM">

        <v-row class="d-flex justify-space-between"
        >
            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">WSS LINE A</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>
            
            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">WSS LINE B</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>

            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">SWSS LINE C</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>

        </v-row>
        <br>
        <br>

        <v-row class="d-flex justify-space-between"
        >
            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">WSS LINE D</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>
            
            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">WSS LINE E</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>

            <v-card
                max-width="350"
                color="darkprimary"
            >
            <v-card-text class="d-flex justify-space-between align-center">
                <h4 class="me-3">WSS LINE F</h4>
                <v-chip
                    prepend-icon="$eye"
                    @click="view"
                >VIEW
                </v-chip>
                <v-chip
                    prepend-icon="$edit"
                    @click="edit"
                    color="darksuccess"
                    variant="flat"
                >EDIT
                </v-chip>
            </v-card-text>
            </v-card>

        </v-row>
        
      </UiParentCard>
    </v-col>
  </v-row>






<!-- Dialog untuk menampilkan ProductionSheet.vue -->
<v-dialog v-model="dialog" max-width="800">
    <v-card>
      <v-card-title>
        <!-- Judul dialog berdasarkan mode -->
        <span v-if="mode === 'edit'">Edit Production Sheet</span>
        <span v-else-if="mode === 'view'">View Production Sheet</span>
      </v-card-title>
      <v-card-text>
        <!-- Masukkan komponen ProductionSheet dengan prop mode -->
        <ProductionSheet :mode="mode" />
      </v-card-text>
      <v-card-actions>
        <v-btn color="primary" @click="dialog = false">Close</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>



</template>

<style scoped>

</style>
