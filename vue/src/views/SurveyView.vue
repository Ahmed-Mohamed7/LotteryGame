<template>
    <PageComponent>
        <template v-slot:header>
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ route.params.id }}
                    {{ route.params.id ? model.title : "Create a Survey" }}
                </h1>

                <div class="flex">
                    <TButton
                        v-if="model.slug"
                        link
                        :href="`/view/survey/${model.slug}`"
                        target="_blank"
                        class="mr-2"
                    >
                        <ExternalLinkIcon class="w-5 h-5" />
                        View Public link
                    </TButton>
                    <TButton
                        v-if="route.params.id"
                        color="red"
                        @click="deleteSurvey()"
                    >
                        <TrashIcon class="w-5 h-5 mr-2" />
                        Delete
                    </TButton>
                </div>
            </div>
        </template>
        <!-- <div v-if="surveyLoading" class="flex justify-center">Loading...</div> -->
    </PageComponent>
    <!-- {{data.price}} -->
    <div v-for="box in data">
        <section class="text-gray-600 body-font overflow-hidden">
            <div class="container px-5 py-5 mx-auto">
                <div class="lg:w-4/5 mx-auto flex flex-wrap">
                    <img
                        alt="ecommerce"
                        class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                        :src="box.Image"
                    />
                    <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                        <h2
                            class="text-sm title-font text-gray-500 tracking-widest"
                        ></h2>
                        <h1
                            class="text-gray-900 text-3xl title-font font-medium mb-1"
                        >
                            {{ box.Name }}
                        </h1>
                        <p class="leading-relaxed">
                            {{ box.Description }}
                        </p>
                        <div class="flex">
                            <span
                                class="title-font font-medium text-2xl text-gray-900"
                                >Quatity : {{ box.quanlity }}
                            </span>
                        </div>
                        <div class="flex">
                            <span
                                class="title-font font-medium text-2xl text-gray-900"
                                >{{ box.price }} ETH
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container">
            <h1>total price :  {{ price }} ETH</h1>
        </div>
        <button class="bg-blue">
            <span class="title-font font-medium text-2xl text-gray-900">
                Buy
            </span>
        </button>
    </section>
</template>

<script setup>
import { v4 as uuidv4 } from "uuid";
import { computed, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { SaveIcon, TrashIcon, ExternalLinkIcon } from "@heroicons/vue/solid";
import { useStore } from "vuex";
import TButton from "../components/core/TButton.vue";
const router = useRouter();

const route = useRoute();

// Get survey loading state, which only changes when we fetch survey from backend

const store = useStore();
const surveyLoading = computed(() => store.state.box.loading);

// If the current component is rendered on survey update route we make a request to fetch survey
const data = computed(() => store.state.box.data[0]);
const price = computed(() => store.state.box.data[1]);
store.dispatch("getBoxById", route.params.id);
console.log(data);

function deleteSurvey() {
    if (
        confirm(
            `Are you sure you want to delete this survey? Operation can't be undone!!`
        )
    ) {
        store.dispatch("deleteSurvey", model.value.id).then(() => {
            router.push({
                name: "Surveys",
            });
        });
    }
}
</script>

<style></style>
