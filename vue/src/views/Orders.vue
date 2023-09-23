<template>
    <PageComponent title="Мой заказы">
        <div v-if="ordersLoading" class="flex justify-center">Loading...</div>
        <div v-else class="mt-6">
            <div v-if="orders.length>0">
                <div v-for="order of orders" :key="order.id" class="flex mb-4">
                    <div
                        class="w-64 overflow-hidden rounded-md bg-gray-200">
                        <img :src="order.product.image_url" alt=""
                             class="h-full w-full object-cover object-center">
                    </div>
                    <div class="my-2 grow p-4">
                        <div class="mb-4">
                                <h3 class="text-sm text-gray-700">
                                    {{ order.product.name }}
                                </h3>
                            <p>{{ order.product.description }}</p>
                        </div>
                        <p class="text-sm font-medium text-gray-900"><span>Статус: </span> {{ order.status }} T</p>
                    </div>
                </div>
            </div>
            <div v-else>
                Пусто
            </div>
        </div>
    </PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue";
import { computed, onMounted } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";


const store = useStore();
const router = useRouter();
const orders = computed(() => store.state.orders.data);
const ordersLoading = computed(() => store.state.orders.loading);
const user = computed(() => store.state.user.data);

onMounted(() => {
    store.dispatch("getUser").then( res => {
        console.log(res)
         store.dispatch("getOrders", {params: { created_by: res.id }});
    });
})

</script>

<style scoped>

</style>
