<template>
    <PageComponent title="Продукты">
        <div v-if="loading" class="flex justify-center">Loading...</div>

        <div v-else class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            <div v-for="item of data" :key="item.id" class="group relative">
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
                <div class="flex justify-end border-gray-400 border-t">
                    <button  @click="checkout(item)" class="rounded p-1 my-4 bg-green-500 text-white">Добавить в корзину</button>
                </div>
            </div>
        </div>
    </PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue";
import { computed } from "vue";
import { useStore } from "vuex";

const store = useStore();

const loading = computed(() => store.state.products.loading);
const data = computed(() => store.state.products.data);
const shoppingCart = computed(() => store.state.shoppingCart);

const checkout = (product) => store.commit('pushProductToBasket', product)

store.dispatch("getProducts");
</script>

<style scoped></style>

