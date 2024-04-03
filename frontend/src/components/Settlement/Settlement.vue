<template>
    <div v-if="loaded">
        <ui-button @click="showDialog">
            Создать поселок
        </ui-button>

        <ui-input 
            v-model="searchQuery"
        />

        <ui-button @click="search">
            Найти
        </ui-button>

        <ui-dialog v-model:show="dialogVisible">

        </ui-dialog>
        <settlement-list 
            :settlements="settlements" 
            @remove="removeSettlement"
        />

        <div class="nav_btns">
            <ui-button @click="changePage(this.page-1)">Previous Page</ui-button>
            <ui-button @click="changePage(this.page+1)">Next Page</ui-button>
        </div>
    </div>
    <h2 v-else>Загрузка...</h2>
</template>

<script>
import axios from 'axios';
import SettlementList from '@/components/Settlement/SettlementList';

export default {
    components: {
        SettlementList
    },
    data(){
        return {
        settlements: [],
        loaded: false,
        dialogVisible: false,
        searchQuery: '',
        page: 1,
        }
    },
    mounted(){
        this.loadSettlements();
    },
    methods:{
        async loadSettlements(search = ''){
            this.loaded = false;
            const response = await axios.post('http://localhost/api/settlements',{
                search,
                page: this.page,
            });
            this.settlements = response.data;
            this.loaded = true;
        },
        search(){
            this.page = 1;
            this.loadSettlements(this.searchQuery);
        },
        removeSettlement(settlement){
            console.log(settlement);
        },
        showDialog(){
            this.dialogVisible = true;
        },
        changePage(page){
            if(page <= 0) return;
            this.page = page;
            this.loadSettlements();
        }
    },
};
</script>

<style>
    .nav_btns{
        margin-top: 10px;
        margin-bottom: 10px;
        width: 100%;
        display: flex;
        justify-content: space-around;
    }
</style>