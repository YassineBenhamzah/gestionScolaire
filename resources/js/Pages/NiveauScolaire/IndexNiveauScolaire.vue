<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">list des niveau</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <CreateNiveauScolaire />
                            </div>
                            <div class="card-tools">
                                <Pagination  :links="props.niveauScolaires.links"
                                             :prev="props.niveauScolaires.prev_page_url"
                                             :next="props.niveauScolaires.next_page_url"  />
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Niveau Scolaire</th>
                                        <th style="width: 10px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="niveauScolaire in props.niveauScolaires.data">
                                        <td>{{niveauScolaire.nom}}</td>
                                        <td>
                                            <div class="d-flex justify-center">
                                                <button @click="openEditModal(niveauScolaire.id)" class="btn btn-info mr-2">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <button
                                                    class="btn btn-danger"
                                                    @click="deleteConfirmation(niveauScolaire.id)"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <EditNiveauScolaire
    :niveau-scolaire-id="editingElementId"
    :show="showModal"
    @modal-closed="modalClosed"
    />
</template>

<script setup>
import Pagination from '@/Shared/Pagination.vue';
import CreateNiveauScolaire from './CreateNiveauScolaire.vue';
import EditNiveauScolaire from './EditNiveauScolaire.vue';
import {ref} from 'vue';
import {useSwalConfirm , useSwalSuccess , useSwalError } from  "@/Composables/alert";
import { router } from '@inertiajs/vue3';

const editingElementId = ref(0)
const showModal = ref(false)

const deleteNiveauScolaire=(id)=>{
    router.delete(route("niveauscolaire.delete", {niveauScolaire: id}), {
        onSuccess: (response)=>{
            useSwalSuccess("Niveau Scolaire supprimer avec success")
        },
        onError: (error)=>{
            /* console.log(error) */

            useSwalError(error.message ?? "une error s'est produite")
        },
    });
}

const deleteConfirmation = (id)=>{
    const message = "vous étes sur le point de supprimer cette élément voullez-vous vraiment continuer"
    useSwalConfirm(message, ()=>{
        deleteNiveauScolaire(id)
    })
}


const props = defineProps({
    niveauScolaires:  {
        type: Object,
        /* required: true, */
    }
})

const modalClosed = ()=>{
    editingElementId.value= 0
    showModal.value = false
}

const openEditModal= (id)=>{
    editingElementId.value= id
    showModal.value = true
}



</script>
