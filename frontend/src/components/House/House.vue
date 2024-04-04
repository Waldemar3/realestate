<template>
    <div v-if="loaded">
        <ui-button @click="showDialog">
            Создать дом
        </ui-button>

        <ui-input 
            v-model="searchQuery"
        />

        <ui-button @click="search">
            Найти
        </ui-button>

        <ui-select
            :options="sortOptions"
            @select="selectFilter"
        >
            Сортировка
        </ui-select>

        <ui-dialog v-model:show="dialogVisible">

        </ui-dialog>
        <house-list 
            :houses="houses" 
            @remove="removeHouse"
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
import HouseList from '@/components/House/HouseList';

export default {
    components: {
        HouseList
    },
    data(){
        return {
            houses: [],
            loaded: false,
            dialogVisible: false,
            searchQuery: '',
            page: 1,
            sortOptions: [
                { value: 'price_usd', name: 'по цене USD' },
                { value: 'floors', name: 'по этажам' },
                { value: 'bedrooms', name: 'по спальням' },
                { value: 'area', name: 'по площади' },
            ],
        }
    },
    mounted(){
        this.loadHouses();
    },
    methods:{
        async loadHouses(search = '', filter = ''){
            this.loaded = false;
            const response = await http.post('/houses',{
                search,
                page: this.page,
                sort_type: filter,
                sort_by: 'asc'
            });
            this.houses = response.data;
            this.loaded = true;
        },
        search(){
            this.page = 1;
            this.loadHouses(this.searchQuery);
        },
        removeHouse(house){
            console.log(house);
        },
        showDialog(){
            this.dialogVisible = true;
        },
        changePage(page){
            if(page <= 0) return;
            this.page = page;
            this.loadHouses();
        },
        selectFilter(value){
            this.loadHouses('', value);
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