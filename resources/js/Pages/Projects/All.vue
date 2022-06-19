<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Projects
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
                
                <jet-button
                    class="p-3 border-2 border-blue-500 text-blue-500 bg-blue-100 hover:bg-blue-200 font-bold rounded-xl"
                    @click="acting = true;
                        method='post';
                        action= route('projects.store');
                        form.title = '';
                        form.description = '';
                        form.link = '';
                        form.logo = '';
                    "
                >
                    Add new +
                </jet-button>

                <!-- Modal -->
                <jet-modal :show="acting" @close="acting = null"> 
                    
                    <div class="bg-gray-50 shadow-2xl p-8">
                        <form
                            class="flex flex-col items-center p-16"
                            @submit.prevent="submit"
                        >
                            <jet-input
                                class="px-5 py-3 w-96 border border-gray-600 rounded"
                                type="text"
                                name="title"
                                placeholder="Project title"
                                v-model="form.title" 
                            ></jet-input>
                            <!-- v-model: para que se hagan efectivos los cambios al rellenar los campos -->

                            <jet-input-error :message="form.errors.title" />

                            <jet-input
                                class="px-5 py-3 w-96 border border-gray-600 rounded mt-5"
                                type="text"
                                name="description"
                                placeholder="Project description"
                                v-model="form.description" 
                            ></jet-input>

                            <jet-input-error :message="form.errors.description" />

                            <jet-input
                                class="px-5 py-3 w-96 border border-gray-600 rounded mt-5"
                                type="text"
                                name="link"
                                placeholder="Project URL"
                                v-model="form.link" 
                            ></jet-input>

                            <jet-input-error :message="form.errors.link" />

                            <jet-input 
                                class="px-5 py-3 w-96 border border-gray-600 rounded mt-5"
                                type="file" 
                                @input="form.logo = $event.target.files[0]">
                            </jet-input>

                            <jet-input-error :message="form.errors.logo" />

                            <jet-button
                                class="px-5 py-3 mt-5 w-96 bg-purple-400 justify-center rounded-xl text-sm"
                                :disabled="form.processing"
                            >
                                <span class="animate-spin mr-1" v-show="form.processing">
                                    &#9696;
                                </span>
                                <span v-show="!form.processing">
                                    Submit    
                                </span>
                            </jet-button>
                        </form>
                    </div>
                </jet-modal>                

                <table v-if="projects.length > 0" class="w-full text-left">
                    <thead
                        class="border-b-2 border-gray-300 text-indigo-600"
                    >
                        <tr>
                            <th class="px-6 py-3 text-left">
                                Title
                            </th>
                            <th class="px-6 py-3 text-left">
                                Description
                            </th>
                            <th class="px-6 py-3 text-left">
                                Link
                            </th>
                            <th class="px-6 py-3 text-left">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody v-for="project in projects" :key="project.id">
                        <tr
                            class="text-sm text-indigo-900 border-b border-gray-400"
                        >
                            <td class="px-6 py-4">
                                {{ project.title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ project.description }}
                            </td>
                            <td class="px-6 py-4">
                                {{ project.link }}
                            </td>
                            
                            <td class="px-6 py-4">
                                <jet-button
                                    class="border border-indigo-500 text-indigo-500 bg-indigo-50 hover:bg-indigo-100 mr-2"
                                    @click="
                                        acting = true;
                                        method='put';
                                        action= route('projects.update', [project.id]);
                                        form.title = project.title;
                                        form.description = project.description;
                                        form.link = project.link;
                                        // form.logo = project.logo_path;
                                    "
                                >
                                    Edit
                                </jet-button>
                                <jet-button
                                    class="border border-red-500 text-red-500 bg-red-50 hover:bg-red-100 ml-2"
                                    @click="
                                        confirmingUserDeletion = true;
                                        method='delete';
                                        action= route('projects.destroy', [project.id]);
                                    "
                                >
                                    Delete
                                </jet-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div v-else class="mt-5 text-left bg-yellow-100 w-72 border border-yellow-400 p-3 rounded-lg text-red-800">
                    There are no projects yet. Let's create one :)
                </div>

                <jet-confirmation-modal :show="confirmingUserDeletion" @close="confirmingUserDeletion = false">
                    <template #title>
                        Delete Project
                    </template>

                    <template #content>
                        Are you sure you want to delete permanently this Project? 
                    </template>

                    <template #footer>
                        <jet-secondary-button @click="confirmingUserDeletion = false">
                            Nevermind
                        </jet-secondary-button>

                        <jet-danger-button 
                            class="border border-red-500 text-red-500 bg-red-50 hover:bg-red-100 ml-2"
                            @click="
                                confirmingUserDeletion = false;
                                submit();
                            "
                        >
                            Delete 
                        </jet-danger-button>
                    </template>
                </jet-confirmation-modal>   

            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetModal from '@/Jetstream/Modal'
    import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import JetDangerButton from '@/Jetstream/DangerButton'
    
    export default {
        components: {
            AppLayout,
            JetButton,
            JetInput,
            JetInputError,
            JetModal,
            JetConfirmationModal,
            JetSecondaryButton,
            JetDangerButton,
        },

        data() {
            return {
                acting: null,
                confirmingUserDeletion: null,
                method: null,
                action: null,
                form: this.$inertia.form({
                    'title' : '',
                    'description' : '',
                    'link' : '',
                    'logo' : '',
                }),
            }
        },

        methods: {
            submit() {
                this.form.submit(this.method, this.action, {
                    onSuccess: () => {
                        this.form.reset('title')
                        this.form.reset('description')
                        this.form.reset('link')
                        this.form.reset('logo')
                        this.acting = null
                    }
                });
            },
        },

        props: {
            projects: Object,
        },
    }
</script>