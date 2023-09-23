<template>
    <PageComponent title="Корзина">
        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            <div v-for="item of shoppingCart" :key="item.id" class="group relative">
                <div
                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-72">
                    <img :src="item.image_url" alt=""
                         class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                </div>
                <div class="my-2 flex justify-between">
                    <div>
                        <div>
                            <h3 class="text-sm text-gray-700">
                                {{ item.name }}
                            </h3>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">{{ item.description }}</p>
                    </div>
                    <p class="text-sm font-medium text-gray-900">{{ item.price }} T</p>
                </div>
            </div>
        </div>
        <div class="mt-6 pt-4 border-t text-lg font-semibold">
            <span @click="checkout" :disable="shoppingCart.length===0" class="cursor-pointer border-gray-600 border p-2 rounded">Оформить заказ</span>
        </div>
    </PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue";
import { computed } from "vue";
import { useStore } from "vuex";
import { v1 as uuidv4 } from 'uuid'
import { useRouter } from "vue-router";


const store = useStore();
const router = useRouter();
const shoppingCart = computed(() => store.state.shoppingCart);
const user = computed(() => store.state.user.data);


function checkout(){
    store
        .dispatch("checkout", generateOrdersData())
        .then((response) => {
            store.commit('clearBasket');
            router.push({name: 'Products'});
        });
}

function generateOrdersData(){
    let orders = [];
    shoppingCart.value.forEach((el) => {
        orders.push({
            number: uuidv4(),
            product_id: el.id,
            created_by: user.value.id
        })
    });
    return orders;
}

</script>

<style scoped>

</style>
