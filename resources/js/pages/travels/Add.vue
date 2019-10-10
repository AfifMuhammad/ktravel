<template>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Add New Travel</h3>
            </div>
            <div class="panel-body">
                <travel-form></travel-form>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm btn-flat" @click.prevent="submit">
                        <i class="fa fa-save"></i> Add New
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapActions, mapState } from 'vuex'
    import FormTravels from './Form.vue'
    export default {
        name: 'AddTravel',
        data() {
            return {
                
            }
        },
        methods: {
            ...mapActions('travel', ['submitTravel']), //PANGGIL ACTIONS submiTravel
            submit() {
                //KETIKA TOMBOL DITEKAN MAKA FUNGSI INI AKAN DIJALANKAN
                //DIMANA FUNGSI INI TELAH DIBUAT PADA SESI SEBELUMNYA
                this.submitTravel().then(() => {
                    //APABILA BERHASIL MAKA AKAN DI-DIRECT KE HALAMAN /outlets
                    this.$router.push({ name: 'travels.data' })
                })
            }
        },
        components: {
            'travel-form': FormTravels
        }
    }
</script>