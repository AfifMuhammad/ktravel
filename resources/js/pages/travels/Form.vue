<template>
    <div>
        <div class="form-group" :class="{ 'has-error': errors.code }">
            <label for="">Kode Travel</label>
            <input type="text" class="form-control" v-model="travel.code" :readonly="$route.name == 'travels.edit'">
            <p class="text-danger" v-if="errors.code">{{ errors.code[0] }}</p>
        </div>
        <div class="form-group" :class="{ 'has-error': errors.name }">
            <label for="">Nama Travel</label>
            <input type="text" class="form-control" v-model="travel.name">
            <p class="text-danger" v-if="errors.name">{{ errors.name[0] }}</p>
        </div>
        <div class="form-group" :class="{ 'has-error': errors.province }">
            <label for="">Provinsi</label>
            <select class="form-control" @change="prov" v-model="travel.province">
                <option value="">Pilih</option>
                <option v-for="(row, index) in provinces.data" :value="row.id" :key="index">{{ row.name }}</option>
            </select>
        </div>
        <div class="form-group" :class="{ 'has-error': errors.region }">
            <label for="">Kab/Kota</label>
            <select class="form-control" v-model="travel.region">
                <option value="">Pilih</option>
                <option v-for="(row, index) in regencies.data" :value="row.name" :key="index">{{ row.name }}</option>
            </select>
        </div>
        <div class="form-group" :class="{ 'has-error': errors.phone }">
            <label for="">No Telp</label>
            <input type="text" class="form-control" v-model="travel.phone">
            <p class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</p>
        </div>
        <div class="form-group">
            <input type="checkbox" v-model="travel.status">
            <label for=""> Set Active</label>
        </div>
    </div>
</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex'
export default {
    name: 'FormTravels',
    created() {
        //SEBELUM COMPONENT DI-LOAD, REQUEST DATA DARI SERVER
        this.getProvinces()
        this.getRegencies()
    },
    data() {
        return {
            province: '',
            region: ''
        }
    },
    computed: {
        ...mapState(['errors']), //MENGAMBIL STATE ERRORS
        ...mapState('travel', {
            travel: state => state.travel, //MENGAMBIL STATE OUTLET
            provinces: state => state.provinces,
            regencies: state => state.regencies
        })
    },
    methods: {
        ...mapMutations('travel', ['CLEAR_FORM', 'SET_PROV']), //PANGGIL MUTATIONS CLEAR_FORM
        ...mapActions('travel', ['getProvinces', 'getRegencies']),
        prov(){
            this.getRegencies(this.travel.province)
        }
    },
    //KETIKA PAGE INI DITINGGALKAN MAKA 
    destroyed() {
        //FORM DI BERSIHKAN
        this.CLEAR_FORM()
    }
}
</script>