<template>
    <PageComponent title="Dashboard">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="container mx-auto px-4 py-8">
            <DashboardCard class="container" style="animation-delay: 0.1s">
                <template v-slot:title>All Boxes</template>
                <div class="">
                    <div v-for="box in data.response">
                        <div class="row" style="border-bottom: solid 1px red">
                            <h1>id : {{ box.id }}</h1>
                            <h2>created at : {{ box.created_at }}</h2>
                            <h2>price :</h2>
                            <div class="flex items-center justify-center">
                                <TButton class="bg-yellow-500 text-white font-bold py-2 px-4 rounded"
                                    :to="{
                                        name: 'SurveyView',
                                        params: { id: box.id },
                                    }"
                                    link
                                >more info
                                </TButton>
                            </div>
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                v-if="box.sold == false"
                            >
                                buy
                            </button>
                            <button
                                class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded disable"
                                v-else
                            >
                                sold out
                            </button>
                        </div>
                    </div>
                </div>
                {{ token }}
            </DashboardCard>
        </div>
    </PageComponent>
</template>

<script setup>
import { EyeIcon, PencilIcon } from "@heroicons/vue/solid";
import DashboardCard from "../components/core/DashboardCard.vue";
import TButton from "../components/core/TButton.vue";
import PageComponent from "../components/PageComponent.vue";
import { computed } from "vue";
import { useStore } from "vuex";

const store = useStore();

const loading = computed(() => store.state.dashboard.loading);
const data = computed(() => store.state.dashboard.data);
const token = sessionStorage.getItem("TOKEN");

store.dispatch("getDashboardData");
console.log(data);
</script>

<style scoped></style>
