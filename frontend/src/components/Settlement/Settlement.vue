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
            <settlement-form :settlement="settlement" @load="load"></settlement-form>
        </ui-dialog>
        <settlement-list 
            :settlements="settlements" 
            @remove="removeSettlement"
            @edit="editSettlement"
        />

        <div class="nav_btns">
            <ui-button @click="changePage(this.page-1)">Previous Page</ui-button>
            <ui-button @click="changePage(this.page+1)">Next Page</ui-button>
        </div>
    </div>
    <h2 v-else>Загрузка...</h2>
</template>

<script>
import http from '@/http';
import SettlementList from '@/components/Settlement/SettlementList';
import SettlementForm from '@/components/Settlement/SettlementForm';

export default {
    components: {
        SettlementList,
        SettlementForm
    },
    data(){
        return {
            settlements: [],
            loaded: false,
            dialogVisible: false,
            searchQuery: '',
            page: 1,
            settlement: null,
        }
    },
    mounted(){
        this.loadSettlements();
    },
    methods:{
        async loadSettlements(search = ''){
            this.loaded = false;
            const response = await http.post('/settlements',{
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
            http.post('/settlement/delete', {id: settlement.id})
            .then(response=>(this.loadSettlements(), alert('Поселок успешно удален')))
            .catch(error=>alert(error));
        },
        editSettlement(settlement){
            this.settlement = settlement;
            this.dialogVisible = true;
        },
        showDialog(){
            this.settlement = null;
            this.dialogVisible = true;
        },
        changePage(page){
            if(page <= 0) return;
            this.page = page;
            this.loadSettlements();
        },
        load(data){
            const formData = new FormData();

            for (let key in data) {
                formData.append(key, data[key]);
            }

            if(this.settlement){
                return http.post('/settlement/update', formData)
                .then(response=>(this.dialogVisible=!this.dialogVisible, this.loadSettlements(), alert('Поселок успешно сохранен')))
                .catch(error=>alert(error));
            }

            http.post('/settlement/create', formData)
            .then(response=>(this.dialogVisible=!this.dialogVisible, this.loadSettlements(), alert('Поселок успешно создан'), this.settlement=null))
            .catch(error=>alert(error));
        },
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