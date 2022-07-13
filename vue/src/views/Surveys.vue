<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="bg-gray-100">
        <!-- End of Navbar -->
        <div class="container mx-auto my-5 p-5">
            <div class="md:flex no-wrap md:-mx-2">
                <!-- Left Side -->
                <div class="w-full md:w-3/12 md:mx-2">
                    <!-- Profile Card -->
                    <div class="bg-white p-3 border-t-4 border-green-400">
                        <div class="image overflow-hidden">
                            <img
                                class="h-auto w-full mx-auto"
                                src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg"
                                alt=""
                            />
                        </div>
                        <h1
                            class="text-gray-900 font-bold text-xl leading-8 my-1"
                        >
                            {{data.firstName}} {{data.lastName}}
                        </h1>
                        
                        <!-- <p
                            class="text-sm text-gray-500 hover:text-gray-600 leading-6"
                        >
                            Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Reprehenderit, eligendi dolorum sequi illum
                            qui unde aspernatur non deserunt
                        </p> -->
                        <ul
                            class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm"
                        >
                            <li class="flex items-center py-3">
                                <span>Status</span>
                                <span class="ml-auto"
                                    ><span
                                        class="bg-green-500 py-1 px-2 rounded text-white text-sm"
                                        >Active</span
                                    ></span
                                >
                            </li>
                            <li class="flex items-center py-3">
                                <span>Member since</span>
                                <span class="ml-auto">{{date.getDate()}}/{{date.getMonth()+1}}/{{date.getFullYear()}}</span>
                            </li>
                        </ul>
                    </div>
                    <!-- End of profile card -->
                    <div class="my-4"></div>
                    
                </div>
                <!-- Right Side -->
                <div class="w-full md:w-9/12 mx-2 h-64">
                    <!-- Profile tab -->
                    <!-- About Section -->
                    <div class="bg-white p-3 shadow-sm rounded-sm">
                        <div
                            class="flex items-center space-x-2 font-semibold text-gray-900 leading-8"
                        >
                            <span clas="text-green-500">
                                <svg
                                    class="h-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                </svg>
                            </span>
                            <span class="tracking-wide">About</span>
                        </div>
                        <div class="text-gray-700">
                            <div class="grid md:grid-cols-2 text-sm">
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">
                                        First Name
                                    </div>
                                    <div class="px-4 py-2">{{data.firstName}}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">
                                        Last Name
                                    </div>
                                    <div class="px-4 py-2">{{data.lastName}}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">
                                        Gender
                                    </div>
                                    <div class="px-4 py-2">{{data.Gender}}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">
                                        Contact No.
                                    </div>
                                    <div class="px-4 py-2">{{data.mobileNumber}}</div>
                                </div>
                                
                                
                                <div class="grid grid-cols-4">
                                    <div class="px-4 py-2 font-semibold">
                                        Email.
                                    </div>
                                    <div class="px-4 py-2">
                                        <a
                                            class="text-blue-800"
                                            href="mailto:jane@example.com"
                                            >{{data.email}}</a
                                        >
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">
                                        Wallet
                                    </div>
                                    <div class="px-4 py-2"> {{data.wallet}} ETH</div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <!-- End of about section -->

                    <div class="my-4"></div>

                    <!-- Experience and education -->
                    <div class="bg-white p-3 shadow-sm rounded-sm">
                        <div class="grid grid-cols-1">
                            <div>
                                <div
                                    class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3"
                                >
                                    <span clas="text-green-500">
                                        <svg
                                            class="h-5"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                            />
                                        </svg>
                                    </span>
                                    <span class="tracking-wide"
                                        >Last purchase</span
                                    >
                                </div>
                                <ul class="list-inside space-y-2">
                                    <li>
                                        <div class="text-teal-600">
                                            Owner at Her Company Inc.
                                        </div>
                                        <div class="text-gray-500 text-xs">
                                            March 2020 - Now
                                        </div>
                                    </li>
                                    <li>
                                        <div class="text-teal-600">
                                            Owner at Her Company Inc.
                                        </div>
                                        <div class="text-gray-500 text-xs">
                                            March 2020 - Now
                                        </div>
                                    </li>
                                    <li>
                                        <div class="text-teal-600">
                                            Owner at Her Company Inc.
                                        </div>
                                        <div class="text-gray-500 text-xs">
                                            March 2020 - Now
                                        </div>
                                    </li>
                                    <li>
                                        <div class="text-teal-600">
                                            Owner at Her Company Inc.
                                        </div>
                                        <div class="text-gray-500 text-xs">
                                            March 2020 - Now
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            
                        </div>
                        <!-- End of Experience and education grid -->
                    </div>
                    <!-- End of profile tab -->
                </div>
            </div>
        </div>
    </div>
</template>


<style>
:root {
    --main-color: #4a76a8;
}

.bg-main-color {
    background-color: var(--main-color);
}

.text-main-color {
    color: var(--main-color);
}

.border-main-color {
    border-color: var(--main-color);
}
</style>

<script setup>
import { computed } from "vue";
import { PlusIcon } from "@heroicons/vue/solid";
import TButton from "../components/core/TButton.vue";
import PageComponent from "../components/PageComponent.vue";
import { useStore } from "vuex";

const store = useStore();

const loading = computed(() => store.state.profile.loading);
const data = computed(() => store.state.user.data);

console.log(data);
store.dispatch("getProfile");

var date= new Date(data.created_at+"+0000");
// console.log("aa",store.state.user.data.id);
// store.dispatch("getUserBoxes",store.state.user.data.id);
// const boxes = computed(() => store.state.userBoxes.data);
// console.log(boxes);

</script>
