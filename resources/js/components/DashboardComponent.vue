<template>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 mt-3" v-show="dashborards.length" v-for="dashborard in dashborards">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <img :src="dashborard.icon" :alt="dashborard.name" width="50">
                    </div>
                    <p class="card-category text-dark font-weight-normal" style="font-size: 1.2rem;">{{ dashborard.name }}</p>
                    <h3 class="card-title">{{ dashborard.count }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="far fa-calendar-alt mx-2"></i> {{ dashborard.last_update }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                dashborards: []
            }
        },
        mounted() {
            this.getData()
        },
        methods: {
            getData() {
                var url = 'api/dashborard';
                axios.get(url).then(response => {
                    this.dashborards = response.data.data
                }).catch(e => {
                    console.log(e);
                });
            }
        }
    }
</script>