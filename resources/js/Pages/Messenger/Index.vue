<template>
    <div class="chat-app ">

        <div class="h-screen w-full flex antialiased text-gray-200 bg-gray-900 overflow-hidden">
            <div class="flex-1 flex flex-col">
                <div class="border-b-2 border-gray-800 p-2 flex flex-row z-20">

                </div>
                <main class="flex-grow flex flex-row min-h-0">
                    <section class="flex flex-col flex-none overflow-auto">
                        <div class="header p-4 flex flex-row justify-between items-center flex-none">
                            <div class="w-16 h-16 relative flex flex-shrink-0" style="filter: invert(100%);">

                            </div>
                            <p class="text-md font-bold hidden md:block group-hover:block">Dialogs</p>

                        </div>
                        <div class="search-box p-4 flex-none">
                            <form onsubmit="">
                                <div class="relative">

                                </div>
                            </form>
                        </div>

                        <div class="contacts p-2 flex-1 overflow-y-scroll">

                            <ContractsList :conversations="conversations" @selected="startConversationWith"/>

                        </div>
                    </section>


                    <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>

                </main>
            </div>
        </div>




    </div>
</template>

<script>
import Conversation from './Conversation'
import ContractsList from './ContractsList'

export default {
    data(){
        return {
            selectedContact: null,
            messages: [],
            conversations: [],
        }
    },
    mounted() {
        // console.log(Ziggy.routes)
        axios.get(route("conversations.get"))
        .then((response)=>{
            // console.log(JSON.parse(app.dataset.page))
            console.log(response.data.data)
            this.conversations = response.data.data
        })
    },
    methods:{
        startConversationWith(contact)
        {
            axios.get(`/conversations/${contact.id}`)
            .then((response)=>{
                console.log( response.data)
                this.messages = response.data;
                this.selectedContact = contact
            })
        },
        saveNewMessage(text){
            this.messages.push(text)
        }
    },
    components: {Conversation,ContractsList}
}
</script>
