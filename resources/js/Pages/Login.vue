<template >
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Admin</b>LTE</a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form  @submit.prevent="soumettre">
                   <div>
                    <div class="input-group mb-3">
                        <input
                            type="email"
                            class="form-control"
                            placeholder="Email"
                            v-model="form.email"
                            :class="{'is-invalid': form.errors.email}"
                        />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span v-if="form.errors.email" class="invalid-feedback error">{{ form.errors.email }}</span>
                   </div>
                    <div class="input-group mb-3">
                        <input
                            type="password"
                            class="form-control"
                            placeholder="Password"
                            v-model="form.password"
                            :class="{'is-invalid': form.errors.password}"
                        />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div style="width: 100%;">
                        <button type="submit" class="btn btn-primary " style="width: 100%;">
                            connexion
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import AuthLayout from  "../Layouts/AuthLayout.vue";

export default  {
    layout: AuthLayout,
    };
</script>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { useSwalError } from '@/Composables/alert';
    const form = useForm({
        email: "",
        password: "",
    })

    const soumettre = ()=>{
        form.post(route("login"),{
            onError: ()=>{
                useSwalError("une erreur s'est produite veuille réessayer plus tard")
            },
        })
    }
</script>
