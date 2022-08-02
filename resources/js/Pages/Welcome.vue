<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineAsyncComponent, defineComponent } from '@vue/runtime-core';

import JetButton from '@/Jetstream/Button'
import JetModal from '@/Jetstream/Modal'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'

import NavLink from '@/Components/NavLink'
import Section from '@/Components/Section'
import Skill from '@/Components/Skill'
import Project from '@/Components/Project'
import Contact from '@/Components/Contact'

export default defineComponent({
    components: {
        Head,
        Link,
        JetButton,
        JetModal,
        JetInput,
        JetInputError,
        NavLink,
        Section,
        Skill,
        Project,
        Contact,
    },

    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        skills: Object,
        projects: Object,
        user: Object,
    },

    methods: {
        skillComponentName(skillIndex) {
            return defineAsyncComponent(() => 
                import (
                    '@heroicons/vue/solid/' 
                    + this.skills[skillIndex].icon_name
                    + 'Icon.js'
                )
            )
        },
        submit() {
            this.form.post(route('contact'));
        },
    },

    data() {
        return {
            contacting: null,
            form: this.$inertia.form({
                'email' : '',
                'message' : '',
            }),
        }
    }
})

</script>

<template>

    <Head title="Welcome" />

    <div class="
        flex
        justify-between
        py-10
        px-72
        bg-indigo-800
        text-gray-300
    ">
        <div>
            <p class="text-gray-200 font-bold text-2xl">
                { ivanurportfolio.com }
            </p>
        </div>
        <div>
            <Contact></Contact>
        </div>
    </div>

    <!-- Main-->
    <Section class="bg-gray-900 pt-16 h-screen">
        <div class="h-2/3 flex flex-wrap content-between border-gray-600 pb-36">
            <div>
                <p class="border-b-2 font-bold border-gray-400 pb-3 text-2xl text-gray-300 uppercase">Hey! this is Ivan Larrañaga. I'm a obsessive Jr. web developer working with Laravel.</p>
                
                <!-- Current Profile Photo -->
                <div class="flex justify-center">
                    <div v-if="user" class="my-10">
                        <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-60 w-60 object-cover">
                    </div>
                </div>
            </div>
            <div class="mt-6 flex items-end border-b-2 border-gray-500 pb-2">
                <p class="font-bold mr-5 text-gray-500 text-xl">Want to know more?</p>
                <jet-button 
                    class="bg-green-400 rounded font-bold text-sm text-gray-800 hover:bg-green-500"
                    @click="contacting = true"
                >
                    {{ 
                        $page.props.flash.contacted ? 'Thanks' : 'Let\'s Chat'  
                    }}
                </jet-button>
            </div>
        </div>  
        <p class="text-center text-gray-300 font-extrabold text-xl">See more...</p>
        <div class="animate-pulse mt-3 text-gray-300 text-center text-9xl">
            <a href="#skills">&#8675;</a>
        </div>
    </Section> 

    <!-- Skills -->
    <Section id="skills" class="bg-gray-200 text-gray-800 h-screen">
        <h2 class="text-6xl font-bold pt-3">Skills & Tools</h2>
        
        <div class="grid grid-cols-2">
            <div v-for="(skill, skillIndex) in skills" :key="skill.id">
                <Skill
                    :name="skill.name"
                    :color="skill.color"
                >
                    <!-- Icon -->
                    <component :is="skillComponentName(skillIndex)"></component>
                </Skill>
            </div>
        </div>

        <div class="flex justify-center mt-10">
            <jet-button 
                class="bg-indigo-800 rounded font-bold text-sm text-gray-200 hover:bg-indigo-700"
                @click="contacting = true"
            >
                {{ 
                    $page.props.flash.contacted ? 'Thanks' : 'Get in touch'  
                }}
            </jet-button>
        </div>
    </Section>

    <!-- Projects -->
    <Section id="projects" class="bg-gray-600 text-gray-200 h-screen">
        <h2 class="text-6xl font-bold pt-3">Projects</h2>
            <div class="mt-3 px-44">
                <p class="text-center text-lg">
                    "Because Laravel is such more than e-commerce apps"
                </p> 
            </div>
            <div v-for="project in projects" :key="project.id">
                <Project 
                    :title="project.title" 
                    :description="project.description"
                    :link="project.link"
                >
                    <img :src="project.logo_path" alt="imagen-proyecto" width="100">
                </Project>
            </div>
            
        <div class="flex justify-center mt-10">
            <jet-button 
                class="bg-purple-200 rounded font-bold text-sm text-gray-800 hover:bg-purple-300"
                @click="contacting = true"
            >
                {{ 
                    $page.props.flash.contacted ? 'Thanks' : 'Know more'  
                }}
            </jet-button>
        </div>
    </Section>

    <!-- Footer -->
    <Section class="flex justify-between bg-gray-800 text-gray-300">
        <p class="text-xl">Developed by Ivan Larrañaga &copy; {{ new Date().getFullYear() }}</p>
        <Contact></Contact>
    </Section>

    <!-- Modals -->
    <jet-modal :show="contacting" closable="true" @close="contacting = null"> 
        <div
            v-if="$page.props.flash.contacted"
            class="bg-green-400 shadow-2xl p-8 text-center font-bold"
        >
        <!-- v-if="$page.props.flash.contacted" Si se pusieron en contacto con nosotros-->
        
            <p class="text-8xl m-5">👍</p>

            <p class="text-5xl text-white font-bold m-2">Thanks!</p>

            <p class="text-xl text-gray-700 m-2">I'll get back to you soon.</p>
        </div>
        
        <div v-else class="bg-gray-50 shadow-2xl p-8">
            <p class="text-gray-600 text-2xl font-extrabold text-center">
                Let me know some details
            </p>

            <form
                class="flex flex-col items-center p-16"
                @submit.prevent="submit"
            >
                <jet-input
                    class="px-5 py-3 w-96 border border-gray-600 rounded"
                    type="email"
                    name="email"
                    placeholder="Your email"
                    v-model="form.email" 
                ></jet-input>
                <!-- v-model: para que se hagan efectivos los cambios al rellenar los campos -->

                <jet-input-error :message="form.errors.email" />

                <textarea
                    class="px-5 py-3 w-96 border border-gray-600 rounded mt-5"
                    name="message"
                    placeholder="The details :)"
                    v-model="form.message"
                ></textarea>

                <jet-input-error :message="form.errors.message" />

                <jet-button
                    class="px-5 py-3 mt-5 w-96 bg-purple-400 justify-center rounded-xl text-sm"
                    :disabled="form.processing"
                >
                    <span class="animate-spin mr-1" v-show="form.processing">
                        &#9696;
                    </span>
                    <span v-show="!form.processing">
                        Get in touch    
                    </span>
                </jet-button>
            </form>
        </div>
    </jet-modal>
</template>

