<template>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Bonjour {{ user.name }}</h1>
                    </div>
                </div>
            </div>
        </div>


        <div class="content">
            <div class="container-fluid">
                <h1>Acceuil</h1>
            </div>
        </div>
</template>

<script setup>
    import {usePage} from '@inertiajs/vue3';
    import {computed} from 'vue';

    const user = computed(()=>{
            return usePage().props.auth.user
    })
</script>


<!-- <script setupt>
import MainLayout from '../Layouts/MainLayout.vue';
export default {
    layout : MainLayout,
}
</script>

<script setup>

</script> -->
