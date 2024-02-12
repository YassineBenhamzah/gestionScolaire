<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">list des etudiant</h1>
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
                                <Link
                                    :href="route('etudiant.create')"
                                    class="btn btn-primary mb-4"

                                >
                                    <i class="fa fa-plus"></i>Create Nouveau
                                </Link>
                                <select @change="search" v-model="par_page" class="form-control " >
                                                <option disabled selected>par page</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                </select>
                            </div>
                            <div class="card-tools d-flex">

                                <Pagination  :links="props.etudiants.links"
                                             :prev="props.etudiants.prev_page_url"
                                             :next="props.etudiants.next_page_url"  />
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>
                                            <p>Etudiant</p>
                                            <input @keyup="search" v-model="searchEtudiant" type="text" class="form-control">
                                        </th>
                                        <th>
                                            <p>Niveau Scolaire</p>
                                            <select @change="search" v-model="filterNiveauScolaire" class="form-control">
                                                <option value=""></option>
                                                <option :value="niveauscolaire.id" :key="niveauscolaire.id" v-for="niveauscolaire in props.niveauScolaires">{{ niveauscolaire.nom }}</option>
                                            </select>
                                        </th>
                                        <th style="width: 10px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="etudiant in props.etudiants.data">
                                        <td>
                                            <img :src="showPic(etudiant)" alt="" style="width: 45px; height: 45px; border-radius: 25px;">
                                        </td>
                                        <td>{{etudiant.nom}} {{etudiant.prenom}}</td>
                                        <td>{{etudiant.niveau_scolaire.nom}}</td>
                                        <td>
                                            <div class="d-flex justify-center">
                                                <Link :href="route('etudiant.edit' ,{etudiant: etudiant.id})" class="btn btn-info mr-2">
                                                    <i class="fas fa-pen"></i>
                                                </Link>
                                                <button
                                                    class="btn btn-danger"
                                                    @click="deleteConfirmation(etudiant)"
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
</template>


<script setup>
import Pagination from '@/Shared/Pagination.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import {useSwalConfirm , useSwalSuccess , useSwalError } from  "@/Composables/alert";

const props = defineProps({
    etudiants:  Object,
    niveauScolaires: Array,
    filtres : Object,
})
const showPic = (etudiant) =>{
    if(etudiant.photo){
        return 'storage/'+etudiant.photo
    }
    return etudiant.sexe == "M" ? "images/homme.png" : "images/femme.png"
}
const searchEtudiant= ref(props.filtres.search ?? "")
const filterNiveauScolaire= ref(props.filtres.filter ?? "")
const par_page= ref(props.filtres.par_page ?? 5)

const deleteEtudiant=(id)=>{
    router.delete(route("etudiant.delete", {etudiant: id}), {
        onSuccess: (response)=>{
            useSwalSuccess("Etudiant supprimer avec success")
        },
        onError: (error)=>{
            /* console.log(error) */

            useSwalError(error.message ?? "une error s'est produite")
        },
    });
}

const deleteConfirmation = (etudiant)=>{
    const message = `vous étes sur le point de supprimer l'étudiant "${etudiant.nom} ${etudiant.prenom}" voullez-vous vraiment continuer`
    useSwalConfirm(message, ()=>{
        deleteEtudiant(etudiant)
    })
}

const search = _.throttle(function(){
    console.log("searchEtudiant :" , searchEtudiant.value)
    console.log("filter : " , filterNiveauScolaire.value)
    console.log("par_page : " , par_page.value)

    router.get(route("etudiant.index" ,
    {  search: searchEtudiant.value,
        filter: filterNiveauScolaire.value ,
        par_page: par_page.value}),{} , {
            replace: true,
            preserveState: true,
        })
}, 500)
</script>
