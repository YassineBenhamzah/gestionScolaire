<template>
    <button
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#createNVModal"
    >
        <i class="fa fa-plus"></i>Create Nouveau
    </button>

    <div
        class="modal fade"
        id="createNVModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Ajouter d'un niveau scolaire
                    </h1>
                    <button
                        type="button"
                        class="btn-close"
                        @click="closeModal"
                    ></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="soumettre" id="createForm">
                        <div class="form-group">
                            <label for="">Nom</label>
                            <input
                                type="text"
                                class="form-control"
                                :class="{ 'is-invalid': nomError != '' }"
                                v-model="nomNiveauScolaire"
                            />
                            <span
                                v-if="nomError != ''"
                                class="invalid-feedback error"
                                >{{ nomError }}</span
                            >
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-danger"
                        @click="closeModal"
                    >
                        Close
                    </button>
                    <button
                        form="createForm"
                        required
                        type="submit"
                        class="btn btn-success"
                    >
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { router } from "@inertiajs/vue3";
import { useSwalSuccess, useSwalError } from "@/Composables/alert";

const nomNiveauScolaire = ref("");
const nomError = ref("");
let createModal = "";

onMounted(() => {
    createModal = $("#createNVModal");
});

const closeModal = () => {
    createModal.modal("hide");
    nomNiveauScolaire.value = "";
};

const soumettre = () => {
    const nom = nomNiveauScolaire.value;
    const url = route("niveauscolaire.store");
    router.post(
        url,
        {
            nom,
        },
        {
            onSuccess: (page) => {
                closeModal();

                //afficher msg success
                useSwalSuccess("Niveau Scolaire ajouter avec success");
            },
            onError: (errors) => {
                if (errors.nom != null) {
                    nomError.value = errors.nom;
                }
                //afficher msg error
                useSwalError("une error s'est produite");
            },
        }
    );
};
</script>
