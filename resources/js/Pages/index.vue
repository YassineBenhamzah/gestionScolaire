
<template>
    <br><br>
    <div class="card col-6 offset-3">
        <div v-if="$page.props.flash.message" class="alert alert-success">
            {{ $page.props.flash.message }}
        </div>
        <table class="table table-bordered table-hover table-sm">
            <thead>
                <tr>
                    <th>name</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="customer in customers">
                    <td>{{ customer.name }}</td>
                    <td>{{ customer.email }}</td>
                    <td>{{ customer.phone }}</td>
                    <td>
                        <button class="btn btn-outline-info ">view</button>
                        <button @click.prevent="edit(customer.id)" class="btn btn-outline-warning ">edit</button>
                        <button @click.prevent="destroy(customer.id)"  class="btn btn-outline-danger">delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script setup>
import { router } from '@inertiajs/vue3';


defineProps({
    customers : Object
})

function destroy(id){
    router.delete('/customers/' + id )
}

function edit(id){
    router.get('/customers/' + id+'/edit')
}
</script>
+
