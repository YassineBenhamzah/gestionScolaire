<template>
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edition niveau scoalire "{{ editNiveauScolaire.nom }}"</h1>
                    <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editForm" @submit.prevent="soumettre">
                        <div class="form-group">
                            <label for="">Nom</label>
                            <input
                                type="text"
                                class="form-control"
                                :class="{ 'is-invalid': editNiveauScolaire.nomError != '' }"
                                v-model="editNiveauScolaire.nom"
                            />
                            <span
                                v-if="editNiveauScolaire.nomError != ''"
                                class="invalid-feedback error"
                                >{{ editNiveauScolaire.nomError }}</span
                            >
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="closeModal">Fermer</button>
                    <button form="editForm" type="submit" class="btn btn-success">Soumettre</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { reactive , watch } from "vue";
import { useSwalSuccess, useSwalError } from "@/Composables/alert";


const emit = defineEmits(["modalClosed"])

const props = defineProps({
    niveauScolaireId: {
        type: Number,
        required: true,
    }
    ,
    show: {
        type: Boolean,
        default: false,
    }
})

const editNiveauScolaire = reactive({
    id: "",
    nom: "",
    nomError: "",
})

const soumettre = ()=>{
    router.put(route("niveauscolaire.update" , {niveauScolaire: props.niveauScolaireId}), {
        nom: editNiveauScolaire.nom
    },{
        onSuccess: (response)=>{
            useSwalSuccess("Niveau Scolaire updated avec success")
            closeModal()
        },
        onError: (error)=>{
            /* console.log(error) */
            editNiveauScolaire.nomError = error.nom
            useSwalError("une error s'est produite")
        },
    })
}

const openModal = ()=>{
    getNiveauScoalireById()
    $("#EditModal").modal("show")
}
const closeModal = ()=>{
    $("#EditModal").modal("hide")
    emit("modalClosed")
}

const getNiveauScoalireById=()=>{
    axios.get(route("niveauscolaire.edit" , {niveauScolaire: props.niveauScolaireId}))
         .then((response)=>{
            /* console.log("response: " , response.data); */
            editNiveauScolaire.id = response.data.niveauScolaire.id
            editNiveauScolaire.nom = response.data.niveauScolaire.nom
         }).catch((error)=>{
            console.log(error)
         })
}

watch(
    ()=> props.show,
    (newVal, oldVal)=>{
        if(newVal){
            openModal()
        }else{
            closeModal()
        }
    }
)


</script>
